<!-- Home Banner -->
<section id="home" class="effect-section parallax" style="background-image: url({{ asset('images/slider/1.jpg') }});height: 36rem;">
    <div class="container">
        <div class="row full-screen align-items-center justify-content-between lg-m-80px-tb">
            
        </div>
    </div>
</section>
<!-- End Home Banner -->

<!-- Section -->
<div class="gray-bg">
    <div class="container m-60px-nt">
        <div class="white-bg box-shadow-lg p-20px position-relative border-radius-5">
            <div class="extra-menu d-flex align-items-center">
                <button type="button" class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#collapseSearch" aria-expanded="false" aria-controls="collapseSearch">
                    <span class="icon-bar"></span>
                </button>
                <div class="d-none d-md-block h-btn m-35px-l col-lg-11">
                    <form class="d-flex flex-row m-5px-b p-1 white-bg input-group" action="{{route('v2.search')}}" method="get">
                        {{csrf_field()}}
                        <input type="email" class="form-control border-radius-0 border-0" placeholder="@lang('app.input.etat')" name="q" value="{{isset($q)?$q:''}}">
                        <input type="email" class="form-control border-radius-0 border-0" placeholder="@lang('app.input.ville')" name="q" value="{{isset($q)?$q:''}}">
                        <input type="email" class="form-control border-radius-0 border-0" placeholder="@lang('app.input.suburb')" name="q" value="{{isset($q)?$q:''}}">
                        <button class="m-btn m-btn-theme2nd flex-shrink-0" type="submit">@lang('app.input.recherche')</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="collapse" id="collapseSearch">
          <div class="card card-body">
            <div class="search-toggle tab-content m-100px-l">
                <a class="m-btn m-btn-theme m-100px-l" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                <i class="fa fa-home" aria-hidden="true">&nbsp;@lang('app.btn.residentiel')</i></a>
                <a class="m-btn m-btn-theme m-10px-l" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                <i class="fa fa-home" aria-hidden="true">&nbsp;@lang('app.btn.foncier')</i></a>
                <a class="m-btn m-btn-theme m-10px-l" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                <i class="fa fa-home" aria-hidden="true">&nbsp;@lang('app.btn.industriel')</i></a>
                <a class="m-btn m-btn-theme m-10px-l" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                <i class="fa fa-home" aria-hidden="true">&nbsp;@lang('app.btn.commercial')</i></a>
            </div>
          </div>
        </div>
    </div>
</div>
<!-- End Section -->