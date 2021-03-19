<!-- Home Banner -->
{{-- <section id="home" class="effect-section parallax" style="background-image: url({{ asset('images/slider/1.jpg') }});height: 42rem;">
</section> --}}

<section id="home" class="effect-section parallax" style="height:42rem;">
    <!--Carousel Wrapper-->
    <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel" style="z-index: 0;">
        <!--Indicators-->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-1z" data-slide-to="1"></li>
            <li data-target="#carousel-example-1z" data-slide-to="2"></li>
        </ol>
        <!--/.Indicators-->
        <!--Slides-->
        <div class="carousel-inner" role="listbox">
            <!--First slide-->
            <div class="carousel-item active">
            <img class="d-block w-100" src="{{ asset('images/slider/1.jpg') }}"
                alt="First slide">
            </div>
            <!--/First slide-->
            <!--Second slide-->
            <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('images/slider/2.jpg') }}"
                alt="Second slide">
            </div>
            <!--/Second slide-->
            <!--Third slide-->
            <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('images/slider/3.jpg') }}"
                alt="Third slide">
            </div>
            <!--/Third slide-->
        </div>
        <!--/.Slides-->
        <!--Controls-->
        <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        <!--/.Controls-->
    </div>
<!--/.Carousel Wrapper-->
</section>
<!-- End Home Banner -->

<!-- Section targeted research-->
    @include('includes.search')
<!-- End Section -->

