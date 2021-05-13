<?php

namespace App\Http\Controllers\Auth;

use App\Buffer;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request)
    {
        return Validator::make($request, [
            'logo' => ['required', 'string'],
            'name' => ['required', 'string', 'max:64'],
            'adress' => ['required', 'string', 'max:64'],
            'postal_code' => ['required', 'integer', 'max:5'],
            'city' => ['required', 'string', 'max:64'],
            'longitude' => ['numeric', 'nullable'],
            'latitude' => ['numeric', 'nullable'],
            'email' => ['required', 'string', 'email', 'max:64', 'unique:users'],
            'phone' => ['required', 'integer', 'max:20'],
            'category' => ['required', 'string', 'max:64'],
            'associations' => ['nullable', 'string', 'max:64'],
            'description' => ['required', 'string'],

            'facebook' => ['nullable', 'string'],
            'twitter' => ['nullable', 'string'],
            'linkedin' => ['nullable', 'string'],

            'activity_area' => ['required', 'string', 'max:64'],
            'funds' => ['required', 'numeric'],
            'employees_number' => ['required', 'integer'],
            'jobs_available_number' => ['required', 'integer'],
            'women_number' => ['required', 'integer'],
            'revenues' => ['required', 'numeric']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Buffer
     */
    protected function store(Request $request)
    {
        try {
            Buffer::create([
                'actor_id' => null,
                'name' => $request['name'],
                'email' => $request['email'],
                'logo' => $request['logo'],
                'adress' => $request['adress'],
                'postal_code' => $request['postal_code'],
                'city' => $request['city'],
                'longitude' => $request['longitude'],
                'latitude' => $request['latitude'],
                'phone' => $request['phone'],
                'category' => $request['category'],
                'associations' => $request['associations'],
                'description' => $request['description'],
                'activity_area' => $request['activity_area'],
                'funds' => $request['funds'],
                'employees_number' => $request['employees_number'],
                'jobs_available_number' => $request['jobs_available_number'],
                'women_number' => $request['women_number'],
                'revenues' => $request['revenues'],
            ]);
            return response()->json(["body" => "success"], 200);
        } catch (\Throwable $th) {
            return response()->json(["body" => $th], 401);
        }
    }
}
