@extends('layouts.user')

@section('content')

<section class="update_profile">
   <div class="row">
      <div class="col-md-5">
        <h2 class="h3 mb-2 text-gray-800 profile">{{ tr('confirm_passwords') }}</h2>
        <p class="mb-4">{{ tr('password_info') }}</p>
        @include('notifications.notification')
      </div>
    </div>  
    
  <div class="container">
      
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">{{ tr('confirm_password') }}</h6>
        </div>
            
        <div class="card-body">
                
          <form action="{{ route('profile.delete') }}" method="post" enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="form-group">
                
                <label class="password_confirmation">{{ tr('confirm_password') }} *</label>

                <input type="password" name="password" class="form-control" placeholder="{{ tr('confirm_password') }}" value="{{ old('password_confirmation') }}" required>

            </div>

            <input type="submit" name="Submit" class="btn btn-primary">

        </form>

      </div>
    </div>
  </div>
</section>

@endsection