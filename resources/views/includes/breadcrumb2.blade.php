<!-- Page Title -->
@php
if(Request::segment(2) != ''){
	$menuInfo = \App\Models\Menu::where('libelle', Request::segment(2))->first();
	if(!empty($menuInfo)){
		$photo_base = $menuInfo->photo;
		if($photo_base != ''){
			$image_fond = asset('images/slider/'.$photo_base);
		}else{
			$image_fond = asset('images/slider/1.jpg');
		}
	}else{
		$image_fond = asset('images/slider/1.jpg');
	}
}else{
	$image_fond = asset('images/slider/1.jpg');
}
@endphp
<section class="section bg-center bg-cover bg-fixed effect-section" style="background-image: url({{ $image_fond }});">
    <div class="mask theme-bg opacity-5"></div>
    <div class="container">
        <div class="row justify-content-center p-50px-t">
            <div class="col-lg-8 text-center">
                <h2 class="white-color h1 m-20px-b">{{ trans('app.txt.'.str_replace(' ','_',strtolower($cat))) }}</h2>
                <ol class="breadcrumb white justify-content-center">
                    <li><a href="{{ route('home') }}">@lang('app.home')</a></li>
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
                <button type="button" class="navbar-toggler collapsed " type="button" data-toggle="collapse" data-target="#collapseSearch" aria-expanded="false" aria-controls="collapseSearch" style="height:3.1rem;margin-top:-0.3rem;">
                    <span class="icon-bar"></span>
                </button>
                <div class="d-md-block h-btn m-35px-l col-lg-11">
                    <form class="d-flex flex-row m-5px-b p-1 white-bg input-group" action="{{route('c.search')}}" method="POST">
                        {{csrf_field()}}
                        <select id="administrative_area_level_1" class="form-control border-radius-0 border-1 m-15px-r" name="state">
                            <option value="{{isset($q)?$q:''}}" selected disabled>@lang('app.input.etat')</option>
                            @foreach (App\Models\State::all() as $state)
                                <option value="{{ $state->content }}">{{ trans('app.txt.'.$state->content) }} ({{ $state->content }})</option>
                            @endforeach
                        </select>
                        <input type="text" id="administrative_area_level_2" name="city" class="form-control border-radius-0 border-1 m-15px-r" onFocus="geolocate()" placeholder="@lang('app.input.ville')" value="{{isset($q)?$q:''}}">
                        <input type="text" id="locality" name="suburb" class="form-control border-radius-0 border-1 m-60px-r" placeholder="@lang('app.input.suburb')" value="{{isset($q)?$q:''}}">
                        <button class="m-btn m-btn-theme2nd flex-shrink-0" type="submit">@lang('app.input.recherche')</button>
                    </form>
                </div>
            </div>
            <div class="checkbox m-100px-l p-10px-l">
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="newsletter" class="custom-control-input" id="shop-notification-1" checked="checked">
                    <label class="custom-control-label" for="shop-notification-1">@lang('app.input.surround_suburbs')</label>
                </div>
            </div>
        </div>

        <div class="collapse" id="collapseSearch">
          <div class="card card-body">
            <div class="search-toggle tab-content p-15px-tb row col-lg-12" style="margin:auto;">
                <a class="m-btn m-btn-theme col-lg-3 col-md-12 border" data-toggle="collapse" href="#residentiel" role="button" aria-expanded="false" aria-controls="residentiel">
                <i class="fa fa-home" aria-hidden="true">&nbsp;@lang('app.btn.residentiel')</i></a>
                <a class="m-btn m-btn-theme col-lg-3 col-md-12 border" data-toggle="collapse" href="#foncier" role="button" aria-expanded="false" aria-controls="foncier">
                <i class="fas fa-map" aria-hidden="true">&nbsp;@lang('app.btn.foncier')</i></a>
                <a class="m-btn m-btn-theme col-lg-3 col-md-12 border" data-toggle="collapse" href="#industriel" role="button" aria-expanded="false" aria-controls="industriel">
                <i class="fa fa-industry" aria-hidden="true">&nbsp;@lang('app.btn.industriel')</i></a>
                <a class="m-btn m-btn-theme col-lg-3 col-md-12 border" data-toggle="collapse" href="#commercial" role="button" aria-expanded="false" aria-controls="commercial">
                <i class="fa fa-building" aria-hidden="true">&nbsp;@lang('app.btn.commercial')</i></a>
            </div>
            <!-- residentiel -->
            <div class="collapse m-20px-l p-25px-tb" id="residentiel">
                <div class="col-lg-12 row">
                    <div class="form-group mar-r-20 col-lg-6">
                        <select id="type" class="form-control" name="type">
                            <option value="" selected disabled>@lang('app.input.type_de_bien')</option>
                            @if(isset($typesRes))
                                @foreach($typesRes as $type)
                                    <option value="{{$type->id}}">{{$type->title.' ('.$type->products()->where('products.status', 'published')->count().')'}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group mar-r-20 col-lg-6">
                        <select id="anciennete" class="form-control" name="anciennete">
                            <option value="" selected disabled>@lang('app.input.anciennete')</option>
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
                            <option value="" selected disabled>@lang('app.input.localisation')</option>
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
                            </div>
                            <div class="range-value col-sm-6 col-6 text-right">
                                <b><span id="value-max"></span></b>
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
                            </div>
                            <div class="range-value col-sm-6 col-6 text-right">
                                <b><span id="bedrooms-value-max"></span></b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- fin residentiel -->

            <!-- foncier --> 
            <div class="collapse m-20px-l p-25px-tb" id="foncier">
                <div class="col-lg-12 row">
                    <div class="form-group mar-r-20 col-lg-6">
                        <select id="typeFonc" class="form-control" name="typeFonc">
                            <option value="" selected disabled>@lang('app.input.type_de_bien')</option>
                            @if(isset($typesFonc))
                                @foreach($typesFonc as $type)
                                    <option value="{{$type->id}}">{{$type->title.' ('.$type->products()->where('products.status', 'published')->count().')'}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group mar-r-20 col-lg-6">
                        <select id="localisationFonc" class="form-control" name="localisationFonc">
                            <option value="" selected disabled>@lang('app.input.localisation')</option>
                            @if(isset($locationTypes))
                                @foreach($locationTypes as $locationType)
                                    <option value="{{$locationType->id}}">{{$locationType->title.' ('.$locationType->products()->where('products.status', 'published')->count().')'}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="col-lg-12 row">
                    <div class="form-group mar-r-20 col-lg-6">
                        <select id="agricole" class="form-control" name="agricole">
                            <option value="" selected disabled>@lang('app.input.secteur_agricole')</option>
                            @if(isset($agricoles))
                                @foreach($agricoles as $agricole)
                                    <option value="{{$agricole->id}}">{{$agricole->title.' ('.$agricole->products()->where('products.status', 'published')->count().')'}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group mar-r-20 col-lg-6">
                        <select id="unite" class="form-control" name="unite">
                            <option value="" selected disabled>@lang('app.input.unite_de_mesure')</option>
                            <option value="m²">m²</option>
                            <option value="m²">Hectare(s)</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-12 row">
                    <div class="form-group mar-r-20 col-lg-6">
                        <select id="unite_min" class="form-control" name="unite_min" disabled>
                            <option value="0" selected disabled>@lang('app.input.superficie') (min)</option>
                            <option value="50">50 m²</option>
                            <option value="100">100 m²</option>
                            <option value="150">150 m²</option>
                            <option value="200">200 m²</option>
                            <option value="250">250 m²</option>
                            <option value="300">300 m²</option>
                            <option value="350">350 m²</option>
                            <option value="400">400 m²</option>
                            <option value="500">500 m²</option>
                            <option value="750">750 m²</option>
                            <option value="1000">{{ number_format('1000', 0, '.', ' ') }} m²</option>
                            <option value="1500">{{ number_format('1500', 0, '.', ' ') }} m²</option>
                            <option value="2000">{{ number_format('2000', 0, '.', ' ') }} m²</option>
                            <option value="3000">{{ number_format('3000', 0, '.', ' ') }} m²</option>
                            <option value="5000">{{ number_format('5000', 0, '.', ' ') }} m²</option>
                            <option value="10000">{{ number_format('10000', 0, '.', ' ') }} m²</option>
                            <option value="20000">{{ number_format('20000', 0, '.', ' ') }} m²</option>
                        </select>
                    </div>
                    <div class="form-group mar-r-20 col-lg-6">
                        <select id="unite_max" class="form-control" name="unite_max" disabled>
                            <option value="" selected disabled>@lang('app.input.superficie') (max)</option>
                            <option value="0" selected disabled>@lang('app.input.superficie') (min)</option>
                            <option value="50">50 m²</option>
                            <option value="100">100 m²</option>
                            <option value="150">150 m²</option>
                            <option value="200">200 m²</option>
                            <option value="250">250 m²</option>
                            <option value="300">300 m²</option>
                            <option value="350">350 m²</option>
                            <option value="400">400 m²</option>
                            <option value="500">500 m²</option>
                            <option value="750">750 m²</option>
                            <option value="1000">{{ number_format('1000', 0, '.', ' ') }} m²</option>
                            <option value="1500">{{ number_format('1500', 0, '.', ' ') }} m²</option>
                            <option value="2000">{{ number_format('2000', 0, '.', ' ') }} m²</option>
                            <option value="3000">{{ number_format('3000', 0, '.', ' ') }} m²</option>
                            <option value="5000">{{ number_format('5000', 0, '.', ' ') }} m²</option>
                            <option value="10000">{{ number_format('10000', 0, '.', ' ') }} m²</option>
                            <option value="20000">{{ number_format('20000', 0, '.', ' ') }} m²</option>
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
                            </div>
                            <div class="range-value col-sm-6 col-6 text-right">
                                <b><span id="prix-value-max"></span></b>
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
                            <option value="" selected disabled>@lang('app.input.type_de_bien')</option>
                            @if(isset($typesInd))
                                @foreach($typesInd as $type)
                                    <option value="{{$type->id}}">{{$type->title.' ('.$type->products()->where('products.status', 'published')->count().')'}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group mar-r-20 col-lg-6">
                        <select id="localisationInd" class="form-control" name="localisationInd">
                            <option value="" selected disabled>@lang('app.input.secteur_industriel')</option>
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
                            </div>
                            <div class="range-value col-sm-6 col-6 text-right">
                                <b><span id="prix-ind-value-max"></span></b>
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
                            <option value="" selected disabled>@lang('app.input.type_de_bien')</option>
                            @if(isset($typesComm))
                                @foreach($typesComm as $type)
                                    <option value="{{$type->id}}">{{$type->title.' ('.$type->products()->where('products.status', 'published')->count().')'}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group mar-r-20 col-lg-6">
                        <select id="secteurComm" class="form-control" name="secteurComm">
                            <option value="" selected disabled>@lang('app.input.secteur_commercial')</option>
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
                        <select id="parkingClient" class="form-control" name="parkingClient">
                            <option value="" selected disabled>@lang('app.input.parking_client')</option>
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
                            </div>
                            <div class="range-value col-sm-6 col-6 text-right">
                                <b><span id="prix-comm-value-max"></span></b>
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
                            </div>
                            <div class="range-value col-sm-6 col-6 text-right">
                                <b><span id="area-comm-value-max"></span></b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- fin commercial -->
          </div>
        </div>

    </div>
</div>
<!-- End Section -->

@push('script')

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
        // Residential
        // price range slider
        var priceRange = document.getElementById('price-range1');
        noUiSlider.create(priceRange, {
            start: [{{ $min_price_residentiel }}, {{ $max_price_residentiel }}],
            connect: true,
            tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
            range: {
                'min': {{ $min_price_residentiel }},
                'max': {{ $max_price_residentiel }}
            },
                format: wNumb({
                decimals: 0,
                thousand: '',
                postfix: '',
            }),
        }); 

        var valueMax = document.getElementById('value-max'),
        valueMin = document.getElementById('value-min');
    
        // When the slider value changes, update the input and span
        priceRange.noUiSlider.on('update', function( values, handle ) {
            if ( handle ) {
                valueMax.innerHTML = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'USD' }).format(values[handle]);
            } else {
                valueMin.innerHTML = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'USD' }).format(values[handle]);
            }
        }); 
        // fin price range slider

                // bedrooms range slider
                var bedrooms = document.getElementById('bedrooms');
        noUiSlider.create(bedrooms, {
            start: [{{ $min_bedrooms_residentiel }}, {{ $max_bedrooms_residentiel }}],
            connect: true,
            tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
            range: {
                'min': {{ $min_bedrooms_residentiel }},
                'max': {{ $max_bedrooms_residentiel }}
            },
                format: wNumb({
                decimals: 0,
                thousand: '',
                postfix: '',
            }),
        }); 

        var bedroomsValueMax = document.getElementById('bedrooms-value-max'),
        bedroomsValueMin = document.getElementById('bedrooms-value-min');
    
        // When the slider value changes, update the input and span
        bedrooms.noUiSlider.on('update', function( values, handle ) {
            if ( handle ) {
                bedroomsValueMax.innerHTML = values[handle];
            } else {
                bedroomsValueMin.innerHTML = values[handle];
            }
        }); 
        // fin bedrooms range slider
        // fin Residential
        
        // Foncier
        // prix slider
        var prix = document.getElementById('prix');
        noUiSlider.create(prix, {
            start: [{{ $min_price_foncier }}, {{ $max_price_foncier }}],
            connect: true,
            tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
            range: {
                'min': {{ $min_price_foncier }},
                'max': {{ $max_price_foncier }}
            },
                format: wNumb({
                decimals: 0,
                thousand: '',
                postfix: '',
            }),
        }); 

        var prixValueMax = document.getElementById('prix-value-max'),
        prixValueMin = document.getElementById('prix-value-min');
    
        // When the slider value changes, update the input and span
        prix.noUiSlider.on('update', function( values, handle ) {
            if ( handle ) {
                prixValueMax.innerHTML = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'USD' }).format(values[handle]);
            } else {
                prixValueMin.innerHTML = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'USD' }).format(values[handle]);
            }
        }); 
        // fin prix slider
        // fin Foncier

        // Industriel
        // prix slider
        var prix = document.getElementById('prixInd');
        noUiSlider.create(prix, {
            start: [{{ $min_price_industriel }}, {{ $max_price_industriel }}],
            connect: true,
            tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
            range: {
                'min': {{ $min_price_industriel }},
                'max': {{ $max_price_industriel }}
            },
                format: wNumb({
                decimals: 0,
                thousand: '',
                postfix: '',
            }),
        }); 

        var prixValueMax = document.getElementById('prix-ind-value-max'),
        prixValueMin = document.getElementById('prix-ind-value-min');
    
        // When the slider value changes, update the input and span
        prix.noUiSlider.on('update', function( values, handle ) {
            if ( handle ) {
                prixValueMax.innerHTML = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'USD' }).format(values[handle]);
            } else {
                prixValueMin.innerHTML = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'USD' }).format(values[handle]);
            }
        }); 
        // fin prix slider
        // fin Industriel

        // Commercial
        // prix slider
        var prix = document.getElementById('prixComm');
        noUiSlider.create(prix, {
            start: [{{ $min_price_commercial }}, {{ $max_price_commercial }}],
            connect: true,
            tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
            range: {
                'min': {{ $min_price_commercial }},
                'max': {{ $max_price_commercial }}
            },
                format: wNumb({
                decimals: 0,
                thousand: '',
                postfix: '',
            }),
        }); 

        var prixValueMax = document.getElementById('prix-comm-value-max'),
        prixValueMin = document.getElementById('prix-comm-value-min');
    
        // When the slider value changes, update the input and span
        prix.noUiSlider.on('update', function( values, handle ) {
            if ( handle ) {
                prixValueMax.innerHTML = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'USD' }).format(values[handle]);
            } else {
                prixValueMin.innerHTML = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'USD' }).format(values[handle]);
            }
        }); 
        // fin prix slider

        // commercial area range slider
        var areaComm = document.getElementById('areaComm');
        noUiSlider.create(areaComm, {
            start: [{{ $min_area_commercial }}, {{ $max_area_commercial }}],
            connect: true,
            tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
            range: {
                'min': {{ $min_area_commercial }},
                'max': {{ $max_area_commercial }}
            },
                format: wNumb({
                decimals: 0,
                thousand: '',
                postfix: '',
            }),
        }); 

        var areaValueMax = document.getElementById('area-comm-value-max'),
     areaValueMin = document.getElementById('area-comm-value-min');
    
        // When the slider value changes, update the input and span
        areaComm.noUiSlider.on('update', function( values, handle ) {
            if ( handle ) {
             areaValueMax.innerHTML = values[handle];
            } else {
             areaValueMin.innerHTML = values[handle];
            }
        }); 
        // fin commercial area range slider
        // fin Commercial

    </script>

   {{-- Autocompletion google map --}}
   <script
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRj7J_sOaCmFfSFNvUL7Z-NX3uUvG_FTA&callback=initAutocomplete&libraries=places&v=weekly"
   defer
   ></script>
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

   function initAutocomplete() {
       var options = {
           types: ["(regions)"],
           componentRestrictions: {country: "au"}
       };
       
       var options2 = {
           types: ["(cities)"],
           componentRestrictions: {country: "au"}
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
       autocomplete.setComponentRestrictions({'country': ['au']});
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
   </script>
@endpush