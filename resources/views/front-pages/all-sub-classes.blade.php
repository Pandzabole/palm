@extends('front-layout.app')

@section('content')
    <div class="b-wrapper">
        <div class="b-page-title-wrap class-header-text mt-1">
            @if($singleClass)
                <h1 class="b-page-title text-center">{{ $singleClass->name }} </h1>

            @else
                <h1 class="b-page-title text-center">{{__('single-class.no-classes')}} </h1>
            @endif

        </div>

        <div class="container container-single-class-header">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="b-decent-title-wrap">
                        {{--                        <p class="b-decent-subtitle">WOOCOMMERCE</p>--}}
                        <div class="b-decent-title">
                            <span>Single Product SINGLE PRODUCT SINGLE PRODUCT SINGLE PRODUCT</span>
                        </div>
                        <p class="b-decent-after-title">
                            Single product page by product ID
                        </p>
                    </div>
                </div>
            </div>
        </div>

@endsection
