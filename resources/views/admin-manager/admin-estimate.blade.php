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
	<title>Estimate - X-Series::Biorev</title>
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estimate2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
</head>

<body class="bg-white">
	<!-- BEGIN: Header-->
	<nav class="header-navbar  fixed-top navbar-light bg-white shadow">
		<div class="container-fluid">
			<div class="row">
				 <div class="col-md-8 col-8">
					<h3 class="brand-text text-center">
						<a href="{{ url('/') }}"> <img src="{{ asset('images/logo2.png') }}" class="logo custom_logo"> </a>
					</h3>
				</div>
				
                 <div class="col-4 col-md-4 text-right top-back">
                        <a href="{{route('manager-estimates')}}" class="btn back_btn"><i class="fa fa-arrow-left"></i> Back</a>
                 </div>
    		</div>
		</div>
	</nav>
	<!-- END: Header-->
	<div class="content">
		<div class="xfloor-section-right">
      <div class="xfloor-tabs-box">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link xfloor-note active" id="community-tab" data-toggle="tab" data-target="#community" role="tab" aria-controls="community" aria-selected="true"> SUMMARY</a>
          </li>
        </ul>
        <div class="tab-content right-part-tabs">
          <div class="tab-pane fade show active" id="community" rolpe="tabpanel" aria-labelledby="community-tab">
            <div class="community-header-bg clearfix">
              <div class="tabs-scroll-area">
                <div class="tabs-scroll-content">
                    <div id="accordion">
                        <div class="card bg-transparent">
                            <div class="card-header p-0" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link new-link" data-id="communitysdiv" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Community
                                </button>
                            </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body p-0">
                            
                            </div>
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
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body p-0">
                            <div class="side-section-list"><ul class="list-group"><li>Exterior Design<span class="badge-right"> $ {{ number_format($estimates->homes->price)}}</span></li></ul></div>
                            </div>
                            </div>
                        </div>
                        
                        
                    </div>
                 <!--    <hr> -->
                    <div class="side-section-list"><ul class="list-group"><li>Total Cost<span class="badge-right">$ {{number_format($estimates->total_price)}}</span></li></ul></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="main-section">
        <div class="box-header" style="background:url({{ asset('uploads/'.$estimates->communities->banner) }}) center center no-repeat">
            <h1> {{ $estimates->communities->name }} <br><small> {{$estimates->communities->location }} </small></h1>
            <p class="text-right">
                <span class="cbox">
                    <span class="cbox-img">
                        <img src="{{ asset('/uploads/'.$estimates->communities->logo) }}" alt="{{ $estimates->communities->name }}" width="64px">
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
                 <!--    <button class="btn btn-side" data-id="breakup"> <i class="fa fa-dollar"></i> Cost Breakup</button> -->
                </div>
                <div class="col-3 text-right">
                     <a href="{{route('manager-pdf-estimates',$estimates->id)}}" target="_blank"><i class="fa fa-download"></i> PDF</a>
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
                                        <p>
                                            <b>Note to Admin</b><br> {{ $estimates->home_msg }} 
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
                                                <th>Base Price</th><td>$ {{ number_format( $estimates->homes->price) }}</td>
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
                                    </div>
                                    <div class="col-md-6">
                                        <p>
                                            <b>Features</b>
                                        </p>
                                        <table class="table table-striped m-0 table-condensed">
                                            @if(isset($estimates->color_schemes))
                                                <tr>
                                                    <th>{{ $estimates->color_schemes->title }} </th>
                                                    <td>$ {{ number_format($estimates->color_schemes->price) }}
                                                </tr>
                                            @endif
                                             @if(isset($home_upgrade_patches))
                                                @foreach($home_upgrade_patches as  $upgrade)
                                                    <tr>
                                                        <th>{{$upgrade[0]->title}}</th>
                                                        <td> $ {{ number_format($upgrade[0]->price) }}</td>
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
                                    <th>Base Price</th><td class="text-right">$ {{ number_format($estimates->homes->price) }}</td>
                                </tr>
                                @if(isset($estimates->color_schemes))
                                    <tr>
                                        <th>{{ $estimates->color_schemes->title }} </th>
                                        <td class="text-right">$ {{ number_format($estimates->color_schemes->price) }}
                                    </tr>
                                @endif
                             
                            </table>
                    </div>
                    
                    <div class="box-card">
                            <table class="table table-striped totaltable">
                                <tr>
                                    <th>Total Cost</th>
                                    <td class="text-right" >$ {{ number_format($estimates->total_price) }}  </td>
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
<div class="footer-wrapper">
  <div class="super-footer">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 col-xl-6 col-6">
         
        </div> 
        <div class="col-lg-6 col-xl-6 col-6 text-right"> 
            <p>Designed &amp; Developed By <a href="https://biorev.com" target="_blank">Biorev</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

	<script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.min.js" integrity="sha256-s/wuIT+s0uE5Igk30VS2UAcs5Ck6SDt+iTlUzYQBn/4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script type="text/javascript">
	var APP_URL = '<?php echo url('/') ?>';
	
	$(document).ready(function(){
            section_height = $('.xfloor-section-right').height();
            $(document).on('click' , '#close-btn1,#close-btn2,#close-btn3' , function(e){
                e.preventDefault();
                if($(window).width()<=991){
                    $('.right-part-tabs .tab-pane.active').removeClass('active');
                    $('.xfloor-tabs-box li a').removeClass('active');
                    $('.xfloor-section-right').css("height", "0");
                }
            });
            if($(window).width()<=991){
                $('.xfloor-tabs-box li a').click(function(){
                    if (window.matchMedia("(orientation: portrait)").matches) {
                        $('.xfloor-section-right').css("height", section_height);
                    } else {
                        var header_height = $('.top-header').height() + 72;
                        var menu_box_height = $(window).innerHeight() - header_height;
                        $('.xfloor-section-right').height(menu_box_height+'px');
                    }
                });
            }

            $(document).on('click','.nav-link', function(){
                if($(window).width() >= 992) {
                    $('.xfloor-section-right').css("height", '100%');
                    if(!$('.right-part-tabs .tab-pane.active').hasClass('active')) {
                        $('#community-tab').addClass('active');
                        $('#community').addClass('active');
                    }
                }
            });

            $(window).resize(function(){
                section_height = $('.xfloor-section-right').height();
                textarea_height = $('#note_textarea').height();
                $(document).on('click' , '#close-btn1,#close-btn2,#close-btn3' , function(e){
                    e.preventDefault();
                    if($(window).width()<=991){
                        close_panel();
                    }
                });
                if($(window).width()<=991){
                    $('.xfloor-tabs-box li a').click(function(){
                        if (window.matchMedia("(orientation: portrait)").matches) {
                            if($(window).width() > 767){
                                height = '350px';
                            } else {
                                height = '250px';
                            }
                            open_panel(height);
                        } else {
                            var header_height = $('.top-header').height() + 72;
                            var menu_box_height = $(window).innerHeight() - header_height;
                            $('.xfloor-section-right').height(menu_box_height+'px');
                        }
                    });

                }
                if($(window).width() >= 992) {
                    $('.xfloor-section-right').css("height", '100%');
                    if(!$('.right-part-tabs .tab-pane.active').hasClass('active')) {
                        $('#community-tab').addClass('active');
                        $('#community').addClass('active');
                        $('#community').addClass('show');
                    }
                }
                if($(window).width() < 992) {
                   setTimeout(function(){
                        var textarea_height = $('.xfloor-section-right').height()-70;
                        $('#note_textarea').css("height", textarea_height+"px");
                    }, 100);

                } else {
                    $('#note_textarea').css("height", "150px");
                }
                if($(window).width() <= 991 && $(window).width() >= 768) {
                    if($('.right-part-tabs .tab-pane.active').hasClass('active')) {
                        $('.xfloor-section-right').css("height", '350px');
                    }
                }
                if($(window).width() <= 767) {
                    if($('.right-part-tabs .tab-pane.active').hasClass('active')) {
                        $('.xfloor-section-right').css("height", '250px');
                    }
                }

                if (window.matchMedia("(orientation: landscape)").matches) {
                    // you are in LANDSCAPE mode
                    if($(window).width() < 992) {
                        if($('.xfloor-section-right').height() > 0) {
                            var header_height = $('.top-header').height() + 72;
                            var menu_box_height = $(window).innerHeight() - header_height;
                            $('.xfloor-section-right').height(menu_box_height+'px');
                        }
                        $('.xfloor-section .xfloor-section-center img').css("height","calc(100vh - 85px - 40px)");
                    }
                }
                else{
                  $('.xfloor-section .xfloor-section-center img').css("height","auto");
                }
            });
            if (window.matchMedia("(orientation: landscape)").matches) {
                // you are in LANDSCAPE mode
                if($(window).width() < 992) {
                    var header_height = $('.top-header').height() + 72;
                    var menu_box_height = $(window).innerHeight() - header_height;
                    $('.xfloor-section-right').height(menu_box_height+'px');
                     $('.xfloor-section .xfloor-section-center img').css("height","calc(100vh - 85px - 40px)");
                }
            }
            else{
                  $('.xfloor-section .xfloor-section-center img').css("height","auto");
            }

            if($(window).width() < 992) {
                $('#note_textarea').css("height", $('.xfloor-section-right').height()-70+"px");
            } else {
                $('#note_textarea').css("height", "150px");
            }
        });

        function close_panel() {
            $('.right-part-tabs .tab-pane.active').removeClass('active');
            $('.xfloor-tabs-box li a').removeClass('active');
            $('.xfloor-section-right').css("height", "0");
        }

        function open_panel(height) {
            $('.xfloor-section-right').css("height", height);
        }
        
        $('.new-link').click(function() {
            $('.box-card .in-container-content').removeClass('active-shadow');
            var did = $(this).attr('data-id');
            $('#'+did+' .in-container-content').addClass('active-shadow');
            $('html, body').animate({
                scrollTop: $("#"+did).offset().top - 70}, 1000);
            });
        
	</script>
</body>

</html>