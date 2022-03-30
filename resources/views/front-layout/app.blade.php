<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <!-- PAGE TITLE -->
    <title>Palm Skils</title>

    @include('front-partials.meta-data')
    @include('front-partials.css-links')
</head>
<body>
@include('front-partials.mobile-menu')
<div class="b-wrapper">
    <header id="b-header">
        @include('front-partials.main-navigation')
    </header>
    @include('front-partials.sub-manu')
    @yield('content')
    @include('front-partials.footer')
    @include('front-partials.search')
</div>
@include('front-partials.js-links')
</body>
</html>
