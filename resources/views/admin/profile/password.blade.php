@extends('layouts.admin') 
@section('content')

    <div class="content-wrapper">

       <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Admin Detail</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.profile.view',$admin->id) }}">Admin Detail</a></li>
                            <li class="breadcrumb-item active">Change Password</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <a href="{{ route('admin.profile.view',$admin->id) }}" class="btn btn-primary pull-right hidden-sm-down">Go Back</a>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->

                @include('notifications.notification')



                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Admin Details</h4>

                                <form method="post" action="{{ route('admin.profile.password', $admin->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">

                                        <label class="oldpassword">Old Password *</label>
                                        <input type="password" class="form-control" name="oldpassword" placeholder="Old Password"  required />
                                    </div>
                                    <div class="form-group">
                                                    
                                        <label class="password">New Password *</label>

                                        <input type="password" name="password" class="form-control" placeholder="Password" required >

                                    </div>
                                    <div class="form-group">
                                                    
                                        <label class="cpassword">Confirm New Password *</label>

                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                                                    
                                    </div>
                                  
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                 </form>
                            </div>
                        </div>    
                    </div>    
        
    </div>


@endsection
