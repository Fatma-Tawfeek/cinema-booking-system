@extends('admin.layouts.master')

@section('title', 'Cinemas Timslots')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Cinemas Timslots</li>
@endSection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Cinemas Timslots List</h3>
                      <div class="float-right">
                        <a href="{{ route('admin.timeslots.create') }}" class="btn btn-primary">Add Timeslot</a>
                    </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th style="width: 10px">#</th>
                            <th>Cinema</th>
                            <th>Day</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($timeslots as $timeslot)
                            <tr>
                                <td>{{ $timeslots->firstItem() + $loop->index }}</td>
                                <td>{{ $timeslot->cinema->name }}</td>
                                <td>{{ ucfirst($timeslot->day) }}</td> 
                                <td>{{ date('h:i A', strtotime($timeslot->from)) }}</td>   
                                <td>{{ date('h:i A', strtotime($timeslot->to)) }}</td>
                                <td> 
                                    <div class="btn-group">
                                        <a href="{{ route('admin.timeslots.edit', $timeslot->id) }}" class="btn btn-primary mr-2">
                                          <i class="fas fa-edit"></i>                                          
                                          Edit</a>
                                        <form action="{{ route('admin.timeslots.destroy', $timeslot->id) }}" method="post">
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
                                    <td colspan="6">No timeslots found.</td>
                                </tr>                          
                            @endforelse                          
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                      {{ $timeslots->links() }}
                    </div>
                  </div>
            </div>
        </div>
</section>

@endSection