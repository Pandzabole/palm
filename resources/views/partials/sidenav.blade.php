<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
{{--            <a class="navbar-brand" href="javascript:void(0)">--}}
{{--                <img src="{{ asset('img/logo_vodavoda.png') }}" class="navbar-brand-img" alt="...">--}}
{{--            </a>--}}
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                @if(!request()->routeIs('admins*'))
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('admin')) active @endif" href="{{route('dashboard')}}">
                                <i class="ni ni-tv-2 text-primary"></i>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('admin/pages*')) active @endif"
                               href="{{ route('pages.index') }}">
                                <i class="ni ni-books text-primary"></i>
                                <span class="nav-link-text">Menu</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('admin/classes*')) active @endif" href="#navbar-classes"
                               data-toggle="collapse" role="button"
                               @if(request()->is('admin/classes*')) aria-expanded="true"
                               @endif aria-controls="navbar-classes">
                                <i class="ni ni-single-copy-04 text-info"></i>
                                <span class="nav-link-text">Classes</span>
                            </a>
                            <div class="collapse @if(request()->is('admin/classes*')) show @endif" id="navbar-classes">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('classes.index') }}"
                                           class="nav-link @if(request()->is('admin/classes')) active @endif">
                                            <span class="sidenav-normal"> Classes </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('main-categories.index') }}"
                                           class="nav-link @if(request()->is('admin/main-categories')) active @endif">
                                            <span class="sidenav-normal"> Main categories </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sub-categories.index') }}"
                                           class="nav-link @if(request()->is('admin/sub-categories')) active @endif">
                                            <span class="sidenav-normal"> Sub categories </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('admin/teachers*')) active @endif"
                               href="{{ route('teachers.index') }}">
                                <i class="ni ni-tablet-button text-primary"></i>
                                <span class="nav-link-text">Teachers</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('admin/page-components*')) active @endif"
                               href="#navbar-components" data-toggle="collapse" role="button"
                               @if(request()->is(['admin/page-component*'])) aria-expanded="true" @endif
                               aria-controls="navbar-components">
                                <i class="ni ni-ungroup text-info"></i>
                                <span class="nav-link-text">Pages</span>
                            </a>
                            <div class="collapse @if(request()->is('admin/page-components/*')) show @endif"
                                 id="navbar-components">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('components.show', 'home') }}"
                                           class="nav-link @if(request()->is('admin/page-components/home*')) active @endif">
                                            <span class="sidenav-normal"> Home </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('components.show', 'products') }}"
                                           class="nav-link @if(request()->is('admin/page-components/products*')) active @endif">
                                            <span class="sidenav-normal"> Products </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('components.show', 'contact') }}"
                                           class="nav-link @if(request()->is('admin/page-components/contact*')) active @endif">
                                            <span class="sidenav-normal"> Contact </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('components.show', 'our-water') }}"
                                           class="nav-link @if(request()->is('admin/page-components/our-water*')) active @endif">
                                            <span class="sidenav-normal"> Our water </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('admin/products*')) active @endif"
                               href="{{route('products.index')}}">
                                <i class="fas fa-wine-bottle text-primary"></i>
                                <span class="nav-link-text">Products</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('admin/news*')) active @endif" href="#navbar-news"
                               data-toggle="collapse" role="button"
                               @if(request()->is('admin/news*')) aria-expanded="true"
                               @endif aria-controls="navbar-news">
                                <i class="ni ni-single-copy-04 text-info"></i>
                                <span class="nav-link-text">News</span>
                            </a>
                            <div class="collapse @if(request()->is('admin/news*')) show @endif" id="navbar-news">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('news.index') }}"
                                           class="nav-link @if(request()->is('admin/news')) active @endif">
                                            <span class="sidenav-normal"> News </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('news-categories.index') }}"
                                           class="nav-link @if(request()->is('admin/news-categories')) active @endif">
                                            <span class="sidenav-normal"> News Categories </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('admin/activ*')) active @endif"
                               href="#navbar-activities"
                               data-toggle="collapse" role="button"
                               @if(request()->is('admin/activ*')) aria-expanded="true"
                               @endif aria-controls="navbar-activities">
                                <i class="ni ni-ui-04 text-info"></i>
                                <span class="nav-link-text">Activities</span>
                            </a>
                            <div class="collapse @if(request()->is('admin/activi*')) show @endif"
                                 id="navbar-activities">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('activities.index') }}"
                                           class="nav-link @if(request()->is('admin/activities')) active @endif">
                                            <span class="sidenav-normal"> Activities </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('activity-categories.index') }}"
                                           class="nav-link @if(request()->is('admin/activity-categories')) active @endif">
                                            <span class="sidenav-normal"> Activity Categories </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('admin/sliders*')) active @endif"
                               href="{{ route('sliders.index') }}">
                                <i class="ni ni-image text-primary"></i>
                                <span class="nav-link-text">Slider</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('admin/certificates*')) active @endif"
                               href="{{ route('certificates.index') }}">
                                <i class="ni ni-paper-diploma text-primary"></i>
                                <span class="nav-link-text">Certificates</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('markets.index') }}"
                               class="nav-link @if(request()->is('admin/markets*')) active @endif">
                                <i class="ni ni-square-pin text-primary"></i>
                                <span class="nav-link-text">Markets</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('contacts.index', 'contacts') }}"
                               class="nav-link @if(request()->is('admin/contacts*')) active @endif">
                                <i class="ni ni-email-83 text-primary"></i>
                                <span class="sidenav-normal"> Contacts </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('admin/misc-information*')) active @endif"
                               href="{{route('misc-information.index')}}">
                                <i class="ni ni-align-center text-primary"></i>
                                <span class="nav-link-text">Other information</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('admin/meta-data*')) active @endif"
                               href="{{route('meta-data.index')}}">
                                <i class="ni ni-world-2 text-primary"></i>
                                <span class="nav-link-text">Meta data</span>
                            </a>
                        </li>
                    </ul>
                @else
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('admin/admins*')) active @endif"
                               href="{{route('admins.index')}}">
                                <i class="ni ni-circle-08 text-primary"></i>
                                <span class="nav-link-text">Admins</span>
                            </a>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </div>
</nav>
