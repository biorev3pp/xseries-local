@extends('layouts.admin')
@section('content') 
<div class="container-fluid page-wrapper">
    <div class=" row justify-content-between mb-2 align-items-center">
        <div class="ml-1">
            <h1 class="a_dash d-inline-block">Floors <small><span class="color-secondary">|</span></small></h1>
            <div class="row breadcrumbs-top d-inline-block">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="{{ route('manager-new_floors') }}">{{$floor->home->title}}</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">{{$floor->title}}</li>
                    <li class="breadcrumb-item active" aria-current="page">Features</li>
                </ol>
            </div>
        </div>
        <div class="ml-1 ml-sm-0">
            <div class="btn-group mr-1">
                <a href="{{route('manager-new_floors')}}" class="add_button"><i class="fa fa-arrow-left position-relative"></i> Back</a>
            </div>
        </div>    
    </div>

    <div class="clearfix"></div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive" id="custom_tables">
                <table class="table table-bordered" id="dataTables" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Price</th>  
                        </tr>
                    </thead>
                    <tbody class="sortable ui-sortable">
                        @php $i=0; @endphp @forelse($features as $record) @php $i++; @endphp
                        <tr id="{{$record->id}}" data-parent_id="{{$record->parent_id}}" class="non-dragable" style="background: #e8e8e8; font-weight: 600;">
                            <td>{{$i}}.</td>
                            <td>{{$record->title}}</td>
                            <td>{{$record->price}}</td>
                        </tr>
                        @php $j=0; @endphp @forelse($record->feature_groups as $feat) @php $j++; @endphp
                        <tr id="{{$feat->id}}" data-parent_id="{{$feat->parent_id}}">
                            <td></td>
                            <td>{{$feat->title}}</td>
                            <td>{{$feat->price}}</td>
                        </tr>
                        @empty @endforelse @empty
                        <tr>
                            <td colspan="4">No Features added yet</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
