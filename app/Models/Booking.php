<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'cinema_id', 'movie_id', 'cinema_timeslot_id', 'cinema_movies_schedule_id', 'date', 'from', 'to'];

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
        return $this->belongsTo(CinemaTimeslot::class);
    }

    public function schedule()
    {
        return $this->belongsTo(CinemaMoviesSchedule::class);
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}
