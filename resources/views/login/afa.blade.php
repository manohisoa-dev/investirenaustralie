@extends('layouts.app')


@section('content')

<!-- Page Title -->
@component('includes.breadcrumb')
    @lang('inscriptionafa')
@endcomponent
<!-- Section -->
<style>
    #map{
        height: 25rem;
    }

    #mapCanvas {
        width: 500px;
        height: 400px;
        float: left;
    }
    #infoPanel {
        float: left;
    }
    #infoPanel div {
        margin-bottom: 5px;
    }
</style>

<div class="main-slider-wrapper clearfix content corps p-100px-tb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="content-box-large">
                    <div class="main-slider-wrapper clearfix content corps gery"> 
                        <div id="slider"> 
                            <div class="container text-center"> 
                                <div class="jumbotron"> 
                                    <h2>@lang('app.form.register.afa.title')</h2> 
                                </div>                     
                            </div>                 
                        </div>             
                    </div>
                    <div id="content">
                        <div role="main">
                            <div id="breadcrumbs" class="group font-size-14">
                                <div id="entry" class="group">
                                    <div class="hasfloat aligncenter"></div>
                                    <div class="hasfloat">
                                    <form class="form-horizontal" role="form" id="formAfaRegistrator" onclick="myFunction()" method="post" action="{{route('register.store', ['role'=>'afa'])}}" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

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
                                                <div class="col-sm-9">
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

                                        {{-- Business Details --}}
                                        <fieldset class="m-25px-t">
                                            <legend>@lang('app.txt.business_details')</legend>
                                            <div class="form-group">
                                                <label for="type" class="col-sm-12 control-label">@lang('app.txt.type_of_business') *</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" name="type" id="type" required>
                                                        <option value="" selected disabled>@lang('app.form.choix_txt')</option>
                                                        <option value="Real Estate Agency"> @lang('app.txt.real_estate_agency')</option>
                                                        <option value="Business Broker"> @lang('app.txt.business_broker')</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="orga_name" class="col-sm-12 control-label">@lang('app.txt.businessname') *</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="orga_name" name="orga_name" placeholder="@lang('app.txt.businessname')" value="{{ old('orga_name')?old('orga_name'):'' }}" required>
                                                    <span class="text-danger">{{ $errors->first('orga_name') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="orga_trading_name" class="col-sm-12 control-label">@lang('app.txt.businesstradingname') *</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="orga_trading_name" name="orga_trading_name" placeholder="@lang('app.txt.businesstradingname')" value="{{ old('orga_trading_name')?old('orga_trading_name'):'' }}" required>
                                                    <span class="text-danger">{{ $errors->first('orga_trading_name') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="orga_abn" class="col-sm-12 control-label">@lang('app.txt.business_abn') *</label>
                                                <div class="col-sm-12">
                                                    <input type="text" minlength="11" maxlength="11" pattern="[0-9]{1}[0-9]{10}" class="form-control" id="orga_abn" name="orga_abn" placeholder="@lang('app.txt.abn_number')" value="{{ old('orga_abn')?old('orga_abn'):'' }}" required>
                                                    <span class="text-danger">{{ $errors->first('orga_abn') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="orga_acn" class="col-sm-12 control-label">@lang('app.txt.business_acn')</label>
                                                <div class="col-sm-12">
                                                    <input type="text" minlength="9" maxlength="9" pattern="[0-9]{1}[0-9]{8}" class="form-control" id="orga_acn" name="orga_acn" placeholder="@lang('app.txt.acn_number')" value="{{ old('orga_acn')?old('orga_acn'):'' }}" >
                                                    <span class="text-danger">{{ $errors->first('orga_acn') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="orga_license_number" class="col-sm-12 control-label">@lang('app.txt.real_estate_agent_licence_number') *</label>
                                                <div class="col-sm-12">
                                                    <input type="text" minlength="7" maxlength="7" pattern="[0-9]{1}[0-9]{6}" class="form-control" id="orga_license_number" name="orga_license_number" placeholder="@lang('app.txt.real_estate_agent_licence_number')" value="{{ old('orga_license_number')?old('orga_license_number'):'' }}" required>
                                                    <span class="text-danger">{{ $errors->first('orga_license_number') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="orga_email" class="col-sm-12 control-label">@lang('app.txt.businessemail') *</label>
                                                <div class="col-sm-12">
                                                    <input type="email" class="form-control" id="orga_email" name="orga_email" placeholder="business@email.com" value="{{ old('orga_email')?old('orga_email'):'' }}" required>
                                                    <span class="text-danger">{{ $errors->first('orga_email') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="orga_phone" class="col-sm-12 control-label">@lang('app.txt.businessphone') *</label>
                                                <div class="input-group mb-3 col-sm-12">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text form-control">(+61)</span>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="text" pattern="[0-9]{1}[0-9]{7|8}" minlength="8" maxlength="9" placeholder="XXXXXXXX" class="form-control m-15px-t" id="orga_phone" name="orga_phone" value="{{ old('orga_phone')?old('orga_phone'):'' }}" required>
                                                    </div>
                                                </div>
                                                <span class="text-danger m-5px-l">{{ $errors->first('orga_phone') }}</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="orga_fax" class="col-sm-12 control-label">@lang('app.txt.businessfax')</label>
                                                <div class="input-group mb-3 col-sm-12">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text form-control">(+61)</span>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="text" class="form-control m-15px-t" id="orga_fax" name="orga_fax" value="{{ old('orga_fax')?old('orga_fax'):'' }}">
                                                    </div>
                                                    <span class="text-danger m-5px-l">{{ $errors->first('orga_fax') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="orga_mobile_phone" class="col-sm-12 control-label">@lang('app.txt.businessmobile') *</label>
                                                <div class="input-group mb-3 col-sm-12">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text form-control">(+61)</span>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="text" pattern="[0-9]{1}[0-9]{8}" minlength="9" maxlength="9" placeholder="XXXXXXXXX" class="form-control m-15px-t" id="orga_mobile_phone" name="orga_mobile_phone" value="{{ old('orga_mobile_phone')?old('orga_mobile_phone'):'' }}" required>
                                                    </div>
                                                </div>
                                                <span class="text-danger m-5px-l">{{ $errors->first('orga_mobile_phone') }}</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="orga_website" class="col-sm-12 control-label">@lang('app.txt.websiteurl') *</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="orga_website" name="orga_website" placeholder="Ex: http://www.iea.com" value="{{ old('orga_website')?old('"orga_website'):'' }}" required>
                                                    <span class="text-danger">{{ $errors->first('orga_website') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="orga_presentation" class="col-sm-12 control-label">@lang('app.txt.businesspresentation')</label>
                                                <div class="col-sm-12">
                                                    <textarea class="form-control" id="orga_presentation" name="orga_presentation" maxlength="2000" rows="10">{{ old('orga_presentation')?old('"orga_presentation'):'' }}</textarea>
                                                    <span class="text-danger">{{ $errors->first('orga_presentation') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="image"> @lang('app.txt.logo')</label>
                                                <div class="input-group mb-3 col-sm-12">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">@lang('app.txt.upload')</span>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input inputGroupFile" name="image" id="image">
                                                        <label class="custom-file-label inputGroupFileName" for="image">@lang('app.txt.choose_file')</label>
                                                    </div>
                                                </div>
                                                <span class="text-danger">{{ $errors->first('image') }}</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="orga_operation_state" class="col-sm-12 control-label">@lang('app.txt.stateoflegaloperation') *</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control selectpicker col-md-12" multiple data-live-search="true" name="orga_operation_state[]" required>
                                                        @foreach($states as $state)
                                                            <option value="{{$state->content}}" {{ old('orga_operation_state')==$state->content?'selected':'' }}> {{$state->content}} </option>
                                                        @endforeach
                                                    </select>
                                                    {{-- <select class="form-control" name="orga_operation_state" required>
                                                        <option value="" selected disabled>@lang('app.select_state')</option>
                                                        @foreach($states as $state)
                                                        <option value="{{$state->id}}" {{ old('orga_operation_state')==$state->id?'selected':'' }}> {{$state->content}}</option>
                                                        @endforeach
                                                    </select> --}}
                                                    <span class="text-danger">{{ $errors->first('orga_operation_state') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="orga_operation_range" class="col-sm-12 control-label">@lang('app.txt.rangeofoperation') *</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" name="orga_operation_range" id="orga_operation_range">
                                                        <option value="10" {{ old('orga_operation_range')=='5'?'selected':'' }}> 5 Km</option>
                                                        <option value="10" {{ old('orga_operation_range')=='10'?'selected':'' }}> 10 Km</option>
                                                        <option value="25" {{ old('orga_operation_range')=='25'?'selected':'' }}> 25 Km</option>
                                                        <option value="50" {{ old('orga_operation_range')=='50'?'selected':'' }}> 50 Km</option>
                                                        <option value="100" {{ old('orga_operation_range')=='100'?'selected':'' }}> 100 Km</option>
                                                        <option value="250" {{ old('orga_operation_range')=='250'?'selected':'' }}> 250 Km</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </fieldset>
                                        
                                        {{-- Office Address --}}
                                        <fieldset class="m-25px-t">
                                            <legend>@lang('app.txt.office_address')</legend>
                                            <div class="form-group">
                                                <label for="building_name" class="col-sm-12 control-label">@lang('app.txt.name_building')</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="building_name" name="building_name" placeholder="@lang('app.txt.name_building')" value="{{ old('building_name')?old('building_name'):'' }}">
                                                    <span class="text-danger">{{ $errors->first('building_name') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="route" class="col-sm-12 control-label">@lang('app.txt.name_of_the_road') *</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="route" name="route" placeholder="@lang('app.txt.name_of_the_road')" value="{{ old('route')?old('route'):'' }}" required>
                                                    <span class="text-danger">{{ $errors->first('route') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="route_number" class="col-sm-12 control-label">@lang('app.txt.number_of_the_road') *</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="route_number" name="route_number" placeholder="@lang('app.txt.number_of_the_road')" value="{{ old('route_number')?old('route_number'):'' }}" required>
                                                    <span class="text-danger">{{ $errors->first('route_number') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="num_rooms" class="col-sm-12 control-label">@lang('app.txt.number_of_rooms')</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="num_rooms" name="num_rooms" placeholder="@lang('app.txt.number_of_rooms')" value="{{ old('num_rooms')?old('num_rooms'):'' }}">
                                                    <span class="text-danger">{{ $errors->first('num_rooms') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="level" class="col-sm-12 control-label">@lang('app.txt.level')</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="level" name="level" placeholder="@lang('app.txt.level')" value="{{ old('level')?old('level'):'' }}">
                                                    <span class="text-danger">{{ $errors->first('level') }}</span>
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
                                                <label for="area_level_1" class="col-sm-3 control-label">@lang('app.txt.etat') *</label>
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
                                        </fieldset>

                                        {{-- Postal Address --}}
                                        <fieldset class="m-25px-t">
                                            <legend>@lang('app.txt.postal_address')</legend>
                                            <div class="form-group">
                                                <div class="row col-sm-offset-3 col-sm-12">
                                                    <div class="col-sm-6">
                                                        <div class="checkbox">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" name="postal_address_above" class="custom-control-input" id="shop-notification-1" {{ old('postal_address_below') ? '' : 'checked="checked"' }} {{ old('postal_address_above') ? 'checked="checked"' : '' }}>
                                                                <label class="custom-control-label" for="shop-notification-1">@lang('app.txt.as_above')</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="checkbox">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" name="postal_address_below" class="custom-control-input" id="shop-notification-2" {{ old('postal_address_below') ? 'checked="checked"' : '' }}>
                                                                <label class="custom-control-label" for="shop-notification-2">@lang('app.txt.detail_below')</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- for detail below --}}
                                            <div id="mailAddress" {{ old('postal_address_below') ? '' : 'hidden="hidden"' }} >
                                                <div class="form-group">
                                                    <label for="adrpost_postal_box" class="col-sm-3 control-label">@lang('app.txt.postal_box') *</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="adrpost_postal_box" name="adrpost_postal_box" placeholder="@lang('app.txt.postal_box')" value="{{ old('adrpost_postal_box')?old('adrpost_postal_box'):'' }}">
                                                        <span class="text-danger">{{ $errors->first('adrpost_postal_box') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="adrpost_locality" class="col-sm-12 control-label">@lang('app.txt.suburb') *</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="adrpost_locality" name="adrpost_locality" placeholder="@lang('app.txt.suburb')" value="{{ old('adrpost_locality')?old('adrpost_locality'):'' }}">
                                                        <span class="text-danger">{{ $errors->first('adrpost_locality') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="adrpost_postalCode" class="col-sm-3 control-label">@lang('app.txt.codepostal') *</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="adrpost_postal_code" name="adrpost_postalCode" value="{{ old('adrpost_postalCode')?old('adrpost_postalCode'):'' }}" placeholder="@lang('app.txt.codepostal')">
                                                        <span class="text-danger">{{ $errors->first('adrpost_postalCode') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="adrpost_area_level_1" class="col-sm-3 control-label">@lang('app.txt.etat') *</label>
                                                    <div class="col-sm-12">
                                                        <select id="adrpost_administrative_area_level_1" class="form-control" name="adrpost_area_level_1">
                                                            <option selected disabled>@lang('app.select_state')</option>
                                                            @foreach ($states as $state)
                                                                <option value="{{ $state->content }}" {{ old('adrpost_area_level_1')==$state->content?'selected':'' }}>{{ trans('app.txt.'.$state->content) }} ({{ $state->content }})</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="text-danger">{{ $errors->first('adrpost_area_level_1') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="adrpost_country" class="col-sm-3 control-label">@lang('app.txt.country') *</label>
                                                    <div class="col-sm-12">
                                                        <select class="form-control" name="adrpost_country">
                                                            <option value="AUS" {{ old('country')=='AUS'?'selected':'' }}> @lang('app.txt.aus') (AUS)</option>
                                                        </select>
                                                        <span class="text-danger">{{ $errors->first('adrpost_country') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>

                                        {{-- Contact Details --}}
                                        <fieldset class="m-25px-t">
                                            <legend>@lang('app.txt.contact_details')</legend>
                                            <div class="form-group">
                                                <label for="contact_name" class="col-sm-12 control-label">@lang('app.txt.contactname') *</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="@lang('app.txt.contactname')" value="{{ old('contact_name')?old('contact_name'):'' }}"  required>
                                                    <span class="text-danger">{{ $errors->first('contact_name') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="contact_email" class="col-sm-12 control-label">@lang('app.txt.contactemail') *</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="contact_email" name="contact_email" placeholder="email@iea.com" value="{{ old('contact_email')?old('contact_email'):'' }}" required>
                                                    <span class="text-danger">{{ $errors->first('contact_email') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="contact_phone" class="col-sm-12 control-label">@lang('app.txt.contactphone') *</label>
                                                <div class="input-group mb-3 col-sm-12">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text form-control">(+61)</span>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="text" pattern="[0-9]{1}[0-9]{8}" minlength="9" maxlength="9" placeholder="XXXXXXXX" class="form-control m-15px-t" id="contact_phone" name="contact_phone" value="{{ old('contact_phone')?old('contact_phone'):'' }}" required>
                                                    </div>
                                                </div>
                                                <span class="text-danger m-5px-l">{{ $errors->first('contact_phone') }}</span>
                                            </div>
                                        </fieldset>
                                        
                                        <div class="form-group">
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
                                                    <input type="checkbox" class="custom-control-input" name="condition" id="checkbox-2" required>
                                                    <label class="custom-control-label" for="checkbox-2"><b>@lang('app.form.register.condition') *</b></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9 p-25px-b">
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
        </div>
    </div>
</div>

@endsection

@push('script')
    <script src="{{asset('js/myJs.js')}}"></script>
    <!-- Jquery Validate -->
    <script src="{{ asset('administrator/js/plugins/validate/jquery.validate.min.js') }}"></script>
    <script>
        $.validator.addMethod('le', function (value, element, param) {
            return this.optional(element) || value !== $(param).val();
        }, '@lang("app.txt.invalid_value")');

        $.validator.addMethod('ge', function (value, element, param) {
            return this.optional(element) || value !== $(param).val();
        }, '@lang("app.txt.invalid_value")');

        $('#formAfaRegistrator').validate({
            ignore: [],
            rules: {
                name: {
                    required: true,
                    remote: {
                        url: "{{ route('ajaxCheckLogin') }}",
                        type: "get",
                        data: {
                            name: function () {
                                return $("input[name='name']").val();
                            }
                        }
                    }
                },
                email: {
                    required: true,
                    email:true,
                    le:'#orga_email',
                    remote: {
                        url: "{{ route('ajaxCheckEmail') }}",
                        type: "get",
                        data: {
                            email: function () {
                                return $("input[name='email']").val();
                            }
                        }
                    }
                },
                politic: {
                    required: true,
                },
                condition: {
                    required: true,
                },
                type: {
                    required: true,
                },
                orga_name: {
                    required: true,
                },
                orga_trading_name: {
                    required: true,
                },
                orga_abn: {
                    required: true,
                    number:true,
                    minlength:11,
                    maxlength:11
                },
                orga_acn: {
                    number:true,
                    minlength:9,
                    maxlength:9
                },
                orga_license_number: {
                    required: true,
                    minlength:7,
                    maxlength:7
                },
                orga_email: {
                    required: true,
                    email:true,
                    le:'#email',
                    ge:'#contact_email',
                },
                orga_phone: {
                    required: true,
                    number:true,
                    minlength:8,
                    maxlength:9,
                    le:'#contact_phone',
                },
                orga_mobile_phone: {
                    required: true,
                    number:true,
                    minlength:9,
                    maxlength:9,
                },
                orga_website: {
                    required: true,
                    url:true
                },
                orga_presentation: {
                    maxlength: 1000,
                },
                // image: {
                //     accept: "image/jpeg, image/pjpeg"
                // },
                orga_operation_state: {
                    required:true,
                },
                orga_operation_range: {
                    required:true,
                },
                route: {
                    required: true,
                },
                route_number: {
                    required: true,
                },
                locality: {
                    required: true,
                },
                area_level_2: {
                    required: true,
                },
                postalCode: {
                    required: true,
                    number:true
                },
                area_level_1: {
                    required: true,
                },
                country: {
                    required: true,
                },
                adrpost_postal_box: {
                    required: {
                        depends: function(element) {
                            if($("#mailAddress").is(":visible")){
                                return true;	
                            }
                        }
                    }
                },
                adrpost_locality: {
                    required: {
                        depends: function(element) {
                            if($("#mailAddress").is(":visible")){
                                return true;	
                            }
                        }
                    }
                },
                adrpost_postalCode: {
                    number:true,
                    required: {
                        depends: function(element) {
                            if($("#mailAddress").is(":visible")){
                                return true;	
                            }
                        }
                    }
                },
                adrpost_area_level_1: {
                    required: {
                        depends: function(element) {
                            if($("#mailAddress").is(":visible")){
                                return true;	
                            }
                        }
                    }
                },
                adrpost_country: {
                    required: {
                        depends: function(element) {
                            if($("#mailAddress").is(":visible")){
                                return true;	
                            }
                        }
                    }
                },
                contact_name: {
                    required: true,
                },
                contact_email: {
                    required: true,
                    email:true,
                    le:'#orga_email',
                },
                contact_phone: {
                    required: true,
                    number:true,
                    minlength: 9,
                    maxlength: 9,
                    le:'#orga_phone',
                },
            },
            messages: {
                name: {
                    required: "@lang('app.txt.champobligatoire')",
                    remote: jQuery.validator.format("{0} @lang('app.txt.form.already_exist')")
                },
                email: {
                    required: "@lang('app.txt.champobligatoire')",
                    remote: jQuery.validator.format("{0} @lang('app.txt.form.already_exist')"),
                    le: '@lang("app.txt.value_already_used")'
                },
                politic: {
                    required: "@lang('app.txt.champobligatoire')"
                },
                condition: {
                    required: "@lang('app.txt.champobligatoire')"
                },
                type: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                orga_name: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                orga_trading_name: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                orga_abn: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                orga_email: {
                    required: "@lang('app.txt.champobligatoire')",
                    le: '@lang("app.txt.value_already_used")',
                    ge: '@lang("app.txt.value_already_used")'
                },
                orga_phone: {
                    required: "@lang('app.txt.champobligatoire')",
                    le: '@lang("app.txt.value_already_used")'
                },
                orga_mobile_phone: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                orga_website: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                orga_operation_state: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                orga_operation_range: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                route: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                route_number: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                locality: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                area_level_2: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                postalCode: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                area_level_1: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                country: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                adrpost_postal_box: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                adrpost_locality: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                adrpost_postalCode: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                adrpost_area_level_1: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                adrpost_country: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                contact_name: {
                    required: "@lang('app.txt.champobligatoire')",
                },
                contact_email: {
                    required: "@lang('app.txt.champobligatoire')",
                    le: '@lang("app.txt.value_already_used")',
                },
                contact_phone: {
                    required: "@lang('app.txt.champobligatoire')",
                    le: '@lang("app.txt.value_already_used")'
                },
            },
            errorPlacement: function ( error, element ) {
                if(element.parent().hasClass('input-group')){
                    error.insertBefore( element.parent() );
                }else{
                    error.insertAfter( element );
                }
            },
        });

        $('#formAfaRegistrator').submit(function() { // fires on every keyup & blur
            if ($('#formAfaRegistrator').valid()) {                   // checks form for validity
                // set btn submit to loading btn
                $('#btn_register').attr('disabled','disabled');
                $('#btn_register').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>@lang("app.txt.loading")');
            } else {
                $('btn_register').prop('disabled', false);   // enable button
                $('#btn_register').html('@lang("app.btn.register")');
            }
        });
    </script>
    <style>
        .error {
            color: #F00;
            background-color: #FFF;
        }
    </style>
    <!-- End Jquery Validate -->
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
        $('#shop-notification-1').change(function(){
            if($('#shop-notification-1').is(":checked"))
            {
                $('#shop-notification-2').prop('checked',false);
                $('#mailAddress').attr('hidden','hidden');
            }else{
                $('#shop-notification-2').prop('checked',true);
                $('#mailAddress').removeAttr('hidden');
            }
        });

        $('#shop-notification-2').change(function(){
            if($('#shop-notification-2').is(":checked"))
            {
                $('#shop-notification-1').prop('checked',false);
                $('#mailAddress').removeAttr('hidden');
            }else{
                $('#shop-notification-1').prop('checked',true);
                $('#mailAddress').attr('hidden','hidden');
            }
        });
    </script>
    {{-- End Script as_above or below --}}



    {{-- Google map autocomplete --}}
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

        function initMap() {
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

@endpush
