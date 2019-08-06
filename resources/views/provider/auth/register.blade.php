@extends('layouts.providers.focused')

@section('content')

	 <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" method="post">
              	@csrf 

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="Name" name="name" placeholder="Name" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="tel" class="form-control form-control-user" id="Mobile" name="mobile" placeholder="Mobile Number" required>
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" name="email" required>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Confirm Password" name="password_confirmation" required>
                  </div>
                </div>
                <input type="submit" value="Register Account" class="btn btn-primary btn-user btn-block">
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="{{ route('provider.password.request') }}">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="{{ route('provider.login') }}">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>


@endsection