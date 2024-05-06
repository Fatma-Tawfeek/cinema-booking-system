@extends('frontend.layouts.master')
@section('title', 'Booking Details')

@section('content')

<section class="content">
    <div class="container">
        <div class="invoice-header">
            <h1>Booking Invoice</h1>
        </div>

        <div class="invoice-content">
            <div class="invoice-details">
                <h2>Invoice Details</h2>
                <p><strong>Name:</strong>  {{ $booking->cinema->name }}</p>
                <p><strong>Movie:</strong> {{ $booking->movie->title }}</p>
                <p><strong>Show Time:</strong> {{ date('d M Y', strtotime($booking->date)) }}, {{ date('h:i A', strtotime($booking->from)) }} - {{ date('h:i A', strtotime($booking->to)) }}</p>
                <p><strong>Booking Date:</strong> {{ date('d M Y', strtotime($booking->created_at)) }}</p>
                <p><strong>Total Price:</strong> ${{ $booking->grand_total }}</p>
                <p><strong>Status:</strong> <span class="status-badge {{ $booking->status == 'paid' ? 'paid' : 'failed' }}">{{ $booking->status }}</span></p>
            </div>

            <div class="invoice-seats">
                <h2>Seats Information</h2>
                <p><strong>Number of Seats:</strong> {{ count($booking->seats) }}</p>
                <p><strong>Seat Codes:</strong> {{ $booking->seats_codes }}</p>
                <p><strong>Seat Price:</strong> ${{ $booking->seat_price }}</p>
            </div>
        </div>

        <div class="invoice-total">
            <p><strong>Subtotal:</strong> ${{ $booking->sub_total }}</p>
            <p><strong>VAT (14%)</strong> ${{ $booking->sub_total * 0.14 }}</p>
            <h3>Total Price: ${{ $booking->grand_total }}</h3>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #000;
        color: #fff;
    }
    .container {
        width: 50%;
        margin: 20px auto;
        background-color: #222;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
        display: flex;
        flex-direction: column;
    }
    .invoice-header {
        text-align: center;
        margin-bottom: 20px;
    }
    .invoice-content {
        display: flex;
        justify-content: space-between;
    }
    .invoice-details,
    .invoice-seats {
        flex: 1;
    }
    .invoice-details h2,
    .invoice-seats h2 {
        margin-bottom: 10px;
    }
    .invoice-details p,
    .invoice-seats p {
        margin: 5px 0;
    }
    .invoice-seats {
        margin-left: 20px;
    }
    .invoice-seats .seat-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
    }
    .invoice-total {
        text-align: center;
    }
</style>
@endpush
