<?php if($ccount >= 1): $clat = $communities[0]['lat']; $clng = $communities[0]['lng']; else: $clat = 48.0633173; $clng = -114.0809202; endif; ?>
<?php setlocale(LC_MONETARY,"en_US");?> 
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
                        <div class="propperty-filter-l-main">
                            @if($url == "community")
                              <input type="hidden" name="search" value="{{$_GET['search']}}">
                            @endif
                              <!--Filters Section Begin-->
                              <div class="filter-form-main">
                                  <div class="row">
                                    @if($url == "community")
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
                                  </div>
                              </div>
                              <div class="filter-bottom-main">
                                    <div class="filter-button-left">
                                        @if($url == "community")
                                        <a href="/">
                                            <span class="material-icons">
                                            chevron_left
                                            </span> 
                                            Back To Search
                                        </a>
                                        @else
                                        <a href="/search-elevations">
                                            <span class="material-icons">
                                            chevron_left
                                            </span> 
                                            Back To Elevations
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
                                                    <h1 class="border-bottom">{{ $ccount }} Communities sorted by</h1>
                                                </div>
                                                <div class="property-list-title-col-4">
                                                    <select name="sortby" id="sortby" onchange="$('#form-filter').submit()">
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
                                            @foreach($communities as $key => $community)
                                            @if($url == "community")
                                                <input type="hidden" id="cominfo{{ $community->id}}" data-title="{{strtoupper($community->name)}}" 
                                                data-price="${{env('CURRENCY').number_format($com_min_price[$key])}} - ${{env('CURRENCY').number_format($com_max_price[$key])}}" 
                                                data-area="{{number_format($com_min_area[$key])}} - {{number_format($com_max_area[$key]) }} sqft" data-image="{{$community->banner}}">
                                            @else
                                                <input type="hidden" id="cominfo{{ $community->id}}" data-title="{{strtoupper($community->name)}}" 
                                                data-price="${{env('CURRENCY').number_format($com_min_price)}}" data-area="{{number_format($com_min_area)}} sqft" data-image="{{$community->banner}}">
                                            @endif
                                            <div class="property-list-box commbox" id="commbox<?=$community->id?>">
                                                <div class="row">
                                                    <div class="property-list-box-left community-banner">
                                                        @if($url != "community")
                                                        <div class="property-left-label">{{$home->title}}</div>
                                                        @endif
                                                        <div class="property-list-box-img">
                                                            <img src="{{asset('uploads/'.$community->banner)}}" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="property-list-box-right">
                                                        <div class="property-list-box-title-main">
                                                            <div class="property-list-box-title">
                                                                <h3 markerid="{{$key}}" data-toggle="tooltip" data-placement="top" title="{{$community->name}}">{{ $community->name}}</h3>
                                                            </div>
                                                            <div class="property-list-compare">
                                                                <label class="checkbox-contain"> 
                                                                    <input type="checkbox" value="{{$community->id}}" id="community_compare{{$community->id}}" class="ccheckbox" name="compare[]">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <span class="compare">Compare</span>
                                                            </div>
                                                        </div>
                                                        <div class="property-list-box-desc community-address" data-toggle="tooltip" data-placement="top" title="{{$community->location}}">
                                                          {{ $community->location}}
                                                        </div>
                                                        <div class="property-list-box-feature-main">
                                                            <div class="row">
                                                                <div class="property-list-feature-col-6">
                                                                    <div class="property-list-feature-text">
                                                                        <span class="material-icons">
                                                                        home
                                                                        </span>
                                                                        <h5>Price Range</h5>
                                                                        @if($url == "community")
                                                                            <p class="m-0" data-toggle="tooltip" data-placement="top" title="${{env('CURRENCY').number_format($com_min_price[$key])}} - ${{env('CURRENCY').number_format($com_max_price[$key])}}">${{env('CURRENCY').number_format($com_min_price[$key])}} - ${{env('CURRENCY').number_format($com_max_price[$key])}}</p>
                                                                        @else
                                                                            <p class="m-0" data-toggle="tooltip" data-placement="top" title="${{env('CURRENCY').number_format($com_min_price)}}">${{env('CURRENCY').number_format($com_min_price)}}</p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="property-list-feature-col-6">
                                                                    <div class="property-list-feature-text">
                                                                        <span class="material-icons">
                                                                        crop_free
                                                                        </span>               
                                                                        <h5>Area</h5>
                                                                        @if($url == "community")
                                                                            <p class="m-0" data-toggle="tooltip" data-placement="top" title="{{number_format($com_min_area[$key])}} - {{number_format($com_max_area[$key])}} sqft">{{number_format($com_min_area[$key])}} - {{number_format($com_max_area[$key])}} sqft</p>
                                                                        @else
                                                                            <p class="m-0" data-toggle="tooltip" data-placement="top" title="{{number_format($com_min_area)}} sqft">{{number_format($com_min_area)}} sqft</p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="property-list-feature-col-6">
                                                                    <div class="property-list-feature-text">
                                                                        <span class="material-icons">
                                                                        business
                                                                        </span>
                                                                        <h5>Community Type</h5>
                                                                        <p class="m-0" data-toggle="tooltip" data-placement="top" title="Value">Value</p>
                                                                    </div>
                                                                </div>
                                                                <div class="property-list-feature-col-6">
                                                                    <div class="property-list-feature-text">
                                                                        <span class="material-icons">
                                                                        school
                                                                        </span>
                                                                        <h5>School</h5>
                                                                        <p class="m-0" data-toggle="tooltip" data-placement="top" title="Value">Value</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="property-list-tabs-main community-tabs" style="margin-top:12px;">
                                                            <!-- Nav tabs -->
                                                            <ul class="nav nav-tabs">
                                                                @if($url == "community")
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="/elevations?community={{$community->slug}}">Elevations</a>
                                                                </li>
                                                                @else
                                                                <li class="nav-item">
                                                                    @if($elevation_type)
                                                                    <a class="nav-link" href="{{ url('/plats/'.$community->slug.'/'.$home->id.'/'.$elevation_type->id) }}">Site Plan</a>
                                                                    @else
                                                                    <a class="nav-link" href="{{ url('/plats/'.$community->slug.'/'.$home->id.'/'.$home->id) }}">Site Plan</a>
                                                                    @endif
                                                                </li>
                                                                @endif
                                                                <li class="nav-item">
                                                                    <a class="nav-link more-info" data-toggle="modal" data-target="#community{{$community->id}}" community_id ="{{$community->id}}" href="javascript:void(0)">More Info</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal: more info -->
                                            <div class="modal fade right sliding-modal" id="community{{$community->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                                <div class="modal-body" style="padding-top: 0 !important; height:calc(100vh - 103px);">
                                                    <div class="brochure-image-wrapper p-1 h-100">
                                                        <a href="{{asset('uploads/brochure.png')}}">
                                                            <img src="{{asset('uploads/brochure.png')}}">
                                                            <div class="middle">
                                                                <div class="text">View</div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>

                                                </div>
                                            </div>
                                            </div>
                                            <!-- Modal: more info end -->
                                            @endforeach
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
            </div>
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
                        @if($url == "community")
                            <input type="hidden" name="search" value="{{$_GET['search']}}">
                        @endif
                        <!--Filters Section Begin-->
                        <div class="filter-form-main">
                            <div class="row" id="app">
                            @if($url == "community")
                            <div class="col-12">
                                <div class="select-fil-d-main">
                                    <select type="button" class="select-filter-input js-example-basic-single" name="value" 
                                    value="(isset($_GET['value'])?$_GET['value']:''">
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
                            </div>
                        </div>
                        <!--Filters Section End-->
                    </form>
                        <div id="fixed-action-buttons" class="row w-100">
                        <div class="col-6 pl-0 pr-1">
                            <button id="apply-button" class="btn">Apply</button>
                        </div>
                        <div class="col-6 pl-1 pr-0">
                            <button onclick="closeNav()" class="btn cancel reset-button">Reset</button>
                        </div>
                        @if($url == "community")
                        <div class="col-12 pl-0 pr-0 mt-2">
                            <a href="/"><button class="btn cancel back-com">Back To Search</button></a>
                        </div>
                        @else
                        <div class="col-12 pl-0 pr-0 mt-2">
                            <a href="/search-elevations"><button class="btn cancel back-com">Back To Elevations</button></a>
                        </div>
                        @endif
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
              <div class="modal-body  p-0" id="comparelist">
              </div>
            </div>
          </div>
        </div>
        <!-- Compare Modal End -->
    </div>
    @include('elements.home-login')
    @include('includes.multi-community-scripts')
    <!-- For Login -->
    @stack('scripts')
    <script>

    @if($url == "community")
        $("#pb-community").addClass('active');
    @else
        $("#pb-elevation-type, #pb-elevation").addClass('active complete');
        $("#pb-community").addClass('active');
    @endif
    $(".progressbar li.complete span").html("done");
    //Reset Filters
    $(".reset-button").click(function(){
        @if($url == "community")
        window.location.href = "/community?search=map";
        @else
        window.location.href = "/community/{{$home->slug}}/{{($elevation_type)?$elevation_type->slug:''}}";
        @endif 
    });

    // Map
    var mapStyles = [{"elementType":"geometry","stylers":[{"color":"#f5f5f5"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#f5f5f5"}]},{"featureType":"administrative.country","elementType":"geometry.stroke","stylers":[{"color":"#8baeff"},{"visibility":"on"},{"weight":5}]},{"featureType":"administrative.country","elementType":"labels.icon","stylers":[{"visibility":"on"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#bdbdbd"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"color":"#ff8000"},{"visibility":"on"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#ffffff"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"saturation":-100},{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#dadada"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#c9c9c9"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#8baeff"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#000080"}]}];
    window.onload = function () {
        LoadMap();
    }
    function LoadMap() {
        var mapOptions = {
        center: new google.maps.LatLng(cLat, cLng),
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
        <?php foreach($communities as $key => $community) { ?>
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
                                    <h3 style="text-transform:uppercase; font-size:12px; font-weight:600; color:#9fcc3a">
                                    {{($url == "community")?env('CURRENCY').number_format($com_min_price[$key]):env('CURRENCY').number_format($com_min_price)}}
                                    </h3>
                                </div>
                            </div>
                            <div style="padding: 0 25px 25px;">
                                <div class="row">
                                    <div style="width:33.333%;">
                                        <h3 style="text-transform:uppercase; font-size:12px; font-weight:500; color:#999; margin-bottom:1px;"> Area</h3>
                                        <h3 style="font-size:12px; font-weight:600; color:#646464;"> 
                                        {{($url=='community')?number_format($com_min_area[$key]):number_format($com_min_area)}}
                                        </h3>
                                    </div>
                                    <div style="width:33.333%;">
                                        <h3 style="text-transform:uppercase; font-size:12px; font-weight:500; color:#999; margin-bottom:1px;"> Bedroom</h3>
                                        <h3 style="font-size:12px; font-weight:600; color:#646464;">
                                        {{($url=='community')?$com_min_bed[$key].' - '.$com_max_bed[$key]:$com_min_bed}}
                                        </h3>
                                    </div>
                                    <div style="width:33.333%;">
                                        <h3 style="text-transform:uppercase; font-size:12px; font-weight:500; color:#999; margin-bottom:1px;"> Bathroom</h3>
                                        <h3 style="font-size:12px; font-weight:600; color:#646464;">
                                        {{($url=='community')?$com_min_bath[$key].' - '.$com_max_bath[$key]:$com_min_bath}}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `);
                    infoWindow.open(map, marker);
                    highlightbox(<?=$community->id?>);
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
    function highlightbox(cid) {
        $('.commbox').removeClass('comactive');
        $('#commbox'+cid).addClass('comactive');
        $('#left-property-list-inner2 .property-list-inner-main').animate({
        scrollTop: $('#commbox'+cid).offset().top}, 1000);
    }
</script>
</body>
</html>