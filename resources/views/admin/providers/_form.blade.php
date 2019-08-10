
 <div class="row">
    <!-- column -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Provider Details</h4>

                    <form action="{{ route('admin.providers.save') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group">
                            

                            <input type="hidden" name="id" class="form-control" @if($provider!=NULL)value="{{ $provider->id }}"@endif >

                        </div>

                        <div class="row">
                        
                             <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="name">Name *</label>

                                <input type="text" name="name" class="form-control" @if($provider!=NULL)value="{{ $provider->name }}" @else value="{{ old('name') }}" @endif placeholder="Name" required>

                            </div>
                            
                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="email">Email Address *</label>

                                <input type="text" name="email" class="form-control" @if($provider!=NULL)value="{{ $provider->email }}" @else value="{{ old('email') }}" @endif placeholder="Email Address" required>
                                
                            </div>
                        </div>
                        
                       

                         @if($provider==NULL) 

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
                            
                                <label class="description">Description *</label>

                                <input type="text" name="description" class="form-control" @if($provider!=NULL)value="{{ $provider->description }}" @else value="{{ old('description') }}" @endif placeholder="description" required>

                            </div>

                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="mobile">Mobile Number *</label>

                                <input type="number" name="mobile" class="form-control" @if($provider!=NULL)value="{{ $provider->mobile }}" @else value="{{ old('mobile') }}" @endif placeholder="Mobile Number" required>

                            </div>
                        </div>
                        

                        <div class="form-group">
                             @if($provider!=NULL) <img src="{{ $provider->picture }}" id="preview" style="width: 200px;height: 200px"> @endif

                        </div>

                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="picture">Picture</label>

                                 <input type="file" onchange="readURL(this);"  name="picture" class="form-control" @if($provider!=NULL)value="{{ $provider->picture }}"@endif accept="image/*">

                            </div>
                        </div>
                        
                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="work">Work </label>

                                <input type="text" name="work" class="form-control" @if($provider!=NULL)value="{{ $provider->work }}" @else value="{{ old('work') }}" @endif placeholder="Work">

                            </div>

                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="school">School </label>

                                <input type="text" name="school" class="form-control" @if($provider!=NULL)value="{{ $provider->school }}" @else value="{{ old('school') }}" @endif placeholder="School">

                            </div>
                        </div>
                        
                        <div class="row"> 

                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="mobile">Languages (Seperate by comma[,])</label>

                                <textarea name="languages" class="form-control"> @if($provider!=NULL){{$provider->languages }}@else{{ old('languages') }} @endif</textarea> 

                            </div>

                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="gender">Gender</label>

                                <select name="gender" class="form-control">
                                    <option value="Male" @if($provider!=NULL){{ $provider->gender === 'Male' ? 'selected' : '' }}@endif>Male</option>
                                    <option value="Female" @if($provider!=NULL) {{ $provider->gender === 'Female' ? 'selected' : '' }}@endif>Female</option>
                                    <option value="Others" @if($provider!=NULL) {{ $provider->gender === 'Others' ? 'selected' : '' }}@endif>Others</option>
                                </select>

                            </div>
                        </div>

                        <input type="submit" name="Submit" class="btn btn-primary">

                    </form>
              </div>                                
            </div>                          
        </div>
    </div>