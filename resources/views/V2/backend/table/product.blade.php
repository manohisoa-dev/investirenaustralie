<table class="shop_table shop_table_responsive cart table table-striped table-hover">
    <thead>
        <tr>
            <th colspan="2">@lang('app.product')</th>
            <th>@lang('app.txt.price')</th>
            <th>@lang('app.txt.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td class="product-thumbnail" width="100">
                <div class="pt-icon">
                    <a href="{{route('v2.product.index', $product->slug)}}">
                        <img src="{{$product->imageUrl()}}" title="" alt="">
                    </a>
                </div>
            </td>
            <td class="product-name"><a href="{{route('product.index', $product)}}">{{$product->title}}</a></td>
            <td class="product-price"><span>{{$product->currency}}</span> {{$product->price}}</td>
            <td class="product-action">
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{$products->links()}}