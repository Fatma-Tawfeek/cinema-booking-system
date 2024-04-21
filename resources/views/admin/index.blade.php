  @extends('admin.layouts.master')
  @section('title', 'Dashboard')
  @section('breadcrumb')
  @parent
  <li class="breadcrumb-item active">Dashboard</li>
  @endsection
  @section('content')
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $bookings_count }}</h3>

                <p>Bookings</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-ticket-alt"></i>
              </div>
              <a href="{{ route('admin.bookings.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $movies_count }}</h3>

                <p>Movies</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-film"></i>
              </div>
              <a href="{{ route('admin.movies.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $cinemas_count }}</h3>

                <p>Cinemas</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-theater-masks"></i>
              </div>
              <a href="{{ route('admin.cinemas.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $users_count }}</h3>

                <p>Users</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-users"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection