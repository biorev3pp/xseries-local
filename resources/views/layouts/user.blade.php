<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>X-Series</title>
    <link rel="icon" type="image/png" href="/images/favicon.ico" sizes="16x16">
    <link href="{{ asset('cms/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">  
      <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('cms/css/bootstrap.min.css') }}">
      <link href="{{ asset('cms/css/sb-admin-2.min.css') }}" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{ asset('cms/css/vendors/material-vendors.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('cms/css/material.css') }}">
    
      <link rel="stylesheet" type="text/css" href="{{ asset('cms/css/bootstrap-extended.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('cms/css/material-extended.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('cms/css/material-colors.css') }}">

      <link rel="stylesheet" type="text/css" href="{{ asset('cms/css/material-vertical-menu-modern.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('xhome/css/simple-line-icons.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('cms/css/vendors/datatables.min.css') }}">
      
      <link rel="stylesheet" type="text/css" href="{{ asset('cms/css/components.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('cms/css/core/style.css') }}">
      <link href="{{ asset('cms/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

	  
    <link href="{{asset('cms/css/custom.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('cms/css/extra.css')}}">
    <style>
      body,h1,h2,h3,h4,h5,h6,p, .h1, .h2, .h3, .h4, .h5, .h6, table {
         font-family: "Poppins",sans-serif;
      }
      .topbar{
         box-shadow:0 0 12px rgba(0, 0, 0, 0.2);
      }
      #accordionSidebar{
         position:fixed;
         left:0;
         top:70px;
         transition: 0.3s ease all;
         min-height: calc(100% - 108px);
         max-height: calc(100% - 108px);
         overflow-y:auto;
      }
      #accordionSidebar::-webkit-scrollbar{width:.3em;background:transparent}
      #accordionSidebar::-webkit-scrollbar-thumb{background:rgba(0,0,0,0.4)}
      #content-wrapper{
         padding-left:17rem;
         transition:0.3s ease all;
      }
      .content-wrapper{
         padding-top: 90px;
         height: calc(100vh - 40px);
      }
      .sidebar-brand-icon{
         opacity:1;
         transition: 0.3s ease opacity;
      }
      #nav-icon{
         display:none;
      }
      @media(max-width:991px){
         .topbar{
            height:60px !important;
         }
         #accordionSidebar{
            min-height: calc(100% - 95px);
            max-height: calc(100% - 95px);
         }
         .logo img{
            padding: 3px 0;
         }
         #content-wrapper{
            padding-left:0rem;
         }
         .sidebar{
            width: 0rem !important;
            top: 60px !important;
            z-index: 1;
         }
         .show-sidebar{
            width: 17rem !important;
         }
         .sidebar-brand-icon{
            opacity:0;
         }
         .opacity1{
            opacity: 1 !important;
         }
         #nav-icon{
            width: 25.6px;
            position: relative;
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
            -webkit-transition: .5s ease-in-out;
            -moz-transition: .5s ease-in-out;
            -o-transition: .5s ease-in-out;
            transition: .5s ease-in-out;
            cursor: pointer;
            display: inline-block;
            top: -20px;
            left: -5.5px;
            margin-right: 2px;
         }
         #nav-icon span {
            display: block;
            position: absolute;
            height: 2.5px;
            width: 50%;
            background: #323232;
            border-radius: 9px;
            opacity: 1;
            left: 0;
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
            -webkit-transition: .25s ease-in-out;
            -moz-transition: .25s ease-in-out;
            -o-transition: .25s ease-in-out;
            transition: .25s ease-in-out;
         }
         #nav-icon span:nth-child(even) {
            left: 50%;
            border-radius: 0 9px 9px 0;
         }
         #nav-icon span:nth-child(odd) {
            left:0px;
            border-radius: 9px 0 0 9px;
         }
         #nav-icon span:nth-child(1), #nav-icon span:nth-child(2) {
            top: 11px;
         }
         #nav-icon span:nth-child(3), #nav-icon span:nth-child(4) {
            top: 18px;
         }
         #nav-icon span:nth-child(5), #nav-icon span:nth-child(6) {
            top: 25px;
         }
         #nav-icon.open span:nth-child(1),#nav-icon.open span:nth-child(6) {
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            transform: rotate(45deg);
         }
         #nav-icon.open span:nth-child(2),#nav-icon.open span:nth-child(5) {
            -webkit-transform: rotate(-45deg);
            -moz-transform: rotate(-45deg);
            -o-transform: rotate(-45deg);
            transform: rotate(-45deg);
         }
         #nav-icon.open span:nth-child(1) {
            left: 2px;
            top: 14px;
         }
         #nav-icon.open span:nth-child(2) {
            left: calc(50% - 2px);
            top: 14px;
         }
         #nav-icon.open span:nth-child(3) {
            left: -50%;
            opacity: 0;
         }
         #nav-icon.open span:nth-child(4) {
            left: 100%;
            opacity: 0;
         }
         #nav-icon.open span:nth-child(5) {
            left: 2px;
            top: 23px;
         }
         #nav-icon.open span:nth-child(6) {
            left: calc(50% - 2px);
            top: 23px;
         }
      }
      @media(max-width:555px){
         .topbar {
            height:55px !important;
         }
         .logo img{
            height: 40px !important;
         }
         .sidebar{
            top: 55px !important;
         }
      }
    </style>
</head>

<body class="vertical-layout vertical-menu-modern material-vertical-layout material-layout 2-columns fixed-navbar pace-done menu-expanded" id="page-top" data-open="click" data-menu="vertical-menu" data-col="2-columns">
    <div id="wrapper">
         <!-- Sidebar -->
         <ul class="navbar-nav  sidebar sidebar-dark accordion light_bl" id="accordionSidebar">
            <!-- Sidebar - Brand -->
           @include('elements.user.header')
            <!-- Divider -->
            <!-- Nav Item - Dashboard -->
            @include('elements.user.sidemenu')
         </ul>
         <!-- End of Sidebar -->
         <!-- Content Wrapper -->
         <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

               <!-- Topbar -->
               @include('elements.user.sidebox')
               <!-- End of Topbar -->
               <!-- Begin Page Content -->
               @yield('content')
               
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('elements.user.footer')
            <!-- End of Footer -->

         </div>
         <!-- End of Content Wrapper -->
      </div>
      <!-- End of Page Wrapper -->
   <script src="//code.tidio.co/nd3ei3sfxvutpyoyimav0ivh6gboahhy.js" async></script>
   <style type="text/css">
      #tidio-chat-iframe{margin-bottom:15px !important; max-height:70% !important;}
      @media(max-width:991px){
         #tidio-chat-iframe{ max-height:100% !important; margin-bottom:0px !important}
      }
   </style>
</body>
</html>
