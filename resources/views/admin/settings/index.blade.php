@extends('layouts.admin')
@section('content')
<div class="container-fluid page-wrapper">
    <div class="justify-content-between mb-2">
        <h1 class="a_dash d-inline-block m-0 p-0">{{$page_title}}</h1>
    </div>

    <div class="mb-1">
        @if (session('error'))
        <div class="alert alert-danger" id="msg">
            {{ session('error') }}
        </div>
        @endif @if(\Session::has('success'))

        <div class="alert alert-success alert-dismissible" style="margin-top: 18px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <strong>Success!</strong> {{ \Session::get('success') }}
        </div>
        @endif
        <!-- main-section-content -->
        <div class="main-section-content">
            <div class="settings-section">
                <div class="custom_b" style="background: #fff; border: 0px; padding: 0;">
                    <nav>
                        <div class="nav nav-tabs myTabSettings" role="tablist">
                            <a class="nav-item mr-md-5 nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" style="line-height: 30px;">ADMIN SETTINGS</a>
                            <a class="nav-item mr-md-5 nav-link" id="nav-password-tab" data-toggle="tab" href="#nav-password" role="tab" aria-controls="nav-password" aria-selected="false" style="line-height: 30px;">CHANGE PASSWORD</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <form class="col-sm-12" id="custom_fonts_1" method="POST" action="{{url('admin/settings/save')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body" id="new_custom_table">
                                    <div class="form-row">
                                    @foreach($setting as $key => $value) @if($value->type =='file')
                                        <div class="form-group col-md-6" id="f_mar">
                                            <div class="row">
                                                <div class="col-xl-4">
                                                    <label for="{{ $value->name }}" class="font-weight-bold text-uppercase">{{ str_replace('_', ' ', $value->name) }}</label>

                                                    <label class="btn btn-default btn-file rounded-0">
                                                        <!-- The file is stored here. -->Choose File
                                                        <input type="file" id="{{ $value->name }}" name="{{ $value->name }}" style="display: none !important;" value="{{ $value->value }}" />
                                                    </label>
                                                </div>
                                                <div class="col-xl-8">
                                                    <span style="border:1px solid #ccc; padding:10pxborder: 1px solid #ccc; padding: 10px; height: 120px; display: inline-block; min-width: 120px;">
                                                        <img src="{{asset('uploads/'.$value->value)}}" style="max-height: 100%;" />
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        @elseif($value->type =='email')
                                        <div class="form-group col-md-6">
                                            <label for="name" class="font-weight-bold text-uppercase">{{ str_replace('_', ' ', $value->name) }}</label>
                                            <input class="form-control forms1" id="{{ $value->name }}" name="{{ $value->name }}" type="{{ $value->type }}" value="{{ $value->value }}" />
                                        </div>
                                        @else
                                        <div class="form-group col-md-6">
                                            <label for="name" class="font-weight-bold text-uppercase">{{ str_replace('_', ' ', $value->name) }}</label>
                                            <input class="form-control forms1" id="{{ $value->name }}" name="{{ $value->name }}" type="{{ $value->type }}" value="{{ $value->value }}" />
                                        </div>
                                        @endif @endforeach
                                    </div>
                                </div>

                                <button type="submit" class="btn-orange t_b_s">Save</button>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
                            <form class="form-horizontal col-sm-12" id="custom_fonts_1" method="POST" action="{{ route('changePassword') }}" style="margin-top: 13px;">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-9">
                                        <label for="name">Current Password</label>
                                        <input required id="current-password" type="password" class="form-control forms1" name="current-password" />

                                        @if ($errors->has('current-password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('current-password') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-9" style="margin-top: -15px;">
                                        <label for="email">New Password</label>
                                        <input required id="new-password" type="password" class="form-control forms1" name="new-password" />

                                        @if ($errors->has('new-password'))
                                        <span class="help-block">
                                            <strong style="color: #7f231c;">{{ $errors->first('new-password') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-9" style="margin-top: -17px;">
                                        <label for="role">Confirm New Password</label>
                                        <input required id="new-password-confirm" type="password" class="form-control forms1" name="new-password_confirmation" />
                                    </div>

                                    <div class="col-lg-12" style="margin-top: 10px;">
                                        <button type="submit" class="btn-orange t_b_s">Save</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
      $(document).ready(function(){
          setTimeout(function() {
              $('#msg').fadeOut('fast');
          }, 3000);
      });
  </script>

<script>
$(document).ready(function()
{
    $('.click_edit').click(function()
    {
        $('#users_id').val($(this).attr('users_id'));
        $('#users_name').val($(this).attr('users_name'));
        $('#users_email').val($(this).attr('users_email'));
        $('#users_mob').val($(this).attr('users_mob'));
        $('#users_status').val($(this).attr('users_status'));
        $('#users_username').val($(this).attr('users_username'));

        $('#user').attr('action','/admin/settings/'+ $('#users_id').val());
        $('#edit_user').modal('show');  
    });
});
</script>

@endsection