
 <div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Host Detail</h4>

                    <form action="{{ route('admin.hosts.save') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group">
                            

                            <input type="hidden" name="id" class="form-control" @if($host!=NULL)value="{{ $host->id }}"@endif >

                        </div>
                        
                        <div class="form-group">
                            
                            <label class="host_name">Host Name *</label>
 
                            <input type="text" name="host_name" class="form-control" @if($host!=NULL)value="{{ $host->host_name }}"@endif placeholder="Host Name" required>

                        </div>

                         <div class="form-group">
                            
                            <label class="provider_name">Provider Name *</label>

                            <select name="provider_name" required>

                                    @foreach($providers as $provider)
                                        
                                       <option @if($host!=NULL)
                                                    {{ $host->provider_id ===  $provider->id ? 'selected' : '' }}     @endif >{{ $provider->name}}
                                            </option>

                                    @endforeach

                            </select>


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
                            
                            <label class="service_location">Service Location *</label>

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
        </div>
    </div>