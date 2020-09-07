@extends('layouts.admin')
   @section('content') 
   <style>
   .file-upload {
      display: block;
      text-align: center;
      font-family: Helvetica, Arial, sans-serif;
      font-size: 12px;
      width: calc(100% - 119px);
   }

   .file-upload .file-select {
      display: block;
      border: 2px solid #dce4ec;
      color: #34495e;
      cursor: pointer;
      height: 40px;
      line-height: 40px;
      text-align: left;
      background: #FFFFFF;
      overflow: hidden;
      position: relative;
   }

   .file-upload .file-select .file-select-button {
      background: #dce4ec;
      padding: 0 10px;
      display: inline-block;
      height: 40px;
      line-height: 40px;
   }

   .file-upload .file-select .file-select-name {
      line-height: 40px;
      display: inline-block;
      padding: 0 10px;
   }

   .file-upload .file-select:hover {
      border-color: #34495e;
      transition: all .2s ease-in-out;
      -moz-transition: all .2s ease-in-out;
      -webkit-transition: all .2s ease-in-out;
      -o-transition: all .2s ease-in-out;
   }

   .file-upload .file-select:hover .file-select-button {
      background: #34495e;
      color: #FFFFFF;
      transition: all .2s ease-in-out;
      -moz-transition: all .2s ease-in-out;
      -webkit-transition: all .2s ease-in-out;
      -o-transition: all .2s ease-in-out;
   }

   .file-upload.active .file-select {
      border-color: #3fa46a;
      transition: all .2s ease-in-out;
      -moz-transition: all .2s ease-in-out;
      -webkit-transition: all .2s ease-in-out;
      -o-transition: all .2s ease-in-out;
   }

   .file-upload.active .file-select .file-select-button {
      background: #3fa46a;
      color: #FFFFFF;
      transition: all .2s ease-in-out;
      -moz-transition: all .2s ease-in-out;
      -webkit-transition: all .2s ease-in-out;
      -o-transition: all .2s ease-in-out;
   }

   .file-upload .file-select input[type=file] {
      z-index: 100;
      cursor: pointer;
      position: absolute;
      height: 100%;
      width: 100%;
      top: 0;
      left: 0;
      opacity: 0;
      filter: alpha(opacity=0);
   }

   .file-upload .file-select.file-select-disabled {
      opacity: 0.65;
   }

   .file-upload .file-select.file-select-disabled:hover {
      cursor: default;
      display: block;
      border: 2px solid #dce4ec;
      color: #34495e;
      cursor: pointer;
      height: 40px;
      line-height: 40px;
      margin-top: 5px;
      text-align: left;
      background: #FFFFFF;
      overflow: hidden;
      position: relative;
   }

   .file-upload .file-select.file-select-disabled:hover .file-select-button {
      background: #dce4ec;
      color: #666666;
      padding: 0 10px;
      display: inline-block;
      height: 40px;
      line-height: 40px;
   }

   .file-upload .file-select.file-select-disabled:hover .file-select-name {
      line-height: 40px;
      display: inline-block;
      padding: 0 10px;
   }
   .btn-orange{
      padding: .5rem 1.2rem;
      height: fit-content;
   }
   @media(max-width:768px){
      .file-upload{width: 100%;}
   }
   </style>
   <div class="container-fluid page-wrapper">
      <div class="row mb-2 justify-content-between pl-1 pr-1 align-items-center">
         <div>
            <h1 class="a_dash p-0 m-0">Admin Dashboard</h1>
         </div>
         <div class="btn-group mt-1 mt-sm-0">
            <a style="position:relative;" href="javascript:;" data-toggle="modal" data-target="#bulkUploadModal" class="add_button"><i class="fas fa-upload"></i> Bulk Upload</a>
         </div>
      </div>
      <div id="crypto-stats-3" class="row">
         <div class="col-xl-3 col-lg-6 col-6"> 
            <div class="card pull-up">
               <div class="card-content">
                  <a href="{{ route('communities') }}">
                     <div class="card-body">
                        <div class="media d-flex">
                              <div class="media-body text-left">
                                 <h3 class="info">{{count($communities)}}</h3>
                                 <h6>Communities</h6>
                              </div>
                              <div>
                                 <i class="icon-user info font-large-2 float-right"></i>
                              </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                           <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                     </div>
                  </a>
               </div>
            </div>
         </div>
         <div class="col-xl-3 col-lg-6 col-6"> 
            <div class="card pull-up">
               <div class="card-content">
                  <a href="{{ route('homes') }}">
                     <div class="card-body">
                        <div class="media d-flex">
                              <div class="media-body text-left">
                                 <h3 class="warning">{{count($homes)}}</h3> <h6>Elevations</h6>
                              </div>
                              <div>
                                 <i class="icon-home warning font-large-2 float-right"></i>
                              </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                           <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                     </div>
                  </a>
               </div>
            </div>
         </div>

         <div class="col-xl-3 col-lg-6 col-6"> 
            <div class="card pull-up">
               <div class="card-content">
                  <a href="{{ route('leads') }}">
                     <div class="card-body">
                        <div class="media d-flex">
                              <div class="media-body text-left">
                                 <h3 class="success">{{count($leads)}}</h3> Buyer Details<h6></h6>
                              </div>
                              <div>
                                 <i class="icon-home success font-large-2 float-right"></i>
                              </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                           <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                     </div>
                  </a>
               </div>
            </div>
         </div>

         <div class="col-xl-3 col-lg-6 col-6"> 
            <div class="card pull-up">
               <div class="card-content">
                  <a href="{{ route('analytics') }}">
                     <div class="card-body">
                        <div class="media d-flex">
                              <div class="media-body text-left">
                                 <h3 class="danger">5</h3> Analytics<h6></h6>
                              </div>
                              <div>
                                 <i class="icon-home danger font-large-2 float-right"></i>
                              </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                           <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                     </div>
                  </a>
               </div>
            </div>
         </div>
      </div>

      
      <div class="card mb-4">
         <div class="card-body">
            <div class="table-responsive" id="custom_table">
               @if(\Session::has('success'))
                  
                  <div class="alert alert-success alert-dismissible" style="margin-top:18px;">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                      <strong>Success!</strong> {{ \Session::get('success') }}
                  </div>
               @endif
               <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                     <tr>
                        <th style="width:40px">#</th>
                        <th>Name</th>
                        <th>Email</th> 
                        <th>Mobile Number</th>
                        <th>Status</th>
                        <th style="width:60px">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($leads as $i => $user)
                     <tr>
                        <td>{{$i+1}}.</td>
                        <td>{{$user->name}}</td>
                        <td>{{isset($user->email)?$user->email:'Not Given'}}</td>
                        <td>{{isset($user->mobile)?$user->mobile:'Not Given'}}</td>
                        <td>
                        @if($user->status_id == 2)
                           <span class="a1 green" id="{{$user->id}}" user_id="{{$user->id}}" >Active</span>
                           @else
                           <span class="a1 red" id="{{$user->id}}" user_id="{{$user->id}}" >Deactive</span>
                           @endif
                        </td>
                        <td>
                           <span><a class="a1 click_edit" title="Edit" href="javascript:void(0)" users_id="{{$user->id}}" users_status="{{$user->status_id}}" users_name="{{$user->name}}" users_email="{{$user->email}}" users_mob="{{$user->mobile}}">
                              <i class="fa fa-edit"></i></a></span>
                           <span><a href="#" class="a1" onclick="deleteData({{$user->id}})" data-toggle="modal" data-target="#modal-delete" id="{{$user->id}}"><i class="fas fa-trash"></i></a></span>
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
               <input type="hidden" name="users_id" id="users_id" value="">
               <div class="modal-body">
                  <div class="row">
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                           <input required class="form-control forms1" id="users_name" name="name" placeholder="Name" type="text" value="">
                        </div>
                     </div>
                     
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                           <input required class="form-control forms1" id="users_email" name="email" placeholder="Email" type="email" value="">
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                           <input class="form-control forms1" id="users_pass" name="password" placeholder="Password" type="password" value="">
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                           <input required class="form-control forms1" id="users_mob" name="mobile" placeholder="Mobile Number" type="text" value="">
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                              <select class="form-control forms1" name="status" id="users_status">
                              
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

   <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-modal="true">
      <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
       <form action="{{route('delete_user')}}" id="deleteForm" method="POST">
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

<!-- CSV Modal -->
<div class="modal fade bd-example-modal-xl" id="bulkUploadModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="m-0" style="line-height:1; font-weight:500;">Bulk Upload</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true"><i class="fa fa-times"></i> </span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row pl-1 pr-1 justify-content-between align-items-center">
               <div class="file-upload pr-md-1 pr-0">
                  <div class="file-select">
                     <div class="file-select-button" id="fileName">Choose Excel File</div>
                     <div class="file-select-name" id="noFile">No file chosen...</div> 
                     <input type="file" name="excel_file" id="excelFile">
                  </div>
               </div>
               <a href="{{ url('/admin/bulk-upload-sample.xlsx') }}" style="float:unset; ; line-height:22px;" class="btn-orange mt-1 mt-md-0"><i class="fa fa-file-excel"></i> Sample File</a>
            </div>
            <div class="error-messages mb-1"></div>
            <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr ml-0">Cancel</button>
            <button type="button" id ="bulkUpload" class="btn-orange t_b_s">Upload</button>
         </div>
      </div>
   </div>
</div>

   
@endsection
@push('scripts')
<script type="text/javascript">
      function deleteData(id) {
         $("#deleteForm #user_id").val(id);
      }

      $(document).ready(function(){
          setTimeout(function() {
              $('#msg').fadeOut('fast');
          }, 3000);
      });

      $(document).ready(function() {
         $('.click_edit').click(function() {
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
            $('#edit_user').modal('show');  
         });
         var file = null;
         var filename;
         $('#excelFile').on('change', function () {
            $(".error-messages").html('');
            file = this.files[0];
            filename = $("#excelFile").val();
            if (/^\s*$/.test(filename)) {
               $(".file-upload").removeClass('active');
               $("#noFile").text("No file chosen..."); 
            }
            else {
               $(".file-upload").addClass('active');
               $("#noFile").text(filename.replace("C:\\fakepath\\", "")); 
            }
         });

         // Modal Event
         $('#bulkUploadModal').on('hidden.bs.modal', function (e) {
            $("#excelFile").val('');
            $(".file-upload").removeClass('active');
            $("#noFile").text("No file chosen..."); 
            file = null;
            $(".error-messages").html('');
         })
         
         //Bulk Upload 
         $("#bulkUpload").click(function(){
            var formData = new FormData();
            formData.append('excelFile', file);
            if(file != null){
               var fileExtension = filename.split('.').pop();
               if(fileExtension == 'xlsx'){
                  $.ajax({
                     type        : "post",
                     url         : "/api/mega-import",
                     headers     : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                     data        : formData,
                     cache       : false,
                     contentType : false,
                     processData : false,
                     success     : function(response){
                        toastr.success(response);
                        $("#bulkUploadModal").modal('hide');
                        $(".error-messages").html('');
                     },
                     error       : function(error){
                        console.log(error);
                        toastr.error(error.responseJSON.message);
                        var errorMessages = '';
                        $.each(error.responseJSON.errors, function(){
                           errorMessages += `<small class="danger">${this}</small><br>`
                        });
                        $(".error-messages").html(errorMessages);
                     } 
                  });
               }
               else{
                  toastr.error("Please choose an excel file.");
               }
            }
            else{
               toastr.error("Please choose an excel file.");
            }
         });
      });
   </script>
@endpush