@extends('frontend.layouts.master')
@section('title', 'Home')
@section('content')
<!-- Home -->
<section class="home swiper" id="home">
    <div class="swiper-wrapper">
        @foreach ($sliderMovies as $movie)
            <div class="swiper-slide container">
                <img src="{{ asset('storage/' . $movie->poster_img) }}" style="background: rgba(0, 0, 0, 0.5)" />
                <div class="home-text">
                    <span>
                        @foreach ($movie->categories as $movieCategory)
                            {{ $movieCategory->name }}
                            @if(!$loop->last)
                                |
                            @endif                            
                        @endforeach
                    </span>
                    <h1>{{ $movie->title }}</h1>
                    <a href="{{ route('movies.show', $movie->id) }}" class="btn">Book Now</a>
                    <a href="{{ route('movies.show', $movie->id) }}" class="play">
                        <i class="bx bx-play-circle"></i>
                    </a>
                </div>
            </div>     
        @endforeach       
    </div>

    <div class="swiper-pagination"></div>
</section>
<!-- Movies -->
<section class="movies" id="movies">
    <h2 class="heading">Coming This Week</h2>
    <!-- Search Bar-->
    <div id="filter-container">
        <form id="search-form" method="get">
            <label class="label-search" for="name"></label><br /><br />
            <input type="text" class="input-search" id="name-filter" placeholder="Name" name="search" value="{{ request()->get('search') }}" />
            <select id="category-filter" name="category_id">
                <option value="" selected>Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request()->get('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            <input type="date" class="input-search" id="date-filter" name="date" value="{{ request()->get('date') }}" />
            <button id="apply-filter" type="button">Apply Filters</button>
        </form>
    </div>

    <div id="result-container">
        <!-- Display filtered results here -->
        {{-- @include('frontend.filtered_movies') --}}
    </div>

    <!-- Movies Container -->
    <div class="movies-container">
        <!-- Display slider movies, coming soon movies, etc. -->
        @include('frontend.filtered_movies')
    </div>
</section>
<!-- Comming Soon-->
<section class="comming" id="coming">
    <h2 class="heading">Coming Soon</h2>
    <!-- Coming Container-->
    <div class="coming-container">
        @foreach ($comingSoonMovies as $movie )
        <!-- Box 1-->
        <div class="box">
            <div class="box-img">
                <a href="{{ route('movies.show', $movie->id) }}">
                    <img src="{{ asset('storage/' . $movie->poster_img) }}" alt="" />
                </a>
            </div>
            <div class="textinfo">
                <a href="{{ route('movies.show', $movie->id) }}" style="font-size: 18px; color: aliceblue"
                    >{{ $movie->title }}</a
                ><br />
                <span>
                    @foreach ($movie->categories as $movieCategory)
                        {{ $movieCategory->name }}
                        @if(!$loop->last)
                            ,
                        @endif
                    @endforeach
                        | {{ $movie->duration }} MIN                    
                </span><br />
            </div>
        </div>            
        @endforeach

    </div>
</section>
@endsection

@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#apply-filter').click(function(event) {
            event.preventDefault(); // Prevent form submission

            var formData = $('#search-form').serialize(); // Serialize form data

            $.get('/', formData, function(response) {
                $('#result-container').html(response); // Update results container
            });
        });
    });
</script>
    
@endpush