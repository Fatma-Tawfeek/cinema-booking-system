@extends('admin.layouts.master')

@section('title', 'Add Actor')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Actors</li>
<li class="breadcrumb-item active">Add Actor</li>
@endSection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add Actor</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.actors.store') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter name">
                      @error('name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label>Nationality</label>
                      <input type="text" class="form-control @error('nationality') is-invalid @enderror" name="nationality" placeholder="Enter nationality">
                      @error('nationality')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label>Profile Image</label> <br>
                      <img src="{{ asset('storage/images/actors/default.png') }}" class="img-size-50 mr-3 mb-2" alt="" id="blah">
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