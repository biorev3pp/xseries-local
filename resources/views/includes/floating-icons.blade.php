<!-- Floating Buttons -->
<div class="welcome-message" id="feature-tour-message">
    <div class="arrow">
        <div class="outer"></div>
        <div class="inner"></div>
    </div>
    <div class="message-body">
        <p>Need any assistance? Get a tour now.</p>
    </div>
</div>
<ul class="fixed-floating-buttons-left">
    <li id="feature-tour-button">
        <a href="javascript:void(0)" id="demo" data-demo>
            <p>Features Tour</p> 
            <span class="material-icons">
            live_help
            </span>
        </a>
    </li>
    <li>
        <a href="javascript:void(0)" data-toggle="modal" data-target="#brochure-modal">
            <p>Download Brochure</p> 
            <span class="material-icons dbrochure">
            cloud_download
            </span>
        </a>
    </li>
    <li>
        <a href="javascript:void(0)" data-toggle="modal" data-target="#get-in-touch-modal">
            <p>Get In Touch</p> 
            <span class="material-icons gintouch">
                alternate_email
            </span>
        </a>
    </li>
    <li>
        <a href="javascript:void(0)" data-toggle="modal" data-target="#property-modal">
            <p>Property Info</p> 
            <span class="material-icons proinfo">
                home
            </span>
        </a>
    </li>
    <li>
        <a href="javascript:void(0)" data-toggle="modal" data-target="#mortgage-modal">
            <p>Mortgage Calculator</p> 
            <span class="material-icons mcalculate">
                calculate
            </span>
        </a>
    </li>
    <li>
        <a href="javascript:void(0)" data-toggle="modal" data-target="#map-modal">
            <p>Check Location</p> 
            <span class="material-icons checklocation">
                map
            </span>
        </a>
    </li>
    @if(Route::currentRouteName() != 'xfloor')
    <li>
        <a href="javascript:void(0)" data-lid="" id="generate_estimate">
            <p>Generate Estimate</p> 
            <span class="material-icons pestimate">
                receipt_long
            </span>
        </a>
    </li>
    @endif
    <div class="welcome-message estimate-message">
        <div class="arrow">
            <div class="outer"></div>
            <div class="inner"></div>
        </div>
        <div class="message-body">
            <p>Click here to generate estimate</p>
        </div>
    </div>
</ul>
<!-- Mobile Tray Menu Floating Icons -->
<div class="map-mobile-icon" id="tray-menu">
	<ul class="tray-menu-buttons">
		<li>
			
		</li>
		<li>
			<a href="javascript:void(0)" data-toggle="modal" data-target="#brochure-modal"> <span class="material-icons">
          cloud_download
          </span> </a>
		</li>
		<li>
			<a href="javascript:void(0)" data-toggle="modal" data-target="#get-in-touch-modal"> <span class="material-icons">
              alternate_email
          </span> </a>
		</li>
		<li>
			<a href="javascript:void(0)" data-toggle="modal" data-target="#property-modal"> <span class="material-icons">
              home
          </span> </a>
		</li>
		<li>
			<a href="javascript:void(0)" data-toggle="modal" data-target="#mortgage-modal"> <span class="material-icons">
              calculate
          </span> </a>
		</li>
		<li>
			<a href="javascript:void(0)" data-toggle="modal" data-target="#map-modal"> 
                <span class="material-icons">
                    map
                </span> 
            </a>
        </li>
        @if(Route::currentRouteName() != 'xfloor')
        <li>
			<a href="javascript:void(0)" data-lid="" id="generate_estimate"> 
                <span class="material-icons">
                    receipt_long
                </span> 
            </a>
		</li>
        @endif
    </ul> 
    <span class="material-icons right-arrow">
    chevron_right
    </span> 
</div>
<!-- End Floating Buttons -->
<!--    Brochure Modal-->
<div class="modal fade right inner-sliding-modal" id="brochure-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
		<div class="modal-content">
			<!--Header-->
			<div class="modal-header">
				<div class="d-flex"> <span class="material-icons mr-2">
            cloud_download
            </span>
					<h5>Download brochure</h5> </div>
				<div data-toggle="collapse" data-target="#floor-tab-1" class="close-tab" data-dismiss="modal" aria-label="Close"> <span class="material-icons cross">
            cancel
            </span> </div>
			</div>
			<!--Body-->
			<div class="modal-body">
				<div class="h-100 brochure-image-wrapper justify-content-center">
					<a href="/uploads/brochure.png" class="h-100"> <img class="h-100" src="/uploads/brochure.png">
						<div class="middle">
							<div class="text">View</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!--    End of Brochure Modal-->
<!--    Get in touch Modal-->
<div class="modal fade right inner-sliding-modal" id="get-in-touch-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
		<div class="modal-content">
			<!--Header-->
			<div class="modal-header">
				<div class="d-flex"> <span class="material-icons mr-2">
            alternate_email
            </span>
					<h5>Get In touch</h5> </div>
				<div data-toggle="collapse" data-target="#floor-tab-1" class="close-tab" data-dismiss="modal" aria-label="Close"> <span class="material-icons cross">
            cancel
            </span> </div>
			</div>
			<!--Body-->
			<div class="modal-body">
				<form id="contact_submit">
					<div class="form-group">
						<div class="input-group"> <span class="input-group-addon"><i class="icon-user"></i></span>
							<input type="text" class="form-control h-auto" id="username" required placeholder="Enter Full Name"> </div>
					</div>
					<div class="form-group">
						<div class="input-group"> <span class="input-group-addon"><i class="icon-envelope"></i></span>
							<input type="email" class="form-control h-auto" id="useremail" required placeholder="Enter Email"> </div>
					</div>
					<div class="form-group">
						<div class="input-group"> <span class="input-group-addon"><i class="icon-screen-smartphone"></i></span>
							<input type="mobile" class="form-control h-auto" id="usermobile" required placeholder="Enter Contact Number"> </div>
					</div>
					<div class="form-group">
						<div class="input-group"> <span class="input-group-addon"><i class="icon-speech"></i></span>
							<textarea style="height:100px; padding-top:11px;" class="form-control" id="userMessage" required placeholder="Enter Message"></textarea>
						</div>
					</div>
					<div class="form-group">
						<button type="submit" style="cursor: pointer;" class="btn btn-block btn-success btn-lg login-button">Contact</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--    End of Get in touch Modal-->
<!--    Property Modal-->
<div class="modal fade right inner-sliding-modal" id="property-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <div class="d-flex">
                    <span class="material-icons mr-2">
                    home
                    </span>
                    <h5>Property Info</h5>
                </div>
                <div data-toggle="collapse" data-target="#floor-tab-1" class="close-tab" data-dismiss="modal" aria-label="Close">
                    <span class="material-icons cross">
                    cancel
                    </span>
                </div>
            </div>
            <!-- Spinner/Loader -->
            <svg xmlns:svg="http://www.w3.org/2000/svg" id="property-loader" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);opacity:0; transition: 0.3s ease opacity;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="40px" height="40px" viewBox="0 0 128 128" xml:space="preserve"><g><linearGradient id="linear-gradient-property"><stop offset="0%" stop-color="#ffffff" fill-opacity="0"/><stop offset="100%" stop-color="#4d4d4d" fill-opacity="1"/></linearGradient><path d="M63.85 0A63.85 63.85 0 1 1 0 63.85 63.85 63.85 0 0 1 63.85 0zm.65 19.5a44 44 0 1 1-44 44 44 44 0 0 1 44-44z" fill="url(#linear-gradient-property)" fill-rule="evenodd"/><animateTransform attributeName="transform" type="rotate" from="0 64 64" to="360 64 64" dur="1080ms" repeatCount="indefinite"></animateTransform></g></svg>
            <!--Body-->
            <div class="modal-body show-modal-body" style="opacity:0; transition:0.3s ease opacity;">
                <div class="row h-100">
                    <div class="col-md-6 border-right h-100">
                        <div class="property-image mb-3">
                            @foreach( explode(',', $home->gallery) as  $key => $gallery)
                            <a href="{{asset('uploads/homes/'.$gallery)}}">
                                <img src="{{asset('uploads/homes/'.$gallery)}}" />
                            </a>
                            @endforeach
                        </div>
                        <h4 class="border-bottom m-0">
                            {{$home->title}} 
                        </h4>
                        <div class="d-flex mt-3 justify-content-between">
                            <div class="property-info mb-1">
                                <img class="d-inline-block" src="/Xseries-new-ui/images/price.PNG">
                                <p class="d-inline-block home-price"><span>${{env('CURRENCY').number_format($home->price)}}</span></p>
                            </div>
                            <div class="property-info mb-1">
                                <img class="d-inline-block" src="/Xseries-new-ui/images/areas.png">
                                <p class="d-inline-block area"> <span>{{number_format($home->area)}}</span> Sqft</p>
                            </div>
                        </div>  
                        <div class="d-flex mt-3 justify-content-between">
                            <div class="property-info">
                                <img class="d-inline-block" src="/Xseries-new-ui/images/3-bedroom.png">
                                <p class="d-inline-block bed"> <span>{{$home->bedroom}}</span> Bedrooms</p>
                            </div>
                            <div class="property-info">
                                <img class="d-inline-block" src="/Xseries-new-ui/images/2-bedroom.png">
                                <p class="d-inline-block bath"> <span>{{$home->bathroom}}</span> Bathrooms</p>
                            </div>
                        </div>  
                        <div class="d-flex mt-3">
                            <div class="property-info">
                                <img class="d-inline-block" src="/Xseries-new-ui/images/floor.PNG">
                                <p class="d-inline-block floor"> <span>{{$home->floor}}</span> Floors</p>
                            </div>
                            <div class="property-info">
                                <img class="d-inline-block" src="/Xseries-new-ui/images/2-garage.png">
                                <p class="d-inline-block garage"> <span>{{$home->garage}}</span> Garages</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 h-100 floor-tabs-wrapper">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs border-bottom-0 justify-content-center">
                            @foreach($home->floors as $key => $floor_data)
                            @if($key == 0)
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link active" data-toggle="tab" href="#floor_plan{{$floor_data->id}}">{{$floor_data->title}}</a>
                                </li>
                            @else
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-toggle="tab" href="#floor_plan{{$floor_data->id}}">{{$floor_data->title}}</a>
                                </li>
                            @endif
                            @endforeach
                        </ul>
                        <!-- Tab panes -->
                        
                        <div class="tab-content">
                        @if(sizeof($home->floors) == 0)
                        <div class="alert alert-info" role="alert">
                            Floor Plans Coming Soon!
                        </div>
                        @endif
                        @foreach($home->floors as $key => $floor_data)
                        @if($key == 0)
                        <div class="tab-pane active h-100" id="floor_plan{{$floor_data->id}}">
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
                        <div class="tab-pane h-100" id="floor_plan{{$floor_data->id}}">
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
</div>
<!--    End of Property Modal-->
<!-- Mortgage Calculator Modal -->
<div class="modal fade right mortgage-calculator inner-sliding-modal" id="mortgage-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <div class="d-flex">
                    <span class="material-icons mr-2">
                    calculate
                    </span>
                    <h5>Mortgage Calculator</h5>
                </div>
                <div data-toggle="collapse" data-target="#floor-tab-1" class="close-tab" data-dismiss="modal" aria-label="Close">
                    <span class="material-icons cross">
                    cancel
                    </span>
                </div>
            </div>
            <!--Body-->
            <div class="modal-body h-100">
                <div class="row h-100">
                    <div class="col-md-5 h-100 mortgage-overflow">
                        <div class="mortgage-calculator-form-box h-100">
                            <form>
                                <div class="form-group">
                                    <div class="mgc-form-field mgc-form-field-error">
                                        <label for="inputs-homeprice">Total price</label>
                                        <div class="mgc-input-overlay_left inputs-homeprice">
                                            <div class="mgc-input-overlay-text_left">$</div>
                                            @php $home_lot_price=Session::get('total_price');@endphp
                                            <input type="tel" id="amount" class="form-control amount" value="{{$home_lot_price}}" autocomplete="off" readonly placeholder="0" onkeyup="calculatePayment()">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mgc-form-field mgc-form-field-error">
                                        <label for="inputs-downpayment">Down payment</label>
                                        <div class="down-payment-container">
                                            <div class="mgc-input-overlay_left downPayment">
                                                <div class="mgc-input-overlay-text_left">$</div>
                                                <input type="tel" id="downpay_amt" class="form-control downpay_amt" value="" autocomplete="off" onkeyup="downpayment()" />
                                            </div>
                                            <div class="mgc-input-overlay_right downPercent">
                                                <input type="text" class="form-control downpay_rate" id="downpay_rate" value="20" autocomplete="off" onkeyup="downrate()">
                                                <div class="mgc-input-overlay-text_right">%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputs-term">Term </label>
                                    <select id="term" class="term form-control" onchange="calculatePayment()">
                                        <option selected value="30y">30-year fixed</option>
                                        <option value="15y">15-year fixed</option>
                                        <option value="5y">5/1 ARM</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputs-rate">Rate (APR):<a href="https://www.zillow.com/mortgage-rates/?value=300000&amp;down=60000&amp;auto=true&amp;source=Z_Mortgage_Calc_rates" rel="nofollow" style="float: right;font-weight: 500; color:#0079e1;" target="_blank">See current rates</a></label>
                                    <div class="mgc-input-overlay_right inputs-rate">
                                        <input type="number" id="rate" class="form-control rate" value="4.1" autocomplete="off" onkeyup="calculatePayment()">
                                        <div class="mgc-input-overlay-text_right" style="padding:4.4px 17px; right:1px; top: 1px;color: #495057; font-weight: 400; background-color:#eaecef; border-left:1px solid #cacaca;">%</div>
                                    </div>
                                </div>
                            </form>
                            <div class="circle-div">
                                <div class="circle">
                                    <text y="-10">Your payment</text>
                                    <p class="estimate" id="payment"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 h-100 mortgage-list-overflow" style="overflow-y: auto;">
                        <div class="mortgage-calculator-right-box">
                            <div class="right-box-border"></div>
                            <div class="mortgage-contain">
                                <div id="home_customization">
                                    <h2>Community: <?= $community->name ?></h2>
                                    <div class="base-price">Lot Price
                                        <span id="slotp">${{(Session::get('lot_price'))?env('CURRENCY').number_format(Session::get('lot_price')):0}}</span>
                                        <input type="hidden" name="slot_id" id="slot_id" value="{{(Session::get('lot_price'))?Session::get('lot_price'):0}}">
                                    </div>
                                    <hr>
                                    <h2>Home: <span id="shome">{{$home->title}} @if($home_type)<span class="m-0 home-type-title-mortgage">- {{$home_type->title}}</span> @endif</span></h2>
                                    <div class="base-price">Home Price <span id="shmprice">${{(Session::has('base_price'))?env('CURRENCY').number_format(Session::get('base_price')):0}}</span></div>
                                    <input type="hidden" name="shome_id" id="shome_id" value="{{(Session::get('base_price'))?Session::get('base_price'):0}}">
                                    <hr>
                                    @if(Route::currentRouteName() != "xplat" && Route::currentRouteName() != "plat")
                                    <h2 class="d-none"><span id="total_cost">{{$home_lot_price}}</span></h2>
                                    <div id="new_data">
                                    @if(Session::has('home_customization'))
                                        <?php echo Session::get('home_customization');?>
                                        @else
                                        <h2>Exterior Customization</h2>
                                        <div id="mort_color_scheme_price">
                                        </div>
                                        <div id="mort_upgrade_options">
                                        </div>
                                    @endif
                                    </div>
                                    <hr>
                                    @endif
                                    @if(Route::currentRouteName() == "xfloor" || Route::currentRouteName() == "estimate")
                                    <div id="new_data_floor">
                                        <div id="floor_customization"> @if(Session::has('floor_customization'))
                                            <?php echo Session::get('floor_customization');?> @else @php $i=0;@endphp @foreach($home->floors as $floor) @php $i++;@endphp
                                            <h2>{{$floor->title}} Customization</h2>
                                            <div id="floor_customization{{$i}}"> </div> @endforeach @endif 
                                        </div>
                                    </div>
                                    @endif
                                    <h2>Total Price</h2>
                                    <div class="price-text">
                                        <p class="estimate" id="paymentss" style="display: none;"></p>
                                        <span class="estimate" id="amount_display">${{(Session::get('total_price'))?env('CURRENCY').number_format(Session::get('total_price')):'--'}}</span>
                                    </div>
                                    <div class="price-text" style="visibility: hidden;">
                                        <p id="payments"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Mortgage Calculator Modal -->
<!--    Elevation Type Modal-->
<div class="modal fade right inner-sliding-modal" id="elevation-type-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <div class="d-flex">
                    <span class="material-icons mr-2" style="background: #7bc22a;">
                    home
                    </span>
                    <h5>{{(Route::currentRouteName() == 'xplat' || Route::currentRouteName() == 'plat' )?'Elevation Types':'Feature'}}</h5>
                </div>
                <div data-toggle="collapse" data-target="#floor-tab-1" class="close-tab" data-dismiss="modal" aria-label="Close">
                    <span class="material-icons cross">
                    cancel
                    </span>
                </div>
            </div>
            <!--Body-->
            @if(Route::currentRouteName() == "xplat" || Route::currentRouteName() == "plat")
            <div class="modal-body pt-2 pl-2 pr-2">
            </div>
            @endif
            @if(Route::currentRouteName() == "xhome")
            <div class="modal-body pl-4 pb-4" style="overflow-y:auto;">
                <!-- Spinner/Loader -->
                <svg xmlns:svg="http://www.w3.org/2000/svg" id="loader" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);opacity:0; transition: 0.3s ease opacity;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="40px" height="40px" viewBox="0 0 128 128" xml:space="preserve"><g><linearGradient id="linear-gradient"><stop offset="0%" stop-color="#ffffff" fill-opacity="0"/><stop offset="100%" stop-color="#4d4d4d" fill-opacity="1"/></linearGradient><path d="M63.85 0A63.85 63.85 0 1 1 0 63.85 63.85 63.85 0 0 1 63.85 0zm.65 19.5a44 44 0 1 1-44 44 44 44 0 0 1 44-44z" fill="url(#linear-gradient)" fill-rule="evenodd"/><animateTransform attributeName="transform" type="rotate" from="0 64 64" to="360 64 64" dur="1080ms" repeatCount="indefinite"></animateTransform></g></svg>
                <div class="feature-wrapper">
                    <div class="feature-image-wrapper pb-3">
                        <img class="w-100 border border-dark" src="">
                    </div>
                    <div class="d-flex mb-2">
                        <span class="material-icons" style="font-size: 40px;padding: 0 10px 0 0px;">
                            texture
                        </span>
                        <div class="feature-text">
                            <h6 class="d-block" style="font-size: 13px;text-transform: uppercase;color: #666;line-height: 1.7;">
                            Material
                            </h6>
                            <p class="d-block m-0 f-material" style="font-size: 16px;line-height: 0.6; text-transform:capitalize;">
                            </p>
                        </div>
                    </div>
                    <div class="d-flex mb-2 ">
                        <span class="material-icons" style="font-size: 40px;padding: 0 10px 0 0px;">
                            construction
                        </span>
                        <div class="feature-text">
                            <h6 class="d-block" style="font-size: 13px;text-transform: uppercase;color: #666;line-height: 1.7;">
                            Manufacturer
                            </h6>
                            <p class="d-block m-0 f-manufacturer" style="font-size: 16px;line-height: 0.6; text-transform:capitalize;">
                            </p>
                        </div>
                    </div>
                    <div class="d-flex mb-2 ">
                        <span class="material-icons" style="font-size: 40px;padding: 0 10px 0 0px;">
                            portrait
                        </span>
                        <div class="feature-text">
                            <h6 class="d-block" style="font-size: 13px;text-transform: uppercase;color: #666;line-height: 1.7;">
                            Name
                            </h6>
                            <p class="d-block m-0 f-name" style="font-size: 16px;line-height: 0.6; text-transform:capitalize;">
                            </p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <span class="material-icons" style="font-size: 40px;padding: 0 10px 0 0px;">
                            lock_open
                        </span>
                        <div class="feature-text">
                            <h6 class="d-block" style="font-size: 13px;text-transform: uppercase;color: #666;line-height: 1.7;">
                            Id
                            </h6>
                            <p class="d-block m-0 f-id" style="font-size: 16px;line-height: 0.6; text-transform:capitalize;">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<!--    End of Elevation Type Modal-->
<!--    Check Location Modal-->
<div class="modal fade right inner-sliding-modal" id="map-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <div class="d-flex">
                    <span class="material-icons mr-2">
                    map
                    </span>
                    <h5>Check Location</h5>
                </div>
                <div data-toggle="collapse" data-target="#floor-tab-1" class="close-tab" data-dismiss="modal" aria-label="Close">
                    <span class="material-icons cross">
                    cancel
                    </span>
                </div>
            </div>
            <!--Body-->
            <div class="modal-body">
                <div class="row h-100">
                    <div class="col-xl-4 col-lg-5 col-md-4 h-100 pr-0 pl-0 height-resp">
                        <div class="map-menu-wrapper h-100">
                            <div class="search-box-wrap">
                                <input type="text" name="" class="search-box form-control controls" 
                                placeholder="Search" id="search-box">
                                <span class="material-icons areset-icon">
                                search
                                </span>
                            </div>
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="pills-hospital-tab" data-toggle="pill" 
                                        href="#pills-hospital" role="tab" aria-controls="pills-hospital" 
                                        aria-selected="true">
                                        <div class="map-menu-icons">
                                            <span class="material-icons" style="font-size:20px; line-height:40px;">
                                            healing
                                            </span>
                                        </div>
                                    </a>
                                    <p class="mb-0 mt-2">Hospitals</p>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-school-tab" data-toggle="pill" 
                                        href="#pills-school" role="tab" aria-controls="pills-school" 
                                        aria-selected="false">
                                        <div class="map-menu-icons">
                                            <i class="icon-graduation"></i>
                                        </div>
                                    </a>
                                    <p class="mb-0 mt-2">Schools</p>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-rest-tab" data-toggle="pill" 
                                        href="#pills-rest" role="tab" aria-controls="pills-rest" 
                                        aria-selected="false">
                                        <div class="map-menu-icons">
                                            <i class="icon-cup"></i>
                                        </div>
                                    </a>
                                    <p class="mb-0 mt-2">Restaurants</p>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-mall-tab" data-toggle="pill" 
                                        href="#pills-mall" role="tab" aria-controls="pills-mall" 
                                        aria-selected="false">
                                        <div class="map-menu-icons">
                                            <i class="icon-bag"></i>
                                        </div>
                                    </a>
                                    <p class="mb-0 mt-2">Malls</p>
                                </li>
                            </ul>
                            <div class="tab-content map-menu-list-wrap" id="pills-tabContent">
                                @if($nearby)
                                <div class="tab-pane fade show active" id="pills-hospital" role="tabpanel" aria-labelledby="pills-hospital-tab">
                                    @if($nearby['hospital'])
                                    @foreach($nearby['hospital'] as $key => $hospital)
                                    @if($key == 0)
                                    <hr class="mt-0">
                                    <div class="d-flex">
                                        <div class="map-menu-icons mr-3 ml-0 hospital-icon">
                                            <span class="material-icons" style="font-size:20px; line-height:40px;">
                                            healing
                                            </span>
                                        </div>
                                        <a href="javascript:google.maps.event.trigger(gmarkers['{{ $hospital->name}}'],'click')">
                                            <p class="m-0" lat="{{$hospital->lat}}" lng="{{$hospital->lng}}"
                                                location_title="{{$hospital->name}}">
                                                {{$hospital->name}} <br>
                                                <small>{{$hospital->distance}} Miles away from Community</small>
                                            </p>
                                        </a>
                                    </div>
                                    @elseif($key == sizeof($nearby['hospital']) - 1)
                                    <hr>
                                    <div class="d-flex">
                                        <div class="map-menu-icons mr-3 ml-0 hospital-icon">
                                            <span class="material-icons" style="font-size:20px; line-height:40px;">
                                            healing
                                            </span>
                                        </div>
                                        <a href="javascript:google.maps.event.trigger(gmarkers['{{ $hospital->name}}'],'click')">
                                            <p class="m-0" lat="{{$hospital->lat}}" lng="{{$hospital->lng}}"
                                                location_title="{{$hospital->name}}">
                                                {{$hospital->name}} <br>
                                                <small>{{$hospital->distance}} Miles away from Community</small>
                                            </p>
                                        </a>
                                    </div>
                                    <hr class="mb-0">
                                    @else
                                    <hr>
                                    <div class="d-flex">
                                        <div class="map-menu-icons mr-3 ml-0 hospital-icon">
                                            <span class="material-icons" style="font-size:20px; line-height:40px;">
                                            healing
                                            </span>
                                        </div>
                                        <a href="javascript:google.maps.event.trigger(gmarkers['{{ $hospital->name}}'],'click')">
                                            <p class="m-0" lat="{{$hospital->lat}}" lng="{{$hospital->lng}}"
                                                location_title="{{$hospital->name}}">
                                                {{$hospital->name}} <br>
                                                <small>{{$hospital->distance}} Miles away from Community</small>
                                            </p>
                                        </a>
                                    </div>
                                    @endif
                                    @endforeach
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="pills-school" role="tabpanel" aria-labelledby="pills-school-tab">
                                    @if($nearby['school'])
                                    @foreach($nearby['school'] as $key => $school)
                                    @if($key == 0)
                                    <hr class="mt-0">
                                    <div class="d-flex">
                                        <div class="map-menu-icons mr-3 ml-0 school-icon">
                                            <i class="icon-graduation"></i>
                                        </div>
                                        <a href="javascript:google.maps.event.trigger(gmarkers['{{ $school->name}}'],'click')">
                                            <p class="m-0"  lat="{{$school->lat}}" lng="{{$school->lng}}"
                                                location_title="{{$school->name}}">
                                                {{$school->name}} <br>
                                                <small>{{$school->distance}} Miles away from Community</small>
                                            </p>
                                        </a>
                                    </div>
                                    @elseif($key == sizeof($nearby['school']) - 1)
                                    <hr>
                                    <div class="d-flex">
                                        <div class="map-menu-icons mr-3 ml-0 school-icon">
                                            <i class="icon-graduation"></i>
                                        </div>
                                        <a href="javascript:google.maps.event.trigger(gmarkers['{{ $school->name}}'],'click')">
                                            <p class="m-0"  lat="{{$school->lat}}" lng="{{$school->lng}}"
                                                location_title="{{$school->name}}">
                                                {{$school->name}} <br>
                                                <small>{{$school->distance}} Miles away from Community</small>
                                            </p>
                                        </a>
                                    </div>
                                    <hr class="mb-0">
                                    @else
                                    <hr>
                                    <div class="d-flex">
                                        <div class="map-menu-icons mr-3 ml-0 school-icon">
                                            <i class="icon-graduation"></i>
                                        </div>
                                        <a href="javascript:google.maps.event.trigger(gmarkers['{{ $school->name}}'],'click')">
                                            <p class="m-0"  lat="{{$school->lat}}" lng="{{$school->lng}}"
                                                location_title="{{$school->name}}">
                                                {{$school->name}} <br>
                                                <small>{{$school->distance}} Miles away from Community</small>
                                            </p>
                                        </a>
                                    </div>
                                    @endif
                                    @endforeach
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="pills-rest" role="tabpanel" aria-labelledby="pills-rest-tab">
                                    @if($nearby['restaurant'])
                                    @foreach($nearby['restaurant'] as $key => $restaurant)
                                    @if($key == 0)
                                    <hr class="mt-0">
                                    <div class="d-flex">
                                        <div class="map-menu-icons mr-3 ml-0 rest-icon">
                                            <i class="icon-cup"></i>
                                        </div>
                                        <a href="javascript:google.maps.event.trigger(gmarkers['{{ $restaurant->name}}'],'click')">
                                            <p class="m-0" lat="{{$restaurant->lat}}" lng="{{$restaurant->lng}}"
                                                location_title="{{$restaurant->name}}">
                                                {{$restaurant->name}}<br>
                                                <small>{{$restaurant->distance}} Miles away from Community</small>
                                            </p>
                                        </a>
                                    </div>
                                    @elseif($key == sizeof($nearby['restaurant']) - 1)
                                    <hr>
                                    <div class="d-flex">
                                        <div class="map-menu-icons mr-3 ml-0 rest-icon">
                                            <i class="icon-cup"></i>
                                        </div>
                                        <a href="javascript:google.maps.event.trigger(gmarkers['{{ $restaurant->name}}'],'click')">
                                            <p class="m-0" lat="{{$restaurant->lat}}" lng="{{$restaurant->lng}}"
                                                location_title="{{$restaurant->name}}">
                                                {{$restaurant->name}}<br>
                                                <small>{{$restaurant->distance}} Miles away from Community</small>
                                            </p>
                                        </a>
                                    </div>
                                    <hr class="mb-0">
                                    @else
                                    <hr>
                                    <div class="d-flex">
                                        <div class="map-menu-icons mr-3 ml-0 rest-icon">
                                            <i class="icon-cup"></i>
                                        </div>
                                        <a href="javascript:google.maps.event.trigger(gmarkers['{{ $restaurant->name}}'],'click')">
                                            <p class="m-0" lat="{{$restaurant->lat}}" lng="{{$restaurant->lng}}"
                                                location_title="{{$restaurant->name}}">
                                                {{$restaurant->name}}<br>
                                                <small>{{$restaurant->distance}} Miles away from Community</small>
                                            </p>
                                        </a>
                                    </div>
                                    @endif
                                    @endforeach
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="pills-mall" role="tabpanel" aria-labelledby="pills-mall-tab">
                                    @if($nearby['shopping_mall'])
                                    @foreach($nearby['shopping_mall'] as $key => $shopping_mall)
                                    @if($key == 0)
                                    <hr class="mt-0">
                                    <div class="d-flex">
                                        <div class="map-menu-icons mr-3 ml-0 mall-icon">
                                            <i class="icon-bag"></i>
                                        </div>
                                        <a href="javascript:google.maps.event.trigger(gmarkers['{{ $shopping_mall->name}}'],'click')">
                                            <p class="m-0" lat="{{$shopping_mall->lat}}" lng="{{$shopping_mall->lng}}"
                                                location_title="{{$shopping_mall->name}}">
                                                {{$shopping_mall->name}} <br>
                                                <small>{{$shopping_mall->distance}} Miles away from Community</small>
                                            </p>
                                        </a>
                                    </div>
                                    @elseif($key == sizeof($nearby['shopping_mall']) - 1)
                                    <hr>
                                    <div class="d-flex">
                                        <div class="map-menu-icons mr-3 ml-0 mall-icon">
                                            <i class="icon-bag"></i>
                                        </div>
                                        <a href="javascript:google.maps.event.trigger(gmarkers['{{ $shopping_mall->name}}'],'click')">
                                            <p class="m-0" lat="{{$shopping_mall->lat}}" lng="{{$shopping_mall->lng}}"
                                                location_title="{{$shopping_mall->name}}">
                                                {{$shopping_mall->name}} <br>
                                                <small>{{$shopping_mall->distance}} Miles away from Community</small>
                                            </p>
                                        </a>
                                    </div>
                                    <hr>
                                    @else
                                    <hr>
                                    <div class="d-flex">
                                        <div class="map-menu-icons mr-3 ml-0 mall-icon">
                                            <i class="icon-bag"></i>
                                        </div>
                                        <a href="javascript:google.maps.event.trigger(gmarkers['{{ $shopping_mall->name}}'],'click')">
                                            <p class="m-0" lat="{{$shopping_mall->lat}}" lng="{{$shopping_mall->lng}}"
                                                location_title="{{$shopping_mall->name}}">
                                                {{$shopping_mall->name}} <br>
                                                <small>{{$shopping_mall->distance}} Miles away from Community</small>
                                            </p>
                                        </a>
                                    </div>
                                    @endif
                                    @endforeach
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7 col-md-8 h-100 pl-0">
                        <div id="map-canvas" class="h-100 w-100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--    End of Check Location Modal-->
<script>
function automapReset() {
    $('#search-box').val('');
    $('.areset-icon').removeClass('cursor-pointer').removeAttr('onclick').html('search');
}
var map;
var InforObj = [];
var gmarkers = [];
var markers = [];
var nmarker = [];
//var locations=[{lat:48.0259021,lng:-114.0710105}, {lat:32.8950174,lng:-96.9399379}, {lat:32.897033,lng:-96.940108}, {lat:32.898965,lng:-96.940413}];
var locations=new Array();
var titles=new Array();
var icons=new Array();
var distance=new Array();
var address=new Array();
var all_icons = {
        hospital: '/images/hospital_H_pinlet-2-medium.png',
        shopping_mall: '/images/shoppingbag_pinlet-2-medium.png',
        school: '/images/school_pinlet-2-medium.png',
        restaurant: '/images/restaurant_pinlet-2-medium.png'
        };
locations.push({'lat': <?= ($community->lat != '')?$community->lat:'48.0667';?>, 'lng': <?= ($community->lng !='')?$community->lng:'-114.0895';?>});
titles.push('<?= ($community->name !='')?$community->name:'Your title will be here';?>');
icons.push("<?= asset('images/spotlight_pin_v2_accent-1-small.png') ?>");
distance.push('');
address.push('<?= ($community->location != '')?$community->location:'';?>');
<?php if($nearby) {
    foreach($nearby as $nkey => $nvalue) {
        if(is_array($nvalue)) $nlist = $nvalue; else $nlist = get_object_vars($nvalue);
            foreach($nlist as $lvalue){ if($nkey <= 2){ ?>
            locations.push({'lat':{{ isset($lvalue->lat)?$lvalue->lat:''}},'lng':{{ isset($lvalue->lng)?$lvalue->lng:''}}});
            titles.push("{{ isset($lvalue->name)?$lvalue->name:''}}");
            distance.push("({{ isset($lvalue->distance)?$lvalue->distance:''}} Miles)");
            address.push("{{ isset($lvalue->address)?$lvalue->address:''}}");
            icons.push(all_icons.{{$nkey}});
            //  console.log('{{$nkey}}');
            <?php
            } }                                      
    }
}?>
function initMap() {
    // console.log(locations);
    var directionsService = new google.maps.DirectionsService();
    var directionsRenderer = new google.maps.DirectionsRenderer();
    var map = new google.maps.Map(document.getElementById('map-canvas'), {
        //center: {lat: 48.0667, lng: -114.0895},
        center: {lat: <?= ($community->lat != '')?$community->lat:'48.0667';?>, lng: <?= ($community->lng !='')?$community->lng:'-114.0895';?>},
        zoom: 13,
        mapTypeId: <?= ($community->map_type_id != '')?"'".$community->map_type_id."'":'roadmap';?>,
        zoomControl: true,
        controlSize: 32,
        zoomControlOptions: {
            position: google.maps.ControlPosition.LEFT_TOP,
        },
        streetViewControlOptions: {
            position: google.maps.ControlPosition.LEFT_TOP 
        },
    });
    var nmarker = new google.maps.Marker({map: map});
    //new AutocompleteDirectionsHandler(map);
    //The map() method here has nothing to do with the Google Maps API.
    directionsRenderer.setMap(map);
    locations.map(function(location, i) {
        var contentString = '<div id="infowindow-content"><div id="place-image"><img src="'+icons[i]+'" width="60" height="60" id="place-icon" /></div><div id="place-name" class="title">'+titles[i]+'<br>'+distance[i]+'</div><div id="place-address">'+address[i]+'</div></div>';
        var marker = new google.maps.Marker({
                position: locations[i],
                map: map,
                icon: icons[i]
            });
        const infowindow = new google.maps.InfoWindow({
            content: contentString,
            maxWidth: 400
        });
        marker.addListener('click', function () {
            closeOtherInfo();
            nmarker.setVisible(false);
            infowindow.open(marker.get('map'), marker);
            InforObj[0] = infowindow;
            calculateAndDisplayRoute(directionsService, directionsRenderer,locations[i]);
        });
        gmarkers[titles[i]] = marker;
    });

    //var bounds = new google.maps.LatLngBounds();
    //map.fitBounds(bounds);

        // Property Marker
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
                <div class="property-list-box-title pt-2 pl-2 pb-2">
                    <h3 class="pr-0" style="text-transform:uppercase; font-size:14px; font-weight:600; margin-bottom:6px;"> <?= $community->name?></h3>
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

    var destinationInput = document.getElementById('search-box');
    var adistance = '';
    //console.log(destinationInput);

    var destinationAutocomplete = new google.maps.places.Autocomplete(destinationInput);
    destinationAutocomplete.setComponentRestrictions({'country':'us'});
    //destinationAutocomplete.setFields(['place_id']);
    destinationAutocomplete.setFields(["place_id", "address_components", "formatted_address", "geometry", "icon", "name", "photos"]);

    destinationAutocomplete.addListener("place_changed", () => {
        //directionsRenderer.setMap(null);
        $('.areset-icon').addClass('cursor-pointer').attr('onclick', 'automapReset()').html('close');
        const place = destinationAutocomplete.getPlace();
        if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
        }
        getDistance(place.place_id);
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(14); // Why 17? Because it looks good.
        }
        nmarker.setPosition(place.geometry.location);
        nmarker.setVisible(true);
        let address = "";

        if (place.address_components) {
            address = [
            (place.address_components[0] &&
                place.address_components[0].short_name) ||
                "",
            (place.address_components[1] &&
                place.address_components[1].short_name) ||
                "",
            (place.address_components[2] &&
                place.address_components[2].short_name) ||
                ""
            ].join(" ");
        }
        let photo = ''; pclass = ''; pid = 'place-image';
        if(place.photos) {
            photo = place.photos[0].getUrl({maxWidth: 250, maxHeight: 250});
            pclass = 'place-icon3'; pid = 'place-image2';
        } else {
            photo = place.icon;
            pclass = 'place-icon2';
        }
        closeOtherInfo();
        var contentString = '<div id="infowindow-content"><div id="'+pid+'"><img src="'+photo+'" id="'+pclass+'" /></div><div id="place-name" class="title">'+place.name+'<br> (<span id="place-distance">0</span> Miles)</div><div id="place-address">'+address+'</div></div>';
        const infowindow = new google.maps.InfoWindow({
            content: contentString,
            maxWidth: 400
        });
        infowindow.open(map, nmarker);
        InforObj[0] = infowindow;

        //InforObj[0] = ninfowindow;
        destinationAutocomplete.addListener('place_changed', function() {
            var place = destinationAutocomplete.getPlace();
            if (!place.place_id) {
                window.alert('Please select an option from the dropdown list.');
                return;
            }
            
        });
        calculateAndDisplayRoute(directionsService, directionsRenderer,{'placeId': place.place_id});
    });
    
}
function calculateAndDisplayRoute(directionsService, directionsRenderer, destination) {
    directionsService.route(
    {
        origin: { lat:<?= $community->lat?>,lng:<?= $community->lng?>},
        destination: destination,
        travelMode: "DRIVING"
    },
    function(response, status) {
        if (status === "OK") {
            directionsRenderer.setDirections(response);
        } else {
            window.alert("Directions request failed due to " + status);
        }
    });
}

function getDistance(pid){
    let lat = '<?= $community->lat?>';
    let lng = '<?= $community->lng?>';
    let des = 0;
    $.ajax({
        type: 'post',
        url: '/api/get-distance',
        data: {'pid':pid, 'lat':lat,'lng':lng},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(result){
            if(result.status =='success')
            { 
                des = 0.000621371*result.data.rows[0].elements[0].distance.value;
            }
            $('#place-distance').html(des.toFixed(1));
        }
    });
}
function closeOtherInfo() {
    if (InforObj.length > 0) {
        /* detach the info-window from the marker ... undocumented in the API docs */
        InforObj[0].set("marker", null);
        /* and close it */
        InforObj[0].close();
        /* blank the array */
        InforObj.length = 0;
    }
}

</script>
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclustererplus@4.0.1.min.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDW-MNsJkIli84no9ZFtyx5uJrEUFPCACE&libraries=places,drawing&callback=initMap" async defer></script>