<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use Notifiable;

    protected $fillable = [

    'name',
    'email', 
    'password', 
    'description',
    'mobile',
    'picture',
    'work',
    'school',
    'language',
	];

	protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
