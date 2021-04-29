<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Client;
use App\Models\News;
use App\Models\Slide;
use App\Models\Team;
use App\Models\Service;
use App\Models\Project;
use App\Models\Gallery;
use App\Models\WhyChooseUs;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class FrontierController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        $news = News::inRandomOrder()->limit(4)->wherePublished(true)->latest()->get();
        $slides = Slide::inRandomOrder()->limit(3)->whereStatus(true)->get();
        $choices = WhyChooseUs::inRandomOrder()->limit(3)->whereStatus(true)->get();
        $services = Service::whereServiceType(Service::SERVICE)->limit(4)->inRandomOrder()->whereStatus(true)->get();
        $categories = Service::whereServiceType(Service::CATEGORY)->limit(4)->inRandomOrder()->whereStatus(true)->get();

        $clients = Client::inRandomOrder()->limit(10)->wherePublished(true)->latest()->get();
        $teams = Team::inRandomOrder()->limit(4)->wherePublished(true)->latest()->get();
        $projects = Project::inRandomOrder()->limit(8)->wherePublished(true)->latest()->get();
        $testimonials = Testimonial::inRandomOrder()->limit(4)->wherePublished(true)->latest()->get();
        //$galleries = Gallery::inRandomOrder()->limit(8)->latest()->get();
        $galleries = DB::table('galleries')
                ->join('services', 'galleries.referred', '=', 'services.id')
                    ->select('galleries.picture', 'services.heading', 'services.service_type')
                    ->where('galleries.type', '=', 'category')->where('services.service_type', '=', Service::CATEGORY)
                    ->inRandomOrder()->limit(8)
                    ->get();

        $gales = DB::table('galleries')
            ->join('services', 'galleries.referred', '=', 'services.id')
                ->select('galleries.picture', 'services.heading')
                ->where('galleries.type', '=', 'category')->where('services.service_type', '=', Service::CATEGORY)
                ->groupBy('services.service_type', 'galleries.picture', 'services.heading')
                ->inRandomOrder()->limit(8)
                ->get();

        //count stat
        $clientCount = Client::count();
        $projectCount = Project::count();

        $latestwo_post = News::latest()->limit(2)->get();

        return view('pages.home', compact(
                'slides', 'categories', 'choices', 'services', 'news', 'teams',
                'testimonials', 'clients', 'projects', 'clientCount', 'projectCount', 'galleries',
                'gales', 'latestwo_post'
            )
        );
    }

    public function aboutus()
    {
        $latestwo_post = News::latest()->limit(2)->get();

        return view('pages.about', compact('latestwo_post'));
    }

    public function service()
    {
        $latestwo_post = News::latest()->limit(2)->get();
        $services = Service::whereServiceType(Service::SERVICE)->get();

        return view('pages.service', compact('latestwo_post'));
    }

    public function news()
    {
        $latestwo_post = News::latest()->limit(2)->get();
        $posts = News::latest()->orderBy('created_at', 'desc')->paginate(4);

        return view('pages.news', compact('latestwo_post', 'posts'));
    }

    public function project()
    {
        $projects = Project::latest()->orderBy('created_at', 'desc')->paginate(4);
        $latestwo_post = News::latest()->limit(2)->get();

        return view('pages.project', compact('latestwo_post', 'projects'));
    }

    public function gallery()
    {
        $latestwo_post = News::latest()->limit(2)->get();
        $galleries = DB::table('galleries')
                ->join('services', 'galleries.referred', '=', 'services.id')
                    ->select('galleries.picture', 'services.heading', 'services.service_type')
                    ->where('galleries.type', '=', 'category')->where('services.service_type', '=', Service::CATEGORY)
                    ->inRandomOrder()->limit(32)
                    ->get();

        $gales = DB::table('galleries')
            ->join('services', 'galleries.referred', '=', 'services.id')
                ->select('galleries.picture', 'services.heading')
                ->where('galleries.type', '=', 'category')->where('services.service_type', '=', Service::CATEGORY)
                ->groupBy('services.service_type', 'galleries.picture', 'services.heading')
                ->get();


        return view('pages.gallery', compact('latestwo_post', 'galleries', 'gales'));
    }

    public function contact()
    {
        $latestwo_post = News::latest()->limit(2)->get();

        return view('pages.contact', compact('latestwo_post'));
    }
}
