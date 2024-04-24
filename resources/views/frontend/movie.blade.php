@extends('frontend.layouts.master')

@section('title', $movie->title)

@section('content')

  <!-- Movie Info Section -->
  <div class="information">
    <section class="info">
      <div class="info-image">
        <img src="{{ asset('storage/' . $movie->poster_img) }}" alt="">
      </div>
      <div class="info-content">
        <h2>{{ $movie->title }}</h2>
        <p> Genre: 
            @foreach ($movie->categories as $movieCategory)
                {{ $movieCategory->name }}
                @if(!$loop->last)
                    ,
                @endif                
            @endforeach
        </p>
        <p> Running Time: {{ $movie->duration }} min</p>
        <p> Release Date: {{ date('d M Y', strtotime($movie->release_date)) }}</p>
        <p> 
            @foreach ($movie->actors as $movieActor)
                {{ $movieActor->name }}
                @if(!$loop->last)
                    ,
                @endif                
            @endforeach
        </p>
        <p> Language: English </p>
        @if($movie->status == 'showing_now')
        <a href = "schedule.html" class="book-now">Book Now</a>
        @else
        <a href = "#" class="book-now">Coming Soon</a>
        @endif
      </div>
    </section>
  </div>

  <!-- About Movie-->
  <div class="text-info">
    <div class="m-header">
      <h3>About the movie</h3>
    </div>
    <div class="m-text">
      <p>{{ $movie->description }}</p>
    </div>
  </div>

  <!-- Comming Soon-->
  <section class="comming" id="coming">
    <h2 class="heading">You might also like</h2>
    <!--Movies Container-->
    <div class="movies-container">
      @foreach ($commanMovies as $commanMovie )
      <!-- Box 1-->
      <div class="box">
        <div class="box-img">
          <a href="{{ route('movies.show', $commanMovie->id) }}">
            <img src="{{ asset('storage/' . $commanMovie->poster_img) }}" alt="">
          </a>
        </div>
        <div class="textinfo">
          <a href="{{ route('movies.show', $commanMovie->id) }}"  style="font-size:18px;color:aliceblue">{{ $commanMovie->title }}</a><br>
            <span >
              @foreach ($commanMovie->categories as $commanMovieCategory)
                  {{ $commanMovieCategory->name }}
                  @if(!$loop->last)
                      ,
                  @endif
              @endforeach
               | {{ $commanMovie->duration }} MIN</span><br>
        </div>
      </div>
      @endforeach
  </div>
  </section>

@endsection
