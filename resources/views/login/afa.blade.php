@extends('layouts.app')


@section('content')

<!-- Page Title -->
@component('includes.breadcrumb')
    @lang('inscriptionafa')
@endcomponent
<!-- Section -->
<style>
    #map{
        height: 25rem;
    }

    #mapCanvas {
        width: 500px;
        height: 400px;
        float: left;
    }
    #infoPanel {
        float: left;
    }
    #infoPanel div {
        margin-bottom: 5px;
    }
</style>

<div class="main-slider-wrapper clearfix content corps p-100px-tb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="content-box-large">
                    <div class="main-slider-wrapper clearfix content corps gery"> 
                        <div id="slider"> 
                            <div class="container text-center"> 
                                <div class="jumbotron"> 
                                    <h2>@lang('app.form.register.afa.title')</h2> 
                                </div>                     
                            </div>                 
                        </div>             
                    </div>
                    <div id="content">
                        <div role="main">
                            <div id="breadcrumbs" class="group font-size-14">
                                <div id="entry" class="group">
                                    <div class="hasfloat aligncenter">
                                        <b>@lang('app.form.register.afa.desc')</b>
                                    </div>
                                    <div class="hasfloat">
                                    <form class="form-horizontal" role="form" method="post" action="{{route('register', ['role'=>'afa'])}}" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                        <input type="hidden" name="type" value="organization">
                                        <fieldset>
                                            <legend>Login Information</legend>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="name">Login *</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Votre nom d'utilisateur" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="email">Adresse Email *</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="you@exemple.com" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="language" class="col-sm-3 control-label" for="language">@lang('app.txt.langage') *</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="language" name="language">
                                                        <option value="fr">@lang('app.txt.fr')</option>
                                                        <option value="en">@lang('app.txt.en')</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>Business Details</legend>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="image"> @lang('app.txt.logo') *</label>
                                                <div class="input-group mb-3 col-md-9">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">@lang('app.txt.upload')</span>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input inputGroupFile" name="image" id="image">
                                                        <label class="custom-file-label inputGroupFileName" for="image">@lang('app.txt.choose_file')</label>
                                                    </div>
                                                </div>
                                                <span class="text-danger">{{ $errors->first('image') }}</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="orga_name" class="col-sm-3 control-label">Business Name *</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="orga_name" name="orga_name" placeholder="Business Name" required>
                                                    <span class="text-danger">{{ $errors->first('orga_name') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="orga_email" class="col-sm-3 control-label">Business Email *</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="orga_email" name="orga_email" placeholder="Business Email" required>
                                                    <span class="text-danger">{{ $errors->first('orga_email') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="orga_phone" class="col-sm-3 control-label">Business Phone *</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="orga_phone" name="orga_phone" placeholder="Business Phone" required>
                                                    <span class="text-danger">{{ $errors->first('orga_phone') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="orga_website" class="col-sm-3 control-label">Website URL *</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="orga_website" name="orga_website" placeholder="Business Website" required>
                                                    <span class="text-danger">{{ $errors->first('orga_website') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="orga_presentation" class="col-sm-3 control-label">Business Presentation *</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" id="orga_presentation" name="orga_presentation" placeholder="Business Presentation" rows="5"></textarea>
                                                    <span class="text-danger">{{ $errors->first('orga_presentation') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="orga_operation_state" class="col-sm-3 control-label">State of legal operation of your present office *</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" name="orga_operation_state">
                                                        <option value="0">@lang('app.select_state')</option>
                                                        @foreach($states as $state)
                                                        <option value="{{$state->id}}"> {{$state->content}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger">{{ $errors->first('orga_operation_state') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="orga_operation_range" class="col-sm-3 control-label">Range of operation of your present office *</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="orga_operation_range" id="orga_operation_range">
                                                        <option value="10"> 10km</option>
                                                        <option value="25"> 25km</option>
                                                        <option value="50"> 50km</option>
                                                        <option value="100"> 100km</option>
                                                        <option value="250"> 250km</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend> Locality Information </legend>
                                            <div class="form-group">
                                                <label for="country" class="col-sm-3 control-label">Pays *</label>
                                                <div class="col-md-9">
                                                    <select class="form-control country-select" name="country">
                                                        <option value="0">@lang('app.select_country')</option>
                                                        @foreach($countries as $country)
                                                            @if($country->prefixPhone)
                                                                <option value="{{$country->id}}"> {{$country->content}} ({{$country->code}})</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="state">State *</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="area_level_1" id="area_level_1" >
                                                    <span class="text-danger">{{ $errors->first('area_level_1') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="locality">City *</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="locality" id="locality" required>
                                                    <span class="text-danger">{{ $errors->first('locality') }}</span>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group">
                                                <label for="route" class="col-sm-3 control-label">Street Address *</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="route" name="route" placeholder="Street Address" required>
                                                    <span class="text-danger">{{ $errors->first('route') }}</span>
                                                </div>
                                            </div> --}}
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="postalCode">Post Code *</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="postalCode" id="postalCode" required>
                                                    <span class="text-danger">{{ $errors->first('postalCode') }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <input type="hidden" name="longitude" id="longitude">
                                                <input type="hidden" name="latitude" id="latitude">
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>Contact Details</legend>
                                            <div class="form-group">
                                                <label for="contact_name" class="col-sm-3 control-label">Contact Name *</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Contact Name" required>
                                                    <span class="text-danger">{{ $errors->first('contact_name') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="contact_email" class="col-sm-3 control-label">Contact Email *</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="contact_email" name="contact_email" placeholder="Contact Email" required>
                                                    <span class="text-danger">{{ $errors->first('contact_email') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="contact_phone" class="col-sm-3 control-label">Contact Phone *</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="contact_phone" name="contact_phone" placeholder="Contact Phone" required>
                                                    <span class="text-danger">{{ $errors->first('contact_phone') }}</span>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>CRM Provider</legend>
                                            <div class="form-group">
                                                <label for="crm_name" class="col-sm-3 control-label">CRM Provider Name *</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="crm_name" name="crm_name" placeholder="CRM Provider Name" required>
                                                    <span class="text-danger">{{ $errors->first('crm_name') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="crm_email" class="col-sm-3 control-label">CRM Provider Email *</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="crm_email" name="crm_email" placeholder="CRM Provider Email" required>
                                                    <span class="text-danger">{{ $errors->first('crm_email') }}</span>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <em class="help-block">@lang('app.form.required')</em>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9 p-25px-b">
                                                <button type="submit" class="m-btn m-btn-theme" id="btn_register">@lang('app.btn.register')</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="countrySelectModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content white-bg">
            <div class="modal-header border-radius-0" style="background-color: #AE4435 !important;">
                <h4 class="modal-title white-color">{{trans('app.txt.choose_position')}}</h4>
            </div>
            <div class="modal-body">
                <div id="map"></div>                  
                <div id="infoPanel"  class=" col-lg-12 border-top-1 border-color-gray m-25px-t p-15px-t">
                    <b>@lang('app.txt.marker.status') :</b>
                    <div id="markerStatus"><i>@lang('app.txt.marker.click_drag')</i></div>
                    <b>@lang('app.txt.marker.current_position'):</b>
                    <div id="info"></div>
                    <b>@lang('app.txt.marker.matching_address') :</b>
                    <div id="address"></div>
                </div>

            </div>
            <div class="modal-footer">
                <a type="button" class="pull-left m-btn m-btn-theme" data-dismiss="modal">@lang('app.btn.close')</a>
                <a type="button" class="pull-left m-btn m-btn-theme4rd" id="btn_save">@lang('app.btn.save')</a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script src="{{asset('js/myJs.js')}}"></script>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
    //fermeture du modal
    $("#custom-close").on('click', function() {
        $('#myModal').modal('hide');
    });
</script>
<script type="text/javascript">
    $('body').scrollspy({
        target: '#navbar-collapsible',
        offset: 50
    });
    $('a[href*=#]:not([href=#])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top - 50
                }, 1000);
                return false;
            }
        }
    });

</script>

<script>
    $('form').on('change','.country-select',function(){
        var country_id = $(this).val();

        if(country_id==12){
            $('#countrySelectModal').modal('show');
        }

        // renitialise localization info input
        $('#latitude').val('');
        $('#longitude').val('');
        $('#postalCode').val('');
        $('#locality').val('');
        $('#area_level_1').val('');
    })
</script>
<script type="text/javascript">
    var _map;
    var _lat = -25.363;
    var _long = 131.044;
    var geocoder;

    function initMap() {
        var myLatlng = new google.maps.LatLng(-25.363882,131.044922);
            geocoder = new google.maps.Geocoder();
        
        _map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: _lat, lng:  _long},
            zoom: 4
        });

        // Place a draggable marker on the map
        var marker = new google.maps.Marker({
            position: {lat: _lat, lng:  _long},
            map: _map,
            draggable:true,
            title:"{{ trans('app.txt.choose_position') }}"
        });

        // Get info with marker drag
        // Update current position info.
        updateMarkerPosition(myLatlng);
        geocodePosition(myLatlng);
        
        // Add dragging event listeners.
        google.maps.event.addListener(marker, 'dragstart', function() {
            updateMarkerAddress('{{ trans("app.txt.marker.dragging") }}...');
        });
        
        google.maps.event.addListener(marker, 'drag', function() {
            updateMarkerStatus('{{ trans("app.txt.marker.dragging") }}...');
            updateMarkerPosition(marker.getPosition());
        });
        
        google.maps.event.addListener(marker, 'dragend', function() {
            updateMarkerStatus('{{ trans("app.txt.marker.drag_ended") }}');
            geocodePosition(marker.getPosition());
        });
        
        
        // Onload handler to fire off the app.
        // google.maps.event.addDomListener(window, 'load', initialize);
        // End Get info with marker drag
    }
    
    function geocodePosition(pos) {
        geocoder.geocode({
            latLng: pos
        }, function(responses) {
            if (responses && responses.length > 0) {
            updateMarkerAddress(responses[0].formatted_address);
            } else {
            updateMarkerAddress("{{ trans('app.txt.marker.cannot_determine_address') }}");
            }
        });
    }
    
    function updateMarkerStatus(str) {
        document.getElementById('markerStatus').innerHTML = str;
    }
    
    function updateMarkerPosition(latLng) {
        document.getElementById('info').innerHTML = [
            latLng.lat(),
            latLng.lng()
        ].join(', ');
    }
    
    function updateMarkerAddress(str) {
        document.getElementById('address').innerHTML = str;
    }
</script>
<script type="text/javascript">
    $('#btn_save').click(function(){
        var latLong = $('#info').text();
        var adr = ($('#address').text()).split(',');
        var lat=0;long = 0;
        var state,postalCode,locality="";

        switch (adr.length) {
            case 3:
                var adrInfo = adr[1].split(' ');
                lat = latLong.split(',')[0];            
                long = latLong.split(',')[1];
                postalCode = adrInfo[(adrInfo.length)-1];
                state = adrInfo[(adrInfo.length)-2];

                // set locality
                for(var i=0;i<adrInfo.length-2;i++){
                    if(adrInfo[i].length !== 0){
                        locality+=adrInfo[i]+' ';
                    }
                }

                $('#countrySelectModal').modal('hide');

                break;

            case 2:
                var adrInfo = adr[0].split(' ');
                lat = latLong.split(',')[0];            
                long = latLong.split(',')[1];
                postalCode = adrInfo[(adrInfo.length)-1];
                state = adrInfo[(adrInfo.length)-2];

                // set locality
                for(var i=0;i<adrInfo.length-2;i++){
                    if(adrInfo[i].length !== 0){
                        locality+=adrInfo[i]+' ';
                    }
                }

                $('#countrySelectModal').modal('hide');
                
                break;
        
            default:
                alert("{{ trans('app.txt.choose_position_exacte') }}");
                break;
        }
        
        // set localisation input info
        $('#latitude').val(lat);
        $('#longitude').val(long);
        $('#postalCode').val(postalCode);
        $('#locality').val(locality);
        $('#area_level_1').val(state);
    });

</script>


<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRj7J_sOaCmFfSFNvUL7Z-NX3uUvG_FTA&callback=initMap"></script>
@endpush
