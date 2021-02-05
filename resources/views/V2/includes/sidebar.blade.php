
<div class="col-lg-4 md-m-15px-tb">
    <a href="{{route('v2.apls')}}" class="m-btn m-btn-theme4rd flex-shrink-0 col-md-12" style="margin-bottom: 20px;">@lang('app.list_apl')</a>

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
            <a href="{{route('v2.product.index',['product'=>$product->slug])}}" class="list-group-item list-group-item-action d-flex p15px-tb">
                <div>
                    <div class="avatar-50 border-radius-5">
                        <img src="{{$product->imageUrl(false)}}" title="" alt="" />
                    </div>
                </div>
                <div class="p-15px-l">
                    <p class="m-0px">{{$product->title}}</p>
                    <span class="btn btn-price">{{number_format($product->price, 0, '.', ' ')}}</span>
                </div>
            </a>
            <div class="social-icon si-30 theme2nd radius nav justify-content-center p-10px-t" style="padding-bottom: 7px;padding-top: 5px;">
                <a href="#"><i class="fa fa-arrows-alt"></i></a> @lang('app.num.area', ['num'=>number_format($product->area, 0)])
                <a href="#"><i class="fa fa-bed"></i></a> @lang('app.num.bed', ['num'=>$product->bedrooms])
                <a href="#"><i class="fa fa-bath"></i></a> @lang('app.num.bath', ['num'=>$product->bathrooms])
                <a href="#"><i class="fa fa-car"></i></a> {{$product->garage_spaces?__('app.yes'):__('app.no')}}
            </div>
            @endforeach
        </div>
    </div>

    <div class="card m-35px-t">
        @if(\Auth::check()&&\Auth::user()->hasRole('member'))
        <section class="widget recent-properties clearfix">
            <a href="{{route('member.contact', ['role'=>'admin'])}}" class="m-btn m-btn-theme col-sm-12"><i class="fa fa-envelope-open-o"></i> @lang('app.btn.contact_admin')</a>
            <a href="{{route('member.contact', ['role'=>'apl'])}}" class="m-btn m-btn-theme4rd col-sm-12"><i class="fa fa-envelope-open-o"></i> @lang('app.btn.contact_apl')</a>
        </section>
        @endif
    </div>

    <div class="card m-35px-t">
        <div class="card-header bg-transparent">
            <span class="h5 m-0px font-w-600 dark-color">@lang('app.recent.category')</span>
        </div>

        <div class="list-group list-group-flush">
            @foreach($categories as $category)
            <a href="{{route('v2.shop.index',$category)}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                <div>
                    <span class="theme2nd-bg p-5px-tb p-10px-lr border-radius-15 white-color small">{{$category->products_count}}</span> <span> {{ trans('app.txt.'.$category->title) }} </span>
                </div>
                <div>
                    <i class="ti-angle-right"></i>
                </div>
            </a>
            <!-- <span class="row justify-content-sm-between align-items-sm-center">
                    <span class="col-sm-6 m-5px-tb dark-color">
                        Business 
                    </span>
                    <span class="col-sm-6 m-5px-tb text-sm-right">
                        <span class="theme2nd-bg p-5px-tb p-10px-lr border-radius-15 white-color small">Chicago, US<i class="fas fa-arrow-right small m-5px-l"></i></span>
                    </span>
                </span> -->
                    <!-- <span> {{ trans('app.txt.'.$category->title) }} </span><span class="theme2nd-bg p-5px-tb p-10px-lr border-radius-15 white-color small">{{$category->products_count}}<i class="fas fa-arrow-right small m-5px-l"></i></span> -->
            @endforeach
        </div>
    </div>

</div>