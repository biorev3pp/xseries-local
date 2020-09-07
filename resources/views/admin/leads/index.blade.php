@extends('layouts.admin')
   @section('content')
   @if (session('error'))
<div class="alert alert-danger" id="msg">
    {{ session('error') }}
</div>
@endif

<div class="container-fluid page-wrapper">
    <div class=" row justify-content-between align-items-center pl-1 pr-1 mb-2">
      <div>
        <h1 class="a_dash d-inline-block m-0 p-0">Buyers</h1>
      </div>
      <div class="mt-1 mt-sm-0">
         <div class="btn-group">
               <a href="{{ route('export-leads')}}" target="_blank" class="add_button"><i class="la la-file-excel-o position-relative"></i> Export</a>
         </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive" id="custom_table">
                @if(\Session::has('success'))

                <div class="alert alert-success alert-dismissible" style="margin-top: 18px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    <strong>Success!</strong> {{ \Session::get('success') }}
                </div>
                @endif
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=0; @endphp @forelse($leads as $user) @php $i++; @endphp
                        <tr>
                            <td>{{$i}}.</td>
                            <td>{{$user->name}}</td>
                            <td>{{isset($user->email)?$user->email:'Not Given'}}</td>
                            <td>{{isset($user->mobile)?$user->mobile:'Not Given'}}</td>

                            <td>
                                @if($user->status_id == 2)
                                <span><a class="a1 green" id="{{$user->id}}" user_id="{{$user->id}}" style="font-size: 15px;">Active</a></span>
                                @else
                                <span><a class="a1 red" id="{{$user->id}}" user_id="{{$user->id}}" style="font-size: 15px;">Deactive</a></span>
                                @endif
                            </td>
                            <td>
                                <span>
                                    <a
                                        class="a1 click_edit"
                                        title="Edit"
                                        href="javascript:void(0)"
                                        users_id="{{$user->id}}"
                                        users_status="{{$user->status_id}}"
                                        users_name="{{$user->name}}"
                                        users_email="{{$user->email}}"
                                        users_mob="{{$user->mobile}}"
                                    >
                                        <i class="fa fa-edit"></i> <span></span>
                                    </a>
                                </span>
                                <span>
                                    <a href="#" class="a1" onclick="deleteData({{$user->id}})" data-toggle="modal" data-target="#modal-delete" id="{{$user->id}}"><i class="fas fa-trash"></i> <span></span></a>
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">No users added yet</td>
                        </tr>
                        @endforelse
                    </tbody>

                    <!-- Edit User popup modal-->
                </table>
            </div>

            <div class="modal fade bd-example-modal-xl" id="edit_user" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Edit User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fa fa-times"></i></span>
                            </button>
                        </div>
                        <form method="post" action="{{Route('update_lead')}}" name="user" id="user">
                            @csrf
                            <input type="hidden" name="users_id" id="users_id" value="" />
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <input required class="form-control forms1" id="users_name" name="name" placeholder="Name" type="text" value="" />
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <input required class="form-control forms1" id="users_email" name="email" placeholder="Email" type="email" value="" />
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <input class="form-control forms1" id="users_pass" name="password" placeholder="Password" type="password" value="" />
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <input required class="form-control forms1" id="users_mob" name="mobile" placeholder="Mobile Number" type="text" value="" />
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <select class="form-control forms1" name="status" id="users_status"> </select>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr">Cancel</button>
                            <button type="submit" class="btn-orange t_b_s">Save</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Edit user popup modal-->

            <!-- Delete user modal popup modal-->

            <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
                    <form action="{{route('delete_lead')}}" id="deleteForm" method="POST">
                        <input type="hidden" name="user_id" id="user_id" />
                        @csrf
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
                    $("#deleteForm #user_id").val(id);
                }
            </script>

            <!-- Delete user modal popup-->
        </div>
    </div>
</div>
   @endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>
$(document).ready(function()
{
    $('.click_edit').click(function()
    {
        $('#users_id').val($(this).attr('users_id'));
        $('#users_name').val($(this).attr('users_name'));
        $('#users_email').val($(this).attr('users_email'));
        $('#users_mob').val($(this).attr('users_mob'));
		if($(this).attr('users_status')==2){
			var options='<option selected value="2">Active</option><option value="1">Deactive</option>';
			
		}else{
			var options='<option value="2">Active</option><option selected value="1">Deactive</option>';
		}
		$('#users_status').html(options);
		

        //$('#user').attr('action','/admin/leads/'+ $('#users_id').val());
        $('#edit_user').modal('show');  
    });
});
</script>