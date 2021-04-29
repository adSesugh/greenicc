<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') | {{ config('app.name') }}</title>
    @include('layouts.frontier.partials.scripts')
    @include('layouts.frontier.partials.css')

    <style>
        .is-invalid {
            border: 1px solid rgb(194, 28, 28);
        }
        input:invalid {
            border-color: red;
        }
    </style>

</head>

<body id="top" class="home blog pagelayer-body">
    <div id="pagewrap">

        @include('layouts.frontier.partials.aheader')

        @include('layouts.frontier.partials.header')

        @yield('content')


        @include('layouts.frontier.partials.footer')
        <div id="back-top">
            <a title="Top of Page" href="#top"><span></span></a>
        </div>
        <script type='text/javascript' src='front/js/wp-embed.min.js?ver=5.5.3' id='wp-embed-js'></script>
    </div>
</body>

</html>
