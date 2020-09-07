@extends('layouts.admin')
@section('content')
<div class="container-fluid page-wrapper">
    <div class="row mb-2 justify-content-between pl-1 pr-1 align-items-center">
        <div>
            @if($home->parent_id== 0)
            <h1 class="a_dash m-0 p-0 d-inline-block">Elevations <small><span class="color-secondary">|</span></small></h1>
            @else
            <h1 class="a_dash m-0 p-0 d-inline-block">Elevation Types <small><span class="color-secondary">|</span></small></h1>
            @endif
            <div class="row breadcrumbs-top pl-2 d-inline-block">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manager-homes') }}"> {{ $home->title }} </a>
                    </li>
                    <li class="breadcrumb-item active">Gallery </li>
                </ol>
            </div>
        </div>
        <div class="mt-1 mt-sm-0">
            <div class="btn-group">
                @if($home->parent_id == 0)
                <a href="{{ route('manager-homes') }}" class="add_button"><i class="fa fa-arrow-left position-relative"></i> Back</a>
                @else
                <a href="{{ route('manager-homes_elevation_type',['id'=>base64_encode($home->parent_id)]) }}" class="add_button"><i class="fa fa-arrow-left position-relative"></i> Back</a>
                @endif
            </div>
        </div>    
    </div>

    <div class="card mb-4">
        <div class="card-content collapse show">
            <div class="card-body p-0">
                <nav>
                    <div class="nav nav-tabs myTabSettings" role="tablist">
                        <a class="nav-item wf-20 nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" style="line-height: 30px;">GALLERY</a>
                    </div>
                </nav>
                <div class="tab-content p-2" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="grid-hover row" id="galleryrow"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="{{ asset('cms/css/gallery.css') }}">
@endsection
@push('scripts')
<script>
    var APP_URL = "{{url('/') }}";
    $(document).ready(function(){

        function getHomeGallery() {
            $.ajax({
                type: 'get',
                url: '/api/get-home-gallery/<?= $home->id?>',
                data: {},
                success: function(data) {
                    $('#galleryrow').html(data.gallery);
                }
            });
        }
        getHomeGallery();
    });
</script>
@endpush
