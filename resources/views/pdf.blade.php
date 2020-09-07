<!doctype html>

<html lang="en">

   <head>

   <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>X-Series </title>
	<style>
	.primary {
		background: #f5564e
	}
	
	.bg_white {
		background: #fff
	}
	
	.bg_light {
		background: #fafafa
	}
	
	.bg_black {
		background: #000
	}
	
	.bg_dark {
		background: rgba(0, 0, 0, .8)
	}
	
	.email-section {
		padding: 2.5em
	}
	
	h1,
	h2,
	h3,
	h4,
	h5,
	h6,
	p {
		font-family: 'calibri', sans-serif;
		color: #000;
		margin-top: 0
	}
	
	body {
		font-family: 'calibri', sans-serif;
		font-weight: 400;
		font-size: 14px;
		line-height: 1.8;
		margin: -15px;
	}
	
	a {
		color: #f5564e
	}
	
	.hero {
		position: relative;
		z-index: 0
	}
	
	.hero .text {
		color: rgba(255, 255, 255, .8);
		padding: 0 4em
	}
	
	.hero .text h2 {
		color: #fff;
		font-size: 40px;
		margin-bottom: 0;
		line-height: 1.2;
		font-weight: 900
	}
	
	.heading-section h2 {
		color: #000;
		font-size: 24px;
		margin-top: 0;
		line-height: 1.4;
		font-weight: 700
	}
	
	.heading-section-white {
		color: rgba(255, 255, 255, .8)
	}
	
	.heading-section-white h2 {
		line-height: 1;
		padding-bottom: 0;
		color: #fff
	}
	
	* {
		box-sizing: border-box
	}
	
	body {
		font-family: 'calibri', sans-serif;
	}
	
	/* .page-break {
		page-break-before: always
	} */
	
	div.table-title {
		display: block;
		margin: auto;
		max-width: 600px;
		padding: 5px;
		width: 100%
	}
	
	.table-title h3 {
		color: #fafafa;
		font-size: 30px;
		font-weight: 400;
		font-style: normal;
		font-family: 'calibri', sans-serif;
		text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
		text-transform: uppercase
	}
	
	.table-fill {
		background: #fff;
		border-radius: 3px;
		border-collapse: collapse;
		margin: auto;
		max-width: 600px;
		padding: 5px;
		width: 100%;
		box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
		animation: float 5s infinite
	}
	
	th {
		color: #D5DDE5;
		background: #1b1e24;
		border-bottom: 4px solid #9ea7af;
		border-right: 1px solid #343a45;
		font-size: 23px;
		font-weight: 100;
		padding: 24px;
		text-align: left;
		text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
		vertical-align: middle
	}
	
	th:first-child {
		border-top-left-radius: 3px
	}
	
	th:last-child {
		border-top-right-radius: 3px;
		border-right: none
	}
	
	.calculation {
		margin-top: 30px
	}
	
	.calculation tr {
		border-top: 1px solid #C1C3D1;
		border-bottom-: 1px solid #C1C3D1;
		color: #000000;
		font-size: 14px;
	}
	
	.calculation tr:first-child {
		border-top: none
	}
	
	.calculation tr:last-child {
		border-bottom: none
	}
	
	.calculation tr:last-child td:first-child {
		border-bottom-left-radius: 3px
	}
	
	.calculation tr:last-child td:last-child {
		border-bottom-right-radius: 3px
	}
	
	.calculation td {
		background: #FFF;
		padding: 5px 10px;
		text-align: left;
		vertical-align: middle;
		font-size: 14px;
		text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
		border-right: 1px solid #C1C3D1
	}
	
	.calculation td:last-child {
		border-right: 0
	}
	
	th.text-left {
		text-align: left
	}
	
	th.text-center {
		text-align: center
	}
	
	th.text-right {
		text-align: right
	}
	
	.calculation td.text-left {
		text-align: left
	}
	
	.calculation td.text-center {
		text-align: center
	}
	
	.calculation td.text-right {
		text-align: right
	}
	
	.calculation tr:nth-child(even) td {
		background-color: #f2f2f2;
	}
	
	.calculation tr:nth-child(odd) td {
		background-color: #e4e4e4;
	}
	
	.position-relative {
		position: relative!important
	}
	
	.position-absolute {
		position: absolute!important
	}
	
	.img-fluid {
		max-width: 100%;
		height: auto
	}
	.no-break {
		page-break-inside: avoid;
	}
	</style>
   </head>

<body class="body" style="padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#fff; -webkit-text-size-adjust:none;

      font-family: Arial, Helvetica, sans-serif;">

	<table width="530" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff" class="mobile-shell">
		<tr>
			<td align="center" valign="top" style="padding-bottom:1rem;"> <img src="{{asset('images/biorev_header.png')}}" width="100%"> </td>
		</tr>
	</table>
	<table width="530" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff" class="mobile-shell">
		<tr>
			<td valign="top" style="height:865px; overflow:hidden">
				<table width="100%">
					<tr>
						<td colspan="2" valign="middle" class="hero bg_white" style="background: #212f38; height: 240px;text-align:center"> <img src="{{ asset('uploads/'.$lot->community->community->logo) }}" style="width:125px">
							<h1 style="color:#fff;text-align:center; font-size:40px;margin-bottom:0px; letter-spacing:2px;line-height:40px">{{ strtoupper($lot->community->community->name) }}</h1>
							<p style="margin:0;color:#fff;text-align:center; font-size:21px;">{{ $lot->community->community->location }}</p>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" class="calculation">
								<tr>
									<td style="width:50%">SELECTED LOT NO</td>
									<td>{{ $lot->alias }} </td>
								</tr>
								<tr>
									<td style="width:50%">SELECTED LOT PRICE</td>
									<td>${{ number_format($lot->price) }} </td>
								</tr>
								<tr>
									<td colspan="2" style="padding:15px 0 0 0; background:#fff">
										<p style="background: #666; margin: 0; padding: 3px 15px 10px 9px; color: #fff; font-weight: 600; letter-spacing: 1px;font-size: 19px;">COMMUNITY CONTACT DETAILS</p>
									</td>
								</tr>
								<tr>
									<td style="width:50%">CONTACT PERSON </td>
									<td> {{ strtoupper($lot->community->community->contact_person) }} </td>
								</tr>
								<tr>
									<td style="width:50%">CONTACT EMAIL</td>
									<td> {{ $lot->community->community->contact_email }} </td>
								</tr>
								<tr>
									<td style="width:50%">CONTACT NO</td>
									<td>{{ $lot->community->community->contact_number }} </td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table width="530" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff" class="mobile-shell">
		<tr>
			<td align="center" valign="top" style="padding-bottom:1rem;"> <img src="{{asset('images/biorev_header.png')}}" width="100%"> </td>
		</tr>
	</table>
	<table width="530" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff" class="mobile-shell">
		<tr>
			<td valign="top" style="height:865px; overflow:hidden">
				<table width="100%">
					<tr>
						<td>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td>
										<table width="100%" cellpadding="0" cellspacing="0">
											<tr align="center">
												<td align="center" style="padding:0;">
													<img src="{{asset('uploads/homes/'.$myhome->img)}}" style="height:240px;">
												</td>
											</tr>
											<tr>
												<td>
													<p style="background: #666; margin: 0; padding: 3px 15px 10px 9px; color: #fff; font-weight: 600; letter-spacing: 1px;font-size: 19px; margin-top:10px">{{ strtoupper($home->title) }} @if($home_type) - {{ strtoupper($home_type->title) }} @endif</p>
												</td>
											</tr>
											<tr>
												<td style="font-style: italic; font-size: 14px; color: #333333; line-height: 22px; padding: 10px 0;">Renderings may show optional features that are not included in the base elevation price. Rendering is for display purposes only, actual elevations may vary. </td>
											</tr>
											<tr>
												<td>
													<table width="100%" border="0" cellspacing="0" cellpadding="0" class="calculation" style="margin:0">
														<tr>
															<td colspan="2" style="padding:15px 0 0 0; background:#fff">
																<p style="background: #666; margin: 0; padding: 3px 15px 10px 9px; color: #fff; font-weight: 600; letter-spacing: 1px;font-size: 19px;">{{ strtoupper('Elevation Specifications') }}</p>
															</td>
														</tr>
														<tr>
															<td style="width:50%;">Price</td>
															<td style="width:50%;">{{ '$'.number_format(($home_type)?$home_type->price:$home->price) }}</td>
														</tr>
														<tr>
															<td style="width:50%;">Area</td>
															<td style="width:50%;">{{ ($home_type)?$home_type->area:$home->area }} sqft</td>
														</tr>
														<tr>
															<td style="width:50%;">Bedrooms</td>
															<td style="width:50%;">{{ ($home_type)?$home_type->bedroom:$home->bedroom }}</td>
														</tr>
														<tr>
															<td style="width:50%;">Bathrooms</td>
															<td style="width:50%;">{{ ($home_type)?$home_type->bathroom:$home->bathroom }}</td>
														</tr>
														<tr>
															<td style="width:50%;">Floors</td>
															<td style="width:50%;">{{ ($home_type)?$home_type->floor:$home->floor }}</td>
														</tr>
														<tr>
															<td style="width:50%;">Garage</td>
															<td style="width:50%;">{{ ($home_type)?$home_type->garage:$home->garage }}</td>
														</tr>
													</table>
												</td>
											</tr>
											@if(isset($myhome->color_scheme))
											<tr style="page-break-before:always;">
												<td>
													<table width="100%" border="0" cellspacing="0" cellpadding="0" class="calculation" style="margin:0">
														<tr>
															<td colspan="2" style="padding:15px 0 0 0; background:#fff">
																<p style="background: #666; margin: 0; padding: 3px 15px 10px 9px; color: #fff; font-weight: 600; letter-spacing: 1px;font-size: 19px;">{{ strtoupper('Elevation Customizations') }}</p>
															</td>
														</tr>
														<tr>
															<td style="width:50%;">{{ $myhome->color_scheme->title }}</td>
															<td style="width:50%;">${{ number_format($myhome->color_scheme->price) }}</td>
														</tr> 
														@if(isset($home_upgrade_patches)) 
														@foreach($home_upgrade_patches as $upgrade)
														<tr>
															<td style="width:50%;">{{$upgrade->title}}</td>
															<td style="width:50%;">${{ number_format($upgrade->price) }}</td>
														</tr> 
														@endforeach 
														@endif										
													</table>
												</td>
											</tr>
											@endif
										</table>
									</td>
								</tr>
							</table>
					</tr>
				</table>
				</td>
		</tr>
	</table>
	@php $j=0; @endphp
	@foreach($home->floors as $floor)
	@php $j++; @endphp
	<table width="530" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff" class="mobile-shell">
		<tr>
			<td align="center" valign="top" style="padding-bottom:1rem;"> <img src="{{asset('images/biorev_header.png')}}" width="100%"> </td>
		</tr>
	</table>
	<table width="530" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff" class="mobile-shell">
		<tr>
			<td valign="top" style="height:865px; overflow:hidden">
				<table width="100%">
					<tr>
						<td>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td>
										<table width="100%" cellpadding="0" cellspacing="0">
											<tr align="center" width="530">
												<td valign="top" align="center" style="height:500px; overflow:hidden; position:relative;" width="530">
													<img id="floor_base_img" src="{{asset('uploads/floors/'.$floor->image)}}" class="position-absolute" style="width:345px; left:175px;">                        
													@forelse($floor->features as $feature)
													@if(in_array($feature->id,$features))
													<img src="{{asset('uploads/features/'.$feature->image)}}" class="position-absolute" style="width:345px; left:175px;">	
													@endif
													@empty
													@endforelse
												</td>
											</tr>
											<tr>
												<td>
													<table width="100%" border="0" cellspacing="0" cellpadding="0" class="calculation" style="margin:0">
														<tr>
															<td colspan="2" style="padding:15px 0 0 0; background:#fff">
																<p style="background: #666; margin: 0; padding: 3px 15px 10px 9px; color: #fff; font-weight: 600; letter-spacing: 1px;font-size: 19px;">{{ strtoupper($floor->title) }}</p>
															</td>
														</tr>
														@if(isset($features[0]) && $features[0] !='')
														@forelse($floor->features as $feature)
														@if(in_array($feature->id,$features))
														<tr>
															<td style="width:50%">{{$feature->title}}</td>
															<td style="width:50%">${{number_format($feature->price)}}</td>
														</tr> 
														@endif
														@empty
														@endforelse
														@endif									
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
					</tr>
				</table>
				</td>
		</tr>
	</table>
	@endforeach
   </body>
</html>

