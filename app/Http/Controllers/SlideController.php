<?php

namespace App\Http\Controllers;

use File;
use Image;
use App\Models\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slide::orderBy('created_at', 'desc')->get();
        return view('slide.index', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('slide.create');
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
            'banner'    =>  ['required'],
            'overlay_text_title'    =>  ['sometimes', 'nullable', 'max:50'],
            'overlay_text'  =>  ['sometimes', 'nullable', 'required_unless:overlay_text_title,'.!is_null($request->overlay_text_title), 'max:200'],
        ]); 

        $input = $request->all();
          
        try {

            $imagePath = public_path('/uploads/slides/');
            if(!File::isDirectory($imagePath)){

                File::makeDirectory($imagePath, 0777, true, true);
            }

            if($files = request()->file('banner')) {

                $imageUpload = Image::make($files);
                $imageUpload->resize(1375,560);
                $imageUpload->text(config('app.name'), 600, 280, function ($font) {
                    $font->file(public_path('assets/fonts/amandasignature.ttf'));
                    $font->size(35);
                    $font->color(array(255, 255, 255, 0.5));
                    $font->align('center'); 
                    $font->valign('top');
                    $font->angle(45);
                });
        
                $imageUpload->save($imagePath.time().'.'.$files->getClientOriginalExtension());
                
                $input['banner'] = '/uploads/slides/'.time().'.'.$files->getClientOriginalExtension();

                if($request->has('status') && $request->status == 'on') {
                    $input['status'] = true;
                }
                else {
                    $input['status'] = false;
                }

                auth()->user()->slide()->create($input);
            }

            return redirect()->route('slides.index');
        }
        catch(Exception $e) {
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function show(Slide $slide)
    {
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function edit(Slide $slide)
    {
        return view('slide.edit', compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slide $slide)
    {
        $slide->overlay_text_title = $request->overlay_text_title;
        $slide->overlay_text = $request->overlay_text;
        $slide->status = $request->status == 'on' ? 1 : 0;
        $slide->save();

        return redirect()->route('slides.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slide $slide)
    {
        abort(403);
    }

    public function markAs($id)
    {
        $slide = Slide::findOrFail($id);
        
        if(!is_null($slide)) {
            $slide->update([
                'status'    => request()->status
            ]);
        }
        
        return redirect()->route('slides.index');
    }
}
