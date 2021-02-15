@extends('admin.layouts.app')
@section('breadcrumb')
   @include('layouts.breadcrumbs')
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="ibox ">
			<div class="ibox-title">
				<h5>@lang('app.title.password')</h5>
			</div>
			<div class="ibox-content">
				 @include('includes.alerts')
				 <form class="form-horizontal" role="form" method="post" action="{{route('admin.password.edit')}}">
				 	 <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
					 <div class="form-group">
						<label>@lang('app.last.password')</label> 
						<input name="old_password" type="password" class="form-control" id="old_password" placeholder="@lang('app.last.password')">
					</div>
					<div class="form-group">
						<label>@lang('app.new.password')</label> 
						<input name="password" type="password" class="form-control" id="password" placeholder="@lang('app.new.password')">
					</div>
					<div class="form-group">
						<label>@lang('app.confirm.password')</label> 
						<input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="@lang('app.confirm.password')">
					</div>
					<div class="hr-line-dashed"></div>
					<button type="submit" class="btn btn-danger">Enregistrer</button>
				 </form>
			</div>
		</div>
	</div>
@endsection