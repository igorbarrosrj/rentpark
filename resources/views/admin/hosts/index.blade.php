@extends('layouts.admin')

@section('content')

	<div class="content-wrapper">

		 <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Hosts List</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">List Hosts</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <a href="{{ route('admin.hosts.create') }}" class="btn btn-primary pull-right hidden-sm-down">Add Host</a>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->

                 @include('notifications.notification')
        
    @php  $sno = 0; @endphp

	<div class="row">
						
		<div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Hosts</h4>
                    <div class="table-responsive">
		            <table class="table">
		                <tr>
		                  	
		                  	<th>SNo</th>
		                  	<th>Host Name</th>
		                  	<th>Provider Name</th>
		                  	<th>Host Type</th>
		                  	<th>Service Location</th>
		                  	<th>Total Spaces</th>
		                  	<th>Per Hour</th>
		                  	<th>Updated At</th>
		                  	<th>Status</th>
		                  	<th>Action</th>
		                </tr>

		                @if(count($hosts)>0)
							@foreach($hosts as $host)
								<tr>
								 	<td>{{ ++$sno }}</td>
									<td><a href="{{ route('admin.hosts.view',$host->id) }}">{{ $host->host_name }}</a></td>
									<td>
										@if($host->provider()->first()!=NULL)
											<a href="{{ route('admin.providers.view', $host->provider()->first()->id) }}">{{ $host->provider()->first()->name }}</a>
										@else
											No Provider Available
										@endif
									</td>
									<td>{{ $host->host_type }}</td>
									<td>
										@if($host->service_location()->first()!=NULL)
											<a href="{{ route('admin.service_locations.view',$host->service_location()->first()->id) }}">{{ $host->service_location()->first()->name }}</a>
										@else
											No Service Location Found
										@endif
									</td>
									<td>{{ $host->total_spaces }}</td>
									<td>{{ $host->per_hour }}</td>
									<td>{{ $host->updated_at }}</td>
									 @switch($host->status)

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
                                                <li><a href="{{ route('admin.hosts.view',$host->id) }}" class="dropdown-item" >View</a></li>
                                                <li><a href="{{ route('admin.hosts.edit',$host->id) }}" class="dropdown-item">Edit</a></li>
                                                <li><a href="{{ route('admin.hosts.delete',$host->id) }}" class="dropdown-item" onclick="return confirm('Are you sure want to delete host {{ $host->host_name }}?')" >Delete</a></li>
                                                <div class="dropdown-divider"></div>
                                                         <li><a href="{{ route('admin.hosts.status',$host->id) }}" class="dropdown-item">
                                                             
                                                            {{  $host->status = $host->status == APPROVED ? 'Decline' : 'Approve'}}

                                                         </a></li>
                                            </ul>
                                         </div> 
									</td>								
								</tr>
							@endforeach
						@else
				            <tr><td colspan=5><h3>No Hosts found</h3></td></tr>
				        @endif
						       		
				    </table>
				    
				    {{$hosts->links()}}

		            </div>		            
	          </div>		
			</div>							
		</div>
	</div>
		

@endsection

