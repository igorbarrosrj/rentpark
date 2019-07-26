@extends('layouts.admin')

@section('content')

	<div class="content-wrapper">

		 <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Bookings List</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">List Bookings</li>
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
							@foreach($bookings as $booking)
						        <tr>
						            <td>{{ ++$sno }}</td>
						            <td>

						            	@if($booking->user()->first()!=NULL)

						            		<a href="{{ route('admin.users.view',$booking->user()->first()->id) }}">{{ $booking->user()->first()->name }}</a>
						            	@else
						            		No User Available
						            	@endif	
						            	</td>

						            <td>
						            	@if($booking->provider()->first()!=NULL)

						            		<a href="#">{{ $booking->provider()->first()->name }}</a>
						            	@else
						            		No Provider Available
						            	@endif

						            </td>
									<td>

										@if($booking->host()->first()!=NULL)

											<a href="{{ route('admin.hosts.view',$booking->host()->first()->id) }}">{{ $booking->host()->first()->host_name }}</a>										
										@else
											No Host Available
										@endif
									</td>

									<td>{{ $booking->checkin }}</td>
									<td>{{ $booking->checkout }}</td>										
							       	@switch($booking->status)

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

									<td><a href="{{ route('admin.bookings.view',$booking->id) }}" class="btn btn-info">View</a></td>
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

