@extends('V2.admin.layouts.app')

@section('breadcrumb')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>@lang('app.profile')</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('V2/admin')}}">Accueil</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>@lang('app.profile')</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">
		<!-- profil -->
		<div class="ibox ">
			<div class="ibox-title">
				<h5><i class="fa fa-user-circle" aria-hidden="true"></i> Profile</h5>
				<div class="ibox-tools">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
				</div>
			</div>
			<div class="ibox-content">
				<div class="row">
					<div class="col-sm-3 b-r">
						<h4>Avatar</h4>
						<p class="text-center">
							<img src="{{$item->imageUrl(false)}}" alt="{{$item->name}}" class="img-responsive" style="width:100%" alt="profile">
						</p>
					</div>
					<div class="col-sm-9">
						<h3 class="m-t-none m-b">@lang('app.login_info')</h3>
						<form role="form" action="{{route('v2.admin.profile.info')}}" method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>@lang('app.form.login')</label> 
										<input class="form-control" value="{{$item->name}}" placeholder="@lang('app.form.login')" disabled>
									</div>
									<div class="form-group">
										<label>@lang('app.form.email')</label> 
										<input name="email" class="form-control" value="{{$item->email}}" placeholder="@lang('app.form.email')">
									</div>
									<div class="form-group">
										<label>@lang('app.form.language')</label> 
										<select name="language" class="form-control" id="language">
											<option value="fr" {{$item->language=='fr'?'selected':''}}>Français</option>
											<option value="en" {{$item->language=='en'?'selected':''}}>English</option>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>@lang('app.form.first_name')</label> 
										<input class="form-control" value="{{old('first_name', $item->meta('first_name', ''))}}" name="first_name" placeholder="@lang('app.form.first_name')">
									</div>
									<div class="form-group">
										<label>@lang('app.form.last_name')</label> 
										<input class="form-control" value="{{old('last_name', $item->meta('last_name', ''))}}" name="last_name" placeholder="@lang('app.form.last_name')">
									</div>
									<div class="form-group">
										<label>Avatar</label> 
										<input type="file" class="form-control" id="image" name="image" accept=".png, .jpg, .jpeg">
									</div>
								</div>
								{{ csrf_field() }}
							</div>
							<div class="hr-line-dashed"></div>
							<div>
								<button class="btn btn-primary pull-right" type="submit">
									<strong><i class="fa fa-check"></i> Sauvegarder</strong>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- fin profil-->
		<!-- Mot de passe -->
		<div class="ibox ">
			<div class="ibox-title">
				<h5><i class="fa fa-lock"></i> @lang('app.title.password')</h5>
				<div class="ibox-tools">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
				</div>
			</div>
			<div class="ibox-content">
				<form role="form" action="{{route('v2.admin.password')}}" method="post" id="passwordForm">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<label>@lang('app.last.password')</label> 
								<input name="old_password" type="password" class="form-control" id="old_password">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label>@lang('app.new.password')</label> 
								<input name="password" type="password" class="form-control" id="password">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label>@lang('app.confirm.password')</label> 
								<input name="password_confirmation" type="password" class="form-control" id="password_confirmation">
							</div>
						</div>
						<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
					</div>
					<div class="hr-line-dashed"></div>
					<div>
						<button class="btn btn-primary pull-right save-password" type="submit">
							<strong><i class="fa fa-check"></i> Sauvegarder</strong>
						</button>
						<div style="clear:both"></div>
					</div>
				</form>
			</div>
		</div>
		<!-- fin mot de passe-->
		<!-- localisation -->
		<div class="ibox ">
			<div class="ibox-title">
				<h5><i class="fa fa-map-marker"></i> @lang('app.location')</h5>
				<div class="ibox-tools">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
				</div>
			</div>
			<form role="form" action="{{route('v2.admin.location.edit')}}" method="post">
			<div class="ibox-content">
				<!--<div id="map"></div>-->
				<div class="hr-line-dashed"></div>
				<div class="row">
					<div class="col-sm-3">
						<div class="form-group">
							<label>@lang('app.latitude')</label> 
							<input type="text" name="latitude" class="form-control" id="latitude" placeholder="Latitude" value="{{old('latitude')?old('latitude'):$location?$location->latitude:''}}">
						</div>
						<div class="form-group">
							<label>@lang('app.longitude')</label> 
							<input type="text" name="longitude" class="form-control" id="longitude" placeholder="Longitude" value="{{old('longitude')?old('longitude'):$location?$location->longitude:''}}">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label>@lang('app.country')</label> 
							<select class="form-control" name="country" id="country">
								<option value="0">@lang('app.select_country')</option>
								@foreach($countries as $country)
									<option value="{{$country->id}}" {{ ( $country->content == $location->country) ? 'selected' : '' }}> {{$country->content}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>@lang('app.area_level_1')</label> 
							<select class="form-control" name="area_level_1" id="area_level_1">
								<option value="0">@lang('app.select_country')</option>
								@foreach(\App\State::all() as $state)
									<option value="{{$state->id}}" {{ ( $country->states == $location->state) ? 'selected' : '' }}> {{$state->content}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label>@lang('app.area_level_2')</label> 
							<input type="text" name="area_level_2" class="form-control" id="area_level_2" placeholder="@lang('app.region')" value="{{old('region')?old('region'):$location?$location->region:''}}">
						</div>
						<div class="form-group">
							<label>@lang('app.locality')</label> 
							 <input type="text" name="locality" class="form-control" id="locality" placeholder="@lang('app.locality')" value="{{old('locality')?old('locality'):$location?$location->locality:''}}">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label>@lang('app.route')</label> 
							<input type="text" name="route" class="form-control" id="route" placeholder="@lang('app.route')" value="{{old('route')?old('route'):$location?$location->route:''}}">
						</div>
						<div class="form-group">
							<label>@lang('app.postalCode')</label> 
							<input type="text" name="postalCode" class="form-control" id="postalCode" placeholder="@lang('app.postalCode')" value="{{old('postalCode')?old('postalCode'):$location?$location->postalCode:''}}">
						</div>
					</div>
					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">					
					<input type="hidden" name="formatted" id="formatted">
				</div>
				<div class="hr-line-dashed"></div>
				<button type="submit" class="btn btn-primary pull-right">
					<strong><i class="fa fa-check"></i> @lang('app.btn.save')</strong>
				</button>
				<div style="clear:both"></div>
			</div>
			</form>
		</div>
		<!-- localisation -->
	</div>
@endsection
@section('custom-script')
<script type="text/javascript">
	$(document).ready(function() {
		$('#passwordForm').validate({
			rules: {
				old_password: {
					required: true
				},
				password: {
					required: true
				},
				password_confirmation: {
					required: true
				}
			},
			messages: {
				old_password: {
					required: "@lang('app.last.password')"
				},
				password: {
					required: "@lang('app.new.password')"
				},
				password_confirmation: {
					required: "@lang('app.confirm.password')"
				}
			}
		});
		$("#country").select2();
		$("#area_level_1").select2();
	});
	<?php /*?>
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
	<?php */?>
</script>
<?php /*?><script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzqATs_wp3WXAVlt9iPVS9GcRFPGcIZZw&callback=initMap" type="text/javascript"></script><?php */?>
@endsection

