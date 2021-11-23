{{-- <!DOCTYPE html>
<html>
<head>
    <title>Google reCAPTCHA v2</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    {!! NoCaptcha::renderJs() !!}
</head>
<body>
<div class="container" style="margin-top: 50px; width: 750px;">
    <div class="card card-primary">
        <div class="card-body">
            <h4 class="card-title text-center">Google reCAPTCHA v2</h4>
            <form class="form-horizontal" role="form" method="POST" action="{{ route('contact-request') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Name</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">E-Mail Address</label>
                    <div class="col-md-12">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Message</label>
                    <div class="col-md-12">
                        <textarea class="form-control" name="message" rows="3">{{ old('message') }}</textarea>
                        @if ($errors->has('message'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('message') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Captcha</label>
                    <div class="col-md-12">
                        {!! app('captcha')->display() !!}
                        @if ($errors->has('g-recaptcha-response'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{bcrypt("Membre123#")}}

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <br/>
                        <button type="submit" class="btn btn-primary">
                            Contact
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html> --}}


@extends('layouts.app')

@section('content')

<section class="section">
    <div class="container">
        <div class="row">
            <div class="card gray-bg">
                <div class="card-body">
                    <h4 class="m-30px-b">@lang('app.txt.product_location')</h4>
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection

@push('script')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2izG_M7K3gP6pFUH5cyzmDjuGpOYfgc4&libraries=places&callback=initMap&channel=GMPSB_addressselection_v1_cABC" async defer></script>
	@php
        $latitude = -25.647467468105795;
        $longitude = 146.89921517372136;
	@endphp
  <script>

      var _map;
      var _geocoder;
      var _marker;
      var _circle;
      var _lat = {{$latitude}};
      var _long = {{$longitude}};


      function initMap() {
          _map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: _lat, lng:  _long},
              zoom: 10
          });

          // The map, centered on Central Park
            const center = {lat: 40.774102, lng: -73.971734};
            const options = {zoom: 15, scaleControl: true, center: center};
            map = new google.maps.Map(
                document.getElementById('map'), options);
            // Locations of landmarks
            const dakota = {lat: 40.7767644, lng: -73.9761399};
            const frick = {lat: 40.771209, lng: -73.9673991};
            // The markers for The Dakota and The Frick Collection
            var mk1 = new google.maps.Marker({position: dakota, map: map});
            var mk2 = new google.maps.Marker({position: frick, map: map});

            initialize();
      };

      initialize();

      function initialize() {
            var lat = _lat
            var lng = _long

            var service = new google.maps.places.PlacesService(map);
            var pyrmont = {lat: lat, lng: lng};
            placeResults = service.nearbySearch({
                location: pyrmont,
                radius: 1000 // meters
            }, callback);

    }

      

  </script>
  
@endpush
