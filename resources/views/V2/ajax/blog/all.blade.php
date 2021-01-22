@foreach($items as $item)
<div class="col-md-6 col-lg-4 m-30px-b">
    <div class="hover-top card box-shadow-only-hover overflow-hidden">
        <div>
            <a href="#">
                <img src="{{$item->imageUrl()}}" alt="{{$item->title}}">
            </a>
        </div>
        <div class="p-20px">
            <label class="font-small">@lang('app.txt.postepar') : <a href="#">{{$item->author->name}}</a> – {{$item->created_at->diffForHumans()}}</label>
            <h5 class="m-10px-b font-w-600"><a class="dark-color" href="{{route('v2.blog.index',$item->slug)}}">{{$item->title}}</a></h5>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p> -->
            <div class="nav font-small border-top-1 border-color-dark-gray p-15px-t">
                <a class="m-15px-r body-color font-w-500" href="#"><i class="fas fa-calendar-alt "></i> {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('d F')}},{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->year }}</a>
                <a class="body-color font-w-500" href="#"><i class="fas fa-comments"></i> {{$item->comments_count}}</a>
                <a class="body-color font-w-500 ml-auto" href="#">@lang('app.txt.lecture') <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>
    </div>
</div>
@endforeach
