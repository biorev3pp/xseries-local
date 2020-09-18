@extends('layouts.admin') @section('content')

<div class="container-fluid page-wrapper">
    <div class="row mb-2 justify-content-between ml-0 mr-0 align-items-center">
        <h1 class="a_dash p-0 m-0">{{$page_title}} <small><span class="color-secondary">|</span> Import History</small></h1>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered imp-table">
            <tbody>
               <tr>
                    <td width="50px"> 1. </td>
                    <td width="250px"> bulk-upload-sample.xlsx </td>
                    <td width="240px"> Uploaded By - Admin </td>
                    <td width="130px"> Finished On <span class="subbottom"> Sep 18, 2020 </span> </td>
                    <td class="progress-row"> 
                        <span class="progresss-span-bg"> 
                            <span class="progresss-span" style="width:83%"> 83% complete </span>
                                <a href="javascript:;" class="float-right progresss-side-span"> 3 of 18 failed </a>
                        </span>
                    </td>
                    <td width="50px" align="center"> 18 <span class="subbottom"> Total </span> </td>
                    <td width="50px" align="center"> <a href="#"> </a> 15 <span class="subbottom"> Imported </span> </td>
                    <td width="50px" align="center"> <a href="#"> 3</a> <span class="subbottom"> Failure </span>  </td>
               </tr>
            </tbody>
        </table>
    </div>
</div>

<style>
    .imp-table tbody td{font-weight: 600; padding: 8px;}
    .poptable td, .poptable th{    padding: 8px !important;
    font-size: 11px !important;
    text-align: left !important;}
    .subbottom{display: block; color: #aaa; position: relative; top: -4px; font-size: 85%;}
    .progresss-span-bg{display: block; background: #dc3545; height: 26px; color: #fff; border-radius: 4px; line-height: 26px; position: relative; font-weight: 500;}
    .progresss-span{background: #28a745; display: block; height: 26px; color: #fff; border-radius: 4px; line-height: 26px; padding: 0 10px;}
    .progresss-side-span{position: absolute; right: 14px; top: 0; font-weight: 500; color: #fff;}
    .progresss-side-span:hover{color:#000}
    .progress-row{ min-width: 250px;}
</style>
@endsection
