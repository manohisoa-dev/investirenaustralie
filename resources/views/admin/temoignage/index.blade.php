@extends('admin.layouts.app')

@section('title', 'Témoignages de satisfaction - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Temoignages</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.temoignage.index') }}">Témoignages de satisfaction</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ route('admin.temoignage.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Ajouter un nouveau Témoignages            
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
				<h5>Témoignages de satisfaction</h5>
			</div>
			<div class="ibox-content">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
						{!!\Nvd\Crud\Html::sortableTh('id','admin.temoignage.index','Id')!!}
						{!!\Nvd\Crud\Html::sortableTh('contenu','admin.temoignage.index','Message')!!}
						{!!\Nvd\Crud\Html::sortableTh('user_create','admin.temoignage.index','Membre')!!}
						{!!\Nvd\Crud\Html::sortableTh('pays','admin.temoignage.index','Pays ou le territoire')!!}						
						{!!\Nvd\Crud\Html::sortableTh('statut','admin.temoignage.index','Statut')!!}
						{!!\Nvd\Crud\Html::sortableTh('created_at','admin.temoignage.index','Crée le')!!}
						{!!\Nvd\Crud\Html::sortableTh('updated_at','admin.temoignage.index','Modifié le')!!}
						<th><a href="javascript:void(0)">Actions</a></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
							<td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
							<td><input type="text" class="form-control" name="contenu" value="{{Request::input("contenu")}}"></td>
							<td><input type="text" class="form-control" name="user_create" value="{{Request::input("user_create")}}"></td>
							<td><input type="text" class="form-control" name="pays" value="{{Request::input("pays")}}"></td>
							<td><input type="text" class="form-control" name="statut" value="{{Request::input("statut")}}"></td>
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
                                          data-type="textarea"
                                          data-name="contenu"
                                          data-value="{{ $record->contenu }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.temoignage.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{str_limit(strip_tags($record->contenu),"100","...")}}</span>
                               </td>
                               <td>
                                   <span class="editable"
                                          data-type="text"
                                          data-name="user_create"
                                          data-value="{{ $record->user_create }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.temoignage.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->author->name }}</span>
                               </td>
							   <td>
                                   <span class="editable"
                                          data-type="text"
                                          data-name="pays"
                                          data-value="{{ $record->pays }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.temoignage.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->pays }}</span>
                               </td>
                               <td>
                                  <span class="editable"
                                          data-type="text"
                                          data-name="statut"
                                          data-value="{{ $record->statut }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.temoignage.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->statut }}</span>
                                </td>
                                <td>{{$record->created_at ? $record->created_at->diffForHumans() : ""}}</td>
                                <td>{{$record->updated_at ? $record->updated_at->diffForHumans() : ""}}</td>
								<td class="actions-cell">
								<form class="form-inline" action="{{route('admin.temoignage.index')}}/{{$record->id}}" method="POST">
									<a href="{{route('admin.temoignage.index')}}/{{$record->id}}" class="btn btn-default btn-circle" title="Voir">
										<i class="fa fa-eye"></i>
									</a>&nbsp;&nbsp;
								
									<a href="{{route('admin.temoignage.index')}}/{{$record->id}}/edit" class="btn btn-default btn-circle" title="Modification">
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
                            @include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 8])
                        @endforelse
                    </tbody>

                </table>

                @include('vendor.crud.single-page-templates.common.pagination', [ 'records' => $records ] )
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