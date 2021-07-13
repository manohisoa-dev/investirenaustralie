@extends('admin.layouts.app')

@section('title', 'Parameters Emails - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.mail_settings')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.txt.mail_settings')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdmin()?route('admin.parameters-email.index'):route('admin.collaborators.admin.parameters-email.index') }}">@lang('app.txt.lists')</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.details')</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

    </div>
</div>

@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>@lang('app.txt.detail_mail_settings', ['param'=>$parametersEmail->libelle])</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>@lang('app.table.id')</h4>
                        <h5>{{$parametersEmail->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.txt.label')</h4>
                        <h5>{{$parametersEmail->libelle}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.txt.variable_name')</h4>
                        <h5>{{$parametersEmail->nom_variable}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.txt.model_name')</h4>
                        <h5>{{$parametersEmail->model_name}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.txt.created_on')</h4>
                        <h5>{{$parametersEmail->created_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.txt.updated_on')</h4>
                        <h5>{{$parametersEmail->updated_at}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection