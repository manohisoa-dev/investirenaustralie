@extends('admin.layouts.app')

@section('title', 'Role - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.roles')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.role.index'):route('admin.role.index') }}">@lang('app.txt.roles')</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.lists')</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.role.create'):route('admin.role.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> @lang('app.txt.add_new_role')         
			</a>
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>@lang('app.txt.roles')</h5>
			</div>
			<div class="ibox-content">
				<div class="table-responsive">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
						{!!\Nvd\Crud\Html::sortableTh('id','admin.role.index','Id')!!}
						{!!\Nvd\Crud\Html::sortableTh('role_name','admin.role.index','Rôle')!!}
						{!!\Nvd\Crud\Html::sortableTh('role_initial','admin.role.index','Initiale')!!}
						<th><a href="javascript:void(0)">@lang('app.table.actions')</a></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
							<td width="5%"><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
							<td><input type="text" class="form-control" name="role_name" value="{{Request::input("role_name")}}"></td>
							<td><input type="text" class="form-control" name="role_initial" value="{{Request::input("role_initial")}}"></td>
							<td style="min-width: 6em;">@include('vendor.crud.single-page-templates.common.search-btn')</td>
                        </form>
                    </tr>
                    </thead>

                    <tbody>
                        @forelse ( $records as $index =>$record )
                            <tr>
								<td>{{ $index + $records->firstItem() }}</td>
                                <td>
                                    <span class="editable"
                                          data-type="text"
                                          data-name="role_name"
                                          data-value="{{ $record->role_name }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.role.index'):route('admin.role.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->role_name }}</span>
                                 </td>
                                 <td>
                                     <span class="editable"
                                          data-type="text"
                                          data-name="role_initial"
                                          data-value="{{ $record->role_initial }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.role.index'):route('admin.role.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->role_initial }}</span>
                                  </td>
								  <td class="actions-cell text-center" width="7%">
                                    @if (Auth::user()->isAdminDelegate() && $record->id===1)
                                    <small>@lang('app.txt.authorization_not_defined')</small>
                                    @else
								  	<a href="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.role.index'):route('admin.role.index')}}/{{$record->id}}/edit" title="Modification" class="btn btn-default btn-circle">
										<i class="fa fa-pencil-square-o"></i>
									</a>
                                    @endif
								  </td>
                            </tr>
                        @empty
                            @include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 4])
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
</div>
@endsection
