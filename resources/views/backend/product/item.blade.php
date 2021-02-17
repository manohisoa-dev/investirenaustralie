@if($type == 'purchases')
    <div class="col-md-6 col-lg-4 m-15px-tb">
        <div class="price-table-01 active">
            <div class="pt-head">
                <p class="white-color font-15"><span>$</span>{{number_format($product->price, 0, '.', ' ')}}</p>
                <i class="fas fa-check"></i>
            </div>
            <div class="pt-body">
                <a href="{{route('product.index',['product'=>$product])}}">
			        <img  class="feature-image" src="{{$product->imageUrl(false)}}" alt="{{$product->title}}">
			    </a>
            </div>
            <div class="pt-footer">
                <h5><a href="{{route('product.index',['product'=>$product])}}">{{$product->title}}</a></h5>
            </div>
        </div>
    </div> <!-- col -->
@elseif($type == 'orders')
    <div class="col-md-6 col-lg-4 m-15px-tb">
        <div class="price-table-01">
            <div class="pt-head">
                <p class="white-color font-15"><span>$</span>{{number_format($product->price, 0, '.', ' ')}}</p>
            </div>
            <div class="pt-body">
                <a href="{{route('product.index',['product'=>$product])}}">
			        <img  class="feature-image" src="{{$product->imageUrl(false)}}" alt="{{$product->title}}">
			    </a>
            </div>
            <div class="pt-footer">
                <h5><a href="{{route('product.index',['product'=>$product])}}">{{$product->title}}</a></h5>
            </div>
        </div>
    </div> <!-- col -->
@elseif($type == 'products')
    <div class="col-sm-6 col-lg-4 m-15px-tb">
        <div class="box-shadow-hover hover-top white-bg our-team-hover-icon border-radius-3">
            <div class="p-10px team-img">
                <img src="{{$product->imageUrl(false)}}" alt="{{$product->title}}">
            </div>
            <div class="p-5px-t p-20px-b text-center">
                <small><i class="fa fa-map-marker"></i></small>
                <h6 class="m-10px-b font-w-600"><a class="dark-color" href="{{route('product.index',['product'=>$product])}}">{{$product->title}}</a></h6>
            </div>
            <div class="font-small p-5px-t p-20px-b text-center border-top-1 border-color-dark-gray">
                <a class="m-15px-r body-color font-w-500" href="#"><i class="fa fa-arrows-alt"></i> @lang('app.num.area', ['num'=>number_format($product->area, 0)])</a>
                <a class="body-color font-w-500" href="#"><i class="fa fa-bed"></i> @lang('app.num.bed', ['num'=>$product->bedrooms])</a>
                <a class="body-color font-w-500" href="#"><i class="fa fa-bath"></i> @lang('app.num.bath', ['num'=>$product->bathrooms])</a>
                <a class="body-color font-w-500" href="#"><i class="fa fa-car"></i> {{$product->garage_spaces?__('app.yes'):__('app.no')}}</a>
            </div>
            <button type="button" class="m-btn m-btn-theme2nd font-w-500 ml-auto">{{$product->currency}} {{number_format($product->price, 0, '.', ' ')}}</button>
        </div>
    </div>
@elseif($type == 'favorites')
    <div class="col-sm-6 col-xl-4 m-10px-tb">
        <div class="card">
            <a href="{{route('product.index',['product'=>$product])}}" class="media align-items-center lh-normal p-10px gray-bg">
                <div class="avatar-50 border-radius-50">
                    <img src="{{$product->imageUrl(false)}}" title="{{$product->title}}" alt="{{$product->title}}">
                </div>
                <div class="media-body p-10px-l">
                    <h6 class="font-w-600 m-0px">{{$product->title}}</h6>
                    <span class="font-small body-color"><span>$</span>{{number_format($product->price, 0, '.', ' ')}}</span>
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
	                <p class="m-0px"><span>$</span>{{number_format($product->price, 0, '.', ' ')}}</p>
	            </div>
	        </div>
	    </div>
	</div>
@else
	<div class="col-sm-6 m-15px-tb">
        <div class="card p-15px">
            <div class="media align-items-center">
                <p>Aucune données à afficher</p>
            </div>
        </div>
    </div>
@endif


