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
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.lists')</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <?php /*?><a href="{{ route('admin.user.create') }}" type="button" class="btn btn-primary"><!--btn-block-->
                <i class="fa fa-plus"></i> Ajouter un partie prenante           
			</a><?php */?>
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
						<form class="search-form">
							<div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label>@lang('app.select_role')</label> 
										<select class="form-control" name="role" id="role">
											<option value="">@lang('app.txt.any')</option>
											@foreach($roles as $role)
											<option value="{{$role->id}}" {{@$_GET['role']==$role->id?'selected':''}}>{{$role->role_name}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<label>@lang('app.select_country')</label> 
									<select class="form-control" name="country_id" id="country_id">
										<option value="">@lang('app.txt.any')</option>
										@foreach($countries as $c)
										<option value="{{$c->code}}" {{@$_GET['country_id']==$c->code?'selected':''}}>{{$c->content}}</option>
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
				<div class="table-responsive">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
						{!!\Nvd\Crud\Html::sortableTh('id','admin.user.index','Id')!!}
						{!!\Nvd\Crud\Html::sortableTh('image_id','admin.user.index','Photo')!!}
						{!!\Nvd\Crud\Html::sortableTh('name','admin.user.index','Nom')!!}
						{!!\Nvd\Crud\Html::sortableTh('country','admin.user.index','Country')!!}
						{!!\Nvd\Crud\Html::sortableTh('locality','admin.user.index','City')!!}
                        {!!\Nvd\Crud\Html::sortableTh('email','admin.user.index','Email')!!}
						{!!\Nvd\Crud\Html::sortableTh('created_at','admin.user.index','Date')!!}
						{!!\Nvd\Crud\Html::sortableTh('role','admin.user.index','Rôle')!!}
						{!!\Nvd\Crud\Html::sortableTh('type_users_id','admin.user.index','Type')!!}
						{!!\Nvd\Crud\Html::sortableTh('status','admin.user.index','Statuts')!!}
						<th width="16%"><a href="javascript:void(0)">Actions</a></th>
                    </tr>
                    </thead>

                    <tbody>
					@forelse ( $records as $index =>$record )
						<tr>
							<td>{{ $index + $records->firstItem() }}</td>
							<td>
							@if (@getimagesize($record->imageUrl()))
								<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.show', $record):route('admin.user.show', $record->uid)}}">
									<img class="img-responsive" src="{{$record->imageUrl(false)}}" width="50">
								</a>
							@else
								<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.show', $record):route('admin.user.show', $record->uid)}}">
									<img class="img-responsive" src="{{asset('img/500x500.jpg')}}" width="50">
								</a>
							@endif
								
							</td>
							<td>
								<span class="editable"
								data-type="text"
								data-name="name"
								data-value="{{ $record->name }}"
								data-pk="{{ $record->{$record->getKeyName()} }}"
								data-url="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.index'):route('admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
								>{{ $record->name }}</span>
							</td>
							<td>
								<span class="editable"
								data-type="text"
								data-name="country"
								data-value="{{ $record->country }}"
								data-pk="{{ $record->{$record->getKeyName()} }}"
								data-url="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.index'):route('admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
								>{{$record->country}}</span>
							</td>
							<td>
								<span class="editable"
								data-type="text"
								data-name="locality"
								data-value="{{ $record->locality }}"
								data-pk="{{ $record->{$record->getKeyName()} }}"
								data-url="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.index'):route('admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
								>{{$record->locality}}</span>
							</td>
							
							<td>
								<span class="editable"
								data-type="email"
								data-name="email"
								data-value="{{ $record->email }}"
								data-pk="{{ $record->{$record->getKeyName()} }}"
								data-url="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.index'):route('admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
								>{{ $record->email }}</span>
							</td>
							<td>{{$record->created_at->diffForHumans()}}</td>
							<td>
								<span class="editable"
								data-type="text"
								data-name="role"
								data-value="{{ $record->role }}"
								data-pk="{{ $record->{$record->getKeyName()} }}"
								data-url="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.index'):route('admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
								><a href=""><span class="label label-warning">{{$record->roleUser['role_initial']}}</span></a></span>
							</td>
							<td>
								<span class="editable"
								data-type="text"
								data-name="type_users_id"
								data-value="{{ $record->type_users_id }}"
								data-pk="{{ $record->{$record->getKeyName()} }}"
								data-url="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.index'):route('admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
								>
								@if($record->type_users_id == 2)
								<a href="">
									<span class="label label-success">{{$record->typeUser['type_user_name']}}</span>
								</a>
								@else
								<a href="">
									<span class="label label-primary">{{$record->typeUser['type_user_name']}}</span>
								</a>
								@endif
								</span>
							</td>
							<td>
								<span class="editable"
								data-type="text"
								data-name="status"
								data-value="{{ $record->status }}"
								data-pk="{{ $record->{$record->getKeyName()} }}"
								data-url="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.index'):route('admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
								>
									<a href="#">
									@if($record->status=='active')
									<span class="label label-primary">{{$record->status == 'active' ? 'Actif' : ''}}</span>
									@else
										@if($record->status == 'disabled')
											<span class="label label-danger">Suspendu</span>
										@elseif($record->status == 'deleted')
											<span class="label label-danger">Supprimer</span>
										@elseif($record->status == 'pinged')
											<span class="label label-warning">{{ucfirst($record->status)}}</span>
										@endif
									@endif
									</a>
								</span>
							</td>
							<td>
							@if (Auth::user()->isAdminDelegate() && $record->role===1)
								<small>@lang('app.txt.authorization_not_defined')</small>
							@else
								<form class="form-inline" action="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.index'):route('admin.user.index')}}/{{$record->uid}}" method="POST">
									<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.show', ['user_id' => $record->uid]):route('admin.user.show', ['user_id' => $record->uid])}}" class="btn btn-default btn-circle" title="@lang('app.btn.view')">
										<i class="fa fa-info text-success"></i>
									</a>&nbsp;&nbsp;
									@if(!$record->isAdmin())
										@if($record->status=='active')
											<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.desactiver', ['user_id' => $record->uid]):route('admin.user.desactiver', ['user_id' => $record->uid])}}" class="btn btn-default btn-circle" title="@lang('app.btn.disable')">
												<i class="fa fa-eye-slash"></i>
											</a>&nbsp;&nbsp;
										@else
											<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.active', ['user_id' => $record->uid]):route('admin.user.active', ['user_id' => $record->uid])}}" class="btn btn-default btn-circle" title="@lang('app.btn.active')">
												<i class="fa fa-eye text-info"></i>
											</a>&nbsp;&nbsp;
										@endif
										<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.contact', ['user_id' => $record->uid]):route('admin.user.contact', ['user_id' => $record->uid])}}" class="btn btn-default btn-circle" title="@lang('app.btn.contact')">
											<i class="fa fa-envelope" aria-hidden="true"></i>
										</a>&nbsp;&nbsp;
										<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.show.message', ['user_id' => $record->uid]):route('admin.user.show.message', ['user_id' => $record->uid])}}" class="btn btn-default btn-circle" title="">
											<i class="fa fa-comment	" aria-hidden="true"></i>
										</a>&nbsp;&nbsp;
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button type="button" class="btn btn-default btn-circle" title="Suppression" id="delRecord"><i class="fa fa-times text-danger"></i>
										</button>
									@endif
								</form>
							@endif
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
<script src="{{ asset('administrator/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script>
	$(document.body).on('click', '#delRecord', function (event) {
		event.preventDefault();
		var $form = $(this).closest('form');
			swal({
				title: "@lang('app.table.confirm_delete')",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "@lang('app.yes')",
				cancelButtonText: "@lang('app.btn.cancel')",
				closeOnConfirm: true
			},
			function () {
				$form.submit();
			});
  });
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
