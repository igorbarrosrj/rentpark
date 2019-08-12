@extends('layouts.admin')

@section('content')

	<div class="content-wrapper">

		 <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Admin Profile</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Admin Profile</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->

                @include('notifications.notification')

        

		<div class="row">
	    <!-- column -->
	    <div class="col-12">
	        <div class="card">
	            <div class="card-body">
                <h4 class="card-title">Admin Profile</h4>

		            <div class="box-body">
		              <table class="table ">
		                <tr>
		                  	<th>Details</th>
		                  	<th>Admin Data</th>
		                </tr>
		             	<tr>
		             		<td> Name</td>
		             		<td>{{ $admin->name }}</td>	
		             	</tr>

		             	<tr>
		             		<td>Email</td>
		             		<td>{{ $admin->email }}</td>
		             	</tr>	

		             	<tr>
		             		<td>Mobile</td>
		             		<td>{{ $admin->mobile }}</td>
		             	</tr>	
		             	
		             	<tr>
		             		<td>About</td>
		             		<td>{{ $admin->about }}</td>
		             	</tr>

		             	<tr>
		             		<td>Picture</td>
		             		<td><img src="{{ $admin->picture }}" style="width: 200px;height: 200px"></td>
		             	</tr>	

		             	<tr>
		             		<td>Updated At</td>
		             		<td>{{ $admin->updated_at }}</td>
		             	</tr>

		        

		             		<td> <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary">Edit</a></td>

		             		<td>
		             			<a href="{{ route('admin.profile.password') }}" class="btn btn-danger" >Change Password</a>
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