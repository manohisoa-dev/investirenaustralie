@extends('admin.layouts.app')

@section('title', 'Témoignages - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Témoignages</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Témoignages de satisfaction</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.temoignage.index') }}">Listes</a>
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
                <h5>Détail Temoignage</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                    <li class="list-group-item">
                        <h4>Membre</h4>
                        <h5>{{$temoignage->author->name}} - {{$temoignage->pays}}</h5>
                    </li>
                    <li class="list-group-item">
                        <h4>Message</h4>
                        <h5>{!! $temoignage->contenu !!}</h5>
                    </li>
                    <li class="list-group-item">
                        <h4>Statut</h4>
                        <h5>{{$temoignage->statut}}</h5>
                    </li>
                    <li class="list-group-item">
                        <h4>Crée le</h4>
                        <h5>{{$temoignage->created_at}}</h5>
                    </li>
               </ul>
            </div>
        </div>
    </div>
</div>

@endsection