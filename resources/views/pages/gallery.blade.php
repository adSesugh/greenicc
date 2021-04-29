@extends('layouts.frontier.app')

@section('title') Gallery @stop

@section('content')
    @include('layouts.frontier.partials.breadcrumb')
    <div class="container content-area">
        <div class="middle-align">
            <div class="site-main sitefull">

                <article id="post-475" class="post-475 page type-page status-publish hentry">
                    <header class="entry-header">
                        <h1 class="entry-title">Gallery</h1>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <div class="photobooth">
                            <ul class="portfoliofilter clearfix">
                                <li><a class="selected" data-filter="*" href="#">Show All</a><span></span></li>
                                @foreach ($gales as $gallery)
                                    <li><a data-filter=".{{Str::slug($gallery->heading)}}" href="#">{{$gallery->heading}}</a></li>
                                @endforeach
                            </ul>
                            <div class="row fourcol portfoliowrap">
                                <div class="portfolio">
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
                    </div><!-- .entry-content -->
                </article><!-- #post-## -->
            </div>
            <div class="clear"></div>
        </div>
    </div>
@endsection
