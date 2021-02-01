@extends('V2.layouts.app')

@section('content')
    <!-- Home Slider -->
    <section class="white-bg" style="padding-top:8%;padding-bottom:5%;">
        <div class="container">
            <div class="row justify-content-center full-screen align-items-center">
                <div class="col-lg-8 text-center">
                    <h5 class="display-3 dark-color m-15px-b">404 - Page Not Found..</h5>
                    <p class="h4">Whoops, it looks like the page you request wasn't found.</p>
                    <div class="m-30px-tb">
                        <img src="{{ asset('static/img/effect/404-page.svg') }}" title="" alt="">
                    </div>
                    <div>
                        <a class="m-btn m-btn-theme2nd" href="{{ route('v2.home') }}">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end Home Slider -->
@endsection