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
            <div class="search-toggle tab-content m-100px-l p-15px-tb">
                <a class="m-btn m-btn-theme m-100px-l" data-toggle="collapse" href="#residentiel" role="button" aria-expanded="false" aria-controls="residentiel">
                <i class="fa fa-home" aria-hidden="true">&nbsp;@lang('app.btn.residentiel')</i></a>
                <a class="m-btn m-btn-theme m-10px-l" data-toggle="collapse" href="#foncier" role="button" aria-expanded="false" aria-controls="foncier">
                <i class="fa fa-home" aria-hidden="true">&nbsp;@lang('app.btn.foncier')</i></a>
                <a class="m-btn m-btn-theme m-10px-l" data-toggle="collapse" href="#industriel" role="button" aria-expanded="false" aria-controls="industriel">
                <i class="fa fa-home" aria-hidden="true">&nbsp;@lang('app.btn.industriel')</i></a>
                <a class="m-btn m-btn-theme m-10px-l" data-toggle="collapse" href="#commercial" role="button" aria-expanded="false" aria-controls="commercial">
                <i class="fa fa-home" aria-hidden="true">&nbsp;@lang('app.btn.commercial')</i></a>
            </div>
            <!-- residentiel -->
            <div class="collapse m-100px-l" id="residentiel">
                <div class="form-group">
                    <select id="basic" class="form-control" name="type">
                        <option value="">@lang('app.input.type')</option>
                        @if(isset($types))
                            @foreach($types as $type)
                                <option value="{{$type->id}}">{{$type->title.' ('.$type->products()->where('products.status', 'published')->count().')'}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <select id="basic" class="form-control" name="location_type">
                        <option value="">@lang('app.input.localisation')</option>
                        @if(isset($locationTypes))
                            @foreach($locationTypes as $locationType)
                                <option value="{{$locationType->id}}">{{$locationType->title.' ('.$locationType->products()->where('products.status', 'published')->count().')'}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="search-row">


                    <div class="form-group">
                      <h2>Bootstrap Slider with Tooltip</h2>
                      <input id="ex1" data-slider-id='ex1Slider' type="text" 
                             data-slider-min="0" 
                             data-slider-max="20" 
                             data-slider-step="1" 
                             data-slider-value="14"/>
                    </div>


                    <div class="form-group mar-r-20">
                        <label for="price-range">@lang('app.input.prix') ( Australia Dollar AUD ) :</label>
                        <input type="text" class="span2" name="price" value="" data-slider-min="100000" data-slider-max="10000000" data-slider-step="100000" data-slider-value="[500000,5000000]" id="price-range1">
                        <br>
                        <b class="pull-left color">100.000$</b>
                        <b class="pull-right color">10.000.000$</b>
                    </div>
                    <div class="form-group mar-l-20">
                        <label for="area">@lang('app.input.superficie') ( m<sup>2</sup> ) :</label>
                        <input type="text" class="span2"  name="area" value="" data-slider-min="50" data-slider-max="1000" data-slider-step="50" data-slider-value="[50,450]" id="property-geo">
                        <br>
                        <b class="pull-left color">50m<sup>2</sup></b>
                        <b class="pull-right color">1000m<sup>2</sup></b>
                    </div>
                </div>
                <div class="search-row">
                    <div class="form-group mar-r-20">
                        <label for="price-range">@lang('app.input.nbsalledebain') :</label>
                        <input type="text" class="span2" name="bathrooms" value="" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="[5,8]" id="min-baths">
                        <br>
                        <b class="pull-left color">1</b>
                        <b class="pull-right color">10</b>
                    </div>
                    <div class="form-group mar-l-20">
                        <label for="price-range">@lang('app.input.nbchambre') :</label>
                        <input type="text" class="span2" name="bedrooms" value="" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="[5,8]" id="min-bed">
                        <br>
                        <b class="pull-left color">1</b>
                        <b class="pull-right color">10</b>
                    </div>
                </div>
                <div class="search-row">
                    <div class="form-group mar-r-20">
                        <label for="toillet">@lang('app.input.nbtoilette') :</label>
                        <input type="text" class="span2" name="toillet" value="" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="[1,3]" id="min-toillet">
                        <br>
                        <b class="pull-left color">1</b>
                        <b class="pull-right color">10</b>
                    </div>
                    <div class="form-group mar-l-20">
                        <label for="garage_spaces">@lang('app.input.nbgarage') :</label>
                        <input type="text" class="span2" name="bedrooms" value="" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="[1,1]" id="min-park">
                        <br>
                        <b class="pull-left color">1</b>
                        <b class="pull-right color">10</b>
                    </div>
                </div>
                <button class="btn search-btn prop-btm-sheaerch" type="submit"><i class="fa fa-search"></i></button>
            </div>
            <!-- fin residentiel -->

            <!-- foncier -->
            <div class="collapse m-100px-l" id="foncier">
                <div class="search-row">
                <div class="form-group mar-r-20">
                    <label for="price-range">@lang('app.input.prix') (AU$):</label>
                    <input type="text" class="span2" value="" data-slider-min="100000"
                           data-slider-max="10000000" data-slider-step="50000"
                           data-slider-value="[500000,5000000]" id="price-range" name="prix"><br />
                    <b class="pull-left color">100000$</b>
                    <b class="pull-right color">10000000$</b>
                </div>
                <div class="form-group mar-l-20">
                    <label for="property-geo">@lang('app.input.superficie') (m2) :</label>
                    <input type="text" class="span2" value="" data-slider-min="50"
                           data-slider-max="1000" data-slider-step="25"
                           data-slider-value="[50,450]" id="property-geo1" name="superficie"><br />
                    <b class="pull-left color">50m</b>
                    <b class="pull-right color">1000m</b>
                </div>
                <br>
              </div><!-- end search-row -->
            </div>
            <!-- fin foncier -->

            <!-- industriel -->
            <div class="collapse m-100px-l" id="industriel">
                <h3>@lang('app.input.menuindustriel')</h3>
                <p>@lang('app.input.menuindustriel.content')</p>      
            </div>
            <!-- fin industriel -->

            <!-- commercial -->
            <div class="collapse m-100px-l" id="commercial">
                <h3>@lang('app.input.menucommercial')</h3>
                <p>@lang('app.input.menucommercial.content')</p>
            </div>
            <!-- fin commercial -->
          </div>
        </div>
    </div>
</div>
<!-- End Section -->

@push('script')
<!-- bootstrap-slider js + css  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.2.0/bootstrap-slider.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.2.0/css/bootstrap-slider.min.css" />
    <script type="text/javascript">
        $('#residentiel').on('show.bs.collapse', function () {
            $('#foncier').collapse('hide');
            $('#industriel').collapse('hide');
            $('#commercial').collapse('hide');
        });

        $('#foncier').on('show.bs.collapse', function () {
            $('#residentiel').collapse('hide');
            $('#industriel').collapse('hide');
            $('#commercial').collapse('hide');
        });

        $('#industriel').on('show.bs.collapse', function () {
            $('#foncier').collapse('hide');
            $('#residentiel').collapse('hide');
            $('#commercial').collapse('hide');
        });

        $('#commercial').on('show.bs.collapse', function () {
            $('#residentiel').collapse('hide');
            $('#industriel').collapse('hide');
            $('#foncier').collapse('hide');
        });


        $('#ex1').slider({
          formatter: function(value) {
            return value;
          }
        });

    </script>


    <style type="text/css">
    
  background: #fafafa;
  box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
  height: 7px;

}
#ex1Slider {
  width: 300px;
}

/* .tooltip - background of tooltip */
#ex1Slider  .tooltip-inner {
  background-color: #fafafa;
  border-radius: 15px;
  color: #ccc;
  margin-left: -3.5px;
  box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
  opacity: 1;
}

#ex1Slider .slider-handle {
  background: #fafafa;
  width: 16px;
  height: 16px;
  box-shadow: 1px 2px 3px rgba(0, 0, 0, 0.3), 0px 0px 1px rgba(13, 13, 13, 0.3);
  border: 1px solid rgba(0, 0, 0, 0);
}

/* This sets the color of the arrow that connects the tooltip to the handle */
#ex1Slider .tooltip-arrow {
  border-top-color: #fafafa;
  margin-left: -7px;
  display: none;
}

body {
  background-color: #fff;
}

.form-group {
  padding: 25px;
}

h2 {
  padding: 15px 0px 30px 0px;
}
    </style>
@endpush