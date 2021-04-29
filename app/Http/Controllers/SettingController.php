<?php

namespace App\Http\Controllers;

use File;
use Image;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::find(1);

        if($setting) {
            return view('setting.index', compact('setting'));
        }
        else {
            return view('setting.form');
        }
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
            'name'    =>  ['required'],
            'logo'    =>  ['required'],
            'breadcrumb'   => ['required'],
            'whyus_background'  => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
        ]); 

        $input = $request->all();
          
        try {

            $imagePath = public_path('/uploads/setting/');
            if(!File::isDirectory($imagePath)){

                File::makeDirectory($imagePath, 0777, true, true);
            }

            if($files = request()->file('logo')) {

                $imageUpload = Image::make($files);
                //$imageUpload->resize(330,220);
                $imageUpload->save($imagePath.time().'-logo.'.$files->getClientOriginalExtension());

                $input['logo'] = '/uploads/setting/'.time().'-logo.'.$files->getClientOriginalExtension();
            }

            if($breadcrumb = request()->file('breadcrumb')) {

                $imageUpload1 = Image::make($breadcrumb);
                $imageUpload1->resize(1420,286);
                $imageUpload1->save($imagePath.time().'-breadcrumb.'.$breadcrumb->getClientOriginalExtension());

                $input['breadcrumb'] = '/uploads/setting/'.time().'-breadcrumb.'.$breadcrumb->getClientOriginalExtension();
            }

            if($whyus = request()->file('whyus_background')) {

                $imageUpload2 = Image::make($whyus);
                $imageUpload2->resize(740,475);
                $imageUpload2->save($imagePath.time().'-bg.'.$whyus->getClientOriginalExtension());

                $input['whyus_background'] = '/uploads/setting/'.time().'-bg.'.$whyus->getClientOriginalExtension();
            }

            Setting::create($input);

            return redirect()->route('settings.index');
        }
        catch(Exception $e) {
            return back()->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $setting = Setting::findOrFail($request->id);
        $setting->name = $request->name;
        $setting->phone = $request->phone;
        $setting->email = $request->email;
        $setting->address = $request->address;
        $setting->fb_url = $request->fb_url ? $request->fb_url : NULL;
        $setting->twitter_url = $request->twitter_url ? $request->twitter_url : NULL;
        $setting->insta_url = $request->insta_url ? $request->insta_url : NULL;
        $setting->google_url = $request->google_url ? $request->google_url : NULL;
        $setting->linkedin_url = $request->linkedin_url ? $request->linkedin_url : NULL;
        $setting->about_us = $request->about_us;
        
        $imagePath = public_path('/uploads/setting/');

        if($files = request()->file('logo')) {

            if(file_exists($setting->logo)){
                unlink(public_path($setting->logo));
            }

            $imageUpload = Image::make($files);
            //$imageUpload->resize(330,220);
            $imageUpload->save($imagePath.time().'-logo.'.$files->getClientOriginalExtension());

            $setting->logo = '/uploads/setting/'.time().'-logo.'.$files->getClientOriginalExtension();
        }

        if($breadcrumb = request()->file('breadcrumb')) {

            if(file_exists($setting->breadcrumb)){
                unlink(public_path($setting->breadcrumb));
            }

            $imageUpload1 = Image::make($breadcrumb);
            $imageUpload1->resize(1420,286);
            $imageUpload1->save($imagePath.time().'-breadcrumb.'.$breadcrumb->getClientOriginalExtension());

            $setting->breadcrumb = '/uploads/setting/'.time().'-breadcrumb.'.$breadcrumb->getClientOriginalExtension();
        }

        if($whyus = request()->file('whyus_background')) {

            if(file_exists($setting->whyus_background)){
                unlink(public_path($setting->whyus_background));
            }

            $imageUpload2 = Image::make($whyus);
            $imageUpload2->resize(740,475);
            $imageUpload2->save($imagePath.time().'-bg.'.$whyus->getClientOriginalExtension());

            $setting->whyus_background = '/uploads/setting/'.time().'-bg.'.$whyus->getClientOriginalExtension();
        }
        
        $setting->save();

        if($setting) {
            return redirect()->route('settings.index');
        }

        return back()->withInput();
    }
}
