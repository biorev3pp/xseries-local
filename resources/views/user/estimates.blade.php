@extends('layouts.user') 
    @section('content')
<div class="content-wrapper">
     <div class="row m-0">
        <div class="col-12 mb-3">
            <div class="row m-0">
                <div class="col-6 float-left">

                    <h1 class="h1">Estimates History</h1>
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header" id="not_show">
                <h3 class="permission">Estimations</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover"  width="100%" cellspacing="0">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>Buyer</th>
                           <th>Community</th>
                           <th>Home</th>
                           <th>Color Scheme</th>
                           <th>Total Price</th>
                           <th>Created On</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                      @foreach($estimates as $key => $estimate)
                        <tr>
                           <td>{{$key+1}}.</td>
                             <td>{{ ucwords($estimate->admins->name)}}</td>
                             <td>{{ ucwords($estimate->communities->name)}}</td>
                             <td>{{ isset($estimate->homes->title)?ucwords($estimate->homes->title):'not selected'}}</td>
                             <td>{{ isset($estimate->color_schemes->title)?ucwords($estimate->color_schemes->title):'not selected'}}</td>
                             <td>{{ isset($estimate->total_price)?ucwords($estimate->total_price):''}}</td>
                             <td>{{ isset($estimate->created_at)?date('M d, Y - H:i A', strtotime($estimate->created_at)):''}}</td>
                            <td>
                                <a href="{{route('detail-estimates',$estimate->id)}}" class="a1"><i class="fas fa-info-circle"></i></a>
                            </td>
                        </tr>
                        @endforeach
                       
                     </tbody>


                  </table>
                </div> 
          </div>
        </div>
  </div>
</div>
        @endsection
