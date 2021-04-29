@extends('layouts.frontier.app')

@section('title') Service @stop

@section('content')
    @include('layouts.frontier.partials.breadcrumb')
    <div class="container content-area">
        <div class="middle-align">
            <div class="site-main" id="sitemain">
                <header>
                    <h1 class="entry-title">Service</h1>
                </header>
                @forelse ($services as $post)
                    <div class="blog-post-repeat">
                        <article id="post-476"
                            class="post-476 post type-post status-publish format-standard has-post-thumbnail hentry category-uncategorized">
                            <header class="entry-header">
                                <h3 class="post-title"><a href=""
                                        rel="bookmark">{{ $post->heading }}</a></h3>
                                <div class="postmeta">
                                    <div class="post-date">May 26, 2016</div><!-- post-date -->
                                    <div class="clear"></div>
                                </div><!-- postmeta -->
                                <div class="post-thumb"><a href=""><img
                                            width="150" height="150"
                                            src="{{ URL::to($post->cover) }}"
                                            class="alignleft wp-post-image" alt="" loading="lazy"></a></div>
                                <!-- post-thumb -->

                            </header><!-- .entry-header -->

                            <div class="entry-summary">
                                <p>{!! Str::limit($post->description, 250) !!}</p>
                                <p class="read-more"><a href="../it-is-a-long-established-fact/index.htm">Read more</a></p>
                            </div><!-- .entry-summary -->

                        </article><!-- #post-## -->
                        <div class="spacer20"></div>
                    </div>
                @empty
                    <div class="blog-post-repeat">
                       No Post found!
                        <div class="spacer20"></div>
                    </div><!-- blog-post-repeat -->
                @endforelse
            </div>
            {{-- <div id="sidebar">
                <div class="clear"></div>

                <h3 class="widget-title">Recent Posts</h3>
                <aside id="%1$s" class="widget %2$s">
                    <ul>
                        <li>
                            <a href="../it-is-a-long-established-fact/index.htm">It is a long established fact</a>
                        </li>
                        <li>
                            <a href="../lorem-ipsum-is-simply-dummy-text/index.htm">Lorem Ipsum is simply dummy text</a>
                        </li>
                        <li>
                            <a href="../this-is-an-example-page/index.htm">This is an example page.</a>
                        </li>
                        <li>
                            <a href="../most-people-start-with-an-about-page/index.htm">Most people start with an About
                                page</a>
                        </li>
                        <li>
                            <a href="../hello-world-2/index.htm">Hello world!</a>
                        </li>
                    </ul>

                    <div class="clear"></div>
                </aside>
                <h3 class="widget-title">Recent Comments</h3>
                <aside id="%1$s" class="widget %2$s">
                    <ul id="recentcomments">
                        <li class="recentcomments"><span class="comment-author-link"><a href='../../../index.htm'
                                    rel='external nofollow ugc' class='url'>Mr WordPress</a></span> on <a
                                href="../hello-world-2/index.htm#comment-2">Hello world!</a></li>
                    </ul>
                    <div class="clear"></div>
                </aside>
                <h3 class="widget-title">Archives</h3>
                <aside id="%1$s" class="widget %2$s">
                    <ul>
                        <li><a href='../2016/05/index.htm'>May 2016</a></li>
                    </ul>

                    <div class="clear"></div>
                </aside>
                <h3 class="widget-title">Categories</h3>
                <aside id="%1$s" class="widget %2$s">
                    <ul>
                        <li class="cat-item cat-item-1"><a href="../category/uncategorized/index.htm">Uncategorized</a>
                        </li>
                    </ul>

                    <div class="clear"></div>
                </aside>
                <h3 class="widget-title">Meta</h3>
                <aside id="%1$s" class="widget %2$s">
                    <ul>
                        <li><a href="../wp-login.php.html">Log in</a></li>
                        <li><a href="../feed/index.htm.rss">Entries feed</a></li>
                        <li><a href="../comments/feed/index.htm.rss">Comments feed</a></li>

                        <li><a href="../../../index.htm">WordPress.org</a></li>
                    </ul>

                    <div class="clear"></div>
                </aside>
            </div><!-- sidebar --> --}}
            <div class="clear"></div>
        </div>
    </div>
@endsection
