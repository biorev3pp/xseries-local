<?php 
    $url_array = explode('/', Request::url());
    $url = end($url_array);
?>
<!DOCTYPE html>
<html>
@include('includes.multi-community-head')
<body>
    <div class="wrapper">
        <!--Topbar Begin-->
        @include('elements.header-footer')
        <!-- Topbar End -->        
        <div id="lower-main-x-contain">
            <div class="row">
                <div id="x-content-col-left">
                    <div class="property-left-contain-main">
                      <form id="form-filter" class="h-100">
                        @if($url == "elevations")
                        <input type="hidden" name="community" value="{{$_GET['community']}}">
                        @endif
                        <div class="propperty-filter-l-main">
                                <!--Filters Section Begin-->
                                <div class="filter-form-main">
                                    <div class="row">
                                        @if($url != "elevations")
                                        <div class="col-8 pl-1 pr-1">
                                            <div class="select-fil-d-main">
                                                <select type="button" class="select-filter-input js-example-basic-single" name="value" 
                                                onchange="$('#form-filter').submit()" value="(isset($_GET['value'])?$_GET['value']:''">
                                                    <option></option>
                                                    @foreach($cities as $cityId => $city)
                                                        @if(isset($_GET['value']) && ($_GET['value'] == $cityId))
                                                        <option selected="selected" value="{{ $cityId }}">{{ $city }}</option>
                                                        @else
                                                        <option value="{{ $cityId }}">{{ $city }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>                                        
                                            </div>                                       
                                        </div>
                                        @endif
                                        <div class="filter-form-col4">
                                            <div class="select-fil-d-main dropdown">
                                                <button type="button" class="select-filter-input dropdown-toggle" data-toggle="dropdown">
                                                    Price
                                                    <span class="material-icons" style="top:0;">
                                                        arrow_drop_up
                                                    </span>
                                                    <span class="material-icons">
                                                        arrow_drop_down
                                                    </span>
                                                    <span class="float-right filter-button-badge price-badge"></span>
                                                </button>                                                
                                                <div class="dropdown-menu">
                                                    <h6 class="border-bottom" style="padding-bottom:5px;">Price Range</h6>
                                                    <div class="pl-2 pr-2">
                                                        <div class="value-box price">
                                                            <span class="start-value"></span>
                                                            <span>-</span>
                                                            <span class="end-value"></span>
                                                        </div>
                                                        <input type="text" class="js-range-slider price-filter" value=""
                                                        name="price_range"/>
                                                    </div>
                                                </div>                                          
                                            </div>                                       
                                        </div>
                                        <div class="filter-form-col4">
                                            <div class="select-fil-d-main dropdown">
                                                <button type="button" class="select-filter-input dropdown-toggle" data-toggle="dropdown">
                                                    Area
                                                    <span class="material-icons" style="top:0;">
                                                        arrow_drop_up
                                                    </span>
                                                    <span class="material-icons">
                                                        arrow_drop_down
                                                    </span>
                                                    <span class="float-right filter-button-badge area-badge"></span>
                                                </button>                                                
                                                <div class="dropdown-menu">
                                                    <h6 class="border-bottom" style="padding-bottom:5px;">Area Range</h6>
                                                    <div class="value-box area">
                                                        <span class="start-value"></span>
                                                        <span>-</span>
                                                        <span class="end-value"></span>
                                                    </div>
                                                    <input type="text" class="js-range-slider area-filter" value="" name="feet"/>
                                                </div>                                          
                                            </div>
                                        </div>
                                          <div class="filter-form-col4">
                                            <div class="select-fil-d-main dropdown">
                                                <button type="button" class="select-filter-input dropdown-toggle" data-toggle="dropdown">
                                                    Bedroom
                                                    <span class="material-icons" style="top:0;">
                                                        arrow_drop_up
                                                    </span>
                                                    <span class="material-icons">
                                                        arrow_drop_down
                                                    </span>
                                                    <span class="float-right filter-button-badge bed-badge"></span>
                                                </button>                                                
                                                <div class="dropdown-menu">
                                                    <h6 class="border-bottom" style="padding-bottom:5px;">Bedroom Range</h6>
                                                    <div class="value-box bed">
                                                        <span class="start-value"></span>
                                                        <span>-</span>
                                                        <span class="end-value"></span>
                                                    </div>
                                                    <input type="text" class="js-range-slider bed-filter" value="" name="bedroom"/>
                                                </div>                                          
                                            </div>
                                        </div>
                                        <div class="filter-form-col4">
                                            <div class="select-fil-d-main dropdown">
                                                <button type="button" class="select-filter-input dropdown-toggle" data-toggle="dropdown">
                                                    Bathroom
                                                    <span class="material-icons" style="top:0;">
                                                        arrow_drop_up
                                                    </span>
                                                    <span class="material-icons">
                                                        arrow_drop_down
                                                    </span>
                                                    <span class="float-right filter-button-badge bath-badge"></span>
                                                </button>                                                
                                                <div class="dropdown-menu">
                                                    <h6 class="border-bottom" style="padding-bottom:5px;">Bathroom Range</h6>
                                                    <div class="value-box bath">
                                                        <span class="start-value"></span>
                                                        <span>-</span>
                                                        <span class="end-value"></span>
                                                    </div>
                                                    <input type="text" class="js-range-slider bath-filter" value="" name="bathroom"/>
                                                </div>                                          
                                            </div>
                                        </div>
                                        @if($url == "elevations")
                                        <div class="filter-form-col4">
                                            <div class="select-fil-d-main dropdown">
                                                <button type="button" class="select-filter-input dropdown-toggle" data-toggle="dropdown">
                                                    Garage
                                                    <span class="material-icons" style="top:0;">
                                                        arrow_drop_up
                                                    </span>
                                                    <span class="material-icons">
                                                        arrow_drop_down
                                                    </span>
                                                    <span class="float-right filter-button-badge garage-badge"></span>
                                                </button>                                                
                                                <div class="dropdown-menu">
                                                    <h6 class="border-bottom" style="padding-bottom:5px;">Garage Range</h6>
                                                    <div class="value-box garage">
                                                        <span class="start-value"></span>
                                                        <span>-</span>
                                                        <span class="end-value"></span>
                                                    </div>
                                                    <input type="text" class="js-range-slider garage-filter" value="" name="garage"/>
                                                </div>                                          
                                            </div>
                                        </div>
                                        <div class="filter-form-col4">
                                            <div class="select-fil-d-main dropdown">
                                                <button type="button" class="select-filter-input dropdown-toggle" data-toggle="dropdown">
                                                    Floor
                                                    <span class="material-icons" style="top:0;">
                                                        arrow_drop_up
                                                    </span>
                                                    <span class="material-icons">
                                                        arrow_drop_down
                                                    </span>
                                                    <span class="float-right filter-button-badge floor-badge"></span>
                                                </button>                                                
                                                <div class="dropdown-menu">
                                                    <h6 class="border-bottom" style="padding-bottom:5px;">Floor Range</h6>
                                                    <div class="value-box floor">
                                                        <span class="start-value"></span>
                                                        <span>-</span>
                                                        <span class="end-value"></span>
                                                    </div>
                                                    <input type="text" class="js-range-slider floor-filter" value="" name="floor"/>
                                                </div>                                          
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="filter-bottom-main">
                                    <div class="filter-button-left">
                                        @if($url == "elevations")
                                        <a href="/community?search=map">
                                            <span class="material-icons">
                                            chevron_left
                                            </span> 
                                            Back To Communities
                                        </a>
                                        @else
                                        <a href="/">
                                            <span class="material-icons">
                                            chevron_left
                                            </span> 
                                            Back To Search
                                        </a>
                                        @endif
                                    </div>
                                    <div class="filter-button-right pb-2">
                                        <button class="reset-button" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="37.304" height="26" viewBox="0 0 37.304 26">
                                                <g id="Group_106" data-name="Group 106" transform="translate(-695 -162)">
                                                    <rect id="Rectangle_17" data-name="Rectangle 17" width="37.304" height="26" transform="translate(695 162)" fill="none" />
                                                    <g id="filter" transform="translate(700 167)">
                                                        <g id="filter-2" data-name="filter">
                                                            <path id="Path_4" data-name="Path 4" d="M9.333,92.5h5.333V89.833H9.333ZM0,76.5v2.667H24V76.5Zm4,9.333H20V83.167H4Z" transform="translate(0 -76.5)" fill="#fff" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg> Reset Filters
                                        </button>
                                    </div>
                                </div>
                                <!--Filters Section End-->
                        </div>
                        <div id="left-property-list-main">
                            <div class="row">
                                <div id="left-property-list-inner">
                                    <div id="left-property-list-inner2">
                                        <!--Sorting Section Begin-->
                                        <div id="property-list-title-main">
                                            <div class="row">
                                                <div class="property-list-title-col-8">
                                                    <h1 class="border-bottom">{{ $ccount }} Elevation Designs sorted by</h1>
                                                </div>
                                                <div class="property-list-title-col-4">
                                                    <select name="sortby" id="sortby" class="form-control custom-select2" onchange="$('#form-filter').submit()">
                                                        <option <?= (isset($_GET['sortby']) && ($_GET['sortby'] == 'location'))?'selected="selected"':'' ?> value="location">Location</option>
                                                        <option <?= (isset($_GET['sortby']) && ($_GET['sortby'] == 'a_z'))?'selected="selected"':'' ?> value="a_z">Name A-Z</option>
                                                        <option <?= (isset($_GET['sortby']) && ($_GET['sortby'] == 'z_a'))?'selected="selected"':'' ?> value="z_a">Name Z-A</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Sorting Section End-->
                                        <div class="property-list-inner-main">
                                            <!--Property Wrapper Begin-->
                                            @if($ccount > 0)
                                            @foreach($communities as $key => $home)
                                            <input type="hidden" id="homeinfo{{ $home->id}}" data-title="{{strtoupper($home->title)}}" data-price="{{env('CURRENCY').number_format($home->price)}}" data-bed="{{$home->bedroom}}" data-bath="{{$home->bathroom}}" data-area="{{number_format($home->area)}}"   data-image="{{$home->img}}" data-garage="{{$home->garage}}"data-floor="{{$home->floor}}" >
                                            <div class="property-list-box">
                                                <div class="row">
                                                    <div class="property-list-box-left">
                                                        @if($url == "elevations")
                                                        <div class="property-left-label">{{$community->name}}</div>
                                                        @endif
                                                        <div class="property-list-box-img">
                                                            <img src="{{asset('uploads/homes/'.$home->img)}}" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="property-list-box-right">
                                                        <div class="property-list-box-title-main">
                                                            <div class="property-list-box-title">
                                                                <h3>{{ $home->title}}</h3>
                                                            </div>
                                                            <div class="property-list-compare">
                                                                <label class="checkbox-contain"> 
                                                                    <input type="checkbox" value="{{$home->id}}" id="home_compare{{$home->id}}" class="ccheckbox" name="compare[]">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <span class="compare">Compare</span>
                                                            </div>
                                                        </div>

                                                        <div class="property-list-box-desc">
                                                          {{$home->specifications}}
                                                        </div>
                                                        <div class="property-list-box-feature-main">
                                                            <div class="row">
                                                                <div class="property-list-feature-col-6">
                                                                    <div class="property-list-feature-text">
                                                                        <span class="material-icons">
                                                                        home
                                                                        </span>
                                                                        <h5>Price</h5>
                                                                        ${{env('CURRENCY').number_format($home->price)}}
                                                                    </div>
                                                                </div>
                                                                <div class="property-list-feature-col-6">
                                                                    <div class="property-list-feature-text">
                                                                        <span class="material-icons">
                                                                        crop_free
                                                                        </span>               
                                                                        <h5>Area</h5>
                                                                        {{ number_format($home->area) }} sqft
                                                                    </div>
                                                                </div>
                                                                <div class="property-list-feature-col-6">
                                                                    <div class="property-list-feature-text">
                                                                        <span class="material-icons">
                                                                        king_bed
                                                                        </span>
                                                                        <h5>Beds</h5>
                                                                        {{ $home->bedroom }}
                                                                    </div>
                                                                </div>
                                                                <div class="property-list-feature-col-6">
                                                                    <div class="property-list-feature-text">
                                                                        <span class="material-icons">
                                                                        bathtub
                                                                        </span>
                                                                        <h5>Bath</h5>
                                                                        {{ $home->bathroom }}
                                                                    </div>
                                                                </div>
                                                                <div class="property-list-feature-col-6">
                                                                    <div class="property-list-feature-text">
                                                                        <span class="material-icons">
                                                                        store
                                                                        </span>
                                                                        <h5>Garage</h5>
                                                                        {{ $home->garage }}
                                                                    </div>
                                                                </div>
                                                                <div class="property-list-feature-col-6">
                                                                    <div class="property-list-feature-text">
                                                                        <span class="material-icons">
                                                                        location_city
                                                                        </span>            
                                                                        <h5>Floors</h5>
                                                                        {{ $home->floor }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="property-list-tabs-main elevations" style="margin-top:1.9px !important;">
                                                            <!-- Nav tabs -->
                                                            <ul class="nav nav-tabs">
                                                                <li class="nav-item">
                                                                    <a class="nav-link" data-toggle="modal" data-target="#gallery{{$home->id}}" href="javascript:void(0)">Gallery</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" data-toggle="modal" data-target="#floor{{$home->id}}" href="javascript:void(0)">Floor</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="javascript:void(0)" data-toggle="modal" data-target="#types{{$home->id}}">Types</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal: gallery -->
                                            <div class="modal fade right sliding-modal gallery" id="gallery{{$home->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true" data-backdrop="false">
                                            <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
                                                <div class="modal-content">
                                                <!--Header-->
                                                <div data-toggle="collapse" data-target="#floor-tab-1" class="close-tab" data-dismiss="modal" aria-label="Close">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
                                                            <defs>
                                                                <style>
                                                                    .cls-1 {
                                                                        fill: #3a3b3d;
                                                                    }
                                                                    .cls-2 {
                                                                        fill: #fff;
                                                                    }
                                                                </style>
                                                            </defs>
                                                            <g id="Group_121" data-name="Group 121" transform="translate(-1537 -127)">
                                                                <circle id="Ellipse_1" data-name="Ellipse 1" class="cls-1" cx="24" cy="24" r="24" transform="translate(1537 127)" />
                                                                <path id="close" class="cls-2" d="M10.217,8.771l6.725-6.725A1.119,1.119,0,0,0,15.36.464L8.635,7.189,1.91.464A1.119,1.119,0,0,0,.328,2.046L7.053,8.771.328,15.5A1.119,1.119,0,1,0,1.91,17.078l6.725-6.725,6.725,6.725A1.119,1.119,0,0,0,16.942,15.5Zm0,0" transform="translate(1552 141.864)" />
                                                            </g>
                                                        </svg>
                                                    </div>
                                                <!--Body-->
                                                <div class="modal-body">
                                                    <div id="aniimated-thumbnials" class="slider-for">
                                                        @foreach( explode(',', $home->gallery) as  $key => $gallery)
                                                        <a href="{{asset('uploads/homes/'.$gallery)}}">
                                                            <img src="{{asset('uploads/homes/'.$gallery)}}" />
                                                        </a>
                                                        @endforeach
                                                    </div>
                                                    <div class="slider-nav">
                                                        @foreach( explode(',', $home->gallery) as  $key => $gallery)
                                                        <div class="item-slick">
                                                            <img src="{{asset('uploads/homes/'.$gallery)}}" alt="Alt">
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                            <!-- Modal: gallery end -->
                                            <!-- Modal: floor -->
                                            <div class="modal fade right sliding-modal" id="floor{{$home->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true" data-backdrop="false">
                                            <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
                                                <div class="modal-content">
                                                <!--Header-->
                                                <div data-toggle="collapse" data-target="#floor-tab-1" class="close-tab" data-dismiss="modal" aria-label="Close">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
                                                            <defs>
                                                                <style>
                                                                    .cls-1 {
                                                                        fill: #3a3b3d;
                                                                    }
                                                                    .cls-2 {
                                                                        fill: #fff;
                                                                    }
                                                                </style>
                                                            </defs>
                                                            <g id="Group_121" data-name="Group 121" transform="translate(-1537 -127)">
                                                                <circle id="Ellipse_1" data-name="Ellipse 1" class="cls-1" cx="24" cy="24" r="24" transform="translate(1537 127)" />
                                                                <path id="close" class="cls-2" d="M10.217,8.771l6.725-6.725A1.119,1.119,0,0,0,15.36.464L8.635,7.189,1.91.464A1.119,1.119,0,0,0,.328,2.046L7.053,8.771.328,15.5A1.119,1.119,0,1,0,1.91,17.078l6.725-6.725,6.725,6.725A1.119,1.119,0,0,0,16.942,15.5Zm0,0" transform="translate(1552 141.864)" />
                                                            </g>
                                                        </svg>
                                                    </div>
                                                <!--Body-->
                                                <div class="modal-body">
                                                    <div class="property-floor-map-main">
                                                        <!-- Nav tabs -->
                                                        <ul class="nav nav-tabs pt-3">
                                                            @foreach($home->floors as $key => $floor_data)
                                                            @if($key == 0)
                                                            <li class="nav-item">
                                                                <a class="nav-link active" data-toggle="tab" href="#floor_plan{{$floor_data->id}}">{{$floor_data->title}}</a>
                                                            </li>
                                                            @else
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-toggle="tab" href="#floor_plan{{$floor_data->id}}">{{$floor_data->title}}</a>
                                                            </li>
                                                            @endif
                                                            @endforeach
                                                        </ul>
                                                        <!-- Tab panes -->
                                                        <div class="tab-content">
                                                            @foreach($home->floors as $key => $floor_data)
                                                            @if($key == 0)
                                                            <div class="tab-pane active" id="floor_plan{{$floor_data->id}}">
                                                                <div class="floor-map-img-main">
                                                                    <a href="/uploads/floors/{{$floor_data->image}}">
                                                                        <img src="/uploads/floors/{{$floor_data->image}}" alt="">
                                                                        <div class="middle">
                                                                            <div class="text">View</div>
                                                                        </div>
                                                                    </a>                                                                
                                                                </div>
                                                            </div>
                                                            @else
                                                            <div class="tab-pane" id="floor_plan{{$floor_data->id}}">
                                                                <div class="floor-map-img-main">
                                                                    <a href="/uploads/floors/{{$floor_data->image}}">
                                                                        <img src="/uploads/floors/{{$floor_data->image}}" alt="">
                                                                        <div class="middle">
                                                                            <div class="text">View</div>
                                                                        </div>
                                                                    </a>                                                                
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>

                                                </div>
                                            </div>
                                            </div>
                                            <!-- Modal: floor end -->
                                            <!-- Modal: Types -->
                                            <div class="modal fade right sliding-modal types" id="types{{$home->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true" data-backdrop="false">
                                            <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
                                                <div class="modal-content">
                                                    <!--Header-->
                                                    <div data-toggle="collapse" data-target="#floor-tab-1" class="close-tab" data-dismiss="modal" aria-label="Close">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
                                                                <defs>
                                                                    <style>
                                                                        .cls-1 {
                                                                            fill: #3a3b3d;
                                                                        }
                                                                        .cls-2 {
                                                                            fill: #fff;
                                                                        }
                                                                    </style>
                                                                </defs>
                                                                <g id="Group_121" data-name="Group 121" transform="translate(-1537 -127)">
                                                                    <circle id="Ellipse_1" data-name="Ellipse 1" class="cls-1" cx="24" cy="24" r="24" transform="translate(1537 127)" />
                                                                    <path id="close" class="cls-2" d="M10.217,8.771l6.725-6.725A1.119,1.119,0,0,0,15.36.464L8.635,7.189,1.91.464A1.119,1.119,0,0,0,.328,2.046L7.053,8.771.328,15.5A1.119,1.119,0,1,0,1.91,17.078l6.725-6.725,6.725,6.725A1.119,1.119,0,0,0,16.942,15.5Zm0,0" transform="translate(1552 141.864)" />
                                                                </g>
                                                            </svg>
                                                        </div>
                                                    <!--Body-->
                                                    <div class="modal-body">
                                                        <div class="property-types-list-main">
                                                        <div class="property-right-type-box">
                                                                <div class="row">
                                                                    <div class="property-right-type-left">
                                                                        <div class="property-right-type-img">
                                                                            <img src="{{asset('uploads/homes/'.$home->img)}}" alt="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="property-right-type-right">
                                                                        <h3>{{$home->title}}</h3>
                                                                        <div class="property-right-type-price">${{env('CURRENCY').number_format($home->price)}}</div>
                                                                        <div class="property-right-type-details">
                                                                            <div class="row">
                                                                                <div class="property-right-detail-col">
                                                                                    <h5>Area</h5>
                                                                                    {{number_format($home->area)}} sqft
                                                                                </div>
                                                                                <div class="property-right-detail-col">
                                                                                    <h5>Beds</h5>
                                                                                    {{$home->bedroom}}
                                                                                </div>
                                                                                <div class="property-right-detail-col">
                                                                                    <h5>Bath</h5>
                                                                                    {{$home->bathroom}}
                                                                                </div>
                                                                                <div class="property-right-detail-col">
                                                                                    <h5>garage</h5>
                                                                                    {{$home->garage}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="property-right-type-button">
                                                                            @if($url == "elevations")
                                                                            <a href="{{ url('/plats/'.$community->slug.'/'.$home->id.'/'.$home->id) }}" class="green-button">
                                                                                <span class="material-icons">
                                                                                house
                                                                                </span>
                                                                                Site Plan
                                                                            </a>
                                                                            @else
                                                                            <a href="{{route('elevation-communities',['id' => $home->slug])}}" class="green-button">
                                                                                <span class="material-icons">
                                                                                house
                                                                                </span>
                                                                                Select Community
                                                                            </a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @foreach($home->home_types as $home_type)
                                                            <div class="property-right-type-box">
                                                                <div class="row">
                                                                    <div class="property-right-type-left">
                                                                        <div class="property-right-type-img">
                                                                            <img src="{{asset('uploads/homes/'.$home_type->img)}}" alt="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="property-right-type-right">
                                                                        <h3>{{$home_type->title}}</h3>
                                                                        <div class="property-right-type-price">${{env('CURRENCY').number_format($home_type->price)}}</div>
                                                                        <div class="property-right-type-details">
                                                                            <div class="row">
                                                                                <div class="property-right-detail-col">
                                                                                    <h5>Area</h5>
                                                                                    {{number_format($home_type->area)}} sqft
                                                                                </div>
                                                                                <div class="property-right-detail-col">
                                                                                    <h5>Beds</h5>
                                                                                    {{$home_type->bedroom}}
                                                                                </div>
                                                                                <div class="property-right-detail-col">
                                                                                    <h5>Bath</h5>
                                                                                    {{$home_type->bathroom}}
                                                                                </div>
                                                                                <div class="property-right-detail-col">
                                                                                    <h5>garage</h5>
                                                                                    {{$home_type->garage}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="property-right-type-button">
                                                                            @if($url == "elevations")
                                                                            <a href="{{ url('/plats/'.$community->slug.'/'.$home->id.'/'.$home_type->id) }}" class="green-button">
                                                                                <span class="material-icons">
                                                                                house
                                                                                </span>
                                                                                Site Plan
                                                                            </a>
                                                                            @else
                                                                            <a href="{{route('elevation-communities',['id' => $home->slug, 'type_id' => $home_type->slug])}}" class="green-button">
                                                                                <span class="material-icons">
                                                                                house
                                                                                </span>
                                                                                Select Community
                                                                            </a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <!-- Modal: Types End -->
                                            @endforeach
                                            @endif
                                            <!--Property Wrapper End-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </form>
                    </div>
                </div>
                <!--Map Section Begin-->
                <div id="x-content-col-right">
                    <div class="property-right-contain-main">
                        <div class="property-right-map">
                            <div id="map-canvas" class="fullmap"></div>
                        </div>
                    </div>
                </div>
                <!--Map Section End-->
                <!-- Compare Modal -->
                <div class="modal fade" id="compreModelCenter" tabindex="-1" role="dialog" aria-labelledby="compreModelCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="compreModelLongTitle">Communities Comparison</h5>
                            <div data-toggle="collapse" data-target="#floor-tab-1" class="close-tab" data-dismiss="modal" aria-label="Close">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
                                    <defs>
                                        <style>
                                            .cls-1 {
                                                fill: #3a3b3d;
                                            }
                                            .cls-2 {
                                                fill: #fff;
                                            }
                                        </style>
                                    </defs>
                                    <g id="Group_121" data-name="Group 121" transform="translate(-1537 -127)">
                                        <circle id="Ellipse_1" data-name="Ellipse 1" class="cls-1" cx="24" cy="24" r="24" transform="translate(1537 127)" />
                                        <path id="close" class="cls-2" d="M10.217,8.771l6.725-6.725A1.119,1.119,0,0,0,15.36.464L8.635,7.189,1.91.464A1.119,1.119,0,0,0,.328,2.046L7.053,8.771.328,15.5A1.119,1.119,0,1,0,1.91,17.078l6.725-6.725,6.725,6.725A1.119,1.119,0,0,0,16.942,15.5Zm0,0" transform="translate(1552 141.864)" />
                                    </g>
                                </svg>
                            </div>
                        </div>
                            <div class="modal-body  p-0" id="comparelist"></div>
                        </div>
                    </div>
                </div>
                <!-- Compare Modal End -->
            </div>
            <div id="myNav" class="overlay">
              <!-- Button to close the overlay navigation -->
                <div class="filter-head">
                    <div class="row">
                        <div class="col-10">
                            <h3>Filters</h3>
                        </div>
                        <div class="col-2">
                            <div data-toggle="collapse" class="close-tab closebtn" onclick="closeNav()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
                                    <defs>
                                        <style>
                                            .cls-1 {
                                                fill: #3a3b3d;
                                            }
                                            .cls-2 {
                                                fill: #fff;
                                            }
                                        </style>
                                    </defs>
                                    <g id="Group_121" data-name="Group 121" transform="translate(-1537 -127)">
                                        <circle id="Ellipse_1" data-name="Ellipse 1" class="cls-1" cx="24" cy="24" r="24" transform="translate(1537 127)" />
                                        <path id="close" class="cls-2" d="M10.217,8.771l6.725-6.725A1.119,1.119,0,0,0,15.36.464L8.635,7.189,1.91.464A1.119,1.119,0,0,0,.328,2.046L7.053,8.771.328,15.5A1.119,1.119,0,1,0,1.91,17.078l6.725-6.725,6.725,6.725A1.119,1.119,0,0,0,16.942,15.5Zm0,0" transform="translate(1552 141.864)" />
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="propperty-filter-l-main">   
                    <form id="mobile-filter">
                        @if($url == "elevations")
                        <input type="hidden" name="community" value="{{$_GET['community']}}">
                        @endif
                        <!--Filters Section Begin-->
                        <div class="filter-form-main">
                            <!--# vue filters begin -->
                            <div class="row" id="app-responsive">
                            @if($url != "elevations")
                            <div class="col-12">
                                <div class="select-fil-d-main">
                                    <select type="button" class="select-filter-input js-example-basic-single" name="value" 
                                    onchange="$('#form-filter').submit()" value="(isset($_GET['value'])?$_GET['value']:''">
                                        <option></option>
                                        @foreach($cities as $cityId => $city)
                                            @if(isset($_GET['value']) && ($_GET['value'] == $cityId))
                                            <option selected="selected" value="{{ $cityId }}">{{ $city }}</option>
                                            @else
                                            <option value="{{ $cityId }}">{{ $city }}</option>
                                            @endif
                                        @endforeach
                                    </select>                                        
                                </div>                                       
                            </div>
                            @endif
                            <div class="col-12">
                                <div class="select-fil-d-main dropdown">
                                    <button type="button" class="select-filter-input dropdown-toggle" data-toggle="dropdown">
                                        Price
                                        <span class="material-icons" style="top:0;">
                                        arrow_drop_up
                                        </span>
                                        <span class="material-icons">
                                        arrow_drop_down
                                        </span>
                                        <span class="float-right filter-button-badge price-badge"></span>
                                    </button>                                                
                                    <div class="dropdown-menu">
                                        <h6 class="border-bottom" style="padding-bottom:5px;">Price Range</h6>
                                        <div class="pl-2 pr-2">
                                            <div class="value-box price">
                                                <span class="start-value"></span>
                                                <span>-</span>
                                                <span class="end-value"></span>
                                            </div>
                                            <input type="text" class="js-range-slider price-filter" value=""
                                            name="price_range"/>
                                        </div>
                                    </div>                                          
                                </div>                                       
                            </div>
                            <div class="col-12">
                                <div class="select-fil-d-main dropdown">
                                    <button type="button" class="select-filter-input dropdown-toggle" data-toggle="dropdown">
                                        Area
                                        <span class="material-icons" style="top:0;">
                                        arrow_drop_up
                                        </span>
                                        <span class="material-icons">
                                        arrow_drop_down
                                        </span>
                                        <span class="float-right filter-button-badge area-badge"></span>
                                    </button>                                                
                                    <div class="dropdown-menu">
                                        <h6 class="border-bottom" style="padding-bottom:5px;">Area Range</h6>
                                        <div class="value-box area">
                                            <span class="start-value"></span>
                                            <span>-</span>
                                            <span class="end-value"></span>
                                        </div>
                                        <input type="text" class="js-range-slider area-filter" value="" name="feet"/>
                                    </div>                                          
                                </div>
                            </div>
                                <div class="col-12">
                                <div class="select-fil-d-main dropdown">
                                    <button type="button" class="select-filter-input dropdown-toggle" data-toggle="dropdown">
                                        Bedroom
                                        <span class="material-icons" style="top:0;">
                                        arrow_drop_up
                                        </span>
                                        <span class="material-icons">
                                        arrow_drop_down
                                        </span>
                                        <span class="float-right filter-button-badge bed-badge"></span>
                                    </button>                                                
                                    <div class="dropdown-menu">
                                        <h6 class="border-bottom" style="padding-bottom:5px;">Bedroom Range</h6>
                                        <div class="value-box bed">
                                            <span class="start-value"></span>
                                            <span>-</span>
                                            <span class="end-value"></span>
                                        </div>
                                        <input type="text" class="js-range-slider bed-filter" value="" name="bedroom"/>
                                    </div>                                          
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="select-fil-d-main dropdown">
                                    <button type="button" class="select-filter-input dropdown-toggle" data-toggle="dropdown">
                                        Bathroom
                                        <span class="material-icons" style="top:0;">
                                        arrow_drop_up
                                        </span>
                                        <span class="material-icons">
                                        arrow_drop_down
                                        </span>
                                        <span class="float-right filter-button-badge bath-badge"></span>
                                    </button>                                                
                                    <div class="dropdown-menu">
                                        <h6 class="border-bottom" style="padding-bottom:5px;">Bathroom Range</h6>
                                        <div class="value-box bath">
                                            <span class="start-value"></span>
                                            <span>-</span>
                                            <span class="end-value"></span>
                                        </div>
                                        <input type="text" class="js-range-slider bath-filter" value="" name="bathroom"/>
                                    </div>                                          
                                </div>
                            </div>
                            @if($url == "elevations")
                            <div class="col-12">
                                <div class="select-fil-d-main dropdown">
                                    <button type="button" class="select-filter-input dropdown-toggle" data-toggle="dropdown">
                                        Garage
                                        <span class="material-icons" style="top:0;">
                                        arrow_drop_up
                                        </span>
                                        <span class="material-icons">
                                        arrow_drop_down
                                        </span>
                                        <span class="float-right filter-button-badge garage-badge"></span>
                                    </button>                                                
                                    <div class="dropdown-menu">
                                        <h6 class="border-bottom" style="padding-bottom:5px;">Garage Range</h6>
                                        <div class="value-box garage">
                                            <span class="start-value"></span>
                                            <span>-</span>
                                            <span class="end-value"></span>
                                        </div>
                                        <input type="text" class="js-range-slider garage-filter" value="" name="garage"/>
                                    </div>                                          
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="select-fil-d-main dropdown">
                                    <button type="button" class="select-filter-input dropdown-toggle" data-toggle="dropdown">
                                        Floor
                                        <span class="material-icons" style="top:0;">
                                        arrow_drop_up
                                        </span>
                                        <span class="material-icons">
                                        arrow_drop_down
                                        </span>
                                        <span class="float-right filter-button-badge floor-badge"></span>
                                    </button>                                                
                                    <div class="dropdown-menu">
                                        <h6 class="border-bottom" style="padding-bottom:5px;">Floor Range</h6>
                                        <div class="value-box floor">
                                            <span class="start-value"></span>
                                            <span>-</span>
                                            <span class="end-value"></span>
                                        </div>
                                        <input type="text" class="js-range-slider floor-filter" value="" name="floor"/>
                                    </div>                                          
                                </div>
                            </div>
                            @endif
                            </div>
                            <!--# vue filters end -->
                        </div>
                        <!--Filters Section End-->
                    </form>
                    <div id="fixed-action-buttons" class="row w-100">
                        <div class="col-6 pl-0 pr-1">
                            <button id="apply-button" class="btn">Apply</button>
                        </div>
                        <div class="col-6 pl-1 pr-0">
                            <button class="btn cancel reset-button">Reset</button>
                        </div>
                        <div class="col-12 pl-0 pr-0 mt-2">
                            @if($url == "elevations")
                            <button class="btn cancel back-com">Back To Communities</button>
                            @else
                            <button class="btn cancel back-com">Back To Search</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Map Icon -->
        <div class="map-mobile-icon">
            <span class="material-icons">
            room
            </span>
            Map
        </div>
        <div class="back-map">
            <span class="material-icons">
            chevron_left
            </span>
            Back
        </div>
        <!-- Map Icon End -->
    </div>
    @include('elements.home-login')
    @include('includes.multi-community-scripts')
    <!-- For Login -->
    @stack('scripts')
    <!--End of Login -->    
    <script>
    $("#pb-elevation").addClass('active');
    @if($url=="elevations")
        $("#pb-community").addClass('active complete');    
    @endif
    $(".progressbar li.complete span").html("done");

    $(document).ready(function() {
        @if($url == "elevations")
        //Garage Filter
        $(".garage-filter").ionRangeSlider({
            type: "double",
            min: <?php echo $range['min_garage'] ?>, 
            max: <?php echo $range['max_garage'] ?>,
            from: <?php if(isset($_GET['garage'])) 
                        { $garage = explode(';',$_GET['garage']); echo $garage[0];} 
                        else { echo $range['min_garage'];} 
                        ?>,
            to: <?php if(isset($_GET['garage'])) 
                    { $garage = explode(';',$_GET['garage']); echo $garage[1];} 
                    else { echo $range['max_garage'];} 
                    ?>,
            grid: false,
            skin: "round",
            hide_min_max: true,    
            hide_from_to: true,
            step:1,
            onStart: function(data){
                $(".select-fil-d-main .dropdown-menu .garage .start-value").html(`${data.from}`);
                $(".select-fil-d-main .dropdown-menu .garage .end-value").html(`${data.to}`);
                $(".garage-badge").html(`${data.from} - ${data.to}`);
            },
            onChange: function (data) {
                $(".select-fil-d-main .dropdown-menu .garage .start-value").html(`${data.from}`);
                $(".select-fil-d-main .dropdown-menu .garage .end-value").html(`${data.to}`);
                $(".garage-badge").html(`${data.from} - ${data.to}`);
            },
            onFinish: function(data){
                if(window.innerWidth > 1023){
                    $("#form-filter").submit();
                }
            }
        });
        //floor  Filter
        $(".floor-filter").ionRangeSlider({
            type: "double",
            min: <?php echo $range['min_floor'] ?>, 
            max: <?php echo $range['max_floor'] ?>,
            from: <?php if(isset($_GET['floor'])) 
                        { $floor = explode(';',$_GET['floor']); echo $floor[0];} 
                        else { echo $range['min_floor'];} 
                        ?>,
            to: <?php if(isset($_GET['floor'])) 
                    { $floor = explode(';',$_GET['floor']); echo $floor[1];} 
                    else { echo $range['max_floor'];} 
                    ?>,
            grid: false,
            skin: "round",
            hide_min_max: true,    
            hide_from_to: true,
            step:1,
            onStart: function(data){
                $(".select-fil-d-main .dropdown-menu .floor .start-value").html(`${data.from}`);
                $(".select-fil-d-main .dropdown-menu .floor .end-value").html(`${data.to}`);
                $(".floor-badge").html(`${data.from} - ${data.to}`);
            },
            onChange: function (data) {
                $(".select-fil-d-main .dropdown-menu .floor .start-value").html(`${data.from}`);
                $(".select-fil-d-main .dropdown-menu .floor .end-value").html(`${data.to}`);
                $(".floor-badge").html(`${data.from} - ${data.to}`);
            },
            onFinish: function(data){
                if(window.innerWidth > 1023){
                    $("#form-filter").submit();
                }
            }
        });
        @endif
        // Filters
        @if($url == "elevations")
            $(".reset-button").click(function(){
                window.location.href = '/elevations?community='+'<?= $community->slug ?>';
            });
        @else
            $(".reset-button").click(function(){
                window.location.href = '/search-elevations';
            });
        @endif
        @if($url == "elevations")
        $(".back-com").click(function(){
            window.location.href = '/community?search=map';
        });
        @else
        $(".back-com").click(function(){
            window.location.href = '/';
        });
        @endif
    });
    </script>
    <script>
    //Map
    @if($url == "elevations")
    window.onload = function () {
        initMap();
    }
    function initMap() {
        var mapStyles = [{"elementType":"geometry","stylers":[{"color":"#f5f5f5"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#f5f5f5"}]},{"featureType":"administrative.country","elementType":"geometry.stroke","stylers":[{"color":"#8baeff"},{"visibility":"on"},{"weight":5}]},{"featureType":"administrative.country","elementType":"labels.icon","stylers":[{"visibility":"on"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#bdbdbd"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"color":"#ff8000"},{"visibility":"on"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#ffffff"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"saturation":-100},{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#dadada"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#c9c9c9"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#8baeff"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#000080"}]}];
        // Add a custom marker
        var markerIcon = {
            path: 'M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z',
            fillColor: '#26ae61',
            fillOpacity: 0.95,
            scale: 2,
            strokeColor: '#fff',
            strokeWeight: 3,
            anchor: new google.maps.Point(12, 24)
        };
        var map = new google.maps.Map(document.getElementById('map-canvas'), {
            center: {lat: <?= $community->lat?>, lng: <?= $community->lng?>},
            zoom: 16,
            styles:mapStyles,
            zoomControl: true,
            controlSize:32,
            zoomControlOptions: {
                position: google.maps.ControlPosition.LEFT_TOP 
            },
            streetViewControlOptions: {
                position: google.maps.ControlPosition.LEFT_TOP 
            },
        });
        var marker = new google.maps.Marker({
            position: {lat: <?= $community->lat?>, lng: <?= $community->lng?>},
            map: map,
            title: '<?= $community->name ?>',
            icon: "<?= url('/uploads/pin-'.$community->id.'.png') ?>",
        });
        var contentString = `<div class="property-list-box community-detail m-0" style="max-width:280px;">
                        <div class="property-list-box-left community-banner">
                            <div class="property-list-box-img">
                                <img src="/uploads/<?=$community->banner ?>" alt="">
                            </div>
                        </div>
                        <div class="property-list-box-right pl-2 pr-2">
                            <div class="property-list-box-title-main">
                                <div class="property-list-box-title pt-2 pl-2">
                                    <h3 style="text-transform:uppercase; font-size:14px; font-weight:600; margin-bottom:6px;"> <?= $community->name?></h3>
                                </div>
                            </div>
                            <div class="property-list-box-title-main">
                                <div class="property-list-box-title pl-2">
                                    <h3 style="text-transform:uppercase; font-size:12px; font-weight:600; color:#9fcc3a"> \${{env('CURRENCY').number_format($range['min_price'])}} - \${{env('CURRENCY').number_format($range['max_price'])}}</h3>
                                </div>
                            </div>
                            <div style="padding: 0 25px 25px;">
                                <div class="row">
                                    <div style="width:33.333%;">
                                        <h3 style="text-transform:uppercase; font-size:12px; font-weight:500; color:#999; margin-bottom:1px;"> Area</h3>
                                        <h3 style="font-size:12px; font-weight:600; color:#646464;"> {{number_format($range['min_area'])}} - {{number_format($range['max_area'])}} sqft</h3>
                                    </div>
                                    <div style="width:33.333%;">
                                        <h3 style="text-transform:uppercase; font-size:12px; font-weight:500; color:#999; margin-bottom:1px;"> Bedroom</h3>
                                        <h3 style="font-size:12px; font-weight:600; color:#646464;">{{$range['min_bedroom']}} - {{$range['max_bedroom']}}</h3>
                                    </div>
                                    <div style="width:33.333%;">
                                        <h3 style="text-transform:uppercase; font-size:12px; font-weight:500; color:#999; margin-bottom:1px;"> Bathroom</h3>
                                        <h3 style="font-size:12px; font-weight:600; color:#646464;"> {{$range['min_bathroom']}} - {{$range['max_bathroom']}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
        var infowindow = new google.maps.InfoWindow({
        content: contentString
        });
        google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map,marker);
        });
        infowindow.open(map,marker);
    }
    @else
    // Map
    <?php if($ccount >= 1): $clat = $community[0]['lat']; $clng = $community[0]['lng']; else: $clat = 48.0633173; $clng = -114.0809202; endif; ?>
    var mapStyles = [{"elementType":"geometry","stylers":[{"color":"#f5f5f5"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#f5f5f5"}]},{"featureType":"administrative.country","elementType":"geometry.stroke","stylers":[{"color":"#8baeff"},{"visibility":"on"},{"weight":5}]},{"featureType":"administrative.country","elementType":"labels.icon","stylers":[{"visibility":"on"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#bdbdbd"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"color":"#ff8000"},{"visibility":"on"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#ffffff"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"saturation":-100},{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#dadada"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#c9c9c9"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#8baeff"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#000080"}]}];
    window.onload = function () {
        LoadMap();
    }
    function LoadMap() {
      var mapOptions = {
        center: new google.maps.LatLng(<?=$clat?>, <?= $clng ?>),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        styles:mapStyles,
        zoomControl: true,
        controlSize:32,
        zoomControlOptions: {
            position: google.maps.ControlPosition.LEFT_TOP 
        },
        streetViewControlOptions: {
            position: google.maps.ControlPosition.LEFT_TOP 
        },
      };
      var infoWindow = new google.maps.InfoWindow();
      var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
      //Create LatLngBounds object.
      var latlngbounds = new google.maps.LatLngBounds();
      var markers = [];
      <?php foreach($community as $key => $community) { ?>
        var data = markers[<?=$key?>];
        var myLatlng = new google.maps.LatLng(<?= $community->lat?>, <?= $community->lng?>);
        var marker = new google.maps.Marker({
          position: myLatlng,
          map: map,
          icon: "<?= url('/uploads/pin-'.$community->id.'.png') ?>",
          title: "<?= $community->name?>"
        });
        markers.push(marker);
        (function (marker, data) {
            google.maps.event.addListener(marker, "click", function (e) {
              infoWindow.setContent(`
                <div class="property-list-box community-detail m-0" style="max-width:280px;">
                    <div class="property-list-box-left community-banner">
                        <div class="property-list-box-img">
                            <img src="/uploads/<?=$community->banner ?>" alt="">
                        </div>
                    </div>
                    <div class="property-list-box-right pl-2 pr-2">
                        <div class="property-list-box-title-main">
                            <div class="property-list-box-title pt-2 pl-2">
                                <h3 style="text-transform:uppercase; font-size:14px; font-weight:600; margin-bottom:6px;"> <?= $community->name?></h3>
                            </div>
                        </div>
                        <div class="property-list-box-title-main">
                            <div class="property-list-box-title pl-2">
                                <h3 style="text-transform:uppercase; font-size:12px; font-weight:600; color:#9fcc3a"> \${{env('CURRENCY').number_format($range['min_price'])}}</h3>
                            </div>
                        </div>
                        <div style="padding: 0 25px 25px;">
                            <div class="row">
                                <div style="width:33.333%;">
                                    <h3 style="text-transform:uppercase; font-size:12px; font-weight:500; color:#999; margin-bottom:1px;"> Area</h3>
                                    <h3 style="font-size:12px; font-weight:600; color:#646464;"> {{number_format($range['min_area'])}} sqft</h3>
                                </div>
                                <div style="width:33.333%;">
                                    <h3 style="text-transform:uppercase; font-size:12px; font-weight:500; color:#999; margin-bottom:1px;"> Bedroom</h3>
                                    <h3 style="font-size:12px; font-weight:600; color:#646464;">{{$range['min_bedroom']}} - {{$range['max_bedroom']}}</h3>
                                </div>
                                <div style="width:33.333%;">
                                    <h3 style="text-transform:uppercase; font-size:12px; font-weight:500; color:#999; margin-bottom:1px;"> Bathroom</h3>
                                    <h3 style="font-size:12px; font-weight:600; color:#646464;"> {{$range['min_bathroom']}} - {{$range['max_bedroom']}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              `);
              infoWindow.open(map, marker);
            });
        })(marker, data);
        //Extend each marker's position in LatLngBounds object.
        latlngbounds.extend(marker.position);
      <?php } ?>
      //Get the boundaries of the Map.
      var bounds = new google.maps.LatLngBounds();
      //Center map and adjust Zoom based on the position of all markers.
      map.setCenter(latlngbounds.getCenter());
      map.fitBounds(latlngbounds);
      $('.open-infobox').on('click', function () {
        infoWindow.open(map, markers[$(this).data('markerid')]);
        google.maps.event.trigger(markers[$(this).data('markerid')], 'click');
      });
    }
    @endif
    </script>
</body>
</html>
