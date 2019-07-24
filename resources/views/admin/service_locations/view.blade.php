@extends('layouts.admin')

@section('content')

	<div class="content-wrapper">

		 <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Service Location Detail</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Service Location Detail</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->


		<div class="well">
						
			<div class="row">

				<div class="col-sm-12 col-md-12">
					<a href="{{ route('admin.service_locations.index') }}" class="btn btn-primary">Go Back</a>

		            <div class="box-body">
		              <table class="table table-bordered">
		                <tr>
		                  	<th>Details</th>
		                  	<th>Service Locations Data</th>
		                </tr>
		             	<tr>
		             		<td> Name</td>
		             		<td>{{ $service_location->name }}</td>	
		             	</tr>

		             	<tr>
		             		<td>Picture</td>
		             		<td><img src="/uploads/service_locations/{{ $service_location->picture }}" style="width: 200px;height: 200px"></td>
		             	</tr>	

		             	<tr>
		             		<td>Full Address</td>
		             		<td>{{ $service_location->full_address }}</td>
		             	</tr>	

		             	<tr>
		             		<td>Description</td>
		             		<td>{{ $service_location->description }}</td>
		             	</tr>	

		             	<tr>
		             		<td>Created At</td>
		             		<td>{{ $service_location->created_at }}</td>
		             	</tr>

		             	<tr>
		             		<td>Updated At</td>
		             		<td>{{ $service_location->updated_at }}</td>
		             	</tr>

		             	<tr>
		             		<td> <a href="{{ route('admin.service_locations.edit',$service_location->id) }}" class="btn btn-primary">Edit</a></td>

		             		<td>
		             			<a href="{{ route('admin.service_locations.delete',$service_location->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')" >Delete</a>
               				</td>
		             	</tr>			             					
									
		              </table>
		        
		            </div>
	          </div>								
			</div>							
		</div>
	</div>
@endsection