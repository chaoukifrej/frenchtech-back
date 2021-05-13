<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Actor;
use Grosv\LaravelPasswordlessLogin\LoginUrl;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActorLoginMail;

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
        $user = Actor::where("email", "=", $email)->first();

        if (empty($user)) {
            return back();
        }

        $generator = new LoginUrl($user);
        $generator->setRedirectUrl('/somewhere/else'); // Override the default url to redirect to after login
        $data['url'] = $generator->generate();
        $data['user'] = $user;

        Mail::to($user->email)->send(new ActorLoginMail($data));

        return back();
    }
}
