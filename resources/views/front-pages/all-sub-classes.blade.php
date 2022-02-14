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
                    <div class="b-decent-title-wrap">
                        <div class="b-decent-title">
                            <span>{{ $singleClass->classSubCategory->name}} classes</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                        <a href="javascript:;" class="b-open_filters">Filters</a>
                    </div>
                </div>
            </div>
            <div class="b-filters_area mt-2">
                <div class="b-filters_inner_area">
                    <div class="row clearfix">
                        <div class="col-xl-3 col-lg-3 col-mb-3 col-sm-6 col-xs-12">
                            <h5 class="b-filter_title">Sort by</h5>
                            <form action="#">
                                <ul>
                                    <li><a href="#" class="b-acitve">Default</a></li>
                                    <li><a href="#">Popularity</a></li>
                                    <li><a href="#">Average rating</a></li>
                                    <li><a href="#">Newness</a></li>
                                    <li><a href="#">Price: low to high</a></li>
                                    <li><a href="#">Price: high to low</a></li>
                                </ul>
                            </form>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-mb-3 col-sm-6 col-xs-12">
                            <h5 class="b-filter_title">Price Filter</h5>
                            <form action="#">
                                <ul>
                                    <li><a href="#" class="b-acitve">All</a></li>
                                    <li><a href="#">£0.00 - £150.00</a></li>
                                    <li><a href="#">£150.00 - £300.00</a></li>
                                    <li><a href="#">£300.00 - £450.00</a></li>
                                    <li><a href="#">£450.00+</a></li>
                                </ul>
                            </form>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-mb-3 col-sm-6 col-xs-12">
                            <h5 class="b-filter_title">FILTER BY COLOR</h5>
                            <form action="#">
                                <ul class="b-color_filter">
                                    <li>
                                        <a href="#">
                                            <span class="b-color_circle b-black"></span>
                                            Black
                                        </a>
                                        <span class="b-count float-right">(7)</span>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="b-color_circle b-brown"></span>
                                            Brown
                                        </a>
                                        <span class="b-count float-right">(7)</span>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="b-color_circle b-yellow"></span>
                                            Yellow
                                        </a>
                                        <span class="b-count float-right">(6)</span>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="b-color_circle b-red"></span>
                                            Red
                                        </a>
                                        <span class="b-count float-right">(5)</span>
                                    </li>
                                    <li>
                                        <a href="#" class="b-acitve">
                                            <span class="b-color_circle b-blue"></span>
                                            Blue
                                        </a>
                                        <span class="b-count float-right">(8)</span>
                                    </li>
                                </ul>
                            </form>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-mb-3 col-sm-6 col-xs-12">
                            <h5 class="b-filter_title">FILTER BY SIZE</h5>
                            <form action="#">
                                <ul class="b-list_ib">
                                    <li><a href="#" class="b-acitve">L <span class="b-count_number">(4)</span></a></li>
                                    <li><a href="#">M <span class="b-count_number">(9)</span></a></li>
                                    <li><a href="#">XL <span class="b-count_number">(7)</span></a></li>
                                    <li><a href="#">S <span class="b-count_number">(3)</span></a></li>
                                    <li><a href="#">XS <span class="b-count_number">(5)</span></a></li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="b-products b-product_grid b-product_grid_four mb-4">
            <div class="container container-single-class">
                <div class="row clearfix">
                    @foreach($classes as $class)
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="b-product_grid_single">
                            <div class="b-product_grid_header">
                                <a href="{{ route('single-class', $class->uuid) }}">
                                    <img src="{{ asset( $class->desktopImage()->getUrl()) }}" class="" alt="" style="">
                                </a>
                                <div class="b-product_grid_action">
{{--                                    <a href="javascript:void(0)" data-whishurl="whishlist.html" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to Whishlist">--}}
{{--                                        <i class="icon-heart icons b-add_to_whish">--}}
{{--                                            <img src="{{ asset( $class->desktopImage()->getThumbUrl()) }}" class="g-loading_gif" alt="">--}}
{{--                                        </i>--}}
{{--                                    </a>--}}
{{--                                    <i data-toggle="tooltip" data-placement="left" title="" class="icon-refresh icons" data-original-title="Compare"></i>--}}
{{--                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#b-qucik_view">--}}
{{--                                        <i data-toggle="tooltip" data-placement="left" title="" class="icon-magnifier-add icons" data-original-title="Quick View"></i>--}}
{{--                                    </a>--}}
                                </div>
                            </div>
                            <div class="b-product_grid_info">
                                <h3 class="product-title text-center">
                                    <a href="{{ route('single-class', $class->id) }}">{{ $class->name }}</a>
                                </h3>
                                <div class="clearfix text-center">
                                    <div class="b-product_grid_toggle  text-center">
                                        @if($session === 'database-ar')
                                            <span class="b-price price-style text-center">AED {{ $class->price_sar }} </span>
                                        @endif
                                            @if($session === 'database-en')
                                                <span class="b-price price-style text-center">{{ $class->price_usd }} $ or {{ $class->price_eur }} €</span>
                                            @endif
                                            @if($session === 'database-om')
                                                <span class="b-price price-style text-center">OMR {{ $class->price_omr }}</span>
                                            @endif
                                        <span class="b-add_cart">
                                          <i class="icon-eye icons">
                                          <a href="{{ route('single-class', $class->id) }}">{{ $class->level}}</a></i>
                                      </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                        {{--                @if($session === 'database-ar')--}}
                        {{--                        <div>{{$classe->price_usd}}</div>--}}
                        {{--                    @endif--}}

{{--                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">--}}
{{--                        <div class="b-product_grid_single">--}}
{{--                            <div class="b-product_grid_header">--}}
{{--                                <a href="#">--}}
{{--                                    <img data-src="assets/images/products/home/product_grid_04_01.jpg, assets/images/products/home/product_grid_04_02.jpg" src="{{ asset('front-css/assets/images/classes/class110244.jpg') }}" class="img-fluid img-switch d-block" alt="" style="">--}}
{{--                                </a>--}}
{{--                                <div class="b-product_grid_action">--}}
{{--                                    <a href="javascript:void(0)" data-whishurl="whishlist.html" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to Whishlist">--}}
{{--                                        <i class="icon-heart icons b-add_to_whish">--}}
{{--                                            <img src="{{ asset('front-css/assets/images/classes/class110244.jpg') }}" class="g-loading_gif" alt="">--}}
{{--                                        </i>--}}
{{--                                    </a>--}}
{{--                                    <i data-toggle="tooltip" data-placement="left" title="" class="icon-refresh icons" data-original-title="Compare"></i>--}}
{{--                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#b-qucik_view">--}}
{{--                                        <i data-toggle="tooltip" data-placement="left" title="" class="icon-magnifier-add icons" data-original-title="Quick View"></i>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="b-product_grid_info">--}}
{{--                                <h3 class="product-title">--}}
{{--                                    <a href="#">Before decaf phone case</a>--}}
{{--                                </h3>--}}
{{--                                <div class="clearfix">--}}
{{--                                    <div class="b-product_grid_toggle float-left">--}}
{{--                                        <span class="b-price">$49</span>--}}
{{--                                        <span class="b-add_cart">--}}
{{--                                          <i class="icon-basket icons"></i>--}}
{{--                                          <a href="#">Add to cart</a>--}}
{{--                                      </span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                </div>
            </div>
            <div class="text-center">
                {{ $classes->links() }}
            </div>
        </div>
    </div>

@endsection
