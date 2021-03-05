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
    @lang('app.reset_password')
@endcomponent

<!-- Section -->
<section class="section gray-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 m-15px-tb">
                
                @include('includes.alerts')

                <div class="white-bg box-shadow p-30px">
                    <div class="p-20px-b">
                        <h5 class="m-0px">@lang('app.txt.send_email')</h5>
                    </div>
                    <form data-form-output="form-output-global" data-form-type="contact" method="post" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
    
                        <div class="row col-lg-12">
                            <div class="col-lg-12 form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">@lang('app.txt.email')</label>
        
                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ session('reset_email') ? session('reset_email') : '' }}" required>
        
                                    @if ($errors->has('email'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
        
                            <div class="form-group col-lg-6">
                                <div class="col-md-12 col-md-offset-4 p-60px-t">
                                    <button type="submit" class="m-btn m-btn-theme border-radius-0">
                                        @lang('app.txt.send_password_reset_link')
                                    </button>
                                </div>
                            </div>
                        </div>
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