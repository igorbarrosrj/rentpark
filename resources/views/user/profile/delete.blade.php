@extends('layouts.user')

@section('content')

<section class="update_profile pb-4">
    
    <div class="container">
      
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">{{ tr('confirm_password') }}</h6>
        </div>
            
        <div class="card-body">
                
          <form action="{{ route('password.check') }}" method="post" enctype="multipart/form-data">

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