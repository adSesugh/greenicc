<?php

namespace App\Http\Controllers;

use File;
use Image;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::get();
        return view('project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project.create');
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
            'title' => ['required'],
            'body'  => ['required'],
            'picture'   => ['required'],
        ]);

        $input = $request->all();

        $imagePath = public_path('/uploads/projects/');
        if(!File::isDirectory($imagePath)){

            File::makeDirectory($imagePath, 0777, true, true);
        }

        if($files = request()->file('picture')) {

            $imageUpload = Image::make($files);
            $imageUpload->resize(330,220);
            $imageUpload->save($imagePath.time().'.'.$files->getClientOriginalExtension());

            $input['picture'] = '/uploads/projects/'.time().'.'.$files->getClientOriginalExtension();

            if($request->has('published') && $request->published == 'on') {
                $input['published'] = true;
            }
            else {
                $input['published'] = false;
            }
        }

        $project = auth()->user()->project()->create($input);

        if($project) {
            return redirect()->route('projects.index');
        }

        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $project = Project::with(['gallery'])->findOrFail($project->id);
        return view('project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('project.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $project)
    {
        $project = Project::findOrFail($project);
        $project->title = $request->title;
        $project->body = $request->body;
        
        if($request->has('published') || $request->published == 'on')
        {
            $project->published = true;
        }
        else {
            $project->published = false;
        }

        $imagePath = public_path('/uploads/projects/');
        if($files = $request->file('picture')) {

            if(file_exists($project->picture)){
                unlink(public_path($project->picture));
            }

            $imageUpload = Image::make($files);
            $imageUpload->resize(270,347);
            $imageUpload->save($imagePath.time().'.'.$files->getClientOriginalExtension());

            $project->picture = '/uploads/projects/'.time().'.'.$files->getClientOriginalExtension();
        }

        $project->user_id = auth()->user()->id;
        
        $project->save();

        if($project) {
            return redirect()->route('projects.index');
        }

        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index');
    }

    public function markAs($id)
    {
        $project = Project::findOrFail($id);
        
        if(!is_null($project)) {
            $project->update([
                'published'    => request()->published
            ]);
        }
        
        return redirect()->route('projects.index');
    }
}
