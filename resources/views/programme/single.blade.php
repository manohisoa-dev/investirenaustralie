
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
        
        <div class="hover-top transition blog-grid-overlay border-radius-0" style="background-image: url({{ $img }}); ">
            <div class="blog-gird-info">
                <h5>{{ $item->title?$item->title:'' }}</h5>
                <p>{{ $item->location ? Illuminate\Support\Str::upper($item->location->locality.' '.$item->location->area_level_2.', '.$item->location->area_level_1.' '.$item->location->postalCode) : '' }}</p>            
            </div>
        </div>

        <div class="p-5px-t p-20px-b text-center">
            <h6>{{ $item->content? Illuminate\Support\Str::limit($item->content, 75) :''}}</h6>
        </div>
        <div class="font-small p-5px-t p-20px-b text-center border-top-1 border-color-dark-gray">
            

            <div class="col-md-12">
                <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
                    <!-- Wrapper for carousel items -->
                    <div class="carousel-inner">


                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-sm-3 col-md-6 col-lg-4">
                                    <div class="thumb-wrapper">
                                        <div class="img-box">
                                            @php
                                                try {
                                                    if(file_get_contents($item->imageUrl()));
                                                    $img=$item->imageUrl();
                                                } catch (\Throwable $th) {
                                                    $img=asset('images/iea.png');
                                                }   
                                            @endphp
                                            <img src="{{$img}}" alt="{{$item->title}}" class="img-fluid">
                                        </div>
                                        <div class="thumb-content">
                                            <p class="item-price"><span>$ {{number_format($item->price, 0, '.', ' ')}}</span></p>
                                            <div class="star-rating">
                                                <ul class="list-inline">
                                                    <a class="body-color font-w-500" href="#"><i class="fa fa-bed"></i> {{ $item->bedrooms }}</a>
                                                    <a class="body-color font-w-500" href="#"><i class="fa fa-bath"></i> {{ $item->bathrooms }}</a>
                                                    <a class="body-color font-w-500" href="#"><i class="fa fa-car"></i> {{$item->garage_spaces?__('app.yes'):__('app.no')}}</a>
                                                    {{-- <li class="list-inline-item"><i class="fa fa-star"></i></li>--}}
                                                </ul>
                                            </div>
                                        </div>						
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-6 col-lg-4">
                                    <div class="thumb-wrapper">
                                        <div class="img-box">
                                            @php
                                                try {
                                                    if(file_get_contents($item->imageUrl()));
                                                    $img=$item->imageUrl();
                                                } catch (\Throwable $th) {
                                                    $img=asset('images/iea.png');
                                                }   
                                            @endphp
                                            <img src="{{$img}}" alt="{{$item->title}}" class="img-fluid">
                                        </div>
                                        <div class="thumb-content">
                                            <p class="item-price"><span>$ {{number_format($item->price, 0, '.', ' ')}}</span></p>
                                            <div class="star-rating">
                                                <ul class="list-inline">
                                                    <a class="body-color font-w-500" href="#"><i class="fa fa-bed"></i> {{ $item->bedrooms }}</a>
                                                    <a class="body-color font-w-500" href="#"><i class="fa fa-bath"></i> {{ $item->bathrooms }}</a>
                                                    <a class="body-color font-w-500" href="#"><i class="fa fa-car"></i> {{$item->garage_spaces?__('app.yes'):__('app.no')}}</a>
                                                    {{-- <li class="list-inline-item"><i class="fa fa-star"></i></li>--}}
                                                </ul>
                                            </div>
                                        </div>						
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-6 col-lg-4">
                                    <div class="thumb-wrapper">
                                        <div class="img-box">
                                            @php
                                                try {
                                                    if(file_get_contents($item->imageUrl()));
                                                    $img=$item->imageUrl();
                                                } catch (\Throwable $th) {
                                                    $img=asset('images/iea.png');
                                                }   
                                            @endphp
                                            <img src="{{$img}}" alt="{{$item->title}}" class="img-fluid">
                                        </div>
                                        <div class="thumb-content">
                                            <p class="item-price"><span>$ {{number_format($item->price, 0, '.', ' ')}}</span></p>
                                            <div class="star-rating">
                                                <ul class="list-inline">
                                                    <a class="body-color font-w-500" href="#"><i class="fa fa-bed"></i> {{ $item->bedrooms }}</a>
                                                    <a class="body-color font-w-500" href="#"><i class="fa fa-bath"></i> {{ $item->bathrooms }}</a>
                                                    <a class="body-color font-w-500" href="#"><i class="fa fa-car"></i> {{$item->garage_spaces?__('app.yes'):__('app.no')}}</a>
                                                    {{-- <li class="list-inline-item"><i class="fa fa-star"></i></li>--}}
                                                </ul>
                                            </div>
                                        </div>						
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-sm-3 col-md-6 col-lg-4">
                                    <div class="thumb-wrapper">
                                        <div class="img-box">
                                            @php
                                                try {
                                                    if(file_get_contents($item->imageUrl()));
                                                    $img=$item->imageUrl();
                                                } catch (\Throwable $th) {
                                                    $img=asset('images/iea.png');
                                                }   
                                            @endphp
                                            <img src="{{$img}}" alt="{{$item->title}}" class="img-fluid">
                                        </div>
                                        <div class="thumb-content">
                                            <p class="item-price"><span>$ {{number_format($item->price, 0, '.', ' ')}}</span></p>
                                            <div class="star-rating">
                                                <ul class="list-inline">
                                                    <a class="body-color font-w-500" href="#"><i class="fa fa-bed"></i> {{ $item->bedrooms }}</a>
                                                    <a class="body-color font-w-500" href="#"><i class="fa fa-bath"></i> {{ $item->bathrooms }}</a>
                                                    <a class="body-color font-w-500" href="#"><i class="fa fa-car"></i> {{$item->garage_spaces?__('app.yes'):__('app.no')}}</a>
                                                    {{-- <li class="list-inline-item"><i class="fa fa-star"></i></li>--}}
                                                </ul>
                                            </div>
                                        </div>						
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-6 col-lg-4">
                                    <div class="thumb-wrapper">
                                        <div class="img-box">
                                            @php
                                                try {
                                                    if(file_get_contents($item->imageUrl()));
                                                    $img=$item->imageUrl();
                                                } catch (\Throwable $th) {
                                                    $img=asset('images/iea.png');
                                                }   
                                            @endphp
                                            <img src="{{$img}}" alt="{{$item->title}}" class="img-fluid">
                                        </div>
                                        <div class="thumb-content">
                                            <p class="item-price"><span>$ {{number_format($item->price, 0, '.', ' ')}}</span></p>
                                            <div class="star-rating">
                                                <ul class="list-inline">
                                                    <a class="body-color font-w-500" href="#"><i class="fa fa-bed"></i> {{ $item->bedrooms }}</a>
                                                    <a class="body-color font-w-500" href="#"><i class="fa fa-bath"></i> {{ $item->bathrooms }}</a>
                                                    <a class="body-color font-w-500" href="#"><i class="fa fa-car"></i> {{$item->garage_spaces?__('app.yes'):__('app.no')}}</a>
                                                    {{-- <li class="list-inline-item"><i class="fa fa-star"></i></li>--}}
                                                </ul>
                                            </div>
                                        </div>						
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Carousel controls -->
                    <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="carousel-control-next" href="#myCarousel" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>



<style>
    .carousel {
        margin: 5px auto;
        margin-bottom: -75px !important;
        padding: 0 50px;
    }
    .carousel .carousel-item {
        min-height: 330px;
        text-align: center;
        overflow: hidden;
    }
    .carousel .carousel-item .img-box {
        height: 160px;
        width: 100%;
        position: relative;
    }
    .carousel .carousel-item img {	
        max-width: 100%;
        max-height: 100%;
        display: inline-block;
        position: absolute;
        bottom: 0;
        margin: 0 auto;
        left: 0;
        right: 0;
    }
    .carousel .carousel-item h4 {
        font-size: 18px;
        margin: 10px 0;
    }
    .carousel .carousel-item .btn {
        color: #333;
        border-radius: 0;
        font-size: 11px;
        text-transform: uppercase;
        font-weight: bold;
        background: none;
        border: 1px solid #ccc;
        padding: 5px 10px;
        margin-top: 5px;
        line-height: 16px;
    }
    .carousel .carousel-item .btn:hover, .carousel .carousel-item .btn:focus {
        color: #fff;
        background: #000;
        border-color: #000;
        box-shadow: none;
    }
    .carousel .carousel-item .btn i {
        font-size: 14px;
        font-weight: bold;
        margin-left: 5px;
    }
    .carousel .thumb-wrapper {
        text-align: center;
    }
    .carousel .thumb-content {
        padding: 15px;
    }
    .carousel-control-prev, .carousel-control-next {
        height: 100px;
        width: 40px;
        background: none;
        margin: auto 0;
        background: rgba(0, 0, 0, 0.2);
    }
    .carousel-control-prev i, .carousel-control-next i {
        font-size: 30px;
        position: absolute;
        top: 50%;
        display: inline-block;
        margin: -16px 0 0 0;
        z-index: 5;
        left: 0;
        right: 0;
        color: rgba(0, 0, 0, 0.8);
        text-shadow: none;
        font-weight: bold;
    }
    .carousel-control-prev i {
        margin-left: -3px;
    }
    .carousel-control-next i {
        margin-right: -3px;
    }
    .carousel .item-price {
        font-size: 13px;
        padding: 2px 0;
    }
    .carousel .item-price strike {
        color: #999;
        margin-right: 5px;
    }
    .carousel .item-price span {
        color: #86bd57;
        font-size: 110%;
    }	
    .carousel .carousel-indicators {
        bottom: -50px;
    }
    .carousel-indicators li, .carousel-indicators li.active {
        width: 10px;
        height: 10px;
        margin: 4px;
        border-radius: 50%;
        border-color: transparent;
        border: none;
    }
    .carousel-indicators li {	
        background: rgba(0, 0, 0, 0.2);
    }
    .carousel-indicators li.active {	
        background: rgba(0, 0, 0, 0.6);
    }
    .star-rating li {
        padding: 0;
    }
    .star-rating i {
        font-size: 14px;
        color: #AE4435    ;
    }
    </style>






