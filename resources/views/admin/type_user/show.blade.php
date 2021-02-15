@extends('admin.layouts.app')

@section('title', 'Type Users - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Type Users</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Type Users</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.type-user.index') }}">Listes</a>
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
                <h5>Détail Type User : {{$typeUser->type_user_name}}</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>Id</h4>
                        <h5>{{$typeUser->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Type User Name</h4>
                        <h5>{{$typeUser->type_user_name}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection