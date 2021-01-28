<!-- Page Title -->
<section class="section bg-center bg-cover bg-fixed effect-section" style="background-image: url({{ asset('images/slider/1.jpg') }});">
    <div class="mask theme-bg opacity-5"></div>
    <div class="container">
        <div class="row justify-content-center p-50px-t">
            <div class="col-lg-8 text-center">
                <h2 class="white-color h1 m-20px-b">{{ trans('app.txt.'.str_replace(' ','_',strtolower($slot))) }}</h2>
                <ol class="breadcrumb white justify-content-center">
                    <li><a href="{{ route('v2.home') }}">@lang('app.home')</a></li>
                    <li class="active">{{ trans('app.txt.'.str_replace(' ','_',strtolower($slot))) }}</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<!-- En Page Title -->	