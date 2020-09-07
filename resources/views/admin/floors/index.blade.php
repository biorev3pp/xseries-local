@extends('layouts.admin')
    @section('content')
<style> 
.modal-header h5{margin: 0; font-size: 17px; font-weight: 600; }
.action-btn .btn{margin-right: 3px; margin-bottom: 3px;, padding:0.275rem 0.451rem;}
.action-btn .btn i{font-size: 13px}
.action-btn .btn:last-child{margin-right: 0;}
</style>    
<div class="container-fluid page-wrapper">
    <!-- Page Heading -->
    <div class="row mb-2 justify-content-between pl-1 pr-1 align-items-center">
        <div>
            <h1 class="a_dash m-0 p-0">{{$page_title}}</h1>
        </div>    
        <div class="filter-search-input w-100" style="max-width:450px;">
            <input type="text" class="form-control" name="skeyword" id="skeyword" placeholder="Search here" onkeyup="InPageFilter()" />
        </div>  
        <div class="mt-1 mt-sm-0">
            <div class="btn-group">
                <a href="{{url('admin/floors/create/')}}" style="position: relative;" href="javascript:void(0)" class="add_button position-relative"><i class="fas fa-plus position-relative"></i> Add New</a>
            </div>    
        </div>
    </div>

    <div class="clearfix"></div>

    @if (session('error'))
    <div class="alert alert-danger" id="msg">
        {{ session('error') }}
    </div>
    @endif @if(\Session::has('success'))

    <div class="alert alert-success alert-dismissible" style="margin-top: 18px;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
        <strong>Success!</strong> {{ \Session::get('success') }}
    </div>
    @endif

    <div class="clearfix"></div>

    @foreach($floors as $key => $floor) @if(count($floor['floor']) >= 1)

    <div class="design-home-heading mb-3 p-2">
        <h3 class="pb-1"><b>Home:</b> {{ $floor['home']->title }}</h3>
        <div class="card-wrapper pb-1">
            @foreach($floor['floor'] as $record)
            <div class="scrollable-cards mr-1">
                <div class="card mb-0 pl-1 pr-1" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4 col-4 card-image">
                            <img src="{{ asset('uploads/floors/'.$record['image'])}}" class="card-img" style="height:150px; object-fit: contain;" alt="..." />
                        </div>
                        <div class="col-md-8 d-flex align-items-center col-8">
                            <div class="card-body pl-1 h-auto py-0 pr-0">
                                <h5 class="card-title" style="margin-bottom:.5rem!important;font-size:17px;">{{$record->title}}</h5>
                                <div class="row mx-0 action-btn">
                                    @if($record->status_id == 2)
                                    <a
                                        class="btn btn-sm btn-outline-success floor_status show-tooltip"
                                        id="floor_{{$record->id}}"
                                        href="javascript:void(0);"
                                        floor_id="{{$record->id}}"
                                        floor_status="{{ $record->status_id }}"
                                        title="Active/Blocked"
                                    >
                                        <i class="fa fa-check"></i>
                                    </a>
                                    @else
                                    <a
                                        class="btn btn-sm btn-outline-danger floor_status"
                                        href="javascript:void(0);"
                                        id="floor_{{$record->id}}"
                                        href="javascript:void(0);"
                                        floor_id="{{$record->id}}"
                                        floor_status="{{ $record->status_id }}"
                                        title="Active/Blocked"
                                    >
                                        <i class="fa fa-ban"></i>
                                    </a>
                                    @endif
                                    <a class="btn btn-sm btn-outline-dark show-tooltip" title="Edit Floor" href="{{url('admin/floors/edit/'.base64_encode($record->id))}}"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-sm btn-outline-dark show-tooltip" title="Manage Floor Features" href="{{url('admin/homes/features/'.base64_encode($record->id))}}"><i class="fas fa-sliders-h"></i></a>
                                    <a href="#" class="btn btn-sm btn-outline-danger show-tooltip" title="Delete Floor" id="{{base64_encode($record->id)}}" onclick="deleteData({{$record->id}})" data-toggle="modal" data-target="#modal-delete">
                                        <i class="fa fa-trash-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif @endforeach

    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
            <form action="" id="deleteForm" method="get">
                <div class="modal-content" style="margin-left: 110px;">
                    <div class="modal-header">
                        <h5>Confirm Action</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-times"></i> </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <h6 class="delete_heading">Are you sure, you want to delete this record ?</h6>
                            <div class="clearfix"></div>
                            <div class="m-auto">
                                <input type="hidden" name="floor_id" id="floor_id" value="" />
                                <input type="hidden" name="floor_status" id="floor_status" value="" />

                                <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr">No</button>
                                <button type="submit" class="btn-orange t_b_s" onclick="formSubmit()">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Start Activate and Deactivate Popup -->
    <div class="modal fade" id="addFloor" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times"></i> </span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <h6 class="delete_heading">Do you want to update the status ?</h6>
                        <div class="clearfix"></div>
                        <div class="m-auto">
                            <input type="hidden" name="floor_id" id="floor_id" value="" />
                            <input type="hidden" name="floor_status" id="floor_status" value="" />

                            <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr">No</button>
                            <button type="button" class="btn-orange t_b_s yesBtn">Yes</button>
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
   $(document).ready(function(){
         setTimeout(function() {
            $('#msg').fadeOut('fast');
         }, 3000);
   });
  </script>
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
                    $('#floor_'+ $('#floor_id').val()).removeClass("btn-outline-danger");
                    $('#floor_'+ $('#floor_id').val()).addClass("btn-outline-success");
                    $('#floor_'+ $('#floor_id').val()).html('<i class="fa fa-check"></i>');
                } 
                else 
                {
                  $('#floor_'+ $('#floor_id').val()).removeClass("btn-outline-success");
                  $('#floor_'+ $('#floor_id').val()).addClass("btn-outline-danger");
                  $('#floor_'+ $('#floor_id').val()).html('<i class="fa fa-ban"></i>');
                }
                $('#addFloor').modal('hide');
            }
        });
    });
});
function InPageFilter() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("skeyword");
    filter = input.value.toUpperCase();
    sdiv = document.getElementsByClassName("design-home-heading");
    for (i = 0; i < sdiv.length; i++) {
        a = sdiv[i].getElementsByTagName("h3")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            sdiv[i].style.display = "";
        } else {
            sdiv[i].style.display = "none";
        }
    }
    }
</script>