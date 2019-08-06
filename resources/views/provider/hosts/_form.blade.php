<!-- Page Heading -->
          <div class="row">
                        <div class="col-md-5">
                             <h1 class="h3 mb-2 text-gray-800">Host Details</h1>
          <p class="mb-4">You can enter host data here:</p>
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
                
                <form action="{{ route('provider.hosts.save') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group">
                            

                            <input type="hidden" name="id" class="form-control" @if($host!=NULL)value="{{ $host->id }}"@endif >

                        </div>
                        
                        <div class="form-group">
                            
                            <label class="host_name">Host Name *</label>
 
                            <input type="text" name="host_name" class="form-control " @if($host!=NULL)value="{{ $host->host_name }}"@endif placeholder="Host Name" required>

                        </div>

                        <div class="form-group">
                            
                            <label class="host_type">Host Type *</label>

                            <select name="host_type" required>
                                <option value="Driveway" @if($host!=NULL){{ $host->host_type === 'Driveway' ? 'selected' : '' }}@endif>Driveway</option>
                                <option value="Garage" @if($host!=NULL) {{ $host->host_type === 'Garage' ? 'selected' : '' }}@endif>Garage</option>
                                <option value="Carpark" @if($host!=NULL) {{ $host->host_type === 'Carpark' ? 'selected' : '' }}@endif>Carpark</option>
                            </select>

                        </div>

                        <div class="form-group">
                            
                            <label class="description">Description *</label>

                            <input type="text" name="description" class="form-control" @if($host!=NULL)value="{{ $host->description }}"@endif placeholder="description" required>

                        </div>
                        <div class="form-group">
                             @if($host!=NULL) <img src="{{ $host->picture }}" style="width: 200px;height: 200px"> @endif

                        </div>

                        <div class="form-group">
                            
                            <label class="picture">Picture</label>

                             <input type="file" name="picture" class="form-control" @if($host!=NULL)value="{{ $host->picture }}"@endif>

                        </div>


                        <div class="form-group">
                            
                            <label class="service_location">Location *</label>

                            <select name="service_location" required>
                                    @foreach($service_locations as $service_location)
                                        
                                       <option @if($host!=NULL)
                                                    {{ $host->service_location_id ===  $service_location->id ? 'selected' : '' }}     @endif >{{ $service_location->name}}
                                            </option>

                                    @endforeach
                            </select>

                        </div>
                        
                        <div class="form-group">
                            
                            <label class="total_spaces">Total Spaces *</label>

                            <input type="text" name="total_spaces" class="form-control" @if($host!=NULL)value="{{ $host->total_spaces }}"@endif placeholder="Total Spaces" required>

                        </div>

                        <div class="form-group">
                            
                            <label class="full_address">Full Address *</label>

                            <input type="text" name="full_address" class="form-control" @if($host!=NULL)value="{{ $host->full_address }}"@endif placeholder="Full Address" required>

                        </div>


                         <div class="form-group">
                            
                            <label class="per_hour">Per Hour *</label>

                            <input type="text" name="per_hour" class="form-control" @if($host!=NULL)value="{{ $host->per_hour }}"@endif placeholder="Per Hour" required>

                        </div>


                        <input type="submit" name="Submit" class="btn btn-primary">

                    </form>

            </div>
          </div>