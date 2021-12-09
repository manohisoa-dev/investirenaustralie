@extends('layouts.backend')

@section('subcontent')


@include('includes.alerts')
<div class="m-40px-tb card card-body">
    <div class="border-bottom-1 border-color-dark-gray m-15px-b p-0px-b">
        <h5>@lang('app.select_apl')</h5>
        <div class="row">
            <div class="col-md-4 m-10px-tb">
                <div class="media">
                    <div class="only-icon-20">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="media-body p-15px-l lh-normal">
                        <form id="filter-form" method="get" action="">
                            <div  class="pull-left">
                                <label for="distance"> @lang('app.form.filterBy'):   </label>  
                                <select name="distance" id="distance" onchange="document.getElementById('filter-form').submit();"> 
                                    @foreach($distances as $dist)
                                    <option value="{{$dist}}" {{$distance===$dist?'selected':''}}>{{$dist}}</option> 
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="border-bottom-1 border-color-dark-gray m-15px-b p-15px-b">
        <div class="row">
            <div class="col-sm-12 col-xl-12 m-10px-tb">
                <div id="map"></div>
            </div>
        </div>
    </div>
</div>


<!-- modal -->
<div class="container">
    <div class="modal left fade" id="myModal" tabindex="" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content dark-bg">
                <div class="modal-header" style="background-color: #AE4435 !important;">
                  <h4 class="modal-title white-color" id="title">@lang('app.apl')</h4>
                </div>
                <div class="modal-body">
                    <div class="nav flex-sm-column flex-row">
                      <p id="content" class="white-color">@lang('app.select_apl')</p>
                    </div>
                </div>
                <div class="modal-footer">
                  <form id="apl-form-modal" class="form-horizontal" role="form" method="get" action="{{$action}}">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" id="apl-modal"  name="apl">
                    <div class="pull-left hidden row-confirm-modal" style="margin-bottom: 20px;">
                        <input id="check-confirm-modal" type="checkbox"><span style="color:red;"> {!!__('member.accept_term_and_condition_apl')!!}</span>
                        <label>@lang('app.txt.condition_days_apl', ['nbDay'=>App\Models\Parameter::nbDayEndApl()])</label>
                    </div>
                    <div class="row col-md-12">
                      <div class="col-md-5">
                        <button class="m-btn m-btn-theme" data-dismiss="modal" aria-hidden="true">@lang('app.btn.cancel')</button>
                      </div>
                      <div class="col-md-5">
                        <button id="submit" type="submit" class="m-btn m-btn-theme4rd">@lang('member.select')</button>
                      </div>  
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin modal -->

<!-- Message modal -->
<div id="modal-message" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="title">@lang('member.info')</h4>
        </div>
        <div class="modal-body">
            <p>{!! $message !!}</p>
        </div>
        <div class="modal-footer">
            <button class="m-btn m-btn-theme" data-dismiss="modal" aria-hidden="true">@lang('app.btn.ok')</button>
        </div>
      </div>
    </div>
</div>
<!-- Fin Message modal -->

@push('script')
    <style type="text/css">
        /* Always set the map height explicitly to define the size of the div
        * element that contains the map. */
        #map {
        height: 25rem;
        }

    </style>

    <script type="text/javascript">
        $(window).on('load', function() {
            if('{{ $message }}')
            $('#modal-message').modal('show');
        });
    </script>
    
    <script>
        $('#apl-form-modal').submit(function(event){
            if(!$('#check-confirm-modal').is(":checked"))
            {
                $('.row-confirm-modal').removeClass('hidden');
                event.preventDefault();
                alert("{{ trans('app.txt.accept_term', ['role'=>'APL']) }}");
            }
        });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2izG_M7K3gP6pFUH5cyzmDjuGpOYfgc4&libraries=places&callback=initMap&channel=GMPSB_addressselection_v1_cABC" async defer></script>
    <script>
        var _map;
        var _geocoder;
        var _marker;
        // var _lat = {{$location?$location->latitude:-25.647467468105795}};
        // var _long = {{$location?$location->longitude:146.89921517372136}};

        var _lat = -25.647467468105795;
        var _long = 146.89921517372136;
        var _lat_user = {{Auth::user()->location()?Auth::user()->location->latitude:0}};
        var _long_user = {{Auth::user()->location()?Auth::user()->location->longitude:0}};
        
        var iconBase = "{{url('')}}";
        var icons = {
        user: {
            icon: iconBase + '/images/map/user.png'
        },
        5: {
            icon: iconBase + '/images/map/member.png'
        },
        4: {
            icon: iconBase + '/images/map/apl.png'
        },
        3: {
            icon: iconBase + '/images/map/afa.png'
        },
        product: {
            icon: iconBase + '/images/map/product.png'
        }
        };
        
        
        var datas = {!!$data!!};
        var selected = {!!$selected!!};
        var markers = [];
    
        function initMap() {
            
            _map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: _lat, lng:  _long},
                zoom: 3,
                fullscreenControl: true
            });
            
            if(_lat_user!=0 && _long_user!=0){
                _marker = new google.maps.Marker({
                position: {lat: _lat_user, lng: _long_user},
                icon: icons[5].icon,
                map: _map,
                title: "@lang('app.your_location')"
                });

                _marker.addListener('dragend', function() {
                    var lat = _marker.getPosition().lat();
                    var lng = _marker.getPosition().lng();
                });

                // show info inwindows
                infoWindowLocal(_marker,"@lang('app.your_location')");
            }
        
            for (var i = 0; i < datas.length; i++) {
                placeMarker(datas[i], );
            }
        }
        
        function placeMarker(data) {
            markers[data.id] = new google.maps.Marker({
                position: {lat:parseFloat(data.lat), lng:parseFloat(data.lng)},
                map: _map,
                title: data.title,
                icon: icons[data.type].icon,
            });
            
            if(data.type == 4){
                // show info inwindows
                infoWindow(markers[data.id],data);

                google.maps.event.addListener(markers[data.id], 'click', function() {
                    $('#apl-modal').attr("value", data.id);
                    $('#title').html(data.title);
                    $('#content').html(data.html);
                    $('#myModal').modal('show'); 

                    onClickListener();
                });
            }
        }

        function infoWindow(marker,data){
            // On crée une infobulle
            var infowindow1 = new google.maps.InfoWindow({
                maxWidth: 300, 
                //On définit le texte à afficher dans l'infoWindow 
                content: '<b>'+data.immat+'</b><br/>'+data.title+'<br/>'+data.adr
            });

            //On ajoute un listener d'événement : on écoute le clic sur le marqueur
            google.maps.event.addListener(marker, 'mouseover', function() {
                // Ouverture de l'infobulle 
                infowindow1.open(map, marker);  
            });  

            // Ouverture de l'infobulle 
            infowindow1.open(map, marker);  
        }

        function infoWindowLocal(marker,data){
            // On crée une infobulle
            var infowindow1 = new google.maps.InfoWindow({
                maxWidth: 300, 
                //On définit le texte à afficher dans l'infoWindow 
                content: data
            });

            //On ajoute un listener d'événement : on écoute le clic sur le marqueur
            google.maps.event.addListener(marker, 'mouseover', function() {
                // Ouverture de l'infobulle 
                infowindow1.open(map, marker);  
            });  

            // Ouverture de l'infobulle 
            infowindow1.open(map, marker);  
        }

        function onClickListener() {
            // Exit Full Screen Mode
            if (document.fullscreenElement ) {
            document.exitFullscreen();
            } else if (document.mozFullScreenElement ) {
            document.mozCancelFullScreen();
            } else if (document.webkitFullscreenElement ) {
            document.webkitExitFullscreen();
            } else if (document.msFullscreenElement  ) {
            document.msExitFullscreen();
            }

            return false;
        }

    </script>
    @endpush

@endsection

