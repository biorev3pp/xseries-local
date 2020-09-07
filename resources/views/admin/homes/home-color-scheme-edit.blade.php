@extends('layouts.admin')
@section('content')
<div class="container-fluid page-wrapper">
    <div class="row pl-1 pr-1 justify-content-between align-items-center mb-2">
        <div>
        @if($homes->parent_id==0)
            <h1 class="a_dash d-inline-block m-0 p-0">Elevations <small><span class="color-secondary">|</span></small></h1>
            @else
            <h1 class="a_dash d-inline-block m-0 p-0">Elevation Types <small><span class="color-secondary">|</span></small></h1>
            @endif
            <div class="row breadcrumbs-top pl-2 d-inline-block">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="{{ route('homes') }}">{{$homes->title}}</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="{{route('homes_color_scheme', ['id' =>$home_id])}}">Color Schemes </a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        {{$color_scheme->title}}
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </div>
        </div>
        <div class="mt-1 mt-sm-0">
            <div class="btn-group float-md-right">
                <a href="{{route('homes_color_scheme', ['id' =>$home_id])}}" class="add_button"><i class="fa fa-arrow-left position-relative"></i> Back</a>
            </div>
        </div>
    </div>

    @if(\Session::has('message'))

    <div class="alert alert-success alert-dismissible" style="margin-top: 18px;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
        <strong>Success!</strong> {{ \Session::get('message') }}
    </div>
    @endif

    <div class="card theme_set">
        <form method="post" action="{{route('color_scheme_update')}}" name="home" id="home" enctype="multipart/form-data" class="form-horizontal col-sm-12">
            <div class="card-body">
                @csrf
                <input type="hidden" value="{{base64_encode($color_scheme->id)}}" name="id" />

                <div class="col-lg-4 col-md-6 col-sm-4 float-left">
                    <div class="card" style="border: 0px;">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input required value="{{$color_scheme->title}}" class="form-control forms1" name="title" placeholder="Title" type="text" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-4 float-left">
                    <div class="card" style="border: 0px;">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="price">Cost</label>
                                <input required value="{{$color_scheme->price}}" class="form-control forms1" name="price" min="0"  placeholder="Cost" type="number" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-4 float-left">
                    <div class="card" style="border: 0px;">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="priority">Priority</label>
                                <input value="{{$color_scheme->priority}}" min="0" class="form-control forms1" name="priority" placeholder="Priority" type="number" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-4 float-left">
                    <div class="card" style="border: 0px;">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="img">Thumbnail</label>
                                <label class="btn btn-default btn-file rounded-0" style="margin-top: 0px !important;">
                                    <!-- The file is stored here. -->Choose File
                                    <input type="file" id="file1" class="form-control no_bor forms1" name="img" onchange="readURL1(this);" style="display: none !important;" />
                                </label>
                                <!-- <input value="" class="form-control no_bor forms1" name="img" type="file"> -->
                                @if(isset($color_scheme->img)) @if($color_scheme->img!='' || $color_scheme->img!=null)
                                <div class="col-lg-12 mx-auto p-0 o-hidden">
                                    <img id="blah1" width="180" height="180" src="{{asset('uploads/homes/'.$color_scheme->img)}}" class="img-thumbnail" />
                                </div>
                                @else
                                <div class="col-lg-12 mx-auto p-0 o-hidden">
                                    <img id="blah1" width="180" height="180" src="http://placehold.it/180" class="img-thumbnail" />
                                </div>
                                @endif @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-4 float-left">
                    <div class="card" style="border: 0px;">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="base_img">Image</label>
                                <label class="btn btn-default btn-file rounded-0" style="margin-top: 0px !important;">
                                    <!-- The file is stored here. -->Choose File
                                    <input type="file" id="file2" class="form-control no_bor forms1" name="base_img" onchange="readURL2(this);" style="display: none !important;" />
                                </label>
                                @if(isset($color_scheme->base_img)) @if($color_scheme->base_img!='' || $color_scheme->base_img!=null)
                                <div class="col-lg-12 mx-auto p-0 o-hidden">
                                    <img id="blah2" width="180" height="180" src="{{asset('uploads/homes/'.$color_scheme->base_img)}}" class="img-thumbnail" />
                                </div>
                                @else
                                <div class="col-lg-12 mx-auto p-0 o-hidden">
                                    <img id="blah2" width="180" height="180" src="http://placehold.it/180" class="img-thumbnail" />
                                </div>
                                @endif @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <p id="imageAlert" class="d-block ml-1 mr-1 mt-1"></p>
            <div class="col-lg-4 col-md-6 col-sm-4 float-left">
                <div class="card" style="border: 0px;">
                    <div class="card-body">
                        <div class="form-group">
                            <button class="btn-orange t_b_s" id="mySubmit" type="submit">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
function readURL1(input) {
      var fileName = document.getElementById("file1").value;
      var idxDot = fileName.lastIndexOf(".") + 1;
      var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
      if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
        document.getElementById("mySubmit").disabled = false;
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $("#blah1").attr("src", e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
        $('#imageAlert').removeClass('d-block');
        $('#imageAlert').fadeOut();
      }
      else{
        document.getElementById("mySubmit").disabled = true;
        $('#imageAlert').html("Only jpg/jpeg and png files are allowed!").show().addClass('alert').addClass('alert-danger');
      } 
    }
    function readURL2(input) {
      var fileName = document.getElementById("file2").value;
      var idxDot = fileName.lastIndexOf(".") + 1;
      var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
      if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
        document.getElementById("mySubmit").disabled = false;
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $("#blah2").attr("src", e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
        $('#imageAlert').removeClass('d-block');
        $('#imageAlert').fadeOut();
      }
      else{
        document.getElementById("mySubmit").disabled = true;
        $('#imageAlert').html("Only jpg/jpeg and png files are allowed!").show().addClass('alert').addClass('alert-danger');
      } 
    }
    $(document).ready(function(){
        setTimeout(function() {
            $('#msg').fadeOut('fast');
        }, 3000);
    });
  </script>