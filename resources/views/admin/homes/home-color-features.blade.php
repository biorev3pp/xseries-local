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
                            <a href="{{ route('homes') }}">{{$homes->title}}</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a href="{{route('homes_color_scheme', ['id' =>$home_id])}}">Color Schemes</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">{{$color_scheme->title}}</li>
                        <li class="breadcrumb-item active" aria-current="page">Color Features</li>
                    </ol>
                </div>
            </div>
        </div>  
        <div class="mt-1 mt-sm-0">
            <div class="btn-group">
                <a href="{{route('homes_color_scheme', ['id' =>$home_id])}}" class="add_button"><i class="fa fa-arrow-left position-relative"></i> Back</a>
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
            <a href="javascript:void(0)">
                <button data-toggle="modal" data-target="#importModal" type="button" id="upload_csv_color_scheme_feature_btn" class="add_button btn btn-dark btn-min-width mr-1 waves-effect waves-light">
                    <i style="top: 0;" class="fa fa-file-excel"></i> Upload CSV
                </button>
            </a>
            <a href="javascript:void(0);" data-toggle="modal" data-target="#upgrade_images"><button type="button" class="btn btn-dark btn-min-width mr-1 waves-effect waves-light">Upgrade Images</button></a>
            <a href="javascript:void(0);" data-toggle="modal" data-target="#add_home">
                <button type="button" class="btn btn-dark btn-min-width mr-1 waves-effect waves-light"><i style="top: 0;" class="fas fa-plus"></i> Add Color Feature</button>
            </a>
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
                                <a class="btn btn-sm btn-outline-dark show-tooltip" href="{{route('color_features_edit', ['id' => base64_encode($feature->id)])}}" title="Edit Feature"><i class="fa fa-edit"></i></a>

                              <a class="btn btn-sm btn-outline-danger feature_delete show-tooltip" id="{{base64_encode($feature->id)}}" onclick="deleteData({{$feature->id}})" data-toggle="modal" title="Delete Feature" data-target="#modal-delete">
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
    <!-- Upgrade Images -->
    <div class="modal fade bd-example-modal-lg" id="upgrade_images" tabindex="-1" role="dialog" aria-labelledby="add_homeLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="margin-top: 67px;">
                <div class="modal-header dark-color">
                    <h5 class="modal-title" id="manageuserLabel">Upgrade Images</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times"></i> </span>
                    </button>
                </div>
                <div class="modal-body" style="overflow-x: auto;">
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Concrete</th>
                                <th scope="col">Window</th>
                                <th scope="col">Side</th>
                                <th scope="col">Image</th>
                                <th scope="col">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($color_scheme_upgrades as $key => $color_scheme_upgrade)

                            <tr>
                                <th scope="row">{{++$key}}</th>
                                @if($color_scheme_upgrade->concrete == 1)
                                <td><i class="fas fa-check" style="color: #8bc34a;"></i></td>
                                @else
                                <td><i class="fas fa-times" style="color: #f44336;"></i></td>
                                @endif @if($color_scheme_upgrade->window == 1)
                                <td><i class="fas fa-check" style="color: #8bc34a;"></i></td>
                                @else
                                <td><i class="fas fa-times" style="color: #f44336;"></i></td>
                                @endif @if($color_scheme_upgrade->side == 1)
                                <td><i class="fas fa-check" style="color: #8bc34a;"></i></td>
                                @else
                                <td><i class="fas fa-times" style="color: #f44336;"></i></td>
                                @endif @if($color_scheme_upgrade->img == "")
                                <td><img id="blah2" src="http://placehold.it/100" width="100" height="100" alt="your image" /></td>
                                @else
                                <td><img id="upgrade_img" src="/uploads/homes/{{$color_scheme_upgrade->img}}" width="100" height="100" alt="your image" style="object-fit: contain;" /></td>
                                @endif
                                <td>
                                    <form enctype="multipart/form-data">
                                        <input type="hidden" value="{{base64_encode($color_scheme_upgrade->id)}}" name="upgrade_id" class="upgrade_id" />
                                        <label class="btn btn-default btn-file rounded-0" style="margin: 0px auto !important;">
                                            Choose File
                                            <input type="file" name="img" class="form-control no_bor upgrade-input" style="display: none !important;" />
                                        </label>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Upgrade Images -->

    <!-- Add Upgrade Feature -->

    <div class="modal fade" id="add_upgrade_feature" tabindex="-1" role="dialog" aria-labelledby="add_homeLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header dark-color">
                    <h5 class="modal-title" id="manageuserLabel">Manage Upgrade Feature</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times"></i> </span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('upgrade_features_save')}}" name="upgrade_feature" id="upgrade_feature" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="color_scheme_id" value="{{Request::segment(4)}}" />
                        <input type="hidden" name="upgrade_type" id="upgrade_feature_type" value="" />
                        <input type="hidden" name="feature_id" id="upgrade_feature_id" value="" />
                        <input type="hidden" name="group_id" id="group_id" value="" />
                        <input type="hidden" name="upgrade_exists" id="upgrade_exists" value="0" />
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input id="upgrade_title" required class="form-control forms1" name="title" placeholder="Title" type="text" />
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input required id="upgrade_price" class="form-control forms1" name="price" placeholder="Cost" type="text" />
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input required id="upgrade_material" class="form-control forms1" name="material" placeholder="Material" type="text" />
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input required id="upgrade_manufacturer" class="form-control forms1" name="manufacturer" placeholder="Manufacturer" type="text" />
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input required id="upgrade_name" class="form-control forms1" name="name" placeholder="Name" type="text" />
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input required id="upgrade_m_id" class="form-control forms1" name="m_id" placeholder="Id" type="text" />
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="status">Thumbnail</label>
                                    <!-- <input required class="form-control no_bor forms1" name="img" type="file"> -->
                                    <label class="btn btn-default btn-file rounded-0" style="margin-top: 0px !important;">
                                        <!-- The file is stored here. -->Choose File
                                        <input type="file" class="form-control no_bor forms1" id="file1" onchange="readURL1(this);" name="img" style="display: none !important;" />
                                    </label>
                                    <img id="blah1" src="http://placehold.it/150" width="150" height="150" alt="your image" />
                                    <p class="mt-1 ml-1" id="imageAlert"></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div id="upgrade_loader" class="form-group"></div>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                        <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr">Cancel</button>
                        <button type="submit" id="upgradeSubmit" class="btn-orange t_b_s">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Upgrade Feature-->

    <!-- Start Activate and Deactivate Popup -->
    <div class="modal fade" id="addColorFeature" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-hidden="true">
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
                            <input type="hidden" name="color_feature_id" id="color_feature_id" value="" />
                            <input type="hidden" name="color_feature_status" id="color_feature_status" value="" />

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

    <div class="modal fade" id="add_home" tabindex="-1" role="dialog" aria-labelledby="add_homeLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header dark-color">
                    <h5 class="modal-title" id="manageuserLabel">Add Feature</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times"></i> </span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('color_features_save')}}" name="home" id="home" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="color_scheme_id" value="{{Request::segment(4)}}" />
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input required class="form-control forms1" name="title" placeholder="Title" type="text" />
                                </div>
                                <div class="form-group"><input type="checkbox" name="upgradable" id="upgradable" value="1" /> Upgradable</div>

                                <div id="upgrade_types" class="form-group" style="display: none;">
                                    <input name="upgrade_type" style="margin-right:2px;" type="radio" value="1" />Concrete <input name="upgrade_type" style="margin-right:2px;" type="radio" value="2" />Window <input name="upgrade_type" style="margin-right:2px;" type="radio" value="3" />Wall
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="status">Thumbnail</label>
                                    <!-- <input required class="form-control no_bor forms1" name="img" type="file"> -->
                                    <label class="btn btn-default btn-file rounded-0" style="margin-top: 0px !important;">
                                        <!-- The file is stored here. -->Choose File
                                        <input type="file" class="form-control no_bor forms1" id="file" onchange="readURL(this);" name="img" style="display: none !important;" />
                                    </label>
                                    <img id="blah" src="http://placehold.it/150" width="150" height="150" alt="your image" />
                                    <p class="mt-1" id="featureImageAlert"></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input required class="form-control forms1" name="price" placeholder="Cost" type="number"  step="any"/>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input required class="form-control forms1" name="material" placeholder="Material" type="text" />
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input required class="form-control forms1" name="manufacturer" placeholder="Manufacturer" type="text" />
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input required class="form-control forms1" name="name" placeholder="Name" type="text" />
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input required class="form-control forms1" name="m_id" placeholder="Id" type="text" />
                                </div>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                        <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr">Cancel</button>
                        <button type="submit" id="saveFeature" class="btn-orange t_b_s">Save</button>
                    </form>
                </div>
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
            <form id="upload_color_scheme_csv" action="{{route('upload-color-scheme-feature-csv')}}" method="POST" enctype="multipart/form-data">
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
                                            <input class="form-control" id="color_scheme_id" name="color_scheme_id" value="{{Request::segment(count(Request::segments()))}}" type="hidden" />
                                        </label>

                                        <button type="button" class="btn btn-default remove-btn" style="display: none;"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <a href="{{ url('/admin/colorscheme-feature-sample.csv') }}" target="_blank" class="btn-orange"><i class="fa fa-file-excel"></i> Sample CSV</a>
                        </div>

                        <div class="clearfix"></div>
                        <!--<a href="javascript:void();"><button type="submit" class="btn-orange t_b_s d_gr">Cancel </button></a>-->
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
      var url = '{{ action("Admin\HomeController@destroyColorFeature", ":id") }}';
      url = url.replace(':id', id);
      $("#deleteForm").attr('action', url);
   }

   function formSubmit()
   {
      $("#deleteForm").submit();
   }
                          
$(document).ready(function()
{
   
    $('.click_upgrade').click(function()
    { 
        var feature_id=$(this).attr('upgrade_feature_id');
        $('#group_id').val(feature_id);
        $('#upgrade_feature_type').val($(this).attr('upgrade_feature_type'));
        $('#upgrade_feature_id').val(feature_id);
         $('#upgrade_loader').html('<p class="text-center"><img src="https://xseries.renderings360.com/images/spinner.gif"></p>');
        $.ajax({
          type:'POST',
          dataType : "html",
          'url':'{{route("checkUpgrade")}}',
          'data':{'_token':"{{csrf_token()}}",'feature_id':feature_id},
          'success': function(result){
            var obj = JSON.parse(result);
           //console.log(obj);
           //var obj=JSON.parse(response);
           
           //console.log(response);
           if(obj.data){
            var response = obj.data;
            //alert('not null');
            $('#upgrade_exists').val(1);
           $('#upgrade_title').val(response.title);
           $('#upgrade_price').val(response.price);
           $('#upgrade_material').val(response.material);
           $('#upgrade_manufacturer').val(response.manufacturer);
           $('#upgrade_m_id').val(response.m_id);
           $('#upgrade_name').val(response.name);
           $('#blah1').attr('src','{{url("/uploads/homes")}}/'+response.img);
           $('#upgrade_loader').html('');
            }else{
              $('#upgrade_loader').html('');
            }

          }

        });
        $('#add_upgrade_feature').modal('show');  
    });
});

$(document).ready(function()
{
    $('.color_feature_status').click(function()
    {
        $('#color_feature_id').val($(this).attr('color_feature_id'));
        $('#color_feature_status').val($(this).attr('color_feature_status'));
        $('#addColorFeature').modal('show');  
    });
    $('.yesBtn').click(function()
    {
        $.ajax(
        {
            type: 'POST',
            url: '/api/colorfeatureStatus/'+ $('#color_feature_id').val(),
            data: {'color_feature_id': $('#color_feature_id').val() ,'color_feature_status': $('#color_feature_status').val()},
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
                	$('#color_feature_'+ $('#color_feature_id').val()).removeClass('btn-outline-danger');
                  	$('#color_feature_'+ $('#color_feature_id').val()).addClass('btn-outline-success');
                	$('#color_feature_'+ $('#color_feature_id').val()).html('<i class="fa fa-check"></i>');
                } 
                else 
                {	
                	$('#color_feature_'+ $('#color_feature_id').val()).removeClass('btn-outline-success');
                  	$('#color_feature_'+ $('#color_feature_id').val()).addClass('btn-outline-danger');
                    $('#color_feature_'+ $('#color_feature_id').val()).html('<i class="fa fa-ban"></i>');
                }
                $('#addColorFeature').modal('hide');
            }
        });
    });
});
function readURL(input) {
    var fileName = document.getElementById("file").value;
      var idxDot = fileName.lastIndexOf(".") + 1;
      var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
      if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
        document.getElementById("saveFeature").disabled = false;
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $("#blah").attr("src", e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
        $('#featureImageAlert').fadeOut();
      }
      else{
        document.getElementById("saveFeature").disabled = true;
        $('#featureImageAlert').html("Only jpg/jpeg and png files are allowed!").show().addClass('alert').addClass('alert-danger');
      } 
    }
//   .attr('src', e.target.result)
   $(document).on("change",".upgrade-input",function(){
      var input = $(this);
//   console.log('test');
      if (this.files && this.files[0]) 
      {
          var reader = new FileReader();

          reader.onload = function (e) 
          {
             input.closest('td').siblings().find("img").attr('src', e.target.result);
          };
          reader.readAsDataURL(this.files[0]);
      }

      var id = input.closest("form").find(".upgrade_id").val();
      console.log(id);
      
         var file_data = input.prop("files")[0];
//             console.log(file_data);
             var form_data = new FormData();
                form_data.append('upgrade_id',id);
             form_data.append('img', file_data);
             form_data.append('_token', '{{csrf_token()}}');

             $.ajax({
                    type:"POST",
                    url:"{{route('upgrade_image_save')}}",
                    data:form_data,
                    contentType: false,
                    cache: false,
                    processData:false,  

                    success:function(result){
                       console.log(result);
                    }

             })
      
   });
   $(document).on('click','#upgradable',function(){
    if($(this).prop('checked')){
       $('#upgrade_types').show();
    }else{
       $('#upgrade_types').hide();
    }
   
   });
    
   
</script>
@endpush

