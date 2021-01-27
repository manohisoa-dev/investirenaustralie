@extends('V2.admin.layouts.app')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Categories</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Categories</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('v2.category.index') }}">Listes</a>
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
                <h5>Détail Category : {{$category->slug}}</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>Id</h4>
                        <h5>{{$category->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Slug</h4>
                        <h5>{{$category->slug}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Title</h4>
                        <h5>{{$category->title}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Content</h4>
                        <h5>{{$category->content}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Author Id</h4>
                        <h5>{{$category->author_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Créer le</h4>
                        <h5>{{$category->created_at->diffForHumans()}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Mise à jour le</h4>
                        <h5>{{$category->updated_at->diffForHumans()}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection