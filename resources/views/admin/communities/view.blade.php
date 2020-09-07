@extends('layouts.admin') @section('content')
<style>
    .form-group label{
        color:#3c3c3c;
        font-weight:600 !important;
        margin-top:10px;
    }
    .left-align{
        padding:0;
        text-align:left;
    }
    .right-align{
        padding:0;
        text-align:right;
    }
    @media(max-width:540px){
        .left-align{
            text-align:left;
        }
        .right-align{
            text-align:left;
        }
    }
    @media (min-width: 768px)
    {
        #bulk_edit{
            padding:0.65rem 0rem;
        }
    }
</style>
@php
    if($community->nearby) $nearby = get_object_vars(json_decode($community->nearby));
    else $nearby = []; 
    $icons = ['hospital' => 'fa-hospital-o', 'restaurant' => 'fa-cutlery', 'school' => 'fa-graduation-cap', 'shopping_mall' => 'fa fa-cart-plus'];
@endphp
<div class="container-fluid page-wrapper">
    <!-- Page Heading -->
    <div class="row justify-content-between mb-2 pl-1 pr-1 align-items-center">
        <div>
            <h1 class="a_dash m-0 p-0 d-inline-block">Communities <small><span class="color-secondary">|</span></small></h1>
                <div class="row breadcrumbs-top pl-2 d-inline-block">
                    <ol class="breadcrumb"> 
                    <li class="breadcrumb-item">
                    <a href="{{ route('communities') }}"> {{ $community->name }} </a>
                    </li>
                    <li class="breadcrumb-item active">Manage </li>
                    </ol>
                </div>
        </div> 
        <div>
            <div class="btn-group">
                <a href="{{ route('communities') }}" class="add_button"><i class="fa fa-arrow-left position-relative"></i> Back</a>
            </div>
        </div>   
    </div>

    <div class="card">
        <div class="card-body">
            <div class="bottom_sp">
            <!--left area-->
                <div class="col-lg-5 col-md-12 col-sm-6 float-left p-0">
                    <img src="{{asset('/uploads/'.$community->banner) }}">
                </div>
                <!--left area-->
                <!--right area-->
                <div class="col-lg-7 col-md-12 col-sm-6 float-left" id="edi_del_dd">
                    <h1>{{ $community->name }}<span>{{ $community->location }}</span></h1>
                    <h1>Description<span>{{ $community->description }}</span>
                    </h1>
                    <h1>Specifications<span>{{ $community->contact_person }}<br>
                        {{ $community->contact_number}} <br>
                        {{ $community->contact_email }}</span>
                    </h1>
                    <div class="man_commun">
                        <div class="e-d-d">
                            <span><a class="a1" href="/admin/communities/edit/{{ base64_encode($community->id)}}"><i class="fa fa-edit"></i>Edit</a></span>
                            @if($community->status_id == 2)
                            <span><a class="a1 green change_status" href="javascript:void(0);" id="com_{{$community->id}}" community_id="{{$community->id}}" status_id="{{ $community->status_id }}"><i class="fa fa-check"></i><strong>Active</strong></a></span> @else
                            <span><a class="a1 red change_status text-success" href="javascript:void(0);" id="com_{{$community->id}}" community_id="{{$community->id}}" status_id="{{ $community->status_id }}"><i class="fa fa-ban"></i><strong>Deactive</strong></a></span> @endif
                        </div>
                    </div>
                </div>
            <!--right area-->
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-content collapse show">
            <div class="card-body p-0">
                <nav>
                    <div class="nav nav-tabs myTabSettings" role="tablist">
                        <a class="nav-item wf-25 nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" style="line-height: 30px;">PLAT DETAILS</a>
                        <a class="nav-item wf-25 nav-link" id="nav-lots-tab" data-toggle="tab" href="#nav-lots" role="tab" aria-controls="nav-lots" aria-selected="false" style="line-height: 30px;">LOT DETAILS</a>
                        <a class="nav-item wf-25 nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" style="line-height: 30px;">COMMUNITY GALLERY</a>
                        <a class="nav-item wf-25 nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false" style="line-height: 30px;">COMMUNITY LOCATIONS</a>
                    </div>
                </nav>
                <div class="tab-content p-2" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div>
                           <div class="row">
                                <div class="col-sm-6 border-right">
                                    <ul class="imglister">
                                        <li>
                                            <span class="imgboxname"> SVG Image </span>
                                            <div class="imgbox">
                                                @if($plat->svg)
                                                    <img src="{{asset('/uploads/'.$plat->svg) }}"> 
                                                @else
                                                    <img src="{{asset('/images/'.'no-image.png')}}"> 
                                                @endif
                                            </div>
                                        </li>
                                        <li>
                                            <span class="imgboxname"> Background Image </span>
                                            <div class="imgbox">
                                                
                                                @if($plat->svg)
                                                    <img src="{{asset('/uploads/'.$plat->image) }}"> 
                                                @else
                                                    <img src="{{asset('/images/'.'no-image.png')}}"> 
                                                @endif
                                            </div>
                                        </li>
                                    
                                </div>
                                <div class="col-sm-6 padding-zero">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th colspan="2" class="text-left">{{ $legend_group->groupname }}</th>
                                                <th style="width:100px"><a href="javascript:void(0)" onclick="colorLegendUpdate(1, <?= $legend_group->id ?>)"> <i class="fa fa-plus-square"></i> </a> </th>
                                            </tr>
                                        </thead>
                                        <tbody id="lglist">
                                            
                                        </tbody>
                                    </table>
                                </div>
                           </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="nav-lots" role="tabpanel" aria-labelledby="nav-lots-tab">
                        <div class="right_btn_3">
                            <a href="{{ route('export-lots', ['id' => $community->id]) }}" target="_blank" class="btn-orange mr-1"><i class="fa fa-file-excel"></i> Download</button></a>

                            <a href="javascript:void(0);">
                                <button type="button" class="btn-orange  b_dr" data-toggle="modal" data-target="#importModal"><i class="fa fa-file-excel"></i>Upload CSV</button>

                            </a>
                        </div>
                        <div class="clearfix"></div>
                        <div id="f_mar">
                        <div class = "row mb-1" style="padding: 10px 15px 2px 15px; margin:0px ; border: 1px solid #ccc; background-color: #e3e3e3;">
                            <div class="col-lg-2 col-md-3">
                                <div class="form-group">
                                    <label class="">
                                    <input type="checkbox" style="position: relative;top: 1.5px;" name="sample" class="select-all"/> Select All
                                </label>
                                </div>
                            </div>
                            <div class='col-lg-8 col-md-6'>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="row">
                                            <div class="col-sm-4 col-xl-2 right-align">
                                                    <label>Price:</label>
                                                </div>
                                                <div class="col-sm-8 col-xl-10 left-align">
                                                    <input required class="form-control" name="bulk_price" id="bulk_price" placeholder="Enter Price (If Required)" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-4 col-xl-2 right-align">
                                                    <label>Status:</label>
                                                </div>
                                                <div class="col-sm-8 col-xl-10 left-align">
                                                    <select class="form-control" name="bulk_status" id="bulk_status">
                                                    <option value="">Select Status</option>
                                                    @foreach($legend_group->legends as $legend)
                                                    <option value="{{ $legend->id }}">{{ $legend->name }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-4 col-xl-2 right-align">
                                                    <label>Phase:</label>
                                                </div>
                                                <div class="col-sm-8 col-xl-10 left-align">
                                                    <select class="form-control" name="bulk_phase" id="bulk_phase">
                                                    <option value="">Select Phase</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-2 col-md-3">
                                <button type="button" id="bulk_edit" class="btn-orange d_gr float-none" style="line-height: 16px;width: 100%; margin-top: 2px;">Bulk Edit</button>
                            </div>
                        </div>
                            <div class="table-responsive" id="custom_table">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>

                                        <tr>

                                            <th width="100px">Lot No</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Phase</th>
                                            <th width="60px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($lots as $lot)

                                        <tr id="row{{$lot->id}}">

                                            <td id="alias{{$lot->id}}"><input class="lot-checkbox" type="checkbox" name="sample[]" value="{{$lot->id}}"/> {{$lot->alias}}</td>
                                            <td id="price{{$lot->id}}">{{$lot->price}}</td>
                                            <td id="status{{$lot->id}}">{{ (isset($lot->legend)) ? $lot->legend->name : '' }}</td>
                                            <td id="phase{{$lot->id}}">{{$lot->phase}}</td>
                                            <td>
                                            
                                                <a class="" title="Homes" href="{{route('lot_homes',['community_id'=>base64_encode($community->id),'lot_id'=>base64_encode($lot->id)])}}"><i class="fas fa-home"></i></a> 
                                                <a class="show-modal click_edit" title="Edit" href="javascript:void();" data-toggle="modal" alt="" data-id="{{$lot->id}}" data-status="{{ $lot->legend_id }}" data-target="#editlot" data-alias="{{$lot->alias}}" data-price="{{$lot->price}}" data-groupid="{{$lot->groupID}}"><i class="fa fa-edit" ></i></a>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="formbox">
                            <form action="javascript:void(0);" id="uploadForm" name="frmupload" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group" id="f_mar">
                                            <label for="logoImage">Upload Image</label>
                                            <div class="imageupload panel panel-default">
                                                <div class="file-tab panel-body">
                                                    <label class="btn btn-default btn-file rounded-0">
                                                        Choose File
                                                        <input type="file" id="uploadImage" onclick="form.submit()" name="uploadImage" style="visibility:hidden; width:5px">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                    <label for="logoImage" class="d-block" style="visibility:hidden; "> action</label>
                                        <input id="submitButton" type="submit" name='btnSubmit' class="btn-orange" value="Upload Image" />
                                        <input type="hidden" name="community_id" value="{{$community->id}}">
                                    </div>
                                    <div class="col-md-4">
                                        <div id="message" style="display:none"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="grid-hover row" id="galleryrow">
                         
                        </div>
                    </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="col-lg-12">
                        <h3 class="loc-details">Location Details</h3>
                    </div>
                    <div id="success_msg"></div> 

                    <form action="javascript:void(0);" id="locationForm" name="locationForm" method="post" >
                        {{ csrf_field() }}
                        <input type="hidden" name="map_zoom" id="map_zoom" value="<?= ($community->map_zoom != '')?$community->map_zoom:'6';?>">
                        <input type="hidden" name="map_type_id" id="map_type_id" value="<?= ($community->map_type_id != '')?$community->map_type_id:'roadmap';?>">
                            <div class="row">
                                <div class="form-group col-lg-3 col-md-3">
                                    <input id="pac-input" class="form-control" type="text" name="address" value="{{$community->marker}}" placeholder="Type here to find address on map" />
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <label for="companyName">Latitude</label>
                                    <input class="form-control" name="lat" type="text" placeholder="Latitude" id="input-latitude"  value="{{$community->lat}}" readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <label for="contact">Longitude</label>
                                    <input class="form-control" name="lng" type="text" placeholder="Lontgitude" id="input-longitude" value="{{$community->lng}}" readonly="readonly"/>
                                    </div>
                                </div>  
                                <div class="col-lg-3 col-md-3 col-sm-3">   
                                    <label class="d-block" style="visibility:hidden; height:25px"> &nbsp;</label>
                                    <input type="hidden" name="community_id" value="{{ $community->id }}">
                                    <input type="button" name="submit" id="submit" class="btn-orange" value="Submit" />  
                                </div>
                                <div class="form-group col-lg-12">      
                                    <div id="map-canvas"  style="height:400px;width:100%;"></div>
                                </div>
                            </div> 
                        </form>
                    

                    <div class="clearfix"></div>
    
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 float-left">
                            <h3 class="loc-details">Nearby Location</h3>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 float-left">
                            <div class="form-group row sort-by float-right">
                                <div class="dropdown" id="sp_right">
                            
                                    <select name="type" id="type" class="form-control">
                                        <option value="hospital">Hospitals</option>
                                        <option value="school">Schools</option>
                                        <option value="restaurant">Restaurants</option>
                                        <option value="shopping_mall">Shopping Malls</option>
                                    </select>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="f_mar">
                        <div class="table-responsive border-top">
                            <table class="table table-bordered table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th width="50px" class="text-left">Sr.No.</th>
                                        <th class="text-left">Name</th>
                                        <th class="text-left">Address</th>
                                        <th class="text-left">Distance (M)</th>
                                        <th class="text-left">Status</th>
                                        <th width="70px" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="location_data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addStatus" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times"></i>  </span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <h6 class="delete_heading">Do you want to update the status ?
                                    </h6>
                        <div class="clearfix"></div>
                        <div class="m-auto">

                            <input type="hidden" name="community" id="community" value="">
                            <input type="hidden" name="status" id="status" value="">

                            <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr"> No </button>
                            <button type="button" class="btn-orange t_b_s yesBtn"> Yes</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<!--edit lot model-->

<div class="modal fade bd-example-modal-xl" id="editlot" tabindex="-1" role="dialog" aria-labelledby="editlotLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Edit Lot</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i>  </span>
                </button>
            </div>

            <form method="post" action="javascript:void(0);" name="FormUpdate" id="FormUpdate">
                {{csrf_field()}}

                <input type="hidden" name="id" id="id" value="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="modelName">Lot No.</label>
                                <input required class="form-control" name="alias" id="alias" placeholder="lot no" type="text">
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="modelName">Group</label>

                                <input required class="form-control" name="groupid" id="groupid" placeholder="group" type="text">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="modelName">Price</label>

                                <input required class="form-control" name="price" id="price" placeholder="Price" type="text">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="modelName">Status </label>
                                <select class="form-control" name="status" id="status">
                                   @foreach($legend_group->legends as $legend)
                                    <option value="{{ $legend->id }}">{{ $legend->name }}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        </div>

                        <div class="clearfix"></div>
                        <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr">Cancel</button>
                        <button type="submit" name="lotSave" id="lotSave" class="btn-orange t_b_s">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!--edit lot model-->
<div class="modal fade bd-example-modal-xl" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Csv Import</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i>  </span>
                </button>
            </div>
            <form data-parsley-validate name="csv_import" action="{{ route('upload-csv') }}" method="post" enctype="multipart/form-data">
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
                                            <input type="file" id="csv_file" name="csv_file" placeholder="csv_file" style="display:none !important;">
                                            <input class="form-control" id="plot_id" name="plot_id" value="{{ $plat->id }}" type="hidden">

                                        </label>

                                        <button type="button" class="btn btn-default remove-btn" style="display: none;"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <a href="{{ url('/admin/lots-sample.csv') }}" target="_blank" class="btn-orange"><i class="fa fa-file-excel"></i> Sample CSV</a>

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
<!-- Popup modal for csv import -->


<div class="modal fade bd-example-modal-xl_1" id="image-delete" tabindex="-1" role="dialog" aria-labelledby="add_design_groupLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i>  </span>
                </button>
            </div>
            <form method="post" action="javascript:void(0)" class="m-0" name="deleteImgForm" id="deleteImgForm">
                @csrf
                <input type="hidden" id="cid" name="cid" value="{{ $community->id }}"> 
                <input type="hidden" id="gname" name="gname" value=""> 
                <div class="modal-body">
                    <div class="row">
                        <h6 class="delete_heading">Are you sure you want to delete this Image?</h6>
                        <div class="clearfix"></div>
                        <div class="m-auto">
                            <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr">No</button>
                            <button type="submit" class="btn-orange t_b_s"> Yes</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-xl_1" id="cl-delete" tabindex="-1" role="dialog" aria-labelledby="add_design_groupLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style ="margin-left: 110px;">
            <div class="modal-header">
                <h5>Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i>  </span>
                </button>
            </div>
            <form method="post" action="javascript:void(0)" name="deleteCLForm" id="deleteCLForm" class="m-0">
                @csrf
                <input type="hidden" id="id" name="id" value=""> 
                <div class="modal-body">
                    <div class="row">
                        <h6 class="delete_heading">Are you sure you want to delete this color Legend?</h6>
                        <div class="clearfix"></div>
                        <div class="m-auto">
                            <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr">No</button>
                            <button type="submit" class="btn-orange t_b_s"> Yes</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-xl_1" id="colorLegand" tabindex="-1" role="dialog" aria-labelledby="add_design_groupLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="cl-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i>  </span>
                </button>
            </div>
            <form method="post" action="javascript:void(0)" name="colorLegandForm" id="colorLegandForm">
                @csrf
               
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cl-name" class="label-control"></label>
                                <input type="text" name="cl_name" id="cl-name" class="form-control" placeholder="Color Legend Name">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cl-code" class="label-control"></label>
                                <input type="text" name="cl_code" id="cl-code" class="form-control jscolor {zIndex:9999}" placeholder="Color Code">
                            </div>
                        </div>
                        <div class="col-12">
                            <a href="javascript:void();">
                                <input type="hidden" name="cl_id" id="cl-id" class="form-control">
                                <input type="hidden" name="cl_gid" id="cl-gid" class="form-control">
                                <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr">Cancel</button>
                            </a>
                            <button type="submit" class="btn-orange t_b_s" id="cl-btn"> Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--delete popup-->
</div>

<style type="text/css">
    #message {
        border: 16px solid #f3f3f3;
        /* Light grey */
        border-top: 16px solid #3498db;
        /* Blue */
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>

<style>
/* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
      #target {
        width: 345px;
      }
</style>

@endsection
<script src="{{ asset('cms/js/jscolor.js')  }}"></script>
<script type="text/javascript">
    function deleteData(id) {
        var id = id;
        var url = '{{ action("Admin\CommunitiesController@lotdelete", ":id") }}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

    function deleteImage(val) {
        $('#deleteImgForm input#gname').val($('#ablock'+val).attr('data-gname'));
        $('#image-delete').modal('show');
    }

    function deleteColorLegend(val) {
        $('#deleteCLForm input#id').val(val);
        $('#cl-delete').modal('show');
    }

    function formSubmit() {
        $("#deleteForm").submit();
    }

    function colorLegendUpdate(typ, gid, id) {
        if(typ == 1) { $('#cl-title').html('Add Color Legend'); $('#cl-gid').val(gid);  $('#cl-id').val(''); $('#cl-name').val(''); $('#cl-code').val('').css('background', '#fff'); }
        else if(typ == 2) { var name = $('#rowbtn'+id).attr('data-name'); var colorcode = $('#rowbtn'+id).attr('data-color-code'); $('#cl-title').html('Edit Color Legend'); $('#cl-gid').val(gid); $('#cl-id').val(id); $('#cl-name').val(name); $('#cl-code').val(colorcode).css('background', colorcode); }
        $('#colorLegand').modal('show');
    }
</script>
@push('scripts')
<script type="text/javascript">
 var APP_URL = "{{url('/') }}";
    $(document).ready(function() {
        getGallery(); getLegends();
        $('.change_status').click(function() {
            $('#community').val($(this).attr('community_id'));
            $('#status').val($(this).attr('status_id'));
            $('#addStatus').modal('show');

        });
        
        $('#colorLegandForm').submit(function () {
            $.ajax({
                type: 'POST',
                url: APP_URL+'/api/communities/update-color-legend',
                data: $('#colorLegandForm').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                /*contentType: 'json',*/
                success: function(response) {
                    getLegends();
                    $('#colorLegand').modal('hide');
                }
            });
        });

        $('#deleteImgForm').submit(function () {
            $('#image-delete .modal-footer').html('<p class="text-center"><img src="<?= asset('images/spinner.gif') ?>"></p>');
            $.ajax({
                type: 'POST',
                url: APP_URL+'/api/delete-image',
                data: $('#deleteImgForm').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                /*contentType: 'json',*/
                success: function(response) {
                    getGallery();
                    $('#image-delete').modal('hide');
                    $('#image-delete .modal-footer').html('');
                }
            });
        });

        $('#deleteCLForm').submit(function () {
            $('#cl-delete .modal-footer').html('<p class="text-center"><img src="<?= asset('images/spinner.gif') ?>"></p>');
            $.ajax({
                type: 'POST',
                url: APP_URL+'/api/delete-color-legend',
                data: $('#deleteCLForm').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                /*contentType: 'json',*/
                success: function(response) {
                    if(response.status == 'error') {
                        $('#cl-delete .modal-footer').html('<p class="text-danger">'+response.message+'</p>');
                    } else {
                        getLegends();
                        $('#cl-delete').modal('hide');
                        $('#cl-delete .modal-footer').html('');
                    }  
                }
            });
        });

        $('.yesBtn').click(function() {
            $.ajax({
                type: 'POST',
                url: '/admin/communities/changeStatus/' + $('#community').val(),
                data: {
                    'community': $('#community').val(),
                    'status': $('#status').val()
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                /*contentType: 'json',*/
                success: function(response) {
                    if (response == 2) {
                        $('#com_' + $('#community').val()).html('<span class="green" style="margin-left: 0px;"><i class="fa fa-check"></i><strong>Active</strong></span>');
                    } else {
                        $('#com_' + $('#community').val()).html('<span class="red" style="margin-left: 2px;"><i class="fa fa-ban"></i><strong>Deactive</span></strong>');
                    }
                    $('#addStatus').modal('hide');
                }
            });
        });
    });

    $(document).ready(function() {
        var editform = $("#FormUpdate");
        $('.click_edit').click(function() {
            $('#alias').val($(this).data('alias'));
            $('#groupid').val($(this).data('groupid'));
            $('#price').val($(this).data('price'));
            $('#id').val($(this).data('id'));
            var sts = $(this).data('status');
            $('#status option').filter(function() {
                return ($(this).attr('value') == sts); 
            }).prop('selected', true);
        });

        $("#FormUpdate").submit(function() {
            $.ajax({
                type: 'post',
                url: '/admin/communities/update_lot',
                data: $("#FormUpdate").serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    var alias = $('#alias').val();
                    var groupid = $('#groupid').val();
                    var price = $('#price').val();
                    var id = $('#id').val();
                    var sts2 = data.stas;
                    $('#alias' + id).html(alias);
                    $('#group' + id).html(groupid);
                    $('#price' + id).html(price);
                    $('#status' + id).html(sts2);
                    $('#editlot').modal('hide');
                }
            });
        });
    });

    $(document).ready(function() {

        $('#uploadForm').on('submit', function(event) {
            event.preventDefault();
            $('#message').css('display', 'block');

            $.ajax({
                url: "/admin/uploadFile",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('#message').css('display', 'none');
                    $('#uploadImage').val('');
                    getGallery();

                }
            })
        });

    });

    function getGallery() {
        $.ajax({
            type: 'get',
            url: '/api/get-gallery/<?= $community->id?>',
            data: {},
            success: function(data) {
                $('#galleryrow').html(data.gallery);
            }
        });
    }

    function getLegends() {
        $.ajax({
            type: 'get',
            url: '/api/communities/get-color-legend/<?= $legend_group->id?>',
            data: {},
            success: function(data) {
                $('#lglist').html(data.data);
            }
        });
    }
    
  //latLong save into datbase
 
      $('#submit').click(function(){ 
            $('#loader').show(); 
            var address = $('#pac-input').val();
            var lat = $('#input-latitude').val();  
            var lng = $('#input-longitude').val();
            var map_zoom = $('#map_zoom').val();
               $.ajax({  
                     url:"/admin/saveLatlong",  
                     method:"POST",  
                     data:$('#locationForm').serialize(),  
                        success:function(data){ 
                     $('#success_msg').html('<span class="text-info">Location Saved Successfully.</span>');
                     $('#loader').hide(); 
                     }  
                });  
           
      });

      function search_near_locations(){
            $('#loader').show();
            var type = $('#type').val();
            var lat = $('#input-latitude').val();  
            var lng = $('#input-longitude').val();
            $.ajax({  
                     url:"{{route('nearby_locations')}}",  
                     method:"POST",  
                     data:{'_token': "{{csrf_token()}}",'lat':lat,'lng':lng,'type':type,'community_id':"{{ $community->id }}"},  
                        success:function(result){
                        
                             $('#location_data').html(result.data);
                             $('#loader').hide();
                        }
                        
                      
                });
               

           
      };  
      $('#type').change(function(){
        search_near_locations();
      }); 

      $(document).ready(function(){
        search_near_locations();
        });
      /*Add near by location into database*/
  
 $('#location_data').on('click','.add_new',function(){
    $('#loader').show();
    var name=$(this).closest('tr').attr('name');
    var address=$(this).closest('tr').attr('address');
    var distance=$(this).closest('tr').attr('distance');
    var uid=$(this).closest('tr').attr('uid');
    var type=$(this).closest('tr').attr('type');
    var lat=$(this).closest('tr').attr('lat');
    var lng=$(this).closest('tr').attr('lng');
    $.ajax({  
             url:"{{route('add_new_locations')}}",  
             method:"POST",  
             data:{'_token': "{{csrf_token()}}",'type':type,'name':name,'address':address,'distance':distance,'uid':uid,'lat':lat,'lng':lng,'community_id':"{{ $community->id }}"},  
                success:function(result){
                //var obj = JSON.parse(result.data);
                $('#location_data #st_'+uid).html('Published');
                $('#location_data #st_'+uid).removeClass('text-danger');
                $('#location_data #st_'+uid).addClass('text-success');
                $('#location_data #action_'+uid).html('<a class="nearby_delete"><i class="fa fs-25 fa-toggle-on text-success"></i></a>');
                $('#loader').hide();
                }
    });
}); 
  $('#location_data').on('click','.nearby_delete',function(){
    $('#loader').show();
    var name=$(this).closest('tr').attr('name');
    var address=$(this).closest('tr').attr('address');
    var uid=$(this).closest('tr').attr('uid');
    var type=$(this).closest('tr').attr('type');
    $.ajax({  
             url:"{{route('delete_new_locations')}}",  
             method:"POST",  
             data:{'_token': "{{csrf_token()}}",'type':type,'name':name,'address':address,'uid':uid,'community_id':"{{ $community->id }}"},  
                success:function(result){
                //var obj = JSON.parse(result.data);
                $('#location_data #st_'+uid).html('Unpublished');
                $('#location_data #st_'+uid).removeClass('text-success');
                $('#location_data #st_'+uid).addClass('text-danger');
                $('#location_data #action_'+uid).html('<a class="add_new"><i class="fa fs-25 fa-toggle-off text-danger"></i></a>');
                $('#loader').hide();

                }
    });
});

    var map;
    var InforObj = [];
    gmarkers = [];
    var locations=new Array();
    var titles=new Array();
    var icons=new Array();
    var distance=new Array();
    var address=new Array();
    var all_icons = {
            hospital: '/images/hospital_H_pinlet-2-medium.png',
            shopping_mall: '/images/shoppingbag_pinlet-2-medium.png',
            school: '/images/school_pinlet-2-medium.png',
            restaurant: '/images/restaurant_pinlet-2-medium.png'
            };
        

    locations.push({'lat': <?= ($community->lat != '')?$community->lat:'48.0667';?>, 'lng': <?= ($community->lng !='')?$community->lng:'-114.0895';?>});
    titles.push('<?= ($community->name !='')?$community->name:'Your title will be here';?>');
    icons.push('/images/spotlight_pin_v2_accent-1-small.png');
    distance.push('');
    address.push('<?= ($community->location != '')?$community->location:'';?>');
        <?php if($nearby){
            foreach($nearby as $nkey => $nvalue){
                if(is_array($nvalue)) $nlist = $nvalue; else $nlist = get_object_vars($nvalue);
                    foreach($nlist as $lvalue){ ?>
                    locations.push({'lat':{{ isset($lvalue->lat)?$lvalue->lat:''}},'lng':{{ isset($lvalue->lng)?$lvalue->lng:''}}});
                    titles.push("{{ isset($lvalue->name)?$lvalue->name:''}}");
                    distance.push("({{ isset($lvalue->distance)?$lvalue->distance:''}} mile)");
                    address.push("{{ isset($lvalue->address)?$lvalue->address:''}}");
                    icons.push(all_icons.{{$nkey}});
                    <?php
                    }
                                                           
                }
        }?>
    function initMap() {
    
        var map = new google.maps.Map(document.getElementById('map-canvas'), {
            //center: {lat: 48.0667, lng: -114.0895},
            center: {lat: <?= ($community->lat != '')?$community->lat:'48.0667';?>, lng: <?= ($community->lng !='')?$community->lng:'-114.0895';?>},
            fullscreenControlOptions: {
                position: google.maps.ControlPosition.LEFT_TOP,
            },
            zoom: <?= ($community->map_zoom != '')?$community->map_zoom:'6';?>,
            mapTypeId: <?= ($community->map_type_id != '')?"'".$community->map_type_id."'":'roadmap';?>
        });
        //The map() method here has nothing to do with the Google Maps API.
        locations.map(function(location, i) {
            var contentString = '<div id="content"><b>' + titles[i] +
                    '</b> '+distance[i]+'<br>'+address[i]+'</div>';
            var marker = new google.maps.Marker({
                    position: locations[i],
                    map: map,
                    draggable: true,
                    icon: icons[i]
                });
                const infowindow = new google.maps.InfoWindow({
                    content: contentString,
                    maxWidth: 400
                });

                marker.addListener('click', function () {
                    closeOtherInfo();
                    infowindow.open(marker.get('map'), marker);
                    InforObj[0] = infowindow;
                });
                gmarkers[titles[i]] = marker;

                   // Listen for the marker position changed
                marker.addListener('drag', function (e) {
                $('#input-latitude').val(e.latLng.lat());
                $('#input-longitude').val(e.latLng.lng());
                map.setCenter(marker.getPosition());
            });
            });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
            var zoom=map.getZoom();
            $('#map_zoom').val(zoom); //Added to detect dynamic zoom
        });
        
        google.maps.event.addListener( map, 'maptypeid_changed', function() { //Added to detect maptype id
            $('#map_type_id').val(map.getMapTypeId());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
            return;
            }

            // Clear out the old markers.
            markers.forEach(function(marker) {
            marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
            if (!place.geometry) {
                return;
            }
            var icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
                map: map,
                icon: icon,
                title: place.name,
                position: place.geometry.location
            }));

            if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }
            $('#input-latitude').val(place.geometry.location.lat());
            $('#input-longitude').val(place.geometry.location.lng());
            search_near_locations();
            });
            map.fitBounds(bounds);

        });
        

    }
function closeOtherInfo() {
    if (InforObj.length > 0) {
        /* detach the info-window from the marker ... undocumented in the API docs */
        InforObj[0].set("marker", null);
        /* and close it */
        InforObj[0].close();
        /* blank the array */
        InforObj.length = 0;
    }
        }

//Select All
$(".select-all").click(function(){
        $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
});


$("#bulk_edit").click(function(){
    var checked_boxes = $("tbody").find("input[type=checkbox]:checked");
    var lot_ids = [];
        $.each(checked_boxes,function(){
            lot_ids += $(this).val()+" ";  
        });
    var bulk_legend_id = $("#bulk_status option:selected").val();
    var bulk_legend_name = $("#bulk_status option:selected").text();
    var bulk_price = $("#bulk_price").val();
    var bulk_phase = $("#bulk_phase option:selected").val();
    
    $.ajax({
        type:"POST",
        url:"/admin/communities/view",
        data:{"bulk_legend_id":bulk_legend_id, "bulk_legend_name":bulk_legend_name, "bulk_price":bulk_price,
        "bulk_phase":bulk_phase, "lot_ids":lot_ids},
        headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
        success:function(result){
            $("input[type=checkbox]:checked").prop('checked',false);
            // Toast Success Mesaage
            toastr.success('Records Updated Successfully');
            $.each(result,function(){
                $('#price' + this["lot_id"]).html(this["bulk_price"]);
                $('#status' + this["lot_id"]).html(this["bulk_legend_name"]);
                $('#phase' + this["lot_id"]).html(this["bulk_phase"]);
                    });
                }
            });
});        

</script>
@endpush