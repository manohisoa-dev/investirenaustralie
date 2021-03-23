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