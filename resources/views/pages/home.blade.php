@extends('layouts.frontier.app')

@section('title') Home @stop

@section('css')
<!-- Magnific popup -->
<link href="{{URL::to('assets/plugins/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')

@include('layouts.frontier.partials.slide')

@if(isset($categories) && count($categories) == 4)
    <section id="pagearea">
        <div class="container">
            @foreach ($categories as $category)
                    <div class="fourbox ">
                        <div class="thumbbx"><a href="#"><img src="{{($category->cover)}}" alt=""></a></div>
                        <div class="pagecontent">
                            <a href="#">
                                <h3>{{$category->heading}}</h3>
                            </a>
                            <p>{!! Str::limit($category->description, 100, $end="...") !!}</p>
                        </div>
                    </div>
                @endforeach
            <div class="clear"></div>
        </div><!-- .container -->
    </section><!-- #pagearea -->
@endif

@if(isset($choices) && count($choices) > 0)
    <section style="background-color:#111111; " id="section1" class="menu_page">
        <div class="container">
            <div class="sectio1nwrap">
                <div class="one_half"><img src="{{getSetting('whyus_background')}}" alt=""></div>

                <div class="one_half last_column">
                    <h3>Why Choose Us</h3>
                    @foreach ($choices as $choice)
                        <div class="featureslists">
                            <i class="{{$choice->icon}}"></i>
                            <h5>{{$choice->heading}}</h5>
                            <p>{!! $choice->description !!}</p>
                        </div>
                    @endforeach
                </div>
            </div><!-- .end section class -->
            <div class="clear"></div>
        </div><!-- container -->
    </section>
@endif

@if(isset($services) && count($services) >= 3)
    <section style="background-color:#f6f4f4; " id="whoweareasection" class="menu_page">
        <div class="container">
            <div class="themefeatures">
                <h2 class="section_title">Our Best Services</h2>
                @foreach ($services as $service)
                    <div class="one_third"><i class="{!! $service->icon !!}"></i>
                        <h4>{{ $service->heading }}</h4> {!! Str::limit($service->description, 150, $end="...") !!}
                    </div>
                @endforeach
            </div><!-- .end section class -->
            <div class="clear"></div>
        </div><!-- container -->
    </section>
@endif

@if(isset($galleries) && count($galleries) > 0)
    <section style="background-color:#ffffff; " id="portfoliosection" class="menu_page">
        <div class="container">
            <div class="gallerywrap">
                <h2 class="section_title">Photo Gallery</h2>
                <div class="photobooth">
                    <ul class="portfoliofilter clearfix">
                        <li><a class="selected" data-filter="*" href="#">Show All</a><span></span></li>
                        @foreach ($gales as $gallery)
                            <li><a data-filter=".{{Str::slug($gallery->heading)}}" href="#">{{$gallery->heading}}</a></li>
                        @endforeach
                    </ul>
                    <div class="row fourcol portfoliowrap">
                        <div class="portfolio zoom-gallery">
                            @foreach ($galleries as $gal)
                                <div class="entry {{Str::slug($gal->heading)}}">
                                    <div class="holderwrap">
                                        <a href="{{URL::to($gal->picture)}}"
                                            data-rel="prettyPhoto[bkpGallery]"><img
                                                src="{{URL::to($gal->picture)}}"></a>
                                        <h5>{{$gal->heading}}</h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div><!-- .end section class -->
            <div class="clear"></div>
        </div><!-- container -->
    </section>
@endif

<section
    style="background-color:#f2f1f1; background-image:url(front/images/promobg.jpg); background-repeat:no-repeat; background-position: center top; background-attachment:fixed; background-size:cover; "
    id="section4" class="menu_page">
    <div class="container">
        <div class="promowrap">
            <h3><span>Join us with interior Decoration and</span> Make Your Home More Attractive!</h3>
            <div class="custombtn" style="text-align:center">
                <a class="morebutton" href="#" target""="">Join Us</a>
            </div>
        </div><!-- .end section class -->
        <div class="clear"></div>
    </div><!-- container -->
</section>

@if(isset($news) && count($news) > 0)
    <section style="background-color:#ffffff; " id="newswraper" class="menu_page">
        <div class="container">
            <div class="blogpostwrap">
                <h2 class="section_title">latest News</h2>
                <div class="fourcolumn-news">
                    @foreach ($news as $item)
                        <div class="news-box  ">
                            <div class="news-thumb">
                                <a href=""><img
                                        src="{{URL::to($item->picture)}}" alt=""></a>
                                <span class="home-post-comment"><i class="fa fa-comment"></i>@if($item->newsComment) {{ count($item->newsComment) }} @endif</span>
                            </div>
                            <div class="news">
                                <a href="it-is-a-long-established-fact/index.htm">
                                    <h6>{{ Str::limit($item->title, 100, $end="...") }}</h6>
                                </a>
                                <div class="post-admin-date">
                                    <span class="post-admin">Posted By {{$item->user->name}}</span>
                                    <span class="post-date">{{ strtotime($item->created_at) }}</span>
                                    <div class="clear"></div>
                                </div>
                                {!! Str::limit($item->body, 120, $end="...") !!}
                                <a href="" class="pagemore">Read more</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div><!-- .end section class -->
            <div class="clear"></div>
        </div><!-- container -->
    </section>
@endif

<section
    style="background-color:#cccccc; background-image:url(front/images/skillbg.jpg); background-repeat:no-repeat; background-position: center top; background-attachment:fixed; background-size:cover; "
    id="skillwrap" class="menu_page">
    <div class="container">
        <div class="counterwrap">
            <div class="one_half">
                <h5>Nulla consequat massa quis enim.Donec pede justo, fringilla vel, aliquet nec, vulputate
                    eget, arcu fringilla.</h5>
            </div>

            <div class="one_half last_column">
                <div class="counterlist">
                    <i class="fa fa-check-square-o"></i>
                    <div class="counter">{{$projectCount}}</div>
                    <h6>Projects Completed</h6>
                </div>
                <div class="counterlist">
                    <i class="fa fa-group"></i>
                    <div class="counter">{{$clientCount}}</div>
                    <h6>Satisfied Clients</h6>
                </div>
                <div class="counterlist">
                    <i class="fa fa-book"></i>
                    <div class="counter">{{getSetting('brands')}}</div>
                    <h6>Total Brands</h6>
                </div>
                <div class="counterlist">
                    <i class="fa fa-graduation-cap"></i>
                    <div class="counter">{{getSetting('awards')}}</div>
                    <h6>Architect Awards</h6>
                </div>
            </div>
        </div><!-- .end section class -->
        <div class="clear"></div>
    </div><!-- container -->
</section>
@if(isset($teams) && count($teams) == 4)
    <section style="background-color:#f2f1f1; " id="teamwrap" class="menu_page">
        <div class="container">
            <div class="teacherwrap">
                <h2 class="section_title">Our Team</h2>
                @foreach ($teams as $team)
                    <div class="teammember-list">
                        <div class="thumnailbx">
                            <a class="hvr-grow" href="our-team/team-4/index.htm"><img width="270"
                                    height="347" src="{{URL::to($team->picture)}}"
                                    class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""
                                    loading="lazy"
                                    srcset="{{URL::to($team->picture)}} 270w, {{URL::to($team->picture)}} 233w"
                                    sizes="(max-width: 270px) 100vw, 270px">
                                </a>
                        </div>
                        <div class="titledesbox">
                            <span class="title">{{$team->name}}</span>
                            <cite>{{$team->position}}</cite>
                        </div>
                        {{-- <div class="member-social-icon">
                            <a href="#" title="facebook" target="_blank"><i class="fa fa-facebook fa-lg"></i></a>
                            <a href="#" title="twitter" target="_blank"><i class="fa fa-twitter fa-lg"></i></a>
                            <a href="#" title="linkedin" target="_blank"><i class="fa fa-linkedin fa-lg"></i></a>
                        </div> --}}
                    </div>
                @endforeach
                <div class="clear"></div>
            </div><!-- .end section class -->
            <div class="clear"></div>
        </div><!-- container -->
    </section>
@endif

@if(isset($testimonials) && count($testimonials) > 0)
    <section
        style="background-image:url(front/images/testimonials-bg.jpg); background-repeat:no-repeat; background-position: center top; background-attachment:fixed; background-size:cover; "
        id="testimonialswrap" class="menu_page">
        <div class="container">
            <div class="tmnlwraparea">
                <h2 class="section_title">Client Testimonials</h2>
                <div id="clienttestiminials">
                    <div class="owl-carousel">
                        @foreach ($testimonials as $testy)
                            <div class="item">
                                <div class="tmthumb"><a href=""><img src="@if($testy->picture) {{URL::to($testy->picture)}} @else {{URL::to('front/images/team1.jpg')}} @endif" alt=""></a></div>
                                <p>{!! $testy->testimony !!}</p>
                                <h6><a href="">{{$testy->name}}</a></h6>
                                <span>{{$testy->position}}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div><!-- .end section class -->
            <div class="clear"></div>
        </div><!-- container -->
    </section>
@endif

@if(isset($clients) && count($clients) > 0)
    <section
        style="background-color:#ffffff; background-image:url(front/images/clientsbg.jpg); background-repeat:no-repeat; background-position: center top; background-attachment:fixed; background-size:cover; "
        id="ourclients" class="menu_page">
        <div class="container">
            <div class="clientwrap">
                <h2 class="section_title">Our Clients</h2>
                <ul id="flexiselDemo3">
                    @foreach ($clients as $client)
                        <li><a href="" target="_blank"><img src="{{URL::to($client->logo)}}"></a>
                            <h5>{{$client->name}}</h5>
                        </li>
                    @endforeach
                </ul>
            </div><!-- .end section class -->
            <div class="clear"></div>
        </div><!-- container -->
    </section>
@endif

@if(isset($projects) && count($projects) > 0)
    <section style="background-color:#ffffff; " id="projectsection" class="menu_page">
        <div class="container">
            <div class="projectwrap">
                <h2 class="section_title">Our Projects</h2>
                <div class="recentproject_list">
                    @foreach ($projects as $project)
                        <div class="item ">
                            <figure class="effect-bubba"><a href="" target="_blank">
                                    <h5>{{$project->title}}</h5><span>View</span>
                                    <img src="{{URL::to($project->picture)}}">
                                </a>
                                <figcaption></figcaption>
                            </figure>
                        </div>
                    @endforeach
                </div>
            </div><!-- .end section class -->
            <div class="clear"></div>
        </div><!-- container -->
    </section>
@endif
@stop

@section('script')
 <!-- Magnific popup -->
 <script src="{{URL::to('assets/plugins/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
 <script src="{{URL::to('assets/pages/lightbox.js')}}"></script>
@endsection