@extends('layouts.app')

@section('content')
<!-- Main -->
<main>
    @component('includes.breadcrumb')
        @lang('Products')
    @endcomponent
    <!-- Section -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
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
                  <figure class="figure"><img src="{{$item->imageUrl()}}" alt="{{$item->title}}" class="img-fluid shadow rounded">
                      <figcaption class="m-15px-t dark-color"><h4>{{$item->title}}</h4></figcaption>
                  </figure> 
                  @endif

                  <section class="property-meta-wrapper common">
                    <!-- @include('includes.alerts') -->
                    <div class="row">
                        <div class="col-sm-9">
                            <form action="{{route('shop.order', ['product'=>$item->slug])}}" method="post">
                                {{csrf_field()}}
                                <button type="submit" class="m-btn m-btn-theme4rd flex-shrink-0 col-md-12"><i class="fa fa-shopping-cart"></i> @lang('app.btn.add_to_cart')</button>
                            </form>
                        </div>
                        <div class="col-sm-3">
                          <a href="{{route('label.store', ['product'=>$item,'type'=>'starred'])}}" class="m-btn btn-warning dark-color flex-shrink-0 col-md-12"><i class="fa fa-star" aria-hidden="true"></i>  @lang('app.btn.star')</a>
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
                          {{-- <div class="p-15px white-bg box-shadow">
                            <div class="embed-responsive embed-responsive-21by9">
                                <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3151.840107317064!2d144.955925!3d-37.817214!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb6899234e561db11!2sEnvato!5e0!3m2!1sen!2sin!4v1520156366883" allowfullscreen=""></iframe>
                            </div>
                          </div> --}}
                      </div>
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
