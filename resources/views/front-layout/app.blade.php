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
        @include('front-partials.how-to-reserve-class')
        @include('front-partials.classes-home-page')
        @include('front-partials.why-us')

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
    @include('front-partials.js-links')
</body>
</html>
