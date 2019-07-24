<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
	protected $fillable = [
        'name', 'email', 'password', 'description',
    ];

    public function hosts() {

        return $this->hasMany('App\Host');
    }

    public function service_locations() {

        return $this->hasMany('App\ServiceLocation');
    }
}
