@extends('admin.layouts.master')

@section('title', 'Booking Details')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Booking Details</li>
@endSection

@section('content')

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                  <i class="fas fa-video"></i> {{ config('app.name') }}.
                  <small class="float-right">Booking Date: {{ date('d-m-Y', strtotime($booking->created_at)) }}</small>
                </h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                From
                <address>
                  <strong>{{ config('app.name')  }}</strong><br>
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                To
                <address>
                  <strong>{{ $booking->user->full_name }}</strong><br>
                  Email: {{ $booking->user->email }}
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                <b>Invoice</b><br>
                <b>Booking ID:</b> {{ $booking->id }}<br>
                <b>Status:</b> {{ $booking->status }}<br>
                <b>Payment Due:</b> {{ $booking->paymentDetail ? date('d-m-Y', strtotime($booking->paymentDetail->date)) : '' }}<br>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                  <tr>
                    <th>Cinema</th>
                    <th>Movie</th>
                    <th>Showing time</th>
                    <th>Seats Codes</th>
                    <th>Num of Seats</th>
                    <th>Seat Price</th>
                    <th>Subtotal</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>{{ $booking->cinema->name }}</td>
                    <td>{{ $booking->movie->title }}</td>
                    <td>{{ date('d M Y', strtotime($booking->date)) }} <br> {{ date('h:i A', strtotime($booking->timeslot->from)) }} - {{ date('h:i A', strtotime($booking->timeslot->to)) }}</td>
                    <td>{{ $booking->seats_codes }}</td>
                    <td>{{ $booking->seats_count }}</td>
                    <td>{{ $booking->seat_price }}</td>
                    <td>{{ $booking->sub_total }}</td>
                  </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <!-- accepted payments column -->
              <div class="col-6">
                <p class="lead">Payment Methods:</p>
                <img src="../../dist/img/credit/visa.png" alt="Visa">
                <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
              </div>
              <!-- /.col -->
              <div class="col-6">
                <div class="table-responsive">
                  <table class="table">
                    <tr>
                      <th style="width:50%">Subtotal:</th>
                      <td>${{ $booking->sub_total }}</td>
                    </tr>
                    <tr>
                      <th>Tax (14%)</th>
                      <td>${{ $booking->sub_total * 0.14 }}</td>
                    </tr>
                    <tr>
                      <th>Total:</th>
                      <td>${{ $booking->grand_total }}</td>
                    </tr>
                  </table>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.invoice -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

  @endsection