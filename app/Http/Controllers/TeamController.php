<?php

namespace App\Http\Controllers;

use File;
use Image;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::get();
        return view('team.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('team.create');
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
            'name'  =>  ['required'],
            'role'  =>  ['required'],
            'picture'   => ['sometimes', 'nullable'],
            'fb_url'    =>  ['sometimes', 'url', 'nullable'],
            'twitter_ur'    =>  ['sometimes', 'url', 'nullable'],
            'linkedin_url'  =>  ['sometimes', 'url', 'nullable'],
            'insta_url' =>  ['sometimes', 'url', 'nullable']
        ]);

        $input = $request->all();

        try {

            $imagePath = public_path('/uploads/team/');
            if(!File::isDirectory($imagePath)){

                File::makeDirectory($imagePath, 0777, true, true);
            }

            if($files = request()->file('picture')) {

                $imageUpload = Image::make($files);
                $imageUpload->resize(270,347);
                $imageUpload->text(config('app.name'), 200, 280, function ($font) {
                    $font->file(public_path('assets/fonts/amandasignature.ttf'));
                    $font->size(50);
                    $font->color(array(255, 255, 255, 0.5));
                    $font->align('center'); 
                    $font->valign('top');
                    $font->angle(45);
                });
        
                $imageUpload->save($imagePath.time().'.'.$files->getClientOriginalExtension());
                
                $input['picture'] = '/uploads/team/'.time().'.'.$files->getClientOriginalExtension();
            }

            if($request->has('published') && $request->status == 'on') {
                $input['published'] = true;
            }
            else {
                $input['published'] = false;
            }

            auth()->user()->team()->create($input);

            return redirect()->route('teams.index');
        }
        catch(Exception $e) {
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        return view('team.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $team->name = $request->name;
        $team->role = $request->role;
        
        if($request->has('published') || $request->published = 'on'){
            $team->published = true;
        }
        else {
            $team->published = false;
        }

        if($files = $request->file('picture')) {

            if(file_exists($team->picture)){
                unlink(public_path($team->picture));
            }

            $imageUpload = Image::make($files);
            $imageUpload->resize(270,347);
            $imageUpload->save($imagePath.time().'.'.$files->getClientOriginalExtension());

            $team->logo = '/uploads/team/'.time().'.'.$files->getClientOriginalExtension();
        }

        $team->user_id = auth()->user()->id;
        
        $team->save();

        if($team) {
            return redirect()->route('teams.index');
        }

        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        abort(403);
    }

    public function markAs($id)
    {
        $team = Team::findOrFail($id);
        
        if(!is_null($team)) {
            $team->update([
                'published'    => request()->published
            ]);
        }
        
        return redirect()->route('teams.index');
    }
}
