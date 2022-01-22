@extends('front-layout.app')

@section('content')
    <div class="b-wrapper">
        <div class="b-page-title-wrap b-title-dark-scheme" style="background: red">
            <h1 class="b-page-title text-center">Single Product</h1>
            <ul class="b-breadcrumbs">
                <li> Single Product </li>
            </ul>
        </div>

        <div class="container" style="width: 100%">
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
{{--                    <div class="b-product_single_breadcrumbs pt-3 pb-3 mt-up-10">--}}
{{--                        <div class="container">--}}
{{--                            <div class="row clearfix">--}}
{{--                                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">--}}
{{--                                    <div class="b-breadcrumbs">--}}
{{--                                        <a href="#">Home</a>--}}
{{--                                        <a href="#">Shop</a>--}}
{{--                                        <a href="#">Man</a>--}}
{{--                                        <span>Shirt</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">--}}
{{--                                    <ul class="list-unstyled pl-0 float-right mb-0">--}}
{{--                                        <li class="d-inline-block mr-2"><i class="fa fa-long-arrow-left"></i></li>--}}
{{--                                        <lii class="d-inline-block"><i class="fa fa-long-arrow-right"></i>--}}
{{--                                        </lii></ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    <section id="b-portfolio">
        <div class="b-portfolio_grid b-portfolio_grid_full mb-1">

            <div class="container" style="width: 80%">
                <div class="row clearfix gallery" id="b-portfolio_isotop">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 proj-cat-mock-ups p-1">
                        <div class="b-portfolio_single">
                            <div class="b-portfolio_img b-img_zoom">
{{--                                Slika mora da bude 1200 - 600 odnos 1:0.5--}}
                                <img src="front-css/assets/images/classes/class110244.jpg" class="img-fluid d-block" alt="">
                            </div>
                        </div>
                        <div class="b-portfolio_single">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 proj-cat-mock-ups p-1">
                        <div class="b-portfolio_single">
                            <div class="b-portfolio_img b-img_zoom">
                                <img src="front-css/assets/images/classes/class110244.jpg" class="img-fluid d-block" alt="">
                            </div>
                        </div>
                    </div>
{{--                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 proj-cat-print p-1">--}}
{{--                        <div class="b-portfolio_single">--}}
{{--                            <div class="b-portfolio_img b-img_zoom">--}}
{{--                                <img src="front-css/assets/images/classes/class.jpg" class="img-fluid d-block" alt="">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row clearfix pb-5 pt-5">
            <div class="col-xl-4 col-lg-4 col-mb-4 col-sm-4 col-xs-12">
                <div class="b-client_says mt-5 pt-5">
                    <h4 class="text-left text-sm-right"><b>OUR CLIENTS SAYS:</b></h4>
                    <p class="text-left text-sm-right"><em>Read client’s opinions about posuere suspendisse congue aliquet dis penatibus netus tempor a lorem</em></p>
                </div>
            </div>
            <div class="col-xl-8 col-lg-8 col-mb-8 col-sm-8 col-xs-12">
                <section id="b-testimonial">
                    <div class="b-testimonial b-testimonial_small mb-5">
                        <div class="b-testimonial_listing owl-carousel owl-theme" id="b-testimonial_list">
                            <div class="b-testimonial_single">
                                <div class="b-testimonial_inner">
                                    <div class="b-testimonial_avatar">
                                        <img class="img-fluid rounded-circle m-auto d-block" src="front-css/assets/images/testimonial_01.jpg" alt="" title="" width="100" height="100">
                                    </div>
                                    <div class="b-testimonial_content text-center">
                                        <p>
                                            Fringilla iaculis ante torquent a diam a vestibulum diam nisi augue dictumst parturient a vestibulum tortor viverra inceptos adipiscing nec a ullamcorper.Ullamcorper aliquam rutrum.
                                        </p>
                                        <footer>
                                            John Doe <span>Happy Customer</span>
                                        </footer>
                                    </div>
                                </div>
                            </div>
                            <div class="b-testimonial_single">
                                <div class="b-testimonial_inner">
                                    <div class="b-testimonial_avatar">
                                        <img class="img-fluid rounded-circle m-auto d-block" src="front-css/assets/images/testimonial_02.jpg" alt="" title="" width="100" height="100">
                                    </div>
                                    <div class="b-testimonial_content text-center">
                                        <p>
                                            Fringilla iaculis ante torquent a diam a vestibulum diam nisi augue dictumst parturient a vestibulum tortor viverra inceptos adipiscing nec a ullamcorper.Ullamcorper aliquam rutrum.
                                        </p>
                                        <footer>
                                            John Doe <span>Happy Customer</span>
                                        </footer>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <div class="b-gray_bg b-product_tabs">
        <div class="container">
            <div class="row">
                <ul class="nav nav-tabs clearfix" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#tab-01" role="tab" data-toggle="tab">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-02" role="tab" data-toggle="tab">Additional information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-03" role="tab" data-toggle="tab">Reviews (0)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-04" role="tab" data-toggle="tab">Shipping & Delivery</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active show" id="tab-01">
                        <div class="row clearfix">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <h5><strong>Viverra a consectetur</strong></h5>
                                <p class="b-font_title pt-1 pb-1"><i>Enim in malesuada fusce dolor mi massa leo taciti nulla vestibulum dignissim senectus vitae elit ullamcorper primis.</i></p>
                                <h5><strong>Facilisis scelerisque mi</strong></h5>
                                <p>Amet quisque adipiscing scelerisque vestibulum a parturient aptent et pretium a a suspendisse a vestibulum dolor a adipiscing a curabitur integer vulputate praesent convallis. Est nisi ante accumsan pulvinar facilisi orci dignissim lacinia ad sodales conubia viverra a consectetur lectus cras quis aliquam eros curabitur ultricies mauris lectus dictumst magna hac aenean. Odio nec adipiscing.&nbsp;Pulvinar in taciti dui condimentum a vel bibendum aliquet velit nam ultrices.&nbsp;Odio nec adipiscing neque purus parturient a est eu accumsan placerat vestibulum.</p>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <h5><strong>Ullamcorper metus</strong></h5>
                                <p>Nam orci mi non ultricies ut eu in vitae pharetra est in dapibus eu cum nam. Nisl orci quisque congue in ullamcorper metus a hac a arcu tristique class ullamcorper mi lacinia leo id mi at lectus. Pulvinar in taciti dui condimentum a vel bibendum aliquet velit nam ultrices.&nbsp;Odio nec adipiscing neque purus parturient a est eu accumsan placerat dapibus adipiscing parturient placerat a tincidunt enim.</p>
                                <h5><strong>Dignissim a leo cum</strong></h5>
                                <p>A&nbsp;parturient adipiscing dignissim facilisi ullamcorper ut natoque vestibulum class. Mus sit ridiculus risus dignissim a leo cum adipiscing vehicula et adipiscing maecenas adipiscing senectus ultrices at pulvinar neque iaculis a viverra.&nbsp;Bibendum class nec sapien at cubilia dictumst torquent felis.</p>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab-02">
                        <table class="b-shop_attributes">
                            <tbody>
                            <tr>
                                <th>Color</th>
                                <td><p>Black, Brown, Blue</p></td>
                            </tr>
                            <tr>
                                <th>Size</th>
                                <td><p>L, M, XS</p></td>
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
                    <div role="tabpanel" class="tab-pane fade" id="tab-04">
                        <div>
                            <img src="front-css/assets/images/products/product-single/shipping.jpg" class="alignleft">
                            <p>Vestibulum curae torquent diam diam commodo parturient penatibus nunc dui adipiscing convallis bulum parturient suspendisse parturient a.Parturient in parturient scelerisque nibh lectus quam a natoque adipiscing a vestibulum hendrerit et pharetra fames.Consequat net</p>

                            <p>Vestibulum parturient suspendisse parturient a.Parturient in parturient scelerisque  nibh lectus quam a natoque adipiscing a vestibulum hendrerit et pharetra fames.Consequat netus.</p>

                            <p>Scelerisque adipiscing bibendum sem vestibulum et in a a a purus lectus faucibus lobortis tincidunt purus lectus nisl class eros.Condimentum a et ullamcorper dictumst mus et tristique elementum nam inceptos hac vestibulum amet elit</p>

                            <div class="clearfix"></div>
                        </div>
                    </div>
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
                                    <img data-src="front-css/front-css/assets/images/products/product-single/product_grid_10_01.jpg, front-css/front-css/assets/images/products/product-single/product_grid_10_02.jpg" src=" front-css/front-css/assets/images/products/product-single/product_grid_10_01.jpg" class="img-fluid img-switch d-block m-auto" alt="" style="">
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
                                    <img data-src="front-css/front-css/assets/images/products/product-single/product_grid_11_01.jpg, front-css/front-css/assets/images/products/product-single/product_grid_11_02.jpg" src="front-css/front-css/assets/images/products/product-single/product_grid_11_01.jpg" class="img-fluid img-switch d-block m-auto" alt="" style="">
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
                                    <img data-src="front-css/front-css/assets/images/products/product-single/product_grid_12_01.jpg, front-css/front-css/assets/images/products/product-single/product_grid_12_02.jpg" src="front-css/front-css/assets/images/products/product-single/product_grid_12_01.jpg" class="img-fluid img-switch d-block m-auto" alt="" style="">
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
                                    <img data-src="front-css/front-css/assets/images/products/product-single/product_grid_13_01.jpg, front-css/front-css/assets/images/products/product-single/product_grid_13_02.jpg" src="front-css/front-css/assets/images/products/product-single/product_grid_13_01.jpg" class="img-fluid img-switch d-block m-auto" alt="" style="">
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
                                    <img data-src="front-css/front-css/assets/images/products/product-single/product_grid_11_01.jpg, front-css/front-css/assets/images/products/product-single/product_grid_11_02.jpg" src="front-css/front-css/assets/images/products/product-single/product_grid_11_01.jpg" class="img-fluid img-switch d-block m-auto" alt="" style="">
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
                                    <img data-src="front-css/front-css/assets/images/products/product-single/product_grid_12_01.jpg, front-css/front-css/assets/images/products/product-single/product_grid_12_02.jpg" src="front-css/front-css/assets/images/products/product-single/product_grid_12_01.jpg" class="img-fluid img-switch d-block m-auto" alt="" style="">
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

<div class="b-wrapper">
    <div class="b-page-title-wrap b-title-dark-scheme">
        <h1 class="b-page-title text-center">Single Product</h1>
        <ul class="b-breadcrumbs">
            <li><a href=""><i class="fa fa-home"></i> Home</a></li>
            <li> Single Product </li>
        </ul>
    </div>

        <div class="container" style="width: 100%">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="b-decent-title-wrap">
                        <p class="b-decent-subtitle">WOOCOMMERCE</p>
                        <div class="b-decent-title">
                            <span>Single Product</span>
                        </div>
                        <p class="b-decent-after-title">
                            Single product page by product ID
                        </p>
                    </div>
                    <div class="b-product_single_breadcrumbs pt-3 pb-3 mt-up-10">
                        <div class="container">
                            <div class="row clearfix">
                                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                    <div class="b-breadcrumbs">
                                        <a href="#">Home</a>
                                        <a href="#">Shop</a>
                                        <a href="#">Man</a>
                                        <span>Shirt</span>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <ul class="list-unstyled pl-0 float-right mb-0">
                                        <li class="d-inline-block mr-2"><i class="fa fa-long-arrow-left"></i></li>
                                        <lii class="d-inline-block"><i class="fa fa-long-arrow-right"></i>
                                        </lii></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="row clearfix b-product-display">
                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 b-display-single">
                            <div class="b-product-carousel owl-carousel" id="bSingleProductCarousel" data-slider-id="bSingleProductCarousel">
                                <div class="b-produt-item">
                                    <img src="front-css/assets/images/products/product-single/product-single.jpg" alt="" class="img-fluid">
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="row clearfix b-product-display">
                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 b-display-single">
                            <div class="b-product-carousel owl-carousel" id="bSingleProductCarousel" data-slider-id="bSingleProductCarousel">
                                <div class="b-produt-item">
                                    <img src="front-css/assets/images/products/product-single/product-single.jpg" alt="" class="img-fluid">
                                </div>
                            </div>


                        </div>

                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="b-product_single_summary">
                        <h1>Basic knit dress chest</h1>
                        <p class="b-price">
                      <span class="b-amount">
                      <span class="b-symbol">£</span>10.00</span>
                        </p>
                        <div class="b-produt_description">
                            <p>Praesent fringilla est id egestas a pretium consectetur quisque consectetur pulvinar at vestibulum vitae id praesent eget magnis vestibulum.Facilisis adipiscing nulla blandit sem nec est vestibulum malesuada in.</p>
                        </div>
                        <div class="b-product_attr">
                            <div class="b-product_attr_single">
                                <ul class="pl-0 list-unstyled clearfix">
                                    <li><span class="b-product_attr_title pt-1">Color:</span></li>
                                    <li><a href="#"><span data-toggle="tooltip" title="" data-original-title="Black" class="b-color_attr b-black"></span></a></li>
                                    <li><a href="#"><span data-toggle="tooltip" title="" data-original-title="Red" class="b-color_attr b-red"></span></a></li>
                                    <li><a href="#"><span data-toggle="tooltip" title="" data-original-title="Yellow" class="b-color_attr b-yellow"></span></a></li>
                                </ul>
                            </div>
                            <div class="b-product_attr_single">
                                <ul class="pl-0 list-unstyled clearfix">
                                    <li><span class="b-product_attr_title">Size:</span></li>
                                    <li><a href="#"><span class="b-size_attr">L</span></a></li>
                                    <li><a href="#"><span class="b-size_attr">M</span></a></li>
                                    <li><a href="#"><span class="b-size_attr">S</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="b-product_single_action clearfix">
                            <div class="b-quantity pull-left">
                                <input type="button" value="-" class="b-minus minus">
                                <input type="text" step="1" min="1" max="" name="b-quantity" value="1" title="Qty" class="input-text qty count text" size="4" pattern="[0-9]*" inputmode="numeric">
                                <input type="button" value="+" class="b-plus plus">
                            </div>
                            <button class="text-uppercase pull-left btn">add to cart</button>
                        </div>
                        <div class="b-product_single_option">
                            <ul class="pl-0 list-unstyled">
                                <li><a href="#"><i class="icon-heart icons"></i> Add to wishlist</a></li>
                                <li><a href="#"><i class="icon-refresh icons"></i> Compare</a></li>
                                <li><b class="text-uppercase">Sku</b>: N/A</li>
                                <li><b>Category</b>: <a href="#">WoMan</a></li>
                                <li>
                                    <b>Share</b>:
                                    <span class="b-share_product">
                            <a href="#" class="fa fa-facebook"></a>
                            <a href="#" class="fa fa-twitter"></a>
                            <a href="#" class="fa fa-instagram"></a>
                            <a href="#" class="fa fa-envelope"></a>
                            <a href="#" class="fa fa-google-plus"></a>
                            <a href="#" class="fa fa-pint"></a>
                          </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="b-gray_bg b-product_tabs">
        <div class="container">
            <div class="row">
                <ul class="nav nav-tabs clearfix" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#tab-01" role="tab" data-toggle="tab">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-02" role="tab" data-toggle="tab">Additional information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-03" role="tab" data-toggle="tab">Reviews (2)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-04" role="tab" data-toggle="tab">Shipping & Delivery</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active show" id="tab-01">
                        <div class="row clearfix">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
                                <h5><strong>TEMPUS CONSECTETUR</strong></h5>
                                <p class="b-font_title pt-1 pb-1">Ac dis vestibulum ut primis eleifend at neque at ornare mus nostra non senectus magna natoque porta scelerisque molestie taciti lobortis torquent ullamcorper a ullamcorper. Hac suspendisse varius ut et consectetur eu in nisi vestibulum consectetur ultricies in dictum consectetur eu hendrerit ante tortor sagittis etiam porta scelerisque molestie ostra non senectus magna natoque.</p>
                                <p>Vestibulum volutpat inceptos augue maecenas vehicula curae fringilla ridiculus consectetur tincidunt sit suspendisse rutrum facilisis nibh id ad scelerisque feugiat. Suspendisse habitasse aenean a at enim quis in congue a vestibulum lacinia tortor nam ridiculus.  Dictum consectetur eu hendrerit ante tortor sagittis etiam. Hac suspendisse varius ut et consectetur eu porta scelerisque molestie.</p>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <h5 class="text-center"><strong>FIND YOUR SIZE</strong></h5>
                                <div class="table-responsive">
                                    <table class="b-shop_attributes b-sho-attr-center">
                                        <tbody>
                                        <tr>
                                            <th>SIZE</th>
                                            <th>CHEST</th>
                                            <th>WAIST</th>
                                            <th>HIPS</th>
                                            <th>HEIGHT</th>
                                            <th>AGE</th>
                                        </tr>
                                        <tr>
                                            <td><strong>S</strong></td>
                                            <td>6–7</td>
                                            <td>64.5–66</td>
                                            <td>59.5–61.5</td>
                                            <td>68.5–71</td>
                                            <td>122–128</td>
                                        </tr>
                                        <tr>
                                            <td><strong>M</strong></td>
                                            <td>8–9</td>
                                            <td>66–69</td>
                                            <td>61.5–65</td>
                                            <td>71–74.5</td>
                                            <td>128–137</td>
                                        </tr>
                                        <tr>
                                            <td><strong>L</strong></td>
                                            <td>10–12</td>
                                            <td>69–75</td>
                                            <td>65–69</td>
                                            <td>74.5–79.5</td>
                                            <td>137–147</td>
                                        </tr>
                                        <tr>
                                            <td><strong>XL</strong></td>
                                            <td>14–16</td>
                                            <td>75–81.5</td>
                                            <td>69–72.5</td>
                                            <td>79.5–84.5</td>
                                            <td>147–158</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab-02">
                        <table class="b-shop_attributes">
                            <tbody>
                            <tr>
                                <th>Color</th>
                                <td><p>Black, Brown, Blue</p></td>
                            </tr>
                            <tr>
                                <th>Size</th>
                                <td><p>L, M, S</p></td>
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
                                                    admin <em>- November 3, 2015</em>
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
                                                <p>Ut volutpat malesuada massa senectus ad donec a ad elementum iaculis adipiscing arcu suspendisse torquent habitant a.Ullamcorper adipiscing class ut id nisi congue laoreet pharetra quis condimentum taciti amet ac a sociis ullamcorper ullamcorper.</p>
                                            </div>
                                        </div>

                                        <div class="b-review_single">
                                            <img src="front-css/assets/images/products/product-single/user.png" class="img-fluid" alt="">
                                            <div class="b-review_header clearfix">
                                                <p class="float-left">
                                                    admin <em>- November 28, 2015</em>
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
                                                <p>Praesent fringilla est id egestas a pretium consectetur quisque consectetur pulvinar at vestibulum vitae id praesent eget magnis vestibulum.Facilisis adipiscing nulla blandit sem nec est vestibulum malesuada in.</p>
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
                    <div role="tabpanel" class="tab-pane fade" id="tab-04">
                        <div>
                            <img src="front-css/assets/images/products/product-single/shipping.jpg" class="alignleft">
                            <p>Vestibulum curae torquent diam diam commodo parturient penatibus nunc dui adipiscing convallis bulum parturient suspendisse parturient a.Parturient in parturient scelerisque nibh lectus quam a natoque adipiscing a vestibulum hendrerit et pharetra fames.Consequat net</p>

                            <p>Vestibulum parturient suspendisse parturient a.Parturient in parturient scelerisque  nibh lectus quam a natoque adipiscing a vestibulum hendrerit et pharetra fames.Consequat netus.</p>

                            <p>Scelerisque adipiscing bibendum sem vestibulum et in a a a purus lectus faucibus lobortis tincidunt purus lectus nisl class eros.Condimentum a et ullamcorper dictumst mus et tristique elementum nam inceptos hac vestibulum amet elit</p>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
