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
    <div class=" row pl-1 pr-1 justify-content-between align-items-center mb-2">
        <div>
            @if($homes->parent_id == 0)
               <h1 class="a_dash m-0 p-0 d-inline-block">Elevations <small><span class="color-secondary">|</span></small></h1>
            @else     
               <h1 class="a_dash m-0 p-0 d-inline-block">Elevation Types <small><span class="color-secondary">|</span></small></h1>
            @endif
            <div class="row breadcrumbs-top pl-2 d-inline-block">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="{{ route('manager-homes') }}">{{$homes->title}}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Color Schemes</li>
                </ol>
            </div>
        </div> 
        <div class="mt-1 mt-sm-0">   
            <div class="btn-group">
               @if($homes->parent_id == 0)
               <a href="{{route('manager-homes')}}" class="add_button"><i class="fa fa-arrow-left position-relative"></i> Back</a>
               @else
               <a href="{{route('manager-homes_elevation_type',['id'=>base64_encode($homes->parent_id)])}}" class="add_button"><i class="fa fa-arrow-left position-relative"></i> Back</a>
               @endif
            </div>
        </div>
    </div>
    <div class="row card-wrapper">
        @foreach($color_schemes as $color_scheme)
        <div class="col-xl-4 col-sm-6">
            <div class="card mb-2 p-1" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-12 card-image">
                        <img src="{{url('uploads/homes/'.$color_scheme->base_img)}}" class="card-img" alt="..." />
                    </div>
                    <div class="col-12 mt-1">
                        <div class="card-body pl-0 py-0 pr-0 h-auto">
                            <h5 class="card-title mb-1">{{$color_scheme->title}}</h5>
                            <div class="row mx-0 action-btn">
                                @if($color_scheme->status_id == 2)
                                <a
                                    class="btn btn-sm btn-outline-success scheme_status show-tooltip"
                                    id="scheme_{{$color_scheme->id}}"
                                    href="javascript:void(0);"
                                    scheme_id="{{$color_scheme->id}}"
                                    scheme_status="{{ $color_scheme->status_id }}"
                                    title="Active/Blocked"
                                >
                                    <i class="fa fa-check"></i>
                                </a>
                                @else
                                <a
                                    class="btn btn-sm btn-outline-danger scheme_status show-tooltip"
                                    id="scheme_{{$color_scheme->id}}"
                                    href="javascript:void(0);"
                                    scheme_id="{{$color_scheme->id}}"
                                    scheme_status="{{ $color_scheme->status_id }}"
                                    title="Active/Blocked"
                                >
                                    <i class="fa fa-ban"></i>
                                </a>
                                @endif
                                <a href="{{route('manager-color_features', ['id' => base64_encode($color_scheme->id)])}}" class="btn btn-sm btn-outline-dark show-tooltip" title="View Color Features"><i class="fas fa-sliders-h"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

@endsection
