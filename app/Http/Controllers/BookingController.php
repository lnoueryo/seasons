<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Booking;
use App\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function create(Request $request){
        return DB::transaction(function () use ($request) {
            $booking = new Booking;
            $booking->fill($request->all());
            $booking->from = date("Y-m-d H:i:s", strtotime($request->from));
            $booking->to = date("Y-m-d H:i:s", strtotime($request->to));
            $booking->save();
            if (is_array($request->title) && 1 < count($request->title)) {
                for ($i=0; $i < count($request->title); $i++) { 
                    $plan = new Plan;
                    $plan->title = $request->title[$i];
                    $plan->user_id = $request->user_id;
                    $plan->booking_id = $booking->id;
                    $plan->save();
                }
            } else {
                $plan = new Plan;
                $plan->title = $request->title;
                $plan->user_id = $request->user_id;
                $plan->booking_id = $booking->id;
                $plan->save();
            }
        });
    }
    public function show(){
        $booking = Booking::whereDate('from', '>=', '2021-03-01')->get();
        // dd($booking);
        return $booking;
    }
}
