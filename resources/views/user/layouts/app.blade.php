<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='copyright' content=''>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://kit.fontawesome.com/90591a8054.js" crossorigin="anonymous"></script>
    <!-- Title Tag  -->
    <title>SupremeTech Eshop.</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/user/images/favicon.png') }}">
    <!-- Web Font -->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">

    <!-- StyleSheet -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/bootstrap.css') }}">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/magnific-popup.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/font-awesome.css') }}">
    <!-- Fancybox -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/jquery.fancybox.min.css') }}">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/themify-icons.css') }}">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/niceselect.css') }}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/animate.css') }}">
    <!-- Flex Slider CSS -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/flex-slider.min.css') }}">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/owl-carousel.css') }}">
    <!-- Slicknav -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/slicknav.min.css') }}">
    <!-- Profile User -->
    @stack('css')

    <!-- Eshop StyleSheet -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/responsive.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Data Table Bootstrap -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css"> --}}
    <!-- Custom css -->
    <link rel="stylesheet" href="{{ asset('assets/user/custom.css') }}">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script> --}}

</head>

<body class="js">
    <!-- Jquery -->
    <script src="{{ asset('assets/user/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/jquery-migrate-3.0.0.js') }}"></script>
    <script src="{{ asset('assets/user/js/jquery-ui.min.js') }}"></script>
    <!-- Popper JS -->
    <script src="{{ asset('assets/user/js/popper.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/user/js/bootstrap.min.js') }}"></script>
    <!-- Color JS -->
    <script src="{{ asset('assets/user/js/colors.js') }}"></script>
    <!-- Slicknav JS -->
    <script src="{{ asset('assets/user/js/slicknav.min.js') }}"></script>
    <!-- Owl Carousel JS -->
    <script src="{{ asset('assets/user/js/owl-carousel.js') }}"></script>
    <!-- Magnific Popup JS -->
    <script src="{{ asset('assets/user/js/magnific-popup.js') }}"></script>
    <!-- Waypoints JS -->
    <script src="{{ asset('assets/user/js/waypoints.min.js') }}"></script>
    <!-- Countdown JS -->
    <script src="{{ asset('assets/user/js/finalcountdown.min.js') }}"></script>
    <!-- Nice Select JS -->
    <script src="{{ asset('assets/user/js/nicesellect.js') }}"></script>
    <!-- Flex Slider JS -->
    <script src="{{ asset('assets/user/js/flex-slider.js') }}"></script>
    <!-- ScrollUp JS -->
    <script src="{{ asset('assets/user/js/scrollup.js') }}"></script>
    <!-- Onepage Nav JS -->
    <script src="{{ asset('assets/user/js/onepage-nav.min.js') }}"></script>
    <!-- Easing JS -->
    <script src="{{ asset('assets/user/js/easing.js') }}"></script>
    <!-- Active JS -->
    <script src="{{ asset('assets/user/js/active.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- Order history -->
    <script src="{{ asset('assets/user/js/order_history.js') }}"></script>
    @yield('js')
    <!-- update cart JS -->
    <script src="{{ asset('assets/user/js/update-cart.js') }}"></script>
    <!-- Add cart JS -->
    <script src="{{ asset('assets/user/js/add-cart.js') }}"></script>
    <!-- Header -->
    @include('user.layouts.header')
    <!--/ End Header -->

    <!-- Content -->
    @yield('content')
    <!--/ End Content -->


    <!-- Footer -->
    @include('user.layouts.footer')
    <!--/ End Footer -->
</body>
@yield('js')

</html>
