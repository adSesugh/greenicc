<?php

namespace App\Http\Controllers;

use File;
use Image;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::get();
        return view('testimonial.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('testimonial.create');
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
            'testimony' => ['required']
        ]);

        $input = $request->all();

        $imagePath = public_path('/uploads/testimonials/');
        if(!File::isDirectory($imagePath)){

            File::makeDirectory($imagePath, 0777, true, true);
        }

        if($files = request()->file('picture')) {

            $imageUpload = Image::make($files);
            $imageUpload->resize(233,300);
            $imageUpload->save($imagePath.time().'.'.$files->getClientOriginalExtension());

            $input['picture'] = '/uploads/testimonials/'.time().'.'.$files->getClientOriginalExtension();

        }

        if($request->has('published') && $request->published == 'on') {
            $input['published'] = true;
        }
        else {
            $input['published'] = false;
        }

        $testimonial = auth()->user()->testimonial()->create($input);

        if($testimonial) {
            return redirect()->route('testimonials.index');
        }

        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        return view('testimonial.edit', compact('testimonial'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $testimonial->name = $request->name;
        $testimonial->position = $request->position;
        
        if($request->has('published') || $request->published == 'on'){
            $testimonial->published = true;
        }
        else {
            $testimonial->published = false;
        }

        $imagePath = public_path('/uploads/testimonials/');
        if($files = $request->file('picture')) {

            if(file_exists($testimonial->picture)){
                unlink(public_path($testimonial->picture));
            }

            $imageUpload = Image::make($files);
            $imageUpload->resize(233,300);
            $imageUpload->save($imagePath.time().'.'.$files->getClientOriginalExtension());

            $testimonial->logo = '/uploads/testimonials/'.time().'.'.$files->getClientOriginalExtension();
        }

        $testimonial->user_id = auth()->user()->id;
        
        $testimonial->save();

        if($testimonial) {
            return redirect()->route('testimonials.index');
        }

        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        abort(403);
    }

    public function markAs($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        
        if(!is_null($testimonial)) {
            $testimonial->update([
                'published'    => request()->published
            ]);
        }
        
        return redirect()->route('testimonials.index');
    }
}
