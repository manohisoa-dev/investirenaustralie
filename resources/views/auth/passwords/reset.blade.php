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
                        <h5 class="m-0px">@lang('app.txt.newpassword')</h5>
                    </div>

                    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}
                        
                        <input type="hidden" name="token" value="{{ $token }}">
    
                        <div class="form-group">
                            <label for="email" class="col-md-12 control-label">@lang('app.txt.email')</label>
    
                            <div class="col-md-12">
                                <input id="email" placeholder="@lang('app.txt.email')" type="email" class="form-control" name="email" value="{{ session('reset_email')?session('reset_email'):''  }}" required autofocus>
                                
                                @if ($errors->has('email')) 
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label for="password" class="col-md-12 control-label">@lang('app.txt.password')</label>
    
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" placeholder="@lang('app.txt.password')" required>
    
                                @if ($errors->has('password'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-12 control-label">@lang('app.confirm.password')</label>
                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="@lang('app.confirm.password')" required>
    
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
    
                        <div class="col-md-12 p-10px-t">
                            <button class="m-btn m-btn-theme w-100 border-radius-0" type="submit" name="send">@lang('app.txt.reset_password')</button>
                            <div class="snackbars" id="form-output-global"></div>
                        </div>
                        <div id="error-container"></div>
                        <div id="message-container"></div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 m-15px-tb">
                <div class="border-all-10 border-color-white p-40px-tb p-20px-lr theme-bg box-shadow h-100">
                    <h5 class="font-1 white-color m-10px-b">@lang('app.form.login.address')</h5>
                    <p class="white-color-light m-30px-b">
                        @if(empty($address))
                            @lang('app.txt.noinfo')
                        @else
                            {!!$address!!}
                        @endif
                    </p>
                    <h5 class="font-1 white-color m-10px-b">@lang('app.form.login.contact')</h5>
                    @if(empty($contact))
                        <p class="m-0px links-white"><a href="tel:820-885-3321">820-885-3321</a></p>
                        <p class="m-5px-b links-white"><a href="mailto:support@domain.com">support@domain.com</a></p>
                    @else
                        @php
                            $str_replace = str_replace('</ul>','',str_replace('<ul>','',str_replace('<li>', '', $contact)));
                            $str_replace2 = str_replace('</li>','/',$str_replace);
                            $adr = explode('/',$str_replace2);
                        @endphp

                        @foreach($adr as $ad)
                            <p class="m-0px links-white"><a href="#">{{ $ad }}</a></p>
                        @endforeach
                    @endif
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