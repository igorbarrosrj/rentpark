@extends('layouts.admin')

@section('content')

	<div class="content-wrapper">

		 <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Hosts List</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">List Hosts</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
        
        @php  $sno = 0; @endphp

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

		                
					               	
							@if(count($hosts)>0)
									@foreach($hosts as $host)
						                <tr>
						                	<td>{{ ++$sno }}</td>
											<td>{{ $host->name }}</td>
											<td>{{ $host->email }}</td>
											<td>{{ $host->description }}</td>
											<td>{{ $host->mobile }}</td>
											<td>{{ $host->gender }}</td>
											<td>{{ $host->created_at }}</td>	
											<td><a href="{{ route('admin.hosts.view',$host->id) }}" class="btn btn-info">View</a></td>
											<td><a href="{{ route('admin.hosts.edit',$host->id) }}" class="btn btn-primary">Edit</a></td>
											<td><a href="{{ route('admin.hosts.delete',$host->id) }}" class="btn btn-danger">Delete</a>	             			
				               				</td>
						                </tr>
						             @endforeach
				              </table>
				              {{$hosts->links()}}
				             
				            @else
				            	<h3>No Hosts found</h3>
				            @endif

		            </div>		            
	          </div>
	    
								
			</div>							
		</div>
	</div>
		

@endsection

