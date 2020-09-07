@extends('layouts.admin')
    @section('content')
<style> 
.modal-header h5{margin: 0; font-size: 17px; font-weight: 600; }
.action-btn .btn{margin-right: 3px; margin-bottom: 3px;, padding:0.275rem 0.451rem;}
.action-btn .btn i{font-size: 13px}
.action-btn .btn:last-child{margin-right: 0;}
</style>    
<div class="container-fluid page-wrapper">
    <!-- Page Heading -->
    <div class="row mb-2 justify-content-between pl-1 pr-1 align-items-center">
        <div>
            <h1 class="a_dash m-0 p-0">{{$page_title}}</h1>
        </div>    
        <div class="filter-search-input w-100 pr-5" style="max-width:450px;">
            <input type="text" class="form-control" name="skeyword" id="skeyword" placeholder="Search here" onkeyup="InPageFilter()" />
        </div>  
    </div>

    @foreach($floors as $key => $floor) @if(count($floor['floor']) >= 1)

    <div class="design-home-heading mb-3 p-2">
        <h3 class="pb-1"><b>Home:</b> {{ $floor['home']->title }}</h3>
        <div class="card-wrapper pb-1">
            @foreach($floor['floor'] as $record)
            <div class="scrollable-cards mr-1">
                <div class="card mb-0 pl-1 pr-1" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4 col-4 card-image">
                            <img src="{{ asset('uploads/floors/'.$record['image'])}}" class="card-img" style="height:150px; object-fit: contain;" alt="..." />
                        </div>
                        <div class="col-md-8 d-flex align-items-center col-8">
                            <div class="card-body pl-1 h-auto py-0 pr-0">
                                <h5 class="card-title" style="margin-bottom:.5rem!important;font-size:17px;">{{$record->title}}</h5>
                                <div class="row mx-0 action-btn">
                                    @if($record->status_id == 2)
                                    <a
                                        class="btn btn-sm btn-outline-success floor_status show-tooltip"
                                        id="floor_{{$record->id}}"
                                        href="javascript:void(0);"
                                        floor_id="{{$record->id}}"
                                        floor_status="{{ $record->status_id }}"
                                        title="Active/Blocked"
                                    >
                                        <i class="fa fa-check"></i>
                                    </a>
                                    @else
                                    <a
                                        class="btn btn-sm btn-outline-danger floor_status"
                                        href="javascript:void(0);"
                                        id="floor_{{$record->id}}"
                                        href="javascript:void(0);"
                                        floor_id="{{$record->id}}"
                                        floor_status="{{ $record->status_id }}"
                                        title="Active/Blocked"
                                    >
                                        <i class="fa fa-ban"></i>
                                    </a>
                                    @endif
                                    <a class="btn btn-sm btn-outline-dark show-tooltip" title="View Floor Features" href="{{route('manager-features',['id'=>base64_encode($record->id)])}}"><i class="fas fa-sliders-h"></i></a>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif @endforeach
    
</div>

@endsection
<script>
function InPageFilter() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("skeyword");
    filter = input.value.toUpperCase();
    sdiv = document.getElementsByClassName("design-home-heading");
    for (i = 0; i < sdiv.length; i++) {
        a = sdiv[i].getElementsByTagName("h3")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            sdiv[i].style.display = "";
        } else {
            sdiv[i].style.display = "none";
        }
    }
    }
</script>