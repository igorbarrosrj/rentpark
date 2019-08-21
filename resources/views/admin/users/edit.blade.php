@extends('layouts.admin')

@section('content')

    <div class="content-wrapper">

        <!-- ================ Bread crumb ===================== -->
        <div class="row page-titles">         
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Edit User</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">View Users</a></li>
                    <li class="breadcrumb-item active">Edit User</li>
                </ol>
            </div>
         
            <div class="col-md-7 align-self-center">
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary pull-right hidden-sm-down">Go Back</a>
            </div>
       
        </div>
        <!-- ================ End Bread crumb =================== -->

        @include('notifications.notification')

        @include('admin.users._form')

    </div>

@endsection