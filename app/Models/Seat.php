<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = ['cinema_id', 'name', 'type', 'booking_id'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function cinema()
    {
        return $this->belongsTo(Cinema::class);
    }
}
