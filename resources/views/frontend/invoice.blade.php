@extends('frontend.layouts.master')

@section('title', 'Invoice')

@section('content')

<div class="payment-container">
    @if($paymentDetail->status == 'paid')
        <div class="success-message">
            <div class="success-icon">
                <i class="fas fa-credit-card fa-2x"></i>
            </div>
            <p>Payment Successful</p>
        </div>
    @else
    <div class="error-message">
        <div class="error-icon">
            <i class="fas fa-times fa-2x"></i>
        </div>
        <p>Payment Failed</p>
    </div> 
    @endif

    <h2>Payment Details</h2>
    <table>
        <tr>
            <th>Payment ID</th>
            <td>#{{ $paymentDetail->id }}</td>
        </tr>
        <tr>
            <th>Payment Method</th>
            <td>{{ $paymentDetail->payment_method }}</td>
        </tr>
        <tr>
            <th>Amount (USD)</th>
            <td>${{ $paymentDetail->amount }}</td>
        </tr>
        <tr>
            <th>Date</th>
            <td>{{ $paymentDetail->date }}</td>
        </tr>
    </table>
    @if ($paymentDetail->status == 'paid')
    <button onclick="window.location.href='{{ route('home') }}'">Go to Home Page</button>
    @else
    <button onclick="window.location.href='{{ route('bookings.checkout', $paymentDetail->booking_id) }}'">Try To Pay Again</button>
    @endif
</div>

@endSection


@push('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    .success-message {
        background-color: #4CAF50;
        color: #fff;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .success-icon {
        background-color: #4CAF50;
        border-radius: 50%;
        margin-bottom: 10px;
    }
    .error-message {
        background-color: #f44336;
        color: #fff;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .error-icon {
        background-color: #f44336;
        border-radius: 50%;
        margin-bottom: 10px;
    }
    table {
        width: 100%;
        margin-bottom: 20px;
        border-collapse: collapse;
    }
    th, td {
        padding: 10px;
        border-bottom: 1px solid #555;
    }
    th {
        text-align: left;
    }
    button {
        padding: 10px 20px;
        background-color: #d60808;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        display: block;
        margin: 0 auto;
    }
</style>
    
@endpush