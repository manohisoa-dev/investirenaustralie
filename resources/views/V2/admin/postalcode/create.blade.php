@extends('V2.admin.layouts.app')

@section('title', 'Code postaux - Ajout ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Code postaux</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Code postaux</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('v2.admin.postalcode.index') }}">Listes</a>
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
                <h5>Ajouter un nouveau Postalcode</h5>
            </div>
            <div class="ibox-content">
                <form class="form-validation form-padding" action="{{ route('v2.postalcode.store') }}" method="post">

                    {{ csrf_field() }}
                                                        
                    {!! \Nvd\Crud\Form::input('content','text')->show() !!}
                                                                                    
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Créer</button>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
