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

<div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
      <div class="modal-content white-bg">
          <div class="modal-header border-radius-0" style="background-color: #AE4435 !important;">
              <h4 class="modal-title white-color">{{$page->title}}</h4>
          </div>
          <div class="modal-body">
              <p class="text-justify">{{$page->content}}</p>
          </div>
          <div class="modal-footer">
              <a type="button" class="pull-left m-btn m-btn-theme" href="javascript:history.back()">@lang('app.btn.abandonner')</a>
              <a type="button" class="m-btn m-btn-theme2nd" href="#section1" id="custom-close">@lang('app.btn.continuer')</a>
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
                                        <div class="jumbotron"> 
                                                <h2>@lang('app.txt.inscription.membre.title')</h2> 
                                        </div>                     
                                    </div>                 
                                </div>             
                            </div>
                            <div class="panel-body">
                                @include('includes.alerts')
                                <div class="row">
                                    <label for="type" class="col-sm-3 control-label">@lang('app.txt.typemembre') *</label>
                                    <div class="col-md-3">
                                        <select name="type" class="form-control" id="type" required>
                                            <option value="person" selected>@lang('app.txt.particulier')</option>
                                            <option value="organization">@lang('app.txt.organisation')</option>
                                        </select>
                                    </div>
                                </div>
                                <br>

                                {{-- Form for particulier --}}
                                <form class="form-horizontal" role="form" id="particulierForm" action="{{$action}}" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type="hidden" name="type" value="person">
                                    <fieldset>
                                        <legend>@lang('app.txt.logininfo')</legend>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="name">@lang('app.txt.login') *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Votre nom d'utilisateur" required>
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="email">@lang('app.txt.email') *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="email" name="email" placeholder="you@exemple.com" required>
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="language" class="col-sm-3 control-label" for="language">@lang('app.txt.langage') *</label>
                                            <div class="col-md-3">
                                                <select class="form-control" name="language">
                                                    <option value="fr">@lang('app.txt.francais')</option>
                                                    <option value="en">@lang('app.txt.anglais')</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="country" class="col-sm-3 control-label">@lang('app.txt.pays') *</label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="country">
                                                    <option value="0">@lang('app.select_country')</option>
                                                    @foreach($countries as $country)
                                                    <option value="{{$country->id}}"> {{$country->content}} ({{$country->code}})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="image"> @lang('app.txt.avatar') </label>
                                            <div class="col-md-9">
                                                <input type="file" class="m-btn m-btn-theme" name="image" id="image">
                                                <p class="help-block">
                                                    @lang('app.txt.avatar.libelle')
                                                </p>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend> @lang('app.txt.userinfo') </legend>
                                        <div class="form-group">
                                            <label for="first_name" class="col-sm-3 control-label">@lang('app.txt.nom') *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="first_name">
                                                <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="last_name">@lang('app.txt.prenom') *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"  name="last_name" required>
                                                <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sexe" class="col-sm-3 control-label">@lang('app.txt.sexe') *</label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="sexe">
                                                    <option value="0" selected disabled>@lang('app.txt.select_sexe')</option>
                                                    <option value="M">@lang('app.txt.male')</option>
                                                    <option value="F">@lang('app.txt.female')</option>
                                                </select>
                                                <span class="text-danger">{{ $errors->first('sexe') }}</span>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <div class="checkbox">
                                                <p class="help-block">
                                                    <em>(*) @lang('app.txt.champobligatoire')</em>
                                                </p>
                                            </div>
                                            <div class="checkbox">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" name="newsletter" class="custom-control-input" id="shop-notification-1" checked="checked">
                                                    <label class="custom-control-label" for="shop-notification-1">@lang('app.form.register.newsletter')</label>
                                                </div>
                                            </div>
                                            <div class="checkbox">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" name="allow_sharing" class="custom-control-input" id="shop-notification-2">
                                                    <label class="custom-control-label" for="shop-notification-2">@lang('app.form.register.shareinfo')</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <button type="submit" class="m-btn m-btn-theme"> @lang('app.btn.validerinscription') </button>
                                        </div>
                                    </div>
                                </form>

                                {{-- Form for organisation --}}
                                <form hidden class="form-horizontal" role="form" action="{{$action}}" id="organisationForm" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type="hidden" name="type" value="organization">
                                    <fieldset>
                                        <legend> @lang('app.txt.logininfo') </legend>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="name">@lang('app.txt.login') *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="name" placeholder="Votre nom d'utilisateur" required>
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="email">@lang('app.txt.email') *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="email" placeholder="you@exemple.com" required>
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="language" class="col-sm-3 control-label" for="language">@lang('app.txt.langage') *</label>
                                            <div class="col-md-3">
                                                <select class="form-control" name="language">
                                                    <option value="fr">@lang('app.txt.francais')</option>
                                                    <option value="en">@lang('app.txt.anglais')</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Bussiness Detail</legend>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="image">@lang('app.txt.logo.organisation') *</label>
                                            <div class="col-md-9">
                                                <input type="file" class="m-btn m-btn-theme" name="image">
                                                <p class="help-block">
                                                @lang('app.txt.logo.organisation.libelle')
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="orga_name" class="col-sm-3 control-label"> @lang('app.txt.nom.organisation') </label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="orga_name" required>
                                                <span class="text-danger">{{ $errors->first('orga_name') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="orga_email" class="col-sm-3 control-label"> @lang('app.txt.email') </label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="orga_email" required>
                                                <span class="text-danger">{{ $errors->first('orga_email') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="orga_phone" class="col-sm-3 control-label"> @lang('app.txt.phone') </label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="orga_phone" required>
                                                <span class="text-danger">{{ $errors->first('orga_phone') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="orga_website" class="col-sm-3 control-label"> @lang('app.txt.websiteurl') </label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="orga_website" required>
                                                <span class="text-danger">{{ $errors->first('orga_website') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="orga_presentation" >@lang('app.txt.presentation.organisation') *</label>
                                            <div class="col-sm-9">
                                                <textarea  class="form-control" name="orga_presentation" rows="10" required></textarea>
                                                <span class="text-danger">{{ $errors->first('orga_presentation') }}</span>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend> @lang('app.txt.localisation') </legend>
                                        <div class="form-group">
                                            <label for="country" class="col-sm-3 control-label">@lang('app.txt.pays') *</label>
                                            <div class="col-md-9">
                                                <select class="form-control country-select" name="country">
                                                    <option value="0">@lang('app.select_country')</option>
                                                    @foreach($countries as $country)
                                                        @if($country->prefixPhone)
                                                            <option value="{{$country->id}}"> {{$country->content}} ({{$country->code}})</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="state">@lang('app.txt.etat') (@lang('app.txt.etat.libelle'))</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="area_level_1" id="area_level_1" >
                                                <span class="text-danger">{{ $errors->first('area_level_1') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="locality">@lang('app.txt.ville') *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="locality" id="locality" required>
                                                <span class="text-danger">{{ $errors->first('locality') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="postalCode">@lang('app.txt.codepostal') *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="postalCode" id="postalCode" required>
                                                <span class="text-danger">{{ $errors->first('postalCode') }}</span>
                                            </div>
                                        </div>
                                        <div>
                                            <input type="hidden" name="longitude" id="longitude">
                                            <input type="hidden" name="latitude" id="latitude">
                                        </div>
                                    </fieldset>
                                    <fieldset class="border-bottom-1 border-color-gray p-15px-b">
                                        <legend>@lang('app.txt.contactinfo')</legend>
                                        <div class="form-group">
                                            <label for="contact_name" class="col-sm-3 control-label"> @lang('app.txt.nom') </label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="contact_name" required>
                                                <span class="text-danger">{{ $errors->first('contact_name') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_email" class="col-sm-3 control-label"> @lang('app.txt.email') </label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="contact_email" required>
                                                <span class="text-danger">{{ $errors->first('contact_email') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="prefixPhone" class="col-sm-3 control-label">@lang('app.txt.contact.mobile') *</label>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <select class="form-control" name="prefixPhone">
                                                        <option value="0">@lang('app.select_phone')</option>
                                                        @foreach($countries as $country)
                                                            @if($country->prefixPhone)
                                                            <option value="{{$country->prefixPhone}}"> {{$country->prefixPhone}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control"  name="contact_phone" placeholder="3-333-333" required>
                                                    <span class="text-danger">{{ $errors->first('contact_phone') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <div class="checkbox">
                                                <p class="help-block">
                                                    <em>(*) @lang('app.txt.champobligatoire')</em>
                                                </p>
                                            </div>
                                            <div class="checkbox">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" name="newsletter" class="custom-control-input" id="shop-notification-3" checked="checked">
                                                    <label class="custom-control-label" for="shop-notification-3">@lang('app.form.register.newsletter')</label>
                                                </div>
                                            </div>
                                            <div class="checkbox">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" name="allow_sharing" class="custom-control-input" id="shop-notification-4">
                                                    <label class="custom-control-label" for="shop-notification-4">@lang('app.form.register.shareinfo')</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <button type="submit" class="m-btn m-btn-theme">@lang('app.btn.register')</button>
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
    <script type="text/javascript">
        $(document).ready(function(){
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
        $('#type').change(function(){
            var val = $(this).val();
            if(val!='person'){
                $('#organisationForm').removeAttr('hidden');
                $('#particulierForm').attr('hidden','hidden');
            }else{
                $('#organisationForm').attr('hidden','hidden');
                $('#particulierForm').removeAttr('hidden');
            }            
        });
    </script>
    <script>
        $('form').on('change','.country-select',function(){
            var country_id = $(this).val();

            if(country_id==12){
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
    <script type="text/javascript" src="{{ asset('/js/select-location-gmap.js') }}"></script>
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


    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRj7J_sOaCmFfSFNvUL7Z-NX3uUvG_FTA&callback=initMap"></script>
@endpush