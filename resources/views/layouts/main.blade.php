<!DOCTYPE html>
<html>
	@include('includes.head')
<body>
	<script>
	const currentRoute 	= '{{Route::currentRouteName()}}';
	const estimate 		= '{{route("estimate")}}';
	const xhome 		= '{{route("xhome",["community_slug"=>$community->slug,"home_slug"=>$home->slug,"home_type_slug"=>(isset($home_type))?$home_type->slug:""])}}';
	let auth;
	@auth
		auth = true;
	@else
		auth = false;
	@endauth
	@if(Route::currentRouteName() == "xplat" || Route::currentRouteName() == "plat")
		const minPrice 		= '{{$range['min_price']}}';
		const maxPrice 		= '{{$range['max_price']}}';
		const minArea 		= '{{$range['min_area']}}';
		const maxArea 		= '{{$range['max_area']}}';
		const minBed 		= '{{$range['min_bed']}}';
		const maxBed 		= '{{$range['max_bed']}}';
		const minBath 		= '{{$range['min_bath']}}';
		const maxBath 		= '{{$range['max_bath']}}';
		const minGarage 	= '{{$range['min_bath']}}';
		const maxGarage 	= '{{$range['max_bath']}}';
		const minFloor 		= '{{$range['min_bath']}}';
		const maxFloor 		= '{{$range['max_bath']}}';
		const communityId   = {{$community->id}};
		const plotId   		= {{$community->plot->id}};
	@endif
	@if(Route::currentRouteName() == "xfloor")
		const floorCount	= {{count($home->floors)}};
		const featuresData 	= '<?= (Session::has('floor_features'))?json_encode(Session::get('floor_features')):json_encode('') ?>';
		const totalPrice    = {{Session::get('total_price')}};
	@endif
	</script>
	@include('elements.header-footer')
	@yield('content')
	@include('elements.home-login')
	@include('includes.scripts')
	@stack('scripts')	
</body>
</html>
