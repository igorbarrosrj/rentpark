 
 @extends('layouts.provider')

@section('content')

<!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
          <div class="row">
                        <div class="col-md-5">
                             <h1 class="h3 mb-2 text-gray-800">Update Password</h1>
          <p class="mb-4">Your Profile password update here:</p>
                        </div>
                        <div class="col-md-7">
                            <a href="{{ route('provider.profile.index') }}"  class="btn btn-primary float-right hidden-sm-down">Go Back</a>
                        </div>
                    </div>  
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Update Profile</h6>
            </div>
            <div class="card-body">
                
                <form action="{{ route('provider.profile.password.save') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group">
                            

                            <input type="hidden" name="id" class="form-control" value="{{ $profile->id }}" >

                        </div>
                        
                         <div class="form-group">
                            
                            <label class="old_password">Old Password *</label>

                            <input type="password" name="old_password" class="form-control" placeholder="Old Password" required>

                        </div>

                        <div class="form-group">
                            
                            <label class="password">New Password *</label>

                            <input type="password" name="password" class="form-control" placeholder="New Password" required>

                        </div>

                        <div class="form-group">
                            
                            <label class="password_confirmation">Confirm New Password *</label>

                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm New Password" required>

                        </div>



                        <input type="submit" name="Submit" class="btn btn-primary">

                    </form>

            </div>
          </div>
    </div>
  @endsection