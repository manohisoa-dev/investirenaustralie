
<div class="col-lg-4 md-m-15px-tb">
    <a href="{{route('apls')}}" class="m-btn m-btn-theme2nd flex-shrink-0 col-md-12" style="margin-bottom: 20px;">@lang('app.list_apl')</a>

    <div class="card m-35px-t">
        @foreach($pubs as $pub)
        <section class="widget property-meta-wrapper clearfix">
            <h2 class="title wow slideInLeft">{{$pub->title}}</h2>
            <div class="content-box-large box-with-header">
                <a target="_blank" href="{{$pub->links?$pub->links:'#'}}"><img src="{{$pub->imageUrl()}}" class="img-rounded" alt="Cinque Terre" width="604" height="236"></a>
            </div>
        </section>
        @endforeach
    </div>

    <div class="card m-35px-t">
        <div class="card-header bg-transparent">
            <span class="h5 m-0px font-w-600 dark-color">@lang('app.recent.product')</span>
        </div>
        <div class="list-group list-group-flush">
            @foreach($products as $product)
            <a href="{{route('product.index',['product'=>$product->slug])}}" class="list-group-item list-group-item-action d-flex p15px-tb">
                <div>
                    <div class="avatar-50 border-radius-5">
                        <img src="{{$product->imageUrl(false)}}" title="" alt="" />
                    </div>
                </div>
                <div class="p-15px-l">
                    <p class="m-0px">{{$product->title}}</p>
                </div>
                <!-- <span class="btn btn-price">{{$product->price}}</span>
                <div class="property-meta clearfix">
                    <span><i class="fa fa-arrows-alt"></i> @lang('app.num.area', ['num'=>number_format($product->area, 0)])</span>
                    <span><i class="fa fa-bed"></i> @lang('app.num.bed', ['num'=>$product->bedrooms])</span>
                    <span><i class="fa fa-bathtub"></i> @lang('app.num.bath', ['num'=>$product->bathrooms])</span>
                    <span><i class="fa fa-cab"></i> {{$product->garage_spaces?__('app.yes'):__('app.no')}}</span>
                </div> -->
            </a>
            @endforeach
        </div>
    </div>

    <div class="card m-35px-t">
        @if(\Auth::check()&&\Auth::user()->hasRole('member'))
        <section class="widget recent-properties clearfix">
            <a href="{{route('member.contact', ['role'=>'admin'])}}" class="btn btn-primary col-sm-12"><i class="fa fa-envelope-open-o"></i> @lang('app.btn.contact_admin')</a>
            <a href="{{route('member.contact', ['role'=>'apl'])}}" class="btn btn-default col-sm-12"><i class="fa fa-envelope-open-o"></i> @lang('app.btn.contact_apl')</a>
        </section>
        @endif
    </div>

    <div class="card m-35px-t">
        <div class="card-header bg-transparent">
            <span class="h5 m-0px font-w-600 dark-color">@lang('app.recent.category')</span>
        </div>

        <div class="list-group list-group-flush">
            @foreach($categories as $category)
            <a href="{{route('shop.index',$category)}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                <div>
                    <span class="badge badge-success">{{$category->products_count}}</span> <span> {{ trans('app.txt.'.$category->title) }} </span>
                </div>
                <div>
                    <i class="ti-angle-right"></i>
                </div>
            </a>
            @endforeach
        </div>
    </div>

</div>