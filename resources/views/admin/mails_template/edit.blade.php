@extends('admin.layouts.app')

@section('title', 'Mails Template - Edition ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.mails_template')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.txt.mails_template')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdmin()?route('admin.mails-template.index'):route('admin.collaborators.admin.mails-template.index') }}">@lang('app.txt.lists')</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.editing')</strong>
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
                <h5>@lang('app.txt.update_mail_template', ['title'=>$mailsTemplate->titre])</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ Auth::user()->isAdmin()?route('admin.mails-template.index'):route('admin.collaborators.admin.mails-template.index')}}/{{$mailsTemplate->id}}" method="post">

                    {{ csrf_field() }}

                    {{ method_field("PUT") }}
                    <div class="form-group">
						<label for="title">Titre</label>
						<input type="text" class="form-control" name="titre" value="{{$mailsTemplate->titre}}" />
					</div>  
					<div class="form-group">
						<label for="title">Sujet Fr</label>
						<input type="text" class="form-control" name="sujet_fr" value="{{$mailsTemplate->sujet_fr}}" />
					</div>                                                                 
                    {!! \Nvd\Crud\Form::textarea( 'template_fr' )->model($mailsTemplate)->show() !!}
					<div class="form-group">
						<label for="title">Sujet En</label>
						<input type="text" class="form-control" name="sujet_en" value="{{$mailsTemplate->sujet_en}}" />
					</div>                                                                      
                    {!! \Nvd\Crud\Form::textarea( 'template_en' )->model($mailsTemplate)->show() !!}
                                                                                                                                                
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> @lang('app.btn.save')</button>

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