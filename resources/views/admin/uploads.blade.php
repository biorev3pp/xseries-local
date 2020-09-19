@extends('layouts.admin')
@section('content')

<link rel="stylesheet" href="{{asset('cms/css/gallery.css')}}">
<style>

.buttons-wrap{
  justify-content: space-evenly;
}
.buttons-wrap p{
  font-size: 1.3rem;
}
.buttons-wrap button{
  background: #fff;
  border: none;
  font-size: 16px;
  padding: 35px 30px;
  box-shadow: 0 0 10px 2px #ccc;
  color: #555;
  cursor: pointer;
  border-radius: 5px;
  outline:none;
  font-weight: 500;
}
#upload_type{
  max-width:200px;
  width:100%;
  background-color: #fff;
  border: 1px solid #ccc;
  cursor: pointer;
}
#imageList{
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
<div class="container-fluid page-wrapper">
  <div class="row mb-2 justify-content-between pl-1 pr-1 align-items-center">
    <div><h1 class="a_dash p-0 m-0">Bulk Uploads</h1></div>
  </div>  
  <div class="d-flex px-2 pb-2 buttons-wrap align-items-center">
    <a href="{{route('bulk-data')}}" class="add_button">Upload Data</a>
    <p class="m-0">OR</p>
    <a href="{{route('bulk-media')}}" class="add_button">Upload Media</a>
  </div>
  <div class="card d-inline-block w-100 mt-1" id="list">
    <div class="card-body">
      <div class="d-flex justify-content-end pb-1">
        <a href="{{route('unmapped')}}">
          <button style="font-weight:600;" type="button" class="add_button btn btn-dark btn-min-width waves-effect waves-light">See Unmapped Images</button>
        </a>
      </div>
      <div style="padding:5px 15px;" class='d-flex flex-column flex-md-row bg-light mb-1 border'>
        <label style="white-space: nowrap" class="align-self-left align-self-md-center m-0 font-weight-bold text-dark">Community:
        </label>
        <select class="form-control mr-1 mb-1 mb-md-0" id="community-filter" name="community-filter" onchange="loadDropDownOptions('/api/community/home/'+this.value,this.value,'elevation-filter','community')">
        </select>
        <label style="white-space: nowrap" class="align-self-left align-self-md-center m-0 font-weight-bold text-dark">Elevation:</label>
        <select class="form-control mr-1 mb-1 mb-md-0" name="elevation-filter" id="elevation-filter" onchange="loadDropDownOptions('/api/community/home/data/'+this.value,this.value,'elevation-type-filter','home')">
            <option value="">Select Community First</option>
        </select>
        <label style="white-space: nowrap" class="align-self-left align-self-md-center m-0 font-weight-bold text-dark">Elevation Type:</label>
        <select class="form-control mr-1 mb-1 mb-md-0" name="elevation-type-filter" id="elevation-type-filter" onchange="loadDropDownOptions('/api/community/home/type/colorscheme/'+this.value,this.value,'color-scheme-filter','home-type')">
        </select>
        <label style="white-space: nowrap" class="align-self-left align-self-md-center m-0 font-weight-bold text-dark">Color Scheme:</label>
        <select class="form-control" name="color-scheme-filter" id="color-scheme-filter" onchange="loadDropDownOptions('',this.value,'color-scheme')">
        </select>
        <label style="white-space: nowrap" class="align-self-left align-self-md-center m-0 font-weight-bold text-dark">Floor:</label>
        <select class="form-control" onchange="loadDropDownOptions('',this.value,'floor')" name="floor-filter" id="floor-filter">
        </select>
      </div>
    </div>
    <div class="row grid-hover p-1">
      <article class="w-100" style="text-align:center; margin-top:100px;">
        <h1>Please Select Community First</h1>
        <p>You have to select community to view the media files.</p>
      </article>
    </div>
  </div>
</div>
<div class="modal fade" id="modal-warning" tabindex="-1" role="dialog" aria-labelledby="addNewCommunityTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
    <form action="" id="deleteForm" method="get" enctype="multipart/form-data">
      <div class="modal-content" style="margin-left: 110px;">
        <div class="modal-header">
          <h5>warning</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fa fa-times"></i> </span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <h6 class="delete_heading">You haven't selected any options. kindly make sure for which you have uploading the images.</h6>
            <div class="clearfix"></div>
            <div class="m-auto">
              <button type="button" class="btn-orange t_b_s" data-dismiss="modal">Ok</button>
            </div>
          </div>
        </div>
      </div>
    </form>
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
@endsection
@push('scripts')
<script>
  $('#submit_image').click(function(){
    var getUploadType = $('#upload_type').val();
    if(getUploadType!=''){
      $('#type').val(getUploadType);  
      var dropZone = Dropzone.forElement(".dropzone");
      dropZone.processQueue();
    }
    else{
      $('#modal-warning').modal('show');
    }
  });
  loadDropDownOptions('/api/community','','community-filter','community');
  function retriveImages(){
    if(arguments[0]!='')
    {
      $.ajax({
        type:'post',
        url:'/api/community/images/',
        data:{'type':arguments[1],'id':arguments[0]},
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
  }
  $('#color-scheme-filter').on('click',function(){
    $('#floor-filter option[value=""]').prop('selected',true);
  })
  $('#floor-filter').on('click',function(){
    $('#color-scheme-filter option[value=""]').prop('selected',true);
  })
  //first arg api, id, elementsIds, type
  function loadDropDownOptions(){
    retriveImages(arguments[1],arguments[arguments.length-1]);
    var elementId = arguments[2]; 
    if(arguments[0]!=''){
      $.ajax({
        type:'GET',
        url:arguments[0],
        success: function(res){
          var display = `<option value=''>No Options Selected</option>`;
          if(elementId =='elevation-type-filter'){
            $.each(res.home_type,function(key,val){
              display+=`<option value="${val.id}">${val.title}</option>`;
            });
            $('#'+elementId).html(display);

            display = `<option value=''>No Options Selected</option>`;
            $.each(res.color_scheme,function(key,val){
              display+=`<option value="${val.id}">${val.title}</option>`;
            });
            $('#color-scheme-filter').html(display); 

            display = `<option value=''>No Options Selected</option>`;
            $.each(res.floor,function(key,val){
              display+=`<option value="${val.id}">${val.title}</option>`;
            });
            $('#floor-filter').html(display); 
          }
          else{
            $.each(res,function(key,val){
              display+=`<option value="${val.id}">${elementId=='community-filter'?val.name:val.title}</option>`;
            });
            $('#'+elementId).html(display); 
          }
        }
      })
    }
  }
  function deleteImage(dir,val){
    $('#imageName').val(val);
    var dir = $('#imageList').val();
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
      success: function(response) {
          $('#image-delete').modal('hide');
          retriveImages();
      }
    });
  });
</script>
@endpush