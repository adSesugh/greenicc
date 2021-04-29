<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $enqCount = Enquiry::count();
        $clientCount = Client::count();
        $projectCount = Project::count();

        $enqArray = Enquiry::latest()->limit(5)->get();

        return view('home', compact('projectCount', 'clientCount', 'enqCount', 'enqArray'));
    }
}
