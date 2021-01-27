@extends('V2.admin.layouts.app')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Types</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Types</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('v2.type.index') }}">Listes</a>
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
                <h5>Détail Type : {{$type->slug}}</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>Id</h4>
                        <h5>{{$type->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Slug</h4>
                        <h5>{{$type->slug}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Title</h4>
                        <h5>{{$type->title}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Content</h4>
                        <h5>{{$type->content}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Object Type</h4>
                        <h5>{{$type->object_type}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Author Id</h4>
                        <h5>{{$type->author_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Created At</h4>
                        <h5>{{$type->created_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Updated At</h4>
                        <h5>{{$type->updated_at}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection