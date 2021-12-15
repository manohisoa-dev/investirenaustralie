
<div class="col-lg-4 md-m-15px-tb">
    {{-- FAVORIS --}}
    @if (Auth::user())
        @if (isset(App\Models\Label::where('author_id',Auth::id())->where('product_id',$item->id)->where('label','starred')->first()->id))
            <a href="{{route('label.remove', ['id'=>App\Models\Label::where('author_id',Auth::id())->where('product_id',$item->id)->where('label','starred')->first()->id])}}" title="@lang('app.txt.programme_in_favorites')" class="m-btn btn-warning dark-color flex-shrink-0 col-md-12"><i class="fa fa-star" aria-hidden="true"></i>  @lang('app.btn.star')</a>
        @else
            <a href="{{route('label.store', ['product'=>$item,'type'=>'starred'])}}" title="@lang('app.txt.programme_favorites')" class="m-btn m-btn-theme5rd dark-color flex-shrink-0 col-md-12"><i class="fa fa-star" aria-hidden="true"></i>  @lang('app.btn.star')</a>
        @endif
    @else
        <a href="{{route('label.store', ['product'=>$item,'type'=>'starred'])}}" title="@lang('app.txt.programme_favorites')" class="m-btn m-btn-theme5rd dark-color flex-shrink-0 col-md-12"><i class="fa fa-star" aria-hidden="true"></i>  @lang('app.btn.star')</a>
    @endif
    <br><br>
    {{-- CONTACT AFA --}}
    <a {{ Auth::check()? (Auth::user()->hasAfa()?'':'disabled') :'' }} href="javascript:void(0)" data-toggle="modal" data-target="#myModal" class="m-btn m-btn-theme2nd dark-color flex-shrink-0 col-md-12"><i class="fa fa-envelope" aria-hidden="true"></i>  @lang('app.btn.contact_afa')</a>
    <br><br>
    {{-- CONTACT APL --}}
    @if (Request::is('product/*'))
        <a href="{{ route('member.contact', ['role'=>'apl']) }}" class="m-btn m-btn-theme4rd dark-color flex-shrink-0 col-md-12"><i class="fa fa-envelope" aria-hidden="true"></i>  @lang('app.btn.contacter_apl')</a>
        <br><br>
    @endif
    {{-- LISTE DES APLS --}}
    <a href="{{route('apls')}}" class="m-btn m-btn-theme4rd flex-shrink-0 col-md-12" style="margin-bottom: 20px;">@lang('app.list_apl')</a>

    @if ($pubs)
        <div class="m-35px-t">
            <div class="card">
                <p class="text-center" style="font-size: 11px;">@lang('app.txt.advertisement')</p>
                @forelse ($pubs as $pub)
                    <div id="ads" class="ads-section col-lg-12 p-15px-tb white-bg">
                        <div class="ads-header col-lg-12 float-left p-5px-t p-20px-l p-10px-b border-top-1 border-color-gray">
                            <div class="row col-lg-12">
                                <div class="col-lg-6">
                                    <img src="{{ asset('images/ads-logo.png') }}" alt="logo_iea">
                                </div>
                                <div class="col-lg-6">
                                    <p class="text-right">{{getGTranslateAutoDetect( App::getLocale() ,$pub->title)}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="ads-content">
                            <a href="{{ $pub->links?$item->links:'#' }}" target="_blank"><img src="{{$pub->imageUrl()}}" alt=""></a>
                        </div>
                    </div>
                @empty
                    <div class="border-top-1 border-color-gray p-15px-tb text-center">@lang('app.txt.no_ads')</div>
                @endforelse
            </div>
        </div>
    @endif

    {{-- <div class="card m-35px-t">
        <div class="card-header bg-transparent">
            <span class="h5 m-0px font-w-600 dark-color">@lang('app.recent.product')</span>
        </div>
        <div class="list-group list-group-flush">
            @forelse($products as $product)
                @php
                    $photo_principal = \App\Models\ProductsImage::where('products_images.product_id', '=', $product->id)->where('products_images.is_principal', '=', 1)->join('images', 'products_images.image_id', '=', 'images.id')->first();
                    $first_photo = \App\Models\ProductsImage::where('products_images.product_id', '=', $product->id)->join('images', 'products_images.image_id', '=', 'images.id')->first();
                @endphp
                @if($first_photo)
                    @if($photo_principal)
                        <!-- Programme sans principal -->
                        @php
                            //$img = asset($photo_principal->filename)
                            $img_prod = asset(getImageResizeUrl('product', str_replace(' ', '%20', $photo_principal->filename), 'mini'))
                        @endphp
                    @else
                        <!-- Programme principal -->
                        @php
                            //$img = asset($first_photo->filename)
                            $img_prod = asset(getImageResizeUrl('product', str_replace(' ', '%20', $first_photo->filename), 'mini'))
                        @endphp
                    @endif
                @else
                    <!-- Programme aucun photo -->
                    @php
                        $img_prod= asset('images/product.png');
                    @endphp
                @endif	

            <a href="{{route('product.index',['product'=>$product->slug])}}" class="list-group-item list-group-item-action d-flex p15px-tb">
                <div>
                    <div class="avatar-50 border-radius-5">
                        <img src="{{$img_prod}}" title="{{$product->title}}" alt="{{$product->title}}" />
                    </div>
                </div>
                <div class="p-15px-l">
                    <p class="m-0px">{{$product->title}}</p>
					@if($product->parent_id == -1)
                    	<span class="btn btn-price">AUD {{number_format($product->price, 0, '.', ' ')}}</span>
					@else
						<span class="btn btn-price">AUD {{number_format($product->min_price, 0, '.', ' ')}}</span>
					@endif
                </div>
            </a>
            <div class="social-icon si-30 theme2nd radius nav justify-content-center p-10px-t" style="padding-bottom: 7px;padding-top: 5px;">
			    
				@if($product->category_id == 1)
				<!-- icon produit r�sidentiel -->
                <a class="m-15px-r body-color font-w-500" href="#"><i class="fa fa-arrows-alt"></i></a> @lang('app.num.area', ['num'=>number_format($product->total_area, 0)])
                <a class="body-color font-w-500" href="#"><i class="fa fa-bed"></i></a> @lang('app.num.bed', ['num'=>$product->bedrooms])
                <a class="body-color font-w-500" href="#"><i class="fa fa-bath"></i></a> @lang('app.num.bath', ['num'=>$product->bathrooms])
                <a class="body-color font-w-500" href="#"><i class="fa fa-car"></i></a> {{$product->garage_spaces?__('app.yes'):__('app.no')}}
				@elseif($product->category_id == 2)
				<a class="m-15px-r body-color font-w-500" href="#"><i class="fa fa-arrows-alt"></i></a> {{$product->area}}&nbsp;{{$product->unite_area}}
				@elseif($product->category_id == 3)
				
				@elseif($product->category_id == 4)
				
				@endif
				
            </div>
            @empty
                <div class="p-15px-tb text-center">@lang('app.txt.no_product_found')</div>
            @endforelse
        </div>
    </div> --}}

    @if(\Auth::check()&&\Auth::user()->hasRole('member'))
        <div class="card m-35px-t">
            <section class="widget recent-properties clearfix">
                <a href="{{route('member.contact', ['role'=>'admin'])}}" class="m-btn m-btn-theme col-sm-12"><i class="fa fa-envelope-open-o"></i> @lang('app.btn.contact_admin')</a>
                <a href="{{route('member.contact', ['role'=>'apl'])}}" class="m-btn m-btn-theme4rd col-sm-12"><i class="fa fa-envelope-open-o"></i> @lang('app.btn.contact_apl')</a>
            </section>
        </div>
    @endif

    {{-- <div class="card m-35px-t">
        <div class="card-header bg-transparent">
            <span class="h5 m-0px font-w-600 dark-color">@lang('app.recent.category')</span>
        </div>

        <div class="list-group list-group-flush">
            @forelse($categories as $category)
            <a href="{{route('programme.all', \App\Models\Category::find($category->id))}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                <div>
                    <span class="theme2nd-bg p-5px-tb p-10px-lr border-radius-15 white-color small">{{$category->products_count}}</span> <span> {{ trans('app.txt.'.$category->title) }} </span>
                </div>
                <div>
                    <i class="ti-angle-right"></i>
                </div>
            </a> --}}
            {{-- <span class="row justify-content-sm-between align-items-sm-center">
                    <span class="col-sm-6 m-5px-tb dark-color">
                        Business 
                    </span>
                    <span class="col-sm-6 m-5px-tb text-sm-right">
                        <span class="theme2nd-bg p-5px-tb p-10px-lr border-radius-15 white-color small">Chicago, US<i class="fas fa-arrow-right small m-5px-l"></i></span>
                    </span>
                </span>
            <span> {{ trans('app.txt.'.$category->title) }} </span><span class="theme2nd-bg p-5px-tb p-10px-lr border-radius-15 white-color small">{{$category->products_count}}<i class="fas fa-arrow-right small m-5px-l"></i></span> --}}
            {{-- @empty
                <div class="p-15px-tb col-lg-12 text-center"> @lang('app.txt.noinfo') </div>
            @endforelse
        </div> 
    </div> --}}

</div>