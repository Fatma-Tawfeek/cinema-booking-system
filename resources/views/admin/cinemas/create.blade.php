@extends('admin.layouts.master')

@section('title', 'Add Cinema')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Cinemas</li>
<li class="breadcrumb-item active">Add Cinema</li>
@endSection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add Cinema</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.cinemas.store') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter name" value="{{ old('name') }}">
                      @error('name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <div class="row">
                      <div class="form-group col-md-6">
                        <label>Number of Rows</label>
                        <input type="number" class="form-control @error('num_of_rows') is-invalid @enderror" name="num_of_rows" placeholder="Enter Number of Rows" value="{{ old('num_of_seats') }}">
                        @error('num_of_rows')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-6">
                        <label>Number of Columns</label>
                        <input type="number" class="form-control @error('num_of_columns') is-invalid @enderror" name="num_of_columns" placeholder="Enter Number of Columns" value="{{ old('num_of_seats') }}">
                        @error('num_of_columns')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Logo Image</label> <br>
                      <img src="{{ asset('storage/images/cinemas/default.png') }}" class="img-size-50 mr-3 mb-2" alt="" id="blah">
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

@push('scripts')
  
  <script>
  imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
      blah.src = URL.createObjectURL(file)
    }
  }
  </script>
  
@endpush