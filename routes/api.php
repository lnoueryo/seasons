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
Route::resource('booking', 'BookingController');

// Route::get('/booking', 'BookingController@index');
// Route::get('/booking/create', 'BookingController@create');
// Route::post('/booking', 'BookingController@store');
// Route::get('/booking/{id}', 'BookingController@show');
// Route::post('/booking/{id}/edit', 'BookingController@edit');
// Route::put('/booking/{id}', 'BookingController@update');
// Route::delete('/booking/{id}', 'BookingController@destroy');