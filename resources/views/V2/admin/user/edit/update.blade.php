@extends('V2.admin.layouts.app')

@section('breadcrumb')
    @include('V2.layouts.breadcrumbs')
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="ibox ">
			<div class="ibox-title">
				<h5>Modifier Profile</h5>
			</div>
			<div class="ibox-content">
				@include('includes.alerts')
				<form class="form-horizontal" method="post" action="{{$action}}" enctype="multipart/form-data" data-upload-template-id="template-upload-1" data-download-template-id="template-download-1">
					{{ csrf_field() }}
					<div class="form-group">
						<label>@lang('app.form.login')</label> 
						<input type="text" value="{{$item->name}}" placeholder="@lang('app.form.login')" class="form-control" disabled>
					</div>
					<div class="form-group">
						<label>@lang('app.form.email')</label> 
						<input type="email" value="{{$item->email}}" placeholder="@lang('app.form.email')" name="email" class="form-control">
					</div>
					<div class="form-group">
						<label>@lang('app.form.language')</label> 
						<select name="language" class="form-control" id="language">
							<option value="fr" {{$item->language=='fr'?'selected':''}}>Français</option>
							<option value="en" {{$item->language=='en'?'selected':''}}>English</option>
						</select>
					</div>
					<div class="form-group">
						<label>@lang('app.form.first_name')</label> 
						<input type="text" value="{{old('first_name', $item->meta('first_name', ''))}}" placeholder="@lang('app.form.first_name')" name="first_name" class="form-control">
					</div>
					<div class="form-group">
						<label>@lang('app.form.last_name')</label> 
						<input type="text" value="{{old('last_name', $item->meta('last_name', ''))}}" placeholder="@lang('app.form.last_name')" name="last_name" class="form-control">
					</div>
					<div class="hr-line-dashed"></div>
					<button type="submit" class="btn btn-danger">Sauvegarder</button>
					<a class="btn btn-default" href="{{route('admin.profile')}}">Annuler</a>
					<a href="javascript:history.back()" class="btn btn-primary pull-right" type="submit">Allez au precedent</a>
				</form>
			</div>
		</div>
	</div>
@endsection