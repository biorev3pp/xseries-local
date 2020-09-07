@extends('layouts.admin')
   @section('content')

   <div class="container-fluid">

      <div class="d-sm-flex align-items-center justify-content-between mb-2">
         <h1 class="a_dash">Viewer Dashboard</h1>
      </div>

      <div id="crypto-stats-3" class="row">
         
         <div class="col-xl-3 col-lg-6 col-6"> 
            <div class="card pull-up">
               <div class="card-content">
                  <a href="{{ route('manager-communities') }}">
                     <div class="card-body">
                        <div class="media d-flex">
                              <div class="media-body text-left">
                                 <h3 class="info">{{count($communities)}}</h3>
                                 <h6>Communities</h6>
                              </div>
                              <div>
                                 <i class="icon-user info font-large-2 float-right"></i>
                              </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                           <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                     </div>
                  </a>
               </div>
            </div>
         </div>

         <div class="col-xl-3 col-lg-6 col-6"> 
            <div class="card pull-up">
               <div class="card-content">
                  <a href="{{ route('manager-homes') }}">
                     <div class="card-body">
                        <div class="media d-flex">
                              <div class="media-body text-left">
                                 <h3 class="warning">{{count($homes)}}</h3> <h6>Elevations</h6>
                              </div>
                              <div>
                                 <i class="icon-home warning font-large-2 float-right"></i>
                              </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                           <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                     </div>
                  </a>
               </div>
            </div>
         </div>

         <div class="col-xl-3 col-lg-6 col-6"> 
            <div class="card pull-up">
               <div class="card-content">
                  <a href="{{ route('manager-leads') }}">
                     <div class="card-body">
                        <div class="media d-flex">
                              <div class="media-body text-left">
                                 <h3 class="success">{{count($leads)}}</h3> Buyer Details<h6></h6>
                              </div>
                              <div>
                                 <i class="icon-home success font-large-2 float-right"></i>
                              </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                           <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                     </div>
                  </a>
               </div>
            </div>
         </div>

         <div class="col-xl-3 col-lg-6 col-6"> 
            <div class="card pull-up">
               <div class="card-content">
                  <a href="{{ route('manager-analytics') }}">
                     <div class="card-body">
                        <div class="media d-flex">
                              <div class="media-body text-left">
                                 <h3 class="danger">5</h3> Analytics<h6></h6>
                              </div>
                              <div>
                                 <i class="icon-home danger font-large-2 float-right"></i>
                              </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                           <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                     </div>
                  </a>
               </div>
            </div>
         </div>
      </div>

      
      <div class="card mb-4">
         <div class="card-body">
            <div class="table-responsive" id="custom_table">
               @if(\Session::has('success'))
                  
                  <div class="alert alert-success alert-dismissible" style="margin-top:18px;">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                      <strong>Success!</strong> {{ \Session::get('success') }}
                  </div>
               @endif
               <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                     <tr>
                        <th style="width:40px">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Status</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($leads as $i => $user)
                     <tr>
                        <td>{{$i+1}}.</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->mobile}}</td>
                        <td>
                        @if($user->status_id == 2)
                           <span class="a1 green">Active</span>
                           @else
                           <span class="a1 red">Deactive</span>
                           @endif
                        </td>
                     </tr>
                     @empty
                     <tr>
                        <td colspan="3">No users added yet</td>
                     </tr>
                     @endforelse
                  </tbody>
               </table>
            </div>
         </div>
      </div>

   </div>
@endsection