@extends('layouts.admin')
    @section('content')
<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }
</style>      
<div class="container-fluid page-wrapper">
    <div class="row pl-1 pr-1 justify-content-between align-items-center mb-2">
        <div>
            <h1 class="a_dash d-inline-block m-0 p-0">Accounts</h1>
        </div>
        <div class="btn-group">
            <a style="position:relative;" href="javascript:void(0)" class="add_button" id="add_new_account"><i style="top:0;" class="fas fa-plus"></i> Add New</a>
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
                            <th>Role</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($accounts as $key => $account)
                        <tr>
                            <td>{{++$key}}.</td>
                            <td>{{$account->roles->role}}</td>
                            <td>{{$account->name}}</td>
                            <td>{{$account->email}}</td>
                            <td>{{$account->mobile}}</td>
                            <td>
                            @if($account->status_id == 2)
                                <span><a class="a1 green" id="{{$account->id}}" account_id="{{$account->admin_role_id}}" style="font-size: 15px;">Active</a></span>
                                @else
                                <span><a class="a1 red" id="{{$account->id}}" account_id="{{$account->admin_role_id}}" style="font-size: 15px;">Deactive</a></span>
                                @endif
                            </td>
                            <td>
                                <span><a style="margin-right:3px;" href="{{Route('view_account',['id'=>base64_encode($account->id)])}}" class="a1">
                                    <i class="fas fa-eye"></i><span></span></a>
                                </span>
                                <span><a style="margin-right:3px;" class="a1 click_edit" title="Edit" href="javascript:void(0)"
                                    id="{{$account->id}}" account_id="{{$account->admin_role_id}}" account_status="{{$account->status_id}}" 
                                    account_name="{{$account->name}}" account_email="{{$account->email}}" 
                                    account_mob="{{$account->mobile}}" account_role="{{$account->role}}">
                                    <i class="fa fa-edit"></i><span></span></a>
                                </span>
                                <span><a style="margin-right:0px;" href="#" class="a1" onclick="deleteData({{$account->id}})" 
                                data-toggle="modal" data-target="#modal-delete" id="{{$account->id}}">
                                <i class="fas fa-trash"></i><span></span></a>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal fade bd-example-modal-xl" id="edit_account" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Edit Account</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fa fa-times"></i></span>
                            </button>
                        </div>
                        <form method="post" action="{{Route('update_account')}}" name="account" id="account">
                            @csrf
                            <input type="hidden" name="id" id="id" value="">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                        <input required class="form-control forms1" id="account_name" name="name" placeholder="Name" type="text" value="">
                                        </div>
                                    </div>
                                    
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                        <input required class="form-control forms1" id="account_email" name="email" placeholder="Email" type="email" value="">
                                        </div> 
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                        <input class="form-control forms1" id="account_pass" name="password" placeholder="Password" type="password" value="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                        <input required class="form-control forms1" pattern="^[789]\d{9}$" id="account_mob" name="mobile" placeholder="Mobile Number" type="tel" value="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <select required class="form-control forms1" name="status" id="account_status">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <select required class="form-control forms1" name="account_role" id="account_role">
                                            </select>
                                        </div>
                                    </div>                                        
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr"> Cancel </button>
                            <button type="submit" class="btn-orange t_b_s"> Save</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete user modal popup modal-->
            <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
                    <form action="{{route('delete_account')}}" id="deleteForm" method="POST">
                        <input type="hidden" name="id" id="id" value="">
                        @csrf
                        <div class="modal-content" style="margin-left: 110px;">
                            <div class="modal-header">
                                <h5>Confirm Action</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fa fa-times"></i>  </span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <h6 class="delete_heading">Are you sure, you want to delete this record ?
                                    </h6>
                                    <div class="clearfix"></div>
                                    <div class="m-auto">
                                        <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr"> No </button>
                                        <button type="submit" class="btn-orange t_b_s"> Yes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Add new Account Modal -->
            <div class="modal fade bd-example-modal-xl" id="add_account" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Add Account</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fa fa-times"></i></span>
                            </button>
                        </div>
                        <form method="post" action="{{Route('create_account')}}" name="add_account" id="add_account">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                        <input required class="form-control forms1" id="account_name" name="name" placeholder="Name" type="text" value="">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                        <input required class="form-control forms1" id="account_email" name="email" placeholder="Email" type="email" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                        <input required class="form-control forms1" id="account_pass" name="password" placeholder="Password" type="password" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                        <input required class="form-control forms1" id="account_mob" name="mobile" placeholder="Mobile Number" type="number" value="">
                                        </div>
                                    </div>
                                   
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <select required class="form-control forms1" name="account_role" id="account_create_role">
                                            </select>
                                        </div>
                                    </div>                                        
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr"> Cancel </button>
                            <button type="submit" class="btn-orange t_b_s"> Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function deleteData(id){
        $("#deleteForm #id").val(id);
    }
</script>
@endsection
@push('scripts')
<script>
   $(document).ready(function()
   {
        $('.click_edit').click(function(){
            var account_id = $(this).attr('account_id');
            $('#id').val($(this).attr('id'));
            $('#account_name').val($(this).attr('account_name'));
            $('#account_email').val($(this).attr('account_email'));
            $('#account_mob').val($(this).attr('account_mob'));
            if($(this).attr('account_status')==2){
            var options='<option selected value="2">Active</option><option value="1">Deactive</option>';
            }else{
            var options='<option value="2">Active</option><option selected value="1">Deactive</option>';
            }
            $('#account_status').html(options);
            $.ajax({
                type:'get',
                url:'/api/get-admin-roles',
                success:function(result){
                    var role_options;
                    $.each(result, function(){
                        if(this.id == account_id){
                            role_options += `<option value="${this.id}" selected>${this.role}</option>`;
                        }
                        else{
                            role_options += `<option value="${this.id}">${this.role}</option>`;
                        }
                    });
                    $("#account_role").html(role_options);
                } 
            });
            $('#edit_account').modal('show');  
        });
        
        $('#add_new_account').click(function(){
            $.ajax({
                type:'get',
                url:'/api/get-admin-roles',
                success:function(result){
                    var role_options;
                    $.each(result, function(){
                            role_options += `<option value="${this.id}">${this.role}</option>`;
                    });
                    $("#account_create_role").html(role_options);
                } 
            });
            $('#add_account').modal('show');  
        });
   });
</script>
@endpush
