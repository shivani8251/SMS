<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Frest admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Frest admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="DIGITALTEXT">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('head.name', 'DIGITALTEXT') }}</title>
    <!-- Fonts -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/assets/img/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">
    <!-- Styles -->

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/vendors/css/vendors.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/editors/quill/katex.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/editors/quill/monokai-sublime.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/editors/quill/quill.snow.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/editors/quill/quill.bubble.css')}}">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/bootstrap-extended.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/themes/dark-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/themes/semi-dark-layout.min.css') }}">


    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/vendors/css/ui/plyr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/jquery-confirm.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/vendors/css/extensions/swiper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/vendors/css/extensions/toastr.css') }}">
    <!-- END: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/plugins/maps/maps-leaflet.min.css') }}">

    <!-- BEGIN: Theme CSS-->
    <link href="{{ asset('public/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
   
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/core/menu/menu-types/vertical-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/pages/dashboard-ecommerce.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/plugins/extensions/toastr.min.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->

    <link rel="stylesheet" href="{{ asset('public/assets/css/leaflet.css') }}" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('public/assets/uploader/css/fileinput.css') }}" />
    <link href="{{ asset('public/assets/uploader/themes/explorer-fas/theme.css') }}" media="all" rel="stylesheet" type="text/css"/>
    
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/style.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/plugins/forms/wizard.min.css ') }}">
    <style type="text/css">
    /*html, body { width:100%;padding:0;margin:0; }*/
    .map-modal-body { width:95%;max-width:980px; height:500px; padding:1% 2%;margin:0 auto }
    #lat, #lon { text-align:right }
    #map { width:100%; height:50%; padding:0; margin:0; }
    .address { cursor:pointer }
    .address:hover { color:#AA0000; text-decoration:underline }
    </style>
    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    
</head>
