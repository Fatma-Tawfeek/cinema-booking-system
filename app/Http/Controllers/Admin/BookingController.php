<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with('user', 'movie', 'timeslot', 'schedule', 'schedule.cinema')->paginate(15);
        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->seats()->detach();
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Booking cancelled successfully');
    }
}
