@extends('layouts.user') @section('content')
<meta name="google-signin-client_id" content="887903172218-lb8pn2mr1shkm5f51758aa0nj1iaiks3.apps.googleusercontent.com"> 

<div class="content-wrapper">

    <!-- start add button area-->

    <div class="row m-0">

        <div class="col-12 mb-3">

            <div class="row m-0">

                <div class="col-6 float-left">



                    <h1 class="h1">User Profile</h1>

                </div>



            </div>

        </div>

    </div>



    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="card mb-4">

          <div class="card-header">

             <h5 class="card-title"> Your Profile

              <span class="card-tools"><a class="a1 click_edit float-right" title="Edit" href="javascript:void(0)" users_id="{{$user->id}}" users_status="{{$user->status}}" users_name="{{$user->name}}" users_email="{{$user->email}}" users_mob="{{$user->mobile}}">

                                        <i class="la la-edit"></i>Edit</a></span></h5>

          </div>

            <div class="card-body">

                <div class="table-responsive" id="custom_table">

                    <table class="table table-bordered table-striped">

                        <tbody>

                                <tr><th>Name</th><td>{{$user->name}}</td></tr>

                                <tr><th>Email</th><td>{{$user->email}}</td></tr>

                                <tr><th>Mobile Number</th><td>{{$user->mobile}}</td></tr>

                        </tbody>

                    </table>

                </div>

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

            <form method="post" action="{{Route('update')}}" name="user" id="user" class="pl-1">

                @csrf

                <input type="hidden" name="users_id" id="users_id" value="">

                <div class="modal-body">

                    <div class="row">

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 pl-0">

                            <div class="form-group">

                                <input required class="form-control forms1" id="users_name" name="name" placeholder="Name" type="text" value="">

                            </div>

                        </div>



                        <!-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">

                            <div class="form-group">

                                <input required class="form-control forms1" id="users_email" name="email" placeholder="Email" type="email" value="">

                            </div>

                        </div> -->

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 pl-0">

                            <div class="form-group">

                                <input required class="form-control forms1" id="users_mob" name="mobile" placeholder="Mobile Number" type="text" value="">

                            </div>

                        </div>



                        <div class="clearfix"></div>

                    </div>

                </div>

                <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr ml-0" style="height:auto;"> Cancel </button>

                <button type="submit" class="btn-orange t_b_s"> Update Details</button>

            </form>

        </div>

    </div>

</div>



<!-- Edit user popup modal-->



<!-- Delete user modal popup modal-->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>

<script>

    $(document).ready(function() {

        $('.click_edit').click(function() {

            //alert('here');

            $('#users_id').val($(this).attr('users_id'));

            $('#users_name').val($(this).attr('users_name'));

            $('#users_email').val($(this).attr('users_email'));

            $('#users_mob').val($(this).attr('users_mob'));

            $('#users_status').val($(this).attr('users_status'));

            $('#edit_user').modal('show');

        });

        window.fbAsyncInit = function() {
            FB.init({
            appId      : '162866908488483',
            cookie     : true,                     // Enable cookies to allow the server to access the session.
            xfbml      : true,                     // Parse social plugins on this webpage.
            version    : 'v7.0'           // Use this Graph API version for this call.
            });


        };

        
        (function(d, s, id) {                      // Load the SDK asynchronously
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
            });
   
</script>

@endsection