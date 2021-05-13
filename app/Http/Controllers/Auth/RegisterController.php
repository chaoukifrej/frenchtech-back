<?php

namespace App\Http\Controllers\Auth;

use App\Buffer;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
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

    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
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
            'revenues' => ['required', 'numeric'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Buffer
     */
    protected function store(array $data)
    {
        return Buffer::create([
            'actor_id' => null,
            'name' => $data['name'],
            'email' => $data['email'],
            'logo' => $data['logo'],
            'adress' => $data['adress'],
            'longitude' => $data['longitude'],
            'latitude' => $data['latitude'],
            'phone' => $data['phone'],
            'category' => $data['category'],
            'associations' => $data['associations'],
            'description' => $data['description'],
            'activity_area' => $data['activity_area'],
            'funds' => $data['funds'],
            'employees_number' => $data['employees_number'],
            'jobs_available_number' => $data['jobs_available_number'],
            'women_number' => $data['women_number'],
            'revenues' => $data['revenues'],
        ]);
    }
}
