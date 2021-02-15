<table class="shop_table shop_table_responsive cart table table-striped table-hover">
    <thead>
        <tr>
            <th colspan="2">@lang('app.products')</th>
            
            @if(\Auth::check()&&\Auth::user()->hasRole(4))
            <th colspan="2">@lang('app.user')</th>
            @endif
            
            <th>@lang('app.txt.price')</th>
            <th>@lang('app.txt.reservation')</th>
            
            @if($sales[0]->status == 'pinged')
            <th>@lang('app.txt.action')</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($sales as $sale)
        <tr>
            <td class="product-thumbnail" width="100">
                <div class="pt-icon">
                    <a href="{{route('product.index', $sale->product->slug)}}">
                        <img src="{{$sale->product->imageUrl()}}" title="" alt="">
                    </a>
                </div>
            </td>
            <td class="product-name"> <a href="{{route('product.index', $sale->product->slug)}}">{{$sale->product->title}}</a></td>
            
            @if(\Auth::check()&&\Auth::user()->hasRole(4))
                <td class="product-thumbnail" width="100">
                    @if($sale->author)
                    <div class="pt-icon">
                        <a href="{{route(App\Models\Role::find(\Auth::user()->role)->role_initial.'.user.contact', $sale->author)}}">
                            <img src="{{$sale->author->imageUrl()}}" title="" alt="">
                        </a>
                    </div>
                    @endif
                </td>
                <td>
                     @if($sale->author)
                     <a href="{{route(App\Models\Role::find(\Auth::user()->role)->role_initial.'.user.contact', $sale->author)}}">{{$sale->author->email}}</a>
                     @endif
                </td>
            @endif
            
            <td class="product-price"><span>{{$sale->currency}}</span> {{$sale->price}}</td>
            <td class="product-price"><span>{{$sale->currency}}</span> {{$sale->tma}}</td>
            
            <td class="product-action">
                @if($sale->status == 'pinged')
                <form action="{{route('shop.order.last')}}" method="post" class="pull-right">
                    {{csrf_field()}}
                    <input type="hidden" name="sale" value="{{$sale->id}}">
                    <input type="hidden" name="action" value="item">
                    <button type="submit" class="btn btn-default pull-left">x</button>
                </form>
                <form action="{{route('shop.checkout')}}" method="post" class="pull-right">
                    {{csrf_field()}}
                    <input type="hidden" name="sale" value="{{$sale->id}}">
                    <input type="hidden" name="action" value="update_session">
                    <input type="submit" class="btn btn-success pull-left" value="@lang('member.pay_order')">
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{$sales->links()}}

@if($sale->status == 'pinged')
<form action="{{route('shop.order.last')}}" method="post">
{{csrf_field()}}
<input type="hidden" name="action" value="all">
<button type="submit" class="btn btn-default pull-right">@lang('member.cancel_orders')</button>
</form>
@endif