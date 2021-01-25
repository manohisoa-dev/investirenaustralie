<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Cache-control" content="public">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{app_name()}} {{isset($title)?' - '.$title:''}}</title>
<meta name="description" content="{{option('site.meta_desc', 'IEA')}}">
<meta name="keywords" content="{{option('site.meta_keywords', 'IEA, Investir')}}">
    
<!-- Mombo -->
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <!-- plugin CSS -->
<link href="{{ asset('static/plugin/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('static/plugin/font-awesome/css/all.min.css') }}" rel="stylesheet">
<link href="{{ asset('static/plugin/et-line/style.css') }}" rel="stylesheet">
<link href="{{ asset('static/plugin/themify-icons/themify-icons.css') }}" rel="stylesheet">
<link href="{{ asset('static/plugin/owl-carousel/css/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('static/plugin/magnific/magnific-popup.css') }}" rel="stylesheet">
<!-- theme css -->
<link href="{{ asset('static/style/master.css') }}" rel="stylesheet">
<!-- Fin Mombo -->

@yield('style')
    
@yield('style-stripe')
</head>
<!-- Body Start -->

<body data-spy="scroll" data-target="#navbar-collapse-toggle" data-offset="98">
    <!-- Preload -->
    <div id="loading">
        <div class="load-circle"><span class="one"></span></div>
    </div>
    <!-- End Preload -->
    <!-- Header -->
    <header class="header-nav header-white">
        <div class="fixed-header-bar">
            <div class="container container-large">
                <div class="navbar navbar-default navbar-expand-lg main-navbar">
                    <div class="navbar-brand">
                        <a href="{{ route('v2.home') }}" title="Mombo" class="logo">
                            <img src="{{ asset('static/img/logo-light.svg') }}" class="light-logo" alt="Mombo" title="">
                            <img src="{{ asset('static/img/logo.svg') }}" class="dark-logo" alt="Mombo" title="">
                        </a>
                    </div>
                    <div class="navbar-collapse justify-content-end collapse" id="navbar-collapse-toggle">
                        <ul class="nav navbar-nav m-auto">
                            <li class="mm-in px-dropdown">
                                <a href="#home">@lang('app.immobilier')</a>
                                <i class="fa fa-angle-down px-nav-toggle"></i>
                                <ul class="px-dropdown-menu mm-dorp-in">
                                    <li><a href="{{route('v2.shop.index', \App\Models\Category::find(1))}}">@lang('app.residentiel')</a></li>
                                    <li><a href="{{route('v2.shop.index', \App\Models\Category::find(2))}}">@lang('app.foncier')</a></li>
                                </ul>
                            </li>
                            <li class="mm-in px-dropdown">
                                <a href="#home">@lang('app.business')</a>
                                <i class="fa fa-angle-down px-nav-toggle"></i>
                                <ul class="px-dropdown-menu mm-dorp-in">
                                    <li><a href="{{route('v2.shop.index', \App\Models\Category::find(3))}}">@lang('app.industrial')</a></li>
                                    <li><a href="{{route('v2.shop.index', \App\Models\Category::find(4))}}">@lang('app.commercial')</a></li>
                                </ul>
                            </li>
                            <li><a class="nav-link" href="{{route('v2.services')}}">@lang('app.services')</a></li>
                            <li><a class="nav-link" href="{{route('v2.blog.all')}}">@lang('app.blog')</a></li>
                            @if(Auth::check())
                            <li class="mm-in px-dropdown">
                                <a href="#home">@lang('app.account')</a>
                                <i class="fa fa-angle-down px-nav-toggle"></i>
                                <ul class="px-dropdown-menu mm-dorp-in">
                                    <li><a href="{{url(Auth::user()->role)}}">@lang('app.dashboard')</a></li>
                                    <li><a href="{{route('profile')}}">@lang('app.profile')</a></li>
                                    <li><a href="{{route('logout')}}">@lang('app.logout')</a></li>
                                </ul>
                            </li>   
                            
                            <!-- // add this dropdown // -->
                            <li class="mm-in px-dropdown">
                                <a id="notifications" aria-haspopup="true" aria-expanded="true">
                                    <span class="fa fa-user"></span>
                                    <span id="notificationsCount" class="badge badge-info hidden" hidden="true" style="margin-left:-5px; margin-top:-10px; background-color: red;">&nbsp;</span>
                                </a>
                                <i class="fa fa-angle-down px-nav-toggle"></i>
                                <ul class="px-dropdown-menu mm-dorp-in" aria-labelledby="notificationsMenu" id="notificationsMenu">
                                    <li>@lang('app.no_notification')</li>
                                </ul>
                            </li> 
                            @endif
                        </ul>
                    </div>
                    <div class="extra-menu d-flex align-items-center">
                        <div class="d-none d-md-block h-btn m-35px-l">
                            <form class="d-flex flex-row m-5px-b p-1 white-bg input-group" action="{{route('shop.index')}}" method="get">
                                <input type="email" class="form-control border-radius-0 border-0" placeholder="@lang('app.input.recherche')" name="q" value="{{isset($q)?$q:''}}">
                                <button class="m-btn m-btn-theme2nd flex-shrink-0" type="submit">@lang('app.input.recherche')</button>
                            </form>
                        </div>
                        <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#navbar-collapse-toggle" aria-expanded="false">
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->
    
    @yield('content')

    <!-- Footer-->
    <footer class="white-bg footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-12 m-15px-tb mr-auto">
                        <div class="m-20px-b">
                            <img src="static/img/logo.svg" title="" alt="">
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p>
                    </div>
                    <div class="col-lg-3 col-sm-6 m-15px-tb">
                        <h6>
                            Useful
                        </h6>
                        <ul class="list-unstyled links-dark footer-link-1">
                            <li>
                                <a href="#">Web Design</a>
                            </li>
                            <li>
                                <a href="#">Development</a>
                            </li>
                            <li>
                                <a href="#">Wordpress</a>
                            </li>
                            <li>
                                <a href="#">Online Marketing</a>
                            </li>
                            <li>
                                <a href="#">SEO Marketing</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-sm-6 m-15px-tb">
                        <h6>
                            About Us
                        </h6>
                        <ul class="list-unstyled links-dark footer-link-1">
                            <li>
                                <a href="#">Support Center</a>
                            </li>
                            <li>
                                <a href="#">Customer Support</a>
                            </li>
                            <li>
                                <a href="#">About Us</a>
                            </li>
                            <li>
                                <a href="#">Copyright</a>
                            </li>
                            <li>
                                <a href="#">Popular Campaign</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-sm-6 m-15px-tb">
                        <h6>
                            Information
                        </h6>
                        <address>
                            <p class="m-5px-b">301 The Greenhouse London,<br> E2 8DY UK</p>
                            <p class="m-5px-b"><a class="theme2nd-color border-bottom-1 border-color-theme2nd" href="mailto:support@domain.com">support@domain.com</a></p>
                            <p class="m-5px-b"><a class="theme2nd-color border-bottom-1 border-color-theme2nd" href="tel:820-885-3321">820-885-3321</a></p>
                        </address>
                        <div class="social-icon si-30 theme radius nav">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom footer-border-dark">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-right">
                        <ul class="nav justify-content-center justify-content-md-start m-5px-tb links-dark font-small footer-link-1">
                            <li><a href="#">Privace &amp; Policy</a></li>
                            <li><a href="#">Faq's</a></li>
                            <li><a href="#">Get a Quote</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 text-center text-md-right">
                        <p class="m-0px">© 2019 copyright all right reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer End -->
    <!-- jquery -->
    <script src="{{ asset('static/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('static/js/jquery-migrate-3.0.0.min.js') }}"></script>
    <!-- end jquery -->
    <!-- appear -->
    <script src="{{ asset('static/plugin/appear/jquery.appear.js') }}"></script>
    <!-- end appear -->
    <!--bootstrap-->
    <script src="{{ asset('static/plugin/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('static/plugin/bootstrap/js/bootstrap.js') }}"></script>
    <!--end bootstrap-->
    <!-- working form -->
    <script src="{{ asset('static/plugin/mail/js/form.min.js') }}"></script>
    <script src="{{ asset('static/plugin/mail/js/script.js') }}"></script>
    <!-- custom js -->
    <script src="{{ asset('static/js/custom.js') }}"></script>
    <!-- end -->
</body>
<!-- end body -->

</html>
