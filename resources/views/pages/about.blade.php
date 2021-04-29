@extends('layouts.frontier.app')

@section('title') About Us @stop

@section('content')
    @include('layouts.frontier.partials.breadcrumb')
    <div class="container content-area">
        <div class="middle-align content_sidebar">
            <div class="site-main" id="sitemain">

                <article id="post-6" class="post-6 page type-page status-publish hentry">
                    <header class="entry-header">
                        <h1 class="entry-title">About Us</h1>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                       {!! getSetting('about_us') ? getSetting('about_us') : '' !!}
                    </div><!-- .entry-content -->
                </article><!-- #post-## -->
            </div>
            {{-- <div id="sidebar">

                <h3 class="widget-title">Category</h3>
                <aside id="categories" class="widget">
                    <ul>
                        <li class="cat-item cat-item-1"><a
                                href="../category/uncategorized/index.htm">Uncategorized</a>
                        </li>
                    </ul>
                </aside>

                <h3 class="widget-title">Archives</h3>
                <aside id="archives" class="widget">
                    <ul>
                        <li><a href='../2016/05/index.htm'>May 2016</a></li>
                    </ul>
                </aside>

            </div><!-- sidebar --> --}}
            <div class="clear"></div>
        </div>
    </div>
@endsection
