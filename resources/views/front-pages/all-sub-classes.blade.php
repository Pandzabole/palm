@extends('front-layout.app')

@section('content')

    <div class="b-wrapper">
        <div class="b-page-title-wrap class-header-text mt-1">
            @if($singleClass)
                <h1 class="b-page-title text-center">{{ $singleClass->classCategory->name}} classes</h1>

            @else
                <h1 class="b-page-title text-center">{{__('single-class.no-classes')}} </h1>
            @endif

        </div>

        <div class="container container-single-class">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    @if($singleClass)
                        <div class="b-decent-title-wrap">
                            <div class="b-decent-title">
                                <span>{{ $singleClass->classSubCategory->name}} classes</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @if($singleClass)
            <div class="container  container-single-class">
                <div class="row clearfix b-shop_head">
                    <div class="col-xl-6 col-lg-6 col-mb-6 col-sm-6 col-xs-12">
                        <nav class="b-shop_breadcrumb">
                            <a href="#">Home</a>
                            <span> Shop</span>
                        </nav>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-mb-6 col-sm-6 col-xs-12 text-right">
                        <p class="b-result_count d-inline-block hidden-md-down">
                            Showing 1–12 of 292 results
                        </p>
                        <div class="b-filter_button d-inline-block">
                            <a href="javascript:;" class="b-open_filters b-btn_open">Additional filters</a>
                        </div>
                    </div>
                </div>
                <div class="b-filters_area mt-2">
                    <div class="b-filters_inner_area">
                        <div class="row clearfix">
                            <div class="col-xl-4 col-lg-4 col-mb-4 col-sm-12 col-xs-12">
                                <h5 class="b-filter_title">Sort by</h5>
                                <form action="#">
                                    <ul>
                                        <li><a href="#">Popularity</a></li>
                                        <li><a href="#">Discounted</a></li>
                                        <li><a href="#">Newness</a></li>
                                        <li><a href="#">Price: low to high</a></li>
                                        <li><a href="#">Price: high to low</a></li>
                                    </ul>
                                </form>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-mb-4 col-sm-12 col-xs-12">
                                <h5 class="b-filter_title">FILTER BY CLASS LOCATION</h5>
                                    <ul>
                                        @foreach($classLocation as $location)
                                            <li><a href="{{ route('location-filter', [$location->uuid, $mainCategories[0]->classSubCategory[0]->uuid]) }}"> {{$location->location}} </a></li>
                                        @endforeach
                                    </ul>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-mb-4 col-sm-12 col-xs-12">
                                <h5 class="b-filter_title">FILTER BY SKILL LEVEL</h5>
                                <ul>
                                    @foreach($classLevel as $level)
                                        <li><a href="{{ route('level-filter', [$level->uuid, $mainCategories[0]->classSubCategory[0]->uuid]) }}">{{ $level->level }} </a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="b-products b-product_grid b-product_grid_four mb-4">
            <div class="container container-single-class">
                <div class="row clearfix">
                    @foreach($classes as $class)
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="b-product_grid_single">
                                <div class="b-product_grid_header">
                                    <a href="{{ route('single-class', $class->uuid) }}">
                                        <img src="{{ asset( $class->desktopImage()->getUrl()) }}" class="" alt=""
                                             style="">
                                    </a>
                                    <div class="b-product_grid_action">
                                    </div>
                                </div>
                                <div class="b-product_grid_info">
                                    <h3 class="product-title text-center">
                                        <a href="{{ route('single-class', $class->id) }}">{{ $class->name }}</a>
                                    </h3>
                                    <div class="clearfix text-center">
                                        <div class="b-product_grid_toggle  text-center">
                                            @if($session === 'database-ar')
                                                <span
                                                    class="b-price price-style text-center">AED {{ $class->price_sar }} </span>
                                            @endif
                                            @if($session === 'database-en')
                                                <span class="b-price price-style text-center">{{ $class->price_usd }} $ or {{ $class->price_eur }} €</span>
                                            @endif
                                            @if($session === 'database-om')
                                                <span
                                                    class="b-price price-style text-center">OMR {{ $class->price_omr }}</span>
                                            @endif
                                            <span class="b-add_cart">
                                          <i class="icon-eye icons">
                                          <a href="{{ route('single-class', $class->id) }}">{{ $class->classLevel->level}}</a></i>
                                      </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="text-center">
                {{ $classes->links() }}
            </div>
        </div>
    </div>
@endsection
