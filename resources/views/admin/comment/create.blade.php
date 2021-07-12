@extends('admin.layouts.app')

@section('title', 'Commentaires - Ajout ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.commentaires')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.txt.commentaires')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdmin()?route('admin.comment.index'):(Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.comment.index'):route('admin.collaborator.admin.comment.index')) }}">@lang('app.txt.lists')</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.add')</strong>
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
                <h5>@lang('app.txt.add_new_comment')</h5>
            </div>
            <div class="ibox-content">
                <form class="form-validation form-padding" action="{{ Auth::user()->isAdmin()?route('admin.comment.store'):(Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.comment.store'):route('admin.collaborator.admin.comment.store')) }}" method="post">

                    {{ csrf_field() }}
                                                        
                    {!! \Nvd\Crud\Form::input('content','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('status','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('votes','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('spam','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('reply_id','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('blog_id','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('user_id','text')->show() !!}
                                                                                    
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> @lang('app.btn.create')</button>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
