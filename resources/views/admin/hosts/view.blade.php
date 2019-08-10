@extends('layouts.admin')

@section('content')

	<div class="content-wrapper">

		 <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Host Detail</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.hosts.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Host Detail</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <a href="{{ route('admin.hosts.index') }}" class="btn btn-primary pull-right hidden-sm-down">Go Back</a>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->

                 @include('notifications.notification')

		 <div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Host Detail</h4>
					

		            <div class="box-body">
		              <table class="table ">
		                <tr>
		                  	<th>Details</th>
		                  	<th>User Data</th>
		                </tr>
		             	<tr>
		             		<td>Host Name</td>
		             		<td>{{ $host->host_name }}</td>	
		             	</tr>

		             	<tr>
		             		<td>Provider Name</td>
		             		<td>
		             			@if($host->provider()->first()!=NULL)
									<a href="{{ route('admin.providers.view', $host->provider()->first()->id) }}">{{ $host->provider()->first()->name }}</a>
								@else
									No Provider Available
								@endif

		             		</td>
		             	</tr>	

		             	<tr>
		             		<td>Host Type</td>
		             		<td>{{ $host->host_type }}</td>
		             	</tr>	

		             	<tr>
		             		<td>Description</td>
		             		<td>{{ $host->description }}</td>
		             	</tr>	

		             	<tr>
		             		<td>Picture</td>
		             		<td><img src="{{ $host->picture }}" style="width: 200px;height: 200px"></td>
		             	</tr>

		             	<tr>
		             		<td>Service Loction</td>
		             		<td>
		             			@if($host->service_location()->first()!=NULL)
									<a href="{{ route('admin.service_locations.view',$host->service_location()->first()->id) }}">{{ $host->service_location()->first()->name }}</a>
								@else
									No Service Location Found
								@endif

		             		</td>
		             	</tr>	

		             	<tr>
		             		<td>Total Spaces</td>
		             		<td>{{ $host->total_spaces }}</td>
		             	</tr>	

		             	<tr>
		             		<td>Full Address</td>
		             		<td>{{ $host->full_address }}</td>
		             	</tr>	

		             	<tr>
		             		<td>Per Hour</td>
		             		<td>{{ $host->per_hour }}</td>
		             	</tr>	

		             	<tr>
		             		<td>Created At</td>
		             		<td>{{ $host->created_at }}</td>
		             	</tr>

		             	<tr>
		             		<td>Updated At</td>
		             		<td>{{ $host->updated_at }}</td>
		             	</tr>

		             	<tr>
		             		<td>Status</td>
		             		@switch($host->status)

                                @case(DECLINED)
                                    <td><div class="label label-danger">Declined</div></td>
                                @break

                                @case(APPROVED)
                                    <td><div class="label label-success">Approved</div></td>
                                @break

                            @endswitch
		             	</tr>

		             	<tr>
		             		<td> <a href="{{ route('admin.hosts.edit',$host->id) }}" class="btn btn-primary">Edit</a></td>

		             		<td>
		             			
		             			@if($host->status==DECLINED)
	                                    
	                                <a href="{{ route('admin.hosts.status',$host->id) }}" class="btn btn-primary" > Approve</a>

	                            @elseif($host->status==APPROVED)
	                                
	                                <a href="{{ route('admin.hosts.status',$host->id) }}" class="btn btn-info" onclick="return confirm('Are you sure decline the host {{ $host->host_name }} ?')" > Decline</a>

	                            @endif
	                            
		             		</td>

		             		<td>
		             			<a href="{{ route('admin.hosts.delete',$host->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
               				</td>
		             	</tr>			             					
									
		              </table>
		        
		            </div>
	          </div>								
			</div>							
		</div>
	</div>
@endsection