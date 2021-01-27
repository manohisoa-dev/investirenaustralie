@extends('V2.admin.layouts.app')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Types</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Types</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('v2.type.index') }}">Listes</a>
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
                <h5>Mise à jour Type : {{$type->slug}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('v2.type.index')}}/{{$type->id}}" method="post">

                    {{ csrf_field() }}

                    {{ method_field("PUT") }}
                                                                                                
                            {!! \Nvd\Crud\Form::input('slug','text')->model($type)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('title','text')->model($type)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('content','text')->model($type)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('object_type','text')->model($type)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('author_id','text')->model($type)->show() !!}
                                                                                                                                                
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Enregistrer</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
