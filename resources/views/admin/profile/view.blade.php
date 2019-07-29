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
                            <li class="breadcrumb-item active">Admin Details</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
        

        <div class="well">        
            
            <div class="col-sm-12 col-md-12">

                     <div class="box-body">
                      <table class="table ">
                        <tr>
                            <th>Labels</th>
                            <th>admin's Details</th>
                        </tr>
                        <tr><img src="/uploads/admin/{{$admin->picture}}" width="25%" height="25%"></tr> 
                        <tr>
                            <td> Name</td>
                            <td>{{ $admin->name }}</td>  
                        </tr>

                        <tr>
                            <td>Email</td>
                            <td>{{ $admin->email }}</td>
                        </tr>   

                        <tr>
                            <td>About</td>
                            <td>{{ $admin->about }}</td>
                        </tr>   

                        <tr>
                            <td>Mobile</td>
                            <td>{{ $admin->mobile }}</td>
                        </tr>   

                        <tr>
                            <td>Work</td>
                            <td>{{ $admin->work }}</td>
                        </tr>     
                        <tr>
                            <td>Created At</td>
                            <td>{{ $admin->created_at }}</td>
                        </tr>

                        <tr>
                            <td>Updated At</td>
                            <td>{{ $admin->updated_at }}</td>
                        </tr>

                        <td> 
                            <a href="{{ route('admin.profile.edit',$admin->id) }}" class="btn btn-primary">Edit</a>
                        </td>

                        <td> 
                            <a href="{{ route('admin.profile.password',$admin->id) }}" class="btn btn-primary">Change Password</a>
                        </td>


                        
                                                      
                                    
                      </table>
                
                    </div>
                
            </div>
        </div>                                    
                                     
    </div>
@endsection