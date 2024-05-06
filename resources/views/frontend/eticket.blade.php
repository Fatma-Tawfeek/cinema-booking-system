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
            <p>VAT. (14%)</p>
            <p>Sub total</p>
          </div>
          <div>
            <p>{{ $total_price }} USD</p>
            <p>{{ $total_price * 0.14 }} USD</p>
            <p>{{ $total_price + ($total_price * 0.14) }} USD</p>
          </div>
        </div>
        
        
      </div>
      <div class="text-ticket">
          <div class="ticket-header">
            <p>By Proceeding, I express my consent to complete this transaction</p>
          </div>
          <form action="{{ route('bookings.book', ['schedule_id' => $schedule->id, 'totalPrice' => $total_price , 'seatIds' => $seats_ids, 'seatsCodes' => $seats_codes]) }}" method="post">
            @csrf
            <button class="book-ticket" type="submit">Proceed</button>
          </form>
        </div>
      </div>
      
    </section>
  </div>

@endsection