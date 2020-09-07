@extends('layouts.admin')
@section('content')
<div class="container-fluid page-wrapper">
    <div class="row mb-2 justify-content-between pl-1 pr-1 align-items-center">
        <div class="ml-1">
            <h1 class="a_dash d-inline-block m-0 p-0">Elevations <small><span class="color-secondary">|</span> Edit</small>
        </div>
        <div class="btn-group mr-1">
            <a href="{{ route('homes') }}" class="add_button"><i class="fa fa-arrow-left position-relative"></i> Back</a>
        </div>
    </div>
    @if(\Session::has('message'))
    <div class="alert alert-success alert-dismissible" style="margin-top: 18px;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
        <strong>Success!</strong> {{ \Session::get('message') }}
    </div>
    @endif

    <div class="col-12">
        <div class="card theme_set">
            <div class="card-body">
                <form method="post" action="{{route('update_homes')}}" name="home" id="home" enctype="multipart/form-data" class="form-horizontal col-sm-12">
                    @csrf
                    <input type="hidden" value="{{base64_encode($home->id)}}" name="id" />

                    <div class="col-lg-4 col-md-6 col-sm-4 float-left">
                        <div class="card" style="border: 0px;">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input required value="{{$home->title}}" class="form-control forms1" name="title" placeholder="Title" type="text" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-4 float-left">
                        <div class="card" style="border: 0px;">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="specifications">Description</label>
                                    <input required value="{{$home->specifications}}" class="form-control forms1" name="specifications" placeholder="Description" type="text" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-4 float-left">
                        <div class="card" style="border: 0px;">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="area">Area</label>
                                    <input required value="{{$home->area}}" class="form-control forms1" name="area" placeholder="Area" type="number" min="100" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-4 float-left">
                        <div class="card" style="border: 0px;">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="bedroom">Bedrooms</label>
                                    <input required value="{{$home->bedroom}}" class="form-control forms1" name="bedroom" placeholder="Bedrooms" type="number" min="1" max="100" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-4 float-left">
                        <div class="card" style="border: 0px;">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="bathroom">Bathrooms</label>
                                    <input required value="{{$home->bathroom}}" class="form-control forms1" name="bathroom" placeholder="Bathrooms" type="number" min="1" max="100" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-4 float-left">
                        <div class="card" style="border: 0px;">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="garage">Garages</label>
                                    <input required value="{{$home->garage}}" class="form-control forms1" name="garage" placeholder="Garages" type="number" min="0" max="50" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-4 float-left">
                        <div class="card" style="border: 0px;">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="price">Cost</label>
                                    <input required value="{{$home->price}}" class="form-control forms1" name="price" placeholder="Cost" type="number" min="0" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-4 float-left">
                        <div class="card" style="border: 0px;">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control forms1" name="status" id="status">
                                        <option {{ ($home->status_id ==2) ? 'selected' : '' }} value="2">Activate</option>
                                        <option {{ ($home->status_id ==1) ? 'selected' : '' }} value="1">Deactivate</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-4 float-left">
                        <div class="card" style="border: 0px;">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="file">Image</label>
                                    <label class="btn btn-default btn-file rounded-0" style="margin-top: 0px !important;">
                                        <!-- The file is stored here. -->Choose File
                                        <input type="file" class="custom-file-input image-file" value="" onchange="readURL(this);" id="portfolioimage" name="file" style="display: none !important;" />
                                    </label>
                                    @if(isset($home->img)) @if($home->img!='' || $home->img!=null)
                                    <div class="col-lg-12 mx-auto p-0 o-hidden">
                                        <img id="blah" width="180" height="180" src="{{asset('uploads/homes/'.$home->img)}}" class="img-thumbnail" />
                                    </div>
                                    @else
                                    <div class="col-lg-12 mx-auto p-0 o-hidden">
                                        <img id="blah" width="180" height="180" src="http://placehold.it/180" class="img-thumbnail" />
                                    </div>
                                    @endif
                                    <p id="imageAlert"></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

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
    </div>
</div>

@endsection
<script type="text/javascript">
function readURL(input) {
    var fileName = document.getElementById("portfolioimage").value;
      var idxDot = fileName.lastIndexOf(".") + 1;
      var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
      if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
        document.getElementById("mySubmit").disabled = false;
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $("#blah").attr("src", e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
        $('#imageAlert').fadeOut();
      }
      else{
        document.getElementById("mySubmit").disabled = true;
        $('#imageAlert').html("Only jpg/jpeg and png files are allowed!").show().addClass('alert').addClass('alert-danger');
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