<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content="">
	<meta name="keywords" content="">
    <meta name="author" content="BIOREV">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>X-Series</title>
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estimate2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/simple-line-icons.css') }}">
    <!--    Font-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!--    Material Icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Xseries Stylesheet -->
    <link href="/Xseries-new-ui/css/style.css" rel="stylesheet">
    <style>
        .logo a{
            margin-top:0 !important;
        }
        @media(max-width: 991px){
            .pb_container{
                display:none;
            }
            .header-navbar  {
                height: 60px !important;
            }
        }
        @media(min-width: 991px){
            #nav-icon{display:none;}
        }
        @media(max-width:555px){
            .header-navbar  {
                height: 55px !important;
            }        
        }
    </style>
</head>

<body class="bg-white">
	<!-- BEGIN: Header-->
    <nav class="header-navbar fixed-top navbar-light bg-white shadow" style="height:70px;">
        <div class="row justify-content-between align-items-center h-100" style="padding:0 30px;">
            <div class="logo">
                <div id="nav-icon" onclick="openNav()">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                </div>
                <a href="{{ url('/') }}"> <img src="{{ asset('images/logo2.png') }}" class="custom_logo" style="margin:0 !important"> </a>
            </div>
            <div id="header-right-main">
                <div id="header-account-button">
                    <a href="{{route('estimates')}}">
                        <button style="margin: 0;box-shadow: none;border-radius: 0px !important;height: 40px;background-color: #9fcc3a;padding: 0 20px;font-size: 14px;color: #fff;text-align: center;font-weight: 500;letter-spacing: 2px;text-transform: uppercase;border: none;cursor: pointer;transition: 0.5s ease-in-out;" type="button" data-toggle="modal" data-target="#exampleModal">
                            back
                        </button>
                    </a>
                </div>
            </div>
        </div>
	</nav>
	<!-- END: Header-->
	<div class="content">
	    <div class="sidemenu">
      <div class="tabs-box h-100">
        <div class="community-header-bg clearfix">
            <div class="tabs-scroll-area">
            <div class="tabs-scroll-content">
                <a class="nav-link nav-link-head"><span style="vertical-align:middle;" class="material-icons">receipt_long</span> SUMMARY</a>
                <div id="accordion">
                    <div class="card bg-transparent">
                        <div class="card-header p-0" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link new-link" data-id="communitysdiv" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Community
                            </button>
                        </h5>
                        </div>
                    </div>
                    <div class="card bg-transparent">
                        <div class="card-header p-0" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link  new-link collapsed" data-id="homesdiv" data-toggle="collapse" data-target="#" aria-expanded="false" aria-controls="collapseTwo">
                            Home
                            </button>
                        </h5>
                        </div>
                    </div>
                </div>
                <!--    <hr> -->
                <button class="btn btn-link new-link">
                    Total 
                </button>
                <div class="side-section-list"><ul class="list-group"><li>Total Cost<span class="badge-right">${{number_format($estimates->total_price)}}</span></li></ul></div>
            </div>
            </div>
        </div>
      </div>
    </div>

    <div class="main-section">
        <div class="box-header" style="/* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#b5bdc8+0,828c95+36,28343b+100;Grey+Black+3D */
    background: #b5bdc8; /* Old browsers */
    background: -moz-radial-gradient(center, ellipse cover,  #b5bdc8 0%, #828c95 36%, #28343b 100%); /* FF3.6-15 */
    background: -webkit-radial-gradient(center, ellipse cover,  #b5bdc8 0%,#828c95 36%,#28343b 100%); /* Chrome10-25,Safari5.1-6 */
    background: radial-gradient(ellipse at center,  #b5bdc8 0%,#828c95 36%,#28343b 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b5bdc8', endColorstr='#28343b',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */">
            <h1> {{ $estimates->communities->name }} <br><small> {{$estimates->communities->location }} </small></h1>
            <p class="text-right">
                <span class="cbox">
                    <span class="cbox-img">
                        <img style="border-radius:50%;height: 100%;width: 100%;object-fit: cover;" src="{{ asset('/uploads/'.$estimates->communities->logo) }}" alt="{{ $estimates->communities->name }}" width="64px">
                    </span>
                    <span class="cbox-content">
                            {{  $estimates->communities->contact_person  }}<br>{{  $estimates->communities->contact_email  }}<br>{{  $estimates->communities->contact_number  }}
                    </span>
                </span>
            </p>
        </div>
        <div class="box-navlink">
            <div class="row m-0">
                <div class="col-9">
                    <button class="btn btn-side active" data-id="report"> <i class="fa fa-file-text-o"></i> Full Report</button>
                </div>
                <div class="col-3 text-right">
                     <a href="{{route('user-pdf-estimates',$estimates->id)}}" target="_blank" style="position: relative;border-radius: 3px;font-size: 10px;line-height: 18px;color: #fff;text-align: left;font-weight: 500;letter-spacing: 1px;text-transform: uppercase;border: none;margin: 0!important;cursor: pointer;text-align: center;background:rgba(255,255,255,0.15);padding: 13px 15px;top: 6px;"><i class="fa fa-download"></i> PDF</a>
                </div>
            </div>
        </div>

        <div class="box-container">
            <div class="in-container" id="report">
                <div class="box-card" id="communitysdiv">
                    <div class="in-container-title"> Community Details</div>
                    <div class="in-container-content">
                        <div class="row m-0">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>
                                            <b>Community</b><br> {{ $estimates->communities->name }} 
                                        </p>
                                        <p>
                                            <b>Location</b><br> {{ $estimates->communities->location }} 
                                        </p>
                                        <p>
                                            <b>Description</b><br> {{ $estimates->communities->description }} 
                                        </p>
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="box-card" id="homesdiv">
                    <div class="in-container-title">Home Details</div>
                    <div class="in-container-content">
                        <div class="row m-0">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>
                                            <b>Home</b><br> {{ $estimates->homes->title }} 
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        
                                        <p>
                                            <b>Specifications</b>
                                        </p>
                                        <table class="table table-striped table-condensed m-0">
                                            <tr>
                                                <th>Base Price</th><td>${{ number_format( $estimates->homes->price) }}</td>
                                            </tr>    
                                            <tr>
                                                <th>Area</th><td> {{  $estimates->homes->area }} sq.ft</td>
                                            </tr>
                                            <tr>
                                                <th>Bedrooms</th><td> {{ $estimates->homes->bedroom }} </td>
                                            </tr>
                                            <tr>
                                                <th>Bathrooms</th><td> {{ $estimates->homes->bathroom }} </td>
                                            </tr>
                                            <tr>
                                                <th>Floors</th><td> {{ $estimates->homes->floor }} </td>
                                            </tr>
                                            <tr>
                                                <th>Garage</th><td> {{ $estimates->homes->garage }} </td>
                                            </tr>
                                        </table>
                                        <br>
                                        <p>
                                            <b>Note to Admin</b><br> {{ $estimates->home_msg }} 
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>
                                            <b>Features</b>
                                        </p>
                                        <table class="table table-striped m-0 table-condensed">
                                            @if(isset($estimates->color_schemes))
                                                <tr>
                                                    <th>{{ $estimates->color_schemes->title }} </th>
                                                    <td>${{ number_format($estimates->color_schemes->price) }}
                                                </tr>
                                            @endif
                                             @if(isset($home_upgrade_patches))
                                                @foreach($home_upgrade_patches as  $upgrade)
                                                    <tr>
                                                        <th>{{$upgrade[0]->title}}</th>
                                                        <td> ${{ number_format($upgrade[0]->price) }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                          
                        </div>
                    </div>
                </div>
                </div>  
            </div>

            <div class="in-container" id="breakup" style="display:none">
                <div>
                    <div class="box-card">
                        <div class="in-container-title2 mb-15"><span>1.</span> Community - {{ $estimates->communities->name }}</div>
                            
                    </div>

                    <div class="box-card">
                        <div class="in-container-title2 mb-15"><span>2.</span> Home Details</div>
                            <table class="table table-striped">
                                <tr>
                                    <th>Base Price</th><td class="text-right">${{ number_format($estimates->homes->price) }}</td>
                                </tr>
                                @if(isset($estimates->color_schemes))
                                    <tr>
                                        <th>{{ $estimates->color_schemes->title }} </th>
                                        <td class="text-right">${{ number_format($estimates->color_schemes->price) }}
                                    </tr>
                                @endif
                             
                            </table>
                    </div>
                    
                    <div class="box-card">
                            <table class="table table-striped totaltable">
                                <tr>
                                    <th>Total Cost</th>
                                    <td class="text-right" >${{ number_format($estimates->total_price) }}  </td>
                                </tr>
                            </table>
                    </div>
                </div>
           
            </div>
            <div class="in-container" id="pdf" style="display:none">
               
            </div>
            <div class="in-container" id="print" style="display:none">
               
            </div>
        </div>
	</div>
    <footer>
        <p> ©  2020 Biorev, All Rights Reserved. </p>
        <p>Designed &amp; Developed By <a href="https://biorev.com" target="_blank">Biorev</a></p>
    </footer>

	<script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.min.js" integrity="sha256-s/wuIT+s0uE5Igk30VS2UAcs5Ck6SDt+iTlUzYQBn/4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script type="text/javascript">
	var APP_URL = '<?php echo url('/') ?>';     
        $('.new-link').click(function() {
            $('.box-card .in-container-content').removeClass('active-shadow');
            var did = $(this).attr('data-id');
            $('#'+did+' .in-container-content').addClass('active-shadow');
            $('html, body').animate({
                scrollTop: $("#"+did).offset().top - 70}, 1000);
        });
        let openMenu = true;
        function openNav() {
            openMenu =! openMenu;
            if(openMenu){
                $(".sidemenu").addClass('sidebar-show');
                $(".tabs-box .nav-tabs .nav-item").addClass('tab-border-right');
                $("#nav-icon").addClass('open');
            }
            else{
                $(".sidemenu").removeClass('sidebar-show');
                $(".tabs-box .nav-tabs .nav-item").removeClass('tab-border-right');
                $("#nav-icon").removeClass('open');
            }
        }
    </script>
    <!-- Tidio -->
    <script src="//code.tidio.co/nd3ei3sfxvutpyoyimav0ivh6gboahhy.js" async></script>
    <style type="text/css">
        #tidio-chat-iframe{margin-bottom:20px !important; max-height:70% !important;}
        @media(max-width:991px){
            #tidio-chat-iframe{ max-height:100% !important; margin-bottom:0px !important}
        }
    </style>
</body>

</html>