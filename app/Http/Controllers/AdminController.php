<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB, Hash, Auth, Validator, Exception;

use App\User;

use App\Host;

use App\ServiceLocation;

use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\File;

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

        return view('admin.users.show')->with('user',$user);
        
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

            //Create Post

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

        $user->save();

        return redirect()->route('admin.users.index')->with('success','User Saved');
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

        return view('admin.service_locations.show')->with('service_location',$service_location);
        
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
        
            //Create Post

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

        if($hosts){

            return view('admin.hosts.index')->with('hosts',$hosts);

        }
        else {

            return view('admin.hosts.index')->with('danger',"No Users found");
        }
        

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

        return view('admin.hosts.create')->with('host',$host);

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

        $user = Host::find($id);

        if($host){

            return view('admin.hosts.show')->with('host',$host);
        }
        else {

            return view('admin.hosts.index')->with('danger',"No User found");
        }
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

            'provider' => 'required|min:3|max:50',

            'host_type' => 'required|email',

            'description' => 'required| min:5',

            'picture' => 'regex:/[6-9][0-9]{9}/',

            'service_location' => 'required|min:3|max:50',

            'total_spaces' => 'required|min:3|max:50',

            'full_address' => 'required|min:3|max:50',

            'per_hour' => 'required|min:3|max:50',

        ]);


        if($request->id == NULL){
        
            $this->validate($request,[

                'email' => 'required|unique:users,email|email',

                'password' => 'required|min:6',

                'cpassword' => 'required|same:password|min:6',
            ]);

            //Create Post

            $host = New Host;

            $host->unique_id = uniqid(base64_encode(str_random(60)));

            $host->password = bcrypt($request->password);
        }
        else {
            $host = Host::find($request->id);

            
        }


        $host->name = $request->name;        

        $host->email = $request->email;        

        $host->description = $request->description;

        $host->mobile = $request->mobile;

        $host->gender = $request->gender;

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

        if($host){

            return view('admin.hosts.edit')->with('host',$host);
        }
        else {
            return view('admin.hosts.index')->with('danger',"No User found");
        }

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
     * @return view of user's index
     *
     */
    public function hosts_delete($id) {

        $host = Host::find($id);

        if($host){

            $host->delete();

            return redirect()->route('admin.host.index')->with('success','User Removed');
        }
        else {
            return redirect()->route('admin.hosts.index')->with('danger',"No User found");
        }
        
    }

}
