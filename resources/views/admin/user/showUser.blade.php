@extends('admin.layouts.app')

@section('title', 'Users - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.stakeholders')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.index'):route('admin.user.index') }}">@lang('app.txt.stakeholders')</a>
            </li>
			<li class="breadcrumb-item">
				<a href="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.show.'.$userRole):route('admin.user.show.'.$userRole) }}">@lang('app.txt.'.$userRole)</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.lists')</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
		@if($userRole == 'collaborator')
            <a href="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.create.collaborator'):route('admin.user.create.collaborator') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i>@lang('app.txt.add_collaborator')            
			</a>
		@endif
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>@lang('app.txt.lists_of_stakeholders')</h5>
			</div>
			<div class="ibox-content">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5><i class="fa fa-search"></i> @lang('app.search.filter')</h5>
						<div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
					</div>
					<div class="ibox-content">
						<form method="get" action="">
							<div class="row">
								<div class="col-md-2">
									<label>@lang('app.select_country')</label> 
									<select class="form-control" name="country_id" id="country_id">
										<option value="">@lang('app.txt.any')</option>
										@foreach($countries as $c)
										<option value="{{$c->id}}" {{@$_GET['country_id']==$c->id?'selected':''}}>{{$c->content}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-2">
									<label>@lang('app.select_state')</label> 
									<select class="form-control" name="state_id" id="state_id">
										<option value="">@lang('app.txt.any')</option>
										@foreach($states as $stateItem)
										<option value="{{$stateItem->id}}" {{@$_GET['state_id']==$stateItem->id?'selected':''}}>{{$stateItem->content}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-2">
									<label>Nom</label> 
									<input type="text" name="name" value="{{@$_GET['name']}}" class="form-control" />
								</div>
								<div class="col-md-2">
									<label>Type</label> 
									<select class="form-control" name="type_users_id" id="type_users_id">
										<option value="">@lang('app.txt.any')</option>
										@foreach($typeUser as $type)
										<option value="{{$type->id}}" {{@$_GET['type_users_id']==$type->id?'selected':''}}>{{$type->type_user_name}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-2">
									<label>Status</label> 
									<select class="form-control" name="status">
										<option value="">@lang('app.txt.any')</option>
										@foreach($statuts as $st)
										<option value="{{$st}}" {{@$_GET['status']==$st?'selected':''}}>{{$st}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<button type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-search"></i> @lang('app.form.filter')</button>
							<div style="clear:both"></div>
						</form>
					</div>
				</div>
				
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
						{!!\Nvd\Crud\Html::sortableTh('id',$link,'Id')!!}
						{!!\Nvd\Crud\Html::sortableTh('image_id',$link,'Photo')!!}
						{!!\Nvd\Crud\Html::sortableTh('name',$link,'Nom')!!}
						{!!\Nvd\Crud\Html::sortableTh('country',$link,'Country')!!}
						{!!\Nvd\Crud\Html::sortableTh('locality',$link,'City')!!}
                        {!!\Nvd\Crud\Html::sortableTh('email',$link,'Email')!!}						
						{!!\Nvd\Crud\Html::sortableTh('created_at',$link,'Date')!!}
						{!!\Nvd\Crud\Html::sortableTh('role',$link,'Rôle')!!}
						{!!\Nvd\Crud\Html::sortableTh('type_users_id',$link,'Type')!!}
						{!!\Nvd\Crud\Html::sortableTh('status',$link,'Statuts')!!}
						<th><a href="javascript:void(0)">Actions</a></th>
                    </tr>
                    </thead>

                    <tbody>
					@forelse ( $records as $index =>$record )
						@php
							$user_info = \App\Models\Userinfo::where('user_id',$record->uid)->first();
							if(!empty($user_info)){
								if($record->hasRole(5)&&$record->isPerson()){
									$user_name = $user_info->last_name;
								}else{
									if($user_info->orga_name){
										$user_name = $user_info->orga_name;
									}else{
										$user_name = $record->name;
									}
								}
							}else{
								$user_name = $record->name;
							}					
						@endphp
						<tr>
							<td>{{ $index + $records->firstItem() }}</td>
							<td>
							@if($record->image_id != 0)
								@if (@getimagesize($record->imageUrl()))
									<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.show', $record):route('admin.user.show', $record->uid)}}">
										<img class="img-responsive" src="{{$record->imageUrl()}}" width="50">
									</a>
								@else
									<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.show', $record):route('admin.user.show', $record->uid)}}">
										<img class="img-responsive" src="{{asset('img/500x500.jpg')}}" width="50">
									</a>
								@endif
							@else
								<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.show', $record):route('admin.user.show', $record->uid)}}">
									<img class="img-responsive" src="{{asset('img/500x500.jpg')}}" width="50">
								</a>
							@endif								
							</td>
							<td>{{ $user_name }}</td>
							<td>{{$record->country}}</td>
							<td>{{$record->locality}}</td>
							<td>{{ $record->email }}</td>
							<td>{{$record->created_at->diffForHumans()}}</td>
							<td>
								@if($record->type_users_id == 8 || $record->type_users_id == 9)
									<a href="#"><span class="label label-warning">Selle by AFA</span></a></span>
								@else
									<a href="#"><span class="label label-warning">{{$record->roleUser['role_initial']}}</span></a></span>
								@endif								
							</td>
							<td>
								@if($record->type_users_id == 5)
								<a href="">
									<span class="label label-success">{{$record->typeUser['type_user_name']}}</span>
								</a>
								@else
								<a href="">
									<span class="label label-primary">{{$record->typeUser['type_user_name']}}</span>
								</a>
								@endif
							</td>
							<td>
								@if($record->status=='active')
								<span class="label label-primary">{{$record->status == 'active' ? 'Actif' : ''}}</span>
								@else
									@if($record->status == 'disabled')
										<span class="label label-danger">Suspendu</span>
									@elseif($record->status == 'temp')
										<span class="label label-warning">@lang('app.txt.status_pending')</span>
									@elseif($record->status == 'pinged')
										<span class="label label-warning">{{ucfirst($record->status)}}</span>
									@endif
								@endif
							</td>
							<td align="center">
							<form class="form-inline" action="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.index'):route('admin.user.index')}}/{{$record->uid}}" method="POST">
								@if($record->role == 5)
								<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.relation',['user_id' => $record->uid]):route('admin.user.relation', ['user_id' => $record->uid])}}" class="btn btn-default btn-circle" title="Relation avec son APL ">
									<i class="fa fa-chain text-success"></i>
								</a>&nbsp;&nbsp;
								@endif
								<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.show', ['user_id' => $record->uid]):route('admin.user.show', ['user_id' => $record->uid])}}" class="btn btn-default btn-circle" title="@lang('app.btn.view')">
									<i class="fa fa-info text-success"></i>
								</a>&nbsp;&nbsp;
								@if($record->status=='active')
								<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.desactiver', ['user_id' => $record->uid]):route('admin.user.desactiver', ['user_id' => $record->uid])}}" class="btn btn-default btn-circle" title="@lang('app.btn.disable')">
									<i class="fa fa-eye-slash"></i>
								</a>&nbsp;&nbsp;
								@else
								<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.active', ['user_id' => $record->uid]):route('admin.user.active', ['user_id' => $record->uid])}}" class="btn btn-default btn-circle" title="@lang('app.btn.active')">
									<i class="fa fa-eye text-info"></i>
								</a>&nbsp;&nbsp;
								@endif
								<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.contact', ['user_id' => $record->uid]):route('admin.user.contact', ['user_id' => $record->uid])}}" class="btn btn-default btn-circle" title="Envoyer un email">
									<i class="fa fa-envelope" aria-hidden="true"></i>
								</a>&nbsp
								<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.show.message', ['user_id' => $record->uid]):route('admin.user.show.message', ['user_id' => $record->uid])}}" class="btn btn-default btn-circle" title="Tchater avec ce partie prenante">
									<i class="fa fa-comment	" aria-hidden="true"></i>
								</a>&nbsp;&nbsp;
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
								<button class="btn btn-default btn-circle"
									onclick="return confirm('Vous êtes sur?')"
									type="submit" title="Suppression"><i class="fa fa-times text-danger"></i></button>
							</form>	
							</td>
						</tr>
					@empty
						@include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 33])
					@endforelse
                    </tbody>

                </table>

                @include('vendor.crud.single-page-templates.common.pagination', [ 'records' => $records ] )

				
			</div>
		</div>
	</div>
</div>
@endsection
@section('custom-script')
<script type="text/javascript">
	$(document).ready(function() {
		$("#role").select2();
		$("#country_id").select2();
		$("#state_id").select2();
		$("#type_users_id").select2();
	});
	
	function ajouter()
	{
		$('#form')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty(); 
		$('#modal_form').modal('show'); 
		$('.modal-title').text('Choisir type utilisateur');
	}
	
	function suivant()
	{
		var role = $('#new_role').val();
		window.location.href = "{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.create'):route('admin.user.create') }}?type="+role;
	}
</script>
<div class="modal fade" id="modal_form" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-default">
        <div class="modal-content">
            <div class="modal-header">
				<h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
				 <form action="#" id="form" class="form-horizontal">
                    <div class="form-body">
						<div class="form-group">
                            <label class="control-label">@lang('app.txt.role') *</label>
							<select class="form-control" name="new_role" id="new_role">
								<option value="">@lang('app.form.choix_txt')</option>
								@foreach(\App\Models\Role::all() as $role)
									<option value="{{$role->id}}">{{$role->role_name}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
                <button type="button" id="btnSave" onClick="suivant()" class="btn btn-primary">@lang('app.btn.save')</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('app.btn.cancel')</button>
            </div>
		</div>
	</div>
</div>
@endsection
