<div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('admin.settings.save') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="site_name">Site Name *</label>
     
                                <input type="text" name="site_name" class="form-control" value="{{ Setting::get('site_name') }}" placeholder="Site Name" required>

                            </div>

                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="currency">Currency *</label>
     
                                <input type="text" name="currency" class="form-control" value="{{ Setting::get('currency') }}" placeholder="Currency" required>

                            </div>

                        </div>
                        
                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">

                               <img src="{{ setting()->get('favicon')}}" style="width: 200px;height: 200px"> 
                            </div>

                            <div class="form-group col-md-6 col-lg-6">

                               <img src="{{ Setting::get(
                                    'site_logo')}}" style="width: 200px;height: 200px"> 
                            </div>


                        </div>

                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="favicon">Favicon *</label><br>

                                <span>Only .png images</span>

                                 <input type="file" name="favicon" class="form-control" >

                            </div>

                            

                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="site_logo">Site Logo *</label><br>

                                <span>Only .png images</span>

                                 <input type="file" name="site_logo" class="form-control" >

                            </div>


                        </div>
                         
                        
                        <input type="submit" name="Submit" class="btn btn-primary">                       

                    </form>
              </div>                                
            </div>                          
        </div>