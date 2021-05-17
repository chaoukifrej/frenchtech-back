<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Actor;
use App\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActorLoginMail;
use App\Mail\AdminLoginMail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        //$this->middleware('guest:admin')->except(['logout', 'logoutAdmin']);
    }

    public function sendMagicLink(Request $request)
    {
        $email = $request->email;
        $actor = Actor::where("email", "=", $email)->first();
        $sendToAdmin = false;

        $actor ? $sendToAdmin = false : $sendToAdmin = true;

        if ($sendToAdmin) {
            $this->sendLoginLinkAdmin($email);
        } else {
            $this->sendLoginLink($email);
        }
    }

    public function sendLoginLink($email) //Envoi de l'email avec le magic link ACTOR
    {

        $actor = Actor::where("email", "=", $email)->first();

        try {
            if (!isset($actor) || $actor == null) {
                return response()->json(["success" => "aucun acteur trouvé"], 401);
            } else {
                $magicLink = \Str::random(25);
                $actor->magic_link = $magicLink;
                $actor->save();

                $data['url'] = $magicLink;
                $data['user'] = $actor;
                Mail::to($actor->email)->send(new ActorLoginMail($data));
                return response()->json(["success" => "lien envoyé par email"], 200);
            };
        } catch (\Throwable $th) {
            return response()->json(["message" => $th], 401);
        }
    }

    public function confirmLogin($ml, $id)  //Confirmation du login avec magicLink et creation du token ACTOR
    {
        $timeNow = Carbon::now()->subMinutes(5)->toDateTimeString();
        $actor = Actor::where("id", "=", $id)->first();

        if ($actor->updated_at > $timeNow) {
            if ($ml == $actor->magic_link) {
                $token = \Str::random(80);
                $actor->api_token = hash('sha256', $token);
                $actor->save();
                return response()->json(["success" => "true", "message" => "Connexion réussi", 'token' => $token], 200);
            } else {
                return response()->json(["success" => "false", "message" => "le magicLink ne correspond pas"], 401);
            }
        } else {
            return response()->json(["success" => "false", "message" => "Date éxpiré"], 401);
        }
    }

    public function logout() // Logout avec suppression de l'api_token ACTOR
    {
        try {
            $id = Auth::user()->id;
            $actor = Actor::where("id", "=", $id)->first();
            $actor->api_token = null;
            $actor->save();
            return response()->json(["message" => "Déconnexion réussi"], 200);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th], 401);
        }
    }


    public function sendLoginLinkAdmin($email) //Envoi de l'email avec le magic link ADMIN
    {

        $admin = Admin::where("email", "=", $email)->first();

        try {
            if (!isset($admin) || $admin == null) {
                return response()->json(["success" => "Aucun admin trouvé"], 401);
            } else {
                $magicLink = \Str::random(25);
                $admin->magic_link = $magicLink;
                $admin->save();

                $data['url'] = $magicLink;
                $data['admin'] = $admin;
                Mail::to($admin->email)->send(new AdminLoginMail($data));
                return response()->json(["success" => "Lien magique envoyé par email"], 200);
            };
        } catch (\Throwable $th) {
            return response()->json(["message" => $th], 401);
        }
    }

    public function confirmLoginAdmin($ml, $id)  //Confirmation du login avec magicLink et creation du token ADMIN
    {
        $timeNow = Carbon::now()->subMinutes(5)->toDateTimeString();
        $admin = Admin::where("id", "=", $id)->first();

        if ($admin->updated_at > $timeNow) {
            if ($ml == $admin->magic_link) {
                $token = \Str::random(80);
                $admin->api_token = hash('sha256', $token);
                $admin->save();
                return response()->json(["success" => "true", "message" => "Connexion réussi", 'token' => $token], 200);
            } else {
                return response()->json(["success" => "false", "message" => "le magicLink ne correspond pas"], 401);
            }
        } else {
            return response()->json(["success" => "false", "message" => "Date éxpiré"], 401);
        }
    }

    public function logoutAdmin() // Logout avec suppression de l'api_token ADMIN
    {
        try {
            $id = Auth::guard('admin')->user()->id;
            $admin = Admin::where("id", "=", $id)->first();
            $admin->api_token = null;
            $admin->save();
            return response()->json(["message" => "Déconnexion réussi"], 200);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th], 401);
        }
    }
}
