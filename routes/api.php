<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Shop;
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
Route::resource('booking', 'BookingController', ['except' => ['index', 'create', 'edit', 'show']]);


Route::get('/booking/{sid}', 'BookingController@index');
// Route::get('/booking/create', 'BookingController@create');
// Route::post('/booking', 'BookingController@store');
Route::get('/booking/{sid}/{id}', 'BookingController@show');
// Route::post('/booking/{id}/edit', 'BookingController@edit');
// Route::put('/booking/{id}', 'BookingController@update');
// Route::delete('/booking/{id}', 'BookingController@destroy');
Route::get('/shop/{sid}', function($sid){
    try {
        $shop = Shop::findOrFail($sid);
        $message = $shop;
        $status = 200;
        return response($message, $status);
    } catch (\Throwable $th) {
        $message = ['message' => 'ERROR DB connection NG '];
        $status = 404;
        return response()->json([
            'status' => $status,
            'errors' => 'u'
        ], $status);
    }
});
// Route::get('/shop/{sid}', function($sid){
//     try{
//         $shop = Shop::find($sid)->first();
//         return $shop;
//     } catch (Exception $e) {
//         return 'aaa';
//     }
// });