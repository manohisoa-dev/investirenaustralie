@extends('admin.layouts.app')

@section('title', 'Mails Template - Edition ')

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
                <h5>Mise à jour Mails Template : {{$mailsTemplate->titre}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('admin.mails-template.index')}}/{{$mailsTemplate->id}}" method="post">

                    {{ csrf_field() }}

                    {{ method_field("PUT") }}
                                                                                                
                            {!! \Nvd\Crud\Form::input('titre','text')->model($mailsTemplate)->show() !!}                                                                        
                            {!! \Nvd\Crud\Form::input('sujet_fr','text')->model($mailsTemplate)->show() !!}                                                                        
                            {!! \Nvd\Crud\Form::textarea( 'template_fr' )->model($mailsTemplate)->show() !!}
							{!! \Nvd\Crud\Form::input('sujet_en','text')->model($mailsTemplate)->show() !!}                                                                        
                            {!! \Nvd\Crud\Form::textarea( 'template_en' )->model($mailsTemplate)->show() !!}
                                                                                                                                                
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Enregistrer</button>

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