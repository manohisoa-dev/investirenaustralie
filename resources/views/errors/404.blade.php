@extends('V2.layouts.app')

@section('content')
    <!-- Home Slider -->
    <section class="dark-bg" style="padding-top:5%;padding-bottom:5%;">
        <div class="container">
            <div class="row justify-content-center full-screen align-items-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-3 white-color m-15px-b">404 - Page Not Found..</h1>
                    <p class="h4">Whoops, it looks like the page you request wasn't found.</p>
                    <div class="m-30px-tb">
                        <img src="{{ asset('static/img/effect/404-page.svg') }}" title="" alt="">
                    </div>
                    <div>
                        <a class="m-btn m-btn-t-white m-btn-radius" href="{{ route('v2.home') }}">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end Home Slider -->
@endsection