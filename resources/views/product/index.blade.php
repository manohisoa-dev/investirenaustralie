@extends('layouts.app')

@section('content')

<!-- Main -->
<main>
    <!-- Page Title -->
    @php
        if(@getimagesize($item->imageUrl())) {
            $img=$item->imageUrl();
        } else {
            $img=asset('images/blog/iea.png');
        }   
    @endphp
    <section class="bg-center bg-cover bg-fiexd effect-section" style="background-image: url({{ $img }});">
        <div class="mask dark-g-bg opacity-7"></div>
        <div class="container">
            <div class="row screen-65 justify-content-center align-items-center p-100px-tb">
                <div class="col-lg-10 text-center m-50px-t">
                    <h1 class="display-4 white-color m-25px-b">{{getGTranslateAutoDetect( App::getLocale() ,$item->title)}}</h1>
                    <div class="d-flex align-items-center m-25px-t justify-content-center text-left">
                        <div class="p-15px-l">
                            <p class="white-color m-0px"><span class="white-color">{{ $item->location ? Illuminate\Support\Str::upper($item->location->locality.' '.$item->location->area_level_2.', '.$item->location->area_level_1.' '.$item->location->postalCode) : '' }}</span></p>
                        </div>
                    </div>

                    <div class="p-25px-t row col-lg-12">
                        <div class="col-lg-4 col-sm-6">
                          <a {{ Auth::check()? (Auth::user()->hasAfa()?'':'disabled') :'' }} href="{{ route('member.contact',['role'=>'afa']) }}" id="contact_afa" value="{{ Session::has('has_afa')?1:0 }}" class="m-btn m-btn-theme2nd dark-color flex-shrink-0 col-md-12"><i class="fa fa-envelope" aria-hidden="true"></i>  @lang('app.btn.contact_afa')</a>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                          <a href="{{ route('member.contact', ['role'=>'apl']) }}" class="m-btn m-btn-theme4rd dark-color flex-shrink-0 col-md-12"><i class="fa fa-envelope" aria-hidden="true"></i>  @lang('app.btn.contacter_apl')</a>
                        </div>
                        <div class="col-lg-4 col-sm-6">

                            @if (Auth::check())
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
                  @if(count($item->images))
                  <div id="myCarousel" class="carousel slide w-100" data-ride="carousel">
                      <div class="carousel-inner w-100" role="listbox">
                          @foreach ($item->images as $key=>$it)
                            <div class="carousel-item carousel-item-prod @if($loop->first) active @endif">
                                <div class="col-md-12 col-sm-12">
                                    <div class="thumb-wrapper">
                                        <div class="img-box p-10px-b m-15px-b border-bottom-2 border-color-gray">
                                          <div class="grid-item product branding">
                                            <div class="portfolio-box-02">
                                                <div class="portfolio-img">
                                                  @php
                                                    $img_prod = "";
                                                      if(@getimagesize(App\Models\Image::whereId($it->pivot->image_id)->first()->filepath)) { 
                                                        $img_prod=App\Models\Image::whereId($it->pivot->image_id)->first()->filepath;
                                                      } else {
                                                        $img_prod=asset('images/iea.png');
                                                      }   
                                                  @endphp
                                                  <a href="javascript:void(0)"><img src="{{asset($img_prod)}}" alt="{{$it->title}}" class="img-fluid imageresource{{ $key }}"></a>
                                                </div>
                                                <div class="portfolio-info">
                                                    <div class="portfolio-desc">
                                                        <h5><a href="#">{{ getGTranslateAutoDetect( App::getLocale() ,$item->title) }}</a></h5>
                                                    </div>
                                                    <a href="javascript:void(0)" value="{{ $key }}" class="gallery-link pop">
                                                        <i class="ti-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                          </div>
                                          {{-- Badge agence exclusive --}}
                                          @if(!$item->isExclusiveAgency())
                                            <span class="notify-badge-prod">@lang('app.txt.exclusive_agency')</span>
                                          @endif
                                        </div>
                                    </div>
                                </div>
                            </div>    
                          @endforeach                            
                          <a class="carousel-control-prev bg-dark w-auto" href="#myCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">@lang('app.btn.prev')</span>
                          </a>
                          <a class="carousel-control-next bg-dark w-auto" href="#myCarousel" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">@lang('app.btn.next')</span>
                          </a>
                      </div> 
                  </div>
                  @else
                    <div class="col-md-12 col-sm-12">
                      <div class="thumb-wrapper">
                          <div class="img-box p-10px-b m-15px-b border-bottom-2 border-color-gray">
                            <div class="grid-item product branding">
                              <div class="portfolio-box-02">
                                  <div class="portfolio-img">
                                    @php
                                        if(@getimagesize($item->imageUrl())) {
                                            $img=$item->imageUrl();
                                        } else {
                                            $img=asset('images/iea.png');
                                        } 
                                    @endphp
                                    <a href="javascript:void(0)"><img src="{{$img}}" alt="{{$item->title}}" class="img-fluid imageresource0"></a>
                                  </div>
                                  <div class="portfolio-info">
                                      <div class="portfolio-desc">
                                          <h5><a href="#">{{ getGTranslateAutoDetect( App::getLocale() ,$item->title) }}</a></h5>
                                      </div>
                                      <a href="javascript:void(0)" value="0" class="gallery-link pop">
                                          <i class="ti-plus"></i>
                                      </a>
                                  </div>
                              </div>
                            </div>
                            {{-- Badge agence exclusive --}}
                            @if(!$item->isExclusiveAgency())
                              <span class="notify-badge-prod">@lang('app.txt.exclusive_agency')</span>
                            @endif
                          </div>
                      </div>
                  </div>
                  @endif

                  <section class="property-meta-wrapper common">
                    <div class="row m-15px-t">
                        <div class="col-sm-6">
                          {{-- @if(Auth::check() && Auth::user()->hasRole(5)) --}}
                            <button type="button" id="btn_buy" class="m-btn m-btn-theme4rd flex-shrink-0 col-md-12"><i class="fa fa-shopping-cart"></i> @lang('app.btn.add_to_cart')</button>
                          {{-- @else
                            <button type="button" class="m-btn m-btn-theme4rd flex-shrink-0 col-md-12" disabled title="@lang('app.txt.logintocontinue')"><i class="fa fa-shopping-cart"></i> @lang('app.btn.add_to_cart')</button>
                          @endif --}}
                        </div>
                        <div class="col-sm-6">
                          <a href="{{route('member.go.there', $item )}}" id="btn_go_there" value="{{ Session::has('engagement')?1:0 }}" class="m-btn m-btn-theme flex-shrink-0 col-md-12" title="@lang('app.txt.go_to_location')" @if(Auth::check()) {{ Auth::user()->isMove()?'disabled':'' }} @endif><i class="fa fa-map-marker"></i> @lang('app.btn.go_to_location')</a>
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
                            <input type="hidden" id="prod_loc_lat" value="{{ $location->latitude }}">
                            <input type="hidden" id="prod_loc_long" value="{{ $location->longitude }}">
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
                            <p>{!! getGTranslateAutoDetectBd('programme',$item)?getGTranslateAutoDetectBd('programme',$item):$item->content !!}</p>
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
                        <label>@lang('app.txt.condition_days_apl', ['nbDay'=>App\Models\Parameter::nbDayEndApl()])</label>  
                    </div>
                    <div class="col-md-5">
                      <button class="m-btn m-btn-theme" data-dismiss="modal" aria-hidden="true">@lang('app.btn.cancel')</button>
                    </div> 
                  @endif
              </div>
          </div>
      </div>
  </div>
</div>
<!-- End list APL modal -->

<!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <img src="" id="imagepreview" style="width: auto; height: auto;" >
      </div>
    </div>
  </div>
</div>

<!-- Modal for member and afa engagement -->
<div id="engagementModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
      <div class="modal-content white-bg">
          <div class="modal-header border-radius-0" style="background-color: #AE4435 !important;">
              <h4 class="modal-title white-color">@lang('app.message')</h4>
          </div>
          <div class="modal-body">
            {!! Session()->get('engagement') !!}

            @if(Session()->get('hasAfa')===0)  
              <hr>
              <div>
                  <div class="form-group m-25px-t m-50px-b">
                      <div class="custom-control custom-checkbox m-10px-b">
                          <input type="checkbox" class="custom-control-input" name="condition[]" id="checkbox-1" required>
                          <label class="custom-control-label" for="checkbox-1"><b>@lang('member.gothere.select_afa.checkbox.1') *</b></label>
                      </div>
                      <div class="custom-control custom-checkbox m-10px-b">
                          <input type="checkbox" class="custom-control-input" name="condition[]" id="checkbox-2" required>
                          <label class="custom-control-label" for="checkbox-2"><b>@lang('member.gothere.select_afa.checkbox.2') *</b></label>
                      </div>
                      <div class="custom-control custom-checkbox m-10px-b">
                        <input type="checkbox" class="custom-control-input" name="condition[]" id="checkbox-3" required>
                        <label class="custom-control-label" for="checkbox-3"><b>@lang('member.gothere.select_afa.checkbox.3') *</b></label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" name="condition[]" id="checkbox-4" required>
                      <label class="custom-control-label" for="checkbox-4"><b>@lang('member.gothere.select_afa.checkbox.4') *</b></label>
                  </div>
                  </div>
              </div>
              <div class="m-25px-b">
                <a type="button" id="btnSelectAfa" class="m-btn m-btn-theme2nd col-md-12" disabled href="{{ route("member.select.afa", $item) }}" >{{ strtoupper(trans('app.select_afa')) }}</a>
              </div>
              <div>
                  <p>@lang('app.txt.cordial_greetings')</p>
                  <p>@lang('app.app_name')</p>
              </div>
            @endif
          </div>
          <div class="modal-footer">
            @if (!Session::has('waiting'))
              <a type="button" class="pull-left m-btn m-btn-theme" id="btn_cancel" href="javascript:void(0)" data-dismiss="modal">@lang('app.btn.abandonner')</a>
            @else
              @if (Session::get('waiting')===0)
                <a type="button" class="m-btn m-btn-theme2nd" href="javascript:void(0)" id="btn_continue_mandat_recherche">@lang('app.btn.continuer')</a>
              @else
                <a type="button" class="m-btn m-btn-theme2nd" href="javascript:void(0)" data-dismiss="modal" id="btn_continue">@lang('app.btn.ok')</a>  
              @endif
            @endif
          </div>
      </div>
  </div>
</div>


<!-- Modal of member has afa -->
<div id="memberHasAfaModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
      <div class="modal-content white-bg">
          <div class="modal-header border-radius-0" style="background-color: #AE4435 !important;">
              <h4 class="modal-title white-color">@lang('app.txt.information')</h4>
          </div>
          <div class="modal-body">
            {!! Session()->get('has_afa') !!}
          </div>
          <div class="modal-footer">
              <a type="button" class="m-btn m-btn-theme2nd" href="javascript:void(0)" data-dismiss="modal">@lang('app.btn.ok')</a>
          </div>
      </div>
  </div>
</div>

<!-- Modal for particular member registration -->
@if (Auth::check() && Auth::user()->hasRole(5))
  <div id="registratorMemberFormModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="registratorMemberFormLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header border-radius-0" style="background-color: #AE4435 !important;">
            <h4 class="modal-title white-color">@lang('app.txt.complete_registration')</h4>
        </div>
        <div class="modal-body">
            @include('login.memberpart',['user'=>Auth::user()])
        </div>
        {{-- <div class="modal-footer"></div> --}}
      </div>
    </div>
  </div>
@endif
@endsection
    
@push('script')
  <link rel="stylesheet" href="{{ asset('carousel/style.css') }}">
  <link href="{{ asset('plugin/magnific/magnific-popup.css') }}" rel="stylesheet">
  <script src="{{ asset('carousel/popper.min.js') }}"></script>
  <script src="{{ asset('carousel/carousel.js') }}"></script>
  <style>
    #map{
      height: 25rem;
    }

    .notify-badge-prod{
        position: absolute;
        left: 15px;
        top: 50px;
        text-align: center;
        background: rgba(255,255,255, 0.8);
        color:#AE4435;
        padding:5px 10px;
        font-size:14px;
    }
  </style>
  <script>
    $(document).ready(function(){
      var eng = $('#btn_go_there').attr('value');
      var hasAfa = $('#contact_afa').attr('value');

      // show engagement modal
      if(eng !== '0'){
        $('#engagementModal').modal('show');
      }

      // show has afa modal
      if(hasAfa !== '0'){
        $('#memberHasAfaModal').modal('show');
      }

    });
  </script>
  <script>
        $('#btn_continue_mandat_recherche').click(function(event){
          // Load icon
          loadingPage();

          // Send message to member from iea with Mandat Agence Immobilière
          $.ajax({
            url:'{{ route("member.ajaxSendMandatIeaToMember") }}',
            type:'get',
            dataType:'json',
            success:function(data){
              return location.href="{{route('member.contact', ['role'=>'admin'])}}";
            }
          }); 
        });


        $('#btn_continue').click(function(event){
          if($('#condition').is(":checked"))
          {
              event.preventDefault();
              window.location.replace("{{  route('member.send.courriel')  }}");
          }else{
             $('.message-error p').html('{{ trans("afa.accept_term") }}')
          }
        });

        // Show image product in modal
        $(".pop").on("click", function() {
          var id = $(this).attr('value');
          $('#imagepreview').attr('src', $('.imageresource'+id).attr('src')); // here asign the image to the modal when the user click the enlarge link
          $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
        });
  </script>
  <script>
      
      var _map;
      var _geocoder;
      var _marker;
      var _circle;
      var _lat = parseInt($('#prod_loc_lat').val())?parseInt($('#prod_loc_lat').val()):-25.647467468105795;
      var _long = parseInt($('#prod_loc_long').val())?parseInt($('#prod_loc_long').val()):146.89921517372136;
      var _btnSubmit = document.getElementById("submit");
      var _inputApl = document.getElementById("apl");
      var _contentApl = document.getElementById("apl-content");
      var _titleApl = document.getElementById("apl-title");
      console.log(_lat+' '+_long);
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
      
      var data = "{{ (isset($data) ? $data : '') }}";
      
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
      
      };

  </script>
  <script>
    $('#btn_buy').click(function(){
      if('{{ Auth::check() }}'){
        var usrIsCplt = '{{  Auth::check()?Auth::user()->isComplete():''  }}';

        if(usrIsCplt === ''){
          // Show particular member registration Modal
          $('#registratorMemberFormModal').modal('show');
        }else{
          if('{{ Auth::check() && Auth::user()->hasAfa() }}'){
            alert('continue procecus');
          }else{
            location.href="{{ route('member.select.afa', $item->slug) }}";
          }
        }
      }else{
        location.href="{{route('member.buy.product', $item)}}";
      }
       
    });
  </script>
  <script>
    // Script verification checked condition befor afa selection
    $('#checkbox-1').click(function(){
      verifyCheckboxCondition();
    });

    $('#checkbox-2').click(function(){
      verifyCheckboxCondition();
    });

    $('#checkbox-3').click(function(){
      verifyCheckboxCondition();
    });

    $('#checkbox-4').click(function(){
      verifyCheckboxCondition();
    });

    $('#btn_go_there').click(function(){
      loadingPage();
    });

    function verifyCheckboxCondition(){
      var checkCondition = $('[name="condition[]"]:checked');

      if(checkCondition.length === 4){
        $('#btnSelectAfa').removeAttr('disabled');
      }else{
        $('#btnSelectAfa').attr('disabled','disabled');
      }

      return false;
    }
  </script>
@endpush
