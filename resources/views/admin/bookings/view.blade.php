@extends('layouts.admin')

@section('content')

	<div class="content-wrapper">

		 <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">{{ tr('booking_detail') }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">{{ tr('home') }}</a></li>
                            <li class="breadcrumb-item active">{{ tr('booking_detail') }}</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-primary pull-right hidden-sm-down">{{ tr('go_back') }}</a>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->


         @include('notifications.notification')

		< <div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
		            <div class="box-body">
		              <table class="table ">
		                <tr>
		                  	<th>{{ tr('details') }}</th>
		                  	<th>{{ tr('booking_data') }}</th>
		                </tr>
		             	<tr>
		             		<td>{{ tr('user_name') }}</td>
		             		<td>

		             			@if($booking_details->user()->first())

						            <a href="{{ route('admin.users.view',['user_id' => $booking_details->user()->first()->id]) }}">{{ $booking_details->user()->first()->name }}</a>
						        @else
						            {{ tr('no_user_available') }}
						        @endif	
						     </td>	
		             	</tr>

		             	<tr>
		             		<td>{{ tr('provider_name') }}</td>
		             		<td>
		             			@if($booking_details->provider()->first())

						            <a href="{{ route('admin.providers.view',$booking_details->provider()->first()->id) }}">{{ $booking_details->provider()->first()->name }}</a>
						        @else
						            {{ tr('no_provider_available') }}
						        @endif
		             		</td>
		             	</tr>

		             	<tr>
		             		<td>{{ tr('host_name') }}</td>
		             		<td>

		             			@if($booking_details->host()->first())

									<a href="{{ route('admin.hosts.view',$booking_details->host()->first()->id) }}">{{ $booking_details->host()->first()->host_name }}</a>										
								@else
									{{ tr('no_host_available') }}
								@endif

		             		</td>
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('checkin_time') }}</td>
		             		<td>{{ $booking_details->checkin }}</td>
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('checkout_time') }}</td>
		             		<td>{{ $booking_details->checkout }}</td>
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('status') }}</td>
		             		@switch($booking_details->status)

		             			@case(BOOKING_NONE)
									<td><div class="label label-primary">{{ tr('none') }}</div></td>
								@break

								@case(BOOKING_CREATED)
								    <td><div class="label label-info">{{ tr('booking_created') }}</div></td>
								@break

								@case(BOOKING_CHECKIN)
								    <td><div class="label label-primary">{{ tr('checkin') }}</div></td>
								
								@break

								@case(BOOKING_CHECKOUT)
								    <td><div class="label label-primary">{{ tr('checkout') }}</div></td>
								@break

								@case(BOOKING_COMPLETED)
								    <td><div class="label label-success">{{ tr('completed') }}</div></td>
								@break

								@case(BOOKING_USER_CANCEL)
								    <td><div class="label label-danger">{{ tr('user_cancel') }}</div></td>
								@break

								@case(BOOKING_PROVIDER_CANCEL)
								    <td><div class="label label-danger">{{ tr('provider_cancel') }}</div></td>
								@break

		             		@endswitch

		             		
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('comment') }}</td>
		             		<td>
		             			@if($booking_details->provider_review()->first())
		             				{{ $booking_details->provider_review()->first()->comment }}
		             			@else
									{{ tr('no_comment_available') }}
								@endif
							</td>
		             	</tr>	

		             	<tr>
                      <td>{{ tr('rating') }}</td>

                      <td>


                        @if($booking_details->provider_review()->first())                           
                          <div class="rating">
                                <label>
                                  
                                  <input type="radio" name="stars"  checked/>
                                  @for($i=0; $i< $booking_details->provider_review()->first()->review; $i++)
                                    <span class="icon">★</span>
                                  @endfor
                                  
                                </label>
                                <label> 
                                  <span class="icon">★</span>
                                  <span class="icon">★</span>
                                  <span class="icon">★</span>
                                  <span class="icon">★</span>
                                  <span class="icon">★</span>
                                </label>
                              </div>

                            @endif
                      </td>
                    </tr>

		              </table>
		        
		            </div>
	          </div>								
			</div>							
		</div>
	</div>
@endsection