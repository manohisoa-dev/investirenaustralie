@extends('V2.admin.layouts.app')
@section('breadcrumb')
   @include('V2.layouts.breadcrumbs')
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="ibox ">
			<div class="ibox-title">
				<h5>@lang('app.search.filter')</h5>
			</div>
			<div class="ibox-content">
				<form method="get" action="">
				<div class="row">
					<div class="col-md-2">
						<div class="form-group">
							<label>@lang('app.select_role')</label> 
							<select class="form-control" name="role">
								<option value="">@lang('app.select_role')</option>
								<option value="admin" {{$role=='admin'?'selected':''}}>@lang('app.admin')</option>
								<option value="apl" {{$role=='apl'?'selected':''}}>@lang('app.apl')</option>
								<option value="afa" {{$role=='afa'?'selected':''}}>@lang('app.afa')</option>
								<option value="member" {{$role=='member'?'selected':''}}>@lang('app.member')</option>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>@lang('app.select_country')</label> 
							<select class="form-control" name="country">
								<option value="">@lang('app.select_country')</option>
								@foreach($countries as $c)
								<option value="{{$c->id}}" {{$c->id==$country?'selected':''}}>{{$c->content}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>@lang('app.select_state')</label> 
							<select class="form-control" name="state">
                                <option value="">@lang('app.select_state')</option>
                                @foreach($states as $stateItem)
                                <option value="{{$stateItem->id}}" {{$stateItem->id==$state?'selected':''}}>{{$stateItem->content}}</option>
                                @endforeach
                            </select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label>@lang('app.search')</label> 
							<input id="q" type="text" class="form-control" name="q" placeholder="@lang('app.search')" title="@lang('app.search')" value="{{$q}}">
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label>Nombre par page</label> 
							<input id="q" type="number" class="form-control" name="record" title="Nombre par page" placeholder="Nombre par page" min="10" value="{{$record}}">
						</div>
					</div>
				</div>
				<div class="hr-line-dashed"></div>
				<button type="submit" class="btn btn-danger">@lang('app.btn.search')</button>
				</form>
			</div>
		</div>
		
		<div class="ibox ">
			<div class="ibox-title">
				<h5>
					@if(isset($title))
                        {{$title}}
                    @else
                        @lang('app.admin.user.list')
                    @endif
				</h5>
			</div>
			<div class="ibox-content">
				@include('includes.alerts')
				@include('V2.admin.table.user', ['users'=>$items])
				{{$items->links()}}
			</div>
		</div>
	</div>
@endsection