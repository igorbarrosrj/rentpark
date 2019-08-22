
 <div class="row">
    <!-- column -->
    <div class="col-12">
        
        <div class="card">
        
            <div class="card-body">
                
                <h4 class="card-title">{{ tr('user_details') }}</h4>

                <form action="{{ route('admin.users.save') }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <div class="form-group">
                        
                        <input type="hidden" name="id" class="form-control" @if($user_details != NULL) value="{{ $user_details->id }}" @endif >

                    </div>
                    
                    <div class="row">
                        
                        <div class="form-group col-md-6 col-lg-6">
                        
                            <label class="name">{{ tr('name') }} *</label>

                            <input type="text" name="name" class="form-control" @if($user_details != NULL) value="{{ $user_details->name }}" @else value="{{ old('name') }}" @endif placeholder="{{ tr('name') }}" required>

                        </div>
                        
                        <div class="form-group col-md-6 col-lg-6">
                            
                            <label class="email">{{ tr('email_address') }} *</label>

                            <input type="text" name="email" class="form-control" @if($user_details != NULL)value="{{ $user_details->email }}" @else value="{{ old('email') }}" @endif placeholder="{{ tr('email_address') }}" required>
                            
                        </div>

                    </div>
                    
                    @if($user_details == NULL) 

                    <div class="row">
                         
                        <div class="form-group col-md-6 col-lg-6">
                            
                            <label class="password">{{ tr('password') }} *</label>

                            <input type="password" name="password" class="form-control" placeholder="{{ tr('password') }}" required>
                            
                        </div>

                        <div class="form-group col-md-6 col-lg-6">
                            
                            <label class="cpassword">{{ tr('confirm_password') }} *</label>

                            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ tr('confirm_password') }}" required>
                            
                        </div>
                    
                    </div>

                    @endif

                    <div class="row">

                        <div class="form-group col-md-6 col-lg-6">
                        
                            <label class="mobile">{{ tr('mobile_number') }} *</label>

                            <input type="number" name="mobile" class="form-control" @if($user_details!=NULL)value="{{ $user_details->mobile }}" @else value="{{ old('mobile') }}" @endif placeholder="{{ tr('mobile_number') }}" required>

                        </div>

                        <div class="form-group col-md-6 col-lg-6">
                            
                            <label class="description">{{ tr('description') }} *</label>

                            <input type="text" name="description" class="form-control" @if($user_details!=NULL)value="{{ $user_details->description }}" @else value="{{ old('description') }}" @endif placeholder="{{ tr('description') }}" required>

                        </div>
             
                    </div>
                
                    <div class="row">
                        
                        <div class="form-group col-md-6 col-lg-6">
                        
                            <label class="picture">{{ tr('picture') }}</label>

                            <input type="file" onchange="readURL(this);"  name="picture" class="form-control" @if($user_details != NULL) value="{{ $user_details->picture }}" @endif accept="image/*">

                        </div>

                        <div class="form-group col-md-6 col-lg-6">
                        
                            <label class="gender">{{ tr('gender') }}</label>

                            <select name="gender" class="form-control">
                                <option value="male" @if($user_details != NULL){{ $user_details->gender === 'male' ? 'selected' : '' }} @endif>{{ tr('male') }}</option>
                                <option value="female" @if($user_details != NULL) {{ $user_details->gender === 'female' ? 'selected' : '' }} @endif>{{ tr('female') }}</option>
                                <option value="others" @if($user_details != NULL) {{ $user_details->gender === 'others' ? 'selected' : '' }} @endif>{{ tr('others') }}</option>
                            </select>

                        </div>
                        
                    </div>

                    <div class="form-group">
                        
                        @if($user_details != NULL) <img src="{{ $user_details->picture }}" id="preview" style="width: 200px;height: 200px"> @endif

                    </div>
                
                    <input type="submit" name="Submit" title="submit" value="{{ tr('submit') }}" class="btn btn-primary">

                </form>
            
            </div>                                
    
        </div>                          
    
    </div>

</div>