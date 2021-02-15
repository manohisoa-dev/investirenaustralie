@extends('admin.layouts.app')

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
                <a href="{{ route('admin.page.index') }}">Listes</a>
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
                <form class="form-validation form-padding" action="{{ route('admin.page.store') }}" method="post">

                    {{ csrf_field() }}

                    <input type="hidden" name="author_id" value="{{Auth::id()}}">
                                                        
                    {!! \Nvd\Crud\Form::input('title','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('content','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('path','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('page_order','number')->show() !!}
                                            
                    <div class="form-group">
                        <label for="language">Est un pub</label>
                        <select name="language" id="language" class="form-control">
                            <option value="1">Oui</option>
                            <option value="0">Non</option>
                        </select>
                    </div>
                                            
                    <div class="form-group">
                        <label for="language">Langue</label>
                        <select name="language" id="language" class="form-control">
                            <option value="fr">Fr</option>
                            <option value="en">En</option>
                        </select>
                    </div>
                                            
                    <div class="form-group">
                        <label for="parent_id">Parent</label>
                        <select name="parent_id" id="parent_id" class="form-control">
                            @foreach(\App\Page::all() as $page)
                                <option value="{{$page->id}}">{{$page->title}}</option>
                            @endforeach
                        </select>
                    </div>
                                            
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
