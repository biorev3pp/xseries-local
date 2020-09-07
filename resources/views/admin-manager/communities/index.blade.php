@extends('layouts.admin')
@section('content')
<div class="container-fluid page-wrapper">
      <!-- Page Heading -->
      <div class="row mb-2 justify-content-between pl-1 pr-1 align-items-center">
         <div>
            <h1 class="a_dash p-0 m-0">Communities</h1>
         </div>
         <div class="filter-search-input w-100 pr-5" style="max-width:450px;">
            <input type="text" class="form-control" name="skeyword" id="skeyword" placeholder="Search here" onkeyup="InPageFilter()">
        </div>
      </div>
     @if(\Session::has('message'))
        <div class="alert alert-success alert-dismissible" style="margin-top:18px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <strong>Success!</strong> {{ \Session::get('message') }}
        </div>
      @endif
     <div id="cfullrecords">
      <div class="row mb-4">

        @foreach($communities as $key => $community)
        <div class="col-xl-4 col-lg-6 col-sm-6 float-left c_search" id="custom_width">
             <div class="mang_cate">
                <div class="p-1 img-fwrap">
                   <img src="{{asset('/uploads/'.$community->banner) }}">
                </div>
                <div>
                   <div class="h_DIV">
                      <p>{{ $community->name }}</p>
                      <div class="e-d-d">
                         <span><a class="a1" title="Community Homes" href="{{route('manager-communities_homes',['id'=>base64_encode($community->id)])}}"><i class="fas fa-home"></i>Elevations</a></span>

                         @if($community->status_id == 2)
                         <span><a class="a1 green change_status" href="javascript:void(0);" id="com_{{$community->id}}" community_id="{{$community->id}}" status_id="{{ $community->status_id }}"><i class="fa fa-check"></i><strong>Active</strong></a></span>
                         @else
                         <span><a class="a1 red change_status text-success" href="javascript:void(0);" id="com_{{$community->id}}" community_id="{{$community->id}}" status_id="{{ $community->status_id }}"><i class="fa fa-ban"></i><strong>Deactive</strong></a></span>
                         @endif
                      </div>
                      <a href="{{route('manager-view-community',['id'=>base64_encode($community->id)])}}"><button type="submit" class="btn-orange">view</button></a>
                   </div>
                </div>
             </div>
        </div>
        @endforeach
      </div>
      </div>
<script>

    function InPageFilter() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("skeyword");
    filter = input.value.toUpperCase();
    sdiv = document.getElementById("cfullrecords");
    rspan = sdiv.getElementsByClassName("c_search");
    for (i = 0; i < rspan.length; i++) {
        a = rspan[i].getElementsByTagName("p")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            rspan[i].style.display = "";
        } else {
            rspan[i].style.display = "none";
        }
    }
}

</script>
</div>
@endsection