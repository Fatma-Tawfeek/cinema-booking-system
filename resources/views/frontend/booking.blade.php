@extends('frontend.layouts.master')

@section('title', 'Booking' . $movie->title)

@section('content')

<!--Popup-->

{{-- <div class="popup" id="popup-1">
    <div class="overlay"></div>
    <div class="popup-content">
      <div class="close-btn" onclick="togglePopup()">&times;</div>
      <h4>How many seats?</h4>
      @for ($i = 1; $i <= 6; $i++)
      <p class="seat">{{ $i }}</p>          
      @endfor
    <div class="select-seat">
    <a href="{{ route('bookings.seats') }}" class="schedule-link">
      <button class="seat-submit">Select Seats</button>
    </a>
  </div>  
    </div>
    
    <script>
    function togglePopup(){
      document.getElementById("popup-1").classList.toggle("active");
    }
  </script>
  </div> --}}

  <!--End Popup-->

<!-- Time Schedules-->
<div class="showtimes-section">
<h1 class="h1-schedule">{{ $movie->title }}</h1>

<div class="date-navigation">
    <div class="dates-container">
        @foreach ($showtimes as $date => $cinemas)
        <div class="date-card {{ $loop->first ? 'active' : '' }}" aria-hidden="false">
            <button class="date-button" tabindex="0">
                <div class="day-name">{{ date('D', strtotime($date)) }}</div>
                <div class="day-number">{{ date('d', strtotime($date)) }}</div>
            </button>
        </div>
        @endforeach
        
    </div>
</div>

@foreach ($showtimes as $date => $cinemas)
    
<div class="showtimes-container {{ $loop->first ? 'active' : '' }}" aria-hidden="false">
    @foreach ($cinemas as $cinemaName => $schedules)

    <div class="cinema-container">
        <div class="venue-container">
            <div class="venue-1">
                <div class="venue-name">
                    <p>{{ $cinemaName }} </p>
                </div>
            </div>
        </div>
        <div class="dates-container">
                <div class="showtime-content">
                    @foreach ($schedules as $schedule)
                    <button onclick="togglePopup()" class="showtime" data-schedule-id="{{ $schedule->id }}">{{ date('h:i A', strtotime($schedule->timeslot->from)) }}</button>
                    @endforeach
                </div>
        </div>
    </div>
   
    @endforeach
</div>
@endforeach
</div>
    
@endSection

@push('styles')
<style>
    body {
        width: 100%;
        height: 100hv;
        margin: 0;
        padding: 0;
    }

    .dates-container .date-card {
        cursor: pointer;
        padding: 0;
    }

    .dates-container .date-card:first-child {
        background-color: unset;
    }

    .dates-container .date-card.active {
        background-color: red;
    }

    .dates-container .date-button {
        cursor: pointer;
        width: 100%;
        height: 100%;
        padding: 0.5rem;
    }

    .showtimes-container {
        display: none;
    }

    .cinema-container {
        display: flex;
        margin-bottom: 2rem;
    }

    .showtimes-container.active {
        display: block;
        /* flex-direction: column; */
    }
    .selected {
        border-radius: 50%;
        background-color: var(--white);
        color: var(--red);
    }
    .selected {
    color: red;
    background-color: white;
    }
    .showtime-content {
        width: 100%;
    }

</style>
@endpush

@push('scripts')
  <script src="{{ asset('frontend/schedule.js') }}"></script>  
  <script src="{{ asset('frontend/seat.js') }}"></script>
  <script>
   function togglePopup() {
        document.getElementById("popup-1").classList.toggle("active");
    }

    document.querySelectorAll('.seat').forEach(item => {
        item.addEventListener('click', event => {
            // Remove 'selected' class from all seats
            document.querySelectorAll('.seat').forEach(seat => {
                seat.classList.remove('selected');
            });

            // Add 'selected' class to the clicked seat
            event.target.classList.add('selected');
        });
    });

    document.querySelectorAll('.showtime').forEach(button => {
        button.addEventListener('click', event => {
            const scheduleId = button.getAttribute('data-schedule-id');
            window.location.href = "{{ route('bookings.seats') }}" + "?schedule_id=" + scheduleId;
            togglePopup();
        });
    });

  </script>
@endpush