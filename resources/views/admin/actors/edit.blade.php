@extends('admin.layouts.master')

@section('title', 'Edit Actor')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Actors</li>
<li class="breadcrumb-item active">Edit Actor</li>
@endSection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Actor</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.actors.update', $actor->id) }}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                  <div class="card-body">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter name" value="{{ $actor->name }}">
                      @error('name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label>Nationality</label>
                      <input type="text" class="form-control @error('nationality') is-invalid @enderror" name="nationality" placeholder="Enter nationality" value="{{ $actor->nationality }}">
                      @error('nationality')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label>Profile Image</label> <br>
                      <img src="{{ asset('storage/' . $actor->profile_img) }}" class="img-size-50 mr-3 mb-2" alt="" id="blah">
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
                    <button type="submit" class="btn btn-primary">Edit</button>
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