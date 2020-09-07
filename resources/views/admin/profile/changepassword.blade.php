@extends('layouts.admin')
@section('content')
    <!-- BEGIN: Content-->
    <div class="content-wrapper">
      <!-- start add button area-->
      <div class="row">
      <div class="col-12">
      <div class="row">
      <div class="col-6 float-left">
      
      <h1 class="h1">{{$page_title}}</h1>
      </div>
    
      </div>
      </div>
      </div>
      <br>
      
      <!-- end add button area-->
      
      
      
      
      <!--data table start-->
      
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header" id="not_show">
                    <h4 class="card-title">Change Password</h4>
                      <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                      <div class="heading-elements">
                         <a href="{{ route('profile') }}" class="d-none d-sm-inline-block btn btn-dark btn-min-width mb-1 waves-effect waves-light"><i class="fas fa-arrow-left fa-sm pr-2"></i>Back</a>
                      </div>
                    
                </div>
            </div>
        </div>

        <div class="card-body" id="new_custom_table">
          @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

              <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}">
              @csrf
                  <div class="form-row">
                     <div class="form-row col-md-8">
                        <div class="form-group col-md-9">
                           <label for="name">Current Password</label>
                           <input id="current-password" type="password" class="form-control" name="current-password">

                           @if ($errors->has('current-password'))
                              <span class="help-block">
                              <strong>{{ $errors->first('current-password') }}</strong>
                          </span>
                          @endif
                           
                        </div>

                        <div class="form-group col-md-9">
                           <label for="email">New Password</label>
                           <input id="new-password" type="password" class="form-control" name="new-password">

                            @if ($errors->has('new-password'))
                                <span class="help-block">
                                <strong style="color: #7F231C;">{{ $errors->first('new-password') }}</strong>
                            </span>
                            @endif
                           
                        </div>

                        <div class="form-group col-md-9">
                           <label for="role">Confirm New Password</label>
                           <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation">
                           
                        </div>
                        
                        <div class="col-lg-12">
                           <button type="submit" class="d-none d-sm-inline-block btn btn-success btn-min-width mb-1 waves-effect waves-light"><i class="fas fa-save fa-sm text-white-50 pr-2"></i>Save</button>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
      <!--data table end-->
      
      
          
           
    </div>
    <!-- END: Content-->
@endsection