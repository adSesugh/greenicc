@extends('layouts.frontier.app')

@section('title') Contact Us @stop

@section('content')
    @include('layouts.frontier.partials.breadcrumb')
    <div class="container content-area">
        <div class="middle-align">
            <div class="site-main sitefull">
                <header class="entry-header">
                    <h1 class="entry-title">Contact Us</h1>
                </header><!-- .entry-header -->
                <div class="contact_left">
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <div class="main-form-area" id="contactform_main">
                        <form name="contactform" action="{{ route('pstore') }}" method="post">
                            @csrf
                            <p>
                                <input type="text" name="name" placeholder="Name" class="form-control @error('name') invalid @enderror">
                            </p>
                            <p>
                                <input type="email" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror">
                            </p>
                            <div class="clear"></div>
                            <p>
                                <input type="tel" name="phone" placeholder="Phone" class="form-control @error('phone') is-invalid @enderror">
                            </p>
                            <div class="clear"></div>
                            <p>
                                <textarea name="message" placeholder="Message" class="form-control @error('message') is-invalid @enderror"></textarea>
                            </p>
                            <div class="clear"></div>
                            <p class="sub"><input type="submit" name="c_submit" value="Submit" class="search-submit"></p>
                        </form>
                    </div>

                </div><!-- .contact_left -->
                <div class="contact_right">
                    <h3 class="widget-title">Contact Info</h3>
                    <div class="contactdetail">
                        <p><i class="fa fa-map-marker"></i>{{ getSetting('address') ? getSetting('address') : '' }}</p>


                        <p><i class="fa fa-phone"></i>{{ getSetting('phone') ? getSetting('phone') : '' }}</p>

                        <p><i class="fa fa-envelope"></i><a href="mailto:{{ getSetting('email') }}">{{ getSetting('email') ? getSetting('email') : '' }}</a></p>

                    </div>

                </div><!-- .contact_right -->
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
@endsection
