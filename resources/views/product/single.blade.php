<div class="col-sm-12 col-lg-12 m-15px-tb">
    <div class="box-shadow-hover hover-top white-bg our-team-hover-icon border-radius-3">
        <div class="p-10px team-img">
			@php
				$photo_principal = \App\Models\ProductsImage::where('products_images.product_id', '=', $item->id)->where('products_images.is_principal', '=', 1)->join('images', 'products_images.image_id', '=', 'images.id')->first();
				$first_photo = \App\Models\ProductsImage::where('products_images.product_id', '=', $item->id)->join('images', 'products_images.image_id', '=', 'images.id')->first();
				
			@endphp
			@if($first_photo)
				@if($photo_principal)
				<!-- Programme sans principal -->
				<img src="{{asset($photo_principal->filepath)}}" alt="{{$item->title}}" />
				@else
				<!-- Programme principal -->
				<img src="{{asset($first_photo->filepath)}}" alt="{{$item->title}}" />
				@endif
			@else
				<!-- Programme aucun photo -->
				<img class="img-responsive" src="{{asset('images/product.png')}}">
			@endif
									
            
        </div>
        <div class="p-5px-t p-20px-b text-center">
            <small><i class="fa fa-map-marker"></i> 
                
            {{  $item->location? (isset($page_id) ? substr(strip_tags($item->location->toString()), 0, 25) : $item->location->toString()) :''}}</small>
            
            <h6 class="m-10px-b font-w-600"><a class="dark-color" href="{{route('product.index',['product'=>$item->slug])}}">{{$item->title)}}</a></h6>

        </div>
        <div class="font-small p-5px-t p-20px-b text-center border-top-1 border-color-dark-gray">
			@if($item->category_id == 1)
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
        <button type="button" class="m-btn m-btn-theme2nd font-w-500 ml-auto">{{$item->currency}} {{number_format($item->price, 0, '.', ' ')}}</button>
    </div>
</div>

