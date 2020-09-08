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
    ini_set("max_execution_time", 0);
@endphp
<div class="main-wrapper">
    <div class="section-center" style="overflow: hidden; position: relative; align-items:normal">
        <div class="svgloader" style="position: absolute; background: rgba(255,255,255); height: 100%; width: 100%;z-index: 111;">
            <img src="{{ asset('images/spinner.gif') }}" style="height: auto; top: 30%; position: relative;">
        </div> 
        <div class="svg-draggable" id="stage">
            <div id="referencer"></div>
            <?php echo file_get_contents(asset('uploads/'.$community->plot->svg)); ?>
        </div>
    </div>
    @include('includes.sidemenu')
    @include('includes.floating-icons')
    <div class="section-left">
        <div class="bottom-img">
            <ul class="zoom-icons">
                <li class="refrest-btn"> 
                  <div class="theme-white-icon theme-icon icon-refresh"></div>
                </li>
                <li class="zoomin-btn" onclick="step('zoom-in')"> 
                  <i class="theme-white-icon theme-icon icon-plus" ></i>
                </li>
                <li class="zoomout-btn" onclick="step('zoom-out')"> 
                  <i class="theme-white-icon theme-icon icon-minus" ></i>
                </li>
            </ul>
        </div>
    </div>
    <!--  Div for tool tip-->
    <div id="lotInfoOnHover">
        <p class="alias"></p>
        <p class="price"></p>
        <p class="status"></p>      
    </div>
    <!-- end of the div here-->
    <div class="footer">
        <div class="row h-100 justify-content-between align-items-center">
            <div class="footer-btns pbtns">
                @if(Session::has('com_first'))
                <a class="pbs-btn" href="{{ asset('/elevations?community='.$community->slug) }}">previous</a>
                @else
                @if($home_type)
                <a class="pbs-btn" href="{{ asset('/community/'.$home->slug.'/'.$home_type->slug) }}">previous</a>
                @else
                <a class="pbs-btn" href="{{ asset('/community/'.$home->slug) }}">previous</a>
                @endif
                @endif
            </div> 
            <div class="row footer-title" style="padding:10px 0 !important;">
                <h5 class="m-0 pr-2 border-right">
                    <span class="material-icons">business</span>
                    {{$community->name}}</h5>
                <h6 class="m-0 pl-2">
                    <span class="material-icons">home</span>
                    {{$home->title}} @if($home_type)<span class="m-0 home-type-title" style="position:unset; color:#1f223e;">- {{$home_type->title}}</span> @endif
                </h6>
            </div>           
            <div class="footer-btns fns-btn">
                <a href="javascript:void(0);" id="continue_to_home" data-lid="" data-hid="" data-link="">Continue</a>

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
@push('scripts')
<script>
window.onload = function(){ 
    @if(Session::has('lot_group'))
        var lid = '<?= Session::get('lot_group') ?>';
        $('#'+lid).trigger('click');
    @endif
    downrate();
    $('#shmprice').html(formatter.format(<?=($home_type)?$home_type->price:$home->price?>));
    $('#shome_id').val(<?= ($home_type)?$home_type->price:$home->price?>);
    setPayment();
}    
</script>
@endpush
@endsection
