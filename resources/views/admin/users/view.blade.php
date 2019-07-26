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
                    <div class="col-md-7 align-self-center">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-primary pull-right hidden-sm-down">Go Back</a>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->

        

		<div class="row">
	    <!-- column -->
	    <div class="col-12">
	        <div class="card">
	            <div class="card-body">
                <h4 class="card-title">User Details</h4>

		            <div class="box-body">
		              <table class="table ">
		                <tr>
		                  	<th>Details</th>
		                  	<th>User Data</th>
		                </tr>
		             	<tr>
		             		<td> Name</td>
		             		<td>{{ $user->name }}</td>	
		             	</tr>

		             	<tr>
		             		<td>Email</td>
		             		<td>{{ $user->email }}</td>
		             	</tr>	

		             	<tr>
		             		<td>Description</td>
		             		<td>{{ $user->description }}</td>
		             	</tr>	

		             	<tr>
		             		<td>Mobile</td>
		             		<td>{{ $user->mobile }}</td>
		             	</tr>	

		             	<tr>
		             		<td>Gender</td>
		             		<td>{{ $user->gender }}</td>
		             	</tr>	

		             	<tr>
		             		<td>Created At</td>
		             		<td>{{ $user->created_at }}</td>
		             	</tr>

		             	<tr>
		             		<td>Updated At</td>
		             		<td>{{ $user->updated_at }}</td>
		             	</tr>

		             	<tr>
		             		<td>Status</td>
		             		@switch($user->status)

                                @case(0)
                                    <td><div class="label label-danger">Declined</div></td>
                                @break

                                @case(1)
                                    <td><div class="label label-success">Approved</div></td>
                                @break

                            @endswitch
		             	</tr>

		             	<tr>

		             		<td> <a href="{{ route('admin.users.edit',$user->id) }}" class="btn btn-primary">Edit</a></td>

		             		<td>
		             			
		             			<a href="{{ route('admin.users.status',$user->id) }}" class="btn btn-info">
                                                             
                                    @switch($user->status)

                                    @case(0)
                                        Approve
                                    @break

                                    @case(1)
                                        Decline
                                    @break

                                   	@endswitch

                                </a>
		             		</td>

		             		<td>
		             			<a href="{{ route('admin.users.delete',$user->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure want to delete the user {{ $user->name }}?')" >Delete</a>
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