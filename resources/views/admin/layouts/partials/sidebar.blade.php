  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->full_name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Categories
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.actors.index') }}" class="nav-link {{ request()->is('admin/actors*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Actors
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.movies.index') }}" class="nav-link {{ request()->is('admin/movies*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-film"></i>
              <p>
                Movies
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.cinemas.index') }}" class="nav-link {{ request()->is('admin/cinemas*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-theater-masks"></i>
              <p>
                Cinemas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.timeslots.index') }}" class="nav-link {{ request()->is('admin/timeslots*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-clock"></i>
              <p>
                Cinemas Timeslots
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.schedules.index') }}" class="nav-link {{ request()->is('admin/schedules*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Movies Schedules
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.bookings.index') }}" class="nav-link {{ request()->is('admin/bookings*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-ticket-alt"></i>
              <p>
                Bookings
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>