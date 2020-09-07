@extends('layouts.admin') @section('content')
<div class="container-fluid page-wrapper">
    <!-- Page Heading -->
    <div class="row mb-2 justify-content-between pl-1 pr-1 align-items-center">
        <div>
            <h1 class="a_dash p-0 m-0">Elevations</h1>
        </div>
        <div class="filter-search-input w-100 pr-5" style="max-width:450px;">
            <input type="text" class="form-control" name="skeyword" id="skeyword" placeholder="Search here" onkeyup="InPageFilter()">
        </div>
    </div>
    <div id="sfullrecords">
        <div class="row card-wrapper">
            @foreach($homes as $home)
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
                                    <a class="btn btn-sm btn-outline-success change_statuses show-tooltip" id="home_{{$home->id}}" href="javascript:void(0);" home_id="{{$home->id}}" home_status_id="{{ $home->status_id }}" title="Active/Blocked">
                                        <i class="fa fa-check"></i> 
                                    </a>
                                    @else
                                    <a class="btn btn-sm btn-outline-danger change_statuses show-tooltip" id="home_{{$home->id}}" href="javascript:void(0);" home_id="{{$home->id}}" home_status_id="{{ $home->status_id }}" title="Active/Blocked">
                                        <i class="fa fa-ban"></i> 
                                    </a>
                                    @endif
                                    <a href="{{route('manager-homes_color_scheme', ['id' => base64_encode($home->id)])}}" title="Manage Color Scheme" class="btn btn-sm btn-outline-dark show-tooltip" ><i class="fas fa-fill"></i>
                                    </a>
                                    <a class="btn btn-sm btn-outline-dark show-tooltip" href="{{route('manager-view-gallery', ['id' => base64_encode($home->id)])}}" title="View Gallery"><i class="far fa-images"></i>  </a>
                                    <a href="{{route('manager-homes_elevation_type', ['id' => base64_encode($home->id)])}}" class="btn btn-sm btn-outline-secondary show-tooltip" Title="View Eleavtion Types">
                                        <i class="fa fa-eye"></i>
                                    </a>
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

<style type="text/css">
.action-btn .btn{margin-right: 3px; margin-bottom: 3px;, padding:0.275rem 0.451rem;}
.action-btn .btn i{font-size: 13px}
.action-btn .btn:last-child{margin-right: 0;}
</style>

<script type="text/javascript">
    function InPageFilter() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("skeyword");
        filter = input.value.toUpperCase();
        sdiv = document.getElementById("sfullrecords");
        rspan = sdiv.getElementsByClassName("c_search");
        for (i = 0; i < rspan.length; i++) {
            a = rspan[i].getElementsByTagName("h5")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                rspan[i].style.display = "";
            } else {
                rspan[i].style.display = "none";
            }
        }
    }

</script>

@endsection