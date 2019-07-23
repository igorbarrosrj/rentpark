<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Hash, Auth, Validator, Exception;
use App\Provider;

class ProviderController extends Controller
{
   
	public function index()
    {
        $providers = Provider::orderBy('id')->paginate(10);

        return view('admin.providers.index')->with('providers',$providers);

 	public function create()
    {
        return view('admin.providers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            
            'name' => 'required|min:3|max:50',

            'email' => 'required|email',

            'password' => 'required|min:6',
        ]);

        $provider=new Provider([

            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password'=> $request->get('password'),
            'description'=> $request->get('description'),
            'mobile' => $request->get('mobile'),
            'picture' => $request->get('picture'),
            'work' => $request->get('work'),
            'school' => $request->get('school'),
            'languages' => $request->get('languages'),
        ]);

        $provider->save();
        return redirect('\provider')->with('success','Provider saved!');
    }

     public function show($id)
    {
        $provider = Provider::find($id);

        return view('admin.providers.show')->with('providers',$provider);
    }

    public function edit($id) {
        
        $provider = Provider::find($id);

        return view('admin.providers.edit')->with('providers',$provider);

    }

    public function update(Request $request,$id) {

        $this->validate($request,[

            'name' => 'required|min:3|max:50',

            'email' => 'required|email',

            'password' => 'required|min:6',

        ]);


        $provider = Provider::find($id);

        $provider->name = $request->input('name');

        $provider->email = $request->input('email');

        $provider->description = $request->input('description');

        $provider->mobile = $request->input('mobile');

        $provider->picture = $request->input('picture');

        $provider->save();

        return redirect('/listProviders')->with('success','Provider Updated');

    }

     public function users_destroy($id) {

        $provider = Provider::find($id);

        $provider->delete();

        return redirect('/listProviders')->with('success','Providerro Removed');
    }

}
