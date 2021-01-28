@extends('V2.admin.layouts.app')

@section('title', 'Mails - Edition ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Mails</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Mails</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('v2.admin.mail.index') }}">Listes</a>
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
                <h5>Mise à jour Mail : {{$mail->subject}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('v2.admin.mail.index')}}/{{$mail->id}}" method="post">

                    {{ csrf_field() }}

                    {{ method_field("PUT") }}
                                                                                                
                            {!! \Nvd\Crud\Form::textarea( 'subject' )->model($mail)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::textarea( 'content' )->model($mail)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('copied_from','text')->model($mail)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('status','text')->model($mail)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('sender_id','text')->model($mail)->show() !!}
                                                                                                                                                
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Enregistrer</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
