@extends('layouts.admin')

@section('content')

	<div class="content-wrapper">

        <!-- ================ Bread crumb ===================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">User Detail</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">View Users</a></li>
                    <li class="breadcrumb-item active">User Detail</li>
                </ol>
            </div>
            <div class="col-md-7 align-self-center">
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary pull-right hidden-sm-down">Go Back</a>
            </div>
        </div>
        <!-- ================ End Bread crumb =================== -->

         @include('notifications.notification')

		<div class="row">

		    <div class="col-12">
		        
		        <div class="card">
		        
		            <div class="card-body">
	            
	                	<h4 class="card-title">User Details</h4>

			            <div class="box-body">
				            
				            <table class="table">
				                
				                <tr>
				                  	<th>Details</th>
				                  	<th>User Data</th>
				                </tr>
				             	<tr>
				             		<td> Name</td>
				             		<td>{{ $user_details->name }}</td>	
				             	</tr>

				             	<tr>
				             		<td>Email</td>
				             		<td>{{ $user_details->email }}</td>
				             	</tr>	

				             	<tr>
				             		<td>Mobile</td>
				             		<td>{{ $user_details->mobile }}</td>
				             	</tr>

				             	<tr>
				             		<td>Description</td>
				             		<td>{{ $user_details->description }}</td>
				             	</tr>	

				             	<tr>
				             		<td>Picture</td>
				             		<td><img src="{{ $user_details->picture }}" style="width: 200px;height: 200px"></td>
				             	</tr>

				             	<tr>
				             		<td>Gender</td>
				             		<td>{{ $user_details->gender }}</td>
				             	</tr>	

				             	<tr>
				             		<td>Created At</td>
				             		<td>{{ common_date($user_details->created_at) }}</td>
				             	</tr>

				             	<tr>
				             		<td>Updated At</td>
				             		<td>{{ common_date($user_details->updated_at) }}</td>
				             	</tr>

				             	<tr>
				             		<td>Status</td>
				             		
		                            @if($user_details->status) 
	                                    <td>
	                                        <div class="label label-danger">Declined</div>
	                                    </td>
	                                @else 
	                                    <td>
	                                        <div class="label label-success">Approved</div>
	                                    </td>
	                                @endif
				             	</tr>

				             	<tr>

				             		<td> <a href="{{ route('admin.users.edit',['user_id' => $user_details->id]) }}" class="btn btn-primary">Edit</a></td>

				             		<td>
		                               
		                                @if($user_details->status == APPROVED)
		                                   
		                                    <a href="{{ route('admin.users.status',['user_id' => $user_details->id])}}" class="btn btn-info" onclick="return confirm('Are you sure want to decline the user {{ $user_details->name }}')">Decline</a>

		                                @else
		                                
		                                  <a href="{{ route('admin.users.status',['user_id' => $user_details->id])}}" class="btn btn-primary">Approve</a>

		                                @endif
			             			
				             		</td>

				             		<td>
				             			<a href="{{ route('admin.users.delete',['user_id' => $user_details->id])}}" class="btn btn-danger" onclick="return confirm('Are you sure want to delete the user {{ $user_details->name }}?')" >Delete</a>
		               				</td>
				             	</tr>			             					
											
				            </table>
			        
			            </div>
		        	
		        	</div>								
				
				</div>							
		
			</div>
	
		</div>

	</div>

@endsection