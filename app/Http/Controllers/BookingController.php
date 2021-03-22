<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Booking;
use App\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\NewBooking;

class BookingController extends Controller
{
    public $booking;
    public function store(Request $request){
        DB::transaction(function () use ($request) {
            $this->booking = new Booking;
            $this->booking->fill($request->all());
            $this->booking->from = $request->from;
            $this->booking->to = $request->to;
            $this->booking->save();
            if (is_array($request->title)) {
                for ($i=0; $i < count($request->title); $i++) { 
                    $plan = new Plan;
                    $plan->title = $request->title[$i];
                    $plan->user_id = $request->user_id;
                    $plan->booking_id = $this->booking->id;
                    $plan->save();
                }
            } else {
                $plan = new Plan;
                $plan->title = $request->title;
                $plan->user_id = $request->user_id;
                $plan->booking_id = $this->booking->id;
                $plan->save();
            }
        });
        $booking = Booking::with(['user', 'plans'])->find($this->booking->id);
        event(new NewBooking($booking));
        return $booking;
    }

    public function index(){
        $time = Carbon::now('Asia/Tokyo')->getTimestamp();
        $bookings = Booking::with(['user', 'plans'])->whereDate('from', '>=', $time)->get();
        return $bookings;
    }

    public function show($id){
        $booking = Booking::with(['user', 'plans'])->find($id);
        return $booking;
    }

    public function update(Request $request, $id){
        $booking = Booking::with(['user', 'plans'])->find($id);
        $booking->fill($request->all())->update();
        return $booking;
    }

    public function destroy($id){
        $booking = Booking::find($id);
        $booking->delete();
        return $booking;
    }
}
