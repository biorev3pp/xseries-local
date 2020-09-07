<div class="sidemenu" style="z-index:1000;">
    <div class="tabs-box">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item nav-item1">
                <a class="nav-link {{(Route::currentRouteName() == 'xplat' || Route::currentRouteName() == 'plat')?'active':''}}" id="nav-tab1" data-toggle="tab" href="#nav1" role="tab" aria-controls="nav1" aria-selected="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </a>
            </li>
            <li class="nav-item nav-item2">
                <a class="nav-link" id="nav-tab2" data-toggle="tab" href="#nav2" role="tab" aria-controls="nav2" aria-selected="false">
                    @if(Route::currentRouteName() == "xplat" || Route::currentRouteName() == "plat")
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                        stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" 
                        class="feather feather-image">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                        <polyline points="21 15 16 10 5 21"></polyline>
                    </svg>
                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
						<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
						<polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    @endif
                </a>
            </li>
            <li class="nav-item nav-item3">
                <a class="nav-link {{(Route::currentRouteName() == 'xfloor' || Route::currentRouteName() == 'xhome' )?'active':''}}" id="nav-tab3" data-toggle="tab" href="#nav3" role="tab" aria-controls="nav3" aria-selected="false">
                    @if(Route::currentRouteName() == "xplat" || Route::currentRouteName() == "plat")
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                        stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" 
                        class="feather feather-map-pin">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sliders">
						<line x1="4" y1="21" x2="4" y2="14"></line>
						<line x1="4" y1="10" x2="4" y2="3"></line>
						<line x1="12" y1="21" x2="12" y2="12"></line>
						<line x1="12" y1="8" x2="12" y2="3"></line>
						<line x1="20" y1="21" x2="20" y2="16"></line>
						<line x1="20" y1="12" x2="20" y2="3"></line>
						<line x1="1" y1="14" x2="7" y2="14"></line>
						<line x1="9" y1="8" x2="15" y2="8"></line>
						<line x1="17" y1="16" x2="23" y2="16"></line>
					</svg>
                    @endif
                </a>
            </li>
            <li class="nav-item nav-item4">
                <a class="nav-link" id="nav-tab4" data-toggle="tab" href="#nav4" role="tab" aria-controls="nav4" aria-selected="false">
                    @if(Route::currentRouteName() == "xplat" || Route::currentRouteName() == "plat")
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                        stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sliders">
                        <line x1="4" y1="21" x2="4" y2="14"></line>
                        <line x1="4" y1="10" x2="4" y2="3"></line>
                        <line x1="12" y1="21" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12" y2="3"></line>
                        <line x1="20" y1="21" x2="20" y2="16"></line>
                        <line x1="20" y1="12" x2="20" y2="3"></line>
                        <line x1="1" y1="14" x2="7" y2="14"></line>
                        <line x1="9" y1="8" x2="15" y2="8"></line>
                        <line x1="17" y1="16" x2="23" y2="16"></line>
                    </svg>
                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3">
						<path d="M12 20h9"></path>
						<path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
					</svg>
                    @endif
                </a>
            </li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade {{(Route::currentRouteName() == 'xplat' || Route::currentRouteName() == 'plat')?'show active':''}}" id="nav1" role="tabpanel" aria-labelledby="nav-tab1">
            <div class="header-bg">
                <div class="header">
                    <h2>Community</h2>
                </div>
                <div class="tabs-scroll-area area-extra-pd">
                    <div class="tabs-scroll-content">
                        <div class="header-box">
                            <img src="{{ asset('uploads/' . $community->banner) }}" alt="" style="width: 100%;">
                            <h5>{{ $community->name }}</h5>
                        </div>
                        @if(Route::currentRouteName() == "xplat" || Route::currentRouteName() == "plat")
                        @if($community->phases >= 2)
                            @for($i=1;$i <= $community->phases; $i++)
                        <div class="legend-header">
                            Phase {{$i}} {{ $legendData->groupname }}
                        </div>
                        <div class="legend-list"></div>
                        @endfor
                        @else
                        <div class="legend-header">
                            {{ $legendData->groupname }}
                        </div>
                        <div class="legend-list"></div>
                        @endif
                        @else
                        <div class="header mt-3">
							<h2>Image Gallery</h2> </div>
						<div class="p-2">
							<div class="carousel-gallery"> @foreach(explode(',',$community->gallery) as $key => $img) @if($img)
								<a href="{{asset('uploads/'.$img)}}"> <img src="{{asset('uploads/'.$img)}}"> </a> @endif @endforeach </div>
						</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav2" role="tabpanel" aria-labelledby="nav-tab2">
            <div class="header-bg">
                <div class="header">
                    <h2>
                        @if(Route::currentRouteName() == "xplat" || Route::currentRouteName() == "plat")
                        Community Gallery
                        @endif
                        @if(Route::currentRouteName() == "xhome")
                        Elevation & Types
                        @endif
                        @if(Route::currentRouteName() == "xfloor")
                        Elevation
                        @endif
                    </h2>
                </div>
                <div class="tabs-scroll-area">
                    <div class="tabs-scroll-content">
                        @if(Route::currentRouteName() == "xplat" || Route::currentRouteName() == "plat")
                        <div class="p-2">
							<div class="carousel-gallery"> @foreach(explode(',',$community->gallery) as $key => $img) @if($img)
                                <a href="{{asset('uploads/'.$img)}}"> <img src="{{asset('uploads/'.$img)}}"> </a> @endif @endforeach 
                            </div>
                        </div>
                        @endif
                        @if(Route::currentRouteName() == "xhome")
                        @php
                        if(Session::has('home_type_id')){
                            $home = $home_type;
                            if(Session::get('home_type_id') == $home_type->id)
                                $active = 'active';
                            else
                                $active = '';
                        }
                        else{
                            $home = $home;
                            if(Session::get('home_id')== $home->id)
                                $active = 'active';
                            else
                                $active = '';
                        }
                        @endphp
                        <div class="d-block align-items-center pt-3 pl-3 pr-3 pb-2 m-0 border-bottom"> 
                            <div class="home-img">
                                <img src="{{ asset('uploads/homes/'.$home->img)}}" alt="" class="w-100">
                                <span class="text-white">
                                    <svg class="mr-1" onclick="elevationPopup({{$home->id}})" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                                    <svg class="elevation {{$active}}" elevation_id="{{$home->id}}" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                </span>
                            </div>
                            <p class="m-0 mt-2 home-data-wrap text-left">
                                <span class="text-white">{{$home->title}}</span>
                                <span class="d-block text-white">${{env('CURRENCY').number_format($home->price)}}</span>
                                <span class="d-flex justify-content-between home-icons mt-2">
                                    <span>
                                        <span class="material-icons mr-1">
                                        king_bed
                                        </span>
                                        {{$home->bedroom}} Beds
                                    </span>
                                    <span>
                                        <span class="material-icons mr-1">
                                        bathtub
                                        </span>
                                        {{$home->bathroom}} Baths
                                    </span>
                                    <span>
                                        <span class="material-icons mr-1">
                                        drive_eta
                                        </span>
                                        {{$home->garage}} Garages
                                    </span>
                                </span>
                            </p>                            
                        </div>
                        @endif
                        @if(Route::currentRouteName() == "xfloor")
                            <div class="d-block align-items-center pt-3 pl-3 pr-3 pb-2 m-0 border-bottom">
								<div class="home-img"> <img src="{{ asset('uploads/homes/'.$home->img)}}" alt="" class="w-100"> 
									<span class="text-white">
										<svg class="mr-1" onclick="elevationPopup()" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
									</span> 
								</div>
								<p class="m-0 mt-2 home-data-wrap text-left"> 
									<span class="text-white">{{(!$home_type)?$home->title:$home_type->title}}</span> 
									<span class="d-block text-white">${{(!$home_type)?env('CURRENCY').number_format($home->price):env('CURRENCY').number_format($home_type->price)}}</span>
									<span class="d-flex justify-content-between home-icons mt-2">
										<span>
											<span class="material-icons mr-1">
											king_bed
											</span> {{(!$home_type)?$home->bedroom:$home_type->bedroom}} Beds 
										</span> 
										<span>
											<span class="material-icons mr-1">
											bathtub
											</span>
											{{(!$home_type)?$home->bathroom:$home_type->bathroom}} Baths 
										</span> 
										<span>
											<span class="material-icons mr-1">
											drive_eta
											</span>
											{{(!$home_type)?$home->garage:$home_type->garage}} Garages 
										</span>
									</span>
								</p>
							</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade {{(Route::currentRouteName() == 'xfloor' || Route::currentRouteName() == 'xhome')?'show active':''}}" id="nav3" role="tabpanel" aria-labelledby="nav-tab3">
            <div class="header-bg">
                <div class="header">
                    <h2>
                        @if(Route::currentRouteName() == "xplat" || Route::currentRouteName() == "plat")
                        Available Now
                        @endif
                        @if(Route::currentRouteName() == "xhome")
                        Choose Color Scheme
                        @endif
                        @if(Route::currentRouteName() == "xfloor")
                        Floor Plan
                        @endif
                    </h2>
                </div>
                <div class="tabs-scroll-area">
                    @if(Route::currentRouteName() == "xplat" || Route::currentRouteName() == "plat")
                    <div class="tabs-scroll-content">
                    @foreach($xplatData as $xplat)
                        <div class="available-boxes-main">
                            <div  class="available-img-box sb-listings" id="{{ $xplat->groupID }}" data-isblank="yes">
                                <div class="available-header" style="border-bottom:2px solid;">
                                    <p>
                                        <span> {{ $xplat->alias}}</span>
                                        Price : ${{ env('CURRENCY').number_format($xplat->price) }} <br>
                                        Lot Available
                                    </p>
                                </div>
                                <div class="view-more-btn">
                                    <a class="sb-listings-more"   data-toggle="modal" data-lotid="{{$xplat->groupID}}" data-pid="{{$xplat->id}}" data-price="{{$xplat->price }}" data-target="#modal-{{$xplat->groupID}}">View More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                    @endif
                    @if(Route::currentRouteName() == "xhome")
                    <div class="tabs-scroll-content" style="overflow:hidden;">
                        <div class="color-scheme container h-100 pr-0" id="cstoload">
                            <!-- Color Schemes -->
                            <div id="base_images">
                                <div class="row pt-3 pb-0 m-0 w-100" style="padding-right:15px;">
                                    @php 
                                        $color_scheme_id=(Session::has('color_scheme_id'))?Session::get('color_scheme_id'):'';
                                        if(Session::has('home_type_id'))
                                            $home_data = $home_type;
                                        else
                                            $home_data = $home;
                                    @endphp
                                    @foreach($home_data->ColorScheme as $key=>$colorscheme)
                                    @if($key%2 == 0 )
                                    <div class="col-6 pr-1 pl-0">
                                        <a href="javascript:void(0)" class="" >
                                            <div id="colorBox0" class="color-schemes">
                                                <img class="img-fluid" width="100%" height="100%" src="{{asset('uploads/homes').'/'.$colorscheme->img}}" base_image="{{asset('uploads/homes').'/'.$colorscheme->base_img}}" alt="{{$colorscheme->title}}" tabindex="0">
                                                <span class="text-white">
                                                    <svg class="{{ ($color_scheme_id==$colorscheme->id)?'active':'' }} home-thumbnail" active="{{ ($color_scheme_id==$colorscheme->id)?1:0 }}" title="{{$colorscheme->title}}" price="{{$colorscheme->price}}" color_scheme_id="{{$colorscheme->id}}" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                                </span>
                                            </div>
                                        </a>
                                        <div style="color:white;font-size:12px; margin-top:2px;margin-bottom:1px;">{{$colorscheme->title}}</div>
                                    </div>
                                    @else
                                    <div class="col-6 pl-1 pr-0">
                                        <a href="javascript:void(0)" class="" >
                                            <div id="colorBox0" class="color-schemes">
                                                <img class="img-fluid" width="100%" height="100%" src="{{asset('uploads/homes').'/'.$colorscheme->img}}" base_image="{{asset('uploads/homes').'/'.$colorscheme->base_img}}" alt="{{$colorscheme->title}}" tabindex="0">
                                                <span class="text-white">
                                                    <svg class="{{ ($color_scheme_id==$colorscheme->id)?'active':'' }} home-thumbnail" active="{{ ($color_scheme_id==$colorscheme->id)?1:0 }}" title="{{$colorscheme->title}}" price="{{$colorscheme->price}}" color_scheme_id="{{$colorscheme->id}}" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                                </span>
                                            </div>
                                        </a>
                                        <div style="color: white;font-size:12px; margin-top:2px; margin-bottom:1px;">{{$colorscheme->title}}</div>
                                    </div>
                                    @endif
                                @endforeach
                                </div>
                            </div>
                            <!-- End Color Schemes -->
                            <!-- COLOR PATTERNS  START-->
                            <hr style = "margin: 10px 0 !important;margin-left: -15px !important;border-top: 1px solid #dee2e6;">
                            <div class="row w-100 m-0 color-paletes" style="padding-right:11px;" id="options" aria-hidden="false">
                                @if(isset($sess_features))
                                @foreach($sess_features as $key=>$features)
                                @php 
                                $features_old='';
                                $upgrade_type='';
                                if(isset($home_upgrade_patches)){
                                foreach($home_upgrade_patches as $upgrade_patches){
                                if($upgrade_patches->group_id == $features->group_id){
                                    $features_old=$features;
                                    $features=$upgrade_patches;
                                    }
                                }

                                }
                                if($features->upgrade_type==1){
                                    $upgrade_type='concrete';
                                }
                                if($features->upgrade_type==2){
                                    $upgrade_type='window';
                                }
                                if($features->upgrade_type==3){
                                    $upgrade_type='siding';
                                }
                                $active = ($features->upgraded == 1)?'rotate-upgrade':'';
                                @endphp
                                <ul class="col-4 pr-1 pl-0 mb-1">
                                    <a id="{{$upgrade_type}}" upgraded="{{$features->upgraded}}">
                                        <div class="feature-wrap">
                                            <img class="w-100" id="img_{{(($features_old !=''))?$features_old->id : $features->id}}" upgrade_patch_id="{{$features->id}}" price="{{$features->price}}" alt="{{$features->title}}" src="{{url('uploads/homes/'.$features->img)}}">
                                            <span class="text-white d-flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="feature" href="javascript:void(0)" upgrade_type="{{$upgrade_type}}" feature_id="{{(($features_old !=''))?$features_old->id : $features->id}}" stared="{{$features->stared}}" upgraded="{{$features->upgraded}}" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10">
                                                </circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                                                @if($features->stared !=0)
                                                <svg xmlns="http://www.w3.org/2000/svg" title="{{($features->upgraded == 1)?'Downgrade':'Upgrade'}}" upgrade="{{$features->upgraded}}" feature_id="{{(($features_old !=''))?$features_old->id : $features->id}}" upgrade_type="{{$upgrade_type}}" class="upgrade_options ml-1 {{$active}}" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-up-circle">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <polyline points="16 12 12 8 8 12"></polyline>
                                                    <line x1="12" y1="16" x2="12" y2="8"></line>
                                                </svg>
                                                @endif
                                            </span>
                                            @if($features->stared !=0)
                                            <p style="left: 0;right: 0;width: 100%;text-align: center;position: absolute;top: 2px;margin: 0; opacity:0; transition: 0.3s ease opacity;font-size: 11px;background: #FFE300;padding: 4px 5px;line-height: 1;" class="{{($features->upgraded == 1)?'show-bookmark':''}}"> Upgraded</p>
                                            @endif
                                        </div>
                                    </a>
                                </ul>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(Route::currentRouteName() == "xfloor")
                    <div class="tabs-scroll-content">
						<div class="tab-head-content-wrap">
							<div class="filter-price-box floor-box-main">
								<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
									<!-- Single Instance -->
									<div id="floorvars-wrapper">
										<div class="panel panel-default">
											<ul class="home_floors nav nav-tabs2" role="tablist">
												@php $i=0; $floors_count=count($home->floors);if($floors_count==1){$width="100%";} if($floors_count==2){$width="50%";} if($floors_count==3){$width="33.33%";} @endphp
												@foreach($home->floors as $floor) @if($floor->status_id ==2) @php $i++; @endphp
												<li class="nav-items" style="width:{{$width}}">
													<a
														floor_no="{{$i}}"
														class="nav-link text-info-white text-nowrap hand noSelect floorList {{($i==1)?'active':''}}"
														id="floortab_{{$i}}"
														data-toggle="tab"
														data-target="#floor-tabs-{{$i}}"
														aria-selected="{{($i==1)?'true':'false'}}"
														aria-controls="floor{{$i}}"
														style="font-weight: 500;" >
														{{$floor->title}}
													</a>
												</li>
												@endif @endforeach
											</ul>
											<div class="tab-content" id="floor-{{$i}}" style="">
												@php $i=0; @endphp @foreach($home->floors as $floor) @if($floor->status_id ==2) @php $i++; @endphp
												<div class="floor_options tab-pane fade {{($i==1)?' show active':' '}} panel-body row home_floors" data-floor-home-id="{{$i}}" floor="{{$i}}" id="floor-tabs-{{$i}}" role="tabpanel" aria-labelledby="floortab_{{$i}}">
													<div class="xfloor-list-main-box">
														<div class="xfloor-list-heading-box accordion" id="accordianBox{{$i}}">
															@forelse($floor->features_data as $keyid => $group)
															<div>
																<label class="floor-feature-heading <?= ($keyid == 0)?'':'collapsed'?>" data-toggle="collapse" data-target=".collapseUL{{$group['id']}}">{{ ucwords(strtolower($group['title'])) }}
																	<span class="pull-right"></span>
																</label>
																@if(array_key_exists('child_feature', $group)) 
																	<ul class="mb-0 collapse <?= ($keyid == 0)?'show':''?> collapseUL{{$group['id']}}" id="left_togg" data-parent="#accordianBox{{$i}}">
																		@forelse($group['child_feature'] as $feature)
																			<li class="nav-link  hand noSelect_{{$feature['id']}} xfloor-list">
																				<span style="width: 258px; display: inline-block;"> <span class="fttl" data-self="{{$feature['id'] }}" data-image="{{$feature['image']}}" data-conflicts="{{$feature['conflicts']}}" style="width: 210px; display: inline-block;"> {{ ucwords(strtolower($feature['title'])) }} </span> </span>
																				<label
																					id="ftlabel{{$feature['id'] }}"
																					data-conflicts="{{$feature['conflicts']}}"
																					data-dependency="{{$feature['dependency']}}"
																					data-togetherness="{{$feature['togetherness']}}"
																					data-self="{{$feature['id'] }}"
																					data-title="{{$feature['title']}}" 
																						data-image="{{$feature['image']}}" 
																					class="ui-switch ui-switch-success ui-switch-sm mb-0 float-right manageToggle"
																				>
																					<input
																						title="{{$feature['title']}}"
																						data-check-floor-id="{{$floor->id}}"
																						type="checkbox"
																						class="conflicts_{{$feature['id']}} dependency_{{$feature['id']}} self_{{$feature['id']}} togetherness_{{$feature['id']}} checkbox"
																						id="{{$feature['id']}}"
																						value="{{$feature['price']}}"
																					/>
																					<i class="slider round"></i>
																				</label>
																			</li>
																		@empty 
																		@endforelse 
																	</ul>
																@endif 
															</div>
															@empty
																<label style="background: #ad2a3d; color: #fff; padding: 10px 5px 15px 15px; line-height: 25px; font-weight: 400;">
																	No customization available on this floor.
																</label>
															@endforelse
															
														</div>
													</div>
												</div>
												@endif @endforeach
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav4" role="tabpanel" aria-labelledby="nav-tab4">
            <div class="header-bg">
                <div class="header">
                    <h2>{{(Route::currentRouteName() == "xplat" || Route::currentRouteName() == "plat")?'Filters':'Note'}}</h2>
                </div>
                <div class="tabs-scroll-area">
                    <div class="tabs-scroll-content">
                        @if(Route::currentRouteName() == "xplat" || Route::currentRouteName() == "plat")
                        <div class="filter-price-box" id="tabsFilterBox">
                            <div class="filter-tabs-main">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#price_range" role="tab" aria-selected="true">Price</a>
                                        <a class="nav-item nav-link" data-toggle="tab" href="#living_area_range" role="tab" aria-selected="false">Area</a>
                                        <a class="nav-item nav-link" data-toggle="tab" href="#beds_range" role="tab" aria-selected="false">Beds</a>
                                        <a class="nav-item nav-link" data-toggle="tab" href="#baths_range" role="tab" aria-selected="false">Baths</a>
                                        <a class="nav-item nav-link" data-toggle="tab" href="#garage_range" role="tab" aria-selected="false">Garages</a>
                                        <a class="nav-item nav-link" data-toggle="tab" href="#floors_range" role="tab" aria-selected="false">Floors</a>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="price_range">
                                        <span class="filters-value price_range_data"></span>
                                        <div>
                                            <input type="text" id="filter-price" value="" name="range" readonly="">
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="living_area_range">
                                        <span class="filters-value living_area_range_data"></span>
                                        <div>
                                            <input type="text" id="filter-living-area" value="" name="range" readonly="">
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="beds_range">
                                        <span class="filters-value beds_range_data"></span>
                                        <div>
                                            <input type="text" id="filter-beds" value="" name="range"  readonly="">
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="baths_range">
                                        <span class="filters-value baths_range_data"></span>
                                        <div>
                                            <input type="text" id="filter-baths" value="" name="range" readonly="">
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="garage_range">
                                        <span class="filters-value garage_range_data"></span>
                                        <div>
                                            <input type="text" id="filter-garage" value="" name="range" readonly="">
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="floors_range">
                                        <span class="filters-value floors_range_data"></span>
                                        <div>
                                            <input type="text" id="filter-floors" value="" name="range" readonly="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="header">
                            <h2>Search Results</h2>
                        </div>
                        <div class="community-main-header-bg sr-scroll-main">
                            <div class="search-results-main">
                                <div id="search-results" class="shuffle" style="position: relative; overflow: auto; height: calc(100vh - 408px);">   
                                <p class="text-white py-2 text-center">Please select the lot first</p>                              
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="note-area-main p-3">
                            <textarea class="form-control" name="text_msg" id="msg" placeholder="Enter Message">{{(Route::currentRouteName() == 'xhome')?$home_msg: $floor_msg}}</textarea>
                            <div class="row">
                                <div class="col-6 pr-1">
                                    <button class="btn btn-default clear-btn waves-effect waves-light">Clear</button>
                                </div>
                                <div class="col-6 pl-1">
                                    <button id="msg_save" class="btn btn-primary save-btn waves-effect waves-light">Save</button>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>              
</div>
