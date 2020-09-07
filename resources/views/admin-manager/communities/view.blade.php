@extends('layouts.admin') 
@section('content')
<div class="container-fluid page-wrapper">
  <div class="row justify-content-between mb-2 pl-1 pr-1 align-items-center">
      <div>
        <h1 class="a_dash m-0 p-0 d-inline-block">Communities <small><span class="color-secondary">|</span></small></h1>
          <div class="row breadcrumbs-top pl-2 d-inline-block">
              <ol class="breadcrumb"> 
              <li class="breadcrumb-item">
              <a href="{{ route('communities') }}"> {{ $community->name }} </a>
              </li>
              <li class="breadcrumb-item active">Manage </li>
              </ol>
          </div>
      </div> 
      <div>
          <div class="btn-group">
              <a href="{{ route('communities') }}" class="add_button"><i class="fa fa-arrow-left position-relative"></i> Back</a>
          </div>
      </div>   
    </div>

    <div class="card">
        <div class="card-body">
            <div class="bottom_sp">
                <div class="col-lg-5 col-md-12 col-sm-6 float-left p-0">
                    <img src="{{asset('/uploads/'.$community->banner) }}">
                </div>
                <div class="col-lg-7 col-md-12 col-sm-6 float-left" id="edi_del_dd">
                    <h1>{{ $community->name }}<span>{{ $community->location }}</span></h1>
                    <h1>Description<span>{{ $community->description }}</span>
                                </h1>
                    <h1>Specifications<span>{{ $community->contact_person }}<br>
                                    {{ $community->contact_number}} <br>
                                    {{ $community->contact_email }}</span>
                                </h1>
                    <div class="man_commun">
                        <div class="e-d-d">
                            @if($community->status_id == 2)
                            <span><a class="a1 green" href="javascript:void(0);"><i class="fa fa-check"></i><strong>Active</strong></a></span> 
                            @else
                            <span><a class="a1 red text-success" href="javascript:void(0);" ><i class="fa fa-ban"></i><strong>Deactive</strong></a></span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-content collapse show">
            <div class="card-body p-0">
                <nav>
                    <div class="nav nav-tabs myTabSettings" role="tablist">
                        <a class="nav-item wf-20 nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" style="line-height: 30px;">COMMUNITY GALLERY</a>
                        <a class="nav-item wf-20 nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false" style="line-height: 30px;">COMMUNITY LOCATIONS</a>
                    </div>
                </nav>
                <div class="tab-content p-2" id="nav-tabContent">
                    <div class="tab-pane show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="grid-hover row" id="galleryrow"></div>
                    </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="col-lg-12">
                        <h3 class="loc-details">Location Details</h3>
                    </div>

                    <form action="javascript:void(0);" id="locationForm" name="locationForm" method="post" >
                        {{ csrf_field() }}

                            <div class="row">
                                <div class="form-group col-lg-3 col-md-3">
                                    <input id="pac-input" class="form-control" type="text" name="address" value="{{$community->marker}}" placeholder="Type here to find address on map" />
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <label for="companyName">Latitude</label>
                                    <input class="form-control" name="lat" type="text" placeholder="Latitude" id="input-latitude"  value="{{$community->lat}}" readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <label for="contact">Longitude</label>
                                    <input class="form-control" name="lng" type="text" placeholder="Lontgitude" id="input-longitude" value="{{$community->lng}}" readonly="readonly"/>
                                    </div>
                                </div>  
                                <div class="form-group col-lg-12">      
                                    <div id="map-canvas"  style="height:295px;width:100%;"></div>
                                </div>
                            </div> 
                        </form>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 float-left">
                            <h3 class="loc-details">Nearby Location</h3>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 float-left">
                            <div class="form-group row sort-by float-right">
                                <div class="dropdown" id="sp_right">
                                    <select name="type" id="type" class="form-control">
                                        <option value="hospital">Hospitals</option>
                                        <option value="school">Schools</option>
                                        <option value="restaurant">Restaurants</option>
                                        <option value="shopping_mall">Shopping Malls</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="f_mar">
                        <div class="table-responsive border-top">
                            <table class="table table-bordered table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th width="50px" class="text-left">Sr.No.</th>
                                        <th class="text-left">Name</th>
                                        <th class="text-left">Address</th>
                                        <th class="text-left">Distance (M)</th>
                                        <th class="text-left">Status</th>
                                    </tr>
                                </thead>
                                <tbody id="location_data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('cms/js/jscolor.js')  }}"></script>
<link rel="stylesheet" href="{{ asset('cms/css/gallery.css') }}">
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{asset('js/jquery.ajax-cross-origin.min.js')}}"></script>

<style type="text/css">
    #message {
        border: 16px solid #f3f3f3;
        /* Light grey */
        border-top: 16px solid #3498db;
        /* Blue */
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 2s linear infinite;
    }
    
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>

<style>
/* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
      #target {
        width: 345px;
      }
</style>

@endsection
@push('scripts')
<script type="text/javascript">
 var APP_URL = "{{url('/') }}";
    $(document).ready(function() {
        getGallery();
        $('.change_status').click(function() {
            $('#community').val($(this).attr('community_id'));
            $('#status').val($(this).attr('status_id'));
            $('#addStatus').modal('show');

        });
    });

    function getGallery() {
        $.ajax({
            type: 'get',
            url: '/api/get-gallery/<?= $community->id?>',
            data: {},
            success: function(data) {
                $('#galleryrow').html(data.gallery);
            }
        });
    }

    function search_near_locations(){
        $('#loader').show();
        var type = $('#type').val();
        var lat = $('#input-latitude').val();  
        var lng = $('#input-longitude').val();
        $.ajax({  
            url:"{{route('manager-nearby_locations')}}",  
            method:"POST",  
            data:{'_token': "{{csrf_token()}}",'lat':lat,'lng':lng,'type':type,'community_id':"{{ $community->id }}"},  
            success:function(result){
                $('#location_data').html(result.data);
                $('#loader').hide();
            } 
        }); 
    };  
      $('#type').change(function(){
        search_near_locations();
      }); 
      $(document).ready(function(){
        search_near_locations();
        });

 //https://developers-dot-devsite-v2-prod.appspot.com/maps/documentation/javascript/examples/places-searchbox
var map;
function initMap() {
  var map = new google.maps.Map(document.getElementById('map-canvas'), {
    //center: {lat: 48.0667, lng: -114.0895},
    center: {lat: <?= ($community->lat != '')?$community->lat:'48.0667';?>, lng: <?= ($community->lng !='')?$community->lng:'-114.0895';?>},
    zoom: <?= ($community->map_zoom != '')?$community->map_zoom:'6';?>,
    mapTypeId: <?= ($community->map_type_id != '')?"'".$community->map_type_id."'":'roadmap';?>
  });

  var marker = new google.maps.Marker({
    //position: {lat: 48.0667, lng: -114.0895},
    position: {lat: <?= ($community->lat != '')?$community->lat:'48.0667';?>, lng: <?= ($community->lng !='')?$community->lng:'-114.0895';?>},
    map: map,
    title: '<?= ($community->marker !='')?$community->marker:'Your title will be here';?>'
  });

  // This example adds a search box to a map, using the Google Place Autocomplete
      // feature. People can enter geographical searches. The search box will return a
      // pick list containing a mix of places and predicted search terms.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      
        /*var map = new google.maps.Map(document.getElementById('map-canvas'), {
          center: {lat: -33.8688, lng: 151.2195},
          //center: myLatLng,
          zoom: 13,
          mapTypeId: 'roadmap'
        });*/

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
          var zoom=map.getZoom();
          $('#map_zoom').val(zoom); //Added to detect dynamic zoom
        });
        google.maps.event.addListener( map, 'maptypeid_changed', function() { //Added to detect maptype id
            $('#map_type_id').val(map.getMapTypeId());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
            $('#input-latitude').val(place.geometry.location.lat());
            $('#input-longitude').val(place.geometry.location.lng());
            search_near_locations();
          });
          map.fitBounds(bounds);

        });

}
</script>
@endpush