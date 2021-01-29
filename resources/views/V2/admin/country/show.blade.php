@extends('V2.admin.layouts.app')

@section('title', 'Pays - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Pays</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Pays</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('V2.admin.country.index') }}">Listes</a>
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
                <h5>DétailPays : {{$country->code}}</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>Id</h4>
                        <h5>{{$country->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Code</h4>
                        <h5>{{$country->code}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Content</h4>
                        <h5>{{$country->content}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>PrefixPhone</h4>
                        <h5>{{$country->prefixPhone}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Placeholder</h4>
                        <h5>{{$country->placeholder}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Créer le</h4>
                        <h5>{{$country->created_at ? $country->created_at->diffForHumans() : ''}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Mise à jour le</h4>
                        <h5>{{$country->updated_at ? $country->updated_at->diffForHumans() : ''}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection