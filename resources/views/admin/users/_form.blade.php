
 <div class="row">
    <!-- column -->
    <div class="col-12">
        
        <div class="card">
        
            <div class="card-body">
                
                <h4 class="card-title">User Details</h4>

                <form action="{{ route('admin.users.save') }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <div class="form-group">
                        
                        <input type="hidden" name="id" class="form-control" @if($user_details != NULL) value="{{ $user_details->id }}" @endif >

                    </div>
                    
                    <div class="row">
                        
                        <div class="form-group col-md-6 col-lg-6">
                        
                            <label class="name">Name *</label>

                            <input type="text" name="name" class="form-control" @if($user_details != NULL) value="{{ $user_details->name }}" @else value="{{ old('name') }}" @endif placeholder="Name" required>

                        </div>
                        
                        <div class="form-group col-md-6 col-lg-6">
                            
                            <label class="email">Email Address *</label>

                            <input type="text" name="email" class="form-control" @if($user_details != NULL)value="{{ $user_details->email }}" @else value="{{ old('email') }}" @endif placeholder="Email Address" required>
                            
                        </div>

                    </div>
                    
                    @if($user_details == NULL) 

                    <div class="row">
                         
                        <div class="form-group col-md-6 col-lg-6">
                            
                            <label class="password">Password *</label>

                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                            
                        </div>

                        <div class="form-group col-md-6 col-lg-6">
                            
                            <label class="cpassword">Confirm Password *</label>

                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                            
                        </div>
                    
                    </div>

                    @endif

                    <div class="row">

                        <div class="form-group col-md-6 col-lg-6">
                        
                            <label class="mobile">Mobile Number *</label>

                            <input type="number" name="mobile" class="form-control" @if($user_details!=NULL)value="{{ $user_details->mobile }}" @else value="{{ old('mobile') }}" @endif placeholder="Mobile Number" required>

                        </div>

                        <div class="form-group col-md-6 col-lg-6">
                            
                            <label class="description">Description *</label>

                            <input type="text" name="description" class="form-control" @if($user_details!=NULL)value="{{ $user_details->description }}" @else value="{{ old('description') }}" @endif placeholder="description" required>

                        </div>
             
                    </div>
                
                    <div class="row">
                        
                        <div class="form-group col-md-6 col-lg-6">
                        
                            <label class="picture">Picture</label>

                            <input type="file" onchange="readURL(this);"  name="picture" class="form-control" @if($user_details != NULL) value="{{ $user_details->picture }}" @endif accept="image/*">

                        </div>

                        <div class="form-group col-md-6 col-lg-6">
                        
                            <label class="gender">Gender</label>

                            <select name="gender" class="form-control">
                                <option value="male" @if($user_details != NULL){{ $user_details->gender === 'male' ? 'selected' : '' }} @endif>Male</option>
                                <option value="female" @if($user_details != NULL) {{ $user_details->gender === 'female' ? 'selected' : '' }} @endif>Female</option>
                                <option value="others" @if($user_details != NULL) {{ $user_details->gender === 'others' ? 'selected' : '' }} @endif>Others</option>
                            </select>

                        </div>
                        
                    </div>

                    <div class="form-group">
                        
                        @if($user_details != NULL) <img src="{{ $user_details->picture }}" id="preview" style="width: 200px;height: 200px"> @endif

                    </div>
                
                    <input type="submit" name="Submit" title="submit" value="Submit" class="btn btn-primary">

                </form>
            
            </div>                                
    
        </div>                          
    
    </div>

</div>