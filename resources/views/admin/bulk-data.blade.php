@extends('layouts.admin')
   @section('content')
   <div class="container-fluid">
      <div class="justify-content-between mb-1">
         <h1 class="a_dash text-center">Bulk Data Upload</h1>
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
               <div id="ss_step_div" class="text-center">
                  <h3 class="text-center">Import Files</h3>
                  <div class="pt-0 pb-2">
                     <h6>Have existing records in your own file? Import your own excel file.</h6>
                     <!-- <button class="btn btn-secondary btn-sm ftbtn" type="button" onclick="cancelSync()"> No </button>
                     <button class="btn btn-info btn-sm ftbtn" type="button" onclick="startSync()"> Yes </button> -->
                  </div>
                  <div id="start_sync" class="d-none"><p>Please wait.. We are importing the data.</p><p class="syncloader"><img src="{{ asset('images/spinner.gif') }}"></p></div>
               </div>
               <div id="drm_step_div" class="d-none table-responsive">
                  <h3 class="text-center">Records Mapping</h3>
                  <div class="row m-0">
                     <div class="col-md-4">
                        <p> <b id="rupcountm">0</b> records are being effected. Please review bofore going further.</p>
                     </div>
                     <div class="col-md-4">
                        <p> 
                           <select name="Filter Records By Community" id="" class="form-control" onchange="filterrecordsByCommunity(this.value)">
                              <option value="">Select Community to filter records</option>
                              
                           </select>
                        </p>
                     </div>
                     <div class="col-md-4">
                        <p class="text-right"><i class="text-danger "><b> <i class="la la-info-circle"></i> Updatable value text is in bold Red Color*</i></b></p>
                     </div>
                  </div>
                  <div id="bulk-action-box">
                     <b>0</b> record(s) selected.  
                     <span> 
                        <button class="btn btn-sm btn-info ml-1" type="button" disabled="disabled" onclick="UpdateAllEFVRecord()">Approve</button> 
                     </span> 
                     <span> 
                        <button class="btn btn-sm btn-danger" type="button" disabled="disabled" onclick="SkipUpdateAllEFVRecord()">Skip</button> 
                     </span>
                  </div>
                  <div class="scrollable-table table-responsive">
                     <table class="table table-bordered table-condensed table-striped step-2-tbl">
                        <thead>
                           <tr>
                              <th width="80px">SNo <input type="checkbox" name="communities" value="1" class="form-control-checkbox" id="checkall"> </th>
                              <th width="150px">Community</th>
                              <th width="80px">Lot No</th>
                              <th>Elevation(s)</th>
                              <th width="130px">Elevation Type</th>
                              <th width="120px">Status</th>
                              <th width="150px">Action</th>
                           </tr>
                        </thead>
                        <tbody id="confilted-data">
                        </tbody>
                     </table>
                  </div>
                  <div class="text-right mt-1">
                     <button class="btn btn-sm btn-info" type="button" onclick="gotoReport()"> Done Mapping</button>
                  </div>
               </div>
               <div id="sr_step_div" class="d-none">
                  <h3 class="text-center">Sync Report</h3>
                  <div class="scrollable-table">
                     <div class="text-center sr-ans">
                        <i class="material-icons">done</i>
                        <span>All data has been updated successfully.</span>
                        <ul class="same-btns">
                           <li> <a href="#">Sync Data Again </a> </li>
                           <li> <a href="#">View Report </a> </li>
                        </ul>
                        <ul class="sys-btns">
                           <li> <a href="#">Manage Communities </a> </li>
                           <li> <a href="#">Manage Elevations </a> </li>
                           <li> <a href="#">Manage Floors </a> </li>
                        </ul>
                     </div>
                     <div class="sr-synop">
                        <h6>Activity Log </h6>
                        <p> <span class="border-bottom"> <b class="badge badge-success">5</b> Lots has been updated successfully.  </span> </p>
                        <p> <span class="border-bottom"> <b class="badge badge-danger">3</b> conflicts has been skipped.  </span> </p>
                        <p> <span class="border-bottom"> <b class="badge badge-info">100%</b> Sync Process Completed. </span> </p>
                     </div>
                  </div>
                  <div class="text-center">
                     <a href="/admin/dashboard" class="btn btn-dark btn-md"> Close</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="modal fade show" id="sdsModal" tabindex="-1" role="dialog" aria-modal="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5>Information</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true"><i class="fa fa-times"></i>  </span>
               </button>
            </div>
            <div class="modal-body">
               <div class="">
                  <h6 class="delete_heading">What can you do by this button ?</h6>
                  <div class="clearfix"></div>
                  <div class="mb-3">
                     <ul>
                        <li>You can change Lot status to sold and connect the respective elevation and elevation type.</li>
                        <li>You can change Lot status to available and connect multiple elevations.</li>
                        <li>After syncing, you will see all the changes below.</li>
                     </ul>
                  </div>
                  <h6 class="delete_heading">What can't you do by this button?</h6>
                  <div class="clearfix"></div>
                  <div class="mb-3">
                     <ul>
                        <li>You can not update elevation or anything without changing Lot Status.</li>
                        <li>You can change Lot status to any available status but elevations will update only with lot status - Sold, Available.</li>
                        <li>After syncing, you will see all the changes below.</li>
                     </ul>
                  </div>
                  <h6 class="delete_heading text-danger"> Points to remember</h6>
                  <div class="clearfix"></div>
                  <div class="text-danger">
                     <ul>
                        <li>When you making any change in lot status, It is mandatory to change STATUS CODE.</li>
                        <li>If Lot status is sold, then there must be only 1 elevation ID, 1 elevation name and elevation type.</li>
                        <li>For elevation update, Elevation ID must be updated with elevation name.</li>
                        <li>You can download Elevation master sheet any time from the report section above.</li>
                     </ul>
                  </div>
               </div>
            </div>            
         </div>
      </div>
   </div>
   <div class="modal fade show" id="sasModal" tabindex="-1" role="dialog" aria-modal="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5>Information</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true"><i class="fa fa-times"></i>  </span>
               </button>
            </div>
            <div class="modal-body">
               <div class="">
                  <h6 class="delete_heading">What can you do by this button ?</h6>
                  <div class="clearfix"></div>
                  <div>
                     <ul>
                        <li>This button will sync all data with CRM.</li>
                        <li>This feature has been disabled at the moment.</li>
                     </ul>
                  </div>
               </div>
            </div>            
         </div>
      </div>
   </div>
   <style>
   th .form-control-checkbox,td .form-control-checkbox{float:right}
.form-control-checkbox{height:18px;width:18px;cursor:pointer}
.step-2-tbl thead{border:1px solid #f6f6f6;background:#ccc}
.step-2-tbl th{padding:10px 8px!important;text-align:center}
.step-2-tbl td{padding:8px!important;text-align:center}
.step-2-tbl p.ds_old_value{margin:0 0 5px;padding:0 0 5px}
.step-2-tbl p.ds_new_value{margin:0;font-weight:600;color:#F44336}
.step-2-tbl .btn{box-shadow:none}
.sync-container{padding:15px}
.fix-sync h6{font-weight:600}
a.add_button.active{background:#003a8b}
.sync-process ul{margin:0;padding:0}
.sync-process ul li:not(:first-child) a::before{position:absolute;content:"";height:8px;width:87px;background:#6c757d;z-index:9;top:16px;right:37px}
.sync-process li{list-style:none;display:inline-block;width:120px}
.sync-process a{position:relative;margin-right:1px!important;z-index:111;border-radius:50%;width:40px;height:40px;display:inline-block;line-height:40px;font-size:19px}
.sync-process ul li:not(:first-child) a.active::before,.sync-process ul li:not(:first-child) a.complete::before{background-color:#007bff!important;right:38px}
.sync-process a.active{color:#fff!important;background-color:#007bff!important}
.sync-process a.incomplete{color:#fff!important;background-color:#6c757d!important}
.sync-process a.complete{color:#fff!important;background-color:#007bff!important}
.fix-sync{height:calc(100vh - 260px);overflow:auto;background:#fff;border:1px solid #e4e4e4;border-radius:7px}
.fix-sync h3{text-align:center;font-weight:600;text-transform:uppercase}
.scrollable-table{height:calc(100vh - 475px);overflow:auto}
.bg-sdanger{background-color:#fadbd8!important}
.bg-ssuccess{background-color:#d2f4e8!important}
.sr-ans{margin:30px}
.sr-ans i{font-weight:600;font-size:36px;border:2px solid #aaa;padding:27px 20px;border-radius:69%}
.sr-ans span{display:block;margin-top:15px;font-weight:500;font-size:19px;margin-bottom:10px}
.sr-ans ul.same-btns{list-style:none}
.sr-ans ul.same-btns li{display:inline-block;padding:0 8px;line-height:15px}
.sr-ans ul.same-btns li:not(:first-child){border-left:1px solid}
.sr-ans ul.same-btns li a{font-weight:500;text-transform:uppercase}
.sr-ans ul.sys-btns{list-style:none}
.sr-ans ul.sys-btns li{display:inline-block;padding:0 8px;line-height:15px}
.sr-ans ul.sys-btns li:not(:first-child){border-left:1px solid}
.sr-ans ul.sys-btns li a{font-weight:500;text-transform:uppercase}
.sr-synop{padding:20px;text-align:center}
.sr-synop h6{text-transform:uppercase;font-size:17px}
.sr-synop p{font-size:16px}
tr.bg-ssuccess input[type="checkbox"], tr.bg-sdanger input[type="checkbox"]{display: none;}
#bulk-action-box{padding: 8px 10px; margin-bottom: 8px; background: #f4f4f4; border: 1px solid #e4e4e4;}
   </style>
@endsection