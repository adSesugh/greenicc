<?php

namespace App\Http\Controllers;

use Str;
use File;
use Image;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = News::get();
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
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

        $imagePath = public_path('/uploads/posts/');
        if(!File::isDirectory($imagePath)){

            File::makeDirectory($imagePath, 0777, true, true);
        }

        if($files = request()->file('picture')) {

            $imageUpload = Image::make($files);
            $imageUpload->resize(330,220);
            $imageUpload->save($imagePath.time().'.'.$files->getClientOriginalExtension());

            $input['picture'] = '/uploads/posts/'.time().'.'.$files->getClientOriginalExtension();
        }

        if($request->has('published') && $request->published == 'on') {
            $input['published'] = true;
        }
        else {
            $input['published'] = false;
        }

        $input['slug'] = Str::slug($request->title);

        $post = auth()->user()->news()->create($input);

        if($post) {
            return redirect()->route('news.index');
        }

        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        $news = News::with(['newsComment'])->findOrFail($news->id);
        return view('post.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('post.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $news->title = $request->title;
        $news->body = $request->body;

        if($request->has('published') || $request->published == 'on'){
            $news->published = true;
        }
        else {
            $news->published = false;
        }

        $imagePath = public_path('/uploads/posts/');
        if($files = $request->file('picture')) {

            if(file_exists($news->picture)){
                unlink(public_path($news->picture));
            }

            $imageUpload = Image::make($files);
            $imageUpload->resize(270,347);
            $imageUpload->save($imagePath.time().'.'.$files->getClientOriginalExtension());

            $news->picture = '/uploads/posts/'.time().'.'.$files->getClientOriginalExtension();
        }

        $news->user_id = auth()->user()->id;

        $news->save();

        if($news) {
            return redirect()->route('news.index');
        }

        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('news.index');
    }

    public function markAs($id)
    {
        $post = News::findOrFail($id);

        if(!is_null($post)) {
            $post->update([
                'published'    => request()->published
            ]);
        }

        return redirect()->route('news.index');
    }
}

