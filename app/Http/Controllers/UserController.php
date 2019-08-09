<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Host;

use App\User;

use App\Booking;

use DB, Auth, Hash, Validator, Exception;

use Carbon\Carbon;


class UserController extends Controller
{

    Protected $user;
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            
            $this->user= Auth::user();

            return $next($request);
        });

    }

    /**
    *
    * Profile Management
    *
    **/

    /**
     * @method profile_view()
     * 
     * @uses used to view the user's detail
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return user's profile view page
     *
     */
    public function profile_view()
    {
        
        $user = $this->user;

        if(!$user){

            // return redirect()->route('profile.view')->with('error',"No Profile found");

            Auth::logout();

            return redirect('/login');
            
        }

        return view('user.profile.view')->with('user', $user);

    }


    /**
     * @method profile edit()
     * 
     * @uses used to edit the user's detail
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return user's profile edit page
     *
     */

    public function profile_edit($id) {

        $user = $this->user;

        if(!$user){

            return redirect()->route('profile.view')->with('error', "No Profile found");
            
        }

        return view('user.profile.edit')->with(['user' => $user]);
    
    }

    /**
     * @method profile_save()
     * 
     * @uses used to store the user's detail
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param  NULL
     *
     * @return user's profile view page
     *
     */
    public function profile_save(Request $request)
    {

        $user = $this->user;

        if(!$user){

            return redirect()->route('profile.view')->with('error', "No Profile found");
            
        }

        $request->validate([
                
            'name' => 'required|min:3|max:50|regex:/^[a-z A-Z]+$/',

            'email' => 'required|email',

            'description' => 'min:5|max:255',

            'picture' => 'sometimes|required|image|mimes:jpeg,png,jpg|max:2048',

            'mobile' => 'regex:/[6-9][0-9]{9}/',
            

        ]);


        if($request->hasFile('picture')){

            delete_picture($user->picture, PROFILE_PATH_USER);

            $url = upload_picture($user->picture,$request->file('picture'),PROFILE_PATH_USER);

            $user->picture = $url;

        }
        
        $user->name = $request->name;        

        $user->email = $request->email;

        $user->description = $request->description;

        $user->mobile = $request->mobile;

        $user->gender = $request->gender;

        $user->save();

        return view('user.profile.view')->with('user', $user);
       
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
    
        $user = $this->user;

        if(!$user){

            return redirect()->route('profile.view')->with('error', "No Profile found");
            
        }

        return view('user.profile.password')->with(['user' => $user]);


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
        
        $user = $this->user;

        if(!$user){

            return redirect()->route('profile.view')->with('error', "No Profile found");
            
        }
          

        $this->validate($request,[

            'old_password' => 'required|min:6',

            'password' => 'required|confirmed|min:6',

        ]);

        if (!\Hash::check($request->old_password, $user->password)) {

             return redirect()->back()->with('error', "Old Password is wrong");
        }
            
        $password = \Hash::make($request->password);

        $user->password = $password;        

        $user->save();

        return redirect()->route('profile.view')->with('success', 'Password Changed');
        
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
        
        $user = $this->user;

        if(!$user){

            return redirect()->route('profile.view')->with('error', "No Profile found");
            
        }
          
        $imageName=$user->picture;

        delete_picture($imageName,FILE_PATH_USER);

        $user->delete();

        return redirect()->route('login')->with('success', 'Account Deleted');
        
    }


	/**
	*
	* Booking Management
	*
	**/

    /**
     * @method bookings_index()
     * 
     * @uses used to display the all list of booking 
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


        $bookings = Booking::where('user_id', $this->user->id)->orderBy('id')->paginate(10);

        return view('user.bookings.index')->with('bookings', $bookings);        

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


        $booking = Booking::where('user_id', $this->user->id)
            ->where('id',$id)->first();

        if(!$booking){

            return redirect()->route('bookings.index')->with('error', "No Booking found");
            
        }
        
        return view('user.bookings.view')->with('booking', $booking);
    }


    /**
     * @method bookings_save()
     * 
     * @uses used to save the booking of user
     *
     * @created NAVEEN S
     *
     * @updated 
     *
     * @param Request of all data
     *
     * @return booking list page
     *
     */
    public function bookings_save(Request $request, $id) {


    	$host = Host::where('id', $id)->first();

    	if(!$host) {

    		return 'no hosts found';
    	}

       $this->validate($request,[

            'check_in' => 'required|date|after:now',

            'check_out' => 'required|date|after:check_in',

            'description' => 'required|min:3|max:300'

        ]); 


		$check_in = Carbon::createFromFormat('Y-m-d H:i:s', $request->check_in);

		$check_out = Carbon::createFromFormat('Y-m-d H:i:s', $request->check_out);

		$duration = $check_in->diffInMinutes($check_out);

		$per_hour = $host->per_hour;

		$total = ($duration/60)*$per_hour;

		$booking = new Booking;

		$booking->unique_id = uniqid(base64_encode(str_random(60)));

		$booking->user_id = $this->user->id;

		$booking->provider_id = $host->provider()->first()->id;

		$booking->host_id = $host->id;

		$booking->total_spaces = $host->total_spaces;

		$booking->description = $request->description;

		$booking->checkin = $request->check_in;

		$booking->checkout = $request->check_out;

		$booking->duration = $duration;

		$booking->per_hour = $per_hour;

		$booking->total = $total;

		$booking->status = BOOKING_CREATED;

		$booking->save();

        return redirect()->route('bookings.index')->with('success', 'Booking Created');  

    }

     /**
     * @method bookings_status()
     * 
     * @uses used to status of the booking
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param integer id
     *
     * @return view of booking's index
     *
     */
    public function bookings_status($id) {

        $booking = Booking::where('user_id', $this->user->id)
            ->where('id',$id)->first();

        if(!$booking){

            return redirect()->route('bookings.index')->with('error', "No Booking found");
            
        }

        $booking->status = BOOKING_USER_CANCEL;

        $booking->save();

        return redirect()->back()->with('success', 'Status Updated !');
               
    }

    /**
    *
    *
    * Host Management
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


        $hosts = Host::where('status', APPROVED)->orderBy('id')->paginate(10);

        return view('user.hosts.index')->with('hosts', $hosts);        

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

        $host = Host::where('id',$id)->first();

        if(!$host){

            return redirect()->route('hosts.index')->with('error', "No Host found");
            
        }
        
        return view('user.hosts.view')->with('host', $host);
    }


}
