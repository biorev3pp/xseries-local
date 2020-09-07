@extends('layouts.admin')
@section('content')
@if(session()->has('message'))

<div class="alert alert-success" id="msg">
    {{ session()->get('message') }}
</div>

@endif
<div class="container-fluid page-wrapper">
    <!-- Page Heading -->
    <div class="row mb-2 justify-content-between pl-1 pr-1 align-items-center">
         <div>
            <h1 class="a_dash d-inline-block p-0 m-0">Communities <small><span class="color-secondary">|</span></small></h1>
            <div class="row pl-2 breadcrumbs-top d-inline-block">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item" aria-current="page">
                  <a href="{{ route('communities') }}"> {{ $communities->name }} </a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Elevations</a></li>
               </ol>
            </div>
         </div>
         <div>
            <div class="btn-group">
               <a href="javascript:void(0)" class="add_button mr-1" data-toggle="modal" data-target="#add_home"><i style="top:0;" class="fas fa-home"></i> Connect Elevations</a>
               <a href="{{ route('communities') }}" class="add_button"><i class="fa fa-arrow-left position-relative"></i> Back</a>
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
                                <a
                                    class="home_delete btn btn-sm btn-outline-danger show-tooltip"
                                    href="javacript:;"
                                    home_id="{{base64_encode($home->id)}}"
                                    onclick="deleteData({{$home->id}})"
                                    data-toggle="modal"
                                    data-target="#modal-delete"
                                    title="Delete Elevation"
                                >
                                    <i class="fa fa-trash-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Start Activate and Deactivate Popup -->

    <div class="modal fade" id="addHomes" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Confirmation</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times"></i> </span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <h6 class="delete_heading">Do you want to update the status ?</h6>

                        <div class="clearfix"></div>

                        <div class="m-auto">
                            <input type="hidden" name="home_id" id="home_id" value="" />

                            <input type="hidden" name="home_status_id" id="home_status_id" value="" />

                            <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr">No</button>

                            <button type="button" class="btn-orange t_b_s yesBtn">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Popup -->

    <!-- Add New Home popup-->

    <div class="modal fade" id="add_home" tabindex="-1" role="dialog" aria-labelledby="add_homeLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="manageuserLabel">List of Available Elevations</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times"></i></span>
                    </button>
                </div>

                <div class="modal-body p-0">
                    <form method="post" action="{{route('save_communities_homes')}}" name="home" id="home" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="community_id" value="{{$community_id}}" />

                        <div class="col-md-12 table-responsive">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Title</th>

                                        <th>Image</th>

                                        <th>Specifications</th>

                                        <th>Price</th>

                                        <th>Status</th>

                                        <th style="width: 50px;">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php $i=1 @endphp @foreach($homes_not_in_community as $home) @if(!$home->parent_id)
                                    <tr>
                                        <td><b>{{$home->title}}</b></td>

                                        <td><img width="100px" src="{{url('uploads/homes/'.$home->img)}}" /></td>

                                        <td>{{$home->area}} Sq.ft | {{$home->bedroom}} Bedrooms | {{$home->bathroom}} Bathrooms</td>

                                        <td>$ {{$home->price}}</td>

                                        <td>{{ ($home->status_id ==2) ? 'Active' : 'Deactive' }}</td>

                                        <td>
                                            <input class="form-control" name="assign[]" value="{{$home->id}}" type="checkbox" />
                                        </td>
                                    </tr>

                                    @php $i++ @endphp @endif @endforeach
                                </tbody>
                            </table>
                        </div>

                        <hr />

                        <div class="form-group px-3 text-center">
                            <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr float-none">Close</button>

                            <button type="submit" class="btn-orange t_b_s yesBtn float-none">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Add New Home popup-->

    <!-- Delete Community Homes popup  -->

    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
            <form action="" id="deleteForm" method="get" enctype="multipart/form-data">
                <div class="modal-content" style="margin-left: 110px;">
                    <div class="modal-header">
                        <h5>Confirm Action</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-times"></i> </span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <h6 class="delete_heading">Are you sure, you want to delete this record ?</h6>

                            <div class="clearfix"></div>

                            <div class="m-auto">
                                <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr">No</button>

                                <button type="submit" class="btn-orange t_b_s" onclick="formSubmit()">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        function deleteData(id) {
            var id = id;

            var url = '{{ action("Admin\CommunitiesController@destroyCommunityHomes", ":id") }}';

            url = url.replace(":id", id);

            $("#deleteForm").attr("action", url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>

    <!--Delete Community Homes popup-->
</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>
   $(document).ready(function () {
    setTimeout(function () {
        $("#msg").fadeOut("fast");
    }, 3000);
});
</script>

<script>
$(document).ready(function () {
    $(".change_statuses").click(function () {
        $("#home_id").val($(this).attr("home_id"));

        $("#home_status_id").val($(this).attr("home_status_id"));

        $("#addHomes").modal("show");
    });

    $(".yesBtn").click(function () {
        $.ajax({
            type: "POST",

            url: "/api/homeStatus/" + $("#home_id").val(),

            data: { home_id: $("#home_id").val(), home_status_id: $("#home_status_id").val() },

            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },

            /*contentType: 'json',*/

            success: function (response) {
                console.log(response);

                if (response == 2) {
                    $("#home_" + $("#home_id").val()).removeClass("btn-outline-danger");
                    $("#home_" + $("#home_id").val()).addClass("btn-outline-success");
                    $("#home_" + $("#home_id").val()).html('<i class="fa fa-check"></i>');
                } else {
                    $("#home_" + $("#home_id").val()).removeClass("btn-outline-success");
                    $("#home_" + $("#home_id").val()).addClass("btn-outline-danger");
                    $("#home_" + $("#home_id").val()).html('<i class="fa fa-ban"></i>');
                }

                $("#addHomes").modal("hide");
            },
        });
    });
});



</script>


