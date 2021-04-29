<?php

namespace App\Http\Controllers;

use App\Models\Service as BestService;
use Illuminate\Http\Request;

class BestServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bestServices = BestService::whereServiceType(BestService::SERVICE)->get();

        return view('best_service.index', compact('bestServices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('best_service.create');
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
            'heading'    =>  ['required', 'max:50'],
            'service'   => ['required'],
            'description'   => ['required'],
            'service_icon'  =>  ['sometimes', 'nullable', 'required_unless:service,'.!is_null($request->service)],
        ]); 

        $input = $request->all();
          
        try {

            $imagePath = public_path('/uploads/service/');
            if(!File::isDirectory($imagePath)){

                File::makeDirectory($imagePath, 0777, true, true);
            }

            if($files = request()->file('cover')) {

                $imageUpload = Image::make($files);
                $imageUpload->resize(330,220);
                $imageUpload->save($imagePath.time().'.'.$files->getClientOriginalExtension());

                $input['cover'] = '/uploads/service/'.time().'.'.$files->getClientOriginalExtension();

                if($request->has('status') && $request->status == 'on') {
                    $input['status'] = true;
                }
                else {
                    $input['status'] = false;
                }

                $input['service_type'] = Category::CATEGORY;

                auth()->user()->service()->create($input);
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
     * @param  \App\Models\BestService  $bestService
     * @return \Illuminate\Http\Response
     */
    public function show(BestService $bestService)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BestService  $bestService
     * @return \Illuminate\Http\Response
     */
    public function edit(BestService $bestService)
    {
        return view('best_Service.edit', compact('bestService'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BestService  $bestService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BestService $bestService)
    {
        $input = $request->all();
        if($files = $request->file('cover')) {

            if(file_exists($bestService->cover)){
                unlink(public_path($bestService->cover));
            }

            $imageUpload = Image::make($files);
            $imageUpload->resize(330,220);
            $imageUpload->save($imagePath.time().'.'.$files->getClientOriginalExtension());

            $input['cover'] = '/uploads/service/'.time().'.'.$files->getClientOriginalExtension();

            $bestService->cover = $input['cover'];
        }

        $bestService->heading = $request->heading;
        $bestService->description = $request->description;
        $bestService->status = $request->status == 'on' ? 1 : 0;
        $bestService->save();

        return redirect()->route('best_services.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BestService  $bestService
     * @return \Illuminate\Http\Response
     */
    public function destroy(BestService $bestService)
    {
        //
    }

    public function markAs($id)
    {
        $bestService = BestService::findOrFail($id);
        
        if(!is_null($bestService)) {
            $bestService->update([
                'status'    => request()->status
            ]);
        }
        
        return redirect()->route('best_services.index');
    }
}
