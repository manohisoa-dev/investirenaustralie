@extends('admin.layouts.app')

@section('title', 'Mails Template - Ajout ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Mails Template</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Mails Template</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.mails-template.index') }}">Listes</a>
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
                <h5>Ajouter un nouveau Mails Template</h5>
            </div>
            <div class="ibox-content">
                <form class="form-validation form-padding" action="{{ route('admin.mails-template.store') }}" method="post">

                    {{ csrf_field() }}
                                                        
                    {!! \Nvd\Crud\Form::input('titre','text')->show() !!}                                            
                    {!! \Nvd\Crud\Form::input('sujet_fr','text')->show() !!}                                            
                    {!! \Nvd\Crud\Form::textarea( 'template_fr' )->show() !!}
					{!! \Nvd\Crud\Form::input('sujet_en','text')->show() !!}                                            
                    {!! \Nvd\Crud\Form::textarea( 'template_en' )->show() !!}
                                                                                    
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Créer</button>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom-script')
	<script src="{{asset('administrator/plugins/ckeditor/ckeditor.js')}}"></script>
	<script>
        $(document).ready(function(){
			CKEDITOR.replace('template_fr');
			CKEDITOR.replace('template_en');
		});
	</script>
@endsection
