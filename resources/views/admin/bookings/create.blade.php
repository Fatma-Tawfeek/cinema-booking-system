@extends('admin.layouts.master')

@section('title', 'Add Movie Schedule')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Movie Schedules</li>
<li class="breadcrumb-item active">Add Movie Schedule</li>
@endSection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add Movie Schedule</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.schedules.store') }}" method="post">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="">Movie</label> <br>
                      <select class="js-example-basic-single form-control @error('movie_id') is-invalid @enderror" name="movie_id">
                        <option value="">Select Movie</option>
                        @foreach ($movies as $movie)
                          <option value="{{ $movie->id }}">{{ $movie->title }}</option>
                        @endforeach
                      </select>
                      @error('movie_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="">Cinemas</label> <br>
                      <select class="js-example-basic-single form-control @error('cinema_id') is-invalid @enderror" name="cinema_id" id="cinema">
                        <option value="">Select Cinema</option>
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
                      <label for="">Timeslot</label> <br>
                      <select class="form-control @error('timeslot_id') is-invalid @enderror" name="timeslot_id" id="timeslot">
                       <option value="">Select Timeslot</option>
                      </select>
                      @error('timeslot_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="">Date</label>
                      <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" placeholder="Enter date" value="{{ old('date') }}" >
                      @error('date')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                      </div>
                      <div class="form-group">
                        <label for="">Ticket Price in leke</label>
                        <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Enter price" value="{{ old('price') }}" >
                        @error('price')
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

  <script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
    });

    $(document).ready(function(){
    $('#cinema').change(function(){
        var cinemaId = $(this).val();
        $('#timeslot').empty();
        $.get('/admin/schedules/' + cinemaId + '/timeslots', function(data){
            $.each(data, function(key, value){
                $('#timeslot').append('<option value="' + value.id + '">'  + moment(value.from, 'HH:mm').format('hh:mm A') + ' - ' + moment(value.to, 'HH:mm').format('hh:mm A') +  '</option>');
            });
        });
    });
  });


  </script>
  
@endpush