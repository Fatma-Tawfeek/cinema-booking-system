@extends('admin.layouts.master')

@section('title', 'Add Timeslot')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Timeslots</li>
<li class="breadcrumb-item active">Add Timeslot</li>
@endSection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add Timeslot</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.timeslots.store') }}" method="post">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="">Cinemas</label> <br>
                      <select class="js-example-basic-single form-control @error('cinema_id') is-invalid @enderror" name="cinema_id">
                        @foreach ($cinemas as $cinema)
                          <option value="{{ $cinema->id }}">{{ $cinema->name }}</option>
                        @endforeach
                      </select>
                      @error('cinema_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="">Day</label> <br>
                      <select class="form-control @error('day') is-invalid @enderror" name="day" >
                          <option value="monday">Monday</option>
                          <option value="tuesday">Tuesday</option>
                          <option value="wednesday">Wednesday</option>
                          <option value="thursday">Thursday</option>
                          <option value="friday">Friday</option>
                          <option value="saturday">Saturday</option>
                          <option value="sunday">Sunday</option>
                      </select>
                      @error('day')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <div class="row">
                      <div class="form-group col-md-6">
                        <label>Start Time</label>
                        <input type="time" class="form-control @error('start_time') is-invalid @enderror" placeholder="Enter start time" value="{{ old('start_time') }}" name="from">
                        @error('start_time')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-6">
                        <label>End Time</label>
                        <input type="time" class="form-control @error('end_time') is-invalid @enderror" placeholder="Enter end time" value="{{ old('end_time') }}" name="to"> 
                        @error('end_time')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
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
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});

  </script>
  
@endpush