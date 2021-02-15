@if($type == 'purchases')
    <div class="col-md-6 col-lg-4 m-15px-tb">
        <div class="price-table-01 active">
            <div class="pt-head">
                <p class="white-color font-15"><span>$</span>{{$product->price}}</p>
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
                <p class="white-color font-15"><span>$</span>{{$product->price}}</p>
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
@elseif($type == 'favorites')
    <div class="col-sm-6 col-xl-4 m-10px-tb">
        <div class="card">
            <a href="{{route('product.index',['product'=>$product])}}" class="media align-items-center lh-normal p-10px gray-bg">
                <div class="avatar-50 border-radius-50">
                    <img src="{{$product->imageUrl(false)}}" title="{{$product->title}}" alt="{{$product->title}}">
                </div>
                <div class="media-body p-10px-l">
                    <h6 class="font-w-600 m-0px">{{$product->title}}</h6>
                    <span class="font-small body-color"><span>$</span>{{$product->price}}</span>
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
	                <p class="m-0px"><span>$</span>{{$product->price}}</p>
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


