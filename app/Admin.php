<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'firstname', 'lastname', 'email', 'magic_link', 'api_token'
    ];
    protected $hidden = [
        'magic_link', 'api_token',
    ];

    protected $guard = 'admin';
}
