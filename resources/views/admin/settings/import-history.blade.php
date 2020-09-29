@extends('layouts.admin') @section('content')

<div class="container-fluid page-wrapper">
    <div class="row mb-2 justify-content-between ml-0 mr-0 align-items-center">
        <div>
            <h1 class="a_dash p-0 m-0 d-inline-block">{{$page_title}} <small><span class="color-secondary">|</span></small></h1>
            <div class="row breadcrumbs-top pl-2 d-inline-block">
                <ol class="breadcrumb"> 
                <li class="breadcrumb-item">
                <a href="{{ route('import-history') }}"> Data Import Reports </a>
                </li>
                </ol>
            </div>
        </div>
        <div class="btn-group">
			<a style="position:relative;" href="{{route('uploads')}}" class="add_button"><i style="top:0;" class="fa fa-arrow-left"></i> Go To Uploads</a>
		</div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive" id="custom_table">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th style="width:40px">#</th>
                        <th width="250px">Name</th>
                        <th width="200px">Uploaded By</th> 
                        <th width="130px">Status</th>
                        <th>Progress</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($history as $key => $h)
                        <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$h->file_name}}</td>
                        <td>{{$h->name}}</td>
                        <td>Finished On <span class="subbottom"> {{date('M',$h->imported_on)}} {{date('d',$h->imported_on)}}, {{date('Y',$h->imported_on)}} </span></td>
                        <td class="progress-row">
                            <span class="progresss-span-bg"> 
                                <a href="{{route('export-success-history',['timestamp'=>$h->imported_on])}}" class="progresss-span" style="width:{{$h->percent}}%"> <span style="padding-left: 14px;">{{$h->percent}}% complete </span></a>
                                <a href="{{route('export-error-history',['timestamp'=>$h->imported_on])}}" class="float-right progresss-side-span">  {{$h->fail}} of {{$h->success+$h->fail+$h->skip}} failed </a>
                            </span>
                        </td>
                        <td class="action">
                            <a href="#" class="d-inline-block">{{$h->success+$h->fail+$h->skip}} <span class="subbottom"> Total </span> </a>
                            <a href="#" class="d-inline-block"> {{$h->success}} <span class="subbottom"> Imported </span> </a>
                            <a href="#" class="mr-0 d-inline-block"> {{$h->fail}} <span class="subbottom"> Failure </span> </a>
                            <a href="#" class="mr-0 d-inline-block"> {{$h->skip}} <span class="subbottom"> Skipped </span> </a>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .imp-table tbody td{padding: 8px !important; font-size: 15px;}
    .action{min-width: 200px;}
    .poptable td, .poptable th{    padding: 8px !important;
    font-size: 11px !important;
    text-align: left !important;}
    .subbottom{display: block; color: #aaa; position: relative; top: -4px; font-size: 85%;}
    .progresss-span-bg{display: block; background: #dc3545; height: 26px; color: #fff; border-radius: 4px; line-height: 26px; position: relative; font-weight: 500;}
    .progresss-span{background: #28a745; display: block; height: 26px; color: #fff; border-radius: 4px; line-height: 26px; text-align:left; position: absolute;left: 0;white-space: nowrap;}
    .progresss-span:hover, .progresss-span:focus{color: #000;}
    .progresss-side-span{position: absolute; right: 14px; top: 0; font-weight: 500; color: #fff; text-decoration:none}
    .progresss-side-span:hover, .progresss-side-span:focus{color:#000}
    .progress-row{ min-width: 250px;}
</style>
@endsection
