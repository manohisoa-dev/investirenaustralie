<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Cache-control" content="public">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{app_name()}} {{isset($title)&&$title!='title_fr'&&$title!='title_en'?' - '.$title:''}}</title>
<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="{{asset('images/favicon.png')}}">
<meta name="description" content="{{option('site.meta_desc', 'IEA')}}">
<meta name="keywords" content="{{option('site.meta_keywords', 'IEA, Investir')}}">

@php
    $mytime = Carbon\Carbon::now();
    $mytime->toDateTimeString()
@endphp

<!-- Mombo -->
<!-- plugin CSS -->
<!-- Animate fade animation -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<!-- ANIMATE AOS -->
<!-- plugin CSS -->
<link href="{{ asset('plugin/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugin/font-awesome/css/all.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugin/et-line/style.css') }}" rel="stylesheet">
<link href="{{ asset('plugin/themify-icons/themify-icons.css') }}" rel="stylesheet">
<link href="{{ asset('plugin/owl-carousel/css/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugin/magnific/magnific-popup.css') }}" rel="stylesheet">
<!-- theme css -->
<link href="{{ asset('style/master.css?v='.$mytime) }}" rel="stylesheet">
<link href="{{ asset('style/app.css?v='.$mytime) }}" rel="stylesheet">
<link href="{{ asset('style/responsive.css?v='.$mytime) }}" rel="stylesheet">
<link href="{{ asset('style/refonte.css?v='.$mytime) }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/fontawesome.min.css">
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
<!-- jquery UI -->
<link href="{{ asset('administrator/css/plugins/jQueryUI/jquery-ui.css') }}" rel="stylesheet">

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
    <noscript>
        <h2>Javascript est désactivé dans votre navigateur web. Certaines fonctionnalités ne fonctionneront pas correctement.</h2>
    </noscript>
    <!-- Preload -->
    <div id="loading" style="display:none;">
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
                                <li class="text-white font-weight-bold m-10px-l" id="btn-connexion">
                                    <i class="fas fa-mouse-pointer"></i> <a href="{{route('login')}}" class="text-white font-weight-bold ">@lang('app.connexion')</a>
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
                                <li class="m-10px-l text-white font-weight-bold "><i class="fas fa-globe"></i> @lang('app.language') :</li>
                                <li class="m-10px-l text-white font-weight-bold ">
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
                                <a href="javascript:void(0)" title="@lang('app.apls')">@lang('app.txt.apl')</a>
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
                                                            <div class="text-center p-15px-tb">@lang('app.txt.noinfo')</div>
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
                                        <li><a href="{{route('logout')}}" id="btnLogout">@lang('app.logout')</a></li>
                                    </ul>
                                </li>

                                <!-- // add this dropdown // -->
                                @if(!Auth::user()->isAdmin())
                                    <li class="mm-in px-dropdown">
                                        {{-- <a id="notifications" aria-haspopup="true" aria-expanded="true">
                                            <span class="fa fa-bell"></span>
                                            <small id="notificationsCount" class="badge badge-danger">1</small>
                                        </a>
                                        <i class="fa fa-angle-down px-nav-toggle"></i>
                                        <ul class="px-dropdown-menu mm-dorp-in" aria-labelledby="notificationsMenu" id="notificationsMenu">
                                            <li>@lang('app.no_notification')</li>
                                        </ul> --}}
                                        <!-- ICON -->
                                        <div class="dropdown nav-button notifications-button hidden-sm-down m-20px-t">

                                            <a class="btn btn-secondary dropdown-toggle" href="#" id="notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i id="notificationsIcon" class="fa fa-bell" aria-hidden="true"></i>
                                            <span id="notificationsBadge" class="badge badge-danger"><i class="fa fa-spinner fa-pulse fa-fw" aria-hidden="true"></i></span>
                                            </a>

                                            <!-- NOTIFICATIONS -->
                                            <div class="dropdown-menu notification-dropdown-menu" aria-labelledby="notifications-dropdown">
                                            <h6 class="dropdown-header">@lang('app.notifications')</h6>

                                            <!-- CHARGEMENT -->
                                            <a id="notificationsLoader" class="dropdown-item dropdown-notification" href="#">
                                                <p class="notification-solo text-center"><i id="notificationsIcon" class="fa fa-spinner fa-pulse fa-fw" aria-hidden="true"></i>@lang('app.txt.loading_the_latest_notifications')</p>
                                            </a>

                                            <div id="notificationsContainer" class="notifications-container"></div>

                                            <!-- AUCUNE NOTIFICATION -->
                                            <a id="notificationAucune" class="dropdown-item dropdown-notification" href="#">
                                                <p class="notification-solo text-center">@lang('app.no_notification')</p>
                                            </a>

                                            <!-- TOUTES -->
                                            <span class="dropdown-item dropdown-notification-all"></span>

                                            </div>

                                        </div>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </div>
                    <div class="extra-menu d-flex align-items-center">
                        <div class="d-none d-md-block h-btn m-35px-l">
                            <form class="d-flex flex-row m-5px-b p-1 searchform input-group" action="{{route('programme.all')}}" method="get">
                                <input type="text" class="form-control border-radius-left" placeholder="@lang('app.input.recherche')" name="q" value="{{isset($q)?$q:''}}">
                                <button class="m-btn m-btn-theme2nd flex-shrink-0" type="submit"><i class="fa fa-search"></i></button>
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

    <footer class="grey-bg-footer footer border-top-1 border-color-dark-gray">
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
						<div style="margin-top:10px">
							<p style="color:#fff !important">{{trans('app.txt.inscrirenews')}}</p>
							<form class="d-flex flex-row m-5px-b p-1 white-bg input-group" id="form_newsletter" method="post" style="border-radius: 15px;">
								{{ csrf_field() }}
								<input type="email" name="email_adresse" id="email_adresse" class="form-control border-radius-0 border-0" placeholder="{{trans('app.txt.your.email')}}" required>
								<input type="hidden" name="statuts" id="statuts" value="Actif">
								<button class="m-btn m-btn-theme2nd flex-shrink-0" type="submit">OK</button>
							</form>
						</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer waves -->
        <div class="#">
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(43,43,43,0.7)" />
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(43,43,43,0.5)" />
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(43,43,43,0.2)" />
                    <use xlink:href="#gentle-wave" x="48" y="7" fill="rgb(43,43,43,0.1)" />
                </g>
            </svg>
        </div>
        <!-- End Footer waves -->

        <div class="footer-bottom footer-border-light ">
            <div class="container">
                <div class="col-md-12 text-center" id="apl_list">
                    <ul class="nav justify-content-center justify-content-md-start p-25px-b links-white footer-link-1 font-color-theme4rd">
                        <li style="margin:auto;">
                            <a href="{{route('apls')}}" style="color:#ae4435;font-size: 1.5rem;">@lang('app.apls')</a> :
                            @if(getListAplGrpByCountry() !== null)
                                @forelse(getListAplGrpByCountry() as $apl)
                                    @php
                                        $countryContent = App\Models\Country::where('code',$apl->country)->first()->content;
                                    @endphp
                                    <a class="country_apl_item" href="javascript:void(0)" value="{{ $apl->country }}" data-country="{{ $countryContent }}" data-toggle="tooltip" data-placement="top" data-html="true" title="<p class='text-center'> {{ trans('app.txt.click_to_show_city') }} {{ $countryContent }}</p>" style="color:#ae4435;font-size: 1.5rem;">{{ $countryContent }}</a> @if(!$loop->last) - @endif
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
                            <p class="m-0px text-white">{!!trans('app.copyright', ['year'=>date('Y'), 'app'=>trans('app.app_name')])!!}</p>
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

    <!-- Modal of member has dossier transaction -->
    @if(Auth::check() && Auth::user()->hasRole(5))
        <div id="memberHasDossierTransactionModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content white-bg">
                    <div class="modal-header border-radius-0" style="background-color: #AE4435 !important;">
                        <h4 class="modal-title white-color text-center">{{ strtoupper(trans('member.message.transaction.title')) }} </h4>
                    </div>
                    <div class="modal-body">
                    {!! trans('member.message.transaction.content', ['name'=> Auth::user()->isPerson()?(Auth::user()->userinfos()->first()?Auth::user()->userinfos()->first()->last_name.' '.Auth::user()->userinfos()->first()->first_name:''):(Auth::user()->userinfos()->first()?Auth::user()->userinfos()->first()->orga_name:''), 'url'=>url(Auth::user()->roleUser->role_initial), 'id'=>'btnDashboard' ]) !!}
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="m-btn m-btn-theme2nd" href="javascript:void(0)" data-dismiss="modal" id="btnOkNotifTrans">@lang('app.btn.ok')</a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Alert success Modal --}}
    @if (session()->get('alert_success'))
        <div id="alertSuccessModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content white-bg">
                    <div class="modal-header border-radius-0" style="background-color: #AE4435 !important;">
                        <h4 class="modal-title white-color text-center">{{ strtoupper(trans('app.message')) }} </h4>
                    </div>
                    <div class="modal-body">
                        {!! session()->get('alert_success') !!}
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="m-btn m-btn-theme2nd" href="javascript:void(0)" data-dismiss="modal" id="btnOkNotifTrans">@lang('app.btn.ok')</a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Alert message Modal --}}
    @if (session()->get('alert_message'))
        <div id="alertMessageModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content white-bg">
                    <div class="modal-header border-radius-0" style="background-color: #AE4435 !important;">
                        <h4 class="modal-title white-color text-center">{{ strtoupper(trans('app.message')) }} </h4>
                        <button type="button" class="close" data-dismiss="modal" onClick="closeModal()" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! session()->get('alert_message') !!}
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="m-btn m-btn-theme2nd" href="javascript:void(0)" data-dismiss="modal">@lang('app.btn.ok')</a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Upload contract Modal --}}
    @if(Request::get("action") === 'submit_contract')
        <div id="submitContractModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content white-bg">
                    <div class="modal-header border-radius-0" style="background-color: #AE4435 !important;">
                        <h4 class="modal-title white-color text-center">{{ strtoupper(trans('app.txt.submit_contract_signed')) }} </h4>
                        <button type="button" class="close" data-dismiss="modal" onClick="closeModal()" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    @php
                        // $user = App\Models\User::whereId(Request::get('id'))->first();
                        // var_dump($user->contract());
                    @endphp

                    <div class="modal-body"> 
                        <form action="" id="formSendContract" method="get" enctype="multipart/form-data">
                            <div class="form-group ">
                                <input type="hidden" name="_token" id="csrf_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="user_id" id="user_id" value="{{ Request::get('id')?Request::get('id'):'' }}">
                                <label for="">@lang('app.txt.please_choose_your_signed_contract',['filename'=>trans('app.txt.contract')]) *</label>
                                <input type="file" name="file_contract" id="file_contract">
                            </div>
                            <hr/>
                            <div class="input-group">
                                <a type="button" class="m-btn m-btn-theme m-10px-r" href="javascript:void(0)" data-dismiss="modal" id="btn_cancel_contract">@lang('app.btn.cancel')</a>
                                <button type="submit" class="m-btn m-btn-theme2nd" id="btn_send_contract">@lang('app.btn.send')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal of afa has dossier transaction initial deposit -->
    @if(Auth::check() && Auth::user()->hasRole(3) && Auth::user()->hasDossierTransactionInitialDeposit())
        <div id="afaHasDossierTransactionInitialDepositModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content white-bg">
                    <div class="modal-header border-radius-0" style="background-color: #AE4435 !important;">
                        <h4 class="modal-title white-color text-center">{{ strtoupper(trans('afa.message.transaction.initial.deposit.title')) }} </h4>
                    </div>
                    <div class="modal-body">
                        {!! trans('afa.message.transaction.initial.deposit.content',['name'=> Auth::user()->name, 'url'=>route('afa.transaction'), 'id'=>'btnProcedureAchat', 'label'=>trans('app.txt.procedure_achat')]) !!}
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="m-btn m-btn-theme2nd" href="javascript:void(0)" data-dismiss="modal" id="btnOkNotifTransInitDeposit">@lang('app.btn.ok')</a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- jquery -->
    <script src="{{ asset('js/jquery-3.0.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-3.0.0.min.js') }}"></script>
	<!-- jQuery UI -->
	<script src="{{ asset('administrator/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
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
    <script src="{{ asset('js/custom.js?v='.$mytime) }}"></script>
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
	<script src="{{ asset('administrator/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
    {{-- dateformat script --}}
    <script src="{{ asset('/js/jquery-dateFormat.min.js') }}"></script>
    <!-- Jquery Validate -->
    <script src="{{ asset('administrator/js/plugins/validate/jquery.validate.min.js') }}"></script>
    <script>
        $.validator.addMethod('regex', function (value, element) {
            // 8 caractères min : 1 letter maj, 1 letter min, 1 number 1 car spéciaux
            return this.optional(element) || value.match(/^[^+]+\.pdf$/);
        }, '@lang("app.txt.regex_pdf")');

        $('#formSendContract').validate({
            ignore: [],
            rules: {
                file_contract: {
                    required: true,
                    regex: true,
                },
            },
            messages: {
                file_contract: {
                    required: "@lang('app.txt.champobligatoire')",
                },
            },
            errorPlacement: function ( error, element ) {
                if(element.parent().hasClass('input-group')){
                    error.insertBefore( element.parent() );
                }else{
                    error.insertAfter( element );
                }
            },
        });

        $('#formSendContract').submit(function(e) { 
            if ($('#formSendContract').valid()) {
                e.preventDefault();
                var fileToUpload = new FormData();
                
                // Show loading icon
                loadingPage();
                
                fileToUpload.append('_token', $( '#csrf_token' ).val() );
                fileToUpload.append('user_id', $( '#user_id' ).val() );
                fileToUpload.append('file_contract', $( '#file_contract' )[0].files[0] );                
                $.ajax({
                    url: "{{route('confirm.registration.send.contract')}}",
                    type:"POST",
                    data: fileToUpload,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    dataType:'json',
                    enctype: 'multipart/form-data',
                    success: function( data ){
                        // hide loading icon
                        stopLoadingPage();

                        if(data.response == 'true'){
                            //  show loading icon
                            loadingPage();

                            swal({
                                title: "{{ trans('app.txt.submit_contract_signed') }}", 
                                text: "{{ trans('app.txt.file_sent') }}", 
                                type: "success"
                                },
                                function(){ 
                                    // hide modal
                                    $('#submitContractModal').modal('hide');
                                    
                                    // go to home page
                                    window.location.href= "{{route('home')}}";
                                }
                            );
                        }else{
                            if(data.status == 2){
                                swal({
                                    title: "{{ trans('app.txt.submit_contract_signed') }}", 
                                    text: "{{ trans('app.txt.contract_validated') }}", 
                                    type: "info"
                                    },
                                    function(){ 
                                        // go to home page
                                        window.location.href= "{{route('home')}}";
                                    }
                                );
                            }
                            else if(data.status == 1){
                                swal({
                                    title: "{{ trans('app.txt.submit_contract_signed') }}", 
                                    text: "{{ trans('app.txt.contract_awaiting_validation') }}", 
                                    type: "info"
                                    },
                                    function(){ 
                                        // go to home page
                                        window.location.href= "{{route('home')}}";
                                    }
                                );
                            }
                            else{
                                swal("{{ trans('app.txt.submit_contract_signed') }}", "{{ trans('app.txt.upload_error') }}", "error");
                            }
                        }
                    },
                    error:function(){
                        // hide loading icon
                        stopLoadingPage();
                        swal("{{ trans('app.txt.submit_contract_signed') }}", "{{ trans('app.txt.upload_error') }}", "error");
                    }
                });


            } else {
                stopLoadingPage();
            }
        });
    </script>
    <style>
        .error {
            color: #F00;
            background-color: #FFF;
        }
    </style>
    <!-- End Jquery Validate -->
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

            // Show notification current transaction member
            if('{{ !Request::is("product/*") }}'){
                if('{{ Auth::check() && Auth::user()->hasCurrentTransaction() }}' && !sessionStorage.getItem('notif_trans_member')){
                    $('#memberHasDossierTransactionModal').modal('show');
                }
            }
            
            // Show notification current transaction initial deposit afa
            if('{{ Request::is("afa") }}'){
                if('{{ Auth::check() && Auth::user()->hasRole(3) && Auth::user()->hasDossierTransactionInitialDeposit() }}' && !sessionStorage.getItem('notif_trans_afa')){
                    $('#afaHasDossierTransactionInitialDepositModal').modal('show');
                }
            }

            // Show notification message if exist
            if('{{ session()->get("alert_message") }}'){
                $('#alertMessageModal').modal('show');
            }

            // Show upload registration contract modal
            if('{{ Request::get("action") }}' === 'submit_contract'){
                $('#submitContractModal').modal('show');
            }
        });

        $('#btn_cancel_contract').click(function(){
            swal({
                title: "@lang('app.txt.submit_contract_signed')",
                text: "@lang('app.txt.operation_canceled')",
                type: "error",
                confirmButtonColor: '#D0D0D0',
                confirmButtonText: "@lang('app.btn.close')",
                showCancelButton: false,
                showConfirmButton: true,
            },
            function(){
                window.location.href="{{ route('home') }}";
            });
        })

        $('#btnOkNotifTrans').click(function(){
            // 1: notificaiton seen
            return sessionStorage.setItem('notif_trans_member', 1);
        });
        
        $('#btnOkNotifTransInitDeposit').click(function(){
            // 1: notificaiton seen
            return sessionStorage.setItem('notif_trans_afa', 1);
        });

        $('#btnDashboard').click(function(){
            // 1: notificaiton seen
            return sessionStorage.setItem('notif_trans_member', 1);
        })
        
        $('#btnLogout').click(function(){
            // clear all session js
            return sessionStorage.clear();
        })

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

        function loadingPage(){
            $('#loading').css('background','rgba(174,68,53, 0.5)');
            $('#loading').show();
        }

        function stopLoadingPage(){
            $('#loading').css('background','rgba(174,68,53, 0.5)');
            $('#loading').hide();
        }
    </script>

    <script type="text/javascript">
        $(window).bind('wheel', function(event) {
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
            if(!$(".notification-dropdown-menu").is(":visible")){
                $('#container-navbar').addClass('show-navbar-hover-after');  
            }
        }
        });
		
		$('#form_newsletter').on('submit',function(e){
        	e.preventDefault();
			let email_adresse = $('#email_adresse').val();
			let statuts = $('#statuts').val();
			$.ajax({
				url: "{{route('newsletter.store')}}",
				type:"POST",
				data:{
					"_token": "{{ csrf_token() }}",
					email_adresse:email_adresse,
					statuts:statuts
				},
				success:function(data){
					if(data.reponse == 'OK'){
						swal({
							   title: "@lang('app.alert.inscriptionnewsletter.titre')", 
							   text: "@lang('app.alert.inscriptionnewsletter.success')", 
							   type: "success"
							 },
						   function(){ 
							   location.reload();
						   }
						);
					}else{
						swal("@lang('app.alert.sendnewsletter.titre')", data.reponse, "error");
					}
				}
			});
		});
  </script>

  <style>
    .header-white.fixed-header .fixed-header-bar{
        max-width: 3500px !important;
        background: none;
        -webkit-box-shadow: 0px 0px 0px 0px rgb(38 59 94 / 10%);
        -moz-box-shadow: 0px 0px 0px 0px rgb(38 59 94 / 10%);
        -o-box-shadow: 0px 0px 0px 0px rgb(38 59 94 / 10%);
        box-shadow: 0px 0px 0px 0px rgb(38 59 94 / 10%);
        -webkit-transform: perspective(400px) rotateY(0deg) scale(1) ;
        -moz-transform: perspective(400px) rotateY(0deg) scale(1) ;
        -o-transform: perspective(400px) rotateY(0deg) scale(1) ;
        transform: perspective(400px) rotateY(0deg) scale(1) ;
        /* transition:all .1s ease-out; */
    }

    .show-navbar-after-top{
      max-width: 3500px !important;;
      -webkit-background: none;
      -moz-background: none;
      -o-background: none;
      background: none;
      -webkit-position: absolute;
      -moz-position: absolute;
      -o-position: absolute;
      position: absolute;
      -webkit-opacity: 1;
      -moz-opacity: 1;
      -o-opacity: 1;
      opacity: 1;
      -webkit-transform: perspective(400px) rotateY(0deg) scale(1) ;
      -moz-transform: perspective(400px) rotateY(0deg) scale(1) ;
      -o-transform: perspective(400px) rotateY(0deg) scale(1) ;
      transform: perspective(400px) rotateY(0deg) scale(1) ;
      -webkit-transition:all .4s ease-out;
      -moz-transition:all .4s ease-out;
      -o-transition:all .4s ease-out;
      transition:all .4s ease-out;
    }

    .show-navbar-after{
        max-width: 3500px !important;
      -webkit-background: white;
      -moz-background: white;
      -o-background: white;
      background: white;
      -webkit-position: absolute;
      -moz-position: absolute;
      -o-position: absolute;
      position: absolute;
      -webkit-opacity: 1;
      -moz-opacity: 1;
      -o-opacity: 1;
      opacity: 1;
      -webkit-box-shadow: 0px 10px 10px 0px rgb(38 59 94 / 15%);
      -moz-box-shadow: 0px 10px 10px 0px rgb(38 59 94 / 15%);
      -o-box-shadow: 0px 10px 10px 0px rgb(38 59 94 / 15%);
      box-shadow: 0px 10px 10px 0px rgb(38 59 94 / 15%);
      -webkit-transform: perspective(400px) rotateY(0deg) scale(1) ;
      -moz-transform: perspective(400px) rotateY(0deg) scale(1) ;
      -o-transform: perspective(400px) rotateY(0deg) scale(1) ;
      transform: perspective(400px) rotateY(0deg) scale(1) ;
      -webkit-transition:all .6s ease-out;
      -moz-transition:all .6s ease-out;
      -o-transition:all .6s ease-out;
      transition:all .6s ease-out;
    }

    .show-navbar-hover-after {
      /* top:0; */
      max-width: 3500px !important;
      -webkit-background: white;
      -moz-background: white;
      -o-background: white;
      background: white;
      -webkit-opacity:.5;
      -moz-opacity:.5;
      -o-opacity:.5;
      opacity:.5;
      -webkit-box-shadow: 0px 3px 10px 0px rgb(38 59 94 / 15%);
      -moz-box-shadow: 0px 3px 10px 0px rgb(38 59 94 / 15%);
      -o-box-shadow: 0px 3px 10px 0px rgb(38 59 94 / 15%);
      box-shadow: 0px 3px 10px 0px rgb(38 59 94 / 15%);
      -webkit-transform: perspective(400px) rotateX(-90deg);
      -moz-transform: perspective(400px) rotateX(-90deg);
      -o-transform: perspective(400px) rotateX(-90deg);
      transform: perspective(400px) rotateX(-90deg);
      -webkit-transform-origin: perspective(400px) rotateX(-90deg);
      -moz-transform-origin: perspective(400px) rotateX(-90deg);
      -o-transform-origin: perspective(400px) rotateX(-90deg);
      transform-origin: 50% 0%;
      -webkit-transition:all .6s ease-out;
      -moz-transition:all .6s ease-out;
      -o-transition:all .6s ease-out;
      transition:all .6s ease-out;
    }
  </style>
  
    @stack('script')


    <!-- TEMPLATE NOTIFICATION -->
    <link href="{{ asset('style/nav-notification.css') }}" rel="stylesheet">
    <script id="notificationTemplate" type="text/html">
        <!-- NOTIFICATION -->
        <a class="dropdown-item dropdown-notification" href="[[href]]">
        <div class="notification-read">
            <i class="fa fa-times" aria-hidden="true"></i>
        </div>
        <img class="notification-img" src="{{ asset('images/ico/comment-alt.png') }}" alt="Icone Notification" />
        <div class="notifications-body">
            <p class="notification-texte">[[title]]</p>
            <small class="notification-texte">[[texte]]</small>
            <p class="notification-date text-muted">
            <i class="fa fa-clock" aria-hidden="true"></i> [[date]]
            </p>
        </div>
        </a>
    </script>

    <script>
        $(function () {

            var count = 0;
            var lastCount = 0;
            var notifications = new Array();

            showUnreadCount();

            function showUnreadCount(){
                if('{{ Auth::check() }}' !== ''){
                    $.ajax({
                        url: '{{  Auth::check()?route("get.unread.message.notification", ["user_id"=>Auth::user()->id]):"" }}',
                        type: "GET",
                        dataType: "json",
                        success:function(data){
                            var datas = data.res;
                            var datasLength = datas.length;
                            var origin   = window.location.origin;

                            if(datasLength !== 0){
                                // set count notification
                                count = datasLength;

                                // set count notification content
                                for(i=0;i<datasLength;i++){
                                    var body = ($(datas[i].body).text());
                                    var dt = datas[i].created_at;
                                    var userRole = '{{Auth::check()?Auth::user()->roleUser->role_initial:""}}';
                                    var url = userRole!=='afa'?(origin+'/'+userRole+"/contact/role/"+datas[i].role_initial):(origin+'/'+userRole+"/message/afa/show");
                                    
                                    // push data in notifications array
                                    notifications.push({
                                    href: url,
                                    title: (datas[i].role_initial).toUpperCase(),
                                    texte: body.substring(0,70)+'...',
                                    date: dt
                                    });
                                }
                            }
                        },
                        error:function(e){
                            console.log(e);
                        }
                    });
                }

                return false;
            }            

            function makeBadge(texte) {
            return "<span class=\"badge badge-default\">" + texte + "</span>";
            }

            appNotifications = {

            // Initialisation
            init: function () {
                // On masque les éléments
                $("#notificationsBadge").hide();
                $("#notificationAucune").hide();

                // On bind le clic sur les notifications
                $("#notifications-dropdown").on('click', function () {

                var open = $("#notifications-dropdown").attr("aria-expanded");

                // Vérification si le menu est ouvert au moment du clic
                if (open === "false") {
                    appNotifications.loadAll();
                }

                });

                // On charge les notifications
                appNotifications.loadAll();

                // Polling
                // Toutes les 3 minutes on vérifie si il n'y a pas de nouvelles notifications
                setInterval(function () {
                showUnreadCount();
                appNotifications.loadNumber();
                }, 180000);

                // Binding de marquage comme lue desktop
                $('.notification-read-desktop').on('click', function (event) {
                appNotifications.markAsReadDesktop(event, $(this));
                });

            },

            // Déclenche le chargement du nombre et des notifs
            loadAll: function () {

                // On ne charge les notifs que si il y a une différence
                // Ou si il n'y a aucune notifs
                if (count !== lastCount || count === 0) {
                appNotifications.load();
                }
                appNotifications.loadNumber();

            },

            // Masque de chargement pour l'icône et le badge
            badgeLoadingMask: function (show) {
                if (show === true) {
                $("#notificationsBadge").html(appNotifications.badgeSpinner);
                $("#notificationsBadge").show();
                // Mobile
                $("#notificationsBadgeMobile").html(count);
                $("#notificationsBadgeMobile").show();
                }
                else {
                $("#notificationsBadge").html(count);
                if (count > 0) {
                    $("#notificationsIcon").removeClass("fa-bell-o");
                    $("#notificationsIcon").addClass("fa-bell");
                    $("#notificationsBadge").show();
                    // Mobile
                    $("#notificationsIconMobile").removeClass("fa-bell-o");
                    $("#notificationsIconMobile").addClass("fa-bell");
                    $("#notificationsBadgeMobile").show();
                }
                else {
                    $("#notificationsIcon").addClass("fa-bell-o");
                    $("#notificationsBadge").hide();
                    // Mobile
                    $("#notificationsIconMobile").addClass("fa-bell-o");
                    $("#notificationsBadgeMobile").hide();
                }

                }
            },

            // Indique si chargement des notifications
            loadingMask: function (show) {

                if (show === true) {
                $("#notificationAucune").hide();
                $("#notificationsLoader").show();
                } else {
                $("#notificationsLoader").hide();
                if (count > 0) {
                    $("#notificationAucune").hide();
                }
                else {
                    $("#notificationAucune").show();
                }
                }

            },

            // Chargement du nombre de notifications
            loadNumber: function () {
                appNotifications.badgeLoadingMask(true);

                // TODO : API Call pour récupérer le nombre

                // TEMP : pour le template
                setTimeout(function () {
                $("#notificationsBadge").html(count);
                appNotifications.badgeLoadingMask(false);
                }, 1000);
            },

            // Chargement de notifications
            load: function () {
                appNotifications.loadingMask(true);

                // On vide les notifs
                $('#notificationsContainer').html("");

                // Sauvegarde du nombre de notifs
                lastCount = count;

                // TEMP : pour le template
                setTimeout(function () {

                // TEMP : pour le template
                for (i = 0; i < count; i++) {

                    var template = $('#notificationTemplate').html();
                    template = template.replace("[[href]]", notifications[i].href);
                    template = template.replace("[[title]]", notifications[i].title);
                    template = template.replace("[[texte]]", notifications[i].texte);
                    template = template.replace("[[date]]", notifications[i].date);

                    $('#notificationsContainer').append(template);
                }

                // On bind le marquage comme lue
                $('.notification-read').on('click', function (event) {
                    appNotifications.markAsRead(event, $(this));
                });

                // On arrête le chargement
                appNotifications.loadingMask(false);

                // On réactive le bouton
                $("#notifications-dropdown").prop("disabled", false);
                }, 1000);
            },

            // Marquer une notification comme lue
            markAsRead: function (event, elem) {
                // Permet de garde la liste ouverte
                event.preventDefault();
                event.stopPropagation();

                // Suppression de la notification
                elem.parent('.dropdown-notification').remove();

                // TEMP : pour le template
                count--;

                // Mise à jour du nombre
                appNotifications.loadAll();
            },

            // Marquer une notification comme lue version bureau
            markAsReadDesktop: function (event, elem) {
                // Permet de ne pas change de page
                event.preventDefault();
                event.stopPropagation();

                // Suppression de la notification
                elem.parent('.dropdown-notification').removeClass("notification-unread");
                elem.remove();

                // On supprime le focus
                if (document.activeElement) {
                document.activeElement.blur();
                }

                // TEMP : pour le template
                count--;

                // Mise à jour du nombre
                appNotifications.loadAll();
            },

            add: function () {
                lastCount = count;
                count++;
            },

            // Template du badge
            badgeSpinner: '<i class="fa fa-spinner fa-pulse fa-fw" aria-hidden="true"></i>'
            };

            appNotifications.init();

            });

            $(window).on('load',function(){
                if('{{ session()->has("alert_success") }}'){
                    $('#alertSuccessModal').modal('show');
                }
            });
    </script>
    <script>
        function closeModal(){
            loadingPage();
            window.location.href = '{{ route("home") }}';
        }

        function cancelRegistration(){
            swal({
                title: "@lang('app.inscription')",
                text: "@lang('app.cancel_registration_confirme')",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#ff3547',
                confirmButtonText: "@lang('app.yes')",
                cancelButtonText: "@lang('app.no')",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(isConfirm){	
            if (isConfirm){
                    loadingPage();
                    sessionStorage.clear();
                    return window.location.href="{{route('home')}}";    
                }
            });
        }

        function myFunction() {
            return input = document.activeElement.id;
        }
    </script>

    <!-- end -->

</body>
<!-- end body -->

</html>
