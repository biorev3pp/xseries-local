@extends('layouts.admin')
@section('content') 

    <div class="container-fluid page-wrapper">
      <!-- Page Heading --> 
      <div class="row mb-2 justify-content-between pl-1 pr-1 align-items-center">
        <div>
           <h1 class="a_dash d-inline-block p-0 m-0">Communities  <small><span class="color-secondary">|</span> Add</small></h1>
        </div>

        <div class="mt-1 mt-sm-0">
           <div class="btn-group">
            <a href="{{ route('communities') }}" class="add_button position-relative"><i class="fas fa-arrow-left position-relative"></i> Back</a>
           </div> 
        </div>
    </div>
    @if(\Session::has('message'))          
        <div class="alert alert-success alert-dismissible" style="margin-top:18px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <strong>Success!</strong> {{ \Session::get('message') }}
        </div>
    @endif
     @if(\Session::has('exception'))
        <div class="alert alert-danger alert-dismissible" style="margin-top:18px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <strong>Error!</strong> {{ \Session::get('exception') }}
        </div>
      @endif
      <div class="col-12 p-0">

                <div class="card theme_set">
                    <div class="card-body pt-3">
                      <form data-parsley-validate name="community_add_form" action="{{ route('create-community') }}" method="post" enctype="multipart/form-data" class="form-horizontal col-sm-12">
                        {{csrf_field()}}
                        <div class="row">
                           <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control forms1 @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Name" type="text">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                     <label for="contact_email">Contact email</label>
                                  <input class="form-control forms1 @error('contact_email') is-invalid @enderror" id="contact_email" name="contact_email" value="{{ old('contact_email') }}" placeholder="Contact email" type="text">
                                  @error('contact_email')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                     <label for="location">Location</label>
                                     <input class="form-control forms1 @error('location') is-invalid @enderror" id="location" value="{{ old('location') }}" name="location" placeholder="Location" type="text">
                                     @error('location')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">States</label>
                                    <select class="form-control forms1 @error('state_id') is-invalid @enderror" name="state_id" value="{{ old('state_id') }}" id="state_id" onchange="getCitiesList(this.value)">
                                        <option value="">Select State</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}"> {{ $state->code.' - '.$state->state }} </option>
                                        @endforeach
                                    </select>
                                        @error('state_id')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                       </div>
                                <div class="form-group">
                                    <label for="zipcode">Zip Code</label>
                                    <input type="text" class="form-control forms1 @error('zipcode') is-invalid @enderror" id="zipcode" name="zipcode" placeholder="Zip Code">
                                    @error('zipcode')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                 
                                
                                
                                <!--<div class="form-group">
                                     <label for="marker">Marker</label>
                                    <input class="form-control" id="marker" name="marker" placeholder="Marker" type="text">
                                </div>-->
                                <div class="form-group mt-2">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-6">
                                        <label for="logo">Logo</label>
                                        <label class="btn btn-default btn-file rounded-0">
                                            <!-- The file is stored here. -->Choose File
                                         <input class="form-control forms1 @error('logo') is-invalid @enderror" type="file" id="logo" name="logo" style="display: none !important;" value="{{ old('logo') }}" onchange="readURL1(this);" placeholder="Logo">
                                        </label>
                                    </div>
                                    <div class="col-xl-8 col-lg-6">
                                      <img id="blah1" src="http://placehold.it/100" width="100" height="100" alt="your image"/>
                                    </div>
                                     @error('logo')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                </div>
                                 <div class="form-group mt-2">
                                 <div class="row">
                                    <div class="col-xl-4 col-lg-6">
                                        <label for="banner">Banner</label>
                                        <label class="btn btn-default btn-file rounded-0">
                                            <!-- The file is stored here. -->Choose File
                                            <input class="form-control forms1 @error('banner') is-invalid @enderror" onchange="readURL2(this);" type="file" id="banner" name="banner" style="display: none !important;"accept="image/*" value="{{ old('banner') }}" placeholder="Banner">
                                        </label>
                                    </div>
                                    <div class="col-xl-8 col-lg-6">
                                      <img id="blah2" src="http://placehold.it/100" width="100" height="100" alt="your image" />
                                    </div>
                                    @error('banner')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                </div>
                                <div class="form-group mt-2">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-6">
                                        <label for="plot_image">Google Map Marker</label>
                                        <label class="btn btn-default btn-file rounded-0">
                                            <!-- The file is stored here. -->Choose File
                                            <input class="form-control forms1 @error('marker_image') is-invalid @enderror" onchange="readURL5(this);" type="file" id="marker_image" name="marker_image"accept="image/*" style="display: none !important;" placeholder="Google Map Marker Image">
                                        </label>
                                    </div>
                                    <div class="col-xl-8 col-lg-6">
                                      <img id="blah5" src="http://placehold.it/100" width="100" height="100" alt="your image" />
                                    </div> 
                                     @error('marker_image')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                </div>
                                
                              
                                                                                            
                     </div>
                     <div class="col-6">
                                <div class="form-group">
                                    <label for="contact_person">Contact person</label>
                                    <input class="form-control forms1 @error('contact_person') is-invalid @enderror" id="contact_person" name="contact_person" value="{{ old('contact_person') }}" placeholder="Contact person" type="text">
                                    @error('contact_person')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                     <label for="contact_numberc">Contact number</label>
                                     <input class="form-control forms1 @error('contact_number') is-invalid @enderror" id="contact_number" name="contact_number" value="{{ old('contact_number') }}" placeholder="Contact number" type="text">
                                     @error('contact_number')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control forms1 @error('description') is-invalid @enderror" id="description" name="description" placeholder="Description">
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Cities</label>
                                    <select class="form-control forms1 @error('city_id') is-invalid @enderror" name="city_id" value="{{ old('city_id') }}" id="city_id">
                                        <option value="">Select State First</option>
                                    </select>
                                    @error('city_id')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="community_type">Community Type</label>
                                    <input type="text" class="form-control forms1" id="community_type" name="community_type" placeholder="Community Type">

                                </div>
                                <div class="form-group mt-2">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-6">
                                        <label for="svg">Svg</label>
                                        <label class="btn btn-default btn-file rounded-0">
                                            <!-- The file is stored here. -->Choose File
                                            <input class="form-control forms1 @error('svg') is-invalid @enderror" onchange="readURL3(this);" type="file" id="svg" name="svg" style="display: none !important;" value="{{ old('svg') }}" placeholder="Svg" accept="image/*">
                                        </label>
                                    </div>
                                    <div class="col-xl-8 col-lg-6">
                                      <img id="blah3" src="http://placehold.it/100" width="100" height="100" alt="your image" />
                                    </div> 
                                     @error('svg')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>  
                                </div>
                                <div class="form-group mt-2">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-6">
                                        <label for="plot_image">Image</label>
                                        <label class="btn btn-default btn-file rounded-0">
                                            <!-- The file is stored here. -->Choose File
                                            <input class="form-control forms1 @error('plot_image') is-invalid @enderror" onchange="readURL4(this);" type="file" id="plot_image" name="plot_image"accept="image/*" style="display: none !important;" placeholder="Plot Image">
                                        </label>
                                    </div>
                                    <div class="col-xl-8 col-lg-6">
                                      <img id="blah4" src="http://placehold.it/100" width="100" height="100" alt="your image" />
                                    </div> 
                                     @error('plot_image')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                </div>
                                                                                              
                     </div>

                 </div>
                     <!-- <div class="form-group"> 
                        <div class="col-sm-offset-3 col-sm-10">
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div> -->
                        <div class="form-group"><button type="submit" class="btn-orange t_b_s">Add</button> </div>
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
            function readURL4(input) 
            {
                if (input.files && input.files[0]) 
                {
                    var reader = new FileReader();

                    reader.onload = function (e) 
                    {
                        $('#blah4')
                        .attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
            function readURL5(input) 
            {
                if (input.files && input.files[0]) 
                {
                    var reader = new FileReader();

                    reader.onload = function (e) 
                    {
                        $('#blah5')
                        .attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

<style type="text/css">
span .invalid-feedback
{
    color:red;

}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
      $(document).ready(function(){
          setTimeout(function() {
              $('#msg').fadeOut('fast');
          }, 3000);
      });
  </script>
@endsection