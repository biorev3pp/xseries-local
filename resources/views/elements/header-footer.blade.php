<meta name="google-signin-client_id" content="887903172218-lb8pn2mr1shkm5f51758aa0nj1iaiks3.apps.googleusercontent.com"> 
<div class="header">
  <div class="d-flex justify-content-between align-items-center h-100">
    <div class="logo">
      <div id="nav-icon" onclick="openNav()">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
      <a href="/">
        <img src="{{ asset('Xseries-new-ui/images/logo2.png') }}" alt="">
      </a>
    </div> 
    @if(Session::has('com_first'))
    <div class="pb_container">
        <ul class="progressbar">
            <a href="/community?search=map"><li id="pb-community"><span title="Choose Community" class="material-icons">business</span> Choose Community</li></a>
            <a href="{{(Session::get('pb_url_check'))?asset('/elevations?community='.$community->slug):'javascript:;'}}"><li id="pb-elevation"><span title="Select Elevation" class="material-icons">home</span> Select Elevation</li></a> 
            <a href="{{(Session::get('pb_url_check'))?asset('/elevations?community='.$community->slug):'javascript:;'}}"><li id="pb-elevation-type"><span title="Select Elevation" class="material-icons">home</span> Select Elevation Type</li></a> 
            @if(!(Route::currentRouteName() == "xplat")&&!(Route::currentRouteName() == "plat"))
            <a href="{{(Session::get('pb_url_check'))?route('plat'):'javascript:;'}}"><li id="pb-lot"><span title="Select Your Lot" class="material-icons">place
            </span> Lot Selection</li></a> 
            @else
            <li id="pb-lot"><span title="Select Your Lot" class="material-icons">place
            </span> Lot Selection</li> 
            @endif
            @if(Route::currentRouteName()=='xfloor' || Route::currentRouteName() =='estimate')
            <a href="{{(Session::get('pb_url_check'))?route('xhome',['community_slug'=>$community->slug,'home_slug'=>$home->slug,'home_type_slug'=>($home_type)?$home_type->slug:'']):'javascript:;'}}"><li id="pb-color"><span title="Select Your Color Scheme" class="material-icons">format_paint
            </span> Color Scheme</li></a>
            @else
            <li id="pb-color"><span title="Select Your Color Scheme" class="material-icons">format_paint
            </span> Color Scheme</li>
            @endif
            @if(Route::currentRouteName()=='estimate')
            <a href="{{route('xfloor',['community_slug'=>$community->slug,'home_slug'=>$home->slug,'home_type_slug'=>($home_type)?$home_type->slug:''])}}"><li id="pb-floor"><span title="Select Your Floor" class="material-icons">architecture
            </span> Floor PLan</li></a>
            @else
            <li id="pb-floor"><span title="Select Your Floor" class="material-icons">architecture
            </span> Floor PLan</li>
            @endif 
            <li id="pb-estimate"><span title="Complete Estimate" class="material-icons">receipt_long</span> Estimate</li>
        </ul>
    </div>    
    @else
    <div class="pb_container">
        <ul class="progressbar">
            <a href="/search-elevations"><li id="pb-elevation"><span title="Choose Elevation" class="material-icons">home</span> Choose Elevation</li></a> 
            <a href="/search-elevations"><li id="pb-elevation-type"><span title="Choose Elevation Type" class="material-icons">home</span> Choose Elevation Type</li></a> 
            @if(Session::has('home_id'))
              @if($home_type)
              <a href="{{(Session::get('pb_url_check'))?route('elevation-communities',['id'=>$home->slug,'type_id'=>$home_type->slug]):'javascript:;'}}"><li id="pb-community" class=""><span title="Select Community" class="material-icons">business</span> Select Community</li></a>
              @else
              <a href="{{(Session::get('pb_url_check'))?route('elevation-communities',['id'=>$home->slug]):'javascript:;'}}"><li id="pb-community" class=""><span title="Select Community" class="material-icons">business</span> Select Community</li></a>
              @endif
            @else
              <a href="{{(Session::get('pb_url_check'))?'javascript:;':'javascript:;'}}"><li id="pb-community" class=""><span title="Select Community" class="material-icons">business</span> Select Community</li></a>
            @endif
            <a href="{{(Session::get('pb_url_check'))?route('plat'):'javascript:;'}}"><li id="pb-lot"><span title="Select Your Lot" class="material-icons">place
            </span> Lot Selection</li></a>
            @if(Route::currentRouteName()=='xfloor' || Route::currentRouteName()=='estimate')
            <a href="{{route('xhome',['community_slug'=>$community->slug,'home_slug'=>$home->slug,'home_type_slug'=>($home_type)?$home_type->slug:''])}}"><li id="pb-color"><span title="Select Your Color Scheme" class="material-icons">format_paint
            </span> Color Scheme</li></a>
            @else
            <li id="pb-color"><span title="Select Your Color Scheme" class="material-icons">format_paint
            </span> Color Scheme</li>
            @endif
            @if(Route::currentRouteName()=='estimate')
            <a href="{{route('xfloor',['community_slug'=>$community->slug,'home_slug'=>$home->slug,'home_type_slug'=>($home_type)?$home_type->slug:''])}}"><li id="pb-floor"><span title="Select Your Floor" class="material-icons">architecture
            </span> Floor PLan</li></a>
            @else
            <li id="pb-floor"><span title="Select Your Floor" class="material-icons">architecture
            </span> Floor PLan</li>
            @endif 
            <li id="pb-estimate"><span title="Complete Estimate" class="material-icons">receipt_long</span> Estimate</li>
        </ul>
    </div>  
    @endif
    <div id="header-account-button">
      @auth
        <div class="dropdown">
          <button class="btn btn-secondary2 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-people"></i> Account</button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{Route('user_dashboard')}}"><i class="icon-user"></i> Profile</a>
            <a class="dropdown-item" href="{{ Route('user_logout') }}" onclick="signOut()"><i class="icon-logout"></i> Logout</a>
          </div>
        </div>
      @else
        <button type="button" class="btn btn-success login-btn" data-toggle="modal" data-target="#exampleModal">
          <svg xmlns="http://www.w3.org/2000/svg" width="20.572" height="18" viewBox="0 0 20.572 18">
              <g id="login" transform="translate(0 -0.008)">
                  <path id="Path_1" data-name="Path 1" d="M89.669,8.681a4.336,4.336,0,1,1,4.337-4.336A4.341,4.341,0,0,1,89.669,8.681Zm0-7.372A3.036,3.036,0,1,0,92.7,4.345a3.039,3.039,0,0,0-3.036-3.036Zm0,0" transform="translate(-81.932)" fill="#fff" />
                  <path id="Path_2" data-name="Path 2" d="M14.961,263.814H.65a.651.651,0,0,1-.65-.65v-3.036a4.124,4.124,0,0,1,4.12-4.12h7.372a4.124,4.124,0,0,1,4.12,4.12v3.036A.651.651,0,0,1,14.961,263.814Zm-13.66-1.3H14.31v-2.385a2.822,2.822,0,0,0-2.819-2.819H4.12A2.822,2.822,0,0,0,1.3,260.128Zm0,0" transform="translate(0 -245.806)" fill="#fff" />
                  <path id="Path_3" data-name="Path 3" d="M306.69,187.977h-7.372a.65.65,0,1,1,0-1.3h7.372a.65.65,0,1,1,0,1.3Zm0,0" transform="translate(-286.769 -179.175)" fill="#fff" />
                  <path id="Path_4" data-name="Path 4" d="M395.322,109.546a.651.651,0,0,1-.46-1.111l3.01-3.01-3.01-3.01a.651.651,0,0,1,.92-.92l3.469,3.469a.651.651,0,0,1,0,.92l-3.469,3.469a.647.647,0,0,1-.461.192Zm0,0" transform="translate(-378.87 -97.267)" fill="#fff" />
              </g>
          </svg> Login
        </button>
      @endauth
    </div>
  </div>
</div>
<!--Footer-->
<footer>
    <p> &copy;  <?= date('Y') ?> Biorev, All Rights Reserved. </p>
    <p>Designed &amp; Developed By <a href="https://biorev.com" target="_blank">Biorev</a></p>
</footer>
<!--Footer End-->
<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
<script>
  function onLoad() {
    gapi.load('auth2', function() {
      gapi.auth2.init();
    });
  }
  function signOut() {
    // Google SignOut
    if(sessionStorage.getItem('login') !='fb'){
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  }
    // Fb SignOut
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
      FB.logout(function(response) {
        // Person is now logged out
        console.log('Fb User signed out.');
        sessionStorage.removeItem("loggedIn");
        sessionStorage.removeItem("login");
      });
  }
  let openMenu = true;
  function openNav() {
      openMenu =! openMenu;
      if(openMenu){
        $(".sidemenu").addClass('sidebar-show');
        $(".tabs-box .nav-tabs .nav-item").addClass('tab-border-right');
        $("#nav-icon").addClass('open');
      }
      else{
        $(".sidemenu").removeClass('sidebar-show');
        $(".tabs-box .nav-tabs .nav-item").removeClass('tab-border-right');
        $("#nav-icon").removeClass('open');
      }
  }
  
</script>