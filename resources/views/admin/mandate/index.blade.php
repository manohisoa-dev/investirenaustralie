@extends('admin.layouts.app')

@section('title', 'Mandates - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Mandates</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.mandate.index') }}">Mandates</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ route('admin.mandate.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Ajouter un nouveau Mandate            </a>
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Mandates</h5>
			</div>
			<div class="ibox-content">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
                                                    {!!\Nvd\Crud\Html::sortableTh('id','admin.mandate.index','Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('state_id','admin.mandate.index','State Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('mandate_name','admin.mandate.index','Mandate Name')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('mandate_file','admin.mandate.index','Mandate File')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('created_at','admin.mandate.index','Created At')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('updated_at','admin.mandate.index','Updated At')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('deleted_at','admin.mandate.index','Deleted At')!!}
                                                <th><a href="javascript:void(0)">Actions</a></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
                                                            <td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
                                                            <td><input type="text" class="form-control" name="state_id" value="{{Request::input("state_id")}}"></td>
                                                            <td><input type="text" class="form-control" name="mandate_name" value="{{Request::input("mandate_name")}}"></td>
                                                            <td><input type="text" class="form-control" name="mandate_file" value="{{Request::input("mandate_file")}}"></td>
                                                            <td><input type="text" class="form-control" name="created_at" value="{{Request::input("created_at")}}"></td>
                                                            <td><input type="text" class="form-control" name="updated_at" value="{{Request::input("updated_at")}}"></td>
                                                            <td><input type="text" class="form-control" name="deleted_at" value="{{Request::input("deleted_at")}}"></td>
                                                        <td style="min-width: 6em;">@include('vendor.crud.single-page-templates.common.search-btn')</td>
                        </form>
                    </tr>
                    </thead>

                    <tbody>
                        @forelse ( $records as $record )
                            <tr>
                                                                <td>
                                                                            {{ $record->id }}
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="state_id"
                                          data-value="{{ $record->state_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.mandate.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->state_id }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="mandate_name"
                                          data-value="{{ $record->mandate_name }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.mandate.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->mandate_name }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="mandate_file"
                                          data-value="{{ $record->mandate_file }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.mandate.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->mandate_file }}</span>
                                                                    </td>
                                                                <td>
                                                                            {{ $record->created_at }}
                                                                    </td>
                                                                <td>
                                                                            {{ $record->updated_at }}
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="deleted_at"
                                          data-value="{{ $record->deleted_at }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.mandate.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->deleted_at }}</span>
                                                                    </td>
                                                                @include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => route('admin.mandate.index'), 'record' => $record ] )
                            </tr>
                        @empty
                            @include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 8])
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
