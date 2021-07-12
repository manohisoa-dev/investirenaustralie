@extends('admin.layouts.app')

@section('title', 'Commentaires - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.commentaires')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.txt.commentaires')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdmin() ? route('admin.comment.index') : (Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.comment.index'):route('admin.collaborator.admin.comment.index')) }}">@lang('app.txt.lists')</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.details')</strong>
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
                <h5>@lang('app.txt.detail_comment', ['comment'=>$comment->content])</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                    <h4>@lang('app.table.id')</h4>
                        <h5>{{$comment->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.table.content')</h4>
                        <h5>{{$comment->content}}</h5>
                    </li>
                                        <li class="list-group-item">
                    <h4>@lang('app.table.status')</h4>
                        <h5>{{$comment->status}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.txt.votes')</h4>
                        <h5>{{$comment->votes}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.txt.spam')</h4>
                        <h5>{{$comment->spam}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.txt.answered_by')</h4>
                        <h5>{{$comment->reply_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.blog')</h4>
                        <h5>{{$comment->blog->title}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.txt.commented_by')</h4>
                        <h5>{{$comment->user->name}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.txt.created_on') </h4>
                        <h5>{{$comment->created_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.txt.updated_on')</h4>
                        <h5>{{$comment->updated_at}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection