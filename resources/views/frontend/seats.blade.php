@extends('frontend.layouts.master')

@section('title', 'Seats')

@section('content')

<div class="seat-main">
    <h1 class="h1-seat">{{ $movie->title }}</h1>
  
      <div class="seat-container">
        <h3 class="h3-seat">CINEMA SEAT PLAN</h3>
        <div class="screen"></div>
        <input type="hidden" name="schedule_id" value="{{ $schedule->id }}" id="schedule_id"> 

        @for ($row = 0; $row < $cinema->rows_number; $row++)
          <div class="row">
              @for ($col = 0; $col < $cinema->seat_number; $col++)
                  @php
                      $seat_first_id = $cinema->seats()->first()->id;
                      $seatCode = chr(65 + $row) . ($col + 1); // Convert row number to letter if seat is not found
                  @endphp
                  <i class="fa-solid fa-couch {{ in_array($seat_first_id + $row * $cinema->seat_number + $col, $seats) ? 'occupied' : '' }}" 
                    data-seat-id="{{ $seat_first_id + $row * $cinema->seat_number + $col }}" 
                    data-seat-code="{{ $seatCode }}"
                    ></i>
              @endfor
          </div>
      @endfor

      </div>
  
      <ul class="showcase">
      
        <li>
          <i class="fa-solid fa-couch"></i>
          <small>Available</small>
        </li>
        <li>
          <i class="fa-solid fa-couch"></i>
          <small>Selected</small>
        </li>
        <li>
          <i class="fa-solid fa-couch"></i>
          <small>Occupied</small>
        </li>
      </ul>
      <button class="btn-seat" id="totalButton">$<span id="total">0</span></button>
  </div>

@endsection

@push('styles')

<style>
    body{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
    width: 100%;
    margin-top: 10%;
    margin-left: 20%;
    max-width: 60%;
    border-radius: 8px;
    padding: 20px;
  }
  </style>
    
@endpush

@push('scripts')

<script>
    const ticketPrice = {{ $schedule->ticket_price }};
    const container = document.querySelector(".seat-container");
    const couches = document.querySelectorAll(
        ".row i.fa-solid.fa-couch:not(.occupied)"
    );
    let total = document.getElementById("total");
    let totalButton = document.getElementById("totalButton"); // Button element
    let scheduleId = document.getElementById("schedule_id").value;

    function updateCountAndTotal() {
        let selectedCouchesCount = document.querySelectorAll(
            ".row i.fa-solid.fa-couch.selected"
        );
        let totalPrice = selectedCouchesCount.length * ticketPrice;
        total.innerText = totalPrice + " USD";

        // Enable/disable button based on total price
        if (totalPrice > 0) {
            totalButton.disabled = false;
        } else {
            totalButton.disabled = true;
        }

        const couchIndexArray = Array.from(selectedCouchesCount).map((couch) => {
            // return [...couches].indexOf(couch);
            return couch.dataset.seatId;
        });
        localStorage.setItem("couchIndex", JSON.stringify(couchIndexArray));
        localStorage.setItem("totalPrice", totalPrice);
    }

    function storeSeatCodes() {
        let seatCodes = [];
        document
            .querySelectorAll(".row i.fa-solid.fa-couch.selected")
            .forEach((couch) => {
                seatCodes.push(couch.dataset.seatCode);
            });
        localStorage.setItem("seatCodes", JSON.stringify(seatCodes));
    }

    container.addEventListener("click", (e) => {
        if (
            e.target.classList.contains("fa-solid") &&
            e.target.classList.contains("fa-couch") &&
            !e.target.classList.contains("occupied")
        ) {
            e.target.classList.toggle("selected");
            updateCountAndTotal();
        }
    });

    totalButton.addEventListener("click", () => {
        storeSeatCodes();
        const selectedSeatIds = JSON.parse(localStorage.getItem("couchIndex"));
        const seatCodes = JSON.parse(localStorage.getItem("seatCodes"));
        const totalPrice = localStorage.getItem("totalPrice");

        const seatIdsParam = "seatIds=" + selectedSeatIds.join(",");
        const seatCodesParam = "seatCodes=" + seatCodes.join(",");
        const totalPriceParam = "totalPrice=" + totalPrice;
        const scheduleIdParam = "schedule_id=" + scheduleId;

        const eticketUrl = "{{ route('bookings.eticket') }}" + "?" + seatIdsParam + "&" + seatCodesParam + "&" + totalPriceParam + "&" + scheduleIdParam;

        // Redirect to the eticketUrl
        window.location.href = eticketUrl;
    });

    updateCountAndTotal();
</script>

{{-- <script src="{{ asset('frontend/seat.js') }}"></script> --}}
<script src="https://kit.fontawesome.com/7706a54d6c.js" crossorigin="anonymous"></script>
    
@endpush
