@extends('layouts.admin')

@section('content')

    <div class="content-wrapper">

       <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">User Detail</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">User Detail</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->


        <div class="well">
                        
            <div class="row">

                <div class="col-sm-12 col-md-12">

                    <form action="/updateusers/{{ $user->id}}" method="post">

                        {{ csrf_field() }}

                        <input type="hidden" name="_method" value="PUT">
                        
                        <div class="form-group">
                            
                            <label class="name">Name</label>

                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" placeholder="Name">

                        </div>
                        <div class="form-group">
                            
                            <label class="email">Email Address</label>

                            <input type="text" name="email" class="form-control" value="{{ $user->email }}"placeholder="Email Address">
                            
                        </div>

                        <div class="form-group">
                            
                            <label class="password">Password</label>

                            <input type="password" name="password" class="form-control" placeholder="Password">
                            
                        </div>

                         <div class="form-group">
                            
                            <label class="cpassword">Confirm Password</label>

                            <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password">
                            
                        </div>

                        <div class="form-group">
                            
                            <label class="description">Description</label>

                            <input type="text" name="description" class="form-control" value="{{ $user->description }}" placeholder="description">

                        </div>

                        <div class="form-group">
                            
                            <label class="mobile">Mobile Number</label>

                            <input type="text" name="mobile" class="form-control" value="{{ $user->mobile }}" placeholder="Mobile Number">

                        </div>

                        <div class="form-group">
                            
                            <label class="gender">Gender</label>

                            <select name="gender">
                                <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Female</option>
                                <option value="others" {{ $user->gender === 'others' ? 'selected' : '' }}>Others</option>
                            </select>

                        </div>

                        <input type="submit" name="Submit" class="btn btn-primary">

                    </form>
              </div>                                
            </div>                          
        </div>
    </div>
@endsection