@extends('layouts.admin')
@section('content')

<div class="container-fluid page-wrapper">
   <div class="row mb-2 justify-content-between pl-1 pr-1 align-items-center">
      <div>
         <h1 class="a_dash d-inline-block p-0 m-0">Communities <small><span class="color-secondary">|</span></small></h1>
         <div class="row pl-2 breadcrumbs-top d-inline-block">
            <ol class="breadcrumb">
               <li class="breadcrumb-item" aria-current="page">
               <a href="{{ route('manager-communities') }}"> {{ $communities->name }} </a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">Elevations</a></li>
            </ol>
         </div>
      </div>
      <div>
         <div class="btn-group">
            <a href="{{ route('manager-communities') }}" class="add_button"><i class="fa fa-arrow-left position-relative"></i> Back</a>
         </div>
      </div>
      </div>
   <div class="clearfix"></div>     
   <div class="row card-wrapper">
        @foreach($communities->Homes as $home)
        <div class="col-xl-4 c_search col-md-6 col-sm-6">
            <div class="card mb-2 p-1" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-12 card-image">
                        <img src="{{url('uploads/homes/'.$home->img)}}" class="card-img" alt="..." />
                    </div>
                    <div class="col-md-12 mt-1">
                        <div class="card-body pl-0 py-0 pr-0 h-auto">
                            @php $ref = 'E20'.STR_PAD($home->id, 3, 0, STR_PAD_LEFT); @endphp
                            <h5 class="card-title mb-1">{{$home->title}} <span class="float-right">({{'#'.$ref}})</span></h5>
                            <div class="row mx-0 action-btn">
                                @if($home->status_id == 2)
                                <a
                                    class="btn btn-sm btn-outline-success change_statuses show-tooltip"
                                    style="margin-right: 3px;"
                                    id="home_{{$home->id}}"
                                    href="javascript:void(0);"
                                    home_id="{{$home->id}}"
                                    home_status_id="{{ $home->status_id }}"
                                    title="Active/Blocked"
                                >
                                    <i class="fa fa-check"></i>
                                </a>
                                @else
                                <a
                                    class="btn btn-sm btn-outline-danger change_statuses show-tooltip"
                                    style="margin-right: 3px;"
                                    id="home_{{$home->id}}"
                                    href="javascript:void(0);"
                                    home_id="{{$home->id}}"
                                    home_status_id="{{ $home->status_id }}"
                                    title="Active/Blocked"
                                >
                                    <i class="fa fa-ban"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection


