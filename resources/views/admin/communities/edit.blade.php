@extends('layouts.admin') 
@section('content')
<div class="container-fluid page-wrapper">
    <!-- Page Heading -->  
    <div class="row mb-2 justify-content-between pl-1 pr-1 align-items-center">
        <div>
           <h1 class="a_dash p-0 m-0">Communities <small><span class="color-secondary">|</span> Edit</small></h1></h1>
        </div>
        <div>
           <div class="btn-group">
            <a href="{{ route('communities') }}" class="add_button position-relative"><i class="fa fa-arrow-left position-relative"></i> Back</a>
           </div>
        </div>    
    </div>
    @if(\Session::has('message'))

    <div class="alert alert-success alert-dismissible" style="margin-top: 18px;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
        <strong>Success!</strong> {{ \Session::get('message') }}
    </div>
    @endif
    <div class="col-12" style="margin: 0; padding: 0;">
        <div class="card theme_set">
            <div class="card-body pt-3">
                <!-- @foreach ($errors->all() as $error)
                    <div style="color:red">{{$error}}</div>
                      @endforeach -->
                <form data-parsley-validate name="community_edit_form" action="{{ route('modify-community', $communities->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal col-sm-12">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control forms1 @error('name') is-invalid @enderror" id="name" name="name" value="{{$communities->name}}" placeholder="Name" type="text" />
                                @error('name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="contact_email">Contact email</label>
                                <input class="form-control forms1 @error('contact_email') is-invalid @enderror" id="contact_email" name="contact_email" value="{{$communities->contact_email}}" placeholder="Contact email" type="text" />
                                @error('contact_email')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input class="form-control forms1 @error('location') is-invalid @enderror" id="location" name="location" value="{{$communities->location}}" placeholder="Location" type="text" />
                                @error('location')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">States</label>
                                <select class="form-control forms1 @error('state_id') is-invalid @enderror" name="state_id" id="state_id" onchange="getCitiesList(this.value)">
                                    <option value="">Select State</option>
                                    @foreach ($states as $state)

                                    <option value="{{ $state->id }}" {{ ( $state->id == $communities->state_id) ? 'selected' : '' }}> {{ $state->state }} </option>
                                    @endforeach
                                </select>
                                @error('state_id')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="zipcode">Zip Code</label>
                                <input class="form-control forms1 @error('zipcode') is-invalid @enderror" id="zipcode" name="zipcode" value="{{$communities->zipcode}}" placeholder="Zip Code" type="text" />
                                @error('zipcode')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mt-2">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-6">
                                        <label for="logo">Logo</label>
                                        <label class="btn btn-default btn-file rounded-0">
                                            <!-- The file is stored here. -->Choose File
                                            <input
                                                class="form-control forms1 @error('logo') is-invalid @enderror"
                                                onchange="readURL1(this);"
                                                type="file"
                                                id="logo"
                                                name="logo"
                                                accept="image/*"
                                                style="display: none !important;"
                                                value="{{ $communities->logo }}"
                                                placeholder="Logo"
                                            />
                                        </label>
                                    </div>
                                    <div class="col-xl-8 col-lg-6">
                                        @if($communities->logo)
                                        <img src="{{'/uploads/'.$communities->logo }}" id="blah1" width="100" height="100" />
                                        @else
                                        <img src="http://placehold.it/100" width="100" height="100" id="blah1" width="100" height="100" />
                                        @endif
                                    </div>
                                    @error('logo')
                                    <span class="invalid-feedback" style="display: block;" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-6">
                                        <label for="marker_image">Google Map Marker</label>
                                        <label class="btn btn-default btn-file rounded-0">
                                            <!-- The file is stored here. -->Choose File
                                            <input
                                                class="form-control forms1 @error('marker_image') is-invalid @enderror"
                                                onchange="readURL3(this);"
                                                type="file"
                                                accept="image/*"
                                                id="marker_image"
                                                name="marker_image"
                                                style="display: none !important;"
                                                value="{{ $communities->marker_image }}"
                                                placeholder="Google Map Marker"
                                            />
                                        </label>
                                    </div>
                                    <div class="col-xl-8 col-lg-6">
                                        @if($communities->marker_image)
                                        <img src="{{asset('/uploads/'.$communities->marker_image )}}" id="blah3" width="100" height="100" />
                                        @else
                                        <img src="http://placehold.it/100" width="100" height="100" id="blah3" width="100" height="100" />
                                        @endif
                                    </div>
                                    @error('marker_image')
                                    <span class="invalid-feedback" style="display: block;" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="contact_person">Contact person</label>
                                <input class="form-control forms1 @error('contact_person') is-invalid @enderror" id="contact_person" name="contact_person" value="{{$communities->contact_person}}" placeholder="Contact person" type="text" />
                                @error('contact_person')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="contact_numberc">Contact number</label>
                                <input class="form-control forms1 @error('contact_number') is-invalid @enderror" id="contact_number" name="contact_number" value="{{$communities->contact_number}}" placeholder="Contact number" type="text" />
                                @error('contact_number')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input class="form-control forms1 @error('description') is-invalid @enderror" id="description" name="description" value="{{$communities->description}}" placeholder="Description" type="text" />
                                @error('description')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name">Cities</label>
                                <select class="form-control forms1 @error('city_id') is-invalid @enderror" name="city_id" id="city_id">
                                    <option value="">Select State First</option>
                                    @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" {{ ( $city->id == $communities->city_id) ? 'selected' : '' }}> {{ $city->city }} </option>
                                    @endforeach
                                </select>
                                @error('city_id')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="community_type">Community Type</label>
                                <input type="text" class="form-control forms1" id="community_type" name="community_type" placeholder="Community Type" value="{{$communities->community_type}}">
                            </div>
                            <div class="form-group mt-2">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-6">
                                        <label for="banner">Banner</label>
                                        <label class="btn btn-default btn-file rounded-0">
                                            <!-- The file is stored here. -->Choose File
                                            <input
                                                class="form-control forms1 @error('banner') is-invalid @enderror"
                                                onchange="readURL2(this);"
                                                type="file"
                                                id="banner"
                                                accept="image/*"
                                                name="banner"
                                                style="display: none !important;"
                                                value="{{ $communities->banner }}"
                                                placeholder="Banner"
                                            />
                                        </label>
                                    </div>
                                    <div class="col-xl-8 col-lg-6">
                                        @if($communities->banner)
                                        <img src="{{asset('/uploads/'.$communities->banner )}}" id="blah2" width="100" height="100" />
                                        @else
                                        <img src="http://placehold.it/100" width="100" height="100" id="blah2" width="100" height="100" />
                                        @endif
                                    </div>
                                    @error('banner')
                                    <span class="invalid-feedback" style="display: block;" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group"><button type="submit" class="btn-orange t_b_s">Save</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
        
    function getCitiesList(sid) {
        $.ajax({url: '/api/get-cities-list/'+sid, success: function(result){
            $("#city_id").html(result);
        }});
    }

    function getCommunities() {
        var sid = $('#state_id').val();
        var cid = $('#city_id').val();
        if((sid == '') || (cid == '') || (sid == null) || (cid == null)){
            toastr.error('Please select both state and city', 'Ahh!');
            return false;
        }
        $('.picon').html('<img src="/images/loader.gif" alt="">');
        $.ajax({url: '/api/get-communities-list/'+cid, success: function(result){
            $("#list-box").html(result);
        }});
    }

     //read image upload url      
       function readURL1(input) 
        {
            if (input.files && input.files[0]) 
            {
                var reader = new FileReader();

                reader.onload = function (e) 
                {
                    $('#blah1')
                    .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        function readURL2(input) 
        {
            if (input.files && input.files[0]) 
            {
                var reader = new FileReader();

                reader.onload = function (e) 
                {
                    $('#blah2')
                    .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
            function readURL3(input) 
            {
                if (input.files && input.files[0]) 
                {
                    var reader = new FileReader();

                    reader.onload = function (e) 
                    {
                        $('#blah3')
                        .attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }


</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@endsection
