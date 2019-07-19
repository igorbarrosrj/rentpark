<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * Return the view page of index
     */
    public function index()
    {
        
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'name' => 'required|min:3',

            'email' => 'required|email|unique:users,email',

            'password' => 'required|min:6',

            'cpassword' => 'required|same:password|min:6',
        ]);

        //Create Post
        $user = New User;

        $user->name = $request->input('name');

        $user->unique_id = uniqid(base64_encode(str_random(60)));

        $user->email = $request->input('email');

        $user->password = bcrypt($request->password);

        $user->save();

        return redirect('/users')->with('success','User Updated');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.users.edit');
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

        return redirect("/users")->with('Success','User Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect("/users")->with('Success','User Removed');
    }
}
