@extends('layouts.app')

@section('content')

@component('includes.breadcrumb2', 
    isset($category->slug) ? [
        'cat'=>$category->slug,
        'max_price_residentiel'=>$max_price_residentiel,
        'min_price_residentiel'=>$min_price_residentiel,
        'min_land_area_residentiel'=>$min_land_area_residentiel,
        'max_land_area_residentiel'=>$max_land_area_residentiel,
        'min_garage_space_residentiel'=>$min_garage_space_residentiel,
        'max_garage_space_residentiel'=>$max_garage_space_residentiel,
        'min_bathrooms_residentiel'=>$min_bathrooms_residentiel,
        'max_bathrooms_residentiel'=>$max_bathrooms_residentiel,
        'min_bedrooms_residentiel'=>$min_bedrooms_residentiel,
        'max_bedrooms_residentiel'=>$max_bedrooms_residentiel,
        'min_number_of_floors_residentiel'=>$min_number_of_floors_residentiel,
        'max_number_of_floors_residentiel'=>$max_number_of_floors_residentiel,
        'min_price_foncier'=>$min_price_foncier,
        'max_price_foncier'=>$max_price_foncier,
        'min_land_area_foncier'=>$min_land_area_foncier,
        'max_land_area_foncier'=>$max_land_area_foncier,] 
        : [
        'cat'=>'search',
        'max_price_residentiel'=>$max_price_residentiel,
        'min_price_residentiel'=>$min_price_residentiel,
        'min_land_area_residentiel'=>$min_land_area_residentiel,
        'max_land_area_residentiel'=>$max_land_area_residentiel,
        'min_garage_space_residentiel'=>$min_garage_space_residentiel,
        'max_garage_space_residentiel'=>$max_garage_space_residentiel,
        'min_bathrooms_residentiel'=>$min_bathrooms_residentiel,
        'max_bathrooms_residentiel'=>$max_bathrooms_residentiel,
        'min_bedrooms_residentiel'=>$min_bedrooms_residentiel,
        'max_bedrooms_residentiel'=>$max_bedrooms_residentiel,
        'min_number_of_floors_residentiel'=>$min_number_of_floors_residentiel,
        'max_number_of_floors_residentiel'=>$max_number_of_floors_residentiel,
        'min_price_foncier'=>$min_price_foncier,
        'max_price_foncier'=>$max_price_foncier,
        'min_land_area_foncier'=>$min_land_area_foncier,
        'max_land_area_foncier'=>$max_land_area_foncier,])
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

