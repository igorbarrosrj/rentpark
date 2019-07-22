<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB, Hash, Auth, Validator, Exception;

use App\User;

use App\Host;

use Illuminate\Validation\Rule;

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

        return view('admin.hosts.create');

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
