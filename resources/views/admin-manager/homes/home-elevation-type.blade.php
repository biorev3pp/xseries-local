@extends('layouts.admin')
@section('content')
<style> 
.modal-header h5{margin: 0; font-size: 17px; font-weight: 600; }
.action-btn .btn{margin-right: 3px; margin-bottom: 3px;, padding:0.275rem 0.451rem;}
.action-btn .btn i{font-size: 13px}
.action-btn .btn:last-child{margin-right: 0;}
</style>
<div class="container-fluid page-wrapper">
    <div class="row mb-2 justify-content-between pl-1 pr-1 align-items-center">
        <div>
            <h1 class="a_dash m-0 p-0 d-inline-block">Elevations <small><span class="color-secondary">|</span></small></h1>
            <div class="row breadcrumbs-top pl-2 d-inline-block">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="{{ route('manager-homes') }}">{{$homes->title}}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Elevation Types</li>
                </ol>
            </div>
        </div>
        <div class="btn-group">
            <a href="{{route('manager-homes')}}"  class="add_button"><i class="fa fa-arrow-left position-relative"></i> Back</a>
        </div>
    </div>

    <div id="sfullrecords">
        <div class="row card-wrapper">
            @foreach($elevation_types as $type)
            <div class="col-xl-4 c_search col-sm-6">
                <div class="card mb-2 p-1" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-12 card-image">
                            <img src="{{url('uploads/homes/'.$type->img)}}" class="card-img" alt="..." />
                        </div>
                        <div class="col-12 mt-1">
                            <div class="card-body pl-0 py-0 pr-0 h-auto">
                                <h5 class="card-title mb-1">{{$type->title}}</h5>
                                <div class="row mx-0 action-btn">
                                    @if($type->status_id == 2)
                                    <a
                                        class="btn btn-sm btn-outline-success change_statuses show-tooltip"
                                        id="type_{{$type->id}}"
                                        href="javascript:void(0);"
                                        type_id="{{$type->id}}"
                                        type_status="{{ $type->status_id }}"
                                        title="Active/Blocked"
                                    >
                                        <i class="fa fa-check"></i>
                                    </a>
                                    @else
                                    <a
                                        class="btn btn-sm btn-outline-danger change_statuses show-tooltip"
                                        id="type_{{$type->id}}"
                                        href="javascript:void(0);"
                                        type_id="{{$type->id}}"
                                        type_status="{{ $type->status_id }}"
                                        title="Active/Blocked"
                                    >
                                        <i class="fa fa-ban"></i>
                                    </a>
                                    @endif

                                    <a href="{{route('homes_type_color_scheme', ['id' => base64_encode($type->id)])}}" title="Manage Color Scheme" class="btn btn-sm btn-outline-dark show-tooltip" ><i class="fas fa-fill"></i>
                                    </a>
                                    <a class="btn btn-sm btn-outline-dark show-tooltip" href="{{route('manager-view-gallery', ['id' => base64_encode($type->id)])}}" title="View Gallery"><i class="far fa-images"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
  </div>  
@endsection