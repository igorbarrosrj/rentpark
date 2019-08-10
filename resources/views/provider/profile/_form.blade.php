<!-- Page Heading -->
          <div class="row">
                        <div class="col-md-5">
                             <h1 class="h3 mb-2 text-gray-800">Provider Profile</h1>
          <p class="mb-4">Your Profile information can update here:</p>
                        </div>
                        <div class="col-md-7">
                            <a href="{{ route('provider.profile.view') }}"  class="btn btn-primary float-right hidden-sm-down">Go Back</a>
                        </div>
                    </div>  
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Update Profile</h6>
            </div>
            <div class="card-body">
                
                <form action="{{ route('provider.profile.save') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group">
                            

                            <input type="hidden" name="id" class="form-control" value="{{ $provider_details->id }}" >

                        </div>

                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="name">Name *</label>
     
                                <input type="text" name="name" class="form-control" value="{{ $provider_details->name }}" placeholder="Name" required>

                            </div>

                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="email">Email *</label>
     
                                <input type="text" name="email" class="form-control" value="{{ $provider_details->email }}" placeholder="Email" required>

                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="mobile">Mobile *</label>

                                <input type="number" name="mobile" class="form-control" value="{{ $provider_details->mobile }}" placeholder="Mobile" required>

                            </div>

                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="description">Description *</label>

                                <input type="text" name="description" class="form-control" value="{{ $provider_details->description }}" placeholder="Description" required>

                            </div>
                        </div>

                        <div class="form-group">
                              <img src="{{ $provider_details->picture }}" id="preview" style="width: 200px;height: 200px"> 

                        </div>

                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="picture">Picture</label>

                                 <input type="file" name="picture" onchange="readURL(this);"  class="form-control" value="{{ $provider_details->picture }}" accept="image/*">

                            </div>
                        </div>
                        
                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="work">Work </label>

                                <input type="text" name="work" class="form-control" value="{{ $provider_details->work }}" placeholder="Work" >

                            </div>
                            
                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="school">School </label>

                                <input type="text" name="school" class="form-control" value="{{ $provider_details->school }}" placeholder="School">

                            </div>

                        </div>

                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="languages">Languages *</label>

                                <input type="text" name="languages" class="form-control" value="{{ $provider_details->languages }}" placeholder="Languages" required>

                            </div>

                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="gender">Gender</label>

                                <select name="gender" class="form-control">
                                    <option  @if($provider_details!=NULL){{ $provider_details->gender === 'male' ? 'selected' : '' }}@endif>Male</option>
                                    <option @if($provider_details!=NULL) {{ $provider_details->gender === 'female' ? 'selected' : '' }}@endif>Female</option>
                                    <option  @if($provider_details!=NULL) {{ $provider_details->gender === 'others' ? 'selected' : '' }}@endif>Others</option>
                                </select>

                            </div>
                        </div>

                        <input type="submit" name="Submit" class="btn btn-primary">

                    </form>

            </div>
          </div>