@extends('layouts.app')

@section('content')

@component('includes.breadcrumb2', isset($category->slug) ? ['cat'=>$category->slug] : ['cat'=>'search'])
    @lang('all_products')
@endcomponent


<div class="container" style="margin-top: 50px;">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="border-bottom-1 border-color-light-gray">
                <h5>{{ count($items) }} {{ count($items)<1?trans('app.txt.resultat'):trans('app.txt.resultats') }}</h5>
            </div>
            <div class="product-data"> 
                @php $i = 0; @endphp
                @forelse($items as $item)
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
                @empty
                    <div class="m-75px-tb">
                        @lang('app.txt.noinfo')
                    </div>
                @endforelse
                @if((($i%3) > 0))
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

