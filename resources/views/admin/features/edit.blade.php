@extends('layouts.admin')
@section('content')
    <div class="container-fluid page-wrapper">
    <div class=" row justify-content-between mb-2 mr-1 ml-1">
      <div>
        <h1 class="a_dash d-inline-block m-0 p-0">Floors <small><span class="color-secondary">|</span></small></h1>
        <div class="row breadcrumbs-top pl-2 d-inline-block">
          <ol class="breadcrumb">
              <li class="breadcrumb-item" aria-current="page">
              <a href="{{ route('new_floors') }}">
              {{$floor->home->title}}</a>
              </li>
              <li class="breadcrumb-item" aria-current="page">
              <a href="{{url('admin/homes/features/'.base64_encode($floor->id))}}">{{$floor->title}}</a>
              </li>
              <li class="breadcrumb-item" aria-current="page">{{$data->title}}</li>
              <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
      <li class="breadcrumb-item" aria-current="page">{{$data->title}}</li>
      <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                  
                  <div class="alert alert-success alert-dismissible" style="margin-top:18px;">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                      <strong>Success!</strong> {{ \Session::get('success') }}
                  </div>
               @endif

  <div class="col-12">

                <div class="card theme_set">
                    <div class="card-body">
                      <form action="{{action('Admin\FeaturesController@update', $data->id)}}" method="post" enctype="multipart/form-data" class="form-horizontal col-sm-12">
                        {{csrf_field()}}
                        <div class="row">
                           <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">Title</label>
                                    <input class="form-control forms1" id="title" name="title"  placeholder="Enter Title" type="text" value="{{$data->title}}">
                                    <input name="floor_id" type="hidden" value="{{$floor->id}}">
                                </div>
                                
                          
                                <div class="form-group">
                                   <label for="inputEmail4">Group Section</label>
                                   <select name="parent_id" id="parent_id" class="form-control forms1">
                                     <option value="0">None</option>
                                      @foreach($features as $record)
                                      <option value="{{ $record->id }}" {{ ( $record->id == $data->parent_id) ? 'selected' : '' }}> {{ $record->title }} </option>
                                    @endforeach
                                   </select>
                                  
                                </div>
                                
                           </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="name">Price</label>
                                <input class="form-control forms1" id="price" name="price"  placeholder="Enter price" type="text" value="{{$data->price}}">
                              </div>
                              <div class="form-group">
                                     <label for="upload">Upload Picture</label>
                                     <label class="btn btn-default btn-file rounded-0" style="margin-top: 0px !important;">
                                         <!-- The file is stored here. -->Choose File
                                         <input type="file" class="custom-file-input image-file" onchange="readURL(this);" id="portfolioimage" name="image" style="display: none !important;">
                                      </label>
                                     <!-- <div class="custom-file">
                                      {{Form::file('image',['class'=>'custom-file-input image-file', 'id'=>'portfolioimage'])}}
                                      <label class="custom-file-label" for="validatedCustomFile">@if(!isset($data->image)) Choose file @else {{$data->image}} @endif</label>
                                    </div> -->
                                    @if(isset($data->image))
                                      @if($data->image!='' || $data->image!=null)
                                      <div class="col-lg-12 mx-auto p-0 o-hidden">
                                        <img id="blah" width="180" height="180" src="{{asset('uploads/features/'.$data->image)}}" class="img-thumbnail">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
      $(document).ready(function(){
          setTimeout(function() {
              $('#msg').fadeOut('fast');
          }, 3000);
      });
  </script>