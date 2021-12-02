@extends('layouts.app')

@section('content')

@component('includes.breadcrumb')
    @lang('app.list_apl')
@endcomponent

<section class="section gray-bg">
  <div class="container">
      <div class="row justify-content-center">
        <div>
          <h2 class="font-15 m-10px-b">@lang('app.select_apl')</h2>
        </div>
          <div class="row col-lg-12 m-30px-t">
              <div class="col-lg-3 m-8px-l">
                  <span class="m-font m-font-theme4rd flex-shrink-0 col-md-12" style="margin-bottom: 20px;">@lang('app.list_apl')</span>
                  <div class="accordion accordion-05 m-40px-b">
                    @forelse ($lapls_sidebar as $item)
                    <div class="acco-group white-bg">
                        <a href="#" class="acco-heading">{{ $item->country }}</a>
                        <div class="acco-des">
                            @forelse (App\Models\User::where('location_id','=',$item->id)->get() as $apl)
                              <p><a href="{{ route('show.apl',['id'=>$apl->id]) }}" target="_blank"><i class="fa fa-map-marker"></i> {{ $apl->userinfos()?$apl->userinfos->orga_name:$apl->name }}</a></p>
                            @empty
                                <div class="p-15px-tb p-5px-lr text-center">@lang('app.txt.noinfo')</div>
                            @endforelse
                        </div>
                    </div>
                    @empty
                    <div class="acco-group white-bg">
                      <div class="p-100px-tb p-5px-lr text-center">@lang('app.txt.no_apl')</div>
                    </div>
                    @endforelse
                  </div>
              </div>
              <div class="col-lg-9 p-15px white-bg box-shadow">
                <div id="map"></div>
              </div>
          </div>
      </div>
  </div>
</section>

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
                <form id="apl-form-modal" class="form-horizontal" role="form" method="post" action="{{route('member.select.apl')}}">
                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                  <input type="hidden" id="apl-modal"  name="apl">
                  <div class="pull-left hidden row-confirm-modal" style="margin-bottom: 20px;">
                      <input id="check-confirm-modal" type="checkbox" name="confirm" value="1"><span style="color:red;"> {!!__('member.accept_term_and_condition_apl')!!}</span>
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

@endsection

@push('script')
<style>
  #map{
    height: 25rem;
  }
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2izG_M7K3gP6pFUH5cyzmDjuGpOYfgc4&libraries=places&callback=initMap&channel=GMPSB_addressselection_v1_cABC" async defer></script>
<script>
    $('#apl-form-modal').submit(function(event){
        if($('#check-confirm-modal').is(":checked"))
        {
            $('.row-confirm-modal').removeClass('hidden');
        }
        else{
          alert('Veuillez accepter les termes et les conditions APL !');
          event.preventDefault();
        }
    });

</script>
<script>
    var _map;
    var _lat = -25.647467468105795;
    var _long = 146.89921517372136;
    // var _lat = ‑31.083332;
    // var _long = 150.916672;
    
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
    var markers = [];
    
    function initMap() {
        
        _map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: _lat, lng:  _long},
            zoom: 2,
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


        if(data.type == 4){
            // show info inwindows
            if(data.lat!==null || data.lng!==null){
              infoWindow(markers[data.id],data);
            }

            
            google.maps.event.addListener(markers[data.id], 'click', function() {
                $('#apl-modal').attr("value", data.id);
                $('#title').html(data.title);
                $('#content').html(data.html);
                $('#myModal').modal('show'); 

                var id= data.id;
                var uri = '{{ URL::to("get/show/apl") }}'+'/'+id;
                var envoi = $.get( uri );

                envoi.done( function(url) {
                  window.open(url.res, '_blank');
                });

                onClickListener();

            });
        }
    }

    function infoWindow(marker,data){
      	// On crée une infobulle
        var infowindow1 = new google.maps.InfoWindow({
          maxWidth: 300, 
          //On définit le texte à afficher dans l'infoWindow 
          content: '<b>'+data.immat+'</b><br/>'+data.title+'<br/>'+data.adr});
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
