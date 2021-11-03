@php
$photo_principal = \App\Models\ProductsImage::where('products_images.product_id', '=', $product->id)->where('products_images.is_principal', '=', 1)->join('images', 'products_images.image_id', '=', 'images.id')->first();
$first_photo = \App\Models\ProductsImage::where('products_images.product_id', '=', $product->id)->join('images', 'products_images.image_id', '=', 'images.id')->first();

if($first_photo){
	if($photo_principal){
		$img_prd = $photo_principal->filepath;
	}else{
		$img_prd = $first_photo->filepath;
	}
}else{
	$img_prd = 'images/product.png';
}

@endphp

@if($type == 'purchases')
    <div class="col-md-6 col-lg-4 m-15px-tb">
        <div class="price-table-01 active">
            <div class="pt-head">
                <p class="white-color font-15"><span>$</span> {{number_format($product->price, 0, '.', ' ')}}</p>
                <i class="fas fa-check"></i>
            </div>
            <div class="pt-body">
                <a href="{{route('product.index',['product'=>$product->slug])}}">
			        <img  class="feature-image" src="{{$product->imageUrl(false)}}" alt="{{$product->title}}">
			    </a>
            </div>
            <div class="pt-footer">
                <h5><a href="{{route('product.index',['product'=>$product->slug])}}">{{$product->title}}</a></h5>
            </div>
        </div>
    </div> <!-- col -->
@elseif($type == 'orders')
    <div class="col-md-6 col-lg-4 m-15px-tb">
        <div class="price-table-01">
            <div class="pt-head">
                <p class="white-color font-15"><span>$</span> {{number_format($product->price, 0, '.', ' ')}}</p>
            </div>
            <div class="pt-body">
                <a href="{{route('product.index',['product'=>$product->slug])}}">
			        <img  class="feature-image" src="{{$product->imageUrl(false)}}" alt="{{$product->title}}">
			    </a>
            </div>
            <div class="pt-footer">
                <h5><a href="{{route('product.index',['product'=>$product->slug])}}">{{$product->title}}</a></h5>
            </div>
        </div>
    </div> <!-- col -->
@elseif($type == 'products')
    <div class="col-sm-6 col-lg-4 m-15px-tb">
        <div class="box-shadow-hover hover-top white-bg our-team-hover-icon border-radius-3">
            <div class="p-10px team-img">
                <img src="{{asset($img_prd)}}" alt="{{$product->title}}">
            </div>
            <div class="p-5px-t p-20px-b text-center">
                <small>
					<i class="fa fa-map-marker"></i>
					{{ $product->location ? Illuminate\Support\Str::upper($product->location->locality.' '.$product->location->area_level_2.', '.$product->location->area_level_1.' '.$product->location->postalCode) : '' }}
				</small>
                <h6 class="m-10px-b font-w-600">
					<a class="dark-color" href="{{ route('programme.show', ['slug'=>$product->slug]) }}">{!! str_limit($product->title, 20, '...') !!}</a>
				</h6>
            </div>
            <div class="font-small p-5px-t p-20px-b text-center border-top-1 border-color-dark-gray">
				@if($product->category_id == 1)
                <a class="m-15px-r body-color font-w-500" href="#"><i class="fa fa-arrows-alt"></i> @lang('app.num.area', ['num'=>number_format($product->total_area, 0)])</a>
                <a class="body-color font-w-500" href="#"><i class="fa fa-bed"></i> @lang('app.num.bed', ['num'=>$product->bedrooms])</a>
                <a class="body-color font-w-500" href="#"><i class="fa fa-bath"></i> @lang('app.num.bath', ['num'=>$product->bathrooms])</a>
                <a class="body-color font-w-500" href="#"><i class="fa fa-car"></i> {{$product->garage_spaces?__('app.yes'):__('app.no')}}</a>
				@elseif($product->category_id == 2)
				<a class="m-15px-r body-color font-w-500" href="#"><i class="fa fa-arrows-alt"></i> {{$product->area}}&nbsp;{{$product->unite_area}}</a>
				@elseif($product->category_id == 4)
				
				@endif
            </div>
			@if($product->parent_id == 0)
            	<button type="button" class="m-btn m-btn-theme2nd font-w-500 ml-auto">AUD {{number_format($product->min_price, 0, '.', ' ')}}</button>
			@elseif($product->parent_id == -1)
				<button type="button" class="m-btn m-btn-theme2nd font-w-500 ml-auto">AUD {{number_format($product->price, 0, '.', ' ')}}</button>
			@else
				<button type="button" class="m-btn m-btn-theme2nd font-w-500 ml-auto">AUD {{number_format($product->min_price, 0, '.', ' ')}}</button>
			@endif
        </div>
    </div>
@elseif($type == 'favorites')
    <div class="col-sm-12 col-lg-12 m-10px-tb">
        <div class="card">
            <a href="{{route('product.index',['product'=>$product->slug])}}" class="media align-items-center lh-normal p-10px gray-bg">
                <div class="avatar-50 border-radius-50">
                    <img src="{{$product->imageUrl(false)}}" title="{{$product->title}}" alt="{{$product->title}}">
                </div>
                <div class="media-body p-10px-l">
                    <h6 class="font-w-600 m-0px">{{$product->title}}</h6>
                    <span class="font-small body-color"><span>$</span> {{number_format($product->price, 0, '.', ' ')}}</span>
                </div>
            </a>
        </div>
    </div>
@elseif($type == 'pins')
    <div class="col-sm-6 m-15px-tb">
	    <div class="card p-15px">
	        <div class="media align-items-center">
	            <div class="avatar-50 border-radius-50">
                    <img src="{{$product->imageUrl(false)}}" title="{{$product->title}}" alt="{{$product->title}}">
                </div>
	            <div class="media-body p-15px-l">
	                <h6 class="m-0px">{{$product->title}}</h6>
	                <p class="m-0px"><span>$</span> {{number_format($product->price, 0, '.', ' ')}}</p>
	            </div>
	        </div>
	    </div>
	</div>
@else
	<div class="col-sm-6 m-15px-tb">
        <div class="card p-15px">
            <div class="media align-items-center">
                <p>@lang('app.txt.nodata')</p>
            </div>
        </div>
    </div>
@endif


