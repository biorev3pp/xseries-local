@extends('layouts.admin')
@section('content')
<style> 
.modal-header h5{margin: 0; font-size: 17px; font-weight: 600; }
.action-btn .btn{margin-right: 3px; margin-bottom: 3px;, padding:0.275rem 0.451rem;}
.action-btn .btn i{font-size: 13px}
.action-btn .btn:last-child{margin-right: 0;}
.btn-outline-danger{
   color: #F44336!important;
}
</style>
<div class="container-fluid page-wrapper">
    <div class="row pl-1 pr-1 justify-content-between align-items-center mb-2">
        <div>
        @if($homes->parent_id == 0)
            <h1 class="a_dash m-0 p-0 d-inline-block">Elevations <small><span class="color-secondary">|</span></small></h1>
        @else     
            <h1 class="a_dash m-0 p-0 d-inline-block">Elevation Types <small><span class="color-secondary">|</span></small></h1>
        @endif    
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page">
                            <a href="{{ route('manager-homes') }}">{{$homes->title}}</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a href="{{route('manager-homes_color_scheme', ['id' =>$home_id])}}">Color Schemes</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">{{$color_scheme->title}}</li>
                        <li class="breadcrumb-item active" aria-current="page">Color Features</li>
                    </ol>
                </div>
            </div>
        </div>  
        <div class="mt-1 mt-sm-0">
            <div class="btn-group">
                <a href="{{route('manager-homes_color_scheme', ['id' =>$home_id])}}" class="add_button"><i class="fa fa-arrow-left position-relative"></i> Back</a>
            </div>
        </div>    
    </div>


    <div class="row card-wrapper">
        @foreach($features as $feature)
        <div class="col-xl-4 col-sm-6">
            <div class="card mb-2 p-1" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-4 card-image">
                        <img src="{{url('uploads/homes/'.$feature->img)}}" class="card-img h-100" alt="..." />
                    </div>
                    <div class="col-8">
                        <div class="card-body pl-1 py-0 pr-0 h-auto">
                            <h5 class="card-title mb-1">
                                {{$feature->title}} @if($feature->stared==1 && $feature->upgraded==0)
                                <a class="a1 click_upgrade" href="javascript:void(0)" upgrade_feature_id="{{$feature->id}}" upgrade_feature_type="{{$feature->upgrade_type}}"><i class="fa fa-pen"></i>Upgrade</a>

                                @endif
                            </h5>
                            <div class="row mx-0 action-btn">
                                @if($feature->status_id == 2)
                                <a
                                    class="btn btn-sm btn-outline-success color_feature_status show-tooltip"
                                    id="color_feature_{{$feature->id}}"
                                    href="javascript:void(0);"
                                    color_feature_id="{{$feature->id}}"
                                    color_feature_status="{{ $feature->status_id }}"
                                    title="Active/Blocked"
                                >
                                    <i class="fa fa-check"></i>
                                </a>
                                @else
                                <a
                                    class="btn btn-sm btn-outline-danger color_feature_status show-tooltip"
                                    id="color_feature_{{$feature->id}}"
                                    href="javascript:void(0);"
                                    color_feature_id="{{$feature->id}}"
                                    color_feature_status="{{ $feature->status_id }}"
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


@endsection                          
