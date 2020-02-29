<!doctype html>
<html  class="no-js" lang="zxx">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="SITE KEYWORDS HERE" />
    <meta name="description" content="">
    <meta name='copyright' content=''>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    
    <!-- Title -->
    <title>@yield('title','AHF') </title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('pv/images/favicon.png') }}">
    <!-- Web Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    
    {{-- font-family: 'Ubuntu', sans-serif; --}}
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('pv/css/bootstrap.min.css') }}">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('pv/css/font-awesome.min.css') }}" >
    <!-- Fancy Box CSS -->
    <link rel="stylesheet" href="{{ asset('pv/css/jquery.fancybox.min.css') }}">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{ asset('pv/css/owl.carousel.min.css') }}" >
    <link rel="stylesheet" href="{{ asset('pv/css/owl.theme.default.min.css') }}" >
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('pv/css/animate.min.css') }}" >
    <!-- Slick Nav CSS -->
    <link rel="stylesheet" href="{{ asset('pv/css/slicknav.min.css') }}" >
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('pv/css/magnific-popup.css') }}">
    
    <!-- Learedu Stylesheet -->
    <link rel="stylesheet" href="{{ asset('pv/css/normalize.css') }}" >
    <link rel="stylesheet" href="{{ asset('pv/css/style.css') }}" >
    <link rel="stylesheet" href="{{ asset('pv/css/responsive.css') }}" >
    <!-- Color -->
    <link rel="stylesheet" href="{{ asset('pv/css/color.css') }}" >

    @yield('css')
</head>
<body>

    <!-- Header -->
    <header class="header">
        <!-- Topbar -->
            @include('partials_PV._topbar')
        <!-- End Topbar -->
        <!-- Header Inner -->
            @includeWhen($header_inner,'partials_PV._header_inner')
        <!--/ End Header Inner -->
        <!-- Header Menu -->
            @includeWhen($header_menu,'partials_PV._header_menu')
        <!--/ End Header Menu -->
    </header>
    <!-- End Header -->
    
    <!-- Slider Area -->
        @includeWhen($slide,'partials_PV._slide')
    <!--/ End Slider Area -->

    <section class="full-content-box">
        <div class="container-fluid">
            <div class="full-content-items">
                
                <!--/ middle content start -->
                @yield('foisal')
                <!--/ middle content end -->

            </div>

                <!-- Footer area -->
                @includeWhen($footer,'partials_PV._footer')
                <!--/ End footer area -->                

        </div>
    </section>
<!-- Jquery JS-->

@php
    $table = \App\Models\Coaching\Fornt\CoachingForntVisitorCounter::whereDate('created_at',date("Y-m-d"))->first();
    //dd($table);
    if(empty($table)){
        $input['visitor_counter'] = 1;
        \App\Models\Coaching\Fornt\CoachingForntVisitorCounter::create($input);
    } else {
        $table->update(['visitor_counter' => ++$table->visitor_counter]);
    }
@endphp


    <script src="{{ asset('pv/js/jquery.min.js') }}"></script>
    <script src="{{ asset('pv/js/jquery-migrate.min.js') }}"></script>
    <!-- Popper JS-->
    <script src="{{ asset('pv/js/popper.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('pv/js/bootstrap.min.js') }}"></script>
    <!-- Colors JS-->
    <script src="{{ asset('pv/js/colors.js') }}"></script>
    <!-- Jquery Steller JS -->
    <script src="{{ asset('pv/js/jquery.stellar.min.js') }}"></script>
    <!-- Particle JS -->
    <script src="{{ asset('pv/js/particles.min.js') }}"></script>
    <!-- Fancy Box JS-->
    <script src="{{ asset('pv/js/facnybox.min.js') }}"></script>
    <!-- Magnific Popup JS-->
    <script src="{{ asset('pv/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Masonry JS-->
    <script src="{{ asset('pv/js/masonry.pkgd.min.js') }}"></script>
    <!-- Circle Progress JS -->
    <script src="{{ asset('pv/js/circle-progress.min.js') }}"></script>
    <!-- Owl Carousel JS-->
    <script src="{{ asset('pv/js/owl.carousel.min.js') }}"></script>
    <!-- Waypoints JS-->
    <script src="{{ asset('pv/js/waypoints.min.js') }}"></script>
    <!-- Slick Nav JS-->
    <script src="{{ asset('pv/js/slicknav.min.js') }}"></script>
    <!-- Counter Up JS -->
    <script src="{{ asset('pv/js/jquery.counterup.min.js') }}"></script>
    <!-- Easing JS-->
    <script src="{{ asset('pv/js/easing.min.js') }}"></script>
    <!-- Wow Min JS-->
    <script src="{{ asset('pv/js/wow.min.js') }}"></script>
    <!-- Scroll Up JS-->
    <script src="{{ asset('pv/js/jquery.scrollUp.min.js') }}"></script>
    <!-- Google Maps JS -->
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyC0RqLa90WDfoJedoE3Z_Gy7a7o8PCL2jw"></script>
    <script src="{{ asset('js/gmaps.min.js') }}"></script>
    <!-- Main JS-->
    <script src="{{ asset('pv/js/main.js') }}"></script>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    @yield('js')
</body>
</html>