<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header expanded">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-lg-none mr-auto">
                    <a class="nav-link nav-menu-main menu-toggle hidden-xs waves-effect waves-dark is-active" href="#"><i class="ft-menu font-large-1"></i></a>
                </li>

                <li class="nav-item mr-auto">
                    <a class="navbar-brand waves-effect waves-dark" href="{{url('/')}}">
                        <img class="brand-logo" alt="Biorev" src="{{asset('cms/img/logo_circle.png')}}" />
                        <h3 class="brand-text">Biorev</h3>
                    </a>
                </li>

                <li class="nav-item d-none d-lg-block nav-toggle">
                    <a class="nav-link modern-nav-toggle pr-0 waves-effect waves-dark" data-toggle="collapse"><i class="toggle-icon font-medium-3 white ft-toggle-right" data-ticon="ft-toggle-right"></i></a>
                </li>

                <li class="nav-item d-lg-none">
                    <a class="nav-link open-navbar-container waves-effect waves-dark" data-toggle="collapse" data-target="#navbar-mobile"><i class="material-icons mt-1">more_vert</i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div
    class="main-menu material-menu menu-fixed menu-dark menu-accordion menu-shadow expanded"
    data-scroll-to-active="true"
    style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"
>
    <div class="main-menu-content ps" style="height: 100% !important; overflow-y: auto !important;">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" style="font-weight: 600;">
            <li class="navigation-header">
                <span data-i18n="nav.category.admin-panels">Admin Panels</span><i class="material-icons nav-menu-icon" data-toggle="tooltip" data-placement="right" data-original-title="Admin Panels">more_horiz</i>
            </li>
            @if(Auth::user()->admin_role_id !=4)
            <li class="nav-item {{ ($menu == 'dashboard')?'active':'' }}">
                <a href="{{ route('dashboard') }}" class="waves-effect waves-dark"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="">Dashboard</span></a>
            </li>
            <li class="nav-item {{ ($menu == 'uploads')?'active':'' }}">
                <a href="{{ route('uploads') }}" class="waves-effect waves-dark"><i class="material-icons">backup</i><span class="menu-title" data-i18n="">Uploads</span></a>
            </li>
            <li class="nav-item {{ ($menu == 'communities')?'active':'' }}">
                <a href="{{ route('communities') }}" class="waves-effect waves-dark"><i class="material-icons">call_merge</i><span class="menu-title" data-i18n="">Communities</span></a>
            </li>
            <!-- Nav Item - Utilities Collapse Menu -->

            <li class="nav-item {{ ($menu == 'homes')?'active':'' }}">
                <a href="{{ route('homes') }}" class="waves-effect waves-dark"><i class="material-icons">home</i><span class="menu-title" data-i18n="">Elevations</span></a>
            </li>
            <li class="nav-item {{ ($menu == 'floors')?'active':'' }}">
                <a href="{{ route('new_floors') }}" class="waves-effect waves-dark"><i class="material-icons">layers</i><span class="menu-title" data-i18n="">Floors</span></a>
            </li>
            <li class="nav-item {{ ($menu == 'leads')?'active':'' }}">
                <a href="{{ route('leads') }}" class="waves-effect waves-dark"><i class="material-icons">list_alt</i><span class="menu-title" data-i18n="">Buyer Details</span></a>
            </li>

            <li class="nav-item {{ ($menu == 'analytics')?'active':'' }}">
                <a href="{{ route('analytics') }}" class="waves-effect waves-dark"><i class="material-icons">bar_chart</i><span class="menu-title" data-i18n="">Analytics</span></a>
            </li>
            <li class="nav-item {{ ($menu == 'estimates')?'active':'' }}">
                <a href="{{ route('estimates') }}" class="waves-effect waves-dark"><i class="material-icons">account_balance</i><span class="menu-title" data-i18n="">Estimates</span></a>
            </li>
            <li class="nav-item {{ ($menu == 'accounts')?'active':'' }}">
                <a href="{{ route('accounts') }}" class="waves-effect waves-dark"><i class="material-icons">account_box</i><span class="menu-title" data-i18n="">Accounts</span></a>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item has-sub {{ ($menu == 'settings')?'active':'' }}">
                <a href="#" class="waves-effect waves-dark"><i class="material-icons">settings</i><span class="menu-title" data-i18n="">Settings</span></a>
                <ul class="menu-content" style="">
                    <li class="is-shown"><a class="waves-effect waves-dark" href="{{ route('settings') }}"><i></i><span data-i18n="eCommerce">Settings</span></a>
                    </li>
                    <li class="is-shown has-sub">
                        <a class="waves-effect waves-dark"><i></i><span data-i18n="Crypto">View Reports</span></a>
                        <ul class="menu-content">
                            <li class="is-shown"><a class="waves-effect waves-dark" href="{{ route('import-history') }}"><i></i><span data-i18n="eCommerce">Data</span></a>
                            </li>
                            <li class="is-shown"><a class="waves-effect waves-dark" href="{{ route('import-images-history') }}"><i></i><span data-i18n="eCommerce">Images</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="waves-effect waves-dark" onclick="logout()"><i class="material-icons">logout</i><span class="menu-title" data-i18n="">Logout</span></a>
            </li>
            @else
            <li class="nav-item {{ ($menu == 'dashboard')?'active':'' }}">
                <a href="{{ route('manager-dashboard') }}" class="waves-effect waves-dark"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="">Dashboard</span></a>
            </li>

            <li class="nav-item {{ ($menu == 'communities')?'active':'' }}">
                <a href="{{ route('manager-communities') }}" class="waves-effect waves-dark"><i class="material-icons">call_merge</i><span class="menu-title" data-i18n="">Communities</span></a>
            </li>
            <!-- Nav Item - Utilities Collapse Menu -->

            <li class="nav-item {{ ($menu == 'homes')?'active':'' }}">
                <a href="{{ route('manager-homes') }}" class="waves-effect waves-dark"><i class="material-icons">home</i><span class="menu-title" data-i18n="">Elevations</span></a>
            </li>
            <li class="nav-item {{ ($menu == 'floors')?'active':'' }}">
                <a href="{{ route('manager-new_floors') }}" class="waves-effect waves-dark"><i class="material-icons">layers</i><span class="menu-title" data-i18n="">Floors</span></a>
            </li>
            <li class="nav-item {{ ($menu == 'leads')?'active':'' }}">
                <a href="{{ route('manager-leads') }}" class="waves-effect waves-dark"><i class="material-icons">list_alt</i><span class="menu-title" data-i18n="">Buyer Details</span></a>
            </li>

            <li class="nav-item {{ ($menu == 'analytics')?'active':'' }}">
                <a href="{{ route('manager-analytics') }}" class="waves-effect waves-dark"><i class="material-icons">bar_chart</i><span class="menu-title" data-i18n="">Analytics</span></a>
            </li>
            <li class="nav-item {{ ($menu == 'estimates')?'active':'' }}">
                <a href="{{ route('manager-estimates') }}" class="waves-effect waves-dark"><i class="material-icons">account_balance</i><span class="menu-title" data-i18n="">Estimates</span></a>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a href="#" class="waves-effect waves-dark" onclick="managerLogout()"><i class="material-icons">logout</i><span class="menu-title" data-i18n="">Logout</span></a>
            </li>
            @endif
        </ul>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 264px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i> </span>
                </button>
            </div>

            <form id="logoutForm" action="" method="GET">
                <div class="modal-body">
                    <div class="row">
                        <h6 class="delete_heading">Are you sure you want to logout ?</h6>
                        <div class="clearfix"></div>
                        <div class="m-auto">
                            <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr">No</button>
                            <button type="submit" class="btn-orange t_b_s yesBtn" onclick="formSubmit()">Yes</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    function managerLogout() {
        var url = "{{ route('manager-logout') }}";
        $("#logoutForm").attr("action", url);
        $("#logout").modal("show");
    }
    function logout() {
        var url = "{{ route('logout') }}";
        $("#logoutForm").attr("action", url);
        $("#logout").modal("show");
    }

    function formSubmit() {
        $("#logoutForm").submit();
    }
</script>
