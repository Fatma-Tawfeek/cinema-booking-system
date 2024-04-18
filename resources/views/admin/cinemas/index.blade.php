@extends('admin.layouts.master')

@section('title', 'Cinemas')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Cinemas</li>
@endSection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Cinemas List</h3>
                      <div class="float-right">
                        <a href="{{ route('admin.cinemas.create') }}" class="btn btn-primary">Add Cinema</a>
                    </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th style="width: 10px">#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Number of Seats</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($cinemas as $cinema)
                            <tr>
                                <td>{{ $cinemas->firstItem() + $loop->index }}</td>
                                <td>
                                    <img src="{{ asset(  'storage/' . $cinema->logo_img) }}" alt="" style="width: 50px;height: 50px; border-radius: 50%">
                                </td>
                                <td>{{ $cinema->name }}</td>
                                <td>{{ $cinema->seats()->count() }}</td>
                                <td> 
                                    <div class="btn-group">
                                        <a href="{{ route('admin.cinemas.edit', $cinema->id) }}" class="btn btn-primary mr-2">
                                          <i class="fas fa-edit"></i>                                          
                                          Edit</a>
                                        <form action="{{ route('admin.cinemas.destroy', $cinema->id) }}" method="post">
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
                                    <td colspan="5">No cinemas found.</td>
                                </tr>                          
                            @endforelse                          
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                      {{ $cinemas->links() }}
                    </div>
                  </div>
            </div>
        </div>
</section>

@endSection