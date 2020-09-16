@extends('layouts.admin')
@section('content')
<link rel="stylesheet" href="{{asset('Xseries-new-ui/dropzone/dropzone.css')}}">
<link rel="stylesheet" href="{{asset('Xseries-new-ui/dropzone/basic.css')}}">
<link rel="stylesheet" href="{{asset('cms/css/gallery.css')}}">
<style>

#upload_type{
    max-width:200px;
    width:100%;
    background-color: #fff;
    border: 1px solid #ccc;
    cursor: pointer;
}
#list{
    height:calc(100vh - 230px);
    overflow-x: hidden;
    overflow-y: auto;
}
.img-wrapper:hover{
  background:rgba(0,0,0,0.5);
  cursor:pointer;
}
</style>
<script src="{{asset('Xseries-new-ui/dropzone/dropzone.js')}}"></script>
<div class="container-fluid page-wrapper">
    <div class="row mb-2 justify-content-between pl-1 pr-1 align-items-center">
      <div>
        <h1 class="a_dash p-0 m-0">Unmapped</h1>
      </div>
      <div class="mt-1 mt-sm-0">
        <div class="btn-group">
            <a href="{{ route('uploads') }}" class="add_button position-relative"><i class="fas fa-arrow-left position-relative"></i> Back</a>
        </div>
      </div>  
    </div>
    <div class="card d-inline-block w-100 mt-1" id="list">
        <div class="d-flex justify-content-end" style="padding:1rem 2rem 0 0;align-items:center;">
         <button id="clean"style="font-weight:600; margin-right:5px;" type="button" class="add_button btn btn-dark btn-min-width waves-effect waves-light">Clean All For Selected Filter</button>
        <select class="form-control" onchange="retriveImages(this.value)" name="upload_type" id="upload_type">
            <option value="" selected>No options selected</option>
            <option value="communities">Communities</option>
            <option value="elevations">Elevations</option>
            <option value="floors">Floors</option>
            <option value="features">Floors-Features</option>
        </select>
        </div>
        <div class="row grid-hover p-1">
        </div> 
    </div>
</div>
<!-- Delete modal -->
<div class="modal fade bd-example-modal-xl_1" id="image-delete" tabindex="-1" role="dialog" aria-labelledby="add_design_groupLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i> </span>
                </button>
            </div>
            <form method="post" action="javascript:void(0)" class="m-0" name="deleteImgForm" id="deleteImgForm">
                @csrf
                <input type="hidden" id="imageName" name="image" value="">
                <input type="hidden" id="dirName" name="dir" value="">
                <div class="modal-body">
                    <div class="row">
                        <h6 class="delete_heading">Are you sure you want to delete this Image?</h6>
                        <div class="clearfix"></div>
                        <div class="m-auto">
                            <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr">No</button>
                            <button type="submit" class="btn-orange t_b_s">Yes</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-xl_1" id="clean-dir" tabindex="-1" role="dialog" aria-labelledby="add_design_groupLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i> </span>
                </button>
            </div>
            <form method="post" action="javascript:void(0)" class="m-0" name="cleanDirForm" id="cleanDirForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <h6 class="delete_heading">Are you sure you want to perform this action? This will delete all the images.</h6>
                        <div class="clearfix"></div>
                        <div class="m-auto">
                            <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr">No</button>
                            <button type="submit" class="btn-orange t_b_s">Yes</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
    retriveImages();
    function retriveImages(){
        $.ajax({
            type:'post',
            url:'/api/get/unmapped/images',
            data:{'type':arguments[0]},
            headers:{
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
            success: function(res){
                var list='';
                $.each(res.community,function(key,val){
                    if(val)
                    list+=`<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                                <figure class="effect-romeo" style="height:150px;">
                                    <img src="{{asset('uploads/${val}')}}" class="img-fluid">
                                    <span id="uploaded_image"></span>
                                    <figcaption>
                                        <p><a href="javascript:void(0)" onclick="deleteImage('','${val}')" class="text-white"><i class="fa fa-trash"></i> </a></p>
                                    </figcaption>
                                </figure>
                                <span>${val}</span>
                            </div>`;
            })
            $.each(res.home,function(key,val){
                if(val)
                list+=`<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                            <figure class="effect-romeo" style="height:150px;">
                                <img src="{{asset('uploads/homes/${val}')}}" class="img-fluid">
                                <span id="uploaded_image"></span>
                                <figcaption>
                                    <p><a href="javascript:void(0)" onclick="deleteImage('homes','${val}')" class="text-white"><i class="fa fa-trash"></i> </a></p>
                                </figcaption>
                            </figure>
                            <span>${val}</span>
                        </div>`;
            });
            $.each(res.floor,function(key,val){
                if(val)
                list+=`<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                            <figure class="effect-romeo" style="height:150px;">
                                <img src="{{asset('uploads/floors/${val}')}}" class="img-fluid">
                                <span id="uploaded_image"></span>
                                <figcaption>
                                    <p><a href="javascript:void(0)" onclick="deleteImage('floors','${val}')" class="text-white"><i class="fa fa-trash"></i> </a></p>
                                </figcaption>
                            </figure>
                            <span>${val}</span>
                        </div>`;
            });
            $.each(res.feature,function(key,val){
                if(val)
                list+=`<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                            <figure class="effect-romeo" style="height:150px;">
                                <img src="{{asset('uploads/features/${val}')}}" class="img-fluid">
                                <span id="uploaded_image"></span>
                                <figcaption>
                                    <p><a href="javascript:void(0)" onclick="deleteImage('features','${val}')" class="text-white"><i class="fa fa-trash"></i> </a></p>
                                </figcaption>
                            </figure>
                            <span>${val}</span>
                        </div>`;
            });
            $('#list .row').html(list);
            }
        })
  }
  function deleteImage(dir,val){
      $('#imageName').val(val);
      $('#dirName').val(dir);
      $('#image-delete').modal('show');
  }
  $('#deleteImgForm').submit(function () {
      $.ajax({
          type: 'POST',
          url: '/api/uploads/delete',
          data: $('#deleteImgForm').serialize(),
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          /*contentType: 'json',*/
          success: function(response) {
              $('#image-delete').modal('hide');
              retriveImages();
          }
        });
  });
  $('#clean').click(function(){
    $('#clean-dir').modal('show');
  })
  $('#cleanDirForm').submit(function(){
    $.ajax({
      type:'post',
      url:'/api/clean/dir',
      data:{
          'type':$('#upload_type').val()
      },
      headers:{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
            $('#clean-dir').modal('hide');
            retriveImages();
        }
  })
  })

</script>
@endpush