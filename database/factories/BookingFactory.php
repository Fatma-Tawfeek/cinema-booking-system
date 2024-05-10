<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'movie_id' => 1, // Replace with appropriate movie ID
            'cinema_movies_schedule_id' => 1, // Replace with appropriate schedule ID
            'cinema_id' => 1, // Replace with appropriate cinema ID
            'cinema_timeslot_id' => 1, // Replace with appropriate timeslot ID
            'seats_codes' => 'A1,A2,A3',
            'sub_total' => 100,
            'grand_total' => 100,
            'seats_count' => 3,
            'seat_price' => 100,
            'date' => Carbon::now()->format('Y-m-d'),
            'from' => Carbon::now()->format('H:i'),
            'to' => Carbon::now()->format('H:i'),
            'status' => 'failed',
        ];
    }
}
