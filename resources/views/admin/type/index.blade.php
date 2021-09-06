@extends('admin.layouts.app')

@section('title', 'Types - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Types</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.type.index'):route('admin.type.index') }}">Types</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.type.create'):route('admin.type.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Ajouter un nouveau Type            
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
				<h5>Types</h5>
			</div>
			<div class="ibox-content">
				<div class="table-responsive">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
						{!!\Nvd\Crud\Html::sortableTh('id','admin.type.index','Id')!!}
						{!!\Nvd\Crud\Html::sortableTh('title','admin.type.index','Title')!!}
						{!!\Nvd\Crud\Html::sortableTh('categories_id','admin.type.index','Catégorie')!!}
						{!!\Nvd\Crud\Html::sortableTh('author_id','admin.type.index','Author Id')!!}
						{!!\Nvd\Crud\Html::sortableTh('created_at','admin.type.index','Créer le')!!}
						{!!\Nvd\Crud\Html::sortableTh('updated_at','admin.type.index','Mise à jour le')!!}
						<th><a href="javascript:void(0)">Actions</a></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
							<td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
							<td><input type="text" class="form-control" name="title" value="{{Request::input("title")}}"></td>
							<td>
								<select class="form-control" name="categories_id">
									<option value="">Choisir categorie</option>
									@foreach($categories as $category)
										<option value="{{$category->id}}" {{@$_GET['categories_id']==$category->id?'selected':''}}> {{$category->title}}</option>
									@endforeach
								</select>
							</td>
							<td><input type="text" class="form-control" name="author_id" value="{{Request::input("author_id")}}"></td>
							<td><input type="text" class="form-control" name="created_at" value="{{Request::input("created_at")}}"></td>
							<td><input type="text" class="form-control" name="updated_at" value="{{Request::input("updated_at")}}"></td>
							<td style="min-width: 6em;">@include('vendor.crud.single-page-templates.common.search-btn')</td>
                        </form>
                    </tr>
                    </thead>

                    <tbody>
                        @forelse ( $records as $index =>$record )
                            <tr>
								<td>{{ $index + $records->firstItem() }}</td>
                            	<td>
                                	<span class="editable"
                                          data-type="text"
                                          data-name="title"
                                          data-value="{{ $record->title }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.type.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->title }}</span>
                                </td>
                                                                
                                <td>
                                     <span class="editable"
                                          data-type="text"
                                          data-name="categories_id"
                                          data-value="{{ $record->categories_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.type.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->categorie->title }}</span>
                                 </td>
                                 <td>
                                     <span class="editable"
                                          data-type="text"
                                          data-name="author_id"
                                          data-value="{{ $record->author->name }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.type.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->author->name }}</span>
                                 </td>
                                 <td>{{ $record->created_at ? $record->created_at->diffForHumans() : '' }}</td>
                                 <td> {{ $record->updated_at ? $record->updated_at->diffForHumans() : ''}}</td>
								 <td class="actions-cell text-center" width="12%">
									<form class="form-inline" action="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.type.destroy',$record):route('admin.type.destroy',$record)}}" method="POST">
										<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.type.edit', $record):route('admin.type.edit', $record)}}" title="Modification" class="btn btn-default btn-circle">
											<i class="fa fa-pencil-square-o"></i>
										</a>&nbsp;&nbsp;								
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button type="button" class="btn btn-default btn-circle" title="Suppression" id="delRecord"><i class="fa fa-times text-danger"></i>
										</button>
									</form>
								</td>
                            </tr>
                        @empty
                            @include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 9])
                        @endforelse
                    </tbody>

                </table>

                @include('vendor.crud.single-page-templates.common.pagination', [ 'records' => $records ] )
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('custom-script')
	<script src="{{ asset('administrator/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
	<script>
		$(document.body).on('click', '#delRecord', function (event) {
        	event.preventDefault();
        	var $form = $(this).closest('form');
				swal({
					title: "@lang('app.table.confirm_delete')",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "@lang('app.yes')",
					cancelButtonText: "@lang('app.btn.cancel')",
					closeOnConfirm: true
				},
				function () {
                    $form.submit();
                });
      });
	</script>
@endsection
