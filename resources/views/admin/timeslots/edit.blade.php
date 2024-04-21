@extends('admin.layouts.master')

@section('title', 'Edit Timeslot')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Timeslots</li>
<li class="breadcrumb-item active">Edit Timeslot</li>
@endSection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Timeslot</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.timeslots.update', $timeslot->id) }}" method="post">
                  @csrf
                  @method('put')
                  <div class="card-body">
                    <div class="form-group">
                      <label for="">Cinemas</label> <br>
                      <select class="js-example-basic-single form-control @error('cinema_id') is-invalid @enderror" name="cinema_id">
                        @foreach ($cinemas as $cinema)
                          <option value="{{ $cinema->id }}" {{ $cinema->id == $timeslot->cinema_id ? 'selected' : '' }}>{{ $cinema->name }}</option>
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
                          <option value="monday" {{ $timeslot->day == 'monday' ? 'selected' : '' }}>Monday</option>
                          <option value="tuesday" {{ $timeslot->day == 'tuesday' ? 'selected' : '' }}>Tuesday</option>
                          <option value="wednesday" {{ $timeslot->day == 'wednesday' ? 'selected' : '' }}>Wednesday</option>
                          <option value="thursday" {{ $timeslot->day == 'thursday' ? 'selected' : '' }}>Thursday</option>
                          <option value="friday" {{ $timeslot->day == 'friday' ? 'selected' : '' }}>Friday</option>
                          <option value="saturday" {{ $timeslot->day == 'saturday' ? 'selected' : '' }}>Saturday</option>
                          <option value="sunday" {{ $timeslot->day == 'sunday' ? 'selected' : '' }}>Sunday</option>
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
                        <input type="time" class="form-control @error('from') is-invalid @enderror" placeholder="Enter start time" value="{{ $timeslot->from }}" name="from">
                        @error('from')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-6">
                        <label>End Time</label>
                        <input type="time" class="form-control @error('to') is-invalid @enderror" placeholder="Enter end time" value="{{ $timeslot->to }}" name="to"> 
                        @error('to')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
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