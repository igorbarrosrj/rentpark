@extends('layouts.admin')

@section('content')

	<div class="content-wrapper">

		 <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Provider Detail</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.providers.index') }}">View Providers</a></li>
                            <li class="breadcrumb-item active">Provider Detail</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <a href="{{ route('admin.providers.index') }}" class="btn btn-primary pull-right hidden-sm-down">Go Back</a>
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
                <h4 class="card-title">Provider Details</h4>

		            <div class="box-body">
		              <table class="table ">
		                <tr>
		                  	<th>Details</th>
		                  	<th>Provider Data</th>
		                </tr>
		             	<tr>
		             		<td> Name</td>
		             		<td>{{ $provider->name }}</td>	
		             	</tr>

		             	<tr>
		             		<td>Email</td>
		             		<td>{{ $provider->email }}</td>
		             	</tr>	

		             	<tr>
		             		<td>Mobile</td>
		             		<td>{{ $provider->mobile }}</td>
		             	</tr>	

		             	<tr>
		             		<td>Description</td>
		             		<td>{{ $provider->description }}</td>
		             	</tr>	

		             	<tr>
		             		<td>Picture</td>
		             		<td><img src="{{ $provider->picture }}" style="width: 200px;height: 200px"></td>
		             	</tr>

		             	<tr>
		             		<td>Work</td>
		             		<td>{{ $provider->work }}</td>
		             	</tr>	

		             	<tr>
		             		<td>School</td>
		             		<td>{{ $provider->school }}</td>
		             	</tr>


		             	<tr>
		             		<td>Languages</td>
		             		<td>{{ $provider->languages }}</td>
		             	</tr>		

		             	<tr>
		             		<td>Created At</td>
		             		<td>{{ $provider->created_at }}</td>
		             	</tr>

		             	<tr>
		             		<td>Updated At</td>
		             		<td>{{ $provider->updated_at }}</td>
		             	</tr>

		             	<tr>
		             		<td>Status</td>
		             		
		             		@switch($provider->status)

                                @case(DECLINED)
                                    <td><div class="label label-danger">Declined</div></td>
                                @break

                                @case(APPROVED)
                                    <td><div class="label label-success">Approved</div></td>
                                @break

                            @endswitch
		             	</tr>

		             	<tr>

		             		<td> <a href="{{ route('admin.providers.edit',$provider->id) }}" class="btn btn-primary">Edit</a></td>

		             		<td>
		             			@if($provider->status == DECLINED)
                                   <a href="{{ route('admin.providers.status',$provider->id) }}" class="btn btn-primary"> Approve</a>

                                @elseif($provider->status == APPROVED)
                                    <a href="{{ route('admin.providers.status',$provider->id) }}" class="btn btn-info" onclick="return confirm('Are you sure decline the provider {{ $provider->name }}')"> Decline</a>

                           		 @endif
		             			
		             		</td>

		             		<td>
		             			<a href="{{ route('admin.providers.delete',$provider->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure want to delete the provider {{ $provider->name }}?')" >Delete</a>
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