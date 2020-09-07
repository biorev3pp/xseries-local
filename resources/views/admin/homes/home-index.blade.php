@extends('layouts.admin') @section('content')
<div class="container-fluid page-wrapper">
    <!-- Page Heading -->
    <div class="row mb-2 justify-content-between pl-1 pr-1 align-items-center">
        <div>
            <h1 class="a_dash p-0 m-0">Elevations</h1>
        </div>
        <div class="filter-search-input w-100" style="max-width:450px;">
            <input type="text" class="form-control" name="skeyword" id="skeyword" placeholder="Search here" onkeyup="InPageFilter()">
        </div>
        <div class="mt-1 mt-sm-0">
            <div class="btn-group">
                <a  href="javascript:void(0)" class="add_button" data-toggle="modal" data-target="#add_home"><i style="top: 0;" class="fas fa-plus"></i> Add New</a>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-xl" id="add_home" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5><b>Add New Elevations</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times"></i> </span>
                    </button>
                </div>
                <form method="post" action="{{route('save_homes')}}" name="home" id="home" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input required class="form-control forms1 pr-0" name="title" placeholder="Title" type="text" />
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <input required class="form-control forms1 pr-0" name="area" placeholder="Area" type="number" min="100" max="1000000"/>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <input required class="form-control forms1 pr-0" name="bedroom" placeholder="Bedrooms" min="0" max="100" type="number" />
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <input required class="form-control forms1 pr-0" name="bathroom" placeholder="Bathrooms" type="number" step=".5" min="0" max="100"/>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <input required class="form-control forms1 pr-0" name="garage" placeholder="Garages" type="number" min="0" max="50"/>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <input class="form-control forms1 pr-0" name="price" placeholder="Cost" type="number" min="0"/>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <select class="form-control forms1" name="status" id="status">
                                        <option value="2">Activate</option>
                                        <option value="1">Deactivate</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input required class="form-control forms1 pr-0" name="specifications" placeholder="Description" type="text" />
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input class="form-control forms1 pr-0" name="ext_link" placeholder="Enter External Link" type="text" />
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input required class="form-control forms1 pr-0" name="home_type" placeholder="Tag" type="text" />
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="row">
                                    <div class="col-6">
                                        <!-- <input required class="form-control forms1 no_bor" name="file" type="file"> -->
                                        <label class="btn btn-default btn-file rounded-0" style="margin-top: 0px !important;">
                                            <!-- The file is stored here. -->Choose File
                                            <input type="file" id="file" name="file" style="display: none !important;" onchange="readURL(this);" />
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <img id="blah" src="http://placehold.it/150" class="mw-100" width="150" height="150" alt="your image" />
                                    </div>
                                <p id="imageAlert" class="ml-1 mt-1"></p>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <hr />
                    <div class="m-auto">
                        <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr">Cancel</button>
                        <button type="submit" id="mySubmit" class="btn-orange t_b_s">Save Details</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    @if(\Session::has('message'))
    <div class="alert alert-success alert-dismissible" style="margin-top: 18px;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
        <strong>Success!</strong> {{ \Session::get('message') }}
    </div>
    @endif
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

                                    <a class="btn btn-sm btn-outline-dark show-tooltip" href="{{route('edit_homes', ['id' => base64_encode($home->id)])}}" title="Edit Elevation"><i class="fa fa-edit"></i>  </a>
                                    <a href="{{route('homes_color_scheme', ['id' => base64_encode($home->id)])}}" title="Manage Color Scheme" class="btn btn-sm btn-outline-dark show-tooltip" ><i class="fas fa-fill"></i>
                                    </a>
                                    <a class="btn btn-sm btn-outline-dark show-tooltip" href="{{route('view-gallery', ['id' => base64_encode($home->id)])}}" title="View Gallery"><i class="far fa-images"></i>  </a>
                                    <a href="{{route('homes_elevation_type', ['id' => base64_encode($home->id)])}}" class="btn btn-sm btn-outline-secondary show-tooltip" Title="View Eleavtion Types">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="home_delete btn btn-sm btn-outline-danger show-tooltip" href="javacript:;" home_id="{{base64_encode($home->id)}}" onclick="deleteData({{$home->id}})" data-toggle="modal" data-target="#modal-delete" title="Delete Elevation"><i class="fa fa-trash-alt"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
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
            var url = '{{ action("Admin\HomeController@destroy", ":id") }}';
            url = url.replace(":id", id);
            $("#deleteForm").attr("action", url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>

    <!--Delete Home popup-->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!-- <script>
$(document).ready(function()
{
    $('.home_edit').click(function()
    {
        $('#homes_id').val($(this).attr('homes_id'));

        $('#home_title').val($(this).attr('home_title'));
        $('#home_desc').val($(this).attr('home_desc'));
        $('#home_area').val($(this).attr('home_area'));
        $('#home_bed').val($(this).attr('home_bed'));
        $('#home_bath').val($(this).attr('home_bath'));
        $('#home_gar').val($(this).attr('home_gar'));
        $('#home_price').val($(this).attr('home_price'));
        $('#home_status').val($(this).attr('home_status'));
        
        $('#edit_home').modal('show');  
    });
});
</script> -->
<style type="text/css">
.action-btn .btn{margin-right: 3px; margin-bottom: 3px;, padding:0.275rem 0.451rem;}
.action-btn .btn i{font-size: 13px}
.action-btn .btn:last-child{margin-right: 0;}
</style>
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

<script type="text/javascript">
    function readURL(input) {
    var fileName = document.getElementById("file").value;
      var idxDot = fileName.lastIndexOf(".") + 1;
      var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
      if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
        document.getElementById("mySubmit").disabled = false;
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $("#blah").attr("src", e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
        $('#imageAlert').fadeOut();
      }
      else{
        document.getElementById("mySubmit").disabled = true;
        $('#imageAlert').html("Only jpg/jpeg and png files are allowed!").show().addClass('alert').addClass('alert-danger');
      } 
    }

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

@endsection
