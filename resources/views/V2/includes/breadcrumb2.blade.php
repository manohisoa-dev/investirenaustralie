<!-- Page Title -->
<section class="section bg-center bg-cover bg-fixed effect-section" style="background-image: url({{ asset('images/slider/1.jpg') }});">
    <div class="mask theme-bg opacity-5"></div>
    <div class="container">
        <div class="row justify-content-center p-50px-t">
            <div class="col-lg-8 text-center">
                <h2 class="white-color h1 m-20px-b">{{ trans('app.txt.'.str_replace(' ','_',strtolower($cat))) }}</h2>
                <ol class="breadcrumb white justify-content-center">
                    <li><a href="{{ route('v2.home') }}">@lang('app.home')</a></li>
                    <li class="active">{{ trans('app.txt.'.str_replace(' ','_',strtolower($slot))) }}</li>
                    <li class="active">{{ trans('app.txt.'.str_replace(' ','_',strtolower($cat))) }}</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<!-- En Page Title -->	

<!-- Section -->
<div class="gray-bg">
    <div class="container m-60px-nt">
        <div class="white-bg box-shadow-lg p-20px position-relative border-radius-5">
            <div class="extra-menu d-flex align-items-center">
                <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#navbar-collapse-toggle" aria-expanded="false">
                    <span class="icon-bar"></span>
                </button>
                <div class="d-none d-md-block h-btn m-35px-l col-lg-11">
                    <form class="d-flex flex-row m-5px-b p-1 white-bg input-group" action="{{route('shop.index')}}" method="get">
                        <input type="email" class="form-control border-radius-0 border-0" placeholder="@lang('app.input.etat')" name="q" value="{{isset($q)?$q:''}}">
                        <input type="email" class="form-control border-radius-0 border-0" placeholder="@lang('app.input.ville')" name="q" value="{{isset($q)?$q:''}}">
                        <input type="email" class="form-control border-radius-0 border-0" placeholder="@lang('app.input.suburb')" name="q" value="{{isset($q)?$q:''}}">
                        <button class="m-btn m-btn-theme2nd flex-shrink-0" type="submit">@lang('app.input.recherche')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Section -->