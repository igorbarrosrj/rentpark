<div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('admin.settings.save') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group">
                            
                            <label class="site_name">Site Name *</label>
 
                            <input type="text" name="site_name" class="form-control" value="{{ Setting::get('site_name') }}" placeholder="Site Name" required>

                        </div>

                         <div class="form-group">

                           <img src="/uploads/admin/{{ Setting::get(
                                'favicon')}}" style="width: 200px;height: 200px"> 
                        </div>

                        <div class="form-group">
                            
                            <label class="favicon">Favicon</label><br>

                            <span>Only .png images</span>

                             <input type="file" name="favicon" class="form-control" >

                        </div>

                        <div class="form-group">

                           <img src="/uploads/admin/{{ Setting::get(
                                'site_logo')}}" style="width: 200px;height: 200px"> 
                        </div>

                        <div class="form-group">
                            
                            <label class="site_logo">Site Logo</label><br>

                            <span>Only .png images</span>

                             <input type="file" name="site_logo" class="form-control" >

                        </div>

                        <input type="submit" name="Submit" class="btn btn-primary">                       

                    </form>
              </div>                                
            </div>                          
        </div>