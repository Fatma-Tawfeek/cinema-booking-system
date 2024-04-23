<header class="header-nav">
    <a href="{{ route('home') }}" class="logo"> <i class="bx bxs-camera-movie"></i> CineMingle </a>

    <!-- Menu -->
    <ul class="navbar">
        <li><a href="#home" class="home-active">Home</a></li>
        <li><a href="#movies">Movies</a></li>
        <li><a href="#coming">Coming</a></li>
        <li><a href="#contact">Contact</a></li>
    </ul>
    @guest
    <a href="{{ route('login') }}" class="btn">Sign In</a>
    @endguest

    @auth
    <form action="{{ route('logout') }}" method="post" id="logout-form">
        @csrf
        <button type="submit" class="btn">Sign Out</button>
    </form>
    @endauth

</header>