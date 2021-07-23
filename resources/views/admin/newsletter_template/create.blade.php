@extends('admin.layouts.app')

@section('title', 'Newsletter - Ajout ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.newsletter.liste.template')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.newsletter.liste.template')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdmin()?route('admin.newsletter-template.index'):route('admin.collaborators.admin.newsletter-template.index') }}">@lang('app.txt.lists')</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.add')</strong>
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
                <h5>@lang('app.newsletter.title.add')</h5>
            </div>
            <div class="ibox-content">
                <form class="form-validation form-padding" action="{{ Auth::user()->isAdmin()?route('admin.newsletter-template.store'):route('admin.collaborators.admin.newsletter-template.store') }}" method="post">

                    {{ csrf_field() }}
                    <div class="form-group">
						<label for="titre">@lang('app.table.title')</label>
						<input name="newsletter_title" id="newsletter_title" class="form-control" type="text" value="">
					</div>    
					<div class="form-group">
						<label for="contenu">@lang('app.newsletter.title.content')</label>
						<textarea name="newsletter_template" id="contenu" class="form-control"></textarea>
					</div> 
                    <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> @lang('app.btn.create')</button>
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
            CKEDITOR.replace( 'contenu' );
		});
	</script>
@endsection
