<div class="header-top">
    <div class="container">
        <div class="left"><i class="fa fa-phone"></i> {{ getSetting('phone') ? getSetting('phone') : '' }} <span class="phno"><a
                    href="mailto:{{getSetting('email')}}"><i class="fa fa-envelope"></i>{{ getSetting('email') }}</a></span>
        </div>
        <div class="right">
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
</div>
<!--end header-top-->
