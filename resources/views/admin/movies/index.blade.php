@extends('admin.layouts.master')

@section('title', 'Movies')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Movies</li>
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
                      <h3 class="card-title">Movies List</h3>
                      <div class="float-right">
                        <a href="{{ route('admin.movies.create') }}" class="btn btn-primary">Add Movie</a>
                    </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th style="width: 10px">#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>description</th>
                            <th>Categories</th>
                            <th>Duration</th>
                            <th>Release Date</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($movies as $movie)
                            <tr>
                                <td>{{ $movies->firstItem() + $loop->index }}</td>
                                <td>
                                    <img src="{{ asset(  'storage/' . $movie->poster_img) }}" alt="" style="width: 50px;height: 50px; border-radius: 50%">
                                </td>
                                <td>{{ $movie->title }}</td>
                                <td>{{ Str::limit($movie->description, 100) }}</td>
                                <th style="width: 200px">
                                  @foreach ($movie->categories as $cat)
                                      <span class="badge badge-primary">{{ $cat->name }}</span>
                                  @endforeach
                                </th>
                                <td>{{ $movie->duration }} Mins</td>
                                <td>{{ date('d M Y', strtotime($movie->release_date)) }}</td>
                                <td>
                                  @if ($movie->status == 'showing_now')
                                    <span class="badge badge-success">Showing Now</span>
                                  @else
                                    <span class="badge badge-warning">Up Coming</span>
                                  @endif
                                </td>
                                <td> 
                                    <div class="btn-group">
                                        <a href="{{ route('admin.movies.edit', $movie->id) }}" class="btn btn-primary mr-2">
                                          <i class="fas fa-edit"></i>                                          
                                          Edit</a>
                                        <form action="{{ route('admin.movies.destroy', $movie->id) }}" method="post">
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
                                    <td colspan="9">No movies found.</td>
                                </tr>                          
                            @endforelse                          
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                      {{ $movies->links() }}
                    </div>
                  </div>
            </div>
        </div>
</section>

@endSection