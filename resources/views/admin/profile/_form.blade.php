 
 <div class="row">
    <!-- column -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Admin Profile</h4>

                    <form action="{{ route('admin.profile.save')}}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group">
                            

                            <input type="hidden" name="id" class="form-control" value="{{ $admin->id }}" >

                        </div>
                        
                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="name">Name *</label>

                                <input type="text" name="name" class="form-control" value="{{ $admin->name }}" placeholder="Name" required>

                            </div>
                            
                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="email">Email Address *</label>

                                <input type="text" name="email" class="form-control" value="{{ $admin->email }}" placeholder="Email Address" required>
                                
                            </div>

                        </div>
                        
                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="mobile">Mobile Number *</label>

                                <input type="tel" name="mobile" class="form-control" value="{{ $admin->mobile }}" placeholder="Mobile Number" required>

                            </div>


                             <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="description">About *</label>

                                <input type="text" name="about" class="form-control" value="{{ $admin->about }}" placeholder="About" required>

                            </div>

                        </div>


                        <div class="row">
                            
                             <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="picture">Picture</label>

                                 <input type="file" name="picture" onchange="readURL(this);" class="form-control" value="{{ $admin->picture }}" accept="image/*">

                            </div>

                        </div>

                        <div class="form-group">
                             <img  id="preview" src="{{ $admin->picture }}" style="width: 200px;height: 200px">

                        </div>

                       

                        <input type="submit" name="Submit" class="btn btn-primary">

                    </form>
              </div>                                
            </div>                          
        </div>
    </div>