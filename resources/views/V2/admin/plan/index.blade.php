@extends('V2.admin.layouts.app')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Plans</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('v2.plan.index') }}">Plans</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ route('v2.plan.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Ajouter un nouveau Plan            </a>
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Plans</h5>
			</div>
			<div class="ibox-content">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
                                                    {!!\Nvd\Crud\Html::sortableTh('id','v2.plan.index','Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('slug','v2.plan.index','Slug')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('name','v2.plan.index','Name')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('cost','v2.plan.index','Cost')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('description','v2.plan.index','Description')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('type','v2.plan.index','Type')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('role','v2.plan.index','Role')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('created_at','v2.plan.index','Created At')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('updated_at','v2.plan.index','Updated At')!!}
                                            <th></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
                                                            <td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
                                                            <td><input type="text" class="form-control" name="slug" value="{{Request::input("slug")}}"></td>
                                                            <td><input type="text" class="form-control" name="name" value="{{Request::input("name")}}"></td>
                                                            <td><input type="text" class="form-control" name="cost" value="{{Request::input("cost")}}"></td>
                                                            <td><input type="text" class="form-control" name="description" value="{{Request::input("description")}}"></td>
                                                            <td><input type="text" class="form-control" name="type" value="{{Request::input("type")}}"></td>
                                                            <td><input type="text" class="form-control" name="role" value="{{Request::input("role")}}"></td>
                                                            <td><input type="text" class="form-control" name="created_at" value="{{Request::input("created_at")}}"></td>
                                                            <td><input type="text" class="form-control" name="updated_at" value="{{Request::input("updated_at")}}"></td>
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
                                          data-name="slug"
                                          data-value="{{ $record->slug }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.plan.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->slug }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="name"
                                          data-value="{{ $record->name }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.plan.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->name }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="cost"
                                          data-value="{{ $record->cost }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.plan.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->cost }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="textarea"
                                          data-name="description"
                                          data-value="{{ $record->description }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.plan.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->description }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="type"
                                          data-value="{{ $record->type }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.plan.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->type }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="role"
                                          data-value="{{ $record->role }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.plan.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->role }}</span>
                                                                    </td>
                                                                <td>
                                                                            {{ $record->created_at->diffForHumans() }}
                                                                    </td>
                                                                <td>
                                                                            {{ $record->updated_at ? $record->updated_at->diffForHumans() : ''}}
                                                                    </td>
                                                                @include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => route('v2.plan.index'), 'record' => $record ] )
                            </tr>
                        @empty
                            @include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 10])
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
