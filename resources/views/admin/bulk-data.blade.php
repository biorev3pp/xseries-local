@extends('layouts.admin') @section('content')
<style>

#ss_step_div{
	display: block;
}

.containers{
	display:none;
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
	padding: 0 15px;
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

.choose-file-wrap{
    max-width: 70%;
    margin: 0 auto;
}

.file-upload {
    display: block;
    text-align: center;
    font-family: Helvetica, Arial, sans-serif;
    font-size: 12px;
    width: calc(100% - 106px);
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

.tab-content label{
	font-size: 15px;
}

.footer-buttons{
    text-align: right;
	margin-top: 5px;
}

.mapping-fields-wrapper{
	height: calc(100vh - 383px);
	overflow: auto;
}

#backButton{
	display: none;
	background-color: #313131!important;
	transition: 0.3s ease background-color;
}

.nowrap{
	white-space: nowrap;
}

select.form-control:disabled{
	background-color: #eee;
}

@media(max-width:1200px){
	.mapping-fields-wrapper{
		height: auto;
		overflow: hidden;
		padding-bottom: 30px;
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

@media(max-width:768px){
    .file-upload{width: 100%; margin-bottom: 5px;}
    .choose-file-wrap{max-width: 100%;}
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
                <a href="{{ route('bulk-data') }}"> Bulk Data Upload </a>
                </li>
                </ol>
            </div>
		</div>
		<div class="btn-group">
			<a style="position:relative;" href="{{route('uploads')}}" class="add_button"><i style="top:0;" class="fa fa-arrow-left"></i> Back</a>
		</div>
	</div>
	<div id="syncresponse">
		<div class="sync-process text-center mb-1">
			<ul class="text-center">
				<li> <a class="active text-center" id="ss_step">1</a> </li>
				<li> <a class="incomplete text-center" id="drm_step">2</a> </li>
				<li> <a class="incomplete text-center" id="sr_step">3</a> </li>
			</ul>
		</div>
		<div class="fix-sync">
			<div class="sync-container">
				<div id="ss_step_div" class="text-center containers">
					<h3 class="text-center">Import Files</h3>
					<div class="pt-0 pb-2">
						<h6 style="font-weight: 500;">Have existing records in your own file? Import your own excel file. If not you can download sample file.</h6>
					</div>
					<div class="row pl-1 pr-1 justify-content-between align-items-center choose-file-wrap">
						<div class="file-upload pr-md-1 pr-0">
							<div class="file-select">
								<div class="file-select-button" id="fileName">Choose Excel File</div>
								<div class="file-select-name" id="noFile">No file chosen...</div>
								<input type="file" name="excel_file" id="excelFile"> 
                            </div>
						</div> 
                        <a href="{{ url('/admin/bulk-upload-sample.xlsx') }}">
							<button class="btn-orange" type="button"> Sample File </button>
                        </a>
                    </div>
					<h6 class="my-2">OR</h6>
                    <button class="btn-orange" type="button" style="float:unset;"> Import From Google </button>
					<a href="{{route('import-history')}}"><h6 class="mt-3" style="cursor:pointer; width:fit-content; margin:0 auto; font-weight:500;">View Recent Reports</h6></a>
					<div class="mt-2 mx-auto border border-light py-1 px-2" style="max-width:450px;">
						<label class="text-left d-block text-dark" style="font-weight:500 !important; margin-bottom: 5px;">Import Options</label>
						<div class="d-flex flex-sm-row flex-column justify-content-between align-items-center">
							<select id="importOptions" class="form-control mr-0 mr-sm-1 mb-1 mb-sm-0" disabled>
								<option value="">override</option>
								<option value="">update</option>
								<option value="" selected>skip</option>
							</select>
							<div class="w-100 d-flex align-items-center">
								<input type="checkbox" id="importCheck" style="margin-right: 5px;">
								<span class="nowrap">Update existing data while importing.</span>
							</div>
						</div>
					</div>
				</div>
				<div id="drm_step_div" class="table-responsive containers">
					<h3 class="text-center mb-1">Mapping</h3>
					<ul class="nav nav-pills mb-0 justify-content-center" id="pills-tab" role="tablist">
						<li class="nav-item" role="presentation">
							<a class="nav-link active" id="pills-communities-tab" data-toggle="pill" href="#pills-communities" role="tab" aria-controls="pills-communities" aria-selected="true">Communities</a>
						</li>
						<li class="nav-item" role="presentation">
							<a class="nav-link" id="pills-elevations-tab" data-toggle="pill" href="#pills-elevations" role="tab" aria-controls="pills-elevations" aria-selected="false">Elevations</a>
						</li>
						<li class="nav-item" role="presentation">
							<a class="nav-link" id="pills-elevation-types-tab" data-toggle="pill" href="#pills-elevation-types" role="tab" aria-controls="pills-elevation-types" aria-selected="false">Elevation Types</a>
						</li>
						<li class="nav-item" role="presentation">
							<a class="nav-link" id="pills-color-schemes-tab" data-toggle="pill" href="#pills-color-schemes" role="tab" aria-controls="pills-color-schemes" aria-selected="false">Color Schemes</a>
						</li>
						<li class="nav-item" role="presentation">
							<a class="nav-link" id="pills-color-scheme-features-tab" data-toggle="pill" href="#pills-color-scheme-features" role="tab" aria-controls="pills-color-scheme-features" aria-selected="false">Color Scheme Features</a>
						</li>
						<li class="nav-item" role="presentation">
							<a class="nav-link" id="pills-floors-tab" data-toggle="pill" href="#pills-floors" role="tab" aria-controls="pills-floors" aria-selected="false">Floors</a>
						</li>
						<li class="nav-item" role="presentation">
							<a class="nav-link" id="pills-floor-features-tab" data-toggle="pill" href="#pills-floor-features" role="tab" aria-controls="pills-floor-features" aria-selected="false">Floor Features</a>
						</li>
					</ul>
					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade show active" id="pills-communities" role="tabpanel" aria-labelledby="pills-communities-tab">
							<div class="d-flex justify-content-between border-bottom bg-light" style="padding:1.21rem;">
								<h6 class="mb-0 w-100">Column To Import</h6>
								<h6 class="mb-0 w-100" style="max-width:300px;">Map Into Field</h6>
							</div>
							<div class="mapping-fields-wrapper" id="community-tab">
								<p class="syncloader text-center my-2" style="display:none;"><img src="{{asset('images/spinner.gif')}}"></p>
							</div>
						</div>
						<div class="tab-pane fade" id="pills-elevations" role="tabpanel" aria-labelledby="pills-elevations-tab">
							<div class="d-flex justify-content-between border-bottom bg-light" style="padding:1.21rem;">
								<h6 class="mb-0 w-100">Column To Import</h6>
								<h6 class="mb-0 w-100" style="max-width:300px;">Map Into Field</h6>
							</div>
							<div class="mapping-fields-wrapper" id="elevation-tab">
								<p class="syncloader text-center my-2" style="display:none;"><img src="{{asset('images/spinner.gif')}}"></p>
							</div>
						</div>
						<div class="tab-pane fade" id="pills-elevation-types" role="tabpanel" aria-labelledby="pills-elevation-types-tab">
							<div class="d-flex justify-content-between border-bottom bg-light" style="padding:1.21rem;">
								<h6 class="mb-0 w-100">Column To Import</h6>
								<h6 class="mb-0 w-100" style="max-width:300px;">Map Into Field</h6>
							</div>
							<div class="mapping-fields-wrapper" id="elevation-type-tab">
								<p class="syncloader text-center my-2" style="display:none;"><img src="{{asset('images/spinner.gif')}}"></p>
							</div>
						</div>
						<div class="tab-pane fade" id="pills-color-schemes" role="tabpanel" aria-labelledby="pills-color-schemes-tab">
							<div class="d-flex justify-content-between border-bottom bg-light" style="padding:1.21rem;">
								<h6 class="mb-0 w-100">Column To Import</h6>
								<h6 class="mb-0 w-100" style="max-width:300px;">Map Into Field</h6>
							</div>
							<div class="mapping-fields-wrapper" id="color-scheme-tab">
								<p class="syncloader text-center my-2" style="display:none;"><img src="{{asset('images/spinner.gif')}}"></p>
							</div>
						</div>
						<div class="tab-pane fade" id="pills-color-scheme-features" role="tabpanel" aria-labelledby="pills-color-scheme-features-tab">
							<div class="d-flex justify-content-between border-bottom bg-light" style="padding:1.21rem;">
								<h6 class="mb-0 w-100">Column To Import</h6>
								<h6 class="mb-0 w-100" style="max-width:300px;">Map Into Field</h6>
							</div>
							<div class="mapping-fields-wrapper" id="color-scheme-features-tab">
								<p class="syncloader text-center my-2" style="display:none;"><img src="{{asset('images/spinner.gif')}}"></p>
							</div>
						</div>
						<div class="tab-pane fade" id="pills-floors" role="tabpanel" aria-labelledby="pills-floors-tab">
							<div class="d-flex justify-content-between border-bottom bg-light" style="padding:1.21rem;">
								<h6 class="mb-0 w-100">Column To Import</h6>
								<h6 class="mb-0 w-100" style="max-width:300px;">Map Into Field</h6>
							</div>
							<div class="mapping-fields-wrapper" id="floor-tab">
								<p class="syncloader text-center my-2" style="display:none;"><img src="{{asset('images/spinner.gif')}}"></p>
							</div>
						</div>
						<div class="tab-pane fade" id="pills-floor-features" role="tabpanel" aria-labelledby="pills-floor-features-tab">
							<div class="d-flex justify-content-between border-bottom bg-light" style="padding:1.21rem;">
								<h6 class="mb-0 w-100">Column To Import</h6>
								<h6 class="mb-0 w-100" style="max-width:300px;">Map Into Field</h6>
							</div>
							<div class="mapping-fields-wrapper" id="floor-features-tab">
								<p class="syncloader text-center my-2" style="display:none;"><img src="{{asset('images/spinner.gif')}}"></p>
							</div>
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
	</div>
	<div class="footer-buttons">
		<div class="btn-group">
			<a style="position:relative; margin-right:5px;" id="backButton" href="javascript:;" onclick="changeStep(false)" class="add_button"><i style="top:0;" class="fa fa-arrow-left"></i> Back </a>
			<a style="position:relative;" href="javascript:;" id="importButton" onclick="changeStep(true)" class="add_button"> <span>Next</span> <i style="top:0;" class="fa fa-arrow-right"></i></a>
		</div>
	</div>
</div>
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
			$("#importButton span").text('Next');
			$(".containers").hide();
			$('#ss_step_div').fadeIn();
			$('#backButton').fadeOut();
			break;
		case 2: 
			let validationFailed = dataToShowInMapSection();
			if(validationFailed)
			{
				step = 1;
				return;
			}
			$('#ss_step').addClass('complete').removeClass('active');
			$('#drm_step').addClass('active').removeClass('incomplete');
			$("#importButton span").text('Import');
			$(".containers").hide();
			$('#backButton').fadeIn();
			$('#drm_step_div').fadeIn();
			break;
		case 3: 
			let finalStep =  uploadData();
			if(!finalStep){
				step = 2;
				return;
			}
			$('#drm_step').addClass('complete').removeClass('active');
			$('#sr_step').addClass('active').removeClass('incomplete');
			$('.footer-buttons').hide();
			$(".containers").hide();
			$('#sr_step_div').fadeIn();
			break;
	}
}
    var file = null;
    var filename;
    $('#excelFile').on('change', function () {
        $(".error-messages").html('');
        file = this.files[0];
        filename = $("#excelFile").val();
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
    $('#bulkUploadModal').on('hidden.bs.modal', function (e) {
        $("#excelFile").val('');
        $(".file-upload").removeClass('active');
        $("#noFile").text("No file chosen..."); 
        file = null;
        $(".error-messages").html('');
    })
	//Bulk Upload 
	dataToShowInMapSection = () => {
        var formData = new FormData();
        formData.append('excelFile', file);
        if(file != null){
            var fileExtension = filename.split('.').pop();
            if(fileExtension == 'xlsx'){
                $.ajax({
                    type        : "post",
                    url         : "/api/map/sheet/columns",
                    headers     : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data        : formData,
                    cache       : false,
                    contentType : false,
                    processData : false,
					beforeSend  : function(){
						$('.syncloader').fadeIn();
					},
                    success     : function(response)
					{
						// let entityInFile = Object.keys(response.headings);
						// $.each(entityInFile,(key,val)=>{})
						//Community tab data formation
						if(response.headings.hasOwnProperty('Communities'))
						{
							let communityOptions = `<option value=''>No Option Selected</option>`;
							$.each(response.communities,(key,val)=>{
								communityOptions+=`<option value='${key}'>${val}</option>`;
							});
							let communityData = ``;
							$.each(response.headings.Communities[0],(key,val)=>{
								communityData+=`<div class="d-flex justify-content-between align-items-center px-1 mt-1 mb-1 border-bottom">
										<label class="w-100 m-0 text-dark">${val}</label>
										<select class="form-control" style="max-width: 300px;" id="community_dropdown_${key}" onchange="userMappedData('community',${key},'${val}')">
										${communityOptions}
										</select>
									</div>`;
							});	
							$('#community-tab').html(communityData);
						}
						else
						{
							$('#community-tab').html(`<div class="alert alert-danger mt-1" role="alert">There is no corresponding record found in the sheet make sure sheet name is Commmunities.</div>`)
						}
						//Elevation tab data formation
						if(response.headings.hasOwnProperty('Elevations'))
						{
							let elevationOptions = `<option value=''>No Option Selected</option>`;
							$.each(response.elevations,(key,val)=>{
								elevationOptions+=`<option value='${key}'>${val}</option>`;
							});
							var elevationData = ``;
							$.each(response.headings.Elevations[0],(key,val)=>{
								elevationData+=`<div class="d-flex justify-content-between align-items-center px-1 mt-1 mb-1 border-bottom">
										<label data-index='${key}' class="w-100 m-0 text-dark">${val}</label>
										<select class="form-control" style="max-width: 300px;" id="elevation_dropdown_${key}" onchange="userMappedData('elevation',${key},'${val}')">
										${elevationOptions}
										</select>
									</div>`;
							});
							$('#elevation-tab').html(elevationData)	
						}	
						else
						{
							$('#elevation-tab').html(`<div class="alert alert-danger mt-1" role="alert">There is no corresponding record found in the sheet make sure sheet name is Elevations.</div>`)
						}
						//Elevation type data adding here
						if(response.headings.hasOwnProperty('Elevation Types'))
						{
							let elevationOptions = `<option value=''>No Option Selected</option>`;
							$.each(response.elevation_types,(key,val)=>{
								elevationOptions+=`<option value='${key}'>${val}</option>`;
							});
							var elevationData = ``;
							$.each(response.headings['Elevation Types'][0],(key,val)=>{
								elevationData+=`<div class="d-flex justify-content-between align-items-center px-1 mt-1 mb-1 border-bottom">
										<label data-index='${key}' class="w-100 m-0 text-dark">${val}</label>
										<select class="form-control" style="max-width: 300px;" id="elevation_type_dropdown_${key}" onchange="userMappedData('elevation_type',${key},'${val}')">
										${elevationOptions}
										</select>
									</div>`;
							});
							$('#elevation-type-tab').html(elevationData)
						}
						else
						{
							$('#elevation-type-tab').html(`<div class="alert alert-danger mt-1" role="alert">There is no corresponding record found in the sheet make sure sheet name is Elevation Types.</div>`)
						}
						//Color Scheme data here
						if(response.headings.hasOwnProperty('Color Schemes'))
						{
							let colorOptions = `<option value=''>No Option Selected</option>`;
							$.each(response.color_scheme,(key,val)=>{
								colorOptions+=`<option value='${key}'>${val}</option>`;
							});
							let colorData = ``;
							$.each(response.headings['Color Schemes'][0],(key,val)=>{
								colorData+=`<div class="d-flex justify-content-between align-items-center px-1 mt-1 mb-1 border-bottom">
										<label class="w-100 m-0 text-dark" data-index='${key}'>${val}</label>
										<select class="form-control" style="max-width: 300px;" id="color_scheme_dropdown_${key}" onchange="userMappedData('color_scheme',${key},'${val}')">
										${colorOptions}
										</select>
									</div>`;
							});	
							$('#color-scheme-tab').html(colorData);	
						}

						else
						{
							$('#color-scheme-tab').html(`<div class="alert alert-danger mt-1" role="alert">There is no corresponding record found in the sheet make sure sheet name is Color Schemes.</div>`)
						}
						if(response.headings.hasOwnProperty('Color Scheme Features'))
						{
								let colorFeatureOptions = `<option value=''>No Option Selected</option>`;
								$.each(response.color_scheme_features,(key,val)=>{
									colorFeatureOptions+=`<option value='${key}'>${val}</option>`;
								});
								let colorFeatureData = ``;
								$.each(response.headings['Color Scheme Features'][0],(key,val)=>{
									colorFeatureData+=`<div class="d-flex justify-content-between align-items-center px-1 mt-1 mb-1 border-bottom">
											<label class="w-100 m-0 text-dark">${val}</label>
											<select class="form-control" style="max-width: 300px;" id="color_scheme_feature_dropdown_${key}" onchange="userMappedData('color_scheme_feature',${key},'${val}')">
											${colorFeatureOptions}
											</select>
										</div>`;
								});	
								$('#color-scheme-features-tab').html(colorFeatureData)	
						}
						else
						{
							$('#color-scheme-features-tab').html(`<div class="alert alert-danger mt-1" role="alert">There is no corresponding record found in the sheet make sure sheet name is Color Scheme Features.</div>`)
						}
						if(response.headings.hasOwnProperty('Floors'))
						{
								let floorOptions = `<option value=''>No Option Selected</option>`;
								$.each(response.floor,(key,val)=>{
									floorOptions+=`<option value='${key}'>${val}</option>`;
								});
								let floorData = ``;
								$.each(response.headings['Floors'][0],(key,val)=>{
									floorData+=`<div class="d-flex justify-content-between align-items-center px-1 mt-1 mb-1 border-bottom">
											<label class="w-100 m-0 text-dark">${val}</label>
											<select class="form-control" style="max-width: 300px;" id="floor_dropdown_${key}" onchange="userMappedData('floor',${key},'${val}')">
											${floorOptions}
											</select>
										</div>`;
								});	
								$('#floor-tab').html(floorData)	
						}
						else
						{
							$('#floor-tab').html(`<div class="alert alert-danger mt-1" role="alert">There is no corresponding record found in the sheet make sure sheet name is Floors.</div>`)
						}
						if(response.headings.hasOwnProperty('Floor Features'))
						{
								let floorFeatureOptions = `<option value=''>No Option Selected</option>`;
								$.each(response.floor_feature,(key,val)=>{
									floorFeatureOptions+=`<option value='${key}'>${val}</option>`;
								});
								let floorFeatureData = ``;
								$.each(response.headings['Floor Features'][0],(key,val)=>{
									floorFeatureData+=`<div class="d-flex justify-content-between align-items-center px-1 mt-1 mb-1 border-bottom">
											<label class="w-100 m-0 text-dark">${val}</label>
											<select class="form-control" style="max-width: 300px;" id="floor_feature_dropdown_${key}" onchange="userMappedData('floor_feature',${key},'${val}')">
											${floorFeatureOptions}
											</select>
										</div>`;
								});	
								$('#floor-features-tab').html(floorFeatureData)	
						}
						else
						{
							$('#floor-features-tab').html(`<div class="alert alert-danger mt-1" role="alert">There is no corresponding record found in the sheet make sure sheet name is Floor Features.</div>`)
						}
						return false;
                   	 },
                    error       : function(error){
						console.log(error);
						toastr.error(error.responseJSON.message);
						var errorMessages = '';
						$.each(error.responseJSON.errors, function(){
							errorMessages += `<small class="danger">${this}</small><br>`
						});
						$(".error-messages").html(errorMessages);
                    },
					complete	: function(){
						$('.syncloader').hide();
					} 
                });
            }
            else{
                toastr.error("Please choose an excel file.");
				return true;
			}
			return false;
        }
        else{
			toastr.error("Please choose an excel file.");
			return true;
        }
	}
	let mappedArray = {}; 
	let count = 0;
	mappedArray['community'] = {};
	mappedArray['elevation'] = {};
	mappedArray['elevation_type'] = {};
	mappedArray['color_scheme'] = {};
	mappedArray['color_scheme_feature'] = {};
	mappedArray['floor'] = {};
	mappedArray['floor_feature'] = {};
	let [community, elevation,elevation_type,color_scheme,color_scheme_feature,floor,floor_feature] = [{},{},{},{},{},{},{}];
	function userMappedData(type,index,label)
	{
		switch(type){
			case 'community':
				if($('#community_dropdown_'+index).val()=='')
				{
					delete community[label];
					count--;
				}
				else
				{
					community[label] = $('#community_dropdown_'+index).val();
					count++;
				}
				mappedArray['community'] = community;
			break;

			case 'elevation':
				if($('#elevation_dropdown_'+index).val()=='')
				{
					delete elevation[label];
					count--;
				}
				else
				{
					elevation[label] = $('#elevation_dropdown_'+index).val();
					count++;
				}
				mappedArray['elevation'] = elevation;
			break;

			case 'elevation_type':
				if($('#elevation_dropdown_'+index).val()=='')
				{
					delete elevation_type[label];
					count--;
				}
				else
				{
					elevation_type[label] = $('#elevation_type_dropdown_'+index).val();
					count++;
				}
				mappedArray['elevation_type'] = elevation_type;
			break;

			case 'color_scheme':
				if($('#color_scheme_dropdown_'+index).val()=='')
				{
					delete color_scheme[label];
					count--;
				}
				else
				{
					color_scheme[label] = $('#color_scheme_dropdown_'+index).val();
					count++;
				}
				mappedArray['color_scheme'] = color_scheme;
			break;

			case 'color_scheme_feature':
				if($('#color_scheme_feature_dropdown_'+index).val()=='')
				{
					delete color_scheme_feature[label];
					count--;
				}
				else
				{
					color_scheme_feature[label] = $('#color_scheme_feature_dropdown_'+index).val();
					count++;
				}
				mappedArray['color_scheme_feature'] = color_scheme_feature;
			break;

			case 'floor':
				if($('#floor_dropdown_'+index).val()=='')
				{
					delete floor[label];
					count--;
				}
				else
				{
					floor[label] = $('#floor_dropdown_'+index).val();
					count--
				}
				mappedArray['floor'] = floor;
			break;

			case 'floor_feature':
				if($('#floor_feature_dropdown_'+index).val()=='')
				{
					delete floor_feature[label];
					count--;
				}
				else
				{
					floor_feature[label] = $('#floor_feature_dropdown_'+index).val();
					count++;
				}
				mappedArray['floor_feature'] = floor_feature;
			break;

			default:
			break;
		}
	}
	function uploadData()
	{
		console.log(mappedArray);
		if(count!=0)
		{
			mappedArray['import_as'] = $('#importOptions').val();
			let dat = JSON.stringify(mappedArray);
			$.ajax({
				type 		:'post',
				url  		: '/api/mega-import',
				headers     : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				data        : {'mapped':dat},
				success		: function(response){
					$('.badge-success').html(response.success);
					$('.badge-danger').html(response.fail);
					$('.badge-info').html(`${response.percentage}%`);
				},
				error		: function(error){

				},
			})
			return true;
		}
		else
		{
			toastr.error("Please select atleast one field to map.");
			return false;
		}
	}
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