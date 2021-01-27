@extends('V2.admin.layouts.app')

@section('breadcrumb')
<h2>Countries</h2>
<ol class="breadcrumb">
    <li>
        <a href="#">Countries</a>
    </li>
    <li>
        <a href="{{ route('v2.country.index') }}">Listes</a>
    </li>
    <li class="active">
        <strong>Ajout</strong>
    </li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Ajouter un nouveau Country</h5>
            </div>
            <div class="ibox-content">
                <form class="form-validation form-padding" action="{{ route('v2.country.store') }}" method="post">

                    {{ csrf_field() }}
                                                        
                    {!! \Nvd\Crud\Form::input('code','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('content','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('prefixPhone','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('placeholder','text')->show() !!}
                                                                                    
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Créer</button>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
