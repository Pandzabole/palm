<div class="b-header b-header_main">
    <div class="container">
        <div class="clearfix row">
            <div class="col-xl-3 col-lg-3 col-mb-3 col-sm-12 col-xs-6">
                <div class="b-logo text-sm-left text-lg-center text-xl-center">
                    <a href="index.html" class="d-inline-block"><img src="{{ asset('front-css/assets/images/logo.png') }}" class="img-fluid d-block" alt=""></a>
                </div>
            </div>
            <div class="col-xl-5 col-lg-5 col-mb-5 col-sm-12 col-xs-12 hidden-sm-down hidden-md-down">
                <div class="b-header_nav">
                    <div class="b-menu_top_bar_container">
                        @if($session === 'database-om' || $session === 'database-ar')
                            <div class="b-main_menu text-center">
                                <ul class="categories pl-0 mb-0 list-unstyled">
                                    <li class="b-has_sub b-dropdown_wrapper from-bottom nav-link @if(request()->is('contact-us*')) active @endif">
                                        <a href="{{route('contact-us', ['lang' => $selectedLanguageLayout])}}"><span class="top">{{__('home-page.contact')}} </span></a>
                                    </li>
                                    <li class=" b-has_sub b-dropdown_wrapper from-bottom">
                                        <a href="shop-grid-three.html" class=" description ">
                                            <span class="top">{{__('home-page.mount-offer')}}</span><i class="menu-tag sale">{{__('home-page.discount')}}</i></a>
                                        <div class="b-dropdown_content sub-holder dropdown-left" style="width: 992px;"></div>
                                    </li>
                                    <li class=" b-has_sub b-dropdown_wrapper from-bottom">
                                        <a href="{{ route('all-classes', ['lang' => $selectedLanguageLayout]) }}" class=" description ">
                                            <span class="top">{{__('home-page.all-classes')}}</span></a>
                                    </li>
                                    <li class=" b-has_sub b-dropdown_wrapper from-bottom">
                                        <a href="{{ route('home', ['lang' => $selectedLanguageLayout]) }}" class=" description ">
                                            <span class="top">{{__('home-page.home')}}</span></a>
                                    </li>

                                </ul>
                            </div>
                        @else
                            <div class="b-main_menu text-center">
                                <ul class="categories pl-0 mb-0 list-unstyled">
                                    <!-- Mega menu -->
                                    <!-- Top level items -->
                                    <li class=" b-has_sub b-dropdown_wrapper from-bottom">
                                        <a href="{{ route('home', ['lang' => $selectedLanguageLayout]) }}" class=" description ">
                                            <span class="top">{{__('home-page.home')}}</span></a>
                                        <!-- Sub Menu items -->
                                    </li>
                                    <!-- Top level items -->
                                    <li class=" b-has_sub b-dropdown_wrapper from-bottom">
                                        <a href="{{ route('all-classes', ['lang' => $selectedLanguageLayout]) }}" class=" description ">
                                            <span class="top">{{__('home-page.all-classes')}}</span></a>
                                    </li>
                                    <!-- Mountly offer -->
                                    <li class=" b-has_sub b-dropdown_wrapper from-bottom">
                                        <a href="shop-grid-three.html" class=" description ">
                                            <span class="top">{{__('home-page.mount-offer')}}</span><i class="menu-tag sale">{{__('home-page.discount')}}</i></a>
                                        <!-- Sub Menu items -->
                                        <div class="b-dropdown_content sub-holder dropdown-left" style="width: 992px;"></div>
                                    </li>
                                    <!-- Top level items -->
                                    <li class="b-has_sub b-dropdown_wrapper from-bottom nav-link @if(request()->is('contact-us*')) active @endif">
                                        <a href="{{route('contact-us', ['lang' => $selectedLanguageLayout])}}"><span class="top">{{__('home-page.contact')}} </span></a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-mb-4 col-sm-12 col-xs-6">
                @if (isset($selectedLanguageLayout))
                    <div class="b-header_right">

                        <a href="{{ route('set-language-layout', ['lang' => 'en']) }}">
                         <img class="language-flags d-inline @if($session === 'database-en') language-border @endif" src="{{ asset('img/en.svg') }}" alt="language-flags">
                       </a>

                        <a href="{{ route('set-language-layout', ['lang' => 'om']) }}">
                        <img class="language-flags d-inline @if($session === 'database-om') language-border @endif" src="{{ asset('img/om.svg') }}" alt="language-flags">
                        </a>

                        <a href="{{ route('set-language-layout', ['lang' => 'ar']) }}">
                        <img class="language-flags d-inline @if($session === 'database-ar') language-border @endif" src="{{ asset('img/sa.svg') }}" alt="language-flags">
                        </a>
                    </div>
                @endif
                <div class="b-header_right">
                    <div class="b-search_icon hidden-sm-down">
                        <a href="javascript:;" id="b-search_toggle" class="d-inline-block">
                            <i class="icon-magnifier icons"></i>
                        </a>
                    </div>
                    <div class="hidden-lg-up">
                        <i class="icon-menu icons b-nav_icon" id="b-nav_icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@yield('main-navigation')
