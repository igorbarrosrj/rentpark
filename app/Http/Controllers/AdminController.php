<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Booking;
use App\Host;
use App\Provider;
use App\ServiceLocation;
use App\User;
use DB, Auth, Hash, Validator, Exception;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Setting;

use \Mail;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

        $this->middleware('auth:admin');
    }

    /**
     * @method index()
     * 
     * @uses used to display the index page of dashboard
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return view of dashboard
     *
     */
    public function index()
    { 

        return view('admin.dashboard');
    }



    /**
    *
    *
    * User Management in Admin Panel
    *
    */
    
    /**
     * @method users_index()
     * 
     * @uses used to display the list of users
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return view of users list
     *
     */
    public function users_index() {

        $users = User::orderBy('id')->paginate(10);

        if(!$users) {
            
            return redirect()->route('admin.users.index')->with('error',"No User found");
        }

        return view('admin.users.index')->with('users',$users);
        

    }


    /**
     * @method users_create()
     * 
     * @uses used to create the profile of User
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return view of Create User Page
     *
     */

    public function users_create() {

        $user = NULL;
        return view('admin.users.create')->with('user',$user);

    }


    /**
     * @method users_view()
     * 
     * @uses used to display the view page
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param id
     *
     * @return view of particular user
     *
     */
    public function users_view($id) {

        $user = User::find($id);

        if(!$user) {
            
            return redirect()->route('admin.users.index')->with('error',"No User found");
        }

        return view('admin.users.view')->with('user',$user);
        
    }


   /**
     * @method users_save()
     * 
     * @uses used to save the data of user
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param Request of all data
     *
     * @return view of users index
     *
     */
    public function users_save(Request $request) {


        $this->validate($request,[

            'name' => 'required|min:3|max:50',

            'email' => 'required|email',

            'description' => 'required| min:5',

            'mobile' => 'regex:/[6-9][0-9]{9}/',

        ]);


        if($request->id == NULL){
        
            $this->validate($request,[

                'email' => 'required|unique:users,email|email',

                'password' => 'required|confirmed|min:6',

            ]);

            //Create User

            $user = New User;

            $user->unique_id = uniqid(base64_encode(str_random(60)));

            $user->password = \Hash::make($request->password);
        }
        else {
            $user = User::find($request->id);

            
        }


        $user->name = $request->name;        

        $user->email = $request->email;        

        $user->description = $request->description;

        $user->mobile = $request->mobile;

        $user->gender = $request->gender;

        $user->status = 1;

        $user->save();

        if($request->id == NULL){

            $to_name = $request->name;

            $to_email = $request->email;

            $data = array("name"=> $request->name, "body" => "You account is created ", "username" => $request->email, "password" => $request->password, "link" => route('login'));

            Mail::send('admin.users.mail.index', $data, function($message) use ($to_name, $to_email) {$message->to($to_email, $to_name)->subject("Account Activation");

            $message->from(\Config::get('mail.from.address'),"RentPark");;});

            return redirect()->route('admin.users.index')->with('success','User Saved');

        }
        
      
    }
    /**
     * @method users_edit()
     * 
     * @uses used to display the edit page
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param integer id
     *
     * @return view of edit page
     *
     */

    public function users_edit($id) {
        
        $user = User::find($id);


        if(!$user) {
            
            return redirect()->route('admin.users.index')->with('error',"No User found");
        }

        return view('admin.users.edit')->with('user',$user);

    }


    /**
     * @method users_delete()
     * 
     * @uses used to delete the user
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param integer id
     *
     * @return view of user's index
     *
     */
    public function users_delete($id) {

        $user = User::find($id);

        if(!$user) {
            
            return redirect()->route('admin.users.index')->with('error',"No User found");
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success','User Removed');
        
        
    }

    /**
     * @method users_status()
     * 
     * @uses used to status of the user
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param integer id
     *
     * @return view of user's index
     *
     */
    public function users_status($id) {

        $user = User::find($id);

        if(!$user) {
            
            return redirect()->route('admin.users.index')->with('error',"No User found");
        }

        switch ($user->status) {
            case 0:
                
                $user->status = 1;

                break;

            case 1:
                
                $user->status = 0;

                break;
            
        }
        $user->save();

        return redirect()->back()->with('success','Status Updated !');
        
        
    }


    /**
    *
    *
    * Service Location Management in Admin Panel
    *
    */
    
    /**
     * @method locations_index()
     * 
     * @uses used to display the list of service location
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return view of service location list
     *
     */
    public function service_locations_index() {

        $service_locations = ServiceLocation::orderBy('id')->paginate(10);

        if(!$service_locations) {
            
            return redirect()->route('admin.service_locations.index')->with('error',"No Service Location found");
        }

        return view('admin.service_locations.index')->with('service_locations',$service_locations);
        

    }


    /**
     * @method service_locations_create()
     * 
     * @uses used to create the profile of Service Loction
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return view of Create Service Location Page
     *
     */

    public function service_locations_create() {

        $service_location = NULL;

        return view('admin.service_locations.create')->with('service_location',$service_location);

    }


    /**
     * @method service_locations_view()
     * 
     * @uses used to display the view page of Service Location
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param id
     *
     * @return view of particular Service location
     *
     */
    public function service_locations_view($id) {

        $service_location = ServiceLocation::find($id);

        if(!$service_location) {
            
            return redirect()->route('admin.service_locations.index')->with('error',"No Service Location found");
        }

        return view('admin.service_locations.view')->with('service_location',$service_location);
        
    }


   /**
     * @method service_locations_save()
     * 
     * @uses used to save the data of Service Location
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param Request of all data
     *
     * @return view of Service Locations index
     *
     */
    public function service_locations_save(Request $request) {

        $this->validate($request,[

            'name' => 'required|min:3|max:50',

            'full_address' => 'required|min:3|max:200',

            'picture' => 'image|nullable|max:2999|mimes:jpeg,bmp,png,jpg',

            'description' => 'required| min:5',

        ]);

        //Handle File Upload
        if($request->hasFile('picture')){
            //Get file name with extension
            $fileNameWithExt = $request ->file('picture')->getClientOriginalName();

            //dd($fileNameWithExt);

            //Get the file name only
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //Get the file extension only
            $extension = $request->file('picture')->getClientOriginalExtension();

            //Filename to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;

            //Upload Image

            $path = $request->file('picture')->storeAs('/service_locations',$fileNameToStore,'public');


        }else{
            $fileNameToStore = 'noimage.jpg';
        }


        if($request->id == NULL){
        
            //Create Service Location

            $service_location = New ServiceLocation;

            $service_location->unique_id = uniqid(base64_encode(str_random(60)));

            $service_location->picture = $fileNameToStore;

        }
        else {

            $service_location = ServiceLocation::find($request->id);

             if($request->picture != NULL) {

                Storage::disk('public')->delete('/service_locations/'.$service_location->picture);

                $service_location->picture = $fileNameToStore;
            }

        }


        $service_location->name = $request->name;        

        $service_location->full_address = $request->full_address;        

        $service_location->description = $request->description;


        $service_location->save();

        return redirect()->route('admin.service_locations.index')->with('success','Service Location Saved');
    }

    /**
     * @method service_locations_edit()
     * 
     * @uses used to display the edit page
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param integer id
     *
     * @return view of edit page
     *
     */

    public function service_locations_edit($id) {
        
        $service_location = ServiceLocation::find($id);


        if(!$service_location) {
            
            return redirect()->route('admin.service_locations.index')->with('error',"No Service Location found");
        }

        return view('admin.service_locations.edit')->with('service_location',$service_location);

    }


    /**
     * @method service_locations_delete()
     * 
     * @uses used to delete the service location
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param integer id
     *
     * @return view of service location's index
     *
     */
    public function service_locations_delete($id) {

        $service_location = ServiceLocation::find($id);

        if(!$service_location) {
            
            return redirect()->route('admin.service_locations.index')->with('error',"No Service Location found");
        }

        if($service_location->picture != 'noimage.jpg'){


            Storage::disk('public')->delete('/service_locations/'.$service_location->picture);

        }

        $service_location->delete();

        return redirect()->route('admin.service_locations.index')->with('success','Service Location Removed');
        
        
    }

     /**
     * @method service_locations_status()
     * 
     * @uses used to status of the service_location
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param integer id
     *
     * @return view of service_location's index
     *
     */
    public function service_locations_status($id) {

        $service_location = ServiceLocation::find($id);

        if(!$service_location) {
            
            return redirect()->route('admin.service_locations.index')->with('error',"No Host found");
        }

        switch ($service_location->status) {
            case 0:
                
                $service_location->status = 1;

                break;

            case 1:
                
                $service_location->status = 0;

                break;
            
        }
        $service_location->save();

        return redirect()->back()->with('Success','Status updated !');
        
        
    }



    /**
    *
    *
    * Host Management in Admin Panel
    *
    */



    /**
     * @method hosts_index()
     * 
     * @uses used to display the list of hosts
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return view of hosts list
     *
     */
    public function hosts_index() {

        $hosts = Host::orderBy('id')->paginate(10);

        if(!$hosts){

            return redirect()->route('admin.hosts.index')->with('error',"No Host found");
            
        }

        return view('admin.hosts.index')->with('hosts',$hosts);        

    }


    /**
     * @method hosts_create()
     * 
     * @uses used to create the profile of Host
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return view of Create Host Page
     *
     */

    public function hosts_create() {

        $host = NULL;

        $service_locations = ServiceLocation::orderBy('name')->get();

        if(!$service_locations){

            return redirect()->route('admin.hosts.index')->with('error',"No Service Locations found");
            
        }

        $providers = Provider::orderBy('name')->get();

        if(!$providers){

            return redirect()->route('admin.hosts.index')->with('error',"No providers found");
            
        }

        return view('admin.hosts.create')->with(['host' => $host, 'service_locations' => $service_locations, 'providers' => $providers ]);

    }


    /**
     * @method hosts_view()
     * 
     * @uses used to display the view page
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param id
     *
     * @return view of particular host
     *
     */
    public function hosts_view($id) {

        $host = Host::find($id);

        if(!$host){

            return redirect()->route('admin.hosts.index')->with('error',"No Host found");
            
        }
        
        return view('admin.hosts.view')->with('host',$host);
    }


   /**
     * @method hosts_save()
     * 
     * @uses used to save the data of host
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param Request of all data
     *
     * @return view of hosts index
     *
     */
    public function hosts_save(Request $request) {


        $this->validate($request,[

            'host_name' => 'required|min:3|max:50',

            'provider_name' => 'required|min:3|max:50',

            'host_type' => 'required|min:6|max:8',

            'description' => 'required| min:5',

            'picture' => 'image|nullable|max:2999|mimes:jpeg,bmp,png,jpg',

            'service_location' => 'required|min:3|max:50',

            'total_spaces' => 'required|min:1|max:5000|numeric',

            'full_address' => 'required|min:3|max:50',

            'per_hour' => 'required|min:1|max:5000|numeric',

        ]);

        $service_location_id = ServiceLocation::where('name',$request->service_location)->first()->id;

        $provider_id = Provider::where('name',$request->provider_name)->first()->id;


        //Handle File Upload
        if($request->hasFile('picture')){
            //Get file name with extension
            $fileNameWithExt = $request ->file('picture')->getClientOriginalName();

            //dd($fileNameWithExt);

            //Get the file name only
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //Get the file extension only
            $extension = $request->file('picture')->getClientOriginalExtension();

            //Filename to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;

            //Upload Image

            $path = $request->file('picture')->storeAs('/hosts',$fileNameToStore,'public');


        } else {

            $fileNameToStore = 'noimage.jpg';
        }


        if($request->id == NULL){
        

            //Create Host

            $host = New Host;

            $host->unique_id = uniqid(base64_encode(str_random(60)));

            $host->picture = $fileNameToStore;
        }
        else {
            $host = Host::find($request->id);

            if($request->picture != NULL) {

                Storage::disk('public')->delete('/hosts/'.$host->picture);

                $host->picture = $fileNameToStore;
            }
            
        }


        $host->provider_id = $provider_id;        

        $host->host_name = $request->host_name;        

        $host->host_type = $request->host_type;

        $host->description = $request->description;

        $host->service_location_id = $service_location_id;

        $host->total_spaces = $request->total_spaces;        

        $host->full_address = $request->full_address;

        $host->per_hour = $request->per_hour;

        $host->status = 1;

        $host->save();

        return redirect()->route('admin.hosts.index')->with('success','User Saved');
    }

    /**
     * @method hosts_edit()
     * 
     * @uses used to display the edit page
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param integer id
     *
     * @return view of edit page
     *
     */

    public function hosts_edit($id) {
        
        $host = Host::find($id);

        if(!$host){

            return redirect()->route('admin.hosts.index')->with('error',"No Host found");
            
        }

        $service_locations = ServiceLocation::orderBy('name')->get();

        if(!$service_locations){

            return redirect()->route('admin.hosts.index')->with('error',"No Service Locations found");
            
        }

        $providers = Provider::orderBy('name')->get();

        if(!$providers){

            return redirect()->route('admin.hosts.index')->with('error',"No providers found");
            
        }


        return view('admin.hosts.edit')->with(['host' => $host, 'service_locations' => $service_locations, 'providers' => $providers]);
    
    }


    /**
     * @method hosts_delete()
     * 
     * @uses used to delete the user
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param integer id
     *
     * @return view of host's index
     *
     */
    public function hosts_delete($id) {

        $host = Host::find($id);

        if(!$host){

            return redirect()->route('admin.hosts.index')->with('error',"No Host found");
            
        }

         if($host->picture != 'noimage.jpg'){


            Storage::disk('public')->delete('/hosts/'.$host->picture);

        }

        $host->delete();

        return redirect()->route('admin.hosts.index')->with('success','User Removed');
        
    }

    /**
     * @method hosts_status()
     * 
     * @uses used to status of the host
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param integer id
     *
     * @return view of host's index
     *
     */
    public function hosts_status($id) {

        $host = Host::find($id);

        if(!$host) {
            
            return redirect()->route('admin.hosts.index')->with('error',"No Host found");
        }

        switch ($host->status) {
            case 0:
                
                $host->status = 1;

                break;

            case 1:
                
                $host->status = 0;

                break;
            
        }
        $host->save();

        return redirect()->back()->with('Success','Status updated !');
        
        
    }


    /**
    *
    *
    * Booking Management in Admin Panel
    *
    */



    /**
     * @method bookings_index()
     * 
     * @uses used to display the list of booking 
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return view of booking list
     *
     */
    public function bookings_index() {

        $bookings = Booking::orderBy('id')->paginate(10);

        if(!$bookings){

            return redirect()->route('admin.bookings.index')->with('error',"No Booking found");
            
        }

        return view('admin.bookings.index')->with('bookings',$bookings);        

    }


    /**
     * @method bookings_view()
     * 
     * @uses used to display the Booking Details Page
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param id
     *
     * @return view of particular Booking
     *
     */
    public function bookings_view($id) {

        $booking = Booking::find($id);

        if(!$booking){

            return redirect()->route('admin.bookings.index')->with('error',"No Booking found");
            
        }
        
        return view('admin.bookings.view')->with('booking',$booking);
    }

    /**
    *
    * Providers Management
    *
    **/


    /**
     * @method providers_index()
     * 
     * @uses used to list the providers
     *
     * @created BALAJI M
     *
     * @updated
     *
     * @param integer id
     *
     * @return provider's list
     *
     */

    public function providers_index(Request $request) {

        $providers = Provider::orderBy('id')->paginate(5);

        return view('admin.providers.index')->with('providers',$providers);
    }

    /**
     * @method providers_create()
     * 
     * @uses used to create the provider
     *
     * @created BALAJI M
     *
     * @updated
     *
     * @param integer id
     *
     * @return provider's create form
     *
     */

    public function providers_create()
    {
        return view('admin.providers.create');
    }
/**
     * @method providers_save()
     * 
     * @uses used to save the provider's detail in db
     *
     * @created BALAJI M
     *
     * @updated
     *
     * @param integer id
     *
     * @return provider's index page
     *
     */
    public function providers_save(Request $request, $provider_id=null)
    {
        $request->validate([
                
            'name' => 'required|min:3|max:50',

            'email' => 'required|email',
                
            'password' => 'sometimes|required|min:6|confirmed',

            'picture' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);


        $provider = Provider::find($provider_id);

        if($provider_id==null)
        {
            $provider = new Provider;

            $provider->unique_id = rand();

            $provider->password = Hash::make($request->password) ?: "";
        } 

        $provider->name = $request->name?: "";

        $provider->email = $request->email?: "";

        $provider->description = $request->description?: "";

        $provider->mobile = $request->mobile?: "";

        $provider->work = $request->work?: "";

        $provider->school = $request->school?: "";

        $provider->languages = $request->languages?: ""; 

        if($request->hasFile('picture'))

        {   
            $imageName=$provider->picture;

            $image_path = public_path('/uploads/providers/'.$imageName);  

            if(File::exists($image_path)) 
            {
            File::delete($image_path);
            }   

            $image = $request->file('picture');

            $extension = $image->getClientOriginalExtension();

            $filename = rand().".".$extension;

            $image->move(public_path().'/uploads/providers/', $filename);  

            $provider->picture = $filename;
        }

        $provider->save();

        return redirect(route('admin.providers.index'))->with('success','Provider Saved');
       
    }
    /**
     * @method providers_view()
     * 
     * @uses used to show the provider detail
     *
     * @created BALAJI M
     *
     * @updated
     *
     * @param integer id
     *
     * @return provider's detail
     *
     */
    public function providers_view($provider_id) 
    {

        $provider = Provider::find($provider_id);

        return view('admin.providers.view')->with('provider',$provider);
    }
    /**
     * @method providers_edit()
     * 
     * @uses used to edit the provider detail
     *
     * @created BALAJI M
     *
     * @updated
     *
     * @param integer id
     *
     * @return provider's edit form
     *
     */
    public function providers_edit($provider_id) 
    {
        
        $provider = Provider::find($provider_id);

        return view('admin.providers.edit')->with('provider',$provider);

    }
    /**
     * @method providers_delete()
     * 
     * @uses used to delete the provider detail
     *
     * @created BALAJI M
     *
     * @updated
     *
     * @param integer id
     *
     * @return provider's index
     *
     */
    public function providers_delete($provider_id) 
    {

        $provider = Provider::find($provider_id);

        if(!$provider) 
        {
            return "error";
        }

        $provider->delete();

        return redirect(route('admin.providers.index'))->with('success','Provider Removed');
    }

    /**
    *
    *
    * Settings in Admin Panel
    *
    */



    /**
     * @method settingss_index()
     * 
     * @uses used to display the Setting Page 
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return view of settings
     *
     */
    public function settings_index() {

        return view('admin.settings.index');
    }


    public function settings_save(Request $request) {


        $this->validate($request,[

            'site_name' => 'required|min:3|max:50',

            'site_logo' => 'image|nullable|max:2999|mimes:png',

            'favicon' => 'image|nullable|max:2999|mimes:png',

        ]);
        setting();

        //Handle File Upload
        if($request->hasFile('favicon')){


            $image = $request->file('favicon');

            //Filename to store
            $fileNameToStore = asset('/favicon.png');

            //Upload Image

            $image->move(public_path().'/', $fileNameToStore);

            setting(['favicon' => $fileNameToStore])->save();

        } 

         if($request->hasFile('site_logo')){

            $image = $request->file('site_logo');

            //Filename to store
            $fileNameToStore = asset('/logo.png');

            //Upload Image

            $image->move(public_path().'/', $fileNameToStore);

            setting(['site_logo' => $fileNameToStore])->save();

        } 
            
        setting(['site_name' => $request->site_name])->save();


        return redirect()->route('admin.settings.index')->with('success','Settings Saved');
    }

    /**
     * @method admin_profile_save()
     * 
     * @uses used to store the admin detail
     *
     * @created BALAJI M
     *
     * @updated
     *
     * @param integer id
     *
     * @return admin profile view page
     *
     */
    public function admin_profile_save(Request $request, $admin_id)
    {
        $request->validate([
                
            'name' => 'required|min:3|max:50',

            'email' => 'required|email',
                
            'password' => 'sometimes|required|min:6|confirmed',

            'picture' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $admin = Admin::find($admin_id);

        $admin->name = $request->name?: "";
        
        $admin->email = $request->email?: "";

        $admin->about = $request->about?: "";

        $admin->mobile = $request->mobile?: "";

        if($request->hasFile('picture'))

        {   
            $imageName=$admin->picture;

            $image_path = public_path('/uploads/admin/'.$imageName);  

            if(File::exists($image_path)) 
            {
            File::delete($image_path);
            }   

            $image = $request->file('picture');

            $extension = $image->getClientOriginalExtension();

            $filename = rand().".".$extension;

            $image->move(public_path().'/uploads/admin/', $filename);  

            $admin->picture = $filename;
    
        }


        $admin->save();

        return view('admin.profile.view')->with('admin',$admin);
       
    }
    /**
     * @method admin_profile_edit()
     * 
     * @uses used to edit the admin detail
     *
     * @created BALAJI M
     *
     * @updated
     *
     * @param integer id
     *
     * @return admin profile edit form
     *
     */
    public function admin_profile_edit($admin_id) 
    {
        
        $admin = Admin::find($admin_id);

        return view('admin.profile.edit')->with('admin',$admin);

    }
    /**
     * @method admin_profile_view()
     * 
     * @uses used to view the admin detail
     *
     * @created BALAJI M
     *
     * @updated
     *
     * @param integer id
     *
     * @return admin profile view page
     *
     */
    public function admin_profile_view($admin_id)
    {
        $admin = Admin::find($admin_id);

        return view('admin.profile.view')->with('admin',$admin);

    }
    /**
     * @method change_password()
     * 
     * @uses used to view the password change form
     *
     * @created BALAJI M
     *
     * @updated
     *
     * @param integer id
     *
     * @return admin profile view page
     *
     */
    public function change_password($admin_id)
    {
         $admin = Admin::find($admin_id);

        return view('admin.profile.password')->with('admin',$admin);
    }
    /**
     * @method change_password_save()
     * 
     * @uses used to change the admin password
     *
     * @created BALAJI M
     *
     * @updated
     *
     * @param integer id
     *
     * @return admin profile view page
     *
     */
    public function change_password_save(Request $request, $admin_id)
    {

         $admin = Admin::find($admin_id);

        if (Hash::check($request->oldpassword, $admin->password)) {
            
            $admin->password = Hash::make($request->password);
            $admin->save();
        }
        else
        {

        return redirect()->back()->with('error','Wrong Old password!');
        }
        return redirect()->back()->with('success', 'Password changed successfully');

    }

}


