<div class="header">
    <div class="container">
        <div class="logo ">
            <div class="site-branding-text">
                <a href="{{ route('home') }}" target="_blank">
                    <h1>{{ getSetting('name') ? getSetting('name') : '' }}</h1>
                </a>
                <span class="tagline">Interior design with difference</span>
            </div>
        </div><!-- .logo -->
        <div class="header_right">
            <div class="toggle">
                <a class="toggleMenu" href="#">
                    Menu
                </a>
            </div><!-- toggle -->
            <div class="sitenav">
                <div class="menu-primary-container">
                    <ul id="menu-primary" class="menu">
                        <li id="menu-item-26" class="menu-item menu-item-type-custom menu-item-object-custom {{ Request::is('/') ? 'current-menu-item current_page_item' : '' }} menu-item-home menu-item-26">
                            <a href="{{ route('index') }}" aria-current="page">Home</a>
                        </li>
                        <li id="menu-item-480" class="{{ Request::is('about-us') ? 'current-menu-item current_page_item' : '' }} menu-item menu-item-type-post_type menu-item-object-page menu-item-480">
                            <a href="{{ route('aboutus') }}">About Us</a>
                        </li>
                        <li id="menu-item-481"
                            class="{{ Request::is('services') ? 'current-menu-item current_page_item' : '' }} menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-481">
                            <a href="{{ route('service') }}">Services</a>
                        </li>
                        <li id="menu-item-477"
                            class="{{ Request::is('trending-news') ? 'current-menu-item current_page_item' : '' }} menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-477">
                            <a href="{{ route('news') }}">Trending News</a>
                        </li>
                        <li id="menu-item-489"
                            class="{{ Request::is('project') ? 'current-menu-item current_page_item' : '' }} menu-item menu-item-type-post_type menu-item-object-page menu-item-489"><a
                                href="{{ route('project') }}">Projects</a></li>
                        <li id="menu-item-488"
                            class="{{ Request::is('gallery') ? 'current-menu-item current_page_item' : '' }} menu-item menu-item-type-post_type menu-item-object-page menu-item-488"><a
                                href="{{ route('gallery') }}">Gallery</a></li>
                        <li id="menu-item-478"
                            class="{{ Request::is('contact') ? 'current-menu-item current_page_item' : '' }} menu-item menu-item-type-post_type menu-item-object-page menu-item-478"><a
                                href="{{ route('contact') }}">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <!--.sitenav -->
        </div>
        <!--header_right-->
        <div class="clear"></div>
    </div><!-- .container-->

</div><!-- .header -->
