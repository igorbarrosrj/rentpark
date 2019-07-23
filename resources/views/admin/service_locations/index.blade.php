@extends('layouts.admin')

@section('content')

	<div class="content-wrapper">

		 <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Service Locations List</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">List Service Locations</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
        
        @php  $sno = 0; @endphp

		<div class="well">
						
			<div class="row">

				<div class="col-sm-12 col-md-12">
					<div class="box-body">
		              <table class="table table-bordered">
		                <tr>
		                  	
		                  	<th>SNo</th>
		                  	<th>Name</th>
		                  	<th>Full Address</th>
		                  	<th>Description</th>
		                  	<th>Created At</th>
		                </tr>

		                
					               	
							@if(count($service_locations)>0)
									@foreach($service_locations as $service_location)
						                <tr>
						                	<td>{{ ++$sno }}</td>
											<td>{{ $service_location->name }}</td>
											<td>{{ $service_location->full_address }}</td>
											<td>{{ $service_location->description }}</td>
											<td>{{ $service_location->created_at }}</td>	
											<td><a href="{{ route('admin.service_locations.view',$service_location->id) }}" class="btn btn-info">View</a></td>
											<td><a href="{{ route('admin.service_locations.edit',$service_location->id) }}" class="btn btn-primary">Edit</a></td>
											<td><a href="{{ route('admin.service_locations.delete',$service_location->id) }}" class="btn btn-danger">Delete</a>	             			
				               				</td>
						                </tr>
						             @endforeach
				              </table>
				              {{$service_locations->links()}}
				             
				            @else
				            	<h3>No Service Location found</h3>
				            @endif

		            </div>		            
	          </div>
	    
								
			</div>							
		</div>
	</div>
		

@endsection

