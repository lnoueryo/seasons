<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:web')->get('/check', function () {
    return Auth::user();
});

Route::get('/time', function(){
    return Carbon::now();
});

Route::get('/booking', 'BookingController@index');
Route::post('/booking/create', 'BookingController@create');
Route::get('/booking/show/{id}', 'BookingController@show');
Route::post('/booking/update/{id}', 'BookingController@update');
Route::delete('/booking/{id}', 'BookingController@destroy');