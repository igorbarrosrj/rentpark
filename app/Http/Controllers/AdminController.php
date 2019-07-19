<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * Return the view of dashboard
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * Return the view of index
     */
    public function user_index()
    {

        return view('admin.users.create');

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     *
     * Return the create form
     */

    public function users_create()
    {

        return view('admin.users.create');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * Store the data from user create form
     */
    public function user_store(Request $request)
    {
        
        $this->validate($request,[

            'name' => 'required|min:3|max:50',

            'email' => 'required|email|unique:users,email',

            'password' => 'required|min:6',

            'cpassword' => 'required|same:password|min:6',

            'description' => 'required| min:5',

            'mobile' => 'regex:/[6-9][0-9]{9}/',

        ]);

        //Create Post

        $user = New User;

        $user->name = $request->input('name');

        $user->email = $request->input('email');

        $user->password = bcrypt($request->password);

        $user->description = $request->input('description');

        $user->mobile = $request->input('mobile');

        $user->gender = $request->input('gender');

        $user->save();

        return redirect('/users')->with('success','User Updated');
    }
}
