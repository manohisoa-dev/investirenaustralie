@extends('V2.admin.layouts.app')

@section('title', 'Pages - Edition ')

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
                <h5>Mise à jour Page : {{$page->title}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('V2.admin.page.index')}}/{{$page->id}}" method="post">

                    {{ csrf_field() }}

                    {{ method_field("PUT") }}
                                                                                                
                            {!! \Nvd\Crud\Form::input('title','text')->model($page)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('content','text')->model($page)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('path','text')->model($page)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('page_order','text')->model($page)->show() !!}
                                                                        
                            <div class="form-group">
                                <label for="language">Est un pub</label>
                                <select name="language" id="language" class="form-control">
                                    <option value="1" {{$page->is_pub == '1' ? 'selected' : ''}}>Oui</option>
                                    <option value="0" {{$page->is_pub == '0' ? 'selected' : ''}}>Non</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="language">Langue</label>
                                <select name="language" id="language" class="form-control">
                                    <option value="fr" {{$page->language == 'fr' ? 'selected' : ''}}>Fr</option>
                                    <option value="en" {{$page->language == 'en' ? 'selected' : ''}}>En</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="parent_id">Parent</label>
                                <select name="parent_id" id="parent_id" class="form-control">
                                    @foreach(\App\Page::all() as $item)
                                        <option value="{{$item->id}}" {{$page->parent_id == $item->id ? 'selected' : ''}}>{{$item->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                                                                        
                            {!! \Nvd\Crud\Form::input('author_id','text')->model($page)->show() !!}

                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Enregistrer</button>

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
