@extends('admin.layouts.app')

@section('title', 'Newsletter - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.newsletter.liste.template')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.newsletter.liste.template')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdmin()?route('admin.newsletter-template.index'):route('admin.collaborators.admin.newsletter-template.index') }}">@lang('app.txt.lists')</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Détail</strong>
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
                <h5>Détail Newsletter Template : {{$newsletterTemplate->newsletter_title}}</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                    <li class="list-group-item">
                        <h4>Newsletter Title</h4>
                        <h5>{{$newsletterTemplate->newsletter_title}}</h5>
                    </li>
                    <li class="list-group-item">
                        <h4>Newsletter Template</h4>
                        <h5>{!! $newsletterTemplate->newsletter_template !!}</h5>
                    </li>
                    <li class="list-group-item">
                        <h4>Crée</h4>
                        <h5>{{$newsletterTemplate->created_at ? $newsletterTemplate->created_at->diffForHumans() : ""}}</h5>
                    </li>
                    <li class="list-group-item">
                        <h4>Modifier</h4>
                        <h5>{{$newsletterTemplate->updated_at ? $newsletterTemplate->updated_at->diffForHumans() : ""}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection