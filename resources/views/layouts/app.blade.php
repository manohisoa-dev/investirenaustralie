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
<link href="{{ asset('plugin/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugin/font-awesome/css/all.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugin/et-line/style.css') }}" rel="stylesheet">
<link href="{{ asset('plugin/themify-icons/themify-icons.css') }}" rel="stylesheet">
<link href="{{ asset('plugin/owl-carousel/css/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugin/magnific/magnific-popup.css') }}" rel="stylesheet">
<!-- theme css -->
<link href="{{ asset('style/master.css') }}" rel="stylesheet">
<link href="{{ asset('style/app.css') }}" rel="stylesheet">
<!-- Fin Mombo -->

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
                        <div class="col-md-5 ht-info">
                            <ul class="nav justify-content-md-start justify-content-center links-white">
                                <li class="small"><a href="#"><i class="fas fa-mobile-alt"></i> @lang('app.contact_us_phone', ['phone'=>option('site.admin_phone', '+61 33 333 33')])</a></li>
                                <li class="small m-10px-l"><a href="mailto:info@admin.com"><i class="fas fa-envelope"></i> info@admin.com</a></li>
                            </ul>
                        </div>
                        <div class="col-md-7 d-none d-md-block">
                            <ul class="nav justify-content-end links-white dropdown-dark-header">
                                @if(!Auth::check())
                                <li class="small m-10px-l"><i class="fas fa-mouse-pointer"></i> <a href="{{route('login')}}">@lang('app.connexion')</a>
                                </li>
                                <li class="small m-10px-l"><i class="fas fa-sign-in-alt"></i> @lang('app.sinscrire') : 
                                    <select id="currency-dropdown" onChange="location.href=''+this.options[this.selectedIndex].value;" class="white-bg-alt border-color-dark-gray border-radius-0 white-color">
                                        <option class="dark-color" value="#" selected="true" disabled="disabled">@lang('app.as')</option>
                                        <option class="dark-color" value="{{route('register', ['role'=>'member'])}}">@lang('app.member')</option>
                                        <option class="dark-color" value="{{route('register', ['role'=>'seller'])}}">@lang('app.seller')</option>
                                        <option class="dark-color" value="{{route('register', ['role'=>'afa'])}}">@lang('app.afa')</option>
                                        <option class="dark-color" value="{{route('register', ['role'=>'apl'])}}">@lang('app.apl')</option>
                                    </select>
                                </li>
                                @else
                                <li class="small m-10px-l"><i class="fas fa-user"></i> <a href="{{ url(\App\Models\User::find(Auth::id())->roleUser->role_initial)}}">{{Auth::user()->name}} </a>                                </li>
                                @endif
                                <li class="small m-10px-l"><i class="fas fa-globe"></i> @lang('app.language') : 
                                    <div class="dropdown pull-right">
                                      <a href="#" class="font-weight-bold dropdown-toggle" type="button" data-toggle="dropdown">
                                        @php $ico_fr= asset('images/ico/fr.png');$ico_en= asset('images/ico/en.png'); @endphp
                                          <label class="m-10px-l"> {!! app()->getLocale()=='fr' ? '<img src="'.$ico_fr.'">' : '<img src="'.$ico_en.'">' !!}</label></a>
                                          <ul class="dropdown-menu p-10px-l w-100" id="language-dropdown" >
                                            <li><a style="color:#555658;" href="{{route('localization', ['locale'=>'fr'])}}"><img src="{{ asset('images/ico/fr.png') }}"> Fr <span class="dark-color">(@lang('app.txt.fr'))</span></a></li>
                                            <li><a style="color:#555658;" href="{{route('localization', ['locale'=>'en'])}}"><img src="{{ asset('images/ico/en.png') }}"> En <span class="dark-color">(@lang('app.txt.en'))</span></a></li>
                                          </ul>
                                    </div>
                                </li>
                                <li class="small m-10px-l">
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
            <div class="container container-large">
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
                                <a href="#home">@lang('app.immobilier')</a>
                                <i class="fa fa-angle-down px-nav-toggle"></i>
                                <ul class="px-dropdown-menu mm-dorp-in">
                                    <li><a href="{{route('shop.index', \App\Models\Category::find(1))}}">@lang('app.residentiel')</a></li>
                                    <li><a href="{{route('shop.index', \App\Models\Category::find(2))}}">@lang('app.foncier')</a></li>
                                </ul>
                            </li>
                            <li class="mm-in px-dropdown">
                                <a href="#home">@lang('app.business')</a>
                                <i class="fa fa-angle-down px-nav-toggle"></i>
                                <ul class="px-dropdown-menu mm-dorp-in">
                                    <li><a href="{{route('shop.index', \App\Models\Category::find(3))}}">@lang('app.industrial')</a></li>
                                    <li><a href="{{route('shop.index', \App\Models\Category::find(4))}}">@lang('app.commercial')</a></li>
                                </ul>
                            </li>
                            <li><a class="nav-link" href="{{route('services')}}">@lang('app.services')</a></li>
                            <li><a class="nav-link" href="{{route('blog.all')}}">@lang('app.blog')</a></li>
                            @if(Auth::check())
                            <li class="mm-in px-dropdown">
                                <a href="#home">@lang('app.account')</a>
                                <i class="fa fa-angle-down px-nav-toggle"></i>
                                <ul class="px-dropdown-menu mm-dorp-in">
                                    <li><a href="{{url(\App\Models\User::find(Auth::id())->roleUser->role_initial)}}">@lang('app.dashboard')</a></li>
                                    <li><a href="{{route('profile')}}">@lang('app.profile')</a></li>
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
                            <form class="d-flex flex-row m-5px-b p-1 white-bg input-group" action="{{route('shop.index')}}" method="get">
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
                            <li><a href="{{route('shop.index')}}">@lang('app.immobilier')</a></li>
                            <li><a href="{{route('shop.index')}}">@lang('app.business')</a></li>
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
                            <li><a href="{{route('terms')}}">@lang('app.terms')</a></li>
                            <li><a href="{{route('confidentialities')}}">@lang('app.confidential')</a></li>
                            <li><a href="{{route('help')}}">@lang('app.user_guide')</a></li>
                            <li><a href="{{route('publicities')}}">@lang('app.pubs')</a></li>
                            @if(Auth::check())
                                <li><a href="{{route('profile')}}">@lang('app.account')</a></li>
                            @endif
                        </ul>
                    </div>
                    {{-- <div class="col-lg-2 col-sm-5 m-15px-tb" id="apl_list">
                        <h6 class="white-color">
                            {{ Illuminate\Support\Str::upper(trans('app.apls')) }}
                        </h6>
                        <ul class="list-unstyled links-white footer-link-1">
                            @forelse($lapls as $apl)
                                <li><a class="apl_item" href="#" value="{{ $apl->locality }}" data-toggle="modal" data-target="#listAplModal">{{ $apl->locality }}</a></li>
                            @empty
                                <li></li>
                            @endforelse
                        </ul>
                    </div> --}}
                    <div class="col-lg-3 col-sm-5 m-15px-tb">
                        <h6 class="white-color">
                            {{ Illuminate\Support\Str::upper(trans('app.txt.information')) }}
                        </h6>
                        <address>
                            <p class="white-color-light m-5px-b">301 The Greenhouse London,<br> E2 8DY UK</p>
                            <p class="m-5px-b"><a class="theme2nd-color border-color-theme4nd" href="mailto:support@domain.com">info@admin.com</a></p>
                            <p class="m-5px-b"><a class="theme2nd-color border-color-theme4nd" href="tel:820-885-3321">+61 33 333 33</a></p>
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
                    <ul class="nav justify-content-center justify-content-md-start p-25px-b links-white footer-link-1">
                        <li style="margin:auto;">
                            <a href="{{route('apls')}}">@lang('app.apls')</a> :
                            @if(isset($lapls))
                                @foreach($lapls as $apl)
                                    <a class="apl_item" href="#" value="{{ $apl->locality }}" data-toggle="modal" data-target="#listAplModal">{{ $apl->locality }}</a> @if(!$loop->last) - @endif
                                @endforeach
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
                    <div class="modal-body">
                        <div class="nav flex-sm-column flex-row">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="m-btn m-btn-theme2nd" data-dismiss="modal">@lang('app.txt.close')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin modal -->

    <!-- jquery -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
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
    <script src="{{ asset('js/bootstrap-slider.js') }}"></script>
    <!-- Bootstrap 3 slider -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.2/css/bootstrap-slider.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.2/bootstrap-slider.min.js"></script>
    <!-- end -->

    <script type="text/javascript">
        $('#apl_list').on('click','.apl_item',function(){
            var val = $(this).attr('value');
            var uri = '{{ URL::to("getApl") }}'+'/'+val;
            var envoi = $.get( uri );

            envoi.done( function(data) {
                // set apl title
                $('#listAplModal .modal-header').html('<h4 class="white-color">'+val+'</h4>');

                // initialize apl items
                $('#listAplModal .modal-body').html('');

                // set apl items
                $('#listAplModal .modal-body').append("<h6 class='white-color'>@lang('app.txt.aplfound') : "+data.res.length+"</h6>");
                $.each(data.res,function(key,value){
                    $('#listAplModal .modal-body').append('<a href={{route("member.select.apl")}} class="nav-item nav-link white-color"><i class="fa fa-building"></i> '+value.name+'</a>');
                });
            });


            // var path = $('#page_id').val()==1?'V2/getApl':'../V2/getApl';
            // $.ajax({
            //     url : path+'/'+val,
            //     method : 'get',
            //     dataType: 'json',
            //     success : function(data){
            //         // set apl title
            //         $('#listAplModal .modal-header').html('<h4 class="white-color">'+val+'</h4>');

            //         // initialize apl items
            //         $('#listAplModal .modal-body').html('');

            //         // set apl items
            //         $('#listAplModal .modal-body').append("<h6 class='white-color'>@lang('app.txt.aplfound') : "+data.res.length+"</h6>");
            //         $.each(data.res,function(key,value){
            //             $('#listAplModal .modal-body').append('<a href={{route("member.select.apl")}} class="nav-item nav-link white-color"><i class="fa fa-building"></i> '+value.name+'</a>');
            //         });
            //     }
            // });
        });
    </script>



    @stack('script')
    <!-- end -->

</body>
<!-- end body -->

</html>
