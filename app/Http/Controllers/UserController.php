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

    /**
    *
    * Profile Management
    *
    **/

    /**
     * @method profile_view()
     * 
     * @uses used to view the user detail
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return user profile view page
     *
     */
    public function profile_view()
    {
        $id = Auth()->guard('guest')->user()->id;

        $user = User::where('id',$id)->first();

        if(!$user){

            return redirect()->route('profile.view')->with('error',"No Profile found");
            
        }
        
        return view('profile.view')->with('user',$user);

    }

    /**
     * @method profile_save()
     * 
     * @uses used to store the user detail
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param  NULL
     *
     * @return user profile view page
     *
     */
    public function profile_save(Request $request)
    {

        $id = Auth()->guard('guest')->user()->id;

        $user = User::where('id',$id)->first();

        if(!$user){

            return redirect()->route('profile.view')->with('error',"No Profile found");
            
        }

        $request->validate([
                
            'name' => 'required|min:3|max:50',

            'email' => 'required|email',

            'description' => 'min:5',

            'mobile' => 'regex:/[6-9][0-9]{9}/',

            'picture' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);




        if($request->hasFile('picture')){

            $destination = '/uploads/admin';

            $imageName=$user->picture;

            if($user->picture != 'placeholder.jpg') {

                delete_picture($imageName,$destination);

            }

            $image = $request->file('picture');

            $url = upload_picture($imageName,$image,$destination);

            $user->picture = $url;

        }
        

        $user->name = $request->name;        

        $user->email = $request->email;

        $user->description = $request->description;

        $user->mobile = $request->mobile;

        $user->gender = $request->gender;

        $user->save();

        return view('profile.view')->with('user',$user);
       
    }



	/**
	*
	* Booking Management
	*
	**/

    /**
     * @method booking_save()
     * 
     * @uses used to save the booking of user
     *
     * @created NAVEEN S
     *
     * @updated 
     *
     * @param Request of all data
     *
     * @return 
     *
     */
    public function booking_save(Request $request) {

    	$user_id = 3;

    	$host = Host::where('id',$request->host_id)->first();

    	if(!$host) {

    		return 'no hosts found';
    	}

       $this->validate($request,[

            'host_id' => 'required',

            'check_in' => 'required|date|date_format:Y-m-d H:i:s|after:now',

            'check_out' => 'required|date_format:Y-m-d H:i:s|after:check_in',

            'description' => 'required|min:3|max:300'

        ]);


		$check_in = Carbon::createFromFormat('Y-m-d H:i:s', $request->check_in);
		$check_out = Carbon::createFromFormat('Y-m-d H:i:s', $request->check_out);

		$duration = $check_in->diffInMinutes($check_out);

		$per_hour = $host->per_hour;

		$total = ($duration/60)*$per_hour;

		$booking = new Booking;

		$booking->unique_id = uniqid(base64_encode(str_random(60)));

		$booking->user_id = $user_id;

		$booking->provider_id = $host->provider()->first()->id;

		$booking->host_id = $request->host_id;

		$booking->total_spaces = $host->total_spaces;

		$booking->description = $request->description;

		$booking->checkin = $request->check_in;

		$booking->checkout = $request->check_out;

		$booking->duration = $duration;

		$booking->per_hour = $per_hour;

		$booking->total = $total;

		$booking->status = BOOKING_CREATED;

		$booking->save();

		return response()->json([

                    'user_id' =>  $user_id,

                    'provider_id' => $host->provider()->first()->id,

                    'host_id' => $request->host_id,

                    'check_in' => $request->check_in,

                    'check_out' => $request->check_out,

                    'total' => $booking->total,

                    'status' => $booking->status,

                    'created_time' => $booking->created_at,

                ]);

    }
}
