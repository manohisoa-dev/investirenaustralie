@extends('V2.layouts.backend')

@section('subcontent')

<div class="col-lg-8 col-xl-9">
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
                    {{-- <div class="card">
                        <div class="p-15px white-bg box-shadow">
                            <div class="embed-responsive embed-responsive-21by9">
                                <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3151.840107317064!2d144.955925!3d-37.817214!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb6899234e561db11!2sEnvato!5e0!3m2!1sen!2sin!4v1520156366883" allowfullscreen=""></iframe>
                            </div>
                        </div>
                    </div> --}}
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="title">@lang('app.apl')</h4>
      </div>
      <div class="modal-body">
        <p id="content">@lang('app.select_apl')</p>
      </div>
      <div class="modal-footer">
        <form id="apl-form-modal" class="form-horizontal" role="form" method="post" action="{{$action}}">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" id="apl-modal"  name="apl">
            <div class="pull-left hidden row-confirm-modal" style="margin-bottom: 20px;">
                <input id="check-confirm-modal" type="checkbox" name="confirm" value="1"><span style="color:red;"> {!!__('member.accept_term_and_condition_apl')!!}</span>
            </div>
            <div class="col-md-12">
                <button class="btn btn-default pull-right" data-dismiss="modal" aria-hidden="true">@lang('app.btn.cancel')</button>
                <button id="submit" type="submit" class="btn btn-success pull-left">@lang('member.select')</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

@push('script')
    
    <script>
        $('#apl-form-modal').submit(function(event){
            if(!$('#check-confirm-modal').is(":checked"))
            {
                $('.row-confirm-modal').removeClass('hidden');
                event.preventDefault();
            }
        });
    </script>
    <script>
        var _map;
        var _geocoder;
        var _marker;
        var _lat = {{$location?$location->latitude:-25.647467468105795}};
        var _long = {{$location?$location->longitude:146.89921517372136}};
        
        var iconBase = "{{url('')}}";
        var icons = {
        user: {
            icon: iconBase + '/images/map/user.png'
        },
        member: {
            icon: iconBase + '/images/map/member.png'
        },
        apl: {
            icon: iconBase + '/images/map/apl.png'
        },
        afa: {
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
                zoom: 3
            });
            
            _marker = new google.maps.Marker({
            position: {lat: _lat, lng: _long},
            icon: icons['member'].icon,
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
            
            if(data.type == 'apl'){
                google.maps.event.addListener(markers[data.id], 'click', function() {
                    $('#apl-modal').attr("value", data.id);
                    $('#title').html(data.title);
                    $('#content').html(data.html);
                    $('#myModal').modal('show'); 
                });
            }
        }

    </script>
    <script>
        let map;

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: -34.397, lng: 150.644 },
                zoom: 8,
            });
        }
    </script>
     <script
     src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRj7J_sOaCmFfSFNvUL7Z-NX3uUvG_FTA&callback=initMap&libraries=&v=weekly"
     async
   ></script>
    {{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRj7J_sOaCmFfSFNvUL7Z-NX3uUvG_FTA&callback=initMap2"></script> --}}
    @endpush

@endsection

