@extends('layouts.admin')

@section('content')

    <div class="content-wrapper">


         <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Provider Details</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Provider Details</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
        

        <div class="well">        
            
            <div class="col-sm-12 col-md-12">

                    <label><h3>Name : {{$provider->name}}</h3></label> <br>
                    <label><h3>Email : {{$provider->email}}</h3></label> <br>
                    <label><h3>Description : {{$provider->description}}</h3></label> <br>
                    <label><h3>Mobile No : {{$provider->mobile}}</h3></label> <br>
                    <label><h3>Work : {{$provider->work}}</h3></label><br>
                    <label><h3>School : {{$provider->school}}</h3></label><br>
                    <label><h3>Languages : {{$provider->languages}}</h3></label><br>
                    <img src="{{$provider->picture}}" width="50%"><br>
                    <br>
                    <a href="{{ route('admin.providers.edit',$provider->id)}}" class="btn btn-primary">Edit</a>
                
            </div>
        </div>                                    
                                     
    </div>
@endsection