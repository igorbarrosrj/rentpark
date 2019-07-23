
 <div class="well">
                        
            <div class="row">

                <div class="col-sm-12 col-md-12">

                    <form action="{{ route('admin.service_locations.save') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group">
                            

                            <input type="hidden" name="id" class="form-control" @if($service_location!=NULL)value="{{ $service_location->id }}"@endif >

                        </div>
                        
                        <div class="form-group">
                            
                            <label class="name">Name *</label>

                            <input type="text" name="name" class="form-control" @if($service_location!=NULL)value="{{ $service_location->name }}"@endif placeholder="Name" required>

                            @if($service_location!=NULL) <img src="/uploads/admin/{{ $service_location->picture }}" style="width: 200px;height: 200px"> @endif

                        </div>

                        <div class="form-group">
                            
                            <label class="picture">Picture</label>

                            <input type="file" name="picture" class="form-control" @if($service_location!=NULL)value="{{ $service_location->picture }}"@endif>

                        </div>

                        <div class="form-group">
                            
                            <label class="full_address">Full Address *</label>

                            <textarea name="full_address" class="form-control" required> @if($service_location!=NULL){{$service_location->full_address }}@endif</textarea> 

                        </div>

                        <div class="form-group">
                            
                            <label class="description">Description *</label>

                            <input type="text" name="description" class="form-control" @if($service_location!=NULL)value="{{ $service_location->description }}"@endif placeholder="description" required>

                        </div>

                        <input type="submit" name="Submit" class="btn btn-primary">

                    </form>
              </div>                                
            </div>                          
        </div>