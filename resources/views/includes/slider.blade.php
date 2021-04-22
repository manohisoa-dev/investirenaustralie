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
                        if(@getimagesize($item->images->filepath)) {
                            $img=$item->images->filepath;
                        } else {
                            $img=asset('images/slider/default.jpg');
                        }   
                    @endphp
                    <img class="d-block w-100" src="{{ asset($img) }}"
                        alt="{{ asset($item->content) }}">
                </div>
            @empty
                @forelse (App\Models\Slider::where('type','video')->where('status',1)->get() as $item)
                    <div class="embed-responsive embed-responsive-16by9">
                        <a href="#">
                            <video width="512" height="380" id="videoPlayer" muted="muted">
                            
                                @foreach (App\Models\Slider::where('type','video')->where('status',1)->get() as $key=>$video)
                                    @php
                                        try {
                                            if(@getimagesize($video->images->filepath));
                                            $vid=$video->images->filepath;
                                        } catch (\Throwable $th) {
                                            $vid=asset('images/slider/default.jpg');
                                        }   
                                    @endphp
                                    <input type="hidden" id="video-size" value="{{ sizeOf(App\Models\Slider::where('type','video')->where('status',1)->get()) }}">
                                    <input type="hidden" id="video-source-{{ $key }}" value="{{ asset($vid) }}">
                                @endforeach
                            
                            </video>
                        </a>
                    </div>
                @empty
                    @forelse (App\Models\Slider::where('type','pub')->where('status',1)->get() as $item)
                        @php
                            if(@getimagesize($item->images->filepath)) {
                                $img=$item->images->filepath;
                            } else {
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
            @endforelse
        </div>
        <!--/.Slides-->
        <!--Controls-->
        @if (!App\Models\Slider::where('type','video')->where('status',1)->first())
            <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">@lang('app.btn.perv')</span>
            </a>
            <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">@lang('app.btn.next')</span>
            </a>
        @endif
        <!--/.Controls-->
    </div>
<!--/.Carousel Wrapper-->
</section>
<!-- End Home Banner -->
<!-- Section targeted research-->
    @include('includes.search')
<!-- End Section -->


@push('script')
    <script>
        // Load multiple video on slider
        $(document).ready(function(){
            let videoSource = new Array();
            let videoSize = $('#video-size').val();

            for(var j=0; j<videoSize; j++){
                videoSource[j] = $('#video-source-'+j).val();
            }

            let i = 0; // global
            const videoCount = videoSource.length;
            const element = document.getElementById("videoPlayer");

            function videoPlay(videoNum) {
                element.setAttribute("src", videoSource[videoNum]);
                element.autoplay = true;
                element.load();
                element.play();
            }
            document.getElementById('videoPlayer').addEventListener('ended', myHandler, false);

            videoPlay(0); // play the video

            function myHandler() {
                i++;
                if (i == videoCount) {
                    i = 0;
                    videoPlay(i);
                } else {
                    videoPlay(i);
                }
            }

            // Set poster image for video loader
            $('#videoPlayer').on('loadstart', function (event) {
                $(this).addClass('bkg');
                $(this).attr("poster", "{{ asset('images/loading.gif') }}");
            });
            $('#videoPlayer').on('canplay', function (event) {
                $(this).removeClass('bkg');
                $(this).removeAttr("poster");
            });
        })
    </script>
@endpush

