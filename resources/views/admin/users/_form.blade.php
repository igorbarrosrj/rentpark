
 <div class="well">
                        
            <div class="row">

                <div class="col-sm-12 col-md-12">

                    <form action="{{ route('admin.users.save') }}" method="post">

                        {{ csrf_field() }}

                        <div class="form-group">
                            

                            <input type="hidden" name="id" class="form-control" @if($user!=NULL)value="{{ $user->id }}"@endif >

                        </div>
                        
                        <div class="form-group">
                            
                            <label class="name">Name</label>

                            <input type="text" name="name" class="form-control" @if($user!=NULL)value="{{ $user->name }}"@endif placeholder="Name">

                        </div>
                        
                        <div class="form-group">
                            
                            <label class="email">Email Address</label>

                            <input type="text" name="email" class="form-control" @if($user!=NULL)value="{{ $user->email }}"@endif placeholder="Email Address">
                            
                        </div>

                         @if($user==NULL) 
                            <div class="form-group">
                                
                                <label class="password">Password</label>

                                <input type="password" name="password" class="form-control" placeholder="Password">
                                
                            </div>

                             <div class="form-group">
                                
                                <label class="cpassword">Confirm Password</label>

                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                                
                            </div>
                        @endif


                        <div class="form-group">
                            
                            <label class="description">Description</label>

                            <input type="text" name="description" class="form-control" @if($user!=NULL)value="{{ $user->description }}"@endif placeholder="description">

                        </div>

                        <div class="form-group">
                            
                            <label class="mobile">Mobile Number</label>

                            <input type="text" name="mobile" class="form-control" @if($user!=NULL)value="{{ $user->mobile }}"@endif placeholder="Mobile Number">

                        </div>

                        <div class="form-group">
                            
                            <label class="gender">Gender</label>

                            <select name="gender">
                                <option value="male" @if($user!=NULL){{ $user->gender === 'male' ? 'selected' : '' }}@endif>Male</option>
                                <option value="female" @if($user!=NULL) {{ $user->gender === 'female' ? 'selected' : '' }}@endif>Female</option>
                                <option value="others" @if($user!=NULL) {{ $user->gender === 'others' ? 'selected' : '' }}@endif>Others</option>
                            </select>

                        </div>

                        <input type="submit" name="Submit" class="btn btn-primary">

                    </form>
              </div>                                
            </div>                          
        </div>