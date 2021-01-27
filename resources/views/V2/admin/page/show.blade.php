@extends('V2.admin.layouts.app')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Pages</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Pages</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('v2.page.index') }}">Listes</a>
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
                <h5>Détail Page : {{$page->title}}</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>Id</h4>
                        <h5>{{$page->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Title</h4>
                        <h5>{{$page->title}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Content</h4>
                        <h5>{{$page->content}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Path</h4>
                        <h5>{{$page->path}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Page Order</h4>
                        <h5>{{$page->page_order}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Is Pub</h4>
                        <h5>{{$page->is_pub}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Language</h4>
                        <h5>{{$page->language}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Parent Id</h4>
                        <h5>{{$page->parent_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Author Id</h4>
                        <h5>{{$page->author_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Créer le</h4>
                        <h5>{{$page->created_at->diffForHumans()}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Mise à jour le</h4>
                        <h5>{{$page->updated_at->diffForHumans()}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection