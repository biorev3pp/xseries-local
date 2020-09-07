@extends('layouts.admin')
@section('content')
<div class="content-wrapper">

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
<!--datatable-->

<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header" id="not_show">
            <h3 class="permission">Profile Settings</h3>
            <div class="heading-elements">           
                <div class="two_btn_DIV">
                    <a href="{{route('editprofile', ['id' => base64_encode($setting->id)])}}" class="d-none d-sm-inline-block btn btn-dark btn-min-width mb-1 waves-effect waves-light">Edit</a>
                    <a href="{{route('showChangePasswordForm')}}" class="d-none d-sm-inline-block btn btn-dark btn-min-width mb-1 waves-effect waves-light" style="width: 170px;">Change Password</a>
               </div>
            </div>
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
                
            <div class="table-responsive" id="custom_table">
                <table class="table table-bordered" width="100%" cellspacing="0">
                   <thead>
                        <tr>
                            <th>Name</th>
                            <td>{{ $setting->name }}</td>
                        </tr>
                        <tr>
                            <th>Email Address</th>
                            <td>{{ $setting->email }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>{{-- $admin->roles->role --}}</td>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <td>{{ $setting->mobile }}</td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!--datatable-->
<div class="clearfix"></div>

</div>

@endsection
