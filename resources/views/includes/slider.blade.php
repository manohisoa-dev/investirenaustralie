<div id="slider-area">
    <div class="main-slider">
        <div id="bg-slider" class="owl-carousel owl-theme">
          <div class="slider"><img src="{{asset('images/slider/1.jpg')}}" alt="Slide"></div>
          <div class="slider"><img src="{{asset('images/slider/2.jpg')}}" alt="Slide"></div>
          <div class="slider"><img src="{{asset('images/slider/3.jpg')}}" alt="Slide"></div>
        </div>
        <div class="slider-content">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
                    <!-- corps barre de recherche -->
                     <div class="search-form wow pulse" data-wow-delay="0.8s">
                        <form method="post" action="{{route('search')}}" class="form-inline">
                            {{csrf_field()}}
                            <button class="btn toggle-btn" type="button"><i class="fa fa-bars"></i></button>
                             <div class="form-group">
                                <select id="basic" class="form-control" name="state">
                                    <option value="" selected disabled>@lang('app.input.etats')</option>
                                    @if(isset($states))
                                        @foreach($states as $state)
                                            <option value="{{$state->id}}">{{$state->content.' ('.$state->products()->where('products.status', 'published')->count().')'}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <select id="basic" class="form-control" name="city">
                                    <option value="" selected disabled>@lang('app.input.villes')</option>
                                    <option value="">Sydney</option>
                                    <option value="">Sydeney</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select id="basic" class="form-control" name="state3">
                                    <option value="" selected disabled>@lang('app.input.suburbs')</option>
                                    <option value="">Sydney</option>
                                    <option value="">Sydeney</option>
                                </select>
                            </div>
                            
                            <button class="btn search-btn" type="submit"><i class="fa fa-search"></i></button>
                            <div style="display: none;" class="search-toggle tab-content">
                              <a data-toggle="tab" class="btn btn-default" href="#residentiel"><i class="fa fa-home" aria-hidden="true">&nbsp;@lang('app.btn.residentiel')</i></a>
                              <a data-toggle="tab" class="btn btn-default" href="#foncier"><i class="fa fa-map-o" aria-hidden="true">&nbsp;@lang('app.btn.foncier')</i></a>
                              <a data-toggle="tab" class="btn btn-default" href="#industriel"><i class="fa fa-industry" aria-hidden="true">&nbsp;@lang('app.btn.industriel')</i></a>
                              <a data-toggle="tab" class="btn btn-default" href="#commercial"><i class="fa fa-building" aria-hidden="true">&nbsp;@lang('app.btn.commercial')</i></a>
                            <div id="residentiel" class="tab-pane fade in active"><hr>
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
                            </div><!-- end div residentiel -->

                            <div id="foncier" class="tab-pane fade">
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
                            </div><!-- end div foncier -->

                            <div id="industriel" class="tab-pane fade">
                              <h3>@lang('app.input.menuindustriel')</h3>
                              <p>@lang('app.input.menuindustriel.content')</p>
                            </div><!-- end id industriel -->

                             <div id="commercial" class="tab-pane fade">
                              <h3>@lang('app.input.menucommercial')</h3>
                              <p>@lang('app.input.menucommercial.content')</p>
                            </div><!-- end id industriel -->

                          </div><!-- end content search-bar -->
                        </form>
                    </div><!-- end barre de recherche -->
                </div>
            </div>
        </div>
    </div>    
  </div>