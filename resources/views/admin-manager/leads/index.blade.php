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
   <div class="justify-content-between mb-2">
      <h1 class="a_dash d-inline-block">Buyers</h1>
      <div class="btn-group float-md-right">
         <a href="{{ route('export-leads')}}" target="_blank" class="add_button"><i class="la la-file-excel-o"></i> Export</a>
      </div>
   </div>
   <div class="card" id="no_sh">
      <div class="card-body text-right">
         <a href="javascript:void(0)" data-toggle="modal" data-target="#add_account">
            <button type="button" class="btn btn-dark btn-min-width mr-1 waves-effect waves-light">
               <i class="fas fa-plus"></i> Add New Guest
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
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @php $i=0; @endphp
                  @forelse($leads as $user)
                  @php $i++; @endphp
                  <tr>
                     <td>{{$i}}.</td>
                     <td>{{$user->name}}</td>
                     <td>{{$user->email}}</td>
                     <td>{{$user->mobile}}</td>
                     
                     <td>
                        @if($user->status_id == 2)
                        <span><a class="a1 green" style="font-size: 15px;">Active</a></span>
                        @else
                        <span><a class="a1 red" style="font-size: 15px;">Deactive</a></span>
                        @endif
                     </td>
                     <td>
                        <span><a href="#" class="a1" onclick="deleteData({{$user->id}})" data-toggle="modal" data-target="#modal-delete" id="{{$user->id}}"><i class="fas fa-trash"></i> <span>Delete</span></a></span>
                     </td>
                  </tr>
                  @empty
                  <tr>
                     <td colspan="3">No users added yet</td>
                  </tr>
                  @endforelse
               </tbody>
            </table>
         </div>                    
      </div>
   </div>
</div>
<!-- Add new Account Modal -->
<div class="modal fade bd-example-modal-xl" id="add_account" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5>Add Guest</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true"><i class="fa fa-times"></i></span>
            </button>
         </div>
         <form method="post" action="{{Route('manager-create_account')}}" name="add_account" id="add_account">
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
                     <div class="clearfix"></div>
                  </div>
               </div>
               <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr"> Cancel </button>
               <button type="submit" class="btn-orange t_b_s"> Create</button>
         </form>
      </div>
   </div>
</div>
<!-- Delete Modal -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
      <form action="{{route('manager-delete_lead')}}" id="deleteForm" method="POST">
         <input type="hidden" name="user_id" id="user_id">
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
                  <h6 class="delete_heading">Are you sure, you want to delete this record ?</h6>
                  <div class="clearfix"></div>
                  <div class="m-auto">
                     <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr"> No </button>
                     <button type="submit" class="btn-orange t_b_s" onclick="formSubmit()"> Yes</button>
                  </div>
               </div>
            </div>
         </div>
      </form>
   </div>
</div>
<script type="text/javascript">
function deleteData(id){
   $("#deleteForm #user_id").val(id);
}
</script>
@endsection
