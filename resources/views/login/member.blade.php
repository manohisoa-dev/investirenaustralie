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

<div id="chooseTypeMemberModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
      <div class="modal-content white-bg">
          <div class="modal-header border-radius-0" style="background-color: #AE4435 !important;">
              {{-- <h4 class="modal-title white-color">{{$page?$page->title:''}}</h4> --}}
              <h4 class="modal-title white-color">{{ trans('app.txt.inscription.membre.choose_type.title') }}</h4>
              <button type="button" class="close" data-dismiss="modal" onclick="closeModal()" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              {{-- <p class="text-justify">{{$page?$page->content:''}}</p> --}}
              <div class="row">
                <label for="type" class="col-sm-12 col-lg-12 control-label">@lang('app.txt.typemembre') *</label>
                <div class="col-md-12">
                    <select class="form-control" id="type" required>
                        <option value="person" {{ old('type')=='person'?'selected':'' }}>@lang('app.txt.particulier')</option>
                        <option value="organization" {{ old('type')=='organization'?'selected':'' }}>@lang('app.txt.organisation')</option>
                    </select>
                </div>
            </div>
          </div>
          <div class="modal-footer">
              <a type="button" class="pull-left m-btn m-btn-theme" href="{{ route('home') }}">@lang('app.btn.abandonner')</a>
              <a type="button" class="m-btn m-btn-theme2nd" href="#section1" id="custom-continue">@lang('app.btn.continuer')</a>
          </div>
      </div>
  </div>
</div>
<div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content white-bg">
            <div class="modal-header border-radius-0" style="background-color: #AE4435 !important;">
                {{-- <h4 class="modal-title white-color">{{$page?$page->title:''}}</h4> --}}
                <h4 class="modal-title white-color"></h4>
                <button type="button" class="close" data-dismiss="modal" onclick="closeModal()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="engagementForm">
                    {{-- <p class="text-justify">{{$page?$page->content:''}}</p> --}}
                </form>
            </div>
        </div>
    </div>
  </div>

<div id="countrySelectModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content white-bg">
            <div class="modal-header border-radius-0" style="background-color: #AE4435 !important;">
                <h4 class="modal-title white-color">{{trans('app.txt.choose_position')}}</h4>
            </div>
            <div class="modal-body">
                <div id="map"></div>                  
                <div id="infoPanel"  class=" col-lg-12 border-top-1 border-color-gray m-25px-t p-15px-t">
                    <b>@lang('app.txt.marker.status') :</b>
                    <div id="markerStatus"><i>@lang('app.txt.marker.click_drag')</i></div>
                    <b>@lang('app.txt.marker.current_position'):</b>
                    <div id="info"></div>
                    <b>@lang('app.txt.marker.matching_address') :</b>
                    <div id="address"></div>
                </div>

            </div>
            <div class="modal-footer">
                <a type="button" class="pull-left m-btn m-btn-theme" data-dismiss="modal">@lang('app.btn.close')</a>
                <a type="button" class="pull-left m-btn m-btn-theme4rd" id="btn_save">@lang('app.btn.save')</a>
            </div>
        </div>
    </div>
</div>

<div id="section1" class="p-100px-tb">
    <div id="property-single">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="content-box-large">
                            <div class="main-slider-wrapper clearfix content corps gery"> 
                                <div id="slider"> 
                                    <div class="container text-center"> 
                                        <div class="jumbotron title-form"> 
                                            {{-- title form --}}
                                            <h2>{{ strtoupper(trans("app.txt.inscription.membre.organization.title")) }}</h2>
                                        </div>                     
                                    </div>                 
                                </div>             
                            </div>
                            <div class="panel-body">
                                @include('includes.alerts')
                                {{-- <div class="row">
                                    <label for="type" class="col-sm-12 col-lg-3 control-label">@lang('app.txt.typemembre') *</label>
                                    <div class="col-md-3">
                                        <select class="form-control" id="type" required>
                                            <option value="person" {{ old('type')=='person'?'selected':'' }}>@lang('app.txt.particulier')</option>
                                            <option value="organization" {{ old('type')=='organization'?'selected':'' }}>@lang('app.txt.organisation')</option>
                                        </select>
                                    </div>
                                </div>
                                <br> --}}

                                {{-- Form for particulier --}}
                                <form {{ old('type')=='person'?'': (old('type')=='organization'?'hidden="hidden"':'') }} class="form-horizontal" role="form" id="particulierForm" action="{{$action}}" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type="hidden" name="type" value="person">
                                    <input type="hidden" name="is_complete" value="1">

                                    {{-- Login Information --}}
                                    <fieldset>
                                        <legend>@lang('app.txt.logininfo')</legend>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="name">@lang('app.txt.login') *</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Votre nom d'utilisateur" value="{{ old('name')?old('name'):'' }}" required>
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="email">@lang('app.txt.email') *</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="email" name="email" placeholder="you@exemple.com" value="{{ old('email')?old('email'):'' }}" required>
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="language" class="col-sm-12 control-label" for="language">@lang('app.language') *</label>
                                            <div class="col-md-12">
                                                <select class="form-control" name="language">
                                                    <option value="fr" {{ old('language')? (old('language')=='fr'?'selected':'') : (app()->getLocale()=='fr'? 'selected' : '') }}>@lang('app.txt.francais')</option>
                                                    <option value="en" {{ old('language')? (old('language')=='en'?'selected':'') : (app()->getLocale()=='en'? 'selected' : '') }}>@lang('app.txt.anglais')</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="country" class="col-sm-3 control-label">@lang('app.txt.pays') *</label>
                                            <div class="col-md-12">
                                                <select class="form-control" name="country" required>
                                                    <option value="" selected disabled>@lang('app.select_country')</option>
                                                    @foreach($countries as $country)
                                                    <option value="{{$country->code}}" {{ old('country')==$country->code?'selected':'' }}> {{$country->content}} ({{$country->code}})</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">{{ $errors->first('country') }}</span>
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
                                            <label for="sexe" class="col-sm-3 control-label">@lang('app.txt.sexe') *</label>
                                            <div class="col-md-12">
                                                <select class="form-control" name="sexe" required>
                                                    <option value="" selected disabled>@lang('app.txt.select_sexe')</option>
                                                    <option value="M" {{ old('sexe')=='M'?'selected':'' }}>@lang('app.txt.male')</option>
                                                    <option value="F" {{ old('sexe')=='F'?'selected':'' }}>@lang('app.txt.female')</option>
                                                </select>
                                                <span class="text-danger">{{ $errors->first('sexe') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="image"> @lang('app.txt.avatar') </label>
                                            <div class="input-group mb-3 col-md-12">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">@lang('app.txt.upload')</span>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input inputGroupFile" name="image" id="image">
                                                    <label class="custom-file-label inputGroupFileName" for="inputGroupFile01">@lang('app.txt.choose_avatar')</label>
                                                </div>
                                                <span class="text-danger">{{ $errors->first('image') }}</span>
                                            </div>
                                        </div>
                                    </fieldset>

                                    {{-- Member Identity --}}
                                    <fieldset class="m-25px-t">
                                        <legend> @lang('member.member_identity') </legend>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="civility">@lang('app.txt.civility') *</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" name="civility" required>
                                                    <option value="" selected disabled>@lang('app.txt.choose_civility')</option>
                                                    <option value="mr" {{ old('civility')=='mr'? 'selected' : '' }}>@lang('app.txt.mr')</option>
                                                    <option value="mrs" {{ old('civility')=='mrs'? 'selected' : '' }}>@lang('app.txt.mrs')</option>
                                                </select>
                                                <span class="text-danger">{{ $errors->first('civility') }}</span>
                                            </div>
                                        </div>
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
                                    </fieldset>
                                    
                                    <div class="form-group m-25px-tb">
                                        <div class="col-sm-offset-3 col-sm-12">
                                            <div class="form-group m-50px-t">
                                                <div class="row col-lg-12">
                                                    <div class="col-lg-2">
                                                        <select name="newsletter" class="form-control">
                                                            <option value="" selected disabled>@lang('app.txt.select')</option>
                                                            <option value="yes" {{ old('newsletter')=='yes'?'selected':'' }}>@lang('app.txt.yes')</option>
                                                            <option value="no" {{ old('newsletter')=='no'?'selected':'' }}>@lang('app.txt.no')</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <label class="control-label" for="newsletter">@lang('app.form.register.newsletter')</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group m-50px-t">
                                                <div class="row col-lg-12">
                                                    <div class="col-lg-2">
                                                        <select name="allow_sharing" class="form-control">
                                                            <option value="" selected disabled>@lang('app.txt.select')</option>
                                                            <option value="yes" {{ old('allow_sharing')=='yes'?'selected':'' }}>@lang('app.txt.yes')</option>
                                                            <option value="no" {{ old('allow_sharing')=='no'?'selected':'' }}>@lang('app.txt.no')</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <label class="control-label" for="newsletter">@lang('app.form.register.shareinfo')</label>
                                                    </div>
                                                </div>
                                            </div>
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
                                                <input type="checkbox" class="custom-control-input" name="politic" id="checkbox-3" required>
                                                <label class="custom-control-label" for="checkbox-3"><b>@lang('app.form.register.politic') *</b></label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="condition" id="checkbox-4" required>
                                                <label class="custom-control-label" for="checkbox-4"><b>@lang('app.form.register.condition') *</b></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <button type="submit" class="m-btn m-btn-theme" id="btn_member_part_register"> @lang('app.btn.validerinscription') </button>
                                        </div>
                                    </div>
                                </form>

                                {{-- Form for organisation --}}
                                <form  {{ old('type')=='organization'?'':'hidden' }} class="form-horizontal" role="form" action="{{$action}}" id="organisationForm" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type="hidden" name="type" value="organization">
                                    
                                    {{-- Login Information --}}
                                    <fieldset>
                                        <legend> @lang('app.txt.logininfo') </legend>
                                        <div class="form-group">
                                            <label class="col-sm-12 control-label" for="name">@lang('app.txt.login') *</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="name_2" name="name" placeholder="@lang('app.txt.login')" value="{{ old('name') ? old('name') : '' }}" required>
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-12 control-label" for="email">@lang('app.txt.email') *</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="email_2" name="email" placeholder="you@exemple.com" value="{{ old('email') ? old('email') : '' }}" required>
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="orga_phone" class="col-sm-12 control-label">@lang('app.txt.businessphone') *</label>
                                            <div class="input-group mb-3 col-sm-12">
                                                <div class="input-group-prepend">
                                                    <select class="form-control" name="indicatif" id="indicatif">
                                                        @foreach (App\Models\Indicatif::all() as $indicatif)
                                                            <option value="+{{ $indicatif->code }}" {{ $indicatif->code=='61'?'selected':'' }}>(+ {{ $indicatif->code }}) </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="text" pattern="[0-9]{1}[0-9]{7|8}" minlength="6" maxlength="9" placeholder="XXXXXXXX" class="form-control m-15px-t" id="orga_phone" name="orga_phone" value="{{ old('orga_phone')?old('orga_phone'):'' }}" required>
                                                </div>
                                            </div>
                                            <span class="text-danger m-5px-l">{{ $errors->first('orga_phone') }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="orga_fax" class="col-sm-12 control-label"> @lang('app.txt.businessfax') </label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="orga_fax" value="{{ old('orga_fax')?old('orga_fax'):'' }}">
                                                <span class="text-danger">{{ $errors->first('orga_fax') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="orga_mobile_phone" class="col-sm-12 control-label">@lang('app.txt.businessmobile') *</label>
                                            <div class="input-group mb-3 col-sm-12">
                                                <div class="input-group-prepend">
                                                    <select class="form-control" name="indicatif" id="indicatif">
                                                        @foreach (App\Models\Indicatif::all() as $indicatif)
                                                            <option value="+{{ $indicatif->code }}" {{ $indicatif->code=='61'?'selected':'' }}>(+ {{ $indicatif->code }}) </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="text" pattern="[0-9]{1}[0-9]{7|8}" minlength="6" maxlength="9" placeholder="XXXXXXXX" class="form-control m-15px-t" id="orga_mobile_phone" name="orga_mobile_phone" value="{{ old('orga_mobile_phone')?old('orga_mobile_phone'):'' }}" required>
                                                </div>
                                            </div>
                                            <span class="text-danger m-5px-l">{{ $errors->first('orga_mobile_phone') }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="language" class="col-sm-12 control-label" for="language">@lang('app.txt.langage') *</label>
                                            <div class="col-md-12">
                                                <select class="form-control" name="language">
                                                    <option value="fr" {{ old('language')? (old('language')=='fr'?'selected':'') : (app()->getLocale()=='fr'? 'selected' : '') }}>@lang('app.txt.francais')</option>
                                                    <option value="en" {{ old('language')? (old('language')=='en'?'selected':'') : (app()->getLocale()=='en'? 'selected' : '') }}>@lang('app.txt.anglais')</option>
                                                </select>
                                            </div>
                                        </div>                                        
                                    </fieldset>

                                    {{-- Organization Details --}}
                                    <fieldset class="m-25px-t">
                                        <legend>@lang('app.txt.organization_details')</legend>
                                        <div class="form-group">
                                            <label for="orga_name" class="col-sm-3 control-label"> @lang('app.txt.nom.organisation') *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="orga_name" value="{{ old('orga_name')?old('orga_name'):'' }}" required>
                                                <span class="text-danger">{{ $errors->first('orga_name') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="orga_registration_number" class="col-sm-12 control-label">@lang('app.txt.organizationregistrationnumber') *</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="orga_registration_number" name="orga_registration_number" placeholder="@lang('app.txt.organizationregistrationnumber.input')" value="{{ old('orga_registration_number')?old('orga_registration_number'):'' }}" required>
                                                <span class="text-danger">{{ $errors->first('orga_registration_number') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="orga_rep_official_registration" class="col-sm-12 control-label">@lang('app.txt.organizationrepregistrationofficial')</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="orga_rep_official_registration" name="orga_rep_official_registration" placeholder="@lang('app.txt.organizationrepregistrationofficial')" value="{{ old('orga_rep_official_registration')?old('orga_rep_official_registration'):'' }}">
                                                <span class="text-danger">{{ $errors->first('orga_rep_official_registration') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="orga_type" class="col-sm-12 control-label">@lang('app.txt.type_of_organization') *</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="orga_type" name="orga_type" required>
                                                    <option value="" selected disabled>@lang('app.form.choix_txt')</option>
                                                    <option value="public" {{ old('orga_type')=='public'?'selected':'' }}>@lang('member.public_organization')</option>
                                                    <option value="private" {{ old('orga_type')=='private'?'selected':'' }}>@lang('member.private_entreprise')</option>
                                                    <option value="mixte" {{ old('orga_type')=='mixte'?'selected':'' }}>@lang('member.mixed_organization')</option>
                                                </select>
                                                <span class="text-danger">{{ $errors->first('orga_type') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group" id="orgaForm" {{ old('orga_type')=='private'?'': 'hidden="hidden"'}} >
                                            <label for="orga_form" class="col-sm-12 control-label">@lang('app.txt.company_form') *</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="orga_form" name="orga_form">
                                                    <option value="" selected disabled>@lang('app.form.choix_txt')</option>
                                                    <option value="sarl" {{ old('orga_form')=='sarl'?'selected':'' }}>SARL</option>
                                                    <option value="sa" {{ old('orga_form')=='sa'?'selected':'' }}>SA</option>
                                                    <option value="other" {{ old('orga_form')=='other'?'selected':'' }}>@lang('app.txt.other')</option>
                                                </select>
                                                <span class="text-danger">{{ $errors->first('orga_form') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group" id="defineOrgaForm" {{ old('orga_form')=='other'?'': 'hidden="hidden"'}}>
                                            <label for="define_orga_form" class="col-sm-12 control-label">@lang('app.txt.define') *</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="define_orga_form" placeholder="@lang('app.txt.define')" value="{{ old('define_orga_form')?old('define_orga_form'):'' }}">
                                                <span class="text-danger">{{ $errors->first('define_orga_form') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group" id="orgaFormMixte" {{ old('orga_type')=='mixte'?'': 'hidden="hidden"'}} >
                                            <label for="orga_form" class="col-sm-12 control-label">@lang('app.txt.company_form') *</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="orga_form_mixte" name="orga_form">
                                                    <option value="" selected disabled>@lang('app.form.choix_txt')</option>
                                                    <option value="saem" {{ old('orga_form')=='saem'?'selected':'' }}>SAEM</option>
                                                    <option value="other" {{ old('orga_form')=='other'?'selected':'' }}>@lang('app.txt.other')</option>
                                                </select>
                                                <span class="text-danger">{{ $errors->first('orga_form_mixte') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group" id="defineOrgaFormMixte" {{ old('orga_form')=='other'?'': 'hidden="hidden"'}}>
                                            <label for="define_orga_form" class="col-sm-12 control-label">@lang('app.txt.define') *</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="define_orga_form_mixte" placeholder="@lang('app.txt.define')" value="{{ old('define_orga_form')?old('define_orga_form'):'' }}">
                                                <span class="text-danger">{{ $errors->first('define_orga_form') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="orga_presentation" id="orga_presentation_label" class="col-sm-12 control-label">@lang('app.txt.presentation.organisation')</label>
                                            <div class="col-sm-12">
                                                <textarea class="form-control" maxlength="2000" id="orga_presentation" name="orga_presentation" placeholder="@lang('app.txt.presentation.organisation')" rows="10">{{ old('orga_presentation')?old('orga_presentation'):'' }}</textarea>
                                                <span class="text-danger">{{ $errors->first('orga_presentation') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="image" id="orga_logo_label"> @lang('app.txt.logo.organisation')</label>
                                            <div class="input-group mb-3 col-md-9">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">@lang('app.txt.upload')</span>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input inputGroupFile02" id="inputGroupFile02" name="image">
                                                    <label class="custom-file-label inputGroupFileName02" id="orga_logo_upload_label" for="inputGroupFile02">@lang('app.txt.logo.organisation.libelle')</label>
                                                </div>
                                                <span class="text-danger">{{ $errors->first('image') }}</span>
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
                                                <label for="adrpost_postal_box" class="col-sm-12 control-label">@lang('app.txt.postal_box') *</label>
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
                                            <div class="input-group mb-3 col-sm-12">
                                                <div class="input-group-prepend">
                                                    <select class="form-control" name="indicatif" id="indicatif">
                                                        @foreach (App\Models\Indicatif::all() as $indicatif)
                                                            <option value="+{{ $indicatif->code }}" {{ $indicatif->code=='61'?'selected':'' }}>(+ {{ $indicatif->code }}) </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="text" pattern="[0-9]{1}[0-9]{7|8}" minlength="6" maxlength="9" placeholder="XXXXXXXX" class="form-control m-15px-t" id="contact_phone" name="contact_phone" value="{{ old('contact_phone')?old('contact_phone'):'' }}" required>
                                                </div>
                                            </div>
                                            <span class="text-danger m-5px-l">{{ $errors->first('contact_phone') }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_email" class="col-sm-12 control-label">@lang('app.txt.contactemailaddress') *</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="contact_email" name="contact_email" placeholder="@lang('app.txt.contactemailaddress')" value="{{ old('contact_email')?old('contact_email'):'' }}" required>
                                                <span class="text-danger">{{ $errors->first('contact_email') }}</span>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="form-group m-25px-t">
                                        <div class="col-sm-offset-3 col-sm-12">
                                            <div class="form-group m-50px-t">
                                                <div class="row col-lg-12">
                                                    <div class="col-lg-2">
                                                        <select name="newsletter" class="form-control" required>
                                                            <option value="" selected disabled>@lang('app.txt.select')</option>
                                                            <option value="yes" {{ old('allow_sharing')=='yes'?'selected':'' }}>@lang('app.txt.yes')</option>
                                                            <option value="no" {{ old('allow_sharing')=='no'?'selected':'' }}>@lang('app.txt.no')</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <label class="control-label" for="newsletter">@lang('app.form.register.newsletter')</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group m-50px-t">
                                                <div class="row col-lg-12">
                                                    <div class="col-lg-2">
                                                        <select name="allow_sharing" class="form-control" required>
                                                            <option value="" selected disabled>@lang('app.txt.select')</option>
                                                            <option value="yes" {{ old('allow_sharing')=='yes'?'selected':'' }}>@lang('app.txt.yes')</option>
                                                            <option value="no" {{ old('allow_sharing')=='no'?'selected':'' }}>@lang('app.txt.no')</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <label class="control-label" for="newsletter">@lang('app.form.register.shareinfo')</label>
                                                    </div>
                                                </div>
                                            </div>
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
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <button type="submit" class="m-btn m-btn-theme" id="btn_member_org_register">@lang('app.btn.register')</button>
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
@endsection

@push('script')
    <script src="{{asset('js/myJs.js')}}"></script>
    <!-- Jquery Validate -->
<script src="{{ asset('administrator/js/plugins/validate/jquery.validate.min.js') }}"></script>
<script>
    $.validator.addMethod('le', function (value, element, param) {
        return this.optional(element) || value !== $(param).val();
    }, '@lang("app.txt.invalid_value")');

    $('#particulierForm').validate({
        ignore: [],
        rules: {
            name: {
                required: {
                    depends: function(element) {
                        if($("#particulierForm").is(":visible")){
                            return true;	
                        }
                    }
                },
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
                required: {
                    depends: function(element) {
                        if($("#particulierForm").is(":visible")){
                            return true;	
                        }
                    }
                },
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
            country: {
                required: true,
            },
            nationality: {
                required: true,
            },
            sexe: {
                required: true,
            },
            civility: {
                required: true,
            },
            last_name: {
                required: true,
            },
            first_name: {
                required: true,
            },
            newsletter: {
                required: {
                    depends: function(element) {
                        if($("#particulierForm").is(":visible")){
                            return true;	
                        }
                    }
                },
            },
            allow_sharing: {
                required: {
                    depends: function(element) {
                        if($("#particulierForm").is(":visible")){
                            return true;	
                        }
                    }
                },
            },
            politic: {
                required: {
                    depends: function(element) {
                        if($("#particulierForm").is(":visible")){
                            return true;	
                        }
                    }
                },
            },
            condition: {
                required: {
                    depends: function(element) {
                        if($("#particulierForm").is(":visible")){
                            return true;	
                        }
                    }
                },
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
            nationality: {
                required: "@lang('app.txt.champobligatoire')",
            },
            sexe: {
                required: "@lang('app.txt.champobligatoire')",
            },
            civility: {
                required: "@lang('app.txt.champobligatoire')",
            },
            last_name: {
                required: "@lang('app.txt.champobligatoire')",
            },
            first_name: {
                required: "@lang('app.txt.champobligatoire')",
            },
            newsletter: {
                required: "@lang('app.txt.champobligatoire')",
            },
            allow_sharing: {
                required: "@lang('app.txt.champobligatoire')",
            },
            politic: {
                required: "@lang('app.txt.champobligatoire')",
            },
            condition: {
                required: "@lang('app.txt.champobligatoire')"
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

    $('#particulierForm').submit(function() { // fires on every keyup & blur
        if ($('#particulierForm').valid()) {  // checks form for validity
            sessionStorage.removeItem('member_type');

            // set btn submit to loading btn
            $('#btn_member_part_register').attr('disabled','disabled');
            $('#btn_member_part_register').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>@lang("app.txt.loading")');
        } else {
            $('btn_member_part_register').prop('disabled', false);   // enable button
            $('#btn_member_part_register').html('@lang("app.btn.register")');
        }
    });

    $('#organisationForm').validate({
        ignore: [],
        rules: {
            name: {
                required: {
                    depends: function(element) {
                        if($("#organisationForm").is(":visible")){
                            return true;	
                        }
                    }
                },
                remote: {
                    url: "{{ route('ajaxCheckLogin') }}",
                    type: "get",
                    data: {
                        name: function () {
                            return $("input[id='name_2']").val();
                        }
                    }
                }
            },
            email: {
                required: {
                    depends: function(element) {
                        if($("#organisationForm").is(":visible")){
                            return true;	
                        }
                    }
                },
                email:true,
                remote: {
                    url: "{{ route('ajaxCheckEmail') }}",
                    type: "get",
                    data: {
                        email: function () {
                            return $("input[id='email_2']").val();
                        }
                    }
                }
            },
            orga_phone: {
                required: true,
                number:true,
                minlength:6,
                maxlength:9,
            },
            orga_mobile_phone: {
                required: true,
                number:true,
                minlength:6,
                maxlength:9,
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
                        if($("#orgaForm").is(":visible") || $("#orga_form_mixte").is(":visible")){
                            return true;	
                        }
                    }
                }
            },
            orga_presentation: {
                maxlength:1000,
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
            adrpost_postal_box: {
                number:true,
                required: {
                    depends: function(element) {
                        if($("#postalAddress").is(":visible")){
                            return true;	
                        }
                    }
                }
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
            contact_phone: {
                required: true,
                number:true,
                minlength: 6,
                maxlength: 9,
            },
            contact_email: {
                required: true,
                email:true,
            },
            newsletter: {
                required: {
                    depends: function(element) {
                        if($("#organisationForm").is(":visible")){
                            return true;	
                        }
                    }
                },
            },
            allow_sharing: {
                required: {
                    depends: function(element) {
                        if($("#organisationForm").is(":visible")){
                            return true;	
                        }
                    }
                },
            },
            politic: {
                required: {
                    depends: function(element) {
                        if($("#organisationForm").is(":visible")){
                            return true;	
                        }
                    }
                },
            },
            condition: {
                required: {
                    depends: function(element) {
                        if($("#organisationForm").is(":visible")){
                            return true;	
                        }
                    }
                },
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
            orga_phone: {
                required: "@lang('app.txt.champobligatoire')",
            },
            orga_mobile_phone: {
                required: "@lang('app.txt.champobligatoire')",
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
            orga_presentation: {
                maxlength:1000,
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
            adrpost_postal_box: {
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
            contact_phone: {
                required: "@lang('app.txt.champobligatoire')",
            },
            contact_email: {
                required: "@lang('app.txt.champobligatoire')",
            },
            newsletter: {
                required: "@lang('app.txt.champobligatoire')",
            },
            allow_sharing: {
                required: "@lang('app.txt.champobligatoire')",
            },
            politic: {
                required: "@lang('app.txt.champobligatoire')"
            },
            condition: {
                required: "@lang('app.txt.champobligatoire')"
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

    $('#organisationForm').submit(function() { // fires on every keyup & blur
        if ($('#organisationForm').valid()) {                 // checks form for validity
            sessionStorage.removeItem('member_type');
            // set btn submit to loading btn
            $('#btn_member_org_register').attr('disabled','disabled');
            $('#btn_member_org_register').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>@lang("app.txt.loading")');
        } else {
            $('btn_member_org_register').prop('disabled', false);   // enable button
            $('#btn_member_org_register').html('@lang("app.btn.register")');
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
        $(document).ready(function(){
            $('#chooseTypeMemberModal').modal('show');

            $('#engagementForm').validate({
                ignore: [],
                rules: {
                    checkbox_1: {
                        required: true,
                    },
                    checkbox_2: {
                        required: true,
                    },
                },
                messages: {
                    checkbox_1: {
                        required: "@lang('app.txt.champobligatoire')",
                    },
                    checkbox_2: {
                        required: "@lang('app.txt.champobligatoire')",
                    },
                },
                errorPlacement: function ( error, element ) {
                    if(element.parent().hasClass('input-group')){
                        error.insertAfter( element.parent() );
                    }else{
                        error.insertBefore( element );
                    }
                },
            });
            $('#engagementForm').submit(function(e) { // fires on every keyup & blur
                e.preventDefault();
                loadingPage();
                if ($('#engagementForm').valid()) {                 // checks form for validity
                    setInterval(() => {
                        stopLoadingPage();
                        $('#myModal').modal('hide');
                    }, 1000);
                }else{
                    stopLoadingPage();
                }
            });
        });

        //fermeture du modal choix type member
        $("#custom-continue").on('click', function() {
            $('#chooseTypeMemberModal').modal('hide');
            setTimeout(() => {
                if(sessionStorage.getItem('member_type') === 'person'){
                    $('#myModal .modal-title').html('{{ strtoupper(trans("app.txt.inscription.membre.person.engagement.title")) }}');
                }else{
                    $('#myModal .modal-title').html('{{ strtoupper(trans("app.txt.inscription.membre.organization.title")) }}');
                }

                $('#myModal .modal-body form').html('');
                $('#myModal .modal-body form').append('<p class="h4">{{ trans("member.condition.point_1") }}</p>');
                $('#myModal .modal-body form').append('<p>{!! trans("member.condition.point_1.content") !!}</p>');
                $('#myModal .modal-body form').append('<p><input type="checkbox" name="checkbox_1"> {{ trans("app.txt.agree") }} *</p>');
                $('#myModal .modal-body form').append('<p class="h4">{{ trans("member.condition.point_2") }}</p>');
                $('#myModal .modal-body form').append('<p>{!! trans("member.condition.point_2.content") !!}</p>');
                $('#myModal .modal-body form').append('<p><input type="checkbox" name="checkbox_2"> {{ trans("app.txt.agree") }} *</p><hr>');
                $('#myModal .modal-body form').append('<div class="pull-right"><a type="button" class="m-btn m-btn-theme" href={{ route("home") }}>{{trans("app.btn.abandonner")}}</a>'+
                '<a href="#section1" id="custom-close2"><input type="submit" class="m-btn m-btn-theme2nd m-10px-l" value={{trans("app.btn.continuer")}}></a></div>');
                $('#myModal').modal('show');
            }, 500);
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
        // Show default form (particularForm or organizationForm)
        $(function(){
            showForm();
        });

        $('#type').change(function(){
            var val = $(this).val();
            if(val!='person'){
                sessionStorage.setItem('member_type','organization');
                $('#organisationForm').removeAttr('hidden');
                $('#particulierForm').attr('hidden','hidden');
                $('.title-form').html('<h2>{{ strtoupper(trans("app.txt.inscription.membre.organization.title")) }}</h2> ');
            }else{
                sessionStorage.setItem('member_type','person');
                $('#organisationForm').attr('hidden','hidden');
                $('#particulierForm').removeAttr('hidden');
                $('.title-form').html('<h2>{{ strtoupper(trans("app.txt.inscription.membre.person.title")) }}</h2> ');
            }            
        });

        function showForm(){
            if(sessionStorage.getItem('member_type')!=='person'){
                $("#type option:eq(1)").prop('selected',true);
                $('#organisationForm').removeAttr('hidden');
                $('#particulierForm').attr('hidden','hidden');
                $('.title-form').html('<h2>{{ strtoupper(trans("app.txt.inscription.membre.organization.title")) }}</h2> ');
            }else{
                $("#type option:eq(0)").prop('selected',true);
                $('#organisationForm').attr('hidden','hidden');
                $('#particulierForm').removeAttr('hidden');
                $('.title-form').html('<h2>{{ strtoupper(trans("app.txt.inscription.membre.person.title")) }}</h2> ');
            }
        }
    </script>

    {{-- Google map location --}}
    <script>
        $('form').on('change','.country-select',function(){
            var country_code = $(this).val();

            if(country_code=='AUS'){
                $('#countrySelectModal').modal('show');
            }

            // renitialise localization info input
            $('#latitude').val('');
            $('#longitude').val('');
            $('#postalCode').val('');
            $('#locality').val('');
            $('#area_level_1').val('');
        })
    </script>
    <script type="text/javascript">
        var _map;
        var _lat = -25.363;
        var _long = 131.044;
        var geocoder;

        function initMap() {
            var myLatlng = new google.maps.LatLng(-25.363882,131.044922);
                geocoder = new google.maps.Geocoder();
            
            _map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: _lat, lng:  _long},
                zoom: 4
            });

            // Place a draggable marker on the map
            var marker = new google.maps.Marker({
                position: {lat: _lat, lng:  _long},
                map: _map,
                draggable:true,
                title:"{{ trans('app.txt.choose_position') }}"
            });

            // Get info with marker drag
            // Update current position info.
            updateMarkerPosition(myLatlng);
            geocodePosition(myLatlng);
            
            // Add dragging event listeners.
            google.maps.event.addListener(marker, 'dragstart', function() {
                updateMarkerAddress('{{ trans("app.txt.marker.dragging") }}...');
            });
            
            google.maps.event.addListener(marker, 'drag', function() {
                updateMarkerStatus('{{ trans("app.txt.marker.dragging") }}...');
                updateMarkerPosition(marker.getPosition());
            });
            
            google.maps.event.addListener(marker, 'dragend', function() {
                updateMarkerStatus('{{ trans("app.txt.marker.drag_ended") }}');
                geocodePosition(marker.getPosition());
            });
            
            
            // Onload handler to fire off the app.
            // google.maps.event.addDomListener(window, 'load', initialize);
            // End Get info with marker drag
        }
        
        function geocodePosition(pos) {
            geocoder.geocode({
                latLng: pos
            }, function(responses) {
                if (responses && responses.length > 0) {
                updateMarkerAddress(responses[0].formatted_address);
                } else {
                updateMarkerAddress("{{ trans('app.txt.marker.cannot_determine_address') }}");
                }
            });
        }
        
        function updateMarkerStatus(str) {
            document.getElementById('markerStatus').innerHTML = str;
        }
        
        function updateMarkerPosition(latLng) {
            document.getElementById('info').innerHTML = [
                latLng.lat(),
                latLng.lng()
            ].join(', ');
        }
        
        function updateMarkerAddress(str) {
            document.getElementById('address').innerHTML = str;
        }
    </script>
    <script type="text/javascript">
        $('#btn_save').click(function(){
            var latLong = $('#info').text();
            var adr = ($('#address').text()).split(',');
            var lat=0;long = 0;
            var state,postalCode,locality="";

            switch (adr.length) {
                case 3:
                    var adrInfo = adr[1].split(' ');
                    lat = latLong.split(',')[0];            
                    long = latLong.split(',')[1];
                    postalCode = adrInfo[(adrInfo.length)-1];
                    state = adrInfo[(adrInfo.length)-2];

                    // set locality
                    for(var i=0;i<adrInfo.length-2;i++){
                        if(adrInfo[i].length !== 0){
                            locality+=adrInfo[i]+' ';
                        }
                    }

                    $('#countrySelectModal').modal('hide');

                    break;

                case 2:
                    var adrInfo = adr[0].split(' ');
                    lat = latLong.split(',')[0];            
                    long = latLong.split(',')[1];
                    postalCode = adrInfo[(adrInfo.length)-1];
                    state = adrInfo[(adrInfo.length)-2];

                    // set locality
                    for(var i=0;i<adrInfo.length-2;i++){
                        if(adrInfo[i].length !== 0){
                            locality+=adrInfo[i]+' ';
                        }
                    }

                    $('#countrySelectModal').modal('hide');
                    
                    break;
            
                default:
                    alert("{{ trans('app.txt.choose_position_exacte') }}");
                    break;
            }
            
            // set localisation input info
            $('#latitude').val(lat);
            $('#longitude').val(long);
            $('#postalCode').val(postalCode);
            $('#locality').val(locality);
            $('#area_level_1').val(state);
        });

    </script>
    {{-- Fin google map location --}}
    
    <script>
        function resetOrgaForm(){
            $('#orgaForm').attr('hidden','hidden');
            $('#defineOrgaForm').attr('hidden','hidden');
            $('#define_orga_form').val('');
            $('#orga_form option:eq(0)').prop('selected', true);
            $('#orga_form').removeAttr('name');
            $('#define_orga_form').removeAttr('name');
        }

        function resetOrgaFormMixte(){
            $('#orgaFormMixte').attr('hidden','hidden');
            $('#defineOrgaFormMixte').attr('hidden','hidden');
            $('#define_orga_form_mixte').val('');
            $('#orga_form_mixte option:eq(0)').prop('selected', true);
            $('#orga_form_mixte').removeAttr('name');
            $('#define_orga_form_mixte').removeAttr('name');
        }

        $('#orga_type').change(function(){
            if($(this).val() === $("#orga_type option:eq(2)").val()){
                $('#orgaForm').removeAttr('hidden');
                $('#orga_form').attr('name','orga_form');

                // update orga presentation label
                $('#orga_presentation_label').html('{{ trans("app.txt.presentation.entreprise") }}');
                $('#orga_presentation').html('{{ trans("app.txt.presentation.entreprise") }}');
                $('#orga_logo_label').html('{{ trans("app.txt.businesslogo") }}');
                $('#orga_logo_upload_label').html('{{ trans("app.txt.logo.entreprise.libelle") }}');

                // Reinitialize orgaFormMixte
                resetOrgaFormMixte();
                
            }else if($(this).val() === $("#orga_type option:eq(3)").val()){
                $('#orgaFormMixte').removeAttr('hidden');
                $('#orga_form_mixte').attr('name','orga_form');

                // update orga presentation label
                $('#orga_presentation_label').html('{{ trans("app.txt.presentation.organisation") }}');
                $('#orga_presentation').html('{{ trans("app.txt.presentation.organisation") }}');
                $('#orga_logo_label').html('{{ trans("app.txt.logo.organisation") }}');
                $('#orga_logo_upload_label').html('{{ trans("app.txt.logo.organisation.libelle") }}');

                // Reinitialize orgaForm
                resetOrgaForm();
            }
            else{
                // Reinitialize orgaForm
                resetOrgaForm();

                // update orga presentation label
                $('#orga_presentation_label').html('{{ trans("app.txt.presentation.organisation") }}');
                $('#orga_presentation').html('{{ trans("app.txt.presentation.organisation") }}');
                $('#orga_logo_label').html('{{ trans("app.txt.logo.organisation") }}');
                $('#orga_logo_upload_label').html('{{ trans("app.txt.logo.organisation.libelle") }}');
                
                // Reinitialize orgaFormMixte
                resetOrgaFormMixte();
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

        $('#orga_form_mixte').change(function(){
            $('#define_orga_form_mixte').val('');
            
            if($(this).val() === $("#orga_form_mixte option:eq(2)").val()){
                $(this).removeAttr('name');
                $('#defineOrgaFormMixte').removeAttr('hidden');
                $('#define_orga_form_mixte').attr('name','orga_form');
            }else{
                $(this).attr('name','orga_form');
                $('#defineOrgaFormMixte').attr('hidden','hidden');
                $('#define_orga_form_mixte').removeAttr('name');
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