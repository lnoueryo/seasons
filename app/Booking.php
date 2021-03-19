<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['from', 'to', 'price', 'duration', 'user_id'];

    protected $table = 'bookings';
    protected $primaryKey = 'id';
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    public function plans()
    {
        return $this->hasMany('App\Plan', 'booking_id', 'id');
    }
}
