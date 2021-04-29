<?php

namespace App\Http\Controllers;

use App\Models\WhyChooseUs;
use Illuminate\Http\Request;

class WhyChooseUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $choices = WhyChooseUs::get();
        return view('whychooseus.index', compact('choices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
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
            'icon'  =>  ['required'],
            'heading'   =>  ['required'],
            'description'   => ['required']
        ]);

        $choice = auth()->user()->whychooseus()->create($request->all());

        if($choice){
            return redirect()->route('coreValues.index');
        }

        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WhyChooseUs  $whyChooseUs
     * @return \Illuminate\Http\Response
     */
    public function show(WhyChooseUs $whyChooseUs)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WhyChooseUs  $whyChooseUs
     * @return \Illuminate\Http\Response
     */
    public function edit(WhyChooseUs $coreValue)
    {
        $choice = $coreValue;
        $choices = WhyChooseUs::get();
        return view('whychooseus.edit', compact('choice', 'choices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WhyChooseUs  $whyChooseUs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WhyChooseUs $whyChooseUs)
    {
        $whyChooseUs->icon = $request->icon;
        $whyChooseUs->heading = $request->heading;
        $whyChooseUs->description = $request->description;
        $whyChooseUs->user_id = auth()->user()->id;
        $whyChooseUs->save();

        return redirect()->route('coreValues.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WhyChooseUs  $whyChooseUs
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhyChooseUs $whyChooseUs)
    {
        abort(404);
    }
}
