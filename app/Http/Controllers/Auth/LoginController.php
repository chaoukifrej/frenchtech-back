<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Actor;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActorLoginMail;
use Illuminate\Support\Carbon;

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
    }

    public function sendLoginLink(Request $request)
    {

        $email = $request->get('email');
        $actor = Actor::where("email", "=", $email)->first();

        try {
            if (!isset($actor) || $actor == null) {
                return response()->json(["success" => "false"], 401);
            } else {
                $magicLink = \Str::random(25);
                $actor->magic_link = $magicLink;
                $actor->save();

                $data['url'] = $magicLink;
                $data['user'] = $actor;
                Mail::to($actor->email)->send(new ActorLoginMail($data));
                return response()->json(["success" => "true"], 200);
            };
        } catch (\Throwable $th) {
            return response()->json(["message" => $th], 401);
        }
    }

    public function confirmLogin($ml, $id)  //Confirmation du login avec magicLink
    {
        $timeNow = Carbon::now()->subMinutes(5)->toDateTimeString();
        $actor = Actor::where("id", "=", $id)->first();

        if ($actor->updated_at > $timeNow) {
            if ($ml == $actor->magic_link) {
                $actor->api_token = \Str::random(80);
                $actor->save();
                return response()->json(["success" => "true", "message" => "Connexion réussi", 'token' => $actor->api_token], 200);
            } else {
                return response()->json(["success" => "false", "message" => "le magicLink ne correspond pas"], 401);
            }
        } else {
            return response()->json(["success" => "false", "message" => "Date éxpiré"], 401);
        }
    }
}
