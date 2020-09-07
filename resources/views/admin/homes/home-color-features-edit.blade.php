@extends('layouts.admin')
@section('content')

<div class="container-fluid page-wrapper">
<div class="row pl-1 pr-1 justify-content-between align-items-center mb-2">
    <div>
        @if($homes->parent_id == 0)
        <h1 class="a_dash m-0 p-0 d-inline-block">Elevations <small><span class="color-secondary">|</span></small></h1>
        @else
        <h1 class="a_dash m-0 p-0 d-inline-block">Elevation Types <small><span class="color-secondary">|</span></small></h1>
            @endif
            <div class="row breadcrumbs-top pl-2 d-inline-block">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page">
                    <a href="{{ route('homes') }}">{{$homes->title}}</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                    <a href="{{route('homes_color_scheme', ['id' =>$color_scheme_id])}}">Color Schemes</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">{{$color_scheme->title}}</li>
                    <li class="breadcrumb-item" aria-current="page">
                    <a href="{{route('color_features', ['id' =>$color_scheme_id])}}">Color Features</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">{{$feature->title}}</li>
                </ol>
            </div>
         </div>   
         <div class="mt-1 mt-sm-0">
            <div class="btn-group">
               <a href="{{route('color_features', ['id' =>$color_scheme_id])}}" class="add_button"><i class="fa fa-arrow-left position-relative"></i> Back</a>
            </div>
        </div>
    </div>
        @if(\Session::has('message'))
                  
                  <div class="alert alert-success alert-dismissible" style="margin-top:18px;">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                      <strong>Success!</strong> {{ \Session::get('message') }}
                  </div>
               @endif
    <!-- <nav aria-label="breadcrumb" id="g_r_bar">
     <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('homes') }}"><i class="fa fa-home"></i>Homes</a></li>
        <li class="breadcrumb-item" aria-current="page">{{$homes->title}}</li>
        <li class="breadcrumb-item" aria-current="page">{{$color_scheme->title}}</li>
        <li class="breadcrumb-item" aria-current="page">{{$feature->title}}</li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
        <li><a href="{{route('color_features', ['id' =>$color_scheme_id])}}" class="add_button"><i class="fas fa-arrow-left fa-sm pr-2"></i>Back</a></li>
     </ol>
    </nav> -->

    <div class="card theme_set">
        <form method="post" action="{{route('color_features_update')}}" name="home" id="home" enctype="multipart/form-data" class="form-horizontal col-sm-12">
    <div class="card-body">



        
                @csrf
                <input type="hidden" value="{{base64_encode($feature->id)}}" name="id">

                <div class="col-lg-4 col-md-6 col-sm-4 float-left">
                    <div class="card" style="border: 0px;">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input value="{{$feature->title}}" class="form-control forms1" name="title" placeholder="Title" type="text">
                                                 
                                </div>
                            </div>
                    </div>
                    
                </div>
            
               
                <div class="col-lg-4 col-md-6 col-sm-4 float-left">
                    <div class="card" style="border: 0px;">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="price">Cost</label>
                                <input value="{{$feature->price}}" class="form-control forms1" name="price" placeholder="Cost" type="text">
                            </div>
                        </div>
                    </div>
                
                </div>
                <div class="col-lg-4 col-md-6 col-sm-4 float-left">
                    <div class="card" style="border: 0px;">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="material">Material</label>
                                    <input required value="{{$feature->material}}" class="form-control forms1" name="material" placeholder="Material" type="text">
                                             
                            </div>
                        </div>
                    </div>
            
                </div>
                <div class="col-lg-4 col-md-6 col-sm-4 float-left">
                    <div class="card" style="border: 0px;">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="manufacturer">Manufacturer</label>
                                    <input required value="{{$feature->manufacturer}}" class="form-control forms1" name="manufacturer" placeholder="Manufacturer" type="text">
                                             
                            </div>
                        </div>
                    </div>
            
                </div>
                <div class="col-lg-4 col-md-6 col-sm-4 float-left">
                    <div class="card" style="border: 0px;">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                    <input required value="{{$feature->name}}" class="form-control forms1" name="name" placeholder="Name" type="text">
                                             
                            </div>
                        </div>
                    </div>
            
                </div>
                <div class="col-lg-4 col-md-6 col-sm-4 float-left">
                    <div class="card" style="border: 0px;">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="m_id">Id</label>
                                    <input required value="{{$feature->m_id}}" class="form-control forms1" name="m_id" placeholder="Id" type="text">
                                             
                            </div>
                        </div>
                    </div>
            
                </div>
            
                
            
                <div class="col-lg-4 col-md-6 col-sm-4 float-left">
                    <div class="card" style="border: 0px;">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="priority">Priority</label>
                                    <input value="{{$feature->priority}}" min="0" class="form-control forms1" name="priority" placeholder="Priority" type="number">
                                             
                            </div>
                        </div>
                    </div>
            
                </div>

                <div class="col-lg-4 col-md-6 col-sm-4 float-left">
                    <div class="card" style="border: 0px;">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="img">Thumbnail</label>
                                <!-- <input value="" class="form-control no_bor forms1" name="img" type="file"> -->
                                <label class="btn btn-default btn-file rounded-0" style="margin-top: 0px !important;">
                                 <!-- The file is stored here. -->Choose File
                                 <input type="file" class="form-control no_bor forms1" onchange="readURL(this);" id="file" name="img" style="display: none !important;">
                              </label>
                              @if(isset($feature->img))
                          @if($feature->img!='' || $feature->img!=null)
                          <div class="col-lg-12 mx-auto p-0 o-hidden">
                            <img id="blah" width="180" height="180" src="{{asset('uploads/homes/'.$feature->img)}}" class="img-thumbnail">
                          </div>
                          @else
                          <div class="col-lg-12 mx-auto p-0 o-hidden">
                            <img id="blah" width="180" height="180" src="http://placehold.it/180" class="img-thumbnail">
                          </div>
                          @endif
                        @endif
                            </div>
                        </div>
                    </div>
                
                </div>

                <div class="col-lg-4 col-md-6 col-sm-4 float-left">
                    <div class="card" style="border: 0px;">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="priority">Upgrade Option</label>
                                <br>
                                <input type="checkbox" class="forms1" name="upgrade_option" value="0" @if($feature->stared==0) checked="checked" @endif >Base
                                <input type="checkbox" class="forms1" name="upgrade_option" value="1" @if($feature->stared==1) checked="checked" @endif>Upgrade
                            </div>
                        </div>
                    </div>
            
                </div>
            
            
                
            <div class="clearfix"></div>

        </div>
        <div class="col-lg-4 col-md-6 col-sm-4 float-left">
                    <div class="card" style="border: 0px;">
                        <div class="card-body">
                            <div class="form-group">
                                <button class="btn-orange t_b_s" type="submit">Save</button>
                            </div>
                        </div>
                    </div>
                
                </div>
            </form>
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