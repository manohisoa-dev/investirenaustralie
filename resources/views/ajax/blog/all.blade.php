@foreach($items as $item)
<div class="col-md-6 col-lg-6 m-30px-b view-item">
    <div class="hover-top card box-shadow-only-hover overflow-hidden border-radius-0">
        <div>
            {{-- Show blog image --}}
            <a href="{{route('blog.index',$item->slug)}}" target="_blank">
                @php
                    try {
                        if(@getimagesize($item->imageUrl()))
                        $img=$item->imageUrl();
                    } catch (\Throwable $th) {
                        $img=asset('images/blog/iea.png');
                    }   
                @endphp
                <img src="{{$img}}" alt="{{$item->title}}" title="{{$item->title}}">
            </a>
        </div>
        <div class="p-20px">
            <label class="font-small">@lang('app.txt.postepar') : <a href="javascript:void(0)">{{$item->author ? $item->author->name : ''}}</a> – {{$item->created_at ? $item->created_at->diffForHumans() : ''}}</label>
            <h5 class="m-10px-b font-w-600"><a title="{{$item->title}}" class="dark-color" href="{{route('blog.index',$item->slug)}}" target="_blank">{{str_limit($item->title, 50, '...')}}</a></h5>
            <div class="nav font-small border-top-1 border-color-dark-gray p-15px-t">
                <a class="m-15px-r body-color font-w-500" href="javascript:void(0)"><i class="fas fa-calendar-alt "></i> {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('d F')}},{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->year }}</a>
                <a class="body-color font-w-500" href="javascript:void(0)"><i class="fas fa-comments"></i> {{$item->comments_count}}</a>
                <a class="body-color font-w-500 ml-auto" href="{{route('blog.index',$item->slug)}}" target="_blank">@lang('app.txt.lecture') <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>
    </div>
</div>
@endforeach