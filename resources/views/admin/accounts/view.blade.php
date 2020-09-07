@extends('layouts.admin')
    @section('content')
<style>
    #delete_com_button{
        color:inherit;
        transition:0.3s ease all;
    }
    #delete_com_button:hover{
        color:white !important;
    }
    #add_com table td {
        text-align:center;
    }
</style>
<div class="container-fluid page-wrapper">
    <div class="row justify-content-between align-items-center mb-2 pl-1 pr-1">
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
                class="add_button btn btn-dark btn-min-width mr-1 waves-effect waves-light" data-toggle="modal" data-target="#add_com">
                <i class="material-icons" style="font-size: 16px;line-height: 0.5848em;vertical-align: -3.6px;">home</i>
                 Connect Communities
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
                            <th>Logo</th>
                            <th>Location</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($connected_homes as $key=> $connected_home)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$connected_home->name}}</td>
                            <td><img src="{{asset('uploads/'.$connected_home->logo)}}" width="100px"></td>
                            <td>{{$connected_home->location}}</td>
                            <td>
                                <a id="delete_com_button" com_id="{{base64_encode($connected_home->id)}}" class="btn btn-outline-secondary text-secondary btn-sm com_delete"
                                title="Disconnect Community"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Delete Community popup-->
    <div class="modal fade" id="delete_com" tabindex="-1" role="dialog" aria-labelledby="add_homeLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header dark-color">
                    <h5 class="modal-title" id="manageuserLabel">Disconnect Community</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times"></i> </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h6 class="delete_heading">Are you sure you want to disconnect this Community?</h6>
                        <div class="text-danger w-100 pb-2 text-center">This will disconnect all of its related data.</div>
                        <div class="clearfix"></div>
                        <div class="m-auto">
                            <form method="post" action="{{route('delete_manager_coms')}}" name="delete_coms" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="manager_id" value="{{$account->id}}">
                                <input type="hidden" id="community_id" name="community_id" value="">
                                <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr">No</button>
                                <button type="submit" class="btn-orange t_b_s">Yes</button>
                            </form>
                        </div>    
                    </div>    
                </div>
            </div>
        </div>
    </div>

    <!-- Community Modal -->
    <div class="modal fade bd-example-modal-xl" id="add_com" tabindex="-1" role="dialog" aria-labelledby="add_homeLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header dark-color">
                    <h5 class="modal-title" id="manageuserLabel">List of Communities to connect</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{Route('connect_community')}}" name="home" id="home" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="manager_id" value="{{$account->id}}">
                        <table class="table table-bordered table-hover table-responsive-sm" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">SNo</th>
                                    <th>Name</th>
                                    <th>Logo</th>
                                    <th>Location</th>
                                    <th style="width: 160px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($disconnected_homes as $key=> $disconnected_home)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$disconnected_home->name}}</td>
                                    <td><img src="{{asset('uploads/'.$disconnected_home->logo)}}" width="100px"></td>
                                    <td>{{$disconnected_home->location}}</td>
                                    <td>
                                        <input class="form-control" name="community_ids[]" value="{{$disconnected_home->id}}" type="checkbox">
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
$('.com_delete').click(function(){
  var id = $(this).attr('com_id');
  $('#community_id').val(id);
  //alert(home_id);
  $('#delete_com').modal('show');
});
</script>
@endpush
