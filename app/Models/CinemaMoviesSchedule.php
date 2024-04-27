<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CinemaMoviesSchedule extends Model
{
    use HasFactory;

    protected $fillable = ['cinema_id', 'movie_id', 'date', 'cinema_timeslot_id', 'ticket_price'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function timeslot()
    {
        return $this->belongsTo(CinemaTimeslot::class, 'cinema_timeslot_id');
    }

    public function cinema()
    {
        return $this->belongsTo(Cinema::class, 'cinema_id');
    }
}
