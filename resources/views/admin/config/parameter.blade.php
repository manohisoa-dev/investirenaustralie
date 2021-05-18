@extends('admin.layouts.app')

@section('title', 'Configuration site')

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
                    <strong>Paramètre</strong>
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
                    <h5>@lang('app.txt.parameter') <small>Réglage des paramètres utilisés dans le site</small></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <form role="form" method="post" action="{{route('admin.config.update.parameter')}}">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-6">
                                        @foreach ($params as $param)
                                        <div class="form-group"><label> {{ $param->content }} </label> <input type="hidden" value="{{ $param->id }}" name="param_{{ $param->id }}"><input type="text" placeholder="" class="form-control" value="{{old($param->name)?old($param->name):( $param->value ? $param->value :'')}}" name="{{ $param->name }}"></div>    
                                        @endforeach
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"><strong>@lang('app.btn.save')</strong></button>
                                    <button class="btn btn-sm btn-default float-right m-t-n-xs mr-2" type="button"><strong>@lang('app.btn.cancel')</strong></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection