@extends('V2.admin.layouts.app')

@section('title', 'Pages - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Pages</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('V2.admin.page.index') }}">Pages</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ route('V2.admin.page.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Ajouter un nouveau Page            </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Pages</h5>
			</div>
			<div class="ibox-content">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
                                                    {!!\Nvd\Crud\Html::sortableTh('id','V2.admin.page.index','Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('title','V2.admin.page.index','Title')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('content','V2.admin.page.index','Content')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('path','V2.admin.page.index','Path')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('page_order','V2.admin.page.index','Page Order')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('is_pub','V2.admin.page.index','Is Pub')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('language','V2.admin.page.index','Language')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('parent_id','V2.admin.page.index','Parent Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('author_id','V2.admin.page.index','Author Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('created_at','V2.admin.page.index','Créer le')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('updated_at','V2.admin.page.index','Mise à jour le')!!}
                                            <th><a href="javascript:void(0)">Actions</a></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
                                                            <td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
                                                            <td><input type="text" class="form-control" name="title" value="{{Request::input("title")}}"></td>
                                                            <td><input type="text" class="form-control" name="content" value="{{Request::input("content")}}"></td>
                                                            <td><input type="text" class="form-control" name="path" value="{{Request::input("path")}}"></td>
                                                            <td><input type="text" class="form-control" name="page_order" value="{{Request::input("page_order")}}"></td>
                                                            <td><input type="text" class="form-control" name="is_pub" value="{{Request::input("is_pub")}}"></td>
                                                            <td><input type="text" class="form-control" name="language" value="{{Request::input("language")}}"></td>
                                                            <td><input type="text" class="form-control" name="parent_id" value="{{Request::input("parent_id")}}"></td>
                                                            <td><input type="text" class="form-control" name="author_id" value="{{Request::input("author_id")}}"></td>
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
                                          data-name="title"
                                          data-value="{{ $record->title }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.page.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->title }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="content"
                                          data-value="{{ $record->content }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.page.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ str_limit(strip_tags($record->content), "100", "...") }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="path"
                                          data-value="{{ $record->path }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.page.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->path }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="number"
                                          data-name="page_order"
                                          data-value="{{ $record->page_order }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.page.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->page_order }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="number"
                                          data-name="is_pub"
                                          data-value="{{ $record->is_pub }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.page.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->is_pub }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="language"
                                          data-value="{{ $record->language }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.page.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->language }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="parent_id"
                                          data-value="{{ $record->parent_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.page.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->parent_id }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="author_id"
                                          data-value="{{ $record->author_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.page.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->author_id }}</span>
                                                                    </td>
                                                                <td>
                                                                            {{ $record->created_at ? $record->created_at->diffForHumans() : ''}}
                                                                    </td>
                                                                <td>
                                                                            {{ $record->updated_at ? $record->updated_at->diffForHumans() : ''}}
                                                                    </td>
                                                                @include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => route('V2.admin.page.index'), 'record' => $record ] )
                            </tr>
                        @empty
                            @include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 12])
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
