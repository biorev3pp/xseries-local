@extends('layouts.admin')
@section('content')
<div class="container-fluid page-wrapper">
      <!-- Page Heading -->
      <div class="row mb-2 justify-content-between pl-1 pr-1 align-items-center">
         <div>
            <h1 class="a_dash p-0 m-0">Communities</h1>
         </div>
         <div class="filter-search-input w-100" style="max-width:450px;">
            <input type="text" class="form-control" name="skeyword" id="skeyword" placeholder="Search here" onkeyup="InPageFilter()">
        </div>
         <div class="mt-1 mt-sm-0">
            <div class="btn-group">
               <a style="position:relative;" href="{{route('add-community')}}" class="add_button"><i style="top:0;" class="fas fa-plus"></i> Add New</a>
            </div>
         </div>
      </div>
     @if(\Session::has('message'))
        <div class="alert alert-success alert-dismissible" style="margin-top:18px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <strong>Success!</strong> {{ \Session::get('message') }}
        </div>
      @endif
     <div id="cfullrecords">
      <div class="row mb-4">

        @foreach($communities as $key => $community)
        <div class="col-xl-4 col-lg-6 col-sm-6 float-left c_search" id="custom_width">
             <div class="mang_cate">
                <div class="p-1 img-fwrap">
                   <img src="{{asset('/uploads/'.$community->banner) }}">
                </div>
                <div>
                   <div class="h_DIV">
                      <p>{{ $community->name }}</p>
                      <div class="e-d-d">
                         <span><a class="a1" title="Edit" href="/admin/communities/edit/{{ base64_encode($community->id)}}"><i class="fa fa-edit"></i>Edit</a></span>
                         <span><a class="a1" title="Community Homes" href="{{route('communities_homes',['id'=>base64_encode($community->id)])}}"><i class="fas fa-home"></i>Elevations</a></span>

                         @if($community->status_id == 2)
                         <span><a class="a1 green change_status" href="javascript:void(0);" id="com_{{$community->id}}" community_id="{{$community->id}}" status_id="{{ $community->status_id }}"><i class="fa fa-check"></i><strong>Active</strong></a></span>
                         @else
                         <span><a class="a1 red change_status text-success" href="javascript:void(0);" id="com_{{$community->id}}" community_id="{{$community->id}}" status_id="{{ $community->status_id }}"><i class="fa fa-ban"></i><strong>Deactive</strong></a></span>
                         @endif

                      </div>
                      <a href="/admin/communities/view/{{ base64_encode($community->id)}}"><button type="submit" class="btn-orange">Manage</button></a>
                   </div>
                </div>
             </div>
        </div>
        @endforeach
      </div>
      </div>
        <div class="modal fade" id="addStatus" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-hidden="true">
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

                                        <input type="hidden" name="community" id="community" value="">
                                        <input type="hidden" name="status" id="status" value="">

                                       <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr"> No </button>
                                       <button type="button" class="btn-orange t_b_s yesBtn"> Yes</button>
                                    </div>
                                 </div>
                              </div>

                           
                        </div>
                     </div>
                  </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$(document).ready(function()
{
    $('.change_status').click(function()
    {
        $('#community').val($(this).attr('community_id'));
        $('#status').val($(this).attr('status_id'));
        $('#addStatus').modal('show');
       
    });

    $('.yesBtn').click(function()
    {
        //alert("Test");
        $.ajax(
        {
            type: 'POST',
            url: '/admin/communities/changeStatus/'+$('#community').val(),
            data: {'community': $('#community').val() ,'status': $('#status').val()},
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            //contentType: 'json',
            success: function (response) 
            {
                if(response == 2) 
                {
                    $('#com_'+ $('#community').val()).html('<span class="green" style="margin-left: 0px;"><i class="fa fa-check"></i><strong>Active</strong></span>');
                } 
                else 
                {
                    $('#com_'+ $('#community').val()).html('<span class="red" style="margin-left: 2px;"><i class="fa fa-ban"></i><strong>Deactive</span></strong>');
                }
                $('#addStatus').modal('hide');
            }
        });
    });
});

    function InPageFilter() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("skeyword");
    filter = input.value.toUpperCase();
    sdiv = document.getElementById("cfullrecords");
    rspan = sdiv.getElementsByClassName("c_search");
    for (i = 0; i < rspan.length; i++) {
        a = rspan[i].getElementsByTagName("p")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            rspan[i].style.display = "";
        } else {
            rspan[i].style.display = "none";
        }
    }
}

</script>
</div>
@endsection