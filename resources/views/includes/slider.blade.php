<!-- Home Banner -->
{{-- <section id="home" class="effect-section parallax" style="background-image: url({{ asset('images/slider/1.jpg') }});height: 42rem;">
</section> --}}

<section id="home" class="effect-section parallax" style="height:42rem;">
    <!--Carousel Wrapper-->
    <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel" style="z-index: 0;">
        <!--Indicators-->
        @if (App\Models\Slider::where('type','image')->where('status',1)->get() == null)
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-1z" data-slide-to="1"></li>
                <li data-target="#carousel-example-1z" data-slide-to="2"></li>
            </ol>            
        @endif

        <!--/.Indicators-->
        <!--Slides-->
        <div class="carousel-inner" role="listbox">
            @forelse (App\Models\Slider::where('type','image')->where('status',1)->get() as $item)
                <div class="carousel-item  @if($loop->first) active @endif">
                    @php
                        try {
                            if(file_get_contents($item->images->filepath));
                            $img=$item->images->filepath;
                        } catch (\Throwable $th) {
                            $img=asset('images/slider/default.jpg');
                        }   
                    @endphp
                    <img class="d-block w-100" src="{{ asset($img) }}"
                        alt="{{ asset($item->content) }}">
                </div>
            @empty
                @forelse (App\Models\Slider::where('type','pub')->where('status',1)->get() as $item)
                    @php
                        try {
                            if(file_get_contents($item->images->filepath));
                            $img=$item->images->filepath;
                        } catch (\Throwable $th) {
                            $img=asset('images/slider/default.jpg');
                        }   
                    @endphp
                    <div class="carousel-item  @if($loop->first) active @endif">
                        <a href="{{route('product.index',['product'=>$item->content])}}" target="_blank"><img class="d-block w-100" src="{{ asset($img) }}"
                            alt="{{ asset($item->content) }}"></a>
                    </div>
                @empty
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('images/slider/default.jpg') }}"
                            alt="@lang('app.txt.au')">
                    </div>
                @endforelse
            @endforelse
        </div>
        <!--/.Slides-->
        <!--Controls-->
        <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">@lang('app.btn.perv')</span>
        </a>
        <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">@lang('app.btn.next')</span>
        </a>
        <!--/.Controls-->
    </div>
<!--/.Carousel Wrapper-->
</section>
<!-- End Home Banner -->
<!-- Section targeted research-->
    @include('includes.search')
<!-- End Section -->

