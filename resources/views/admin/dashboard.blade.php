@extends('layouts.admin')

@section('content')
	<!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Dashboard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->

                 <!-- ============================================================== -->
                <!-- List -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Total Users -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card card-body mailbox " style="height: 150px">
                            <h5 class="card-title">Total Users</h5>
                            <div class="message-center ps ps--theme_default ps--active-y" data-ps-id="a045fe3c-cb6e-028e-3a70-8d6ff0d7f6bd">
                                <!-- Message-->
                                <a href="{{ route('admin.users.index') }}" class="size">
                                    <div class="btn btn-danger btn-circle"><i class="fa fa-user"></i></div>
                                    <div class="mail-contnet pl-3 pt-2"> <span class="mail-desc"> <h2>{{ $total_users ?? 0 }}</h2> </span> </div>
                                </a>
                                
                            </div>
                        </div>
                    </div>
                    <!-- End Total Users -->

                  <!-- Total Providers -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card card-body mailbox " style="height: 150px">
                            <h5 class="card-title">Total Providers</h5>
                            <div class="message-center ps ps--theme_default ps--active-y" data-ps-id="a045fe3c-cb6e-028e-3a70-8d6ff0d7f6bd">
                                <!-- Message-->
                                <a href="{{ route('admin.providers.index') }}" class="size">
                                    <div class="btn btn-info btn-circle"><i class="fa fa-user"></i></div>
                                    <div class="mail-contnet pl-3 pt-2"> <span class="mail-desc"> <h2>{{ $total_providers ?? 0 }}</h2> </span> </div>
                                </a>
                                
                            </div>
                        </div>
                    </div>
                    <!-- End Total Providers -->

                    <!-- Total Bookings -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card card-body mailbox " style="height: 150px">
                            <h5 class="card-title">Total Bookings</h5>
                            <div class="message-center ps ps--theme_default ps--active-y" data-ps-id="a045fe3c-cb6e-028e-3a70-8d6ff0d7f6bd">
                                <!-- Message-->
                                <a href="{{ route('admin.bookings.index') }}" class="size">
                                    <div class="btn btn-primary btn-circle"><i class="fa fa-calendar"></i></div>
                                    <div class="mail-contnet pl-3 pt-2"> <span class="mail-desc"> <h2>{{ $total_bookings ?? 0 }}</h2> </span> </div>
                                </a>
                                
                            </div>
                        </div>
                    </div>
                    <!-- End Total Users -->
                    <!-- Total Users -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card card-body mailbox " style="height: 150px">
                            <h5 class="card-title">Total Earnings</h5>
                            <div class="message-center ps ps--theme_default ps--active-y" data-ps-id="a045fe3c-cb6e-028e-3a70-8d6ff0d7f6bd">
                                <!-- Message-->
                                <a href="{{ route('admin.bookings.index') }}" class="size">
                                    <div class="btn btn-danger btn-circle"><i class="fa fa-dollar"></i></div>
                                    <div class="mail-contnet pl-3 pt-2"> <span class="mail-desc"> <h2>{{ Setting::get('currency') }} {{ $total_earnings ?? 0 }}</h2> </span> </div>
                                </a>
                                
                            </div>
                        </div>
                    </div>
                    <!-- End Total Users -->
                </div>
                <!-- ============================================================== -->
                <!-- End List -->
                <!-- ============================================================== -->
                
                <!-- ============================================================== -->
                <!-- Users and Providers -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Start Users -->
                    <div class="col-lg-6 col-md-12">
                        <div class="card card-body mailbox">
                            <h5 class="card-title">Recent Users</h5>
                            <div class="message-center ps ps--theme_default ps--active-y" data-ps-id="a045fe3c-cb6e-028e-3a70-8d6ff0d7f6bd">
                                @if(count($users)>0)
                                    @foreach($users as $user)
                                <!-- Message -->
                                <a href="{{ route('admin.users.view',$user->id) }}">
                                    <img src="{{ $user->picture }}" style="height: 40px; width: 40px" class="rounded-circle">
                                    <div class="mail-contnet">
                                        <h5>{{ $user->name }}</h5> <span class="mail-desc">{{ $user->email }}</span> <span class="time">{{ $user->mobile }}</span> </div>
                                </a>
                                @endforeach
                                <br>
                                
                                @else
                                
                                    <h3>No User found</h3>
                                      
                                @endif
                                
                                </div>
                                @if(count($users)>0)
                                    <br>
                                    <a href="{{ route('admin.users.index') }}"><button class="btn btn-primary pl-10">View All</button></a>
                                @endif
                        </div>
                    </div>
                    <!-- End Users -->
                   <!-- Start Providers -->
                    <div class="col-lg-6 col-md-12">
                        <div class="card card-body mailbox">
                            <h5 class="card-title">Recent Providers</h5>
                            <div class="message-center ps ps--theme_default ps--active-y" data-ps-id="a045fe3c-cb6e-028e-3a70-8d6ff0d7f6bd">
                                @if(count($providers)>0)
                                    @foreach($providers as $provider)
                                <!-- Message -->
                                <a href="{{ route('admin.providers.view',$provider->id) }}">
                                    <img src="{{ $provider->picture }}" style="height: 40px; width: 40px" class="rounded-circle">
                                    <div class="mail-contnet">
                                        <h5>{{ $provider->name }}</h5> <span class="mail-desc">{{ $provider->email }}</span> <span class="time">{{ $provider->mobile }}</span> </div>
                                </a>
                              
                                    @endforeach
                                    <br>

                                    @else
                                
                                    <h3>No Provider found</h3>

                                @endif
                                
                            </div>

                            @if(count($providers)>0)
                            
                                <br>    

                                <a href="{{ route('admin.providers.index') }}"><button class="btn btn-primary pl-10">View All</button></a>\
                            @endif
                        </div>
                    </div>
                    <!-- End Providers -->
                </div>
                <!-- ============================================================== -->
                <!-- End Users and Providers -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- End Page Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->

@endsection