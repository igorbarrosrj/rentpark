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
					<a href="/users" class="btn btn-primary">Go Back</a>

		            <div class="box-body">
		              <table class="table table-bordered">
		                <tr>
		                  	<th>Details</th>
		                  	<th>User Data</th>
		                </tr>
		             	<tr>
		             		<td> Name</td>
		             		<td>naveen</td>	
		             	</tr>

		             	<tr>
		             		<td>Email</td>
		             		<td>naveensnlbe@gmail.com</td>
		             	</tr>	

		             	<tr>
		             		<td>Created At</td>
		             		<td>11-7-2019</td>
		             	</tr>	

		             	<tr>
		             		<td> <a href="/users/1/edit" class="btn btn-primary">Edit</a></td>
		             		{{-- <td><a href="{{ route('users.destroy',1) }}"  class="btn btn-danger">Delete</a> --}}

		             		<td>
		             			<form action="{{ route('users.destroy', 1)}}" method="post">
			                  	@csrf
			                  	@method('DELETE')
			                  	<button class="btn btn-danger" type="submit">Delete</button>
               					</form>	
               				</td>
		             	</tr>	
		             	<tr>
		             		<td>

		             			{{-- {!!Form::open(['action' => ['UsersController@destroy', 1], 'method' => 'POST'])!!}
                				
                				{!!Form::hidden('_method','DELETE')!!}
                				
                				{!!Form::submit('delete',['class'=> 'btn btn-danger'])!!}
            					{!!Form::close()!!} --}}
            				</td>
		             	</tr>
		             					
									
		              </table>
		        
		            </div>
	          </div>								
			</div>							
		</div>
	</div>
@endsection