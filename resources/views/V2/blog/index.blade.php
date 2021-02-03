@extends('V2.layouts.app')

@section('content')
<!-- Main -->
<main>
    <!-- Page Title -->
    <section class="bg-center bg-cover bg-fiexd effect-section" style="background-image: url({{$item->imageUrl()}});">
        <div class="mask dark-g-bg opacity-7"></div>
        <div class="container">
            <div class="row screen-65 justify-content-center align-items-center p-100px-tb">
                <div class="col-lg-10 text-center m-50px-t">
                    <h1 class="display-4 white-color m-25px-b">{{$item->title}}</h1>
                    <div class="d-flex align-items-center m-25px-t justify-content-center text-left">
                        <div>
                            <div class="avatar-50 border-radius-50">
                                <img src="{{$item->imageUrl()}}" title="{{$item->title}}" alt="{{$item->title}}">
                            </div>
                        </div>
                        <div class="p-15px-l">
                            <p class="h6 white-color m-0px">{{$item->author->name}}</p>
                            <small class="white-color-light">Co-Founder</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page Title -->
    <!-- Section -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="nav p-25px-b">
                        <span class="dark-color font-w-600"><i class="fas fa-calendar-alt "></i> {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('d F')}},{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->year }}</span>
                        <!-- <a class="dark-color font-w-600 m-15px-l" href="#"><i class="far fa-folder-open"></i> Categories</a> -->
                    </div>
                    
                    <div class="text-justify">{!! $item->content !!}</div>
                    
                    <div class="p-25px-tb m-35px-tb border-top-1 border-bottom-1 border-color-gray">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="m-0px">Share Post</h5>
                            </div>
                            <div>
                                <div class="nav justify-content-center justify-content-md-end social-icon si-30 gray">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="media gray-bg p-20px">
                        <div class="avatar-80 border-radius-50">
                            <img src="static/img/500x500.jpg" title="" alt="">
                        </div>
                        <div class="media-body p-20px-l">
                            <h5 class="m-10px-b">Nancy Bayers</h5>
                            <p class="m-0px">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        </div>
                    </div>
                    <div class="comments-area m-40px-t m-50px-b">
                        <div class="border-bottom-1 border-color-gray p-10px-b m-25px-b">
                            <h4 class="m-0px">{{$item->comments_count}} Comments</h4>
                        </div>
                        <ul class="comment-list">
                            <li class="comment">
                                <article class="comment-body">
                                    <div class="comment-meta d-flex align-items-center">
                                        <div class="comment-author"><img src="static/img/500x500.jpg" title="" alt=""></div>
                                        <div class="comment-metadata">
                                            <div class="c-name">Nancy Bayer</div>
                                            <span class="c-date">May 15, 2019 at 5:50 PM</span>
                                        </div>
                                    </div>
                                    <div class="comment-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                    <div class="comment-reply">
                                        <a class="m-btn m-btn-t-theme m-btn-radius m-btn-sm" href="#">Reply</a>
                                    </div>
                                </article>
                                <ul class="children">
                                    <li class="comment">
                                        <article class="comment-body">
                                            <div class="comment-meta d-flex align-items-center">
                                                <div class="comment-author"><img src="static/img/500x500.jpg" title="" alt=""></div>
                                                <div class="comment-metadata">
                                                    <div class="c-name">Nancy Bayer</div>
                                                    <span class="c-date">May 15, 2019 at 5:50 PM</span>
                                                </div>
                                            </div>
                                            <div class="comment-content">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                            </div>
                                            <div class="comment-reply">
                                                <a class="m-btn m-btn-t-theme m-btn-radius m-btn-sm" href="#">Reply</a>
                                            </div>
                                        </article>
                                    </li>
                                </ul>
                            </li>
                            <li class="comment">
                                <article class="comment-body">
                                    <div class="comment-meta d-flex align-items-center">
                                        <div class="comment-author"><img src="static/img/500x500.jpg" title="" alt=""></div>
                                        <div class="comment-metadata">
                                            <div class="c-name">Nancy Bayer</div>
                                            <span class="c-date">May 15, 2019 at 5:50 PM</span>
                                        </div>
                                    </div>
                                    <div class="comment-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                    <div class="comment-reply">
                                        <a class="m-btn m-btn-t-theme m-btn-radius m-btn-sm" href="#">Reply</a>
                                    </div>
                                </article>
                            </li>
                        </ul>
                    </div>
                    <div class="card gray-bg">
                        <div class="card-body">
                            <h4 class="m-30px-b">Leave a Reply</h4>
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Full Name</label>
                                            <input type="text" class="form-control" placeholder="Martin Luthar">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Your Email</label>
                                            <input type="text" class="form-control" placeholder="info@domain.com">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label">Your Comment?</label>
                                            <textarea class="form-control" rows="6" name="answer" placeholder="Hello, There! " aria-label="How'd you hear about Front?" required="" data-msg="Please enter an answer." data-error-class="u-has-error" data-success-class="u-has-success"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" id="check-terms">
                                                <label class="custom-control-label" for="check-terms">Save my name, email, and website in this browser for the next time I comment.</a></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="m-btn m-btn-radius m-btn-theme">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                    @include('V2.includes.sidebar')
                <!-- fin sidebar -->

            </div>
        </div>
    </section>
    <!-- End Section -->
</main>

@endsection

@section('script')
<script src="{{ asset('js/app.js') }}"></script>
@endsection
