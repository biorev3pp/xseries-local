@extends('layouts.main')
@section('content')  
@php
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
<!-- Begin xfloor section -->
<div class="main-wrapper home-main-wrapper">
    <div class="section-center" style="position: fixed;">
      <div class="mx-auto h-100" style="position:relative;">
        <div id="home-loading" style="display: none; z-index:11111;">
          <div class="fs-loading-content center-middle">
            <p class="fs-loading-icon"></p>
            <div class="item item-1"></div>
            <div class="item item-2"></div>
            <div class="item item-3"></div>
            <div class="item item-4"></div>
            <p></p>
            <p class="fs-loading-text"> Loading <span class="load-percentage"></span> </p>
          </div>
        </div>
        @if(isset($sess_features) && isset($sess_features->img))
        <img id="main_img" src="{{asset('uploads/homes/'.$sess_features->img)}}" >
        @else
        @if($home_type)
        <img id="main_img" src="{{asset('uploads/homes/'.$home_type->img)}}" class="img-fluid">
        @else
        <img id="main_img" src="{{asset('uploads/homes/'.$home->img)}}" class="img-fluid">
        @endif
        @endif
        <input type="hidden" id="home_price" value="{{(Session::has('home_price'))?Session::get('home_price'):Session::get('total_price')}}">

      </div>
    </div>
  @include('includes.sidemenu')
  @include('includes.floating-icons')
  <div class="footer">
      <div class="row h-100 justify-content-between align-items-center">
          <div class="footer-btns pbtns">
              <a class="pbs-btn" href="{{ route('plat') }}">previous</a>
          </div> 
          <div class="row footer-title" style="padding:10px 0 !important;">
              <h5 class="m-0 pr-2 border-right">
                  <span class="material-icons">business</span>
                  {{$community->name}}</h5>
              <h6 class="m-0 pl-2">
                  <span class="material-icons">home</span>
                  {{$home->title}} <span class="m-0 home-title" style="position:unset; color:#1f223e;">@if($home_type)- {{$home_type->title}}@endif</span>
              </h6>
          </div>           
          <div class="footer-btns fns-btn">
              <a href="{{route('xfloor',['community_slug'=>$community->slug,'home_slug'=>$home->slug,'home_type_slug'=>(isset($home_type))?$home_type->slug:''])}}" id="continue_to_floor" data-lid="" data-hid="" data-link="">Continue</a>
          </div>
      </div>
      <div class="close-arrow">
          <span class="material-icons">
          expand_more
          </span>
      </div>
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
$(document).ready(function(){
    downrate();
    calculatePayment();
    openMenu = false;
    openNav();
});
</script>
@endpush