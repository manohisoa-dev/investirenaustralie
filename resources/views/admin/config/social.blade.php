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
                    <strong>Réseaux sociaux</strong>
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
                    <h5>Réseaux sociaux <small>Mise à jour des informations</small></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <form method="post" action="{{route('admin.config.social.update')}}">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">

                                @foreach($titles as $key=>$value)
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="url_{{$key}}">
                                                    <i class="fontello-icon-{{$key}}" aria-hidden="true"></i>{{$value}}
                                                </label>
                                                <input id="url_{{$key}}" class="form-control" type="url" name="{{$key}}" placeholder="https://www.{{$key}}.com" value="{{old($key)?old($key):($item->get_meta($key)?$item->get_meta($key)->value:'')}}">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <button type="submit" class="btn btn-primary float-right">@lang('app.btn.save')</button>
                                <button type="reset" class="btn btn-default float-right mr-2">@lang('app.btn.cancel')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection