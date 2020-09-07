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
            <li class="breadcrumb-item" aria-current="page">{{$homess->title}}</li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                      <form action="{{action('Admin\FloorController@floor_update', $id)}}" method="post" enctype="multipart/form-data" class="form-horizontal col-sm-12">
                        {{csrf_field()}}
                        <div class="row">
                           <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Title</label>
                                    <input class="form-control forms1" id="title" name="title"  placeholder="Enter Title" type="text" value="{{$floors->title}}">
                                    <!-- @error('title')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror -->
                                </div>
                          
                                <div class="form-group">
                                    <label for="name">Home Title</label>
                                    <select class="form-control forms1" id="home_id" name="home_id">
                                       <option value="">--Select Home Title--</option>
                              @foreach ($homes as $home)
                                  <option value="{{ $home->id }}" {{ ( $home->id == $floors->home_id) ? 'selected' : '' }}> {{ $home->title }} </option>
                                @endforeach
                                   </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Upload Picture</label>
                                    <label class="btn btn-default btn-file rounded-0" style="margin-top: 0px !important;">
                                       <!-- The file is stored here. -->Choose File
                                       <input type="file" class="custom-file-input image-file" id="portfolioimage" onchange="readURL(this);" name="image" style="display: none !important;">
                                    </label>
                                    @if(isset($floors->image))
                                      @if($floors->image!='' || $floors->image!=null)
                                      <div class="col-lg-12 mx-auto p-0 o-hidden">
                                        <img id="blah" width="180" height="180" src="{{asset('uploads/floors/'.$floors->image)}}" class="img-thumbnail">
                                      </div>
                                      @else
                                      <div class="col-lg-12 mx-auto p-0 o-hidden">
                                        <img id="blah" width="180" height="180" src="http://placehold.it/100" class="img-thumbnail">
                                      </div>
                                      @endif
                                    @endif
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