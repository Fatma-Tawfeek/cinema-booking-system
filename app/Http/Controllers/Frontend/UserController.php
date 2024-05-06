<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function getUserBookings()
    {
        $user = auth()->user();
        $bookings = Booking::with('movie', 'cinema')->where('user_id', $user->id)->paginate(10);
        return view('frontend.bookings.index', compact('bookings'));
    }

    public function getBooking(Booking $booking)
    {
        return view('frontend.bookings.show', compact('booking'));
    }
}
