@extends('layouts.provider')

@section('content')

	<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Hosts Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Hosts Available</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_hosts ?? 0}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-home fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

             <!-- Bookings Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Bookings</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $total_bookings ?? 0.00}}</div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{Setting::get('currency') }} {{ $earnings ?? 0.00}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-6 col-lg-6">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Recent Earnings Overview</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area align-items-center">
                      

                        @if(count($bookings)>0)
                           @foreach($bookings as $booking)

                            <div class="row wrapper d-flex align-items-center py-2 border-bottom pl-10">
                              
                              <div class="d-flex col-lg-3 float-left align-items-center  justify-content-lg-end">
                                 <img src="/uploads/users{{ $booking->user()->first()->picture }}" class="img-sm rounded-circle" style="width: 40px; height: 40px" alt="profile">
                              </div>
                              <div class="col-lg-4">
                                

                                 <h6 class="ml-1 mb-1">
                                            @if($booking->user()->first()!=NULL)

                                              {{ $booking->user()->first()->name }}
                                            @else
                                              No User Available
                                            @endif  
                                          </h6>

                                          <small class="text-muted ml-auto">
                                            <i class="fa fa-home" aria-hidden="true"></i>
                                            @if($booking->host()->first()!=NULL)

                                              <a href="{{ route('provider.hosts.view',$booking->host()->first()->id) }}">{{ $booking->host()->first()->host_name }}</a>                    
                                            @else
                                              No Host Available
                                            @endif
                                          </small>

                                           <br>  
                                          <small class=" d-flex text-muted mb-0">
                                            
                                            <i class="fa fa-dollar-sign mr-2" aria-hidden="true"></i>
                                            
                                            @if($booking->user()->first()!=NULL)

                                              {{ $booking->total }}
                                            @else
                                              0
                                            @endif  
                                          </small> 
                                    </div>

                                    <div class="d-flex col-lg-3 float-left pull-left justify-content-lg-end" style="float:left;">
                                      
                                      <a href="{{ route('provider.bookings.view',$booking->id) }}"><i class="fa fa-info-circle float-left" style="font-size:38px;" aria-hidden="true"></i></a>

                                    </div>

                                  </div>
                                
                                 
                            
                          @endforeach
    
                          @else
                              <tr><td colspan=5><h3>No Booking found</h3></td></tr>
                          @endif


                  </div>

                  <a href="{{ route('provider.bookings.index') }}"><button class="btn btn-primary pl-10">View All</button></a>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-6 col-lg-6">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Hosts</h6>
                  
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="row">
                     <div class="col-md-10 col-md-offset-1">
                         <div class="panel panel-default">
                             <div class="panel-heading"><b>Hosts Status</b></div>
                             <div class="panel-body">
                                 <canvas id="canvas"></canvas>
                             </div>
                         </div>
                     </div>
                   </div>
                
                </div>


                
              </div>
            </div>
          </div>


        </div>
        <!-- /.container-fluid -->

@endsection