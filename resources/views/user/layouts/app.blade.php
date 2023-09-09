<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('head.name', 'DIGITALTEXT') }}</title>
    <!-- Fonts -->

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('public/assets/plugins/fontawesome-free/css/all.min.css') }}"> --}}

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/assets/img/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/vendors/css/vendors.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/themes/dark-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/themes/semi-dark-layout.min.css') }}">
    <!-- END: Theme CSS-->

    <link rel="stylesheet" type="text/css" href="{{ asset('public/user_assets/toastr.css') }}">
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/core/menu/menu-types/vertical-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/pages/authentication.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/style.css') }}">

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('public/user_assets/vendors/jquery.min.js') }}"></script>
    <script src="{{ asset('public/user_assets/vendors/popper/popper.js') }}"></script>
    <script src="{{ asset('public/user_assets/vendors/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('public/user_assets/vendors/hc-sticky/hc-sticky.js') }}"></script>
    <script src="{{ asset('public/user_assets/vendors/isotope/isotope.pkgd.js') }}"></script>
    <script src="{{ asset('public/user_assets/vendors/magnific-popup/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('public/user_assets/vendors/slick/slick.js') }}"></script>
    <script src="{{ asset('public/user_assets/vendors/waypoints/jquery.waypoints.js') }}"></script>
    <script src="{{ asset('public/user_assets/js/app.js') }}"></script>

    <script src="{{ asset('public/assets/vendors/js/vendors.min.js') }}"></script>     
    <script src="{{ asset('public/assets/js/jquery-confirm.min.js') }}"></script>

    <script src="{{ asset('public/assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('public/assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('public/assets/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
    <script src="{{ asset('public/assets/vendors/js/pickers/pickadate/legacy.js') }}"></script>
    <script src="{{ asset('public/assets/vendors/js/extensions/moment.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>

    <script src="{{ asset('public/assets/uploader/js/fileinput.js') }}" type="text/javascript"></script>
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('public/assets/vendors/js/ui/plyr.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    
    <script src="{{ asset('public/assets/vendors/js/extensions/toastr.min.js') }}"></script>
</head>
<body>
        <main class="vertical-layout vertical-menu-modern 1-column  navbar-sticky footer-static bg-full-screen-image  blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
            @yield('content')
            @yield('script')
        </main>
</body>
</html>
