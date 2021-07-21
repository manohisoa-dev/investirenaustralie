@extends('layouts.app')

@section('content')

@push('script')
    <style>
        #avatar {
            position: relative;
            z-index: 1;
        }
        #btn_edit_avatar {
            position: absolute;
            z-index: 2; /* .boite-doree sera au-dessus de .boite-verte et .boite-tirets */
            background:gray;
            margin-left: -80px;
            opacity: 0;
            transition: 2s;
        }

        #btn_edit_avatar:hover{
            opacity: 0.7;
            cursor: pointer;
        }

        .menu-active {
            background-color: #F1F1F1 !important;
            color: #AE4435 !important;
        }
    </style>
    
    <script>
        $('#btn_edit_avatar').click(function(){
            $('#editAvatarModal').modal('show');
        });

        $('#btn_close_edit_avatar').click(function(){
            location.reload();
        });

        $('#btn_save_edit_avatar').click(function(){
            $('#form_edit_avatar').submit();
        });

        // $('#upload_avatar').on('change',function(e){
        //     var file = $(this).val();
            
        //     readImage(file);

        //     // $('#image_avatar').attr('src',tmppath);

        // })

        function readImage(file) {
            // Check if the file is an image.
            if (file.type && file.type.indexOf('image') === -1) {
                console.log('File is not an image.', file.type, file);
                return;
            }

            const reader = new FileReader();
            reader.addEventListener('load', (event) => {
                img.src = event.target.result;
            });
            reader.readAsDataURL(file);
        }
    </script>
@endpush

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
                                    <img id="avatar" src="{{ \App\Models\User::find(Auth::id())->imageUrl() }}" title="" alt="">
                                    <span id="btn_edit_avatar" class="avatar-80 border-radius-50" title="@lang('app.txt.editavatar')"><i style="margin-top:30px;color:white;" class="fa fa-edit"></i></span>
                                </div>
                                <h6 class="font-w-500 m-15px-t m-0px"><span class="font-w-700">{{ Auth::user()->immat?Auth::user()->immat:'' }}</span></h6>
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
                                <a href="{{url(\App\Models\User::find(Auth::id())->roleUser->role_initial)}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{ (request()->is(\App\Models\User::find(Auth::id())->roleUser->role_initial)) ? 'menu-active' : '' }}">
                                    <div>
                                        <i class="fa fa-tachometer-alt m-10px-r"></i>
                                        <span>@lang('app.dashboard')</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                </a>
                                <a href="{{route('profile')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{ ( request()->is('profile')||request()->is('profile/password') ) ? 'menu-active' : '' }} ">
                                    <div>
                                        <i class="fa fa-edit m-10px-r"></i>
                                        <span>@lang('app.profile')</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                </a>

                            @if(Auth::user()->hasRole(5))
                                <a href="{{route('shop.order.last')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{ (request()->is('order/last')) ? 'menu-active' : '' }}">
                                    <div>
                                        <i class="fa fa-cart-arrow-down m-10px-r"></i>
                                        <span>@lang('member.cart')</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                </a>
                                <a href="{{route('member.orders')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{ (request()->is('member/orders')) ? 'menu-active' : '' }}">
                                    <div>
                                        <i class="fa fa-cart-plus m-10px-r"></i>
                                        <span>@lang('member.orders')</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                </a>
                                <a href="{{route('member.purchases')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{ (request()->is('member/purchases')) ? 'menu-active' : '' }}">
                                    <div>
                                        <i class="far fa-credit-card m-10px-r"></i>
                                        <span>@lang('member.purchases')</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                </a>
								<a href="{{route('member.relationApl')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb align-items-center {{ (request()->is('member/relationApl')) ? 'menu-active' : '' }}">
                                    <div>
                                        <i class="fa fa-link m-10px-r"></i>
                                        <span>@lang('member.menu_relation_apl')</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                </a>
                                <a href="{{route('member.contact', ['role'=>'admin'])}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb align-items-center {{ (request()->is('member/contact/role/admin')) ? 'menu-active' : '' }}">
                                    <div>
                                        <i class="far fa-envelope m-10px-r"></i>
                                        <span>@lang('member.contact_admin')</span>
                                        <span class="unread-count-admin badge badge-pill badge-primary"></span>
                                        {{-- {!! isset(App\Models\Message::unreadCount(Auth::user()->id , 1)->count) ? '<span class="badge badge-pilll badge-primary">'.App\Models\Message::unreadCount(Auth::user()->id, 1)->count.'</span>' : '' !!} --}}
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                </a>
                                <a href="{{route('member.contact', ['role'=>'afa'])}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{ (request()->is('member/contact/role/afa')) ? 'menu-active' : '' }}">
                                    <div>
                                        <i class="far fa-envelope m-10px-r"></i>
                                        <span>@lang('member.contact_afa')</span>
                                        <span class="unread-count-afa badge badge-pill badge-primary"></span>
                                        {{-- {!! isset(App\Models\Message::unreadCount(Auth::user()->id , Auth::user()->afa_id)->count) ? '<span class="badge badge-pilll badge-primary">'.App\Models\Message::unreadCount(Auth::user()->id, Auth::user()->afa_id)->count.'</span>' : '' !!} --}}
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                </a>
                                @if(Auth::user()->hasApl())
                                  <a href="{{route('member.contact', ['role'=>'apl'])}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{ (request()->is('member/contact/role/apl')) ? 'menu-active' : '' }}">
                                      <div>
                                          <i class="far fa-envelope m-10px-r"></i>
                                          <span>@lang('member.contact_apl')</span>
                                      </div>
                                      <div>
                                          <i class="fas fa-chevron-right"></i>
                                      </div>
                                  </a>
                                @endif
								<a href="{{route('member.testimonial')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{ (request()->is('member/testimonial')) ? 'menu-active' : '' }}">
                                    <div>
                                        <i class="fa fa-quote-left m-10px-r"></i>
                                        <span>@lang('member.menu_temoignage')</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                </a>
                            @endif

                            @If(Auth::user()->hasRole(4))
                              <a href="{{route('apl.orders')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{ (request()->is('apl/orders')) ? 'menu-active' : '' }}">
                                  <div>
                                      <i class="fa fa-cart-plus m-10px-r"></i>
                                      <span>@lang('apl.orders')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>
                              <a href="{{route('apl.sales')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{ (request()->is('apl/sales')) ? 'menu-active' : '' }}">
                                  <div>
                                      <i class="fa fa-chart-line m-10px-r"></i>
                                      <span>@lang('apl.sales')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>
                              <a href="{{route('apl.customers')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{ (request()->is('apl/customers')) ? 'menu-active' : '' }}">
                                  <div>
                                      <i class="fa fa-users m-10px-r"></i>
                                      <span>@lang('apl.customers')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>
                              <a href="{{route('apl.commissions', ['filter'=>'not-paid'])}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{ (request()->is('apl/commissions/not-paid')) ? 'menu-active' : '' }}">
                                  <div>
                                      <i class="fa fa-hand-holding-usd m-10px-r"></i>
                                      <span>@lang('app.commissions.not_paid')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>
                              <a href="{{route('apl.commissions', ['filter'=>'paid'])}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{ (request()->is('apl/commissions/paid')) ? 'menu-active' : '' }}">
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
							  <a href="{{route('mes-programmes')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
							  	  <div>
                                      <i class="fa fa-industry m-10px-r"></i>
                                      <span>@lang('afa.programme.menu')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
							  </a>
							  <a href="{{route('mes-produits')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
							  	  <div>
                                      <i class="fa fa-bookmark m-10px-r"></i>
                                      <span>@lang('afa.product.menu')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
							  </a>
                              <a href="{{route('afa.orders')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{ (request()->is('afa/orders')) ? 'menu-active' : '' }}">
                                  <div>
                                      <i class="fa fa-cart-plus m-10px-r"></i>
                                      <span>@lang('afa.orders')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>
                              <a href="{{route('afa.sales')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{ (request()->is('afa/sales')) ? 'menu-active' : '' }}">
                                  <div>
                                      <i class="fa fa-chart-line m-10px-r"></i>
                                      <span>@lang('afa.sales')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>
                              <a href="{{route('afa.commissions', ['filter'=>'paid'])}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{ (request()->is('afa/commissions/paid')) ? 'menu-active' : '' }}">
                                  <div>
                                      <i class="fa fa-money-bill-alt m-10px-r"></i>
                                      <span>@lang('app.commissions.paid')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>
                              <a href="{{route('afa.commissions', ['filter'=>'not-paid'])}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{ (request()->is('afa/commissions/not-paid')) ? 'menu-active' : '' }}">
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
                              <a href="{{route('seller.products')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{ (request()->is('seller/products')) ? 'menu-active' : '' }}">
                                  <div>
                                      <i class="fa fa-paperclip m-10px-r"></i>
                                      <span>@lang('seller.products')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>
                              <a href="{{route('seller.orders')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{ (request()->is('seller/orders')) ? 'menu-active' : '' }}">
                                  <div>
                                      <i class="fa fa-cart-plus m-10px-r"></i>
                                      <span>@lang('seller.orders')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>
                              <a href="{{route('seller.sales')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{ (request()->is('seller/sales')) ? 'menu-active' : '' }}">
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
                              <a href="{{url(\App\Models\User::find(Auth::id())->roleUser->role_initial.'/favorites')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{ (request()->is(\App\Models\User::find(Auth::id())->roleUser->role_initial.'/favorites')) ? 'menu-active' : '' }}">
                                  <div>
                                      <i class="fa fa-heart m-10px-r"></i>
                                      <span>@lang('app.favorites')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>
                              <a href="{{url(\App\Models\User::find(Auth::id())->roleUser->role_initial.'/searches')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{ (request()->is(\App\Models\User::find(Auth::id())->roleUser->role_initial.'/searches')) ? 'menu-active' : '' }}">
                                  <div>
                                      <i class="fa fa-search m-10px-r"></i>
                                      <span>@lang('app.searches')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>

                              @if (Auth::user()->hasRole(2) || Auth::user()->hasRole(3) || Auth::user()->hasRole(4) )
                                @if (Auth::user()->hasRole(2))
                                    @php
                                        $rl = 'seller';
                                    @endphp
                                @elseif(Auth::user()->hasRole(3))
                                    @php
                                        $rl = 'afa';
                                    @endphp
                                @else
                                    @php
                                        $rl = 'apl';
                                    @endphp
                                @endif
                                <a href="{{route('show.message', ['role'=>$rl])}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{ (request()->is(\App\Models\User::find(Auth::id())->roleUser->role_initial.'/mails/inbox')) ? 'menu-active' : '' }}">
                                    <div>
                                        <i class="far fa-comments m-10px-r"></i>
                                        <span>@lang('app.chats')</span>
                                        <span class="unread-count badge badge-pill badge-primary"></span>
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                </a>
                              @endif

                              <a href="{{route(''.\App\Models\User::find(Auth::id())->roleUser->role_initial.'.mail.list',['filter'=>'inbox'])}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{ (request()->is(\App\Models\User::find(Auth::id())->roleUser->role_initial.'/mails/inbox')) ? 'menu-active' : '' }}">
                                  <div>
                                      <i class="far fa-envelope m-10px-r"></i>
                                      <span>@lang('app.mails')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>
                            @endif

                            <a href="{{route('logout')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb ">
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
                @yield('subcontent')
                <!-- end subcontent -->
            </div>
        </div>
    </section>
</main>
<!-- main end -->

<!-- Edit avatar Modal -->
<div class="modal fade" id="editAvatarModal" tabindex="-1" role="dialog" aria-labelledby="editAvatarModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="editAvatarModalTitle">@lang('app.txt.editavatar')</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="form_edit_avatar" class="form-horizontal" role="form" method="post" action="{{route('avatar.edit')}}" 
                enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <fieldset>
                        <div class="col-sm-12 text-center">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-preview thumbnail" style="width: 200px; height: 120px;">
                                    <img src="{{Auth::user()->imageUrl()}}">
                                </div>
                                <div> 
                                    <span class="btn btn-file"> 
                                        <span class="m-btn m-btn-theme fileupload-new"><i class="fa fa-upload"></i> @lang('app.admin.file.select')</span> 
                                        <span class="fileupload-exists" title="@lang('app.admin.file.change')"><i class="fa fa-edit"></i></span>
                                        <input type="file" name="image" id="file">
                                    </span> 
                                    <a href="javascript:void(0)" class="btn fileupload-exists" data-dismiss="fileupload" title="@lang('app.admin.file.remove')"><i class="fa fa-trash-alt"></i></a> 
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary border-radius-0" data-dismiss="modal" id="btn_close_edit_avatar">@lang('app.btn.cancel')</button>
                <button type="submit" class="btn btn-primary border-radius-0" id="btn_save_edit_avatar">@lang('app.btn.save')</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin edit avatar modal -->


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
            <a href="{{route('member.relationApl')}}" class="m-btn m-btn-theme" type="submit">@lang('app.btn.next')</a>
          @else
              <a href="{{route('member.select.apl')}}" class="m-btn m-btn-theme4rd" type="submit">@lang('member.select.apl')</a>
          @endif
      </div>
    </div>
  </div>
</div>
@endif

@endsection

@push('script')
    <link rel="stylesheet" href="{{asset('administrator/plugins/bootstrap-fileupload/css/bootstrap-fileupload.css')}}">
    <script src="{{asset('administrator/plugins/bootstrap-fileupload/js/bootstrap-fileupload.js')}}"></script>
    <script>
        $(document).ready(function(){
            
            // Show unread message count in left sidebar
            showUnreadCount();

            // Update show unread message count
            setInterval(() => {
                showUnreadCount();
            }, 4500);
            

            function showUnreadCount(){
                $.ajax({
                    url: '{{ route("get.unread.message", ["user_id"=>Auth::user()->id]) }}',
                    type: "GET",
                    dataType: "json",

                    success:function(data){

                        if(data.res['role_id'] == 5){
                            var unreadCountAdmin = $('.unread-count-admin');
                            var unreadCountAfa = $('.unread-count-afa');
                            
                            unreadCountAdmin.html(data.res['unreadCountAdmin']);
                            unreadCountAfa.html(data.res['unreadCountAfa']);
                        }else{
                            var unreadCount = $('.unread-count');

                            if(data.res['unreadCount'] !== 0){
                                unreadCount.html(data.res['unreadCount']);
                            }
                            else{
                                unreadCount.html('');
                            }
                        }

                    },
                    error:function(e){
                        console.log(e);
                    }
                });

                return false;
            }

        })
    </script>
@endpush
