@extends('admin.layouts.app')
@section('breadcrumb')
   @include('layouts.breadcrumbs')
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="ibox ">
			<div class="ibox-title">
				<h5>Modification Image</h5>
			</div>
			<div class="ibox-content">
				<form class="form-horizontal" role="form" method="post" action="{{route('admin.avatar.edit')}}" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-4">
							<img src="{{$item->imageUrl()}}" alt="{{$item->name}}" width="100%">
						</div>
						<div class="col-md-8">
							@include('includes.alerts')
							<div class="form-group">
								<label>@lang('app.avatar')</label> 
								<input type="file" class="form-control" id="image" name="image" >
							</div>
							<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
							<div class="hr-line-dashed"></div>
							<button type="submit" class="btn btn-danger">Sauvegarder</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection