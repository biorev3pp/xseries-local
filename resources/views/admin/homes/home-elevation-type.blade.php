@extends('layouts.admin')
@section('content')
<style> 
.modal-header h5{margin: 0; font-size: 17px; }
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
                        <a href="{{ route('homes') }}">{{$homes->title}}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Elevation Types</li>
                </ol>
            </div>
        </div>
        <div class="mt-1 mt-sm-0">
            <div class="btn-group">
                <a href="{{route('homes')}}"  class="add_button"><i class="fa fa-arrow-left position-relative"></i> Back</a>
            </div>
        </div>
    </div>
    @if(\Session::has('message'))
    <div class="alert alert-success alert-dismissible" style="margin-top: 18px;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
        <strong>Success!</strong> {{ \Session::get('message') }}
    </div>
    @endif
    <div class="card" id="no_sh">
        <div class="card-body text-right">
            <a href="#" data-toggle="modal" data-target="#importModal">
                <button type="button"  class="add_button btn btn-dark btn-min-width mr-1 waves-effect waves-light"><i style="top: 0;" class="fa fa-file-excel"></i> Upload CSV</button>
            </a>
            <a href="javascript:void(0);" data-toggle="modal" data-target="#add_elevation" id="add_elevation_type">
                <button type="button" class="btn btn-dark btn-min-width mr-1 waves-effect waves-light"><i style="top: 0;" class="fas fa-plus"></i> Add Elevation Type</button>
            </a>
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

                                    <a class="btn btn-sm btn-outline-dark show-tooltip" href="{{route('elevation_type_edit',['id' => base64_encode($type->id)])}}" title="Edit Elevation Type"><i class="fa fa-edit"></i> </a>
                                    <a href="{{route('homes_color_scheme', ['id' => base64_encode($type->id)])}}" title="Manage Color Scheme" class="btn btn-sm btn-outline-dark show-tooltip" ><i class="fas fa-fill"></i>
                                    </a>
                                    <a class="btn btn-sm btn-outline-dark show-tooltip" href="{{route('view-type-gallery', ['id' => base64_encode($type->id)])}}" title="View Gallery"><i class="far fa-images"></i></a>
                                    <a
                                        class="home_delete btn btn-sm btn-outline-danger show-tooltip"
                                        href="javacript:;"
                                        id="{{base64_encode($type->id)}}"
                                        onclick="deleteData({{$type->id}})"
                                        data-toggle="modal"
                                        data-target="#modal-delete"
                                        title="Delete Elevation Type"
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
    </div>

    <!-- Start Activate and Deactivate Popup -->
    <div class="modal fade" id="changeStatus" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-hidden="true">
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
                            <input type="hidden" name="type_id" id="type_id" value="" />
                            <input type="hidden" name="type_status" id="type_status" value="" />

                            <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr">No</button>
                            <button type="button" class="btn-orange t_b_s yesBtn">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Popup -->

    <!-- Delete popup-->

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
    <div class="modal fade" id="modal-warning" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content" style="margin-left: 110px;">
                <div class="modal-header">
                    <h5>Warning</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times"></i> </span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <h6 class="delete_heading">Elevation type upload limit exceeded. Please contact us for more options</h6>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Delete popup-->
</div>
<!--Elevation modal-->
<div class="modal fade bd-example-modal-xl" id="add_elevation" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Add New Elevation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i> </span>
                </button>
            </div>
            <form method="post" action="{{route('save_elevation')}}" name="elevation" id="elevation" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="home_id" value="{{Request::segment(4)}}" />
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <input required class="form-control forms1" name="title" placeholder="Title" type="text" />
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <!-- <input required class="form-control forms1 no_bor" name="file" type="file"> -->
                                <label class="btn btn-default btn-file rounded-0" style="margin-top: 0px !important;">
                                    <!-- The file is stored here. -->Choose File
                                    <input type="file" id="file" accept="image/*" name="file" style="display: none !important;" onchange="readURL(this);" />
                                </label>
                                <img id="blah" src="http://placehold.it/150" width="150" height="150" alt="your image" />
                                <p id="imageAlert"class="mt-1"></p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <input required class="form-control forms1" name="specifications" placeholder="Description" type="text" />
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <input required class="form-control forms1" name="area" placeholder="Area" type="number" min="100" max="1000000"/>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <input required class="form-control forms1" name="bedroom" placeholder="Bedrooms" type="number" min="0" max="100" />
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <input required class="form-control forms1" name="bathroom" placeholder="Bathrooms" type="number" min="0" max="100" step=".5" />
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <input required class="form-control forms1" name="garage" placeholder="Garages" type="number" min="0" max="50" />
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <input class="form-control forms1" name="price" placeholder="Cost" type="number" min="0" />
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <select class="form-control forms1" name="status" id="status">
                                    <option value="2">Activate</option>
                                    <option value="1">Deactivate</option>
                                </select>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
                <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr">Cancel</button>
                <button type="submit" id="mySubmit" class="btn-orange t_b_s">Save</button>
            </form>
        </div>
    </div>
</div>
<!-- Upload csv modal                   -->
<div class="modal fade bd-example-modal-xl" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Csv Import</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i> </span>
                </button>
            </div>
                <div class="modal-body">
                <form id="upload_elevations_csv" action="{{route('upload-elevations-type-csv')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group" id="f_mar">
                                <label for="svgFile">CSV</label>
                                <div class="imageupload panel panel-default">
                                    <div class="file-tab panel-body">
                                        <label class="btn btn-default btn-file rounded-0">
                                            <!-- The file is stored here. -->Choose File
                                            <input type="file" id="csv_file" name="csv_file" placeholder="csv_file" style="display: none !important;" />
                                            <input class="form-control" id="home_id" name="home_id" value="{{Request::segment(count(Request::segments()))}}" type="hidden" />
                                        </label>

                                        <button type="button" class="btn btn-default remove-btn" style="display: none;"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <a href="{{ url('/admin/elevations-sample.csv') }}" target="_blank" class="btn-orange"><i class="fa fa-file-excel"></i> Sample CSV</a>
                        </div>

                        <div class="clearfix"></div>
                        <!--<a href="javascript:void();"><button type="submit" class="btn-orange t_b_s d_gr">Cancel </button></a>-->
                    </div>
                    <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr ml-0">Cancel</button>
                    <button type="submit" class="btn-orange t_b_s mb-0">Save</button>
                </form>
                </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
   function deleteData(id)
   {
      var id = id;
      var url = '{{ action("Admin\HomeController@destroyElevationType", ":id") }}';
      url = url.replace(':id', id);
      $("#deleteForm").attr('action', url);
   }

   function formSubmit()
   {
      $("#deleteForm").submit();
   }
</script>
<script type="text/javascript">
   $(document).ready(function () {
      $(".change_statuses").click(function () {
         $("#type_id").val($(this).attr("type_id"));
         $("#type_status").val($(this).attr("type_status"));
         $("#changeStatus").modal("show");
      });
      $(".yesBtn").click(function () {
         $.ajax({
               type: "POST",
               url: "/api/elevationtypestatus/" + $("#type_id").val(),
               data: { type_id: $("#type_id").val(), type_status: $("#type_status").val() },
               headers: {
                  "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
               },
               /*contentType: 'json',*/
               success: function (response) {
                  console.log(response);
                  if (response == 2) {
                     $("#type_" + $("#type_id").val()).removeClass("btn-outline-danger");
                     $("#type_" + $("#type_id").val()).addClass("btn-outline-success");
                     $("#type_" + $("#type_id").val()).html('<i class="fa fa-check"></i>');
                  } else {
                     $("#type_" + $("#type_id").val()).removeClass("btn-outline-success");
                     $("#type_" + $("#type_id").val()).addClass("btn-outline-danger");
                     $("#type_" + $("#type_id").val()).html('<i class="fa fa-ban"></i>');
                  }
                  $("#changeStatus").modal("hide");
               },
         });
      });
   });

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

</script>
@endpush 
