@extends('layouts.admin') 
@section('content')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Change Password</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br /> 
        @endif
        <form method="post" action="{{ route('admin.profile.password', $admin->id) }}" enctype="multipart/form-data">
            @method('PUT') 
            @csrf
            <div class="form-group">

                <label class="oldpassword">Old Password:</label>
                <input type="password" class="form-control" name="oldpassword" placeholder="Old Password" />
            </div>
            <div class="form-group">
                            
                <label class="password">New Password</label>

                <input type="password" name="password" class="form-control" placeholder="Password" >

            </div>
            <div class="form-group">
                            
                <label class="cpassword">Confirm New Password</label>

                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" >
                            
            </div>
          
            <button type="submit" class="btn btn-primary">Change Password</button>
        </form>
    </div>
</div>
@endsection
