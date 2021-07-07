@php $i = 0; @endphp
@foreach($items as $key=>$item)
    @if($i%2 === 0)
        <div class="row" id="txtHint">
    @endif
    <div class="{{ $viewProd=='list' ? 'col-md-12' : 'col-md-6'}} view-item layout-item-wrap">

        <div class="col-sm-12 col-lg-12 m-15px-tb">
            <div class="box-shadow-hover hover-top white-bg our-team-hover-icon border-radius-3">
                @php
                    if(@getimagesize($item->imageUrl())) {
                        $img=$item->imageUrl();
                    } else {
                        $img=asset('images/iea.png');
                    }   
                @endphp
                
                <a href="{{ route('programme.show', ['slug'=>$item->slug]) }}" >
                    <div class="transition blog-grid-overlay border-radius-0" style="background-image: url({{ $img }}); ">
                        <div class="blog-gird-info">
                            <h5>{{ $item->title?$item->title:'' }}</h5>
                            <p><span class="white-color">{{ $item->location ? Illuminate\Support\Str::upper($item->location->locality.' '.$item->location->area_level_2.', '.$item->location->area_level_1.' '.$item->location->postalCode) : '' }}</span></p>            
                        </div>
                    </div>

                    {{-- Badge --}}
                    @if ($item->validated_at > Carbon\Carbon::now()->subDays(App\Models\Parameter::where('name','nb_day_new_prod')->first()->value))
                        <span class="notify-badge btn-success">@lang('app.txt.new')</span>
                    @endif

                </a>
        
                <div class="p-5px-t p-20px-b text-center">
                    <h6>{!! $item->content? Illuminate\Support\Str::limit($item->content, 75) :'' !!}</h6>
                </div>

                <div class="font-small p-5px-t p-20px-b text-center border-top-1 border-color-dark-gray">
                    <div class="container text-center">
                        <div class="row mx-auto my-auto">
                            <div id="myCarousel{{ $i }}" class="carousel slide w-100" data-ride="carousel">
                                <div class="carousel-inner w-100" role="listbox">
                                    
                                    @forelse (App\Models\Product::where('parent_id','=',$item->id)->orderBy($orderBy,$order)->get() as $prod)
                                        <div class="carousel-item carousel-item-prod @if($loop->first) active @endif">
                                            <div class="{{ $viewProd=='list' ? 'col-lg-4' : 'col-md-12'}} col-sm-12">
                                                <div class="thumb-wrapper">
                                                    <div class="img-box p-10px-b m-15px-b border-bottom-2 border-color-gray">
                                                        @php
                                                            if(@getimagesize($prod->imageUrl())) { 
                                                                $img_prod=$prod->imageUrl();
                                                            } else {
                                                                $img_prod=asset('images/iea.png');
                                                            }   
                                                        @endphp
                                                        <a href="{{route('product.index',['product'=>$prod->slug])}}" target="_blank"><img src="{{$img_prod}}" alt="{{$prod->title}}" class="img-fluid"></a>
                                                        {{-- Badge type --}}
                                                        <span class="type-badge btn-info">{{ App\Models\Type::find($prod->type_id)->title }}</span>
                                                        {{-- Badge new product --}}
                                                        @if ($prod->validated_at > Carbon\Carbon::now()->subDays(App\Models\Parameter::where('name','nb_day_new_prod')->first()->value))
                                                            <span class="notify-badge-prod btn-success">@lang('app.txt.new')</span>
                                                        @endif
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
    {{-- Show pub --}}
    @if (($key+1)%2 === 0)
        <div class="col-lg-12 md-m-15px-tb m-25px-b">
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
                            <div id="carouselControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @forelse (App\Models\Pub::all() as $pub)
                                        <div class="carousel-item @if($loop->first) active @endif">
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
                                    @empty
                                        <div class="carousel-item active">
                                            <div class="col-lg-12 col-sm-12">
                                                <div class="thumb-wrapper">
                                                    <div class="img-box p-10px-b m-15px-b border-bottom-2 border-color-gray">
                                                        <a href="{{ $pub->links }}" target="_blank"><img src="{{asset('images/iea.png')}}" alt="Investir en Australie" class="img-fluid"></a>
                                                    </div>
                                                    <div class="thumb-content">
                                                        <p><span>{{ $pub->title }}</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- End show pub --}}
    
    {{-- Show blog --}}
        
        @if ($viewProd === 'list')
            @if (($key+1)%(int)($xLine->value) === 0)
                @php
                    $blogs = App\Models\Blog::ofStatus('published')->where('post_type','=', 'blog')->withCount('comments')->get()->random();
                @endphp
                <div class="col-lg-12 md-m-15px-tb m-25px-b">
                    <div class="m-35px-t">
                        <div class="card">
                            <p class="text-center" style="font-size: 11px;">{{ Illuminate\Support\Str::upper(trans('app.blog')) }}</p>
                            <div id="ads" class="ads-section col-lg-12 p-15px-b white-bg">
                                <div class="ads-header col-lg-12 float-left p-5px-t p-20px-l p-10px-b border-top-1 border-color-gray">
                                    <div class="row col-lg-12">
                                        <div class="col-lg-6">
                                            <img src="{{ asset('images/ads-logo.png') }}" alt="logo_iea">
                                        </div>
                                    </div>
                                </div>
                                <div class="ads-content">
                                    <div class="col-md-12 col-lg-12 m-30px-b view-item-blog">
                                        <div class="hover-top card box-shadow-only-hover overflow-hidden">
                                            <div>
                                                {{-- Show blog image --}}
                                                <a href="{{route('blog.index',$blogs->slug)}}" target="_blank">
                                                    @php
                                                        if(@getimagesize($blogs->imageUrl())) {
                                                            $img=$blogs->imageUrl();
                                                        } else {
                                                            $img=asset('images/blog/iea.png');
                                                        }   
                                                    @endphp
                                                    <img src="{{$img}}" alt="{{$blogs->title}}" title="{{$blogs->title}}">
                                                </a>
                                            </div>
                                            <div class="p-20px">
                                                <label class="font-small">@lang('app.txt.postepar') : <a href="javascript:void(0)">{{$blogs->author ? $blogs->author->name : ''}}</a> – {{$blogs->created_at ? $blogs->created_at->diffForHumans() : ''}}</label>
                                                <h5 class="m-10px-b font-w-600"><a title="{{$blogs->title}}" class="dark-color" href="{{route('blog.index',$blogs->slug)}}" target="_blank">{{str_limit($blogs->title, 50, '...')}}</a></h5>
                                                <div class="nav font-small border-top-1 border-color-dark-gray p-15px-t">
                                                    <a class="m-15px-r body-color font-w-500" href="javascript:void(0)"><i class="fas fa-calendar-alt "></i> {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $blogs->created_at)->format('d F')}},{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $blogs->created_at)->year }}</a>
                                                    <a class="body-color font-w-500" href="javascript:void(0)"><i class="fas fa-comments"></i> {{$blogs->comments_count}}</a>
                                                    <a class="body-color font-w-500 ml-auto" href="{{route('blog.index',$blogs->slug)}}" target="_blank">@lang('app.txt.lecture') <i class="fas fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @else
            @if (($key+1)%(int)($xLine->value % 2 === 0 ?$xLine->value:2) === 0)
                <div class="col-lg-12 md-m-15px-tb m-25px-b">
                    <div class="m-35px-t">
                        <div class="card">
                            <p class="text-center" style="font-size: 11px;">{{ Illuminate\Support\Str::upper(trans('app.blog')) }}</p>
                            <div id="ads" class="ads-section col-lg-12 p-15px-b white-bg">
                                <div class="ads-header col-lg-12 float-left p-5px-t p-20px-l p-10px-b border-top-1 border-color-gray">
                                    <div class="row col-lg-12">
                                        <div class="col-lg-6">
                                            <img src="{{ asset('images/ads-logo.png') }}" alt="logo_iea">
                                        </div>
                                    </div>
                                </div>
                                <div class="ads-content row col-lg-12">
                                    @forelse (App\Models\Blog::ofStatus('published')->where('post_type','=', 'blog')->withCount('comments')->get()->random(2) as $blog)
                                        <div class="col-md-12 col-lg-6 m-30px-b view-item-blog">
                                            <div class="hover-top card box-shadow-only-hover overflow-hidden">
                                                <div>
                                                    {{-- Show blog image --}}
                                                    <a href="{{route('blog.index',$blog->slug)}}" target="_blank">
                                                        @php
                                                            if(@getimagesize($blog->imageUrl())) {
                                                                $img=$blog->imageUrl();
                                                            } else {
                                                                $img=asset('images/blog/iea.png');
                                                            }   
                                                        @endphp
                                                        <img src="{{$img}}" alt="{{$blog->title}}" title="{{$blog->title}}">
                                                    </a>
                                                </div>
                                                <div class="p-20px">
                                                    <label class="font-small">@lang('app.txt.postepar') : <a href="javascript:void(0)">{{$blog->author ? $blog->author->name : ''}}</a> – {{$blog->created_at ? $blog->created_at->diffForHumans() : ''}}</label>
                                                    <h5 class="m-10px-b font-w-600"><a title="{{$blog->title}}" class="dark-color" href="{{route('blog.index',$blog->slug)}}" target="_blank">{{str_limit($blog->title, 50, '...')}}</a></h5>
                                                    <div class="nav font-small border-top-1 border-color-dark-gray p-15px-t">
                                                        <a class="m-15px-r body-color font-w-500" href="javascript:void(0)"><i class="fas fa-calendar-alt "></i> {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $blog->created_at)->format('d F')}},{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $blog->created_at)->year }}</a>
                                                        <a class="body-color font-w-500" href="javascript:void(0)"><i class="fas fa-comments"></i> {{$blog->comments_count}}</a>
                                                        <a class="body-color font-w-500 ml-auto" href="{{route('blog.index',$blog->slug)}}" target="_blank">@lang('app.txt.lecture') <i class="fas fa-chevron-right"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            @endif
        @endif
        {{-- End show blog --}}
    

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
    <style>
        /* .card-badge {
            position:absolute;
            text-align: center;
            width: 165px;
            border-radius: 250% 250% 0px 0px;
            top:15px;
            left:-35px;
            padding:5px;
            background: #0DA600;
            color:white;
            transform:rotate(-40deg);
          } */

            .type-badge{
                position: absolute;
                right:15px;
                top:5px;
                text-align: center;
                /* background: #0DA600; */
                /* border-radius: 30px 30px 30px 30px; */
                color:white;
                padding:5px 10px;
                font-size:10px;
            }

            .notify-badge{
                position: absolute;
                right:-20px;
                top:-20px;
                text-align: center;
                color:white;
                padding:5px 10px;
                font-size:18px;
            }

            .notify-badge-prod{
                position: absolute;
                left: 15px;
                top: 100px;
                text-align: center;
                /* background: #0DA600; */
                background: rgba(40,167,69, 0.8);
                color:white;
                padding:5px 10px;
                font-size:14px;
            }
        </style>
@endpush






