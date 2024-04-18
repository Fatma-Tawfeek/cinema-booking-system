@extends('admin.layouts.master')

@section('title', 'Add Movie')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Movies</li>
<li class="breadcrumb-item active">Add Movie</li>
@endSection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add Movie</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.movies.store') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label>Title</label>
                      <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Enter title" value="{{ old('title') }}">
                      @error('title')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="">Categories</label> <br>
                      <select class="js-example-basic-multiple form-control @error('category_id') is-invalid @enderror" name="category_id[]" multiple="multiple">
                        @foreach ($categories as $category)
                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                      </select>
                      @error('category_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Enter description">{{ old('description') }}</textarea>
                      @error('description')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label>Duration</label>
                      <input type="number" class="form-control @error('duration') is-invalid @enderror" name="duration" placeholder="Enter duration in minutes" value="{{ old('duration') }}">
                      @error('duration')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label>Release Date</label>
                      <input type="date" class="form-control @error('release_date') is-invalid @enderror" name="release_date" placeholder="Enter Release Date" value="{{ old('release_date') }}">
                      @error('release_date')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="">Actors</label> <br>
                      <select class="js-example-basic-multiple form-control @error('actor_id') is-invalid @enderror" name="actor_id[]" multiple="multiple">
                        @foreach ($actors as $actor)
                          <option value="{{ $actor->id }}">{{ $actor->name }}</option>
                        @endforeach
                      </select>
                      @error('actor_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label>Status</label> <br>
                      <input type="radio" class="@error('status') is-invalid @enderror" name="status" value="showing_now" id="showing_now" {{ old('status') == 'showing_now' ? 'checked' : '' }}> <label for="showing_now">Showing Now</label> <br>
                      <input type="radio" class="@error('status') is-invalid @enderror" name="status"  value="upcoming" id="upcoming" {{ old('status') == 'upcoming' ? 'checked' : '' }}> <label for="upcoming">Up Coming</label>
                      @error('status')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label>Poster Image</label> <br>
                      <img src="{{ asset('storage/images/movies/default.png') }}" class="img-size-50 mr-3 mb-2" alt="" id="blah">
                      <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="imgInp">
                      @error('image')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                  </div>
                </form>
              </div>
            </div>
        </div>
    </div>
</section>

@endSection

@push('styles')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
  
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>
  imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
      blah.src = URL.createObjectURL(file)
    }
  }

  $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
  });
  </script>
  
@endpush