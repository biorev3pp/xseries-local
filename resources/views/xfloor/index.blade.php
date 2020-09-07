@extends('layouts.main')
@section('content')
@php 
  $prehomeprice = Session::get('base_price');
  $home_lot_floor_price=Session::get('total_price');
  if($community->nearby) {
        $nearby = []; 
        $nearby_data = get_object_vars(json_decode($community->nearby));
        $keys = ['hospital', 'school', 'restaurant', 'shopping_mall'];
        foreach($keys as $key){
            $nearby[$key] = [];
        }
        foreach($nearby_data as $key => $nearby_place_name){
            foreach($nearby_place_name as $nearby_place_list){
                array_push($nearby[$key], $nearby_place_list);
            }
        }
        $icons = ['hospital' => 'fa-hospital-o', 'restaurant' => 'fa-cutlery', 'school' => 'fa-graduation-cap', 'shopping_mall' => 'fa fa-cart-plus'];
    }
    else $nearby = []; 
@endphp
<div id="fs-loading" style="display:none;">
	<div class="fs-loading-content center-middle">
		<p class="fs-loading-icon">
			<div class="item item-1"></div>
			<div class="item item-2"></div>
			<div class="item item-3"></div>
			<div class="item item-4"></div>
		</p>
		<p class="fs-loading-text"><span class="load-percentage">Loading</span> </p>
	</div>
</div>
<!-- Begin section -->
<div class="main-wrapper home-main-wrapper floor-main-wrapper">
  <div class="elevation-home-img" style="display:none;">
    <div class="section-center" style="position:fixed;">
      <div class="mx-auto front-image-wrapper h-100" id="right-wrapper"> 
        <img src="{{ asset('uploads/homes/'.$home->img)}}" class="img-fluid" id="main_img"> 
      </div>
    </div>
  </div>
  <div class="floor-plan-img h-100" id="interactive-pre-wrapper"> 
    <div class="section-left">
      <div class="bottom-img ">
        <ul class="zoom-icons">
          <li class="refrest-btn"> 
            <div class="theme-white-icon theme-icon icon-refresh"></div>
          </li>
          <li onclick="step('zoom-in')" class="zoomin-btn"> 
            <i class="theme-white-icon theme-icon icon-plus"></i>
          </li>
          <li onclick="step('zoom-out')" class="zoomout-btn"> 
            <i class="theme-white-icon theme-icon icon-minus"></i>
          </li>
        </ul>
      </div>
    </div>
    <div class="section-center floor-section-center">
      <div class="h-100 w-100" style="position:relative">
        @php $i=0;@endphp @foreach($home->floors as $floor) 
        @if($floor->status_id ==2) 
        @php $i++;@endphp
        <div id="floor{{$i}}" class="floor_img floor_image_view{{$i}} floor_no{{$i}} {{($i==1)?'floor-image-show':'floor-image-hide'}}">
            <img src="{{asset('uploads/floors/'.$floor->image)}}"> 
        </div> 
        @endif 
        @endforeach 
      </div>
    </div>
  </div>
  <!-- Side Menu -->
  @include('includes.sidemenu')
  <!-- End of Side Menu -->
  <!-- Floating Icons and Modals -->
  @include('includes.floating-icons')
  <!-- End of Floating Icons and Modals -->
</div>
<!-- End section -->
<!-- Begin Footer -->
<div class="footer">
  <div class="row h-100 justify-content-between align-items-center">
    <div class="footer-btns pbtns">
        <a href="{{route('xhome',['community_slug'=>$community->slug,'home_slug'=>$home->slug,'home_type_slug'=>($home_type)?$home_type->slug:''])}}" class="pbs-btn">previous</a>
    </div> 
    <div class="row footer-title" style="padding:10px 0;">
      <h5 class="m-0 pr-2 border-right">
        <span class="material-icons">business</span>
        {{$community->name}}</h5>
      <h6 class="m-0 pl-2" data-title = "{{$home->title}}">
        <span class="material-icons">home</span>
        {{$home->title}} @if($home_type)- {{$home_type->title}} @endif
      </h6>
    </div>           
    <div class="footer-btns fns-btn">
      <a href="javascript:void(0)" id="finish-modulesz" onclick="finish()">Estimate</a>
      {{Form::open(array('url'=>url('finalpage'),'id'=>'finishPage_form'))}} {{Form::hidden('home_id',$home->id)}} {{Form::hidden('total_price',$home_lot_floor_price)}} {{Form::close()}} 
    </div>
  </div>
  <div class="close-arrow">
    <span class="material-icons">
    expand_more
    </span>
  </div>
</div>
<!-- Feature Tour Modal -->
<div class="login-section feature-tour">
    <div class="modal fade" id="FeatureTourModal" tabindex="-1" role="dialog" aria-labelledby="FeatureTourModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content text-center" style="max-width: 450px">
            <div class="modal-header">
                <h5 class="modal-title" id="FeatureTourModalLongTitle">Features Tour</h5>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src="{{ asset('new-ui/images/close-btn.png') }}" alt="">
            </button>
            <div class="modal-body">
                <p>Let's start your tour....</p>
                <div class="tab-box">
                    <button type="button" class="btn btn-primary btn-block waves-effect waves-light login-button" id="pstart-btn">Continue</button>
                </div>
            </div>
        </div>
    </div>
</div>		
@endsection
@push('scripts')
<script>
  window.onload = function(){
    openMenu = false;
    openNav();   
    checkPreChecked();  
    downrate();
    calculatePayment();
  }
</script>
@endpush
