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
                        <a href="{{ route('homes') }}">{{$homes->title}}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Color Schemes</li>
                </ol>
            </div>
        </div> 
        <div class="mt-1 mt-sm-0">   
            <div class="btn-group">
                @if($homes->parent_id == 0)
                <a href="{{route('homes')}}" class="add_button"><i class="fa fa-arrow-left position-relative"></i> Back</a>
                @else
                <a href="{{route('homes_elevation_type',['id'=>base64_encode($homes->parent_id)])}}" class="add_button"><i class="fa fa-arrow-left position-relative"></i> Back</a>
                @endif
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
            <a href="javascript:void(0)" data-toggle="modal" data-target="#importModal">
                <button type="button" id="upload_csv_color_scheme_btn" class="add_button btn btn-dark btn-min-width mr-1 waves-effect waves-light"><i style="top: 0;" class="fa fa-file-excel"></i> Upload CSV</button>
            </a>
            <a href="javascript:void(0);" data-toggle="modal" data-target="#add_home" id="add_color_scheme">
                <button type="button" class="btn btn-dark btn-min-width mr-1 waves-effect waves-light"><i style="top: 0;" class="fas fa-plus"></i> Add Color Scheme</button>
            </a>
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
                                <a class="btn btn-sm btn-outline-dark show-tooltip" href="{{route('color_scheme_edit', ['id' => base64_encode($color_scheme->id)])}}"><i class="fa fa-edit" title="Edit Color Scheme"></i></a>

                                <a href="{{route('color_features', ['id' => base64_encode($color_scheme->id)])}}" class="btn btn-sm btn-outline-dark show-tooltip" title="Manage Color Features"><i class="fas fa-sliders-h"></i></a>

                                <a class="scheme_delete btn btn-sm btn-outline-danger show-tooltip" id="{{base64_encode($color_scheme->id)}}" onclick="deleteData({{$color_scheme->id}})" data-toggle="modal" data-target="#modal-delete" title="Delete Color Scheme">
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
    <div class="modal fade" id="addScheme" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-hidden="true">
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
                            <input type="hidden" name="scheme_id" id="scheme_id" value="" />
                            <input type="hidden" name="scheme_status" id="scheme_status" value="" />

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

    <!--Delete popup-->
</div>

<div class="modal fade" id="add_home" tabindex="-1" role="dialog" aria-labelledby="add_homeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="margin-top: 67px;">
            <div class="modal-header dark-color">
                <h5 class="modal-title" id="manageuserLabel">Add Color Scheme</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i> </span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('save_color_scheme')}}" name="home" id="home" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="home_id" value="{{Request::segment(4)}}" />

                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <input required class="form-control forms1" name="title" placeholder="Title" type="text" />
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <input required class="form-control forms1" name="price" placeholder="Cost" type="number" min="0" />
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="status">Main Image</label>
                                <!-- <input required class="form-control no_bor forms1" name="base_img" type="file"> -->
                                <label class="btn btn-default btn-file rounded-0" style="margin-top: 0px !important;">
                                    <!-- The file is stored here. -->Choose File
                                    <input type="file" class="form-control no_bor forms1" name="base_img" onchange="readURL2(this);" id="file2" style="display: none !important;" />
                                </label>
                                <img id="blah2" src="http://placehold.it/150" width="150" height="150" alt="your image" />
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="status">Thumbnail</label>
                                <!-- <input required class="form-control no_bor forms1" name="img" type="file"> -->
                                <label class="btn btn-default btn-file rounded-0" style="margin-top: 0px !important;">
                                    <!-- The file is stored here. -->Choose File
                                    <input type="file" class="form-control no_bor forms1" name="img" onchange="readURL1(this);" id="file1" style="display: none !important;" />
                                </label>
                                <img id="blah1" src="http://placehold.it/150" width="150" height="150" alt="your image" />
                            </div>
                        </div>
                        <p id="imageAlert" class="d-block w-100 ml-1 mr-1 mt-1"></p>
                        <div class="clearfix"></div>
                        <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr">Cancel</button>
                        <button type="submit" id="mySubmit" class="btn-orange t_b_s">Save</button>
                    </div>
                </form>
            </div>
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
            <form id="upload_color_scheme_csv" action="{{route('upload-color-scheme-csv')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-body">
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
                            <a href="{{ url('/admin/colorscheme-sample.csv') }}" target="_blank" class="btn-orange"><i class="fa fa-file-excel"></i> Sample CSV</a>
                        </div>

                        <div class="clearfix"></div>
                        <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr">Cancel</button>
                        <button type="submit" class="btn-orange t_b_s">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
   function deleteData(id)
   {
      var id = id;
      var url = '{{ action("Admin\HomeController@destroyColorScheme", ":id") }}';
      url = url.replace(':id', id);
      $("#deleteForm").attr('action', url);
   }

   function formSubmit()
   {
      $("#deleteForm").submit();
   }
</script>
<script type="text/javascript">
$(document).ready(function()
{
    $('.scheme_status').click(function()
    {
        $('#scheme_id').val($(this).attr('scheme_id'));
        $('#scheme_status').val($(this).attr('scheme_status'));
        $('#addScheme').modal('show');  
    });
    $('.yesBtn').click(function()
    {
        $.ajax(
        {
            type: 'POST',
            url: '/api/colorschemeStatus/'+ $('#scheme_id').val(),
            data: {'scheme_id': $('#scheme_id').val() ,'scheme_status': $('#scheme_status').val()},
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            /*contentType: 'json',*/
            success: function (response) 
            {
                console.log(response);
                if(response == 2) 
                {
                  $('#scheme_'+ $('#scheme_id').val()).removeClass('btn-outline-danger');
                  $('#scheme_'+ $('#scheme_id').val()).addClass('btn-outline-success');
                  $('#scheme_'+ $('#scheme_id').val()).html('<i class="fa fa-check"></i>');
                } 
                else 
                {
                  $('#scheme_'+ $('#scheme_id').val()).removeClass('btn-outline-success');
                  $('#scheme_'+ $('#scheme_id').val()).addClass('btn-outline-danger');
                  $('#scheme_'+ $('#scheme_id').val()).html('<i class="fa fa-ban"></i>');
                }
                $('#addScheme').modal('hide');
            }
        });
    });
});

function readURL1(input) {
      var fileName = document.getElementById("file1").value;
      var idxDot = fileName.lastIndexOf(".") + 1;
      var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
      if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
        document.getElementById("mySubmit").disabled = false;
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $("#blah1").attr("src", e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
        $('#imageAlert').removeClass('d-block');
        $('#imageAlert').fadeOut();
      }
      else{
        document.getElementById("mySubmit").disabled = true;
        $('#imageAlert').html("Only jpg/jpeg and png files are allowed!").show().addClass('alert').addClass('alert-danger');
      } 
    }
    function readURL2(input) {
      var fileName = document.getElementById("file2").value;
      var idxDot = fileName.lastIndexOf(".") + 1;
      var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
      if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
        document.getElementById("mySubmit").disabled = false;
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $("#blah2").attr("src", e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
        $('#imageAlert').removeClass('d-block');
        $('#imageAlert').fadeOut();
      }
      else{
        document.getElementById("mySubmit").disabled = true;
        $('#imageAlert').html("Only jpg/jpeg and png files are allowed!").show().addClass('alert').addClass('alert-danger');
      } 
    }
</script>
@endpush 
