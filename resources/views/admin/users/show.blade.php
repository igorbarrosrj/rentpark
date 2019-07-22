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
					<a href="{{ route('admin.users.index') }}" class="btn btn-primary">Go Back</a>

		            <div class="box-body">
		              <table class="table table-bordered">
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
		             		<td> <a href="{{ route('admin.users.edit',$user->id) }}" class="btn btn-primary">Edit</a></td>
		             		{{-- <td><a href="{{ route('users.destroy',1) }}"  class="btn btn-danger">Delete</a> --}}

		             		<td>
		             			<a href="{{ route('admin.users.delete',$user->id) }}" class="btn btn-danger">Delete</a>
               				</td>
		             	</tr>			             					
									
		              </table>
		        
		            </div>
	          </div>								
			</div>							
		</div>
	</div>
@endsection