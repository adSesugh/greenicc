<?php

namespace App\Http\Controllers;

use File;
use Image;
use App\Models\News;
use App\Models\Project;
use App\Models\Service;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::orderBy('created_at', 'desc')->paginate(50);
        return view('media.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('media.add');
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
            'picture'   =>  ['required'],
            'referred'      =>  ['required'],
            'category'          =>  ['required']
        ]);

        $input = $request->all();
        $imagePath = public_path('/uploads/gallery/');

        if(!File::isDirectory($imagePath)){
            File::makeDirectory($imagePath, 0777, true, true);
        }

        foreach ($request->picture as $value) {
            
            if($files = $value) {

                $imageUpload = Image::make($files);
                $imageUpload->resize(800,533);
                $imageUpload->save($imagePath.time().'-'.$request->category.'.'.$files->getClientOriginalExtension());

                $input['picture'] = '/uploads/gallery/'.time().'-'.$request->category.'.'.$files->getClientOriginalExtension();
            }

            $input['type'] = $request->category;

            auth()->user()->gallery()->create($input);
        }

        return redirect()->route('media.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        abort(403);
    }

    public function getType()
    {
        $ctype = request()->type;

        if($ctype == 'news') {
            $types = News::orderBy('created_at', 'desc')->pluck('title', 'id')->all();
        }
        elseif($ctype == 'project') {
            $types = Project::orderBy('created_at', 'desc')->pluck('title', 'id')->all();
        }
        elseif($ctype == 'service') {
            $types = Service::orderBy('created_at', 'desc')->whereServiceType(Service::SERVICE)->pluck('heading', 'id')->all();
        }
        elseif($ctype == 'category') {
            $types = Service::orderBy('created_at', 'desc')->whereServiceType(Service::CATEGORY)->pluck('heading', 'id')->all();
        }

        return response()->json($types);
    }
}
