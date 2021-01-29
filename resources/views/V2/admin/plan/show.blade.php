@extends('V2.admin.layouts.app')

@section('title', 'Plans - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Plans</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Plans</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('V2.admin.plan.index') }}">Listes</a>
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
                <h5>Détail Plan : {{$plan->slug}}</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>Id</h4>
                        <h5>{{$plan->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Slug</h4>
                        <h5>{{$plan->slug}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Name</h4>
                        <h5>{{$plan->name}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Cost</h4>
                        <h5>{{$plan->cost}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Description</h4>
                        <h5>{{$plan->description}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Type</h4>
                        <h5>{{$plan->type}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Role</h4>
                        <h5>{{$plan->role}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Créer le</h4>
                        <h5>{{$plan->created_at ? $plan->created_at->diffForHumans() : ''}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Mise à jour le</h4>
                        <h5>{{$plan->updated_at ? $plan->updated_at->diffForHumans() : ''}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection