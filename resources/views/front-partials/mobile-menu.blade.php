<!-- MOBILE MENU-->
@if($session === 'database-om' || $session === 'database-ar')
    <div class="b-main_menu-wrapper hidden-lg-up" style="max-width: 100%" >

@else
    <div class="b-main_menu-wrapper hidden-lg-up">
@endif
    <ul class="mobile-top">
        <li class="search">
            <div class="search-holder-mobile">
                <input type="text" name="search-mobile" value="" placeholder="Search" class="form-control">
                <a class="fa fa-search"></a>
            </div>
        </li>
    </ul>
    <ul class="categories @if($session === 'database-om' || $session === 'database-ar') text-right @else text-center @endif ">
        <li>
            <a href="{{ route('home', ['lang' => $selectedLanguageLayout]) }}"><span class="top">{{__('home-page.home')}}</span></a>
        </li>
        <!-- Top level items -->
        <li class=" has-sub dropdown-wrapper from-bottom">
            @if($session === 'database-om' || $session === 'database-ar')
                <a href="shop-grid-three.html"><span class="top"><span class="fa fa-angle-down mr-2"></span>{{__('home-page.all-classes')}}</span></a>

            @else
                <a href="shop-grid-three.html"><span class="top">{{__('home-page.all-classes')}}</span><i class="fa fa-angle-down"></i></a>
        @endif
            <!-- Sub Menu items -->
            <div class="dropdown-content sub-holder dropdown-left narrow">
                <div class="dropdown-inner">
                    <div class="clearfix">
                        <div class="col-xs-12 col-sm-12 ">
                            <div class="menu-item">
                                <div class="categories">
                                    <div class="clearfix">
                                        <div class="col-sm-12 hover-menu">
                                            <ul>
                                                @foreach($mainCategories as $key => $mainCategory)
                                                    <li><a href="{{ route('main-category', ['lang' => $selectedLanguageLayout, $mainCategory->uuid]) }}">{{ $mainCategory->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <a href="blog-default.html"><span class="top">{{__('home-page.mount-offer')}}</span></a>
        </li>
        <li>
            <a href="{{route('contact-us', ['lang' => $selectedLanguageLayout])}}"><span class="top">{{__('home-page.contact')}}</span></a>
        </li>
    </ul>
        <buttton class="btn-close-mobile-menu" id="close-mobile-menu">{{__('home-page.close')}}</buttton>
</div>

@yield('mobile-menu')
