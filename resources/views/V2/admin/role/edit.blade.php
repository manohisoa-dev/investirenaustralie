@extends('V2.admin.layouts.app')

@section('title', 'Role - Edition ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Rôles</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Rôles</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('V2.admin.role.index') }}">Listes</a>
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
                <h5>Mise à jour Rôle : {{$role->role_name}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('V2.admin.role.index')}}/{{$role->id}}" method="post">

                    {{ csrf_field() }}

                    {{ method_field("PUT") }}
                                                                                                
                            {!! \Nvd\Crud\Form::input('role_name','text')->model($role)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('role_initial','text')->model($role)->show() !!}
                                                
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Enregistrer</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
