@extends('layouts.app')

@section('content')

@component('includes.breadcrumb2', 
    isset($category->slug) ? [
        'cat'=>$category->slug,
        'states'=>$states,
        'typesRes'=>$typesRes,
        'typesFonc'=>$typesFonc,
        'typesInd'=>$typesInd,
        'typesComm'=>$typesComm,
        'anciennetes'=>$anciennetes,
        'locationTypes'=>$locationTypes,
        'agricoles'=>$agricoles,
        'industriels'=>$industriels,
        'commercials'=>$commercials,
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
        'max_land_area_foncier'=>$max_land_area_foncier,
        'min_price_industriel'=>$min_price_industriel,
        'max_price_industriel'=>$max_price_industriel,
        'min_price_commercial'=>$min_price_commercial,
        'max_price_commercial'=>$max_price_commercial,
        'min_area_commercial'=>$min_area_commercial,
        'max_area_commercial'=>$max_area_commercial] 
        : [
        'cat'=>'search',
        'states'=>$states,
        'typesRes'=>$typesRes,
        'typesFonc'=>$typesFonc,
        'typesInd'=>$typesInd,
        'typesComm'=>$typesComm,
        'anciennetes'=>$anciennetes,
        'locationTypes'=>$locationTypes,
        'agricoles'=>$agricoles,
        'industriels'=>$industriels,
        'commercials'=>$commercials,
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
        'max_land_area_foncier'=>$max_land_area_foncier,
        'min_price_industriel'=>$min_price_industriel,
        'max_price_industriel'=>$max_price_industriel,
        'min_price_commercial'=>$min_price_commercial,
        'max_price_commercial'=>$max_price_commercial,
        'min_area_commercial'=>$min_area_commercial,
        'max_area_commercial'=>$max_area_commercial])
    @lang('all_products')
@endcomponent


<div class="container m-50px-t">
    <div class="row">
        <div class="col-lg-12 col-md-8">
            <div>
                <h5 class="border-bottom-1 border-color-light-gray p-15px-b">{{ request()->get('state')?trans('app.txt.search.title', ['state'=>request()->get('state')]):trans('app.txt.search.title2', ['state'=>trans('app.txt.au')]) }}</h5>
                <p class="font-1"><span class="p-25px-r">{{ count($items) }} {{ count($items)>1?trans('app.txt.resultats'):trans('app.txt.resultat') }}</span> | <span class="p-25px-l">{{ trans('app.txt.search.viewing',['min'=>count($items)<1?0:1,'max'=>count($items)>20?20:count($items)]) }}</span></p>
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
        {{-- <!-- Sidebar -->
        @include('includes.sidebar')
        <!-- fin sidebar --> --}}
    </div>
</div>
@endsection

