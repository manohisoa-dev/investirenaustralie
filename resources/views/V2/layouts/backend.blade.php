@extends('V2.layouts.app')

@section('content')

<!-- Main -->
<main>
    <section class="profile-bg-section parallax" style="background-image: url({{ asset('images/slider/2.jpg') }});">
    </section>
    <section class="profile-container gray-bg">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-lg-4 col-xl-3">
                    <div class="profile-aside">
                        <div class="card m-20px-b">
                            <div class="p-25px text-center">
                                <div class="avatar-80 border-radius-50 d-inline-block">
                                    <img src="static/img/500x500.jpg" title="" alt="">
                                </div>
                                <h6 class="font-w-500 m-15px-t m-0px"><span class="font-w-700">Rachel</span> Roth</h6>
                                <span class="font-small">UI/UX Designer</span>
                                <div class="p-10px-t">
                                    <a class="m-btn m-btn-sm m-btn-theme-light m-btn-radius" href="#"><i class="far fa-envelope"></i> Send a Message</a>
                                </div>
                            </div>
                        </div>
                        <div class="card m-20px-b">
                          @if(Auth::user()->hasRole(5))
                              <a class="btn-select-apl m-btn m-btn-theme4rd" href="{{route('member.select.apl')}}">@lang('member.select.apl')</a>
                          @endif
                        </div>
                        <div class="card m-20px-b">
                            <div class="card-header">
                                <h6 class="m-0px">My Account</h6>
                            </div>
                            <div class="list-group list-group-flush">
                                <!-- <a href="profile.html" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                                    <div>
                                        <i class="far fa-user-circle m-10px-r"></i>
                                        <span>My Profile</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                </a> -->
                                <a href="{{url(Auth::user()->role)}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                                    <div>
                                        <i class="fas fa-tachometer m-10px-r"></i>
                                        <span>@lang('app.dashboard')</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                </a>
                                <a href="account-billing.html" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                                    <div>
                                        <i class="far fa-credit-card m-10px-r"></i>
                                        <span>Billing</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                </a>
                                <a href="account-notifications.html" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                                    <div>
                                        <i class="far fa-bell m-10px-r"></i>
                                        <span>Notifications</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-xl-9">
                    <div class="profile-content-area m-40px-tb card card-body">
                        <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                            <h3 class="m-5px-b">Hello, I am rachel Roth</h3>
                            <h6 class="body-color font-w-500 m-25px-b">London, UK - Joined in April 2019</h6>
                            <p>I design and develop services for customers of all sizes, specializing in creating stylish, modern websites, web services and online stores. My passion is to design digital user experiences through the bold interface and meaningful interactions.</p>
                            <div class="nav">
                                <div class="media align-items-center m-20px-r m-5px-tb">
                                    <div class="icon-30 theme-bg white-color border-radius-50">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="media-body p-10px-l">
                                        10 Skills
                                    </div>
                                </div>
                                <div class="media align-items-center m-20px-r m-5px-tb">
                                    <div class="icon-30 green-bg white-color border-radius-50">
                                        <i class="fas fa-award"></i>
                                    </div>
                                    <div class="media-body p-10px-l">
                                        9 Awards
                                    </div>
                                </div>
                                <div class="media align-items-center m-20px-r m-5px-tb">
                                    <div class="icon-30 pink-bg white-color border-radius-50">
                                        <i class="far fa-paper-plane"></i>
                                    </div>
                                    <div class="media-body p-10px-l">
                                        6k Followers
                                    </div>
                                </div>
                            </div>
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
            </div>
        </div>
    </section>
</main>
<!-- main end -->

<!-- <div class="content corps" style="margin-top: 160px;">
    <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="sidebar content-box" style="display: block; background: #fff; margin-bottom: 10px;">
                <ul class="nav nav-side">

                    @if(Auth::user()->hasRole(5))
                        <li><a class="btn-select-apl btn btn-success" href="{{route('member.select.apl')}}">@lang('member.select.apl')</a></li>
                    @endif
                    
                    <li><a href="{{url(Auth::user()->role)}}"><i class="fa fa-tachometer" aria-hidden="true"></i> @lang('app.dashboard')</a></li>
                    <li><a href="{{route('profile')}}"><i class="fa fa-pencil-square" aria-hidden="true"></i> @lang('app.profile')</a></li>
                    
                    @if(Auth::user()->hasRole(5))
                        <li><a href="{{route('shop.order.last')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> @lang('member.cart')</a></li>
                        <li><a href="{{route('member.orders')}}"><i class="fa fa-shopping-basket" aria-hidden="true"></i> @lang('member.orders')</a></li>
                        <li><a href="{{route('member.purchases')}}"><i class="fa fa-shopping-bag" aria-hidden="true"></i> @lang('member.purchases')</a></li>
                    
                        <li><a href="{{route('member.contact', ['role'=>'admin'])}}"><i class="fa fa-envelope" aria-hidden="true"></i> @lang('member.contact_admin')</a></li>
                        @if(Auth::user()->hasApl())
                            <li><a href="{{route('member.contact', ['role'=>'apl'])}}"><i class="fa fa-envelope" aria-hidden="true"></i> @lang('member.contact_apl')</a></li>
                        @endif
                    @endif
                    
                    @If(Auth::user()->hasRole(4))
                        <li><a href="{{route('apl.orders')}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('apl.orders')</a></li>
                        <li><a href="{{route('apl.sales')}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('apl.sales')</a></li>
                        <li><a href="{{route('apl.customers')}}"><i class="fa fa-users" aria-hidden="true"></i> @lang('apl.customers')</a></li>
                    
                        <li><a href="{{route('apl.commissions', ['filter'=>'not-paid'])}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('app.commissions.not_paid')</a></li>
                        <li><a href="{{route('apl.commissions', ['filter'=>'paid'])}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('app.commissions.paid')</a></li>
                    @endif
                    
                    @If(Auth::user()->hasRole(3))
                        <li><a href="{{route('afa.orders')}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('afa.orders')</a></li>
                        <li><a href="{{route('afa.sales')}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('afa.sales')</a></li>
                    
                        <li><a href="{{route('afa.commissions', ['filter'=>'paid'])}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('app.commissions.paid')</a></li>
                        <li><a href="{{route('afa.commissions', ['filter'=>'not-paid'])}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('app.commissions.not_paid')</a></li>
                    @endif
                    
                    @If(Auth::user()->hasRole(2))
                        <li><a href="{{route('seller.products')}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('seller.products')</a></li>
                        <li><a href="{{route('seller.orders')}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('seller.orders')</a></li>
                        <li><a href="{{route('seller.sales')}}"><i class="fa fa-paperclip" aria-hidden="true"></i> @lang('seller.sales')</a></li>
                    @endif
                    
                    @if(!Auth::user()->isAdmin())
                        <li><a href="{{url(Auth::user()->role.'/favorites')}}"><i class="fa fa-gratipay" aria-hidden="true"></i> @lang('app.favorites')</a></li>
                        <li><a href="{{url(Auth::user()->role.'/searches')}}"><i class="fa fa-search" aria-hidden="true"></i> @lang('app.saved_searches')</a></li>
                        <li>
                             <a href="{{route(App\Role::find(Auth::user()->role)->role_initial.'.mail.list',['filter'=>'inbox'])}}">
                                <i class="fa fa-envelope"></i> @lang('app.mails')
                             </a>
                        </li>
                    @endif
                    
                    <li><a href="{{route('logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> @lang('app.logout')</a></li>
                </ul>
             </div>
          </div>
          <div class="col-md-9">
              @include('includes.alerts')
              @yield('subcontent')
          </div>
      </div>
  </div>
</div> -->

@if(Auth::user()->hasRole(5))
<!-- Modal -->
<!-- <div id="modal-select-apl" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="title">@lang('member.info')</h4>
      </div>
      <div class="modal-body">
          @if(Auth::user()->hasAPl())
          <p>@lang('member.info_has_apl')</p>
          @else
          <p>@lang('member.info_no_apl')</p>
          @endif
      </div>
      <div class="modal-footer">
          <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">@lang('app.btn.cancel')</button>
          @if(Auth::user()->hasAPl())
            <a href="{{route('member.select.apl')}}" class="btn btn-success" type="submit">@lang('app.btn.next')</a>
          @else
            <a href="{{route('member.select.apl')}}" class="btn btn-success" type="submit">@lang('member.select.apl')
          @endif
      </div>
    </div>
  </div>
</div> -->
@endif

@endsection
