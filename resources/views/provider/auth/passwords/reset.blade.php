@extends('layouts.providers.focused')

@section('content')
 <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Provider Password</h1>
                    <p class="mb-4">Reset Your Password in this place</p>
                  </div>
                   @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                  <form class="user" method="POST" action="{{ route('provider.password.request') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                                <input id="password" type="password" class="form-control form-control-user" placeholder="Enter Password..." name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            
                                <input id="password-confirm" type="password" class="form-control form-control-user" name="password_confirmation" placeholder="Enter Confirm Password..." required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                           
                        </div>

                       
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Reset Password
                        </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="{{ route('provider.register') }}">Create an Account!</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="{{ route('provider.login') }}">Already have an account? Login!</a>
                  </div>
                </div>
              </div>
            </div>
@endsection