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
        <strong>Edition</strong>
    </li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Mise à jour Country : {{$country->code}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('v2.country.index')}}/{{$country->id}}" method="post">

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
