<!-- Section -->
<div class="gray-bg">
    <div class="container m-60px-nt">
        <form action="{{route('cg.search')}}" method="get" onclick="myFunction()" id="formFiltre">
            <div class="white-bg box-shadow-lg p-20px position-relative border-radius-iea20 aos-init aos-animate" data-aos="fade-up">
                <div class="extra-menu">
                    <div class="row">
                        <div class="col-lg-1 m-10px-t m-5px-b">
                            <button type="button" class="navbar-toggler collapsed " type="button" data-toggle="collapse" data-target="#collapseSearch" aria-expanded="false" aria-controls="collapseSearch" style="height:3.1rem;margin-top:-0.3rem;">
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="h-btn col-lg-11">
                            <span class="m-5px-b p-1 white-bg input-group">
                                {{-- {{csrf_field()}} --}}
                                <div class="row">
                                    <div class="col-lg-3 m-10px-b">
                                        <select id="administrative_area_level_1" class="form-control border-radius-iea border-1 m-15px-r col-sm-12 col-md-12" name="state">
                                            <option value="{{isset($q)?$q:''}}" selected readonly>@lang('app.input.etat')</option>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->content }}">{{ trans('app.txt.'.$state->content) }} ({{ $state->content }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-3 m-10px-b">
                                        <input type="text" id="administrative_area_level_2" name="city" class="form-control border-radius-iea border-1 m-15px-r" onFocus="geolocate()" placeholder="@lang('app.input.ville')" value="{{isset($q)?$q:''}}">
                                    </div>
                                    <div class="col-lg-3 m-10px-b">
                                        <input type="text" id="locality" name="suburb" class="form-control border-radius-iea border-1 m-60px-r" placeholder="@lang('app.input.suburb')" value="{{isset($q)?$q:''}}">
                                    </div>
                                    <div class="col-lg-3">
                                        <button class="m-btn m-btn-theme2nd btn-radius-iea" type="submit">@lang('app.input.recherche')</button>
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="checkbox m-100px-lg p-10px-l">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="sub_env" class="custom-control-input" id="shop-notification-1" checked="checked">
                        <label class="custom-control-label" for="shop-notification-1">@lang('app.input.surround_suburbs')</label>
                        <input type="hidden" value="@lang('app.txt.any')" id="prod" name="prod">
                    </div>
                </div>
                
                @if (session()->exists('search_session') && sizeOf(session()->get('search_session'))!==0)
                    <div class="section-search">
                        <hr>
                        <div class="row col-lg-12">
                            <div class="col-lg-6">
                                <p>@lang('app.txt.recent_searches')</p>
                            </div>
                            <div class="col-lg-6">
                                <a href="{{url('shop/search?state=&city=&suburb=&sub_env=on&prod=Tous') }}" class="close float-right btn-refresh" aria-label="refresh" title="@lang('app.txt.reset_search')">
                                    <span aria-hidden="true" class="small"><i class="icon-refresh" style="background: #555658;padding:5px;font-weight: 900;"></i></span>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            @foreach (session('search_session') as $key=>$item)
                                @php
                                    $data = unserialize($item);
                                @endphp
                                
                                <div class="col-lg-4 col-sm-12 m-15px-tb" id="search-{{ $key }}">
                                    <div class="p-20px p-0px-r border-all-1 border-color-white arrow-hover" style="border:solid 1px #555658;background-color:#555658;">
                                        <button type="button" class="close white-color float-right btn-search-close" aria-label="Close" value="search-{{ $key }}">
                                            <span aria-hidden="true" class="small p-5px">&times;</span>
                                        </button>

                                        @if (Auth::user())
                                            @if (Auth::user()->role==5)
                                                @php
                                                    $content = unserialize($item)['query'];
                                                    $search = App\Models\Search::where('content',$content)->where('author_id',Auth::user()->id)->first();
                                                @endphp

                                                @if(!$search)
                                                    <button type="button" class="close white-color float-right btn-search-save" aria-label="Close" value="{{ $data['query']?$data['query']:'' }}">
                                                        <span aria-hidden="true" class="small"><i class="fa fa-save"></i></span>
                                                    </button>
                                                @endif
                                            @endif
                                        @else
                                            <button type="button" class="close white-color float-right btn-search-save" aria-label="Close" value="{{ $data['query']?$data['query']:'' }}">
                                                <span aria-hidden="true" class="small"><i class="fa fa-save"></i></span>
                                            </button>
                                        @endif

                                        <a href="{{ $data['url'] }}">
                                            <h5 class="font-1 font-w-600 white-color m-0px text-left">{{ ($data['state']?$data['state']:''). ($data['city']?'-'.$data['city']:''). ($data['suburb']?'-'.$data['suburb']:'') }}</h5>
                                            <small class="white-color">{{ $data['prod']===trans('app.txt.any')?trans('app.all_product'):$data['prod'] }}</small>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            {{-- Position fixed  --}}
                {{-- <div class="collapse position-absolute border-radius-0" id="collapseSearch" style="z-index:5; width:82.5%;">  --}} 
            {{-- End Position fixed  --}}
            <div class="collapse position-relative border-radius-0" id="collapseSearch">
                <div class="card card-body">
                    <div class="search-toggle tab-content p-15px-tb row col-lg-12" style="margin:auto;">
                        <a class="btnProd m-btn m-btn-theme col-lg-3 col-md-12 border" data-toggle="collapse" href="#residentiel" role="button" aria-expanded="false" aria-controls="residentiel">
                        <i class="fa fa-home" aria-hidden="true">&nbsp;@lang('app.btn.residentiel')</i></a>
                        <a class="btnProd m-btn m-btn-theme col-lg-3 col-md-12 border" data-toggle="collapse" href="#foncier" role="button" aria-expanded="false" aria-controls="foncier">
                        <i class="fas fa-map" aria-hidden="true">&nbsp;@lang('app.btn.foncier')</i></a>
                        <a class="btnProd m-btn m-btn-theme col-lg-3 col-md-12 border" data-toggle="collapse" href="#industriel" role="button" aria-expanded="false" aria-controls="industriel">
                        <i class="fa fa-industry" aria-hidden="true">&nbsp;@lang('app.btn.industriel')</i></a>
                        <a class="btnProd m-btn m-btn-theme col-lg-3 col-md-12 border" data-toggle="collapse" href="#commercial" role="button" aria-expanded="false" aria-controls="commercial">
                        <i class="fa fa-building" aria-hidden="true">&nbsp;@lang('app.btn.commercial')</i></a>
                    </div>
                    
                    <!-- residentiel -->
                    <div class="collapse m-20px-l p-25px-tb" id="residentiel">
                        <div class="col-lg-12 row">
                            <div class="form-group mar-r-20 col-lg-6">
                                <select id="type" class="form-control" name="typeRes">
                                    <option value="0" selected disabled>@lang('app.input.type_de_bien')</option>
                                    @if(isset($typesRes))
                                        @foreach($typesRes as $type)
                                            <option value="{{$type->id}}">{{$type->title.' ('.$type->products()->where('products.status', 'published')->count().')'}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group mar-r-20 col-lg-6">
                                <select id="anciennete" class="form-control" name="anciennete">
                                    <option value="0" selected disabled>@lang('app.input.anciennete')</option>
                                    @if(isset($anciennetes))
                                        @foreach($anciennetes as $anciennete)
                                            <option value="{{$anciennete->id}}">{{$anciennete->title.' ('.$anciennete->products()->where('products.status', 'published')->count().')'}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12 row">
                            <div class="form-group mar-r-20 col-lg-6">
                                <select id="localisation" class="form-control" name="localisation">
                                    <option value="0" selected disabled>@lang('app.input.localisation')</option>
                                    @if(isset($locationTypes))
                                        @foreach($locationTypes as $locationType)
                                            <option value="{{$locationType->id}}">{{$locationType->title.' ('.$locationType->products()->where('products.status', 'published')->count().')'}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group mar-r-20 col-lg-6">
                                
                            </div>
                        </div>

                        <div class="col-lg-12 row">
                            <div class="form-group mar-r-20 col-lg-6 p-15px-t">
                                <label for="price-range">@lang('app.input.prix') ( Australia Dollar AUD ) :</label>
                                <div class="pmd-range-slider" id="price-range1"></div>
                                <!-- Values -->                                     
                                <div class="row">
                                    <div class="range-value col-sm-6 col-6">
                                        <b><span id="value-min"></span></b>
                                        <input type="hidden" id="residentiel_price_min" name="residentiel_price_min" class="residentiel-input" disabled>
                                    </div>
                                    <div class="range-value col-sm-6 col-6 text-right">
                                        <b><span id="value-max"></span></b>
                                        <input type="hidden" id="residentiel_price_max" name="residentiel_price_max" class="residentiel-input" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mar-r-20 col-lg-6 p-15px-t">
                                <label for="bedrooms">@lang('app.input.nbchambre') :</label>
                                <div class="pmd-range-slider" id="bedrooms"></div>
                                <!-- Values -->                                     
                                <div class="row">
                                    <div class="range-value col-sm-6 col-6">
                                        <b><span id="bedrooms-value-min"></span></b>
                                        <input type="hidden" id="residentiel_bedrooms_min" name="residentiel_bedrooms_min" class="residentiel-input" disabled>
                                    </div>
                                    <div class="range-value col-sm-6 col-6 text-right">
                                        <b><span id="bedrooms-value-max"></span></b>
                                        <input type="hidden" id="residentiel_bedrooms_max" name="residentiel_bedrooms_max" class="residentiel-input" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col-lg-12 row">
                            <div class="form-group mar-r-20 col-lg-6">
                                <label for="bathrooms">@lang('app.input.nbsalledebain') :</label>
                                <div class="pmd-range-slider" id="bathrooms"></div>
                                <!-- Values -->                                     
                                <div class="row">
                                    <div class="range-value col-sm-6 col-6">
                                        <b><span id="bathrooms-value-min"></span></b>
                                    </div>
                                    <div class="range-value col-sm-6 col-6 text-right">
                                        <b><span id="bathrooms-value-max"></span></b>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mar-r-20 col-lg-6">
                                <label for="bedrooms">@lang('app.input.nbchambre') :</label>
                                <div class="pmd-range-slider" id="bedrooms"></div>
                                <!-- Values -->                                     
                                <div class="row">
                                    <div class="range-value col-sm-6 col-6">
                                        <b><span id="bedrooms-value-min"></span></b>
                                    </div>
                                    <div class="range-value col-sm-6 col-6 text-right">
                                        <b><span id="bedrooms-value-max"></span></b>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 row">
                            <div class="form-group mar-r-20 col-lg-6">
                                <label for="etage">@lang('app.input.nbetage') :</label>
                                <div class="pmd-range-slider" id="etage"></div>
                                <!-- Values -->                                     
                                <div class="row">
                                    <div class="range-value col-sm-6 col-6">
                                        <b><span id="etage-value-min"></span></b>
                                    </div>
                                    <div class="range-value col-sm-6 col-6 text-right">
                                        <b><span id="etage-value-max"></span></b>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mar-r-20 col-lg-6">
                                <label for="park">@lang('app.input.nbgarage') :</label>
                                <div class="pmd-range-slider" id="park"></div>
                                <!-- Values -->                                     
                                <div class="row">
                                    <div class="range-value col-sm-6 col-6">
                                        <b><span id="park-value-min"></span></b>
                                    </div>
                                    <div class="range-value col-sm-6 col-6 text-right">
                                        <b><span id="park-value-max"></span></b>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <!-- fin residentiel -->

                    <!-- foncier --> 
                    <div class="collapse m-20px-l p-25px-tb" id="foncier">
                        <div class="col-lg-12 row">
                            <div class="form-group mar-r-20 col-lg-6">
                                <select id="typeFonc" class="form-control" name="typeFonc">
                                    <option value="0" selected disabled>@lang('app.input.type_de_bien')</option>
                                    @if(isset($typesFonc))
                                        @foreach($typesFonc as $type)
                                            <option value="{{$type->id}}">{{$type->title.' ('.$type->products()->where('products.status', 'published')->count().')'}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group mar-r-20 col-lg-6">
                                <select id="localisationFonc" class="form-control" name="localisationFonc">
                                    <option value="0" selected disabled>@lang('app.input.localisation')</option>
                                    @if(isset($locationTypes))
                                        @foreach($locationTypes as $locationType)
                                            <option value="{{$locationType->id}}">{{$locationType->title.' ('.$locationType->products()->where('products.status', 'published')->count().')'}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12 row">
                            {{-- <div class="form-group mar-r-20 col-lg-6">
                                <select id="agricole" class="form-control" name="agricoleFonc" disabled>
                                    <option value="0" selected disabled>@lang('app.input.secteur_agricole')</option>
                                    @if(isset($agricoles))
                                        @foreach($agricoles as $agricole)
                                            <option value="{{$agricole->id}}">{{$agricole->title.' ('.$agricole->products()->where('products.status', 'published')->count().')'}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div> --}}
                            <div class="form-group mar-r-20 col-lg-6">
                                <select id="unite" class="form-control" name="unite">
                                    <option value="0" selected disabled>@lang('app.input.unite_de_mesure')</option>
                                    <option value="1">m²</option>
                                    <option value="2">Hectare(s)</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12 row">
                            <div class="form-group mar-r-20 col-lg-6">
                                <select id="unite_min" class="form-control" name="foncier_area_min" disabled>
                                    <option value="0" selected disabled>@lang('app.input.superficie') (min)</option>
                                </select>
                            </div>
                            <div class="form-group mar-r-20 col-lg-6">
                                <select id="unite_max" class="form-control" name="foncier_area_max" disabled>
                                    <option value="" selected disabled>@lang('app.input.superficie') (max)</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12 row">
                            <div class="form-group mar-r-20 col-lg-6 p-15px-t">
                                <label for="prix">@lang('app.input.prix') ( Australia Dollar AUD ) :</label>
                                <div class="pmd-range-slider" id="prix"></div>
                                <!-- Values -->                                     
                                <div class="row">
                                    <div class="range-value col-sm-6 col-6">
                                        <b><span id="prix-value-min"></span></b>
                                        <input type="hidden" id="foncier_price_min" name="foncier_price_min" class="foncier-input" disabled>
                                    </div>
                                    <div class="range-value col-sm-6 col-6 text-right">
                                        <b><span id="prix-value-max"></span></b>
                                        <input type="hidden" id="foncier_price_max" name="foncier_price_max" class="foncier-input" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- fin foncier -->

                    <!-- industriel -->
                    <div class="collapse m-20px-l p-25px-tb" id="industriel">
                        <div class="col-lg-12 row">
                            <div class="form-group mar-r-20 col-lg-6">
                                <select id="typeInd" class="form-control" name="typeInd">
                                    <option value="0" selected disabled>@lang('app.input.type_de_bien')</option>
                                    @if(isset($typesInd))
                                        @foreach($typesInd as $type)
                                            <option value="{{$type->id}}">{{$type->title.' ('.$type->products()->where('products.status', 'published')->count().')'}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group mar-r-20 col-lg-6">
                                <select id="localisationInd" class="form-control" name="typeSectInd">
                                    <option value="0" selected disabled>@lang('app.input.secteur_industriel')</option>
                                    @if(isset($industriels))
                                        @foreach($industriels as $industriel)
                                            <option value="{{$industriel->id}}">{{$industriel->title.' ('.$industriel->products()->where('products.status', 'published')->count().')'}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 row">
                            <div class="form-group mar-r-20 col-lg-6 p-15px-t">
                                <label for="prixInd">@lang('app.input.prix') ( Australia Dollar AUD ) :</label>
                                <div class="pmd-range-slider" id="prixInd"></div>
                                <!-- Values -->                                     
                                <div class="row">
                                    <div class="range-value col-sm-6 col-6">
                                        <b><span id="prix-ind-value-min"></span></b>
                                        <input type="hidden" id="industriel_price_min" name="industriel_price_min" class="industriel-input" disabled>
                                    </div>
                                    <div class="range-value col-sm-6 col-6 text-right">
                                        <b><span id="prix-ind-value-max"></span></b>
                                        <input type="hidden" id="industriel_price_max" name="industriel_price_max" class="industriel-input" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- fin industriel -->

                    <!-- commercial -->
                    <div class="collapse m-20px-l p-25px-tb" id="commercial">
                        <div class="col-lg-12 row">
                            <div class="form-group mar-r-20 col-lg-6">
                                <select id="typeComm" class="form-control" name="typeComm">
                                    <option value="0" selected disabled>@lang('app.input.type_de_bien')</option>
                                    @if(isset($typesComm))
                                        @foreach($typesComm as $type)
                                            <option value="{{$type->id}}">{{$type->title.' ('.$type->products()->where('products.status', 'published')->count().')'}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group mar-r-20 col-lg-6">
                                <select id="secteurComm" class="form-control" name="typeSectComm">
                                    <option value="0" selected disabled>@lang('app.input.secteur_commercial')</option>
                                    @if(isset($commercials))
                                        @foreach($commercials as $commercial)
                                            <option value="{{$commercial->id}}">{{$commercial->title.' ('.$commercial->products()->where('products.status', 'published')->count().')'}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12 row">
                            <div class="form-group mar-r-20 col-lg-6">
                                <select id="parkingClient" class="form-control" name="parkingComm">
                                    <option value="0" selected disabled>@lang('app.input.parking_client')</option>
                                    <option value="yes">@lang('app.yes')</option>
                                    <option value="no">@lang('app.no')</option>
                                </select>
                            </div>
                            <div class="form-group mar-r-20 col-lg-6">
                                
                            </div>
                        </div>

                        <div class="col-lg-12 row">
                            <div class="form-group mar-r-20 col-lg-6 p-15px-t">
                                <label for="prixComm">@lang('app.input.prix') ( Australia Dollar AUD ) :</label>
                                <div class="pmd-range-slider" id="prixComm"></div>
                                <!-- Values -->                                     
                                <div class="row">
                                    <div class="range-value col-sm-6 col-6">
                                        <b><span id="prix-comm-value-min"></span></b>
                                        <input type="hidden" id="commercial_price_min" name="commercial_price_min" class="commercial-input" disabled>
                                    </div>
                                    <div class="range-value col-sm-6 col-6 text-right">
                                        <b><span id="prix-comm-value-max"></span></b>
                                        <input type="hidden" id="commercial_price_max" name="commercial_price_max" class="commercial-input" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mar-r-20 col-lg-6 p-15px-t">
                                <label for="areaComm">@lang('app.input.area_comm') :</label>
                                <div class="pmd-range-slider" id="areaComm"></div>
                                <!-- Values -->                                     
                                <div class="row">
                                    <div class="range-value col-sm-6 col-6">
                                        <b><span id="area-comm-value-min"></span></b>
                                        <input type="hidden" id="commercial_area_min" name="commercial_area_min" class="commercial-input" disabled>
                                    </div>
                                    <div class="range-value col-sm-6 col-6 text-right">
                                        <b><span id="area-comm-value-max"></span></b>
                                        <input type="hidden" id="commercial_area_max" name="commercial_area_max" class="commercial-input" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- fin commercial -->
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Section -->

@push('script')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2izG_M7K3gP6pFUH5cyzmDjuGpOYfgc4&libraries=places&callback=initMap&channel=GMPSB_addressselection_v1_cABC" async defer></script>
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

    </script>


    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/8.5.1/nouislider.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/range-slider.css') }}">

    <!-- Slider js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wnumb/1.1.0/wNumb.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/8.5.1/nouislider.min.js"></script>

    <script>
        var range_all_sliders = {
            'min': [0],
            '50%': [10000000,10000000],
            'max': [10050000]
        };

        // Residential
        // price range slider
        var priceRange = document.getElementById('price-range1');
        
        noUiSlider.create(priceRange, {
            // start: [{{ $min_price_residentiel?($min_price_residentiel!==$max_price_residentiel?$min_price_residentiel:0):0 }}, 10000000],
            start: [0, 10000000],
            step: 50000,
            connect: true,
            tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
            range: range_all_sliders,
            format: wNumb({
                decimals: 0,
                thousand: '',
                postfix: '',
            }),
        }); 

        var valueMax = document.getElementById('value-max'),
        valueMin = document.getElementById('value-min'),
        resPriceMin = $('#residentiel_price_min'),
        resPriceMax = $('#residentiel_price_max');
    
        // When the slider value changes, update the input and span
        priceRange.noUiSlider.on('update', function( values, handle ) {
            if ( handle ) {
                val = values[handle]>10000000?'+ '+new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'USD' }).format(10000000):new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'USD' }).format(values[handle]);
                valueMax.innerHTML = val;
                resPriceMax.val(values[handle]);
            } else {
                valueMin.innerHTML = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'USD' }).format(values[handle]);
                resPriceMin.val(values[handle]);
            }
        });
        // fin price range slider

        // bedrooms range slider
        var bedrooms = document.getElementById('bedrooms');
        noUiSlider.create(bedrooms, {
            // start:  [{{ $min_bedrooms_residentiel?($min_bedrooms_residentiel!==$max_bedrooms_residentiel?$min_bedrooms_residentiel:0):0 }}, 6],
            start:  [0, 6],
            step: 1,
            connect: true,
            tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
            range: {
                'min': 0,
                'max': 6
                // 'min': {{ $min_bedrooms_residentiel?($min_bedrooms_residentiel!==$max_bedrooms_residentiel?$min_bedrooms_residentiel:0):0 }},
                // 'max': {{ $max_bedrooms_residentiel?$max_bedrooms_residentiel:1 }}
            },
                format: wNumb({
                decimals: 0,
                thousand: '',
                postfix: '',
            }),
        }); 

        var bedroomsValueMax = document.getElementById('bedrooms-value-max'),
        bedroomsValueMin = document.getElementById('bedrooms-value-min'),
        resBedroomsMin = $('#residentiel_bedrooms_min'),
        resBedroomsMax = $('#residentiel_bedrooms_max');
    
        // When the slider value changes, update the input and span
        bedrooms.noUiSlider.on('update', function( values, handle ) {
            if ( handle ) {
                bedroomsValueMax.innerHTML = values[handle];
                resBedroomsMax.val(values[handle]);
            } else {
                bedroomsValueMin.innerHTML = values[handle];
                resBedroomsMin.val(values[handle]);
            }
        }); 
        // fin bedrooms range slider
        // fin Residential

        // property geo range slider
        // var propertyGeo = document.getElementById('property-geo');
        // noUiSlider.create(propertyGeo, {
        //     start: [{{ $min_land_area_residentiel }}, {{ $max_land_area_residentiel }}],
        //     connect: true,
        //     tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
        //     range: {
        //         'min': {{ $min_land_area_residentiel }},
        //         'max': {{ $max_land_area_residentiel }}
        //     },
        //         format: wNumb({
        //         decimals: 0,
        //         thousand: '',
        //         postfix: '',
        //     }),
        // }); 

        // var porpertyGeoValueMax = document.getElementById('property-geo-value-max'),
        // porpertyGeoValueMin = document.getElementById('property-geo-value-min');
    
        // // When the slider value changes, update the input and span
        // propertyGeo.noUiSlider.on('update', function( values, handle ) {
        //     if ( handle ) {
        //         porpertyGeoValueMax.innerHTML = values[handle];
        //     } else {
        //         porpertyGeoValueMin.innerHTML = values[handle];
        //     }
        // }); 
        // fin property geo range slider

        // bathrooms range slider
        // var bathrooms = document.getElementById('bathrooms');
        // noUiSlider.create(bathrooms, {
        //     start: [{{ $min_bathrooms_residentiel }}, {{ $max_bathrooms_residentiel }}],
        //     connect: true,
        //     tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
        //     range: {
        //         'min': {{ $min_bathrooms_residentiel }},
        //         'max': {{ $max_bathrooms_residentiel }}
        //     },
        //         format: wNumb({
        //         decimals: 0,
        //         thousand: '',
        //         postfix: '',
        //     }),
        // }); 

        // var bathroomsValueMax = document.getElementById('bathrooms-value-max'),
        // bathroomsValueMin = document.getElementById('bathrooms-value-min');
    
        // // When the slider value changes, update the input and span
        // bathrooms.noUiSlider.on('update', function( values, handle ) {
        //     if ( handle ) {
        //         bathroomsValueMax.innerHTML = values[handle];
        //     } else {
        //         bathroomsValueMin.innerHTML = values[handle];
        //     }
        // }); 
        // fin bathrooms range slider

        // etage range slider
        // var etage = document.getElementById('etage');
        // noUiSlider.create(etage, {
        //     start: [{{ $min_number_of_floors_residentiel }}, {{ $max_number_of_floors_residentiel }}],
        //     connect: true,
        //     tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
        //     range: {
        //         'min': {{ $min_number_of_floors_residentiel }},
        //         'max': {{ $max_number_of_floors_residentiel }}
        //     },
        //         format: wNumb({
        //         decimals: 0,
        //         thousand: '',
        //         postfix: '',
        //     }),
        // }); 

        // var etageValueMax = document.getElementById('etage-value-max'),
        // etageValueMin = document.getElementById('etage-value-min');
    
        // // When the slider value changes, update the input and span
        // etage.noUiSlider.on('update', function( values, handle ) {
        //     if ( handle ) {
        //         etageValueMax.innerHTML = values[handle];
        //     } else {
        //         etageValueMin.innerHTML = values[handle];
        //     }
        // }); 
        // fin etage range slider

        // park range slider
        // var park = document.getElementById('park');
        // noUiSlider.create(park, {
        //     start: [{{ $min_garage_space_residentiel }}, {{ $max_garage_space_residentiel }}],
        //     connect: true,
        //     tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
        //     range: {
        //         'min': {{ $min_garage_space_residentiel }},
        //         'max': {{ $max_garage_space_residentiel }}
        //     },
        //         format: wNumb({
        //         decimals: 0,
        //         thousand: '',
        //         postfix: '',
        //     }),
        // }); 

        // var parkValueMax = document.getElementById('park-value-max'),
        // parkValueMin = document.getElementById('park-value-min');
    
        // // When the slider value changes, update the input and span
        // park.noUiSlider.on('update', function( values, handle ) {
        //     if ( handle ) {
        //         parkValueMax.innerHTML = values[handle];
        //     } else {
        //         parkValueMin.innerHTML = values[handle];
        //     }
        // }); 
        // fin park range slider
        
        // Foncier
        // prix slider
        var prix = document.getElementById('prix');
        noUiSlider.create(prix, {
            // start: [{{ $min_price_foncier?($min_price_foncier!==$max_price_foncier?$min_price_foncier:0):0 }}, 10000000],
            start: [0, 10000000],
            step: 50000,
            connect: true,
            tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
            range: range_all_sliders,
            format: wNumb({
                decimals: 0,
                thousand: '',
                postfix: '',
            }),
        }); 

        var prixValueMaxFonc = document.getElementById('prix-value-max'),
        prixValueMinFonc = document.getElementById('prix-value-min'),
        foncPriceMin = $('#foncier_price_min'),
        foncPriceMax = $('#foncier_price_max');
    
        // When the slider value changes, update the input and span
        prix.noUiSlider.on('update', function( values, handle ) {
            if ( handle ) {
                val = values[handle]>10000000?'+ '+new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'USD' }).format(10000000):new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'USD' }).format(values[handle]);
                prixValueMaxFonc.innerHTML = val;
                foncPriceMax.val(values[handle]);
            } else {
                prixValueMinFonc.innerHTML = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'USD' }).format(values[handle]);
                foncPriceMin.val(values[handle]);
            }
        }); 
        // fin prix slider

        // superficie range slider
        // var propertyGeo = document.getElementById('superficie');
        // noUiSlider.create(superficie, {
        //     start: [{{ $min_land_area_foncier }}, {{ $max_land_area_foncier }}],
        //     connect: true,
        //     tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
        //     range: {
        //         'min': {{ $min_land_area_foncier }},
        //         'max': {{ $max_land_area_foncier }}
        //     },
        //         format: wNumb({
        //         decimals: 0,
        //         thousand: '',
        //         postfix: '',
        //     }),
        // }); 

        // var superficieValueMax = document.getElementById('superficie-value-max'),
        // superficieValueMin = document.getElementById('superficie-value-min');
    
        // // When the slider value changes, update the input and span
        // superficie.noUiSlider.on('update', function( values, handle ) {
        //     if ( handle ) {
        //         superficieValueMax.innerHTML = values[handle];
        //     } else {
        //         superficieValueMin.innerHTML = values[handle];
        //     }
        // }); 
        // fin superficie range slider
        // fin Foncier

        // Industriel
        // prix slider
        var prixInd = document.getElementById('prixInd');
        noUiSlider.create(prixInd, {
            // start: [{{ $min_price_industriel?($min_price_industriel!==$max_price_industriel?$min_price_industriel:0):0 }}, 10000000],
            start: [0, 10000000],
            step: 50000,
            connect: true,
            tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
            range: range_all_sliders,
            format: wNumb({
                decimals: 0,
                thousand: '',
                postfix: '',
            }),
        }); 

        var prixValueMaxInd = document.getElementById('prix-ind-value-max'),
        prixValueMinInd = document.getElementById('prix-ind-value-min'),
        indPriceMin = $('#industriel_price_min'),
        indPriceMax = $('#industriel_price_max');

        // When the slider value changes, update the input and span
        prixInd.noUiSlider.on('update', function( values, handle ) {
            if ( handle ) {
                val = values[handle]>10000000?'+ '+new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'USD' }).format(10000000):new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'USD' }).format(values[handle]);
                prixValueMaxInd.innerHTML = val;
                indPriceMax.val(values[handle]);
            } else {
                prixValueMinInd.innerHTML = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'USD' }).format(values[handle]);
                indPriceMin.val(values[handle]);
            }
        }); 
        // fin prix slider
        // fin Industriel

        // Commercial
        // prix slider
        var prixComm = document.getElementById('prixComm');
        noUiSlider.create(prixComm, {
            // start: [{{ $min_price_commercial?($min_price_commercial!==$max_price_commercial?$min_price_commercial:0):0 }}, {{ $max_price_commercial?$max_price_commercial:1 }}],
            start: [0, 10000000],
            step: 50000,
            connect: true,
            tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
            range: range_all_sliders,
            format: wNumb({
                decimals: 0,
                thousand: '',
                postfix: '',
            }),
        }); 

        var prixValueMaxCom = document.getElementById('prix-comm-value-max'),
        prixValueMinCom = document.getElementById('prix-comm-value-min'),
        commPriceMin = $('#commercial_price_min'),
        commPriceMax = $('#commercial_price_max');
    
        // When the slider value changes, update the input and span
        prixComm.noUiSlider.on('update', function( values, handle ) {
            if ( handle ) {
                val = values[handle]>10000000?'+ '+new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'USD' }).format(10000000):new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'USD' }).format(values[handle]);
                prixValueMaxCom.innerHTML = val;
                commPriceMax.val(values[handle]);
            } else {
                prixValueMinCom.innerHTML = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'USD' }).format(values[handle]);
                commPriceMin.val(values[handle]);
            }
        }); 
        // fin prix slider

        // commercial area range slider
        var areaComm = document.getElementById('areaComm');
        noUiSlider.create(areaComm, {
            // start: [{{ $min_area_commercial?($min_area_commercial!==$max_area_commercial?$min_area_commercial:0):0 }}, {{ $max_area_commercial?$max_area_commercial:1 }}],
            start: [0, 200],
            step: 20,
            connect: true,
            tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
            range: {
                'min': [0],
                '50%': [200,200],
                'max': [220]
                // 'min': {{ $min_area_commercial?($min_area_commercial!==$max_area_commercial?$min_area_commercial:0):0 }},
                // 'max': {{ $max_area_commercial?$max_area_commercial:1 }}
            },
            format: wNumb({
                decimals: 0,
                thousand: '',
                postfix: '',
            }),
        }); 

        var areaValueMax = document.getElementById('area-comm-value-max'),
        areaValueMin = document.getElementById('area-comm-value-min'), 
        commAreaMin = $('#commercial_area_min'),
        commAreaMax = $('#commercial_area_max');
    
        // When the slider value changes, update the input and span
        areaComm.noUiSlider.on('update', function( values, handle ) {
            if ( handle ) {
            val = values[handle]>200?'+ 200':values[handle];
            areaValueMax.innerHTML = val + ' m²';
             commAreaMax.val(values[handle]);
            } else {
             areaValueMin.innerHTML = values[handle];
             commAreaMin.val(values[handle]);
            }
        }); 
        // fin commercial area range slider
        // fin Commercial

    </script>

{{-- Autocompletion google map --}}
    <script>
    // This sample uses the Autocomplete widget to help the user select a
    // place, then it retrieves the address components associated with that
    // place, and then it populates the form fields with those details.
    // This sample requires the Places library. Include the libraries=places
    // parameter when you first load the API. 
    let placeSearch;
    let autocomplete;
    let autocomplete2;
    var input;
    const componentForm = {
        locality: "long_name",
        administrative_area_level_1: "short_name",
        administrative_area_level_2: "short_name",
    };

    function myFunction() {
        return input = document.activeElement.id;
    }

    var stateBounds={
        cta: ["-35.473469","149.012375"],
        nt: ["-19.491411","132.550964"],
        vic: ["-37.020100","144.964600"],
        sa: ["-30.000233","136.209152"],
        wa: ["-25.042261","117.793221"],
        qld: ["-20.917574","142.702789"],
        nsw: ["-31.840233","145.612793"],
    };

    function getStateBounds(state) {
        return new google.maps.LatLngBounds(
          new google.maps.LatLng(stateBounds[state][0], 
                                 stateBounds[state][1])
        ); 
    }

    function initMap() {
        var options = {
            types: ["(regions)"],
            componentRestrictions: {country: "au"},
            bounds: getStateBounds('vic'),              //à continuer
        };
        
        var options2 = {
            types: ["(cities)"],
            componentRestrictions: {country: "au"},
            bounds: getStateBounds('vic'),              //à continuer
        };

        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.
        autocomplete = new google.maps.places.Autocomplete(document.getElementById("administrative_area_level_2"),options);

        autocomplete2 = new google.maps.places.Autocomplete(document.getElementById("locality"),options2);
        // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.
        autocomplete.setFields(["address_component"]);
        autocomplete2.setFields(["address_component"]);
        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        autocomplete.addListener("place_changed", fillInAddress);
        autocomplete2.addListener("place_changed", fillInAddress);

        // delimite contry autocomplete
        // autocomplete.setComponentRestrictions({'country': ['au']});
        // autocomplete2.setComponentRestrictions({'country': ['au']});
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        const place = input!=='locality'?autocomplete.getPlace():autocomplete2.getPlace();

        for (const component in componentForm) {
            document.getElementById(component).value = "";
            document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.
        for (const component of place.address_components) {
        const addressType = component.types[0];

        if (componentForm[addressType]) {
            const val = component[componentForm[addressType]];
            if(addressType !== "administrative_area_level_1"){
            document.getElementById(addressType).value = val;
            }else{
            $('#administrative_area_level_1 option[value="'+val+'"]').prop('selected', true);
            }
        }
        }
    }

    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position) => {
            const geolocation = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
            };
            const circle = new google.maps.Circle({
            center: geolocation,
            radius: position.coords.accuracy,
            });
            autocomplete.setBounds(circle.getBounds());
        });
        }
    }

    // Initialize input after State selected
    $('#administrative_area_level_1').on('change',function(){
        $('input[name=city').val('');
        $('input[name=suburb').val('');
    })

    // function select typeFonc
    // $('#foncier').on('change','#typeFonc',function(){
    //     var type_id = $(this).val();
    //     var select_agri = $('#agricole');   

    //     if(type_id==16){
    //         return select_agri.removeAttr('disabled');
    //     }

    //     select_agri.find('option:eq(0)').prop('selected', true);
    //     return select_agri.attr('disabled','disabled');
    // })

    // function select unit of measure
    $('#foncier').on('change','#unite',function(){
        var val = $(this).val();
        var area_m = new Array('50','100','150','200','250','300','350','400','500','750','1000','1500','2000','3000','5000','10000','20000');
        var area_hect = new Array('1','5','10','25','50','100','200','300','400','500','1000','5000','5000+');
        var unite_min = $('#unite_min');
        var unite_max = $('#unite_max');

        // enabled area select
        $('#unite_min').removeAttr('disabled');
        $('#unite_max').removeAttr('disabled');
        
        // dont remove first option on select 
        unite_min.find('option').not(':first').remove();
        unite_max.find('option').not(':first').remove();
        
        if(val==1){
            for(var i=0;i<area_m.length;i++){
                unite_min.append('<option>'+area_m[i]+'</option>');
                unite_max.append('<option>'+area_m[i]+'</option>');
            }
        }else{    
            for(var i=0;i<area_hect.length;i++){
                unite_min.append('<option>'+area_hect[i]+'</option>');
                unite_max.append('<option>'+area_hect[i]+'</option>');
            }
        }
    });

    $('.btnProd').click(function(){
        var myElement = $(this).attr('aria-controls');
        var myElementId = $('#'+myElement);
        var visibilite = myElementId.is(':visible');

        if(!visibilite){
            $('.'+myElement+'-input').removeAttr('disabled');
            return $('#prod').val(myElement);
        }

        $('.'+myElement+'-input').attr('disabled','disabled');
        return $('#prod').val('');
    });

    $('.btn-search-close').click(function(){
        var idSearch = $(this).val();
        var id = idSearch.split('-')[1];
        var datas = {
            'id' : id
        };

        $('#'+idSearch).remove();

        
        $.ajax({
            url:'{{ route("remove.search") }}',
            method: 'GET',
            data : datas,
            dataType : 'json',
            success: function(data){
                var res = data.res;
                if(res.length == 0){
                    $('.section-search').hide();
                }
            },
            error: function(){
                console.log('error');
            }
        });

    });

    $('.btn-search-save').click(function(){
        var datas = {
            'dt' : $(this).val(),
        };
        var thisEl = $(this);
        
        $.ajax({
            url:'{{ route("save.search") }}',
            method: 'GET',
            data : datas,
            dataType : 'json',
            success: function(data){
                var msg = data.msg;
                var status = data.status;

                if(status == 1){
                    location.href = "{{ route('login') }}";
                }

                $(thisEl).hide();
                console.log(msg);
            },
            error: function(e){
                console.log(e);
            }
        });

    });
    
    </script>
@endpush