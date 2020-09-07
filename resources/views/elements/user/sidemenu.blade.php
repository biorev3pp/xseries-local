<div class="main-menu-content ps ps--active-y">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
               
                 <li class="nav-item {{ ($menu == 'user_dashboard')?'active':'' }}"><a href="{{ route('user_dashboard') }}" class="waves-effect waves-dark"><i class="material-icons" style="line-height:27px">settings_input_svideo</i><span class="menu-title" data-i18n="">Profile</span></a>
                </li>
                <!-- Nav Item - Pages Collapse Menu -->
              
                <li class="nav-item "><a href="{{route('user-estimates')}}" class="waves-effect waves-dark"><i class="material-icons" style="line-height:27px">account_balance</i><span class="menu-title" data-i18n="">Estimates History</span></a>
                </li>
                @if(Session::has('home_id'))
                <li class="nav-item "><a href="{{route('plat')}}" style="text-overflow: unset;" class="waves-effect waves-dark"><i class="material-icons" style="line-height:27px">keyboard_backspace</i><span class="menu-title" data-i18n="">Back To Plat</span></a>
                </li>
                @endif
                @if(Session::has('home_id'))
                <li class="nav-item "><a href="{{route('xhome',['community_slug'=>$community->slug,'home_slug'=>$home->slug,'home_type_slug'=>($home_type)?$home_type->slug:''])}}" style="text-overflow: unset;" class="waves-effect waves-dark"><i class="material-icons" style="line-height:27px">keyboard_backspace</i><span class="menu-title" data-i18n="">Back To Home</span></a>
                </li>
                @endif
                @if(Session::has('features'))
                <li class="nav-item "><a href="{{route('xfloor',['community_slug'=>$community->slug,'home_slug'=>$home->slug,'home_type_slug'=>($home_type)?$home_type->slug:''])}}" style="text-overflow: unset;" class="waves-effect waves-dark"><i class="material-icons" style="line-height:27px">keyboard_backspace</i><span class="menu-title" data-i18n="">Back To Floor</span></a>
                </li>
                @endif
                <li class="nav-item "><a href="{{ route('welcome') }}" style="text-overflow: unset;" class="waves-effect waves-dark"><i class="material-icons" style="line-height:27px">keyboard_backspace</i><span class="menu-title" data-i18n="">Back To Search</span></a>
                </li>
                <li class="nav-item {{ ($menu == 'user_settings')?'active':'' }}"><a href="{{ route('user_showChangePasswordForm') }}" class="waves-effect waves-dark"><i class="material-icons" style="line-height:27px">settings</i><span class="menu-title" data-i18n="">Settings</span></a>
                </li>
                           
            </ul>

            <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-hidden="true">
                     <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5>Confirmation</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true"><i class="fa fa-times"></i>  </span>
                              </button>
                           </div>
                           
                              <form id="logoutForm" action="" method="GET">
                              <div class="modal-body">
                                 <div class="row">
                                    <h6 class="delete_heading" style="margin-bottom:0px;">Are you sure you want to logout ?
                                    </h6>
                                    <div class="clearfix"></div>
                                    <div class="m-auto">
                                       <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr" style="height:auto;"> No </button>
                                       <button type="submit" class="btn-orange t_b_s yesBtn" onclick="formSubmit()"> Yes</button>
                                    </div>
                                 </div>
                              </div>
                            </form>
                           
                        </div>
                     </div>
                  </div>

</div>
