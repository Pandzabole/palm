@extends('front-layout.app')

@section('content')
    <div class="b-wrapper">
        <div class="b-page-title-wrap class-header-text mt-1">
            <h1 class="b-page-title text-center">{{ $class->classCategory->name }}</h1>
        </div>
        <div class="container container-single-class-header">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="b-decent-title-wrap">
                        <div class="b-decent-title">
                            <span>{{ $class->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section id="b-portfolio">
            <div class="b-portfolio_grid b-portfolio_grid_full mb-1">
                <div class="container container-single-class">
                    <div class="row clearfix gallery" id="b-portfolio_isotop">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 proj-cat-mock-ups p-1">
                            <div class="b-portfolio_single">
                                <div class="b-portfolio_img b-img_zoom">
                                    <img src="{{ asset( $class->desktopImage()->getUrlResponsive('1200')) }}"
                                         class="img-fluid d-block" alt="">
                                </div>
                                @if($session === 'database-en')
                                    <div class="b-product_labels b-labels_rounded b-new image-on-image-single-class">
                                        <span class="b-product_label">{{ $class->price_usd }} $ </span>
                                    </div>
                                @endif
                            </div>
                            <div class="b-portfolio_single">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 proj-cat-mock-ups p-1">
                            <div class="b-portfolio_single">
                                <div class="b-portfolio_img b-img_zoom">
                                    <img src="{{ asset( $class->mobileImage()->getUrlResponsive('1200')) }}"
                                         class="img-fluid d-block" alt="">
                                </div>
                                <div class="b-product_labels b-labels_rounded b-new image-on-image-single-class">
                                    @if($session === 'database-en')
                                        <span class="b-product_label">{{ $class->price_eur }} EUR </span>
                                    @endif
                                    @if($session === 'database-ar')
                                        <span class="b-product_label"> {{ $class->price_sar }} AED </span>
                                    @endif
                                    @if($session === 'database-om')
                                        <span class="b-product_label"> {{ $class->price_omr }} OMR </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{--    @dd($class)--}}
        <div class="container container-single-class">
            <div class="row clearfix pb-5">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                    <section id="b-testimonial">
                        <div class="b-testimonial b-testimonial_small mb-2">
                            <div class="b-testimonial_listing owl-carousel owl-theme" id="b-testimonial_list">
                                <div class="b-testimonial_single">
                                    <div class="b-testimonial_inner">
                                        <div class="b-testimonial_avatar">
                                            <img class="img-fluid rounded-circle m-auto d-block"
                                                 src="{{ asset( $class->teacher->responsiveSingleImage('300')) }}"
                                                 alt="" title="" width="200" height="200">
                                        </div>
                                        <div class="b-testimonial_content text-center">
                                            <strong>{{ $class->teacher->name }}</strong><br>
                                            <p> {!! $class->teacher->education !!} </p>
                                            <footer>
                                                <strong>Experience</strong><br>
                                            </footer>
                                        </div>
                                    </div>
                                </div>
                                <div class="b-testimonial_single">
                                    <div class="b-testimonial_inner">
                                        <div class="b-testimonial_avatar">
                                            <img class="img-fluid rounded-circle m-auto d-block"
                                                 src="{{ asset( $class->teacher->responsiveSingleImage('300')) }}"
                                                 alt="" title="">
                                        </div>
                                        <div class="b-testimonial_content text-center">
                                            <strong>{{ $class->teacher->name }}</strong><br>
                                            <p> {!! $class->teacher->experience !!} </p>
                                            <footer>
                                                <strong>Education</strong>
                                            </footer>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <p class="text-center"><strong>About teacher</strong></p>
                    <p>{!! $class->teacher->description !!}</p>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 book-main">
                    <div class="book-header">Book Your Class</div>
                    <div class="b-product_tabs book-class-tabs">
                        <div class="container">
                            <div class="row">
                                <ul class="nav nav-tabs clearfix" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#tab-011" role="tab" data-toggle="tab">{{__('single-class.book-class')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tab-022" role="tab" data-toggle="tab">{{__('single-class.additional-information')}}</a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active show p-3" id="tab-011">
                                        <div class="row clearfix">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                @if($session === 'database-en')
                                                    <h5 class="text-center"><span class="single-class-index"> {{__('single-class.price')}} : </span>
                                                        <span
                                                            class="price-book-class"> {{ $class->price_eur }} EUR or </span>
                                                        <span
                                                            class="price-book-class"> {{ $class->price_usd }}  $ </span>
                                                    </h5>
                                                    <hr class="hr-underline-eur">
                                                @endif
                                                @if($session === 'database-ar')
                                                    <h5 class="text-center"><span class="single-class-index"> <span
                                                                class="price-book-class">AED {{ $class->price_sar }} </span></span>
                                                    </h5>
                                                    <hr class="hr-underline">
                                                @endif
                                                @if($session === 'database-om')
                                                    <h5 class="text-center"><span class="single-class-index"><span
                                                                class="price-book-class"> OMR {{ $class->price_omr }} </span></span>
                                                    </h5>
                                                    <hr class="hr-underline">
                                                @endif
                                                    <h5><strong class="class-information-head"> {{__('single-class.skill-level')}} : </strong>
                                                        <span class="class-information-title"> {{ $class->level }}  </span></h5>
                                                    <h5><strong class="class-information-head"> {{__('single-class.class-location')}} : </strong>
                                                        @foreach($class->locations as $location)
                                                            <span class="class-information-title"> {{ $location->location }}  </span>
                                                        @endforeach
                                                    </h5>
                                                <h5><strong class="class-information-head">{{__('single-class.short-description')}}</strong></h5>
                                                <p>{!! $class->description !!}</p>
                                                <div
                                                    class="col-xl-12 col-lg-12 col-mb-12 col-sm-12 col-xs-12 text-center">
                                                    <a href=""
                                                       class="btn btn-bg btn-lg btn-block text-white book-now">{{__('single-class.btn-book-class')}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade p-3" id="tab-022">
                                        <div class="row clearfix">
                                            <div class="col-xl-12 col-lg-12 col-mb-12 col-sm-12 col-xs-12">
                                                <div class="b-title text-center title-single-class">
                                                    <h2 class="text-uppercase">{{__('single-class.touch-us')}}</h2>
                                                </div>
                                                <div class="clearfix row">
                                                    <div class="col-xl-6 col-lg-6 col-mb-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>{{__('single-class.name')}} <i
                                                                    style="color: red;">*</i> <span id="userName-info"
                                                                                                    class="info"></span></label>
                                                            <input required="" type="text" name="userName"
                                                                   id="userName">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-mb-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>{{__('single-class.email')}} <i
                                                                    style="color: red;">*</i> <span id="userEmail-info"
                                                                                                    class="info"></span></label>
                                                            <input required="" type="email" name="userEmail"
                                                                   id="userEmail">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-lg-12 col-mb-12 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>{{__('single-class.subject')}} </label>
                                                            <input type="text" name="subject" id="subject">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-lg-12 col-mb-12 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>{{__('single-class.message')}}</label>
                                                            <textarea name="content" id="content" rows="6"
                                                                      cols="50"></textarea>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-xl-12 col-lg-12 col-mb-12 col-sm-12 col-xs-12 text-center">
                                                        <button onClick="sendContact();"
                                                                class="btn btn-bg text-white">{{__('contact.btn')}}</button>
                                                    </div>
                                                </div>
                                                <div class="mt-4" id="mail-status"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="b-product_tabs">
            <div class="container container-single-class">
                <div class="row">
                    <ul class="nav nav-tabs clearfix" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#tab-01" role="tab" data-toggle="tab">Class description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab-02" role="tab" data-toggle="tab">Class information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab-03" role="tab" data-toggle="tab">Class reviews (0)</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active show" id="tab-01">
                            <div class="row clearfix">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <p class="b-font_title pt-1 pb-1"><i> {!! $class->description_first !!}</i></p>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <p class="b-font_title pt-1 pb-1"><i> {!! $class->description_first !!}</i></p>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab-02">
                            <div class="row clearfix">
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <span class="class-information-head">{{__('single-class.skill-level')}} :</span>
                                        <span class="text-left class-information-title"> {{ $class->level }}</span>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <span class="class-information-head">{{__('single-class.class-category')}} :</span>
                                        <span class="text-left class-information-title"> {{ $class->classCategory->name}}</span>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <span class="class-information-head">{{__('single-class.class-sub-category')}} :</span>
                                        <span class="text-left class-information-title"> {{ $class->classSubCategory->name }}</span>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <span class="class-information-head">{{__('single-class.class-teacher')}} :</span>
                                        <span class="text-left class-information-title"> {{ $class->teacher->name }}</span>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <span class="class-information-head">{{__('single-class.class-length')}} :</span>
                                        <span class="text-left class-information-title"> {{ $class->class_length }} {{__('single-class.minutes')}} </span>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <span class="class-information-head">{{__('single-class.class-location')}} :</span>
                                        @foreach($class->locations as $location)
                                            <span class="text-left class-information-title"> {{ $location->location }},</span>
                                        @endforeach
                                    </div>
                                    @if($class->age_restriction)
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <span class="class-information-head">{{__('single-class.age-restriction')}} :</span>
                                            <span class="text-left class-information-title"> {{ $class->age_restriction }}</span>
                                        </div>
                                    @endif
                                    @if($class->materials)
                                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12 mb-3">
                                            <span class="class-information-head">{{__('single-class.class-material')}} :</span>
                                            <span class="text-left class-information-title"> {{ $class->materials }}</span>
                                        </div>
                                    @endif
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab-03">
                            <div class="row clearfix">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="b-review_listing_wrapper">
                                        <h5 class="pb-2"><b>Reviews</b></h5>
                                        <div class="b-review_listing">
                                            <div class="b-review_single">
                                                <img src="front-css/assets/images/products/product-single/user.png"
                                                     class="img-fluid" alt="">
                                                <div class="b-review_header clearfix">
                                                    <p class="float-left">
                                                        <em>Your review is awaiting approval</em>
                                                    </p>
                                                    <p class="float-right">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="icon-star icons"></i>
                                                        <i class="icon-star icons"></i>
                                                        <i class="icon-star icons"></i>
                                                    </p>
                                                </div>
                                                <div class="b-review_content">
                                                    <p>Dis vestibulum ullamcorper senectus conubia suspendisse
                                                        vestibulum nam condimentum aliquet ipsum justo. </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="b-review_form_wrapper">
                                        <h5 class="pb-2"><b>Add a review</b></h5>
                                        <p class="b-comment_notes pb-2">
                                            <span id="b-email_notes">Your email address will not be published.</span>
                                            Required fields are marked
                                            <span class="b-required">*</span>
                                        </p>
                                        <p class="b-rating_area">
                                            <span class="d-inline-block pr-3">Your Rating:</span>
                                            <a href="#" class="d-inline-block mr-3">
                                                <i class="icon-star icons"></i>
                                            </a>
                                            <a href="#" class="d-inline-block b-active mr-3">
                                                <i class="icon-star icons"></i>
                                                <i class="icon-star icons"></i>
                                            </a>
                                            <a href="#" class="d-inline-block mr-3">
                                                <i class="icon-star icons"></i>
                                                <i class="icon-star icons"></i>
                                                <i class="icon-star icons"></i>
                                            </a>
                                            <a href="#" class="d-inline-block mr-3">
                                                <i class="icon-star icons"></i>
                                                <i class="icon-star icons"></i>
                                                <i class="icon-star icons"></i>
                                                <i class="icon-star icons"></i>
                                            </a>
                                            <a href="#" class="d-inline-block mr-3">
                                                <i class="icon-star icons"></i>
                                                <i class="icon-star icons"></i>
                                                <i class="icon-star icons"></i>
                                                <i class="icon-star icons"></i>
                                                <i class="icon-star icons"></i>
                                            </a>
                                        </p>
                                        <p class="b-comment_form_comment">
                                            <label for="comment">Your review <span class="b-required">*</span></label>
                                            <textarea id="comment" name="comment" cols="45" rows="8"
                                                      aria-required="true" required=""></textarea>
                                        </p>
                                        <p class="b-comment_form_author">
                                            <label for="author">Name <span class="b-required">*</span></label>
                                            <input id="author" name="author" type="text" value="" size="30"
                                                   aria-required="true" required="">
                                        </p>
                                        <p class="b-comment_form_email clearfix">
                                            <label for="email">Email <span class="b-required">*</span></label>
                                            <input id="email" name="email" type="email" value="" size="30"
                                                   aria-required="true" required="">
                                        </p>
                                        <p>
                                            <button class="btn" type="submit">submit</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--                    <div role="tabpanel" class="tab-pane fade" id="tab-04">--}}
                        {{--                        <div>--}}
                        {{--                            <img src="front-css/assets/images/products/product-single/shipping.jpg" class="alignleft">--}}
                        {{--                            <p>Vestibulum curae torquent diam diam commodo parturient penatibus nunc dui adipiscing convallis bulum parturient suspendisse parturient a.Parturient in parturient scelerisque nibh lectus quam a natoque adipiscing a vestibulum hendrerit et pharetra fames.Consequat net</p>--}}

                        {{--                            <p>Vestibulum parturient suspendisse parturient a.Parturient in parturient scelerisque  nibh lectus quam a natoque adipiscing a vestibulum hendrerit et pharetra fames.Consequat netus.</p>--}}

                        {{--                            <p>Scelerisque adipiscing bibendum sem vestibulum et in a a a purus lectus faucibus lobortis tincidunt purus lectus nisl class eros.Condimentum a et ullamcorper dictumst mus et tristique elementum nam inceptos hac vestibulum amet elit</p>--}}

                        {{--                            <div class="clearfix"></div>--}}
                        {{--                        </div>--}}
                        {{--                    </div>--}}
                    </div>
                </div>
            </div>
        </div>
        <section id="b-portfolio">
            <div class="b-portfolio_grid b-portfolio_grid_full mb-1">
                <div class="b-section_title">
                    <h4 class="text-center text-uppercase">
                        RECOMMENDED CLASSES
                        <span class="b-title_separator"><span></span></span>
                    </h4>
                </div>
                <div class="container-fluid">
                    <div class="row clearfix gallery" id="b-portfolio_isotop">
                        @foreach($relatedClasses as $relatedClass)
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 proj-cat-mock-ups p-4">
                                <div class="b-portfolio_single">
                                    <a href="{{ route('single-class', $relatedClass->uuid) }}" class="b-portfolio_link" rel=""></a>
                                    <div class="b-portfolio_img b-img_zoom">
                                        <img src="{{ asset( $relatedClass->mobileImage()->getUrlResponsive('1200')) }}" class="img-fluid d-block" alt="{{ $relatedClass->name }}">
                                    </div>
                                    <div class="b-portfolio_info">
                                        <div class="b-portfolio_info_in home-classes-info" >
                                            <h3 class="b-portfolio_title">
                                                <a href="{{ route('single-class', $relatedClass->uuid) }}" rel="">{{ $relatedClass->name }}</a>
                                            </h3>
                                            <h4 class="text-white text-uppercase">
                                                {{ $relatedClass->classCategory->name }}
                                            </h4>
                                            <h4 class="text-white text-uppercase">
                                                {{ $relatedClass->classSubCategory->name }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
@endsection
