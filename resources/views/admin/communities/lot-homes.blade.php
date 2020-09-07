@extends('layouts.admin')
@section('content')
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
<div class="container-fluid page-wrapper">
    <!-- Page Heading -->
    <div class=" row justify-content-between align-item-centers pl-1 pr-1 mb-2">
        <div>
            <h1 class="a_dash d-inline-block">Communities <small><span class="color-secondary">|</span></small></h1>
            <!-- <nav aria-label="breadcrumb" id="g_r_bar"> -->
            <div class="row breadcrumbs-top d-inline-block">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="{{ route('communities') }}"> {{ $communities->name }} </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Lot Specified Elevations</a></li>
                </ol>
            </div>
        </div>
        <div class="mt-1 mt-sm-0">
            <div class="btn-group">
                <a href="/admin/communities/view/{{$community_id}}" class="add_button"><i class="fa fa-arrow-left position-relative"></i> Back</a>
            </div>
        </div>
    </div>
    <!--breadcrumb-->


    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 inbox">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Elevations
                        <div class="float-right">
                            <a href="javascript:void(0)" style='top:10px;' class="add_button" data-toggle="modal" data-target="#add_home"><i style="top:0px;" class="fas fa-home "></i> Available Elevations</a>
                        </div>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Specifications</th>
                                    <th>Price</th>
                                    <th style="width: 80px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1 @endphp
                                @foreach($lots->Homes as $home)
                                <tr>
                                    <td><b>{{$home->title}}</b></td>
                                    <td><img width="100px" src="{{url('uploads/homes/'.$home->img)}}"></td>
                                    <td>{{$home->area}} Sq.ft | {{$home->bedroom}} Bedrooms | {{$home->bathroom}} Bathrooms</td>
                                    <td>${{$home->price}}</td>
                                    <td>
                                        <a id="{{base64_encode($home->id)}}" class="btn btn-danger text-white btn-sm home_delete" title="Delete Home">Remove </a>
                                    </td>
                                </tr>
                                @php $i++ @endphp
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <!---->
            </div>
        </div>

        <!-- Add New Home popup-->


        <div class="modal fade" id="add_home" tabindex="-1" role="dialog" aria-labelledby="add_homeLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="manageuserLabel">Available Elevations</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{route('save_lot_homes')}}" name="home" id="home" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="lot_id" value="{{$lot_id}}">
                            <div class="col-md-12 inbox">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Image</th>
                                                <th>Specifications</th>
                                                <th>Price</th>
                                                <th style="width: 80px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i=1 @endphp
                                            @foreach($homes_not_on_lot->Homes as $home)
                                            <tr>
                                                <th>{{$home->title}}</th>
                                                <td><img width="100px" src="{{url('uploads/homes/'.$home->img)}}"></td>
                                                <td>{{$home->area}} Sq.ft | {{$home->bedroom}} Bedrooms | {{$home->bathroom}} Bathrooms</td>
                                                <td>${{$home->price}}</td>
                                                <td>

                                                    <input class="form-control" name="assign[]" value="{{$home->id}}" type="checkbox">
                                                </td>
                                            </tr>
                                            @php $i++ @endphp
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group px-3 text-center">
                                <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr float-none">Close</button>
                                <button type="submit" class="btn-orange t_b_s yesBtn float-none">Save Connection</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
  <!-- delete modal -->
  <div class="modal fade" id="delete_home" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
            <form action="{{route('delete_lot_homes')}}" name="delete_home" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="lot_id" value="{{$lot_id}}">
                <input type="hidden" id="home_id" name="home_id" value="">
                <div class="modal-content" style="margin-left: 110px;">
                    <div class="modal-header">
                        <h5>Confirm Action</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-times"></i> </span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <h6 class="delete_heading">Are you sure, you want to disconnect this home?</h6>
                            <div class="clearfix"></div>
                            <div class="m-auto">
                                <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr">No</button>
                                <button type="submit" class="btn-orange t_b_s">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
  <!-- modal end -->

    </div>
</div>
</div>

    
@endsection
@push('scripts')
<script type="text/javascript">
$('.home_delete').click(function(){
  var id = $(this).attr('id');
  $('#home_id').val(id);
  //alert(home_id);
  $('#delete_home').modal('show');
});
</script>
@endpush
