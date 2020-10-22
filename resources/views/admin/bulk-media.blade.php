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

.table-overflow-unmapped{
	height: calc(100vh - 380px);
	overflow: auto;
}

.drop-wrapper{
	max-height: 290px;
	overflow: auto;
}



@media(max-width: 1200px){
	.table-overflow, .table-overflow-unmapped{
		height: auto;
	}
	.fix-sync-overflow{
		overflow: auto;
	}

	.drop-wrapper{
		max-height:unset;
	}
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
					<div class="drop-wrapper">
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
										<option value="override">override</option>
										<option value="update">update</option>
										<option value="skip" selected>skip</option>
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
							<a class="nav-link active main-tab-links" id="pills-mapped-tab" data-toggle="pill" href="#pills-mapped" role="tab" aria-controls="pills-mapped" aria-selected="true">Mapped <span class="counter" id="mapped-count">0</span></a>
						</li>
						<li class="nav-item" role="presentation">
							<a class="nav-link main-tab-links" id="pills-unmapped-tab" data-toggle="pill" href="#pills-unmapped" role="tab" aria-controls="pills-unmapped" aria-selected="false">Unmapped <span class="counter"id="unmapped-count">0</span></a>
						</li>
						<li class="nav-item" role="presentation">
							<a class="nav-link main-tab-links" id="pills-deleted-tab" data-toggle="pill" href="#pills-deleted" role="tab" aria-controls="pills-deleted" aria-selected="false">Deleted <span class="counter" id="delete-count">0</span></a>
						</li>
					</ul>
					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade show active" id="pills-mapped" role="tabpanel" aria-labelledby="pills-mapped-tab">
							<ul class="nav nav-pills mb-0 justify-content-start" id="pills-tab" role="tablist">
								<li class="nav-item" role="presentation">
								<a class="nav-link active" id="pills-communities-tab" data-toggle="pill" href="#pills-communities" role="tab" aria-controls="pills-communities" aria-selected="true">Communties <span class="counter" id="community-count">0</span></a>
								</li>
								<li class="nav-item" role="presentation">
								<a class="nav-link" id="pills-elevations-tab" data-toggle="pill" href="#pills-elevations" role="tab" aria-controls="pills-elevations" aria-selected="false">Elevations <span class="counter" id="elevation-count">0</span></a>
								</li>
								<li class="nav-item" role="presentation">
								<a class="nav-link" id="pills-color-scheme-tab" data-toggle="pill" href="#pills-color-scheme" role="tab" aria-controls="pills-color-scheme" aria-selected="false">Color Scheme <span class="counter" id="color-scheme-count">0</span></a>
								</li>
								<li class="nav-item" role="presentation">
								<a class="nav-link" id="pills-color-scheme-features-tab" data-toggle="pill" href="#pills-color-scheme-features" role="tab" aria-controls="pills-color-scheme-features" aria-selected="false">Color Scheme Features <span class="counter" id="color-scheme-feature-count">0</span></a>
								</li>
								<li class="nav-item" role="presentation">
								<a class="nav-link" id="pills-floors-tab" data-toggle="pill" href="#pills-floors" role="tab" aria-controls="pills-floors" aria-selected="false">Floors <span class="counter" id="floor-count">0</span></a>
								</li>
								<li class="nav-item" role="presentation">
								<a class="nav-link" id="pills-floor-features-tab" data-toggle="pill" href="#pills-floor-features" role="tab" aria-controls="pills-floor-features" aria-selected="false">Floor Features <span class="counter" id="floor-feature-count">0</span></a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane fade show active" id="pills-communities" role="tabpanel" aria-labelledby="pills-communities-tab">
									<p class="syncloader text-center my-2" style="display:none;"><img src="{{asset('images/spinner.gif')}}"></p>
									<div class="table-responsive" id="custom_table">
										<div class="w-100 border mapping-action-wrap">
											<span class="mr-2 text-white"><b>0</b> row(s) selected</span>
											<button class="mr-1 add-button" onclick="addMappedData('community',false)">Add</button>
											<button class="mr-1 update-button" onclick="updateConnection('community')">Update</button>
											<button class="mr-1 delete-button" onclick="moveToDeleteSection('community')">Delete</button>
										</div>
										<table class="table table-bordered table-hover" id="communityDataTable" width="100%" cellspacing="0">
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
											<tbody id="community-section">
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="pills-elevations" role="tabpanel" aria-labelledby="pills-elevations-tab">
									<div class="table-responsive" id="custom_table">
										<div class="w-100 border mapping-action-wrap">
											<span class="mr-2 text-white"><b>0</b> row(s) selected</span>
											<button class="mr-1 add-button" onclick="addMappedData('elevation',false)">Add</button>
											<button class="mr-1 update-button"onclick="updateConnection('elevation')">Update</button>
											<button class="mr-1 delete-button" onclick="moveToDeleteSection('elevation')">Delete</button>
										</div>
										<table class="table table-bordered table-hover" id="elevationDataTable" width="100%" cellspacing="0">
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
											<tbody id="elevation-section">
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="pills-color-scheme" role="tabpanel" aria-labelledby="pills-color-scheme-tab">
									<div class="table-responsive" id="custom_table">
										<div class="w-100 border mapping-action-wrap">
											<span class="mr-2 text-white"><b>0</b> row(s) selected</span>
											<button class="mr-1 add-button" onclick="addMappedData('color-scheme',false)">Add</button>
											<button class="mr-1 update-button" onclick="updateConnection('color-scheme')">Update</button>
											<button class="mr-1 delete-button" onclick="moveToDeleteSection('color-scheme')">Delete</button>
										</div>
										<table class="table table-bordered table-hover" id="colorSchemeDataTable" width="100%" cellspacing="0">
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
											<tbody id="color-scheme-section">
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="pills-color-scheme-features" role="tabpanel" aria-labelledby="pills-color-scheme-features-tab">
									<div class="table-responsive" id="custom_table">
										<div class="w-100 border mapping-action-wrap">
											<span class="mr-2 text-white"><b>0</b> row(s) selected</span>
											<button class="mr-1 add-button" onclick="addMappedData('color-scheme-feature',false)">Add</button>
											<button class="mr-1 update-button" onclick="updateConnection('color-scheme-feature')">Update</button>
											<button class="mr-1 delete-button" onclick="moveToDeleteSection('color-scheme-feature')">Delete</button>
										</div>
										<table class="table table-bordered table-hover" id="colorSchemeFeatureDataTable" width="100%" cellspacing="0">
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
											<tbody id="color-scheme-feature-section">
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="pills-floors" role="tabpanel" aria-labelledby="pills-floors-tab">
									<div class="table-responsive">
										<div class="w-100 border mapping-action-wrap">
											<span class="mr-2 text-white"><b>0</b> row(s) selected</span>
											<button class="mr-1 add-button" onclick="addMappedData('floor',false)">Add</button>
											<button class="mr-1 update-button" onclick="updateConnection('floor')">Update</button>
											<button class="mr-1 delete-button" onclick="moveToDeleteSection('floor')">Delete</button>
										</div>
										<table class="table table-bordered table-hover" id="floorDataTable" width="100%" cellspacing="0">
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
											<tbody id="floor-section">
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="pills-floor-features" role="tabpanel" aria-labelledby="pills-floor-features-tab">
									<div class="table-responsive" id="custom_table">
										<div class="w-100 border mapping-action-wrap">
											<span class="mr-2 text-white"><b>0</b> row(s) selected</span>
											<button class="mr-1 add-button" onclick="addMappedData('floor-feature',false)">Add</button>
											<button class="mr-1 update-button" onclick="updateConnection('floor-feature')">Update</button>
											<button class="mr-1 delete-button" onclick="moveToDeleteSection('floor-feature')">Delete</button>
										</div>
										<table class="table table-bordered table-hover" id="floorFeatureDataTable" width="100%" cellspacing="0">
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
											<tbody id="floor-feature-section">
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="pills-unmapped" role="tabpanel" aria-labelledby="pills-unmapped-tab">
							<div class="table-responsive" id="custom_table">
								<div class="w-100 border mapping-action-wrap">
									<span class="mr-2 text-white"><b>0</b> row(s) selected</span>
									<button class="mr-1 update-button" onclick="updateConnection('unmapped')">Update</button>
									<button class="mr-1 delete-button" onclick="moveToDeleteSection('unmapped')">Delete</button>
								</div>
								<table class="table table-bordered table-hover" id="unmappedDataTable" width="100%" cellspacing="0">
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
									<tbody id="unmapped-section">
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane fade" id="pills-deleted" role="tabpanel" aria-labelledby="pills-deleted-tab">
							<div class="table-responsive" id="custom_table">
								<div class="w-100 border mapping-action-wrap">
									<span class="mr-2 text-white"><b>0</b> row(s) selected</span>
									<button class="mr-1 undo-button" onclick="undo()">Undo</button>
								</div>
								<table class="table table-bordered table-hover" id="deleteDataTable" width="100%" cellspacing="0">
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
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div id="sr_step_div" class="containers">
					<h3 class="text-center">Report</h3>
					<p class="uploadloader text-center my-2"><img src="{{asset('images/spinner.gif')}}"></p>
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
							<p> <span class="border-bottom"> <b class="badge badge-success">0</b> New images has been uploaded successfully.  </span> </p>
							<p> <span class="border-bottom"> <b class="badge badge-light">0</b> entries has been skipped.  </span> </p>
							<p> <span class="border-bottom"> <b class="badge badge-danger">0</b> Images failed to upload. </span> </p>
							<p> <span class="border-bottom"> <b class="badge badge-info">0%</b> Upload Completed. </span> </p>
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
					<select name="" class="form-control" onchange="loadSubType(this.value,'update')">
					<option value="">No option selected</option>
					<option value="community">Community</option>
					<option value="elevation">Elevation</option>
					<option value="color-scheme">Color Scheme</option>
					<option value="color-scheme-feature">Color Scheme Feature</option>
					<option value="floor">Floor</option>
					<option value="floor-feature">Floor Feature</option>
					</select>
				</div>
				<div class="w-100 mb-1 mr-0">
					<label class="d-block text-left mb-0 text-dark" for="">Select Sub Type</label>
					<select name="" id="subTypeUpdate" onchange="setSubTypeValue(this.value)" class="form-control ">
					
					</select>
				</div>
				<div class="w-100">
					<label class="d-block text-left mb-0 text-dark" for="">Select Section</label>
					<select name="" id="updateSection" onchange="setSectionValue(this.value)" class="form-control">
					</select>
				</div>
			</div>
			<div class="modal-footer d-flex justify-content-between align-items-center p-2" style="border:none;">
				<button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr m-0">Cancel</button>
				<div>
					<button type="button" class="btn-orange" style="float:unset;" onclick="applyUpdate()">Apply</button>
					<!-- <button type="button" class="btn-orange" onclick="applyUpdate('add')" style="float:unset;">Apply and Add</button> -->
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="replaceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<form method="post" enctype="multipart/form-data" id="replaceImageForm" class="w-100">
			@csrf
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
								<input type="file" name="new_file" id="image"onchange="readURL(this);" accept="image/*">
								<input type="hidden" id="previous_file" name="previous_file"> 
							</div>
						</div> 
					</div>	
				</div>
				<div class="modal-footer d-flex justify-content-start align-items-center p-2" style="border:none;">
					<button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr m-0">Cancel</button>
					<button type="submit" class="btn-orange" style="float:unset;">Update</button>
				</div>
			</div>
		</form>	
	</div>
</div>
<script src="{{asset('Xseries-new-ui/dropzone/dropzone.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
@endsection
@push('scripts')
<script>
// buttonClicked = true for next and false for back
let step = 1;
let unmappedrowsSelected = 0;
let currentTag,currentValue;
let deletedrowsSelected = 0;
let filter = {
	'type'		:'',
	'sub_type'	:'',
	'section'	: '' 
};
let mapped = {};
mapped['community'] = [];
mapped['elevation'] = [];
mapped['color_scheme'] = [];
mapped['color_scheme_feature'] = [];
mapped['floor'] = [];
mapped['floor_feature'] = [];
let singleUpdate;
let replaceImageReference;
let inputReference;
let [communityCount,elevationCount,floorCount,floorFeatureCount,colorSchemeCount,colorSchemeFeatureCount, unmappedCount,mappedCount,deleteCount] = [0,0,0,0,0,0,0,0,0];
// 0 ->community, 1->elevation, 2->color_scheme, 3->color_scheme_feature, 4->floor, 5->floor_feature
let rows = [0,0,0,0,0,0];
let count = 0;
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
				if(filter.type!=''){
					if(filter.sub_type!='' && filter.section!='')
						storeImgTemp();
					else {
						toastr.error("Please apply filter properly. If you want to apply filter.");
						step--;
						return;
					}	
				}
				else{
					storeImgTemp();
				}
			}
			else{
				toastr.error("Please select images to upload.");
				step--;
				return;
			}
			$('#ss_step').addClass('complete').removeClass('active');
			$('#drm_step').addClass('active').removeClass('incomplete');
			$('.fix-sync').addClass('fix-sync-overflow');
			$("#importButton span").text('Upload');
			$(".containers").hide();
			$('#backButton').fadeOut();
			$('#drm_step_div').fadeIn();
			break;
		case 3: 
			let finalStep =  confirmAndUpload();
			if(!finalStep){
				step = 2;
				return;
			}
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
function setSubTypeValue(value)
{
	filter.sub_type = value;
	currentValue = $('#subTypeUpdate').children("option:selected").text();
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
      
      self.on("successmultiple",function(file,res){
        // self.removeFile(file);
		let communityContent = '';
		let elevationContent = '';
		let floorContent = '';
		let floorFeatureContent = '';
		let unmappedContent = '';
		let colorSchemeContent = '';
		let colorSchemeFeatureContent = '';

		// Community section data
		$.each(res.mapped.community,function(key,val){
			communityContent+= `<tr data-id="${val.id}" data-ref="community" data-section="${val.section}" data-name="${val.name}">
							<td><input type="checkbox"></td>
							<td>${val.name}</td>
							<td class="section">${val.value} - ${val.section}</td>
							<td>${res.uploaded_by}</td>
							<td width="100px" style="min-width:100px;">
								<div style="position:relative;">
									<img class="w-100" src="{{asset('uploads/temp/${val.path}')}}">
									<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit image-edit-button" onclick="replaceImage('${val.name}',this)"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
								</div>
							</td>
							<td>
								<button type="button" class="add-image-button btn-orange" onclick="addMappedData('community',this)">Add</button>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#8BC34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
							</td>
						</tr>`;
						communityCount++;
		});
		$('#community-count').html(communityCount);
		$('#community-section').html(communityContent);
		$('#communityDataTable').DataTable();
		$('#communityDataTable').parent().parent().addClass('table-overflow');


		// Elevation section data
		$.each(res.mapped.elevation,function(key,val){
			elevationContent+= `<tr data-id="${val.id}" data-ref="elevation" data-section="${val.section}" data-name="${val.name}">
							<td><input type="checkbox"></td>
							<td>${val.name}</td>
							<td class="section">${val.value} - ${val.section}</td>
							<td>${res.uploaded_by}</td>
							<td width="100px" style="min-width:100px;">
								<div style="position:relative;">
									<img class="w-100" src="{{asset('uploads/temp/${val.path}')}}">
									<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit image-edit-button" onclick="replaceImage('${val.name}',this)"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
								</div>
							</td>
							<td>
								<button type="button" onclick="addMappedData('elevation',this)" class="add-image-button btn-orange">Add</button>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#8BC34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
							</td>
						</tr>`;
						elevationCount++;
		});
		$('#elevation-count').html(elevationCount);
		$('#elevation-section').html(elevationContent);
		$('#elevationDataTable').DataTable();
		$('#elevationDataTable').parent().parent().addClass('table-overflow');

		// Floor data section
		$.each(res.mapped.floor,function(key,val){
			floorContent+= `<tr data-id="${val.id}" data-ref="floor" data-section="${val.section}" data-name="${val.name}">
							<td><input type="checkbox"></td>
							<td>${val.name}</td>
							<td class="section">${val.value} - ${val.section}</td>
							<td>${res.uploaded_by}</td>
							<td width="100px" style="min-width:100px;">
								<div style="position:relative;">
									<img class="w-100" src="{{asset('uploads/temp/${val.path}')}}">
									<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit image-edit-button" onclick="replaceImage('${val.name}',this)"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
								</div>
							</td>
							<td>
								<button type="button" class="add-image-button btn-orange" onclick="addMappedData('floor',this)">Add</button>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#8BC34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
							</td>
						</tr>`;
						floorCount++;
		});
		$('#floor-count').html(floorCount);
		$('#floor-section').html(floorContent);
		$('#floorDataTable').DataTable();
		$('#floorDataTable').parent().parent().addClass('table-overflow');

		// Floor Feature section
		$.each(res.mapped.floor_feature,function(key,val){
			floorFeatureContent+= `<tr data-id="${val.id}" data-ref="floor-feature" data-section="${val.section}" data-name="${val.name}">
							<td><input type="checkbox"></td>
							<td>${val.name}</td>
							<td class="section">${val.value} - ${val.section}</td>
							<td>${res.uploaded_by}</td>
							<td width="100px" style="min-width:100px;">
								<div style="position:relative;">
									<img class="w-100" src="{{asset('uploads/temp/${val.path}')}}">
									<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit image-edit-button" onclick="replaceImage('${val.name}',this)"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
								</div>
							</td>
							<td>
								<button type="button" class="add-image-button btn-orange" onclick="addMappedData('floor-feature',this)">Add</button>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#8BC34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
							</td>
						</tr>`;
						floorFeatureCount++;
		});
		$('#floor-feature-count').html(floorFeatureCount);
		$('#floor-feature-section').html(floorFeatureContent);
		$('#floorFeatureDataTable').DataTable();
		$('#floorFeatureDataTable').parent().parent().addClass('table-overflow');

		//color scheme
		$.each(res.mapped.color_scheme,function(key,val){
			colorSchemeContent+= `<tr data-id="${val.id}" data-ref="color-scheme" data-section="${val.section}" data-name="${val.name}">
							<td><input type="checkbox"></td>
							<td>${val.name}</td>
							<td class="section">${val.value} - ${val.section}</td>
							<td>${res.uploaded_by}</td>
							<td width="100px" style="min-width:100px;">
								<div style="position:relative;">
									<img class="w-100" src="{{asset('uploads/temp/${val.path}')}}">
									<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit image-edit-button" onclick="replaceImage('${val.name}',this)"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
								</div>
							</td>
							<td>
								<button type="button" class="add-image-button btn-orange" onclick="addMappedData('color-scheme',this)">Add</button>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#8BC34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
							</td>
						</tr>`;
						colorSchemeCount++;
		});
		$('#color-scheme-count').html(colorSchemeCount);
		$('#color-scheme-section').html(colorSchemeContent);
		$('#colorSchemeDataTable').DataTable();
		$('#colorSchemeDataTable').parent().parent().addClass('table-overflow');

		// color scheme feature
		$.each(res.mapped.color_scheme_feature,function(key,val){
			colorSchemeFeatureContent+= `<tr data-id="${val.id}" data-ref="color-scheme-feature" data-section="${val.section}" data-name="${val.name}">
							<td><input type="checkbox"></td>
							<td>${val.name}</td>
							<td class="section">${val.value} - ${val.section}</td>
							<td>${res.uploaded_by}</td>
							<td width="100px" style="min-width:100px;">
								<div style="position:relative;">
									<img class="w-100" src="{{asset('uploads/temp/${val.path}')}}">
									<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit image-edit-button" onclick="replaceImage('${val.name}',this)"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
								</div>
							</td>
							<td>
								<button type="button" class="add-image-button btn-orange" onclick="addMappedData('color-scheme-feature',this)">Add</button>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#8BC34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
							</td>
						</tr>`;
						colorSchemeFeatureCount++;
		});
		$('#color-scheme-feature-count').html(colorSchemeFeatureCount);
		$('#color-scheme-feature-section').html(colorSchemeFeatureContent);
		$('#colorSchemeFeatureDataTable').DataTable();
		$('#colorSchemeFeatureDataTable').parent().parent().addClass('table-overflow');

		// Unmapped data
		$.each(res.unmapped,function(key,val){
			unmappedContent+=`	<tr data-name="${val.name}" data-ref="unmapped">
									<td><input type="checkbox"></td>
									<td>${val.name}</td>
									<td class="section">Undefined</td>
									<td>${res.uploaded_by}</td>
									<td width="100px" style="min-width:100px;">
										<div style="position:relative;">
											<img class="w-100" src="{{asset('uploads/temp/${val.path}')}}">
											<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit image-edit-button" onclick="replaceImage('${val.name}',this)"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
										</div>
									</td>
									<td>
										<button type="button" class="add-image-button btn-orange" onclick="updateConnection('unmapped',this)" >Update</button>
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#8BC34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
									</td>
								</tr>`;
								unmappedCount++;
		});
		$('#unmapped-count').html(unmappedCount);
		mappedCount = communityCount+elevationCount+floorCount+floorFeatureCount+colorSchemeFeatureCount+colorSchemeCount;
		$('#mapped-count').html(mappedCount);
		$('#unmapped-section').html(unmappedContent);
		$('#unmappedDataTable').DataTable();
		$('#unmappedDataTable').parent().parent().addClass('table-overflow-unmapped');
		intializeTab();
		singleCheck();
		unmappedIntialization();
		singleUnmapped();
		$('.syncloader').hide();
		$('.table-responsive').show();
      });
    }
  };
function readURL(input){
  inputReference = input;
}
  function loadSubType(){
	  let type = arguments[0]; 	
	  let action = arguments[1];
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
					if(action!='update')
					{
						$('#subType').html(options);
					}
					else{
						$('#subTypeUpdate').html(options);
					}  
				}		
			})
	  	}
	  else{
		  if(arguments[1]!='update')
		  {
			$('#subType').html(options);
		  }
		  else{
			$('#subTypeUpdate').html(options);
		  }
		filter.type 	='';
		filter.sub_type ='';
		filter.section  = '';
	  }
	  loadSection(type,action);
    }
	function loadSection(type,action){
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
		if(action!='update')
		$('#section').html(options);
		else
		$('#updateSection').html(options);
	}
	function storeImgTemp(){
		$('.table-responsive').hide();
		$('.syncloader').fadeIn();
		$('#type').val(JSON.stringify(filter));
		var dropZone = Dropzone.forElement(".dropzone");
		dropZone.processQueue();
	}
// Mapped Section
$('#pills-mapped ul li a').on('shown.bs.tab', function (e) {
	intializeTab(); 
	singleCheck();
})
$('#pills-tab li a.main-tab-links').on('shown.bs.tab', function (e) {
	intializeTab(); 
	singleCheck();
	deleteInitialization();
	singleDelete();
	unmappedIntialization();
	singleUnmapped();
})
function intializeTab() 
{
	$("#pills-mapped .tab-pane.active .checkall").unbind().click(function(){
		let current_tab = $(this).parents('table').attr('id');
		$("#pills-mapped .tab-pane.active tbody input[type=checkbox]").prop('checked', $(this).prop('checked'));
		let rowsSelected = $("#pills-mapped .tab-pane.active tbody input[type=checkbox]:checked").length;
		switch(current_tab){
			case 'communityDataTable':
				rows[0] = rowsSelected;
				$("#pills-mapped .tab-pane.active .mapping-action-wrap span b").html(rows[0]);

			break;

			case 'elevationDataTable':
				rows[1] = rowsSelected;
				$("#pills-mapped .tab-pane.active .mapping-action-wrap span b").html(rows[1]);
			break;

			case 'colorSchemeDataTable':
				rows[2] = rowsSelected;
				$("#pills-mapped .tab-pane.active .mapping-action-wrap span b").html(rows[2]);
			break;

			case 'colorSchemeFeatureDataTable':
				rows[3] = rowsSelected;
				$("#pills-mapped .tab-pane.active .mapping-action-wrap span b").html(rows[3]);
			break;

			case 'floorDataTable':
				rows[4] = rowsSelected;
				$("#pills-mapped .tab-pane.active .mapping-action-wrap span b").html(rows[4]);
			break;

			case 'floorFeatureDataTable':
				rows[5] = rowsSelected;
				$("#pills-mapped .tab-pane.active .mapping-action-wrap span b").html(rows[5]);
			break;

			default:
			break
		}
		if(rowsSelected > 0)
		{
			$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeIn();
		}
		else
		{
			$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeOut();
		}
	});	
}
function singleCheck()
{
	$("#pills-mapped .tab-pane.active tbody input[type=checkbox]").unbind().click(function()
	{
		let current_tab = $(this).parents('table').attr('id');
		switch(current_tab){
			case 'communityDataTable':
				if(this.checked)
				{
					rows[0]++;	
				}
				else{
					rows[0]--;
				}
				$("#pills-mapped .tab-pane.active .mapping-action-wrap span b").html(rows[0]);
				if(rows[0] > 0)
				{
					$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeIn();
				}
				else
				{
					$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeOut();
				}
			break;

			case 'elevationDataTable':
				if(this.checked)
				{
					rows[1]++;	
				}
				else{
					rows[1]--;
				}
				$("#pills-mapped .tab-pane.active .mapping-action-wrap span b").html(rows[1]);
				if(rows[1] > 0)
				{
					$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeIn();
				}
				else
				{
					$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeOut();
				}
			break;

			case 'colorSchemeDataTable':
				if(this.checked)
				{
					rows[2]++;	
				}
				else{
					rows[2]--;
				}
				$("#pills-mapped .tab-pane.active .mapping-action-wrap span b").html(rows[2]);
				if(rows[2] > 0)
				{
					$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeIn();
				}
				else
				{
					$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeOut();
				}
			break;

			case 'colorSchemeFeatureDataTable':
				if(this.checked)
				{
					rows[3]++;	
				}
				else{
					rows[3]--;
				}
				$("#pills-mapped .tab-pane.active .mapping-action-wrap span b").html(rows[3]);
				if(rows[3] > 0)
				{
					$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeIn();
				}
				else
				{
					$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeOut();
				}
			break;

			case 'floorDataTable':
				if(this.checked)
				{
					rows[4]++;	
				}
				else{
					rows[4]--;
				}
				$("#pills-mapped .tab-pane.active .mapping-action-wrap span b").html(rows[4]);
				if(rows[4] > 0)
				{
					$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeIn();
				}
				else
				{
					$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeOut();
				}
			break;

			case 'floorFeatureDataTable':
				if(this.checked)
				{
					rows[5]++;	
				}
				else{
					rows[5]--;
				}
				$("#pills-mapped .tab-pane.active .mapping-action-wrap span b").html(rows[5]);
				if(rows[5] > 0)
				{
					$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeIn();
				}
				else
				{
					$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeOut();
				}
			break;

			default:
			break;
		}
	});	
}

function addMappedData(currentTab,single){

	let arrTr;
	switch(currentTab){
		case 'community':
			if(single)
			{
				allTr = $(single).parents('tr');
				$(single).parents('tr').find('.add-image-button').fadeOut(function(){
					$(single).parents('tr').find('.add-image-button').next().fadeIn();
				});
			}
			else{
				allTr = $("#communityDataTable tbody input[type=checkbox]:checked").parents('tr');
				$("#communityDataTable tbody input[type=checkbox]:checked").parents('tr').find('.add-image-button').fadeOut(function(){
				$("#communityDataTable tbody input[type=checkbox]:checked").parents('tr').find('.add-image-button').next().fadeIn();
			});
			}
			pushInMapArray(allTr,'community');
			$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeOut();
		break;

		case 'elevation':
			if(single){
				allTr = $(single).parents('tr');
				$(single).parents('tr').find('.add-image-button').fadeOut(function(){
					$(single).parents('tr').find('.add-image-button').next().fadeIn();
				});
			}
			else{
				allTr = $("#elevationDataTable tbody input[type=checkbox]:checked").parents('tr');
				$("#elevationDataTable tbody input[type=checkbox]:checked").parents('tr').find('.add-image-button').fadeOut(function(){
					$("#elevationDataTable tbody input[type=checkbox]:checked").parents('tr').find('.add-image-button').next().fadeIn();
				});
			}
			pushInMapArray(allTr,'elevation');
			$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeOut();
		break;

		case 'color-scheme':
			if(single){
				allTr = $(single).parents('tr');
				$(single).parents('tr').find('.add-image-button').fadeOut(function(){
					$(single).parents('tr').find('.add-image-button').next().fadeIn();
				});
			}
			else{
				allTr = $("#colorSchemeDataTable tbody input[type=checkbox]:checked").parents('tr');
				$("#colorSchemeDataTable tbody input[type=checkbox]:checked").parents('tr').find('.add-image-button').fadeOut(function(){
					$("#colorSchemeDataTable tbody input[type=checkbox]:checked").parents('tr').find('.add-image-button').next().fadeIn();
				});
			}
			pushInMapArray(allTr,'color_scheme');
			$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeOut();
		break;
		case 'color-scheme-feature':
			if(single){
				allTr = $(single).parents('tr');
				$(single).parents('tr').find('.add-image-button').fadeOut(function(){
					$(single).parents('tr').find('.add-image-button').next().fadeIn();
				});
			}
			else{
				allTr = $("#colorSchemeFeatureDataTable tbody input[type=checkbox]:checked").parents('tr');
				$("#colorSchemeFeatureDataTable tbody input[type=checkbox]:checked").parents('tr').find('.add-image-button').fadeOut(function(){
					$("#colorSchemeFeatureDataTable tbody input[type=checkbox]:checked").parents('tr').find('.add-image-button').next().fadeIn();
				});
			}
			pushInMapArray(allTr,'color_scheme_feature');
			$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeOut();
		break;

		case 'floor':
			if(single){
				allTr = $(single).parents('tr');
				$(single).parents('tr').find('.add-image-button').fadeOut(function(){
					$(single).parents('tr').find('.add-image-button').next().fadeIn();
				});
			}
			else{
				allTr = $("#floorDataTable tbody input[type=checkbox]:checked").parents('tr');
				$("#floorDataTable tbody input[type=checkbox]:checked").parents('tr').find('.add-image-button').fadeOut(function(){
					$("#floorDataTable tbody input[type=checkbox]:checked").parents('tr').find('.add-image-button').next().fadeIn();
				});
			}
			pushInMapArray(allTr,'floor');
			$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeOut();
		break;

		case 'floor-feature':
			if(single){
				allTr = $(single).parents('tr');
				$(single).parents('tr').find('.add-image-button').fadeOut(function(){
					$(single).parents('tr').find('.add-image-button').next().fadeIn();
				});
			}
			else{
				allTr = $("#floorFeatureDataTable tbody input[type=checkbox]:checked").parents('tr');
				$("#floorFeatureDataTable tbody input[type=checkbox]:checked").parents('tr').find('.add-image-button').fadeOut(function(){
					$("#floorFeatureDataTable tbody input[type=checkbox]:checked").parents('tr').find('.add-image-button').next().fadeIn();
				});
			}
			pushInMapArray(allTr,'floor_feature');
			$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeOut();
		break;

		default:
		break; 
	}
}
$('#pills-mapped .tab-pane.active .add-image-button').on('click', function(){
	const button = $(this);
	button.fadeOut(function(){
		button.next().fadeIn();
	})
});

function updateConnection(){
	$("#updateModal").modal('show');
		currentTab = arguments[0];
	if(arguments[1] != 'undefined'){
		singleUpdate = arguments[1];
	}
}
function applyUpdate(){
	let allTr;
	switch(currentTab){
		case 'community':
			allTr = $("#communityDataTable tbody input[type=checkbox]:checked").parents('tr');

			if((filter.section =='logo' || filter.section =='map' || filter.section =='banner' || filter.section =='feature-image') && allTr.length !=1){
				toastr.error('You have selected multiple rows please apply filter accordingly.');
			}
			else{
				$("#updateModal").modal('hide');
				switchData(allTr,'communityDataTable');
				$("#communityDataTable thead input[type=checkbox]").prop('checked',false);
				$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeOut();
				rows[0] = 0;
			}
		break;

		case 'elevation':
			allTr = $("#elevationDataTable tbody input[type=checkbox]:checked").parents('tr');

			if(( filter.section =='feature-image') && allTr.length !=1){
				toastr.error('You have selected multiple rows please apply filter accordingly.');
			}
			else{
				$("#updateModal").modal('hide');
				switchData(allTr,'elevationDataTable');
				$("#communityDataTable thead input[type=checkbox]").prop('checked',false);
				$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeOut();
				rows[1] = 0;
			}
		break;

		case 'color-scheme':
			allTr = $("#colorSchemeDataTable tbody input[type=checkbox]:checked").parents('tr');

			if(( filter.section =='feature-image') && allTr.length !=1){
				toastr.error('You have selected multiple rows please apply filter accordingly.');
			}
			else{
				$("#updateModal").modal('hide');
				switchData(allTr,'colorSchemeDataTable');
				$("#colorSchemeDataTable thead input[type=checkbox]").prop('checked',false);
				$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeOut();
				rows[2] = 0;
			}
		break;

		case 'color-scheme-feature':
			allTr = $("#colorSchemeFeatureDataTable tbody input[type=checkbox]:checked").parents('tr');

			if(( filter.section =='feature-image') && allTr.length !=1){
				toastr.error('You have selected multiple rows please apply filter accordingly.');
			}
			else{
				$("#updateModal").modal('hide');
				switchData(allTr,'colorSchemeFeatureDataTable');
				$("#colorSchemeFeatureDataTable thead input[type=checkbox]").prop('checked',false);
				$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeOut();
				rows[3] = 0;
			}
		break;

		case 'floor': 
			allTr = $("#floorDataTable tbody input[type=checkbox]:checked").parents('tr');

			if(( filter.section =='feature-image') && allTr.length !=1){
				toastr.error('You have selected multiple rows please apply filter accordingly.');
			}
			else{
				$("#updateModal").modal('hide');
				switchData(allTr,'floorDataTable');
				$("#floorDataTable thead input[type=checkbox]").prop('checked',false);
				$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeOut();
				rows[4] = 0;
			}
		break;

		case 'floor-feature':
			allTr = $("#floorDataTable tbody input[type=checkbox]:checked").parents('tr');

			if(( filter.section =='feature-image') && allTr.length !=1){
				toastr.error('You have selected multiple rows please apply filter accordingly.');
			}
			else{
				$("#updateModal").modal('hide');
				switchData(allTr,'floorFeatureDataTable');
				$("#floorFeatureDataTable thead input[type=checkbox]").prop('checked',false);
				$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeOut();
				rows[5] = 0;
			}
		break;

		case 'unmapped':
			if(singleUpdate){
				allTr = $(singleUpdate).parents('tr');
			}
			else{
				allTr = $("#unmappedDataTable tbody input[type=checkbox]:checked").parents('tr');
			}

			if(( filter.section =='feature-image') && allTr.length !=1){
				toastr.error('You have selected multiple rows please apply filter accordingly.');
			}
			else{
				$("#updateModal").modal('hide');
				switchData(allTr,'unmappedDataTable');
				$("#unmappedDataTable thead input[type=checkbox]").prop('checked',false);
				$("#pills-unmapped .table-responsive .mapping-action-wrap").fadeOut();
				unmappedrowsSelected = 0;
			}
		break; 
		default:
		break;
	}
}

//Switch data in betweem tabs. filter option will tell where to put data
function switchData(allTr,dataTable){
	if(filter.type == currentTab)
	{
		$("#"+dataTable+" tbody input[type=checkbox]:checked").parents('tr').find('.section').text(currentValue+'-'+filter.section);
		$("#"+dataTable+" tbody input[type=checkbox]:checked").parents('tr').attr('data-id',filter.sub_type);
		$("#"+dataTable+" tbody input[type=checkbox]:checked").parents('tr').attr('data-section',filter.section);
		$("#"+dataTable+" tbody input[type=checkbox]:checked").prop('checked',false)
		$('#'+dataTable).DataTable();
		return;
	}
	else{
		let currentTable,targetTable;
		currentTable = $('#'+dataTable).DataTable();
		let rows = currentTable.rows(allTr);
		rows.remove().draw();

		if(dataTable=='communityDataTable'){
			communityCount = communityCount-allTr.length;
			$('#community-count').html(communityCount);
		}
		if(dataTable =='elevationDataTable'){
			elevationCount = elevationCount-allTr.length;
			$('#elevation-count').html(elevationCount);
		}
		if(dataTable=='colorSchemeDataTable'){
			colorSchemeCount = colorSchemeCount-allTr.length;
			$('#color-scheme-count').html(colorSchemeCount);
		}
		if(dataTable=='colorSchemeFeatureDataTable'){
			colorSchemeFeatureCount = colorSchemeFeatureCount-allTr.length;
			$('#color-scheme-feature-count').html(colorSchemeFeatureCount);
		}
		if(dataTable=='floorDataTable'){
			floorCount = floorCount-allTr.length;
			$('#floor-count').html(floorCount);
		}
		if(dataTable=='floorFeatureDataTable'){
			floorFeatureCount = floorFeatureCount-allTr.length;
			$('#floor-feature-count').html(floorFeatureCount);
		}
		if(dataTable == 'unmappedDataTable'){
			unmappedCount = unmappedCount-allTr.length;
			$('#unmapped-count').html(unmappedCount);
			mappedCount = mappedCount+allTr.length;
			$('#mapped-count').html(mappedCount);
		}
		let targetDataTable;
		if(filter.type=='community'){
			targetDataTable = 'communityDataTable';
			communityCount = communityCount+allTr.length;
			$('#community-count').html(communityCount);
		} 
		if(filter.type=='elevation'){
			targetDataTable = 'elevationDataTable';
			elevationCount = elevationCount+allTr.length;
			$('#elevation-count').html(elevationCount);
		}
		if(filter.type=='color-scheme') {
			targetDataTable = 'colorSchemeDataTable';
			colorSchemeCount = colorSchemeCount+allTr.length;
			$('#color-scheme-count').html(colorSchemeCount);
		}

		if(filter.type=='color-scheme-feature'){
			targetDataTable = 'colorSchemeFeatureDataTable';
			colorSchemeFeatureCount = colorSchemeFeatureCount+allTr.length;
			$('#color-scheme-feature-count').html(colorSchemeFeatureCount);
		} 

		if(filter.type=='floor'){
			targetDataTable = 'floorDataTable';
			floorCount = floorCount+allTr.length;
			$('#floor-count').html(floorCount);
		}
		if(filter.type=='floor-feature'){	
			targetDataTable = 'floorFeatureDataTable';
			floorFeatureCount = floorFeatureCount+allTr.length;
			$('#floor-feature-count').html(floorFeatureCount);
		} 
		targetTable = $('#'+targetDataTable).DataTable();

		for(let i =0; i<allTr.length; i++)
		{
			if(currentTab == 'unmapped'){
				$(allTr[i]).find('td button').removeClass('disabled-button');
				$(allTr[i]).find('td button').html('Add');
			}
			($(allTr[i]).find('.section')).text(currentValue+'-'+filter.section);
			$(allTr[i]).find('input[type=checkbox]').prop('checked',false);
			$(allTr[i]).find('td button').attr('onClick','addMappedData(\''+filter.type+'\',this)');
			allTr[i].dataset.id  = filter.sub_type;
			allTr[i].dataset.ref = filter.type;
			allTr[i].dataset.section = filter.section;
			targetTable.row.add(allTr[i]).draw();
		}
		$('#'+targetDataTable).DataTable();
		$('#'+dataTable).DataTable();
		 return;
	}
}

//Push in map array
function pushInMapArray(allTr,key){
	for(let i=0;i<allTr.length;i++){
		let tempObj = {
					'section': allTr[i].dataset.section,
					'image_name': allTr[i].dataset.name,
					'id': allTr[i].dataset.id
				};
		if(!checkIfobjExist(mapped[key],tempObj))
			mapped[key].push(tempObj);	
			}
}
//Check if objects already added
function checkIfobjExist(array,obj){
	for(let i=0;i<array.length;i++){
		if( obj.section ==array[i].section && obj.image_name == array[i].name  && obj.id ==array[i].id)
		return true;
	}
	return false;
}
function replaceImage(name,ref){
	$("#replaceModal").modal("show");
	$('#previous_file').val(name);
	updateImageReference = ref;
}
$("#replaceImageForm").on("submit",function(e){
	e.preventDefault();
	let frm = $('#replaceImageForm');
    let formData = new FormData(frm[0]);
    formData.append('file', $('#replaceImageForm input[type=file]')[0].files[0]);
	let filename = inputReference.files[0].name;
	var extFile = (filename.split('.').pop()).toLowerCase();
      if (extFile!="jpg" && extFile!="jpeg" && extFile!="png"){
		toastr.error("Please choose a valid file.");
		inputReference = '';
		return;
      }
	if (inputReference.files && inputReference.files[0]){

		$(updateImageReference).parents('tr').find('td:eq(1)').html(filename)
		$(updateImageReference).parents('tr').attr('data-name',filename);
		var reader = new FileReader();
		reader.onload = function (e) {
		$(updateImageReference).parents('tr').find('td img')
			.attr('src', e.target.result)
		};
		reader.readAsDataURL(inputReference.files[0]);
  }
	$.ajax({
		type:'post',
		url: '/api/update/image',
		enctype: 'multipart/form-data',
		headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
		data:formData,
		cache: false,
        contentType: false,
		processData: false,
		
		success: function(){
			
		}
	})
	$("#replaceModal").modal("hide");
})

// Unmapped Section
function unmappedIntialization(){
	$("#pills-unmapped .checkall").unbind().click(function(){
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
}
function singleUnmapped(){
	$("#pills-unmapped tbody input[type=checkbox]").unbind().click(function()
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
}

// Deleted Section
deleteInitialization();
singleDelete();
function deleteInitialization(){
	$("#pills-deleted .checkall").unbind().click(function(){
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
}
function singleDelete(){

	$("#pills-deleted tbody input[type=checkbox]").unbind().click(function()
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
}


$(document).ready( function () {
	$('#deleteDataTable').DataTable();
	$('#deleteDataTable').parent().parent().addClass('table-overflow-unmapped');	
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

//Delete section script
function moveToDeleteSection(current_tab){
	switch(current_tab){

		case 'community':
			allTr = $("#communityDataTable tbody input[type=checkbox]:checked").parents('tr');
			shiftingToDeleteSection(allTr,'communityDataTable');
			$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeOut();
			$("#communityDataTable thead input[type=checkbox]").prop('checked',false);
			rows[0] = 0;
		break;

		case 'elevation':
			allTr = $("#elevationDataTable tbody input[type=checkbox]:checked").parents('tr');
			shiftingToDeleteSection(allTr,'elevationDataTable');
			$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeOut();
			$("#elevationDataTable thead input[type=checkbox]").prop('checked',false);
			rows[1] = 0;
		break;

		case 'color-scheme':
			allTr = $("#colorSchemeDataTable tbody input[type=checkbox]:checked").parents('tr');
			shiftingToDeleteSection(allTr,'colorSchemeDataTable');
			$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeOut();
			$("#colorSchemeDataTable thead input[type=checkbox]").prop('checked',false);
			rows[2] = 0;
		break;

		case 'color-scheme-feature':
			allTr = $("#colorSchemeFeatureDataTable tbody input[type=checkbox]:checked").parents('tr');
			shiftingToDeleteSection(allTr,'colorSchemeFeatureDataTable');
			$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeOut();
			$("#colorSchemeFeatureDataTable thead input[type=checkbox]").prop('checked',false);
			rows[3] = 0;
		break;

		case 'floor':
			allTr = $("#floorDataTable tbody input[type=checkbox]:checked").parents('tr');
			shiftingToDeleteSection(allTr,'floorDataTable');
			$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeOut();
			$("#floorDataTable thead input[type=checkbox]").prop('checked',false);
			rows[4] = 0;
		break;

		case 'floor-feature':
			allTr = $("#floorFeatureDataTable tbody input[type=checkbox]:checked").parents('tr');
			shiftingToDeleteSection(allTr,'floorFeatureDataTable');
			$("#pills-mapped .tab-pane.active .table-responsive .mapping-action-wrap").fadeOut();
			$("#floorFeatureDataTable thead input[type=checkbox]").prop('checked',false);
			rows[5] = 0;
		break;

		case 'unmapped':
			allTr = $("#unmappedDataTable tbody input[type=checkbox]:checked").parents('tr');
			shiftingToDeleteSection(allTr,'unmappedDataTable');
			$("#pills-unmapped  .table-responsive .mapping-action-wrap").fadeOut();
			$("#unmappedDataTable thead input[type=checkbox]").prop('checked',false);
			unmappedrowsSelected = 0;
		break;

		default:
		break;

	}
}
function shiftingToDeleteSection(allTr,dataTable){
	let currentTable,targetTable;
		currentTable = $('#'+dataTable).DataTable();
		let rows = currentTable.rows(allTr);
		// let rowNode = rows.node();
		rows.remove().draw();

		if(dataTable=='communityDataTable'){
			communityCount = communityCount-allTr.length;
			$('#community-count').html(communityCount);
			mappedCount = mappedCount-allTr.length;
			$('#mapped-count').html(mappedCount);
		}
		if(dataTable =='elevationDataTable'){
			elevationCount = elevationCount-allTr.length;
			$('#elevation-count').html(elevationCount);
			mappedCount = mappedCount-allTr.length;
			$('#mapped-count').html(mappedCount);
		}
		if(dataTable=='colorSchemeDataTable'){
			colorSchemeCount = colorSchemeCount-allTr.length;
			$('#color-scheme-count').html(colorSchemeCount);
			mappedCount = mappedCount-allTr.length;
			$('#mapped-count').html(mappedCount);
		}
		if(dataTable=='colorSchemeFeatureDataTable'){
			colorSchemeFeatureCount = colorSchemeFeatureCount-allTr.length;
			$('#color-scheme-feature-count').html(colorSchemeFeatureCount);
			mappedCount = mappedCount-allTr.length;
			$('#mapped-count').html(mappedCount);
		}
		if(dataTable=='floorDataTable'){
			floorCount = floorCount-allTr.length;
			$('#floor-count').html(floorCount);
			mappedCount = mappedCount-allTr.length;
			$('#mapped-count').html(mappedCount);
		}
		if(dataTable=='floorFeatureDataTable'){
			floorFeatureCount = floorFeatureCount-allTr.length;
			$('#floor-feature-count').html(floorFeatureCount);
			mappedCount = mappedCount-allTr.length;
			$('#mapped-count').html(mappedCount);
		}
		if(dataTable == 'unmappedDataTable'){
			unmappedCount = unmappedCount-allTr.length;
			$('#unmapped-count').html(unmappedCount);
			unmappedrowsSelected = unmappedrowsSelected - allTr.length;
		}
		targetTable = $('#deleteDataTable').DataTable();
		deleteCount = deleteCount+allTr.length;
		$('#delete-count').html(deleteCount);
		for(let i =0; i<allTr.length; i++)
		{
			if(dataTable == 'unmappedDataTable'){
				$(allTr[i]).find('td button').removeClass('disabled-button');
			}
			$(allTr[i]).find('td button').html('Undo');
			$(allTr[i]).find('td button').attr('onClick','undo(this)');
			$(allTr[i]).find('input[type=checkbox]').prop('checked',false);
			targetTable.row.add(allTr[i]).draw();
		}
		$('#deleteDataTable').DataTable();
		return;
}
function undo(){
	let singleUndo = arguments[0];
	let allTr; let targetTable;
	if(singleUndo){
		allTr = $(singleUndo).parents('tr');
	}
	else{
		allTr = $("#deleteDataTable tbody input[type=checkbox]:checked").parents("tr");
	}
	let currentDataTable = $('#deleteDataTable').DataTable();
	deleteCount = deleteCount-allTr.length;
	deletedrowsSelected = deletedrowsSelected-allTr.length;
	$('#delete-count').html(deleteCount);
	let rows = currentDataTable.rows(allTr);
	 rows.remove().draw();
	for(let i=0; i<allTr.length; i++){
		let belongsTo = allTr[i].dataset.ref;
		if(belongsTo == 'community'){
			targetTable = $('#communityDataTable').DataTable();
			communityCount = communityCount+1;
			$('#community-count').html(communityCount);
			mappedCount = mappedCount+1;
			$('#mapped-count').html(mappedCount);
			$(allTr[i]).find('td button').html('Add');
			$(allTr[i]).find('td button').attr('onClick','addMappedData("community",this)');
			$(allTr[i]).find('input[type=checkbox]').prop('checked',false);
		}
		if(belongsTo == 'elevation'){
			targetTable = $('#elevationDataTable').DataTable();
			elevationCount = elevationCount+1;
			$('#elevation-count').html(elevationCount);
			mappedCount = mappedCount+1;
			$('#mapped-count').html(mappedCount);
			$(allTr[i]).find('td button').html('Add');
			$(allTr[i]).find('td button').attr('onClick','addMappedData("elevation",this)');
			$(allTr[i]).find('input[type=checkbox]').prop('checked',false);
		}
		if(belongsTo == 'color-scheme'){
			targetTable = $('#colorSchemeDataTable').DataTable();
			colorSchemeCount = colorSchemeCount+1;
			$('#color-scheme-count').html(colorSchemeCount);
			mappedCount = mappedCount+1;
			$('#mapped-count').html(mappedCount);
			$(allTr[i]).find('td button').html('Add');
			$(allTr[i]).find('td button').attr('onClick','addMappedData("color-scheme",this)');
			$(allTr[i]).find('input[type=checkbox]').prop('checked',false);
		}
		if(belongsTo == 'color-scheme-feature'){
			targetTable = $('#colorSchemeFeatureDataTable').DataTable();
			colorSchemeFeatureCount = colorSchemeFeatureCount+1;
			$('#color-scheme-feature-count').html(colorSchemeFeatureCount);
			mappedCount = mappedCount+1;
			$('#mapped-count').html(mappedCount);
			$(allTr[i]).find('td button').html('Add');
			$(allTr[i]).find('td button').attr('onClick','addMappedData("color-scheme-feature",this)');
			$(allTr[i]).find('input[type=checkbox]').prop('checked',false);
		}
		if(belongsTo == 'floor'){
			targetTable = $('#floorDataTable').DataTable();
			floorCount = floorCount+1;
			$('#floor-count').html(floorCount);
			mappedCount = mappedCount+1;
			$('#mapped-count').html(mappedCount);
			$(allTr[i]).find('td button').html('Add');
			$(allTr[i]).find('td button').attr('onClick','addMappedData("floor",this)');
			$(allTr[i]).find('input[type=checkbox]').prop('checked',false);
		}
		if(belongsTo == 'floor-feature'){
			targetTable = $('#floorFeatureDataTable').DataTable();
			floorFeatureCount = floorFeatureCount+1;
			$('#floor-count').html(floorFeatureCount);
			mappedCount = mappedCount+1;
			$('#mapped-count').html(mappedCount);
			$(allTr[i]).find('td button').html('Add');
			$(allTr[i]).find('td button').attr('onClick','addMappedData("floor-feature",this)');
			$(allTr[i]).find('input[type=checkbox]').prop('checked',false);
		}
		if(belongsTo == 'unmapped'){
			targetTable = $('#unmappedDataTable').DataTable();
			unmappedCount = unmappedCount+1;
			$('#unmapped-count').html(unmappedCount);
			$(allTr[i]).find('td button').html('Update');
			$(allTr[i]).find('td button').attr('onClick','updateConnection("unmapped",this)');
			$(allTr[i]).find('input[type=checkbox]').prop('checked',false);
		}
		targetTable.row.add(allTr[i]).draw();
		$("#pills-deleted  .table-responsive .mapping-action-wrap").fadeOut();
		$("#deleteDataTable thead input[type=checkbox]").prop('checked',false);
	}
}

function confirmAndUpload(){
	if(mapped.community.length!=0 || mapped.elevation.length!=0 || mapped.color_scheme.length!=0 || mapped.color_scheme_feature.length!=0 || mapped.floor.length!=0 || mapped.floor_feature.length!=0){
		let data = JSON.stringify(mapped);
		$.ajax({
			type: 'post',
			url: '/api/bulk/upload',
			data: {'mapped':data,'import_as':$('#importOptions').val()},
			headers :{
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			beforeSend  : function(){
				$('.table-responsive').hide();
				$('.syncloader').fadeIn();
			},
			success: function(response){
				$('.badge-success').html(response.success);
				$('.badge-light').html(response.skip);
				$('.badge-danger').html(response.fail);
				$('.badge-info').html(`${response.percentage}%`);
				$(".uploadloader").hide();
				$('.report-wrap').fadeIn();
			},
			error: function(error){
				$(".uploadloader").hide();
				toastr.error('Something went wrong, please try again.');
			},
			complete	: function(){
				$('.syncloader').hide();
				$('.table-responsive').show();
			} 
		})
		return true;
	}
	else{
		toastr.error('please confirm atleast one image to proceed.');
		return false;
	}
}
</script>
@endpush