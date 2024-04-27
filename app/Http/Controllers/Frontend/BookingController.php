<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Movie;
use App\Models\Cinema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\CinemaMoviesSchedule;

class BookingController extends Controller
{
    public function getTimeslots(Movie $movie)
    {
        $showtimes = [];

        // Get unique dates the movie is displayed
        $dates = $movie->schedules()->pluck('date')->unique();

        foreach ($dates as $date) {
            $cinemas = $movie->schedules()
                ->where('date', $date)
                ->with('cinema', 'timeslot')
                ->get()
                ->groupBy('cinema.name');

            $showtimes[$date] = $cinemas;
        }

        return view('frontend.booking', compact('movie', 'showtimes'));
    }

    public function getSeats(Request $request)
    {
        $schedule = CinemaMoviesSchedule::where('id', $request->schedule_id)->with('cinema')->first();
        $cinema = $schedule->cinema()->first();
        $movie = $schedule->movie()->first();
        $bookings = Booking::where('cinema_movies_schedule_id', $request->schedule_id)->get();

        $seats = [];
        foreach ($bookings as $booking) {
            $seats[] = $booking->seats()->get()->pluck('id')->toArray();
        }
        $seats = array_merge(...$seats);

        return view('frontend.seats', compact('cinema', 'movie', 'schedule', 'seats'));
    }

    public function getEticket(Request $request)
    {
        $schedule = CinemaMoviesSchedule::where('id', $request->schedule_id)->with('cinema')->first();
        $movie = $schedule->movie()->first();
        $seats_codes = $request->get('seatCodes');
        $total_price = $request->get('totalPrice');
        $seats_ids = $request->get('seatIds');
        return view('frontend.eticket', compact('movie', 'seats_codes', 'total_price', 'schedule', 'seats_ids'));
    }

    public function getCheckout(Request $request)
    {
        $schedule = CinemaMoviesSchedule::where('id', $request->schedule_id)->with('cinema')->first();
        $seats_ids = $request->get('seatIds');
        $total_price = $request->get('totalPrice');
        return view('frontend.checkout', compact('seats_ids', 'total_price', 'schedule'));
    }

    public function postCheckout(Request $request)
    {
        $schedule = CinemaMoviesSchedule::where('id', $request->schedule_id)->with('cinema')->first();
        $cinema = $schedule->cinema()->first();
        $movie = $schedule->movie()->first();
        $timeslot = $schedule->timeslot()->first();
        $total_price = $request->totalPrice;
        $seats_ids = explode(',', $request->seatIds);

        $booking = Booking::create([
            'movie_id' => $movie->id,
            'cinema_id' => $cinema->id,
            'cinema_movies_schedule_id' => $schedule->id,
            'cinema_timeslot_id' => $timeslot->id,
            'total_price' => $total_price,
            'date' => $schedule->date,
            'from' => $timeslot->from,
            'to' => $timeslot->to,
            'user_id' => auth()->user()->id,

        ]);

        foreach ($seats_ids as $seat_id) {
            DB::table('booking_seat')->insert([
                'booking_id' => $booking->id,
                'seat_id' => $seat_id
            ]);
        }

        return redirect()->route('home');
    }
}
