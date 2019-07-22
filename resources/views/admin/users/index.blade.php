@extends('layouts.admin')

@section('content')

	<div class="content-wrapper">

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
        
        {{-- Declare the Serial no. Initially as 0 --}}
        @php  $no = 0 @endphp

		<div class="well">
						
			<div class="row">

				<div class="col-sm-12 col-md-12">
					<div class="box-body">
		              <table class="table table-bordered">
		                <tr>
		                  	
		                  	<th>SNo</th>
		                  	<th>Name</th>
		                  	<th>Email</th>
		                  	<th>Description</th>
		                  	<th>Mobile</th>
		                  	<th>Gender</th>
		                  	<th>Created At</th>
		                </tr>
					               	
							@if(count($users)>0)

									@foreach($users as $user)
						                <tr>
						                	<td>{{ ++$no }}</td>
											<td>{{ $user->name }}</td>
											<td>{{ $user->email }}</td>
											<td>{{ $user->description }}</td>
											<td>{{ $user->mobile }}</td>
											<td>{{ $user->gender }}</td>
											<td>{{ $user->created_at }}</td>
				            				 <td><a href="view/{{ $user->id }}" class="btn btn-info">View</a></td>
											<td><a href="edit/{{ $user->id }}" class="btn btn-primary">Edit</a></td>
											<td><a href="delete/{{ $user->id }}" class="btn btn-danger">Delete</a>			             			
				               				</td>
						                </tr>
						             @endforeach
				              </table>
				              {{$users->links()}}
				             
				            @else
				            	<h3>No Users found</h3>
				            @endif

		            </div>		            
	          </div>
	    
								
			</div>							
		</div>
	</div>
		

@endsection

