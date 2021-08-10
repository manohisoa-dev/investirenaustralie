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

    {{-- Horizontal timeline --}}
    <style>
        .cd-horizontal-timeline ol, .cd-horizontal-timeline ul {
        list-style: none;
        }
        .cd-timeline-navigation a:hover, .cd-timeline-navigation a:focus {
        border-color:#313740;
        
        }
        .cd-horizontal-timeline a, .cd-horizontal-timeline a:hover, .cd-horizontal-timeline a:focus{ color:#313740;}
        .cd-horizontal-timeline blockquote, .cd-horizontal-timeline q {
        quotes: none;
        }
        .cd-horizontal-timeline blockquote:before, .cd-horizontal-timeline blockquote:after,
        .cd-horizontal-timeline q:before, .cd-horizontal-timeline q:after {
        content: '';
        content: none;
        }
        .cd-horizontal-timeline table {
        border-collapse: collapse;
        border-spacing: 0;
        }
        .cd-horizontal-timeline {
        opacity: 0;
        margin: 2em auto;
        -webkit-transition: opacity 0.2s;
        -moz-transition: opacity 0.2s;
        transition: opacity 0.2s;
        }
        .cd-horizontal-timeline::before {
        /* never visible - this is used in jQuery to check the current MQ */
        content: 'mobile';
        display: none;
        }
        .cd-horizontal-timeline.loaded {
        /* show the timeline after events position has been set (using JavaScript) */
        opacity: 1;
        }
        .cd-horizontal-timeline .timeline {
        position: relative;
        height: 100px;
        width: 90%;
        max-width: 800px;
        margin: 0 auto;
        }
        .cd-horizontal-timeline .events-wrapper {
        position: relative;
        height: 100%;
        margin: 0 40px;
        overflow: hidden;
        }
        .cd-horizontal-timeline .events-wrapper::after, .cd-horizontal-timeline .events-wrapper::before {
        /* these are used to create a shadow effect at the sides of the timeline */
        content: '';
        position: absolute;
        z-index: 2;
        top: 0;
        height: 100%;
        width: 20px;
        }
        .cd-horizontal-timeline .events-wrapper::before {
        left: 0;
        
        }
        .cd-horizontal-timeline .events-wrapper::after {
        right: 0;
        
        }
        .cd-horizontal-timeline .events {
        /* this is the grey line/timeline */
        position: absolute;
        z-index: 1;
        left: 0;
        top: 50px;
        height: 2px;
        /* width will be set using JavaScript */
        background: #dfdfdf;
        -webkit-transition: -webkit-transform 0.4s;
        -moz-transition: -moz-transform 0.4s;
        transition: transform 0.4s;
        }
        .cd-horizontal-timeline .filling-line {
        /* this is used to create the green line filling the timeline */
        position: absolute;
        z-index: 1;
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        background-color: #313740;
        -webkit-transform: scaleX(0);
        -moz-transform: scaleX(0);
        -ms-transform: scaleX(0);
        -o-transform: scaleX(0);
        transform: scaleX(0);
        -webkit-transform-origin: left center;
        -moz-transform-origin: left center;
        -ms-transform-origin: left center;
        -o-transform-origin: left center;
        transform-origin: left center;
        -webkit-transition: -webkit-transform 0.3s;
        -moz-transition: -moz-transform 0.3s;
        transition: transform 0.3s;
        }
        .cd-horizontal-timeline .events a {
        position: absolute;
        bottom: 0;
        z-index: 2;
        text-align: center;
        font-size: 1rem;
        padding-bottom: 15px;
        
        /* fix bug on Safari - text flickering while timeline translates */
        -webkit-transform: translateZ(0);
        -moz-transform: translateZ(0);
        -ms-transform: translateZ(0);
        -o-transform: translateZ(0);
        transform: translateZ(0);
        }
        .cd-horizontal-timeline .events a::after {
        /* this is used to create the event spot */
        content: '';
        position: absolute;
        left: 50%;
        right: auto;
        -webkit-transform: translateX(-50%);
        -moz-transform: translateX(-50%);
        -ms-transform: translateX(-50%);
        -o-transform: translateX(-50%);
        transform: translateX(-50%);
        bottom: -5px;
        height: 12px;
        width: 12px;
        border-radius: 50%;
        border: 2px solid #dfdfdf;
        background-color: #f8f8f8;
        -webkit-transition: background-color 0.3s, border-color 0.3s;
        -moz-transition: background-color 0.3s, border-color 0.3s;
        transition: background-color 0.3s, border-color 0.3s;
        }
        .no-touch .cd-horizontal-timeline .events a:hover::after {
        background-color: #313740;
        border-color: #313740;
        }
        .cd-horizontal-timeline .events a.selected {
        pointer-events: none;
        }
        .cd-horizontal-timeline .events a.selected::after {
        background-color: #313740;
        border-color: #313740;
        }
        .cd-horizontal-timeline .events a.older-event::after {
        border-color: #313740;
        }
        @media only screen and (min-width: 1100px) {
        .cd-horizontal-timeline::before {
            /* never visible - this is used in jQuery to check the current MQ */
            content: 'desktop';
        }
        }

        .cd-timeline-navigation a {
        /* these are the left/right arrows to navigate the timeline */
        position: absolute;
        z-index: 1;
        top: 50%;
        bottom: auto;
        -webkit-transform: translateY(-50%);
        -moz-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        -o-transform: translateY(-50%);
        transform: translateY(-50%);
        height: 34px;
        width: 34px;
        border-radius: 50%;
        border: 2px solid #dfdfdf;
        /* replace text with an icon */
        overflow: hidden;
        color: transparent;
        text-indent: 100%;
        white-space: nowrap;
        -webkit-transition: border-color 0.3s;
        -moz-transition: border-color 0.3s;
        transition: border-color 0.3s;
        }
        .cd-timeline-navigation a::after {
        /* arrow icon */
        content: '';
        position: absolute;
        height: 16px;
        width: 16px;
        left: 50%;
        top: 50%;
        bottom: auto;
        right: auto;
        -webkit-transform: translateX(-50%) translateY(-50%);
        -moz-transform: translateX(-50%) translateY(-50%);
        -ms-transform: translateX(-50%) translateY(-50%);
        -o-transform: translateX(-50%) translateY(-50%);
        transform: translateX(-50%) translateY(-50%);
        background: url(../img/cd-arrow.svg) no-repeat 0 0;
        }
        .cd-timeline-navigation a.prev {
        left: 0;
        -webkit-transform: translateY(-50%) rotate(180deg);
        -moz-transform: translateY(-50%) rotate(180deg);
        -ms-transform: translateY(-50%) rotate(180deg);
        -o-transform: translateY(-50%) rotate(180deg);
        transform: translateY(-50%) rotate(180deg);
        }
        .cd-timeline-navigation a.next {
        right: 0;
        }
        .no-touch .cd-timeline-navigation a:hover {
        border-color: #7b9d6f;
        }
        .cd-timeline-navigation a.inactive {
        cursor: not-allowed;
        }
        .cd-timeline-navigation a.inactive::after {
        background-position: 0 -16px;
        }
        .no-touch .cd-timeline-navigation a.inactive:hover {
        border-color: #dfdfdf;
        }

        .cd-horizontal-timeline .events-content {
        position: relative;
        width: 100%;
        margin: 2em 0;
        overflow: hidden;
        -webkit-transition: height 0.4s;
        -moz-transition: height 0.4s;
        transition: height 0.4s;
        }
        .cd-horizontal-timeline .events-content li {
        position: absolute;
        z-index: 1;
        width: 100%;
        left: 0;
        top: 0;
        -webkit-transform: translateX(-100%);
        -moz-transform: translateX(-100%);
        -ms-transform: translateX(-100%);
        -o-transform: translateX(-100%);
        transform: translateX(-100%);
        padding: 0 5%;
        opacity: 0;
        -webkit-animation-duration: 0.4s;
        -moz-animation-duration: 0.4s;
        animation-duration: 0.4s;
        -webkit-animation-timing-function: ease-in-out;
        -moz-animation-timing-function: ease-in-out;
        animation-timing-function: ease-in-out;
        }
        .cd-horizontal-timeline .events-content li.selected {
        /* visible event content */
        position: relative;
        z-index: 2;
        opacity: 1;
        -webkit-transform: translateX(0);
        -moz-transform: translateX(0);
        -ms-transform: translateX(0);
        -o-transform: translateX(0);
        transform: translateX(0);
        }
        .cd-horizontal-timeline .events-content li.enter-right, .cd-horizontal-timeline .events-content li.leave-right {
        -webkit-animation-name: cd-enter-right;
        -moz-animation-name: cd-enter-right;
        animation-name: cd-enter-right;
        }
        .cd-horizontal-timeline .events-content li.enter-left, .cd-horizontal-timeline .events-content li.leave-left {
        -webkit-animation-name: cd-enter-left;
        -moz-animation-name: cd-enter-left;
        animation-name: cd-enter-left;
        }
        .cd-horizontal-timeline .events-content li.leave-right, .cd-horizontal-timeline .events-content li.leave-left {
        -webkit-animation-direction: reverse;
        -moz-animation-direction: reverse;
        animation-direction: reverse;
        }
        .cd-horizontal-timeline .events-content li > * {
        max-width: 800px;
        margin: 0 auto;
        }
        .cd-horizontal-timeline .events-content h4 {
        font-weight: 700;
        margin-bottom: 0px;
        line-height: 20px;
        margin-bottom: 15px;
        }
        .cd-horizontal-timeline .events-content h4 small {
        font-weight: 400;
        line-height: normal;
        font-size: 15px;
        }
        .cd-horizontal-timeline .events-content em {
        display: block;
        font-style: italic;
        margin: 10px auto;
        }
        .cd-horizontal-timeline .events-content em::before {
        content: '- ';
        }
        .cd-horizontal-timeline .events-content p {
        font-size: 16px;
        margin-top: 15px;
        
        }

        @media only screen and (min-width: 768px) {
        
        .cd-horizontal-timeline .events-content em {
            font-size: 1rem;
        }  
        }

        @media only screen and (max-width: 767px) {

        .cd-horizontal-timeline.loaded{ margin: 0;}  
        .cd-horizontal-timeline .timeline{ width: 100%;}
        .cd-horizontal-timeline ol, .cd-horizontal-timeline ul{padding: 0;margin: 0;}
        .cd-horizontal-timeline .events-content h4{ font-size: 16px;}
        .cd-horizontal-timeline .events-content{ margin: 0;}
        
        }

        @-webkit-keyframes cd-enter-right {
        0% {
            opacity: 0;
            -webkit-transform: translateX(100%);
        }
        100% {
            opacity: 1;
            -webkit-transform: translateX(0%);
        }
        }
        @-moz-keyframes cd-enter-right {
        0% {
            opacity: 0;
            -moz-transform: translateX(100%);
        }
        100% {
            opacity: 1;
            -moz-transform: translateX(0%);
        }
        }
        @keyframes cd-enter-right {
        0% {
            opacity: 0;
            -webkit-transform: translateX(100%);
            -moz-transform: translateX(100%);
            -ms-transform: translateX(100%);
            -o-transform: translateX(100%);
            transform: translateX(100%);
        }
        100% {
            opacity: 1;
            -webkit-transform: translateX(0%);
            -moz-transform: translateX(0%);
            -ms-transform: translateX(0%);
            -o-transform: translateX(0%);
            transform: translateX(0%);
        }
        }
        @-webkit-keyframes cd-enter-left {
        0% {
            opacity: 0;
            -webkit-transform: translateX(-100%);
        }
        100% {
            opacity: 1;
            -webkit-transform: translateX(0%);
        }
        }
        @-moz-keyframes cd-enter-left {
        0% {
            opacity: 0;
            -moz-transform: translateX(-100%);
        }
        100% {
            opacity: 1;
            -moz-transform: translateX(0%);
        }
        }
        @keyframes cd-enter-left {
        0% {
            opacity: 0;
            -webkit-transform: translateX(-100%);
            -moz-transform: translateX(-100%);
            -ms-transform: translateX(-100%);
            -o-transform: translateX(-100%);
            transform: translateX(-100%);
        }
        100% {
            opacity: 1;
            -webkit-transform: translateX(0%);
            -moz-transform: translateX(0%);
            -ms-transform: translateX(0%);
            -o-transform: translateX(0%);
            transform: translateX(0%);
        }
        }
        .timeline:before{
        content: " ";
            display:none;
            bottom: 0;
            left: 0%;
            width: 0px;
            margin-left: -1.5px;
            background-color: #eeeeee;
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
                                <a href="{{route('member.dossier')}}" class="{{ Auth::user()->hasCurrentTransaction()?'theme2nd-bg-alt':'' }} list-group-item list-group-item-action d-flex justify-content-between p15px-tb align-items-center {{ (request()->is('member/dossier')) ? 'menu-active' : '' }}">
                                    <div>
                                        <i class="fa fa-folder m-10px-r"></i>
                                        @if(Auth::user()->hasCurrentTransaction())
                                            <b>
                                        @endif
                                            <span class="{{ Auth::user()->hasCurrentTransaction()?'theme2nd-color':'' }}">@lang('app.txt.file')</span>
                                        @if(Auth::user()->hasCurrentTransaction())
                                            </b>
                                        @endif
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
                                @if(Auth::user()->hasAfa())
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
                                @endif
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
							  <a href="#properties" data-toggle="collapse" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{Request::is('mes-programmes') || Request::is('nouveau-programmes') || Request::is('mes-produits') || Request::is('nouveau-produit') ? 'menu-active' : ''}}">
									<div>
										<i class="fa fa-industry m-10px-r"></i>
										<span>Properties</span>
									</div>
									<div>
										<i class="fas fa-chevron-right"></i>
									</div>
								</a>								
								<ul id="properties" class="collapse {{Request::is('mes-programmes') || Request::is('nouveau-programmes') || Request::is('mes-produits') || Request::is('nouveau-produit') ? 'show' : ''}}" style="list-style:none">
									<li>
										<a href="{{route('mes-programmes')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{Request::is('mes-programmes') ? 'menu-active' : ''}}">
											@lang('afa.programme.menu')
										</a>
									</li>
									<li>
										<a href="{{route('nouveau-programmes')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{Request::is('nouveau-programmes') ? 'menu-active' : ''}}">
											@lang('app.admin.program.add')
										</a>
									</li>
									<li>
										<a href="{{route('mes-produits')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{Request::is('mes-produits') ? 'menu-active' : ''}}">
											@lang('app.admin.product.list')
										</a>
									</li>
									<li>
										<a href="{{route('nouveau-produit')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{Request::is('nouveau-produit') ? 'menu-active' : ''}}">
											@lang('app.admin.product.add')
										</a>
									</li>
								</ul> 
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
								<a href="#properties" data-toggle="collapse" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{Request::is('mes-programmes') || Request::is('nouveau-programmes') || Request::is('mes-produits') || Request::is('nouveau-produit') ? 'menu-active' : ''}}">
									<div>
										<i class="fa fa-industry m-10px-r"></i>
										<span>Properties</span>
									</div>
									<div>
										<i class="fas fa-chevron-right"></i>
									</div>
								</a>								
								<ul id="properties" class="collapse {{Request::is('mes-programmes') || Request::is('nouveau-programmes') || Request::is('mes-produits') || Request::is('nouveau-produit') ? 'show' : ''}}" style="list-style:none">
									<li>
										<a href="{{route('mes-programmes')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{Request::is('mes-programmes') ? 'menu-active' : ''}}">
											@lang('afa.programme.menu')
										</a>
									</li>
									<li>
										<a href="{{route('nouveau-programmes')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{Request::is('nouveau-programmes') ? 'menu-active' : ''}}">
											@lang('app.admin.program.add')
										</a>
									</li>
									<li>
										<a href="{{route('mes-produits')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{Request::is('mes-produits') ? 'menu-active' : ''}}">
											@lang('app.admin.product.list')
										</a>
									</li>
									<li>
										<a href="{{route('nouveau-produit')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{Request::is('nouveau-produit') ? 'menu-active' : ''}}">
											@lang('app.admin.product.add')
										</a>
									</li>
								</ul> 
                              {{--<a href="{{route('seller.products')}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{ (request()->is('seller/products')) ? 'menu-active' : '' }}">
                                  <div>
                                      <i class="fa fa-paperclip m-10px-r"></i>
                                      <span>@lang('seller.products')</span>
                                  </div>
                                  <div>
                                      <i class="fas fa-chevron-right"></i>
                                  </div>
                              </a>--}}
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

                              {{-- @if (Auth::user()->hasRole(2) || Auth::user()->hasRole(3) || Auth::user()->hasRole(4) ) --}}
                              @if (Auth::user()->hasRole(3) || Auth::user()->hasRole(4) )
                                @if(Auth::user()->hasRole(3))
                                    @php
                                        $rl = 'afa';
                                    @endphp
                                @else
                                    @php
                                        $rl = 'apl';
                                    @endphp
                                @endif
                                <a href="{{route($rl.'.show.message', ['role'=>$rl])}}" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb {{ (request()->is(\App\Models\User::find(Auth::id())->roleUser->role_initial.'/message/*')) ? 'menu-active' : '' }}">
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

                <div class="col-lg-8 col-xl-9">
                    <div class="row">
                        {{-- Timeline horizontale --}}
                        {{-- <div class="col-lg-12">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="body">
                                                <div class="cd-horizontal-timeline loaded">
                                                    <div class="timeline">
                                                        <div class="events-wrapper">
                                                            <div class="events" style="width: 1800px;">
                                                                <ol>
                                                                    <li><a href="#0" data-date="16/01/2017" style="left: 300px;" class="older-event">Etape 1</a></li>
                                                                    <li><a href="#0" data-date="28/02/2017" style="left: 400px;" class="selected">Etape 2</a></li>
                                                                    <li><a href="#0" data-date="20/04/2017" style="left: 500px;">Etape 3</a></li>
                                                                    <li><a href="#0" data-date="20/05/2017" style="left: 600px;">Etape 4</a></li>
                                                                    <li><a href="#0" data-date="09/07/2017" style="left: 700px;">Etape 5</a></li>
                                                                    <li><a href="#0" data-date="30/08/2017" style="left: 800px;">Etape 6</a></li>
                                                                    <li><a href="#0" data-date="15/09/2017" style="left: 900px;">Etape 7</a></li>
                                                                    <li><a href="#0" data-date="01/11/2017" style="left: 1000px;">Etape 8</a></li>
                                                                    <li><a href="#0" data-date="10/12/2017" style="left: 1100px;">Etape 9</a></li>
                                                                    <li><a href="#0" data-date="19/01/2018" style="left: 1200px;">Etape 10</a></li>
                                                                    <li><a href="#0" data-date="03/03/2018" style="left: 1300px;">Etape 11</a></li>
                                                                </ol>
                                                                <span class="filling-line" aria-hidden="true" style="transform: scaleX(0.281506);"></span>
                                                            </div>
                                                            <!-- .events -->
                                                        </div>
                                                        <!-- .events-wrapper -->
                                                        <ul class="cd-timeline-navigation">
                                                            <li><a href="#0" class="prev inactive">Prev</a></li>
                                                            <li><a href="#0" class="next">Next</a></li>
                                                        </ul>
                                                        <!-- .cd-timeline-navigation -->
                                                    </div>
                                                    <!-- .timeline -->
                                                    <div class="events-content" style="height: 72px;">
                                                        <ol>
                                                            <li data-date="16/01/2017">
                                                                <h4>Titre etape 1</h4>
                                                                <em>Description etape 1</em>
                                                            </li>
                                                            <li data-date="28/02/2017" class="selected">
                                                                <h4>Titre etape 2</h4>
                                                                <em>Description etape 2</em>
                                                            </li>
                                                            <li data-date="20/04/2017">
                                                                <h4>Titre etape 3</h4>
                                                                <em>Description etape 3</em>
                                                            </li>
                                                        </ol>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-lg-12 col-xl-12">
                            @yield('subcontent')
                        </div>
                    </div>
                </div>
                
                <!-- subcontent -->
                {{-- @yield('subcontent') --}}
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

    {{-- Script Horizontal timeline --}}
    <script>
        jQuery(document).ready(function($){
            var timelines = $('.cd-horizontal-timeline'),
                eventsMinDistance = 60;

            (timelines.length > 0) && initTimeline(timelines);

            function initTimeline(timelines) {
                timelines.each(function(){
                    var timeline = $(this),
                        timelineComponents = {};
                    //cache timeline components 
                    timelineComponents['timelineWrapper'] = timeline.find('.events-wrapper');
                    timelineComponents['eventsWrapper'] = timelineComponents['timelineWrapper'].children('.events');
                    timelineComponents['fillingLine'] = timelineComponents['eventsWrapper'].children('.filling-line');
                    timelineComponents['timelineEvents'] = timelineComponents['eventsWrapper'].find('a');
                    timelineComponents['timelineDates'] = parseDate(timelineComponents['timelineEvents']);
                    timelineComponents['eventsMinLapse'] = minLapse(timelineComponents['timelineDates']);
                    timelineComponents['timelineNavigation'] = timeline.find('.cd-timeline-navigation');
                    timelineComponents['eventsContent'] = timeline.children('.events-content');

                    //assign a left postion to the single events along the timeline
                    setDatePosition(timelineComponents, eventsMinDistance);
                    //assign a width to the timeline
                    var timelineTotWidth = setTimelineWidth(timelineComponents, eventsMinDistance);
                    //the timeline has been initialize - show it
                    timeline.addClass('loaded');

                    //detect click on the next arrow
                    timelineComponents['timelineNavigation'].on('click', '.next', function(event){
                        event.preventDefault();
                        updateSlide(timelineComponents, timelineTotWidth, 'next');
                    });
                    //detect click on the prev arrow
                    timelineComponents['timelineNavigation'].on('click', '.prev', function(event){
                        event.preventDefault();
                        updateSlide(timelineComponents, timelineTotWidth, 'prev');
                    });
                    //detect click on the a single event - show new event content
                    timelineComponents['eventsWrapper'].on('click', 'a', function(event){
                        event.preventDefault();
                        timelineComponents['timelineEvents'].removeClass('selected');
                        $(this).addClass('selected');
                        updateOlderEvents($(this));
                        updateFilling($(this), timelineComponents['fillingLine'], timelineTotWidth);
                        updateVisibleContent($(this), timelineComponents['eventsContent']);
                    });

                    //on swipe, show next/prev event content
                    timelineComponents['eventsContent'].on('swipeleft', function(){
                        var mq = checkMQ();
                        ( mq == 'mobile' ) && showNewContent(timelineComponents, timelineTotWidth, 'next');
                    });
                    timelineComponents['eventsContent'].on('swiperight', function(){
                        var mq = checkMQ();
                        ( mq == 'mobile' ) && showNewContent(timelineComponents, timelineTotWidth, 'prev');
                    });

                    //keyboard navigation
                    $(document).keyup(function(event){
                        if(event.which=='37' && elementInViewport(timeline.get(0)) ) {
                            showNewContent(timelineComponents, timelineTotWidth, 'prev');
                        } else if( event.which=='39' && elementInViewport(timeline.get(0))) {
                            showNewContent(timelineComponents, timelineTotWidth, 'next');
                        }
                    });
                });
            }

            function updateSlide(timelineComponents, timelineTotWidth, string) {
                //retrieve translateX value of timelineComponents['eventsWrapper']
                var translateValue = getTranslateValue(timelineComponents['eventsWrapper']),
                    wrapperWidth = Number(timelineComponents['timelineWrapper'].css('width').replace('px', ''));
                //translate the timeline to the left('next')/right('prev') 
                (string == 'next') 
                    ? translateTimeline(timelineComponents, translateValue - wrapperWidth + eventsMinDistance, wrapperWidth - timelineTotWidth)
                    : translateTimeline(timelineComponents, translateValue + wrapperWidth - eventsMinDistance);
            }

            function showNewContent(timelineComponents, timelineTotWidth, string) {
                //go from one event to the next/previous one
                var visibleContent =  timelineComponents['eventsContent'].find('.selected'),
                    newContent = ( string == 'next' ) ? visibleContent.next() : visibleContent.prev();

                if ( newContent.length > 0 ) { //if there's a next/prev event - show it
                    var selectedDate = timelineComponents['eventsWrapper'].find('.selected'),
                        newEvent = ( string == 'next' ) ? selectedDate.parent('li').next('li').children('a') : selectedDate.parent('li').prev('li').children('a');
                    
                    updateFilling(newEvent, timelineComponents['fillingLine'], timelineTotWidth);
                    updateVisibleContent(newEvent, timelineComponents['eventsContent']);
                    newEvent.addClass('selected');
                    selectedDate.removeClass('selected');
                    updateOlderEvents(newEvent);
                    updateTimelinePosition(string, newEvent, timelineComponents);
                }
            }

            function updateTimelinePosition(string, event, timelineComponents) {
                //translate timeline to the left/right according to the position of the selected event
                var eventStyle = window.getComputedStyle(event.get(0), null),
                    eventLeft = Number(eventStyle.getPropertyValue("left").replace('px', '')),
                    timelineWidth = Number(timelineComponents['timelineWrapper'].css('width').replace('px', '')),
                    timelineTotWidth = Number(timelineComponents['eventsWrapper'].css('width').replace('px', ''));
                var timelineTranslate = getTranslateValue(timelineComponents['eventsWrapper']);

                if( (string == 'next' && eventLeft > timelineWidth - timelineTranslate) || (string == 'prev' && eventLeft < - timelineTranslate) ) {
                    translateTimeline(timelineComponents, - eventLeft + timelineWidth/2, timelineWidth - timelineTotWidth);
                }
            }

            function translateTimeline(timelineComponents, value, totWidth) {
                var eventsWrapper = timelineComponents['eventsWrapper'].get(0);
                value = (value > 0) ? 0 : value; //only negative translate value
                value = ( !(typeof totWidth === 'undefined') &&  value < totWidth ) ? totWidth : value; //do not translate more than timeline width
                setTransformValue(eventsWrapper, 'translateX', value+'px');
                //update navigation arrows visibility
                (value == 0 ) ? timelineComponents['timelineNavigation'].find('.prev').addClass('inactive') : timelineComponents['timelineNavigation'].find('.prev').removeClass('inactive');
                (value == totWidth ) ? timelineComponents['timelineNavigation'].find('.next').addClass('inactive') : timelineComponents['timelineNavigation'].find('.next').removeClass('inactive');
            }

            function updateFilling(selectedEvent, filling, totWidth) {
                //change .filling-line length according to the selected event
                var eventStyle = window.getComputedStyle(selectedEvent.get(0), null),
                    eventLeft = eventStyle.getPropertyValue("left"),
                    eventWidth = eventStyle.getPropertyValue("width");
                eventLeft = Number(eventLeft.replace('px', '')) + Number(eventWidth.replace('px', ''))/2;
                var scaleValue = eventLeft/totWidth;
                setTransformValue(filling.get(0), 'scaleX', scaleValue);
            }

            function setDatePosition(timelineComponents, min) {
                for (i = 0; i < timelineComponents['timelineDates'].length; i++) { 
                    var distance = daydiff(timelineComponents['timelineDates'][0], timelineComponents['timelineDates'][i]),
                        distanceNorm = Math.round(distance/timelineComponents['eventsMinLapse']) + 2;
                    timelineComponents['timelineEvents'].eq(i).css('left', distanceNorm*min+'px');
                }
            }

            function setTimelineWidth(timelineComponents, width) {
                var timeSpan = daydiff(timelineComponents['timelineDates'][0], timelineComponents['timelineDates'][timelineComponents['timelineDates'].length-1]),
                    timeSpanNorm = timeSpan/timelineComponents['eventsMinLapse'],
                    timeSpanNorm = Math.round(timeSpanNorm) + 4,
                    totalWidth = timeSpanNorm*width;
                timelineComponents['eventsWrapper'].css('width', totalWidth+'px');
                updateFilling(timelineComponents['eventsWrapper'].find('a.selected'), timelineComponents['fillingLine'], totalWidth);
                updateTimelinePosition('next', timelineComponents['eventsWrapper'].find('a.selected'), timelineComponents);
            
                return totalWidth;
            }

            function updateVisibleContent(event, eventsContent) {
                var eventDate = event.data('date'),
                    visibleContent = eventsContent.find('.selected'),
                    selectedContent = eventsContent.find('[data-date="'+ eventDate +'"]'),
                    selectedContentHeight = selectedContent.height();

                if (selectedContent.index() > visibleContent.index()) {
                    var classEnetering = 'selected enter-right',
                        classLeaving = 'leave-left';
                } else {
                    var classEnetering = 'selected enter-left',
                        classLeaving = 'leave-right';
                }

                selectedContent.attr('class', classEnetering);
                visibleContent.attr('class', classLeaving).one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(){
                    visibleContent.removeClass('leave-right leave-left');
                    selectedContent.removeClass('enter-left enter-right');
                });
                eventsContent.css('height', selectedContentHeight+'px');
            }

            function updateOlderEvents(event) {
                event.parent('li').prevAll('li').children('a').addClass('older-event').end().end().nextAll('li').children('a').removeClass('older-event');
            }

            function getTranslateValue(timeline) {
                var timelineStyle = window.getComputedStyle(timeline.get(0), null),
                    timelineTranslate = timelineStyle.getPropertyValue("-webkit-transform") ||
                        timelineStyle.getPropertyValue("-moz-transform") ||
                        timelineStyle.getPropertyValue("-ms-transform") ||
                        timelineStyle.getPropertyValue("-o-transform") ||
                        timelineStyle.getPropertyValue("transform");

                if( timelineTranslate.indexOf('(') >=0 ) {
                    var timelineTranslate = timelineTranslate.split('(')[1];
                    timelineTranslate = timelineTranslate.split(')')[0];
                    timelineTranslate = timelineTranslate.split(',');
                    var translateValue = timelineTranslate[4];
                } else {
                    var translateValue = 0;
                }

                return Number(translateValue);
            }

            function setTransformValue(element, property, value) {
                element.style["-webkit-transform"] = property+"("+value+")";
                element.style["-moz-transform"] = property+"("+value+")";
                element.style["-ms-transform"] = property+"("+value+")";
                element.style["-o-transform"] = property+"("+value+")";
                element.style["transform"] = property+"("+value+")";
            }

            //based on http://stackoverflow.com/questions/542938/how-do-i-get-the-number-of-days-between-two-dates-in-javascript
            function parseDate(events) {
                var dateArrays = [];
                events.each(function(){
                    var singleDate = $(this),
                        dateComp = singleDate.data('date').split('T');
                    if( dateComp.length > 1 ) { //both DD/MM/YEAR and time are provided
                        var dayComp = dateComp[0].split('/'),
                            timeComp = dateComp[1].split(':');
                    } else if( dateComp[0].indexOf(':') >=0 ) { //only time is provide
                        var dayComp = ["2000", "0", "0"],
                            timeComp = dateComp[0].split(':');
                    } else { //only DD/MM/YEAR
                        var dayComp = dateComp[0].split('/'),
                            timeComp = ["0", "0"];
                    }
                    var	newDate = new Date(dayComp[2], dayComp[1]-1, dayComp[0], timeComp[0], timeComp[1]);
                    dateArrays.push(newDate);
                });
                return dateArrays;
            }

            function daydiff(first, second) {
                return Math.round((second-first));
            }

            function minLapse(dates) {
                //determine the minimum distance among events
                var dateDistances = [];
                for (i = 1; i < dates.length; i++) { 
                    var distance = daydiff(dates[i-1], dates[i]);
                    dateDistances.push(distance);
                }
                return Math.min.apply(null, dateDistances);
            }

            /*
                How to tell if a DOM element is visible in the current viewport?
                http://stackoverflow.com/questions/123999/how-to-tell-if-a-dom-element-is-visible-in-the-current-viewport
            */
            function elementInViewport(el) {
                var top = el.offsetTop;
                var left = el.offsetLeft;
                var width = el.offsetWidth;
                var height = el.offsetHeight;

                while(el.offsetParent) {
                    el = el.offsetParent;
                    top += el.offsetTop;
                    left += el.offsetLeft;
                }

                return (
                    top < (window.pageYOffset + window.innerHeight) &&
                    left < (window.pageXOffset + window.innerWidth) &&
                    (top + height) > window.pageYOffset &&
                    (left + width) > window.pageXOffset
                );
            }

            function checkMQ() {
                //check if mobile or desktop device
                return window.getComputedStyle(document.querySelector('.cd-horizontal-timeline'), '::before').getPropertyValue('content').replace(/'/g, "").replace(/"/g, "");
            }
        });
    </script>
@endpush
