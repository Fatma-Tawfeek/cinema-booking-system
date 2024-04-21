@extends('admin.layouts.master')

@section('title', 'Cinemas Movie Schedules')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Cinemas Movie Schedules</li>
@endSection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Cinemas Movie Schedules List</h3>
                      <div class="float-right">
                        <a href="{{ route('admin.schedules.create') }}" class="btn btn-primary">Add schedule</a>
                    </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th style="width: 10px">#</th>
                            <th>Movie</th>
                            <th>Cinema</th>
                            <th>Showing Date</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Price</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($schedules as $schedule)
                            <tr>
                                <td>{{ $schedules->firstItem() + $loop->index }}</td>
                                <td>{{ $schedule->movie->title }}</td>
                                <td>{{ $schedule->cinema->name }}</td> 
                                <td>{{ date('d M Y', strtotime($schedule->date)) }}</td>   
                                <td>{{ date('h:i A', strtotime($schedule->timeslot->from)) }}</td>
                                <td>{{ date('h:i A', strtotime($schedule->timeslot->to)) }}</td>
                                <td>{{ $schedule->ticket_price }} leke</td>
                                <td> 
                                    <div class="btn-group">
                                        <a href="{{ route('admin.schedules.edit', $schedule->id) }}" class="btn btn-primary mr-2">
                                          <i class="fas fa-edit"></i>                                          
                                          Edit</a>
                                        <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">
                                              <i class="fas fa-trash"></i> 
                                              Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>      
                            @empty
                                <tr>
                                    <td colspan="8">No schedules found.</td>
                                </tr>                          
                            @endforelse                          
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                      {{ $schedules->links() }}
                    </div>
                  </div>
            </div>
        </div>
</section>

@endSection