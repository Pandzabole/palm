@extends('front-layout.app')

@section('content')
    <div class="b-contact b-contact_light pt-5 mt-4">
        <div class="container">
            <div class="row clearfix">
                <div class="col-xl-6 col-lg-6 col-mb-6 col-sm-12 col-xs-12">
                    <div class="b-title b-title_line_right">
                        <h2 class="text-uppercase">{{__('contact.touch-us')}}</h2>
                    </div>
                    <div class="clearfix row">
                        <div class="col-xl-6 col-lg-6 col-mb-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>{{__('contact.name')}} <i style="color: red;">*</i> <span id="userName-info" class="info"></span></label>
                                <input required="" type="text" name="userName" id="userName">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-mb-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>{{__('contact.email')}} <i style="color: red;">*</i>  <span id="userEmail-info" class="info"></span></label>
                                <input required="" type="email" name="userEmail" id="userEmail">
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-mb-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>{{__('contact.subject')}} </label>
                                <input  type="text" name="subject" id="subject">
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-mb-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>{{__('contact.message')}}</label>
                                <textarea name="content" id="content"></textarea>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-mb-12 col-sm-12 col-xs-12">
                            <button  onClick="sendContact();" class="btn btn-bg text-white">{{__('contact.btn')}}</button>
                        </div>
                    </div>
                    <div class="mt-4" id="mail-status"></div>
                </div>
                <div class="col-xl-6 col-lg-6 col-mb-6 col-sm-12 col-xs-12">
                    <div class="b-title b-title_line_righ mt-5 mt-lg -0">
                        <h2 class="text-uppercase">{{__('contact.about-us')}}</h2>
                    </div>
                    <p>{{__('contact.about-us-first')}}</p>
                    <p>{{__('contact.about-us-second')}}</p>
                    <div class="b-title b-title_line_right">
                        <h2 class="text-uppercase">{{__('contact.contact-us')}}</h2>
                    </div>
                    <div class="b-block_four_info">
                        <div class="row clearfix">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="clearfix mb-5">
                                    <i class="icon-envelope icons pull-left mr-4 b-icon_large"></i>
                                    <p class="pull-left mb-0">
                                        {{__('contact.telephone')}} <br>
                                        {{__('contact.email-contact')}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="clearfix mb-5">
                                    <i class="icon-clock icons pull-left mr-4 b-icon_large"></i>
                                    <p class="pull-left mb-0">
                                        {{__('contact.address')}} <br>
                                         {{__('contact.country-address')}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="clearfix mb-5">
                                    <i class="icon-cursor icons pull-left mr-4 b-icon_large"></i>
                                    <p class="pull-left mb-0">
                                        {{__('contact.shipping-first')}}<br>
                                        {{__('contact.shipping-first')}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="clearfix mb-5">
                                    <i class="icon-rocket icons pull-left mr-4 b-icon_large"></i>
                                    <p class="pull-left mb-0">
                                        {{__('contact.support-first')}}<br>
                                        {{__('contact.support-second')}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="b-blog_social b-socail_color mt-0 pb-5">
                        <ul class="list-unstyled clearfix mb-0 pl-0 pr-0">
                            <li><a href="#" class="fa fa-facebook text-white"></a></li>
                            <li><a href="#" class="fa fa-twitter text-white"></a></li>
                            <li><a href="#" class="fa fa-google-plus text-white"></a></li>
                            <li><a href="#" class="fa fa-envelope text-white"></a></li>
                            <li><a href="#" class="fa fa-pinterest text-white"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
