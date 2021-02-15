@extends('admin.layouts.app')

@section('title', 'Pays - Edition ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Pays</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Pays</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.country.index') }}">Listes</a>
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
                <h5>Mise à jourPays : {{$country->code}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('admin.country.index')}}/{{$country->id}}" method="post">

                    {{ csrf_field() }}

                    {{ method_field("PUT") }}
                                                                                                
                            {!! \Nvd\Crud\Form::input('code','text')->model($country)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('content','text')->model($country)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('prefixPhone','text')->model($country)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('placeholder','text')->model($country)->show() !!}
                                                                                                                                                
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Enregistrer</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
