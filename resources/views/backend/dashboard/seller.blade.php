@extends('layouts.backend')

@section('subcontent')
<div class="col-lg-8 col-xl-9">
    <div class="profile-content-area m-40px-tb card card-body">
        <div class="border-color-dark-gray m-35px-b p-10px-b">
            <!-- Section -->
            <section class="p-50px-tb white-bg">
                <div class="container">
                    <div class="row counter">
                        <div class="col-6 col-md-6 col-lg-4 m-15px-tb text-center">
                            <div class="box-shadow white-bg p-20px border-bottom-5 border-color-theme2nd border-radius-5">
                                <h2 class="count h1" data-to="{{$count['products']}}" data-speed="{{$count['products']}}">{{$count['products']}}</h2>
                                <h6 class="font-w-500 m-0px">@lang('app.products')</h6>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-4 m-15px-tb text-center">
                            <div class="box-shadow white-bg p-20px border-bottom-5 border-color-theme2nd border-radius-5">
                                <h2 class="count h1" data-to="{{$count['favorites']}}" data-speed="{{$count['favorites']}}">{{$count['favorites']}}</h2>
                                <h6 class="font-w-500 m-0px">@lang('app.favorites')</h6>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-4 m-15px-tb text-center">
                            <div class="box-shadow white-bg p-20px border-bottom-5 border-color-theme2nd border-radius-5">
                                <h2>
                                    <span class="count h1" data-to="{{$count['orders']}}" data-speed="{{$count['orders']}}">{{$count['orders']}}</span>
                                    <span class="h1">/</span>
                                    <span class="count h1" data-to="{{$count['sales']}}" data-speed="{{$count['sales']}}">{{$count['sales']}}</span>
                                </h2>
                                <h6 class="font-w-500 m-0px">@lang('app.orders')/@lang('app.sales')</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="profile-content-area m-40px-tb card card-body">
        <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
            <h3 class="title">@lang('app.orders')</h3>
            <div class="row align-items-center">
                @if(sizeOf($recent['orders']) != 0)
                    @foreach($recent['orders'] as $product)
                        @include('backend.product.item', ['product'=>$product], ['type'=>'orders'])
                    @endforeach
                @else
                    <p class="m-20px-lr p-25px-t">@lang('app.txt.noinfo')</p>
                @endif
            </div>
        </div>
    </div>

    <div class="profile-content-area m-40px-tb card card-body">
        <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
            <h3 class="title">@lang('app.sales')</h3>
            <div class="row align-items-center">
                @if(sizeOf($recent['sales']) != 0)
                    @foreach($recent['sales'] as $product)
                        @include('backend.product.item', ['product'=>$product], ['type'=>'sales'])
                    @endforeach
                @else
                    <p class="m-20px-lr p-25px-t">@lang('app.txt.noinfo')</p>
                @endif
            </div>
        </div>
    </div>

    <div class="profile-content-area m-40px-tb card card-body">
        <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
            <h3 class="title">@lang('app.products')</h3>
            <div class="row align-items-center">
                @if(sizeOf($recent['products']) != 0)
                    @foreach($recent['products'] as $product)
                        @include('backend.product.item', ['product'=>$product], ['type'=>'products'])
                    @endforeach
                @else
                    <p class="m-20px-lr p-25px-t">@lang('app.txt.noinfo')</p>
                @endif
            </div>
        </div>
    </div>

    <div class="profile-content-area m-40px-tb card card-body">
        <div class="row col-lg-12">
        <div class="col-lg-6">
            <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                <h3>@lang('app.favorites')</h3>
                <div class="row">
                    @if(sizeOf($recent['favorites']) != 0)
                        @foreach($recent['favorites'] as $product)
                            @include('backend.product.item', ['product'=>$product], ['type'=>'favorites'])
                        @endforeach
                    @else
                        <p class="m-20px-lr p-25px-t">@lang('app.txt.noinfo')</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                <h3>@lang('app.pins')</h3>
                <div class="row">
                    @if(sizeOf($recent['pins']) != 0)
                        @foreach($recent['pins'] as $product)
                            @include('backend.product.item', ['product'=>$product], ['type'=>'pins'])
                        @endforeach
                    @else
                        <p class="m-20px-lr p-25px-t">@lang('app.txt.noinfo')</p>
                    @endif
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection