<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cinema_movies_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cinema_id')->constrained();
            $table->foreignId('movie_id')->constrained();
            $table->foreignId('cinema_timeslot_id')->constrained();
            $table->date('date');
            $table->decimal('ticket_price', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cinema_movies_schedules');
    }
};
