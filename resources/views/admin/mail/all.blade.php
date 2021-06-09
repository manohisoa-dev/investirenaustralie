@extends('admin.layouts.app')

@section('title', 'Mails - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Mails</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.mail.index') }}">Mails</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>{{$title}}</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ route('admin.mail.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Composer un nouveau Mail            
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
				<h5>Mails</h5>
			</div>
			<div class="ibox-content">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
                        {!!\Nvd\Crud\Html::sortableTh('id','admin.mail.index','Id')!!}
                        {!!\Nvd\Crud\Html::sortableTh('subject','admin.mail.index','Subject')!!}
                        {!!\Nvd\Crud\Html::sortableTh('content','admin.mail.index','Contenu')!!}
                        {!!\Nvd\Crud\Html::sortableTh('sender_id','admin.mail.index','Sender')!!}
                        {!!\Nvd\Crud\Html::sortableTh('status','admin.mail.index','Status')!!}
                        {!!\Nvd\Crud\Html::sortableTh('created_at','admin.mail.index','Date')!!}
                        <th><a href="javascript:void(0)">Actions</a></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
                            <td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
                            <td><input type="text" class="form-control" name="subject" value="{{Request::input("subject")}}"></td>
                            <td><input type="text" class="form-control" name="content" value="{{Request::input("content")}}"></td>
                            <td><input type="text" class="form-control" name="sender_id" value="{{Request::input("sender_id")}}"></td>
                            <td><input type="text" class="form-control" name="status" value="{{Request::input("status")}}"></td>
                            <td><input type="text" class="form-control" name="created_at" value="{{Request::input("created_at")}}"></td>
                            <td style="min-width: 6em;">@include('vendor.crud.single-page-templates.common.search-btn')</td>
                        </form>
                    </tr>
                    </thead>

                    <tbody>
                        @forelse ( $records as $index =>$record )
                            <tr>
                                <td>
                                    {{ $index + $records->firstItem() }}
                                </td>
                                <td>
                                    <span class="editable"
                                          data-type="textarea"
                                          data-name="subject"
                                          data-value="{{ $record->subject }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.mail.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->subject }}</span>
                                </td>
                                <td>
                                    <span class="editable"
                                          data-type="textarea"
                                          data-name="content"
                                          data-value="{{ $record->content }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.mail.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ str_limit(strip_tags($record->content), "100", "...") }}</span>
                                </td>
                                <td>
                                    <span class="editable"
                                          data-type="text"
                                          data-name="sender_id"
                                          data-value="{{ $record->sender_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.mail.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->sender->name }}</span>
                                </td>
                                <td>
                                    <span class="editable"
                                          data-type="text"
                                          data-name="status"
                                          data-value="{{ $record->status }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.mail.index')}}/{{ $record->{$record->getKeyName()} }}"
                                    >{{ $record->status }}</span>
                                </td>
                                <td>
                                {{ $record->created_at ? $record->created_at->diffForHumans() : '' }}
                                </td>
                                <td width="10%">
								<form class="form-inline" action="{{route('admin.mail.index')}}/{{$record->id}}" method="POST">
									<a href="{{route('admin.mail.index')}}/{{$record->id}}" class="btn btn-default btn-circle" title="@lang('app.btn.view')">
										<i class="fa fa-eye"></i>
									</a>&nbsp;&nbsp;								
									<a href="{{route('admin.mail.compose', $record)}}" class="btn btn-default btn-circle" title="@lang('app.btn.send')">
										<i class="fa fa-reply"></i>
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
