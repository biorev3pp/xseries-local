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
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$page_title}}</li>
            <li><a href="{{url('admin/floors/')}}" class="add_button"><i class="fa fa-arrow-left"></i>Back</a></li>
         </ol>
      </nav>

      <div class="clearfix"></div>

      @if(count($errors) > 0)
      <div class="alert alert-danger">
       <ul>
       @foreach($errors->all() as $error)
        <li>{{$error}}</li>
       @endforeach
       </ul>
      </div>
      @endif
      @if(\Session::has('success'))
      <div class="alert alert-success">
       <p>{{ \Session::get('success') }}</p>
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
                                    <input class="form-control forms1" id="title" name="title"  placeholder="Enter Title" type="text">
                                    <!-- @error('title')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror -->
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
                                       <input type="file" class="custom-file-input image-file" id="portfolioimage" onchange="readURL(this);" name="image" style="display: none !important;">
                                    </label>
                                    <img id="blah" src="http://placehold.it/300" width="300" height="300" alt="your image" />
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