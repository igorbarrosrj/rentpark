@extends('layouts.admin')

@section('content')

	<div class="content-fluid">

		 <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">List Providers</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.providers.index') }}">Providers</a></li>
                            <li class="breadcrumb-item active">List providers</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <a href="{{ route('admin.providers.create') }}" class="btn btn-primary pull-right hidden-sm-down">Add Provider</a>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->

                @include('notifications.notification')
        
    @php  $sno = 0; @endphp

	<div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Providers</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>SNo</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Updated At</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($providers)>0)
                                    @foreach($providers as $provider)
                                        <tr>
                                            <td>{{ ++$sno }}</td>
                                            <td><a href="{{ route('admin.providers.view',$provider->id) }}">{{ $provider->name }}</a></td>
                                            <td>{{ $provider->email }}</td>
                                            <td>{{ $provider->mobile }}</td>   
                                            <td>{{ $provider->updated_at }}</td>
                                            @switch($provider->status)

                                                @case(DECLINED)
                                                    <td><div class="label label-danger">Declined</div></td>
                                                @break

                                                @case(APPROVED)
                                                    <td><div class="label label-success">Approved</div></td>
                                                @break

                                            @endswitch
                                            <td>
                                                 <div class="dropdown">
                                                      <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Action
                                                      <span class="caret"></span></button>
                                                      <ul class="dropdown-menu">
                                                        <li><a href="{{ route('admin.providers.view',$provider->id) }}" class="dropdown-item" >View</a></li>
                                                        <li><a href="{{ route('admin.providers.edit',$provider->id) }}" class="dropdown-item" >Edit</a></li>
                                                        <li><a href="{{ route('admin.providers.delete',$provider->id) }}" class="dropdown-item" onclick="return confirm('Are you sure want to delete the provider {{ $provider->name }}?')" >Delete</a></li>
                                                         <div class="dropdown-divider"></div>
                                                         <li>
                                                            @if($provider->status == DECLINED)
                                                                <a href="{{ route('admin.providers.status',$provider->id) }}" class="dropdown-item"> Approve</a>
                                                
                                                            @elseif($provider->status == APPROVED)
                                                                <a href="{{ route('admin.providers.status',$provider->id) }}" class="dropdown-item" onclick="return confirm('Are you sure decline the provider {{ $provider->name }}')"> Decline</a>

                                                            @endif
                                                        </li>
                                                      </ul>
                                                </div> 
                                            </td>
                                        </tr>
                                     @endforeach
                                      
                                     
                                    @else
                                        <tr><td colspan=5><h3>No providers found</h3></td></tr>
                                    @endif
                            </tbody>
                        </table>
                        {{$providers->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
		

@endsection

