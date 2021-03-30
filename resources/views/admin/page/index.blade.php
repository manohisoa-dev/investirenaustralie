@extends('admin.layouts.app')

@section('title', 'Pages - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Pages</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.page.index') }}">Pages</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ route('admin.page.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Ajouter un nouveau Page            
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
				<h5>Pages</h5>
			</div>
			<div class="ibox-content">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
						{!!\Nvd\Crud\Html::sortableTh('id','admin.page.index','Id')!!}
						{!!\Nvd\Crud\Html::sortableTh('title','admin.page.index','Title')!!}
						{!!\Nvd\Crud\Html::sortableTh('content','admin.page.index','Content')!!}
						{!!\Nvd\Crud\Html::sortableTh('path','admin.page.index','Path')!!}
						{!!\Nvd\Crud\Html::sortableTh('page_order','admin.page.index','Ordre')!!}
						{!!\Nvd\Crud\Html::sortableTh('language','admin.page.index','Language')!!}
						{!!\Nvd\Crud\Html::sortableTh('parent_id','admin.page.index','Parent')!!}
						{!!\Nvd\Crud\Html::sortableTh('author_id','admin.page.index','Auteur')!!}
						{!!\Nvd\Crud\Html::sortableTh('created_at','admin.page.index','Créer le')!!}
						{!!\Nvd\Crud\Html::sortableTh('updated_at','admin.page.index','Mise à jour le')!!}
						<th><a href="javascript:void(0)">Actions</a></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
							<td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
							<td><input type="text" class="form-control" name="title" value="{{Request::input("title")}}"></td>
							<td><input type="text" class="form-control" name="content" value="{{Request::input("content")}}"></td>
							<td><input type="text" class="form-control" name="path" value="{{Request::input("path")}}"></td>
							<td><input type="text" class="form-control" name="page_order" value="{{Request::input("page_order")}}"></td>
							<td>
								<select name="language" id="language" class="form-control">
									<option value=""></option>
									<option value="fr" {{Request::input("language") == 'fr' ? 'selected' : ''}}>Fr</option>
									<option value="en" {{Request::input("language") == 'en' ? 'selected' : ''}}>En</option>
								</select>
							</td>
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
                                <td>{{ $record->id }}</td>
                                <td>
                                    <span class="editable"
                                          data-type="text"
                                          data-name="title"
                                          data-value="{{ $record->title }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.page.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->title }}</span><br />
										  @if($record->is_pub == 1)
										  	<span class="label label-primary">PUB</span>
										  @endif
                                </td>
                                <td>
                                    <span class="editable"
                                          data-type="text"
                                          data-name="content"
                                          data-value="{{ $record->content }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.page.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ str_limit(strip_tags($record->content), "100", "...") }}</span>
                                 </td>
                                 <td>
                                     <span class="editable"
                                          data-type="text"
                                          data-name="path"
                                          data-value="{{ $record->path }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.page.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->path }}</span>
                                 </td>
                                 <td>
                                      <span class="editable"
                                          data-type="number"
                                          data-name="page_order"
                                          data-value="{{ $record->page_order }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.page.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->page_order }}</span>
                                  </td>
                                  <td>
                                      <span class="editable"
                                          data-type="text"
                                          data-name="language"
                                          data-value="{{ $record->language }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.page.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->language }}</span>
                                   </td>
                                   <td>
                                       <span class="editable"
                                          data-type="text"
                                          data-name="parent_id"
                                          data-value="{{ $record->parent_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.page.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->parent ? $record->parent->title : ''}}</span>
                                    </td>
                                    <td>
                                        <span class="editable"
                                          data-type="text"
                                          data-name="author_id"
                                          data-value="{{ $record->author_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.page.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->author ? $record->author->name : ''}}</span>
                                     </td>
                                     <td>{{ $record->created_at ? $record->created_at->diffForHumans() : ''}}</td>
                                     <td>{{ $record->updated_at ? $record->updated_at->diffForHumans() : ''}}</td>
									 <td class="actions-cell text-center" width="7%">
									 	<form class="form-inline" action="{{route('admin.page.index')}}/{{$record->id}}" method="POST">
											<a href="{{route('admin.page.index')}}/{{$record->id}}/edit" title="Modification" class="btn btn-default btn-circle">
												<i class="fa fa-pencil-square-o"></i>
											</a>&nbsp;&nbsp;
											{{ csrf_field() }}
											{{ method_field('DELETE') }}
											<button class="btn btn-default btn-circle"
												onclick="return confirm('Vous êtes sur?')"
												type="submit" title="Suppression"><i class="fa fa-times text-danger"></i>
											</button>
										</form>
									 </td>
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
