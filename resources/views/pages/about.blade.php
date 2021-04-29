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
                        <p>This is an example page. It&#8217;s different from a blog post because it will stay
                            in one place and will show up in your site navigation (in most themes). Most people
                            start with an About page that introduces them to potential site visitors. It might
                            say something like this:</p>
                        <blockquote>
                            <p>Hi there! I&#8217;m a bike messenger by day, aspiring actor by night, and this is
                                my website. I live in Los Angeles, have a great dog named Jack, and I like
                                pi&#241;a coladas. (And gettin&#8217; caught in the rain.)</p>
                        </blockquote>
                        <p>&#8230;or something like this:</p>
                        <blockquote>
                            <p>The XYZ Doohickey Company was founded in 1971, and has been providing quality
                                doohickeys to the public ever since. Located in Gotham City, XYZ employs over
                                2,000 people and does all kinds of awesome things for the Gotham community.</p>
                        </blockquote>
                        <p>As a new WordPress user, you should go to <a
                                href="http://localhost/www/Mythemes/StudyCircle/wp-admin/">your dashboard</a> to
                            delete this page and create new pages for your content. Have fun!</p>
                    </div><!-- .entry-content -->
                </article><!-- #post-## -->
            </div>
            <div id="sidebar">

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

            </div><!-- sidebar -->
            <div class="clear"></div>
        </div>
    </div>
@endsection
