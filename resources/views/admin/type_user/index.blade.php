@extends('admin.layouts.app')

@section('title', 'Type Users - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.user_type')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.type-user.index'):route('admin.type-user.index') }}">@lang('app.txt.user_type')</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.lists')</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.type-user.create'):route('admin.type-user.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i>@lang('app.txt.add_new_user_type')            
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
				<h5>@lang('app.txt.user_type')</h5>
			</div>
			<div class="ibox-content">
				<div class="table-responsive">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
						{!!\Nvd\Crud\Html::sortableTh('id','admin.type-user.index','Id')!!}
						{!!\Nvd\Crud\Html::sortableTh('type_user_name','admin.type-user.index','Type utilisateur')!!}
						<th><a href="javascript:void(0)">@lang('app.table.actions')</a></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
							<td width="5%"><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
							<td><input type="text" class="form-control" name="type_user_name" value="{{Request::input("type_user_name")}}"></td>
							<td style="min-width: 6em;">@include('vendor.crud.single-page-templates.common.search-btn')</td>
                        </form>
                    </tr>
                    </thead>

                    <tbody>
                        @forelse ( $records as $record )
                            <tr>
                                <td>{{ $record->id }}</td>
                                <td>
                                    <span class="editable"
                                          data-type="text"
                                          data-name="type_user_name"
                                          data-value="{{ $record->type_user_name }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.type-user.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->type_user_name }}</span>
                                </td>
								<td class="actions-cell text-center" width="7%">
                                    @if (Auth::user()->isAdminDelegate() && $record->id===7)
                                        <small>@lang('app.txt.authorization_not_defined')</small>
                                    @else
                                        <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.type-user.edit', ['type_user'=>$record->id]):route('admin.type-user.edit', ['type-user'=>$record->id])}}" title="Modification" class="btn btn-default btn-circle">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                    @endif
								</td>
                                {{-- @include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => route('admin.type-user.index'), 'record' => $record ] ) --}}
                            </tr>
                        @empty
                            @include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 3])
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
