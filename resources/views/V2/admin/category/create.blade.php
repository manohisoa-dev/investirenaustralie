@extends('V2.admin.layouts.app')

@section('title', 'Categories - Ajout ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Categories</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Categories</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('V2.admin.category.index') }}">Listes</a>
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
                <h5>Ajouter un nouveau Category</h5>
            </div>
            <div class="ibox-content">
                <form class="form-validation form-padding" action="{{ route('V2.admin.category.store') }}" method="post">

                    {{ csrf_field() }}
                                                        
                    {!! \Nvd\Crud\Form::input('slug','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('title','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('content','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('author_id','text')->show() !!}
                                                                                    
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Créer</button>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
