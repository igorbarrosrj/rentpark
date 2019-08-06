@extends('layouts.provider')

@section('content')

	<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Hosts Index</h1>
          <p class="mb-4">It shows all hosts which you entered</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">List Hosts</h6>
            </div>
            @php  $sno = 0; @endphp

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>SNo</th>
                        <th>Host Name</th>
                        <th>Host Type</th>
                        <th>Location</th>
                        <th>Total Spaces</th>
                        <th>Per Hour</th>
                        <th>Updated At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                
                    @if(count($hosts)>0)
              @foreach($hosts as $host)
                <tr>
                  <td>{{ ++$sno }}</td>
                  <td><a href="{{ route('provider.hosts.view',$host->id) }}">{{ $host->host_name }}</a></td>
                  <td>{{ $host->host_type }}</td>
                  <td>
                    @if($host->service_location()->first()!=NULL)
                      {{ $host->service_location()->first()->name }}
                    @else
                      No Location Found
                    @endif
                  </td>
                  <td>{{ $host->total_spaces }}</td>
                  <td>{{ $host->per_hour }}</td>
                  <td>{{ $host->updated_at }}</td>
                   @switch($host->status)

                                                @case(DECLINED)
                                                    <td><div class="label label-danger">Declined</div></td>
                                                @break

                                                @case(APPROVED)
                                                    <td><div class="label label-success">Approved</div></td>
                                                @break

                                            @endswitch
                  <td>
                    <div class="dropdown">
                                            <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Action
                                            <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ route('provider.hosts.view',$host->id) }}" class="dropdown-item" >View</a></li>
                                                <li><a href="{{ route('provider.hosts.edit',$host->id) }}" class="dropdown-item">Edit</a></li>
                                                <li><a href="{{ route('provider.hosts.delete',$host->id) }}" class="dropdown-item" onclick="return confirm('Are you sure want to delete host {{ $host->host_name }}?')" >Delete</a></li>
                                                <div class="dropdown-divider"></div>
                                                      
                                            </ul>
                                         </div> 
                  </td>               
                </tr>
              @endforeach
            @else
                    <tr><td colspan=5><h3>No Hosts found</h3></td></tr>
                @endif
                      
            </table>

              {{$hosts->links()}}
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
@endsection