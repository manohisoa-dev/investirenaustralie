@extends('admin.layouts.app')

@section('title', 'Pubs - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Publicités</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.pub.index') }}">Publicités</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ route('admin.pub.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Ajouter un nouveau Pub            
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
				<h5>Publicités</h5>
			</div>
			<div class="ibox-content">
				<div class="table-responsive">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
						{!!\Nvd\Crud\Html::sortableTh('id','admin.pub.index','ID')!!}
						<th>Images</th>
						{!!\Nvd\Crud\Html::sortableTh('title','admin.pub.index','Titre')!!}
						{!!\Nvd\Crud\Html::sortableTh('content','admin.pub.index','Description')!!}
						{!!\Nvd\Crud\Html::sortableTh('links','admin.pub.index','Liens')!!}
						<th>Pages</th>
						{!!\Nvd\Crud\Html::sortableTh('created_at','admin.pub.index','Créer le')!!}
						{!!\Nvd\Crud\Html::sortableTh('author_id','admin.pub.index','Auteur')!!}
						<th><a href="javascript:void(0)">Actions</a></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
							<td style="width:5%"><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
							<td></td>
							<td><input type="text" class="form-control" name="title" value="{{Request::input("title")}}"></td>
							<td><input type="text" class="form-control" name="content" value="{{Request::input("content")}}"></td>
							<td><input type="text" class="form-control" name="links" value="{{Request::input("links")}}"></td>
							<td></td>
							<td><input type="text" class="form-control" name="created_at" value="{{Request::input("created_at")}}"></td>
							<td><input type="text" class="form-control" name="author_id" value="{{Request::input("author_id")}}"></td>
							<td style="min-width: 6em;">@include('vendor.crud.single-page-templates.common.search-btn')</td>
                        </form>
                    </tr>
                    </thead>

                    <tbody>
                        @forelse ( $records as $index =>$record )
                            <tr>
                                <td>{{ $index + $records->firstItem() }}</td>
								<td>
									<img src="{{$record->getImageUrl('thumb')}}" class="img-responsive"/>
								</td>
                                <td>
                                     <span class="editable"
                                          data-type="text"
                                          data-name="title"
                                          data-value="{{ $record->title }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.pub.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->title }}</span>
                                 </td>
                                 <td>
                                     <span class="editable"
                                          data-type="text"
                                          data-name="content"
                                          data-value="{{ $record->content }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.pub.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ strip_tags($record->content) }}</span>
                                 </td>
                                 <td>
                                     <span class="editable"
                                          data-type="text"
                                          data-name="links"
                                          data-value="{{ $record->links }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.pub.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->links }}</span>
                                  </td>
								  <td>{{count($record->pages)}}</td>
								  <td> {{ $record->created_at ? $record->created_at->diffForHumans() : '' }}</td>
                                  <td>
                                      <span class="editable"
                                          data-type="text"
                                          data-name="author_id"
                                          data-value="{{ $record->author_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.pub.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{$record->author->name}}</span>
                                    </td>
									<td class="actions-cell text-center" width="7%">
										<form class="form-inline" action="{{route('admin.pub.index')}}/{{$record->id}}" method="POST">
											<a href="{{route('admin.pub.index')}}/{{$record->id}}/edit" class="btn btn-default btn-circle" title="Modification">
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

				<script>
					$(".editable").editable({ajaxOptions:{method:'PUT'}});
				</script>
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