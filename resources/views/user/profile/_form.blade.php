<!-- Page Heading -->
          <div class="row">
                        <div class="col-md-5">
                             <h1 class="h3 mb-2 text-gray-800">user Profile</h1>
          <p class="mb-4">Your Profile information can update here:</p>
                        </div>
                        <div class="col-md-7">
                            <a href="{{ route('profile.view') }}"  class="btn btn-primary float-right hidden-sm-down">Go Back</a>
                        </div>
                    </div>  
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Update Profile</h6>
            </div>
            <div class="card-body">
                
                <form action="{{ route('profile.save') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group">
                            

                            <input type="hidden" name="id" class="form-control" value="{{ $user->id }}" >

                        </div>
                        
                        <div class="form-group">
                            
                            <label class="name">Name *</label>
 
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" placeholder="Name" required>

                        </div>

                        <div class="form-group">
                            
                            <label class="email">Email *</label>
 
                            <input type="text" name="email" class="form-control" value="{{ $user->email }}" placeholder="Email" required>

                        </div>


                        <div class="form-group">
                            
                            <label class="description">Description *</label>

                            <input type="text" name="description" class="form-control" value="{{ $user->description }}" placeholder="Description" required>

                        </div>

                        <div class="form-group">
                            
                            <label class="mobile">Mobile *</label>

                            <input type="text" name="mobile" class="form-control" value="{{ $user->mobile }}" placeholder="Mobile" required>

                        </div>

                        <div class="form-group">
                              <img src="{{ $user->picture }}" style="width: 200px;height: 200px"> 

                        </div>

                        <div class="form-group">
                            
                            <label class="picture">Picture</label>

                             <input type="file" name="picture" class="form-control" value="{{ $user->picture }}">

                        </div>


                        <div class="form-group">
                            


                        <div class="form-group">
                            
                            <label class="gender">Gender</label>

                            <select name="gender">
                                <option  @if($user!=NULL){{ $user->gender === 'male' ? 'selected' : '' }}@endif>Male</option>
                                <option @if($user!=NULL) {{ $user->gender === 'female' ? 'selected' : '' }}@endif>Female</option>
                                <option  @if($user!=NULL) {{ $user->gender === 'others' ? 'selected' : '' }}@endif>Others</option>
                            </select>

                        </div>


                        <input type="submit" name="Submit" class="btn btn-primary">

                    </form>

            </div>
          </div>