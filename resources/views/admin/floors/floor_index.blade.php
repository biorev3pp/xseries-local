@extends('layouts.admin')
    @section('content')
    <div class="container-fluid">
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="a_dash">{{$page_title}}</h1>
      </div>
      <!--breadcrumb-->
      <nav aria-label="breadcrumb" id="g_r_bar">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('new_floors') }}"><i class="fas fa-fw fa-table"></i>{{$page_title}}</a></li>
            <li><a href="{{url('admin/floors/create/')}}" class="add_button"><i class="fas fa-plus"></i>Add New Floor</a></li>
         </ol>
      </nav>

      <div class="clearfix"></div>

      @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

      <div class="clearfix"></div>

      @foreach($floors as $key => $floor) @if(count($floor['floor']) >= 1)
      <nav aria-label="breadcrumb" id="g_r_bar">
         <ol class="breadcrumb">
            <li class="breadcrumb-item">Home:- {{ $floor['home']->title }}</li>
         </ol>
      </nav>
      <div class="row">
         @foreach($floor['floor'] as $record)
         <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6" id="custom_width">
               <div class="mang_cate">
                  <div class="col-lg-5 col-md-12 col-sm-5 float-left">
                     <img src="{{ asset('uploads/floors/'.$record['image'])}}">
                  </div>
                  <div class="col-lg-7 col-md-12 col-sm-5 float-left">
                     <div class="h_DIV">
                        <p>{{$record->title}}</p>
                        <div class="e-d-d">
                           <!-- <span><a class="a1" href="{{url('admin/homes/features/'.base64_encode($record->id))}}"><i class="fas fa-pen"></i>Features</a></span>
                           <br> -->
                           <span><a class="a1" href="{{url('admin/floors/edit/'.base64_encode($record->id))}}"><i class="fa fa-edit"></i>Edit</a>

                           <span><a href="#" class="a1" id="{{base64_encode($record->id)}}" onclick="deleteData({{$record->id}})" data-toggle="modal" data-target="#modal-delete"><i class="fas fa-trash"></i> Delete</a></span> 

                           <br>

                           @if($record->status == 2)
                           <span><a class="a1 green floor_status" id="floor_{{$record->id}}" href="javascript:void(0);" floor_id="{{$record->id}}" floor_status="{{ $record->status }}" style="margin-left: 0px;"><i class="fa fa-check"></i><strong>Active</strong></a></span>
                           @else
                           <span><a class="a1 red floor_status" href="javascript:void(0);" id="floor_{{$record->id}}" href="javascript:void(0);" floor_id="{{$record->id}}" style="margin-left: 2px;" floor_status="{{ $record->status }}"><i class="fa fa-ban"></i><strong>Deactive</strong></a></span>
                           @endif

                        </div>
                        
                        <a href="{{url('admin/homes/features/'.base64_encode($record->id))}}"><button type="submit" class="btn-orange t_b_s">Manage Features</button></a>
                     </div>
                  </div>
               </div>
         </div>
         @endforeach
</div>
         @endif
      @endforeach

        <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-hidden="true">
                     <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
                      <form action="" id="deleteForm" method="get">
                        <div class="modal-content" style="margin-left: 110px;">
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

                                        <input type="hidden" name="floor_id" id="floor_id" value="">
                                        <input type="hidden" name="floor_status" id="floor_status" value="">

                                       <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr"> No </button>
                                       <button type="submit" class="btn-orange t_b_s" onclick="formSubmit()"> Yes</button>
                                    </div>
                                 </div>
                              </div>

                           
                        </div>
                      </form>
                     </div>
                  </div>

        

                            <script type="text/javascript">
                               function deleteData(id)
                               {
                                   var id = id;
                                   var url = '{{ action("Admin\FloorController@delete", ":id") }}';
                                   url = url.replace(':id', id);
                                   $("#deleteForm").attr('action', url);
                               }
                          
                               function formSubmit()
                               {
                                   $("#deleteForm").submit();
                               }
                          </script>

         <!-- Start Activate and Deactivate Popup -->
                  <div class="modal fade" id="addFloor" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-hidden="true">
                     <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5>Confirmation</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true"><i class="fa fa-times"></i>  </span>
                              </button>
                           </div>
                           
                              
                              <div class="modal-body">
                                 <div class="row">
                                    <h6 class="delete_heading">Do you want to update the status ?
                                    </h6>
                                    <div class="clearfix"></div>
                                    <div class="m-auto">

                                        <input type="hidden" name="floor_id" id="floor_id" value="">
                                        <input type="hidden" name="floor_status" id="floor_status" value="">

                                       <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr"> No </button>
                                       <button type="button" class="btn-orange t_b_s yesBtn"> Yes</button>
                                    </div>
                                 </div>
                              </div>

                           
                        </div>
                     </div>
                  </div>

                  <!-- End Popup -->

    </div>
    
      
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$(document).ready(function()
{
    $('.floor_status').click(function()
    {
        $('#floor_id').val($(this).attr('floor_id'));
        $('#floor_status').val($(this).attr('floor_status'));
        $('#addFloor').modal('show');  
    });
    $('.yesBtn').click(function()
    {
        $.ajax(
        {
            type: 'POST',
            url: '/api/floorStatus/'+ $('#floor_id').val(),
            data: {'floor_id': $('#floor_id').val() ,'floor_status': $('#floor_status').val()},
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            /*contentType: 'json',*/
            success: function (response) 
            {
                console.log(response);
                if(response == 2) 
                {
                    $('#floor_'+ $('#floor_id').val()).html('<span class="green" style="margin-left: 0px;"><i class="fa fa-check"></i><strong>Active</strong></span>');
                } 
                else 
                {
                    $('#floor_'+ $('#floor_id').val()).html('<span class="red" style="margin-left: 2px;"><i class="fa fa-ban"></i><strong>Deactive</span></strong>');
                }
                $('#addFloor').modal('hide');
            }
        });
    });
});
</script>