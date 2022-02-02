@extends('front-layout.app')

@section('content')
    <div class="b-wrapper">
        <div class="b-page-title-wrap class-header-text mt-1">
            <h1 class="b-page-title text-center">{{ $class->name }}</h1>
        </div>

        <div class="container container-single-class-header">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="b-decent-title-wrap">
{{--                        <p class="b-decent-subtitle">WOOCOMMERCE</p>--}}
                        <div class="b-decent-title">
                            <span>{{ $class->name }}</span>
                        </div>
{{--                        <p class="b-decent-after-title">--}}
{{--                            Single product page by product ID--}}
{{--                        </p>--}}
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
{{--                                Slika mora da bude 1200 - 700 odnos 1:0.5--}}
                                <img src="{{ asset( $class->desktopImage()->getUrl()) }}" class="img-fluid d-block" alt="">
                            </div>
                            @if($session === 'database-en')
                            <div class="b-product_labels b-labels_rounded b-new image-on-image-single-class">
                                    <span class="b-product_label">{{ $class->price_usd }} DOL </span>
                            </div>
                            @endif
                        </div>
                        <div class="b-portfolio_single">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 proj-cat-mock-ups p-1">
                        <div class="b-portfolio_single">
                            <div class="b-portfolio_img b-img_zoom">
                                <img src="{{ asset( $class->mobileImage()->getUrl()) }}"class="img-fluid d-block" alt="">
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
                                        <img class="img-fluid rounded-circle m-auto d-block" src="{{ asset( $class->teacher->firstMediaUrl()) }}" alt="" title="" width="200" height="200">
                                    </div>
                                    <div class="b-testimonial_content text-center">
                                        <strong>{{ $class->teacher->name }}</strong><br>
                                        <p> {!! $class->teacher->education !!} </p
                                        <footer>
                                            <strong>Experience</strong><br>
                                        </footer>
                                    </div>
                                </div>
                            </div>
                            <div class="b-testimonial_single">
                                <div class="b-testimonial_inner">
                                    <div class="b-testimonial_avatar">
                                        <img class="img-fluid rounded-circle m-auto d-block" src="{{ asset( $class->teacher->firstMediaUrl()) }}" alt="" title="" width="100" height="100">
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
                                    <a class="nav-link active" href="#tab-011" role="tab" data-toggle="tab">Book Class</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab-022" role="tab" data-toggle="tab">Additional information</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active show p-3" id="tab-011">
                                    <div class="row clearfix">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            @if($session === 'database-en')
                                                <h5 class="text-center"><span class="single-class-index"> {{__('single-class.price')}} : </span> <span class="price-book-class"> {{ $class->price_eur }} EUR or </span> <span class="price-book-class"> {{ $class->price_usd }}  DOL </span> </h5>
                                                <hr class="hr-underline-eur">
                                                <h5><strong> {{__('single-class.skill-level')}} : </strong> <span> {{ $class->level }}  </span> </h5>
                                                <h5><strong> {{__('single-class.class-location')}} : </strong>
                                                    @foreach($class->locations as $location)
                                                        <span> {{ $location->location }}  </span>
                                                    @endforeach
                                                </h5>
                                            @endif
                                            @if($session === 'database-ar')
                                                    <h5 class="text-center"><span class="single-class-index"> <span class="price-book-class"> {{ $class->price_sar }} AED</span></span></h5>
                                                    <hr class="hr-underline">
                                                    <h5> <span> {{ $class->level  }} </span> : <strong> {{__('single-class.skill-level')}}  </strong> </h5>
                                                    <h5>
                                                        @foreach($class->locations as $location)
                                                            <span> {{ $location->location }}  </span>
                                                        @endforeach : <strong> {{__('single-class.class-location')}} </strong> </h5>
                                                @endif
                                            @if($session === 'database-om')
                                                    <h5 class="text-center"><span class="single-class-index"><span class="price-book-class">  {{ $class->price_omr }} OMR</span></span></h5>
                                                    <hr class="hr-underline">
                                                    <h5> <span> {{ $class->level  }} </span> : <strong> {{__('single-class.skill-level')}}  </strong> </h5>
                                                    <h5>
                                                        @foreach($class->locations as $location)
                                                            <span> {{ $location->location }}  </span>
                                                        @endforeach : <strong> {{__('single-class.class-location')}} </strong> </h5>
                                                @endif
                                            <h5><strong>{{__('single-class.short-description')}}</strong></h5>
                                                <p>{!! $class->description !!}</p>
                                            <div class="col-xl-12 col-lg-12 col-mb-12 col-sm-12 col-xs-12 text-center">
                                                <a href="" class="btn btn-bg btn-lg btn-block text-white book-now">{{__('single-class.btn-book-class')}}</a>
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
                                                        <label>{{__('single-class.name')}} <i style="color: red;">*</i> <span id="userName-info" class="info"></span></label>
                                                        <input required="" type="text" name="userName" id="userName">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-mb-6 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>{{__('single-class.email')}} <i style="color: red;">*</i>  <span id="userEmail-info" class="info"></span></label>
                                                        <input required="" type="email" name="userEmail" id="userEmail">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-mb-12 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>{{__('single-class.subject')}} </label>
                                                        <input  type="text" name="subject" id="subject">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-mb-12 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>{{__('single-class.message')}}</label>
                                                        <textarea name="content" id="content" rows="6" cols="50"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-mb-12 col-sm-12 col-xs-12 text-center">
                                                    <button  onClick="sendContact();" class="btn btn-bg text-white">{{__('contact.btn')}}</button>
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
                        <a class="nav-link active" href="#tab-01" role="tab" data-toggle="tab">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-02" role="tab" data-toggle="tab">Class information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-03" role="tab" data-toggle="tab">Reviews (0)</a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="#tab-04" role="tab" data-toggle="tab">Shipping & Delivery</a>--}}
{{--                    </li>--}}
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
                        <table class="b-shop_attributes" style="max-width: 90%">
                            <tbody>
                            <tr>
                                @if($session === 'database-en')
                                    <th>{{__('single-class.skill-level')}} : </th>
                                    <td><p class=" text-left"> {{ $class->level }}</p></td>
                                    <th>Class category : </th>
                                    <td><p class=" text-left">{{ $class->classCategory->name }}</p></td>
                                    <th>Class subcategory : </th>
                                    <td><p class=" text-left">{{ $class->classSubCategory->name }}</p></td>
                                @endif
                                @if($session === 'database-ar')
                                        <th>Class level </th>
                                        <td><p class=" text-left">Black, Brown, Blue</p></td>
                                        <th>Class category</th>
                                        <td><p class=" text-left">L, M, XS</p></td>
                                @endif
                                @if($session === 'database-om')
                                        <th>Class level </th>
                                        <td><p class=" text-left">Black, Brown, Blue</p></td>
                                        <th>Class category</th>
                                        <td><p class=" text-left">L, M, XS</p></td>
                                @endif

                            </tr>
                            <tr>
                                @if($session === 'database-en')
                                    <th>Class teacher : </th>
                                    <td><p class=" text-left"> {{ $class->teacher->name }}</p></td>
                                @endif
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab-03">
                        <div class="row clearfix">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="b-review_listing_wrapper">
                                    <h5 class="pb-2"><b>Reviews</b></h5>
                                    <div class="b-review_listing">
                                        <div class="b-review_single">
                                            <img src="front-css/assets/images/products/product-single/user.png" class="img-fluid" alt="">
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
                                                <p>Dis vestibulum ullamcorper senectus conubia suspendisse vestibulum nam condimentum aliquet ipsum justo. </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="b-review_form_wrapper">
                                    <h5 class="pb-2"><b>Add a review</b></h5>
                                    <p class="b-comment_notes pb-2">
                                        <span id="b-email_notes">Your email address will not be published.</span> Required fields are marked
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
                                        <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required=""></textarea>
                                    </p>
                                    <p class="b-comment_form_author">
                                        <label for="author">Name <span class="b-required">*</span></label>
                                        <input id="author" name="author" type="text" value="" size="30" aria-required="true" required="">
                                    </p>
                                    <p class="b-comment_form_email clearfix">
                                        <label for="email">Email <span class="b-required">*</span></label>
                                        <input id="email" name="email" type="email" value="" size="30" aria-required="true" required="">
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

    <section id="b-products">
        <div class="b-section_title">
            <h4 class="text-center text-uppercase">
                RELATED CLASSES
                <span class="b-title_separator"><span></span></span>
            </h4>
        </div>
        <div class="b-products b-product_grid b-product_grid_four mb-4">
            <div class="container">
                <div class="clearfix owl-carousel owl-theme" id="b-related_products">
                    <div>
                        <div class="b-product_grid_single">
                            <div class="b-product_grid_header">
                                <a href="#">
                                    <img data-src="front-css/assets/images/products/product-single/product_grid_10_01.jpg, front-css/assets/images/products/product-single/product_grid_10_02.jpg" src=" front-css/assets/images/products/product-single/product_grid_10_01.jpg" class="img-fluid img-switch d-block m-auto" alt="" style="">
                                </a>
                                <div class="b-product_grid_action">
                                    <a href="javascript:void(0)" data-whishurl="whishlist.html" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to Whishlist">
                                        <i class="icon-heart icons b-add_to_whish">
                                            <img src="front-css/assets/images/classes/class.jpg" class="g-loading_gif" alt="">
                                        </i>
                                    </a>
                                    <i data-toggle="tooltip" data-placement="left" title="" class="icon-refresh icons" data-original-title="Compare"></i>
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#b-qucik_view">
                                        <i data-toggle="tooltip" data-placement="left" title="" class="icon-magnifier-add icons" data-original-title="Quick View"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="b-product_grid_info">
                                <h3 class="product-title">
                                    <a href="#">Houble strap backpack</a>
                                </h3>
                                <div class="clearfix">
                                    <div class="b-product_grid_toggle float-left">
                                        <span class="b-price">$120</span>
                                        <span class="b-add_cart">
                                              <i class="icon-basket icons"></i>
                                              <a href="#">Select Options</a>
                                          </span>
                                    </div>
                                    <div class="b-product_options float-right">
                                        <ul class="pl-0 mb-0 list-unstyled">
                                            <li>
                                                <span data-toggle="tooltip" title="" class="b-black" data-original-title="Black"></span>
                                            </li>
                                            <li>
                                                <span data-toggle="tooltip" title="" class="b-blue" data-original-title="Blue"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="b-product_grid_single">
                            <div class="b-product_grid_header">
                                <a href="#">
                                    <img data-src="front-css/assets/images/products/product-single/product_grid_11_01.jpg, front-css/assets/images/products/product-single/product_grid_11_02.jpg" src="front-css/assets/images/products/product-single/product_grid_11_01.jpg" class="img-fluid img-switch d-block m-auto" alt="" style="">
                                </a>
                                <div class="b-product_grid_action">
                                    <a href="javascript:void(0)" data-whishurl="whishlist.html" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to Whishlist">
                                        <i class="icon-heart icons b-add_to_whish">
                                            <img src="front-css/assets/images/products/product_loading.gif" class="g-loading_gif" alt="">
                                        </i>
                                    </a>
                                    <i data-toggle="tooltip" data-placement="left" title="" class="icon-refresh icons" data-original-title="Compare"></i>
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#b-qucik_view">
                                        <i data-toggle="tooltip" data-placement="left" title="" class="icon-magnifier-add icons" data-original-title="Quick View"></i>
                                    </a>
                                </div>
                                <div class="b-product_labels b-labels_rounded b-new">
                                    <span class="b-product_label">New</span>
                                </div>
                            </div>
                            <div class="b-product_grid_info">
                                <h3 class="product-title">
                                    <a href="#">Basic contrast sneakers</a>
                                </h3>
                                <div class="clearfix">
                                    <div class="b-product_grid_toggle float-left">
                                        <span class="b-price">$20</span>
                                        <span class="b-add_cart">
                                              <i class="icon-basket icons"></i>
                                              <a href="#">Select Options</a>
                                          </span>
                                    </div>
                                    <div class="b-product_options float-right">
                                        <ul class="pl-0 mb-0 list-unstyled">
                                            <li>
                                                <span data-toggle="tooltip" title="" class="b-black" data-original-title="Black"></span>
                                            </li>
                                            <li>
                                                <span data-toggle="tooltip" title="" class="b-brown" data-original-title="Brown"></span>
                                            </li>
                                            <li>
                                                <span data-toggle="tooltip" title="" class="b-red" data-original-title="Red"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="b-product_grid_single">
                            <div class="b-product_grid_header">
                                <a href="#">
                                    <img data-src="front-css/assets/images/products/product-single/product_grid_12_01.jpg, front-css/assets/images/products/product-single/product_grid_12_02.jpg" src="front-css/assets/images/products/product-single/product_grid_12_01.jpg" class="img-fluid img-switch d-block m-auto" alt="" style="">
                                </a>
                                <div class="b-product_grid_action">
                                    <a href="javascript:void(0)" data-whishurl="whishlist.html" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to Whishlist">
                                        <i class="icon-heart icons b-add_to_whish">
                                            <img src="front-css/assets/images/products/product_loading.gif" class="g-loading_gif" alt="">
                                        </i>
                                    </a>
                                    <i data-toggle="tooltip" data-placement="left" title="" class="icon-refresh icons" data-original-title="Compare"></i>
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#b-qucik_view">
                                        <i data-toggle="tooltip" data-placement="left" title="" class="icon-magnifier-add icons" data-original-title="Quick View"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="b-product_grid_info">
                                <h3 class="product-title">
                                    <a href="#">Basic Korean-style coat</a>
                                </h3>
                                <div class="clearfix">
                                    <div class="b-product_grid_toggle float-left">
                                        <span class="b-price">$214</span>
                                        <span class="b-add_cart">
                                              <i class="icon-basket icons"></i>
                                              <a href="#">Add to cart</a>
                                          </span>
                                    </div>
                                    <div class="b-product_options float-right">
                                        <ul class="pl-0 mb-0 list-unstyled">
                                            <li>
                                                <span data-toggle="tooltip" title="" class="b-brown" data-original-title="Brown"></span>
                                            </li>
                                            <li>
                                                <span data-toggle="tooltip" title="" class="b-blue" data-original-title="Blue"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="b-product_grid_single">
                            <div class="b-product_grid_header">
                                <a href="#">
                                    <img data-src="front-css/assets/images/products/product-single/product_grid_13_01.jpg, front-css/assets/images/products/product-single/product_grid_13_02.jpg" src="front-css/assets/images/products/product-single/product_grid_13_01.jpg" class="img-fluid img-switch d-block m-auto" alt="" style="">
                                </a>
                                <div class="b-product_grid_action">
                                    <a href="javascript:void(0)" data-whishurl="whishlist.html" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to Whishlist">
                                        <i class="icon-heart icons b-add_to_whish">
                                            <img src="front-css/assets/images/products/product_loading.gif" class="g-loading_gif" alt="">
                                        </i>
                                    </a>
                                    <i data-toggle="tooltip" data-placement="left" title="" class="icon-refresh icons" data-original-title="Compare"></i>
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#b-qucik_view">
                                        <i data-toggle="tooltip" data-placement="left" title="" class="icon-magnifier-add icons" data-original-title="Quick View"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="b-product_grid_info">
                                <h3 class="product-title">
                                    <a href="#">Before decaf phone case</a>
                                </h3>
                                <div class="clearfix">
                                    <div class="b-product_grid_toggle float-left">
                                        <span class="b-price">$49</span>
                                        <span class="b-add_cart">
                                              <i class="icon-basket icons"></i>
                                              <a href="#">Add to cart</a>
                                          </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="b-product_grid_single">
                            <div class="b-product_grid_header">
                                <a href="#">
                                    <img data-src="front-css/assets/images/products/product-single/product_grid_11_01.jpg, front-css/assets/images/products/product-single/product_grid_11_02.jpg" src="front-css/assets/images/products/product-single/product_grid_11_01.jpg" class="img-fluid img-switch d-block m-auto" alt="" style="">
                                </a>
                                <div class="b-product_grid_action">
                                    <a href="javascript:void(0)" data-whishurl="whishlist.html" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to Whishlist">
                                        <i class="icon-heart icons b-add_to_whish">
                                            <img src="front-css/assets/images/products/product_loading.gif" class="g-loading_gif" alt="">
                                        </i>
                                    </a>
                                    <i data-toggle="tooltip" data-placement="left" title="" class="icon-refresh icons" data-original-title="Compare"></i>
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#b-qucik_view">
                                        <i data-toggle="tooltip" data-placement="left" title="" class="icon-magnifier-add icons" data-original-title="Quick View"></i>
                                    </a>
                                </div>
                                <div class="b-product_labels b-labels_rounded b-new">
                                    <span class="b-product_label">New</span>
                                </div>
                            </div>
                            <div class="b-product_grid_info">
                                <h3 class="product-title">
                                    <a href="#">Basic contrast sneakers</a>
                                </h3>
                                <div class="clearfix">
                                    <div class="b-product_grid_toggle float-left">
                                        <span class="b-price">$20</span>
                                        <span class="b-add_cart">
                                              <i class="icon-basket icons"></i>
                                              <a href="#">Select Options</a>
                                          </span>
                                    </div>
                                    <div class="b-product_options float-right">
                                        <ul class="pl-0 mb-0 list-unstyled">
                                            <li>
                                                <span data-toggle="tooltip" title="" class="b-black" data-original-title="Black"></span>
                                            </li>
                                            <li>
                                                <span data-toggle="tooltip" title="" class="b-brown" data-original-title="Brown"></span>
                                            </li>
                                            <li>
                                                <span data-toggle="tooltip" title="" class="b-red" data-original-title="Red"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="b-product_grid_single">
                            <div class="b-product_grid_header">
                                <a href="#">
                                    <img data-src="front-css/assets/images/products/product-single/product_grid_12_01.jpg, front-css/assets/images/products/product-single/product_grid_12_02.jpg" src="front-css/assets/images/products/product-single/product_grid_12_01.jpg" class="img-fluid img-switch d-block m-auto" alt="" style="">
                                </a>
                                <div class="b-product_grid_action">
                                    <a href="javascript:void(0)" data-whishurl="whishlist.html" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to Whishlist">
                                        <i class="icon-heart icons b-add_to_whish">
                                            <img src="front-css/assets/images/products/product_loading.gif" class="g-loading_gif" alt="">
                                        </i>
                                    </a>
                                    <i data-toggle="tooltip" data-placement="left" title="" class="icon-refresh icons" data-original-title="Compare"></i>
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#b-qucik_view">
                                        <i data-toggle="tooltip" data-placement="left" title="" class="icon-magnifier-add icons" data-original-title="Quick View"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="b-product_grid_info">
                                <h3 class="product-title">
                                    <a href="#">Basic Korean-style coat</a>
                                </h3>
                                <div class="clearfix">
                                    <div class="b-product_grid_toggle float-left">
                                        <span class="b-price">$214</span>
                                        <span class="b-add_cart">
                                              <i class="icon-basket icons"></i>
                                              <a href="#">Add to cart</a>
                                          </span>
                                    </div>
                                    <div class="b-product_options float-right">
                                        <ul class="pl-0 mb-0 list-unstyled">
                                            <li>
                                                <span data-toggle="tooltip" title="" class="b-brown" data-original-title="Brown"></span>
                                            </li>
                                            <li>
                                                <span data-toggle="tooltip" title="" class="b-blue" data-original-title="Blue"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
