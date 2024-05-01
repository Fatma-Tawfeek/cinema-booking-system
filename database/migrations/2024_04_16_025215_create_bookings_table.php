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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('movie_id')->constrained();
            $table->foreignId('cinema_id')->constrained();
            $table->foreignId('cinema_timeslot_id')->constrained();
            $table->foreignId('cinema_movies_schedule_id')->constrained();
            $table->date('date');
            $table->time('from');
            $table->time('to');
            $table->string('seats_codes');
            $table->decimal('sub_total', 8, 2);
            $table->decimal('seat_price', 8, 2);
            $table->integer('seats_count');
            $table->decimal('grand_total', 8, 2);
            $table->enum('status', ['paid', 'failed'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
