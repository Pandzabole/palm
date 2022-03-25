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

    <div class="b-search_popup search-custom-layout">
        <form role="search" method="get" id="searchform" class="searchform  basel-ajax-search" action="{{ route('search-class') }}" data-thumbnail="1" data-price="1" data-count="3">
            @csrf
            <div>
                <label class="screen-reader-text" for="s"></label>
                <input type="text" placeholder="Search for products" value="" name="search" id="s" autocomplete="off">
                <input type="hidden" name="post_type" id="post_type" value="product">
                <button type="submit" class="b-searchsubmit" id="b-searchsubmit">Search</button>
                <div class="search-result">rezultati</div>
                <div class="search-result">rezultati</div>
                <div class="search-result">rezultati</div>
                <div class="search-result">rezultati</div>
            </div>
        </form>
        <span class="b-close_search" id="b-close_search">close</span>
    </div>
</div>
    @include('front-partials.js-links')
</body>
</html>
