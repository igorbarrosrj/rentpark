@extends('layouts.admin') 

@section('content')

<div class="content-fluid">

    <!-- ================ Bread crumb ===================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">List Users</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">View Users</a></li>
                <li class="breadcrumb-item active">List Users</li>
            </ol>
        </div>
        <div class="col-md-7 align-self-center">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary pull-right hidden-sm-down">Add User</a>
        </div>
    </div>
    <!-- ================ End Bread crumb =================== -->

    @include('notifications.notification') 

    @php $sno = 0; @endphp

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

                                    @foreach($users as $user_details)
                                        
                                        <tr>
                                            <td>{{ ++$sno }}</td>
                                            <td><a href="{{ route('admin.users.view',$user_details->id) }}">{{ $user_details->name }}</a></td>
                                            <td>{{ $user_details->email }}</td>
                                            <td>{{ $user_details->mobile }}</td>
                                            <td>{{ common_date($user_details->updated_at) }}</td>
                                           
                                            @if($user_details->status == APPROVED) 
                                            
                                            <td>
                                                <div class="label label-success">Approved</div>
                                            </td>
                                            @else 
                                            <td>
                                                <div class="label label-danger">Declined</div>
                                            </td>
                                            @endif

                                            <td>

                                                <div class="dropdown">
                                                   
                                                    <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Action
                                                        <span class="caret"></span>
                                                    </button>
                                                   
                                                    <ul class="dropdown-menu">
                                                       
                                                        <li><a href="{{ route('admin.users.view',$user_details->id) }}" class="dropdown-item">View</a></li>
                                                      
                                                        <li><a href="{{ route('admin.users.edit',$user_details->id) }}" class="dropdown-item">Edit</a></li>
                                                       
                                                        <li><a href="{{ route('admin.users.delete',$user_details->id) }}" class="dropdown-item" onclick="return confirm('Are you sure want to delete the user {{ $user_details->name }}?')">Delete</a>
                                                        </li>
                                                        
                                                        <div class="dropdown-divider"></div>
                                                        
                                                        <li>
                                                            @if($user_details->status == DECLINED)

                                                            <a href="{{ route('admin.users.status',$user_details->id) }}" class="dropdown-item">Approve</a> 

                                                            @else

                                                            <a href="{{ route('admin.users.status',$user_details->id) }}" class="dropdown-item" onclick="return confirm('Are you sure want to decline the user {{ $user_details->name }}')">Decline</a> 

                                                            @endif
                                                            
                                                        </li>

                                                    </ul>

                                                </div>

                                            </td>

                                        </tr>
                                    
                                    @endforeach 

                                @else
                                    
                                    <tr>
                                        <td colspan=5>
                                            <h3>No Users found</h3>
                                        </td>
                                    </tr>

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