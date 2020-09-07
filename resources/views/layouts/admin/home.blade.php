<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'xHome360 | X-Series') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('public/favicon.png') }}" sizes="16x16">
    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="{{ asset('public/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/xfloor-style.css') }}">
    <!-- Style rangeSlider -->
    <link rel="stylesheet" href="{{ asset('public/css/ion.rangeSlider.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/ion.rangeSlider.skinFlat.css') }}">

    <link rel="stylesheet" href="{{ asset('public/css/nouislider.min.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/responsive.css') }}">
    <!-- SweetAlert -->
    <link rel="stylesheet" href="{{ asset('public/css/sweetalert.css') }}">
    <!-- Core CSS file -->
    <link rel="stylesheet" href="{{ asset('public/css/photoswipe.css') }}">

    <!-- Skin CSS file (styling of UI - buttons, caption, etc.)
         In the folder of skin CSS file there are also:
         - .png and .svg icons sprite,
         - preloader.gif (for browsers that do not support CSS animations) -->
    <link rel="stylesheet" href="{{ asset('public/css/default-skin/default-skin.css') }}">
    <!-- XHome Menu CSS And  XHome Responsive Mune CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/xhome-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/xhome-responsive-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/xfloor-responsive.css') }}">
</head>
<body>
<div id="fs-loading" style="display: none;">
    <div class="fs-loading-content center-middle">
      <p class="fs-loading-icon"> 
      
          </p><div class="item item-1"></div>
          <div class="item item-2"></div>
          <div class="item item-3"></div>
          <div class="item item-4"></div>
      
      <p></p>
      <!-- <p class="fs-loading-text"> Loading <span class="load-percentage"></span> </p> -->
      <p class="fs-loading-text"><span class="load-percentage">0%</span> </p>
    </div>
  </div>
  

    <!-- Begin wrapper -->
    <div class="wrapper">
      @include('elements.home-header')
      <div class="ng-scope" style="">
      @yield('content')
      @include('elements.home-footer')
      </div>
    </div>
    <!-- End wrapper -->

    <!-- jquery latest version -->
    <script src="{{ asset('public/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/js/home-custom.js') }}"></script>

    <!-- popper.min js -->
   <!-- <script src="new-ui/js/popper.min.js"></script>-->

    <!-- bootstrap.min js -->
    <!--<script src="new-ui/js/bootstrap.min.js"></script>-->

    <!-- ie10 viewport bug-workaround js -->
    <!--<script src="new-ui/js/ie10-viewport-bug-workaround.js"></script>-->

    <!-- custom js -->
    <!--<script src="new-ui/js/custom.js"></script>-->

</body>
</html>
