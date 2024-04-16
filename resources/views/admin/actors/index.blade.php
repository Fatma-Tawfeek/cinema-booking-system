@extends('admin.layouts.master')

@section('title', 'Actors')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Actors</li>
@endSection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Success!</h5>
                        {{ session('success') }}
                    </div>                    
                @endif
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Actors List</h3>
                      <div class="float-right">
                        <a href="{{ route('admin.actors.create') }}" class="btn btn-primary">Add Actor</a>
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
                            <th>Nationality</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($actors as $actor)
                            <tr>
                                <td>{{ $actors->firstItem() + $loop->index }}</td>
                                <td>
                                    <img src="{{ asset(  'storage/' . $actor->profile_img) }}" alt="" style="width: 50px;height: 50px; border-radius: 50%">
                                </td>
                                <td>{{ $actor->name }}</td>
                                <td>{{ $actor->nationality }}</td>
                                <td> 
                                    <div class="btn-group">
                                        <a href="{{ route('admin.actors.edit', $actor->id) }}" class="btn btn-primary mr-2">
                                          <i class="fas fa-edit"></i>                                          
                                          Edit</a>
                                        <form action="{{ route('admin.actors.destroy', $actor->id) }}" method="post">
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
                                    <td colspan="6">No actors found.</td>
                                </tr>                          
                            @endforelse                          
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                      {{-- <ul class="pagination pagination-sm m-0 float-right">
                        <li class="page-item"><a class="page-link" href="#">«</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">»</a></li>
                      </ul> --}}
                      {{ $actors->links() }}
                    </div>
                  </div>
            </div>
        </div>
</section>

@endSection