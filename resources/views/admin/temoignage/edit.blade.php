@extends('admin.layouts.app')

@section('title', 'Témoignage - Edition ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.testimonials')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.txt.satisfaction_testimonials')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdmin()?route('admin.temoignage.index'):route('admin.collaborators.admin.temoignage.index') }}">@lang('app.txt.lists')</a>
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
                <h5>@lang('app.txt.update_testimonials')</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ Auth::user()->isAdmin()?route('admin.temoignage.index'):route('admin.collaborators.admin.temoignage.index')}}/{{$temoignage->id}}" method="post">

                    {{ csrf_field() }}

                    {{ method_field("PUT") }}
                    <div class="form-group">
						<label for="statut">@lang('app.txt.member')</label>
						<input type="text" class="form-control" value="{{$temoignage->author->name}}" readonly="" />
					</div>        
					<div class="form-group">
						<label for="contenu">@lang('app.message')</label>
						<textarea name="contenu" id="contenu" class="form-control">{{$temoignage->contenu}}</textarea>
					</div>                                                                         
					<input type="hidden" name="user_create" value="{{$temoignage->user_create}}" />
					<div class="form-group">
						<label for="statut">@lang('app.txt.status')</label>
						<select class="form-control" name="statut" id="statut">
							<option value="Actif" {{ ( $temoignage->statut == 'Actif') ? 'selected' : '' }}>@lang('app.txt.active')</option>
							<option value="Bloqué" {{ ( $temoignage->statut == 'Bloqué') ? 'selected' : '' }}>@lang('app.blocked')</option>
						</select>
					</div>                                            
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
            CKEDITOR.replace( 'contenu' );
		});
	</script>
@endsection
