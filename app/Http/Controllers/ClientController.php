<?php

namespace App\Http\Controllers;

use Arr;
use File;
use Image;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flag = true;
        $clients = Client::get();
        return view('client.index', compact('flag', 'clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => ['required'],
            'logo'  =>  ['sometimes', 'nullable'],
        ]);

        $input = $request->all();

        $imagePath = public_path('/uploads/clients/');
        if(!File::isDirectory($imagePath)){

            File::makeDirectory($imagePath, 0777, true, true);
        }

        if($files = request()->file('logo')) {

            $imageUpload = Image::make($files);
            $imageUpload->resize(259,145);
            $imageUpload->save($imagePath.time().'.'.$files->getClientOriginalExtension());

            $input['logo'] = '/uploads/clients/'.time().'.'.$files->getClientOriginalExtension();
        }

        if($request->has('published') && $request->published == 'on') {
            $input['published'] = true;
        }
        else {
            $input['published'] = false;
        }

        $client = auth()->user()->client()->create($input);

        if($client) {
            return redirect()->route('clients.index');
        }

        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $flag = false;
        $clients = Client::get();

        return view('client.index', compact('clients', 'client', 'flag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        abort(403);
        $client = Client::findOrFail($id);
        $client->name = $request->name;
        
        if($request->has('published') || $request->published = 'on'){
            $client->published = true;
        }
        else {
            $client->published = false;
        }

        if($files = $request->file('logo')) {

            if(file_exists($client->logo)){
                unlink(public_path($client->logo));
            }

            $imageUpload = Image::make($files);
            $imageUpload->resize(259,145);
            $imageUpload->save($imagePath.time().'.'.$files->getClientOriginalExtension());

            $client->logo = '/uploads/clients/'.time().'.'.$files->getClientOriginalExtension();
        }

        $client->user_id = auth()->id;
        
        $client->save();

        if($client) {
            return redirect()->route('clients.index');
        }

        return back()->withInput();
    }

    public function updateClient(Request $request, $id) 
    {
        //$input = $request->all();
        //dd($input);
        $client = Client::findOrFail($id);
        $client->name = $request->name;
        
        if($request->has('published') || $request->published = 'on'){
            $client->published = true;
        }

        $imagePath = public_path('/uploads/clients/');
        if($files = $request->file('file')) {
            if(file_exists($client->logo)){
                unlink(public_path($client->logo));
            }

            $imageUpload = Image::make($files);
            $imageUpload->resize(259,145);
            $imageUpload->save($imagePath.time().'.'.$files->getClientOriginalExtension());

            $client->logo = '/uploads/clients/'.time().'.'.$files->getClientOriginalExtension();
        }
        else {
            $client->logo = $client->logo;
        }



        $client->user_id = auth()->user()->id;
        
        $client->save();

        if($client) {
            return redirect()->route('clients.index');
        }

        return back()->withInput();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        abort(403);
    }

    public function markAs($id)
    {
        $client = Client::findOrFail($id);
        
        if(!is_null($client)) {
            $client->update([
                'published'    => request()->published
            ]);
        }
        
        return redirect()->route('clients.index');
    }
}
