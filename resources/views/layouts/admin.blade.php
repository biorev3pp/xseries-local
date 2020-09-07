<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title> X-Series360</title>
      <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
      <link href="{{ asset('cms/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">  
      <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('cms/css/bootstrap.min.css') }}">
      <link href="{{ asset('cms/css/sb-admin-2.min.css') }}" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{ asset('cms/css/vendors/material-vendors.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('cms/css/material.css') }}">
    
      <link rel="stylesheet" type="text/css" href="{{ asset('cms/css/bootstrap-extended.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('cms/css/material-extended.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('cms/css/material-colors.css') }}">

      <link rel="stylesheet" type="text/css" href="{{ asset('cms/css/material-vertical-menu-modern.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('cms/fonts/simple-line-icons/style.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('cms/css/vendors/datatables.min.css') }}">
      
      <link rel="stylesheet" type="text/css" href="{{ asset('cms/css/components.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('cms/css/core/style.css') }}">
      <link href="{{ asset('cms/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
      <link href="{{ asset('cms/css/custom2.css') }}" rel="stylesheet">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.css" rel="stylesheet">
      <!-- Date Range -->
       <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
      @if(Route::currentRouteName()=='view-community')
      <link rel="stylesheet" href="{{ asset('cms/css/gallery.css') }}">
      @endif
   </head>
   <style>
      .modal{
         z-index:11111;
      }
   </style>
   <body class="vertical-layout vertical-menu-modern material-vertical-layout material-layout 2-columns fixed-navbar pace-done menu-expanded" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

      @include('elements.admin.sidemenu')
   
      <div class="app-content content">
         <div class="content-wrapper" id="cus_qu">
            <div class="content-body">
               @yield('content')
            </div>
         </div>
      </div>
      @include('elements.admin.footer')
      <div id="loader" class="overlay" style="display: none;">
         <img src="{{ asset('images/white-loader.gif') }}">
      </div>
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
      <script src="{{ asset('admin/vendors/js/vendors.min.js') }}"></script>
      <script src="{{ asset('admin/js/core/libraries/jquery_ui/jquery-ui.min.js') }}"></script>
      
      <script src="{{ asset('admin/js/custom.js') }}"></script>
   
      <script src="{{ asset('admin/js/core/app-menu.js') }}"></script>
      <script src="{{ asset('admin/js/core/app.js') }}"></script>
      <script src="{{ asset('admin/js/scripts/ui/jquery-ui/navigations.js') }}"></script>
      <script src="https://cdn.jsdelivr.net/npm/select2@4.0.11/dist/js/select2.min.js"></script>
      <script src="{{ asset('admin/datatables/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('admin/datatables/dataTables.bootstrap4.min.js') }}"></script>
      <script src="{{ asset('admin/datatables/datatables-demo.js') }}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
      <script>
         $(document).ready(function(){
            $('.show-tooltip').tooltip();
            $.ajax({
               type:"get",
               url: "/api/site/settings",
               success: function(result){
                  $.each(result,function(ky,val){
                     if(val.name=='site_title'){
                        $('title').html(val.value);
                     }
                     if(val.name=='site_favicon'){
                        var link = document.querySelector("link[rel*='icon']") || document.createElement('link');
                        link.type = 'image/png';
                        link.rel = 'icon';
                        link.size= '16x16';
                        link.href = `/uploads/${val.value}`;
                     }
                  });
               }
            });
         })
      </script>
      <!-- HighCharts JS -->
    @if($menu == 'analytics')
      <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
      <script src="https://code.highcharts.com/highcharts.js"></script>
      <script>
         $(document).ready(function(){

            var filter_conditions_array = {
               "start_date"         : "",
               "end_date"           : "",
               "country_name"       : "",
               "state_name"         : "",
               "city_name"          : "",
               "type"               : "community",
               "home_id"            : '',
               "floor_id"           :'',
               "color_scheme_id"    : "",
               "elevation_type_id"  : "",
               "community_id"       : "",
            };

            // HighCharts
            var APP_URL = "{{url('/')}}";
            var options = { 
                  chart: {
                     renderTo: 'pie',
                     type: 'pie',
                     backgroundColor: "transparent",
                  },
                  title:{
                     text:"Option List Analytics"
                  },
                  plotOptions: {
                     series: {
                        dataLabels: {
                              enabled: false,
                              format: '{point.name}: {point.y:.1f}%'
                           }
                     }
                  },
                  series: [{
                     "name" : "Popularity",
                     data:[]
                  }],
                  tooltip: {
                        pointFormat: '<span style="color:{series.color}">{series.name}</span>: {point.y:.0f}%<br/>',
                        shared: true
                  }
            };
            
            // Range Datepicker
            var start_date;
            var end_date;
            $(function() {

               var start = moment().subtract(29, 'days');
               var end = moment();

               function cb(start, end) {
                  $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                  filter_conditions_array["start_date"] = start.format('YYYY-MM-DD');
                  filter_conditions_array["end_date"] = end.format('YYYY-MM-DD');
                  start_date = start.format('YYYY-MM-DD');
                  end_date = end.format('YYYY-MM-DD');
                  displayAnalyticsData(filter_conditions_array);
                  // console.log(end);
               }

               $('#reportrange').daterangepicker({
                  startDate: start,
                  endDate: end,
                  ranges: {
                     'Today': [moment(), moment()],
                     'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                     'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                     'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                     'This Month': [moment().startOf('month'), moment().endOf('month')],
                     'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                  }
               }, cb);

               cb(start, end);

            });
            //Displaying data in Pie and Table 
            function displayAnalyticsData(filter_conditions){
               $.ajax({
                  type:"post",
                  url: APP_URL+"/api/admin/analytics",
                  headers: 
                  {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  data: filter_conditions,

                  success:function(data){
                     options.title.text = data.title;
                     options.series[0].data = data.pie_chart_data;
                     var chart = new Highcharts.Chart(options);
                     $('.lots_list_analytics').html(data.lot_list_data);
                  }
               });
            }
            //Getting data of Countries
            $.ajax({
               type:"get",
               url: APP_URL+"/api/get-all-countries",
               success:function(result){
                  var display = '<option value="">Select Country</option>';
                  $.each(result,function(){
                     display += "<option value='"+this.country+"'>"+this.country+"</option>"; 
                  });
                  $("#country").html(display);
               }
            });

            //Getting data of states
            $("#country").on('change',function(){
               if($(this).val() == ""){
                  $("#state").html('<option value="">Select State</option>');
                  $("#city").html('<option value="">Select City</option>');

                  filter_conditions_array["country_name"] = $(this).val();
                  filter_conditions_array["state_name"] = "";
                  filter_conditions_array["city_name"] = "";
                  displayAnalyticsData(filter_conditions_array);
               }
               else{
                  // country data for analytics
                  filter_conditions_array["country_name"] = $(this).val();
                  filter_conditions_array["state_name"] = "";
                  filter_conditions_array["city_name"] = "";

                  displayAnalyticsData(filter_conditions_array);
                  $.ajax({
                     type:"get",
                     url: APP_URL+"/api/get-all-states/"+$(this).val(),
                     success:function(result){
                        var display = '<option value="">Select State</option>'
                        $.each(result,function(){
                           display += "<option value='"+this.state+"'>"+this.state+"</option>"; 
                        });
                        $("#state").html(display);
                     }
                  });
               }
            });

            
            //Getting data of cities
            $("#state").on('change',function(){
                if($(this).val() == ""){
                  $("#city").html('<option value="">Select City</option>');
                  filter_conditions_array["state_name"] = $(this).val();
                  filter_conditions_array["city_name"] = "";
                  displayAnalyticsData(filter_conditions_array);
               }
               else{
                  filter_conditions_array["state_name"] = $(this).val();
                  filter_conditions_array["city_name"] = "";
                  displayAnalyticsData(filter_conditions_array);
                  $.ajax({
                     type:"get",
                     url: APP_URL+"/api/get-all-cities/"+$(this).val(),
                     success:function(result){
                        var display = '<option value="">Select City</option>';
                        $.each(result,function(){
                           display += "<option value='"+this.city+"'>"+this.city+"</option>"; 
                        });
                        $("#city").html(display);
                     }
                  });
               }
            });

            // Cities data for analytics
            $("#city").on('change',function(){
               filter_conditions_array["city_name"] = $(this).val();
               displayAnalyticsData(filter_conditions_array);
            });

             //Getting data of communities dropdown in elevation tab
            function displayCommunitites(){
               $.ajax({
                  type:"get",
                  url: APP_URL+"/api/get-all-communities",
                  success:function(result){
                     var display = '<option value="">Select Community</option>';
                     $.each(result,function(ky){
                        display += "<option value='"+this.community.id+"'>"+this.community.name+"</option>"; 
                     });
                     $("#community").html(display);
                  }
               });
            }
            // Getting data of Communitites and elevation dropdown in Elevation Types tab
            function displayDropdownForElevationTypes(){
               $.ajax({
                  type:"get",
                  url: APP_URL+"/api/get-all-communities-type",
                  success:function(result){
                     var display = '<option value="">Select Community</option>';
                     $.each(result,function(ky){
                           display += "<option value='"+this.community.id+"'>"+this.community.name+"</option>"; 
                     });
                     $("#ele-type-community-dropdown").html(display);
                     filter_conditions_array["community_id"] = "";
                  }
               });
               $.ajax({
                  type:"post",
                  url: APP_URL+"/api/get-all-elevations",
                  headers: 
                  {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success:function(data){
                     var display_elevation='<option value="">Select Elevation</option>';
                     $.each(data,function(key){
                           display_elevation += "<option value='"+this.home.id+"'>"+this.home.title+"</option>"; 
                     });
                     $("#elevation-type-dropdown").html(display_elevation);
                     filter_conditions_array["home_id"] = "";
                  }
               });
            }

            //Getting data of community dropdown in lots tab
            function displayLotCommunities(){
               $.ajax({
                  type:"get",
                  url: APP_URL+"/api/get-all-communities-lot",
                  success:function(result){
                     var display ;
                     $.each(result,function(ky){
                        if(ky == 0){
                        display += "<option value='"+this.community.id+"' selected>"+this.community.name+"</option>";
                        filter_conditions_array["community_id"] = this.community.id;
                        displayAnalyticsData(filter_conditions_array); 
                        }
                        else{
                           display += "<option value='"+this.community.id+"'>"+this.community.name+"</option>"; 
                        }
                     });
                     $("#lot-community-dropdown").html(display);
                  }
               });
            }

            // Getting data of Communitites and elevation type dropdown in Color Scheme tab
            function displayDropdownsForColor(){
               $.ajax({
                  type:"get",
                  url: APP_URL+"/api/get-all-communities-color",
                  success:function(result){
                     var display = '<option value="">Select Community</option>';
                     $.each(result,function(ky){
                           display += "<option value='"+this.community.id+"'>"+this.community.name+"</option>"; 
                     });
                     $("#color-community-dropdown").html(display);
                     filter_conditions_array["community_id"] = "";
                  }
               });
               $.ajax({
                  type:"post",
                  url: APP_URL+"/api/get-all-elevation-types",
                  headers: 
                        {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },      
                  success:function(data){
                     var display_elevation_type ='<option value="">Select Elevation</option>';
                     var i = 0;
                     $.each(data.home,function(ky){
                           display_elevation_type += "<option value='"+this.home.id+"'>"+this.home.title+" - "+data.title[i]+"</option>"; 
                           i++;
                     });
                     $("#color-dropdown").html(display_elevation_type);
                     filter_conditions_array["elevation_type_id"] = "";
                  }
               });
            }

            //Getting data of community, elevation type and color scheme dropdown in upgrade tab
            function displayDropdownsForUpgrade(){
               $.ajax({
                  type:"get",
                  url: APP_URL+"/api/get-all-communities-upgrade",
                  success:function(response){
                  var display_com = '<option value="">Select Community</option>'; 
                  $.each(response,function(ky){
                     display_com += "<option value='"+this.community.id+"'>"+this.community.name+"</option>"; 
                  });
                  $("#upgrade-community-dropdown").html(display_com);
                  filter_conditions_array["community_id"] = "";
                  }
               });
               $.ajax({
                  type:"post",
                  url: APP_URL+"/api/get-all-elevation-types-upgrade",
                  headers: 
                     {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                  success:function(result){
                     var display = '<option value="">Select Elevation</option>';
                     var i = 0;
                     $.each(result.home,function(ky){
                           display += "<option value='"+this.home.id+"'>"+this.home.title+" - "+result.title[i]+"</option>"; 
                           i++;
                     });
                     $("#upgrade-elevation-dropdown").html(display);
                     $("#upgrade-color-dropdown").html('<option value="">Select Elevation First</option>');
                     filter_conditions_array["home_id"] = "";
                     filter_conditions_array["elevation_type_id"] = '';

                  }
               });
            }

            //Getting data of elevation and community dropdown in features tab
            function displayDropdownsForFeatures(){
               $.ajax({
               type:"get",
               url: APP_URL+"/api/get-all-communities",
               success:function(response){
                  var display_com = '<option value="">Select Community</option>';
                  $.each(response,function(index){
                        display_com += "<option value='"+this.community.id+"'>"+this.community.name+"</option>"; 
                  });
                  $("#feature-community-dropdown").html(display_com);
               }
               });
               $.ajax({
                  type:"post",
                  url: APP_URL+"/api/get-all-elevation-feature",
                  headers: 
                  {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success:function(result){
                     var display = '<option value="">Select Elevation</option>';
                     $.each(result,function(ky){
                           display += "<option value='"+this.home.id+"'>"+this.home.title+"</option>"; 
                     });
                     $("#feature-elevation-dropdown").html(display);
                  }
               });
               $("#feature-floor-dropdown").html('<option value="">Select Elevation First</option>');
            }
            
            // Community Dropdown in Elevation Tab
            $("#community").on("change",function(){
               filter_conditions_array["community_id"] = $(this).val();
               filter_conditions_array["type"] = "elevation";
               displayAnalyticsData(filter_conditions_array); 
            });

            // Community Dropdown in Elevation Type Tab
            $("#ele-type-community-dropdown").on("change",function(){
               filter_conditions_array["community_id"] = $(this).val();
               filter_conditions_array["type"] = "elevation-type";
               if($(this).val() == ""){
                  $.ajax({
                     type:"post",
                     url: APP_URL+"/api/get-all-elevations",
                     headers: 
                     {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     success:function(data){
                        var display_elevation='<option value="">Select Elevation</option>';
                        $.each(data,function(key){
                              display_elevation += "<option value='"+this.home.id+"'>"+this.home.title+"</option>"; 
                        });
                        $("#elevation-type-dropdown").html(display_elevation);
                        filter_conditions_array["home_id"] = "";
                        displayAnalyticsData(filter_conditions_array);
                     }
                  });
               }
               else{
               $.ajax({
                     type:"post",
                     url: APP_URL+"/api/get-all-elevations",
                     headers: 
                     {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     data:{"community_id":$(this).val()},
                     success:function(data){
                        var display_elevation = '<option value="">Select Elevation</option>';
                        $.each(data,function(key){
                              display_elevation += "<option value='"+this.home.id+"'>"+this.home.title+"</option>"; 
                        });
                        $("#elevation-type-dropdown").html(display_elevation);
                        filter_conditions_array["home_id"] = "";
                        displayAnalyticsData(filter_conditions_array);
                     }
                  });
               }
            }); 

            // Community dropdown in lots tab
            $("#lot-community-dropdown").on("change",function(){
               filter_conditions_array["community_id"] = $(this).val();
               filter_conditions_array["type"] = "lot";
               displayAnalyticsData(filter_conditions_array); 
            });

            // Community dropdown in color scheme tab
            $("#color-community-dropdown").on("change",function(){
               filter_conditions_array["community_id"] = $(this).val();
               filter_conditions_array["type"] = "color-scheme";
               if($(this).val() == ""){
                  $.ajax({
                     type:"post",
                     url: APP_URL+"/api/get-all-elevation-types",
                     headers: 
                           {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                           },      
                     success:function(data){
                        var display_elevation_type ='<option value="">Select Elevation</option>';
                        var i = 0;
                        $.each(data.home,function(ky){
                              display_elevation_type += "<option value='"+this.home.id+"'>"+this.home.title+" - "+data.title[i]+"</option>"; 
                              i++;
                        });
                        $("#color-dropdown").html(display_elevation_type);
                        filter_conditions_array["home_id"] = "";
                        filter_conditions_array["elevation_type_id"] = "";
                        displayAnalyticsData(filter_conditions_array); 

                     }
                  });
               }
               else{
                  $.ajax({
                     type:"post",
                     url: APP_URL+"/api/get-all-elevation-types",
                     headers: 
                           {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                           },
                     data:{"community_id":$(this).val()},      
                     success:function(data){
                        var display_elevation_type ='<option value="">Select Elevation</option>';
                        var i = 0;
                        $.each(data.home,function(ky){
                              display_elevation_type += "<option value='"+this.home.id+"'>"+this.home.title+" - "+data.title[i]+"</option>"; 
                              i++;
                        });
                        $("#color-dropdown").html(display_elevation_type);
                        filter_conditions_array["home_id"] = "";
                        filter_conditions_array["elevation_type_id"] = "";
                        displayAnalyticsData(filter_conditions_array); 

                     }
                  });
               }
            });

            // Community Dropdown in upgrade tab
            $("#upgrade-community-dropdown").on("change",function(){
               filter_conditions_array["community_id"] = $(this).val();
               filter_conditions_array["type"] = "upgrade";
               if($(this).val() == ""){
                  $.ajax({
                     type:"post",
                     url: APP_URL+"/api/get-all-elevation-types-upgrade",
                     headers: 
                        {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                     success:function(result){
                        var display = '<option value="">Select Elevation</option>';
                        var i = 0;
                        $.each(result.home,function(ky){
                              display += "<option value='"+this.home.id+"'>"+this.home.title+" - "+result.title[i]+"</option>"; 
                              i++;
                        });
                        $("#upgrade-elevation-dropdown").html(display);
                        $("#upgrade-color-dropdown").html('<option value="">Select Elevation First</option>');
                        filter_conditions_array["home_id"] = "";
                        filter_conditions_array["elevation_type_id"] = '';
                        displayAnalyticsData(filter_conditions_array);
                     }
                  });
               }
               else{
                  $.ajax({
                     type:"post",
                     url: APP_URL+"/api/get-all-elevation-types-upgrade",
                     headers: 
                     {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     data:{"community_id":$(this).val()},
                     success:function(result){
                        var display = '<option value="">Select Elevation</option>';
                        var i = 0;
                        $.each(result.home,function(ky){
                              display += "<option value='"+this.home.id+"'>"+this.home.title+" - "+result.title[i]+"</option>"; 
                              i++;
                        });
                        $("#upgrade-elevation-dropdown").html(display);
                        $("#upgrade-color-dropdown").html('<option value="">Select Elevation First</option>');
                        filter_conditions_array["home_id"] = '';
                        filter_conditions_array["elevation_type_id"] = '';

                        displayAnalyticsData(filter_conditions_array);
                     }
                  });
               }
            });

            // Community Dropdown in Feature tab
            $("#feature-community-dropdown").on("change",function(){
               filter_conditions_array["community_id"] = $(this).val();
               filter_conditions_array["type"] = "feature";
               if($(this).val() == ""){
                  $.ajax({
                     type:"post",
                     url: APP_URL+"/api/get-all-elevation-feature",
                     headers: 
                     {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     success:function(result){
                        var display = '<option value="">Select Elevation</option>';
                        $.each(result,function(ky){
                              display += "<option value='"+this.home.id+"'>"+this.home.title+"</option>"; 
                        });
                        $("#feature-elevation-dropdown").html(display);
                        filter_conditions_array["home_id"] = "";
                        filter_conditions_array["floor_id"] = "";
                        $("#feature-floor-dropdown").html('<option value="">Select Elevation First</option>');
                        displayAnalyticsData(filter_conditions_array);
                     }
                  });
               }
               else{
               $.ajax({
                     type:"post",
                     url: APP_URL+"/api/get-all-elevation-feature",
                     headers: 
                     {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     data:{'community_id':$(this).val()},
                     success:function(result){
                        var display = '<option value="">Select Elevation</option>';
                        $.each(result,function(ky){
                           display += "<option value='"+this.home.id+"'>"+this.home.title+"</option>"; 
                        });
                        $("#feature-elevation-dropdown").html(display);
                        $("#feature-floor-dropdown").html('<option value="">Select Elevation First</option>');
                        filter_conditions_array["home_id"] = "";
                        filter_conditions_array["floor_id"] = "";
                        displayAnalyticsData(filter_conditions_array);
                     }
                  });
               }
            });

            // Elevation Dropdown in Elevation Type Tab
            $("#elevation-type-dropdown").on("change",function(){
               filter_conditions_array["home_id"] = $(this).val();
               filter_conditions_array["type"] = "elevation-type";
               displayAnalyticsData(filter_conditions_array); 
            });

            // Elevation Dropdown in Color Scheme Tab
            $("#color-dropdown").on("change",function(){
               // filter_conditions_array["home_id"] = $(this).val();
               filter_conditions_array["elevation_type_id"] = $(this).val();
               filter_conditions_array["type"] = "color-scheme";
               displayAnalyticsData(filter_conditions_array); 
            });

            // Elevation Dropdown in Upgrade Tab
            $("#upgrade-elevation-dropdown").on("change",function(){
               filter_conditions_array["elevation_type_id"] = $(this).val();
               filter_conditions_array["type"] = "upgrade";
               if($(this).val() == ""){
                  $("#upgrade-color-dropdown").html('<option value="">Select Elevation First</option>'); 
                  filter_conditions_array["color_scheme_id"] = "";
                  displayAnalyticsData(filter_conditions_array);
               }
               else{
                  $.ajax({
                     type:"get",
                     url: APP_URL+"/api/get-all-color-schemes/"+$(this).val(),
                     success:function(data){
                        var display_color_scheme = '<option value="">Select Color Scheme</option>';
                        $.each(data,function(key){
                              display_color_scheme += "<option value='"+this.color_scheme.id+"'>"+this.color_scheme.title+"</option>"; 
                        });
                        $("#upgrade-color-dropdown").html(display_color_scheme); 
                        filter_conditions_array["color_scheme_id"] = "";
                        displayAnalyticsData(filter_conditions_array);
                     }
                  });
               }
            });

            // Elevation Dropdown in Feature Tab
            $("#feature-elevation-dropdown").on("change",function(){
               filter_conditions_array["home_id"] = $(this).val();
               filter_conditions_array["type"] = "feature";
               if($(this).val() == ""){
                  var display_floor = '<option value="">Select Elevation First</option>';
                  filter_conditions_array["floor_id"] = "";
                  $("#feature-floor-dropdown").html(display_floor); 
                  displayAnalyticsData(filter_conditions_array);
               }
               else{
               $.ajax({
                  type:"get",
                  url: APP_URL+"/api/get-all-floors/"+$(this).val(),
                  success:function(data){
                     var display_floor = '<option value="">Select Floor</option>' ;
                     $.each(data,function(key){
                           display_floor += "<option value='"+this.floor.id+"'>"+this.floor.title+"</option>"; 
                     });
                     $("#feature-floor-dropdown").html(display_floor); 
                     filter_conditions_array["floor_id"] = "";
                     displayAnalyticsData(filter_conditions_array);
                  }
               });
               }
            }); 

            // Color Scheme Dropdown in Upgrade Tab
            $("#upgrade-color-dropdown").on("change",function(){
               filter_conditions_array["color_scheme_id"] = $(this).val();
               filter_conditions_array["type"] = "upgrade";
               displayAnalyticsData(filter_conditions_array); 
            });

            // Floor Dropdown in Feature Tab
            $("#feature-floor-dropdown").on("change",function(){
               filter_conditions_array["floor_id"] = $(this).val();
               filter_conditions_array["type"] = "feature";
               displayAnalyticsData(filter_conditions_array); 
            });

            // Communities Tab Click
            $("#nav-com-tab").click(function(){
               filter_conditions_array["type"] = "community";
               filter_conditions_array["community_id"] = "";
               filter_conditions_array["home_id"] = "";
               filter_conditions_array["floor_id"] = '';
               displayAnalyticsData(filter_conditions_array); 
            });

            // Elevation Tab Click
            $("#nav-ele-tab").click(function(){
               filter_conditions_array["type"] = "elevation";
               filter_conditions_array["community_id"] = "";
               filter_conditions_array["home_id"] = "";
               filter_conditions_array["floor_id"] = '';
               displayCommunitites();
               displayAnalyticsData(filter_conditions_array); 
            }); 

            // Elevation Type Tab Click
            $("#nav-eletype-tab").click(function(){
               filter_conditions_array["type"] = "elevation-type";
               filter_conditions_array["color_scheme_id"] = '';
               filter_conditions_array["home_id"] = "";
               filter_conditions_array["community_id"] = "";
               filter_conditions_array["elevation_type_id"] = '';
               displayDropdownForElevationTypes();
               displayAnalyticsData(filter_conditions_array);
            });

            // Lots Tab Click
            $("#nav-eletype-tab").click(function(){
               filter_conditions_array["type"] = "lot";
               filter_conditions_array["community_id"] = "";
               displayLotCommunities();
            });

            // Color Scheme Tab Click
            $("#nav-color-tab").click(function(){
               filter_conditions_array["type"] = "color-scheme";
               filter_conditions_array["color_scheme_id"] = '';
               filter_conditions_array["community_id"] = "";
               filter_conditions_array["home_id"] = "";
               filter_conditions_array["elevation_type_id"] = '';
               displayDropdownsForColor();
               displayAnalyticsData(filter_conditions_array);  
            });

            // Upgrades Tab Click
            $("#nav-upgrade-tab").click(function(){
               filter_conditions_array["type"] = "upgrade";
               filter_conditions_array["community_id"] = "";
               filter_conditions_array["elevation_type_id"] = '';
               filter_conditions_array["home_id"] = "";
               filter_conditions_array["color_scheme_id"] = '';
               displayDropdownsForUpgrade();
               displayAnalyticsData(filter_conditions_array);
            });

            //Features Tab Click
            $('#nav-feature-tab').click(function(){
               filter_conditions_array["type"] = "feature";
               filter_conditions_array["community_id"] = "";
               filter_conditions_array["floor_id"] = "";
               filter_conditions_array["home_id"] = "";
               displayDropdownsForFeatures();
               displayAnalyticsData(filter_conditions_array); 
            });

            function downloadCSV(csv, filename) {
               var csvFile;
               var downloadLink;

               // CSV file
               csvFile = new Blob([csv], {type: "text/csv"});

               // Download link
               downloadLink = document.createElement("a");

               // File name
               downloadLink.download = filename;

               // Create a link to the file
               downloadLink.href = window.URL.createObjectURL(csvFile);

               // Hide download link
               downloadLink.style.display = "none";

               // Add the link to DOM
               document.body.appendChild(downloadLink);

               // Click download link
               downloadLink.click();
               document.body.removeChild(downloadLink);
            }

            function exportCommunityTableToCSV(filename) {
               var csv = [];

               // Declaring Variables
               var country_head;
               var state_head;
               var selected_country_val;
               var selected_state_val;
               var city_head;
               var selected_city_val;
               var date_head = "Date Range";
               var selected_date_val = start_date+' - '+end_date;

               if($("#country option:selected").val() != ""){
                  country_head = "Country";
                  selected_country_val = $("#country option:selected").text();
               }
               else{
                  country_head = "";
                  selected_country_val = "";
               }

               if($("#state option:selected").val() != ""){
                  state_head = "State";
                  selected_state_val = $("#state option:selected").text();
               }
               else{
                  state_head = "";
                  selected_state_val = "";
               }

               if($("#city option:selected").val() != ""){
                  city_head = "City";
                  selected_city_val = $("#city option:selected").text();
               }
               else{
                  city_head = "";
                  selected_city_val = "";
               }

               csv.push([country_head, state_head, city_head, date_head].join(","));
               csv.push([selected_country_val, selected_state_val, selected_city_val, selected_date_val].join(","));
               csv.push("");
               var rows = document.querySelectorAll("#community_table tr");
               for (var i = 0; i < rows.length; i++) {
                  var row = [], cols = rows[i].querySelectorAll("#community_table td, #community_table th");
                  for (var j = 0; j < cols.length; j++) 
                     row.push(cols[j].innerText);  
                  csv.push(row.join(","));        
               }
               // Download CSV file
               downloadCSV(csv.join("\n"), filename);
            }

            function exportElevationTableToCSV(filename) {
               var csv = [];

               // Declaring Variables
               var com_head;
               var selected_com_val;
               var country_head;
               var state_head;
               var selected_country_val;
               var selected_state_val;
               var city_head;
               var selected_city_val;
               var date_head = "Date Range";
               var selected_date_val = start_date+' - '+end_date;

               if($("#community option:selected").val() != ""){
                  com_head = "Community";
                  selected_com_val = $("#community option:selected").text();
               }
               else{
                  com_head = "";
                  selected_com_val = "";
               }
               if($("#country option:selected").val() != ""){
                  country_head = "Country";
                  selected_country_val = $("#country option:selected").text();
               }
               else{
                  country_head = "";
                  selected_country_val = "";
               }

               if($("#state option:selected").val() != ""){
                  state_head = "State";
                  selected_state_val = $("#state option:selected").text();
               }
               else{
                  state_head = "";
                  selected_state_val = "";
               }

               if($("#city option:selected").val() != ""){
                  city_head = "City";
                  selected_city_val = $("#city option:selected").text();
               }
               else{
                  city_head = "";
                  selected_city_val = "";
               }
               
               csv.push([com_head, country_head, state_head, city_head, date_head].join(","));
               csv.push([selected_com_val, selected_country_val, selected_state_val, selected_city_val, selected_date_val].join(","));
               csv.push("");
               var rows = document.querySelectorAll("#elevation_table tr");
               for (var i = 0; i < rows.length; i++) {
                  var row = [], cols = rows[i].querySelectorAll("#elevation_table td, #elevation_table th");
                  for (var j = 0; j < cols.length; j++) 
                     row.push(cols[j].innerText);
                  csv.push(row.join(","));        
               }
               // Download CSV file
               downloadCSV(csv.join("\n"), filename);
            }

            function exportEleTypeTableToCSV(filename) {
               var csv = [];

               // Declaring Variables
               var com_head;
               var selected_com_val;
               var ele_head;
               var selected_ele_val;
               var country_head;
               var state_head;
               var selected_country_val;
               var selected_state_val;
               var city_head;
               var selected_city_val;
               var date_head = "Date Range";
               var selected_date_val = start_date+' - '+end_date;

               if($("#ele-type-community-dropdown option:selected").val() != ""){
                  com_head = "Community";
                  selected_com_val = $("#ele-type-community-dropdown option:selected").text();
               }
               else{
                  com_head = "";
                  selected_com_val = "";
               }
               if($("#elevation-type-dropdown option:selected").val() != ""){
                  ele_head = "Elevation";
                  selected_ele_val = $("#elevation-type-dropdown option:selected").text();
               }
               else{
                  ele_head = "";
                  selected_ele_val = "";
               }
               if($("#country option:selected").val() != ""){
                  country_head = "Country";
                  selected_country_val = $("#country option:selected").text();
               }
               else{
                  country_head = "";
                  selected_country_val = "";
               }

               if($("#state option:selected").val() != ""){
                  state_head = "State";
                  selected_state_val = $("#state option:selected").text();
               }
               else{
                  state_head = "";
                  selected_state_val = "";
               }

               if($("#city option:selected").val() != ""){
                  city_head = "City";
                  selected_city_val = $("#city option:selected").text();
               }
               else{
                  city_head = "";
                  selected_city_val = "";
               }

               csv.push([com_head, ele_head, country_head, state_head, city_head, date_head].join(","));
               csv.push([selected_com_val, selected_ele_val, selected_country_val, selected_state_val, selected_city_val, selected_date_val].join(","));
               csv.push("");

               var rows = document.querySelectorAll("#ele_type_table tr");
               
               for (var i = 0; i < rows.length; i++) {
                  var row = [], cols = rows[i].querySelectorAll("#ele_type_table td, #ele_type_table th");
                  
                  for (var j = 0; j < cols.length; j++) 
                        row.push(cols[j].innerText);
                  
                  csv.push(row.join(","));        
               }

               // Download CSV file
               downloadCSV(csv.join("\n"), filename);
            }

            function exportLotTableToCSV(filename) {
               var csv = [];

               // Declaring Variables
               var com_head;
               var selected_com_val;
               var country_head;
               var state_head;
               var selected_country_val;
               var selected_state_val;
               var city_head;
               var selected_city_val;
               var date_head = "Date Range";
               var selected_date_val = start_date+' - '+end_date;

               if($("#lot-community-dropdown option:selected").val() != ""){
                  com_head = "Community";
                  selected_com_val = $("#lot-community-dropdown option:selected").text();
               }
               else{
                  com_head = "";
                  selected_com_val = "";
               }
               if($("#country option:selected").val() != ""){
                  country_head = "Country";
                  selected_country_val = $("#country option:selected").text();
               }
               else{
                  country_head = "";
                  selected_country_val = "";
               }

               if($("#state option:selected").val() != ""){
                  state_head = "State";
                  selected_state_val = $("#state option:selected").text();
               }
               else{
                  state_head = "";
                  selected_state_val = "";
               }

               if($("#city option:selected").val() != ""){
                  city_head = "City";
                  selected_city_val = $("#city option:selected").text();
               }
               else{
                  city_head = "";
                  selected_city_val = "";
               }

               csv.push([com_head, country_head, state_head, city_head, date_head].join(","));
               csv.push([selected_com_val, selected_country_val, selected_state_val, selected_city_val, selected_date_val].join(","));
               csv.push("");
            
               var rows = document.querySelectorAll("#lots_table tr");
               for (var i = 0; i < rows.length; i++) {
                  var row = [], cols = rows[i].querySelectorAll("#lots_table td, #lots_table th");
                  
                  for (var j = 0; j < cols.length; j++) 
                        row.push(cols[j].innerText);
                  
                  csv.push(row.join(","));
               }
               

               // Download CSV file
               downloadCSV(csv.join("\n"), filename);
            }

            function exportColorTableToCSV(filename) {
               var csv = [];

               // Declaring Variables
               var com_head;
               var selected_com_val;
               var ele_head;
               var selected_ele_val;
               var country_head;
               var state_head;
               var selected_country_val;
               var selected_state_val;
               var city_head;
               var selected_city_val;
               var date_head = "Date Range";
               var selected_date_val = start_date+' - '+end_date;

               if($("#color-community-dropdown option:selected").val() != ""){
                  com_head = "Community";
                  selected_com_val = $("#color-community-dropdown option:selected").text();
               }
               else{
                  com_head = "";
                  selected_com_val = "";
               }

               if($("#color-dropdown option:selected").val() != ""){
                  ele_head = "Elevation Type";
                  selected_ele_val = $("#color-dropdown option:selected").text();
               }
               else{
                  ele_head = "";
                  selected_ele_val = "";
               }
               if($("#country option:selected").val() != ""){
                  country_head = "Country";
                  selected_country_val = $("#country option:selected").text();
               }
               else{
                  country_head = "";
                  selected_country_val = "";
               }

               if($("#state option:selected").val() != ""){
                  state_head = "State";
                  selected_state_val = $("#state option:selected").text();
               }
               else{
                  state_head = "";
                  selected_state_val = "";
               }

               if($("#city option:selected").val() != ""){
                  city_head = "City";
                  selected_city_val = $("#city option:selected").text();
               }
               else{
                  city_head = "";
                  selected_city_val = "";
               }

               csv.push([com_head, ele_head, country_head, state_head, city_head, date_head].join(","));
               csv.push([selected_com_val, selected_ele_val, selected_country_val, selected_state_val, selected_city_val, selected_date_val].join(","));
               csv.push("");

               var rows = document.querySelectorAll("#color_table tr");
               
               for (var i = 0; i < rows.length; i++) {
                  var row = [], cols = rows[i].querySelectorAll("#color_table td, #color_table th");
                  
                  for (var j = 0; j < cols.length; j++) 
                        row.push(cols[j].innerText);
                  
                  csv.push(row.join(","));        
               }

               // Download CSV file
               downloadCSV(csv.join("\n"), filename);
            }

            function exportUpgradeTableToCSV(filename) {
               var csv = [];

               // Declaring Variables
               var com_head;
               var selected_com_val;
               var ele_head;
               var selected_ele_val;
               var color_head;
               var selected_color_val;
               var country_head;
               var state_head;
               var selected_country_val;
               var selected_state_val;
               var city_head;
               var selected_city_val;
               var date_head = "Date Range";
               var selected_date_val = start_date+' - '+end_date;

               if($("#upgrade-community-dropdown option:selected").val() != ""){
                  com_head = "Community";
                  selected_com_val = $("#upgrade-community-dropdown option:selected").text();
               }
               else{
                  com_head = "";
                  selected_com_val = "";
               }

               ele_head = "Elevation Type";
               selected_ele_val = $("#color-dropdown option:selected").text();

               color_head = "Color Scheme";
               selected_color_val = $("#upgrade-color-dropdown option:selected").text();

               if($("#country option:selected").val() != ""){
                  country_head = "Country";
                  selected_country_val = $("#country option:selected").text();
               }
               else{
                  country_head = "";
                  selected_country_val = "";
               }

               if($("#state option:selected").val() != ""){
                  state_head = "State";
                  selected_state_val = $("#state option:selected").text();
               }
               else{
                  state_head = "";
                  selected_state_val = "";
               }

               if($("#city option:selected").val() != ""){
                  city_head = "City";
                  selected_city_val = $("#city option:selected").text();
               }
               else{
                  city_head = "";
                  selected_city_val = "";
               }

               csv.push([com_head, ele_head, color_head, country_head, state_head, city_head, date_head].join(","));
               csv.push([selected_com_val, selected_ele_val, selected_color_val, selected_country_val, selected_state_val, selected_city_val, selected_date_val].join(","));
               csv.push("");

               var rows = document.querySelectorAll("#upgrade_table tr");
               
               for (var i = 0; i < rows.length; i++) {
                  var row = [], cols = rows[i].querySelectorAll("#upgrade_table td, #upgrade_table th");
                  
                  for (var j = 0; j < cols.length; j++) 
                        row.push(cols[j].innerText);
                  
                  csv.push(row.join(","));        
               }

               // Download CSV file
               downloadCSV(csv.join("\n"), filename);
            }

            function exportFeatureTableToCSV(filename) {
               var csv = [];
               // Declaring Variables
               var com_head;
               var selected_com_val;
               var ele_head;
               var selected_ele_val;
               var floor_head;
               var selected_floor_val;
               var country_head;
               var state_head;
               var selected_country_val;
               var selected_state_val;
               var city_head;
               var selected_city_val;
               var date_head = "Date Range";
               var selected_date_val = start_date+' - '+end_date;

               if($("#feature-community-dropdown option:selected").val() != ""){
                  com_head = "Community";
                  selected_com_val = $("#feature-community-dropdown option:selected").text();
               }
               else{
                  com_head = "";
                  selected_com_val = "";
               }

               if($("#feature-elevation-dropdown option:selected").val() != ""){
                  ele_head = "Elevation";
                  selected_ele_val = $("#feature-elevation-dropdown option:selected").text();
               }
               else{
                  ele_head = "";
                  selected_ele_val = "";
               }

               if($("#feature-floor-dropdown option:selected").val() != ""){
                  floor_head = "Floor";
                  selected_floor_val = $("#feature-floor-dropdown option:selected").text();
               }
               else{
                  floor_head = "";
                  selected_floor_val = "";
               }

               if($("#country option:selected").val() != ""){
                  country_head = "Country";
                  selected_country_val = $("#country option:selected").text();
               }
               else{
                  country_head = "";
                  selected_country_val = "";
               }

               if($("#state option:selected").val() != ""){
                  state_head = "State";
                  selected_state_val = $("#state option:selected").text();
               }
               else{
                  state_head = "";
                  selected_state_val = "";
               }

               if($("#city option:selected").val() != ""){
                  city_head = "City";
                  selected_city_val = $("#city option:selected").text();
               }
               else{
                  city_head = "";
                  selected_city_val = "";
               }
               csv.push([com_head, ele_head, floor_head ,country_head, state_head, city_head, date_head].join(","));
               csv.push([selected_com_val, selected_ele_val, selected_floor_val, selected_country_val, selected_state_val, selected_city_val, selected_date_val].join(","));
               csv.push("");
               var rows = document.querySelectorAll("#feature_table tr");
               for (var i = 0; i < rows.length; i++) {
                  var row = [], cols = rows[i].querySelectorAll("#feature_table td, #feature_table th"); 
                  for (var j = 0; j < cols.length; j++) 
                        row.push(cols[j].innerText);
                  
                  csv.push(row.join(","));        
               }
               // Download CSV file
               downloadCSV(csv.join("\n"), filename);
            }

            $('#community-csv').click(function(){
               exportCommunityTableToCSV('Community-Analytics-Report.csv');
            });
            $('#elevation-csv').click(function(){
               exportElevationTableToCSV('Elevation-Analytics-Report.csv');
            });
            $('#ele-type-csv').click(function(){
               exportEleTypeTableToCSV('Elevation-Type-Analytics-Report.csv');
            });
            $('#lot-csv').click(function(){
               exportLotTableToCSV('Lot-Analytics-Report.csv');
            });
            $('#color-csv').click(function(){
               exportColorTableToCSV('Color-Scheme-Analytics-Report.csv');
            });
            $('#upgrade-csv').click(function(){
               exportUpgradeTableToCSV('Upgrades-Analytics-Report.csv');
            });
            $('#feature-csv').click(function(){
               exportFeatureTableToCSV('Feature-Analytics-Report.csv');
            });
         });      
      </script>
      @endif

      @if(Route::currentRouteName() == 'view-community' || Route::currentRouteName() == 'manager-view-community')
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDW-MNsJkIli84no9ZFtyx5uJrEUFPCACE&libraries=places,drawing&callback=initMap" async defer></script>
      @endif
      
      @if(Route::currentRouteName() == 'estimates')
      <script>
         function viewMore(id)
         {
            $.ajax({
               type: 'get',
               url: '/api/user-estimate-list/'+id,
               headers: 
               {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               success: function(result){
                     console.log(result);
                     $('#userFList').html(result);
                     $('#modal-view').modal('show');
               }
            })
         }
      </script>
      @endif
      @stack('scripts')
   </body>
</html>
