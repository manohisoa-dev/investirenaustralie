@extends('layouts.app')


@section('content')

<!-- Page Title -->
@component('includes.breadcrumb')
    @lang('inscriptionapl')
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
                                    <h2>@lang('app.form.register.apl.title')</h2> 
                                </div>                     
                            </div>                 
                        </div>             
                    </div>
                    <div id="content">
                        <div role="main">
                            <div id="breadcrumbs" class="group font-size-14">
                                <div id="entry" class="group">
                                    <div class="hasfloat aligncenter">
                                        {{-- <b>@lang('app.form.register.apl.desc')</b> --}}
                                    </div>
                                    <div class="hasfloat">
                                    <form class="form-horizontal" id="formAplRegistrator" role="form" method="post" action="{{route('register.store', ['role'=>'apl'])}}" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                        <input type="hidden" name="type" value="organization">

                                        {{-- Login info --}}
                                        <fieldset class="m-25px-t">
                                            <legend>@lang('app.txt.logininfo')</legend>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="name">@lang('app.txt.login') *</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="@lang('app.txt.your_login')" value="{{ old('name')?old('name'):'' }}" required>
                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-12 control-label" for="email">@lang('app.txt.email') *</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="Ex: iea@email.com" value="{{ old('email')?old('email'):'' }}" required>
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="language" class="col-sm-12 control-label" for="language">@lang('app.txt.langage') *</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="language" name="language">
                                                        <option value="fr" {{ old('language')=='fr'?'selected':'' }}>@lang('app.txt.fr')</option>
                                                        <option value="en" {{ old('language')=='en'?'selected':'' }}>@lang('app.txt.en')</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </fieldset>

                                        {{-- Agency details --}}
                                        <fieldset class="m-25px-t">
                                            <legend>@lang('app.txt.agencydetail')</legend>
                                            <div class="form-group">
                                                <label for="orga_name" class="col-sm-12 control-label">@lang('app.txt.agencyname') *</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="orga_name" name="orga_name" placeholder="@lang('app.txt.agencyname')" value="{{ old('orga_name')?old('orga_name'):'' }}" required>
                                                    <span class="text-danger">{{ $errors->first('orga_name') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="orga_registration_number" class="col-sm-12 control-label">@lang('app.txt.agencyregistrationnumber') *</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="orga_registration_number" name="orga_registration_number" placeholder="RCS XXX XXX XXX XXX" value="{{ old('orga_registration_number')?old('orga_registration_number'):'' }}" required>
                                                    <span class="text-danger">{{ $errors->first('orga_registration_number') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="orga_type" class="col-sm-12 control-label">@lang('app.txt.type_of_company') *</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="orga_type" name="orga_type" required>
                                                        <option value="" selected disabled>@lang('app.form.choix_txt')</option>
                                                        <option value="individual" {{ old('orga_type')=='individual'?'selected':'' }}>@lang('app.txt.individual')</option>
                                                        <option value="society" {{ old('orga_type')=='society'?'selected':'' }}>@lang('app.txt.society')</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group" id="orgaForm" {{ old('orga_type')=='society'?'': 'hidden="hidden"'}} >
                                                <label for="orga_form" class="col-sm-12 control-label">@lang('app.txt.company_form') *</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="orga_form" name="orga_form">
                                                        <option value="" selected disabled>@lang('app.form.choix_txt')</option>
                                                        <option value="sarl" {{ old('orga_form')=='sarl'?'selected':'' }}>SARL</option>
                                                        <option value="sa" {{ old('orga_form')=='sa'?'selected':'' }}>SA</option>
                                                        <option value="other" {{ old('orga_form')=='other'?'selected':'' }}>@lang('app.txt.other')</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group" id="defineOrgaForm" {{ old('orga_form')=='other'?'': 'hidden="hidden"'}}>
                                                <label for="define_orga_form" class="col-sm-12 control-label">@lang('app.txt.define') *</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="define_orga_form" placeholder="@lang('app.txt.define')" value="{{ old('define_orga_form')?old('define_orga_form'):'' }}">
                                                    <span class="text-danger">{{ $errors->first('define_orga_form') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="orga_license_number" class="col-sm-12 control-label">@lang('app.txt.professional_license_number_of_apl') *</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="orga_license_number" name="orga_license_number" placeholder="@lang('app.txt.professional_license_number_of_apl')" value="{{ old('orga_license_number')?old('orga_license_number'):'' }}" required>
                                                    <span class="text-danger">{{ $errors->first('orga_license_number') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="orga_presentation" class="col-sm-12 control-label">@lang('app.txt.agencypresentation')</label>
                                                <div class="col-sm-12">
                                                    <textarea class="form-control" maxlength="2000" id="orga_presentation" name="orga_presentation" placeholder="@lang('app.txt.agencypresentation')" rows="10">{{ old('orga_presentation')?old('orga_presentation'):'' }}</textarea>
                                                    <span class="text-danger">{{ $errors->first('orga_presentation') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="image"> @lang('app.txt.agencylogo')</label>
                                                <div class="input-group mb-3 col-md-12">
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
                                                <label for="orga_operation_range" class="col-sm-12 control-label">@lang('app.txt.scope_of_intervention_around_establishment') *</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" name="orga_operation_range" id="orga_operation_range" required>
                                                        <option value="10" {{ old('orga_operation_range')=='5'?'selected':'' }}> 5 Km</option>
                                                        <option value="10" {{ old('orga_operation_range')=='10'?'selected':'' }}> 10 Km</option>
                                                        <option value="25" {{ old('orga_operation_range')=='25'?'selected':'' }}> 25 Km</option>
                                                        <option value="50" {{ old('orga_operation_range')=='50'?'selected':'' }}> 50 Km</option>
                                                        <option value="100" {{ old('orga_operation_range')=='100'?'selected':'' }}> 100 Km</option>
                                                        <option value="250" {{ old('orga_operation_range')=='250'?'selected':'' }}> 250 Km</option>
                                                        <option value="+250" {{ old('orga_operation_range')=='+250'?'selected':'' }}>@lang('app.txt.more_than',['number'=>'250 Km'])</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </fieldset>

                                        {{-- Physical address --}}
                                        <fieldset class="m-25px-t">
                                            <legend>@lang('app.txt.physical_address')</legend>
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
                                                <label for="num_floor" class="col-sm-12 control-label">@lang('app.txt.floor')</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="num_floor" name="num_floor" placeholder="@lang('app.txt.floor')" value="{{ old('num_floor')?old('num_floor'):'' }}">
                                                    <span class="text-danger">{{ $errors->first('num_floor') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="neighborhood" class="col-sm-12 control-label">@lang('app.txt.neighborhood_district_borough')</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="neighborhood" name="neighborhood" placeholder="@lang('app.txt.neighborhood_district_borough')" value="{{ old('neighborhood')?old('neighborhood'):'' }}">
                                                    <span class="text-danger">{{ $errors->first('neighborhood') }}</span>
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
                                                                <option value="{{$country->code}}" {{ old('country')==$country->code?'selected':'' }}> {{$country->content}} ({{$country->code}})</option>
                                                            @endif
                                                        @endforeach
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
                                            <div id="postalAddress" {{ old('postal_address_below') ? '' : 'hidden="hidden"' }}>
                                                <div class="form-group">
                                                    <label for="adrpost_postal_box" class="col-sm-12 control-label">@lang('app.txt.postal_box')</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="adrpost_postal_box" name="adrpost_postal_box" placeholder="@lang('app.txt.postal_box')" value="{{ old('adrpost_postal_box')?old('adrpost_postal_box'):'' }}">
                                                        <span class="text-danger">{{ $errors->first('adrpost_postal_box') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="adrpost_locality" class="col-sm-3 control-label">@lang('app.txt.city') *</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="adrpost_locality" name="adrpost_locality" value="{{ old('adrpost_locality')?old('adrpost_locality'):'' }}" placeholder="@lang('app.txt.city')">
                                                        <span class="text-danger">{{ $errors->first('adrpost_locality') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="adrpost_postalCode" class="col-sm-12 control-label">@lang('app.txt.codepostal') *</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="adrpost_postalCode" name="adrpost_postalCode" value="{{ old('adrpost_postalCode')?old('adrpost_postalCode'):'' }}" placeholder="@lang('app.txt.codepostal')">
                                                        <span class="text-danger">{{ $errors->first('adrpost_postalCode') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label" for="adrpost_area_level_1">@lang('app.txt.etat') (@lang('app.txt.etat.libelle'))</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" name="adrpost_area_level_1" id="adrpost_area_level_1" value="{{ old('adrpost_area_laravel_1')?old('adrpost_area_laravel_1'):'' }}">
                                                        <span class="text-danger">{{ $errors->first('adrpost_area_level_1') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="adrpost_country" class="col-sm-12 control-label">@lang('app.txt.country') *</label>
                                                    <div class="col-md-12">
                                                        <select class="form-control" name="adrpost_country"> 
                                                            <option value="" selected disabled>@lang('app.select_country')</option>
                                                            @foreach($countries as $country)
                                                                @if($country->prefixPhone)
                                                                    <option value="{{$country->code}}" {{ old('adrpost_country')==$country->code?'selected':'' }}> {{$country->content}} ({{$country->code}})</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        <span class="text-danger">{{ $errors->first('adrpost_country') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>

                                        {{-- Contact Information --}}
                                        <fieldset class="m-25px-t">
                                            <legend>@lang('app.txt.contact_information')</legend>
                                            <div class="form-group">
                                                <label for="contact_name" class="col-sm-12 control-label">@lang('app.txt.contactname') *</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="@lang('app.txt.contactname')" value="{{ old('contact_name')?old('contact_name'):'' }}" required>
                                                    <span class="text-danger">{{ $errors->first('contact_name') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="contact_phone" class="col-sm-12 control-label">@lang('app.txt.contactmobile') *</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" minlength="9" maxlength="9" id="contact_phone" name="contact_phone" placeholder="@lang('app.txt.contactmobile')" value="{{ old('contact_phone')?old('contact_phone'):'' }}" required>
                                                    <span class="text-danger">{{ $errors->first('contact_phone') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="contact_email" class="col-sm-12 control-label">@lang('app.txt.contactemailaddress') *</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="contact_email" name="contact_email" placeholder="@lang('app.txt.contactemailaddress')" value="{{ old('contact_email')?old('contact_email'):'' }}" required>
                                                    <span class="text-danger">{{ $errors->first('contact_email') }}</span>
                                                </div>
                                            </div>
                                        </fieldset>
                                        
                                        {{-- Bank Account --}}
                                        <fieldset class="m-25px-t">
                                            <legend>@lang('app.txt.bank_account')</legend>
                                            <div class="form-group">
                                                <label for="bank_name" class="col-sm-12 control-label">@lang('app.txt.bank') *</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="@lang('app.txt.bank')" value="{{ old('bank_name')?old('bank_name'):'' }}" required>
                                                    <span class="text-danger">{{ $errors->first('bank_name') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="bank_agency" class="col-sm-12 control-label">@lang('app.txt.agency') *</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="bank_agency" name="bank_agency" placeholder="@lang('app.txt.agency')" value="{{ old('bank_agency')?old('bank_agency'):'' }}" required>
                                                    <span class="text-danger">{{ $errors->first('bank_agency') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-12 control-label">@lang('app.txt.address') :</label>
                                                <fieldset>
                                                    <div class="form-group">
                                                        <label for="bank_postal_box" class="col-sm-12 control-label">@lang('app.txt.postal_box') *</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="bank_postal_box" name="bank_postal_box" placeholder="@lang('app.txt.postal_box')" value="{{ old('bank_postal_box')?old('bank_postal_box'):'' }}" required>
                                                            <span class="text-danger">{{ $errors->first('bank_postal_box') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="bank_locality" class="col-sm-12 control-label">@lang('app.txt.city') *</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="bank_locality" name="bank_locality" placeholder="@lang('app.txt.city')" value="{{ old('bank_locality')?old('bank_locality'):'' }}" required>
                                                            <span class="text-danger">{{ $errors->first('bank_locality') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="bank_postalCode" class="col-sm-12 control-label">@lang('app.txt.codepostal') *</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="bank_postalCode" name="bank_postalCode" placeholder="@lang('app.txt.codepostal')" value="{{ old('bank_postalCode')?old('bank_postalCode'):'' }}" required>
                                                            <span class="text-danger">{{ $errors->first('bank_postalCode') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-12 control-label" for="bank_area_level_1">@lang('app.txt.etat') (@lang('app.txt.etat.libelle'))</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" name="bank_area_level_1" id="bank_area_level_1" value="{{ old('bank_area_level_1')?old('bank_area_level_1'):'' }}">
                                                            <span class="text-danger">{{ $errors->first('bank_area_level_1') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="bank_country" class="col-sm-12 control-label">@lang('app.txt.country') *</label>
                                                        <div class="col-md-12">
                                                            <select class="form-control" name="bank_country" required>
                                                                <option value="" selected disabled>@lang('app.select_country')</option>
                                                                @foreach($countries as $country)
                                                                    @if($country->prefixPhone)
                                                                        <option value="{{$country->code}}" {{ old('bank_country')==$country->code?'selected':'' }}> {{$country->content}} ({{$country->code}})</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger">{{ $errors->first('bank_country') }}</span>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="form-group">
                                                <label for="bank_iban" class="col-sm-12 control-label">@lang('app.txt.iban_bank_account') *</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="bank_iban" name="bank_iban" maxlength="27" placeholder="XXXX XXXX XXXX XXXX XXXX XXXX XXX" value="{{ old('bank_iban')?old('bank_iban'):'' }}" required>
                                                    <span class="text-danger">{{ $errors->first('bank_iban') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="bank_bic" class="col-sm-12 control-label">@lang('app.txt.bic_code') *</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="bank_bic" name="bank_bic" maxlength="8" placeholder="XXXXXXXX" value="{{ old('bank_bic')?old('bank_bic'):'' }}" required>
                                                    <span class="text-danger">{{ $errors->first('bank_bic') }}</span>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <div class="form-group p-50px-t">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <em class="help-block">(*) @lang('app.txt.champobligatoire')</em>
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
                                                <button type="submit" class="m-btn m-btn-theme" id='btn_register'>@lang('app.btn.register')</button>
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
    $('#formAplRegistrator').validate({
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
            orga_name: {
                required: true,
            },
            orga_registration_number: {
                required: true,
            },
            orga_type: {
                required: true,
            },
            orga_form: {
                required: {
                    depends: function(element) {
                        if($("#orgaForm").is(":visible")){
                            return true;	
                        }
                    }
                }
            },
            orga_license_number: {
                required: true,
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
            postalCode: {
                required: true,
                number:true
            },
            country: {
                required: true,
            },
            adrpost_locality: {
                required: {
                    depends: function(element) {
                        if($("#postalAddress").is(":visible")){
                            return true;	
                        }
                    }
                }
            },
            adrpost_postalCode: {
                number:true,
                required: {
                    depends: function(element) {
                        if($("#postalAddress").is(":visible")){
                            return true;	
                        }
                    }
                }
            },
            adrpost_country: {
                required: {
                    depends: function(element) {
                        if($("#postalAddress").is(":visible")){
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
            },
            contact_phone: {
                required: true,
                number:true,
                minlength: 9,
                maxlength: 9,
            },
            bank_name: {
                required: true,
            },
            bank_agency: {
                required: true,
            },
            bank_postal_box: {
                required: true,
            },
            bank_locality: {
                required: true,
            },
            bank_postalCode: {
                required: true,
                number:true,
            },
            bank_country: {
                required: true,
            },
            bank_iban: {
                required: true,
                minlength:27,
                maxlength:27,
            },
            bank_bic: {
                required: true,
                minlength:8,
                maxlength:8,
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
            },
            politic: {
                required: "@lang('app.txt.champobligatoire')"
            },
            condition: {
                required: "@lang('app.txt.champobligatoire')"
            },
            orga_name: {
                required: "@lang('app.txt.champobligatoire')",
            },
            orga_registration_number: {
                required: "@lang('app.txt.champobligatoire')",
            },
            orga_type: {
                required: "@lang('app.txt.champobligatoire')",
            },
            orga_form: {
                required: "@lang('app.txt.champobligatoire')",
            },
            orga_license_number: {
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
            postalCode: {
                required: "@lang('app.txt.champobligatoire')",
            },
            country: {
                required: "@lang('app.txt.champobligatoire')",
            },
            adrpost_locality: {
                required: "@lang('app.txt.champobligatoire')",
            },
            adrpost_postalCode: {
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
            },
            contact_phone: {
                required: "@lang('app.txt.champobligatoire')",
            },
            bank_name: {
                required: "@lang('app.txt.champobligatoire')",
            },
            bank_agency: {
                required: "@lang('app.txt.champobligatoire')",
            },
            bank_postal_box: {
                required: "@lang('app.txt.champobligatoire')",
            },
            bank_locality: {
                required: "@lang('app.txt.champobligatoire')",
            },
            bank_postalCode: {
                required: "@lang('app.txt.champobligatoire')",
            },
            bank_country: {
                required: "@lang('app.txt.champobligatoire')",
            },
            bank_iban: {
                required: "@lang('app.txt.champobligatoire')",
            },
            bank_bic: {
                required: "@lang('app.txt.champobligatoire')",
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

    $('#formAplRegistrator').submit(function() { // fires on every keyup & blur
        if ($('#formAplRegistrator').valid()) {                   // checks form for validity
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
<script>
    $('#orga_type').change(function(){
        if($(this).val() === $("#orga_type option:eq(2)").val()){
            $('#orgaForm').removeAttr('hidden');
        }else{
            $('#orgaForm').attr('hidden','hidden');
            $('#defineOrgaForm').attr('hidden','hidden');
            $('#define_orga_form').val('');
            $('#orga_form option:eq(0)').prop('selected', true);
        }
    });

    $('#orga_form').change(function(){
        $('#define_orga_form').val('');
        
        if($(this).val() === $("#orga_form option:eq(3)").val()){
            $(this).removeAttr('name');
            $('#defineOrgaForm').removeAttr('hidden');
            $('#define_orga_form').attr('name','orga_form');
        }else{
            $(this).attr('name','orga_form');
            $('#defineOrgaForm').attr('hidden','hidden');
            $('#define_orga_form').removeAttr('name');
        }
    });

    $('#shop-notification-1').change(function(){
        if($('#shop-notification-1').is(":checked"))
        {
            $('#shop-notification-2').prop('checked',false);
            $('#postalAddress').attr('hidden','hidden');
        }else{
            $('#shop-notification-2').prop('checked',true);
            $('#postalAddress').removeAttr('hidden');
        }
    });

    $('#shop-notification-2').change(function(){
        if($('#shop-notification-2').is(":checked"))
        {
            $('#shop-notification-1').prop('checked',false);
            $('#postalAddress').removeAttr('hidden');
        }else{
            $('#shop-notification-1').prop('checked',true);
            $('#postalAddress').attr('hidden','hidden');
        }
    });
</script>
@endpush
