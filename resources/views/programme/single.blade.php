@extends('layouts.app')

@section('content')

<!-- Main -->
<main>
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
                    <div class="nav p-25px-b">
                        <p class="h4 dark-color font-w-600">@lang('app.description')</p>
                    </div>
                    
                    <div class="text-justify">{!! $item->content !!}</div>

                    
                    <div class="comments-area m-40px-t m-50px-b">
                        <div class="card-body">
                            <p class="h6 m-30px-b">@lang('app.txt.loc_geo')</p>
                            <div id="map"></div>
                        </div>
                    </div>
                    
                    <div class="p-25px-tb m-35px-tb border-top-1 border-bottom-1 border-color-gray">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="m-0px">@lang('app.txt.all_products')</h5>
                            </div>
                        </div>
                    </div>
                    <div class="media p-20px">
                        <div class="container text-center">
                            <div class="row mx-auto my-auto">
                                <div id="myCarousel" class="carousel slide w-100" data-ride="carousel">
                                    <div class="carousel-inner w-100" role="listbox">
                                        
                                        @forelse (App\Models\Product::where('parent_id','=',$item->id)->get() as $prod)
                                            <div class="carousel-item @if($loop->first) active @endif">
                                                <div class="col-sm-3 col-md-6 col-lg-4">
                                                    <div class="thumb-wrapper">
                                                        <div class="img-box p-10px-b m-15px-b border-bottom-2 border-color-gray">
                                                            @php
                                                                try {
                                                                    if(file_get_contents($prod->imageUrl()));
                                                                    $img_prod=$prod->imageUrl();
                                                                } catch (\Throwable $th) {
                                                                    $img_prod=asset('images/iea.png');
                                                                }   
                                                            @endphp
                                                            <a href="{{route('product.index',['product'=>$prod->slug])}}" target="_blank"><img src="{{$img_prod}}" alt="{{$prod->title}}" class="img-fluid"></a>
                                                        </div>
                                                        <div class="thumb-content">
                                                            <p class="item-price"><span>$ {{number_format($prod->price, 0, '.', ' ')}}</span></p>
                                                            <div class="star-rating">
                                                                <ul class="list-inline">
                                                                    <a class="body-color font-w-500" href="#"><i class="fa fa-bed"></i> {{ $prod->bedrooms }}</a>
                                                                    <a class="body-color font-w-500" href="#"><i class="fa fa-bath"></i> {{ $prod->bathrooms }}</a>
                                                                    <a class="body-color font-w-500" href="#"><i class="fa fa-car"></i> {{$prod->garage_spaces?__('app.yes'):__('app.no')}}</a>
                                                                </ul>
                                                            </div>
                                                        </div>						
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div>
                                                <p>@lang('app.txt.no_product')</p>
                                            </div>
                                        @endforelse
    
                                    </div>
                                    @if (sizeOf(App\Models\Product::where('parent_id','=',$item->id)->get())>3)
                                        <a class="carousel-control-prev bg-dark w-auto" href="#myCarousel" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next bg-dark w-auto" href="#myCarousel" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    @endif
    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                    @include('includes.sidebar')
                <!-- fin sidebar -->

            </div>
        </div>
    </section>
    <!-- End Section -->
</main>

{{-- Modal --}}
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="commentModalLabel">@lang('app.txt.leavereply')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('comment.store') }}" method="POST" id="comment_form">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-control-label">@lang('app.txt.yourcomment')</label>
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <input type="hidden" name="blog_id" value="{{ $item->id }}">
                            <input type="hidden" name="reply_id" id="reply_id">
                            <textarea class="form-control" rows="6" name="content" placeholder="..." aria-label="How'd you hear about Front?" required="" data-msg="Please enter an answer." data-error-class="u-has-error" data-success-class="u-has-success"></textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="m-btn m-btn-theme" data-dismiss="modal">@lang('app.btn.close')</button>
          <button class="m-btn m-btn-theme" id="btn_reply_comment">@lang('app.btn.submit')</button>
        </div>
      </div>
    </div>
</div>
{{-- end modal --}}


{{-- Modal --}}
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">@lang('app.txt.login')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('login')}}" id="login_form" method="post">
                {{ csrf_field() }}
                {{ Session()->put('comment','login_comment') }}
                <div class="form-group">
                    <label class="form-control-label">@lang('app.txt.email')</label>
                    <input type="email" name="email" class="form-control" placeholder="Votre email *" required="required" value="{{ old('email') }}" autofocus>
                    <span>{{ $errors->has('email') ? ' has-error' : '' }}</span>
                </div>
                <div class="form-group">
                    <label class="form-control-label">@lang('app.txt.password')</label>
                    <input name="password"  type="password" placeholder="Votre mot de passe *" class="form-control" placeholder="***********" required="required">
                    <span>{{ $errors->has('password') ? ' has-error' : '' }}</span>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('app.form.login.remember')
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="m-btn m-btn-theme" data-dismiss="modal">@lang('app.btn.close')</button>
          <button type="button" id="btn_submit" class="m-btn m-btn-theme2nd">@lang('app.btn.login')</button>
        </div>
      </div>
    </div>
</div>
{{-- end modal --}}

@endsection


@push('script')
    <link rel="stylesheet" href="{{ asset('carousel/style.css') }}">
    <script src="{{ asset('carousel/popper.min.js') }}"></script>
    <script src="{{ asset('carousel/carousel.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
        $('#btn_comment').click(function(){
            $('#loginModal').modal('show');
        });

        $('#btn_submit').click(function(){
            $('#login_form').submit();
        });

        $(document).on('keypress',function(e) {
            if(e.which == 13) {
                $('#login_form').submit();
            }
        });

        $('.btn_reply').click(function(){
            var comment_id = $(this).attr('value');
            $('#commentModal').modal('show');
            $('#reply_id').attr('value',comment_id);
        });

        $('#btn_reply_comment').click(function(){
            $('#comment_form').submit();
        });
    </script>
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
@endpush('script')

