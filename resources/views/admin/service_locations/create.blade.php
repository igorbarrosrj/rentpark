@extends('layouts.admin')

@section('content')

    <div class="content-wrapper">


         <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">{{ tr('add_service_location') }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">{{ tr('home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.service_locations.index') }}">{{ tr('service_locations') }}</a></li>
                            <li class="breadcrumb-item active">{{ tr('add_service_location') }}</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <a href="{{ route('admin.service_locations.index') }}" class="btn btn-primary pull-right hidden-sm-down">{{ tr('service_locations') }}</a>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->

                 @include('notifications.notification')

        @include('admin.service_locations._form')
    </div>
@endsection