<div class="col-sm-12 col-lg-12 m-15px-tb">
    <div class="box-shadow-hover hover-top white-bg our-team-hover-icon border-radius-3">
        <div class="p-10px team-img">
            <img src="{{$item->imageUrl()}}" alt="{{$item->title}}">
        </div>
        <div class="p-5px-t p-20px-b text-center">
            <small><i class="fa fa-map-marker"></i> {{$item->location?$item->location->toString():''}}</small>
            <h6 class="m-10px-b font-w-600"><a class="dark-color" href="{{route('v2.product.index',['product'=>$item->slug])}}">{{$item->title}}</a></h6>
        </div>
        <div class="font-small p-5px-t p-20px-b text-center border-top-1 border-color-dark-gray">
            <a class="m-15px-r body-color font-w-500" href="#"><i class="fa fa-arrows-alt"></i> @lang('app.num.area', ['num'=>number_format($item->area, 0)])</a>
            <a class="body-color font-w-500" href="#"><i class="fa fa-bed"></i> @lang('app.num.bed', ['num'=>$item->bedrooms])</a>
            <a class="body-color font-w-500" href="#"><i class="fa fa-bathtub"></i> @lang('app.num.bath', ['num'=>$item->bathrooms])</a>
            <a class="body-color font-w-500" href="#"><i class="fa fa-cab"></i> {{$item->garage_spaces?__('app.yes'):__('app.no')}}</a>
        </div>
        <button type="button" class="m-btn m-btn-theme2nd font-w-500 ml-auto">{{$item->currency}} {{$item->price}}</button>
    </div>
</div>

