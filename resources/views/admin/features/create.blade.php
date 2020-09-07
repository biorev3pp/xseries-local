@extends('layouts.admin')
@section('content')
    <div class="container-fluid page-wrapper">
      <div class="row justify-content-between align-items-center mb-2 ml-1 mr-1">
      <div>
      <h1 class="a_dash d-inline-block m-0 p-0 ">Floors <small><span class="color-secondary">|</span></small></h1>
      <div class="row breadcrumbs-top pl-2 d-inline-block">
          <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page">
            <a href="{{ route('new_floors') }}">{{$floor->home->title}}</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
            <a href="{{url('admin/homes/features/'.base64_encode($floor->id))}}">{{$floor->title}}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Add Feature</li>
          </ol>
        </div>
      </div>
        <div class="ml-1 ml-sm-0">
          <div class="btn-group">
              <a href="{{url('admin/homes/features/'.base64_encode($floor->id))}}" class="add_button"><i class="fa fa-arrow-left position-relative"></i> Back</a>
          </div>
        </div>
    </div>

  <!-- <nav aria-label="breadcrumb" id="g_r_bar">
   <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('new_floors') }}"><i class="fas fa-fw fa-table"></i>Floors</a></li>
      <li class="breadcrumb-item" aria-current="page">{{$floor->home->title}}</li>
      <li class="breadcrumb-item" aria-current="page">{{$floor->title}}</li>
      <li class="breadcrumb-item active" aria-current="page">Add</li>
      <li><a href="{{url('admin/homes/features/'.base64_encode($floor->id))}}" class="add_button"><i class="fa fa-arrow-left"></i>Back</a></li>
   </ol>
  </nav> -->

      <div class="clearfix"></div>

      @if(count($errors) > 0)
      <div class="alert alert-danger" id="msg">
       <ul>
       @foreach($errors->all() as $error)
        <li>{{$error}}</li>
       @endforeach
       </ul>
      </div>
      @endif
      @if(\Session::has('success'))
      <div class="alert alert-success" id="msg">
       <p>{{ \Session::get('success') }}</p>
      </div>
      @endif


                <div class="col-12">
                  <div class="card theme_set">
                    <div class="card-body">
                      <form action="{{url('admin/homes/features/'.base64_encode($floor->id))}}" method="post" enctype="multipart/form-data" class="form-horizontal col-sm-12">
                        {{csrf_field()}}
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="name">Title</label>
                                <input class="form-control forms1" id="title" name="title"  placeholder="Enter Title" type="text" required>
                                <input name="floor_id" type="hidden" value="{{$floor->id}}">
                              </div>
                              <div class="form-group">
                                <label for="inputEmail4">Group Section</label>
                                <select name="parent_id" id="parent_id" class="form-control forms1" required>
                                  <option value="0">None</option>
                                  @foreach($features as $record)
                                  <option value="{{$record->id}}">{{$record->title}}</option>
                                  @endforeach
                                </select>
                              </div>
                              
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="name">Price</label>
                                <input class="form-control forms1" id="price" name="price" placeholder="Enter price" type="text" value="">
                              </div>
                              <div class="form-group">
                                <label for="name">Upload Picture</label>
                                <label class="btn btn-default btn-file rounded-0" style="margin-top: 0px !important;">
                                    <!-- The file is stored here. -->Choose File
                                  <input type="file" class="custom-file-input image-file" id="portfolioimage" onchange="readURL(this);" name="image" style="display: none !important;" required>
                                </label>
                                <img id="blah" src="http://placehold.it/300" width="180" height="180" alt="your image" />
                              </div>
                            </div>
                          </div>
                          <div class="form-group"><button type="submit" class="btn-orange t_b_s">Save</button> </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
      $(document).ready(function(){
          setTimeout(function() {
              $('#msg').fadeOut('fast');
          }, 3000);
      });
  </script>