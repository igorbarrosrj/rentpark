@extends('layouts.provider') 

@section('content')

  <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="row">
                        <div class="col-md-5">
                             <h1 class="h3 mb-2 text-gray-800">Booking Detail</h1>
          <p class="mb-4">Your Booking information can available:</p>
                        </div>
                        <div class="col-md-7">
                            <a href="{{ route('provider.bookings.index') }}"  class="btn btn-primary float-right hidden-sm-down">Go Back</a>
                        </div>
                    </div>  
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Booking</h6>
            </div>
            <div class="card-body">
              <table class="table table-borderless">
                    <tr>
                        <th>Details</th>
                        <th>Booking Data</th>
                    </tr>                                                                                         
                  <tr>
                    <td>User Name</td>
                    <td>

                        @if($booking->user()->first()!=NULL)

                          {{ $booking->user()->first()->name }}
                        @else
                            No User Available
                        @endif  
                    </td>  
                  </tr>

                  <tr>
                    <td>User Image</td>
                    <td>

                        @if($booking->user()->first()!=NULL)

                         <img src="{{ $booking->user()->first()->picture }}" style="width: 200px;height: 200px">
                        @else
                            No User Available
                        @endif  
                    </td>  
                  </tr>
                  <td>User Mail id</td>
                    <td>

                        @if($booking->user()->first()!=NULL)

                          {{ $booking->user()->first()->email }}
                        @else
                            No User Available
                        @endif  
                    </td>  
                  </tr>

                  <td>User Mobile</td>
                    <td>

                        @if($booking->user()->first()!=NULL)

                          {{ $booking->user()->first()->mobile }}
                        @else
                            No User Available
                        @endif  
                    </td>  
                  </tr>

                  <tr>
                    <td>Host Name</td>
                    <td>

                      @if($booking->host()->first()!=NULL)

                        <a href="{{ route('provider.hosts.view',$booking->host()->first()->id) }}">{{ $booking->host()->first()->host_name }}</a>                   
                      @else
                        No Host Available
                      @endif

                    </td>
                  </tr> 

                  <tr>
                    <td>Check-in Time</td>
                    <td>{{ $booking->checkin }}</td>
                  </tr> 

                  <tr>
                    <td>Check-out Time</td>
                    <td>{{ $booking->checkout }}</td>
                  </tr> 

                  <tr>
                    <td>Mode of Payment</td>
                    <td>{{ $booking->payment_mode }}</td>
                  </tr> 

                  <tr>
                    <td>Total Amount</td>
                    <td>{{ $booking->currency }}{{ $booking->total }}</td>
                  </tr> 

                  <tr>
                    <td>Status</td>
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

                    
                  </tr> 
                  @if($booking->status==BOOKING_CHECKOUT)
                  <tr>
                    <td>Review</td>

                    <td><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal">Click Me!</button></td>   

                    <div class="modal fade" id="myModal" role="dialog">
                      <div class="modal-dialog">
                      
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            <form action="{{ route('provider.bookings.rating', $booking->id) }}" method="post">       
                              @csrf

                              <input type="hidden" name="booking_id" class="form-control" value="{{ $booking->id }}" >

                                  <div class="rating" class="form-control">
                                  
                                  <label>
                                    <input type="radio" name="stars" value="1" @if($booking->provider_review()->first()!=NULL) {{ $booking->provider_review()->first()->review == '1' ? 'checked' : '' }} @endif/>
                                    <span class="icon">★</span>
                                  </label>
                                  <label>
                                    <input type="radio" name="stars" value="2" @if($booking->provider_review()->first()!=NULL) {{ $booking->provider_review()->first()->review == '2' ? 'checked' : '' }} @endif/>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                  </label>
                                  <label>
                                    <input type="radio" name="stars" value="3" @if($booking->provider_review()->first()!=NULL) {{ $booking->provider_review()->first()->review == '3' ? 'checked' : '' }} @endif/>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>   
                                  </label>
                                  <label>
                                    <input type="radio" name="stars" value="4" @if($booking->provider_review()->first()!=NULL) {{ $booking->provider_review()->first()->review == '4' ? 'checked' : '' }} @endif/>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                  </label>
                                  <label>
                                    <input type="radio" name="stars" value="5" @if($booking->provider_review()->first()!=NULL) {{ $booking->provider_review()->first()->review == '5' ? 'checked' : '' }} @endif/>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                  </label>
                                </div> 
                                     
                              

                              <div class="form-group">
                                  <label>Comments *</label>
                                  <input type="text" name="comment" class="form-control "  placeholder="Comment" @if($booking->provider_review()->first()!=NULL) value="{{ $booking->provider_review()->first()->comment}}"@endif>

                              </div> 
                               
                               
                                <input type="submit" name="submit">
                       
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                        
                      </div>
                    </div>               
                  </tr>  
                  @endif     

                  @if($booking->status == BOOKING_COMPLETED)

                    <tr>
                      <td>Comment</td>
                      <td>@if($booking->provider_review()->first()!=NULL) 
                          {{ $booking->provider_review()->first()->comment}}
                        @endif
                      </td>
                    </tr>

                    <tr>
                      <td>Rating  </td>

                      <td>


                        @if($booking->provider_review()->first()!=NULL)                           
                          <div class="rating">
                                <label>
                                  
                                  <input type="radio" name="stars"  checked/>
                                  @for($i=0; $i< $booking->provider_review()->first()->review; $i++)
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

                  @endif       

                  <tr>
                    <td>
                      @if($booking->status!= BOOKING_PROVIDER_CANCEL && $booking->status!= BOOKING_USER_CANCEL & $booking->status!= BOOKING_COMPLETED)
              
                        <a href="{{ route('provider.bookings.status',$booking->id) }}" class="btn btn-danger">Cancel</a>
                      @endif
                    </td>
                  </tr>    
                  
                  </table>


            </div>
          </div>

        </div>

  <!-- /.container-fluid -->
@endsection