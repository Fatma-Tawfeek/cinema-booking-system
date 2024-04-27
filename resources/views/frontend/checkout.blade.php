@extends('frontend.layouts.master')

@section('title', 'Checkout')

@section('content')

<div class="payment-container">
    <h1>Payment Form</h1>
    <form id="paymentForm" action="{{ route('bookings.book', ['schedule_id' => $schedule->id, 'totalPrice' => $total_price, 'seatIds' => $seats_ids]) }}" method="post">
        @csrf
        <label class="label-payment" for="cardNumber">Card Number</label>
        <input type="text" class="input-pay" id="cardNumber" name="cardNumber" placeholder="Enter card number" required>

        <label class="label-payment" for="cardHolder">Card Holder Name</label>
        <input type="text" class="input-pay" id="cardHolder" name="cardHolder" placeholder="Enter card holder name" required>

        <div class="expiry-cvv">
            <div class="expiry">
                <label class="label-payment" for="expiryDate">Expiry Date</label>
                <input type="text" class="input-pay" id="expiryDate" name="expiryDate" placeholder="MM/YY" required>
            </div>
            <div class="cvv">
                <label class="label-payment" for="cvv">CVV</label>
                <input type="number" class="input-pay" id="cvv" name="cvv" placeholder="Enter CVV" required>
            </div>
        </div>

        <input type="submit" class="input-pay" value="PAY NOW">
    </form>
</div>

@endSection

@push('styles')
<style>
    body {
    margin: 0;
    padding: 0;
  }
</style>
@endpush