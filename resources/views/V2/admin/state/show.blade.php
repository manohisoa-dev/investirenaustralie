@extends('V2.admin.layouts.app')

@section('title', 'States - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>States</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">States</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('v2.state.index') }}">Listes</a>
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
                <h5>Détail State : {{$state->content}}</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>Id</h4>
                        <h5>{{$state->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Content</h4>
                        <h5>{{$state->content}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Country</h4>
                        <h5>{{$state->country}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Créer le</h4>
                        <h5>{{$state->created_at ? $state->created_at->diffForHumans() : ''}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Mise à jour le</h4>
                        <h5>{{$state->updated_at ? $state->updated_at->diffForHumans() : ''}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection