@extends('admin.layouts.app')

@section('title', 'Mails Template - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.mails_template')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.txt.mails_template')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdmin()?route('admin.mails-template.index'):route('admin.collaborators.admin.mails-template.index') }}">@lang('app.txt.lists')</a>
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
                <h5>@lang('app.txt.detail_mail_template', ['title'=>$mailsTemplate->titre])</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>@lang('app.table.id')</h4>
                        <h5>{{$mailsTemplate->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.table.title')</h4>
                        <h5>{{$mailsTemplate->titre}}</h5>
                    </li>
                    <li class="list-group-item">
                        <h4>@lang('app.table.subject_fr')</h4>
                        <h5>{{$mailsTemplate->sujet_fr}}</h5>
                    </li>
                    <li class="list-group-item">
                        <h4>@lang('app.table.template')</h4>
                        <h5>{!! $mailsTemplate->template_fr !!}</h5>
                    </li>
					<li class="list-group-item">
                        <h4>@lang('app.table.subject_in')</h4>
                        <h5>{{$mailsTemplate->sujet_en}}</h5>
                    </li>
                    <li class="list-group-item">
                        <h4>@lang('app.table.template_in')</h4>
                        <h5>{!! $mailsTemplate->template_en !!}</h5>
                    </li>
					<li class="list-group-item">
                        <h4>Params</h4>
                        <h5>{!! $mailsTemplate->params !!}</h5>
                    </li>
                    <li class="list-group-item">
                        <h4>@lang('app.txt.created_on')</h4>
                        <h5>{{$mailsTemplate->created_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.txt.updated_on')</h4>
                        <h5>{{$mailsTemplate->updated_at}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection