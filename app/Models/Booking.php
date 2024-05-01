<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'cinema_id', 'movie_id', 'cinema_timeslot_id', 'cinema_movies_schedule_id', 'date', 'from', 'to', 'seats_codes', 'sub_total', 'grand_total', 'status', 'seat_price', 'seats_count'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function timeslot()
    {
        return $this->belongsTo(CinemaTimeslot::class, 'cinema_timeslot_id');
    }

    public function schedule()
    {
        return $this->belongsTo(CinemaMoviesSchedule::class, 'cinema_movies_schedule_id');
    }

    public function cinema()
    {
        return $this->belongsTo(Cinema::class);
    }

    public function seats()
    {
        return $this->belongsToMany(Seat::class);
    }

    public function paymentDetail()
    {
        return $this->hasOne(PaymentDetail::class);
    }
}
