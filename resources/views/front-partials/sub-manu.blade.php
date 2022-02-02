<div class="container">
    <div class="clearfix row">
        <div class="col-xl-12 col-lg-12 col-mb-4 col-sm-12 col-xs-12 hidden-sm-down hidden-md-down">
            <div class="b-header_nav">
                <div class="b-menu_top_bar_container">
                    <div class="b-main_menu text-center pt-0">
                        <ul class="categories pl-0 mb-0 list-unstyled">
                            <!-- Mega menu -->
                            <!-- Top level items -->
                            <li class=" b-has_sub b-dropdown_wrapper from-bottom online-class-bg">
                                <a href="index.html" class=" description ">
                                    <span class="top online-class-color">{{__('home-page.on-line')}}</span></a>
                                <!-- Sub Menu items -->
                            </li>
                            <!-- Arts and Entertanemet -->
                            @foreach($mainCategories as $key => $mainCategory)
                                <li class=" b-has_sub b-dropdown_wrapper from-bottom">
                                    <a href="shop-grid-three.html" class=" description ">
                                        <span class="top">{{ $mainCategory->name }} </span><i
                                            class="fa fa-angle-down"></i></a>
                                    <!-- Sub Menu items -->
                                    @foreach($mainCategory->classSubCategory as $classSub)
                                        @if($classSub->name)
                                            <div class="b-dropdown_content sub-holder @if($key > 2) dropdown-menu-right @else dropdown-menu-left @endif dropdown-menu-width">
                                                <div class="dropdown-inner">
                                                    <div class="row">
                                                        @foreach($mainCategory->classSubCategory as $classSub)
                                                            <div class="col-xs-12 col-sm-4">
                                                                <div class="menu-item">
                                                                    <div class="categories">
                                                                        <div class="row">
                                                                            <div class="col-sm-12 hover-menu">
                                                                                <ul>
                                                                                    <li>
                                                                                        <a href="{{ route('sub-classes', $classSub->uuid) }}">{{$classSub->name}}</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
