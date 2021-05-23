<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Actor extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'api_token', 'postal_code', 'facebook', 'linkedin', 'twitter', 'longitude', 'latitude', 'logo', 'city', 'adress', 'phone', 'category', 'associations', 'description', 'activity_area', 'funds', 'employees_number', 'jobs_available_number', 'women_number', 'revenues', 'actor_id', 'website'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'funds', 'employees_number', 'jobs_available_number', 'women_number', 'revenues', 'magic_link', 'api_token', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
