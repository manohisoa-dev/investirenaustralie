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
                                                                        
                            {!! \Nvd\Crud\Form::input('is_pub','text')->model($page)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('language','text')->model($page)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('parent_id','text')->model($page)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('author_id','text')->model($page)->show() !!}
                                                                                                                                                
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Enregistrer</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
