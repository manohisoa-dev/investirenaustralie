@extends('admin.layouts.app')

@section('title', 'Type Users - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Type utilisateur</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.type-user.index') }}">Type utilisateur</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ route('admin.type-user.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Ajouter un nouveau Type utilisateur            
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
				<h5>Type utilisateur</h5>
			</div>
			<div class="ibox-content">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
						{!!\Nvd\Crud\Html::sortableTh('id','admin.type-user.index','Id')!!}
						{!!\Nvd\Crud\Html::sortableTh('type_user_name','admin.type-user.index','Type utilisateur')!!}
						<th><a href="javascript:void(0)">Actions</a></th>
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
								  	<a href="{{route('admin.type-user.index')}}/{{$record->id}}/edit" title="Modification" class="btn btn-default btn-circle">
										<i class="fa fa-pencil-square-o"></i>
									</a>
								</td>
                                <?php /*?>@include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => route('admin.type-user.index'), 'record' => $record ] )<?php */?>
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
@endsection
