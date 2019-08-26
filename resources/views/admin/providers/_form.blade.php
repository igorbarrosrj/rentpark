
 <div class="row">
    <!-- column -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ tr('provider_details') }}</h4>

                    <form action="{{ route('admin.providers.save') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group">
                            

                            <input type="hidden" name="id" class="form-control" @if($provider!=NULL)value="{{ $provider->id }}"@endif >

                        </div>

                        <div class="row">
                        
                             <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="name">{{ tr('name') }} *</label>

                                <input type="text" name="name" class="form-control" @if($provider!=NULL)value="{{ $provider->name }}" @else value="{{ old('name') }}" @endif placeholder="{{ tr('name') }}" required>

                            </div>
                            
                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="email">{{ tr('email_address') }} *</label>

                                <input type="text" name="email" class="form-control" @if($provider!=NULL)value="{{ $provider->email }}" @else value="{{ old('email') }}" @endif placeholder="{{ tr('email_address') }}" required>
                                
                            </div>
                        </div>
                        
                       

                         @if($provider==NULL) 

                         <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="password">{{ tr('password') }} *</label>

                                <input type="password" name="password" class="form-control" placeholder="{{ tr('password') }}"  value="{{ old('password') }}" required>
                                
                            </div>

                             <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="cpassword">{{ tr('confirm_password') }} *</label>

                                <input type="password" name="password_confirmation" class="form-control" placeholder="{{ tr('confirm_password') }}" value="{{ old('password_confirmation') }}" required>
                                
                            </div>

                         </div>
                            
                        @endif

                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="description">{{ tr('description') }} *</label>

                                <input type="text" name="description" class="form-control" @if($provider!=NULL)value="{{ $provider->description }}" @else value="{{ old('description') }}" @endif placeholder="{{ tr('description') }}" required>

                            </div>

                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="mobile">{{ tr('mobile_number') }} *</label>

                                <input type="number" name="mobile" class="form-control" @if($provider!=NULL)value="{{ $provider->mobile }}" @else value="{{ old('mobile') }}" @endif placeholder="{{ tr('mobile_number') }}" required>

                            </div>
                        </div>
                        

                        <div class="form-group">
                             @if($provider!=NULL) <img src="{{ $provider->picture }}" id="preview" style="width: 200px;height: 200px"> @endif

                        </div>

                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="picture">{{ tr('picture') }}</label>

                                 <input type="file" onchange="readURL(this);"  name="picture" class="form-control" @if($provider!=NULL)value="{{ $provider->picture }}"@endif accept="image/*">

                            </div>
                        </div>
                        
                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="work">{{ tr('work') }} </label>

                                <input type="text" name="work" class="form-control" @if($provider!=NULL)value="{{ $provider->work }}" @else value="{{ old('work') }}" @endif placeholder="{{ tr('work') }}">

                            </div>

                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="school">{{ tr('school') }} </label>

                                <input type="text" name="school" class="form-control" @if($provider!=NULL)value="{{ $provider->school }}" @else value="{{ old('school') }}" @endif placeholder="{{ tr('school') }}">

                            </div>
                        </div>
                        
                        <div class="row"> 

                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="mobile">{{ tr('languages') }} ({{ tr('seperate_by_comma') }}[,])</label>

                                <textarea name="languages" class="form-control"> @if($provider!=NULL){{$provider->languages }}@else{{ old('languages') }} @endif</textarea> 

                            </div>

                        </div>

                        <input type="submit" name="Submit" value="{{ tr('submit') }}" class="btn btn-primary">

                    </form>
              </div>                                
            </div>                          
        </div>
    </div>