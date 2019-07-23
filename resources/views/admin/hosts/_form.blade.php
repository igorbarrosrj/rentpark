
 <div class="well">
                        
            <div class="row">

                <div class="col-sm-12 col-md-12">

                    <form action="{{ route('admin.hosts.save') }}" method="post">

                        {{ csrf_field() }}

                        <div class="form-group">
                            

                            <input type="hidden" name="id" class="form-control" @if($host!=NULL)value="{{ $host->id }}"@endif >

                        </div>
                        
                        <div class="form-group">
                            
                            <label class="name">Host Name</label>

                            <input type="text" name="host_name" class="form-control" @if($host!=NULL)value="{{ $host->host_name }}"@endif placeholder="Host Name">

                        </div>

                         <div class="form-group">
                            
                            <label class="name">Provider Name</label>

                            <input type="text" name="provider_name" class="form-control" @if($host!=NULL)value="{{ $host->host_name }}"@endif placeholder="Provider Name">

                        </div>

                        <div class="form-group">
                            
                            <label class="host_type">Host Type</label>

                            <select name="host_type">
                                <option value="Driveway" @if($host!=NULL){{ $host->host_type === 'Driveway' ? 'selected' : '' }}@endif>Driveway</option>
                                <option value="Garage" @if($host!=NULL) {{ $host->host_type === 'Garage' ? 'selected' : '' }}@endif>Garage</option>
                                <option value="Carpark" @if($host!=NULL) {{ $host->host_type === 'Carpark' ? 'selected' : '' }}@endif>Carpark</option>
                            </select>

                        </div>

                        <div class="form-group">
                            
                            <label class="description">Description</label>

                            <input type="text" name="description" class="form-control" @if($host!=NULL)value="{{ $host->description }}"@endif placeholder="description">

                        </div>


                        <div class="form-group">
                            
                            <label class="service_location">Service Location</label>

                            <input type="text" name="service_location" class="form-control" @if($host!=NULL)value="{{ $host->host_name }}"@endif placeholder="Service Location">

                        </div>

                        <div class="form-group">
                            
                            <label class="total_spaces">Total Spaces</label>

                            <input type="text" name="total_spaces" class="form-control" @if($host!=NULL)value="{{ $host->total_spaces }}"@endif placeholder="Total Spaces">

                        </div>

                        <div class="form-group">
                            
                            <label class="full_address">Full Address</label>

                            <input type="text" name="full_address" class="form-control" @if($host!=NULL)value="{{ $host->full_address }}"@endif placeholder="Full Address">

                        </div>


                         <div class="form-group">
                            
                            <label class="per_hour">Per Hour</label>

                            <input type="text" name="per_hour" class="form-control" @if($host!=NULL)value="{{ $host->per_hour }}"@endif placeholder="Per Hour">

                        </div>

                        <input type="submit" name="Submit" class="btn btn-primary">

                    </form>
              </div>                                
            </div>                          
        </div>