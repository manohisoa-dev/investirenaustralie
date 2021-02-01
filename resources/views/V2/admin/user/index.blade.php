@extends('V2.admin.layouts.app')

@section('title', 'Users - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Utilisateurs</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('V2.admin.user.index') }}">Utilisateurs</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <!--<a href="{{ route('V2.admin.user.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Ajouter un nouveau User            
			</a>-->
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Liste des utilisateurs</h5>
			</div>
			<div class="ibox-content">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
						{!!\Nvd\Crud\Html::sortableTh('id','V2.admin.user.index','Id')!!}
						{!!\Nvd\Crud\Html::sortableTh('image_id','V2.admin.user.index','Photo')!!}
						{!!\Nvd\Crud\Html::sortableTh('name','V2.admin.user.index','Nom')!!}
                        {!!\Nvd\Crud\Html::sortableTh('email','V2.admin.user.index','Email')!!}
						{!!\Nvd\Crud\Html::sortableTh('created_at','V2.admin.user.index','Date')!!}
						{!!\Nvd\Crud\Html::sortableTh('role','V2.admin.user.index','Rôle')!!}
						{!!\Nvd\Crud\Html::sortableTh('type','V2.admin.user.index','Type')!!}
						{!!\Nvd\Crud\Html::sortableTh('status','V2.admin.user.index','Statuts')!!}
						<th><a href="javascript:void(0)">Actions</a></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
							<td style="width:2%"><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
							<td></td>
							<td><input type="text" class="form-control" name="name" value="{{Request::input("name")}}"></td>
                            <td><input type="text" class="form-control" name="email" value="{{Request::input("email")}}"></td>
							<td><input type="text" class="form-control" name="created_at" value="{{Request::input("created_at")}}"></td>
							<td><input type="text" class="form-control" name="role" value="{{Request::input("role")}}"></td>
							<td><input type="text" class="form-control" name="type" value="{{Request::input("type")}}"></td>
							<td><input type="text" class="form-control" name="status" value="{{Request::input("status")}}"></td>
                            <td style="min-width: 10em;">@include('vendor.crud.single-page-templates.common.search-btn')</td>
                        </form>
                    </tr>
                    </thead>

                    <tbody>
					@forelse ( $records as $record )
						<tr>
							<td>{{ $record->id }}</td>
							<td>
								<a href="{{route('V2.admin.user.show', $record)}}">
									<img class="img-responsive" src="{{$record->imageUrl()}}" width="50">
								</a>
							</td>
							<td>
								<span class="editable"
								data-type="text"
								data-name="name"
								data-value="{{ $record->name }}"
								data-pk="{{ $record->{$record->getKeyName()} }}"
								data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
								>{{ $record->name }}</span>
							</td>
							<td>
								<span class="editable"
								data-type="email"
								data-name="email"
								data-value="{{ $record->email }}"
								data-pk="{{ $record->{$record->getKeyName()} }}"
								data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
								>{{ $record->email }}</span>
							</td>
							<td>{{$record->created_at->diffForHumans()}}</td>
							<td>
								<span class="editable"
								data-type="text"
								data-name="role"
								data-value="{{ $record->role }}"
								data-pk="{{ $record->{$record->getKeyName()} }}"
								data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
								><a href=""><span class="label label-warning">{{$record->role}}</span></a></span>
							</td>
							<td>
								<span class="editable"
								data-type="text"
								data-name="type"
								data-value="{{ $record->type }}"
								data-pk="{{ $record->{$record->getKeyName()} }}"
								data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
								>
								@if($record->isPerson())
								<a href=""><span class="label label-success">{{$record->type}}</span>
								</a>
								@else
								<a href=""><span class="label label-primary">{{$record->type}}</span>
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
								data-url="{{ route('V2.admin.user.index')}}/{{ $record->{$record->getKeyName()} }}"
								>
									<a href="#">
									@if($record->status=='active')
									<span class="label label-primary">{{$record->status}}</span>
									@else
									<span class="label label-warning">{{$record->status}}</span>
									@endif
									</a>
								</span>
							</td>
							<td>
								@if($record->status=='active')
								<a href="{{route('V2.admin.user.disable', ['user'=>$record->id])}}" class="btn btn-default btn-circle" title="@lang('app.btn.disable')">
									<i class="fa fa-eye-slash"></i>
								</a>&nbsp;&nbsp;
								@else
								<a href="#" class="btn btn-default btn-circle" title="@lang('app.btn.active')">
									<i class="fa fa-eye text-info"></i>
								</a>&nbsp;&nbsp;
								@endif
								<a href="#" class="btn btn-default btn-circle" title="@lang('app.btn.contact')">
									<i class="fa fa-address-book-o" aria-hidden="true"></i>
								</a>&nbsp;&nbsp;
								<a href="#" class="btn btn-default btn-circle" title="@lang('app.btn.delete')">
									<i class="fa fa-trash-o text-danger"></i>
								</a>
								
							</td>
						</tr>
					@empty
						@include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 33])
					@endforelse
                    </tbody>

                </table>

                @include('vendor.crud.single-page-templates.common.pagination', [ 'records' => $records ] )

				<script>
					$(".editable").editable({ajaxOptions:{method:'PUT'}});
				</script>
			</div>
		</div>
	</div>
</div>
@endsection
