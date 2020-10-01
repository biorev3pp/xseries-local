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
	padding: 15px;
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
	height: calc(100vh - 225px);
	overflow: auto;
	background: #fff;
	border: 1px solid #e4e4e4;
	border-radius: 7px;
	display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.fix-sync-overflow{
	overflow: hidden;
}

.fix-sync h3 {
	text-align: center;
	font-weight: 600;
	text-transform: uppercase;
	margin-top: 10px;
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
    text-align: right;
	margin-top: 5px;
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

.counter{
	background: white;
    border-radius: 50%;
    color: #323232;
    display: inline-block;
    width: 20px;
    height: 20px;
    line-height: 20px;
    text-align: center;
}

.table-responsive{
	position: relative;
	margin-top: 10px;
}

.mapping-action-wrap{
	background: #363636;
    padding: 6px 20px;
    margin: 0;
	position: absolute;
    top: 0;
    z-index: 1;
    right: 1px;
	display: none;
}

.mapping-action-wrap button{
	background: transparent;
	border: 1px solid #f1f1f1;
	border-radius: 50px;
	width: 100px;
	color: #f1f1f1;
	padding: 3px 0;
	font-size: 14px;
	transition: 0.3s ease all;
	outline:none;
}

.mapping-action-wrap button:hover{
	color: #363636;
	background: #f1f1f1;
}

.add-image-button{
	float: unset;
	width : 101px;
	padding-left: 0px;
	padding-right: 0px;
}

.add-image-button:focus{
	outline: none;
}

.feather.feather-check-circle{
	display:none;
}

.disabled-button {
	background: #aaa;
	pointer-events: none;
}

.image-edit-button{
    position: absolute;
    right: 0;
    background: rgba(245, 105, 84, 0.8);
    padding: 3px;
    top: 0;
	cursor: pointer;
	transition: .3s ease all;
}
.image-edit-button:hover{
	background: rgba(245, 105, 84, 0.9)
}

/* Choose File */
.file-upload {
    display: block;
    text-align: center;
    font-family: Helvetica, Arial, sans-serif;
    font-size: 12px;
    width: 100%;
}

.file-upload .file-select {
    display: block;
    border: 2px solid #dce4ec;
    color: #34495e;
    cursor: pointer;
    height: 40px;
    line-height: 40px;
    text-align: left;
    background: #FFFFFF;
    overflow: hidden;
    position: relative;
}

.file-upload .file-select .file-select-button {
    background: #dce4ec;
    padding: 0 10px;
    display: inline-block;
    height: 40px;
    line-height: 40px;
}

.file-upload .file-select .file-select-name {
    line-height: 40px;
    display: inline-block;
    padding: 0 10px;
}

.file-upload .file-select:hover {
    border-color: #34495e;
    transition: all .2s ease-in-out;
    -moz-transition: all .2s ease-in-out;
    -webkit-transition: all .2s ease-in-out;
    -o-transition: all .2s ease-in-out;
}

.file-upload .file-select:hover .file-select-button {
    background: #34495e;
    color: #FFFFFF;
    transition: all .2s ease-in-out;
    -moz-transition: all .2s ease-in-out;
    -webkit-transition: all .2s ease-in-out;
    -o-transition: all .2s ease-in-out;
}

.file-upload.active .file-select {
    border-color: #3fa46a;
    transition: all .2s ease-in-out;
    -moz-transition: all .2s ease-in-out;
    -webkit-transition: all .2s ease-in-out;
    -o-transition: all .2s ease-in-out;
}

.file-upload.active .file-select .file-select-button {
    background: #3fa46a;
    color: #FFFFFF;
    transition: all .2s ease-in-out;
    -moz-transition: all .2s ease-in-out;
    -webkit-transition: all .2s ease-in-out;
    -o-transition: all .2s ease-in-out;
}

.file-upload .file-select input[type=file] {
    z-index: 100;
    cursor: pointer;
    position: absolute;
    height: 100%;
    width: 100%;
    top: 0;
    left: 0;
    opacity: 0;
    filter: alpha(opacity=0);
}

.file-upload .file-select.file-select-disabled {
    opacity: 0.65;
}

.file-upload .file-select.file-select-disabled:hover {
    cursor: default;
    display: block;
    border: 2px solid #dce4ec;
    color: #34495e;
    cursor: pointer;
    height: 40px;
    line-height: 40px;
    margin-top: 5px;
    text-align: left;
    background: #FFFFFF;
    overflow: hidden;
    position: relative;
}

.file-upload .file-select.file-select-disabled:hover .file-select-button {
    background: #dce4ec;
    color: #666666;
    padding: 0 10px;
    display: inline-block;
    height: 40px;
    line-height: 40px;
}

.file-upload .file-select.file-select-disabled:hover .file-select-name {
    line-height: 40px;
    display: inline-block;
    padding: 0 10px;
}

.nowrap{
	white-space: nowrap;
}

select.form-control:disabled{
	background-color: #eee;
}

.table-overflow{
	height: calc(100vh - 424px);
	overflow: auto;
}

@media(min-width: 992px){
	.sync-process{
		position: absolute;
		top: 14px;
		left: 0;
		right: 0;
		margin: 0 auto; 
		z-index: 1111; 
	}
}

@media(max-width: 992px){
	#syncresponse{
		position:relative;
	}
	.fix-sync{height: auto;}
}

@media(max-width: 425px){
	.nowrap{
		white-space: unset;
	}
	.sync-process li{
		width: 80px;
	}
	.sync-process ul li:not(:first-child) a::before{
		width: 47px;
	}
}

</style>
<div class="container-fluid page-wrapper">
	<div class="row justify-content-between pl-1 pr-1 align-items-center">
		<div>
			<h1 class="a_dash p-0 m-0 d-inline-block">Uploads <small><span class="color-secondary">|</span></small></h1>
			<div class="row breadcrumbs-top pl-2 d-inline-block">
				<ol class="breadcrumb"> 
					<li class="breadcrumb-item">
					<a href="{{ route('bulk-media') }}"> Bulk Images Upload </a>
					</li>
				</ol>
			</div>
		</div>      
		<div class="btn-group">
			<a style="position:relative;" href="{{route('uploads')}}" class="add_button"><i style="top:0;" class="fa fa-arrow-left"></i> Back</a>
		</div>
	</div>
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
	<div id="syncresponse">
		<div class="fix-sync">
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
					<div class="d-flex justify-content-between flex-xl-row flex-column">
						<div class="border border-light mt-1 p-1 category-wrapper w-100 mr-1">
							<h5 class="text-left mb-1" style="font-weight:500">Select Category</h5>
							<div class="d-flex flex-sm-row flex-column justify-content-between">
								<div class="w-100 mr-sm-2 mb-sm-0 mb-1 mr-0">
									<label class="d-block text-left mb-0 text-dark" for="">Select Type</label>
									<select name="" id="" onchange="loadSubType(this.value)" class="form-control">
										<option value="">No option selected</option>
										<option value="community">Community</option>
										<option value="elevation">Elevation</option>
										<option value="color-scheme">Color Scheme</option>
										<option value="color-scheme-feature">Color Scheme Feature</option>
										<option value="floor">Floor</option>
										<option value="floor-feature">Floor Feature</option>
									</select>
								</div>
								<div class="w-100 mr-sm-2 mb-sm-0 mb-1 mr-0">
									<label class="d-block text-left mb-0 text-dark" for="">Select Sub Type</label>
									<select name="" onchange="setSubTypeValue(this.value)" id="subType" class="form-control ">
									</select>
								</div>
								<div class="w-100">
									<label class="d-block text-left mb-0 text-dark" for="">Select Section</label>
									<select name="" id="section" onchange="setSectionValue(this.value)" class="form-control">
										
									</select>
								</div>
							</div>
						</div>
						<div class="border border-light mt-1 p-1 category-wrapper w-100" style="max-width:450px;">
						<h5 class="text-left mb-1" style="font-weight:500">Upload Options</h5>
							<div class="mt-1">
								<label class="text-left d-block text-dark mb-0" style="font-weight:500 !important">Select Option</label>
								<div class="d-flex flex-sm-row flex-column justify-content-between align-items-center">
									<select id="importOptions" class="form-control mr-0 mr-sm-1 mb-1 mb-sm-0" disabled>
										<option value="">override</option>
										<option value="">update</option>
										<option value="" selected>skip</option>
									</select>
									<div class="w-100 d-flex align-items-center">
										<input type="checkbox" id="importCheck" style="margin-right: 5px;">
										<span class="nowrap">Update existing images while uploading.</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<a href="{{route('import-images-history')}}" style="display:block; width:fit-content; margin:0 auto;"><h6 class="mt-3" style="font-weight:500;">View Recent Reports</h6></a>
				</div>
				<div id="drm_step_div" class="containers">
					<ul class="nav nav-pills mb-0 justify-content-start" id="pills-tab" role="tablist">
						<li class="nav-item" role="presentation">
							<a class="nav-link active" id="pills-mapped-tab" data-toggle="pill" href="#pills-mapped" role="tab" aria-controls="pills-mapped" aria-selected="true">Mapped <span class="counter">6</span></a>
						</li>
						<li class="nav-item" role="presentation">
							<a class="nav-link" id="pills-unmapped-tab" data-toggle="pill" href="#pills-unmapped" role="tab" aria-controls="pills-unmapped" aria-selected="false">Unmapped <span class="counter">1</span></a>
						</li>
						<li class="nav-item" role="presentation">
							<a class="nav-link" id="pills-deleted-tab" data-toggle="pill" href="#pills-deleted" role="tab" aria-controls="pills-deleted" aria-selected="false">Deleted <span class="counter">1</span></a>
						</li>
					</ul>
					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade show active" id="pills-mapped" role="tabpanel" aria-labelledby="pills-mapped-tab">
							<ul class="nav nav-pills mb-0 justify-content-start" id="pills-tab" role="tablist">
								<li class="nav-item" role="presentation">
								<a class="nav-link active" id="pills-communities-tab" data-toggle="pill" href="#pills-communities" role="tab" aria-controls="pills-communities" aria-selected="true">Communties <span class="counter">6</span></a>
								</li>
								<li class="nav-item" role="presentation">
								<a class="nav-link" id="pills-elevations-tab" data-toggle="pill" href="#pills-elevations" role="tab" aria-controls="pills-elevations" aria-selected="false">Elevations <span class="counter">0</span></a>
								</li>
								<li class="nav-item" role="presentation">
								<a class="nav-link" id="pills-floors-tab" data-toggle="pill" href="#pills-floors" role="tab" aria-controls="pills-floors" aria-selected="false">Floors <span class="counter">0</span></a>
								</li>
								<li class="nav-item" role="presentation">
								<a class="nav-link" id="pills-floor-features-tab" data-toggle="pill" href="#pills-floor-features" role="tab" aria-controls="pills-floor-features" aria-selected="false">Floor Features <span class="counter">0</span></a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane fade show active" id="pills-communities" role="tabpanel" aria-labelledby="pills-communities-tab">
									<div class="table-responsive" id="custom_table">
										<div class="w-100 border mapping-action-wrap">
											<span class="mr-2 text-white"><b>0</b> row(s) selected</span>
											<button class="mr-1 add-button">Add</button>
											<button class="mr-1 update-button">Update</button>
											<button class="mr-1 delete-button">Delete</button>
										</div>
										<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th style="width:40px"><input type="checkbox" class="checkall"></th>
													<th>Image Name</th>
													<th>Category or Mapped</th> 
													<th>Uploaded By</th>
													<th>Image</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><input type="checkbox"></td>
													<td>cottage-garden-g-1</td>
													<td>Cottage Garden - Gallery</td>
													<td>Admin</td>
													<td width="100px" style="min-width:100px;">
														<div style="position:relative;">
															<img class="w-100" src="{{asset('uploads/1591693227.jpg')}}">
															<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit image-edit-button" onclick="replaceImage()"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
														</div>
													</td>
													<td>
														<button type="button" class="add-image-button btn-orange">Add</button>
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#8BC34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
													</td>
												</tr>
												<tr>
													<td><input type="checkbox"></td>
													<td>cottage-garden-g-2</td>
													<td>Cottage Garden - Gallery</td>
													<td>Admin</td>
													<td width="100px" style="min-width:100px;">
														<div style="position:relative;">
															<img class="w-100" src="{{asset('uploads/1591693227.jpg')}}">
															<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit image-edit-button" onclick="replaceImage()"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
														</div>
													</td>
													<td>
														<button type="button" class="add-image-button btn-orange">Add</button>
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#8BC34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
													</td>
												</tr>
												<tr>
													<td><input type="checkbox"></td>
													<td>cottage-garden-g-3</td>
													<td>Cottage Garden - Gallery</td>
													<td>Admin</td>
													<td width="100px" style="min-width:100px;">
														<div style="position:relative;">
															<img class="w-100" src="{{asset('uploads/1591693227.jpg')}}">
															<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit image-edit-button" onclick="replaceImage()"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
														</div>
													</td>
													<td>
														<button type="button" class="add-image-button btn-orange">Add</button>
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#8BC34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
													</td>
												</tr>
												<tr>
													<td><input type="checkbox"></td>
													<td>cottage-garden-g-4</td>
													<td>Cottage Garden - Gallery</td>
													<td>Admin</td>
													<td width="100px" style="min-width:100px;">
														<div style="position:relative;">
															<img class="w-100" src="{{asset('uploads/1591693227.jpg')}}">
															<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit image-edit-button" onclick="replaceImage()"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
														</div>
													</td>
													<td>
														<button type="button" class="add-image-button btn-orange">Add</button>
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#8BC34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
													</td>
												</tr>
												<tr>
													<td><input type="checkbox"></td>
													<td>cottage-garden-g-5</td>
													<td>Cottage Garden - Gallery</td>
													<td>Admin</td>
													<td width="100px" style="min-width:100px;">
														<div style="position:relative;">
															<img class="w-100" src="{{asset('uploads/1591693227.jpg')}}">
															<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit image-edit-button" onclick="replaceImage()"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
														</div>
													</td>
													<td>
														<button type="button" class="add-image-button btn-orange">Add</button>
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#8BC34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
													</td>
												</tr>
												<tr>
													<td><input type="checkbox"></td>
													<td>cottage-garden-g-6</td>
													<td>Cottage Garden - Gallery</td>
													<td>Admin</td>
													<td width="100px" style="min-width:100px;">
														<div style="position:relative;">
															<img class="w-100" src="{{asset('uploads/1591693227.jpg')}}">
															<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit image-edit-button" onclick="replaceImage()"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
														</div>
													</td>
													<td>
														<button type="button" class="add-image-button btn-orange">Add</button>
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#8BC34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
													</td>
												</tr>	
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="pills-elevations" role="tabpanel" aria-labelledby="pills-elevations-tab">
									<div class="alert alert-danger mt-1" role="alert">No Images are Mapped in this section.</div>
								</div>
								<div class="tab-pane fade" id="pills-floors" role="tabpanel" aria-labelledby="pills-floors-tab">
									<div class="alert alert-danger mt-1" role="alert">No Images are Mapped in this section.</div>
								</div>
								<div class="tab-pane fade" id="pills-floor-features" role="tabpanel" aria-labelledby="pills-floor-features-tab">
									<div class="alert alert-danger mt-1" role="alert">No Images are Mapped in this section.</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="pills-unmapped" role="tabpanel" aria-labelledby="pills-unmapped-tab">
							<div class="table-responsive" id="custom_table">
								<div class="w-100 border mapping-action-wrap">
									<span class="mr-2 text-white"><b>0</b> row(s) selected</span>
									<button class="mr-1 add-button">Add</button>
									<button class="mr-1 update-button">Update</button>
									<button class="mr-1 delete-button">Delete</button>
								</div>
								<table class="table table-bordered table-hover" id="unmappedTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th style="width:40px"><input type="checkbox" class="checkall"></th>
											<th>Image Name</th>
											<th>Category or Mapped</th> 
											<th>Uploaded By</th>
											<th>Image</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input type="checkbox"></td>
											<td>test_image</td>
											<td>Undefined</td>
											<td>Admin</td>
											<td width="100px" style="min-width:100px;">
												<div style="position:relative;">
													<img class="w-100" src="{{asset('uploads/interior.png')}}">
													<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit image-edit-button" onclick="replaceImage()"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
												</div>
											</td>
											<td>
												<button type="button" class="add-image-button disabled-button btn-orange">Add</button>
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#8BC34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane fade" id="pills-deleted" role="tabpanel" aria-labelledby="pills-deleted-tab">
							<div class="table-responsive" id="custom_table">
								<div class="w-100 border mapping-action-wrap">
									<span class="mr-2 text-white"><b>0</b> row(s) selected</span>
									<button class="mr-1 undo-button">Undo</button>
								</div>
								<table class="table table-bordered table-hover" id="deleteTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th style="width:40px"><input type="checkbox" class="checkall"></th>
											<th>Image Name</th>
											<th>Category or Mapped</th> 
											<th>Uploaded By</th>
											<th>Image</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input type="checkbox"></td>
											<td>cottage-garden-g-7</td>
											<td>Cottage Garden - Gallery</td>
											<td>Admin</td>
											<td width="100px" style="min-width:100px;"><img class="w-100" src="{{asset('uploads/Kingsmark-C2.jpg')}}"></td>
											<td>
												<button type="button" class="add-image-button btn-orange undo-button">Undo</button>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div id="sr_step_div" class="containers">
					<h3 class="text-center">Report</h3>
					<div>
						<div class="text-center sr-ans"> <i class="material-icons">done</i> <span>Images has been uploaded successfully.</span>
							<ul class="same-btns">
								<li> <a href="{{route('bulk-media')}}">Upload More Images </a> </li>
								<li> <a href="{{route('import-images-history')}}">View Report </a> </li>
								<li> <a href="{{route('bulk-data')}}">Import Data </a> </li>
							</ul>
							<ul class="sys-btns">
								<li> <a href="{{route('communities')}}">Manage Communities </a> </li>
								<li> <a href="{{route('homes')}}">Manage Elevations </a> </li>
								<li> <a href="{{route('new_floors')}}">Manage Floors </a> </li>
							</ul>
						</div>
						<div class="sr-synop">
							<h6>Activity Log </h6>
							<p> <span class="border-bottom"> <b class="badge badge-success">6</b> New images has been uploaded successfully.  </span> </p>
							<p> <span class="border-bottom"> <b class="badge badge-danger">0</b> Images failed to upload. </span> </p>
							<p> <span class="border-bottom"> <b class="badge badge-info">100%</b> Upload Completed. </span> </p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-buttons">
		<div class="btn-group">
			<a style="position:relative; margin-right:5px;" id="backButton" href="javascript:;" onclick="changeStep(false)" class="add_button"><i style="top:0;" class="fa fa-arrow-left"></i> Back </a>
			<a style="position:relative;" href="javascript:;" id="importButton" onclick="changeStep(true)" class="add_button"> <span>Next</span> <i style="top:0;" class="fa fa-arrow-right"></i></a>
		</div>
	</div>
</div>
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle" style="font-weight:600; font-size: 17px;">Update Selected Rows</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"><i class="fa fa-times"></i> </span>
				</button>
			</div>
			<div class="modal-body px-2 pt-2 pb-0">
				<div class="w-100 mb-1 mr-0">
					<label class="d-block text-left mb-0 text-dark" for="">Select Type</label>
					<select name="" id="" class="form-control">
					<option value="">No option selected</option>
					<option value="">Community</option>
					<option value="">Elevation</option>
					<option value="">Floor</option>
					<option value="">Floor-Feature</option>
					</select>
				</div>
				<div class="w-100 mb-1 mr-0">
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
			<div class="modal-footer d-flex justify-content-between align-items-center p-2" style="border:none;">
				<button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr m-0">Cancel</button>
				<div>
					<button type="button" class="btn-orange" style="float:unset;">Apply</button>
					<button type="button" class="btn-orange" style="float:unset;">Apply and Add</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="replaceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle" style="font-weight:600; font-size: 17px;">Replace Image</h5>
			</div>
			<div class="modal-body px-2 pt-2 pb-0">
				<div class="w-100">
					<div class="file-upload pr-md-1 pr-0">
						<div class="file-select">
							<div class="file-select-button" id="fileName">Choose Image</div>
							<div class="file-select-name" id="noFile">No file chosen...</div>
							<input type="file" name="excel_file" id="image"> 
						</div>
					</div> 
				</div>	
			</div>
			<div class="modal-footer d-flex justify-content-start align-items-center p-2" style="border:none;">
				<button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr m-0">Cancel</button>
				<button type="button" class="btn-orange" style="float:unset;">Update</button>
			</div>
		</div>
	</div>
</div>
<script src="{{asset('Xseries-new-ui/dropzone/dropzone.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
@endsection
@push('scripts')
<script>
// buttonClicked = true for next and false for back
let step = 1;
let rowsSelected = 0;
let unmappedrowsSelected = 0;
let deletedrowsSelected = 0;

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
			$("#importButton span").text('Next');
			$('.fix-sync').removeClass('fix-sync-overflow');
			$(".containers").hide();
			$('#ss_step_div').fadeIn();
			$('#backButton').fadeOut();
			break;
		case 2: 
			if(count>0){
				storeImgTemp();
			}
			else{
				toastr.error("Please select images to upload.");
				step--;
				return;
			}
			$('#ss_step').addClass('complete').removeClass('active');
			$('#drm_step').addClass('active').removeClass('incomplete');
			$('.fix-sync').addClass('fix-sync-overflow');
			$('table').parent().parent().addClass('table-overflow');
			$("#importButton span").text('Upload');
			$(".containers").hide();
			$('#backButton').fadeIn();
			$('#drm_step_div').fadeIn();
			break;
		case 3: 
			$('#drm_step').addClass('complete').removeClass('active');
			$('#sr_step').addClass('active').removeClass('incomplete');
			$('.fix-sync').removeClass('fix-sync-overflow');
			$('.footer-buttons').hide();
			$(".containers").hide();
			$('#sr_step_div').fadeIn();
			break;
	}
}


// Dropzone code
let filter = {
	'type'		:'',
	'sub_type'	:'',
	'section'	: '' 
};
let count = 0;
function setSubTypeValue(value)
{
		filter.sub_type = value;
}
function setSectionValue(value){
	filter.section = value;
}
Dropzone.options.uploadImages = {
    maxFilesize: 5,
    dictResponseError: 'Server not Configured',
    acceptedFiles: ".png,.jpg,.jpeg",
    uploadMultiple: true,
    autoProcessQueue: false,
    parallelUploads: 100,
    init:function(){
      var self = this;
      // config
      self.options.addRemoveLinks = true;
      self.options.dictRemoveFile = "<i class='fas fa-trash'style='cursor:pointer;'></i>";
      //New file added
      self.on("addedfile", function (file) {
		  count++;
      });
      // Send file starts
      self.on("sending", function (file,xhr, formData) {
        $('.meter').show();
      });
      // multiple
      self.on("processingmultiple",function(files){
      })
      // File upload Progress
      self.on("totaluploadprogress", function (progress) {
        $('.roller').width(progress + '%');
      });
      self.on("queuecomplete", function (progress) {
        $('.meter').delay(999).slideUp(999);

      });
      
      // On removing file
      self.on("removedfile", function (file) {
        count--;
      });
      
      self.on("success",function(file,error){
        // self.removeFile(file);
      });
    }
  };

  function loadSubType(type){ 	
	  filter.type = type;
	  let options = `<option value="">No option selected</option>`;
	  if(type!=''){
		$.ajax({
			type: 'get',
			url: '/api/options/'+type,
			success: function(response){
				$.each(response,function(key,value){
					options+=`<option value="${value.id}">${type=='community'?value.name:value.title}</option>`;
				});  
				$('#subType').html(options);
			}		
		})
	  }
	  else{
		$('#subType').html(options);
			filter.type 	='';
			filter.sub_type ='';
			filter.section  = '';
	  }
	  loadSection(type)
    }
	function loadSection(type){
		let options = `<option value="">No option selected</option>`;
		switch(type){
			case 'community':
				options += `<option value="logo">Logo</option>
				<option value="banner">Banner</option>
				<option value="map">Map Marker</option>
				<option value="gallery">Gallery</option>`;
			break;

			case 'elevation':
				options += `<option value="feature-image">Feature Image</option>
				<option value="gallery">Gallery</option>`;
			break;

			case 'floor':
				options += `<option value="feature-image">Feature Image</option>`;
			break;

			case 'floor-feature':
				options += `<option value="feature-image">Feature Image</option>`;
			break;

			case 'color-scheme':
				options += `<option value="feature-image">Feature Image</option>`;
			break;
			case 'color-scheme-feature':
				options += `<option value="feature-image">Feature Image</option>`;
			break;	
			case '':
			break;
			default:
			break;
		}
		$('#section').html(options);
	}
	function storeImgTemp(){
		$('#type').val(JSON.stringify(filter));
		var dropZone = Dropzone.forElement(".dropzone");
		dropZone.processQueue();
	}
// Mapped Section

$("#pills-mapped .tab-pane.active .checkall").on('click', function(){
	$("#pills-mapped .tab-pane.active tbody input[type=checkbox]").prop('checked', $(this).prop('checked'));
	rowsSelected = $("#pills-mapped .tab-pane.active tbody input[type=checkbox]:checked").length;
	$("#pills-mapped .tab-pane.active .mapping-action-wrap span b").html(rowsSelected);
	if(rowsSelected > 0)
	{
		$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeIn();
	}
	else
	{
		$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeOut();
	}
});
$("#pills-mapped .tab-pane.active tbody input[type=checkbox]").on('click', function()
{
	if(this.checked)
	{
		rowsSelected++;
	}
	else{
		rowsSelected--;
	}
	$("#pills-mapped .tab-pane.active .mapping-action-wrap span b").html(rowsSelected);
	if(rowsSelected > 0)
	{
		$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeIn();
	}
	else
	{
		$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeOut();
	}
});	
$("#pills-mapped .tab-pane.active .mapping-action-wrap button").click(function(){
	if(rowsSelected < 1){
		toastr.error('Please select atleast one row');
		return;
	}
	switch($(this).attr('class').split(' ').pop())
	{
		case "add-button":
			$("#pills-mapped .tab-pane.active tbody input[type=checkbox]:checked").parents('tbody').find('.add-image-button').fadeOut(function(){
				$("#pills-mapped .tab-pane.active tbody input[type=checkbox]:checked").parents('tbody').find('.add-image-button').next().fadeIn();
			});
			break;			
		case "update-button" : 
			$("#updateModal").modal('show');
			break;			
		case "delete-button": 
			break;			
	}
});

$('#pills-mapped .tab-pane.active .add-image-button').on('click', function(){
	const button = $(this);
	button.fadeOut(function(){
		button.next().fadeIn();
	})
});

function replaceImage(){
	$("#replaceModal").modal("show");
}

// Unmapped Section

$("#pills-unmapped .checkall").on('click', function(){
	$("#pills-unmapped tbody input[type=checkbox]").prop('checked', $(this).prop('checked'));
	unmappedrowsSelected = $("#pills-unmapped tbody input[type=checkbox]:checked").length;
	$("#pills-unmapped .mapping-action-wrap span b").html(unmappedrowsSelected);
	if(unmappedrowsSelected > 0)
	{
		$("#pills-unmapped .table-responsive .mapping-action-wrap").fadeIn();
	}
	else
	{
		$("#pills-unmapped  .table-responsive .mapping-action-wrap").fadeOut();
	}
});
$("#pills-unmapped tbody input[type=checkbox]").on('click', function()
{
	if(this.checked)
	{
		unmappedrowsSelected++;
	}
	else{
		unmappedrowsSelected--;
	}
	$("#pills-unmapped .mapping-action-wrap span b").html(unmappedrowsSelected);
	if(unmappedrowsSelected > 0)
	{
		$("#pills-unmapped .table-responsive .mapping-action-wrap").fadeIn();
	}
	else
	{
		$("#pills-unmapped  .table-responsive .mapping-action-wrap").fadeOut();
	}
});	
$("#pills-unmapped .mapping-action-wrap button").click(function(){
	if(unmappedrowsSelected < 1){
		toastr.error('Please select atleast one row');
		return;
	}
	switch($(this).attr('class').split(' ').pop())
	{
		case "add-button":
			// $("#pills-unmapped tbody input[type=checkbox]:checked").parents('tbody').find('.add-image-button').fadeOut(function(){
			// 	$("#pills-unmapped tbody input[type=checkbox]:checked").parents('tbody').find('.add-image-button').next().fadeIn();
			// });
			break;			
		case "update-button" : 
			$("#updateModal").modal('show');
			break;			
		case "delete-button": 
			break;			
	}
});

// Deleted Section

$("#pills-deleted .checkall").on('click', function(){
	$("#pills-deleted tbody input[type=checkbox]").prop('checked', $(this).prop('checked'));
	deletedrowsSelected = $("#pills-deleted tbody input[type=checkbox]:checked").length;
	$("#pills-deleted .mapping-action-wrap span b").html(deletedrowsSelected);
	if(deletedrowsSelected > 0)
	{
		$("#pills-deleted .table-responsive .mapping-action-wrap").fadeIn();
	}
	else
	{
		$("#pills-deleted  .table-responsive .mapping-action-wrap").fadeOut();
	}
});
$("#pills-deleted tbody input[type=checkbox]").on('click', function()
{
	if(this.checked)
	{
		deletedrowsSelected++;
	}
	else{
		deletedrowsSelected--;
	}
	$("#pills-deleted .mapping-action-wrap span b").html(deletedrowsSelected);
	if(deletedrowsSelected > 0)
	{
		$("#pills-deleted .table-responsive .mapping-action-wrap").fadeIn();
	}
	else
	{
		$("#pills-deleted  .table-responsive .mapping-action-wrap").fadeOut();
	}
});	
$("#pills-deleted .mapping-action-wrap button").click(function(){
	if(deletedrowsSelected < 1){
		toastr.error('Please select atleast one row');
		return;
	}
});

$(document).ready( function () {
	$('#unmappedTable').DataTable();
	$('#deleteTable').DataTable();
});

$('#image').on('change', function () {
	var filename = $("#image").val();
	if (/^\s*$/.test(filename)) {
		$(".file-upload").removeClass('active');
		$("#noFile").text("No file chosen..."); 
	}
	else {
		$(".file-upload").addClass('active');
		$("#noFile").text(filename.replace("C:\\fakepath\\", "")); 
	}
});

// Modal Event
$('#replaceModal').on('hidden.bs.modal', function (e) {
	$("#image").val('');
	$(".file-upload").removeClass('active');
	$("#noFile").text("No file chosen..."); 
})

$("#importCheck").click(function(){
	if(this.checked)
	{	
		$("#importOptions").removeAttr('disabled');
	}
	else
	{
		$("#importOptions").attr('disabled', true);
	}
});

</script>
@endpush