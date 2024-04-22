<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equi="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Movie Ticket</title>
        <link rel="stylesheet" href="{{ asset('frontend/style.css') }}" />
        <!--Box Icons-->
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"
        />
        <!--Link Swiper's CSS-->
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
        />
    </head>
    <body>
        <!-- Navbar-->
        @include('frontend.layouts.partials.header')

        <!--Content-->
        @yield('content')

        <!-- Footer-->
       @include('frontend.layouts.partials.footer')

        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <!--Link to Custom JS-->
        <script src="{{ asset('frontend/main.js') }}"></script>
    </body>
</html>
