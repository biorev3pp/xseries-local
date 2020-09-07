@extends('layouts.admin')
    @section('content')
<style>
    #estimate_delete_button, #assign_icon_button, #copy_button{
        color:inherit;
        transition:0.3s;
    }
    #estimate_delete_button:hover{
        color:white !important;
    }
    #assign_icon_button:hover{
        color:white !important;
    }
    #copy_button:hover{
        color:white !important;
    }
    
</style>
<div class="container-fluid page-wrapper">
   <div class="justify-content-between mb-2">
      <h1 class="a_dash d-inline-block">Estimates</h1>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Assign estimates to customer</li>
                </ol>
            </div>
        </div>
        <div class="btn-group float-md-right">
            <a href="{{ route('manager-estimates') }}" class="add_button"><i class="la la-arrow-circle-left"></i> Back</a>
        </div>
   </div>
   <div class="clearfix"></div>
   <div class="card mb-4">
      <div class="card-body">
         <div class="table-responsive" id="custom_table">
            @if(\Session::has('success'))  
            <div class="alert alert-success alert-dismissible" style="margin-top:18px;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                <strong>Success!</strong> {{ \Session::get('success') }}
            </div>
            @endif
                @if(\Session::has('error'))  
            <div class="alert alert-danger alert-dismissible" style="margin-top:18px;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                <strong>Failed!</strong> {{ \Session::get('error') }}
            </div>
            @endif
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 50px;">SNo</th>
                        <th>Community</th>
                        <th>Home</th></th>
                        <th>Color Scheme</th>
                        <th>Total Price</th>
                        <th>Added On</th>
                        <th style="width: 160px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($unassigned_estimates as $key=> $unassigned_estimate)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{isset($unassigned_estimate->communities->name) ? ucwords($unassigned_estimate->communities->name) : '' }}</td>
                        <td>{{isset($unassigned_estimate->homes->title) ? ucwords($unassigned_estimate->homes->title) : '' }}</td>
                        <td>{{isset($unassigned_estimate->color_schemes->title) ? $unassigned_estimate->color_schemes->title : 'Not Selected' }}</td>
                        <td>{{isset($unassigned_estimate->total_price) ? $unassigned_estimate->total_price : '' }}</td>
                        <td>{{isset($unassigned_estimate->created_at) ? $unassigned_estimate->created_at : '' }}</td>
                        <td>
                            <span>
                                <a id="copy_button" estimate_id="{{$unassigned_estimate->id}}" class="btn btn-outline-secondary text-secondary btn-sm"
                                data-toggle="modal" data-target="#copy_modal" title="Clone estimate"><i class="far fa-clone"></i></a>
                                <a id="assign_icon_button" assign_estimate_id="{{$unassigned_estimate->id}}" class="btn btn-outline-secondary text-secondary btn-sm assign_estimate"
                                data-toggle="modal" data-target="#customer_modal" title="Assign estimate"><i class="fas fa-user"></i></a>
                                <a id="estimate_delete_button" estimate_id="{{$unassigned_estimate->id}}" onclick="deleteData({{$unassigned_estimate->id}})" class="btn btn-outline-secondary text-secondary btn-sm estimate_delete"
                                title="Delete estimate"><i class="far fa-trash-alt"></i></a>
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<div class="modal fade p-0" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog modal-dialog-centered" role="document">
      <form action="{{route('manager-delete_estimate')}}" id="deleteForm" method="POST">
         <input type="hidden" name="estimate_id" id="estimate_id">
         @csrf
         <div class="modal-content">
            <div class="modal-header">
               <h5>Confirm Action</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true"><i class="fa fa-times"></i>  </span>
               </button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <h6 class="delete_heading">Are you sure, you want to delete this record ?
                  </h6>
                  <div class="clearfix"></div>
                     <div class="m-auto">
                        <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr"> No </button>
                        <button type="submit" class="btn-orange t_b_s" onclick="formSubmit()"> Yes</button>
                    </div>
               </div>
            </div>
         </div>
      </form>
   </div>
</div>
<!-- Customer Modal -->
<div class="modal fade bd-example-modal-lg" id="customer_modal" tabindex="-1" role="dialog" aria-labelledby="add_homeLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header dark-color">
                <h5 class="modal-title" id="manageuserLabel">List of customers to connect</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i>  </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive" id="custom_table">
                    <form method="post" action="{{Route('assign-estimate-customer')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="assign_estimate_id" name="estimate_id">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">SNo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    <th style="width: 160px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $key=> $customer)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{isset($customer->name) ? ucwords($customer->name) : '' }}</td>
                                    <td>{{isset($customer->email) ? $customer->email : '' }}</td>
                                    <td>{{isset($customer->mobile) ? $customer->mobile : '' }}</td>
                                    <td>
                                        <input class="form-control" style="width:20px; margin: 0 auto;" name="customer_id" value="{{$customer->id}}" type="radio">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="modal-footer justify-content-center">
                            <button type="button" data-dismiss="modal" style="top:6px;" class="btn-orange t_b_s d_gr float-none">Close</button>
                            <button type="submit" style="top:6px;" class="btn-orange t_b_s yesBtn float-none mb-0">Save</button>
                        </div>  
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Copy Modal -->
<div class="modal fade p-0" id="copy_modal" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog modal-dialog-centered" role="document">
      <form action="{{route('manager-copy_estimate')}}" id="copyForm" method="POST">
         <input type="hidden" name="id" id="copy_estimate_id">
         @csrf
         <div class="modal-content">
            <div class="modal-header">
               <h5>Confirm Action</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true"><i class="fa fa-times"></i>  </span>
               </button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <h6 class="delete_heading">Are you sure, you want to create a copy of this record ?
                  </h6>
                  <div class="clearfix"></div>
                     <div class="m-auto">
                        <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr"> No </button>
                        <button type="submit" class="btn-orange t_b_s"> Yes</button>
                    </div>
               </div>
            </div>
         </div>
      </form>
   </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
   $('.estimate_delete').click(function(){
        var id = $(this).attr('estimate_id');
        $('#estimate_id').val(id);
        $('#modal-delete').modal('show');
    });
    $('.assign_estimate').click(function(){
        var id = $(this).attr('assign_estimate_id');
        $('#assign_estimate_id').val(id);
        $('#customer_modal').modal('show');
    });
    $('#copy_button').click(function(){
        var id = $(this).attr('estimate_id');
        $('#copy_estimate_id').val(id);
        $('#copy_modal').modal('show');
    });
</script>
@endpush