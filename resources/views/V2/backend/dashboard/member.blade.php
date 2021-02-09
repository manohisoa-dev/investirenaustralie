@extends('V2.layouts.backend')

@section('subcontent')
<div class="col-lg-8 col-xl-9">
    <div class="profile-content-area m-40px-tb card card-body">
        <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
            <!-- Section -->
            <section class="p-50px-tb white-bg">
                <div class="container">
                    <div class="row counter">
                        <div class="col-6 col-md-6 col-lg-4 m-15px-tb text-center">
                            <div class="box-shadow white-bg p-20px border-bottom-5 border-color-theme2nd border-radius-5">
                                <h2 class="count h1" data-to="650" data-speed="650">{{$count['favorites']}}</h2>
                                <h6 class="font-w-500 m-0px">@lang('app.favorites')</h6>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-4 m-15px-tb text-center">
                            <div class="box-shadow white-bg p-20px border-bottom-5 border-color-theme2nd border-radius-5">
                                <h2 class="count h1" data-to="987" data-speed="987">{{$count['orders']}}</h2>
                                <h6 class="font-w-500 m-0px">@lang('app.orders')</h6>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-4 m-15px-tb text-center">
                            <div class="box-shadow white-bg p-20px border-bottom-5 border-color-theme2nd border-radius-5">
                                <h2 class="count h1" data-to="350" data-speed="350">{{$count['purchases']}}</h2>
                                <h6 class="font-w-500 m-0px">@lang('app.purchases')</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
            <div class="row">
                <div class="col-md-4 m-10px-tb">
                    <div class="media">
                        <div class="only-icon-20">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="media-body p-15px-l lh-normal">
                            <div class="dark-color m-5px-b font-w-600">Email</div>
                            <a class="body-color" href="#">rachel.roth@domain.com</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 m-10px-tb">
                    <div class="media">
                        <div class="only-icon-20">
                            <i class="fas fa-birthday-cake"></i>
                        </div>
                        <div class="media-body p-15px-l lh-normal">
                            <div class="dark-color m-5px-b font-w-600">Birthday</div>
                            <span>April 4, 1991</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 m-10px-tb">
                    <div class="media">
                        <div class="only-icon-20">
                            <i class="fas fa-globe"></i>
                        </div>
                        <div class="media-body p-15px-l lh-normal">
                            <div class="dark-color m-5px-b font-w-600">Language</div>
                            <span>English, French</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 m-10px-tb">
                    <div class="media">
                        <div class="only-icon-20">
                            <i class="fas fa-link"></i>
                        </div>
                        <div class="media-body p-15px-l lh-normal">
                            <div class="dark-color m-5px-b font-w-600">Website</div>
                            <a class="body-color" href="#">www.pxdraft.com</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 m-10px-tb">
                    <div class="media">
                        <div class="only-icon-20">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="media-body p-15px-l lh-normal">
                            <div class="dark-color m-5px-b font-w-600">Organization</div>
                            <span>pxdraft Ltd.</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 m-10px-tb">
                    <div class="media">
                        <div class="only-icon-20">
                            <i class="fas fa-tags"></i>
                        </div>
                        <div class="media-body p-15px-l lh-normal">
                            <div class="dark-color m-5px-b font-w-600">Organization</div>
                            <span>HTML, CSS, JavaScript</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 m-10px-tb">
                    <div class="media">
                        <div class="only-icon-20">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="media-body p-15px-l lh-normal">
                            <div class="dark-color m-5px-b font-w-600">Location</div>
                            <span>London, England</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 m-10px-tb">
                    <div class="media">
                        <div class="only-icon-20">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <div class="media-body p-15px-l lh-normal">
                            <div class="dark-color m-5px-b font-w-600">Phone</div>
                            <span>+01 799 966 6532</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
            <h5>Connections</h5>
            <div class="row">
                <div class="col-sm-6 col-xl-4 m-10px-tb">
                    <div class="card">
                        <a href="#" class="media align-items-center lh-normal p-10px gray-bg">
                            <div class="avatar-50 border-radius-50">
                                <img src="static/img/500x500.jpg" title="" alt="">
                            </div>
                            <div class="media-body p-10px-l">
                                <h6 class="font-w-600 m-0px">Rachel Roth</h6>
                                <span class="font-small body-color">UI/UX Designer</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4 m-10px-tb">
                    <div class="card">
                        <a href="#" class="media align-items-center lh-normal p-10px gray-bg">
                            <div class="avatar-50 border-radius-50">
                                <img src="static/img/500x500.jpg" title="" alt="">
                            </div>
                            <div class="media-body p-10px-l">
                                <h6 class="font-w-600 m-0px">Rachel Roth</h6>
                                <span class="font-small body-color">UI/UX Designer</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4 m-10px-tb">
                    <div class="card">
                        <a href="#" class="media align-items-center lh-normal p-10px gray-bg">
                            <div class="avatar-50 border-radius-50">
                                <img src="static/img/500x500.jpg" title="" alt="">
                            </div>
                            <div class="media-body p-10px-l">
                                <h6 class="font-w-600 m-0px">Rachel Roth</h6>
                                <span class="font-small body-color">UI/UX Designer</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
            <h5>Work experience</h5>
            <div class="row">
                <div class="col-sm-6 m-15px-tb">
                    <div class="card p-15px">
                        <div class="media align-items-center">
                            <div class="only-icon-60 theme-color">
                                <i class="fab fa-google"></i>
                            </div>
                            <div class="media-body p-15px-l">
                                <span class="font-small">Jul 2018</span>
                                <h6 class="m-0px">Senior Frontend Developer</h6>
                                <p class="m-0px">at Google - SF, USA</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
            <h5>Social Profiles</h5>
            <div class="row">
                <div class="col-sm-6 col-xl-3 m-10px-tb">
                    <div class="card p-10px">
                        <a href="#" class="media align-items-center lh-normal">
                            <div class="icon-40 border-radius-50 theme-bg white-color">
                                <i class="fab fa-facebook-f"></i>
                            </div>
                            <div class="media-body p-10px-l">
                                <h6 class="font-w-600 m-0px">Facbook</h6>
                                <span class="font-small body-color">5k Followers</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 m-10px-tb">
                    <div class="card p-10px">
                        <a href="#" class="media align-items-center lh-normal">
                            <div class="icon-40 border-radius-50 theme-bg white-color">
                                <i class="fab fa-twitter"></i>
                            </div>
                            <div class="media-body p-10px-l">
                                <h6 class="font-w-600 m-0px">Twitter</h6>
                                <span class="font-small body-color">9k Followers</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 m-10px-tb">
                    <div class="card p-10px">
                        <a href="#" class="media align-items-center lh-normal">
                            <div class="icon-40 border-radius-50 theme-bg white-color">
                                <i class="fab fa-linkedin-in"></i>
                            </div>
                            <div class="media-body p-10px-l">
                                <h6 class="font-w-600 m-0px">Linkedin</h6>
                                <span class="font-small body-color">10k Followers</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 m-10px-tb">
                    <div class="card p-10px">
                        <a href="#" class="media align-items-center lh-normal">
                            <div class="icon-40 border-radius-50 theme-bg white-color">
                                <i class="fab fa-instagram"></i>
                            </div>
                            <div class="media-body p-10px-l">
                                <h6 class="font-w-600 m-0px">Instagram</h6>
                                <span class="font-small body-color">19k Followers</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <h5>Reviews </h5>
            <div class="media-comment">
                <div class="media m-15px-b">
                    <div class="avatar-50 border-radius-50">
                        <img src="static/img/500x500.jpg" title="" alt="">
                    </div>
                    <div class="media-body align-self-center p-15px-l">
                        <h6>Dick Grayson</h6>
                        <div class="nav yellow-color small">
                            <span class="fas fa-star"></span>
                            <span class="fas fa-star"></span>
                            <span class="fas fa-star"></span>
                            <span class="fas fa-star"></span>
                            <span class="fas fa-star-half"></span>
                        </div>
                    </div>
                    <div class="media-body text-right">
                        <span>5 hours ago.</span>
                    </div>
                </div>
                <p class="font-2">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
                </p>
                <ul class="list-inline d-flex m-0px">
                    <li class="list-inline-item">
                        <a class="text-secondary" href="#">
                            17
                            <span class="far fa-thumbs-up ml-1"></span>
                        </a>
                    </li>
                    <li class="list-inline-item ml-3">
                        <a class="text-secondary" href="#">
                            0
                            <span class="far fa-thumbs-down ml-1"></span>
                        </a>
                    </li>
                    <li class="list-inline-item ml-auto">
                        <a class="text-secondary" href="#">
                            <span class="far fa-comments mr-1"></span>
                            Reply
                        </a>
                    </li>
                </ul>
            </div>
            <div class="m-20px-t">
                <button class="m-btn m-btn-radius m-btn-theme-light w-100">See More</button>
            </div>
        </div>
    </div>
</div>






<div class="row">
    <div id="property-sidebar">
        <div class="col-sm-12">
            <div class="col-sm-4">
                <a href="#">
                    <section class="widget text-center">
                        <strong>@lang('app.favorites')</strong>
                        <h3>{{$count['favorites']}}</h3>
                    </section>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="#">
                    <section class="widget text-center">
                        <strong>@lang('app.orders')</strong>
                        <h3>{{$count['orders']}}</h3>
                    </section>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="#">
                    <section class="widget text-center">
                        <strong>@lang('app.purchases')</strong>
                        <h3>{{$count['purchases']}}</h3>
                    </section>
                </a>
            </div>
        </div>
    </div>
</div>
<div id="property-sidebar">
    <div class="col-sm-6">
        <section class="widget recent-properties clearfix">
            <h5 class="title">@lang('app.purchases')</h5>
            @foreach($recent['purchases'] as $product)
                @include('backend.product.item', ['product'=>$product])
            @endforeach
        </section>
    </div>
    <div class="col-sm-6">
        <section class="widget recent-properties clearfix">
            <h5 class="title">@lang('app.orders')</h5>
            @foreach($recent['orders'] as $product)
                @include('backend.product.item', ['product'=>$product])
            @endforeach
        </section>
    </div>
</div>
<div id="property-sidebar">
    <div class="col-sm-6">
        <section class="widget recent-properties clearfix">
            <h5 class="title">@lang('app.favorites')</h5>
            @foreach($recent['favorites'] as $product)
                @include('backend.product.item', ['product'=>$product])
            @endforeach
        </section>
    </div>
    <div class="col-sm-6">
        <section class="widget recent-properties clearfix">
            <h5 class="title">@lang('app.pins')</h5>
            @foreach($recent['pins'] as $product)
                @include('backend.product.item', ['product'=>$product])
            @endforeach
        </section>
    </div>
</div>
@endsection