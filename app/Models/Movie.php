<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image', 'duration', 'release_date', 'status'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }
}
