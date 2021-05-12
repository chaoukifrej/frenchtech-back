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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'actor_id' => ['int'],
            'logo' => ['required', 'string'],
            'name' => ['required', 'string', 'max:64'],
            'adress' => ['required', 'string'],
            'postal_code' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:64', 'unique:users'],
            'longitude' => ['string'],
            'latitude' => ['string'],
            'phone' => ['required', 'string'],
            'category' => ['required', 'string'],
            'associations' => ['required', 'string'],
            'description' => ['required', 'string'],
            'activity_area' => ['required', 'string'],
            'funds' => ['string'],
            'employees_number' => ['required', 'string'],
            'jobs_available_number' => ['required', 'string'],
            'women_number' => ['required', 'string'],
            'revenues' => ['required', 'string'],
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
            'actor_id' => 2,
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
