@extends('frontend.layouts.master')

@section('title', 'eticket for ' . $movie->title)

@section('content')

  <!-- Movie Info Section -->
  <div class="ticket">
    <section class="ticket-info">
      <div class="ticket-image">
        <img src="{{ asset('storage/' . $movie->poster_img) }}" alt="">
      </div>
      <div class="ticket-box">
      <div class="ticket-content">
        <h1>Booking Summary</h1>
        <div class="ticket-columns">
          <div>
            <p>{{ $seats_codes }}</p>
            <p>Convenience fees</p>
            <p>Sub total</p>
          </div>
          <div>
            <p>{{ $total_price }} leke</p>
            <p>40 leke</p>
            <p>{{ $total_price + 40 }} leke</p>
          </div>
        </div>
        
        
      </div>
      <div class="text-ticket">
          <div class="ticket-header">
            <p>By Proceeding, I express my consent to complete this transaction</p>
          </div>
          <a href="{{ route('bookings.checkout') }}?schedule_id={{ $schedule->id }}&totalPrice={{ $total_price + 40 }}&seatIds={{ $seats_ids }}" class="book-ticket">Proceed</a>
        </div>
      </div>
      
    </section>
  </div>

@endsection