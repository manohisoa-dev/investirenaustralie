@extends('admin.layouts.app')

@section('title', 'Role - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Role</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Role</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.role.index') }}">Listes</a>
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
                <h5>Détail Role : {{$role->role_name}}</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>Id</h4>
                        <h5>{{$role->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Role Name</h4>
                        <h5>{{$role->role_name}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Role Initial</h4>
                        <h5>{{$role->role_initial}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection