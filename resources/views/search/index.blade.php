@extends('layouts.app')

@section('content')

@component('includes.breadcrumb2', isset($category->slug) ? ['cat'=>$category->slug] : ['cat'=>'search'])
    @lang('all_products')
@endcomponent


<div class="container" style="margin-top: 50px;">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="product-data"> 
                @php $i = 0; @endphp
                @foreach($items as $item)
                    @if($i%3 === 0)
                        <div class="row" id="txtHint">
                    @endif
                    <div class="col-md-4 layout-item-wrap">
                        @include('product.single', ['item'=>$item])
                    </div>
                    @php $i++; @endphp
                    @if($i%3 === 0)
                        </div>
                    @endif
                @endforeach
                @if((($i%3) > 0))
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

