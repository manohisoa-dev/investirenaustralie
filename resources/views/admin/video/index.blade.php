@extends('admin.layouts.app')

@section('title', 'Videos - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Videos</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.video.index') }}">Vidéos</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ route('admin.video.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Ajouter un nouveau Vidéo</a>
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Vidéos</h5>
			</div>
			<div class="ibox-content">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
						{!!\Nvd\Crud\Html::sortableTh('id','admin.video.index','Id')!!}
						{!!\Nvd\Crud\Html::sortableTh('video_titre','admin.video.index','Titre du vidéo')!!}
						{!!\Nvd\Crud\Html::sortableTh('video_url','admin.video.index','Url')!!}
						{!!\Nvd\Crud\Html::sortableTh('video_path','admin.video.index','Vidéo')!!}
						{!!\Nvd\Crud\Html::sortableTh('created_at','admin.video.index','Créer le ')!!}
						{!!\Nvd\Crud\Html::sortableTh('updated_at','admin.video.index','Mise à jour le')!!}
						<th><a href="javascript:void(0)">Actions</a></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
							<td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
							<td><input type="text" class="form-control" name="video_titre" value="{{Request::input("video_titre")}}"></td>
							<td><input type="text" class="form-control" name="video_url" value="{{Request::input("video_url")}}"></td>
							<td><input type="text" class="form-control" name="video_path" value="{{Request::input("video_path")}}"></td>
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
									{{ $record->video_titre }}<br />
									@if($record->type_source == 0)
										<span class="label label-warning-light">URL</span>
									@else
										<span class="label label-primary-light">INTERNE</span>
									@endif
								</td>
                                <td>{{ $record->video_url }}</td>
                                <td>{{ $record->video_path }}</td>
                                <td>{{ $record->created_at }}</td>
                                <td>{{ $record->updated_at }}</td>
								<td align="center" class="actions-cell" style="width:10%;">
									<form class="form-inline" action="{{Auth::user()->isAdmin()?route('admin.video.index'):route('admin.collaborators.admin.video.index')}}/{{$record->id}}" method="POST">
									
										<a href="{{Auth::user()->isAdmin()?route('admin.video.index'):route('admin.collaborators.admin.video.index')}}/{{$record->id}}/edit" class="btn btn-default btn-circle" title="Modification">
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
                            @include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 7])
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
