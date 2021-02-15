@extends('admin.layouts.app')
@section('breadcrumb')
   @include('layouts.breadcrumbs')
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="ibox ">
			<div class="ibox-title">
				<h5>@lang('app.location')</h5>
			</div>
			<div class="ibox-content">
				<div id="map"></div>
				<div class="hr-line-dashed"></div>
				@include('includes.alerts')
				<form class="form-horizontal" role="form" method="post" action="{{route('admin.location.edit')}}">
					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">					
					<input type="hidden" name="formatted" id="formatted">
					<div class="form-group">
						<label>@lang('app.latitude')</label> 
						<input type="text" name="latitude" class="form-control" id="latitude" placeholder="Latitude" value="{{old('latitude')?old('latitude'):$location?$location->latitude:''}}">
					</div>
					<div class="form-group">
						<label>@lang('app.longitude')</label> 
						<input type="text" name="longitude" class="form-control" id="longitude" placeholder="Longitude" value="{{old('longitude')?old('longitude'):$location?$location->longitude:''}}">
					</div>
					<div class="form-group">
						<label>@lang('app.country')</label> 
						<input type="text" name="country" class="form-control" id="country" placeholder="country" value="{{old('country')?old('country'):$location?$location->country:''}}">
					</div>
					<div class="form-group">
						<label>@lang('app.area_level_1')</label> 
						<input type="text" name="area_level_1" class="form-control" id="area_level_1" placeholder="state" value="{{old('state')?old('state'):$location?$location->state:''}}">
					</div>
					<div class="form-group">
						<label>@lang('app.area_level_2')</label> 
						<input type="text" name="locality" class="form-control" id="locality" placeholder="@lang('app.locality')" value="{{old('locality')?old('locality'):$location?$location->locality:''}}">
					</div>
					<div class="form-group">
						<label>@lang('app.route')</label> 
						<input type="text" name="route" class="form-control" id="route" placeholder="@lang('app.route')" value="{{old('route')?old('route'):$location?$location->route:''}}">
					</div>
					<div class="form-group">
						<label>@lang('app.postalCode')</label> 
						<input type="text" name="postalCode" class="form-control" id="postalCode" placeholder="@lang('app.postalCode')" value="{{old('postalCode')?old('postalCode'):$location?$location->postalCode:''}}">
					</div>
					<div class="hr-line-dashed"></div>
					<button type="submit" class="btn btn-danger">@lang('app.btn.save')</button>
				</form>
			</div>
		</div>
	</div>
@endsection
@section('script')
<script>
    var _map;
    var _geocoder;
    var _marker;
    var _lat = {{$location?floatval($location->latitude):-25.647467468105795}};
    var _long = {{$location?floatval($location->longitude):146.89921517372136}};
    var _longInput = document.getElementById("longitude");
    var _latInput = document.getElementById("latitude");
    
    var _formattedInput = document.getElementById("formatted");
    var _countryInput = document.getElementById("country");
    var _level_1Input = document.getElementById("area_level_1");
    var _level_2Input = document.getElementById("area_level_2");
    var _localityInput = document.getElementById("locality");
    var _routeInput = document.getElementById("route");
    var _postalInput = document.getElementById("postalCode");
    
    
    function initMap() {
        
        _map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: _lat, lng:  _long},
            zoom: 2
        });
        
        _marker = new google.maps.Marker({
          position: {lat: _lat, lng: _long},
          draggable:true,
          map: _map
        });

        google.maps.event.addListener(_map, 'click', function(event) {
             var lat = _latInput.value = event.latLng.lat();
             var lng = _longInput.value = event.latLng.lng();
             placeMarkerAndPanTo(event.latLng);
             loadGeocode(event.latLng);
        });

        _marker.addListener('dragend', function() {
             var lat = _latInput.value = _marker.getPosition().lat();
             var lng = _longInput.value = _marker.getPosition().lng();
             loadGeocode(_marker.getPosition());
        });
        
        _geocoder = new google.maps.Geocoder();
        loadGeocode({lat: _lat, lng: _long});
    }

    function placeMarkerAndPanTo(latLng) {
        _marker.setMap(null);
        _marker = new google.maps.Marker({
            position: latLng,
            draggable:true,
            map: _map
        });
        _map.panTo(latLng);
    }

    function loadGeocode(latLng) {
        _geocoder.geocode({'location': latLng}, function(results, status){
            console.log(results);
            if (status === 'OK') {
                if (results[0]) {
                    _formattedInput.value = results[0].formatted_address;
                    for(var i = 0; i< results[0].address_components.length; i++){
                        var info = results[0].address_components[i];
                        var label = info.long_name;
                        var types = info.types;
                        for(var j = 0; j<types.length; j++){
                            if(types[j]=='country'){
                                _countryInput.value = label;
                                break;
                            }
                            if(types[j]=='administrative_area_level_1'){
                                _level_1Input.value = label;
                                break;
                            }
                            if(types[j]=='administrative_area_level_2'){
                                _level_2Input.value = label;
                                break;
                            }
                            if(types[j]=='route'){
                                _routeInput.value = label;
                                break;
                            }
                            if(types[j]=='locality'){
                                _localityInput.value = label;
                                break;
                            }
                            if(types[j]=='postal_code'){
                                _postalInput.value = label;
                                break;
                            }
                        }
                    }
                } else {
                    window.alert('No results found');
                }
            } else {
              window.alert('Geocoder failed due to: ' + status);
            }
        });
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtRuDbjjrHacZ6EqZySofNueLBLkrNxwI&callback=initMap"></script>
@endsection