@foreach ($filteredMovies as $movie )
    <!-- Box 1-->
    <div class="box">
        <div class="box-img">
            <a href="information.html">
                <img src="{{ asset('storage/' . $movie->poster_img) }}" alt="" />
            </a>
        </div>
        <div class="textinfo">
            <a href="information.html" style="font-size: 18px; color: aliceblue">{{ $movie->title }}</a><br />
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
