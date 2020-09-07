@extends('layouts.user') @section('content')

<!-- BEGIN: Content-->

<div class="content-wrapper">

    <!-- start add button area-->

    <div class="row m-0">

        <div class="col-12 mb-3">

            <div class="row m-0">

                <div class="col-6 float-left">



                    <h1 class="h1">{{$page_title}}</h1>

                </div>



            </div>

        </div>

    </div>



    <!-- end add button area-->



    <!--data table start-->



    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="card mb-4">

            <div class="card-header" id="not_show">

                <h4 class="card-title">Change Password</h4>

                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

            </div>

          <div class="card-body" id="new_custom_table">

        @if (session('error'))

        <div class="alert alert-danger">

            {{ session('error') }}

        </div>

        @endif @if (session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

        @endif



        <form class="form-horizontal" method="POST" action="{{ route('user_changepassword') }}">

            @csrf

            <div class="form-row">

                <div class="form-row col-md-8">

                    <div class="form-group col-md-9">

                        <label for="name">Current Password</label>

                        <input id="current_password" type="password" class="form-control" name="current_password"> @if ($errors->has('current_password'))

                        <span class="help-block">

                              <strong>{{ $errors->first('current_password') }}</strong>

                          </span> @endif



                    </div>



                    <div class="form-group col-md-9">

                        <label for="email">New Password</label>

                        <input id="new_password" type="password" class="form-control" name="new_password"> @if ($errors->has('new_password'))

                        <span class="help-block">

                                <strong style="color: #7F231C;">{{ $errors->first('new_password') }}</strong>

                            </span> @endif



                    </div>



                    <div class="form-group col-md-9">

                        <label for="role">Confirm New Password</label>

                        <input id="new_password-confirm" type="password" class="form-control" name="new_password_confirmation">



                    </div>



                    <div class="col-lg-12">

                    <button type="submit" class="btn btn-success btn-min-width mb-1 waves-effect waves-light" style="border-radius: 0px;box-shadow: none;font-size: 14px;font-weight: 500;letter-spacing: 1px; z-index:unset;">Save</button>
                    </div>

                </div>

            </div>

        </form>

    </div>

    <!--data table end-->

</div>

</div>

</div>

<!-- END: Content-->

@endsection