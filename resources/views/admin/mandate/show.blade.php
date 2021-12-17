@extends('admin.layouts.app')

@section('title', 'Mandates - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Mandates</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Mandates</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.mandate.index') }}">Listes</a>
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
                <h5>Détail Mandate : {{$mandate->state_id}}</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>Id</h4>
                        <h5>{{$mandate->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>State Id</h4>
                        <h5>{{$mandate->state_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Mandate Name</h4>
                        <h5>{{$mandate->mandate_name}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Mandate File</h4>
                        <h5>{{$mandate->mandate_file}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Créer le </h4>
                        <h5>{{$mandate->created_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Mise à jour le</h4>
                        <h5>{{$mandate->updated_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Deleted At</h4>
                        <h5>{{$mandate->deleted_at}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection