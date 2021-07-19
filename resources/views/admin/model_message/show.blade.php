@extends('admin.layouts.app')

@section('title', 'Model Message - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.titre.modele_message')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.titre.modele_message')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdmin()?route('admin.model-message.index'):route('admin.collaborators.admin.model-message.index') }}">
					@lang('app.txt.lists')
				</a>
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
                <h5>Détail Model Message : {{$modelMessage->titre}}</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                    <li class="list-group-item">
                        <h4>Id</h4>
                        <h5>{{$modelMessage->id}}</h5>
                    </li>
                     <li class="list-group-item">
                        <h4>Titre</h4>
                        <h5>{{$modelMessage->titre}}</h5>
                    </li>
                    <li class="list-group-item">
                        <h4>Message</h4>
                        <h5>{!! $modelMessage->message !!}</h5>
                    </li>
                    <li class="list-group-item">
                        <h4>Created At</h4>
                        <h5>{{$modelMessage->created_at}}</h5>
                    </li>
                    <li class="list-group-item">
                        <h4>Updated At</h4>
                        <h5>{{$modelMessage->updated_at}}</h5>
                    </li>
                  </ul>
            </div>
        </div>
    </div>
</div>

@endsection