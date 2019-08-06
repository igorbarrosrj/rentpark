@extends('layouts.provider') 

@section('content')

  <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="row">
                        <div class="col-md-5">
                             <h1 class="h3 mb-2 text-gray-800">Host Detail</h1>
          <p class="mb-4">Your Host information can available:</p>
                        </div>
                        <div class="col-md-7">
                            <a href="{{ route('provider.hosts.index') }}"  class="btn btn-primary float-right hidden-sm-down">Go Back</a>
                        </div>
                    </div>  
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Host</h6>
            </div>
            <div class="card-body">
              <table class="table table-borderless">
                    <tr>
                        <th>Details</th>
                        <th>Host Data</th>
                    </tr>                                                                                         
                  <tr>
                    <td>Host Name</td>
                    <td>{{ $host->host_name }}</td> 
                  </tr>

                  <tr>
                    <td>Host Type</td>
                    <td>{{ $host->host_type }}</td>
                  </tr> 

                  <tr>
                    <td>Description</td>
                    <td>{{ $host->description }}</td>
                  </tr> 

                  <tr>
                    <td>Picture</td>
                    <td><img src="{{ $host->picture }}" style="width: 200px;height: 200px"></td>
                  </tr>

                  <tr>
                    <td>Loction</td>
                    <td>
                      @if($host->service_location()->first()!=NULL)
                        {{ $host->service_location()->first()->name }}
                      @else
                        No Location Found
                      @endif
                  </td>
                  </tr> 

                  <tr>
                    <td>Total Spaces</td>
                    <td>{{ $host->total_spaces }}</td>
                  </tr> 

                  <tr>
                    <td>Full Address</td>
                    <td>{{ $host->full_address }}</td>
                  </tr> 

                  <tr>
                    <td>Per Hour</td>
                    <td>{{ $host->per_hour }}</td>
                  </tr> 

                  <tr>
                    <td>Created At</td>
                    <td>{{ $host->created_at }}</td>
                  </tr>

                  <tr>
                    <td>Updated At</td>
                    <td>{{ $host->updated_at }}</td>
                  </tr>

                  <tr>
                    <td>Status</td>
                    @switch($host->status)

                                @case(DECLINED)
                                    <td><div class="label label-danger">Declined</div></td>
                                @break

                                @case(APPROVED)
                                    <td><div class="label label-success">Approved</div></td>
                                @break

                            @endswitch
                  </tr>

                  <tr>
                    <td> <a href="{{ route('provider.hosts.edit',$host->id) }}" class="btn btn-primary">Edit</a></td>

                    <td>
                      <a href="{{ route('provider.hosts.delete',$host->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                      </td>
                  </tr>                 
                  
                  </table>
            </div>
          </div>

        </div>

  <!-- /.container-fluid -->
@endsection