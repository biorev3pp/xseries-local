@extends('layouts.admin')
    @section('content')
<style>
    #delete_manager_button{
        color:inherit;
        transition:0.3s;
    }
    #delete_manager_button:hover{
        color:white !important;
    }
    #view_manager_button{
        color:inherit;
        transition:0.3s;
    }
    #view_manager_button:hover{
        color:white !important;
    }
    
</style>
<div class="container-fluid page-wrapper">
    <div class="row justify-content-between pl-1 pr-1 mb-2 align-items-center">
        <div>
            <h1 class="a_dash d-inline-block m-0 p-0">Accounts <small><span class="color-secondary">|</span></small></h1>
            <div class="row breadcrumbs-top pl-2 d-inline-block">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{Route('accounts')}}">
                    {{ucwords($account->name)}}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">View</li>
                </ol>
            </div>
        </div>
        <div>
            <div class="btn-group">
            <a href="{{ route('accounts') }}" class="add_button"><i class="fa fa-arrow-left position-relative"></i> Back</a>
            </div>
        </div>    
    </div>
    <div class="card" id="no_sh">
        <div class="card-body text-right">
            <a href="javascript:void(0)">
                <button type="button" id ="upload_csv_elevations_btn" 
                class="add_button btn btn-dark btn-min-width mr-1 waves-effect waves-light" data-toggle="modal" data-target="#add_manager">
                <i class="material-icons" style="font-size: 16px;line-height: 0.5848em;vertical-align: -3.6px;">account_box</i>
                 Connect Viewers
                </button>
            </a>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive" id="custom_table">
                @if(\Session::has('success'))  
                <div class="alert alert-success alert-dismissible" style="margin-top:18px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    <strong>Success!</strong> {{ \Session::get('success') }}
                </div>
                @endif
                 @if(\Session::has('error'))  
                <div class="alert alert-danger alert-dismissible" style="margin-top:18px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    <strong>Failed!</strong> {{ \Session::get('error') }}
                </div>
                @endif
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($connected_managers as $key=> $connected_manager)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{isset($connected_manager->name) ? ucwords($connected_manager->name) : ''}}</td>
                            <td>{{isset($connected_manager->email) ? $connected_manager->email : ''}}</td>
                            <td>{{isset($connected_manager->mobile) ? $connected_manager->mobile : ''}}</td>
                            <td>
                                <a id="view_manager_button" href="{{Route('view_account', ['id'=>base64_encode($connected_manager->id)])}}" class="btn btn-outline-secondary text-secondary btn-sm"
                                title="View Viewer"><i class="fas fa-eye"></i></a>
                                <a id="delete_manager_button" manager_id="{{base64_encode($connected_manager->id)}}" class="btn btn-outline-secondary text-secondary btn-sm manager_delete"
                                title="Disconnect Viewer"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Delete Manager popup-->
    <div class="modal fade" id="delete_manager" tabindex="-1" role="dialog" aria-labelledby="add_homeLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header dark-color">
                    <h5 class="modal-title" id="manageuserLabel">Disconnect Viewer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times"></i> </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h6 class="delete_heading">Are you sure you want to disconnect this Viewer?</h6>
                        <div class="text-danger w-100 pb-2 text-center">This will disconnect all of its related data.</div>
                        <div class="clearfix"></div>
                        <div class="m-auto">
                            <form method="post" action="{{route('delete_admin_managers')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="admin_id" value="{{$account->id}}">
                                <input type="hidden" id="manager_id" name="manager_id" value="">
                            
                                    <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr">No</button>
                                    <button type="submit" class="btn-orange t_b_s">Yes</button>
                            </form>
                        </div> 
                    </div>    
                </div>
            </div>
        </div>
    </div>

    <!-- Manager Modal -->
    <div class="modal fade bd-example-modal-lg" id="add_manager" tabindex="-1" role="dialog" aria-labelledby="add_homeLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header dark-color">
                    <h5 class="modal-title" id="manageuserLabel">List of viewers to connect</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times"></i> </span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{Route('connect_manager')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="admin_id" value="{{$account->id}}">
                        <table class="table table-bordered table-hover table-responsive-sm" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">SNo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    <th style="width: 160px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($disconnected_managers as $key=> $disconnected_manager)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{isset($disconnected_manager->name) ? ucwords($disconnected_manager->name) : '' }}</td>
                                    <td>{{isset($disconnected_manager->email) ? $disconnected_manager->email : '' }}</td>
                                    <td>{{isset($disconnected_manager->mobile) ? $disconnected_manager->mobile : '' }}</td>
                                    <td>
                                        <input class="form-control" name="manager_ids[]" value="{{$disconnected_manager->id}}" type="checkbox">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="modal-footer justify-content-center">
                            <button type="button" data-dismiss="modal" style="top:6px;" class="btn-orange t_b_s d_gr float-none m-0">Close</button>
                            <button type="submit" style="top:6px;" class="btn-orange t_b_s yesBtn float-none mb-0">Save</button>
                        </div>   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
$('.manager_delete').click(function(){
  var id = $(this).attr('manager_id');
  $('#manager_id').val(id);
  //alert(home_id);
  $('#delete_manager').modal('show');
});
</script>
@endpush
