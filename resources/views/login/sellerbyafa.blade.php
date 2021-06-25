@extends('layouts.app')


@section('content')

<!-- Page Title -->
@component('includes.breadcrumb')
    @lang('inscriptionseller')
@endcomponent
<!-- Section -->

<div class="main-slider-wrapper clearfix content corps p-100px-tb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="content-box-large">
                    <div class="main-slider-wrapper clearfix content corps gery"> 
                        <div id="slider"> 
                            <div class="container text-center"> 
                                <div class="jumbotron"> 
                                    <h2>@lang('app.form.register.seller_by_afa.title')</h2> 
                                </div>                     
                            </div>                 
                        </div>             
                    </div>
                
                    <div id="content">
                        @include('includes.alerts')
                        <div role="main">
                            <div id="breadcrumbs" class="group font-size-14">
                                </div>
                                <div id="entry" class="group">
                                    {{-- <div class="hasfloat aligncenter">
                                        <b>@lang('app.form.register.seller.desc')</b>
                                    </div> --}}
                                    <div class="hasfloat">
                                        @include('includes.alerts')

                                        {{-- Seller by AFA Registrater Form --}}
                                        <form id="formSeller3Registrator" class="form-horizontal" role="form" onClick="myFunction()" method="post" action="{{route('register.store', ['role'=>'seller'])}}" enctype="multipart/form-data">
                                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                            
                                            {{-- Registering AFA --}}
                                            <fieldset>
                                                <legend>@lang('app.txt.registering_afa')</legend>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="login">@lang('app.txt.afa_name') *</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="login" name="login" placeholder="you@login.com" value="{{ old('login')?old('login'):'' }}" required>
                                                        <span class="text-danger">{{ $errors->first('login') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="immat">@lang('app.txt.afa_id') *</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="immat" name="immat" placeholder="AFA-XXXXX" value="{{ old('email')?old('email'):'' }}" required>
                                                        <span class="text-danger">{{ $errors->first('immat') }}</span>
                                                    </div>
                                                </div>
                                            </fieldset>

                                            {{-- Login Information --}}
                                            <fieldset class="m-25px-t">
                                                <legend>@lang('app.txt.logininfo')</legend>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="name">@lang('app.txt.login') *</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="@lang('app.txt.login')" value="{{ old('name')?old('name'):'' }}" required>
                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="email">@lang('app.txt.email') *</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="email" name="email" placeholder="you@email.com" value="{{ old('email')?old('email'):'' }}" required>
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="language" class="col-sm-12 control-label" for="language">@lang('app.language') *</label>
                                                    <div class="col-sm-12">
                                                        <select class="form-control" id="language" name="language">
                                                            <option value="fr" {{ app()->getLocale()=='fr'?'selected':'' }}>@lang('app.txt.fr')</option>
                                                            <option value="en" {{ app()->getLocale()=='en'?'selected':'' }}>@lang('app.txt.en')</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </fieldset>

                                            {{-- Seller Details --}}
                                            <fieldset>
                                                <legend>@lang('app.txt.seller_details')</legend>
                                                <div class="form-group">
                                                    <label for="seller_type" class="col-sm-3 control-label">@lang('app.txt.kind_of_seller') *</label>
                                                    <div class="col-sm-12">
                                                        <select class="form-control" id="seller_type" required>
                                                            <option value="individual" {{ old('seller_type')=='seller_1'?'selected':'' }}>@lang('app.txt.individual')</option>
                                                            <option value="business" {{ old('seller_type')=='seller_2'?'selected':'' }}>@lang('app.business')</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                {{-- Individual details --}}
                                                <div id="sellerDetailsIndividual" {{ old('seller_type')!=='business'?'':'hidden' }}>
                                                    {{-- seller #1 --}}
                                                    <div class="m-25px-t">
                                                        <h5>Seller #1</h5>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="last_name">@lang('app.txt.nom') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control"  name="last_name" value="{{ old('last_name')?old('last_name'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="first_name" class="col-sm-3 control-label">@lang('app.txt.prenom') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" name="first_name" value="{{ old('first_name')?old('first_name'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="date_of_birth" class="col-sm-3 control-label">@lang('app.txt.date_of_birth') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" name="date_of_birth" value="{{ old('date_of_birth')?old('date_of_birth'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="place_of_birth" class="col-sm-3 control-label">@lang('app.txt.place_of_birth') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" name="place_of_birth" value="{{ old('place_of_birth')?old('place_of_birth'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('place_of_birth') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="name">@lang('app.txt.nationality') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="nationality" name="nationality" value="{{ old('nationality')?old('nationality'):'' }}" placeholder="@lang('app.txt.nationality')" required>
                                                                <span class="text-danger">{{ $errors->first('nationality') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="route" class="col-sm-12 control-label">@lang('app.txt.streetaddress') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="route" name="route" placeholder="@lang('app.txt.streetaddress')" value="{{ old('route')?old('route'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('route') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="locality" class="col-sm-12 control-label">@lang('app.txt.suburb') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="locality" name="locality" placeholder="@lang('app.txt.suburb')" value="{{ old('locality')?old('locality'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('locality') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="administrative_area_level_2" class="col-sm-12 control-label">@lang('app.txt.city') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="area_level_2" name="area_level_2" placeholder="@lang('app.txt.city')" value="{{ old('area_level_2')?old('area_level_2'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('area_level_2') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="postalCode" class="col-sm-12 control-label">@lang('app.txt.codepostal') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="postalCode" name="postalCode" placeholder="@lang('app.txt.codepostal')" value="{{ old('postalCode')?old('postalCode'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('postalCode') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-12 control-label" for="state">@lang('app.txt.etat') (@lang('app.txt.etat.libelle'))</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" name="area_level_1" id="area_level_1" value="{{ old('area_level_1')?old('area_level_1'):'' }}">
                                                                <span class="text-danger">{{ $errors->first('area_level_1') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="country" class="col-sm-12 control-label">@lang('app.txt.country') *</label>
                                                            <div class="col-md-12">
                                                                <select class="form-control" name="country" required>
                                                                    <option value="" selected disabled>@lang('app.select_country')</option>
                                                                    @foreach($countries as $country)
                                                                        @if($country->prefixPhone)
                                                                            <option value="{{$country->id}}" {{ old('country')==$country->id?'selected':'' }}> {{$country->content}} ({{$country->code}})</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                <span class="text-danger">{{ $errors->first('country') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- seller #2 --}}
                                                    <div class="m-25px-t">
                                                        <h5>Seller #2</h5>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="last_name">@lang('app.txt.nom') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control"  name="last_name" value="{{ old('last_name')?old('last_name'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="first_name" class="col-sm-3 control-label">@lang('app.txt.prenom') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" name="first_name" value="{{ old('first_name')?old('first_name'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="date_of_birth" class="col-sm-3 control-label">@lang('app.txt.date_of_birth') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" name="date_of_birth" value="{{ old('date_of_birth')?old('date_of_birth'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="place_of_birth" class="col-sm-3 control-label">@lang('app.txt.place_of_birth') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" name="place_of_birth" value="{{ old('place_of_birth')?old('place_of_birth'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('place_of_birth') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="name">@lang('app.txt.nationality') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="nationality" name="nationality" value="{{ old('nationality')?old('nationality'):'' }}" placeholder="@lang('app.txt.nationality')" required>
                                                                <span class="text-danger">{{ $errors->first('nationality') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="route" class="col-sm-12 control-label">@lang('app.txt.streetaddress') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="route" name="route" placeholder="@lang('app.txt.streetaddress')" value="{{ old('route')?old('route'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('route') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="locality" class="col-sm-12 control-label">@lang('app.txt.suburb') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="locality" name="locality" placeholder="@lang('app.txt.suburb')" value="{{ old('locality')?old('locality'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('locality') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="locality" class="col-sm-12 control-label">@lang('app.txt.city') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="locality" name="locality" placeholder="@lang('app.txt.city')" value="{{ old('locality')?old('locality'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('locality') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="postalCode" class="col-sm-12 control-label">@lang('app.txt.codepostal') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="postalCode" name="postalCode" placeholder="@lang('app.txt.codepostal')" value="{{ old('postalCode')?old('postalCode'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('postalCode') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-12 control-label" for="state">@lang('app.txt.etat') (@lang('app.txt.etat.libelle'))</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" name="area_level_1" id="area_level_1" value="{{ old('area_level_1')?old('area_level_1'):'' }}">
                                                                <span class="text-danger">{{ $errors->first('area_level_1') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="country" class="col-sm-12 control-label">@lang('app.txt.country') *</label>
                                                            <div class="col-md-12">
                                                                <select class="form-control" name="country" required>
                                                                    <option value="" selected disabled>@lang('app.select_country')</option>
                                                                    @foreach($countries as $country)
                                                                        @if($country->prefixPhone)
                                                                            <option value="{{$country->id}}" {{ old('country')==$country->id?'selected':'' }}> {{$country->content}} ({{$country->code}})</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                <span class="text-danger">{{ $errors->first('country') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Business details --}}
                                                <div id="sellerDetailsBusiness" {{ old('seller_type')=='business'?'':'hidden' }}>
                                                    <div class="form-group">
                                                        <label for="orga_name" class="col-sm-12 control-label">@lang('app.txt.businessname') *</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="orga_name" name="orga_name" placeholder="@lang('app.txt.businessname')" value="{{ old('orga_name')?old('orga_name'):'' }}" required>
                                                            <span class="text-danger">{{ $errors->first('orga_name') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="route" class="col-sm-12 control-label">@lang('app.txt.streetaddress') *</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="route" name="route" placeholder="@lang('app.txt.streetaddress')" value="{{ old('route')?old('route'):'' }}" required>
                                                            <span class="text-danger">{{ $errors->first('route') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="locality" class="col-sm-12 control-label">@lang('app.txt.suburb') *</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="locality" name="locality" placeholder="@lang('app.txt.suburb')" value="{{ old('locality')?old('locality'):'' }}" required>
                                                            <span class="text-danger">{{ $errors->first('locality') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="area_level_2" class="col-sm-3 control-label">@lang('app.txt.city') *</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="administrative_area_level_2" name="area_level_2" placeholder="@lang('app.txt.city')" value="{{ old('area_level_2')?old('area_level_2'):'' }}" required>
                                                            <span class="text-danger">{{ $errors->first('area_level_2') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="postalCode" class="col-sm-3 control-label">@lang('app.txt.codepostal') *</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="postal_code" name="postalCode" placeholder="@lang('app.txt.codepostal')" value="{{ old('postalCode')?old('postalCode'):'' }}" required>
                                                            <span class="text-danger">{{ $errors->first('postalCode') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="country" class="col-sm-3 control-label">@lang('app.txt.etat') *</label>
                                                        <div class="col-sm-12">
                                                            <select id="administrative_area_level_1" class="form-control" name="area_level_1">
                                                                <option selected disabled>@lang('app.select_state')</option>
                                                                @foreach ($states as $state)
                                                                    <option value="{{ $state->content }}" {{ old('area_level_1')==$state->content?'selected':'' }}>{{ trans('app.txt.'.$state->content) }} ({{ $state->content }})</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger">{{ $errors->first('area_level_1') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="country" class="col-sm-3 control-label">@lang('app.txt.country') *</label>
                                                        <div class="col-sm-12">
                                                            <select class="form-control" name="country" required>
                                                                <option value="AUS" {{ old('country')=='AUS'?'selected':'' }}> @lang('app.txt.aus') (AUS)</option>
                                                            </select>
                                                            <span class="text-danger">{{ $errors->first('country') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="orga_phone" class="col-sm-12 control-label">@lang('app.txt.businessphone') *</label>
                                                        <div class="input-group mb-3 col-sm-12">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text form-control">(+61)</span>
                                                            </div>
                                                            <div class="custom-file">
                                                                <input type="text" pattern="[0-9]{1}[0-9]{7}" minlength="8" maxlength="8" placeholder="XXXXXXXX" class="form-control m-15px-t" id="orga_phone" name="orga_phone" value="{{ old('orga_phone')?old('orga_phone'):'' }}" required>
                                                            </div>
                                                            <span class="text-danger m-5px-l">{{ $errors->first('orga_phone') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="orga_mobile_phone" class="col-sm-12 control-label">@lang('app.txt.businessmobile') *</label>
                                                        <div class="input-group mb-3 col-sm-12">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text form-control">(+61)</span>
                                                            </div>
                                                            <div class="custom-file">
                                                                <input type="text" pattern="[0-9]{1}[0-9]{7}" minlength="8" maxlength="8" placeholder="XXXXXXXX" class="form-control m-15px-t" id="orga_mobile_phone" name="orga_mobile_phone" value="{{ old('orga_mobile_phone')?old('orga_mobile_phone'):'' }}" required>
                                                            </div>
                                                            <span class="text-danger m-5px-l">{{ $errors->first('orga_mobile_phone') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="orga_email" class="col-sm-12 control-label">@lang('app.txt.businessemail') *</label>
                                                        <div class="col-sm-12">
                                                            <input type="email" class="form-control" id="orga_email" name="orga_email" placeholder="business@email.com" value="{{ old('orga_email')?old('orga_email'):'' }}" required>
                                                            <span class="text-danger">{{ $errors->first('orga_email') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <em class="help-block">@lang('app.form.required')</em>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <button type="submit" class="m-btn m-btn-theme" id="btn_register">@lang('app.btn.register')</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="cl-md-4"></div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{asset('js/myJs.js')}}"></script>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
    //fermeture du modal
    $("#custom-close").on('click', function() {
        $('#myModal').modal('hide');
    });
</script>
<script type="text/javascript">
    $('body').scrollspy({
        target: '#navbar-collapsible',
        offset: 50
    });
    $('a[href*=#]:not([href=#])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top - 50
                }, 1000);
                return false;
            }
        }
    });
</script>
{{-- Script as_above or below --}}
<script>
    $('#seller_type').change(function(){
        var val = $(this).val();

        if(val == 'individual'){
            $('#sellerDetailsIndividual').removeAttr('hidden');
            $('#sellerDetailsBusiness').attr('hidden','hidden');
        }else{
            $('#sellerDetailsBusiness').removeAttr('hidden');
            $('#sellerDetailsIndividual').attr('hidden','hidden');
        }
    });

    $('#shop-notification-1').change(function(){
        if($('#shop-notification-1').is(":checked"))
        {
            $('#shop-notification-2').prop('checked',false);
            $('#mailAddress').attr('hidden','hidden');

            // unset required input
            $('#adrpost_postal_box').removeAttr('required');
            $('#adrpost_area_level_2').removeAttr('required');
            $('#adrpost_postalCode').removeAttr('required');
            $('#adrpost_area_level_1').removeAttr('required');
        }else{
            $('#shop-notification-2').prop('checked',true);
            $('#mailAddress').removeAttr('hidden');
            
            // set required input
            $('#adrpost_postal_box').attr('required','required');
            $('#adrpost_area_level_2').attr('required','required');
            $('#adrpost_postalCode').attr('required','required');
            $('#adrpost_area_level_1').attr('required','required');
        }
    });

    $('#shop-notification-2').change(function(){
        if($('#shop-notification-2').is(":checked"))
        {
            $('#shop-notification-1').prop('checked',false);
            $('#mailAddress').removeAttr('hidden');
            
            // set required input
            $('#adrpost_postal_box').attr('required','required');
            $('#adrpost_area_level_2').attr('required','required');
            $('#adrpost_postalCode').attr('required','required');
            $('#adrpost_area_level_1').attr('required','required');
        }else{
            $('#shop-notification-1').prop('checked',true);
            $('#mailAddress').attr('hidden','hidden');

            // unset required input
            $('#adrpost_postal_box').removeAttr('required');
            $('#adrpost_area_level_2').removeAttr('required');
            $('#adrpost_postalCode').removeAttr('required');
            $('#adrpost_area_level_1').removeAttr('required');
        }
    });
</script>
{{-- End Script as_above or below --}}



{{-- Google map autocomplete --}}
<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRj7J_sOaCmFfSFNvUL7Z-NX3uUvG_FTA&callback=initAutocomplete&libraries=places&v=weekly"
defer
></script>
<script>
    // This sample uses the Autocomplete widget to help the user select a
    // place, then it retrieves the address components associated with that
    // place, and then it populates the form fields with those details.
    // This sample requires the Places library. Include the libraries=places
    // parameter when you first load the API. 
    let placeSearch;
    let autocomplete;
    let autocomplete2;
    let autocomplete3;
    var input;
    const componentForm = {
        locality: "long_name",
        administrative_area_level_1: "short_name",
        administrative_area_level_2: "short_name",
        postal_code: "short_name",
    };

    function myFunction() {
        return input = document.activeElement.id;
    }

    var stateBounds={
        cta: ["-35.473469","149.012375"],
        nt: ["-19.491411","132.550964"],
        vic: ["-37.020100","144.964600"],
        sa: ["-30.000233","136.209152"],
        wa: ["-25.042261","117.793221"],
        qld: ["-20.917574","142.702789"],
        nsw: ["-31.840233","145.612793"],
    };

    function getStateBounds(state) {
        return new google.maps.LatLngBounds(
        new google.maps.LatLng(stateBounds[state][0], 
                                stateBounds[state][1])
        ); 
    }

    function initAutocomplete() {
        var options = {
            types: ["(regions)"],
            componentRestrictions: {country: "au"},
            bounds: getStateBounds('vic'),              //à continuer
        };
        
        var options2 = {
            types: ["(cities)"],
            componentRestrictions: {country: "au"},
            bounds: getStateBounds('vic'),              //à continuer
        };

        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.
        autocomplete = new google.maps.places.Autocomplete(document.getElementById("administrative_area_level_2"),options);
        
        autocomplete2 = new google.maps.places.Autocomplete(document.getElementById("locality"),options2);
        
        autocomplete3 = new google.maps.places.Autocomplete(document.getElementById("adrpost_locality"),options);

        // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.
        autocomplete.setFields(["address_component"]);
        autocomplete2.setFields(["address_component"]);
        autocomplete3.setFields(["address_component"]);
        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        autocomplete.addListener("place_changed", fillInAddress);
        autocomplete2.addListener("place_changed", fillInAddress);
        autocomplete3.addListener("place_changed", fillInAddress);

        // delimite contry autocomplete
        // autocomplete.setComponentRestrictions({'country': ['au']});
        // autocomplete2.setComponentRestrictions({'country': ['au']});
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        const place = input!=='locality'?(input!=='adrpost_locality'?autocomplete.getPlace():autocomplete3.getPlace()):autocomplete2.getPlace();
        var prefix = '';

        for (const component in componentForm) {
            if(input==='adrpost_locality'){
                prefix = 'adrpost_';
            }
            
            if(prefix == 'adrpost_' && component!=='administrative_area_level_2'){
                document.getElementById(prefix+component).value = "";
                document.getElementById(prefix+component).disabled = false;
            }else{
                document.getElementById(component).value = "";
                document.getElementById(component).disabled = false;
            }
        }

        // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.
        for (const component of place.address_components) {
            const addressType = component.types[0];
            if (componentForm[addressType]) {
                const val = component[componentForm[addressType]];
                if(addressType !== "administrative_area_level_1"){
                    if(prefix == 'adrpost_' && addressType!=='administrative_area_level_2'){
                        document.getElementById(prefix+addressType).value = val;
                    }else{
                        document.getElementById(addressType).value = val;
                    }
                }else{
                    $('#'+prefix+'administrative_area_level_1 option[value="'+val+'"]').prop('selected', true);
                }
            }
        }
    }

    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position) => {
            const geolocation = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
            };
            const circle = new google.maps.Circle({
            center: geolocation,
            radius: position.coords.accuracy,
            });
            autocomplete.setBounds(circle.getBounds());
        });
        }
    }

    // Initialize input after State selected
    $('#administrative_area_level_1').on('change',function(){
        $('input[name=city').val('');
        $('input[name=suburb').val('');
    })
</script>
{{-- End google map autocomplete --}}

<script>
    $('#formSellerRegistrator').submit(function(){
        // set btn submit to loading btn
        $('#btn_register').attr('disabled','disabled');
        $('#btn_register').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>@lang("app.txt.loading")');
    })
</script>

@endpush
