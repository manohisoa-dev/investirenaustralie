@extends('layouts.app')

@section('style')
<style type="text/css">
    .ajax-load{
        background: #e1e1e1;
        padding: 10px 0px;
        width: 100%;
    }
</style>
@endsection

@section('content')
@component('includes.breadcrumb')
    @lang('app.contact')
@endcomponent

<!-- Section -->
<section class="section gray-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 m-15px-tb">
                <div class="white-bg box-shadow p-30px">
                    <div class="p-20px-b">
                        <h5 class="m-0px">@lang('app.txt.contact_us')</h5>
                    </div>
                    <form class="rd-mailform" data-form-output="form-output-global" data-form-type="contact" method="post" action="{{route('contact')}}" id="commentform">

                        {{ csrf_field() }}
                         
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">@lang('app.txt.email')</label>
                                    <input id="email" type="email" name="email" placeholder="@lang('app.txt.your.email') *" required="required" data-constraints="@Required" class="form-control">
                                    <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">@lang('app.txt.nom')</label>
                                    <input id="name" type="text" name="name" placeholder="@lang('app.txt.your.name') *" data-constraints="@Required" class="form-control" required="required">
                                    <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">@lang('app.subject')</label>
                                    <input id="subject" type="text" name="subject" placeholder="@lang('app.txt.your.subject') *" data-constraints="@Required" class="form-control" required="required">
                                    <span class="text-danger">{{ $errors->has('subject') ? $errors->first('subject') : '' }}</span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">@lang('app.message')</label>
                                    <textarea class="form-control" id="content" name="content" rows="3" placeholder="@lang('app.txt.your.message') *" data-constraints="@Required" required="required"></textarea>
                                    <span class="text-danger">{{ $errors->has('content') ? $errors->first('content') : '' }}</span>
                                </div>
                            </div>
                            <div class="col-md-12 p-10px-t">
                                <button class="m-btn m-btn-theme border-radius-0 w-100" type="submit" name="send">@lang('app.btn.send')</button>
                                <div class="snackbars" id="form-output-global"></div>
                            </div>
                            <div id="error-container"></div>
                            <div id="message-container"></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 m-15px-tb">
                <div class="border-all-10 border-color-white p-40px-tb p-20px-lr theme-bg box-shadow h-100">
                    <h5 class="font-1 white-color m-10px-b">@lang('app.form.login.address')</h5>
                    <p class="white-color-light m-30px-b">
                        {!! App\Models\Config::site()->get_meta('admin_address') ? App\Models\Config::site()->get_meta('admin_address')->value: trans('app.txt.noinfo') !!}
                    </p>
                    <h5 class="font-1 white-color m-10px-b">@lang('app.form.login.contact')</h5>
                    {{-- @if(empty($contact)) --}}
                        <p class="m-0px links-white">@lang('app.txt.phone') : <a href="tel:{{ App\Models\Config::site()->get_meta('admin_phone')?App\Models\Config::site()->get_meta('admin_phone')->value:'#' }}">{{ App\Models\Config::site()->get_meta('admin_phone')?App\Models\Config::site()->get_meta('admin_phone')->value:'-' }}</a></p>
                        <p class="m-5px-b links-white">@lang('app.mail') : <a href="mailto:{{ App\Models\Config::site()->get_meta('admin_email')?App\Models\Config::site()->get_meta('admin_email')->value:'#' }}">{{ App\Models\Config::site()->get_meta('admin_email')?App\Models\Config::site()->get_meta('admin_email')->value:'-' }}</a></p>
                        <p class="m-5px-b links-white">Fax : <a href="fax:{{ App\Models\Config::site()->get_meta('admin_fax')?App\Models\Config::site()->get_meta('admin_fax')->value:'#' }}">{{ App\Models\Config::site()->get_meta('admin_fax')?App\Models\Config::site()->get_meta('admin_fax')->value:'-' }}</a></p>
                    {{-- @else
                        @php
                            $str_replace = str_replace('</ul>','',str_replace('<ul>','',str_replace('<li>', '', $contact)));
                            $str_replace2 = str_replace('</li>','/',$str_replace);
                            $adr = explode('/',$str_replace2);
                        @endphp

                        @foreach($adr as $ad)
                            <p class="m-0px links-white"><a href="#">{{ $ad }}</a></p>
                        @endforeach
                    @endif --}}
                    <h5 class="font-1 white-color m-10px-b m-30px-t">@lang('app.txt.followus')</h5>
                    <div class="social-icon si-30 white radius nav">
                        @php $socialConfig = \App\Models\Config::social(); @endphp
                        @foreach(\App\Models\Config::socialRules() as $key => $value)
                            @if($metaConfig = $socialConfig->get_meta($key))
                            <a href="{{$metaConfig->value}}"><i class="fab fa-{{$key}}"></i></a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12 m-30px-t">
                <div class="p-15px white-bg box-shadow">
                    <div class="embed-responsive embed-responsive-21by9">
                        <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3151.840107317064!2d144.955925!3d-37.817214!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb6899234e561db11!2sEnvato!5e0!3m2!1sen!2sin!4v1520156366883" allowfullscreen=""></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Section -->

@endsection
