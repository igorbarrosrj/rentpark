<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Host;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\File;


class ProviderController extends Controller
{
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

        return view('provider.hosts.index');
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

        $hosts = Host::orderBy('id')->paginate(10);

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

        $service_locations = ServiceLocation::orderBy('name')->get();

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

        $host = Host::find($id);

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

        return redirect()->route('provider.hosts.index')->with('success','User Saved');
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

            return redirect()->route('provider.hosts.index')->with('error',"No Host found");
            
        }

        $service_locations = ServiceLocation::orderBy('name')->get();

        if(!$service_locations){

            return redirect()->route('provider.hosts.index')->with('error',"No Service Locations found");
            
        }

        $providers = Provider::orderBy('name')->get();

        if(!$providers){

            return redirect()->route('provider.hosts.index')->with('error',"No providers found");
            
        }


        return view('provider.hosts.edit')->with(['host' => $host, 'service_locations' => $service_locations, 'providers' => $providers]);
    
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

            return redirect()->route('provider.hosts.index')->with('error',"No Host found");
            
        }

         if($host->picture != 'noimage.jpg'){


            Storage::disk('public')->delete('/hosts/'.$host->picture);

        }

        $host->delete();

        return redirect()->route('provider.hosts.index')->with('success','User Removed');
        
    }


}
