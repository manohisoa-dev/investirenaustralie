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
                    @if($i%2 === 0)
                        <div class="row" id="txtHint">
                    @endif
                    <div class="col-md-6 layout-item-wrap">
                        @include('product.single', ['item'=>$item])
                    </div>
                    @php $i++; @endphp
                    @if($i%2 === 0)
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

            {{-- Show pub search --}}
            <div class="p-50px-t">
                <h5 class="border-bottom-1 border-color-light-gray p-15px-b">@lang('app.txt.result_for_ads')</h5>
                <p class="font-1"><span class="p-25px-r">{{ count($pubItems) }} {{ count($pubItems)>1?trans('app.txt.resultats'):trans('app.txt.resultat') }}</span></p>
            </div>
            <div class="row col-lg-12">
                
                @forelse ($pubItems as $pub)
                    <div class="col-lg-6 md-m-15px-tb m-25px-b">
                        <div class="m-35px-t">
                            <div class="card">
                                <p class="text-center" style="font-size: 11px;">@lang('app.txt.advertisement')</p>
                                <div id="ads" class="ads-section col-lg-12 p-15px-b white-bg">
                                    <div class="ads-header col-lg-12 float-left p-5px-t p-20px-l p-10px-b border-top-1 border-color-gray">
                                        <div class="row col-lg-12">
                                            <div class="col-lg-6">
                                                <img src="{{ asset('images/ads-logo.png') }}" alt="logo_iea">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ads-content">
                                        <div class="pub col-lg-12 col-sm-12">
                                            <div class="thumb-wrapper">
                                                <div class="img-box p-10px-b m-15px-b border-bottom-2 border-color-gray">
                                                    @php
                                                        if(@getimagesize($pub->imageUrl())) {
                                                            $img_pub=$pub->imageUrl();                            
                                                        } else {
                                                            $img_pub=asset('images/pub/iea.png');
                                                        }
                                                    @endphp
                                                    <a href="{{ $pub->links }}" target="_blank"><img src="{{$img_pub}}" alt="{{$pub->title}}" class="img-fluid"></a>
                                                </div>
                                                <div class="thumb-content">
                                                    <p><span>{{ $pub->title }}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse
                
            </div>
            {{-- End Show pub search --}}
        </div>
        {{-- <!-- Sidebar -->
        @include('includes.sidebar')
        <!-- fin sidebar --> --}}
    </div>
</div>
@endsection

