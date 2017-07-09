<!DOCTYPE html>
<html>
    <head>
        @include('v2.utils.sharing')
        @include('v2.utils.favicons')
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta id="globalprops" name="globalprops" content="
            {{
                rawurlencode(json_encode([
                    'token' => csrf_token(),
                    'info' => session('info'),
                    'allowedTags' => config('site.allowedtags'),
                    'maxfilesize' => config('site.maxfilesize'),
                    'promo' => config('promo')
                ])) 
            }}
        ">
        <link rel="stylesheet" href="{{ dist('css') }}">
        <link rel="sitemap" type="application/xml" title="Sitemap" href="/sitemap.xml" />
        <!-- TradeDoubler site verification 2960089 -->
    </head>
    <body>
        @include('v2.utils.svg')
        <div id="app" class="background-{{ $color }}">
            @yield('background')
            @yield('promobar')
            @yield('header')
            {!! component('HeaderError') !!}
            @yield('content')
            @yield('footer')
            {!! component('PhotoFullscreen') !!}
            {!! component('Alert') !!}
        </div>
        <script src="{{ dist('vendor') }}"></script>
        <script src="{{ dist('js') }}"></script>
        @include('v2.utils.promo')
        @include('v2.utils.facebook')
        @include('v2.utils.googleTag')
        @include('v2.utils.analytics')
        @include('v2.utils.hotjar')
        @stack('scripts')
    </body>
</html>
