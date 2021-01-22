@extends('V2.layouts.app')

@section('content')

<!-- Main -->
<main>
    @if($item->id==1)
        @include('V2.includes.slider')
    @else
        @component('V2.includes.breadcrumb')
            {{$item->title}}
        @endcomponent
    @endif    
    <!-- Section -->
    <section id="about" class="section gray-bg">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6 text-center m-15px-tb">
                    <img src="static/img/500x500.jpg" title="" alt="">
                </div>
                <div class="col-lg-5 m-15px-tb">
                    <h2 class="h1 m-25px-b">Welcome to Mombo <u class="theme-color">Digital Marketing</u></h2>
                    <p class="m-5px-b">Mombo is a HTML5 template based on Sass and Bootstrap 4 with modern and creative multipurpose design you can use it as a startups. Ut enim ad minim veniam.
                    </p>
                    <div class="row">
                        <div class="col-md-6 m-15px-tb">
                            <h5 class="theme-color h6 m-10px-b">Mobile Friendly</h5>
                            <p class="m-0px">Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
                        </div>
                        <!-- col -->
                        <div class="col-md-6 m-15px-tb">
                            <h5 class="theme-color h6 m-10px-b">Multiple Layouts</h5>
                            <p class="m-0px">Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
                        </div>
                        <!-- col -->
                    </div>
                    <!-- row -->
                    <div class="btn-bar p-15px-t">
                        <a class="m-btn m-btn-radius m-btn-theme" href="#">More about</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Section -->
    <!-- Section -->
    <section id="feature" class="section bg-cover bg-no-repeat parallax" style="background-image: url(static/img/1600x900.jpg);">
        <div class="container">
            <div class="row md-m-25px-b m-45px-b justify-content-center text-center">
                <div class="col-lg-8">
                    <h3 class="h1 white-color m-20px-b p-20px-b white-after after-50px">List Of Features</h3>
                    <p class="m-0px font-2 white-color-light">Mombo is a HTML5 template based on Sass and Bootstrap 4 with modern and creative multipurpose design you can use it as a startups.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 m-15px-tb">
                    <div class="media">
                        <div class="only-icon-60 white-color">
                            <i class="icon-desktop"></i>
                        </div>
                        <div class="media-body p-20px-l">
                            <h5 class="white-color h6 m-10px-b">Elegant / Unique design</h5>
                            <p class="white-color-light m-0px">Mombo is a HTML5 template based on Sass and Bootstrap 4 with modern.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 m-15px-tb">
                    <div class="media">
                        <div class="only-icon-60 white-color">
                            <i class="icon-pricetags"></i>
                        </div>
                        <div class="media-body p-20px-l">
                            <h5 class="white-color h6 m-10px-b">Different Layout Type</h5>
                            <p class="white-color-light m-0px">Mombo is a HTML5 template based on Sass and Bootstrap 4 with modern.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 m-15px-tb">
                    <div class="media">
                        <div class="only-icon-60 white-color">
                            <i class="icon-chat"></i>
                        </div>
                        <div class="media-body p-20px-l">
                            <h5 class="white-color h6 m-10px-b">Make it Simple</h5>
                            <p class="white-color-light m-0px">Mombo is a HTML5 template based on Sass and Bootstrap 4 with modern.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 m-15px-tb">
                    <div class="media">
                        <div class="only-icon-60 white-color">
                            <i class="icon-mobile"></i>
                        </div>
                        <div class="media-body p-20px-l">
                            <h5 class="white-color h6 m-10px-b">Responsiveness</h5>
                            <p class="white-color-light m-0px">Mombo is a HTML5 template based on Sass and Bootstrap 4 with modern.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 m-15px-tb">
                    <div class="media">
                        <div class="only-icon-60 white-color">
                            <i class="icon-target"></i>
                        </div>
                        <div class="media-body p-20px-l">
                            <h5 class="white-color h6 m-10px-b">Testing for Perfection</h5>
                            <p class="white-color-light m-0px">Mombo is a HTML5 template based on Sass and Bootstrap 4 with modern.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 m-15px-tb">
                    <div class="media">
                        <div class="only-icon-60 white-color">
                            <i class="icon-tools-2"></i>
                        </div>
                        <div class="media-body p-20px-l">
                            <h5 class="white-color h6 m-10px-b">Advanced Options</h5>
                            <p class="white-color-light m-0px">Mombo is a HTML5 template based on Sass and Bootstrap 4 with modern.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Section -->
    <!-- Section -->
    <section class="section">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-5 m-15px-tb">
                    <h2 class="h1 m-25px-b">Take a look at how the new <u class="theme-color">Startup App works</u></h2>
                    <p class="m-5px-b">Mombo is a HTML5 template based on Sass and Bootstrap 4 with modern and creative multipurpose design you can use it as a startups. Ut enim ad minim veniam.</p>
                    <div class="btn-bar p-15px-t">
                        <a class="m-btn m-btn-radius m-btn-theme" href="#">More About</a>
                    </div>
                </div>
                <div class="col-lg-6 m-15px-tb">
                    <div class="video-box">
                        <img class="box-shadow border-radius-5" src="static/img/900x550.jpg" title="" alt="">
                        <a class="video-btn white popup-youtube p-center" href="https://www.youtube.com/watch?v=dNIfsv1rKJo"><span></span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Section -->
    <!-- Section -->
    <section class="section gray-bg">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-5 m-15px-tb">
                    <img src="static/img/500x500.jpg" title="" alt="">
                </div>
                <div class="col-lg-6 m-15px-tb">
                    <h2 class="h1 m-25px-b">Take a look at how the new <u class="theme-color">Startup App works</u></h2>
                    <p>Mombo is a HTML5 template based on Sass and Bootstrap 4 with modern and creative multipurpose..</p>
                    <div class="accordion accordion-02 p-10px-t">
                        <div class="acco-group white-bg">
                            <a href="#" class="acco-heading">Can I change plans later on?</a>
                            <div class="acco-des">Adipisicing elit lorem ipsum dolor sit amet, consectetur. Tempora, ab officiis ducimus commodi, quibusdam similique quam corporis.</div>
                        </div>
                        <div class="acco-group white-bg">
                            <a href="#" class="acco-heading">What is the difference between Pro and Ultimate?</a>
                            <div class="acco-des">Adipisicing elit lorem ipsum dolor sit amet, consectetur. Tempora, ab officiis ducimus commodi, quibusdam similique quam corporis.</div>
                        </div>
                        <div class="acco-group white-bg">
                            <a href="#" class="acco-heading">Can I try before I buy?</a>
                            <div class="acco-des">Adipisicing elit lorem ipsum dolor sit amet, consectetur. Tempora, ab officiis ducimus commodi, quibusdam similique quam corporis.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Section -->
    <!-- Section -->
    <section class="section bg-cover bg-center bg-no-repeat parallax" style="background-image: url(static/img/1600x900.jpg);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <label class="white-color-light">Feel The Futuer</label>
                    <h2 class="h1 white-color m-25px-b"><u>Growth and development</u> are fostered here!</h2>
                    <div class="m-btn-dual">
                        <a class="m-btn m-btn-white m-btn-radius m-btn-shadow" href="#"><i class="fab fa-google-play m-5px-r"></i> Google Play</a>
                        <a class="m-btn m-btn-white m-btn-radius m-btn-shadow" href="#"><i class="fab fa-apple m-5px-r"></i> App Store</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Section -->
    <!-- Section -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-5 m-15px-tb">
                    <h2 class="h1 m-15px-b">Get tips & tricks on <u class="theme-color">how to skyrocket</u>your sales.</h2>
                    <div class="tab-style-2 dark p-15px-t">
                        <ul class="nav" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-01-tab" data-toggle="pill" href="#pills-01" role="tab" aria-controls="pills-01" aria-selected="false">
                                    Friendly
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-02-tab" data-toggle="pill" href="#pills-02" role="tab" aria-controls="pills-02" aria-selected="true">
                                    Multiple
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-03-tab" data-toggle="pill" href="#pills-03" role="tab" aria-controls="pills-03" aria-selected="false">
                                    Install
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-01" role="tabpanel" aria-labelledby="pills-01-tab">
                                <p>Mombo is a HTML5 template based on Sass and Bootstrap 4 with modern and creative multipurpose design you can use it as a startups.</p>
                                <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            </div>
                            <div class="tab-pane fade" id="pills-02" role="tabpanel" aria-labelledby="pills-02-tab">
                                <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                <p>Mombo is a HTML5 template based on Sass and Bootstrap 4 with modern and creative multipurpose design you can use it as a startups.</p>
                            </div>
                            <div class="tab-pane fade" id="pills-03" role="tabpanel" aria-labelledby="pills-03-tab">
                                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 m-15px-tb">
                    <img src="static/img/500x500.jpg" title="" alt="">
                </div>
            </div>
        </div>
    </section>
    <!--End Section -->
    <!-- Section -->
    <section id="team" class="section gray-bg">
        <div class="container">
            <div class="row md-m-25px-b m-45px-b justify-content-center text-center">
                <div class="col-lg-8">
                    <h3 class="h1 m-20px-b p-20px-b theme-after after-50px">Our Advisors</h3>
                    <p class="m-0px font-2">Mombo is a HTML5 template based on Sass and Bootstrap 4 with modern and creative multipurpose design you can use it as a startups.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6 m-15px-tb">
                    <div class="hover-top-in text-center">
                        <div class="avatar-220 border-radius-50 d-inline-block">
                            <img src="static/img/500x500.jpg" title="" alt="">
                        </div>
                        <div class="m-10px-lr box-shadow border-radius-5 position-relative mt-n4 white-bg p-20px text-center hover-top--in">
                            <h6 class="m-5px-b">Nancy Bayers</h6>
                            <small>Co-Founder</small>
                            <div class="social-icon si-30 theme round nav justify-content-center p-10px-t">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 m-15px-tb">
                    <div class="hover-top-in text-center">
                        <div class="avatar-220 border-radius-50 d-inline-block">
                            <img src="static/img/500x500.jpg" title="" alt="">
                        </div>
                        <div class="m-10px-lr box-shadow border-radius-5 position-relative mt-n4 white-bg p-20px text-center hover-top--in">
                            <h6 class="m-5px-b">Nancy Bayers</h6>
                            <small>Co-Founder</small>
                            <div class="social-icon si-30 theme round nav justify-content-center p-10px-t">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 m-15px-tb">
                    <div class="hover-top-in text-center">
                        <div class="avatar-220 border-radius-50 d-inline-block">
                            <img src="static/img/500x500.jpg" title="" alt="">
                        </div>
                        <div class="m-10px-lr box-shadow border-radius-5 position-relative mt-n4 white-bg p-20px text-center hover-top--in">
                            <h6 class="m-5px-b">Nancy Bayers</h6>
                            <small>Co-Founder</small>
                            <div class="social-icon si-30 theme round nav justify-content-center p-10px-t">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 m-15px-tb">
                    <div class="hover-top-in text-center">
                        <div class="avatar-220 border-radius-50 d-inline-block">
                            <img src="static/img/500x500.jpg" title="" alt="">
                        </div>
                        <div class="m-10px-lr box-shadow border-radius-5 position-relative mt-n4 white-bg p-20px text-center hover-top--in">
                            <h6 class="m-5px-b">Nancy Bayers</h6>
                            <small>Co-Founder</small>
                            <div class="social-icon si-30 theme round nav justify-content-center p-10px-t">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Section -->
    <!-- Section -->
    <section class="section">
        <div class="container">
            <div class="row md-m-25px-b m-45px-b justify-content-center text-center">
                <div class="col-lg-8">
                    <h3 class="h1 m-20px-b p-20px-b theme-after after-50px">Testimonials</h3>
                    <p class="m-0px font-2">Mombo is a HTML5 template based on Sass and Bootstrap 4 with modern and creative multipurpose design you can use it as a startups.</p>
                </div>
            </div>
            <div class="owl-carousel" data-items="3" data-nav-dots="true" data-md-items="3" data-sm-items="2" data-xs-items="1" data-xx-items="1" data-space="30">
                <div class="border-all-1 border-color-dark-gray text-center m-25px-t m-20px-b">
                    <div class="icon-60 border-radius-50 theme2nd-bg white-color d-inline-block mt-n5">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    <div class="p-25px">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
                        <h5 class="h6 m-0px">Nancy Bayers</h5>
                        <label class="font-w-600 font-small m-0px">Co-founder</label>
                    </div>
                </div>
                <div class="border-all-1 border-color-dark-gray text-center m-25px-t m-20px-b">
                    <div class="icon-60 border-radius-50 theme2nd-bg white-color d-inline-block mt-n5">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    <div class="p-25px">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
                        <h5 class="h6 m-0px">Nancy Bayers</h5>
                        <label class="font-w-600 font-small m-0px">Co-founder</label>
                    </div>
                </div>
                <div class="border-all-1 border-color-dark-gray text-center m-25px-t m-20px-b">
                    <div class="icon-60 border-radius-50 theme2nd-bg white-color d-inline-block mt-n5">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    <div class="p-25px">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
                        <h5 class="h6 m-0px">Nancy Bayers</h5>
                        <label class="font-w-600 font-small m-0px">Co-founder</label>
                    </div>
                </div>
                <div class="border-all-1 border-color-dark-gray text-center m-25px-t m-20px-b">
                    <div class="icon-60 border-radius-50 theme2nd-bg white-color d-inline-block mt-n5">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    <div class="p-25px">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
                        <h5 class="h6 m-0px">Nancy Bayers</h5>
                        <label class="font-w-600 font-small m-0px">Co-founder</label>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section -->
    <!-- Section -->
    <section id="price" class="section gray-bg">
        <div class="container">
            <div class="row md-m-25px-b m-45px-b justify-content-center text-center">
                <div class="col-lg-8">
                    <h3 class="h1 m-20px-b p-20px-b theme-after after-50px">Pricing Plans</h3>
                    <p class="m-0px font-2">Mombo is a HTML5 template based on Sass and Bootstrap 4 with modern and creative multipurpose design you can use it as a startups.</p>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-3 m-15px-tb">
                    <div class="price-table-01">
                        <div class="pt-head">
                            <h4>Basic Package</h4>
                            <h5><span>$</span>49</h5>
                        </div>
                        <div class="pt-body">
                            <ul class="list-type-02">
                                <li><i class="fas fa-check"></i> Drag &amp; Drop Builder</li>
                                <li><i class="fas fa-check"></i> 1,000s of Templates Ready</li>
                                <li><i class="fas fa-check"></i> Blog Tools</li>
                                <li><i class="fas fa-check"></i> eCommerce Store</li>
                                <li><i class="fas fa-check"></i> 30+ Webmaster Tools</li>
                            </ul>
                        </div>
                        <div class="pt-footer">
                            <a class="m-btn m-btn-theme m-btn-radius" href="#">Sign Up</a>
                        </div>
                    </div>
                </div> <!-- col -->
                <div class="col-md-6 col-lg-3 m-15px-tb">
                    <div class="price-table-01">
                        <div class="pt-head">
                            <h4>Basic Package</h4>
                            <h5><span>$</span>49</h5>
                        </div>
                        <div class="pt-body">
                            <ul class="list-type-02">
                                <li><i class="fas fa-check"></i> Drag &amp; Drop Builder</li>
                                <li><i class="fas fa-check"></i> 1,000s of Templates Ready</li>
                                <li><i class="fas fa-check"></i> Blog Tools</li>
                                <li><i class="fas fa-check"></i> eCommerce Store</li>
                                <li><i class="fas fa-check"></i> 30+ Webmaster Tools</li>
                            </ul>
                        </div>
                        <div class="pt-footer">
                            <a class="m-btn m-btn-theme m-btn-radius" href="#">Sign Up</a>
                        </div>
                    </div>
                </div> <!-- col -->
                <div class="col-md-6 col-lg-3 m-15px-tb">
                    <div class="price-table-01 active">
                        <div class="pt-head">
                            <h4>Basic Package</h4>
                            <h5><span>$</span>49</h5>
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="pt-body">
                            <ul class="list-type-02">
                                <li><i class="fas fa-check"></i> Drag &amp; Drop Builder</li>
                                <li><i class="fas fa-check"></i> 1,000s of Templates Ready</li>
                                <li><i class="fas fa-check"></i> Blog Tools</li>
                                <li><i class="fas fa-check"></i> eCommerce Store</li>
                                <li><i class="fas fa-check"></i> 30+ Webmaster Tools</li>
                            </ul>
                        </div>
                        <div class="pt-footer">
                            <a class="m-btn m-btn-theme2nd m-btn-radius" href="#">Sign Up</a>
                        </div>
                    </div>
                </div> <!-- col -->
                <div class="col-md-6 col-lg-3 m-15px-tb">
                    <div class="price-table-01">
                        <div class="pt-head">
                            <h4>Basic Package</h4>
                            <h5><span>$</span>49</h5>
                        </div>
                        <div class="pt-body">
                            <ul class="list-type-02">
                                <li><i class="fas fa-check"></i> Drag &amp; Drop Builder</li>
                                <li><i class="fas fa-check"></i> 1,000s of Templates Ready</li>
                                <li><i class="fas fa-check"></i> Blog Tools</li>
                                <li><i class="fas fa-check"></i> eCommerce Store</li>
                                <li><i class="fas fa-check"></i> 30+ Webmaster Tools</li>
                            </ul>
                        </div>
                        <div class="pt-footer">
                            <a class="m-btn m-btn-theme m-btn-radius" href="#">Sign Up</a>
                        </div>
                    </div>
                </div> <!-- col -->
            </div>
        </div>
    </section>
    <!-- End Section -->
    <!-- Section -->
    <section id="blog" class="section">
        <div class="container">
            <div class="row md-m-25px-b m-45px-b justify-content-center text-center">
                <div class="col-lg-8">
                    <h3 class="h1 m-20px-b p-20px-b theme-after after-50px">Daily Updates</h3>
                    <p class="m-0px font-2">Mombo is a HTML5 template based on Sass and Bootstrap 4 with modern and creative multipurpose design you can use it as a startups.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3 m-15px-tb">
                    <div class="blog-grid">
                        <div class="blog-grid-img">
                            <a href="#">
                                <img src="static/img/900x550.jpg" title="" alt="">
                            </a>
                        </div>
                        <div class="blog-gird-info">
                            <div class="b-meta">
                                <span class="date">02 Mar 2019</span>
                                <span class="meta">Design</span>
                            </div>
                            <h5><a href="#">Make your Marketing website</a></h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            <div class="btn-grid">
                                <a class="m-btn m-btn-theme m-btn-radius m-btn-sm" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 m-15px-tb">
                    <div class="blog-grid">
                        <div class="blog-grid-img">
                            <a href="#">
                                <img src="static/img/900x550.jpg" title="" alt="">
                            </a>
                        </div>
                        <div class="blog-gird-info">
                            <div class="b-meta">
                                <span class="date">02 Mar 2019</span>
                                <span class="meta">Design</span>
                            </div>
                            <h5><a href="#">Make your Marketing website</a></h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            <div class="btn-grid">
                                <a class="m-btn m-btn-theme m-btn-radius m-btn-sm" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 m-15px-tb">
                    <div class="blog-grid">
                        <div class="blog-grid-img">
                            <a href="#">
                                <img src="static/img/900x550.jpg" title="" alt="">
                            </a>
                        </div>
                        <div class="blog-gird-info">
                            <div class="b-meta">
                                <span class="date">02 Mar 2019</span>
                                <span class="meta">Design</span>
                            </div>
                            <h5><a href="#">Make your Marketing website</a></h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            <div class="btn-grid">
                                <a class="m-btn m-btn-theme m-btn-radius m-btn-sm" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 m-15px-tb">
                    <div class="blog-grid">
                        <div class="blog-grid-img">
                            <a href="#">
                                <img src="static/img/900x550.jpg" title="" alt="">
                            </a>
                        </div>
                        <div class="blog-gird-info">
                            <div class="b-meta">
                                <span class="date">02 Mar 2019</span>
                                <span class="meta">Design</span>
                            </div>
                            <h5><a href="#">Make your Marketing website</a></h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            <div class="btn-grid">
                                <a class="m-btn m-btn-theme m-btn-radius m-btn-sm" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section -->
    <!-- Section -->
    <section id="contact" class="section parallax" style="background-image: url(static/img/1600x900.jpg);">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-5">
                    <h3 class="h1 white-color m-20px-b p-20px-b white-after after-50px">let's start working together</h3>
                </div>
                <div class="col-lg-4 col-xl-3">
                    <div class="p-20px white-bg box-shadow">
                        <h5 class="h6 m-15px-b">Send A Message</h5>
                        <form class="rd-mailform" data-form-output="form-output-global" data-form-type="contact" method="post" action="static/plugin/mail/bat/rd-mailform.php">
                            <div class="form-group">
                                <input id="contact-name" type="text" name="name" placeholder="Name" data-constraints="@Required" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <input id="contact-email" type="email" name="email" placeholder="Email" data-constraints="@Required" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" id="contact-message" name="message" rows="4" placeholder="Your Comments" data-constraints="@Required"></textarea>
                            </div>
                            <div class="form-action">
                                <button class="m-btn m-btn-sm m-btn-theme m-btn-radius" type="submit" name="send">Get in touch</button>
                                <div class="snackbars" id="form-output-global"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section -->
</main>
<!-- End Main -->
@endsection
