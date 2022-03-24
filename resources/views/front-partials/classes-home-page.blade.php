<section id="b-portfolio">
    @if(count($homeClasses) > 5)
    <div class="b-portfolio_grid b-portfolio_grid_full mb-1">
        <div class="b-section_title text-center">
            <h2 class="text-uppercase">
                {{__('home-page.local-classes')}}
            </h2>
        </div>
        <div class="container-fluid">
            <div class="col-sm-12 b-portfolio_filter">
                <ul class="b-masonry_filter list-inline text-center">
                    @if($session === 'database-en')
                        <li><a href="#" data-filter="*" class="b-filter_active">{{__('home-page.all-classes')}}</a></li>
                    @endif
                    @foreach($mainCategories as $key => $mainCategory)
                        <li><a href="{{ route('main-category', ['lang' => $selectedLanguageLayout, $mainCategory->uuid]) }}" data-filter=".proj-cat-mock-ups"> {{ $mainCategory->name }}</a></li>
                  @endforeach
                    @if($session === 'database-om' || $session === 'database-ar')
                        <li><a href="#" data-filter="*" class="b-filter_active">{{__('home-page.all-classes')}}</a></li>
                    @endif
                </ul>
            </div>
                <div class="row clearfix gallery" id="b-portfolio_isotop">
                    @foreach($homeClasses as $class)
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 proj-cat-mock-ups p-1">
                        <div class="b-portfolio_single">
                            <a href="{{ route('single-class', $class->uuid) }}" class="b-portfolio_link" rel=""></a>
                            <div class="b-portfolio_img b-img_zoom">
                                <img src="{{ asset( $class->desktopImage()->getUrlResponsive('1200')) }}" class="img-fluid d-block" alt="">
                            </div>
                            <div class="b-portfolio_info">
                                <div class="b-portfolio_info_in home-classes-info" >
                                    <h3 class="b-portfolio_title">
                                        <a href="{{ route('single-class', $class->uuid) }}" rel="">{{ $class->name }}</a>
                                    </h3>
                                    <h4 class="text-white text-uppercase">
                                        {{ $class->classCategory->name }}
                                    </h4>
                                    <h4 class="text-white text-uppercase">
                                        {{ $class->classSubCategory->name }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
        </div>
    </div>
    @endif
</section>
