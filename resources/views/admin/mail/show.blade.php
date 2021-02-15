@extends('admin.layouts.app')

@section('title', 'Mails - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Mails</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Mails</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.mail.index') }}">Listes</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Détail</strong>
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
                <h5>Détail Mail : {{$mail->subject}}</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>Id</h4>
                        <h5>{{$mail->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Subject</h4>
                        <h5>{{$mail->subject}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Contenu</h4>
                        <h5>{{$mail->content}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Copied From</h4>
                        <h5>{{$mail->copied_from}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Status</h4>
                        <h5>{{$mail->status}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Sender Id</h4>
                        <h5>{{$mail->sender->name}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Créer le</h4>
                        <h5>{{$mail->created_at ? $mail->created_at->diffForHumans() : ''}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Mise à jour le</h4>
                        <h5>{{$mail->updated_at ? $mail->updated_at->diffForHumans() : ''}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection