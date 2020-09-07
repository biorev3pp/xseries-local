@extends('layouts.admin')
@section('content')
<div class="container-fluid page-wrapper">
    <!-- Page Heading -->
    <div class="row mb-2 justify-content-between pl-1 pr-1 align-items-center">
        <div class="ml-1">
            <h1 class="a_dash p-0 m-0">
                {{$page_title}} <small><span class="color-secondary">|</span> Add</small>
            </h1>
        </div>
        <div class="mt-1 mt-sm-0">
            <div class="btn-group mr-1">
                <a href="{{url('admin/floors/')}}" class="add_button position-relative"><i class="fa fa-arrow-left position-relative"></i> Back</a>
            </div>
        </div>
    </div>
    @if(\Session::has('message'))
    <div class="alert alert-success alert-dismissible" style="margin-top: 18px;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
        <strong>Success!</strong> {{ \Session::get('message') }}
    </div>
    @endif @if(\Session::has('exception'))
    <div class="alert alert-danger alert-dismissible" style="margin-top: 18px;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
        <strong>Error!</strong> {{ \Session::get('exception') }}
    </div>
    @endif

    <div class="col-12">
        <div class="card theme_set">
            <div class="card-body">
                <form action="{{url('admin/floors/')}}" method="post" enctype="multipart/form-data" class="form-horizontal col-sm-12">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Title</label>
                                <input class="form-control forms1" id="title" name="title" placeholder="Enter Title" type="text" />
                            </div>

                            <div class="form-group">
                                <label for="name">Home Title</label>
                                <select class="form-control forms1" id="home_id" name="home_id">
                                    <option value="">--Select Home Title--</option>
                                    @foreach ($homes as $home)
                                    <option value="{{ $home->id }}"> {{ $home->title }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Upload Picture</label>
                                <label class="btn btn-default btn-file rounded-0" style="margin-top: 0px !important;">
                                    <!-- The file is stored here. -->Choose File
                                    <input type="file" class="custom-file-input image-file" id="portfolioimage" onchange="readURL(this);" name="image" style="display: none !important;" />
                                </label>
                                <img id="blah" src="http://placehold.it/150" width="150" height="150" alt="your image" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group"><button type="submit" class="btn-orange t_b_s">Save</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript">
  function readURL(input) 
  {
      if (input.files && input.files[0]) 
      {
          var reader = new FileReader();

          reader.onload = function (e) 
          {
              $('#blah')
              .attr('src', e.target.result);
          };
          reader.readAsDataURL(input.files[0]);
      }
  }
</script>