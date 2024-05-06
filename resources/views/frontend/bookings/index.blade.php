@extends('frontend.layouts.master')

@section('title', 'Bookings')

@section('content')

    <section class="content">
        <h1>My Bookings</h1>
        <div class="container">
            <table>
                <thead>
                    <tr>
                        <th>Cinema Name</th>
                        <th>Movie Name</th>
                        <th>Show Time</th>
                        <th>Booking Date</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                        @forelse ($bookings as $booking)
                        <tr>
                        <td>{{ $booking->cinema->name }}</td>
                        <td>{{ $booking->movie->title }}</td>
                        <td>{{ date('d M Y', strtotime($booking->date)) }} <br> {{ date('h:i A', strtotime($booking->from)) }} - {{ date('h:i A', strtotime($booking->to)) }}</td>
                        <td>{{ date('d M Y', strtotime($booking->created_at)) }}</td>
                        <td>${{ $booking->grand_total }}</td>  
                        <td><span class="status-badge {{ $booking->status == 'paid' ? 'paid' : 'failed' }}">{{ $booking->status }}</span></td>
                        <td><a href="{{ route('bookings.show', $booking->id) }}" class="view-btn"><i class="fas fa-eye"></i></a></td>
                        </tr>
                        @empty
                        <td colspan="6">No bookings found.</td>                            
                        @endforelse
                        <!-- Add more rows for each booking -->
                </tbody>
            </table>
        </div>
        <div class="pagination-container">
            {{ $bookings->links() }}
        </div>
    </section>
    <!-- /.content -->
@endSection

@push('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    .content {
        padding-top: 8%;
    }
    .container {
            width: 80%;
            margin: 20px auto;
            background-color: #222;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #fff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #444;
    }
    th {
        background-color: #333;
        font-weight: bold;
    }
    tr:hover {
        background-color: #444;
    }
    .view-btn {
            background-color: #d60808;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .pagination-container {
    margin-top: 20px;
    text-align: center;
}

.pagination {
    display: inline-block;
}

.pagination li {
    display: inline;
    padding: 0 5px;
}

.pagination li a,
.pagination li span {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 3px;
    color: #333;
    text-decoration: none;
}

.pagination li.active a {
    background-color: #007bff;
    color: #fff;
}

.pagination li.disabled span {
    background-color: #eee;
    color: #666;
}

.status-badge {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 5px;
    font-weight: bold;
}

.paid {
    background-color: green;
    color: white;
}

.failed {
    background-color: red;
    color: white;
}


</style>
@endpush
