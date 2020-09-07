@extends('layouts.admin')
@section('content') 
<div class="container-fluid page-wrapper">
    <div class=" row justify-content-between mb-2 align-items-center">
        <div class="ml-1">
            <h1 class="a_dash d-inline-block">Floors <small><span class="color-secondary">|</span></small></h1>
            <div class="row breadcrumbs-top d-inline-block">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="{{ route('new_floors') }}">{{$floor->home->title}}</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">{{$floor->title}}</li>
                    <li class="breadcrumb-item active" aria-current="page">Features</li>
                </ol>
            </div>
        </div>
        <div class="ml-1 ml-sm-0">
            <div class="btn-group mr-1">
                <a href="{{url('admin/floors/')}}" class="add_button"><i class="fa fa-arrow-left position-relative"></i> Back</a>
            </div>
        </div>    
    </div>
    <div class="card" id="no_sh">
        <div class="card-body text-right">
            <a href="#" data-toggle="modal" data-target="#importModal">
                <button type="button" id="upload_csv_features_btn" class="btn btn-dark btn-min-width mr-1 waves-effect waves-light"><i class="fa fa-file-excel"></i> Upload CSV</button>
            </a>
            <a href="{{url('admin/homes/features/create/'.base64_encode($floor->id))}}">
            <button type="button" id="add_features" class="btn btn-dark btn-min-width mr-1 waves-effect waves-light"><i style="top: 0;" class="fas fa-plus"></i> Add Features</button>
            </a>
            <a href="{{url('admin/features/set-acl/'.base64_encode($floor->id))}}"><button type="button" class="btn btn-dark btn-min-width mr-1 waves-effect waves-light">ACL Settings</button></a>
        </div>
    </div>

    @if (session('error'))
    <div class="alert alert-danger" id="msg">
        {{ session('error') }}
    </div>
    @endif @if (session('success'))
    <div class="alert alert-success" id="msg">
        {{ session('success') }}
    </div>
    @endif @if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
    <script>
        $(function () {
            $("#modal-warning").modal("show");
        });
    </script>
    @endif

    <div class="clearfix"></div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive" id="custom_tables">
                <table class="table table-bordered" id="dataTables" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Price</th>  
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="sortable ui-sortable">
                        @php $i=0; @endphp @forelse($features as $record) @php $i++; @endphp
                        <tr id="{{$record->id}}" data-parent_id="{{$record->parent_id}}" class="non-dragable" style="background: #e8e8e8; font-weight: 600;">
                            <td>{{$i}}.</td>
                            <td>{{$record->title}}</td>
                            <td>{{$record->price}}</td>
                            <td>
                                <span>
                                    <a href="{{url('admin/homes/features/edit/'.base64_encode($record->id))}}" class="a1"><i class="fas fa-edit"></i></a>
                                </span>
                                <span>
                                    <a href="#" class="a1" data-id="{{base64_encode($record->id)}}" data-toggle="modal" data-target="#modal-delete"><i class="fas fa-trash"></i></a>
                                </span>
                            </td>
                        </tr>
                        @php $j=0; @endphp @forelse($record->feature_groups as $feat) @php $j++; @endphp
                        <tr id="{{$feat->id}}" data-parent_id="{{$feat->parent_id}}">
                            <td></td>
                            <td>{{$feat->title}}</td>
                            <td>{{$feat->price}}</td>
                            <td>
                                <span>
                                    <a href="{{url('admin/homes/features/edit/'.base64_encode($feat->id))}}" class="a1"><i class="fas fa-edit"></i></a>
                                </span>
                                <span>
                                    <a href="#" class="a1" data-id="{{base64_encode($feat->id)}}" data-toggle="modal" data-target="#modal-delete"><i class="fas fa-trash"></i></a>
                                </span>
                            </td>
                        </tr>
                        @empty @endforelse @empty
                        <tr>
                            <td colspan="4">No Features added yet</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Confirm Action</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i> </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                  <h6 class="delete_heading">Are you sure, you want to delete this record ?</h6>
                  <div class="text-danger w-100 pb-2 text-center">Note: If you delete the main group section, all its related features will also be deleted.</div>
                  <div class="clearfix"></div>
                  <div class="m-auto">
                    {{Form::open(array('id'=>'delete_form','url'=>url('admin/features/delete')))}} {{Form::hidden('delete_id',null,['id'=>'delete_id'])}}
                    <button type="button" class="btn-orange t_b_s d_gr" data-dismiss="modal">No</button>
                    <button type="submit" class="btn-orange t_b_s">Yes</button>
                    {{Form::close()}}
                  </div>
                </div>
            </div>
        </div>
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
                    <h6 class="delete_heading">Features upload limit exceeded for this package.</h6>
                    <p style="margin: 0 auto;">Kindly contact us for more options.</p>
                    <div class="clearfix"></div>
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
            <form id="upload_feature_csv" action="{{route('upload-feature-csv')}}" method="POST" enctype="multipart/form-data">
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
                                            <input class="form-control" id="floor_id" name="floor_id" value="{{ $floor->id }}" type="hidden" />
                                        </label>

                                        <button type="button" class="btn btn-default remove-btn" style="display: none;"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <a href="{{ url('/admin/features-sample.csv') }}" target="_blank" class="btn-orange"><i class="fa fa-file-excel"></i> Sample CSV</a>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
      $(document).ready(function(){
          setTimeout(function() {
              $('#msg').fadeOut('fast');
          }, 3000);
          $('#modal-delete').on('show.bs.modal', function (e) {
          var $trigger = $(e.relatedTarget);
          var delete_id = $trigger.data('id');
          document.forms['delete_form']['delete_id'].value = delete_id;
        });  
      });
  </script>