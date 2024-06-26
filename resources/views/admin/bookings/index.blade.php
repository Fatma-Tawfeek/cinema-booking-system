@extends('admin.layouts.master')

@section('title', 'Bookings')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Bookings</li>
@endSection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Bookings List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th style="width: 10px">#</th>
                            <th>User</th>
                            <th>Movie</th>
                            <th>Cinema</th>
                            <th>Showing time</th>
                            <th>Booking date</th>
                            <th>Total Price</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookings as $booking)
                            <tr>
                                <td>{{ $bookings->firstItem() + $loop->index }}</td>
                                <td>{{ $booking->user->full_name }}</td>
                                <td>{{ $booking->movie->title }}</td>
                                <td>{{ $booking->cinema->name }}</td> 
                                <td>{{ date('d M Y', strtotime($booking->date)) }} <br> {{ date('h:i A', strtotime($booking->timeslot->from)) }} - {{ date('h:i A', strtotime($booking->timeslot->to)) }}</td>   
                                <td>{{ date('d M Y', strtotime($booking->created_at)) }}</td>
                                <td>{{ $booking->grand_total }} USD</td>
                                <td> 
                                    <div class="btn-group">
                                        <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-primary mr-2">
                                        <i class="fas fa-eye"></i>
                                        show
                                        </a>
                                        <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">
                                              <i class="fas fa-trash"></i> 
                                              Cancel</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>      
                            @empty
                                <tr>
                                    <td colspan="10">No bookings found.</td>
                                </tr>                          
                            @endforelse                          
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                      {{ $bookings->links() }}
                    </div>
                  </div>
            </div>
        </div>
</section>

@endSection