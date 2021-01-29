@extends('V2.admin.layouts.app')

@section('title', 'Pages - Ajout ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Pages</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Pages</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('V2.admin.page.index') }}">Listes</a>
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
                <h5>Ajouter un nouveau Page</h5>
            </div>
            <div class="ibox-content">
                <form class="form-validation form-padding" action="{{ route('V2.admin.page.store') }}" method="post">

                    {{ csrf_field() }}
                                                        
                    {!! \Nvd\Crud\Form::input('title','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('content','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('path','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('page_order','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('is_pub','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('language','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('parent_id','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('author_id','text')->show() !!}
                                                                                    
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Créer</button>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom-script')
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

    <script>
        $(document).ready(function(){
            CKEDITOR.replace( 'content' );
        }) ;
    </script>
@endsection
