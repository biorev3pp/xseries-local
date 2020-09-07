<meta name="google-signin-client_id" content="887903172218-lb8pn2mr1shkm5f51758aa0nj1iaiks3.apps.googleusercontent.com">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
<!-- Begin Login Section Pop Up -->
<div class="login-section">
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" style="z-index:1300;">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <img src="{{asset('new-ui/images/close-btn.png')}}" alt=""> </button>
				<div class="modal-body p-0">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link authentication-modal-form active" id="home-tab" data-toggle="tab" data-target="#home" role="tab" aria-controls="home" aria-selected="true"> <i class="icon-login"></i> Sign In</a>
						</li>
						<li class="nav-item">
							<a class="nav-link authentication-modal-form" id="profile-tab" data-toggle="tab" data-target="#profile" role="tab" aria-controls="profile" aria-selected="false"> <i class="icon-note"></i> Sign Up </a>
						</li>
						<li class="nav-item">
							<a class="nav-link authentication-modal-form" id="contact-tab" data-toggle="tab" data-target="#contact" role="tab" aria-controls="contact" aria-selected="false"> <i class="icon-lock"></i> Forgot Password </a>
						</li>
					</ul>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
							<div id="loginbox" class="tab-box">
								<div class="panel panel-info">
									<div class="panel-body">
										<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
										<form action="javascript:void(0)" id="signInForm" method="post">
											<input type="hidden" id="btn_clicked" value="@auth{{'finish'}}@else{{'login'}}@endauth">
											<div id="lerr-msg"></div>
											<div class="form-group">
												<div class="input-group"> <span class="input-group-addon"><i class="icon-envelope"></i></span>
													<input id="lemail" type="email" class="form-control" name="username" placeholder="Your Email Address" required="" aria-invalid="true" style=""> </div>
											</div>
											<div class="form-group">
												<div class="input-group"> <span class="input-group-addon"><i class="icon-lock"></i></span>
													<input id="lpassword" type="password" class="form-control" name="password" placeholder="Your Password" required="" aria-invalid="true"> </div>
											</div>
											<div class="form-group text-center" id="logindiv">
												<button type="submit" class="btn btn-primary btn-lg btn-block login-button">Login</button>
											</div>
											<div class="divider-text text-center mb-2 mt-4"> <span class="bg-light"><b>OR</b></span> </div>
											<div class="row">
												<div class="col-sm-6">
													<div class="social-btn">
														<div data-onlogin="checkLoginState()" data-scope="public_profile,email" class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-use-continue-as="true"></div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="social-btn">
														<div id="my-signin2"></div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
							<div id="loginbox" class="tab-box">
								<div class="panel panel-info">
									<div class="panel-body">
										<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
										<form action="javascript:void(0)" id="signupForm" method="post">
											<div id="rerr-msg"></div>
											<div class="form-group">
												<div class="input-group"> <span class="input-group-addon"><i class="icon-user"></i></span>
													<input type="text" class="form-control" id="nname" required="" placeholder="Enter Full Name"> </div>
											</div>
											<div class="form-group">
												<div class="input-group"> <span class="input-group-addon"><i class="icon-envelope"></i></span>
													<input type="email" class="form-control" id="nemail" required="" placeholder="Enter Email"> </div>
											</div>
											<div class="form-group">
												<div class="input-group"> <span class="input-group-addon"><i class="icon-screen-smartphone"></i></span>
													<input type="mobile" class="form-control" id="nmobile" required="" placeholder="Enter Contact Number"> </div>
											</div>
											<div class="form-group">
												<div class="input-group"> <span class="input-group-addon"><i class="icon-lock"></i></span>
													<input type="password" class="form-control" id="npassword" required="" placeholder="Enter Password"> </div>
											</div>
											<div class="form-group" id="regdiv">
												<button type="submit" class="btn btn-block btn-primary btn-lg login-button">Sign Up</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
							<div id="loginbox" class="tab-box">
								<div class="panel panel-info">
									<div class="panel-body">
										<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
										<p>We will send you a reset password email, kindly check your email and follow the given instruction.</p>
										<form action="javascript:void(0)" id="forgotPasswordPopForm" method="post">
											<div id="ferr-msg"></div>
											<div class="form-group" id="ediv">
												<div class="input-group"> <span class="input-group-addon"><i class="icon-envelope"></i></span>
													<input type="email" class="form-control" id="femail" name="femail" placeholder="Enter Email"> </div>
											</div>
											<div class="form-group" style="display:none" id="vcodeDiv">
												<label for="fvcode">Verification Code<span class="text-danger">*</span> </label>
												<div class="input-group">
													<input type="text" class="form-control" id="fvcode" placeholder="Enter Verification Code">
													<div class="input-group-append no-verify">
														<button class="input-group-text" id="verifyCode" type="button"> Verify </button>
													</div>
												</div>
											</div>
											<div class="form-group" style="display:none" id="npassDiv">
												<label for="fpassword">New Password<span class="text-danger">*</span> </label>
												<div class="input-group">
													<input type="password" class="form-control" id="fpassword" placeholder="Enter Password">
													<div class="input-group-append">
														<button class="input-group-text" id="showPass" type="button"> <i class="fas fa-eye"></i> </button>
													</div>
												</div>
												<div class="form-group mt-3" id="cpPassBtnDiv">
													<button type="button" id="cpPassBtn" class="btn btn-block btn-primary btn-lg login-button">Change Password</button>
												</div>
											</div>
											<div class="form-group" id="forgdiv">
												<button type="submit" class="btn btn-block btn-primary btn-lg login-button">Proceed</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div style="margin-bottom: 0px;text-align: center;font-weight: 500;border-radius:0px;" class="alert alert-success" role="alert"> OAuth 2.0 Protected. </div>
			</div>
		</div>
	</div>
</div>
<!-- End Login Section Pop Up -->
  @push('scripts')
  <script>
  function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
    if (response.status === 'connected') {   // Logged into your webpage and Facebook.
      testAPI();  
    }
  }

  function checkLoginState() {               // Called when a person is finished with the Login Button.
    FB.getLoginStatus(function(response) {   // See the onlogin handler
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '317131729490323',
      cookie     : true,                     // Enable cookies to allow the server to access the session.
      xfbml      : true,                     // Parse social plugins on this webpage.
      version    : 'v7.0'           // Use this Graph API version for this call.
    });

    FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
      statusChangeCallback(response);        // Returns the login status.
    });
  };

  (function(d, s, id) {                      // Load the SDK asynchronously
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
    FB.api('/me', {fields: 'id,name,email' }, function(response) {
      if(sessionStorage.getItem("loggedIn") != 1){
        $.ajax({
          type:"post",
          url: "/api/fb-sign-in-data",
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
          data:{"fb_id":response.id, "name":response.name,'email':response.email},  
          beforeSend  : function () 
          {
            $("#preloader").show();
          },
          complete: function (response) 
          {
            if(response.responseJSON.status == 'success') {
              if($('#btn_clicked').val() == 'login'){
                window.location.reload();                  
              }else{
                sessionStorage.setItem("loggedIn", "1");
                sessionStorage.setItem("login", "fb");
                window.location.href = estimate;
              }
              $("#preloader").hide();
              $('#rerr-msg').html('').removeClass('alert alert-danger');
                $('#regdiv').html('');
            } else {
              $('#rerr-msg').html(response.responseJSON.message).addClass('alert alert-danger');
              $('#regdiv').html('<button type="submit" class="btn btn-block btn-primary btn-lg login-button">Sign Up</button>');
            }
          },
        });
      }
    });
  }
</script>
<script type="text/javascript">
  function finish(){
    $('#btn_clicked').val('finish');
    @auth
      window.location.href = estimate;
    @else
    $('#exampleModal').modal('show');
    @endauth
  }
  var app_base_url="{{url('/')}}";
  // Sign up Form Action
  $('#signupForm').submit(function() {
    $.ajax({
      url : app_base_url+'/api/user-register',
      type : "POST",
      data : {'_token': "{{csrf_token()}}",'name':$('#nname').val(),'email':$('#nemail').val(),'mobile':$('#nmobile').val(),'password':$('#npassword').val()},
      beforeSend  : function () 
      {
        $("#preloader").show();
      },
      complete: function (response) 
      {
        if(response.responseJSON.status == 'success') {
            if($('#btn_clicked').val() == 'login'){
            window.location.reload();
          }else{
            window.location.href = estimate;
          }
          $("#preloader").hide();
          $('#rerr-msg').html('').removeClass('alert alert-danger');
          $('#regdiv').html('');
        } else {
            $('#rerr-msg').html(response.responseJSON.message).addClass('alert alert-danger');
            $('#regdiv').html('<button type="submit" class="btn btn-block btn-primary btn-lg login-button">Sign Up</button>');
        }
      },
    });
  });
  // Sign in Form Action
  $('#signInForm').submit(function() {
    $('#logindiv').html('<img src="'+app_base_url+'/images/spinner.gif">');
    $.ajax({
      url : app_base_url+'/api/user-login',
      type : "POST",
      data : {'_token': "{{csrf_token()}}",'email':$('#lemail').val(),'password':$('#lpassword').val()},
      beforeSend  : function () 
      {
        $("#preloader").show();
      },
      complete: function (response) 
      {
        if(response.responseJSON.status == 'success') {
          if($('#btn_clicked').val() == 'login'){
            window.location.reload();
          }else{
            window.location.href = estimate;
          }
          $('#logindiv').html('Success');
          $('#lerr-msg').html('').removeClass('alert alert-danger');
          $('#logindiv').html('');
        } else {
          $('#lerr-msg').html(response.responseJSON.message).addClass('alert alert-danger');
          $('#logindiv').html('<button type="submit" class="btn btn-block btn-primary btn-lg btn-block login-button">Login</button>');
        }
      },
    });
  });
  // Forgot password Form Actions - send code on email
  $('#forgotPasswordPopForm').submit(function() {
    $('#forgdiv').html('<img src="'+app_base_url+'/images/spinner.gif">');
    $.ajax({
      url : app_base_url+'/api/forgot-password',
      type : "POST",
      data : {'_token': "{{csrf_token()}}",'email':$('#femail').val()},
      complete: function (response) 
      {
        if(response.responseJSON.status == 'success') {
          $('#ferr-msg').html(response.responseJSON.message).addClass('alert alert-success').removeClass('alert-danger');
          $('#femail').attr('readonly', 'readonly');
          $('#vcodeDiv').show();
          $('#forgdiv').html('').hide();
        } else {
          $('#ferr-msg').html(response.responseJSON.message).addClass('alert alert-danger').removeClass('alert-success');
          $('#forgdiv').html('<button type="submit" class="btn btn-block btn-primary btn-lg login-button">Proceed</button>');
        }
      },
    });
  });
  // verify code sent on email
  $('#verifyCode').click(function() {
    $.ajax({
      url : app_base_url+'/api/verify-code',
      type : "POST",
      data : {'_token': "{{csrf_token()}}",'email':$('#femail').val(), 'vcode':$('#fvcode').val()},
      complete: function (response) 
      {
        if(response.responseJSON.status == 'success') {
          $('#ferr-msg').html(response.responseJSON.message).addClass('alert alert-info').removeClass('alert-danger alert-success');
          $('#femail').attr('readonly', 'readonly');
          $('#vcodeDiv').hide();
          $('.no-verify').html('').hide();
          $('#npassDiv').show();
        } else {
          $('#ferr-msg').html(response.responseJSON.message).addClass('alert alert-danger').removeClass('alert-success  alert-info');
        }
      },
    });
  });
  // update password
  $('#cpPassBtn').click(function() {
    $('cpPassBtnDiv').html('<img src="'+app_base_url+'/images/spinner.gif">');
    $.ajax({
      url : app_base_url+'/api/update-password',
      type : "POST",
      data : {'_token': "{{csrf_token()}}",'email':$('#femail').val(), 'vcode':$('#fvcode').val(), 'passcode': $('#fpassword').val()},
      complete: function (response) 
      {
        if(response.responseJSON.status == 'success') {
          $(document).find('.manageToggle').each(function(){
            let checked = $(this).find('input').is(':checked');
            if(checked){
              let featureid = $(this).attr('data-self');
              let featureInput = '<input name="feature_id[]" type="hidden" value="'+featureid+'">';
              $(document).find("input[name='home_id']").after(featureInput);
            }
          });
          $("#npassDiv").hide();
          $("#vcodeDiv").hide();
          $("#ediv").show();
          $('#ferr-msg').html(response.responseJSON.message).addClass('alert alert-success').removeClass('alert-danger  alert-info');
        } else {
          $('cpPassBtnDiv').html('<button type="button" id="cpPassBtn" class="btn btn-block btn-primary btn-lg login-button">Change Password</button>');
          $('#ferr-msg').html(response.responseJSON.message).addClass('alert alert-danger').removeClass('alert-success  alert-info');
        }
      },
    });
  });
  // Show/hide password in forgot password box
  $('#showPass').mouseover(function() {
    $('#fpassword').attr('type', 'text');
  }).mouseout(function() {
    $('#fpassword').attr('type', 'password');
  });
</script>
<script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
<script>
  function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    $.ajax({
      type:"post",
      url: "/api/google-sign-in-data",
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      data:{"g_id":profile.getId(), "name":profile.getName(), "email":profile.getEmail()},
      beforeSend  : function () 
      {
        $("#preloader").show();
      },
      complete: function (response) 
      {
        if(response.responseJSON.status == 'success') {
          if($('#btn_clicked').val() == 'login'){
            window.location.reload();
          }else{
            window.location.href = estimate;
          }
          $("#preloader").hide();
          $('#rerr-msg').html('').removeClass('alert alert-danger');
          $('#regdiv').html('');
        } else {
          $('#rerr-msg').html(response.responseJSON.message).addClass('alert alert-danger');
          $('#regdiv').html('<button type="submit" class="btn btn-block btn-primary btn-lg login-button">Sign Up</button>');
        }
      },
    });
  }
  function renderButton() {
    gapi.signin2.render('my-signin2', {
      'scope': 'profile email',
      'width': 240,
      'height': 40,
      'longtitle': true,
      'theme': 'dark', 
    });
    gapi.load('auth2', function() {
      var auth2 = gapi.auth2.init();
      var element = document.getElementById('my-signin2');
      auth2.attachClickHandler(element, {}, onSignIn);
    });
  }
</script>
@endpush