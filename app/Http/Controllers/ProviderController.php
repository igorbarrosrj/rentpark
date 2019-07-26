<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Host;

use App\ServiceLocation;

use App\Provider;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\File;


class ProviderController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

        $this->middleware('auth:provider');
    }

    /**
     * @method index()
     * 
     * @uses used to display the index
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return view of  index
     *
     */
    public function index()
    { 

        return view('provider.dashboard');
    }


    
    /**
    *
    *
    * Host Management in provider Panel
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

        $provider_id = Auth()->guard('provider')->user()->id;

        $hosts = Host::where('provider_id',$provider_id)->orderBy('id')->get();

        if(!$hosts){

            return redirect()->route('provider.hosts.index')->with('error',"No Host found");
            
        }

        return view('provider.hosts.index')->with('hosts',$hosts);        

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

        $service_locations = ServiceLocation::where('status',1)->get();

        if(!$service_locations){

            return redirect()->route('provider.hosts.index')->with('error',"No Service Locations found");
            
        }

        $providers = Provider::orderBy('name')->get();

        if(!$providers){

            return redirect()->route('provider.hosts.index')->with('error',"No providers found");
            
        }

        return view('provider.hosts.create')->with(['host' => $host, 'service_locations' => $service_locations, 'providers' => $providers ]);

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

        $provider_id = Auth()->guard('provider')->user()->id;

        $host = Host::where('provider_id', $provider_id)
            ->where('id',$id)->first();

        if(!$host){

            return redirect()->route('provider.hosts.index')->with('error',"No Host found");
            
        }
        
        return view('provider.hosts.view')->with('host',$host);
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

            'host_type' => 'required|min:6|max:8',

            'description' => 'required| min:5',

            'picture' => 'image|nullable|max:2999|mimes:jpeg,bmp,png,jpg',

            'service_location' => 'required|min:3|max:50',

            'total_spaces' => 'required|min:1|max:5000|numeric',

            'full_address' => 'required|min:3|max:50',

            'per_hour' => 'required|min:1|max:5000|numeric',

        ]);

        $service_location_id = ServiceLocation::where('name',$request->service_location)->first()->id;

        $provider_id = Auth()->guard('provider')->user()->id;



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

            if($request->hasFile('picture')) {

                if($host->picture != 'noimage.jpg'){

                    Storage::disk('public')->delete('/hosts/'.$host->picture);

                }
   
            }

            $host->picture = $fileNameToStore;
        }


        $host->provider_id = $provider_id;        

        $host->host_name = $request->host_name;        

        $host->host_type = $request->host_type;

        $host->description = $request->description;

        $host->service_location_id = $service_location_id;

        $host->total_spaces = $request->total_spaces;        

        $host->full_address = $request->full_address;

        $host->per_hour = $request->per_hour;

        $host->status = 0;

        $host->save();

        return redirect()->route('provider.hosts.index')->with('success','Host Saved');
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

        $provider_id = Auth()->guard('provider')->user()->id;
        
        $host = Host::where('provider_id', $provider_id)
            ->where('id',$id)->first();

        if(!$host){

            return redirect()->route('provider.hosts.index')->with('error',"No Host found");
            
        }
        

        $service_locations = ServiceLocation::where('status',1)->get();

        if(!$service_locations){

            return redirect()->route('provider.hosts.index')->with('error',"No Service Locations found");
            
        }


        return view('provider.hosts.edit')->with(['host' => $host, 'service_locations' => $service_locations]);
    
    }


    /**
     * @method hosts_delete()
     * 
     * @uses used to delete the host
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

        $host = Host::where('provider_id', $provider_id)
            ->where('id',$id)->first();

        $provider_id = Auth()->guard('provider')->user()->id;

        if(!$host){

            return redirect()->route('provider.hosts.index')->with('error',"No Host found");
            
        }

         if($host->picture != 'noimage.jpg'){


            Storage::disk('public')->delete('/hosts/'.$host->picture);

        }

        $host->delete();

        return redirect()->route('provider.hosts.index')->with('success','User Removed');
        
    }




    /**
    *
    * Profile Management
    *
    **/




    /**
     * @method profile_view()
     * 
     * @uses used to display the view page
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param 
     *
     * @return view of particular host
     *
     */
    public function profile_view() {

        $provider_id = Auth()->guard('provider')->user()->id;

        $provider_details = Provider::where('id',$provider_id)->first();

        if(!$provider_details){

            return redirect()->route('provider.profile.view')->with('error',"No Profile found");
            
        }
        
        return view('provider.profile.view')->with('provider_details',$provider_details);
    }



    public function profile_edit($id) {

        $provider_id = Auth()->guard('provider')->user()->id;
        
        $provider_details = Provider::where('id',$provider_id)->first();

        if(!$provider_details){

            return redirect()->route('provider.profile.view')->with('error',"No Profile found");
            
        }

        return view('provider.profile.edit')->with(['provider_details' => $provider_details]);
    
    }


    /**
     * @method profile_save()
     * 
     * @uses used to save the data of profile
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param Request of all data
     *
     * @return view of profile view
     *
     */
    public function profile_save(Request $request) {


        $provider_id = Auth()->guard('provider')->user()->id;
        
        $provider_details = Provider::where('id',$provider_id)->first();

        if(!$provider_details){

            return redirect()->route('provider.profile.view')->with('error',"No Profile found");
            
        }

        $this->validate($request,[

            'name' => 'required|min:3|max:50',

            'email' => 'required|email',

            'description' => 'required| min:5',

            'mobile' => 'regex:/[6-9][0-9]{9}/',

            'picture' => 'image|nullable|max:2999|mimes:jpeg,bmp,png,jpg',

            'work' => 'max:50',

            'school' => 'max:50',

            'languages' => 'max:100',

        ]);


        //Handle File Upload
        if($request->hasFile('picture')){

            if($provider_details->picture != 'noimage.jpg'){

                Storage::disk('public')->delete('/providers/'.$provider_details->picture);
            }

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

            $path = $request->file('picture')->storeAs('/providers',$fileNameToStore,'public');


        } else {

            $fileNameToStore = 'noimage.jpg';
        }

            
        $provider_details->picture = $fileNameToStore;

        $provider_details->name = $request->name;        

        $provider_details->email = $request->email;

        $provider_details->description = $request->description;

        $provider_details->mobile = $request->mobile;

        $provider_details->work = $request->work;        

        $provider_details->school = $request->school;

        $provider_details->languages = $request->languages;

        $provider_details->gender = $request->gender;

        $provider_details->save();

        return redirect()->route('provider.profile.view')->with('success','Profile Saved');
    }


    /**
     * @method profile_password()
     * 
     * @uses used to view password page
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param Request of all data
     *
     * @return view of profile password view
     *
     */
    public function profile_password(Request $request) {
    
        $provider_id = Auth()->guard('provider')->user()->id;
        
        $provider_details = Provider::where('id',$provider_id)->first();

        if(!$provider_details){

            return redirect()->route('provider.profile.view')->with('error',"No Profile found");
            
        }

        return view('provider.profile.password')->with(['provider_details' => $provider_details]);


    }


    /**
     * @method profile_password_save()
     * 
     * @uses used to save the password
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param Request of all data
     *
     * @return view of profile view
     *
     */
    public function profile_password_save(Request $request) {
    

        $provider_id = Auth()->guard('provider')->user()->id;
        
        $provider_details = Provider::where('id',$provider_id)->first();

        if(!$provider_details){

            return redirect()->route('provider.profile.view')->with('error',"No Profile found");
            
        }
          

        $this->validate($request,[

            'old_password' => 'required|min:6',

            'password' => 'required|confirmed|min:6',

        ]);



        if (!\Hash::check($request->old_password, $provider_details->password)) {

             return redirect()->back()->with('error',"Old Password is wrong");
        }
            
        $password = \Hash::make($request->password);

        $provider_details->password = $password;        

        $provider_details->save();

        return redirect()->route('provider.profile.view')->with('success','Password Changed');
        
    }


    /**
     * @method profile_delete()
     * 
     * @uses used to delete the user
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param integer id
     *
     * @return view of profile's view
     *
     */
    public function profile_delete($id) {

        $provider_id = Auth()->guard('provider')->user()->id;
        
        $provider_details = Provider::where('id',$provider_id)->first();

        if(!$provider_details){

            return redirect()->route('provider.profile.view')->with('error',"No Profile found");
            
        }
          

        if($provider_details->picture != 'noimage.jpg'){


            Storage::disk('public')->delete('/providers/'.$provider_details->picture);

        }

        $provider_details->delete();

        return redirect()->route('provider.login')->with('success','Account Deleted');
        
    }


}
