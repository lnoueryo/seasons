<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['title', 'booking_id', 'user_id'];
}
