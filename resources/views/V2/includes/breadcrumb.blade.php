<!-- Page Title -->
<section class="section bg-center bg-cover bg-fixed effect-section" style="background-image: url(static/img/1600x900.jpg);">
    <div class="mask theme-bg opacity-9"></div>
    <div class="container">
        <div class="row justify-content-center p-50px-t">
            <div class="col-lg-8 text-center">
                <h2 class="white-color h1 m-20px-b">{{ trans('app.txt.'.str_replace(' ','_',strtolower($slot))) }}</h2>
                <ol class="breadcrumb white justify-content-center">
                    <li><a href="index.html">@lang('app.home')</a></li>
                    <li class="active">{{ trans('app.txt.'.str_replace(' ','_',strtolower($slot))) }}</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<!-- En Page Title -->	