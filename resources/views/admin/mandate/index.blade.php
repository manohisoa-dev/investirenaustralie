@extends('admin.layouts.app')

@section('title', 'Mandats de vente - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Mandates</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.mandate.index') }}">Mandat</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ route('admin.mandate.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Ajouter un nouveau Mandat</a>
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Mandats de vente</h5>
			</div>
			<div class="ibox-content">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
						{!!\Nvd\Crud\Html::sortableTh('id','admin.mandate.index','Id')!!}
						{!!\Nvd\Crud\Html::sortableTh('state_id','admin.mandate.index','Etat')!!}
						{!!\Nvd\Crud\Html::sortableTh('mandate_name','admin.mandate.index','Libellé')!!}
						{!!\Nvd\Crud\Html::sortableTh('mandate_file','admin.mandate.index','Mandat')!!}
						{!!\Nvd\Crud\Html::sortableTh('created_at','admin.mandate.index','Created At')!!}
						{!!\Nvd\Crud\Html::sortableTh('updated_at','admin.mandate.index','Updated At')!!}
						<th><a href="javascript:void(0)">Actions</a></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
							<td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
							<td><input type="text" class="form-control" name="state_id" value="{{Request::input("state_id")}}"></td>
							<td><input type="text" class="form-control" name="mandate_name" value="{{Request::input("mandate_name")}}"></td>
							<td><input type="text" class="form-control" name="mandate_file" value="{{Request::input("mandate_file")}}"></td>
							<td><input type="text" class="form-control" name="created_at" value="{{Request::input("created_at")}}"></td>
							<td><input type="text" class="form-control" name="updated_at" value="{{Request::input("updated_at")}}"></td>
							<td style="min-width: 6em;">@include('vendor.crud.single-page-templates.common.search-btn')</td>
                        </form>
                    </tr>
                    </thead>

                    <tbody>
                        @forelse ( $records as $key=>$record)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $record->state->content }}</td>
                                <td>{{ $record->mandate_name }}</td>
                                <td><a href="{{url($record->image->filepath)}}" target="_blank"><i class="fa fa-fw fa-file-pdf-o"></i></a></td>
                                <td>{{$record->created_at ? $record->created_at->diffForHumans() : ""}}</td>
                                <td>{{$record->updated_at ? $record->updated_at->diffForHumans() : ""}}</td>
                                <td align="center" width="12%">
									<form class="form-inline" action="{{Auth::user()->isAdmin()?route('admin.mandate.index'):route('admin.collaborators.admin.mandate.index')}}/{{$record->id}}" method="POST">
									<a href="{{Auth::user()->isAdmin()?route('admin.mandate.index'):route('admin.collaborators.admin.mandate.index')}}/{{$record->id}}" class="btn btn-default btn-circle" title="Voir">
										<i class="fa fa-eye"></i>
									</a>&nbsp;&nbsp;
								
									<a href="{{Auth::user()->isAdmin()?route('admin.mandate.index'):route('admin.collaborators.admin.mandate.index')}}/{{$record->id}}/edit" class="btn btn-default btn-circle" title="Modification">
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

