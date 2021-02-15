@extends('admin.layouts.app')

@section('title', 'Configuration Social')

@section('breadcrumb')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>@lang('app.info_site')</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('V2/admin')}}">Accueil</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Configuration</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Paiement </strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Paiement <small>Mise à jour des informations</small></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <form method="post" action="{{route('admin.config.payment.update')}}">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <fieldset>
                                    <legend>@lang('app.inscription')</legend>
                                    <div class="form-group">
                                        <label for="trial_delay">@lang('app.trial_delay')</label>
                                        <input id="trial_delay" name="trial_delay"
                                               class="form-control"
                                               type="number"
                                               placeholder="@lang('app.placeholder.trial_delay')"
                                               value="{{old('trial_delay')?old('trial_delay'):
                                                    ($item->get_meta('trial_delay')?$item->get_meta('trial_delay')->value:'')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="disable_payed_inscription">@lang('app.disable_payed_inscription')</label>
                                        <input type="checkbox" name="disable_payed_inscription" id="disable_payed_inscription" value="1"
                                               {{old('disable_payed_inscription')?'checked':
                                               ($item->get_meta('disable_payed_inscription')&&$item->get_meta('disable_payed_inscription')->value?'checked':'')}}> @lang('app.placeholder.disable_payed_inscription')
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>@lang('app.reservation')</legend>
                                    <div class="form-group">
                                        <label for="percent_reservation">@lang('app.percent_reservation') %</label>
                                        <input id="percent_reservation" name="percent_reservation"
                                               class="form-control"
                                               type="number"
                                               step=".01"
                                               placeholder="@lang('app.placeholder.percent_reservation')"
                                               value="{{old('percent_reservation')?old('percent_reservation'):
                                                    ($item->get_meta('percent_reservation')?$item->get_meta('percent_reservation')->value:'')}}">
                                        <p class="help-box">@lang('app.percent.desc')</p>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>@lang('app.percent_presentation')</legend>
                                    <div class="form-group">
                                        <label for="percent_presentation_afa">@lang('app.percent_presentation_afa') %</label>
                                        <input id="percent_presentation_afa" name="percent_presentation_afa"
                                               class="form-control"
                                               type="number"
                                               step=".01"
                                               placeholder="@lang('app.placeholder.percent_presentation_afa')"
                                               value="{{old('percent_presentation_afa')?old('percent_presentation_afa'):
                                                    ($item->get_meta('percent_presentation_afa')?$item->get_meta('percent_presentation_afa')->value:'')}}">
                                        <p class="help-box">@lang('app.percent.desc')</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="percent_presentation_apl">@lang('app.percent_presentation_apl') %</label>
                                        <input id="percent_presentation_apl" name="percent_presentation_apl"
                                               class="form-control"
                                               type="number"
                                               step=".01"
                                               placeholder="@lang('app.placeholder.percent_presentation_apl')"
                                               value="{{old('percent_presentation_apl')?old('percent_presentation_apl'):
                                                    ($item->get_meta('percent_presentation_apl')?$item->get_meta('percent_presentation_apl')->value:'')}}">
                                        <p class="help-box">@lang('app.percent.desc')</p>
                                    </div>
                                </fieldset>
                                <button type="submit" class="btn btn-primary float-right ">@lang('app.btn.save')</button>
                                <button type="reset" class="btn btn-default float-right mr-2">@lang('app.btn.cancel')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection