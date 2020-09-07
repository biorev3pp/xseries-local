<style>
.btn-secondary2 {
    margin: 0;
    box-shadow: none;
    border-radius: 0px !important;
    width: 160px;
    height: 40px;
    border-radius: 2px;
    background-color: #9fcc3a;
    padding: 0;
    font-size: 14px;
    line-height: 1;
    color: #fff;
    text-align: center;
    font-weight: 500;
    letter-spacing: 2px;
    text-transform: uppercase;
    border: none;
    cursor: pointer;
    transition: 0.5s ease-in-out;
}
.btn-secondary2:hover {
    background-color: #5d991f !important;
    color: #fff;
    box-shadow: none;
}
.dropdown-toggle::after {
    display: inline-block;
    margin: 0;
    margin-left: .255em;
    vertical-align: 0.255em;
    content: "" !important;
    border-top: .3em solid !important;
    border-right: .3em solid transparent !important;
    border-bottom: 0 !important;
    border-left: .3em solid transparent !important;
    font-size: 14px;
    padding: 0;
}
#header-account-button a.dropdown-item {
    transition: .5s ease-in-out;
    font-size: 15px;
    color: #323232;
    font-weight: 300;
    font-family:"Poppins",sans-serif;

}
#header-account-button .dropdown-item {
    height: 40px;
    padding: 9px 18px;
}
#header-account-button .show>a.dropdown-item:hover {
    color: #fff;
    background-color: #9fcc3a;
    padding-left: 30px !important;
}
#header-account-button .show>.dropdown-menu{
    padding: 0;
    margin: .125rem 0 0;
    font-size: 1rem;
    color: #212529;
    text-align: left;
    border: 1px solid rgba(159, 204, 58, 1.15);
    border-radius: 0;
    width: auto;
    right: 0;
}
.dropdown i{
  margin-right: 0.1rem;
}
@media (max-width: 575px){
.btn-secondary2 {
    width: 113px;
    height: 32px;
    padding: 7px;
    font-size: 11px;
    letter-spacing: 1px;
    margin-top: 0px;
}
}
</style>
<nav class="navbar navbar-expand navbar-light topbar static-top dark-blue w-100" style="position:fixed; left:0; height:70px; z-index:11; display:flex; justify-content: space-between;">
  <div>
    <!-- Sidebar Toggle (Topbar) -->
    <div id="nav-icon" onclick="openNav()">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <a href="{{url('/')}}" class="logo"><img src="{{asset('images/logo2.png')}}" style="height:45px;" /></a>
  </div>
  <!-- Topbar Navbar -->
  <div id="header-account-button">
    @auth
    <div class="dropdown">
        <button class="btn btn-secondary2 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-people m-0"></i> Account</button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="{{Route('user_dashboard')}}"><i class="icon-user"></i> Profile</a>
        <a class="dropdown-item" href="{{ Route('user_logout') }}" onclick="signOut()"><i class="icon-logout"></i> Logout</a>
        </div>
    </div>
    @else
    <button class="green-button" type="button" data-toggle="modal" data-target="#exampleModal">
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
</nav>
<script>
let openMenu = false;
function openNav() {
    openMenu =! openMenu;
    if(openMenu){
      $("#accordionSidebar").addClass('show-sidebar');
      // $("#content-wrapper").addClass('add-padding');
      $(".sidebar-brand-icon").addClass('opacity1');
      $("#nav-icon").addClass('open');
    }
    else{
      $("#accordionSidebar").removeClass('show-sidebar');
      // $("#content-wrapper").removeClass('add-padding');
      $(".sidebar-brand-icon").removeClass('opacity1');
      $("#nav-icon").removeClass('open');
    }
}
</script>