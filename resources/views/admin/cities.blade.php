@extends('layouts.admin')
@section('content')
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
    <div class="content-wrapper p-2 inner">
    	<div class="row">
    		<div class="col-md-6">
    			<ul class="breadcrumb m-0">
    				<li class="breadcrumb-new"><a href="#">Assets</a></li>
    				 <li class="color"><i class="la la-arrow-right"></i> Cities</li>
    				</ul>
    		</div>
    		<div class="col-md-6"></div>
			<div class="col-md-12 inbox">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Cities
            			
            		</h4>
            	</div>
            	 <div class="card-body">
            	 	 <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
            	 		<thead>
            	 			<tr>
            	 				<th style="width: 50px;">SNo</th>
            	 				<th>City</th>
            	 				<th>State</th>
            	 				<th>Status</th>
            	 			</tr>
            	 		</thead>
            	 		<tbody>
            	 		@php $i=1 @endphp
        	 			@foreach($cities as $city)
        	 			<tr>
                           <td>{{$i}}</td>
                           <td>{{$city->city}}</td>
                           <td>{{$city->state->state}}</td>
                           <td>{{($city->status_id==2)?'Active':'Pending'}}</td>
                        </tr>
                        @php $i++ @endphp
                        @endforeach
            	 		 	
            	 		</tbody>
            	 	</table>
            	 </div> <!---->
            	</div>
            </div>
                	 


            </div>
    </div>
@endsection
@push('scripts')
<script type="text/javascript">
</script>
@endpush
