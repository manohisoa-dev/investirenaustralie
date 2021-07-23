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
<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="{{asset('images/favicon.png')}}">
<meta name="description" content="{{option('site.meta_desc', 'IEA')}}">
<meta name="keywords" content="{{option('site.meta_keywords', 'IEA, Investir')}}">

<!-- Mombo -->
{{-- <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"> --}}
    <!-- plugin CSS -->
<link href="{{ asset('plugin/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugin/font-awesome/css/all.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugin/et-line/style.css') }}" rel="stylesheet">
<link href="{{ asset('plugin/themify-icons/themify-icons.css') }}" rel="stylesheet">
<link href="{{ asset('plugin/owl-carousel/css/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugin/magnific/magnific-popup.css') }}" rel="stylesheet">
<!-- theme css -->
<link href="{{ asset('style/master.css') }}" rel="stylesheet">
<link href="{{ asset('style/app.css') }}" rel="stylesheet">
<link href="{{ asset('style/responsive.css') }}" rel="stylesheet">
<!-- Fin Mombo -->

<!-- dropzone -->
<link href="{{ asset('administrator/css/plugins/dropzone/basic.css') }}" rel="stylesheet">
<link href="{{ asset('administrator/css/plugins/dropzone/dropzone.css') }}" rel="stylesheet">

<!-- select2 -->
<link href="{{ asset('administrator/css/plugins/select2/select2.min.css') }}" rel="stylesheet">
<!-- Sweet Alert -->
<link href="{{ asset('administrator/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
<!-- step -->
<link href="{{ asset('administrator/css/plugins/steps/jquery.steps.css') }}" rel="stylesheet">

<style>
    .feedback {
        background-color : #AE4435;
        color: white;
        padding: 10px 20px;
        border-radius: none;
        border-color: #AE4435;
        width: 100px;
        opacity: 0.5;
        transition: 1s;
    }

    .feedback2 {
        background-color : #000;
        color: white;
        padding: 10px 20px;
        border-radius: none;
        border-color: #000;
        width: 175px;
        opacity: 1;
        transition: 1s;
    }

    .feedback:hover {
        background-color : #AE4435;
        color: white;
        padding: 10px 20px;
        border-radius: none;
        border-color: #AE4435;
        width: 175px;
        opacity: 1;
    }

    #mybutton {
        position: fixed;
        bottom: -4px;
        right: 10px;
        z-index: 999;
    }

    #btn_devise2 {
        position: relative;
        z-index: 3;
    }
    #form_devise {
        position: absolute;
        z-index: -999; /* .boite-doree sera au-dessus de .boite-verte et .boite-tirets */
        background:gray;
        margin-left: -175px;
        /* margin-top: -190px; */
        margin-top: 50px;
        opacity: 1;
        transition: 2s;
    }

    ::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: #F5F5F5;
    }

    ::-webkit-scrollbar
    {
        width: 12px;
        background-color: #F5F5F5;
    }

    ::-webkit-scrollbar-thumb
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #555;
    }
</style>

@yield('style')

@yield('style-stripe')
</head>
<!-- Body Start -->
@php $socialConfig = \App\Models\Config::social(); @endphp

<body data-spy="scroll" data-target="#navbar-collapse-toggle" data-offset="98">
    <!-- Preload -->
    <div id="loading">
        <div class="load-circle"><span class="one"></span></div>
        <input type="hidden" name="page_id" id="page_id" value="{{ isset($item)?$item->id:0 }}">
    </div>
    <!-- End Preload -->
    <!-- Header -->
    <header class="header-nav header-white">
        <div class="fixed-header-bar">
            <div class="header-top dark-bg">
                <div class="container">
                    <div class="row align-items-center p-10px-tb">
                        @if(App\Models\Config::site()->get_meta('admin_phone')->value != "")
                            <div class="col-md-5 ht-info" id="contact-top">
                                <ul class="nav justify-content-md-start justify-content-center links-white">
                                    @if(App\Models\Config::site()->get_meta('admin_phone')->value != "")
                                        <li class="small"><a href="#"><i class="fas fa-mobile-alt"></i> @lang('app.contact_us_phone', ['phone'=>option('site.admin_phone', App\Models\Config::site()->get_meta('admin_phone')?App\Models\Config::site()->get_meta('admin_phone'):'-')])</a></li>
                                    @endif
                                    @if(App\Models\Config::site()->get_meta('admin_email')->value != "")
                                        <li class="small m-10px-l"><a href="mailto:info@admin.com"><i class="fas fa-envelope"></i> {{ App\Models\Config::site()->get_meta('admin_email')?App\Models\Config::site()->get_meta('admin_email')->value:'-' }}</a></li>
                                    @endif
                                </ul>
                            </div>
                        @endif
                        @if(App\Models\Config::site()->get_meta('admin_phone')->value != "")
                            <div class="col-md-8 bloc-login-registration">
                        @else
                            <div class="col-md-12 bloc-login-registration">
                        @endif
                            <ul class="nav justify-content-end links-white dropdown-dark-header">
                                @if(!Auth::check())
                                <li class="text-white font-weight-bold m-10px-l"><i class="fas fa-mouse-pointer"></i> <a href="{{route('login')}}" class="text-white font-weight-bold ">@lang('app.connexion')</a>
                                </li>

                                <li class="text-white font-weight-bold m-40px-l bloc-registration"><i class="fas fa-sign-in-alt"></i> @lang('app.sinscrire') :
                                    <select id="currency-dropdown" onChange="location.href=''+this.options[this.selectedIndex].value;" class="white-bg-alt border-color-dark-gray border-radius-0 white-color">
                                        <option class="dark-color" value="#" selected="true" disabled="disabled">@lang('app.as')</option>
                                        <option class="dark-color" value="{{route('register', ['role'=>'member'])}}" @if(isset($role)) {{ trans('app.'.$role)==trans('app.member')?"selected":""  }}@endif>@lang('app.member')</option>
                                        <option class="dark-color" value="{{route('register', ['role'=>'seller'])}}" @if(isset($role)) {{ trans('app.'.$role)==trans('app.seller')?"selected":""  }}@endif>@lang('app.seller')</option>
                                        <option class="dark-color" value="{{route('register', ['role'=>'afa'])}}" @if(isset($role)) {{ trans('app.'.str_replace(' ','_',$role))==trans('app.afa')?"selected":""  }}@endif>@lang('app.afa')</option>
                                        <option class="dark-color" value="{{route('register', ['role'=>'apl'])}}" @if(isset($role)) {{ trans('app.'.str_replace(' ','_',$role))==trans('app.apl')?"selected":""  }}@endif>@lang('app.apl')</option>
                                    </select>
                                </li>
                                @else
                                    <li class="m-10px-l"><i class="fas fa-user"></i>
                                        <a href="{{ url(\App\Models\User::find(Auth::id())->roleUser->role_initial)}}">
                                            {{Auth::user()->name}}
                                        </a>
                                        {{ trans('app.txt.connected_role', ['connect'=>isset(Auth::user()->userinfos) && Auth::user()->userinfos->sexe?(Auth::user()->userinfos->sexe=='M'?trans('app.txt.connecte'):trans('app.txt.connectee')):trans('app.txt.connected'), 'role'=>trans('app.'.str_replace(' ', '',\App\Models\User::find(Auth::id())->roleUser->role_name))]) }}
                                    </li>
                                @endif
                                <li class="m-10px-l text-white font-weight-bold "><i class="fas fa-globe"></i> @lang('app.language') :
                                    <div class="dropdown pull-right">
                                      <a href="#" class="font-weight-bold dropdown-toggle" type="button" data-toggle="dropdown">
                                        @php $ico_fr= asset('images/ico/fr.png');$ico_en= asset('images/ico/en.png'); @endphp
                                          <label class="m-10px-l text-white font-weight-bold "> {!! app()->getLocale()=='fr' ? '<img src="'.$ico_fr.'">' : '<img src="'.$ico_en.'">' !!}</label></a>
                                          <ul class="dropdown-menu p-10px-l w-100" id="language-dropdown" >
                                            <li><a style="color:#555658;" href="{{route('localization', ['locale'=>'fr'])}}"><img src="{{ asset('images/ico/fr.png') }}"> Fr <span class="dark-color">(@lang('app.txt.fr'))</span></a></li>
                                            <li><a style="color:#555658;" href="{{route('localization', ['locale'=>'en'])}}"><img src="{{ asset('images/ico/en.png') }}"> En <span class="dark-color">(@lang('app.txt.en'))</span></a></li>
                                          </ul>
                                    </div>
                                </li>
                                <li class="m-10px-l text-white font-weight-bold ">
                                    @php $socialConfig = \App\Models\Config::social(); @endphp
                                    @foreach(\App\Models\Config::socialRules() as $key => $value)
                                        @if($metaConfig = $socialConfig->get_meta($key))
                                            <a href="{{$metaConfig->value}}" target="_blank"><i class="{{'fab fa-'.$key}}"></i></a>
                                        @endif
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div id="container-navbar" class="container container-large">
                <div class="navbar navbar-default navbar-expand-lg main-navbar">
                    <div class="navbar-brand">
                        <a href="{{ route('home') }}" title="{{ app_name() }}" class="logo">
                            <img src="{{asset('images/logo.png')}}" class="light-logo" alt="{{ app_name() }}" title="">
                            <img src="{{asset('images/logo.png')}}" class="dark-logo" alt="{{ app_name() }}" title="">
                        </a>
                    </div>
                    <div class="navbar-collapse justify-content-end collapse" id="navbar-collapse-toggle">
                        <ul class="nav navbar-nav m-auto">
                            <li class="mm-in px-dropdown">
                                <a href="{{route('programme.all')}}">@lang('app.immobilier')</a>
                                <i class="fa fa-angle-down px-nav-toggle"></i>
                                <ul class="px-dropdown-menu mm-dorp-in">
                                    {{-- \App\Models\Category::whereId(1)->first()->slug] --}}
                                    <li><a href="{{route('programme.all', \App\Models\Category::find(1))}}">@lang('app.residentiel')</a></li>
                                    <li><a href="{{route('programme.all', \App\Models\Category::find(2))}}">@lang('app.foncier')</a></li>
                                </ul>
                            </li>
                            <li class="mm-in px-dropdown">
                                <a href="{{route('programme.all')}}">@lang('app.business')</a>
                                <i class="fa fa-angle-down px-nav-toggle"></i>
                                <ul class="px-dropdown-menu mm-dorp-in">
                                    <li><a href="{{route('programme.all', \App\Models\Category::find(3))}}">@lang('app.industrial')</a></li>
                                    <li><a href="{{route('programme.all', \App\Models\Category::find(4))}}">@lang('app.commercial')</a></li>
                                </ul>
                            </li>
                            <li><a class="nav-link" href="{{route('services')}}">@lang('app.services')</a></li>
                            <li class="mm-in px-mega">
                                <a href="javascript:void(0)">@lang('app.apls')</a>
                                <i class="fa fa-angle-down px-nav-toggle"></i>
                                <div class="px-mega-menu mm-dorp-in">
                                    <div class="row no-gutters">
                                        <div class="col-lg-12">
                                            <div class="px-mm-right">
                                                <div class="row">
                                                    @if(getListAplGrpByCountry() !== null)
                                                        @forelse(getListAplGrpByCountry() as $apl)
                                                            @php
                                                                $countryContent = App\Models\Country::where('code',$apl->country)->first()->content;
                                                            @endphp
                                                            <div class="col-lg-4">
                                                                <h6 class="mm-title">{{ $countryContent }}</h6>
                                                                <ul class="mm-link">
                                                                    @foreach (getListAplGrpByCity($countryContent) as $item)
                                                                        <li class="theme2nd-color">{{ $item->locality }}</li>
                                                                        @foreach (getListApl($countryContent,$item->locality) as $apl)
                                                                            <li><a href="{{ route('show.apl', ['id'=>$apl->id]) }}" target="_blank">{{ $apl->name }}</a></li>
                                                                        @endforeach
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @empty
                                                            <span>@lang('app.txt.noinfo')</span>
                                                        @endforelse
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- row -->
                                </div>
                            </li>
                            <li><a class="nav-link" href="{{route('blog.all')}}">@lang('app.blog')</a></li>
                            @if(Auth::check())
                            <li class="mm-in px-dropdown">
                                <a href="#home">@lang('app.account')</a>
                                <i class="fa fa-angle-down px-nav-toggle"></i>
                                <ul class="px-dropdown-menu mm-dorp-in">
                                    <li><a href="{{url(\App\Models\User::find(Auth::id())->roleUser->role_initial)}}">@lang('app.dashboard')</a></li>
                                    <li><a href="@if(!Auth::user()->isAdmin() && !Auth::user()->isAdminBlog() && !Auth::user()->isAdminDelegate()) {{ route('profile') }} @else {{ Auth::user()->isAdmin() ? route('admin.profile') : route('admin.collaborator.admin.profile') }} @endif">@lang('app.profile')</a></li>
                                    <li><a href="{{route('logout')}}">@lang('app.logout')</a></li>
                                </ul>
                            </li>

                            <!-- // add this dropdown // -->
                            <li class="mm-in px-dropdown">
                                <a id="notifications" aria-haspopup="true" aria-expanded="true">
                                    <span class="fa fa-bell"></span>
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
                            <form class="d-flex flex-row m-5px-b p-1 white-bg input-group" action="{{route('programme.all')}}" method="get">
                                <input type="text" class="form-control border-radius-0 border-0" placeholder="@lang('app.input.recherche')" name="q" value="{{isset($q)?$q:''}}">
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
    
    @yield('content2')

    <div id="mybutton">
        <button id="btn_devise" class="feedback"><img src="{{ asset('images/ico/devise.png') }}" alt=""> </button>
        <button id="btn_devise2" class="feedback2" hidden>Fermer</button>
        <iframe id="form_devise" width="175" height="202" id="themoneyconverter-mini" src="https://themoneyconverter.com/MoneyConverter?from=EUR&amp;to=AUD" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" seamless="seamless" __idm_frm__="815"></iframe>
    </div>

    <footer class="grey-bg footer border-top-1 border-color-dark-gray">
        <div class="footer-top site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-sm-12 m-15px-tb mr-auto">
                        <div class="m-20px-b">
                            <a class="footer-logo" href="{{route('home')}}">
                                <img src="{{ asset('images/logos.png') }}" title="Logo IEA" alt="Logo IEA">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-5 m-15px-tb">
                        <h6 class="white-color">
                            {{ Illuminate\Support\Str::upper(trans('app.rapid_link')) }}
                        </h6>
                        <ul class="list-unstyled links-white footer-link-1">
                            <li><a href="{{route('home')}}">@lang('app.home')</a></li>
                            <li><a href="{{route('programme.all')}}">@lang('app.txt.our_programs')</a></li>
                            <li><a href="{{route('programme.all', \App\Models\Category::find(1))}}">@lang('app.txt.immobilier_residentiel')</a></li>
                            <li><a href="{{route('programme.all', \App\Models\Category::find(2))}}">@lang('app.txt.immobilier_foncier')</a></li>
                            <li><a href="{{route('programme.all', \App\Models\Category::find(3))}}">@lang('app.txt.business_industriel')</a></li>
                            <li><a href="{{route('programme.all', \App\Models\Category::find(4))}}">@lang('app.txt.business_commercial')</a></li>
                            <li><a href="{{route('services')}}">@lang('app.services')</a></li>
                            <li><a href="{{route('blog.all')}}">@lang('app.blog')</a></li>
                            <li><a href="{{route('contact')}}">@lang('app.contact')</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-sm-5 m-15px-tb">
                        <h6 class="white-color">
                            {{ Illuminate\Support\Str::upper(trans('app.txt.aboutus')) }}
                        </h6>
                        <ul class="list-unstyled links-white footer-link-1">
                            <li><a href="{{route('about')}}">@lang('app.about')</a></li>
                            <li><a href="{{route('terms')}}">@lang('app.terms')</a></li>
                            <li><a href="{{route('confidentialities')}}">@lang('app.confidential')</a></li>
                            <li><a href="{{route('help')}}">@lang('app.user_guide')</a></li>
                            <li><a href="{{route('publicities')}}">@lang('app.txt.agence_publicite')</a></li>
                            @if(Auth::check())
                                <li><a href="{{route('profile')}}">@lang('app.account')</a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-lg-3 col-sm-5 m-15px-tb">
                        <h6 class="white-color">
                            {{ Illuminate\Support\Str::upper(trans('app.txt.information')) }}
                        </h6>
                        <address>
                            <p class="white-color-light m-5px-b">{!! App\Models\Config::site()->get_meta('admin_address')?App\Models\Config::site()->get_meta('admin_address')->value:'-' !!}</p>
                            <p class="m-5px-b"><a class="theme2nd-color border-color-theme4nd" href="mailto:{{ App\Models\Config::site()->get_meta('admin_email')?App\Models\Config::site()->get_meta('admin_email')->value:'#' }}">{{ App\Models\Config::site()->get_meta('admin_email')?App\Models\Config::site()->get_meta('admin_email')->value:'-' }}</a></p>
                            <p class="m-5px-b"><a class="theme2nd-color border-color-theme4nd" href="tel:{{ App\Models\Config::site()->get_meta('admin_phone')?App\Models\Config::site()->get_meta('admin_phone')->value:'#' }}">{{ App\Models\Config::site()->get_meta('admin_phone')?App\Models\Config::site()->get_meta('admin_phone')->value:'-' }}</a></p>
                        </address>
                        <div class="social-icon si-30 theme2nd nav">
                            @foreach(\App\Models\Config::socialRules() as $key => $value)
                                @if($metaConfig = $socialConfig->get_meta($key))
                                <a href="{{$metaConfig->value}}" target="_blank"><i class="fab fa-{{$key}}"></i></a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom footer-border-light ">
            <div class="container">
                <div class="col-md-12 text-center" id="apl_list">
                    <ul class="nav justify-content-center justify-content-md-start p-25px-b links-white footer-link-1 font-color-theme4rd">
                        <li style="margin:auto;">
                            <a href="{{route('apls')}}" style="color:#01E367;font-size: 1.5rem;">@lang('app.apls')</a> :
                            @if(getListAplGrpByCountry() !== null)
                                @forelse(getListAplGrpByCountry() as $apl)
                                    @php
                                        $countryContent = App\Models\Country::where('code',$apl->country)->first()->content;
                                    @endphp
                                    <a class="country_apl_item" href="javascript:void(0)" value="{{ $apl->country }}" data-country="{{ $countryContent }}" data-toggle="tooltip" data-placement="top" data-html="true" title="<p class='text-center'> {{ trans('app.txt.click_to_show_city') }} {{ $countryContent }}</p>" style="color:#01E367;font-size: 1.5rem;">{{ $countryContent }}</a> @if(!$loop->last) - @endif
                                @empty
                                    <span style="color:#01E367;font-size: 1.2rem;">@lang('app.txt.noinfo')</span>
                                @endforelse
                            @endif
                        </li>
                        <li></li>
                    </ul>
                </div>
                <div class="footer-border-light m-auto col-lg-3"></div>
                <div class="container p-25px-t">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-right">
                            <ul class="nav justify-content-center justify-content-md-start m-5px-tb links-white footer-link-1">
                                <li><a href="#">@lang('app.footer_description')</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6 text-center text-md-right">
                            <p class="m-0px">{!!trans('app.copyright', ['year'=>date('Y'), 'app'=>trans('app.app_name')])!!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End footer -->

    <!-- modal -->
    <div class="container">
        <div class="modal left fade" id="listAplModal" tabindex="" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content dark-bg">
                    <div class="modal-header" style="background-color: #AE4435 !important;">
                    </div>
                    <div class="modal-body" style="background-color: #323232 !important;">
                        <div class="nav flex-sm-column flex-row">
                        </div>
                    </div>
                    <div class="modal-footer" style="background-color: #555658 !important;">
                        <button type="button" class="m-btn m-btn-theme2nd" data-dismiss="modal">@lang('app.txt.close')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin modal -->

    <!-- jquery -->
    <script src="{{ asset('js/jquery-3.0.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-3.0.0.min.js') }}"></script>
    <!-- end jquery -->
    <!-- appear -->
    <script src="{{ asset('plugin/appear/jquery.appear.js') }}"></script>
    <!-- end appear -->
    <!--bootstrap-->
    <script src="{{ asset('plugin/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('plugin/bootstrap/js/bootstrap.js') }}"></script>
    <!--end bootstrap-->
    <!-- working form -->
    <script src="{{ asset('plugin/mail/js/form.min.js') }}"></script>
    <script src="{{ asset('plugin/mail/js/script.js') }}"></script>
    <!-- custom js -->
    <script src="{{ asset('js/custom.js') }}"></script>
    <!-- end -->
    <!-- cookie js -->
    <script src="{{ asset('plugin/cookie/herbyCookie.min.js') }}"></script>
    <!-- end -->
    <!-- carousel js -->
    <script src="{{ asset('plugin/owl-carousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('plugin/counter/jquery.countTo.js') }}"></script>
    <!-- bootstrap-slider.js -->
    {{-- <script src="{{ asset('js/bootstrap-slider.js') }}"></script> --}}
    <!-- Bootstrap 3 slider -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.2/css/bootstrap-slider.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.2/bootstrap-slider.min.js"></script>
    {{-- Bootstrap popper --}}
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <!-- end -->

    {{-- Tooltip css style --}}
    <style>
        .tooltip-inner {
        max-width: 250px !important;
        width: 250px !important;
        height: auto !important;
        font-size: 12px;
        padding: 10px 15px 10px 20px;
        background: #01E056;
        color: #ffffff !important;
        border: none;
        border-radius: none;
        text-align: left;
        }

        .tooltip-inner a,p{
            color: #323232 !important;
            font-size: 16px !important;
        }

        .tooltip-inner a:hover{
            color: #000000 !important;
        }

        .tooltip.show {
        opacity: 1;
        }
    </style>

    {{-- Popup style --}}
    <style>
        a .show-apl-info{
            position:absolute;       
            margin-top:23px;
            margin-left:-35px;
            color:#ffffff;
            background:rgba(0,0,0,.9);
            padding:15px;
            border-radius:3px;
            box-shadow:0 0 2px rgba(0,0,0,.5); 
            transform:scale(0) rotate(-12deg);      
            transition:all .25s;
            opacity:0;
            font-size: 12px;
        }

        a:hover .show-apl-info, a:focus .show-apl-info{
            opacity:1;
            transform:scale(1) rotate(0);        
        }
    </style>

    <script type="text/javascript">
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        $('#apl_list').on('click','.country_apl_item',function(){
            var val = $(this).attr('value');
            var countryContent = $(this).attr('data-country');
            var uri = '{{ URL::to("getListAplGrpByCity") }}'+'/'+val;
            var envoi = $.get( uri );
            
            // Reinitalize data in tooltip
            $('.tooltip-inner').html('');
            $('.tooltip-inner').append('<p class="text-center border-bottom-1 border-gray">{{ trans("app.txt.apl_city") }} '+countryContent+'</p>');
            $('.tooltip-inner').append('<div id="city_list"><div class="load-circle"><span class="one"></span></div></div>');
            
            envoi.done( function(data) {
                $('.tooltip-inner #city_list').html('');
                $.each(data.res,function(key,value){
                    ctry=(value.country).replaceAll(' ','_');
                    loc=(value.locality).replaceAll(' ','_');
                    $('.tooltip-inner #city_list').append('<p><a href="javascript:void(0)" onclick=getApl("'+ctry+'","'+loc+'") class="apl_item"><i class="fa fa-building"></i> '+value.locality+'</a></p>');
                });
            });
        });

        function getApl(ctry,loc){
            var uri = '{{ URL::to("getApl") }}'+'/'+ctry+'/'+loc;
            var envoi = $.get( uri );

            // show list apl modal
            $('#listAplModal').modal('show');

            $.ajaxSetup({
                headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                }
            });

            // set apl title
            $('#listAplModal .modal-header').html('<h4 class="white-color">'+loc.replaceAll('_',' ')+'</h4>');

            // initialize apl items
            $('#listAplModal .modal-body').html('<div class="load-circle"><span class="one"></span></div>');

            envoi.done( function(data) {
                // set apl items
                $('#listAplModal .modal-body').html("<h6 class='white-color'>@lang('app.txt.aplfound') : "+data.res.length+"</h6>");

                $.each(data.res,function(key,value){
                    var id= value.id;
                    var uri = '{{ URL::to("get/show/apl") }}'+'/'+id;
                    var envoi = $.get( uri );
                    var nl = "{{ trans('app.txt.noinfo') }}";
                    var aplInfo ="";
                    var apl_phone = data.infos[key]?data.infos[key]['orga_phone']:nl;
                    var apl_email = data.infos[key]?data.infos[key]['orga_email']:nl;
                    var apl_website = data.infos[key]?data.infos[key]['orga_website']:nl;

                    aplInfo = '<i class="fa fa-phone"></i> Phone : '+apl_phone+'<br/><i class="fa fa-envelope"></i> Email : '+apl_email+'<br/><i class="fa fa-globe"></i> Site internet : '+apl_website;
                    envoi.done( function(url) {
                        $('#listAplModal .modal-body').append('<a href="'+url.res+'" target="_blank" class="nav-item nav-link white-color tip-top"><i class="fa fa-map-marker"></i> '+value.name+'<span class="show-apl-info">'+aplInfo+'</span></a>');
                    });

                });
            });
        }

        $('#btn_devise').click(function(){
            $('#form_devise').show();
            $('#form_devise').css({'opacity': 1, 'margin-top':'-185px'});
            $(this).attr('hidden','true');
            $('#btn_devise2').removeAttr('hidden');
        });

        $('#btn_devise2').click(function(){
            $('#form_devise').css({'opacity': 0, 'margin-top':'50px'});
            setTimeout(function(){
                $("#form_devise").hide(25, "linear", function(){
                    $('#btn_devise').removeAttr('hidden');
                });
            },1000);
            $(this).attr('hidden','true');
        });
    </script>

    <script type="text/javascript">
        $(window).bind('mousewheel', function(event) {
        if (event.originalEvent.wheelDelta >= 0) {
            if ($(document).scrollTop() <= 100) {
                // $('#container-navbar').removeClass('show-navbar-after');
                $('#container-navbar').removeClass('show-navbar-after');
                $('#container-navbar').addClass('show-navbar-after-top');    
            }else{
                $('#container-navbar').removeClass('show-navbar-after-top');    
                $('#container-navbar').addClass('show-navbar-after');
            }
            $('#container-navbar').removeClass('show-navbar-hover-after');
            // $('#container-navbar').addClass('show-navbar-after');
        }
        else {
            $('#container-navbar').addClass('show-navbar-hover-after');   
        }
        });
  </script>

  <style>
    .header-white.fixed-header .fixed-header-bar{
        background: none;
        box-shadow: 0px 0px 0px 0px rgb(38 59 94 / 10%);
        transform: perspective(400px) rotateY(0deg) scale(1) ;
        /* transition:all .1s ease-out; */
    }

    .show-navbar-after-top{
      background: none;
      position: absolute;
      opacity: 1;
      transform: perspective(400px) rotateY(0deg) scale(1) ;
      transition:all .4s ease-out;
    }

    .show-navbar-after{
      background: white;
      position: absolute;
      opacity: 1;
      box-shadow: 0px 10px 10px 0px rgb(38 59 94 / 15%);
      transform: perspective(400px) rotateY(0deg) scale(1) ;
      transition:all .6s ease-out;
    }

    .show-navbar-hover-after {
      /* top:0; */
      background: white;
      opacity:.5;
      box-shadow: 0px 3px 10px 0px rgb(38 59 94 / 15%);
      transform: perspective(400px) rotateX(-90deg);
      transform-origin: 50% 0%;
      transition:all .6s ease-out;
    }
  </style>



    @stack('script')
    <!-- end -->

</body>
<!-- end body -->

</html>
