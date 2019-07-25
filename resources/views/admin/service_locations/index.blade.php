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

	<div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Service Locations</h4>
                    <div class="table-responsive">
                        <table class="table">
			                <tr>
			                  	
			                  	<th>SNo</th>
			                  	<th>Name</th>
			                  	<th>Full Address</th>
			                  	<th>Description</th>
			                  	<th>Updated At</th>
			                  	<th>Status</th>
			                  	<th>Action</th>
			                </tr>
					               	
							@if(count($service_locations)>0)
								@foreach($service_locations as $service_location)
						            <tr>
						            	<td>{{ ++$sno }}</td>
										<td><a href="{{ route('admin.service_locations.view',$service_location->id) }}">{{ $service_location->name }}</a></td>
										<td>{{ $service_location->full_address }}</td>
										<td>{{ $service_location->description }}</td>
										<td>{{ $service_location->updated_at }}</td>
										@switch($service_location->status)

                                                @case(0)
                                                    <td><div class="label label-danger">Declined</div></td>
                                                @break

                                                @case(1)
                                                    <td><div class="label label-success">Approved</div></td>
                                                @break

                                            @endswitch
										<td>
											 <div class="dropdown">
                                                      <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Action
                                                      <span class="caret"></span></button>
                                                      <ul class="dropdown-menu">
                                                        <li ><a href="{{ route('admin.service_locations.view',$service_location->id) }}" class="dropdown-item" >View</a></li>
                                                        <li><a href="{{ route('admin.service_locations.edit',$service_location->id) }}" class="dropdown-item" >Edit</a></li>
                                                        <li><a href="{{ route('admin.service_locations.delete',$service_location->id) }}" class="dropdown-item" onclick="return confirm('Are you sure?')" >Delete</a></li>
                                                        <div class="dropdown-divider"></div>
                                                         <li><a href="{{ route('admin.service_locations.status',$service_location->id) }}" class="dropdown-item">
                                                             
                                                             @switch($service_location->status)

                                                                @case(0)
                                                                    Approve
                                                                @break

                                                                @case(1)
                                                                    Decline
                                                                @break

                                                            @endswitch

                                                         </a></li>
                                                      </ul>
                                                </div> 
										</td>
						            </tr>
						        @endforeach

				            @else
				            	<tr><td colspan=5><h3>No Service Location found</h3></td></tr>
				            @endif

				        </table>
				        {{$service_locations->links()}}

		            </div>		            
	          </div>				
			</div>							
		</div>
	</div>
		

@endsection

