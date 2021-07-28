@extends('admin.layouts.app')

@section('title', 'Newsletters - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.newsletter.liste.inscrit')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.newsletter.index') }}">@lang('app.newsletter.liste.inscrit')</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
			{{--
            <a href="{{ route('admin.newsletter.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Ajouter un nouveau Newsletter            
			</a>
			--}}
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>@lang('app.newsletter.liste.inscrit')</h5>
			</div>
			<div class="ibox-content">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
						{!!\Nvd\Crud\Html::sortableTh('id','admin.newsletter.index','Id')!!}
						{!!\Nvd\Crud\Html::sortableTh('email_adresse','admin.newsletter.index','Email Adresse')!!}
						{!!\Nvd\Crud\Html::sortableTh('statuts','admin.newsletter-template.index','Statut')!!}
						{!!\Nvd\Crud\Html::sortableTh('created_at','admin.newsletter.index','Created At')!!}
						{!!\Nvd\Crud\Html::sortableTh('updated_at','admin.newsletter.index','Updated At')!!}
						<th><a href="javascript:void(0)">Actions</a></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
							<td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
							<td><input type="text" class="form-control" name="email_adresse" value="{{Request::input("email_adresse")}}"></td>
							<td><input type="text" class="form-control" name="statuts" value="{{Request::input("statuts")}}"></td>
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
                                          data-type="email"
                                          data-name="email_adresse"
                                          data-value="{{ $record->email_adresse }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.newsletter.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->email_adresse }}</span>
                                </td>
								<td>
                                   <span class="editable"
                                          data-type="text"
                                          data-name="statuts"
                                          data-value="{{ $record->statuts }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.newsletter-template.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->statuts }}</span>
                               </td>
                                <td>{{$record->created_at ? $record->created_at->diffForHumans() : ""}}</td>
                                <td>{{$record->updated_at ? $record->updated_at->diffForHumans() : ""}}</td>
								<td class="actions-cell">
									<form class="form-inline" action="{{Auth::user()->isAdmin()?route('admin.newsletter.index'):route('admin.collaborators.admin.newsletter.index')}}/{{$record->id}}" method="POST">									
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button type="button" class="btn btn-default btn-circle" title="Suppression" id="delRecord"><i class="fa fa-times text-danger"></i>
										</button>
									</form>
								</td>
                            </tr>
                        @empty
                            @include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 5])
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
