<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceLocation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'full_address', 'description',
    ];

    
    public function bookings() {

        return $this->hasMany('App\Booking');
    }
}
