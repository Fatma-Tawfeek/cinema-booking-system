@extends('frontend.layouts.master')
@section('content')
<!-- Home -->
<section class="home swiper" id="home">
    <div class="swiper-wrapper">
        @foreach ($sliderMovies as $movie)
            <div class="swiper-slide container">
                <img src="{{ asset('storage/' . $movie->poster_img) }}" />
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
                    <a href="information.html" class="btn">Book Now</a>
                    <a href="information.html" class="play">
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
    <!-- Serach Bar-->
    <div id="filter-container">
        <form action="" id="search-form" method="get">
        <label class="label-search" for="name"></label><br /><br />
        <input type="text" class="input-search" id="name-filter" placeholder="Name" name="search" />
        <select id="category-filter" name="category_id">
            <option value="" selected disabled>Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <input type="date" class="input-search" id="date-filter" name="date" />
        <button onclick="applyFilters()" id="apply-filter" type="submit">Apply Filters</button>
        </form>
    </div>

    <div id="result-container">
        <!-- Display filtered results here -->
    </div>

    <!--Movies Container-->
    <div class="movies-container">
        @foreach ($filteredMovies as $movie )
            <!-- Box 1-->
        <div class="box">
            <div class="box-img">
                <a href="information.html">
                    <img src="{{ asset('storage/' . $movie->poster_img) }}" alt="" />
                </a>
            </div>
            <div class="textinfo">
                <a href="information.html" style="font-size: 18px; color: aliceblue"
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
<!-- Comming Soon-->
<section class="comming" id="coming">
    <h2 class="heading">Coming Soon</h2>
    <!-- Coming Container-->
    <div class="coming-container">
        @foreach ($comingSoonMovies as $movie )
        <!-- Box 1-->
        <div class="box">
            <div class="box-img">
                <a href="information.html">
                    <img src="{{ asset('storage/' . $movie->poster_img) }}" alt="" />
                </a>
            </div>
            <div class="textinfo">
                <a href="information.html" style="font-size: 18px; color: aliceblue"
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