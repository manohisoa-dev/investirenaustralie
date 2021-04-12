@extends('layouts.app')

@section('content')
<!-- Main -->
<main>
    {{-- @component('includes.breadcrumb')
        @lang('Products')
    @endcomponent --}}
    <!-- Page Title -->
    @php
        try {
            if(file_get_contents($item->imageUrl()));
            $img=$item->imageUrl();
        } catch (\Throwable $th) {
            $img=asset('images/blog/iea.png');
        }   
    @endphp
    <section class="bg-center bg-cover bg-fiexd effect-section" style="background-image: url({{ $img }});">
        <div class="mask dark-g-bg opacity-7"></div>
        <div class="container">
            <div class="row screen-65 justify-content-center align-items-center p-100px-tb">
                <div class="col-lg-10 text-center m-50px-t">
                    <h1 class="display-4 white-color m-25px-b">{{$item->title}}</h1>
                    <div class="d-flex align-items-center m-25px-t justify-content-center text-left">
                        <div class="p-15px-l">
                            <p class="white-color m-0px">{{ $item->location ? Illuminate\Support\Str::upper($item->location->locality.' '.$item->location->area_level_2.', '.$item->location->area_level_1.' '.$item->location->postalCode) : '' }}</p>
                        </div>
                    </div>

                    <div class="p-25px-t row col-lg-12">
                        <div class="col-lg-4 col-sm-6">
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#listAfaModal" class="m-btn m-btn-theme2nd dark-color flex-shrink-0 col-md-12"><i class="fa fa-envelope" aria-hidden="true"></i>  @lang('app.btn.contact_afa')</a>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                          <a href="{{ route('member.contact', ['role'=>'apl']) }}" class="m-btn m-btn-theme4rd dark-color flex-shrink-0 col-md-12"><i class="fa fa-envelope" aria-hidden="true"></i>  @lang('app.btn.contacter_apl')</a>
                        </div>
                        <div class="col-lg-4 col-sm-6">

                            @if (Auth::user())
                                @if (isset(App\Models\Label::where('author_id',Auth::id())->where('product_id',$item->id)->where('label','starred')->first()->id))
                                    <a href="{{route('label.remove', ['id'=>App\Models\Label::where('author_id',Auth::id())->where('product_id',$item->id)->where('label','starred')->first()->id])}}" title="@lang('app.txt.programme_in_favorites')" class="m-btn btn-warning dark-color flex-shrink-0 col-md-12"><i class="fa fa-star" aria-hidden="true"></i>  @lang('app.btn.star')</a>
                                @else
                                    <a href="{{route('label.store', ['product'=>$item,'type'=>'starred'])}}" title="@lang('app.txt.programme_favorites')" class="m-btn m-btn-theme5rd dark-color flex-shrink-0 col-md-12"><i class="fa fa-star" aria-hidden="true"></i>  @lang('app.btn.star')</a>
                                @endif
                            @else
                                <a href="{{route('label.store', ['product'=>$item,'type'=>'starred'])}}" title="@lang('app.txt.programme_favorites')" class="m-btn m-btn-theme5rd dark-color flex-shrink-0 col-md-12"><i class="fa fa-star" aria-hidden="true"></i>  @lang('app.btn.star')</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page Title -->
    <!-- Section -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                  @include('includes.alerts')
                  @if(count($item->images))
                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                      </ol>
                      <!-- Wrapper for slides -->
                      <div class="carousel-inner">
                        <div class="item active">
                          <img src="{{asset('images/Surfers_Paradise.jpg')}}" alt="..." style="width:100%;">
                        </div>
                        <div class="item">
                          <img src="{{asset('images/caroussel-image-1.jpg')}}" alt="..." style="width:100%;">
                        </div>
                        <div class="item">
                          <img src="{{asset('images/caroussel-image-2.jpg')}}" alt="..." style="width:100%;">
                        </div>
                      </div>
                      <!-- Left and right controls -->
                      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">@lang('app.btn.prev')</span>
                      </a>
                      <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">@lang('app.btn.next')</span>
                      </a>
                  </div>
                  @else
                  <figure class="figure">
                    @php
                        try {
                            if(file_get_contents($item->imageUrl()));
                            $img=$item->imageUrl();
                        } catch (\Throwable $th) {
                            $img=asset('images/iea.png');
                        }   
                    @endphp
                    <img src="{{$img}}" alt="{{$item->title}}" class="img-fluid shadow rounded">
                    <figcaption class="m-15px-t dark-color"><h4>{{$item->title}}</h4></figcaption>
                  </figure> 
                  @endif

                  <section class="property-meta-wrapper common">
                    <!-- @include('includes.alerts') -->
                    <div class="row">
                        <div class="col-sm-6">
                            <form action="{{route('shop.order', ['product'=>$item->slug])}}" method="post">
                                {{csrf_field()}}
                                <button type="submit" class="m-btn m-btn-theme4rd flex-shrink-0 col-md-12"><i class="fa fa-shopping-cart"></i> @lang('app.btn.add_to_cart')</button>
                            </form>
                        </div>
                        <div class="col-sm-6">
                          <form action="{{route('shop.order', ['product'=>$item->slug])}}" method="post">
                              {{csrf_field()}}
                              <button type="submit" class="m-btn m-btn-theme flex-shrink-0 col-md-12" title="@lang('app.txt.go_to_location')"><i class="fa fa-map-marker"></i> @lang('app.btn.go_to_location')</button>
                          </form>
                        </div>
                    </div>
                  </section>
                  
                    
                  <div class="p-25px-tb m-35px-tb border-top-1 border-bottom-1 border-color-gray">
                      <div class="d-flex justify-content-between align-items-center">
                          <div>
                              <h5 class="m-0px">@lang('app.detail')</h5>
                          </div>
                      </div>
                  </div>

                  <div class="media gray-bg p-20px">
                      <div class="avatar-80 border-radius-50">
                          <img src="static/img/500x500.jpg" title="" alt="">
                      </div>
                      <div class="media-body p-20px-l">
                          <h5 class="m-10px-b">{{isset($item->created_at) ? $item->created_at->diffForHumans() : ''}}</h5>
                          <p class="m-0px"><span>@lang('app.reference'):</span> {{$item->reference}}</p>
                          <p class="m-0px"><span>@lang('app.txt.price'):</span>{{$item->price}}</p>
                          @if(isset($location))
                            <p class="m-0px"><span>@lang('app.txt.product_location'):</span> {{$location?$location->formatted:'Localisation inconnue'}}</p>
                          @endif
                          <p class="m-0px"><span>@lang('app.txt.area'):</span> {{$item->area}}</p>
                          <p class="m-0px"><span>@lang('app.txt.carport_spaces'):</span> {{$item->carport_spaces}}</p>
                          <p class="m-0px"><span>@lang('app.txt.garage_spaces'):</span> {{$item->garage_spaces}}</p>
                          <p class="m-0px"><span>@lang('app.txt.off_street_spaces'):</span> {{$item->off_street_spaces}}</p>
                          <p class="m-0px"><span>@lang('app.txt.bathrooms'):</span> {{$item->bathrooms}}</p>
                          <p class="m-0px"><span>@lang('app.txt.bedrooms'):</span> {{$item->bedrooms}}</p>
                          <p class="m-0px"><span>@lang('app.txt.ensuite'):</span> {{$item->ensuite}}</p>
                          <p class="m-0px"><span>@lang('app.txt.land_area'):</span> {{$item->land_area}}</p>
                          <p class="m-0px"><span>@lang('app.txt.floor_area'):</span> {{$item->floor_area}}</p>
                          <p class="m-0px"><span>@lang('app.txt.number_of_floors'):</span> {{$item->number_of_floors}}</p>
                      </div>
                  </div>
                  <div class="comments-area m-40px-t m-50px-b">
                      <div class="border-bottom-1 border-color-gray p-10px-b m-25px-b">
                          <h4 class="m-0px">@lang('app.description')</h4>
                      </div>
                      <ul class="comment-list">
                          <li class="comment">
                            <p>{{$item->content}}</p>
                          </li>
                      </ul>
                  </div>
                  <div class="card gray-bg">
                      <div class="card-body">
                          <h4 class="m-30px-b">@lang('app.txt.product_location')</h4>
                          <div id="map"></div>
                      </div>
                  </div>
                  <div class="m-35px-t">
                    <a href="{{ url()->previous() }}" class="m-btn m-btn-theme"><i class="fa fa-arrow-left"></i> @lang('app.btn.return')</a>
                  </div>
                </div>

                <!-- Sidebar -->
                    @include('includes.sidebar')
                <!-- fin sidebar -->

            </div>
        </div>
    </section>

    <!-- Section -->
    <section class="section gray-bg">
        <div class="container">
            <div class="row justify-content-center sm-m-20px-b m-40px-b">
                <div class="col-lg-8 text-center">
                    <label class="border-bottom-2 text-uppercase font-w-600 theme-color border-color-theme2nd">@lang('app.txt.product')</label>
                    <h3 class="h1 m-0px">@lang('app.txt.latest_product')</h3>
                </div>
            </div>
            <div class="row">
                <!-- start section products -->
                @if(isset($products))
                    @include('product.all', ['items'=>$products])
                @endif
                <!-- end section products -->
            </div>
        </div>
    </section>          
    <!-- End Section -->    
</main>

<!-- List AFA modal -->
<div class="container">
  <div class="modal left fade" id="listAfaModal" tabindex="" role="dialog" aria-labelledby="listAfaModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content dark-bg">
              <div class="modal-header" style="background-color: #AE4435 !important;">
                <h4 class="modal-title white-color text-center" id="title">@lang('app.afa')</h4>
              </div>
              <div class="modal-body">
                  <div class="nav flex-sm-column flex-row">
                      <div class="row col-lg-12">
                          @forelse ($afas as $afa)
                              <div class="col-lg-8"><p id="content" class="white-color"><i class="fa fa-building"></i> {{ $afa->name?$afa->name:'' }}</p></div>
                              <div class="col-lg-4"><a class="white-color" href="{{route('member.contact', ['role'=>'afa', 'afa'=>$afa->name?$afa->name:''])}}" title="@lang('app.txt.contact_afa') ({{ $afa->name?$afa->name:'' }})"><i class="fa fa-envelope"></i></a></div>
                          @empty
                              <p>@lang('app.txt.no_afa_in_this_location')</p>
                          @endforelse
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                <div class="col-md-5">
                  @if (sizeOf($afas) !== 0)
                    <button class="m-btn m-btn-theme" data-dismiss="modal" aria-hidden="true">@lang('app.btn.cancel')</button>
                  @else
                    <button class="m-btn m-btn-theme" data-dismiss="modal" aria-hidden="true">@lang('app.btn.close')</button>
                  @endif
                </div>
              </div>
          </div>
      </div>
  </div>
</div>
<!-- End list AFA modal -->

<!-- List APL modal -->
<div class="container">
  <div class="modal left fade" id="listAplModal" tabindex="" role="dialog" aria-labelledby="listAplModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content dark-bg">
              <div class="modal-header" style="background-color: #AE4435 !important;">
                <h4 class="modal-title white-color text-center" id="title">@lang('app.apl')</h4>
              </div>
              <div class="modal-body">
                  <div class="nav flex-sm-column flex-row">
                      <div class="row col-lg-12">
                          @forelse ($apls as $apl)
                              <div class="col-lg-8"><p id="content" class="white-color"><i class="fa fa-building"></i> {{ $apl->name?$apl->name:'' }}</p></div>
                              <div class="col-lg-4"><a class="white-color contact-apl" href="{{route('member.select.apl', ['apl'=>$apl->id?$apl->id:''])}}" title="@lang('app.txt.contact_apl') ({{ $apl->name?$apl->name:'' }})"><i class="fa fa-envelope"></i></a></div>
                          @empty
                              <p>@lang('app.txt.no_apl_in_this_location')</p>
                          @endforelse
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  @if (sizeOf($apls) !== 0)
                    <div class="pull-left hidden row-confirm-modal" style="margin-bottom: 20px;">
                        <input id="check-confirm-modal" type="checkbox" name="confirm" value="1"><span style="color:red;"> {!!__('member.accept_term_and_condition_apl')!!}</span>
                        <label>@lang('app.txt.condition_days_apl', ['nbDay'=>'180'])</label>  
                    </div>
                    <div class="col-md-5">
                      <button class="m-btn m-btn-theme" data-dismiss="modal" aria-hidden="true">@lang('app.btn.cancel')</button>
                    </div> 
                    
                      {{-- <div class="col-md-5">
                          <button class="m-btn m-btn-theme" data-dismiss="modal" aria-hidden="true">@lang('app.btn.cancel')</button>
                      </div> --}}
                  @endif
              </div>
          </div>
      </div>
  </div>
</div>
<!-- End list APL modal -->

@endsection
    
@push('script')
  <style>
    #map{
      height: 25rem;
    }
  </style>
  <script>
        $('.contact-apl').click(function(event){
          if(!$('#check-confirm-modal').is(":checked"))
          {
              event.preventDefault();
              $('.row-confirm-modal').removeClass('hidden');
              alert("{{ trans('app.txt.accept_term', ['role'=>'APL']) }}");
          } 
        });
      
  </script>
  <script>
      var _map;
      var _geocoder;
      var _marker;
      var _circle;
      var _lat = {{isset($location)?$location->latitude:-25.647467468105795}};
      var _long = {{isset($location)?$location->longitude:146.89921517372136}};
      var _btnSubmit = document.getElementById("submit");
      var _inputApl = document.getElementById("apl");
      var _contentApl = document.getElementById("apl-content");
      var _titleApl = document.getElementById("apl-title");
      
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
      
      var data = {!!(isset($data) ? $data : '')!!};
      
      function initMap() {
          
          _map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: _lat, lng:  _long},
              zoom: 10
          });
          
          _marker = new google.maps.Marker({
            position: {lat: _lat, lng: _long},
            icon: icons['product'].icon,
            map: _map,
            title: data.title
          });

          _marker.addListener('dragend', function() {
              var lat = _marker.getPosition().lat();
              var lng = _marker.getPosition().lng();
          });
          
          _circle = new google.maps.Circle({
            strokeColor: '#358bbc',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#358bbc',
            fillOpacity: 0.35,
            map: _map,
            center: {lat:parseFloat(data.lat), lng:parseFloat(data.lng)},
            radius: data.area
          });
      
      }

  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRj7J_sOaCmFfSFNvUL7Z-NX3uUvG_FTA&callback=initMap"></script>
@endpush
