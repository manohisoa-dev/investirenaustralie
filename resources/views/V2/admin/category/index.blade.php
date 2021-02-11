@extends('V2.admin.layouts.app')

@section('title', 'Categories - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Categories</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('V2.admin.category.index') }}">Categories</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ route('V2.admin.category.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Ajouter un nouveau catégorie           
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
				<h5>Categories</h5>
			</div>
			<div class="ibox-content">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
						{!!\Nvd\Crud\Html::sortableTh('id','V2.admin.category.index','ID')!!}
						{!!\Nvd\Crud\Html::sortableTh('title','V2.admin.category.index','Titre')!!}
						{!!\Nvd\Crud\Html::sortableTh('created_at','V2.admin.category.index','Créer le')!!}
						<th>Produits/SubProduits<span class="column-sorter"></span></th>
						<!--{!!\Nvd\Crud\Html::sortableTh('slug','V2.admin.category.index','Slug')!!}					
						{!!\Nvd\Crud\Html::sortableTh('content','V2.admin.category.index','Content')!!}-->	
						<th>Blogs</th>
						{!!\Nvd\Crud\Html::sortableTh('author_id','V2.admin.category.index','Auteur')!!}
						<!--{!!\Nvd\Crud\Html::sortableTh('updated_at','V2.admin.category.index','Mise à jour le')!!}-->
						<th><a href="javascript:void(0)">Actions</a></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
							<td style="width:5%"><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
							<td><input type="text" class="form-control" name="title" value="{{Request::input("title")}}"></td>
							<td><input type="text" class="form-control" name="created_at" value="{{Request::input("created_at")}}"></td>
							<?php /*?><td><input type="text" class="form-control" name="slug" value="{{Request::input("slug")}}"></td>
							<td><input type="text" class="form-control" name="content" value="{{Request::input("content")}}"></td><?php */?>							
							<td><input type="text" class="form-control" name="author_id" value="{{Request::input("author_id")}}"></td>		
							<td></td>					
							<?php /*?><td><input type="text" class="form-control" name="updated_at" value="{{Request::input("updated_at")}}"></td><?php */?>
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
                                          data-url="{{ route('V2.admin.category.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->title }}</span>
                                </td>
								<td>
									{{ $record->created_at ? $record->created_at->diffForHumans() : '' }}
                                </td>                                
                                <td>{{count($record->products)}} / {{count($record->subProducts)}}</td>
								<td>{{count($record->blogs)}}</td>
                               <td>
                                   <span class="editable"
                                          data-type="text"
                                          data-name="author_id"
                                          data-value="{{ $record->author_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.category.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->author->name }}</span>
                               </td>
                               @include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => route('V2.admin.category.index'), 'record' => $record ] )
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
