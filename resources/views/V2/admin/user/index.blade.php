@extends('V2.admin.layouts.app')
@section('breadcrumb')
   @include('V2.layouts.breadcrumbs')
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">
		@include('includes.alerts')
		<div style="text-align:right; margin-bottom:2%">
			 @if($item->status=='active')
				<a href="{{route('admin.user.disable', $item)}}" class="btn btn-small btn-success">@lang('app.btn.disable')</a>
			 @else
				<a href="{{route('admin.user.active', $item)}}" class="btn btn-small btn-info">@lang('app.btn.active')</a>
			 @endif
				<a href="{{route('admin.user.delete', $item)}}" class="btn btn-small btn-danger">@lang('app.btn.delete')</a>
				<a href="{{route('admin.user.contact', $item)}}" class="btn btn-small btn-default">@lang('app.btn.contact')</a>
		</div>
		@include('V2.admin.user.info.login',    ['item'=>$item])
	</div>
@endsection