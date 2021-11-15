@foreach($items as $item)
    <div class="col-sm-6 col-lg-4 m-15px-tb">
        <div class="box-shadow-hover hover-top white-bg our-team-hover-icon border-radius-3">
            <div class="p-10px team-img">
				@php
                    $photo_principal = \App\Models\ProductsImage::where('products_images.product_id', '=', $item->id)->where('products_images.is_principal', '=', 1)->join('images', 'products_images.image_id', '=', 'images.id')->first();
                    $first_photo = \App\Models\ProductsImage::where('products_images.product_id', '=', $item->id)->join('images', 'products_images.image_id', '=', 'images.id')->first();
                @endphp
                @if($first_photo)
                    @if($photo_principal)
                        <!-- Programme sans principal -->
                        @php
                            //$img = asset($photo_principal->filename)
                            $img = asset(getImageResizeUrl('product', $photo_principal->filename, 'medium'))
                        @endphp
                    @else
                        <!-- Programme principal -->
                        @php
                            //$img = asset($first_photo->filename)
                            $img = asset(getImageResizeUrl('product', $first_photo->filename, 'medium'))
                        @endphp
                    @endif
                @else
                    <!-- Programme aucun photo -->
                    @php $img = asset('images/product.png') @endphp
                @endif	
                <img src="{{$img}}" alt="{{$item->title}}" style="height:180px">
            </div>
            <div class="p-5px-t p-20px-b text-center">
                <small><i class="fa fa-map-marker"></i> 

                {{  $item->location? (isset($page_id) ? substr(strip_tags($item->location->toString()), 0, 25) : $item->location->toString()) :''}}</small>
                
                <h6 class="m-10px-b font-w-600"><a class="dark-color" href="{{route('product.index',['product'=>$item->slug])}}">{!! $item->title !!}</a></h6>

            </div>
            <div class="font-small p-5px-t p-20px-b text-center border-top-1 border-color-dark-gray">
				@if($item->category_id == 1)
				<!-- icon produit r�sidentiel -->
                <a class="m-15px-r body-color font-w-500" href="#"><i class="fa fa-arrows-alt"></i> @lang('app.num.area', ['num'=>number_format($item->total_area, 0)])</a>
                <a class="body-color font-w-500" href="#"><i class="fa fa-bed"></i> @lang('app.num.bed', ['num'=>$item->bedrooms])</a>
                <a class="body-color font-w-500" href="#"><i class="fa fa-bath"></i> @lang('app.num.bath', ['num'=>$item->bathrooms])</a>
                <a class="body-color font-w-500" href="#"><i class="fa fa-car"></i> {{$item->garage_spaces?__('app.yes'):__('app.no')}}</a>
				@elseif($item->category_id == 2)
				<a class="m-15px-r body-color font-w-500" href="#"><i class="fa fa-arrows-alt"></i> {{$item->area}}&nbsp;{{$item->unite_area}}</a>
				@elseif($item->category_id == 3)
				
				@elseif($item->category_id == 4)
				
				@endif
            </div>
			@if($item->parent_id == -1)
            <button type="button" class="m-btn m-btn-theme2nd font-w-500 ml-auto">AUD {{number_format($item->price, 0, '.', ' ')}}</button>
			@else
			<button type="button" class="m-btn m-btn-theme2nd font-w-500 ml-auto">AUD {{number_format($item->min_price, 0, '.', ' ')}}</button>
			@endif
        </div>
    </div>
@endforeach

