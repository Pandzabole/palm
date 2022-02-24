<section id="b-portfolio">
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
                        <li><a href="#" data-filter=".proj-cat-mock-ups"> {{ $mainCategory->name }}</a></li>
                  @endforeach
                    @if($session === 'database-om' || $session === 'database-ar')
                        <li><a href="#" data-filter="*" class="b-filter_active">{{__('home-page.all-classes')}}</a></li>
                    @endif
                </ul>
            </div>




            <div class="row clearfix gallery" id="b-portfolio_isotop">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 proj-cat-mock-ups p-1">
                    <div class="b-portfolio_single">
                        <a href="portfolio-single.html" class="b-portfolio_link" rel=""></a>
                        <div class="b-portfolio_img b-img_zoom">
                            <img src="{{ asset('front-css/assets/images/classes/c11200x700.jpg') }}" class="img-fluid d-block" alt="">
                        </div>
                        <div class="b-portfolio_info">
                            <div class="b-portfolio_info_in home-classes-info" >
                                <h3 class="b-portfolio_title">
                                    <a href="portfolio-single.html" rel="">Class title</a>
                                </h3>
                                <h4 class="text-white text-uppercase">
                                    Class price
                                </h4>
                                <h4 class="text-white text-uppercase">
                                    Main category
                                </h4>
                                <h4 class="text-white text-uppercase">
                                    Sub category
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 proj-cat-mock-ups p-1">
                    <div class="b-portfolio_single">
                        <a href="portfolio-single.html" class="b-portfolio_link" rel=""></a>
                        <div class="b-portfolio_img b-img_zoom">
                            <img src="{{ asset('front-css/assets/images/classes/c11200x700.jpg') }}" class="img-fluid d-block" alt="">
                        </div>
                        <div class="b-portfolio_info">
                            <div class="b-portfolio_info_in home-classes-info" >
                                <h3 class="b-portfolio_title">
                                    <a href="portfolio-single.html" rel="">Class title</a>
                                </h3>
                                <h4 class="text-white text-uppercase">
                                    Class price
                                </h4>
                                <h4 class="text-white text-uppercase">
                                    Main category
                                </h4>
                                <h4 class="text-white text-uppercase">
                                    Sub category
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 proj-cat-mock-ups p-1">
                    <div class="b-portfolio_single">
                        <a href="portfolio-single.html" class="b-portfolio_link" rel=""></a>
                        <div class="b-portfolio_img b-img_zoom">
                            <img src="{{ asset('front-css/assets/images/classes/c11200x700.jpg') }}" class="img-fluid d-block" alt="">
                        </div>
                        <div class="b-portfolio_info">
                            <div class="b-portfolio_info_in home-classes-info" >
                                <h3 class="b-portfolio_title">
                                    <a href="portfolio-single.html" rel="">Class title</a>
                                </h3>
                                <h4 class="text-white text-uppercase">
                                    Class price
                                </h4>
                                <h4 class="text-white text-uppercase">
                                    Main category
                                </h4>
                                <h4 class="text-white text-uppercase">
                                    Sub category
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 proj-cat-mock-ups p-1">
                    <div class="b-portfolio_single">
                        <a href="portfolio-single.html" class="b-portfolio_link" rel=""></a>
                        <div class="b-portfolio_img b-img_zoom">
                            <img src="{{ asset('front-css/assets/images/classes/c11200x700.jpg') }}" class="img-fluid d-block" alt="">
                        </div>
                        <div class="b-portfolio_info">
                            <div class="b-portfolio_info_in home-classes-info" >
                                <h3 class="b-portfolio_title">
                                    <a href="portfolio-single.html" rel="">Class title</a>
                                </h3>
                                <h4 class="text-white text-uppercase">
                                    Class price
                                </h4>
                                <h4 class="text-white text-uppercase">
                                    Main category
                                </h4>
                                <h4 class="text-white text-uppercase">
                                    Sub category
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 proj-cat-mock-ups p-1">
                    <div class="b-portfolio_single">
                        <a href="portfolio-single.html" class="b-portfolio_link" rel=""></a>
                        <div class="b-portfolio_img b-img_zoom">
                            <img src="{{ asset('front-css/assets/images/classes/c11200x700.jpg') }}" class="img-fluid d-block" alt="">
                        </div>
                        <div class="b-portfolio_info">
                            <div class="b-portfolio_info_in home-classes-info" >
                                <h3 class="b-portfolio_title">
                                    <a href="portfolio-single.html" rel="">Class title</a>
                                </h3>
                                <h4 class="text-white text-uppercase">
                                    Class price
                                </h4>
                                <h4 class="text-white text-uppercase">
                                    Main category
                                </h4>
                                <h4 class="text-white text-uppercase">
                                    Sub category
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 proj-cat-mock-ups p-1">
                    <div class="b-portfolio_single">
                        <a href="portfolio-single.html" class="b-portfolio_link" rel=""></a>
                        <div class="b-portfolio_img b-img_zoom">
                            <img src="{{ asset('front-css/assets/images/classes/c11200x700.jpg') }}" class="img-fluid d-block" alt="">
                        </div>
                        <div class="b-portfolio_info">
                            <div class="b-portfolio_info_in home-classes-info" >
                                <h3 class="b-portfolio_title">
                                    <a href="portfolio-single.html" rel="">Class title</a>
                                </h3>
                                <h4 class="text-white text-uppercase">
                                    Class price
                                </h4>
                                <h4 class="text-white text-uppercase">
                                    Main category
                                </h4>
                                <h4 class="text-white text-uppercase">
                                    Sub category
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
