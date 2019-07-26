@extends('layouts.admin')

@section('content')

    <div class="content-wrapper">


         <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Create Provider</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Create Provider</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
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

        <div class="well">
                        
            <div class="row">

                <div class="col-sm-12 col-md-12">

                    
                    <form action="{{route('admin.providers.save')}}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        
                        <div class="form-group">
                            
                            <label class="name">Name</label>

                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{old('name')}}">

                        </div>
                        <div class="form-group">
                            
                            <label class="email">Email Address</label>

                            <input type="text" name="email" class="form-control" placeholder="Email Address" value="{{old('email')}}">
                            
                        </div>

                        <div class="form-group">
                            
                            <label class="password">Password</label>

                            <input type="password" name="password" class="form-control" placeholder="Password" value="{{old('password')}}">
                            
                        </div>

                         <div class="form-group">
                            
                            <label class="cpassword">Confirm Password</label>

                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" value="{{old('password_confirmation')}}">
                            
                        </div>

                        <div class="form-group">
                            
                            <label class="description">Description</label>

                            <input type="text" name="description" class="form-control" value="{{old('description')}}" placeholder="description">

                        </div>

                        <div class="form-group">
                            
                            <label class="mobile">Mobile Number</label>

                            <input type="text" name="mobile" class="form-control" value="{{old('mobile')}}" placeholder="Mobile Number">

                        </div> 

                         <div class="form-group">
                            
                            <label class="picture">Picture</label>

                            <input type="file" name="picture" class="form-control" value="{{old('picture')}}" id="picture" placeholder="Picture">

                        </div>

                         <div class="form-group">
                            
                            <label class="work">Work</label>

                            <input type="text" name="work" class="form-control" value="{{old('work')}}" placeholder="Work">

                        </div>

                         <div class="form-group">
                            
                            <label class="school">School</label>

                            <input type="text" name="school" class="form-control" value="{{old('school')}}" placeholder="School">

                        </div>

                         <div class="form-group">
                            
                            <label class="languages">Languages</label>

                            <input type="text" name="languages" class="form-control" value="{{old('languages')}}" placeholder="Languages">

                        </div>

                        <input type="submit" name="Submit" class="btn btn-primary">

                    </form>
              </div>                                
            </div>                          
        </div>
    </div>
@endsection