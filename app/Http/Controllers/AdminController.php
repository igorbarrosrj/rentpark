<?php

namespace App\Http\Controllers;

use Faker\Provider\Image;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cookie;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Storage;

use Illuminate\Validation\Rule;

use App\Admin;

use App\Booking;

use App\Host;

use App\Provider;

use App\ServiceLocation;

use App\User;

use DB, Auth, Hash, Validator, Exception;

use Setting;

use \Mail;

class AdminController extends Controller {

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
    public function index() { 
       
        $recent_users = User::orderBy('created_at', 'desc')->take(10)->get();
        
        $recent_providers = Provider::orderBy('created_at', 'desc')->take(10)->get();

        $data['total_users'] = Host::orderBy('id')->get()->count();

        $data['total_providers'] = Provider::orderBy('id')->get()->count();

        $data['total_bookings'] = Booking::orderBy('id')->get()->count();

        $data['total_earnings'] = Booking::orderBy('id')->sum('total');

        $data = json_decode(json_encode($data));

        return view('admin.dashboard')
                ->with('recent_users',$recent_users)
                ->with('recent_providers',$recent_providers)
                ->with('data',$data);
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

        $users = User::orderBy('created_at','desc')->paginate(10);

        return view('admin.users.index')
                    ->with('users', $users);
        
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

        $user_details = NULL;

        return view('admin.users.create')->with('user_details', $user_details);

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

        try {
            
            $user_details = User::find($id);

            if(!$user_details) {
                
                return redirect()->route('admin.users.index')->with('error',"No User found");
            }

            return view('admin.users.view')->with('user_details', $user_details);
             
        } catch (Exception $e) {

            $error = $e->getMessage();

            return redirect()->route('admin.users.index')->with('error', "No User found");
        }
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

        try {
           
            DB::begintransaction();

            $validator = Validator::make( $request->all(), [

                'name' => 'required|min:3|max:50|regex:/^[a-z A-Z]+$/',
                'email' => $request->id ? 'required|email|max:191|unique:users,email,'.$request->user_id.',id' : 'required|email',
                'picture' => 'sometimes|required|image|mimes:jpeg,png,jpg|max:2048',
                'description' => 'required|min:5',
                'mobile' => 'digits_between:6,13|nullable',
                'password' => $request->user_id ? "" : 'required|min:6'
                ]
            );

            if($validator->fails()) {

                $error = implode(',', $validator->messages()->all());

                throw new Exception($error, 101);
            }
            
            if($request->id) {

                $user_details = User::find($request->id);

                if($request->hasFile('picture')) {

                    delete_picture($user_details->picture, PROFILE_PATH_USER);

                }

            } else {
                
                $user_details = New User;

                $user_details->unique_id = uniqid(base64_encode(str_random(60)));

                $user_details->password = \Hash::make($request->password);

                $user_details->status = APPROVED;

                $user_details->picture = asset('placeholder.jpg');

            }
           
            $user_details->name = $request->name;        

            $user_details->email = $request->email;        

            $user_details->description = $request->description?:'';

            $user_details->mobile = $request->mobile?:'';

            $user_details->gender = $request->gender;

            $user_details->token = $request->token?:"";

            $user_details->token_expiry = $request->token_expiry?:"";

            if($request->hasFile('picture')) {

                $user_details->picture = upload_picture($request->file('picture'), PROFILE_PATH_USER);
            }

            if($user_details->save()) {
    
                DB::commit(); 
            
                if(!$request->id) {

                    if(Setting::get('is_email_configured') == YES) {

                        $to_name = $request->name;

                        $to_email = $request->email;            

                        $data = ["name"=> $request->name, "body" => "You account is created ", "username" => $request->email, "password" => $request->password, "link" => route('login')];

                        Mail::send('admin.users.mail.index', $data, function($message) use ($to_name, $to_email) {$message->to($to_email, $to_name)->subject("Account Activation");

                        $message->from(\Config::get('mail.from.address'), "RentPark");;}); 
                    }

                }        
    
                return redirect()->route('admin.users.index')->with('success', 'User Saved');
            }

            throw new Exception("Sorry! User Details could not be saved, Please try again", 1);
                        
        } catch (Exception $e) {
            
            DB::rollback();

            $error = $e->getMessage();

            return redirect()->back()->withInput()->with('flash_error', $error);

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
        
        try {
            
            $user_details = User::find($id);

            if(!$user_details) {
                
                throw new Exception("No User found", 101);                
            }

            return view('admin.users.edit')->with('user_details', $user_details);
                
        } catch (Exception $e) {

            $error = $e->getMessage();

            return redirect()->route('admin.users.index')->with('error', "No User found");
        }
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

        try {
            
            DB::begintransaction();

            $user_details = User::find($id);

            if(!$user_details) {
                
                throw new Exception("No User found", 101);
            }

            $user_picture = $user_details->picture;

            if($user_details->delete()) {

                DB::commit();
                
                delete_picture($user_picture , PROFILE_PATH_USER);

                return redirect()->route('admin.users.index')->with('success', 'User Removed');  
            }

            throw new Exception("Sorry! User details could not be delated. Plese try again", 101);

        } catch (Exception $e) {

            DB::rollback();

            $error = $e->getMessage();

            return redirect()->back()->with('error', "No User found");
        }       
        
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

        try {
            
            DB::begintransaction();

            $user_details = User::find($id);

            if(!$user_details) {
                
                throw new Exception("No User found", 101);                
            }

            $user_details->status = $user_details->status == APPROVED ? DECLINED : APPROVED;

            if($user_details->save()) {

                DB::commit();

                return redirect()->back()->with('success', 'Status Updated!'); 
            
            }

            throw new Exception("Sorry! User Status could not change. Plese try again", 1);
            
        } catch (Exception $e) {

            DB::rollback();

            $error = $e->getMessage();

            return redirect()->back()->with('error', "No User found");
        } 
    }


    /**
    *
    *
    * Service Location Management in Admin Panel
    *
    */
    
    /**
     * @method service_locations_index()
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

        $service_locations = ServiceLocation::orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.service_locations.index')->with('service_locations', $service_locations);

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

        return view('admin.service_locations.create')->with('service_location', $service_location);

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
            
            return redirect()->route('admin.service_locations.index')->with('error', "No Service Location found");
        }

        return view('admin.service_locations.view')->with('service_location', $service_location);
        
    }


   /**
     * @method service_locations_save()
     * 
     * @uses used to save the data of Service Location
     *
     * @created NAVEEN S
     *
     * @updated BALAJI M
     *
     * @param Request of all data
     *
     * @return view of Service Locations index
     *
     */
    public function service_locations_save(Request $request) {

        $this->validate($request,[

            'name' => 'required|min:3|max:50|regex:/^[a-z A-Z]+$/',

            'full_address' => 'required|min:3|max:200',

            'picture' => 'sometimes|image|nullable|max:2999|mimes:jpeg,bmp,png,jpg',

            'description' => 'required| min:5',

        ]);

        if(!$request->id){
        
            //Create Service Location

            $service_location = New ServiceLocation;

            $service_location->unique_id = uniqid(base64_encode(str_random(60)));

            $service_location->status = APPROVED;

            $service_location->picture = asset('/noimage.jpg');

        } else {


            $service_location = ServiceLocation::find($request->id);

            if($request->hasFile('picture')) {

                delete_picture($service_location->picture, FILE_PATH_SERVICE_LOCATION);

            }

        }
        
        
        $service_location->name = $request->name;        

        $service_location->full_address = $request->full_address;        

        $service_location->description = $request->description;

        if($request->hasFile('picture')){

            $service_location->picture = upload_picture($request->file('picture'), FILE_PATH_SERVICE_LOCATION);

        }

        $service_location->save();

        return redirect()->route('admin.service_locations.index')->with('success', 'Service Location Saved');
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
            
            return redirect()->route('admin.service_locations.index')->with('error', "No Service Location found");
        }

        return view('admin.service_locations.edit')->with('service_location', $service_location);

    }


    /**
     * @method service_locations_delete()
     * 
     * @uses used to delete the service location
     *
     * @created NAVEEN S
     *
     * @updated BALAJI M
     *
     * @param integer id
     *
     * @return view of service location's index
     *
     */
    public function service_locations_delete($id) {

        $service_location = ServiceLocation::find($id);

        if(!$service_location) {
            
            return redirect()->route('admin.service_locations.index')->with('error', "No Service Location found");
        }

        delete_picture($service_location->picture, FILE_PATH_SERVICE_LOCATION);

        $service_location->delete();

        return redirect()->route('admin.service_locations.index')->with('success', 'Service Location Removed');
        
        
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
            
            return redirect()->route('admin.service_locations.index')->with('error', "No Service Location found");
        }

        $service_location->status = $service_location->status == APPROVED ? DECLINED : APPROVED;

        $service_location->save();

        return redirect()->back()->with('Success', 'Status updated !');
        
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

        $hosts = Host::orderBy('created_at', 'desc')->paginate(10);

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

        $service_locations = ServiceLocation::where('status', APPROVED)->orderBy('name')->get();

        $providers = Provider::where('status', APPROVED)->orderBy('name')->get();

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

            return redirect()->route('admin.hosts.index')->with('error', "No Host found");
            
        }
        
        return view('admin.hosts.view')->with('host', $host);
    }


   /**
     * @method hosts_save()
     * 
     * @uses used to save the data of host
     *
     * @created NAVEEN S
     *
     * @updated BALAJI M
     *
     * @param Request of all data
     *
     * @return view of hosts index
     *
     */
    public function hosts_save(Request $request) {


        $this->validate($request,[

            'host_name' => 'required|min:3|max:50|regex:/^[a-z A-Z]+$/',

            'provider_name' => 'required|min:3|max:50|regex:/^[a-z A-Z]+$/',

            'host_type' => 'required|min:6|max:8',

            'description' => 'required| min:5',

            'picture' => 'image|nullable|max:2999|mimes:jpeg,bmp,png,jpg',

            'service_location' => 'required|min:3|max:50',

            'total_spaces' => 'required|min:1|max:5000|numeric',

            'full_address' => 'required|min:3|max:50',

            'per_hour' => 'required|min:1|max:5000|numeric',

        ]);

        $service_location_id = ServiceLocation::where('name', $request->service_location)->first()->id;

        $provider_id = Provider::where('name', $request->provider_name)->first()->id;

        if(!$request->id){
        
            //Create Host

            $host = New Host;

            $host->unique_id = uniqid(base64_encode(str_random(60)));

            $host->status = APPROVED;

            $host->picture = asset('noimage.jpg');

        } else {

            $host = Host::find($request->id);

            if($request->hasFile('picture')){

                delete_picture($host->picture, FILE_PATH_HOST);
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

        if($request->hasFile('picture')){

            $host->picture = upload_picture($request->file('picture'), FILE_PATH_HOST);

        }

        $host->save();

        return redirect()->route('admin.hosts.index')->with('success', 'Host Saved');
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

            return redirect()->route('admin.hosts.index')->with('error', "No Host found");
            
        }

        $service_locations = ServiceLocation::orderBy('name')->get();

        $providers = Provider::orderBy('name')->get();

        return view('admin.hosts.edit')->with(['host' => $host, 'service_locations' => $service_locations, 'providers' => $providers]);
    
    }


    /**
     * @method hosts_delete()
     * 
     * @uses used to delete the user
     *
     * @created NAVEEN S
     *
     * @updated BALAJI M
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

        delete_picture($host->picture, FILE_PATH_HOST);

        $host->delete();

        return redirect()->route('admin.hosts.index')->with('success', 'Host Removed');
        
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
            
            return redirect()->route('admin.hosts.index')->with('error', "No Host found");
        }

        $host->status = $host->status == APPROVED ? DECLINED : APPROVED;

        $host->save();

        return redirect()->back()->with('Success', 'Status updated !');
        
        
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
     * @uses To list out booking details
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

        $bookings = Booking::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.bookings.index')->with('bookings',$bookings);        

    }

    /**
     * @method bookings_view()
     * 
     * @uses to display the Booking Details based on $id
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

        $booking_details = Booking::find($id);

        if(!$booking_details){

            return redirect()->route('admin.bookings.index')->with('error', "No Booking found");            
        }
        
        return view('admin.bookings.view')->with('booking_details', $booking_details);
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

        $providers = Provider::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.providers.index')->with('providers', $providers);
    }

    /**
     * @method providers_create()
     * 
     * @uses used to create the provider
     *
     * @created BALAJI M
     *
     * @updated NAVEEN S
     *
     * @param integer id
     *
     * @return provider's create form
     *
     */
    public function providers_create() {

        $provider = NULL;

        return view('admin.providers.create')->with('provider', $provider);;
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
    public function providers_edit($id) {
        
        try {
            
            $provider = Provider::find($id);

            if(!$provider) {

                throw new Exception("Provider Not Found", 101);
            }

            return view('admin.providers.edit')->with('provider', $provider);

        } catch (Exception $e) {
             
            $error = $e->getMessage();

            return redirect()->route('admin.providers.index')->with('error', 'Provider Not Found');
        }

    }
    
    /**
     * @method providers_save()
     * 
     * @uses used to save the provider's detail in db
     *
     * @created BALAJI M
     *
     * @updated NAVEEN S
     *
     * @param integer id
     *
     * @return provider's index page
     *
     */
    public function providers_save(Request $request) {

        $request->validate([
                
            'name' => 'required|min:3|max:50|regex:/^[a-z A-Z]+$/',

            'email' => 'required|email',
                
            'picture' => 'sometimes|required|image|mimes:jpeg,png,jpg|max:2048',

            'mobile' => 'digits_between:6,13|nullable',

            'work' => 'min:3|max:255|nullable',

            'school' => 'min:3|max:255|nullable',

            'languages' => 'min:3|max:255|nullable',

        ]);

        if(!$request->id) {
            
            $request->validate([

                'email' => 'required|email|unique:providers,email',

                'password' => 'sometimes|required|min:6|confirmed',
            ]);
            
            $provider = new Provider;

            $provider->unique_id = rand();

            $provider->password = Hash::make($request->password) ?: "";

            $provider->status = APPROVED;

            $provider->picture = asset('placeholder.jpg');
            
        } else {

            $provider = Provider::find($request->id);

            if($request->hasFile('picture')){

                delete_picture($provider->picture, PROFILE_PATH_PROVIDER);

            }

        }

        $provider->name = $request->name ?: "";

        $provider->email = $request->email ?: "";

        $provider->description = $request->description ?: "";

        $provider->mobile = $request->mobile ?: "";

        $provider->work = $request->work ?: "";

        $provider->school = $request->school ?: "";

        $provider->languages = $request->languages ?: ""; 

        $provider->remember_token = $request->remember_token ?: "";

        if($request->hasFile('picture')){

            $provider->picture = upload_picture( $request->file('picture'),PROFILE_PATH_PROVIDER);
        }

        $provider->save();

        return redirect(route('admin.providers.index'))->with('success', 'Provider Saved');
       
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
    public function providers_view($provider_id) {

        $provider = Provider::find($provider_id);

        if(!$provider) {

            return redirect()->route('admin.providers.index')->with('error', 'Provider Not Found');            
        }

        return view('admin.providers.view')->with('provider', $provider);
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
    public function providers_delete($id) {

        $provider = Provider::find($id);

        if(!$provider) {

            return redirect()->route('admin.providers.index')->with('error','Provider Not Found');

        }

        delete_picture($provider->picture, PROFILE_PATH_PROVIDER);

        $provider->delete();

        return redirect(route('admin.providers.index'))->with('success', 'Provider Removed');
    }

    /**
     * @method providers_status()
     * 
     * @uses used to status of the provider
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param integer id
     *
     * @return view of provider's index
     *
     */
    public function providers_status($id) {

        $provider = Provider::find($id);

        if(!$provider) {
            
            return redirect()->route('admin.providers.index')->with('error',"No Provider
             found");
        }

        $provider->status = $provider->status == APPROVED ? DECLINED : APPROVED;

        $provider->save();

        return redirect()->back()->with('success', 'Status Updated !');
        
        
    }


    /**
    *
    *
    * Settings in Admin Panel
    *
    */

    /**
     * @method settings_index()
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

            'currency' => 'required',

        ]);

        setting();

        //Handle File Upload
        if($request->hasFile('favicon')){

            $image = $request->file('favicon');

            //Filename to store
            $fileNameToStore = asset('favicon.png');

            //Upload Image

            $image->move(public_path().'/', $fileNameToStore);

            setting(['favicon' => $fileNameToStore])->save();

        } 

         if($request->hasFile('site_logo')){

            $image = $request->file('site_logo');

            //Filename to store
            $fileNameToStore = asset('logo.png');

            //Upload Image

            $image->move(public_path().'/', $fileNameToStore);

            setting(['site_logo' => $fileNameToStore])->save();

        } 
            
        setting(['site_name' => $request->site_name, 'currency' => $request->currency])->save();


        return redirect()->route('admin.settings.index')->with('success', 'Settings Saved');
    }

    /**
     * @method admin_profile_save()
     * 
     * @uses used to store the admin detail
     *
     * @created BALAJI M
     *
     * @updated NAVEEN S
     *
     * @param integer id
     *
     * @return admin profile view page
     *
     */
    public function admin_profile_save(Request $request)
    {
        $request->validate([
                
            'name' => 'required|min:3|max:50|regex:/^[a-z A-Z]+$/',

            'email' => 'required|email',
                
            'password' => 'sometimes|required|min:6|confirmed',

            'picture' => 'sometimes|required|image|mimes:jpeg,png,jpg|max:2048',

        ]);

        $admin = Admin::find(Auth()->guard('admin')->user()->id);

        $admin->name = $request->name?: "";
        
        $admin->email = $request->email?: "";

        $admin->about = $request->about?: "";

        $admin->mobile = $request->mobile?: "";      

        if($request->hasFile('picture')){

            delete_picture($admin->picture, PROFILE_PATH_ADMIN);

            $admin->picture = upload_picture($request->file('picture'),PROFILE_PATH_ADMIN);

        }
    
        $admin->save();

        return view('admin.profile.view')->with('admin', $admin);
        
    }

    /**
     * @method admin_profile_edit()
     * 
     * @uses used to edit the admin detail
     *
     * @created BALAJI M
     *
     * @updated NAVEEN S
     * 
     * @param integer id
     *
     * @return admin profile edit form
     *
     */
    public function admin_profile_edit() 
    {
        
        $admin = Admin::find(Auth()->guard('admin')->user()->id);

        return view('admin.profile.edit')->with('admin', $admin);

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
    public function admin_profile_view()
    {
        $admin = Admin::find(Auth()->guard('admin')->user()->id);

        return view('admin.profile.view')->with('admin',$admin);

    }

    /**
     * @method change_password()
     * 
     * @uses used to view the password change form
     *
     * @created BALAJI M
     *
     * @updated NAVEEN S
     *
     * @param integer id
     *
     * @return admin profile view page
     *
     */
    public function change_password()
    {
        $admin = Admin::find(Auth()->guard('admin')->user()->id);

        return view('admin.profile.password')->with('admin', $admin);
    }

    /**
     * @method change_password_save()
     * 
     * @uses used to change the admin password
     *
     * @created BALAJI M
     *
     * @updated NAVEEN S
     *
     * @param integer id
     *
     * @return admin profile view page
     *
     */
    public function change_password_save(Request $request)
    {

        $request->validate([

                'password' => 'sometimes|required|min:6|confirmed',
            ]);

        $admin = Admin::find(Auth()->guard('admin')->user()->id);

        if (Hash::check($request->oldpassword, $admin->password)) {
            
            $admin->password = Hash::make($request->password);

            $admin->save();
        } else
        {

            return redirect()->back()->with('error', 'Wrong Old password!');
        }
        return redirect()->route('admin.profile.view',$admin->id)->with('success', 'Password changed successfully');

    }

}


