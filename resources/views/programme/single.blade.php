@extends('layouts.app')

@section('content')

<!-- Main -->
<main>
    <!-- Page Title -->
    @php
        if(@getimagesize($item->imageUrl())){
            $img=$item->imageUrl();
        }
        else{
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
                            <p class="m-0px" style="color: #ffffff !important;">{{ $item->location ? Illuminate\Support\Str::upper($item->location->locality.' '.$item->location->area_level_2.', '.$item->location->area_level_1.' '.$item->location->postalCode) : '' }}</p>
                        </div>
                    </div>

                    <div class="p-25px-t row col-lg-12">
                        <div class="col-lg-6 col-sm-6">
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" class="m-btn m-btn-theme2nd dark-color flex-shrink-0 col-md-12"><i class="fa fa-envelope" aria-hidden="true"></i>  @lang('app.btn.contact_afa')</a>
                        </div>
                        <div class="col-lg-6 col-sm-6">

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
                    {{-- Show progam image --}}
                    @if(count($item->images))
                    <div id="myCarousel" class="carousel slide w-100" data-ride="carousel">
                        <div class="carousel-inner w-100" role="listbox">
                            @foreach ($item->images as $key=>$it)
                                <div class="carousel-item carousel-item-prod @if($loop->first) active @endif">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="thumb-wrapper">
                                            <div class="img-box p-10px-b m-15px-b border-bottom-2 border-color-gray">
                                                <div class="grid-item product branding {{ $item->isParticular()?'border-particular':'' }}">
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
                                                                <h5><a href="#">{{ $item->title }}</a></h5>
                                                            </div>
                                                            <a href="javascript:void(0)" value="{{ $key }}" class="gallery-link pop">
                                                                <i class="ti-plus"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Badge agence exclusive --}}
                                                @if($item->isExclusiveAgency())
                                                    <span class="notify-badge-prod">@lang('app.txt.priority_agency')</span>
                                                @endif
                                                
                                                {{-- Cocarde --}}
                                                @if($item->isParticular())
                                                    <span class="border-particular-cocarde-2"></span>
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
                                            <h5><a href="#">{{ $item->title }}</a></h5>
                                        </div>
                                        <a href="javascript:void(0)" value="0" class="gallery-link pop">
                                            <i class="ti-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="nav p-25px-b">
                        <p class="h4 dark-color font-w-600">@lang('app.description')</p>
                    </div>
                    
                    <div class="text-justify">{!! $item->content !!}</div><br />
					
					<!-- fond de dossier -->
					@if ($dossier)
					<div class="nav p-25px-b">
						<p class="h4 dark-color font-w-600">@lang('app.form.programme_fond_dossier') {{Auth::user()->id}}</p>
					</div>
					<div>
					@foreach ($dossier as $dossie )		
						<div class="file-box">
							<div class="file">
								@if(setIconFile($dossie->filepath) == 'images')
									<a href="{{asset($dossie->filepath)}}" class="fancyboxLink">
								@elseif(setIconFile($dossie->filepath) == 'pdf')
									<a class="fancybox-pdf" data-fancybox-type="iframe" href="http://docs.google.com/viewer?embedded=true&url={{asset(urlencode($dossie->filepath))}}">
								@else
									<a href="https://docs.google.com/viewer?url={{asset(urlencode($dossie->filepath))}}&embedded=true" class="fancyboxLinkDoc" data-fancybox-type="iframe">
								@endif
									<span class="corner"></span>	
									@if(setIconFile($dossie->filepath) == 'images')
										<div class="image">
											<img alt="image" class="img-fluid" src="{{asset($dossie->filepath)}}">
										</div>
									@endif	
									@if(setIconFile($dossie->filepath) == 'pdf')
										<div class="icon">
											<i class="fa fa-file-pdf"></i>
										</div>
									@endif	
									@if(setIconFile($dossie->filepath) == 'doc')
										<div class="icon">
											<i class="fa fa-file-word"></i>
										</div>
									@endif
									@if(setIconFile($dossie->filepath) == 'excel')
										<div class="icon">
											<i class="fa fa-file-excel"></i>
										</div>
									@endif	
									@if(setIconFile($dossie->filepath) == 'file')
										<div class="icon">
											<i class="fa fa-file"></i>
										</div>
									@endif									
									<div class="file-name">
										@php
											$filename = $dossie->filename;
											$filename = preg_replace('/^(.*)\-\d{8,}\.(gif|jpg|png|pdf)$/', '$1.$2', $filename);
										@endphp
										<label style="text-transform:lowercase">{{str_limit($filename, 15)}}</label>
									</div>
								</a>
							</div>
						</div>
					@endforeach	
						<div style="clear:both"></div>
					</div>
					@endif 
					<!-- fond de dossier -->

                    
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
                                        
                                        @forelse (App\Models\Product::where('parent_id','=',$item->id)->where('status','=','published')->get() as $prod)
                                            <div class="carousel-item @if($loop->first) active @endif">
                                                <div class="col-sm-3 col-md-6 col-lg-4">
                                                    <div class="thumb-wrapper">
                                                        <div class="img-box p-10px-b m-15px-b border-bottom-2 border-color-gray">
                                                            @php
                                                                $photo_principal = \App\Models\ProductsImage::where('products_images.product_id', '=', $prod->id)->where('products_images.is_principal', '=', 1)->join('images', 'products_images.image_id', '=', 'images.id')->first();
                                                                $first_photo = \App\Models\ProductsImage::where('products_images.product_id', '=', $prod->id)->join('images', 'products_images.image_id', '=', 'images.id')->first();
                                                            @endphp
                                                            @if($first_photo)
                                                                @if($photo_principal)
                                                                <!-- Programme sans principal -->
                                                                @php $img = asset($photo_principal->filepath) @endphp
                                                                @else
                                                                <!-- Programme principal -->
                                                                @php $img = asset($first_photo->filepath) @endphp
                                                                @endif
                                                            @else
                                                                <!-- Programme aucun photo -->
                                                                @php $img = asset('images/product.png') @endphp
                                                            @endif	
                                                            <a href="{{route('product.index',['product'=>$prod->slug])}}" target="_blank"><img src="{{$img}}" alt="{{$prod->title}}" class="img-fluid"></a>
                                                        </div>
                                                        <div class="thumb-content">
                                                            <p class="item-price"><span>$ {{number_format($prod->min_price, 0, '.', ' ')}}</span></p>
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
                    <div>
                        <a href="{{ url()->previous() }}" class="m-btn m-btn-theme"><i class="fa fa-arrow-left"></i> @lang('app.btn.return')</a>
                    </div>

                    <div class="m-35px-t" style="color:#323232;">
                        <small><em>@lang('app.txt.advertisers_statement')</em></small>
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


<!-- modal -->
<div class="container">
    <div class="modal left fade" id="myModal" tabindex="" role="dialog" aria-labelledby="listAfaModalLabel" aria-hidden="true">
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
  <!-- Fin modal -->

@endsection


@push('script')
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2izG_M7K3gP6pFUH5cyzmDjuGpOYfgc4&libraries=places&callback=initMap&channel=GMPSB_addressselection_v1_cABC" async defer></script>
	@php
		if(isset($location) && $location->latitude != '' && $location->longitude != ''){
			$latitude = $location->latitude;
			$longitude = $location->longitude;
		}else{
			$latitude = -25.647467468105795;
			$longitude = 146.89921517372136;
		}
	@endphp
    <link rel="stylesheet" href="{{ asset('carousel/style.css') }}">
	<link rel="stylesheet" href="{{ asset('plugin/fancybox/jquery.fancybox.css') }}" type="text/css" media="screen" />
    <style>
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

        .border-particular-cocarde-2{
            position: absolute;
            left: 85%;
            top: 70%;
            text-align: center;
            background: none;
            color:#AE4435;
            padding:5px 10px;
            font-size:14px;
            content: url('../images/ico/cocarde.png')
        }
    </style>
    <script src="{{ asset('carousel/popper.min.js') }}"></script>
    <script src="{{ asset('carousel/carousel.js') }}"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
		$(document).ready(function(){
			$("a.fancyboxLink").fancybox();			
			$("#fancybox-pdf").fancybox({
				openEffect  : 'none',
				closeEffect : 'none',
				iframe : {
					preload: false
				}
			});
			$("a.fancyboxLinkDoc").fancybox({
				type: "iframe"
			});
		});
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
          $('#afa-form-modal').submit(function(event){
              if($('#check-confirm-modal').is(":checked"))
              {
                  $('.row-confirm-modal').removeClass('hidden');
              }
              else{
                alert('Veuillez accepter les termes et les conditions AFA !');
                event.preventDefault();
              }
          });
      </script>
      <script>
          var _map;
          var _geocoder;
          var _marker;
          var _circle;
          var _lat = {{$latitude}};
          var _long = {{$longitude}};
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
@endpush('script')

