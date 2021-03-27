<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    protected $fillable = ['from', 'to', 'duration', 'user_id', 'shop_id', 'staff_id'];

    protected $table = 'bookings';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected static function boot()
    {
        parent::boot();
        static::deleted(function($booking) {
            foreach(['plans', 'payment'] as $relation) {
                foreach($booking->$relation()->get() as $child){
                    $child->delete();
                }
            }
        });
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::orderedUuid();
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
    public function payment()
    {
        return $this->hasOne('App\Payment', 'booking_id', 'id');
    }

}
