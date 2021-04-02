@php $i = 0; @endphp
@foreach($items as $key=>$item)
    @if($i%2 === 0)
        <div class="row" id="txtHint">
    @endif
    <div class="col-md-12 view-item layout-item-wrap">
        <div class="col-sm-12 col-lg-12 m-15px-tb">
            <div class="box-shadow-hover hover-top white-bg our-team-hover-icon border-radius-3">
                @php
                    try {
                        if(file_get_contents($item->imageUrl()));
                        $img=$item->imageUrl();
                    } catch (\Throwable $th) {
                        $img=asset('images/iea.png');
                    }   
                @endphp
                
                <a href="{{ route('programme.show', ['slug'=>$item->slug]) }}" target="_blank">
                    <div class="hover-top transition blog-grid-overlay border-radius-0" style="background-image: url({{ $img }}); ">
                        <div class="blog-gird-info">
                            <h5>{{ $item->title?$item->title:'' }}</h5>
                            <p>{{ $item->location ? Illuminate\Support\Str::upper($item->location->locality.' '.$item->location->area_level_2.', '.$item->location->area_level_1.' '.$item->location->postalCode) : '' }}</p>            
                        </div>
                    </div>
                </a>
        
                <div class="p-5px-t p-20px-b text-center">
                    <h6>{{ $item->content? Illuminate\Support\Str::limit($item->content, 75) :''}}</h6>
                </div>
                <div class="font-small p-5px-t p-20px-b text-center border-top-1 border-color-dark-gray">
                    
                    <div class="container text-center">
                        <div class="row mx-auto my-auto">
                            <div id="myCarousel{{ $i }}" class="carousel slide w-100" data-ride="carousel">
                                <div class="carousel-inner w-100" role="listbox">
                                    
                                    @forelse (App\Models\Product::where('parent_id','=',$item->id)->get() as $prod)
                                        <div class="carousel-item @if($loop->first) active @endif">
                                            <div class="col-sm-3 col-md-6 col-lg-4">
                                                <div class="thumb-wrapper">
                                                    <div class="img-box p-10px-b m-15px-b border-bottom-2 border-color-gray">
                                                        @php
                                                            try {
                                                                if(file_get_contents($prod->imageUrl()));
                                                                $img_prod=$prod->imageUrl();
                                                            } catch (\Throwable $th) {
                                                                $img_prod=asset('images/iea.png');
                                                            }   
                                                        @endphp
                                                        <a href="{{route('product.index',['product'=>$prod->slug])}}" target="_blank"><img src="{{$img_prod}}" alt="{{$prod->title}}" class="img-fluid"></a>
                                                    </div>
                                                    <div class="thumb-content">
                                                        <p class="item-price"><span>$ {{number_format($prod->price, 0, '.', ' ')}}</span></p>
                                                        <div class="star-rating">
                                                            <ul class="list-inline">
                                                                <a class="body-color font-w-500" href="#"><i class="fa fa-bed"></i> {{ $prod->bedrooms }}</a>
                                                                <a class="body-color font-w-500" href="#"><i class="fa fa-bath"></i> {{ $prod->bathrooms }}</a>
                                                                <a class="body-color font-w-500" href="#"><i class="fa fa-car"></i> {{$prod->garage_spaces?__('app.yes'):__('app.no')}}</a>
                                                            </ul>
                                                        </div>
                                                    </div>						
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div>
                                            <p>@lang('app.txt.no_product')</p>
                                        </div>
                                    @endforelse

                                </div>
                                @if (sizeOf(App\Models\Product::where('parent_id','=',$item->id)->get())>3)
                                    <a class="carousel-control-prev bg-dark w-auto" href="#myCarousel{{ $i }}" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next bg-dark w-auto" href="#myCarousel{{ $i }}" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                @endif

                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    @php $i++; @endphp
    @if($i%2 === 0)
        </div>
    @endif
@endforeach
@if((($i%2) > 0))
</div>
@endif



@push('script')
    <link rel="stylesheet" href="{{ asset('carousel/style.css') }}">
    <script src="{{ asset('carousel/popper.min.js') }}"></script>
    <script src="{{ asset('carousel/carousel.js') }}"></script>
@endpush






