@extends('layouts.admin')

@section('content')

	<div class="content-wrapper">

        <!-- ================ Bread crumb ===================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">List Bookings</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">List Bookings</li>
                </ol>
            </div>
        </div>
        <!-- ================ End Bread crumb =================== -->
         
        @include('notifications.notification')

        @php  $sno = 0; @endphp

		<div class="row">
        
        <!-- column -->
        <div class="col-12">
        
            <div class="card">
        
                <div class="card-body">
        
                    <h4 class="card-title">Users</h4>                    
        
                    <div class="table-responsive">
                        
                        <table class="table">
				         	<tr>			                  	
				                <th>SNo</th>
				                <th>User Name</th>
				                <th>Provider Name</th>
				                <th>Host Name</th>
				                <th>Check-in</th>
				                <th>Check-Out</th>
				                <th>Status</th>
				                <th>Action</th>
				            </tr>
			            	               	
							@if(count($bookings)>0)

								@foreach($bookings as $booking_details)
							        <tr>
							            <td>{{ ++$sno }}</td>
							            <td>

							            	@if($booking_details->user()->first()!=NULL)

							            		<a href="{{ route('admin.users.view',$booking_details->user()->first()->id) }}">{{ $booking_details->user()->first()->name }}</a>
							            	@else
							            		No User Available
							            	@endif	
							            	</td>

							            <td>
							            	@if($booking_details->provider()->first()!=NULL)

							            		<a href="{{ route('admin.providers.view',$booking_details->provider()->first()->id) }}">{{ $booking_details->provider()->first()->name }}</a>
							            	@else
							            		No Provider Available
							            	@endif

							            </td>
										<td>

											@if($booking_details->host()->first()!=NULL)

												<a href="{{ route('admin.hosts.view',$booking_details->host()->first()->id) }}">{{ $booking_details->host()->first()->host_name }}</a>										
											@else
												No Host Available
											@endif
										</td>

										<td>{{ $booking_details->checkin }}</td>
										<td>{{ $booking_details->checkout }}</td>										
								       	@switch($booking_details->status)

								        	@case(0)
								         	<td><div class="label label-primary">None</div></td>
								        	@break

								        	@case(1)
								         	<td><div class="label label-info">Booking Created</div></td>
								        	@break

								        	@case(2)
								         	<td><div class="label label-primary">Check in</div></td>
								        	@break

								        	@case(3)
								         	<td><div class="label label-primary">Check Out</div></td>
								        	@break

								        	@case(4)
								         	<td><div class="label label-success">Completed</div></td>
								        	@break

								        	@case(5)
								         	<td><div class="label label-danger">User Cancel</div></td>
								        	@break

								        	@case(6)
								         	<td><div class="label label-danger">Provider Cancel</div></td>
								        	@break

								       	@endswitch

										<td><a href="{{ route('admin.bookings.view',$booking_details->id) }}" class="btn btn-info">View</a></td>
							        </tr>
							    @endforeach
					       
					        @else
					           	<tr><td colspan=5><h3>No Booking found</h3></td></tr>
					        @endif

				         </table>

				        {{$bookings->links()}}

		            </div>		            
	    
	          	</div>					
		
			</div>							
		
		</div>
	
	</div>
	
@endsection

