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
                    <h4 class="card-title">Update Profile</h4>
                      <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                      <div class="heading-elements">
                         <a href="{{ route('profile') }}" class="d-none d-sm-inline-block btn btn-dark btn-min-width mb-1 waves-effect waves-light"><i class="fas fa-arrow-left fa-sm pr-2"></i>Back</a>
                      </div>
                    
                </div>
            </div>
        </div>
        @if(count($errors) > 0)
                <div class="alert alert-danger">
                 <ul>
                 @foreach($errors->all() as $error)
                  <li>{{$error}}</li>
                 @endforeach
                 </ul>
                </div>
                @endif
                @if(\Session::has('success'))
                <div class="alert alert-success">
                 <p>{{ \Session::get('success') }}</p>
                </div>
                @endif

        <div class="card-body" id="new_custom_table">

                    <form method="POST" action="{{action('Admin\ProfileController@update', Auth::user()->id)}}" id="portfolio_form">
              @csrf
                  <div class="form-row">
                     <div class="form-row col-md-8">
                        <div class="form-group col-md-9">
                           <label for="name">Name</label>
                           <input class="form-control" id="name" placeholder="Enter Name" name="name" type="text" value="{{ $form->name}}">

                           @error('name')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                           
                        </div>

                        <div class="form-group col-md-9">
                           <label for="email">Email Address</label>
                           <input class="form-control" id="email" placeholder="Enter Email Address" name="email" type="email" value="{{ $form->email}}">

                           @error('email')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                           
                        </div>

                        <div class="form-group col-md-9">
                           <label for="role">Role</label>
                           <input class="form-control" id="role" name="role" type="text" value="{{$admin->roles->role}}" readonly="readonly">
                           
                        </div>

                        <div class="form-group col-md-9">
                           <label for="mobile">Mobile Number</label>
                           <input class="form-control" id="mobile" placeholder="Enter Mobile Number" name="mobile" type="text" value="{{ $form->mobile}}">

                           @error('mobile')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                           
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