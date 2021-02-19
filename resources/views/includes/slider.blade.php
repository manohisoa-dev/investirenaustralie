<!-- Home Banner -->
<section id="home" class="effect-section parallax" style="background-image: url({{ asset('images/slider/1.jpg') }});height: 42rem;">
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
                <button type="button" class="navbar-toggler collapsed " type="button" data-toggle="collapse" data-target="#collapseSearch" aria-expanded="false" aria-controls="collapseSearch" style="height:3.1rem;margin-top:-0.3rem;">
                    <span class="icon-bar"></span>
                </button>
                <div class="d-md-block h-btn m-35px-l col-lg-11">
                    <form class="d-flex flex-row m-5px-b p-1 white-bg input-group" action="{{route('c.search')}}" method="POST">
                        {{csrf_field()}}
                        <select id="administrative_area_level_1" class="form-control border-radius-0 border-1 m-15px-r" name="state">
                            <option value="{{isset($q)?$q:''}}" selected disabled>@lang('app.input.etat')</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->content }}">{{ trans('app.txt.'.$state->content) }} ({{ $state->content }})</option>
                            @endforeach
                        </select>
                        <input type="text" id="locality" name="city" class="form-control border-radius-0 border-1 m-15px-r" onFocus="geolocate()" placeholder="@lang('app.input.ville')" value="{{isset($q)?$q:''}}">
                        <input type="text" id="administrative_area_level_2" name="suburb" class="form-control border-radius-0 border-1 m-60px-r" placeholder="@lang('app.input.suburb')" value="{{isset($q)?$q:''}}">
                        <button class="m-btn m-btn-theme2nd flex-shrink-0" type="submit">@lang('app.input.recherche')</button>
                    </form>
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
            <div class="collapse m-150px-lr p-25px-tb" id="residentiel" style="margin:auto;">
                <div class="col-lg-12 row">
                    <div class="form-group mar-r-20 col-lg-6">
                        <select id="basic" class="form-control" name="type">
                            <option value="">@lang('app.input.type')</option>
                            @if(isset($types))
                                @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->title.' ('.$type->products()->where('products.status', 'published')->count().')'}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group mar-r-20 col-lg-6 col-md-12">
                        <select id="basic" class="form-control" name="location_type">
                            <option value="">@lang('app.input.localisation')</option>
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
                    <div class="form-group mar-r-20 col-lg-6">
                        <label for="property-geo">@lang('app.input.superficie') ( m<sup>2</sup> ) :</label>
                        <div class="pmd-range-slider" id="property-geo"></div>
                        <!-- Values -->                                     
                        <div class="row">
                            <div class="range-value col-sm-6 col-6">
                                <b><span id="property-geo-value-min"></span> m²</b>
                            </div>
                            <div class="range-value col-sm-6 col-6 text-right">
                                <b><span id="property-geo-value-max"></span> m²</b>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-12 row">
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
                        <label for="toillet">@lang('app.input.nbtoilette') :</label>
                        <div class="pmd-range-slider" id="toillet"></div>
                        <!-- Values -->                                     
                        <div class="row">
                            <div class="range-value col-sm-6 col-6">
                                <b><span id="toillet-value-min"></span></b>
                            </div>
                            <div class="range-value col-sm-6 col-6 text-right">
                                <b><span id="toillet-value-max"></span></b>
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
                </div>
            </div>
            <!-- fin residentiel -->

            <!-- foncier --> 
            <div class="collapse m-100px-l p-25px-tb" id="foncier">
                <div class="col-lg-12 row">
                    <div class="form-group mar-r-20 col-lg-6">
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
                    <div class="form-group mar-r-20 col-lg-6">
                        <label for="superficie">@lang('app.input.superficie') (m2) :</label>
                        <div class="pmd-range-slider" id="superficie"></div>
                        <!-- Values -->                                     
                        <div class="row">
                            <div class="range-value col-sm-6 col-6">
                                <b><span id="superficie-value-min"></span> m²</b>
                            </div>
                            <div class="range-value col-sm-6 col-6 text-right">
                                <b><span id="superficie-value-max"></span> m²</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- fin foncier -->

            <!-- industriel -->
            <div class="collapse m-100px-l p-25px-tb" id="industriel">
                <div class="col-lg-12 row">
                    <div class="form-group mar-r-20 col-lg-6">
                        <h3>@lang('app.input.menuindustriel')</h3>
                        <p>@lang('app.input.menuindustriel.content')</p> 
                    </div>
                </div><!-- end search-row -->
            </div>
            <!-- fin industriel -->

            <!-- commercial -->
            <div class="collapse m-100px-l p-25px-tb" id="commercial">
                <div class="col-lg-12 row">
                    <div class="form-group mar-r-20 col-lg-6">
                        <h3>@lang('app.input.menucommercial')</h3>
                        <p>@lang('app.input.menucommercial.content')</p>
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

        // price range slider
        var priceRange = document.getElementById('price-range1');
        noUiSlider.create(priceRange, {
            start: [100000, 10000000],
            connect: true,
            tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
            range: {
                'min': 100000,
                'max': 10000000
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

        // property geo range slider
        var propertyGeo = document.getElementById('property-geo');
        noUiSlider.create(propertyGeo, {
            start: [50, 450],
            connect: true,
            tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
            range: {
                'min': 50,
                'max': 1000
            },
                format: wNumb({
                decimals: 0,
                thousand: '',
                postfix: '',
            }),
        }); 

        var porpertyGeoValueMax = document.getElementById('property-geo-value-max'),
        porpertyGeoValueMin = document.getElementById('property-geo-value-min');
    
        // When the slider value changes, update the input and span
        propertyGeo.noUiSlider.on('update', function( values, handle ) {
            if ( handle ) {
                porpertyGeoValueMax.innerHTML = values[handle];
            } else {
                porpertyGeoValueMin.innerHTML = values[handle];
            }
        }); 
        // fin property geo range slider

        // bathrooms range slider
        var bathrooms = document.getElementById('bathrooms');
        noUiSlider.create(bathrooms, {
            start: [2, 5],
            connect: true,
            tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
            range: {
                'min': 1,
                'max': 10
            },
                format: wNumb({
                decimals: 0,
                thousand: '',
                postfix: '',
            }),
        }); 

        var bathroomsValueMax = document.getElementById('bathrooms-value-max'),
        bathroomsValueMin = document.getElementById('bathrooms-value-min');
    
        // When the slider value changes, update the input and span
        bathrooms.noUiSlider.on('update', function( values, handle ) {
            if ( handle ) {
                bathroomsValueMax.innerHTML = values[handle];
            } else {
                bathroomsValueMin.innerHTML = values[handle];
            }
        }); 
        // fin bathrooms range slider

        // bedrooms range slider
        var bedrooms = document.getElementById('bedrooms');
        noUiSlider.create(bedrooms, {
            start: [2, 5],
            connect: true,
            tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
            range: {
                'min': 1,
                'max': 10
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

        // toillet range slider
        var toillet = document.getElementById('toillet');
        noUiSlider.create(toillet, {
            start: [2, 5],
            connect: true,
            tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
            range: {
                'min': 1,
                'max': 10
            },
                format: wNumb({
                decimals: 0,
                thousand: '',
                postfix: '',
            }),
        }); 

        var toilletValueMax = document.getElementById('toillet-value-max'),
        toilletValueMin = document.getElementById('toillet-value-min');
    
        // When the slider value changes, update the input and span
        toillet.noUiSlider.on('update', function( values, handle ) {
            if ( handle ) {
                toilletValueMax.innerHTML = values[handle];
            } else {
                toilletValueMin.innerHTML = values[handle];
            }
        }); 
        // fin toillet range slider

        // park range slider
        var park = document.getElementById('park');
        noUiSlider.create(park, {
            start: [2, 5],
            connect: true,
            tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
            range: {
                'min': 1,
                'max': 10
            },
                format: wNumb({
                decimals: 0,
                thousand: '',
                postfix: '',
            }),
        }); 

        var parkValueMax = document.getElementById('park-value-max'),
        parkValueMin = document.getElementById('park-value-min');
    
        // When the slider value changes, update the input and span
        park.noUiSlider.on('update', function( values, handle ) {
            if ( handle ) {
                parkValueMax.innerHTML = values[handle];
            } else {
                parkValueMin.innerHTML = values[handle];
            }
        }); 
        // fin park range slider

        // prix slider
        var prix = document.getElementById('prix');
        noUiSlider.create(prix, {
            start: [100000, 10000000],
            connect: true,
            tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
            range: {
                'min': 100000,
                'max': 10000000
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

        // superficie range slider
        var propertyGeo = document.getElementById('superficie');
        noUiSlider.create(superficie, {
            start: [50, 450],
            connect: true,
            tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
            range: {
                'min': 50,
                'max': 1000
            },
                format: wNumb({
                decimals: 0,
                thousand: '',
                postfix: '',
            }),
        }); 

        var superficieValueMax = document.getElementById('superficie-value-max'),
        superficieValueMin = document.getElementById('superficie-value-min');
    
        // When the slider value changes, update the input and span
        superficie.noUiSlider.on('update', function( values, handle ) {
            if ( handle ) {
                superficieValueMax.innerHTML = values[handle];
            } else {
                superficieValueMin.innerHTML = values[handle];
            }
        }); 
        // fin superficie range slider

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
    const componentForm = {
        locality: "long_name",
        administrative_area_level_1: "short_name",
        administrative_area_level_2: "short_name",
    };

    function initAutocomplete() {

        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
        // document.getElementById("autocomplete"),
        document.getElementById("locality"),
        { types: ["geocode"] }
        );
        // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.
        autocomplete.setFields(["address_component"]);
        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        autocomplete.addListener("place_changed", fillInAddress);


    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        const place = autocomplete.getPlace();

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
    </script>
@endpush