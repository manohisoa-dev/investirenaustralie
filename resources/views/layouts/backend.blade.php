@extends('layouts.app')

@section('content')

<!-- Main -->
<main>
    <section class="profile-bg-section parallax" style="background-image: url({{ asset('images/slider/1.jpg') }});">
    </section>
    <section class="profile-container gray-bg">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-lg-4 col-xl-3">
                    <div class="profile-aside">
                        <div class="card m-20px-b">
                            <div class="p-25px text-center">
                                <div class="avatar-80 border-radius-50 d-inline-block">
                                    <img src="{{ \App\Models\User::find(Auth::id())->imageUrl() }}" title="" alt="">
                                </div>
                                <h6 class="font-w-500 m-15px-t m-0px"><span class="font-w-700">{{ Auth::user()->name }}</span></h6>
                                <span class="font-small">{{ \App\Models\User::find(Auth::id())->roleUser->role_initial }}</span>
                                <div class="p-10px-t">
                                    @if(App\Models\User::find(Auth::id())->role == 5)
                                        <a class="m-btn m-btn-sm m-btn-theme-light m-btn-radius" href="{{ route('member.contact', ['role'=>'admin']) }}"><i class="far fa-envelope"></i> @lang('app.txt.sendmessage') </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="card m-20px-b">
                            @if(Auth::user()->hasRole(5))
                                <a class="btn-select-apl m-btn m-btn-theme4rd" data-toggle="modal" data-target="#modal-select-apl" href="{{route('member.select.apl')}}">@lang('member.select.apl')</a>
                            @endif
                            <div class="list-group list-group-flush">
                                <a href="{{url(\App\Models\User::find(Auth::id())->roleUser->role_initial)}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                                    <div>
                                        <i class="fa fa-tachometer-alt m-10px-r"></i>
                                        <span>@lang('app.dashboard')</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                </a>
                                <a href="{{route('profile')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                                    <div>
                                        <i class="fa fa-edit m-10px-r"></i>
                                        <span>@lang('app.profile')</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                </a>

                            @if(Auth::user()->hasRole(5))
                                <a href="{{route('shop.order.last')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                                    <div>
                                        <i class="fa fa-cart-arrow-down m-10px-r"></i>
                                        <span>@lang('member.cart')</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                </a>
                                <a href="{{route('member.orders')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                                    <div>
                                        <i class="fa fa-cart-plus m-10px-r"></i>
                                        <span>@lang('member.orders')</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                </a>
                                <a href="{{route('member.purchases')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                                    <div>
                                        <i class="far fa-credit-card m-10px-r"></i>
                                        <span>@lang('member.purchases')</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                </a>
                                <a href="{{route('member.contact', ['role'=>'admin'])}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                                    <div>
                                        <i class="far fa-envelope m-10px-r"></i>
                                        <span>@lang('member.contact_admin')</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                </a>
                                @if(Auth::user()->hasApl())
                                  <a href="{{route('member.contact', ['role'=>'apl'])}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                                      <div>
                                          <i class="far fa-envelope m-10px-r"></i>
                                          <span>@lang('member.contact_apl')</span>
                                      </div>
                                      <div>
                                          <i class="fas fa-chevron-right"></i>
                                      </div>
                                  </a>
                                @endif
                            @endif

                            @If(Auth::user()->hasRole(4))
                              <a href="{{route('apl.orders')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                                  <div>
                                      <i class="fa fa-cart-plus m-10px-r"></i>
                                      <span>@lang('apl.orders')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>
                              <a href="{{route('apl.sales')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                                  <div>
                                      <i class="fa fa-chart-line m-10px-r"></i>
                                      <span>@lang('apl.sales')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>
                              <a href="{{route('apl.customers')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                                  <div>
                                      <i class="fa fa-users m-10px-r"></i>
                                      <span>@lang('apl.customers')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>
                              <a href="{{route('apl.commissions', ['filter'=>'not-paid'])}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                                  <div>
                                      <i class="fa fa-hand-holding-usd m-10px-r"></i>
                                      <span>@lang('app.commissions.not_paid')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>
                              <a href="{{route('apl.commissions', ['filter'=>'paid'])}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                                  <div>
                                      <i class="far fa-money-bill-alt m-10px-r"></i>
                                      <span>@lang('app.commissions.paid')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>
                            @endif

                            @If(Auth::user()->hasRole(3))
                              <a href="{{route('afa.orders')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                                  <div>
                                      <i class="fa fa-cart-plus m-10px-r"></i>
                                      <span>@lang('afa.orders')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>
                              <a href="{{route('afa.sales')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                                  <div>
                                      <i class="fa fa-chart-line m-10px-r"></i>
                                      <span>@lang('afa.sales')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>
                              <a href="{{route('afa.commissions', ['filter'=>'paid'])}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                                  <div>
                                      <i class="fa fa-money-bill-alt m-10px-r"></i>
                                      <span>@lang('app.commissions.paid')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>
                              <a href="{{route('afa.commissions', ['filter'=>'not-paid'])}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                                  <div>
                                      <i class="fa fa-hand-holding-usd m-10px-r"></i>
                                      <span>@lang('app.commissions.not_paid')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>
                            @endif

                            @If(Auth::user()->hasRole(2))
                              <a href="{{route('seller.products')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                                  <div>
                                      <i class="fa fa-paperclip m-10px-r"></i>
                                      <span>@lang('seller.products')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>
                              <a href="{{route('seller.orders')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                                  <div>
                                      <i class="fa fa-cart-plus m-10px-r"></i>
                                      <span>@lang('seller.orders')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>
                              <a href="{{route('seller.sales')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                                  <div>
                                      <i class="fa fa-chart-line m-10px-r"></i>
                                      <span>@lang('seller.sales')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>
                            @endif

                            @if(!Auth::user()->isAdmin())
                              <a href="{{url(\App\Models\User::find(Auth::id())->roleUser->role_initial.'/favorites')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                                  <div>
                                      <i class="fa fa-heart m-10px-r"></i>
                                      <span>@lang('app.favorites')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>
                              <a href="{{url(\App\Models\User::find(Auth::id())->roleUser->role_initial.'/searches')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                                  <div>
                                      <i class="fa fa-search m-10px-r"></i>
                                      <span>@lang('app.searches')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>
                              <a href="{{route(''.\App\Models\User::find(Auth::id())->roleUser->role_initial.'.mail.list',['filter'=>'inbox'])}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                                  <div>
                                      <i class="far fa-envelope m-10px-r"></i>
                                      <span>@lang('app.mails')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>
                            @endif

                            <a href="{{route('logout')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                                  <div>
                                      <i class="fa fa-sign-out-alt m-10px-r"></i>
                                      <span>@lang('app.logout')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- subcontent -->
                @include('includes.alerts')
                @yield('subcontent')
                <!-- end subcontent -->
            </div>
        </div>
    </section>
</main>
<!-- main end -->


@if(Auth::user()->hasRole(5))
<!-- Modal -->
<div id="modal-select-apl" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
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
          <button class="m-btn m-btn-theme" data-dismiss="modal" aria-hidden="true">@lang('app.btn.cancel')</button>
          @if(Auth::user()->hasAPl())
            <a href="{{route('member.select.apl')}}" class="m-btn m-btn-theme" type="submit">@lang('app.btn.next')</a>
          @else
              <a href="{{route('member.select.apl')}}" class="m-btn m-btn-theme4rd" type="submit">@lang('member.select.apl')</a>
          @endif
      </div>
    </div>
  </div>
</div>
@endif

@endsection
