@extends('V2.admin.layouts.app')

@section('title', 'Blogs - Ajout ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Blogs</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Blogs</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('v2.blog.index') }}">Listes</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Ajout</strong>
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
                <h5>Ajouter un nouveau Blog</h5>
            </div>
            <div class="ibox-content">
                <form class="form-validation form-padding" action="{{ route('v2.blog.store') }}" method="post">

                    {{ csrf_field() }}
                                                        
                    {!! \Nvd\Crud\Form::input('slug','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('title','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('content','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('meta_tag','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('meta_description','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('view_count','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('status','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('starred','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('post_type','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('image_id','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('author_id','text')->show() !!}
                                                                                    
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Créer</button>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
