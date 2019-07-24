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
                            <li class="breadcrumb-item active">Host Detail</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->


		<div class="well">
						
			<div class="row">

				<div class="col-sm-12 col-md-12">
					<a href="{{ route('admin.hosts.index') }}" class="btn btn-primary">Go Back</a>

		            <div class="box-body">
		              <table class="table table-bordered">
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
		             		<td>{{ $host->provider()->first()->name}}</td>
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
		             		<td><img src="/uploads/hosts/{{ $host->picture }}" style="width: 200px;height: 200px"></td>
		             	</tr>

		             	<tr>
		             		<td>Service Loction</td>
		             		<td>{{ $host->service_location()->first()->name }}</td>
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
		             		<td> <a href="{{ route('admin.hosts.edit',$host->id) }}" class="btn btn-primary">Edit</a></td>

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