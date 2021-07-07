@extends('admin.layouts.app')

@section('title', 'Mails Template - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Mails Template</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Mails Template</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.mails-template.index') }}">Listes</a>
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
                <h5>Détail Mails Template : {{$mailsTemplate->titre}}</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>Id</h4>
                        <h5>{{$mailsTemplate->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Titre</h4>
                        <h5>{{$mailsTemplate->titre}}</h5>
                    </li>
                    <li class="list-group-item">
                        <h4>Sujet fr</h4>
                        <h5>{{$mailsTemplate->sujet_fr}}</h5>
                    </li>
                    <li class="list-group-item">
                        <h4>Template</h4>
                        <h5>{!! $mailsTemplate->template_fr !!}</h5>
                    </li>
					<li class="list-group-item">
                        <h4>Sujet en</h4>
                        <h5>{{$mailsTemplate->sujet_en}}</h5>
                    </li>
                    <li class="list-group-item">
                        <h4>Template en</h4>
                        <h5>{!! $mailsTemplate->template_en !!}</h5>
                    </li>
                    <li class="list-group-item">
                        <h4>Created At</h4>
                        <h5>{{$mailsTemplate->created_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Updated At</h4>
                        <h5>{{$mailsTemplate->updated_at}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection