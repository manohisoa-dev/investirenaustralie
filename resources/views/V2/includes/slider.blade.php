<!-- Home Banner -->
<section id="home" class="effect-section">
    <div class="effect-shape theme-bg"></div>
    <div class="container">
        <div class="row full-screen align-items-center justify-content-between lg-m-80px-tb">
            <div class="col-lg-6 m-50px-tb">
                <h1 class="white-color display-4 m-20px-b">@lang('app.home.title')</h1>
                <p class="font-2 white-color-light">@lang('app.home.abstract')</p>
                <div class="extra-menu d-flex align-items-center">
                    <button type="button" class="navbar-toggler collapsed m-btn m-btn-theme2nd flex-shrink-0" data-toggle="collapse" data-target="#navbar-collapse-toggles" aria-expanded="false" style="margin-right: -50px;margin-left: -5px;">
                        <span class="icon-bar"></span>
                    </button>
                    <div class=" d-md-block h-btn m-35px-l col-lg-12">
                        <form class="d-flex flex-row m-5px-b p-1 white-bg input-group" action="{{route('shop.index')}}" method="get">
                            <input type="email" class="form-control border-radius-0 border-0" placeholder="@lang('app.input.etat')" name="q" value="{{isset($q)?$q:''}}">
                            <input type="email" class="form-control border-radius-0 border-0" placeholder="@lang('app.input.ville')" name="q" value="{{isset($q)?$q:''}}">
                            <input type="email" class="form-control border-radius-0 border-0" placeholder="@lang('app.input.suburb')" name="q" value="{{isset($q)?$q:''}}">
                            <button class="m-btn m-btn-theme2nd flex-shrink-0" type="submit">@lang('app.input.recherche')</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img class="max-width-auto" src="{{ asset('images/slider/large/2.jpg') }}" title="" alt="">
            </div>
        </div>
    </div>
</section>
<!-- End Home Banner -->

<!-- Section -->
<div class="gray-bg">
    <div class="container m-60px-nt">
        <div class="white-bg box-shadow-lg p-20px position-relative border-radius-5">
            <div class="owl-carousel" data-items="6" data-md-items="6" data-sm-items="3" data-xs-items="3" data-xx-items="2" data-space="10" data-nav-dots="false" data-autoplay="ture">
                <div class="grayscale-hover">
                    <a href="#">
                        <img src="{{ asset('/images/slider/1.jpg') }}" title="" alt="">
                    </a>
                </div>
                <div class="grayscale-hover">
                    <a href="#">
                        <img src="{{ asset('/images/slider/2.jpg') }}" title="" alt="">
                    </a>
                </div>
                <div class="grayscale-hover">
                    <a href="#">
                        <img src="{{ asset('/images/slider/3.jpg') }}" title="" alt="">
                    </a>
                </div>
                <div class="grayscale-hover">
                    <a href="#">
                        <img src="{{ asset('/images/slider/4.jpg') }}" title="" alt="">
                    </a>
                </div>
                <div class="grayscale-hover">
                    <a href="#">
                        <img src="{{ asset('/images/slider/11.jpg') }}" title="" alt="">
                    </a>
                </div>
                <div class="grayscale-hover">
                    <a href="#">
                        <img src="{{ asset('/images/slider/22.jpg') }}" title="" alt="">
                    </a>
                </div>
                <div class="grayscale-hover">
                    <a href="#">
                        <img src="{{ asset('/images/slider/44.jpg') }}" title="" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Section -->