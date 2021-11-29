@extends('layouts.app')

@section('content')

<!-- Main -->
<main>
    @if($item->id==1)
        @include('includes.slider')
    @else
        @component('includes.breadcrumb')
            {{$item->title}}
        @endcomponent
    @endif


    <!-- Content home -->
    @if(!empty($item->content))
        <section class="property-contents common">
            <header class="section-header home-section-header">
               <h4 class="wow slideInRight">{{$item->title}}</h4>
            </header>
            <div class="row">
                <div class="property-single-metax">{!!$item->content!!}</div>
                @if(Auth::check()&&Auth::user()->isAdmin())
                <a href="{{route('admin.page.update',$item)}}" class="more pull-right"><i class="fa fa-pencil"></i> @lang('app.btn.edit')</a>
                @endif
            </div>
        </section>
    @endif

    @foreach($item->childs as $child)
        @if ($child->page_order%2 == 0 && $child->isPub($child->id))
            <!-- Section show pubs pages -->
            @forelse ($child->pubs as $item)
                <section id="feature" class="section bg-cover bg-no-repeat parallax opacity-10" style="background-image: url(images/fond-grenat.jpg);">
                    <div class="container">
                        <div class="row md-m-25px-b m-45px-b justify-content-center text-center">
                            <div class="col-lg-8">
                                <p class="m-0px font-1 white-color-light">@lang('app.txt.advertisement')</p>
                                <div id="ads" class="ads-section col-lg-12 p-15px-tb white-bg">
                                    <div class="ads-header float-left p-20px-l p-10px-b">
                                        <img src="{{ asset('images/ads-logo.png') }}" alt="logo_iea">
                                    </div>
                                    <div class="ads-content">
                                        {{-- size 714x298px --}}
										@if($item->image)
											<a href="{{$item->links}}" target="_blank"><img src="{{ $item->image?asset($item->image->filepath):'' }}" alt="{{$item->title}}"></a>
										@else
											<a href="{{$item->links}}" target="_blank"><img src="http://placehold.it/250x250" alt="{{$item->title}}"></a>
										@endif
                                        
                                    </div>
                                    <div class="ads-footer p-15px-t">
                                        <div class="row col-lg-12">
                                            <div class="col-lg-8">
                                                <p class="float-left">{{$item->title}}</p>
                                            </div>
                                            <div class="col-lg-4">
                                                <a class="float-right m-btn m-btn-theme2nd-outline" href="{{$item->links}}" target="_blank">@lang('app.btn.read_more')</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @empty

            @endforelse
            <!--End Section show pubs pages -->
        @else
            @if($child->page_order == 1)
                <!-- Section -->
                <section id="about" class="section gray-bg">
                    <div class="container">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-lg-6 text-center m-15px-tb">
                                <div class="aos-init aos-animate" data-aos="fade-right">
                                    {{--@forelse ($child->images as $item)--}}
                                        {{--<img src="{{ asset($item->filepath) }}" title="{{ $item->filename }}" alt="{{ $item->filename }}">--}}
                                    {{--@empty--}}
                                        <img src="{{ asset('img/sydney-img1.png') }}" title="{{ asset('img/sydney-img1.png') }}" alt="{{ asset('') }}">
                                    {{--@endforelse--}}
                                </div>
                            </div>

                            <div class="col-lg-6 m-15px-tb">
                                <h2 class="h1 m-25px-b title-iea h1 m-25px-b" style="font-size: 2.1rem !important;">{{$child->title}}</h2>
                                <div class="text-justify txt-body">
                                    <p class="m-5px-b">{!!$child->content!!}</p>
                                </div>
                                @if(Auth::check()&&Auth::user()->isAdmin())
                                    <div class="btn-bar p-15px-t">
                                        <a class="m-btn-theme" href="{{route('admin.page.update',$child)}}"><i class="icon-edit"></i> @lang('app.btn.edit')</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
                <!--End Section -->

                @if(request()->getHost() == "iea.easydata.mg")
                <!-- VIDEO SECTION PARALLAX -->
                <div class="jarallax" data-jarallax data-jarallax-video="https://youtu.be/WlPUe_yfMVg">
                    <div class="demo-table">
                        <div class="demo-table-cell">
                            <section class="pb-0" id="">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="title-box">
                                                <h2 style="margin-top: 80px; color: white !important; font-weight: 800 !important;">Comment on peut vous aider ?</h2>
                                                <p class="" style="color: white !important;">Lorem ipsum dolor sit amet</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6" data-aos="fade-right">
                                            <div class="fancy_service text-left">
                                                <div class="bg_img">
                                                    <img src="img/44.png" alt="fancybox">
                                                </div>
                                                <div class="fancy_block">
                                                    <div class="fancy-info">
                                                        <h4 class="mt-4 mb-3 title">Membre </h4><h4 style="color: white;">.</h4>
                                                        <p class="txt-body">Si vous êtes intéressé par une solution d'investissement en Australie.</p>
                                                        <a href="#">
                                                            <span class="btn-effect orange-color">
                                                                S'isncrire
                                                                <i class="fa fa-plus-circle ml-2" aria-hidden="true"></i>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <!-- Blem affichage -->
                                                    <div class="fancy_img_test"><img src="img/e1-full.jpg" alt="fancybox2"></div>
                                                    <!-- blem affichage -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6" data-aos="fade-left">
                                            <div class="fancy_service text-left" style="visibility: visible; animation-name: fadeInUp;">
                                                <div class="bg_img">
                                                    <img src="img/44.png" alt="fancybox">
                                                </div>
                                                <div class="fancy_block">
                                                    <div class="fancy-info">
                                                        <h4 class="mt-4 mb-3 title">Vendeur </h4><h4 style="color: white;">.</h4>
                                                        <p class="txt-body">Si vous souhaitez proposer aux investisseurs francophones<span id="dots">...</span>
                                                            <span id="more">internationaux des produits australiens immobiliers résidentiels, fonciers, industriels ou commerciaux.</span>

                                                            <button onclick="voirPlus()" id="myBtn">▼</button></p>
                                                        <a href="#">
                                                            <span class="btn-effect orange-color">
                                                                S'inscrire
                                                                <i class="fa fa-plus-circle ml-2" aria-hidden="true"></i>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div class="fancy_img_test"><img src="img/e4-full.jpg" alt="fancybox2"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6" data-aos="fade-right">
                                            <div class="fancy_service text-left" style="visibility: visible; animation-name: fadeInUp;">
                                                <div class="bg_img">
                                                    <img src="img/44.png" alt="fancybox">
                                                </div>
                                                <div class="fancy_block">
                                                    <div class="fancy-info">
                                                        <h4 class="mt-4 mb-3 title">Agence Francophone</h4><h4 class="title">Australienne</h4>
                                                        <p class="txt-body">AFA si, en tant qu'agence immobilière ou d'affaires australienne,...▼</p>
                                                        <a href="#">
                                                            <span class="btn-effect orange-color">
                                                                S'inscrire
                                                                <i class="fa fa-plus-circle ml-2" aria-hidden="true"></i>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div class="fancy_img_test"><img src="img/e3-full.jpg" alt="fancybox2"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6" data-aos="fade-left">
                                            <div class="fancy_service text-left" style="visibility: visible; animation-name: fadeInUp;">
                                                <div class="bg_img mb-5 mb-lg-0">
                                                    <img src="img/44.png" alt="fancybox">
                                                </div>
                                                <div class="fancy_block">
                                                    <div class="fancy-info">
                                                        <h4 class="mt-4 mb-3 title">Agence Partenaire</h4><span></span><h4 class="title">Locale</h4>
                                                        <p class="txt-body">APL si, en tant qu'agence implantée dans un pays ou territoire francophone,...▼</p>
                                                        <a href="#">
                                                            <span class="btn-effect orange-color">
                                                                S'inscrire
                                                                <i class="fa fa-plus-circle ml-2" aria-hidden="true"></i>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div class="fancy_img_test"><img src="img/e2-full.jpg" alt="fancybox2"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <!-- READ MORE SCRIPT -->
                @endif
            @elseif($child->page_order == 3)
                <section id="feature" class="section gray-bg">
                    <div class="container">
                        <div class="row md-m-25px-b m-45px-b justify-content-center text-center">
                            <div class="col-lg-8">
                                <h3 class="h2 m-20px-b p-20px-b theme-after after-50px">{{$child->title}}</h3>
                            </div>
                        </div>
                        <div class="tab-style-3">
                            <ul class="nav nav-fill nav-tabs box-shadow-lg">
                                <li class="nav-item">
                                    <a href="#tab3_sec1" data-toggle="tab" class="active">
                                        <div class="icon"><img class="img-step-iea icon-step" src="{{asset("icon/step1.png")}}"></div>
                                        <span>@lang('app.home.step1.title')</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tab3_sec2" data-toggle="tab" class="">
                                        <div class="icon"><img class="img-step-iea icon-step" src="{{asset("icon/step2.png")}}"></div>
                                        <span>@lang('app.home.step2.title')</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tab3_sec3" data-toggle="tab" class="">
                                        <div class="icon"><img class="img-step-iea icon-step" src="{{asset("icon/step3.png")}}"></div>
                                        <span>@lang('app.home.step3.title')</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tab3_sec4" data-toggle="tab" class="">
                                        <div class="icon"><img class="img-step-iea icon-step" src="{{asset("icon/step4.png")}}"></div>
                                        <span>@lang('app.home.step4.title')</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content iea-tab">

                                @php
                                    $htmlContent = $child->content;
                                    preg_match('/<div class="home-step">(.*?)<\/div>/s', $htmlContent, $match);
                                    if(count($match) > 0){
                                        preg_match_all( '|<h[^>]+>(.*)</h[^>]+>|iU', $match[1], $titles );
                                        preg_match_all( '/<p[^>]*?>(.*?)<\/p>/s', $match[1], $contents );
                                    }
                                    $getTitle = isset($titles) && count($titles) ? $titles[1] : [];
                                    $getContent = isset($contents) && count($contents) ? $contents[1] : [];
                                @endphp

                                @for ($i=0; $i <sizeOf($getTitle) ; $i++)
                                    @if($i+1 === 1)
                                        <div id="tab3_sec1" class="tab-pane fade in active show">
                                            <div class="row align-items-center p-25px-t lg-p-15px-t">
                                                <div class="col-lg-6 text-center">
                                                    <img src={{ asset("images/page/step1.png") }} title="" alt="">
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="p-70px-l lg-p-0px-l lg-m-30px-t">
                                                        <h2 class="h2-small m-25px-b" style="overflow-wrap: break-word;">{!! array_key_exists($i,$getTitle)?$getTitle[$i]:'' !!}</h2>
                                                        <p class="m-5px-b text-justify" style="overflow-wrap: break-word;">{!! array_key_exists($i,$getContent)?$getContent[$i]:trans('app.txt.noinfo') !!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($i+1 === 2)
                                        <div id="tab3_sec2" class="tab-pane fade in">
                                            <div class="row align-items-center p-25px-t lg-p-15px-t">
                                                <div class="col-lg-6">
                                                    <div class="p-70px-r lg-p-0px-r lg-m-30px-t">
                                                        <h2 class="h2-small m-25px-b" style="overflow-wrap: break-word;">{!! array_key_exists($i,$getTitle)?$getTitle[$i]:'' !!}</u></h2>
                                                        <p class="m-5px-b text-justify" style="overflow-wrap: break-word;">{!! array_key_exists($i,$getContent)?$getContent[$i]:trans('app.txt.noinfo') !!}</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 order-lg-2 order-first text-center">
                                                    <img src="{{ asset('images/page/step2.png') }}" title="" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($i+1 === 3)
                                        <div id="tab3_sec3" class="tab-pane fade in">
                                            <div class="row align-items-center p-25px-t lg-p-15px-t">
                                                <div class="col-lg-6 text-center">
                                                    <img src="{{ asset('images/page/step3.png') }}" title="" alt="">
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="p-70px-l lg-p-0px-l lg-m-30px-t">
                                                        <h2 class="h2-small m-25px-b" style="overflow-wrap: break-word;">{!! array_key_exists($i,$getTitle)?$getTitle[$i]:'' !!}</h2>
                                                        <p class="m-5px-b text-justify" style="overflow-wrap: break-word;">{!! array_key_exists($i,$getContent)?$getContent[$i]:trans('app.txt.noinfo') !!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div id="tab3_sec4" class="tab-pane fade in">
                                            <div class="row align-items-center p-25px-t lg-p-15px-t">
                                                <div class="col-lg-6">
                                                    <div class="p-70px-r lg-p-0px-r lg-m-30px-t">
                                                        <h2 class="h2-small m-25px-b" style="overflow-wrap: break-word;">{!! array_key_exists($i,$getTitle)?$getTitle[$i]:'' !!}</h2>
                                                        <p class="m-5px-b text-jusfify" style="overflow-wrap: break-word;">{!! array_key_exists($i,$getContent)?$getContent[$i]:trans('app.txt.noinfo') !!}</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 order-lg-2 order-first text-center">
                                                    <img src="{{ asset('images/page/step4.png') }}" title="" alt="">
                                                </div>
                                            </div>
                                        </div>

                                    @endif

                                @endfor
                                @if(Auth::check()&&Auth::user()->isAdmin())
                                    <div class="btn-bar p-15px-t">
                                        <a class="m-btn-theme" href="{{route('admin.page.index')}}/{{ App::getLocale()=='fr'?11:38 }}/edit"><i class="icon-edit"></i> @lang('app.btn.edit')</a>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </section>
            @elseif($child->page_order == 5)
                @php
                    $htmlContent = $child->content;
                    preg_match_all('/<p[^>]*?>(.*?)<\/p>/s', $htmlContent, $match);
                        
                    if(count($match) > 0){
                        $p0 = strip_tags($match[0][0]);
                        $p1 = strip_tags($match[0][1]);
                        $p2 = strip_tags($match[0][2]);
                    }
                @endphp

                <section class="section">
                    <div class="container">
                        <div class="row md-m-25px-b m-45px-b">
                            <div class="col-lg-4 m-15px-tb aos-init aos-animate" data-aos="fade-right">
                                <div class="p-45px-tb p-35px-lr">
                                    <h3 class="h1 m-20px-b p-20px-b">@lang('app.txt.missionvision')</h3>
                                    <p class="m-0px txt-body">{{ str_replace('&nbsp;',' ',$p0) }}</p>
                                    <p class="txt-body" style="padding-top: 10px;padding-left: 10px;"><i class="fa fa-check-circle"></i> {{ str_replace('&nbsp;',' ',$p1) }}</p>
                                    <p class="txt-body" style="padding-left: 10px;"><i class="fa fa-check-circle" style="color: #ae4435;"></i> {{ str_replace('&nbsp;',' ',$p2) }}</p>
                                </div>
                            </div>
                            <div class="col-lg-4 p-35px-lr contente aos-init aos-animate" data-aos="fade-up">
                                <div class="content-overlay"></div>
                                <div class="content-origin">
                                    <img src="{{asset('img/mission-min.png')}}" style="width:256px; height: auto">
                                    <h5>@lang('app.txt.mission.title')</h5>
                                </div>
                                <div class="content-details fadeIn-bottom">
                                    <p class="content-text" style="padding-left:20px; padding-right:20px;">@lang('app.txt.mission.content')</p>
                                </div>
                            </div>

                            <div class="col-lg-4 p-35px-lr contente aos-init aos-animate" data-aos="fade-down">
                                <div class="content-overlay"></div>
                                <div class="content-origin">
                                    <img src="{{asset('img/vision-min.png')}}" style="width:256px; height: auto">
                                    <h5>@lang('app.txt.vision.title')</h5>
                                </div>
                                <div class="content-details fadeIn-bottom">
                                    <p class="content-text" style="padding-left:20px; padding-right:20px;">@lang('app.txt.vision.content')</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                @if(request()->getHost() == "iea.easydata.mg")
                <!-- VIDEO SECTION PARALLAX 2 -->
                <div class="jarallax" data-jarallax data-jarallax-video="https://youtu.be/WlPUe_yfMVg">
                    <div class="demo-table">
                        <div class="demo-table-cell">
                            <section id="call-to-action" class="cta-iea" style="margin-top: 80px">
                                <div class="container laptop-cta">
                                    <div class="row row-cta">
                                        <div class="col-lg-12 right-cta" style="margin: auto;">
                                            <h1 class="text-white" style="text-align: center;">Inscrivez-Vous</h1>
                                            <p class="txt-body" style="color: #e6e6e6 !important; text-align: center;">Le portail "Investir en Australie" - IEA offre plusieurs opportunités d'inscription. Vous pouvez vous inscrire en qualité de :<br>
                                                ► "Membre" si vous êtes intéressé par une solution d'investissement en Australie;<br>
                                                ► "Vendeur" si vous souhaitez proposer aux investisseurs francophones internationaux des produits australiens immobiliers résidentiels, fonciers, industriels ou commerciaux;<br>
                                                ► "Agence Francophone Australienne" - AFA si, en tant qu'agence immobilière ou d'affaires australienne, vous souhaitez réaliser les opérations de vente correspondantes;<br>
                                                ► "Agence Partenaire Locale" - APL si, en tant qu'agence implantée dans un pays ou territoire francophone, vous souhaitez proposer vos services à votre clientèle locale concernant des investissements en Australie dans un partenariat avec le système "Investir en Australie".
                                            </p>
                                            <div style="margin-top: 20px; text-align: center;" data-aos="fade-up">
                                                <a class="m-btn m-btn-theme2nd btn-radius-iea" href="#">
                                                    S'inscrire gratuitement
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <!-- END PARALLAX 2-->
                @endif
                @else
                <!-- Section -->
                <section id="about" class="section gray-bg">
                    <div class="container">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-lg-6 text-center m-15px-tb">
                                @forelse ($child->images as $item)
                                    <img src="{{ asset($item->filepath) }}" title="{{ $item->filename }}" alt="{{ $item->filename }}">
                                @empty
                                    <img src="{{ asset('images/page/default.png') }}" title="{{ asset('images/page/default.png') }}" alt="{{ asset('images/page/default.png') }}">
                                @endforelse
                            </div>
                            <div class="col-lg-5 m-15px-tb">
                                <h2 class="h1 m-25px-b">{{$child->title}}</h2>
                                <div class="text-justify txt-body">
                                    <p class="m-5px-b">{!!$child->content!!}</p>
                                </div>
                                @if(Auth::check()&&Auth::user()->isAdmin())
                                    <div class="btn-bar p-15px-t">
                                        <a class="m-btn-theme" href="{{route('admin.page.update',$child)}}"><i class="icon-edit"></i> @lang('app.btn.edit')</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
                <!--End Section -->
            @endif
        @endif
    @endforeach

    <!-- Section -->
    <section class="section youtube-iea">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6 m-15px-tb">
                    <div class="video-box aos-init aos-animate" data-aos="fade-down">
                        <!-- <iframe class="iframe" height="350" src="https://www.youtube.com/embed/dzHw2RRyk68"></iframe> -->
                        <img class="box-shadow-iea border-radius-20" src="{{ asset('img/bghead.jpg') }}" title="" alt="">
                        <a class="video-btn white popup-youtube p-center" href="https://www.youtube.com/watch?v=8FPgOCmX7MM"><span></span></a>
                    </div>
                </div>

                <div class="col-lg-5 m-15px-tb aos-init aos-animate" data-aos="fade-right">
                    <h2 class="h1 m-25px-b text-white bg-title">@lang('app.home.youtube.title')</h2>
                    <p class="text-white" style="padding-top: 20px; line-height: 1.8;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <div class="btn-bar p-15px-t aos-init aos-animate" data-aos="fade-up">
                        <a class="m-btn m-btn-theme btn-white-iea btn-radius-iea" href="#">@lang('app.btn.view_more')</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Section -->
    <!-- Section produit-->
    <section class="section gray-bg overflow-hidden bloc-last-product">
        <div class="container">
            <div class="row md-m-25px-b m-45px-b justify-content-center text-center">
                <div class="col-lg-8">
                    <h3 class="h1 m-10px-b p-20px-b theme-after after-50px">@lang('app.dernierprod')</h3>
                </div>
            </div>

            <div class="owl-carousel owl-no-overflow" data-items="3" data-nav-dots="true" data-md-items="2" data-sm-items="2" data-xs-items="1" data-xx-items="1" data-space="30" data-center="true" data-stage="50">
                @forelse($recentProducts as $product)
                    @include('product.single', ['item'=>$product, 'page_id'=>$item->id])
                @empty
                    <div class="text-center">@lang('app.txt.no_product_found')</div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- End Section -->
    <!-- Section blog-->
    <section id="blog" class="section white-bg">
        <div class="container-xxl">
            <div class="row justify-content-center sm-m-20px-b m-40px-b">
                <div class="col-lg-8 text-center">
                    <label class="border-bottom-2 font-w-600 theme-color border-color-theme2nd">@lang('app.txt.our_blogs')</label>
                    <h3 class="h1 m-0px">@lang('app.dernierart')</h3>
                </div>
            </div>
            <div class="row">
               @forelse($blogs as $blog)
			   		@php
						$lang = \App::getLocale();
						$slug = 'slug_'.$lang;
						$title = 'title_'.$lang;
					@endphp

                    <div class="col-xl-3 m-15px-tb">
                        <div class="hover-top transition blog-grid-overlay overlay-iea" style="background-image: url({{asset(getImageResizeUrl('blog', $blog->image->filename, 'scare'))}}); ">
                            <div class="blog-gird-info">
                                <a class="overlay-link" href="{{route('blog.index',$blog->$slug)}}"></a>
                                <div class="b-meta">
                                    <span class="date">{{ $blog->created_at ? Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $blog->created_at)->format('d F') : ""}}, {{$blog->created_at ? Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $blog->created_at)->year : ''}}</span>
                                    <p class="meta-blog">@lang('app.txt.postepar') : {{$blog->author ? $blog->author->name : ''}} – {{$blog->created_at ? $blog->created_at->diffForHumans() : ''}}</label> </p>
                                </div>
                                <h5 style="height: 100px;">{{$blog->$title}}</h5>
                                <!-- <p>{{ substr(strip_tags($blog->excerpt()),0,0) }} ...</p> -->
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-xl-4 m-15px-tb"> @lang('app.txt.noinfo') </div>
               @endforelse
            </div>
        </div>
    </section>
    <!-- End Section -->
	
	<!-- Section témoignage -->
	@if (count($testimonials)) { 
	<section class="section gray-bg overflow-hidden">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-5 m-15px-tb">
                    <label class="border-bottom-2 font-w-600 theme-color border-color-theme2nd">@lang('app.txt.our_testimonials')</label>
					<p class="font-2">@lang('app.txt.testimonial_description')</p>
					@if(Auth::check() && Auth::user()->hasRole(5))
					<div class="p-15px-t">
						<a class="m-btn m-btn-theme m-btn-radius" href="{{route('member.testimonial')}}">@lang('app.txt.add_new_testimonials')</a>
					</div>
					@endif
				</div>
				<div class="col-lg-6 m-15px-tb">
					<div class="owl-carousel" data-items="2" data-nav-dots="true" data-md-items="2" data-sm-items="2" data-xs-items="2" data-xx-items="1" data-space="0">
						@foreach($testimonials as $testimonial)
						@php
							$path = \App\Models\Image::find($testimonial->author->image_id);
							if(@getimagesize(asset($path->filepath))){
								$background = asset($path->filepath);
							}else{
								$background = asset('img/500x500.jpg');
							}
						@endphp
						<div class="box-shadow m-10px overflow-hidden border-radius-5">
							<div class="d-flex align-items-center h-100 min-h-150px bg-cover bg-no-repeat position-relative" style="background-image: url({{$background}});">
								<div class="mask theme-bg opacity-5"></div>
								<div class="position-relative w-100 text-center">
									<h5 class="white-color m-0px font-w-600">{{ $testimonial->author->name }}</h5>
									<label class="m-0px font-small white-color">{{\App\Models\User::find($testimonial->user_create)->roleUser->role_name}}</label>
								</div>
							</div>
							<div class="mt-n4 p-20px-lr p-30px-b position-relative text-center">
								<div class="icon-50 theme2nd-bg border-radius-50 d-inline-block white-color m-15px-b"><i class="fas fa-quote-left"></i></div>
								<p class="m-0px">{{str_limit(strip_tags($testimonial->contenu),"250","...")}}</p>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</section>
	@endif
	<!-- End Section témoignage -->
</main>
<!-- End Main -->
@endsection
