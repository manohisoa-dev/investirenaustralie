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
                                        <a href="{{$item->links}}" target="_blank"><img src="{{ $item->image?asset($item->image->filepath):'' }}" alt="{{$item->title}}"></a>
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
                                @forelse ($child->images as $item)
                                    <img src="{{ asset($item->filepath) }}" title="{{ $item->filename }}" alt="{{ $item->filename }}">
                                @empty
                                    <img src="{{ asset('images/page/default.png') }}" title="{{ asset('images/page/default.png') }}" alt="{{ asset('images/page/default.png') }}">
                                @endforelse
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
            @elseif($child->page_order == 3)
                <section id="feature" class="section gray-bg">
                    <div class="container">
                        <div class="row md-m-25px-b m-45px-b justify-content-center text-center">
                            <div class="col-lg-8">
                                <h3 class="h1 m-20px-b p-20px-b theme-after after-50px">{{$child->title}}</h3>
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

                                @php
                                    $htmlContent = $child->content;
                                    preg_match('/<div class="home-step">(.*?)<\/div>/s', $htmlContent, $match);
                                    if(count($match) > 0){
                                        preg_match_all( '|<h[^>]+>(.*)</h[^>]+>|iU', $match[1], $titles );
                                        preg_match_all( '|<p>(.*)</p>|iU', $match[1], $contents );
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
                                                        <h2 class="h1 m-25px-b" style="overflow-wrap: break-word;">{!! array_key_exists($i,$getTitle)?$getTitle[$i]:'' !!}</h2>
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
                                                        <h2 class="h1 m-25px-b" style="overflow-wrap: break-word;">{!! array_key_exists($i,$getTitle)?$getTitle[$i]:'' !!}</u></h2>
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
                                                        <h2 class="h1 m-25px-b" style="overflow-wrap: break-word;">{!! array_key_exists($i,$getTitle)?$getTitle[$i]:'' !!}</h2>
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
                                                        <h2 class="h1 m-25px-b" style="overflow-wrap: break-word;">{!! array_key_exists($i,$getTitle)?$getTitle[$i]:'' !!}</h2>
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
                <section class="section theme-bg">
                    <div class="container">
                        <div class="row md-m-25px-b m-45px-b justify-content-center text-center">
                            <div class="col-lg-8">
                                <h3 class="h1 white-color m-20px-b p-20px-b white-after after-50px">@lang('app.txt.missionvision')</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 m-15px-tb">
                                <div style="height:500px;" class="p-50px-tb p-35px-lr box-shadow-hover hover-top hover-rotate white-bg text-center border-radius-5 mission-content">
                                    <div class="ef-1 icon-80 theme-bg border-radius-50 theme2nd-color d-inline-block m-20px-b hr-rotate-after">
                                        <i class="white-color fa fa-podcast"></i>
                                    </div>
                                    <h5 class="h3 m-10px-b">@lang('app.txt.mission.title')</h5>
                                    <p class="m-0px text-justify">@lang('app.txt.mission.content')</p>
                                </div>
                            </div>
                            <div class="col-md-6 m-15px-tb">
                                <div class="p-45px-tb p-35px-lr box-shadow-hover hover-top hover-rotate white-bg text-center border-radius-5">
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
            @endif
        @endif
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
    <!-- Section produit-->
    <section class="section gray-bg overflow-hidden">
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
        <div class="container">
            <div class="row justify-content-center sm-m-20px-b m-40px-b">
                <div class="col-lg-8 text-center">
                    <label class="border-bottom-2 font-w-600 theme-color border-color-theme2nd">@lang('app.txt.our_blogs')</label>
                    <h3 class="h1 m-0px">@lang('app.dernierart')</h3>
                </div>
            </div>
            <div class="row">
               @forelse($blogs as $blog)
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
                @empty
                    <div class="col-lg-12 text-center"> @lang('app.txt.noinfo') </div>
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
