@extends('front-layout.app')

@section('content')
    <div class="b-wrapper">
        <div class="b-page-title-wrap class-header-text mt-1">
            @if($singleClass)
                <h1 class="b-page-title text-center">{{ $singleClass->classCategory->name}}</h1>

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
                                <span>{{ $singleClass->classCategory->name}}</span>
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
                            Showing 1–12 of {{ count($classes) }} results
                        </p>
                        <div class="b-filter_button d-inline-block">
                            <a href="javascript:;" class="b-open_filters b-btn_open">{{__('single-class.additional-filter')}}</a>
                        </div>
                    </div>
                </div>
                <div class="b-filters_area mt-2 main-filters">
                    <div class="b-filters_inner_area">
                        <div class="row clearfix">
                            <div class="col-xl-4 col-lg-4 col-mb-4 col-sm-12 col-xs-12">
                                <h5 class="b-filter_title @if($session === 'database-om' || $session === 'database-ar') text-right @else text-left @endif">{{__('single-class.sort-by')}}</h5>
                                <ul class="@if($session === 'database-om' || $session === 'database-ar') text-right @else text-left @endif">
                                    <li><a href="{{ route('discount-classes-main', ['lang' => $selectedLanguageLayout, $uuid]) }}" class="filter-font text-left">{{__('single-class.discount')}}</a></li>
                                    <li><a href="{{ route('popular-classes-main', ['lang' => $selectedLanguageLayout, $uuid]) }}" class="filter-font">{{__('single-class.popularity')}}</a></li>
                                    <li><a href="{{ route('low-to-high-price-main', ['lang' => $selectedLanguageLayout, $uuid]) }}" class="filter-font">{{__('single-class.price-low')}}</a></li>
                                    <li><a href="{{ route('high-to-low-price-main', ['lang' => $selectedLanguageLayout, $uuid]) }}" class="filter-font">{{__('single-class.price-high')}}</a></li>
                                </ul>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-mb-4 col-sm-12 col-xs-12">
                                <h5 class="b-filter_title @if($session === 'database-om' || $session === 'database-ar') text-right @else text-left @endif">{{__('single-class.filter-location')}}</h5>
                                <ul class="@if($session === 'database-om' || $session === 'database-ar') text-right @else text-left @endif">
                                    @foreach($classLocation as $location)
                                        <li>
                                            <a href="{{ route('location-filter-main', ['lang' => $selectedLanguageLayout, $location->uuid, $uuid]) }}" class="filter-font"> {{$location->location}} </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-mb-4 col-sm-12 col-xs-12">
                                <h5 class="b-filter_title @if($session === 'database-om' || $session === 'database-ar') text-right @else text-left @endif">{{__('single-class.filter-skill-level')}}</h5>
                                <ul class="@if($session === 'database-om' || $session === 'database-ar') text-right @else text-left @endif">
                                    @foreach($classLevel as $level)
                                        <li>
                                            <a href="{{ route('level-filter-main', ['lang' => $selectedLanguageLayout, $level->uuid, $uuid]) }}" class="filter-font">{{ $level->level }} </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="container  container-single-class">
            <section id="b-portfolio">
                <div class="b-portfolio_grid b-portfolio_grid_full mb-1">
                    <div class="container-fluid">
                        <div class="row clearfix gallery" id="b-portfolio_isotop">

                            @foreach($classes as $class)
                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-xs-12 proj-cat-mock-ups  class-main-div-picture">
                                    <div class="b-portfolio_single">
                                        <h5 class="@if($session === 'database-om' || $session === 'database-ar') text-right @else text-left @endif pt-2">
                                            <span
                                                class="main-text-font-single"> {{ $class->name }}
                                            </span>
                                        </h5>
                                        <a href="{{ route('single-class', ['lang' => $selectedLanguageLayout, $class->uuid]) }}" class="b-portfolio_link"
                                           rel=""></a>
                                        <div class="b-portfolio_img b-img_zoom">
                                            <img src="{{ asset( $class->mobileImage()->getUrlResponsive('1200')) }}"
                                                 class="img-fluid d-block" alt="{{ $class->name }}">
                                        </div>
                                        @if($class->discount === true)
                                            <div class="b-product_labels b-labels_rounded b-new discounted-badge">
                                                <span class="b-product_label"><strong> % </strong></span>
                                            </div>
                                        @endif
                                        <div class="price-discount">
                                            <h5 class="pt-2">
                                                <span class="price-book-class main-text-font @if($class->discount === true)decoration-line-through @endif"> {{ $class->price_eur }} € or </span>
                                                <span class="price-book-class main-text-font @if($class->discount === true)decoration-line-through @endif"> {{ $class->price_usd }}  $ </span>
                                                @if($class->discount === true)
                                                    <br>
                                                    <span class="main-text-font"> {{ $class->priceCalculate($class->price_eur, $class->discount_percentage) }} € or</span>
                                                    <span class="main-text-font"> {{ $class->priceCalculate($class->price_usd, $class->discount_percentage) }} $ </span>
                                                @endif
                                            </h5>
                                        </div>
                                        <div class="b-portfolio_info @if($class->discount === true) b-portfolio_info-custom-discount @else b-portfolio_info-custom @endif">
                                            <div class="b-portfolio_info_in home-classes-info">
                                                <h3 class="b-portfolio_title">
                                                    <a href="{{ route('single-class', ['lang' => $selectedLanguageLayout, $class->uuid])}}"
                                                       rel="">{{ $class->name }}</a>
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
                                    <h5 class="@if($session === 'database-om' || $session === 'database-ar') text-right @else text-left @endif pt-2">
                                        @if($session === 'database-om' || $session === 'database-ar')
                                            @foreach($class->locations as $location)
                                                {{ $location->location }}
                                            @endforeach
                                            <i class="icon-location-pin custom-icon-location"></i>
                                            <br>
                                            {{ $class->teacher->name }} : <i class="icon-notebook custom-icon-location"></i>
                                        @else
                                            <i class="icon-location-pin custom-icon-location"></i>
                                            @foreach($class->locations as $location)
                                                <span class="main-text-font-single">{{ $location->location }}</span>
                                            @endforeach
                                            <br>
                                            <i class="icon-notebook custom-icon-location"></i> <span class="main-text-font-single"> : {{ $class->teacher->name }}</span>

                                        @endif
                                    </h5>
                                    <hr class="hr-underline-`eur` hr-under-line-mobile">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    {{ $classes->links() }}
                </div>
            </section>
        </div>
    </div>
@endsection

