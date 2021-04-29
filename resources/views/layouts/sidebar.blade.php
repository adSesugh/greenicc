            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Main</li>
                            <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                                <a href="{{ route('home') }}" class="waves-effect">
                                    <i class="mdi mdi-view-dashboard"></i><span> @lang('messages.dashboard') </span>
                                </a>
                            </li>
                            <li class="{{ Request::is('slides') ? 'active' : '' }}">
                                <a href="{{ route('slides.index') }}" class="waves-effect">
                                    <i class="mdi ion-ios7-bookmarks-outline"></i><span> @lang('messages.slide_index') </span>
                                </a>
                            </li>
                            <li class="{{ Request::is('enquiries') ? 'active' : '' }}">
                                <a href="{{ route('enquiry.index') }}" class="waves-effect">
                                    <i class="mdi ion-folder"></i><span> @lang('messages.enquiry_menu') </span>
                                </a>
                            </li>
                            <li class="{{ Request::is('services/*') ? 'active' : '' }}">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ion-briefcase"></i><span> @lang('messages.service_menu') <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li class="{{ Request::is('*/categories') || Request::is('*/categories/*') ? 'active' : '' }}"><a href="{{ route('categories.index') }}"><i class="{{ Request::is('*/categories') ? 'ion-toggle-filled' : 'ion-toggle' }}"></i> @lang('messages.category')</a></li>
                                    <li class="{{ Request::is('*/best_services') || Request::is('*/best_services/*') ? 'active' : '' }}"><a href="{{ route('best_services.index') }}"><i class="{{ Request::is('*/best_services') ? 'ion-toggle-filled' : 'ion-toggle' }}"></i> @lang('messages.best_service')</a></li>
                                </ul>
                            </li>
                            <li class="{{ Request::is('coreValues') ? 'active' : '' }}">
                                <a href="{{ route('coreValues.index') }}" class="waves-effect">
                                    <i class="mdi ion-code-working"></i><span> @lang('messages.why_choose_us') </span>
                                </a>
                            </li>
                            <li class="{{ Request::is('teams') ? 'active' : '' }}">
                                <a href="{{ route('teams.index') }}" class="waves-effect">
                                    <i class="mdi ion-person-stalker"></i><span> @lang('messages.team_menu') </span>
                                </a>
                            </li>
                            <li class="{{ Request::is('clients') ? 'active' : '' }}">
                                <a href="{{ route('clients.index') }}" class="waves-effect">
                                    <i class="mdi ion-android-friends"></i><span> @lang('messages.client_menu') </span>
                                </a>
                            </li>
                            <li class="{{ Request::is('projects') ? 'active' : '' }}">
                                <a href="{{ route('projects.index') }}" class="waves-effect">
                                    <i class="mdi ion-android-promotion"></i><span> @lang('messages.project_menu') </span>
                                </a>
                            </li>
                            <li class="{{ Request::is('testimonials') ? 'active' : '' }}">
                                <a href="{{ route('testimonials.index') }}" class="waves-effect">
                                    <i class="mdi ion-android-hand"></i><span> @lang('messages.testimonial_menu') </span>
                                </a>
                            </li>
                            <li class="{{ Request::is('news') ? 'active' : '' }}">
                                <a href="{{ route('news.index') }}" class="waves-effect">
                                    <i class="mdi ion-ios7-chatboxes"></i><span> @lang('messages.news_menu') </span>
                                </a>
                            </li>
                            <li class="{{ Request::is('media') || Request::is('media*') ? 'active' : '' }}">
                                <a href="{{ route('media.index') }}" class="waves-effect">
                                    <i class="mdi ion-ios7-albums"></i><span> @lang('messages.media_menu') </span>
                                </a>
                            </li>
                            <li class="{{ Request::is('settings') ? 'active' : '' }}">
                                <a href="{{ route('settings.index') }}" class="waves-effect">
                                    <i class="mdi ion-ios7-albums"></i><span> @lang('messages.setting_menu') </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
