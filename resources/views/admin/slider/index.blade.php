@extends('admin.layouts.app')

@section('title', 'Sliders - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Sliders</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.slider.index') }}">Sliders</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ route('admin.slider.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Ajouter un nouveau Slider            </a>
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Sliders</h5>
			</div>
			<div class="ibox-content">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
                                                    {!!\Nvd\Crud\Html::sortableTh('id','admin.slider.index','Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('content','admin.slider.index','Content')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('type','admin.slider.index','Type')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('status','admin.slider.index','Status')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('image_id','admin.slider.index','Image Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('created_at','admin.slider.index','Created At')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('updated_at','admin.slider.index','Updated At')!!}
                                                <th><a href="javascript:void(0)">Actions</a></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
                                                            <td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
                                                            <td><input type="text" class="form-control" name="content" value="{{Request::input("content")}}"></td>
                                                            <td><input type="text" class="form-control" name="type" value="{{Request::input("type")}}"></td>
                                                            <td><input type="text" class="form-control" name="status" value="{{Request::input("status")}}"></td>
                                                            <td><input type="text" class="form-control" name="image_id" value="{{Request::input("image_id")}}"></td>
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
                                          data-name="content"
                                          data-value="{{ $record->content }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.slider.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->content }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="type"
                                          data-value="{{ $record->type }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.slider.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->type }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="number"
                                          data-name="status"
                                          data-value="{{ $record->status }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.slider.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->status }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="image_id"
                                          data-value="{{ $record->image_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.slider.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->image_id }}</span>
                                                                    </td>
                                                                <td>
                                                                            {{ $record->created_at }}
                                                                    </td>
                                                                <td>
                                                                            {{ $record->updated_at }}
                                                                    </td>
                                                                @include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => route('admin.slider.index'), 'record' => $record ] )
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
