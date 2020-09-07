@extends('layouts.user')
    @section('content')
  
    <div class="container-fluid">

<div class="d-sm-flex align-items-center justify-content-between mb-4">
 <h1 class="a_dash">{{$page_title}}</h1>
</div>

<nav aria-label="breadcrumb" id="g_r_bar">
 <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('settings') }}"><i class="fas fa-fw fa-cogs"></i>{{$page_title}}</a></li>
 </ol>
</nav>
        
                  <div>
                            @if (session('error'))
                            <div class="alert alert-danger" id="msg">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success" id="msg">
                                {{ session('success') }}
                            </div>
                        @endif
                     <!-- main-section-content -->
                     <div class="main-section-content">
                        <div class="settings-section">
                           <div class="custom_b">
                              <nav>
                                 <div class="nav nav-tabs myTabSettings" role="tablist">
                                  <!--  <a class="nav-item mr-md-5 nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" style="line-height: 30px;">USER SETTINGS</a> -->
                                    <a class="nav-item mr-md-5 nav-link active" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false" style="line-height: 30px;">USER SETTINGS</a>
                                      <a class="nav-item mr-md-5 nav-link" id="nav-password-tab" data-toggle="tab" href="#nav-password" role="tab" aria-controls="nav-password" aria-selected="false" style="line-height: 30px;">CHANGE PASSWORD</a>
                               
                                 </div>
                              </nav>
                              <div class="tab-content" id="nav-tabContent">

                               <!--  <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <form class="col-sm-12" id="custom_fonts_1" method="POST" action="{{url('user_settings/save')}}"  enctype="multipart/form-data">
                                        
                                      @csrf
                                      <div class="card-body" id="new_custom_table">
                                       
                                          
                                            <div class="form-row">
                                                @foreach($setting as $key => $value)
                                                  @if($value->type =='file')
                                                  <div class="form-group col-md-6" id="f_mar">
                                                    <label for="logoImage">Profile Image</label>
                                                    <div class="imageupload panel panel-default">
                                                       <div class="file-tab panel-body">
                                                          <label class="btn btn-default btn-file rounded-0">
                                                             Choose File
                                                             <input type="file" id="{{ $value->name }}" name="{{ $value->name }}" style="display: none !important;" value="{{ $value->value }}">
                                                          </label>
                                                          <img src="{{asset('uploads/'.$value->value)}}" style="margin-top: -91px;margin-left: 150px;">
                                                       </div>
                                                    </div>
                                                 </div>
                                                  @else
                                                  <div class="form-group col-md-6">
                                                     <label for="name" class="font-weight-bold text-uppercase">{{ str_replace('_', ' ', $value->name) }}</label>
                                                     <input class="form-control forms1" id="{{ $value->name }}" name="{{ $value->name }}" type="{{ $value->type }}" value="{{ $value->value }}">
                                                  </div>
                                                  @endif
                                                @endforeach
                                               
                                            </div>
                                      </div>

                                       <button type="submit" class="btn btn-orange rounded-0 pl-3 pr-3">Submit</button>
                                    </form>
                                 </div> -->

                                  
                                 <div class="tab-pane fade show active" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    <div id="f_mar" class="px-4">
                                       <div class="table-responsive" id="custom_table">
                                           <form method="post" action="{{route('user_settings_save')}}" name="user" id="user">
                                @csrf
                                <input type="hidden" name="users_id" id="users_id" value="{{$user->id}}">
                                <div class="modal-body">
                                   <div class="row">
                                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                         <div class="form-group">
                                            <input required class="form-control forms1" id="name" name="name" value="{{$user->name}}" placeholder="Name" type="text" value="">
                                         </div>
                                      </div>


                                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                    <label for="name">Profile image</label>
                                    <label class="btn btn-default btn-file rounded-0" style="margin-top: 0px !important;">
                                       Choose File
                                  <input type="file" class="custom-file-input image-file" id="profileimage" onchange="readURL(this);" name="profileimage" style="display: none !important;">
                                    </label>
                                  
                                                @if(isset($user->profile_image))
                                                    @if($user->profile_image!='' || $user->profile_image!=null)
                                                    <div class="col-lg-12 mx-auto p-0 o-hidden">
                                                      <img id="blah" width="180" height="180" src="{{asset('uploads/'.$user->profile_image)}}" class="img-thumbnail">
                                                    </div>
                                                    @else
                                                    <div class="col-lg-12 mx-auto p-0 o-hidden">
                                                      <img id="blah" width="180" height="180" src="http://placehold.it/100" class="img-thumbnail">
                                                    </div>
                                                    @endif
                                                  @endif
                                    </div>
                                      </div> 

                                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                         <div class="form-group">
                                            <input required class="form-control forms1" id="username" name="username" placeholder="Username" type="text" value="{{$user->username}}">
                                         </div>
                                      </div>
                                      
                                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                         <div class="form-group">
                                            <input required class="form-control forms1" id="email" name="email" value="{{$user->email}}" placeholder="Email" type="email" value="">
                                         </div>
                                      </div>
                                     <!--  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                         <div class="form-group">
                                            <input class="form-control forms1" id="pass" name="pass" placeholder="Password" type="password" value="">
                                         </div>
                                      </div> -->
                                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                         <div class="form-group">
                                            <input required class="form-control forms1" id="mobile" name="mobile" value="{{$user->mobile}}" placeholder="Mobile Number" type="text" value="">
                                         </div>
                                      </div>
                                     <!--  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                         <div class="form-group">
                                            <input  class="form-control forms1" id="users_role" name="role" type="text" value="" readonly="readonly">
                                         </div>
                                      </div> -->
                                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                         <div class="form-group">
                                              <select class="form-control forms1" name="status_id" id="status_id">
                                                <option value="2">Active</option>
                                              <option value="1">Deactive</option>
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

                     <!-- Edit User popup modal-->
                      <div class="modal fade bd-example-modal-xl" id="edit_user" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-hidden="true">
                       <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
                          <div class="modal-content">
                             <div class="modal-header">
                                <h5>Edit User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fa fa-times"></i>  </span>
                                </button>
                             </div>
                           
                          </div>
                       </div>
                    </div>

                    <!-- Edit user popup modal-->

                     </div>

                                 <div class="tab-pane fade" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
                                    <form class="form-horizontal col-sm-12" id="custom_fonts_1" method="POST" action="{{ route('user_changepassword') }}" style="margin-top: 13px;">
                                        <input  id="email" name="email" value="{{$user->email}}" type="hidden">

                                    @csrf
                                        <div class="form-row">
                                           
                                              <div class="form-group col-md-9">
                                                 <label for="name">Current Password</label>
                                                 <input id="current_password" type="password" class="form-control forms1" name="current_password">

                                                 @if ($errors->has('current_password'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('current_password') }}</strong>
                                                </span>
                                                @endif
                                                 
                                              </div>

                                              <div class="form-group col-md-9" style="margin-top: -15px;">
                                                 <label for="email">New Password</label>
                                                 <input id="new_password" type="password" class="form-control forms1" name="new_password">

                                                  @if ($errors->has('new_password'))
                                                      <span class="help-block">
                                                      <strong style="color: #7F231C;">{{ $errors->first('new_password') }}</strong>
                                                  </span>
                                                  @endif
                                                 
                                              </div>

                                              <div class="form-group col-md-9" style="margin-top: -17px;">
                                                 <label for="role">Confirm New Password</label>
                                                 <input id="new_password_confirm" type="password" class="form-control forms1" name="new_password_confirmation">
                                                 
                                              </div>
                                              
                                              <div class="col-lg-12" style="margin-top: 10px;">
                                                 <button type="submit" class="btn btn-orange subBtn"><i class="fas fa-save fa-sm text-white-50 pr-2"></i>Save</button>
                                              </div>
                                           
                                        </div>
                                     </form>
                                 </div>

                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

        
        </div>
        
        <div class="clearfix"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
      $(document).ready(function(){
          setTimeout(function() {
              $('#msg').fadeOut('fast');
          }, 3000);
      });
  </script>

<script>
 $(document).ready(function() {
        var editform = $("#user");
        $("#user").submit(function() {
            $.ajax({
                type: 'POST',
                url: '{{route('user_settings_save')}}',
                data: $("#user").serialize(),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                enctype: 'multipart/form-data',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                  console.log(data);
                  $('#edit_user').modal('hide');
                }
            });
        });
    });


  function readURL(input) 
            {
                if (input.files && input.files[0]) 
                {
                    var reader = new FileReader();

                    reader.onload = function (e) 
                    {
                        $('#blah')
                        .attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }




</script>

@endsection
