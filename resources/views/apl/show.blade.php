@extends('layouts.app')

@section('content')

@component('includes.breadcrumb')
    @lang('app.list_apl')
@endcomponent

<section class="section gray-bg">
  <div class="container">
      <div class="row justify-content-center">
        <div>
          <h2 class="font-15 m-10px-b">@lang('app.txt.info.apl', ['apl'=>$aplDatas[0]->name])</h2>
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
                                <p><a href="{{ route('show.apl',['id'=>$apl->id]) }}"><i class="fa fa-map-marker"></i> {{ $apl->name }}</a></p>
                                @empty
                                    <p>@lang('app.txt.noinfo')</p>
                                @endforelse
                            </div>
                        </div>
                        @empty
                        <div class="acco-group white-bg">
                            <p><i class="fa fa-map-marker"></i> @lang('app.txt.noinfo')</p>
                        </div>
                        @endforelse
                    </div>
                </div>
                <div class="col-lg-9 p-15px white-bg box-shadow">
                    {{-- show map --}}
                    <div id="map"></div>
                    {{-- end show map --}}

                    <!-- Section -->
                    <section class="section">
                        <div class="container">
                            <div class="row align-items-start border-bottom-1 border-color-gray m-15px-b p-35px-b">
                                <div class="col-lg-12 md-m-15px-tb">

                                    {{-- Info entreprise --}}
                                    <div class="card m-30px-b">
                                        <div class="card-body">
                                            <div class="m-30px-b">
                                                <h3 class="h4">@lang('app.txt.presentation')</h3>
                                                <div class="gray-bg border-left-5 border-color-theme p-20px m-35px-tb font-1">
                                                    {{ $aplDatas[0]->userinfos?$aplDatas[0]->userinfos->orga_presentation:trans('app.txt.noinfo') }}        
                                                </div>
                                            </div>

                                            <h5 class="p-25px-t m-15px-b">@lang('app.txt.businessdetail')</h5>
                                            <ul class="list-type-02">
                                                <div class="col-lg-3 col-sm-6 m-15px-tb">
                                                    <div class="hover-top-in">
                                                        <div class="overflow-hidden border-radius-5">
                                                            <img src="{{ $aplDatas[0]->imageUrl() }}" title="{{ $aplDatas[0]->name }}" alt="{{ $aplDatas[0]->name }}">
                                                        </div>
                                                        <div class="m-10px-lr box-shadow border-radius-5 position-relative mt-n4 white-bg p-20px text-center hover-top--in">
                                                            <h6 class="font-w-700 dark-color m-5px-b">{{ $aplDatas[0]->name }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <li><i class="fas fa-building"></i> @lang('app.txt.businessname') : {{$aplDatas[0]->userinfos?$aplDatas[0]->userinfos->orga_name:trans('app.txt.noinfo')}}</li>
                                                <li><i class="fas fa-envelope"></i> @lang('app.txt.businessemail') : {{$aplDatas[0]->userinfos ?$aplDatas[0]->userinfos->orga_email:trans('app.txt.noinfo') }}</li>
                                                <li><i class="fas fa-phone"></i> @lang('app.txt.businessphone') : {{$aplDatas[0]->userinfos ?$aplDatas[0]->userinfos->orga_phone:trans('app.txt.noinfo') }}</li>
                                                <li><i class="fas fa-globe"></i> @lang('app.txt.businesswebsite') : {{$aplDatas[0]->userinfos ?$aplDatas[0]->userinfos->orga_website:trans('app.txt.noinfo') }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    {{-- Localité --}}
                                    <div class="card m-30px-b">
                                        <div class="card-body">
                                            <div class="m-30px-b">
                                                <h3 class="h4">@lang('app.txt.localityinformation')</h3>
                                            </div>
                                            <ul class="list-type-02">
                                                <li><i class="fas fa-road"></i> @lang('app.txt.streetaddress') : {{$aplDatas[0]->location ?$aplDatas[0]->location->route:trans('app.txt.noinfo') }}</li>
                                                <li><i class="fas fa-city"></i> @lang('app.txt.suburb') : {{$aplDatas[0]->location ?$aplDatas[0]->location->locality:trans('app.txt.noinfo') }}</li>
                                                <li><i class="fas fa-flag"></i> @lang('app.txt.etat') : {{$aplDatas[0]->location ?$aplDatas[0]->location->area_level_1:trans('app.txt.noinfo') }}</li>
                                                <li><i class="fas fa-info"></i> @lang('app.txt.codepostal') : {{$aplDatas[0]->location ?$aplDatas[0]->location->postalCode:trans('app.txt.noinfo') }}</li>
                                            </ul>
                                        </div>
                                    </div>

                                    {{-- Info contact --}}
                                    <div class="card m-30px-b">
                                        <div class="card-body">
                                            <div class="m-30px-b">
                                                <h3 class="h4">@lang('app.txt.contactinfo')</h3>
                                            </div>
                                            <ul class="list-type-02">
                                                <li><i class="fas fa-user"></i> @lang('app.txt.contactname') : {{$aplDatas[0]->userinfos ?$aplDatas[0]->userinfos->contact_name:trans('app.txt.noinfo') }}</li>
                                                <li><i class="fas fa-envelope"></i> @lang('app.txt.contactemail') : {{$aplDatas[0]->userinfos ?$aplDatas[0]->userinfos->contact_email:trans('app.txt.noinfo') }}</li>
                                                <li><i class="fas fa-phone"></i> @lang('app.txt.contactphone') : {{$aplDatas[0]->userinfos ?$aplDatas[0]->userinfos->contact_phone:trans('app.txt.noinfo') }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="float-right">
                                <button class="m-btn m-btn-theme4rd" data-toggle="modal" data-target="#myModal" id="btn_select_apl">@lang('app.btn.select_apl')</button>
                            </div>
                        </div>
                    </section>
                    <!-- End Section -->
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
                    <p id="content" class="white-color"><i class="fa fa-building"></i> {{ $apl->name?$apl->name:'' }}</p>
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
                // $('#apl-modal').attr("value", data.id);
                // $('#title').html(data.title);
                // $('#content').html(data.html);
                // $('#myModal').modal('show'); 
            });
        }
    }

</script>
@endpush
