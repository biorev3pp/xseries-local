@extends('layouts.admin')
@section('content') 
<div class="container-fluid page-wrapper">
    <!-- Page Heading -->
    <div class="row mb-2 justify-content-between pl-1 pr-1 align-items-center">
        <div class="ml-1">
            <h1 class="a_dash d-inline-block p-0 m-0">{{$page_title}} <small><span class="color-secondary">| Edit</span></small></h1>
        </div>  
        <div class="ml-1 ml-sm-0">
            <div class="btn-group mr-1">
                <a href="{{url('admin/floors/')}}" class="add_button"><i class="fa fa-arrow-left position-relative"></i> Back</a>
            </div>
        </div>
    </div>
    @if(\Session::has('success'))

    <div class="alert alert-success alert-dismissible" style="margin-top: 18px;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
        <strong>Success!</strong> {{ \Session::get('success') }}
    </div>
    @endif

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

    <div class="col-12">
        <div class="card theme_set">
            <div class="card-body">
                <form action="{{action('Admin\FloorController@update', $id)}}" method="post" enctype="multipart/form-data" class="form-horizontal col-sm-12">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Title</label>
                                <input class="form-control forms1" id="title" name="title" placeholder="Enter Title" type="text" value="{{$floors->title}}" />
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
                                    <input type="file" class="custom-file-input image-file" id="portfolioimage" onchange="readURL(this);" name="image" style="display: none !important;" />
                                </label>
                                @if(isset($floors->image)) @if($floors->image!='' || $floors->image!=null)
                                <div class="col-lg-12 mx-auto p-0 o-hidden">
                                    <img id="blah" width="180" height="180" src="{{asset('uploads/floors/'.$floors->image)}}" class="img-thumbnail" />
                                </div>
                                @else
                                <div class="col-lg-12 mx-auto p-0 o-hidden">
                                    <img id="blah" width="150" height="150" src="http://placehold.it/150" class="img-thumbnail" />
                                </div>
                                @endif @endif
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
@push('scripts')
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
@endpush

