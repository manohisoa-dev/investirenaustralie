@extends('layouts.app')

@section('content')
<!-- Main -->
<main>
    <!-- Page Title -->
    @component('includes.breadcrumb')
        @lang('service')
    @endcomponent
    <!-- Section -->
    <section class="section gray-bg">
        <div class="container">
            <div class="row md-m-25px-b m-45px-b justify-content-center text-center">
                <div class="col-lg-8">
                    <h3 class="h1 m-20px-b p-20px-b theme-after after-50px">@lang('app.txt.service_iea')</h3>
                    <p class="m-0px font-2">@lang('app.txt.service_def')</p>
                </div>
            </div>
            <div class="row">  
                @if(!empty($item->content))
                    <div class="nav p-25px-b">
                        <span class="h2 dark-color font-w-600">{{ $item->title }}</span>
                    </div>
                
                    {!! $item->content !!}

                    @if(Auth::check()&&Auth::user()->isAdmin())
                        <a href="{{route('admin.page.update',$item)}}" class="more pull-right"><i class="fa fa-edit"></i></a> 
                    @endif
                @endif
                @forelse ($item->childs as $child)
                    @if($child->is_pub ==0)
                        <div class="col-md-6 m-15px-tb">
                            <div class="media p-40px-tb p-20px-lr box-shadow hover-top white-bg border-radius-5">
                                <div class="icon-80 gray-bg dots-icon border-radius-50 theme-color d-inline-block m-15px-b">
                                    <i class="icon-desktop"></i>
                                    <span class="dots"><i class="dot dot1"></i><i class="dot dot2"></i><i class="dot dot3"></i></span>
                                </div>
                                <div class="media-body p-20px-l">
                                    <h6>{{$child->title}}</h6>
                                    {{-- <p class="p-35px-t">{!! Auth::check() ? $child->content.'<div class="border-bottom-2 border-coler-gray p-10px-b prestataire"><b>Prestataires</b> : <span class="theme4rd-bg p-5px-tb p-10px-lr border-radius-15 white-color small">APL-1</span> <span class="theme4rd-bg p-5px-tb p-10px-lr border-radius-15 white-color small">APL-2</span></div><div class="float-right border-color-gray"><i class="far fa-envelope"></i> <a href="javascript.void(0)" data-toggle="modal" data-target="#formContactModal">'.trans('app.btn.contact').'</a></div>' : '<a data-toggle="modal" data-target="#loginFormModal" href="javascript:void(0)" class="more pull-right">'.trans("app.btn.view_more").'</a>' !!}</p> --}}
                                    {{-- <p class="p-35px-t">{!! Auth::check() ? $child->content.'<div class="border-top-2 border-coler-gray m-35px-t p-10px-tb prestataire"><b>Prestataires</b> : <span class="theme4rd-bg p-5px-tb p-10px-lr border-radius-15 white-color small"><a class="white-color" href="javascript.void(0)" data-toggle="modal" data-target="#contactFormModal" title="Contacter APL-1">APL-1</a></span> <span class="theme4rd-bg p-5px-tb p-10px-lr border-radius-15 white-color small"><a class="white-color" href="javascript.void(0)" data-toggle="modal" data-target="#contactFormModal" title="Contacter APL-2">APL-2</a></span></div>' : '<a data-toggle="modal" data-target="#loginFormModal" href="javascript:void(0)" class="more pull-right">'.trans("app.btn.view_more").'</a>' !!}</p> --}}
                                    <p class="p-35px-t text-justify">{!! Auth::check() ? $child->content : '<a data-toggle="modal" data-target="#loginFormModal" href="javascript:void(0)" class="more pull-right">'.trans("app.btn.view_more").'</a>' !!}</p>
                                    
                                    @if (Auth::check() && $child->page_order==8)
                                        <div class="border-top-2 border-coler-gray m-35px-t p-10px-tb prestataire">
                                            <b>Prestataires</b> : 
                                            @forelse ($apls as $apls_item)
                                                <span class="theme4rd-bg m-5px-r p-5px-tb p-10px-lr border-radius-15 white-color small">
                                                    <a class="white-color" href="javascript.void(0)" data-toggle="modal" data-target="#contactFormModal" title="Contacter APL-1">{{ $apls_item->name }}</a>
                                                </span>
                                                @if($loop->last) 
                                                    <span class="theme4rd-bg m-5px-r p-5px-tb p-10px-lr border-radius-15 white-color small">
                                                        <a class="white-color" href="{{route('apls')}}" title="@lang('app.txt.show.all')"><i class="fa fa-plus"></i></a> 
                                                    </span>
                                                @endif
                                            @empty
                                                @lang('app.txt.noinfo')
                                            @endforelse
                                        </div>
                                    @endif
                                    
                                    @if(Auth::check()&&Auth::user()->isAdmin())
                                        <a href="{{route('admin.page.update',$child)}}" class="more pull-right" title="@lang('app.txt.edit')"><i class="fa fa-edit"></i></a> 
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
            
                    {{-- @foreach($child->pubs as $pub)
                    <div class="nav p-25px-b">
                        <span class="h2 dark-color font-w-600">{{$pub->title}}</span>
                    </div>
                
                    <div class="content-box-large box-with-header">
                        <a target="_blank" href="{{$pub->links?$pub->links:'#'}}"><img src="{{$pub->imageUrl()}}" class="img-rounded" alt="Cinque Terre" width="604" height="236"></a>
                    </div>

                    @endforeach --}}
                @empty
                    <p class="font-2 m-40px-b">@lang('app.txt.noinfo')</p>
                @endforelse
            </div>
        </div>
    </section>
    <!-- End Section -->

    <!-- Section catégorie -->
    <section class="section theme-bg">
        <div class="container">
            <div class="row md-m-25px-b m-45px-b justify-content-center text-center">
                <div class="col-lg-8">
                    <h3 class="h1 white-color m-20px-b p-20px-b white-after after-50px">@lang('app.recent.category')</h3>
                </div>
            </div>
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-lg-3 col-sm-6 m-15px-tb">
                        <div class="p-20px p-50px-r border-all-1 border-color-white arrow-hover">
                            <a class="overlay-link" href="{{route('shop.index',$category)}}"></a>
                            <div class="arrow-icon white-color"></div>
                            <h5 class="font-1 font-w-600 white-color m-0px"><span class="theme2nd-bg p-5px-tb p-10px-lr border-radius-15 white-color small">{{$category->products_count}}</span> <span> {{ trans('app.txt.'.$category->title) }} </span></h5>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Section -->

    <!-- Section produit-->
    <section class="section white-bg overflow-hidden">
        <div class="container">
            <div class="row md-m-25px-b m-45px-b justify-content-center text-center">
                <div class="col-lg-8">
                    <h3 class="h1 m-10px-b p-20px-b theme-after after-50px">@lang('app.dernierprod')</h3>
                </div>
            </div>

            <div class="owl-carousel owl-no-overflow" data-items="3" data-nav-dots="true" data-md-items="2" data-sm-items="2" data-xs-items="1" data-xx-items="1" data-space="30" data-center="true" data-stage="50">
                @foreach($products as $product)
                    @include('product.single', ['item'=>$product, 'page_id'=>$item->id])
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Section -->
</main>

<!-- Modal login form -->
<div id="loginFormModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title">@lang('app.login')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form action="{{route('login')}}" method="post">
                    {{ csrf_field() }}
                    {{ Session()->put('login_service','login_service') }}

                    <div class="form-group">
                        <label class="form-control-label">@lang('app.txt.email')</label>
                        <input type="email" name="email" class="form-control" placeholder="@lang('app.txt.your.email') *" required="required" value="{{ old('email') }}" autofocus>
                        <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">@lang('app.txt.password')</label>
                        <input name="password"  type="password" placeholder="@lang('app.txt.your.password') *" class="form-control" required="required">
                        <span class="text-danger">{{ $errors->has('password') ? $errors->first('password') : '' }}</span>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('app.form.login.remember')
                    </div>
                    <div class="p-10px-t">
                        <button type="submit" class="m-btn m-btn-theme w-100">@lang('app.btn.login')</button>
                    </div>
                    <div class="m-20px-t text-center">
                        <a href="{{ route('password.request')}}" class="small font-weight-bold">@lang('app.form.login.forgot')</a> 
                        <div class="dropdown pull-right">
                        <a href="#" class="small font-weight-bold dropdown-toggle" type="button" data-toggle="dropdown">
                            @lang('app.form.login.not_registered')</a>
                            <ul class="dropdown-menu form-control-label">
                                <li><a href="{{route('register', ['member'])}}">@lang('app.member')</a></li>
                                <li><a href="{{route('register', ['seller'])}}">@lang('app.seller')</a></li>
                                <li><a href="{{route('register', ['afa'])}}">@lang('app.afa')</a></li>
                                <li><a href="{{route('register', ['apl'])}}">@lang('app.apl')</a></li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal contact form -->
<div id="contactFormModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title">@lang('app.contact_prestataire')</h4>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> --}}
            </div>
            <div class="modal-body">
                <form action="{{route('member.contact', ['role'=>'apl'])}}" method="post" id="contactForm">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="form-control-label">@lang('app.txt.prestataire') : <span class="theme4rd-bg p-5px-tb p-10px-lr border-radius-15 white-color small" id="name_prest"></span></label>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">@lang('app.txt.your.subject')</label>
                        <input name="subject"  type="text" class="form-control" id="subject" placeholder="@lang('app.txt.your.subject') *" required>
                        <span class="text-danger">{{ $errors->has('subject') ? $errors->first('subject') : '' }}</span>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">@lang('app.txt.your.email')</label>
                        <input type="email" name="email" class="form-control" placeholder="@lang('app.txt.your.email') *" required="required" value="{{ old('email') }}" autofocus>
                        <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">@lang('app.txt.your.message')</label>
                        <textarea name="message" id="message" cols="30" rows="5" class="form-control" required="required"></textarea>
                        <span class="text-danger">{{ $errors->has('message') ? $errors->first('message') : '' }}</span>
                    </div>
                    <div class="p-10px-t row col-lg-10">
                        <div class="col-lg-4">
                            <button type="reset" class="m-btn m-btn-theme" id="btn_cancel">@lang('app.btn.cancel')</button>
                        </div>
                        <div class="col-lg-4">
                            <button type="submit" class="m-btn m-btn-theme2nd">@lang('app.btn.send')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
<script type="text/javascript">
    $('.prestataire').on('click','span a',function(){
        var prest = $(this).text();
        $('#name_prest').html(prest);
    });

    $('#btn_cancel').click(function(){
        $('#contactFormModal').modal('hide');
    });
</script>
@endpush

@endsection
