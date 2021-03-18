<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['from', 'to', 'price', 'duration', 'user_id'];
}
