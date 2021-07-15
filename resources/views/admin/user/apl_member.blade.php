@extends('admin.layouts.app')

@section('title', 'Users - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>APL liée</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.txt.stakeholders')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.show.'.$userRole):route('admin.user.show.'.$userRole) }}">@lang('app.txt.'.$userRole)</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>APL liée</strong>
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
                <h5>APL liée : {{$member->name}}</h5>
            </div>
			<div class="ibox-content">
				 <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
						{!!\Nvd\Crud\Html::sortableTh('id','admin.user.index','Id')!!}
						{!!\Nvd\Crud\Html::sortableTh('image_id','admin.user.index','Photo')!!}
						{!!\Nvd\Crud\Html::sortableTh('name','admin.user.index','Nom')!!}
                        {!!\Nvd\Crud\Html::sortableTh('email','admin.user.index','Email')!!}
						{!!\Nvd\Crud\Html::sortableTh('apl_ends_at','admin.user.index','Date fin')!!}
						{!!\Nvd\Crud\Html::sortableTh('role','admin.user.index','Rôle')!!}
						{!!\Nvd\Crud\Html::sortableTh('type_users_id','admin.user.index','Type')!!}
						{!!\Nvd\Crud\Html::sortableTh('status','admin.user.index','Statuts')!!}
						<th><a href="javascript:void(0)">Actions</a></th>
                    </tr>
                    </thead>

                    <tbody>
					@forelse ( $records as $index =>$record )
						<tr>
							<td>{{ $index + $records->firstItem() }}</td>
							<td>
							@if (@getimagesize($record->imageUrl()))
								<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.show', $record):route('admin.user.show', $record)}}">
									<img class="img-responsive" src="{{$record->imageUrl()}}" width="50">
								</a>
							@else
								<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.show', $record):route('admin.user.show', $record)}}">
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
								data-type="email"
								data-name="email"
								data-value="{{ $record->email }}"
								data-pk="{{ $record->{$record->getKeyName()} }}"
								data-url="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.index'):route('admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
								>{{ $record->email }}</span>
							</td>
							<td>{{$member->apl_ends_at->formatLocalized('%d %B %Y')}}</td>
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
								@if($record->type_users_id == 5)
								<a href="">
									<span class="label label-success">{{ trans('app.txt.'.str_replace(' ','_',$record->typeUser['type_user_name'])) }}</span>
								</a>
								@else
								<a href="">
									<span class="label label-primary">{{ trans('app.txt.'.str_replace(' ','_',$record->typeUser['type_user_name'])) }}</span>
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
										@elseif($record->status == 'pinged')
											<span class="label label-warning">{{ucfirst($record->status)}}</span>
										@endif
									@endif
									</a>
								</span>
							</td>
							<td align="center">
							
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