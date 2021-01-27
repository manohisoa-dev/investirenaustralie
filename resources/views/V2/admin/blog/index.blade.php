@extends('V2.admin.layouts.app')

@section('title', 'Blogs - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Blogs</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('v2.blog.index') }}">Blogs</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ route('v2.blog.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Ajouter un nouveau Blog            </a>
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Blogs</h5>
			</div>
			<div class="ibox-content">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
                                                    {!!\Nvd\Crud\Html::sortableTh('id','v2.blog.index','Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('slug','v2.blog.index','Slug')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('title','v2.blog.index','Title')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('content','v2.blog.index','Content')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('meta_tag','v2.blog.index','Meta Tag')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('meta_description','v2.blog.index','Meta Description')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('view_count','v2.blog.index','View Count')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('status','v2.blog.index','Status')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('starred','v2.blog.index','Starred')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('post_type','v2.blog.index','Post Type')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('image_id','v2.blog.index','Image Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('author_id','v2.blog.index','Author Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('created_at','v2.blog.index','Créer le')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('updated_at','v2.blog.index','Mise à jour le')!!}
                                            <th><a href="javascript:void(0)">Actions</a></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
                                                            <td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
                                                            <td><input type="text" class="form-control" name="slug" value="{{Request::input("slug")}}"></td>
                                                            <td><input type="text" class="form-control" name="title" value="{{Request::input("title")}}"></td>
                                                            <td><input type="text" class="form-control" name="content" value="{{Request::input("content")}}"></td>
                                                            <td><input type="text" class="form-control" name="meta_tag" value="{{Request::input("meta_tag")}}"></td>
                                                            <td><input type="text" class="form-control" name="meta_description" value="{{Request::input("meta_description")}}"></td>
                                                            <td><input type="text" class="form-control" name="view_count" value="{{Request::input("view_count")}}"></td>
                                                            <td><input type="text" class="form-control" name="status" value="{{Request::input("status")}}"></td>
                                                            <td><input type="text" class="form-control" name="starred" value="{{Request::input("starred")}}"></td>
                                                            <td><input type="text" class="form-control" name="post_type" value="{{Request::input("post_type")}}"></td>
                                                            <td><input type="text" class="form-control" name="image_id" value="{{Request::input("image_id")}}"></td>
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
                                          data-name="slug"
                                          data-value="{{ $record->slug }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.blog.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->slug }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="title"
                                          data-value="{{ $record->title }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.blog.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->title }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="content"
                                          data-value="{{ $record->content }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.blog.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ str_limit(strip_tags($record->content), "100", "...") }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="meta_tag"
                                          data-value="{{ $record->meta_tag }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.blog.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->meta_tag }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="meta_description"
                                          data-value="{{ $record->meta_description }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.blog.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->meta_description }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="view_count"
                                          data-value="{{ $record->view_count }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.blog.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->view_count }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="status"
                                          data-value="{{ $record->status }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.blog.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->status }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="number"
                                          data-name="starred"
                                          data-value="{{ $record->starred }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.blog.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->starred }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="post_type"
                                          data-value="{{ $record->post_type }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.blog.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->post_type }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="image_id"
                                          data-value="{{ $record->image_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.blog.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->image_id }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="author_id"
                                          data-value="{{ $record->author_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.blog.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->author_id }}</span>
                                                                    </td>
                                                                <td>
                                                                            {{ $record->created_at ? $record->created_at->diffForHumans() : '' }}
                                                                    </td>
                                                                <td>
                                                                            {{ $record->updated_at ? $record->updated_at->diffForHumans() : ''}}
                                                                    </td>
                                                                @include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => route('v2.blog.index'), 'record' => $record ] )
                            </tr>
                        @empty
                            @include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 15])
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
