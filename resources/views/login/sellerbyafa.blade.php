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

                                        {{-- Seller by AFA Registrater Form --}}
                                        <form id="formSellerRegistrator" onclick="myFunction()" class="form-horizontal" role="form" method="post" action="{{route('register.store', ['role'=>'seller'])}}" enctype="multipart/form-data">
                                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                            
                                            {{-- Registering AFA --}}
                                            <fieldset>
                                                <legend>@lang('app.txt.registering_afa')</legend>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="login">@lang('app.txt.afa_name') *</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="login" name="login_afa" placeholder="@lang('app.txt.afa_name')" value="{{ session('afa_name')?session('afa_name'): (old('login')?old('login'):'') }}" readonly required>
                                                        <span class="text-danger">{{ $errors->first('login') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="immat">@lang('app.txt.afa_id') *</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="immat" name="immat_afa" placeholder="AFA-XXXXX" value="{{ session('afa_id')?session('afa_id'): (old('email')?old('email'):'') }}" readonly required>
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
                                                        <select class="form-control" id="seller_type" name="type" required>
                                                            <option value="individual" {{ old('seller_type')=='seller_1'?'selected':'' }}>@lang('app.txt.individual')</option>
                                                            <option value="business" {{ old('seller_type')=='seller_2'?'selected':'' }}>@lang('app.business')</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                {{-- Individual details --}}
                                                <div id="sellerDetailsIndividual" {{ old('type')!=='business'?'':'hidden' }}>
                                                    {{-- seller #1 --}}
                                                    <div class="m-25px-t">
                                                        <h5>Seller #1</h5>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="last_name">@lang('app.txt.last_name') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name')?old('last_name'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="first_name" class="col-sm-3 control-label">@lang('app.txt.first_name') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name')?old('first_name'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="street_adr" class="col-sm-12 control-label">@lang('app.txt.streetaddress') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="street_adr" name="street_adr" placeholder="@lang('app.txt.streetaddress')" value="{{ old('street_adr')?old('street_adr'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('street_adr') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="suburb" class="col-sm-12 control-label">@lang('app.txt.suburb') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="suburb" name="suburb" placeholder="@lang('app.txt.suburb')" value="{{ old('suburb')?old('suburb'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('suburb') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="city" class="col-sm-12 control-label">@lang('app.txt.city') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="city" name="city" placeholder="@lang('app.txt.city')" value="{{ old('city')?old('city'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('city') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="post_code" class="col-sm-12 control-label">@lang('app.txt.codepostal') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="post_code" name="post_code" placeholder="@lang('app.txt.codepostal')" value="{{ old('post_code')?old('post_code'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('post_code') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-12 control-label" for="state">@lang('app.txt.etat') (@lang('app.txt.etat.libelle'))</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" name="state" id="state" value="{{ old('state')?old('state'):'' }}">
                                                                <span class="text-danger">{{ $errors->first('state') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="country" class="col-sm-12 control-label">@lang('app.txt.country') *</label>
                                                            <div class="col-md-12">
                                                                <select class="form-control" id="country" name="country" required>
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
                                                        <div class="form-group">
                                                            <label for="phone" class="col-sm-12 control-label">@lang('app.txt.phone') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="phone" name="phone" placeholder="@lang('app.txt.contactmobile')" value="{{ old('phone')?old('phone'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="mobile" class="col-sm-12 control-label">@lang('app.txt.mobile') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="@lang('app.txt.contactmobile')" value="{{ old('mobile')?old('mobile'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email_adr" class="col-sm-12 control-label">@lang('app.txt.email') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="email_adr" name="email_adr" placeholder="@lang('app.txt.email')" value="{{ old('email_adr')?old('email_adr'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('email_adr') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- seller #2 --}}
                                                    <div class="m-25px-t">
                                                        <h5>Seller #2</h5>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="last_name_2">@lang('app.txt.last_name') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control"  id="last_name_2" name="last_name_2" value="{{ old('last_name_2')?old('last_name_2'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('last_name_2') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="first_name_2" class="col-sm-3 control-label">@lang('app.txt.first_name') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="first_name_2" name="first_name_2" value="{{ old('first_name_2')?old('first_name_2'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('first_name_2') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="street_adr_2" class="col-sm-12 control-label">@lang('app.txt.streetaddress') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="street_adr_2" name="street_adr_2" placeholder="@lang('app.txt.streetaddress')" value="{{ old('street_adr_2')?old('street_adr_2'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('street_adr_2') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="suburb_2" class="col-sm-12 control-label">@lang('app.txt.suburb') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="suburb_2" name="suburb_2" placeholder="@lang('app.txt.suburb')" value="{{ old('suburb_2')?old('suburb_2'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('suburb_2') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="city_2" class="col-sm-12 control-label">@lang('app.txt.city') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="city_2" name="city_2" placeholder="@lang('app.txt.city')" value="{{ old('city_2')?old('city_2'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('city_2') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="post_code_2" class="col-sm-12 control-label">@lang('app.txt.codepostal') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="post_code_2" name="post_code_2" placeholder="@lang('app.txt.codepostal')" value="{{ old('post_code_2')?old('post_code_2'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('post_code_2') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-12 control-label" for="state_2">@lang('app.txt.etat') (@lang('app.txt.etat.libelle'))</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" name="state_2" id="state_2" value="{{ old('state_2')?old('state_2'):'' }}">
                                                                <span class="text-danger">{{ $errors->first('state_2') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="country_2" class="col-sm-12 control-label">@lang('app.txt.country') *</label>
                                                            <div class="col-md-12">
                                                                <select class="form-control" id="country_2" name="country_2" required>
                                                                    <option value="" selected disabled>@lang('app.select_country')</option>
                                                                    @foreach($countries as $country)
                                                                        @if($country->prefixPhone)
                                                                            <option value="{{$country->id}}" {{ old('country_2')==$country->id?'selected':'' }}> {{$country->content}} ({{$country->code}})</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                <span class="text-danger">{{ $errors->first('country_2') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="phone_2" class="col-sm-12 control-label">@lang('app.txt.phone') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="phone_2" name="phone_2" placeholder="@lang('app.txt.contactmobile')" value="{{ old('phone_2')?old('phone_2'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('phone_2') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="mobile_2" class="col-sm-12 control-label">@lang('app.txt.mobile') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="mobile_2" name="mobile_2" placeholder="@lang('app.txt.contactmobile')" value="{{ old('mobile_2')?old('mobile_2'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('mobile_2') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email_adr_2" class="col-sm-12 control-label">@lang('app.txt.email') *</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="email_adr_2" name="email_adr_2" placeholder="@lang('app.txt.email')" value="{{ old('email_adr_2')?old('email_adr_2'):'' }}" required>
                                                                <span class="text-danger">{{ $errors->first('email_adr_2') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Business details --}}
                                                <div id="sellerDetailsBusiness" {{ old('type')=='business'?'':'hidden' }}>
                                                    <div class="form-group">
                                                        <label for="business_name" class="col-sm-12 control-label">@lang('app.txt.businessname') *</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="business_name" name="business_name" placeholder="@lang('app.txt.businessname')" value="{{ old('business_name')?old('business_name'):'' }}">
                                                            <span class="text-danger">{{ $errors->first('business_name') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="street_adr_bs" class="col-sm-12 control-label">@lang('app.txt.streetaddress') *</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="street_adr_bs" name="street_adr_bs" placeholder="@lang('app.txt.streetaddress')" value="{{ old('street_adr_bs')?old('street_adr_bs'):'' }}">
                                                            <span class="text-danger">{{ $errors->first('street_adr_bs') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="suburb_bs" class="col-sm-12 control-label">@lang('app.txt.suburb') *</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="locality" name="suburb_bs" placeholder="@lang('app.txt.suburb')" value="{{ old('suburb_bs')?old('suburb_bs'):'' }}">
                                                            <span class="text-danger">{{ $errors->first('suburb_bs') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="city_bs" class="col-sm-3 control-label">@lang('app.txt.city') *</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="administrative_area_level_2" name="city_bs" placeholder="@lang('app.txt.city')" value="{{ old('city_bs')?old('city_bs'):'' }}">
                                                            <span class="text-danger">{{ $errors->first('city_bs') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="post_code_bs" class="col-sm-3 control-label">@lang('app.txt.codepostal') *</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="postal_code" name="post_code_bs" placeholder="@lang('app.txt.codepostal')" value="{{ old('post_code_bs')?old('post_code_bs'):'' }}">
                                                            <span class="text-danger">{{ $errors->first('post_code_bs') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="state_bs" class="col-sm-3 control-label">@lang('app.txt.etat') *</label>
                                                        <div class="col-sm-12">
                                                            <select id="administrative_area_level_1" class="form-control" name="state_bs">
                                                                <option selected disabled>@lang('app.select_state')</option>
                                                                @foreach ($states as $state)
                                                                    <option value="{{ $state->content }}" {{ old('state_bs')==$state->content?'selected':'' }}>{{ trans('app.txt.'.$state->content) }} ({{ $state->content }})</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger">{{ $errors->first('state_bs') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="country_bs" class="col-sm-3 control-label">@lang('app.txt.country') *</label>
                                                        <div class="col-sm-12">
                                                            <select class="form-control" id="country_bs" name="country_bs">
                                                                <option value="AUS" {{ old('country_bs')=='AUS'?'selected':'' }}> @lang('app.txt.aus') (AUS)</option>
                                                            </select>
                                                            <span class="text-danger">{{ $errors->first('country_bs') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone_bs" class="col-sm-12 control-label">@lang('app.txt.businessphone') *</label>
                                                        <div class="input-group mb-3 col-sm-12">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text form-control">(+61)</span>
                                                            </div>
                                                            <div class="custom-file">
                                                                <input type="text" pattern="[0-9]{1}[0-9]{7}" minlength="8" maxlength="8" placeholder="XXXXXXXX" class="form-control m-15px-t" id="phone_bs" name="phone_bs" value="{{ old('phone_bs')?old('phone_bs'):'' }}">
                                                            </div>
                                                            <span class="text-danger m-5px-l">{{ $errors->first('phone_bs') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="mobile_bs" class="col-sm-12 control-label">@lang('app.txt.businessmobile') *</label>
                                                        <div class="input-group mb-3 col-sm-12">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text form-control">(+61)</span>
                                                            </div>
                                                            <div class="custom-file">
                                                                <input type="text" pattern="[0-9]{1}[0-9]{7}" minlength="8" maxlength="8" placeholder="XXXXXXXX" class="form-control m-15px-t" id="mobile_bs" name="mobile_bs" value="{{ old('mobile_bs')?old('mobile_bs'):'' }}">
                                                            </div>
                                                            <span class="text-danger m-5px-l">{{ $errors->first('mobile_bs') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email_adr_bs" class="col-sm-12 control-label">@lang('app.txt.businessemail') *</label>
                                                        <div class="col-sm-12">
                                                            <input type="email" class="form-control" id="email_adr_bs" name="email_adr_bs" placeholder="business@email.com" value="{{ old('email_adr_bs')?old('email_adr_bs'):'' }}">
                                                            <span class="text-danger">{{ $errors->first('email_adr_bs') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <div class="form-group m-25px-t">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <em class="help-block">@lang('app.form.required')</em>
                                                </div>
                                            </div>
                                            <hr>

                                            {{-- Politic and condition --}}
                                            <div>
                                                <div class="form-group m-25px-t m-50px-b">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="politic" id="checkbox-1" required>
                                                        <label class="custom-control-label" for="checkbox-1"><b>@lang('app.form.register.politic') *</b></label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="politic" id="checkbox-2" required>
                                                        <label class="custom-control-label" for="checkbox-2"><b>@lang('app.form.register.condition') *</b></label>
                                                    </div>
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
    var indivInput,busInput = "";

    $(window).on('load',function(){
        indivInput = $('#sellerDetailsIndividual').html();
        busInput = $('#sellerDetailsBusiness').html();

        // $('#sellerDetailsBusiness').html('');
    });
    
    $('#seller_type').change(function(){
        var val = $(this).val();

        if(val == 'individual'){
            $('#sellerDetailsIndividual').html(indivInput);
            $('#sellerDetailsBusiness').attr('hidden','hidden');
            // $('#sellerDetailsBusiness').html('');

            // unset seller business input required
            $('#business_name').removeAttr('required');
            $('#street_adr_bs').removeAttr('required');
            $('#locality').removeAttr('required');
            $('#administrative_area_level_2').removeAttr('required');
            $('#postal_code').removeAttr('required');
            $('#state').removeAttr('required');
            $('#country_bs').removeAttr('required');
            $('#phone_bs').removeAttr('required');
            $('#mobile_bs').removeAttr('required');
            $('#email_adr_bs').removeAttr('required');
        }else{
            // $('#sellerDetailsBusiness').html(busInput);
            $('#sellerDetailsBusiness').removeAttr('hidden');
            $('#sellerDetailsIndividual').html('');

            // set seller business input required
            $('#business_name').attr('required','required');
            $('#street_adr_bs').attr('required','required');
            $('#locality').attr('required','required');
            $('#administrative_area_level_2').attr('required','required');
            $('#postal_code').attr('required','required');
            $('#state_bs').attr('required','required');
            $('#country_bs').attr('required','required');
            $('#phone_bs').attr('required','required');
            $('#mobile_bs').attr('required','required');
            $('#email_adr_bs').attr('required','required');
        }
    });
</script>
{{-- End Script as_above or below --}}



{{-- Autocompletion google map --}}
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
        // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.
        autocomplete.setFields(["address_component"]);
        autocomplete2.setFields(["address_component"]);
        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        autocomplete.addListener("place_changed", fillInAddress);
        autocomplete2.addListener("place_changed", fillInAddress);

        // delimite contry autocomplete
        // autocomplete.setComponentRestrictions({'country': ['au']});
        // autocomplete2.setComponentRestrictions({'country': ['au']});
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        const place = input!=='locality'?autocomplete.getPlace():autocomplete2.getPlace();

        for (const component in componentForm) {
        document.getElementById(component).value = "";
        document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.
        for (const component of place.address_components) {
        const addressType = component.types[0];

        if (componentForm[addressType]) {
            const val = component[componentForm[addressType]];
            if(addressType !== "administrative_area_level_1"){
            document.getElementById(addressType).value = val;
            }else{
            $('#administrative_area_level_1 option[value="'+val+'"]').prop('selected', true);
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
        sessionStorage.removeItem('class');
        // set btn submit to loading btn
        $('#btn_register').attr('disabled','disabled');
        $('#btn_register').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>@lang("app.txt.loading")');
    })
</script>

@endpush
