<div id="footer-wrapper">
    <div class="container footer">
        <div class="cols-3">
            <div class="widget-column-1">
                <h5>About Us</h5>
                <p>{!! getSetting('about_us') ? Str::limit(getSetting('about_us'), 350) : '' !!}</p>
                <div class="clear"></div>
            </div>

            <div class="widget-column-2">
                <h5>Latest Posts</h5>
                <ul class="recent-post">
                    @forelse ($latestwo_post as $post)
                        <li>
                            <a href="it-is-a-long-established-fact/index.htm">
                                <div class="footerthumb">
                                    <img src="{{ URL::to($post->picture) }}" alt="" width="70" height="auto">
                                </div>
                            </a>
                            <strong>
                                <a href="it-is-a-long-established-fact/index.htm">
                                    {{ $post->title }}
                                </a>
                            </strong>
                            {!! Str::limit($post->body, 60) !!}
                        </li>
                    @empty
                        <li>
                            <strong>No Trending News Found!</strong>
                        </li>
                    @endforelse
                </ul>
            </div>

            <div class="widget-column-3">
                <h5>Contact Info</h5>
                <div class="contactdetail">
                    <p><i class="fa fa-map-marker"></i> {{ getSetting('address') ? getSetting('address') : '' }}</p>
                    <p><i class="fa fa-phone"></i>{{ getSetting('phone') ? getSetting('phone'): '' }}</p>
                    <p><i class="fa fa-envelope"></i><a href="mailto:{{ getSetting('email') }}">{{ getSetting('email') ? getSetting('email') : '' }}</a></p>
                </div>

                <div class="social-icons">
                    @if (!is_null(getSetting('fb_url'))) <a href="{{ getSetting('fb_url') }}" target="_blank" class="fa fa-facebook" title="facebook"></a> @endif
                    @if (!is_null(getSetting('twitter_url'))) <a href="{{ getSetting('twitter_url') }}" target="_blank" class="fa fa-twitter" title="twitter"></a> @endif
                    @if (!is_null(getSetting('google_url')) && !empty(getSetting('google_url'))) <a href="{{ getSetting('google_url') }}" target="_blank" class="fa fa-google-plus" title="google-plus"></a> @endif
                    @if (!is_null(getSetting('insta_url')) && !empty(getSetting('insta_url'))) <a href="{{ getSetting('insta_url') }}" target="_blank" class="fa fa-instagram" title="instagram"></a> @endif
                    @if (!is_null(getSetting('linkedin_url'))) <a href="{{ getSetting('linkedin_url') }}" target="_blank" class="fa fa-linkedin" title="linkedin"></a> @endif
                </div>
            </div>

            <div class="clear"></div>
        </div>
        <!--end .cols-4-->

        <div class="clear"></div>

    </div>
    <!--end .container-->

    <div class="copyright-wrapper">
        <div class="container">
            <div class="copyright-txt"> Copyright &copy; @if(date('Y') === date('Y')) {{ date('Y') }}. @else 2021 - {{ date('Y') }} @endif All rights reserved</div>
            <div class="design-by">Design by <a href="https://keensoen.ng/" target="_blank">KeennessSolutions</a></div>
            <div class="clear"></div>
        </div>
    </div>

</div>
