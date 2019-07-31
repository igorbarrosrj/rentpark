@extends('layouts.provider')

@section('content')

	<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Bookings Index</h1>
          <p class="mb-4">All the booking will show in this place</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">List Booking</h6>
            </div>
            @php  $sno = 0; @endphp

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable"  width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>SNo</th>
                      <th>User</th>
                      <th>Host Name</th>
                      <th>Check-in</th>
                      <th>Check-Out</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                
                   @if(count($bookings)>0)
              @foreach($bookings as $booking)
                    <tr>
                        <td>{{ ++$sno }}</td>
                        <td>

                          @if($booking->user()->first()!=NULL)

                            {{ $booking->user()->first()->name }}
                          @else
                            No User Available
                          @endif  
                        </td>


                  <td>

                    @if($booking->host()->first()!=NULL)

                      <a href="{{ route('provider.hosts.view',$booking->host()->first()->id) }}">{{ $booking->host()->first()->host_name }}</a>                    
                    @else
                      No Host Available
                    @endif
                  </td>

                  <td>{{ $booking->checkin }}</td>
                  <td>{{ $booking->checkout }}</td>                   
                      @switch($booking->status)

                        @case(BOOKING_NONE)
                          <td><div class="text-primary">None</div></td>
                        @break

                        @case(BOOKING_CREATED)
                          <td><div class="text-info">Booking Created</div></td>
                        @break

                        @case(BOOKING_CHECKIN)
                          <td><div class="text-primary">Check in</div></td>
                        @break

                        @case(BOOKING_CHECKOUT)
                          <td><div class="text-primary">Check Out</div></td>
                        @break

                        @case(BOOKING_COMPLETED)
                          <td><div class="text-success">Completed</div></td>
                        @break

                        @case(BOOKING_USER_CANCEL)
                          <td><div class="text-danger">User Cancel</div></td>
                        @break

                        @case(BOOKING_PROVIDER_CANCEL)
                          <td><div class="text-danger">Provider Cancel</div></td>
                        @break

                      @endswitch


                      <td>
                    <div class="dropdown">
                                            <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Action
                                            <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ route('provider.bookings.view',$booking->id) }}" class="dropdown-item">View</a></li>
                                      
                                              @if($booking->status!=BOOKING_PROVIDER_CANCEL & $booking->status!=BOOKING_USER_CANCEL & $booking->status!=BOOKING_COMPLETED)
                                                <div class="dropdown-divider"></div>
                                                  <li><a href="{{ route('provider.bookings.status',$booking->id) }}" class="dropdown-item">

                                                                Cancel
                                                         </a></li>
                                              @endif
                                            </ul>
                                         </div> 
                  </td>

                  {{-- <td><a href="{{ route('provider.bookings.view',$booking->id) }}" class="btn btn-info">View</a></td> --}}
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
        <!-- /.container-fluid -->
@endsection