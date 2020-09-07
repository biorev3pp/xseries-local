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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
    <!-- Simple Line Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" integrity="sha512-QKC1UZ/ZHNgFzVKSAhV5v5j73eeL9EEN289eKAEFaAjgAiobVAnVv/AGuPbXsKl1dNoel3kNr6PYnSiTzVVBCw==" crossorigin="anonymous" />    
    <!--    Material Icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Xseries-new-ui/css/style-min.css') }}">
    <style>
        .header{
            position:fixed; 
        }
        .footer {
            width: calc(100% - 280px);
            margin: 0 0 0 280px;
            padding: 0;
            border-top: none !important;
            background: #fff;
            position: fixed;
            bottom: 38px;
            height: 55px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.2);
            z-index: 999;
        }
        #tidio-chat-iframe{margin-bottom:70px !important; max-height:70% !important;}
        @media(max-width:991px){
            #tidio-chat-iframe{ max-height:100% !important; margin-bottom:0px !important}
            .footer {
                width: 100%;
                margin: 0;
                transition: 0.3s ease all;
            }
            .footer .close-arrow {
                position: absolute;
                left: 0;
                right: 0;
                margin: 0 auto;
                top: -19.3px;
                width: 24px;
                text-align: center;
                border: 1px solid #cacaca;
                border-bottom: none;
                background: #fff;
                height: 20px;
                font-size: 24px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;
            }
            .close-footer {
                height: 0px;
                bottom: 33px;
            }
        }
        @media(max-width:727px){
            .footer .footer-title h5{
                font-size:14px;
            }
            .footer .footer-title h6{
                font-size:12px;
            }
        }
    </style>
</head>
<body class="bg-white">
    @include('elements.header-footer')
    <div class="content">
        <div class="sidemenu">
            <div class="tabs-box h-100">
                <div class="community-header-bg h-100">
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
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body p-0">
                                            <div class="side-section-list"><ul class="list-group"><li>Lot Price<span class="badge-right">${{ number_format(Session::get('lot_price')) }}</span></li></ul></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card bg-transparent">
                                    <div class="card-header p-0" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link  new-link collapsed" data-id="homesdiv" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Home
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body p-0">
                                            <div class="side-section-list"><ul class="list-group"><li>Exterior Design<span class="badge-right"> ${{ (Session::has('home_price'))?number_format(Session::get('home_price')):number_format(Session::get('base_price')) }}</span></li></ul></div>
                                        </div>
                                    </div>
                                </div>
                                @if(isset($features[0]) && $features[0] !='')
                                <div class="card bg-transparent">
                                    <div class="card-header p-0" id="headingThree">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link  new-link collapsed" data-id="floorsdiv" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Floor
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                    <div class="card-body p-0">
                                    <div class="side-section-list"><ul class="list-group"><li>Floor Customization<span class="badge-right">${{ number_format(Session::get('floor_price')) }}</span></li></ul></div>
                                    </div>
                                    </div>
                                </div> 
                                @endif
                                @if (isset($optiondata) && (count($optiondata) >= 1))
                                <div class="card bg-transparent">
                                    <div class="card-header p-0" id="headingFour">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link  new-link collapsed" data-id="designsdiv" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        Design
                                        </button>
                                    </h5>
                                    </div>
                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                                    <div class="card-body p-0">
                                    <div class="side-section-list"><ul class="list-group"><li>Interior Design<span class="badge-right">
                                        <?php $designPrice = 0; ?>
                                        @if (isset($optiondata) && (count($optiondata) >= 1))
                                            @foreach ($optiondata as $key => $value)
                                                <?php $designPrice = $designPrice + number_format($value['price']); ?>
                                            @endforeach
                                        @endif 
                                        ${{$designPrice}}
                                        </span></li></ul></div>
                                    </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <button class="btn btn-link  new-link collapsed">Total</button>
                            <div class="side-section-list"><ul class="list-group"><li>Total Cost<span class="badge-right">${{ number_format(Session::get('total_price')) }}</span></li></ul></div>
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
                <h1> {{ $community->name }} <br><small> {{$community->location }} </small></h1>
                <p class="text-right">
                    <span class="cbox">
                        <span class="cbox-img">
                            <img style="border-radius:50%;height: 100%;width: 100%;object-fit: cover;" src="{{ asset('images/avatar.png') }}" alt="{{ $lot->community->community->name }}" width="64px">
                        </span>
                        <span class="cbox-content">
                            {{  $community->contact_person  }}<br>{{  $community->contact_email  }}<br>{{  $community->contact_number  }}
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
                        <form method="POST" class="d-inline-block" action="{{route('download_pdf')}}" accept-charset="UTF-8" id="pdf_form">
                        @csrf
                        <input name="action" type="hidden" value="pdf">
                        <button type="submit" class="btn btn-side" data-id="download" id="pdf_download"> <i class="fa fa-download"></i> PDF</button>
                        </form>
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
                                                <b>Community</b><br> {{ $community->name }} 
                                            </p>
                                            <p>
                                                <b>Location</b><br> {{ $community->location }} 
                                            </p>
                                            <p>
                                                <b>Description</b><br> {{ $community->description }} 
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>
                                                <b>Lot No</b><br> {{ $lot->alias }} 
                                            </p>
                                            <p>
                                                <b>Lot Price</b><br>${{ number_format($lot->price) }} 
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div id="lots_container" class="col-md-6 py-2 estimgbox">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-card" id="homesdiv">
                        <div class="in-container-title"> Home Details</div>
                        <div class="in-container-content">
                            <div class="row m-0">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>
                                                <b>Home</b><br> {{ $home->title }} @if($home_type) - {{$home_type->title}} @endif
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            
                                            <p>
                                                <b>Specifications</b>
                                            </p>
                                            <table class="table table-striped table-condensed m-0">
                                                <tr>
                                                    <th>Base Price</th><td>${{ number_format(($home_type)?$home_type->price:$home->price) }}</td>
                                                </tr>    
                                                <tr>
                                                    <th>Area</th><td> {{ number_format(($home_type)?$home_type->area:$home->area) }} sqft</td>
                                                </tr>
                                                <tr>
                                                    <th>Bedrooms</th><td> {{ ($home_type)?$home_type->bedroom:$home->bedroom }} </td>
                                                </tr>
                                                <tr>
                                                    <th>Bathrooms</th><td> {{ ($home_type)?$home_type->batrhoom:$home->bathroom }} </td>
                                                </tr>
                                                <tr>
                                                    <th>Floors</th><td> {{ ($home_type)?$home_type->floor:$home->floor }} </td>
                                                </tr>
                                                <tr>
                                                    <th>Garage</th><td> {{ ($home_type)?$home_type->garage:$home->garage }} </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <b>Features</b>
                                            </p>
                                            <table class="table table-striped m-0 table-condensed">
                                                @if(isset($myhome->color_scheme))
                                                    <tr>
                                                        <th>{{ $myhome->color_scheme->title }} </th>
                                                        <td>${{ number_format($myhome->color_scheme->price) }}
                                                    </tr>
                                                @endif
                                                @if(isset($home_upgrade_patches))
                                                    @foreach($home_upgrade_patches as $upgrade)
                                                        <tr>
                                                            <th>{{$upgrade->title}}</th>
                                                            <td> ${{ number_format($upgrade->price) }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 py-2 estimgbox">
                                    <img src="{{asset('uploads/homes/'.$myhome->img)}}" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-card" id="floorsdiv">
                        <div class="in-container-title"> Floor Details</div>
                        <div class="in-container-content">
                            <div class="row m-0">
                                <div class="col-12">
                                    <p>
                                        <b>Home</b><br> {{ $home->title }} 
                                    </p>
                                    @php $j=0; @endphp
                                    @forelse($home->floors as $floor)
                                    @php $j++; @endphp
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <table class="table table-striped table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th colspan="2">{{$floor->title}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @if(isset($features[0]) && $features[0] !='')
                                                @forelse($floor->features as $feature)
                                                    @if(in_array($feature->id,$features))
                                                    <tr>
                                                        <td>{{$feature->title}}</td>
                                                        <td>${{number_format($feature->price)}}</td>
                                                    </tr>
                                                    @endif
                                                @empty
                                                @endforelse
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-sm-6">
                                            <h3 style="text-align:center;">{{$floor->title}}</h3>
                                            <div id="floor_img_container" style="height:730px" class="cimgbx1 position-relative">
                                            
                                                    <img id="floor_base_img" src="{{asset('uploads/floors/'.$floor->image)}}" class="img-fluid position-absolute" style="height:100%;object-fit:contain;">
                                                
                                                @forelse($floor->features as $feature)
                                                    @if(in_array($feature->id,$features))
                                                    
                                                            <img src="{{asset('uploads/features/'.$feature->image)}}" class="img-fluid position-absolute" style="height:100%;object-fit:contain;">
                                                         
                                                    @endif
                                                @empty
                                                @endforelse
                                                
                                            </div>
                                        </div>
                                    </div> 
                                    @empty
                                        <p class="m-3 text-danger "> No features has been modified by you. You will get default features.</p>                           
                                    @endforelse  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
        <div class="footer">
            <div class="row h-100 justify-content-between align-items-center">
                <div class="footer-btns pbtns">
                    <a class="pbs-btn" href="{{route('xfloor',['community_slug'=>$community->slug,'home_slug'=>$home->slug,'home_type_slug'=>($home_type)?$home_type->slug:''])}}">previous</a>
                </div> 
                <div class="row footer-title" style="padding:10px 0 !important;">
                    <h5 class="m-0 pr-2 border-right">
                        <span class="material-icons">business</span>
                        {{$community->name}}</h5>
                    <h6 class="m-0 pl-2">
                        <span class="material-icons">home</span>
                        {{$home->title}} @if($home_type) - {{$home_type->title}} @endif                  
                    </h6>
                </div>           
                <div class="footer-btns fns-btn">
                    <a href="{{route('user-estimates')}}" id="continue_to_home" data-lid="" data-hid="" data-link="">view estimates</a>
                </div>
            </div>
            <div class="close-arrow">
                <span class="material-icons">
                expand_more
                </span>
            </div>
        </div>
    </div>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>

    <script type="text/javascript">
    $("#pb-elevation-type, #pb-elevation, #pb-community, #pb-lot, #pb-color, #pb-floor, #pb-estimate").addClass('active complete');
    $(".progressbar li.complete span").html("done");
	var APP_URL = '<?php echo url('/') ?>';
    var ip_address, country, city, state;
    $.ajax({
        url: APP_URL+"/api/get-all-lots",
        type: 'post',
        dataType : "json",
        data:{pid: <?= $lot->community->id?>},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(response){ 
            var response;
            $.each(response, function(i, item) {
                $("#lots_container svg").find("g#"+item.groupID+' text.st1.st2').text(item.alias);
                $("#lots_container svg").find("g#"+item.groupID+' text.st4.st20').text(item.alias);
                $("#lots_container svg").find("g#"+item.groupID+' path').css({
                    "fill" : "rgb(119, 120, 123)",
                    "stroke" : "#fff"
                });
                $("#lots_container svg").find("g#"+item.groupID+' polygon').css({
                    "fill" : "rgb(119, 120, 123)",
                    "stroke" : "#fff"
                });
            });
        },
    });
    <?php if(Session::has('lot_group')): ?>
        var lid = '<?= Session::get('lot_group') ?>';
        $('#'+lid+' path').addClass('fill-blue');
        $('#'+lid+' polygon').addClass('fill-blue');
    <?php endif; ?>
    $('.btn-side').click(function() {
        toastr.success('We are preparing your estimate.');
    });
    $('.new-link').click(function() {
        $('.box-card .in-container-content').removeClass('active-shadow');
        var did = $(this).attr('data-id');
        $('#'+did+' .in-container-content').addClass('active-shadow');
        $('html, body').animate({
            scrollTop: $("#"+did).offset().top - 70}, 1000);
    });

    window.onload = function() {
        var img = document.getElementById('floor_base_img');
        var height = img.clientHeight;
        // var design_img = document.getElementById('design_base_img');
        // var design_height = design_img.clientHeight;
        // $("#design_img_container").height(design_height);
        var lots_img = $('#Layer_1 image');
        var lots_height = lots_img.clientHeight;
        $("#lots_container").height(lots_height);
    }
    $(".footer .close-arrow").click(function(){
        $('.footer .footer-btns').toggleClass('hide-footer-btns');
        $(".footer").toggleClass('close-footer');
        $('.footer .close-arrow span').toggleClass('rotate-arrow');
    });
    window.onload = function(){
        $.get("https://ipinfo.io?token=34980ab4231481", function(response) {
            ip_address = response.ip;
            country = response.country;
            state = response.region;
            city = response.city;
            $.ajax({
                type: 'POST',
                url: 'api/store/analytics',
                headers: 
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {'ip':ip_address,'country':country,'state':state,'city':city},
        
                success: function(result){
                    //Upgrade Analytics
                    $.ajax({
                        type: 'POST',
                        url: 'api/store/upgrade/analytics',
                        headers: 
                        {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {'ip':ip_address,'country':country,'state':state,'city':city},
                    })
                    //Features Analytics
                    $.ajax({
                        type: 'POST',
                        url: 'api/store/floor/features/analytics',
                        headers: 
                        {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {'ip':ip_address,'country':country,'state':state,'city':city},
                    })
                }
            })
        }, "jsonp")
    };
    </script>
    <script src="//code.tidio.co/nd3ei3sfxvutpyoyimav0ivh6gboahhy.js" async></script>
</body>

</html>