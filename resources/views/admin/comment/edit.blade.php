@extends('admin.layouts.app')

@section('title', 'Commentaires - Edition ')

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
                <strong>Edition</strong>
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
                <h5>Mise à jour Comment : {{$comment->content}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ Auth::user()->isAdmin() ? route('admin.comment.index') : route('admin.collaborator.admin.comment.index') }}/{{$comment->id}}" method="post">

                    {{ csrf_field() }}

                    {{ method_field("PUT") }}
                                                                                                
                            {!! \Nvd\Crud\Form::input('content','text')->model($comment)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('status','text')->model($comment)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('votes','text')->model($comment)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('spam','text')->model($comment)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('reply_id','text')->model($comment)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('blog_id','text')->model($comment)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('user_id','text')->model($comment)->show() !!}
                                                                                                                                                
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Enregistrer</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
