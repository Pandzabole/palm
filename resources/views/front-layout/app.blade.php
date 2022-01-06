<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <!-- PAGE TITLE -->
    <title>Palm Skils</title>

    @include('front-partials.meta-data')
    @include('front-partials.css-links')
</head>
<body>
    @include('front-partials.mobile-menu')
<div class="b-wrapper">
    <header id="b-header">
        @include('front-partials.main-navigation')
    </header>
        @include('front-partials.sub-manu')
        @include('front-partials.home-slider')
    <section id="b-products_cat">
        <div class="b-section_title text-center">
            <span>MADE THE HARD WAY</span>
            <h4 class="text-uppercase">
                FEATURED CATEGORIES
                <span class="b-title_separator"><span></span></span>
            </h4>
            <p class="b-section_text">Basel Co. is a powerful eCommerce theme for WordPress. Visit our shop page to see all main features for <a href="#" target="_blank">Your Store</a></p>
        </div>
        <div class="b-featured_cat">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-mb-6 col-sm-6 col-xs-12">
                        <div class="b-featured_cat_in">
                            <a href="#">
                                <img src="front-css/assets/images/category/home/feature_cat_01.jpg" class="img-fluid d-block" alt="">
                            </a>
                            <div class="b-cat_mask">
                                <a href="#" class="category-link-overlay">Bags</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-mb-3 col-sm-3 col-xs-12">
                        <div class="b-featured_cat_in mb-4">
                            <a href="#">
                                <img src="front-css/assets/images/category/home/feature_cat_02.jpg" class="img-fluid d-block" alt="">
                            </a>
                            <div class="b-cat_mask">
                                <a href="#" class="category-link-overlay">Shoes</a>
                            </div>
                        </div>
                        <div class="b-featured_cat_in">
                            <a href="#">
                                <img src="front-css/assets/images/category/home/feature_cat_03.jpg" class="img-fluid d-block" alt="">
                            </a>
                            <div class="b-cat_mask">
                                <a href="#" class="category-link-overlay">Women</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-mb-3 col-sm-3 col-xs-12">
                        <div class="b-featured_cat_in">
                            <a href="#">
                                <img src="front-css/assets/images/category/home/feature_cat_04.jpg" class="img-fluid d-block" alt="">
                            </a>
                            <div class="b-cat_mask">
                                <a href="#" class="category-link-overlay">Watches</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="b-products">
        <div class="b-section_title">
            <h4 class="text-center text-uppercase">
                FEATURED PRODUCTS
                <span class="b-title_separator"><span></span></span>
            </h4>
        </div>
        <div class="b-products b-product_grid b-product_grid_four mb-4">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-xl-3 col-lg-3 col-mb-3 col-sm-3 col-xs-12">
                        <div class="b-product_grid_single">
                            <div class="b-product_grid_header">
                                <a href="#">
                                    <img data-src="front-css/assets/images/products/home/product_grid_01_01.jpg, front-css/assets/images/products/home/product_grid_01_02.jpg" src="front-css/assets/images/products/home/product_grid_01_01.jpg" class="img-fluid img-switch d-block" alt="">
                                </a>
                                <div class="b-product_grid_action">
                                    <a href="javascript:void(0)" data-whishurl="whishlist.html" data-toggle="tooltip" data-placement="left" title="Add to Whishlist">
                                        <i class="icon-heart icons b-add_to_whish">
                                            <img src="front-css/assets/images/products/product_loading.gif" class="g-loading_gif" alt="">
                                        </i>
                                    </a>
                                    <i data-toggle="tooltip" data-placement="left" title="Compare" class="icon-refresh icons"></i>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#b-qucik_view">
                                        <i data-toggle="tooltip" data-placement="left" title="Quick View" class="icon-magnifier-add icons" ></i>
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
                                                <span data-toggle="tooltip" title="Black" class="b-black"></span>
                                            </li>
                                            <li>
                                                <span data-toggle="tooltip" title="Blue" class="b-blue"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-mb-3 col-sm-3 col-xs-12">
                        <div class="b-product_grid_single">
                            <div class="b-product_grid_header">
                                <a href="#">
                                    <img data-src="front-css/assets/images/products/home/product_grid_02_01.jpg, front-css/assets/images/products/home/product_grid_02_02.jpg" src="front-css/assets/images/products/home/product_grid_02_01.jpg" class="img-fluid img-switch d-block" alt="">
                                </a>
                                <div class="b-product_grid_action">
                                    <a href="javascript:void(0)" data-whishurl="whishlist.html" data-toggle="tooltip" data-placement="left" title="Add to Whishlist">
                                        <i class="icon-heart icons b-add_to_whish">
                                            <img src="front-css/assets/images/products/product_loading.gif" class="g-loading_gif" alt="">
                                        </i>
                                    </a>
                                    <i data-toggle="tooltip" data-placement="left" title="Compare" class="icon-refresh icons"></i>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#b-qucik_view">
                                        <i data-toggle="tooltip" data-placement="left" title="Quick View" class="icon-magnifier-add icons" ></i>
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
                                                <span data-toggle="tooltip" title="Black" class="b-black"></span>
                                            </li>
                                            <li>
                                                <span data-toggle="tooltip" title="Brown" class="b-brown"></span>
                                            </li>
                                            <li>
                                                <span data-toggle="tooltip" title="Red" class="b-red"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-mb-3 col-sm-3 col-xs-12">
                        <div class="b-product_grid_single">
                            <div class="b-product_grid_header">
                                <a href="#">
                                    <img data-src="front-css/assets/images/products/home/product_grid_03_01.jpg, front-css/assets/images/products/home/product_grid_03_02.jpg" src="front-css/assets/images/products/home/product_grid_03_01.jpg" class="img-fluid img-switch d-block" alt="">
                                </a>
                                <div class="b-product_grid_action">
                                    <a href="javascript:void(0)" data-whishurl="whishlist.html" data-toggle="tooltip" data-placement="left" title="Add to Whishlist">
                                        <i class="icon-heart icons b-add_to_whish">
                                            <img src="front-css/assets/images/products/product_loading.gif" class="g-loading_gif" alt="">
                                        </i>
                                    </a>
                                    <i data-toggle="tooltip" data-placement="left" title="Compare" class="icon-refresh icons"></i>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#b-qucik_view">
                                        <i data-toggle="tooltip" data-placement="left" title="Quick View" class="icon-magnifier-add icons" ></i>
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
                                                <span data-toggle="tooltip" title="Brown" class="b-brown"></span>
                                            </li>
                                            <li>
                                                <span data-toggle="tooltip" title="Blue" class="b-blue"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-mb-3 col-sm-3 col-xs-12">
                        <div class="b-product_grid_single">
                            <div class="b-product_grid_header">
                                <a href="#">
                                    <img data-src="front-css/assets/images/products/home/product_grid_04_01.jpg, front-css/assets/images/products/home/product_grid_04_02.jpg" src="front-css/assets/images/products/home/product_grid_04_01.jpg" class="img-fluid img-switch d-block" alt="">
                                </a>
                                <div class="b-product_grid_action">
                                    <a href="javascript:void(0)" data-whishurl="whishlist.html" data-toggle="tooltip" data-placement="left" title="Add to Whishlist">
                                        <i class="icon-heart icons b-add_to_whish">
                                            <img src="front-css/assets/images/products/product_loading.gif" class="g-loading_gif" alt="">
                                        </i>
                                    </a>
                                    <i data-toggle="tooltip" data-placement="left" title="Compare" class="icon-refresh icons"></i>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#b-qucik_view">
                                        <i data-toggle="tooltip" data-placement="left" title="Quick View" class="icon-magnifier-add icons" ></i>
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
                    <div class="col-xl-3 col-lg-3 col-mb-3 col-sm-3 col-xs-12">
                        <div class="b-product_grid_single">
                            <div class="b-product_grid_header">
                                <a href="#">
                                    <img data-src="front-css/assets/images/products/home/product_grid_05_01.jpg, front-css/assets/images/products/home/product_grid_05_02.jpg" src="front-css/assets/images/products/home/product_grid_05_01.jpg" class="img-fluid img-switch d-block" alt="">
                                </a>
                                <div class="b-product_grid_action">
                                    <a href="javascript:void(0)" data-whishurl="whishlist.html" data-toggle="tooltip" data-placement="left" title="Add to Whishlist">
                                        <i class="icon-heart icons b-add_to_whish">
                                            <img src="front-css/assets/images/products/product_loading.gif" class="g-loading_gif" alt="">
                                        </i>
                                    </a>
                                    <i data-toggle="tooltip" data-placement="left" title="Compare" class="icon-refresh icons"></i>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#b-qucik_view">
                                        <i data-toggle="tooltip" data-placement="left" title="Quick View" class="icon-magnifier-add icons" ></i>
                                    </a>
                                </div>
                            </div>
                            <div class="b-product_grid_info">
                                <h3 class="product-title">
                                    <a href="#">Black umbrella in handle</a>
                                </h3>
                                <div class="clearfix">
                                    <div class="b-product_grid_toggle float-left">
                                        <span class="b-price">$99</span>
                                        <span class="b-add_cart">
                                              <i class="icon-basket icons"></i>
                                              <a href="#">Add to cart</a>
                                          </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-mb-3 col-sm-3 col-xs-12">
                        <div class="b-product_grid_single">
                            <div class="b-product_grid_header">
                                <a href="#">
                                    <img data-src="front-css/assets/images/products/home/product_grid_06_01.jpg, front-css/assets/images/products/home/product_grid_06_02.jpg" src="front-css/assets/images/products/home/product_grid_06_01.jpg" class="img-fluid img-switch d-block" alt="">
                                </a>
                                <div class="b-product_grid_action">
                                    <a href="javascript:void(0)" data-whishurl="whishlist.html" data-toggle="tooltip" data-placement="left" title="Add to Whishlist">
                                        <i class="icon-heart icons b-add_to_whish">
                                            <img src="front-css/assets/images/products/product_loading.gif" class="g-loading_gif" alt="">
                                        </i>
                                    </a>
                                    <i data-toggle="tooltip" data-placement="left" title="Compare" class="icon-refresh icons"></i>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#b-qucik_view">
                                        <i data-toggle="tooltip" data-placement="left" title="Quick View" class="icon-magnifier-add icons" ></i>
                                    </a>
                                </div>
                            </div>
                            <div class="b-product_grid_info">
                                <h3 class="product-title">
                                    <a href="#">Houble strap backpack</a>
                                </h3>
                                <div class="clearfix">
                                    <div class="b-product_grid_toggle float-left">
                                        <span class="b-price">$10</span>
                                        <span class="b-add_cart">
                                            <i class="icon-basket icons"></i>
                                            <a href="#">Add to cart</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-mb-3 col-sm-3 col-xs-12">
                        <div class="b-product_grid_single">
                            <div class="b-product_grid_header">
                                <a href="#">
                                    <img data-src="front-css/assets/images/products/home/product_grid_07_01.jpg, front-css/assets/images/products/home/product_grid_07_02.jpg" src="front-css/assets/images/products/home/product_grid_07_01.jpg" class="img-fluid img-switch d-block" alt="">
                                </a>
                                <div class="b-product_grid_action">
                                    <a href="javascript:void(0)" data-whishurl="whishlist.html" data-toggle="tooltip" data-placement="left" title="Add to Whishlist">
                                        <i class="icon-heart icons b-add_to_whish">
                                            <img src="front-css/assets/images/products/product_loading.gif" class="g-loading_gif" alt="">
                                        </i>
                                    </a>
                                    <i data-toggle="tooltip" data-placement="left" title="Compare" class="icon-refresh icons"></i>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#b-qucik_view">
                                        <i data-toggle="tooltip" data-placement="left" title="Quick View" class="icon-magnifier-add icons" ></i>
                                    </a>
                                </div>
                            </div>
                            <div class="b-product_grid_info">
                                <h3 class="product-title">
                                    <a href="#">Eingerless gloves in camel</a>
                                </h3>
                                <div class="clearfix">
                                    <div class="b-product_grid_toggle float-left">
                                        <span class="b-price">$392</span>
                                        <span class="b-add_cart">
                                            <i class="icon-basket icons"></i>
                                            <a href="#">Add to cart</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-mb-3 col-sm-3 col-xs-12">
                        <div class="b-product_grid_single">
                            <div class="b-product_grid_header">
                                <a href="#">
                                    <img data-src="front-css/assets/images/products/home/product_grid_08_01.jpg, front-css/assets/images/products/home/product_grid_08_02.jpg" src="front-css/assets/images/products/home/product_grid_08_01.jpg" class="img-fluid img-switch d-block" alt="">
                                </a>
                                <div class="b-product_grid_action">
                                    <a href="javascript:void(0)" data-whishurl="whishlist.html" data-toggle="tooltip" data-placement="left" title="Add to Whishlist">
                                        <i class="icon-heart icons b-add_to_whish">
                                            <img src="front-css/assets/images/products/product_loading.gif" class="g-loading_gif" alt="">
                                        </i>
                                    </a>
                                    <i data-toggle="tooltip" data-placement="left" title="Compare" class="icon-refresh icons"></i>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#b-qucik_view">
                                        <i data-toggle="tooltip" data-placement="left" title="Quick View" class="icon-magnifier-add icons" ></i>
                                    </a>
                                </div>
                            </div>
                            <div class="b-product_grid_info">
                                <h3 class="product-title">
                                    <a href="#">Gthnic detail open jacket</a>
                                </h3>
                                <div class="clearfix">
                                    <div class="b-product_grid_toggle float-left">
                                        <span class="b-price">$59</span>
                                        <span class="b-add_cart">
                                            <i class="icon-basket icons"></i>
                                            <a href="#">Select Options</a>
                                        </span>
                                    </div>
                                    <div class="b-product_options float-right">
                                        <ul class="pl-0 mb-0 list-unstyled">
                                            <li>
                                                <span data-toggle="tooltip" title="Black" class="b-black"></span>
                                            </li>
                                            <li>
                                                <span data-toggle="tooltip" title="Yellow" class="b-yellow"></span>
                                            </li>
                                            <li>
                                                <span data-toggle="tooltip" title="Blue" class="b-blue"></span>
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
    <section id="b-newsletter">
        <div class="b-newsletter b-newsletter_bg mb-5">
            <div class="b-newsletter_inner">
                <h3 class="text-center font-italic">Connect to Basel & Co.</h3>
                <h2 class="text-center">Join Our Newsletter</h2>
                <p class="text-center">Hey you, sign up it only takes a second to be the first to find out about our latest news and promotions…</p>
                <div class="b-newsletter_form">
                    <form action="#" class="clearfix">
                        <div class="form-group float-left">
                            <label>Email address: </label>
                            <input name="email" placeholder="Your email address" required="" type="email">
                        </div>
                        <div class="b-form_submit float-left">
                            <button class="b-submit">Sign up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section id="b-blog">
        <div class="b-section_title">
            <h4 class="text-center text-uppercase">
                LATEST NEWS
                <span class="b-title_separator"><span></span></span>
            </h4>
        </div>
        <div class="b-blog b-blog_grid text-center b-blog_grid_three mb-5">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-xl-4 col-lg-4 col-mb-4 col-sm-6 col-xs-12">
                        <div class="b-blog_grid_single">
                            <div class="b-blog_single_header">
                                <div class="b-blog_img_wrap">
                                    <a href="#">
                                        <img src="front-css/assets/images/blog/home/cat_grid_03_01.jpg" class="img-fluid d-block" alt="">
                                    </a>
                                </div>
                                <div class="b-post_time">
                                    <span class="b-post_day">08</span>
                                    <span class="b-post_month">Aug</span>
                                </div>
                                <div class="b-post_categories">
                                    <div class="b-post_categorie_list">
                                        <a href="#" rel="category tag">Creative</a>,
                                        <a href="#" rel="category tag">Hobbies</a>
                                    </div>
                                </div>
                            </div>
                            <div class="b-blog_single_info">
                                <h3 class="b-entry_title">
                                    <a href="#" rel="bookmark">Venenatis veulum peus</a>
                                </h3>
                                <div class="b-author_info">
                                        <span class="b-author_name">
                                            By <a href="#" rel="author">V. Harrison</a>
                                        </span>
                                    <span class="b-reply">
                                            <a href="#">Leave a comment</a>
                                        </span>
                                </div>
                                <div class="b-blog_single_content">
                                    <p>Sociosqu scele risque aliquet penatibus pretium vesti bulum imperdiet ad metus a tempus congue a venenatis condi mentum parturient dis</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-mb-4 col-sm-6 col-xs-12">
                        <div class="b-blog_grid_single">
                            <div class="b-blog_single_header">
                                <div class="b-blog_img_wrap">
                                    <a href="#">
                                        <img src="front-css/assets/images/blog/home/cat_grid_03_02.jpg" class="img-fluid d-block" alt="">
                                    </a>
                                </div>
                                <div class="b-post_time">
                                    <span class="b-post_day">08</span>
                                    <span class="b-post_month">Aug</span>
                                </div>
                                <div class="b-post_categories">
                                    <div class="b-post_categorie_list">
                                        <a href="#" rel="category tag">Creative</a>,
                                        <a href="#" rel="category tag">Hobbies</a>
                                    </div>
                                </div>
                            </div>
                            <div class="b-blog_single_info">
                                <h3 class="b-entry_title">
                                    <a href="#" rel="bookmark">Hac fames tempor</a>
                                </h3>
                                <div class="b-author_info">
                                        <span class="b-author_name">
                                            By <a href="#" rel="author">V. Harrison</a>
                                        </span>
                                    <span class="b-reply">
                                            <a href="#">Leave a comment</a>
                                        </span>
                                </div>
                                <div class="b-blog_single_content">
                                    <p>Egestas mus a mus rhoncus adipiscing iaculis facilisis a eu nunc varius a per parturient vestibulum suspendisse aenean semper velit aliquam</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-mb-4 col-sm-6 col-xs-12">
                        <div class="b-blog_grid_single">
                            <div class="b-blog_single_header">
                                <div class="b-blog_img_wrap">
                                    <a href="#">
                                        <img src="front-css/assets/images/blog/home/cat_grid_03_03.jpg" class="img-fluid d-block" alt="">
                                    </a>
                                </div>
                                <div class="b-post_time">
                                    <span class="b-post_day">08</span>
                                    <span class="b-post_month">Aug</span>
                                </div>
                                <div class="b-post_categories">
                                    <div class="b-post_categorie_list">
                                        <a href="#" rel="category tag">Creative</a>,
                                        <a href="#" rel="category tag">Hobbies</a>
                                    </div>
                                </div>
                            </div>
                            <div class="b-blog_single_info">
                                <h3 class="b-entry_title">
                                    <a href="#" rel="bookmark">Urna ligula inceptos</a>
                                </h3>
                                <div class="b-author_info">
                                        <span class="b-author_name">
                                            By <a href="#" rel="author">V. Harrison</a>
                                        </span>
                                    <span class="b-reply">
                                            <a href="#">Leave a comment</a>
                                        </span>
                                </div>
                                <div class="b-blog_single_content">
                                    <p>Vestibulum malesuada elit sit placerat congue viverra congue orci cras mus sociis non mi enim cum ante. Condimentum ac ac ullamcorper ar</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-mb-4 col-sm-6 col-xs-12">
                        <div class="b-blog_grid_single">
                            <div class="b-blog_single_header">
                                <div class="b-blog_img_wrap">
                                    <a href="#">
                                        <img src="front-css/assets/images/blog/home/cat_grid_03_04.jpg" class="img-fluid d-block" alt="">
                                    </a>
                                </div>
                                <div class="b-post_time">
                                    <span class="b-post_day">08</span>
                                    <span class="b-post_month">Aug</span>
                                </div>
                                <div class="b-post_categories">
                                    <div class="b-post_categorie_list">
                                        <a href="#" rel="category tag">Creative</a>,
                                        <a href="#" rel="category tag">Hobbies</a>
                                    </div>
                                </div>
                            </div>
                            <div class="b-blog_single_info">
                                <h3 class="b-entry_title">
                                    <a href="#" rel="bookmark">Dapibus a at gravida</a>
                                </h3>
                                <div class="b-author_info">
                                        <span class="b-author_name">
                                            By <a href="#" rel="author">V. Harrison</a>
                                        </span>
                                    <span class="b-reply">
                                            <a href="#">Leave a comment</a>
                                        </span>
                                </div>
                                <div class="b-blog_single_content">
                                    <p>Ut cubilia metus sagittis rhoncus non suspendisse vestibulum a taciti posuere urna scelerisque neque scelerisque condimentum sed hac sem</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-mb-4 col-sm-6 col-xs-12">
                        <div class="b-blog_grid_single">
                            <div class="b-blog_single_header">
                                <div class="b-blog_img_wrap">
                                    <a href="#">
                                        <img src="front-css/assets/images/blog/home/cat_grid_03_05.jpg" class="img-fluid d-block" alt="">
                                    </a>
                                </div>
                                <div class="b-post_time">
                                    <span class="b-post_day">08</span>
                                    <span class="b-post_month">Aug</span>
                                </div>
                                <div class="b-post_categories">
                                    <div class="b-post_categorie_list">
                                        <a href="#" rel="category tag">Creative</a>,
                                        <a href="#" rel="category tag">Hobbies</a>
                                    </div>
                                </div>
                            </div>
                            <div class="b-blog_single_info">
                                <h3 class="b-entry_title">
                                    <a href="#" rel="bookmark">Condintum intelger ridis</a>
                                </h3>
                                <div class="b-author_info">
                                        <span class="b-author_name">
                                            By <a href="#" rel="author">V. Harrison</a>
                                        </span>
                                    <span class="b-reply">
                                            <a href="#">Leave a comment</a>
                                        </span>
                                </div>
                                <div class="b-blog_single_content">
                                    <p>In suspendisse at condimentum vitae torquent eu nam a adipiscing convallis quis elit quis mi suscipit adipiscing risus nisi quis leo elementum justo</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-mb-4 col-sm-6 col-xs-12">
                        <div class="b-blog_grid_single">
                            <div class="b-blog_single_header">
                                <div class="b-blog_img_wrap">
                                    <a href="#">
                                        <img src="front-css/assets/images/blog/home/cat_grid_03_06.jpg" class="img-fluid d-block" alt="">
                                    </a>
                                </div>
                                <div class="b-post_time">
                                    <span class="b-post_day">08</span>
                                    <span class="b-post_month">Aug</span>
                                </div>
                                <div class="b-post_categories">
                                    <div class="b-post_categorie_list">
                                        <a href="#" rel="category tag">Creative</a>,
                                        <a href="#" rel="category tag">Hobbies</a>
                                    </div>
                                </div>
                            </div>
                            <div class="b-blog_single_info">
                                <h3 class="b-entry_title">
                                    <a href="#" rel="bookmark">Condentum integer ridiculus</a>
                                </h3>
                                <div class="b-author_info">
                                        <span class="b-author_name">
                                            By <a href="#" rel="author">V. Harrison</a>
                                        </span>
                                    <span class="b-reply">
                                            <a href="#">Leave a comment</a>
                                        </span>
                                </div>
                                <div class="b-blog_single_content">
                                    <p>A sodales suspen disse vestibulum dui ultrices ferm entum a parturient scele risque potenti placerat blandit purus adipiscing eros habitasse sodales</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="b-load_more text-center">
                    <a href="#" class="btn b-blog_load_more">Load More Posts</a>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row clearfix mb-2">
            <div class="col-xl-6 col-lg-6 col-mb-6 col-sm-6 col-xs-12">
                <section id="b-testimonial">
                    <div class="b-section_title">
                        <h4 class="text-center text-uppercase">
                            WHAT THEY SAY ABOUT US
                            <span class="b-title_separator"><span></span></span>
                        </h4>
                    </div>
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
            <div class="col-xl-6 col-lg-6 col-mb-6 col-sm-6 col-xs-12">
                <div class="b-instagram_feeds mb-5">
                    <ul class="b-instagram_pics list-inline">
                        <li>
                            <a href="#" target="_self"></a>
                            <div class="wrapp-pics">
                                <img src="front-css/assets/images/instagram/home/default-instagramm-1.jpg" alt="" class="img-fluid d-block">
                                <div class="hover-mask"></div>
                            </div>
                        </li>
                        <li>
                            <a href="#" target="_self"></a>
                            <div class="wrapp-pics">
                                <img src="front-css/assets/images/instagram/home/default-instagramm-2.jpg" alt="" class="img-fluid d-block">
                                <div class="hover-mask"></div>
                            </div>
                        </li>
                        <li>
                            <a href="#" target="_self"></a>
                            <div class="wrapp-pics">
                                <img src="front-css/assets/images/instagram/home/default-instagramm-3.jpg" alt="" class="img-fluid d-block">
                                <div class="hover-mask"></div>
                            </div>
                        </li>
                        <li>
                            <a href="#" target="_self"></a>
                            <div class="wrapp-pics">
                                <img src="front-css/assets/images/instagram/home/default-instagramm-4.jpg" alt="" class="img-fluid d-block">
                                <div class="hover-mask"></div>
                            </div>
                        </li>
                        <li>
                            <a href="#" target="_self"></a>
                            <div class="wrapp-pics">
                                <img src="front-css/assets/images/instagram/home/default-instagramm-5.jpg" alt="" class="img-fluid d-block">
                                <div class="hover-mask"></div>
                            </div>
                        </li>
                        <li>
                            <a href="#" target="_self"></a>
                            <div class="wrapp-pics">
                                <img src="front-css/assets/images/instagram/home/default-instagramm-6.jpg" alt="" class="img-fluid d-block">
                                <div class="hover-mask"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="b-gallery_logo_outer">
        <div class="b-gallery_logo">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-xl-3 col-lg-3 col-mb-3 col-sm-4 col-xs-12">
                        <h2>our partners</h2>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-mb-9 col-sm-8 col-xs-12">
                        <div class="b-gallery_logo_list">
                            <ul class="p-0 m-0 owl-carousel owl-theme b-count_04" id="b-gallery_logo">
                                <li><a href="#"><img src="front-css/assets/images/partners/logo-1.png" class="img-fluid d-block" alt=""></a></li>
                                <li><a href="#"><img src="front-css/assets/images/partners/logo-2.png" class="img-fluid d-block" alt=""></a></li>
                                <li><a href="#"><img src="front-css/assets/images/partners/logo-3.png" class="img-fluid d-block" alt=""></a></li>
                                <li><a href="#"><img src="front-css/assets/images/partners/logo-4.png" class="img-fluid d-block" alt=""></a></li>
                                <li><a href="#"><img src="front-css/assets/images/partners/logo-1.png" class="img-fluid d-block" alt=""></a></li>
                                <li><a href="#"><img src="front-css/assets/images/partners/logo-2.png" class="img-fluid d-block" alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="b-footer_container color-scheme-light hidden -sm-down">
        <div class="container b-main_footer">
            <!-- footer-main -->
            <aside class="row clearfix">
                <div class="b-footer_column col-md-12 col-sm-12">
                    <div class="b-footer_block">
                        <div class="b-footer_block_in">
                            <p class="text-center mb-0"><img src="front-css/assets/images/logo-white.png" class="d-block m-auto img-fluid" alt="" title=""></p>
                            <ul class="b-social-icons text-center">
                                <li class="b-social_facebook"><a href="#" target="_blank"><i class="fa fa-facebook"></i>Facebook</a></li>
                                <li class="b-social_twitter"><a href="#" target="_blank"><i class="fa fa-twitter"></i>Twitter</a></li>
                                <li class="b-social_google"><a href="#" target="_blank"><i class="fa fa-google-plus"></i>Google</a></li>
                                <li class="b-social_email"><a href="#" target="_blank"><i class="fa fa-envelope"></i>Email</a></li>
                                <li class="b-social_pinterest"><a href="#" target="_blank"><i class="fa fa-pinterest"></i>Pinterest</a></li>
                            </ul>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="b-footer_column col-lg-2 col-md-3 col-sm-6 mb-4">
                    <div class="b-footer_block">
                        <h5 class="b-footer_block_title">Our Stores</h5>
                        <div class="b-footer_block_in">
                            <ul class="b-footer_menu">
                                <li><a href="#">New York</a></li>
                                <li><a href="#">London SF</a></li>
                                <li><a href="#">Cockfosters BP</a></li>
                                <li><a href="#">Los Angeles</a></li>
                                <li><a href="#">Chicago</a></li>
                                <li><a href="#">Las Vegas</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="b-footer_column col-lg-2 col-md-3 col-sm-6 mb-4">
                    <div class="b-footer_block">
                        <h5 class="b-footer_block_title">Information</h5>
                        <div class="b-footer_block_in">
                            <ul class="b-footer_menu">
                                <li><a href="#">About Store</a></li>
                                <li><a href="#">New Collection</a></li>
                                <li><a href="#">Woman Dress</a></li>
                                <li><a href="contact-01.html">Contact Us</a></li>
                                <li><a href="#">Latest News</a></li>
                                <li><a href="#">Our Sitemap</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="b-footer_column col-lg-2 col-md-3 col-sm-6 mb-4">
                    <div class="b-footer_block">
                        <h5 class="b-footer_block_title">Useful links</h5>
                        <div class="b-footer_block_in">
                            <ul class="b-footer_menu">
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Returns</a></li>
                                <li><a href="#">Terms &amp; Conditions</a></li>
                                <li><a href="contact-01.html">Contact Us</a></li>
                                <li><a href="#">Latest News</a></li>
                                <li><a href="#">Our Sitemap</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="b-footer_column col-lg-2 col-md-3 col-sm-6 mb-4 mb-4">
                    <div class="b-footer_block">
                        <h5 class="b-footer_block_title">Footer Menu</h5>
                        <div class="b-footer_block_in">
                            <ul class="b-footer_menu">
                                <li><a href="#">Instagram profile</a></li>
                                <li><a href="#">New Collection</a></li>
                                <li><a href="#">Woman Dress</a></li>
                                <li><a href="contact-01.html">Contact Us</a></li>
                                <li><a href="#">Latest News</a></li>
                                <li><a href="#" target="_blank">Purchase Theme</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="b-footer_column col-lg-4 col-md-12 col-sm-12 mb-4">
                    <div class="b-footer_block">
                        <h5 class="b-footer_block_title">About The Store</h5>
                        <div class="b-footer_block_in">
                            <p>STORE - worldwide fashion store since 1978. We sell over 1000+ branded products on our web-site.</p>
                            <div class="b-contact_info">
                                <i class="fa fa-location-arrow d-inline-block"></i> 451 Wall Street, USA, New York
                                <br>
                                <i class="fa fa-mobile d-inline-block"></i> Phone: (064) 332-1233
                                <br>
                            </div>
                            <br>
                            <p><img src="front-css/assets/images/payments.png" alt=""></p>
                        </div>
                    </div>
                </div>
            </aside>
            <!-- footer-main -->
        </div>
        <!-- footer-bar -->
        <div class="b-copyrights_wrapper">
            <div class="container">
                <div class="d-footer_bar">
                    <div class="text-center">
                        <i class="fa fa-copyright"></i> 2018 Created by
                        <a href="#" class="text-white">
                            jThemes Studio
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer-bar -->
    </footer>
    <a href="javascript:;" id="b-scrollToTop" class="b-scrollToTop">
        <span class="basel-tooltip-label">Scroll To Top</span>Scroll To Top
    </a>
    <div class="b-search_popup">
        <form role="search" method="get" id="searchform" class="searchform  basel-ajax-search" action="#" data-thumbnail="1" data-price="1" data-count="3">
            <div>
                <label class="screen-reader-text" for="s"></label>
                <input type="text" placeholder="Search for products" value="" name="s" id="s" autocomplete="off">
                <input type="hidden" name="post_type" id="post_type" value="product">
                <button type="submit" class="b-searchsubmit" id="b-searchsubmit">Search</button>
            </div>
        </form>
        <span class="b-close_search" id="b-close_search">close</span>
    </div>
</div>
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade product_view" id="b-qucik_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="btn btn-close btn-secondary" data-dismiss="modal">
                <i class="icon-close icons"></i>
            </button>
            <div class="modal-body p-0">
                <div class="row">
                    <div class="col-md-6 product_img">
                        <div class="owl-carousel owl-theme" id="b-product_pop_slider">
                            <div><img src="front-css/assets/images/accessories-01.jpg" class="img-fluid d-block m-auto"></div>
                            <div><img src="front-css/assets/images/accessories-02.jpg" class="img-fluid d-block m-auto"></div>
                        </div>
                    </div>
                    <div class="col-md-6 product_content pr-5 pt-4">
                        <div class="b-product_single_summary">
                            <h1>Jhecked Bag</h1>
                            <p class="b-price">
                              <span class="b-amount">
                              <span class="b-symbol">£</span>79.00</span>
                            </p>
                            <div class="b-produt_description">
                                <p>Adipiscing vehicula amet in natoque lobortis mus velit dis vestibulum ullamcorper senectus conubia suspendisse vestibulum nam condimentum aliquet ipsum justo eu vestibulum sagittis.A vel vehicula a mi varius porta.</p>
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
                                        <li><a href="#"><span class="b-size_attr">XL</span></a></li>
                                        <li><a href="#"><span class="b-size_attr">XXL</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="b-product_single_action clearfix">
                                <div class="b-quantity pull-left">
                                    <input type="button" value="-" class="b-minus">
                                    <input type="text" step="1" min="1" max="" name="b-quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="[0-9]*" inputmode="numeric">
                                    <input type="button" value="+" class="b-plus">
                                </div>
                                <button class="text-uppercase pull-left btn">add to cart</button>
                            </div>
                            <div class="b-product_single_option">
                                <ul class="pl-0 list-unstyled">
                                    <li><b class="text-uppercase">Sku</b>: N/A</li>
                                    <li><b>Category</b>: <a href="#">Man</a></li>
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
        </div>
    </div>
</div>
    @include('front-partials.js-links')
</body>
</html>
