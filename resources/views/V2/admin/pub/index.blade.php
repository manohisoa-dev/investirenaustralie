@extends('V2.admin.layouts.app')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Pubs</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('v2.pub.index') }}">Pubs</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ route('v2.pub.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Ajouter un nouveau Pub            </a>
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Pubs</h5>
			</div>
			<div class="ibox-content">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
                                                    {!!\Nvd\Crud\Html::sortableTh('id','v2.pub.index','Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('title','v2.pub.index','Title')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('content','v2.pub.index','Content')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('links','v2.pub.index','Links')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('author_id','v2.pub.index','Author Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('image_id','v2.pub.index','Image Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('created_at','v2.pub.index','Créer le')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('updated_at','v2.pub.index','Mise à jour le')!!}
                                            <th></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
                                                            <td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
                                                            <td><input type="text" class="form-control" name="title" value="{{Request::input("title")}}"></td>
                                                            <td><input type="text" class="form-control" name="content" value="{{Request::input("content")}}"></td>
                                                            <td><input type="text" class="form-control" name="links" value="{{Request::input("links")}}"></td>
                                                            <td><input type="text" class="form-control" name="author_id" value="{{Request::input("author_id")}}"></td>
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
                                          data-name="title"
                                          data-value="{{ $record->title }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.pub.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->title }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="content"
                                          data-value="{{ $record->content }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.pub.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->content }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="links"
                                          data-value="{{ $record->links }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.pub.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->links }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="author_id"
                                          data-value="{{ $record->author_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.pub.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->author_id }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="image_id"
                                          data-value="{{ $record->image_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.pub.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->image_id }}</span>
                                                                    </td>
                                                                <td>
                                                                            {{ $record->created_at->diffForHumans() }}
                                                                    </td>
                                                                <td>
                                                                            {{ $record->updated_at ? $record->updated_at->diffForHumans() : ''}}
                                                                    </td>
                                                                @include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => route('v2.pub.index'), 'record' => $record ] )
                            </tr>
                        @empty
                            @include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 9])
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
