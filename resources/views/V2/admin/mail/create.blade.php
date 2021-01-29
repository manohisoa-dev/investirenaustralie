@extends('V2.admin.layouts.app')

@section('title', 'Mails - Ajout ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Mails</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Mails</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('V2.admin.mail.index') }}">Listes</a>
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
                <h5>Ajouter un nouveau Mail</h5>
            </div>
            <div class="ibox-content">
                <form class="form-validation form-padding" action="{{ route('V2.admin.mail.store') }}" method="post">

                    {{ csrf_field() }}
                                                        
                    {!! \Nvd\Crud\Form::textarea( 'subject' )->show() !!}
                                            
                    {!! \Nvd\Crud\Form::textarea( 'content' )->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('copied_from','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('status','text')->show() !!}
                                            
                    {!! \Nvd\Crud\Form::input('sender_id','text')->show() !!}
                                                                                    
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Créer</button>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
