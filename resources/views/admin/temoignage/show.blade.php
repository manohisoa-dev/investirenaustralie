@extends('admin.layouts.app')

@section('title', 'Témoignages - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.testimonials')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.txt.satisfaction_testimonials')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdmin()?route('admin.temoignage.index'):route('admin.collaborators.admin.temoignage.index') }}">@lang('app.txt.lists')</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.detail')</strong>
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
                <h5>@lang('app.txt.detail_testimonial')</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                    <li class="list-group-item">
                        <h4>@lang('app.txt.member')</h4>
                        <h5>{{$temoignage->author->name}} - {{$temoignage->pays}}</h5>
                    </li>
                    <li class="list-group-item">
                        <h4>@lang('app.message')</h4>
                        <h5>{!! $temoignage->contenu !!}</h5>
                    </li>
                    <li class="list-group-item">
                        <h4>@lang('app.txt.status')</h4>
                        <h5>{{$temoignage->statut}}</h5>
                    </li>
                    <li class="list-group-item">
                        <h4>@lang('app.txt.created_on')</h4>
                        <h5>{{$temoignage->created_at}}</h5>
                    </li>
               </ul>
            </div>
        </div>
    </div>
</div>

@endsection