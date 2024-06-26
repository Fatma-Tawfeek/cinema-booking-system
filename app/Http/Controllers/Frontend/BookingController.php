<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Movie;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\PaymentDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\CinemaMoviesSchedule;
use Illuminate\Support\Facades\Http;

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

    public function book(Request $request)
    {
        $schedule = CinemaMoviesSchedule::where('id', $request->schedule_id)->with('cinema')->first();
        $cinema = $schedule->cinema()->first();
        $movie = $schedule->movie()->first();
        $timeslot = $schedule->timeslot()->first();
        $total_price = $request->totalPrice;
        $seats_codes = $request->seatsCodes;
        $seats_ids = explode(',', $request->seatIds);

        $booking = Booking::create([
            'movie_id' => $movie->id,
            'cinema_id' => $cinema->id,
            'cinema_movies_schedule_id' => $schedule->id,
            'cinema_timeslot_id' => $timeslot->id,
            'seats_codes' => $seats_codes,
            'seats_count' => count($seats_ids),
            'seat_price' => $schedule->ticket_price,
            'sub_total' => $total_price,
            'grand_total' => $total_price + ($total_price * 0.14),
            'date' => $schedule->date,
            'from' => $timeslot->from,
            'to' => $timeslot->to,
            'user_id' => auth()->user()->id,
            'status' => 'failed',

        ]);

        foreach ($seats_ids as $seat_id) {
            DB::table('booking_seat')->insert([
                'booking_id' => $booking->id,
                'seat_id' => $seat_id
            ]);
        }

        return view('frontend.checkout', compact('booking'));
    }

    public function getCheckout(Booking $booking)
    {
        return view('frontend.checkout', compact('booking'));
    }

    public function paymentProcess(Request $request, Booking $booking)
    {
        $amount = $booking->grand_total;
        $token = $request->input('cardToken');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer sk_sbox_5ixyeaoiuixwtfex2asngnyfpev',
        ])
            ->post('https://api.sandbox.checkout.com/payments', [
                'source' => [
                    'type' => 'token',
                    'token' => $token,
                ],
                'amount' => $amount * 100, // Convert amount to cents
                'currency' => 'USD',
                'processing_channel_id' => 'pc_rlwcnkgu4pzujf6qmk7iyasbee',
            ]);

        $data = $response->json();
        $status = $data['approved'];
        if ($status) {
            $paymentDetail = PaymentDetail::where('booking_id', $booking->id)->first();

            if ($paymentDetail) {
                $paymentDetail->update(['status' => 'paid']);
                $booking->update(['status' => 'paid']);
                return response()->json($data);
            } else {
                $paymentDetail = PaymentDetail::create([
                    'booking_id' => $booking->id,
                    'user_id' => auth()->user()->id,
                    'amount' => $amount,
                    'payment_id' => $data['id'],
                    'payment_method' => 'card',
                    'status' => 'paid',
                    'date' => Carbon::now(),
                ]);
                $booking->update(['status' => 'paid']);
                session(['paymentDetailId' => $paymentDetail->id]);
                return response()->json(['paymentDetailId' => $paymentDetail->id, 'data' => $data]);
            }
        } else {
            $paymentDetail = PaymentDetail::create([
                'booking_id' => $booking->id,
                'user_id' => auth()->user()->id,
                'amount' => $amount,
                'payment_id' => $data['id'],
                'payment_method' => 'card',
                'status' => 'failed',
                'date' => Carbon::now(),
            ]);
            $booking->update(['status' => 'failed']);
            session(['paymentDetailId' => $paymentDetail->id]);
            return response()->json(['paymentDetailId' => $paymentDetail->id, 'data' => $data], 500);
        }
    }

    public function getConfirm()
    {
        $paymentDetailId = session('paymentDetailId');
        $paymentDetail = PaymentDetail::find($paymentDetailId);
        return view('frontend.invoice', compact('paymentDetail'));
    }
}
