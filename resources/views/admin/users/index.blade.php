@extends('layouts.admin')

@section('content')

	<div class="content-fluid">

		 <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">User List</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">List Users</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
        
    @php  $sno = 0; @endphp

	<div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Users</h4>
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
                                @if(count($users)>0)
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ ++$sno }}</td>
                                            <td><a href="{{ route('admin.users.view',$user->id) }}">{{ $user->name }}</a></td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->mobile }}</td>   
                                            <td>{{ $user->updated_at }}</td>
                                            @switch($user->status)

                                                @case(0)
                                                    <td><div class="label label-danger">Declined</div></td>
                                                @break

                                                @case(1)
                                                    <td><div class="label label-success">Approved</div></td>
                                                @break

                                            @endswitch
                                            <td>
                                                 <div class="dropdown">
                                                      <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Action
                                                      <span class="caret"></span></button>
                                                      <ul class="dropdown-menu">
                                                        <li><a href="{{ route('admin.users.view',$user->id) }}" class="dropdown-item" >View</a></li>
                                                        <li><a href="{{ route('admin.users.edit',$user->id) }}" class="dropdown-item" >Edit</a></li>
                                                        <li><a href="{{ route('admin.users.delete',$user->id) }}" class="dropdown-item" onclick="return confirm('Are you sure want to delete the user {{ $user->name }}?')" >Delete</a></li>
                                                         <div class="dropdown-divider"></div>
                                                         <li><a href="{{ route('admin.users.status',$user->id) }}" class="dropdown-item">
                                                             
                                                             @switch($user->status)

                                                                @case(0)
                                                                    Approve
                                                                @break

                                                                @case(1)
                                                                    Decline
                                                                @break

                                                            @endswitch

                                                         </a></li>
                                                      </ul>
                                                </div> 
                                            </td>
                                        </tr>
                                     @endforeach
                                      
                                     
                                    @else
                                        <tr><td colspan=5><h3>No Users found</h3></td></tr>
                                    @endif
                            </tbody>
                        </table>
                        {{$users->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
		

@endsection

