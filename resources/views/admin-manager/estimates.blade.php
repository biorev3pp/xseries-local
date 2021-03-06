@extends('layouts.admin')
    @section('content')

<div class="container-fluid page-wrapper">
   <div class="justify-content-between mb-2">
      <h1 class="a_dash d-inline-block">Estimates</h1>
      <div class="btn-group float-md-right">
      <form target="_blank" method="post" action="{{Route('manager-export-estimates')}}">
         @csrf
         <input type="hidden" name="estimate_ids" value="" id="estimate_ids">
         <button id="exportButton" type="submit" class="btn-orange t_b_s">
         <i class="la la-file-excel-o" style="position: relative;top: 2px;margin-right: 0;"></i> Export</a>
      </form>
      </div>
   </div>
   <div class="card" id="no_sh">
      <div class="card-body text-right">
         <a href="{{url('/')}}">
            <button type="button" class="btn btn-dark btn-min-width mr-1 waves-effect waves-light">
               <i style="font-size:16px; vertical-align:-3.8px;" class="material-icons">account_balance</i> Generate Estimate
            </button>
         </a>
         <a href="{{Route('assign_estimates')}}">
            <button type="button" class="btn btn-dark btn-min-width mr-1 waves-effect waves-light">
               <i style="font-size:16px; vertical-align:-3.8px;" class="material-icons">account_balance</i> Assign Estimates
            </button>
         </a>
      </div>
   </div>
   <div class="clearfix"></div>
   <div class="card mb-4">
      <div class="card-body">
      <label class="">
         <input type="checkbox" style="position: relative;top: 1.5px;" name="sample" class="select-all"/> Select All
      </label>
         <div class="table-responsive" id="custom_table">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
               <thead>
                  <tr>
                     <th>S.No.</th>
                     <th>Buyer</th>
                     <th>Email</th>
                     <th>Community</th>
                     <th>Home</th></th>
                     <th>Color Scheme</th>
                     <th>Total Price</th>
                     <th>Generated By</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($estimates as $key => $estimate)
                  <tr>
                     <td><input type="checkbox" class="estimate_checkbox" style="margin-right:3px; position:relative; top:1.5px;" value="{{$estimate->id}}"/>{{$key+1}}.</td>
                        <td class="name">{{ isset($estimate->admins->name)?ucwords($estimate->admins->name):''}}</td>
                        <td class="email">{{ isset($estimate->admins->email)?$estimate->admins->email:''}}</td>
                        <td>{{ isset($estimate->communities->name)?ucwords($estimate->communities->name):''}}</td>
                        <td>{{ isset($estimate->homes->title)?ucwords($estimate->homes->title):'not selected'}}</td>
                        <td>{{ isset($estimate->color_schemes->title)?ucwords($estimate->color_schemes->title):'not selected'}}</td>
                        <td>{{ isset($estimate->total_price)?ucwords($estimate->total_price):''}}</td>
                        <td>{{ $estimate->admins->id == $estimate->references->id ? 'Self' :ucwords($estimate->references->name)}}</td>
                        <td style="padding:0">
                        <span><a href="{{route('manager-single-estimates',$estimate->id)}}" class="a1"><i class="fas fa-info-circle"></i></a></span>
                        <span><a href="javascript:void(0)" class="a1 mail-button" 
                        estimate_id="{{$estimate->id}}" customer_id="{{$estimate->admins->id}}">
                        <i class="fas fa-envelope-open-text"></i></a></span>
                        <span><a href="#" class="a1" onclick="deleteData({{$estimate->id}})" data-toggle="modal" data-target="#modal-delete" id="{{$estimate->id}}"><i class="fas fa-trash"></i></a></span>
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
<!-- Mail Modal -->
<div class="modal fade" id="modal-mail" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog modal-dialog-centered" role="document">
      <form style="width:100%;">
         <div class="modal-content">
            <div class="modal-header">
               <h5>Send Mail</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true"><i class="fa fa-times"></i></span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <input class="form-control" type="email" id="email" value="" placeholder="Enter your email">
               </div>
               <button class="btn btn-success" id="send_mail"type="button"><i class="fas fa-paper-plane"></i> Send</button>
               <button id="loading-button" style="display:none;" class="btn btn-success text-white" type="button" disabled>
                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  Sending...
               </button>
            </div>
         </div>
      </form>
   </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
   function deleteData(id)
   {  
   $("#deleteForm #estimate_id").val(id);
   }
   var customer_name;
   var email;
   var customer_id;
   var estimate_id;
   $(".mail-button").click(function(){
      $("#loading-button").hide();
      $("#send_mail").show();
      customer_name = $(this).parent().parent().parent().find("td[class='name']").text();
      email = $(this).parent().parent().parent().find("td[class='email']").text();
      customer_id = $(this).attr('customer_id');
      estimate_id = $(this).attr('estimate_id');
      $("#modal-mail").modal('show');
      $("#email").val(email);
   });
   $('#send_mail').click(()=>{
         $("#send_mail").fadeOut(function(){
            $("#loading-button").fadeIn();
         })
         var email = $('#email').val();
         $.ajax({
            type       :'post',
            url        :'/api/email/estimate',
            headers    :{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data       :{'customer_id': customer_id, 'estimate_id':estimate_id, 'name': customer_name,
                           'email': email},
            success    : (result) => {
               $("#modal-mail").modal('hide');
               toastr.success('Mail Sent Succesfully');
            }            

         });
      });
</script>
@endpush
@push('scripts')
<script>
$(".select-all").click(function(){
   $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
});
$('#exportButton').click(function(){
var checked_boxes = $("tbody").find("input[type=checkbox]:checked");
    var estimate_ids = [];
        $.each(checked_boxes,function(key){
         estimate_ids.push($(this).val());  
        });
      $("#estimate_ids").val(estimate_ids);
      $("input[type=checkbox]:checked").prop('checked',false);
   });
</script>
@endpush