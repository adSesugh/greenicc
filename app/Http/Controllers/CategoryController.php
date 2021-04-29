<?php

namespace App\Http\Controllers;

use File;
use Image;
use App\Models\Service as Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::whereServiceType(Category::CATEGORY)->get();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
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
            'cover'    =>  ['required'],
            'heading'    =>  ['required', 'nullable', 'max:50'],
            'description'   => ['required'],
        ]); 

        $input = $request->all();
          
        try {

            $imagePath = public_path('/uploads/category/');
            if(!File::isDirectory($imagePath)){

                File::makeDirectory($imagePath, 0777, true, true);
            }

            if($files = request()->file('cover')) {

                $imageUpload = Image::make($files);
                $imageUpload->resize(330,220);
                $imageUpload->save($imagePath.time().'.'.$files->getClientOriginalExtension());

                $input['cover'] = '/uploads/category/'.time().'.'.$files->getClientOriginalExtension();

                if($request->has('status') && $request->status == 'on') {
                    $input['status'] = true;
                }
                else {
                    $input['status'] = false;
                }

                $input['service_type'] = Category::CATEGORY;

                auth()->user()->category()->create($input);
            }

            return redirect()->route('categories.index');
        }
        catch(Exception $e) {
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $input = $request->all();
        if($files = $request->file('cover')) {

            if(file_exists($category->cover)){
                unlink(public_path($category->cover));
            }

            $imageUpload = Image::make($files);
            $imageUpload->resize(330,220);
            $imageUpload->save($imagePath.time().'.'.$files->getClientOriginalExtension());

            $input['cover'] = '/uploads/category/'.time().'.'.$files->getClientOriginalExtension();

            $category->cover = $input['cover'];
        }

        $category->heading = $request->heading;
        $category->description = $request->description;
        $category->status = $request->status == 'on' ? 1 : 0;
        $category->save();

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        abort(404);
    }

    public function markAs($id)
    {
        $category = Category::findOrFail($id);
        
        if(!is_null($category)) {
            $category->update([
                'status'    => request()->status
            ]);
        }
        
        return redirect()->route('categories.index');
    }
}
