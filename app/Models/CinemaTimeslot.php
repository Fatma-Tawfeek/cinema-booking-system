<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CinemaTimeslot extends Model
{
    use HasFactory;

    protected $fillable = ['cinema_id', 'day', 'from', 'to'];

    public function cinema()
    {
        return $this->belongsTo(Cinema::class);
    }
}
