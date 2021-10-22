@extends('layouts.app')


@section('content')

<!-- Page Title -->
@component('includes.breadcrumb')
    @lang('inscriptionmembre')
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


<div id="section1" class="p-50px-tb">
    <div id="property-single">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="content-box-large">
                            <div class="main-slider-wrapper clearfix content corps gery"> 
                                <div id="slider"> 
                                    <div class="container text-center"> 
                                        <div class="jumbotron"> 
                                                <h2>@lang('app.txt.inscription.membre.title')</h2> 
                                        </div>                     
                                    </div>                 
                                </div>             
                            </div>
                            <div class="panel-body">
                                @include('includes.alerts')
                                
                                {{-- Form for particulier --}}
                                <form class="form-horizontal" role="form" id="partForm" action="{{route('profile.edit')}}" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type="hidden" name="type" value="person_complete">
                                    <input type="hidden" name="id_doss" value="{{$id_doss}}">
                                    <input type="hidden" name="userinfos_id" value="{{ $user?$user->userinfos()->first()->id:'' }}">

                                    {{-- Login Information --}}
                                    <fieldset>
                                        <legend>@lang('app.txt.logininfo')</legend>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="name">@lang('app.txt.login') *</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Votre nom d'utilisateur" value="{{ old('name')?old('name'):($user?$user->name:'') }}">
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="email">@lang('app.txt.email') *</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="email" name="email" placeholder="you@exemple.com" value="{{ old('email')?old('email'):($user?$user->email:'') }}">
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="language" class="col-sm-12 control-label" for="language">@lang('app.language') *</label>
                                            <div class="col-md-12">
                                                <select class="form-control" name="language">
                                                    <option value="fr" {{ old('language')? (old('language')=='fr'?'selected':'') : ( $user?($user->language=='fr'? 'selected' : ''):'') }}>@lang('app.txt.francais')</option>
                                                    <option value="en" {{ old('language')? (old('language')=='en'?'selected':'') : ( $user?($user->language=='en'? 'selected' : ''):'') }}>@lang('app.txt.anglais')</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="country" class="col-sm-3 control-label">@lang('app.txt.pays') *</label>
                                            <div class="col-md-12">
                                                <select class="form-control" name="country" required>
                                                    <option value="" selected disabled>@lang('app.select_country')</option>
                                                    @foreach(App\Models\Country::all() as $country)
                                                    <option value="{{$country->code}}" {{ old('country')==$country->code?'selected':( $user?($user->location()->first()->country==$country->code? 'selected' : ''):'') }}> {{$country->content}} ({{$country->code}})</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">{{ $errors->first('country') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="image"> @lang('app.txt.avatar') </label>
                                            <div class="input-group mb-3 col-md-12">
                                                @if (Auth::user())
                                                    @if (Auth::user()->hasAvatar())
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
                                                    @endif
                                                @else
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">@lang('app.txt.upload')</span>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input inputGroupFile" name="image" id="image">
                                                        <label class="custom-file-label inputGroupFileName" for="inputGroupFile01">@lang('app.txt.choose_avatar')</label>
                                                    </div>
                                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </fieldset>

                                    {{-- Member Identity --}}
                                    <fieldset class="m-25px-t">
                                        <legend> @lang('member.member_identity') </legend>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="name">@lang('app.txt.civility') *</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" name="civility" required>
                                                    <option value="" selected disabled>@lang('app.txt.choose_civility')</option>
                                                    <option value="mr" {{ old('civility')=='mr'? 'selected' : ( $user?($user->userinfos()->first()->civility=='mr'? 'selected' : ''):'') }}>@lang('app.txt.mr')</option>
                                                    <option value="mrs" {{ old('civility')=='mrs'? 'selected' :( $user?($user->userinfos()->first()->civility=='mrs'? 'selected' : ''):'') }}>@lang('app.txt.mrs')</option>
                                                </select>
                                                <span class="text-danger">{{ $errors->first('civility') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="last_name">@lang('app.txt.nom') *</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control"  name="last_name" value="{{ old('last_name')?old('last_name'):($user?$user->userinfos()->first()->last_name:'') }}" >
                                                <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first_name" class="col-sm-3 control-label">@lang('app.txt.prenom') *</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="first_name" value="{{ old('first_name')?old('first_name'):($user?$user->userinfos()->first()->first_name:'') }}" >
                                                <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="name">@lang('app.txt.nationality') *</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="nationality" name="nationality" value="{{ old('nationality')?old('nationality'):($user?$user->userinfos()->first()->nationality:'') }}" placeholder="@lang('app.txt.nationality')" >
                                                <span class="text-danger">{{ $errors->first('nationality') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="date_of_birth" class="col-sm-3 control-label">@lang('app.txt.date_of_birth')</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control datepickerfrom" placeholder="MM/DD/YYYY" name="date_of_birth" value="{{ old('date_of_birth')?old('date_of_birth'):'' }}">
                                                <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="place_of_birth" class="col-sm-3 control-label">@lang('app.txt.place_of_birth')</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="place_of_birth" value="{{ old('place_of_birth')?old('place_of_birth'):'' }}">
                                                <span class="text-danger">{{ $errors->first('place_of_birth') }}</span>
                                            </div>
                                        </div>
                                    </fieldset>

                                    {{-- Physical Address --}}
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
                                                <input type="text" class="form-control" id="route" name="route" placeholder="@lang('app.txt.name_of_the_road')" value="{{ old('route')?old('route'):'' }}" >
                                                <span class="text-danger">{{ $errors->first('route') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="route_number" class="col-sm-12 control-label">@lang('app.txt.number_of_the_road') *</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="route_number" name="route_number" placeholder="@lang('app.txt.number_of_the_road')" value="{{ old('route_number')?old('route_number'):'' }}" >
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
                                                <input type="text" class="form-control" id="level" name="num_floor" placeholder="@lang('app.txt.level')" value="{{ old('num_floor')?old('num_floor'):'' }}">
                                                <span class="text-danger">{{ $errors->first('num_floor') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="area_level_2" class="col-sm-3 control-label">@lang('app.txt.city') *</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="administrative_area_level_2" name="area_level_2" placeholder="@lang('app.txt.city')" value="{{ old('area_level_2')?old('area_level_2'):'' }}" >
                                                <span class="text-danger">{{ $errors->first('area_level_2') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="postalCode" class="col-sm-3 control-label">@lang('app.txt.codepostal') *</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="postal_code" name="postalCode" placeholder="@lang('app.txt.codepostal')" value="{{ old('postalCode')?old('postalCode'):'' }}" >
                                                <span class="text-danger">{{ $errors->first('postalCode') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-12 control-label" for="area_level_1">@lang('app.txt.etat') (@lang('app.txt.etat.libelle'))</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="area_level_1" id="area_level_1" value="{{ old('area_level_1')?old('area_level_1'):'' }}">
                                                <span class="text-danger">{{ $errors->first('area_level_1') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="adrphy_country" class="col-sm-12 control-label">@lang('app.txt.country') *</label>
                                            <div class="col-md-12">
                                                <select class="form-control" name="adrphy_country" >
                                                    <option value="" selected disabled>@lang('app.select_country')</option>
                                                    @foreach(App\Models\Country::all() as $country)
                                                        @if($country->prefixPhone)
                                                            <option value="{{$country->code}}" {{ old('adrphy_country')==$country->code?'selected':'' }}> {{$country->content}} ({{$country->code}})</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">{{ $errors->first('adrphy_country') }}</span>
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
                                                <label for="adrpost_area_level_2" class="col-sm-12 control-label">@lang('app.txt.city') *</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="adrpost_area_level_2" name="adrpost_area_level_2" placeholder="@lang('app.txt.suburb')" value="{{ old('adrpost_area_level_2')?old('adrpost_area_level_2'):'' }}">
                                                    <span class="text-danger">{{ $errors->first('adrpost_area_level_2') }}</span>
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
                                                <label class="col-sm-12 control-label" for="adrpost_area_level_1">@lang('app.txt.etat') (@lang('app.txt.etat.libelle'))</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" name="adrpost_area_level_1" id="adrpost_area_level_1" value="{{ old('adrpost_area_level_1')?old('adrpost_area_level_1'):'' }}">
                                                    <span class="text-danger">{{ $errors->first('adrpost_area_level_1') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="adrpost_country" class="col-sm-12 control-label">@lang('app.txt.country') *</label>
                                                <div class="col-md-12">
                                                    <select class="form-control" id="adrpost_country" name="adrpost_country">
                                                        <option value="" selected disabled>@lang('app.select_country')</option>
                                                        @foreach(App\Models\Country::all() as $country)
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

                                    {{-- Member Contacts --}}
                                    <fieldset class="m-25px-t">
                                        <legend>@lang('app.txt.member_contacts')</legend>
                                        <div class="form-group">
                                            <label for="orga_phone" class="col-sm-12 control-label">@lang('app.orga.fix_phone') *</label>
                                            <div class="input-group mb-3 col-sm-12">
                                                <div class="input-group-prepend">
                                                    <select class="form-control" name="indicatif" id="indicatif">
                                                        @foreach (App\Models\Indicatif::all() as $indicatif)
                                                            <option value="+{{ $indicatif->code }}" {{ $indicatif->code=='61'?'selected':'' }}>(+ {{ $indicatif->code }}) </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="text" pattern="[0-9]{1}[0-9]{7|8}" minlength="6" maxlength="9" placeholder="XXXXXXXX" class="form-control m-15px-t" id="orga_phone" name="orga_phone" value="{{ old('orga_phone')?old('orga_phone'):'' }}" >
                                                </div>
                                            </div>
                                            <span class="text-danger m-5px-l">{{ $errors->first('orga_phone') }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="orga_mobile_phone" class="col-sm-12 control-label">@lang('app.txt.mobile') *</label>
                                            <div class="input-group mb-3 col-sm-12">
                                                <div class="input-group-prepend">
                                                    <select class="form-control" name="indicatif3" id="indicatif3">
                                                        @foreach (App\Models\Indicatif::all() as $indicatif)
                                                            <option value="+{{ $indicatif->code }}" {{ $indicatif->code=='61'?'selected':'' }}>(+ {{ $indicatif->code }}) </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="text" pattern="[0-9]{1}[0-9]{7|8}" minlength="6" maxlength="9" placeholder="XXXXXXXX" class="form-control m-15px-t" id="orga_mobile_phone" name="orga_mobile_phone" value="{{ old('orga_mobile_phone')?old('orga_mobile_phone'):'' }}" >
                                                </div>
                                            </div>
                                            <span class="text-danger m-5px-l">{{ $errors->first('orga_mobile_phone') }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="orga_email" class="col-sm-12 control-label">@lang('app.txt.email_adr') *</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="orga_email" name="orga_email" placeholder="email@iea.com" value="{{ old('orga_email')?old('orga_email'):'' }}" >
                                                <span class="text-danger">{{ $errors->first('orga_email') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="orga_skype" class="col-sm-12 control-label">@lang('app.txt.skype_nickname')</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="orga_skype" name="orga_skype" placeholder="Ex: live:xxxxxx" value="{{ old('orga_skype')?old('orga_skype'):'' }}">
                                                <span class="text-danger">{{ $errors->first('orga_skype') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="orga_fb" class="col-sm-12 control-label">@lang('app.txt.fb_page')</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="orga_fb" name="orga_fb" placeholder="https://www.facebook.com/iea" value="{{ old('orga_website')?old('orga_website'):'' }}">
                                                <span class="text-danger">{{ $errors->first('orga_fb') }}</span>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <div class="form-group m-25px-t{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            {!! app('captcha')->display() !!}
                                            @if ($errors->has('g-recaptcha-response'))
                                                <span class="help-block text-danger">
                                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group m-50px-t">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <em class="help-block">@lang('app.form.required')</em>
                                        </div>
                                    </div>
                                    
                                    <hr>

                                    {{-- Politic and condition --}}
                                    <div>
                                        <div class="form-group m-25px-t m-50px-b">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="politic" id="checkbox-3" >
                                                <label class="custom-control-label" for="checkbox-3"><b>@lang('app.form.register.politic') *</b></label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="condition" id="checkbox-4" >
                                                <label class="custom-control-label" for="checkbox-4"><b>@lang('app.form.register.condition') *</b></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-12">
                                            <button type="button" class="pull-left m-btn m-btn-theme m-15px-r" id="btn_cancel_form">@lang('app.btn.abandonner')</button>
                                            <button type="button" class="m-btn m-btn-theme2nd" id="btn_save"> @lang('app.btn.save') </button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('script')
    {!! NoCaptcha::renderJs() !!}
    @php
        $key = env('GMAP_API_KEY');
        $url = "https://maps.googleapis.com/maps/api/js?key=".$key."&callback=initMap&libraries=places&v=weekly";
    @endphp
    <script async defer src={{$url}}></script>
    <script src="{{asset('js/myJs.js')}}"></script>
    <!-- Jquery Validate -->
    <script src="{{ asset('administrator/js/plugins/validate/jquery.validate.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
    <!-- Include Bootstrap Datepicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="{{asset('administrator/plugins/bootstrap-fileupload/css/bootstrap-fileupload.css')}}">
    <script src="{{asset('administrator/plugins/bootstrap-fileupload/js/bootstrap-fileupload.js')}}"></script>
    <script>
        $('.datepickerfrom').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
    <script>
        var rls = {
				name: {
					required: true
				},
                email: {
                    required: true,
                },
				language: {
					required: true
				},
                country: {
					required: true
				},
                nationality: {
					required: true
				},

                civility: {
					required: true
				},

                last_name: {
					required: true
				},

                first_name: {
					required: true
				},

                route: {
					required: true
				},

                route_number: {
					required: true
				},

                area_level_2: {
					required: true
				},

                postalCode: {
					required: true,
                    number:true
				},

                adrphy_country: {
					required: true
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

                adrpost_area_level_2: {
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

                adrpost_country: {
                    required: {
                        depends: function(element) {
                            if($("#mailAddress").is(":visible")){
                                return true;	
                            }
                        }
                    }
                },

                orga_phone: {
                    minlength:6,
                    maxlength:9,
                    number:true,
				},

                orga_mobile_phone: {
					required: true,
                    minlength:6,
                    maxlength:9,
                    number:true,
				},

                orga_email: {
					required: true,
                    email:true
				},

                condition: {
					required: true,
				},

                politic: {
					required: true,
				},
                
                orga_fb: {
                    url:true
				},

                'g-recaptcha-response': {
                    required: true,
                },
            };
            var msg = {
				name: {
					required: "@lang('app.txt.champobligatoire')"
				},
				email: {
					required: "@lang('app.txt.champobligatoire')"
				},
				language: {
					required: "@lang('app.txt.champobligatoire')",
				},
				country: {
					required: "@lang('app.txt.champobligatoire')"
				},

                civility: {
					required: "@lang('app.txt.champobligatoire')"
				},

                last_name: {
					required: "@lang('app.txt.champobligatoire')"
				},

                first_name: {
					required: "@lang('app.txt.champobligatoire')"
				},

                nationality: {
					required: "@lang('app.txt.champobligatoire')"
				},

                civility: {
					required: "@lang('app.txt.champobligatoire')"
				},

                route: {
					required: "@lang('app.txt.champobligatoire')"
				},

                route_number: {
					required: "@lang('app.txt.champobligatoire')"
				},

                area_level_2: {
					required: "@lang('app.txt.champobligatoire')"
				},

                postalCode: {
					required: "@lang('app.txt.champobligatoire')"
				},

                adrphy_country: {
					required: "@lang('app.txt.champobligatoire')"
				},

                adrpost_postal_box: {
                    required: "@lang('app.txt.champobligatoire')"
                },

                adrpost_area_level_2: {
                    required: "@lang('app.txt.champobligatoire')"
                },
                
                adrpost_postalCode: {
                    required: "@lang('app.txt.champobligatoire')"
                },

                adrpost_country: {
                    required: "@lang('app.txt.champobligatoire')"
                },

                orga_mobile_phone: {
					required: "@lang('app.txt.champobligatoire')"
				},

                orga_email: {
					required: "@lang('app.txt.champobligatoire')"
				},
                
                adrpost_postal_box: {
					required: "@lang('app.txt.champobligatoire')"
				},

                adrpost_area_level_2: {
					required: "@lang('app.txt.champobligatoire')"
				},

                adrpost_postalCode: {
					required: "@lang('app.txt.champobligatoire')"
				},

                adrpost_country: {
					required: "@lang('app.txt.champobligatoire')"
				},

                politic: {
					required: "@lang('app.txt.accept_politic')"
				},

                condition: {
					required: "@lang('app.txt.accept_condition')"
				},

                'g-recaptcha-response': {
                    required: "@lang('app.txt.champobligatoire')",
                },

			};       

        $('#partForm').validate({
			ignore: [],
			rules: rls,
			messages: msg,
			errorPlacement: function ( error, element ) {
				if(element.parent().hasClass('input-group')){
					error.insertBefore( element.parent() );
				}else{
					error.insertAfter( element );
				}
			},
		});

        $('#partForm').submit(function() { // fires on every keyup & blur
            if ($('#partForm').valid()) {                   // checks form for validity
                // set btn submit to loading btn
                $('#btn_save').attr('disabled','disabled');
                $('#btn_save').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>@lang("app.txt.loading")');
            } else {
                $('btn_save').prop('disabled', false);   // enable button
                $('#btn_save').html('@lang("app.btn.register")');
            }
        });
    </script>
    <style>
        .error {
            color: #F00;
            background-color: #FFF;
        }

    </style>
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

        $('#btn_save').click(function(){
            $('#partForm').submit();
        });
        
        $('#btn_cancel_form').click(function(){
            $('#registratorMemberFormModal').modal('hide');
            $('#partForm')[0].reset();
        });
    </script>
    
@endpush

@endsection