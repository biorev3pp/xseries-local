@extends('layouts.admin')
   @section('content')
   <link rel="stylesheet" href="{{asset('Xseries-new-ui/dropzone/dropzone.css')}}">
   <link rel="stylesheet" href="{{asset('Xseries-new-ui/dropzone/basic.css')}}">
   <style>
   .dropzone {
      border: 2px dashed #666;
      border-radius: 5px;
      background: white;
   }
   #ss_step_div{
	display: block;
}

.containers{
	display:none;
}

#syncresponse{
	position:relative;
}

th .form-control-checkbox,
td .form-control-checkbox {
	float: right
}

.form-control-checkbox {
	height: 18px;
	width: 18px;
	cursor: pointer
}

.step-2-tbl thead {
	border: 1px solid #f6f6f6;
	background: #ccc
}

.step-2-tbl th {
	padding: 10px 8px!important;
	text-align: center
}

.step-2-tbl td {
	padding: 8px!important;
	text-align: center
}

.step-2-tbl p.ds_old_value {
	margin: 0 0 5px;
	padding: 0 0 5px
}

.step-2-tbl p.ds_new_value {
	margin: 0;
	font-weight: 600;
	color: #F44336
}

.step-2-tbl .btn {
	box-shadow: none
}

.sync-container {
	padding: 15px
}

.fix-sync h6 {
	font-weight: 600
}

a.add_button.active {
	background: #003a8b
}

.sync-process ul {
	margin: 0;
	padding: 0
}

.sync-process ul li:not(:first-child) a::before {
	position: absolute;
	content: "";
	height: 8px;
	width: 87px;
	background: #6c757d;
	z-index: 9;
	top: 16px;
	right: 37px
}

.sync-process li {
	list-style: none;
	display: inline-block;
	width: 120px
}

.sync-process a {
	position: relative;
	margin-right: 1px!important;
	z-index: 111;
	border-radius: 50%;
	width: 40px;
	height: 40px;
	display: inline-block;
	line-height: 40px;
	font-size: 19px
}

.sync-process ul li:not(:first-child) a.active::before,
.sync-process ul li:not(:first-child) a.complete::before {
	background-color: #007bff!important;
	right: 38px;
}

.sync-process a.active {
	color: #fff!important;
	background-color: #007bff!important
}

.sync-process a.incomplete {
	color: #fff!important;
	background-color: #6c757d!important
}

.sync-process a.complete {
	color: #fff!important;
	background-color: #007bff!important
}

.fix-sync {
	height: calc(100vh - 240px);
	overflow: hidden;
	background: #fff;
	border: 1px solid #e4e4e4;
	border-radius: 7px;
}

.fix-sync h3 {
	text-align: center;
	font-weight: 600;
	text-transform: uppercase;
	margin-top: 10px;
}

.scrollable-table {
	height: calc(100vh - 475px);
	overflow: auto
}

.bg-sdanger {
	background-color: #fadbd8!important
}

.bg-ssuccess {
	background-color: #d2f4e8!important
}

.sr-ans {
	margin: 20px 30px 30px;
}

.sr-ans i {
	font-weight: 600;
	font-size: 36px;
	border: 2px solid #aaa;
	padding: 27px 20px;
	border-radius: 69%
}

.sr-ans span {
	display: block;
	margin-top: 15px;
	font-weight: 500;
	font-size: 19px;
	margin-bottom: 10px
}

.sr-ans ul.same-btns {
	list-style: none;
	margin-bottom: .5rem;
}

.sr-ans ul.same-btns li {
	display: inline-block;
	padding: 0 8px;
	line-height: 15px
}

.sr-ans ul.same-btns li:not(:first-child) {
	border-left: 1px solid
}

.sr-ans ul.same-btns li a {
	font-weight: 500;
	text-transform: uppercase
}

.sr-ans ul.sys-btns {
	list-style: none
}

.sr-ans ul.sys-btns li {
	display: inline-block;
	padding: 0 8px;
	line-height: 15px
}

.sr-ans ul.sys-btns li:not(:first-child) {
	border-left: 1px solid
}

.sr-ans ul.sys-btns li a {
	font-weight: 500;
	text-transform: uppercase
}

.sr-synop {
	padding: 0 20px 20px;
	text-align: center
}

.sr-synop h6 {
	text-transform: uppercase;
	font-size: 17px
}

.sr-synop p {
	font-size: 16px
}

tr.bg-ssuccess input[type="checkbox"],
tr.bg-sdanger input[type="checkbox"] {
	display: none;
}

#bulk-action-box {
	padding: 8px 10px;
	margin-bottom: 8px;
	background: #f4f4f4;
	border: 1px solid #e4e4e4;
}

.btn-info:focus{
	background-color: #f56954!important;
}

.btn-info{
	background-color: #f56954!important;
	transition: 0.3s ease all;
}

.btn-info:hover, #backButton:hover{
	background-color: #003a8b!important;
}

.nav-pills .nav-item .nav-link.active{
	background: #f56954;
}

.nav-pills .nav-item{
	margin: 0 3px 3px 0;
}

.nav-pills .nav-link{
	font-weight:600;
	background-color: rgba(0, 0, 0, 0.12);
}

#pills-communities div.row div h6{
	padding-bottom: .5rem;
}

.footer-buttons{
    position: absolute;
    text-align: center;
    right: 15px;
    bottom: 15px;
}

.mapping-fields-wrapper{
	height: calc(100vh - 480px);
	overflow: auto;
}

#backButton{
	display: none;
	background-color: #313131!important;
	transition: 0.3s ease background-color;
}

#importOptions{
	max-width: 300px;
	width: 100%;
}
@media(max-width:1200px){
	.fix-sync{
		overflow: auto;
	}
	.mapping-fields-wrapper{
		height: auto;
		overflow: hidden;
		padding-bottom: 30px;
	}
	.footer-buttons{
		right: 30px;
	}
}
   </style>
<div class="container-fluid page-wrapper">
   <div class="row justify-content-between pl-1 pr-1 align-items-center">
      <h1 class="a_dash m-0">Bulk Images Upload</h1> 
      <div class="btn-group">
         <a style="position:relative;" href="{{route('uploads')}}" class="add_button"><i style="top:0;" class="fa fa-arrow-left"></i> Back</a>
      </div>
   </div>
   <div id="syncresponse">
      <div class="sync-process text-center mb-1">
         <ul class="text-center">
            <li>
               <a class="active text-center" id="ss_step">1</a>
            </li>
            <li>
               <a class="incomplete text-center" id="drm_step">2</a>
            </li>
            <li>
               <a class="incomplete text-center" id="sr_step">3</a>
            </li>
         </ul>
      </div>
      <div class="fix-sync" >
         <div class="sync-container">
            <div id="ss_step_div" class="text-center containers">
               <div>
                  <form action="{{route('bulk-image-upload')}}" class="dropzone dz-clickable" id="uploadImages" method="post">
                     @csrf
                     <input type="hidden" name="type" id="type">
                     <div class="dz-default dz-message">
                        <h3 class="dropzone-custom-title">Drag and drop to upload media files!</h3>
                        <button class="dz-button" type="button">...or click to select files from your computer</button>
                     </div>
                  </form>
               </div>
               <div class="border border-light mt-1 p-1 category-wrapper">
                  <h5 class="text-left mb-1" style="font-weight:500">Select Category</h5>
                  <div class="d-flex flex-sm-row flex-column justify-content-between">
                     <div class="w-100 mr-sm-2 mb-sm-0 mb-1 mr-0">
                        <label class="d-block text-left mb-0 text-dark" for="">Select Type</label>
                        <select name="" id="" class="form-control">
                           <option value="">No option selected</option>
                           <option value="">Community</option>
                           <option value="">Elevation</option>
                           <option value="">Floor</option>
                           <option value="">Floor-Feature</option>
                        </select>
                     </div>
                     <div class="w-100 mr-sm-2 mb-sm-0 mb-1 mr-0">
                        <label class="d-block text-left mb-0 text-dark" for="">Select Sub Type</label>
                        <select name="" id="" class="form-control ">
                           <option value="">No option selected</option>
                           <option value="">Enclave of Twin Run</option>
                           <option value="">Big Fork Landing</option>
                        </select>
                     </div>
                     <div class="w-100">
                        <label class="d-block text-left mb-0 text-dark" for="">Select Section</label>
                        <select name="" id="" class="form-control">
                           <option value="">No option selected</option>
                           <option value="">Logo</option>
                           <option value="">Banner</option>
                           <option value="">Map Marker</option>
                           <option value="">Gallery</option>
                        </select>
                     </div>
                  </div>
                  <div class="mt-1">
                     <label class="text-left d-block text-dark mb-0" style="font-weight:500 !important">Import Options</label>
                     <select name="" style="max-width:300px;" class="form-control" id="">
                        <option value="">No option selected</option>
                        <option value="">override</option>
                        <option value="">update</option>
                        <option value="">skip</option>
                     </select>
                  </div>
               </div>
               <div id="start_sync" class="d-none"><p>Please wait.. We are importing the data.</p><p class="syncloader"><img src="{{ asset('images/spinner.gif') }}"></p></div>
            </div>
            <div id="drm_step_div" class="table-responsive containers">
					<h3 class="text-center mb-1">Images Mapping</h3>
               <ul class="nav nav-pills mb-0 justify-content-center" id="pills-tab" role="tablist">
						<li class="nav-item" role="presentation">
							<a class="nav-link active" id="pills-mapped-tab" data-toggle="pill" href="#pills-mapped" role="tab" aria-controls="pills-mapped" aria-selected="true">Mapped</a>
						</li>
						<li class="nav-item" role="presentation">
							<a class="nav-link" id="pills-unmapped-tab" data-toggle="pill" href="#pills-unmapped" role="tab" aria-controls="pills-unmapped" aria-selected="false">Unmapped</a>
						</li>
						<li class="nav-item" role="presentation">
							<a class="nav-link" id="pills-deleted-tab" data-toggle="pill" href="#pills-deleted" role="tab" aria-controls="pills-deleted" aria-selected="false">Deleted</a>
						</li>
					</ul>
					<div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-mapped" role="tabpanel" aria-labelledby="pills-mapped-tab">
                     <ul class="nav nav-pills mb-0 justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                           <a class="nav-link active" id="pills-communties-tab" data-toggle="pill" href="#pills-communties" role="tab" aria-controls="pills-communties" aria-selected="true">Communties</a>
                        </li>
                        <li class="nav-item" role="presentation">
                           <a class="nav-link" id="pills-elevations-tab" data-toggle="pill" href="#pills-elevations" role="tab" aria-controls="pills-elevations" aria-selected="false">Elevations</a>
                        </li>
                        <li class="nav-item" role="presentation">
                           <a class="nav-link" id="pills-floors-tab" data-toggle="pill" href="#pills-floors" role="tab" aria-controls="pills-floors" aria-selected="false">Floors</a>
                        </li>
                        <li class="nav-item" role="presentation">
                           <a class="nav-link" id="pills-floor-features-tab" data-toggle="pill" href="#pills-floor-features" role="tab" aria-controls="pills-floor-features" aria-selected="false">Floor Features</a>
                        </li>
                     </ul>
					      <div class="tab-content">
                        <div class="tab-pane fade show active" id="pills-communities" role="tabpanel" aria-labelledby="pills-communities-tab">...
                        </div>
                        <div class="tab-pane fade" id="pills-elevations" role="tabpanel" aria-labelledby="pills-elevations-tab">test
                        </div>
                        <div class="tab-pane fade" id="pills-floors" role="tabpanel" aria-labelledby="pills-floors-tab">...
                        </div>
                        <div class="tab-pane fade" id="pills-floor-features" role="tabpanel" aria-labelledby="pills-floor-features-tab">...
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="pills-unmapped" role="tabpanel" aria-labelledby="pills-unmapped-tab">
                     unpadded tab
                  </div>
                  <div class="tab-pane fade" id="pills-deleted" role="tabpanel" aria-labelledby="pills-deleted-tab">
                     delete tab
                  </div>
               </div>
            </div>
				<div id="sr_step_div" class="containers">
					<h3 class="text-center">Report</h3>
					<div>
						<div class="text-center sr-ans"> <i class="material-icons">done</i> <span>All data has been imported successfully.</span>
							<ul class="same-btns">
								<li> <a href="{{route('bulk-data')}}">Import More Data </a> </li>
								<li> <a href="{{route('import-history')}}">View Report </a> </li>
								<li> <a href="{{route('uploads')}}">Upload Images </a> </li>
							</ul>
							<ul class="sys-btns">
								<li> <a href="{{route('communities')}}">Manage Communities </a> </li>
								<li> <a href="{{route('homes')}}">Manage Elevations </a> </li>
								<li> <a href="{{route('new_floors')}}">Manage Floors </a> </li>
							</ul>
						</div>
						<div class="sr-synop">
							<h6>Activity Log </h6>
							
							<p> <span class="border-bottom"> <b class="badge badge-success">15</b> New entries has been imported successfully.  </span> </p>
							<p> <span class="border-bottom"> <b class="badge badge-danger">3</b> Entries failed to import. </span> </p>
							<p> <span class="border-bottom"> <b class="badge badge-info">83%</b> Import Process Completed. </span> </p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-buttons">
			<button class="btn btn-secondary btn-sm ftbtn" id="backButton" type="button" onclick="changeStep(false)"> Back </button>
			<button class="btn btn-info btn-sm ftbtn" type="button" onclick="changeStep(true)"> Next </button>
		</div>
	</div>
</div>
<script src="{{asset('Xseries-new-ui/dropzone/dropzone.js')}}"></script>
@endsection
@push('scripts')
<script>
// buttonClicked = true for next and false for back
let step = 1;
const changeStep = (buttonClicked) => {
	if(buttonClicked == true)
	{
		if(step < 4)
			step++;
	}
	else
	{
		if(step > 0)
			step--;
	}
	switch(step)
	{
		case 1:
			$('#ss_step').addClass('active').removeClass('incomplete');
			$('#drm_step').addClass('incomplete').removeClass('active');
			$(".containers").hide();
			$('#ss_step_div').fadeIn();
			$('#backButton').fadeOut();
			break;
		case 2: 
			$('#ss_step').addClass('complete').removeClass('active');
			$('#drm_step').addClass('active').removeClass('incomplete');
			$(".containers").hide();
			$('#backButton').fadeIn();
			$('#drm_step_div').fadeIn();
			break;
		case 3: 
			$('#drm_step').addClass('complete').removeClass('active');
			$('#sr_step').addClass('active').removeClass('incomplete');
			$('.footer-buttons').hide();
			$(".containers").hide();
			$('#sr_step_div').fadeIn();
			break;
	}
}
</script>
@endpush