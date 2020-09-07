<nav class="navbar navbar-expand navbar-light topbar mb-4 static-top dark-blue">
                  <!-- Sidebar Toggle (Topbar) -->
                  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                  <i class="fa fa-bars"></i>
                  </button>
                  <!-- Topbar Search -->
                  <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                     <div class="input-group">
                       <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                       <div class="input-group-append">
                         <button class="btn btn-primary" type="button">
                           <i class="fas fa-search fa-sm"></i>
                         </button>
                       </div>
                     </div>
                     </form>-->
                <!--<a href="{{url('/')}}" class="logo"><img src="{{asset('cms/img/logo.png')}}" /></a>-->
                <div class="text-center d-none d-md-inline">
   <button class="rounded-circle border-0 top_bar_m" id="sidebarToggle"><i class="fa fa-bars"></i></button>
</div>
                  <!-- Topbar Navbar -->
                  <ul class="navbar-nav ml-auto" style="margin-right: 8px;">
                     <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                     <!-- <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-search fa-fw"></i>
                        </a>
                        
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                          <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                              <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                  <i class="fas fa-search fa-sm"></i>
                                </button>
                              </div>
                            </div>
                          </form>
                        </div>
                        </li>-->
                     <!-- Nav Item - Alerts -->



                     <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fas fa-bell fa-fw"></i>
                           <!-- Counter - Alerts -->
                           <span class="badge badge-danger badge-counter">10</span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in d-none" aria-labelledby="alertsDropdown">
                           <h6 class="dropdown-header">
                              Alerts Center
                           </h6>
                           <a class="dropdown-item d-flex align-items-center" href="#">
                              <div class="mr-3">
                                 <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                 </div>
                              </div>
                              <div>
                                 <div class="small text-gray-500">December 12, 2019</div>
                                 <span class="font-weight-bold">A new monthly report is ready to download!</span>
                              </div>
                           </a>
                           <a class="dropdown-item d-flex align-items-center" href="#">
                              <div class="mr-3">
                                 <div class="icon-circle bg-success">
                                    <i class="fas fa-donate text-white"></i>
                                 </div>
                              </div>
                              <div>
                                 <div class="small text-gray-500">December 7, 2019</div>
                                 $290.29 has been deposited into your account!
                              </div>
                           </a>
                           <a class="dropdown-item d-flex align-items-center" href="#">
                              <div class="mr-3">
                                 <div class="icon-circle bg-warning">
                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                 </div>
                              </div>
                              <div>
                                 <div class="small text-gray-500">December 2, 2019</div>
                                 Spending Alert: We've noticed unusually high spending for your account.
                              </div>
                           </a>
                           <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                        </div>
                     </li>
                     <!-- Nav Item - User Information -->
                     <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="log" role="button" onclick="logout()" data-toggle="modal" data-target="#logout">
                           <i class="fas fa-fw fa-sign-out-alt" aria-hidden="true" style="margin-top: 2px;"></i>Logout</a>

                           


                    <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-hidden="true">
                     <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
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
                                    <h6 class="delete_heading">Are you sure you want to logout ?
                                    </h6>
                                    <div class="clearfix"></div>
                                    <div class="m-auto">
                                       <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr"> No </button>
                                       <button type="submit" class="btn-orange t_b_s yesBtn" onclick="formSubmit()"> Yes</button>
                                    </div>
                                 </div>
                              </div>
                            </form>
                           
                        </div>
                     </div>
                  </div>

                  <script type="text/javascript">
                       function logout()
                       {
                           var url = "{{ route('logout') }}";
                           $("#logoutForm").attr('action', url);
                       }
                  
                       function formSubmit()
                       {
                           $("#logoutForm").submit();
                       }
                  </script>
                           
                        </a>
                        
                     </li>
                  </ul>
               </nav>



               