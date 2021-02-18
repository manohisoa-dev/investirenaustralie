@extends('admin.layouts.app')

@section('title', 'Menus - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Menus</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Menus</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.menu.index') }}">Listes</a>
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
                <h5>Détail Menu : {{$menu->menu}}</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>Id</h4>
                        <h5>{{$menu->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Menu</h4>
                        <h5>{{$menu->menu}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Parent Id</h4>
                        <h5>{{$menu->parent_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Created At</h4>
                        <h5>{{$menu->created_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Updated At</h4>
                        <h5>{{$menu->updated_at}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection