<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['from', 'to', 'price', 'duration', 'user_id'];

    protected $table = 'bookings';
    protected $primaryKey = 'id';
    protected static function boot()
    {
        parent::boot();
        static::deleted(function($booking) {
            foreach(['plans'] as $relation) {
                foreach($booking->$relation()->get() as $child){
                    $child->delete();
                }
            }
        });
    }
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    public function plans()
    {
        return $this->hasMany('App\Plan', 'booking_id', 'id');
    }
}
