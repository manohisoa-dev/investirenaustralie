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
        @if($child->page_order == 1)
            <!-- Section -->
            <section id="about" class="section gray-bg">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-lg-6 text-center m-15px-tb">
                            <img src="{{ asset('images/map-of-australia.jpg') }}" title="" alt="">
                        </div>
                        <div class="col-lg-5 m-15px-tb">
                            <h2 class="h1 m-25px-b">{{$child->title}}</h2>
                            <div class="text-justify">
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
            @elseif($child->page_order == 2)
                <!-- Section -->
                <section id="feature" class="section bg-cover bg-no-repeat parallax opacity-10" style="background-image: url(images/fond-grenat.jpg);">
                    <div class="container">
                        <div class="row md-m-25px-b m-45px-b justify-content-center text-center">
                            <div class="col-lg-8">
                                <h3 class="h1 white-color m-20px-b p-20px-b white-after after-50px">{{$child->title}}</h3>
                                <p class="m-0px font-2 white-color-light">{!!$child->content!!}</p>
                            </div>
                        </div>
                    </div>
                </section>
                <!--End Section -->
            @elseif($child->page_order == 3)
                <section id="feature" class="section gray-bg">
                    <div class="container">
                        <div class="row md-m-25px-b m-45px-b justify-content-center text-center">
                            <div class="col-lg-8">
                                <h3 class="h1 m-20px-b p-20px-b theme-after after-50px">{{$child->title}}</h3>
                                <p class="m-0px font-2">{!!$child->content!!}</p>
                            </div>
                        </div>
                        <div class="tab-style-3">
                            <ul class="nav nav-fill nav-tabs box-shadow-lg">
                                <li class="nav-item">
                                    <a href="#tab3_sec1" data-toggle="tab" class="active">
                                        <div class="icon"><i class="fa fa-globe"></i></div>
                                        <span>@lang('app.home.step1.title')</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tab3_sec2" data-toggle="tab" class="">
                                        <div class="icon"><i class="fa fa-info"></i></div>
                                        <span>@lang('app.home.step2.title')</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tab3_sec3" data-toggle="tab" class="">
                                        <div class="icon"><i class="fa fa-mouse-pointer"></i></div>
                                        <span>@lang('app.home.step3.title')</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tab3_sec4" data-toggle="tab" class="">
                                        <div class="icon"><i class="icon-tools"></i></div>
                                        <span>@lang('app.home.step4.title')</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab3_sec1" class="tab-pane fade in active show">
                                    <div class="row align-items-center p-25px-t lg-p-15px-t">
                                        <div class="col-lg-6 text-center">
                                            <img src="{{ asset('images/step1.png') }}" title="" alt="">
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="p-70px-l lg-p-0px-l lg-m-30px-t">
                                                <h2 class="h1 m-25px-b">@lang('app.home.step1.large.title')</u></h2>
                                                <p class="m-5px-b text-justify">@lang('app.home.step1.content')</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab3_sec2" class="tab-pane fade in">
                                    <div class="row align-items-center p-25px-t lg-p-15px-t">
                                        <div class="col-lg-6">
                                            <div class="p-70px-r lg-p-0px-r lg-m-30px-t">
                                                <h2 class="h1 m-25px-b">@lang('app.home.step2.large.title')</u></h2>
                                                <p class="m-5px-b text-justify">@lang('app.home.step2.content')</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 order-lg-2 order-first text-center">
                                            <img src="{{ asset('images/step2.png') }}" title="" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div id="tab3_sec3" class="tab-pane fade in">
                                    <div class="row align-items-center p-25px-t lg-p-15px-t">
                                        <div class="col-lg-6 text-center">
                                            <img src="{{ asset('images/step3.png') }}" title="" alt="">
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="p-70px-l lg-p-0px-l lg-m-30px-t">
                                                <h2 class="h1 m-25px-b">@lang('app.home.step3.large.title')</u></h2>
                                                <p class="m-5px-b text-justify">@lang('app.home.step3.content')</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab3_sec4" class="tab-pane fade in">
                                    <div class="row align-items-center p-25px-t lg-p-15px-t">
                                        <div class="col-lg-6">
                                            <div class="p-70px-r lg-p-0px-r lg-m-30px-t">
                                                <h2 class="h1 m-25px-b">@lang('app.home.step4.large.title')</u></h2>
                                                <p class="m-5px-b text-justify">@lang('app.home.step4.content')</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 order-lg-2 order-first text-center">
                                            <img src="{{ asset('images/step4.png') }}" title="" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @elseif($child->page_order == 4)
                <section class="section theme-bg">
                    <div class="container">
                        <div class="row md-m-25px-b m-45px-b justify-content-center text-center">
                            <div class="col-lg-8">
                                <h3 class="h1 white-color m-20px-b p-20px-b white-after after-50px">@lang('app.txt.missionvision')</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 m-15px-tb">
                                <div class="p-50px-tb p-35px-lr box-shadow-hover hover-top hover-rotate white-bg text-center border-radius-5">
                                    <div class="ef-1 icon-80 theme-bg border-radius-50 theme2nd-color d-inline-block m-20px-b hr-rotate-after"> 
                                        <i class="white-color fa fa-podcast"></i>
                                    </div>
                                    <h5 class="h3 m-10px-b">@lang('app.txt.mission.title')</h5>
                                    <p class="m-0px text-justify">@lang('app.txt.mission.content')</p>
                                </div>
                            </div>
                            <div class="col-md-6 m-15px-tb">
                                <div class="p-50px-tb p-35px-lr box-shadow-hover hover-top hover-rotate white-bg text-center border-radius-5">
                                    <div class="ef-1 icon-80 theme-bg border-radius-50 theme2nd-color d-inline-block m-20px-b hr-rotate-after">
                                        <i class="white-color fa fa-eye"></i>
                                    </div>
                                    <h5 class="h3 m-10px-b">@lang('app.txt.vision.title')</h5>
                                    <p class="m-0px  text-justify p-50px-tb">@lang('app.txt.vision.content')</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @else

        @endif

        <!-- @foreach($child->pubs as $pub)
        <section class="widget property-meta-wrapper clearfix">
            <h2 class="title wow slideInLeft">{{$pub->title}}</h2>
            <div class="content-box-large box-with-header">
                <a target="_blank" href="{{$pub->links?$pub->links:'#'}}"><img src="{{$pub->imageUrl()}}" class="img-rounded" alt="Cinque Terre" width="604" height="236"></a>
            </div>
        </section>
        @endforeach -->
    @endforeach

    <!-- Section -->
    <section class="section">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-5 m-15px-tb">
                    <h2 class="h1 m-25px-b">@lang('app.home.youtube.title')</p>
                    <div class="btn-bar p-15px-t">
                        <a class="m-btn m-btn-theme2nd m-btn-theme" href="#">@lang('app.btn.view_more')</a>
                    </div>
                </div>
                <div class="col-lg-6 m-15px-tb">
                    <div class="video-box">
                        <!-- <iframe class="iframe" height="350" src="https://www.youtube.com/embed/dzHw2RRyk68"></iframe> -->
                        <img class="box-shadow border-radius-5" src="{{ asset('images/iea.png') }}" title="" alt="">
                        <a class="video-btn white popup-youtube p-center" href="https://www.youtube.com/watch?v=8FPgOCmX7MM"><span></span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Section -->
    <!-- Section -->
    <section class="section gray-bg overflow-hidden">
        <div class="container">
            <div class="row md-m-25px-b m-45px-b justify-content-center text-center">
                <div class="col-lg-8">
                    <h3 class="h1 m-10px-b p-20px-b theme-after after-50px">@lang('app.dernierprod')</h3>
                </div>
            </div>

            <div class="owl-carousel owl-no-overflow" data-items="3" data-nav-dots="true" data-md-items="2" data-sm-items="2" data-xs-items="1" data-xx-items="1" data-space="30" data-center="true" data-stage="50">
                @foreach($recentProducts as $product)
                    @include('product.single', ['item'=>$product, 'page_id'=>$item->id])
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Section -->
    <!-- Section -->
    <section id="blog" class="section white-bg">
        <div class="container">
            <div class="row justify-content-center sm-m-20px-b m-40px-b">
                <div class="col-lg-8 text-center">
                    <label class="border-bottom-2 font-w-600 theme-color border-color-theme2nd">Our Blog</label>
                    <h3 class="h1 m-0px">@lang('app.dernierart')</h3>
                </div>
            </div>
            <div class="row">
               @foreach($blogs as $blog)
                    <div class="col-lg-4 m-15px-tb">
                        <div class="hover-top transition blog-grid-overlay" style="background-image: url({{$blog->imageUrl()}}); ">
                            <div class="blog-gird-info">
                                <a class="overlay-link" href="{{route('blog.index',$blog->slug)}}"></a>
                                <div class="b-meta">
                                    <span class="date">{{ $blog->created_at ? Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $blog->created_at)->format('d F') : ""}}, {{$blog->created_at ? Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $blog->created_at)->year : ''}}</span>
                                    <p class="meta">@lang('app.txt.postepar') : {{$blog->author ? $blog->author->name : ''}} – {{$blog->created_at ? $blog->created_at->diffForHumans() : ''}}</label> </p>
                                </div>
                                <h5 style="height: 100px;">{{$blog->title}}</h5>
                                <!-- <p>{{ substr(strip_tags($blog->excerpt()),0,0) }} ...</p> -->
                            </div>
                        </div>
                    </div>
               @endforeach
            </div>
        </div>
    </section>
    <!-- End Section -->
</main>
<!-- End Main -->
@endsection
