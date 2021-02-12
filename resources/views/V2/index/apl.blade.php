@extends('V2.layouts.app')

@section('content')

@component('V2.includes.breadcrumb')
    @lang('app.list_apl')
@endcomponent

<section class="section gray-bg">
  <div class="container">
      <div class="row justify-content-center">
        <div>
          <h2 class="font-15 m-10px-b">@lang('app.select_apl')</h2>
        </div>
          <div class="col-12 m-30px-t">
              <div class="p-15px white-bg box-shadow">
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
                <form id="apl-form-modal" class="form-horizontal" role="form" method="post" action="{{route('v2.member.select.apl')}}">
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
        <form id="apl-form-modal" class="form-horizontal" role="form" method="post" action="{{route('member.select.apl')}}">
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
@endsection

@push('script')
<style>
  #map{
    height: 25rem;
  }
</style>
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
            zoom: 2
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
            google.maps.event.addListener(markers[data.id], 'click', function() {
                $('#apl-modal').attr("value", data.id);
                $('#title').html(data.title);
                $('#content').html(data.html);
                $('#myModal').modal('show'); 
            });
        }
    }

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRj7J_sOaCmFfSFNvUL7Z-NX3uUvG_FTA&callback=initMap"></script>
@endpush
