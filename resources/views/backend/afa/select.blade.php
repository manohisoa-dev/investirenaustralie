@extends('layouts.backend')

@section('subcontent')


@include('includes.alerts')
<div class="m-40px-tb card card-body">
    <div class="border-bottom-1 border-color-dark-gray m-15px-b p-0px-b">
        <h5>@lang('app.select_afa')</h5>
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
                  <h4 class="modal-title white-color" id="title">@lang('app.afa')</h4>
                </div>
                <div class="modal-body">
                    <div class="nav flex-sm-column flex-row">
                      <p id="content" class="white-color">@lang('app.select_afa')</p>
                    </div>
                </div>
                <div class="modal-footer">
                  <form id="afa-form-modal" class="form-horizontal" role="form" method="post" action="{{$action}}">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" id="afa-modal"  name="afa">
                    <div class="pull-left hidden row-confirm-modal" style="margin-bottom: 20px;">
                        <input id="check-confirm-modal" type="checkbox" name="confirm" value="1"><span style="color:red;"> {!!__('member.accept_term_and_condition_afa')!!}</span>
                        <p class="text-left">{!!__('member.select_afa')!!}</p>
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



@push('script')
    <script src="{{ asset('administrator/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <style type="text/css">
        /* Always set the map height explicitly to define the size of the div
        * element that contains the map. */
        #map {
        height: 25rem;
        }

    </style>
    
    <script>
        $('#afa-form-modal').submit(function(event){
            if(!$('#check-confirm-modal').is(":checked"))
            {
                $('.row-confirm-modal').removeClass('hidden');
                event.preventDefault();
                swal({
					title: "@lang('app.select_afa')",
                    text: "@lang('app.txt.accept_term', ['role'=>'AFA'])",
					type: "warning",
					showCancelButton: false,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "@lang('app.btn.ok')",
					closeOnConfirm: true
				},
				function () {
                    return false;
                });
            }
        });
    </script>
    <script>
        var _map;
        var _geocoder;
        var _marker;

        var _lat = -25.647467468105795;
        var _long = 146.89921517372136;
        
        var iconBase = "{{url('')}}";
        var icons = {
        5: {
            icon: iconBase + '/images/map/member.png'
        },
        3: {
            icon: iconBase + '/images/map/afa.png'
        },
        };
        
        
        var datas = {!!$data!!};
        var selected = {!!$selected!!};
        var markers = [];
        
        function initMap() {
            
            _map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: _lat, lng:  _long},
                zoom: 3
            });
            
            _marker = new google.maps.Marker({
            position: {lat: _lat, lng: _long},
            icon: icons[5].icon,
            map: _map,
            title: "@lang('app.your_location')"
            });

            _marker.addListener('dragend', function() {
                var lat = _marker.getPosition().lat();
                var lng = _marker.getPosition().lng();
            });
        
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
            
            if(data.type == 3){
                google.maps.event.addListener(markers[data.id], 'click', function() {
                    $('#afa-modal').attr("value", data.id);
                    $('#title').html(data.title);
                    $('#content').html(data.html);
                    $('#myModal').modal('show'); 
                });
            }
        }

    </script>
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRj7J_sOaCmFfSFNvUL7Z-NX3uUvG_FTA&callback=initMap&libraries=&v=weekly"
    async
    ></script>
    @endpush

@endsection

