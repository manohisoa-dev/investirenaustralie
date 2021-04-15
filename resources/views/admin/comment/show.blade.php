@extends('admin.layouts.app')

@section('title', 'Commentaires - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Commentaires</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Commentaires</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.comment.index') }}">Listes</a>
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
                <h5>Détail Comment : {{$comment->content}}</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>Id</h4>
                        <h5>{{$comment->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Content</h4>
                        <h5>{{$comment->content}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Status</h4>
                        <h5>{{$comment->status}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Votes</h4>
                        <h5>{{$comment->votes}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Spam</h4>
                        <h5>{{$comment->spam}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Répondu par</h4>
                        <h5>{{$comment->reply_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Blog</h4>
                        <h5>{{$comment->blog->title}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Commenter par</h4>
                        <h5>{{$comment->user->name}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Créée le </h4>
                        <h5>{{$comment->created_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Mis à jour le</h4>
                        <h5>{{$comment->updated_at}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection