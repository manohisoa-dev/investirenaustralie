@extends('admin.layouts.app')

@section('title', 'Firb - Edition ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Firb</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Firb</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.firb.index') }}">Listes</a>
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
                <h5>Mise à jour Firb : {{$firb->label}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('admin.firb.index')}}/{{$firb->id}}" method="post">

                    {{ csrf_field() }}

                    {{ method_field("PUT") }}
                                                                                                
                            {!! \Nvd\Crud\Form::input('label','text')->model($firb)->show() !!}
							{!! \Nvd\Crud\Form::input('codePostal','text')->model($firb)->show() !!}
                                                                                                                                                
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Enregistrer</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
