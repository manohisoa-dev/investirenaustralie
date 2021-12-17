@extends('admin.layouts.app')

@section('title', 'Search Mandate - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Search Mandate</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Search Mandate</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.search-mandate.index') }}">Listes</a>
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
                <h5>Détail Search Mandate : {{$searchMandate->state_id}}</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>Id</h4>
                        <h5>{{$searchMandate->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>State Id</h4>
                        <h5>{{$searchMandate->state_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Search Mandate Name</h4>
                        <h5>{{$searchMandate->search_mandate_name}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Image Id</h4>
                        <h5>{{$searchMandate->image_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Créer le </h4>
                        <h5>{{$searchMandate->created_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Mise à jour le</h4>
                        <h5>{{$searchMandate->updated_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Deleted At</h4>
                        <h5>{{$searchMandate->deleted_at}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection