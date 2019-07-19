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
        {{ $no =0 }}

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
		                <tr>
					               	
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
				            				 <td><a href="/showusers/{{ $user->id }}" class="btn btn-info">View</a></td>
											<td><a href="/editusers/{{ $user->id }}" class="btn btn-primary">Edit</a></td>
											<td><a href="/deleteusers/{{ $user->id }}" class="btn btn-danger">Delete</a>			             			
				               				</td>
						                </tr>
						             @endforeach
				              </table>
				              {{$users->links()}}
				            </div>
				             
				            @else
				            	<h3>No Users found</h3>
				            @endif
							
				         </tr>
		              </table>
		            </div>		            
	          </div>

								
			</div>							
		</div>
	</div>
		

@endsection



{{-- 
<div class="box-body">
		              <table class="table table-bordered">
		                <tr>
		                  	
		                  	<th>SNo</th>
		                  	<th>Name</th>
		                  	<th>Email</th>
		                  	<th>Created at</th>
		                </tr>
		                <tr>
			               	<td>1</td>
							<td>Naveen</td>
							<td>naveensnlbe@gmail.com</td>
							<td>14/4/2013</td>
							<td><a href="/users/1" class="btn btn-info">View</a></td>
							<td><a href="/users/1/edit" class="btn btn-primary">Edit</a></td>
							<td>
		             			<form action="#" method="post">
			                  	@csrf
			                  	@method('DELETE')
			                  	<button class="btn btn-danger" type="submit">Delete</button>
               					</form>	
               				</td>
				         </tr>
		              </table>
		            </div> --}}