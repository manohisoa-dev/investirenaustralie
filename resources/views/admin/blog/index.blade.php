@extends('admin.layouts.app')

@section('title', 'Blogs - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.blogs')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdmin()?route('admin.blog.index') : (Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.index'):route('admin.collaborator.admin.blog.index')) }}">@lang('app.txt.blogs')</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.lists')</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ Auth::user()->isAdmin()?route('admin.blog.create') : (Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.create'):route('admin.collaborator.admin.blog.create')) }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> @lang('app.txt.add_new_blog')            
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
				<h5>Blogs</h5>
			</div>
			<div class="ibox-content">
				<div class="table-responsive">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
						{!!\Nvd\Crud\Html::sortableTh('id','admin.blog.index','Id')!!}
						<th>@lang('app.table.photo')</th>
						{!!\Nvd\Crud\Html::sortableTh('title_fr','admin.blog.index','Titres/Contenus')!!}
						<th>@lang('app.table.comment')</th>
						<th>@lang('app.form.order')</th>
						{!!\Nvd\Crud\Html::sortableTh('meta_tag','admin.blog.index','Meta TAG')!!}
						{!!\Nvd\Crud\Html::sortableTh('meta_description','admin.blog.index','Meta DESC')!!}
						{!!\Nvd\Crud\Html::sortableTh('status','admin.blog.index','Statut')!!}
						{!!\Nvd\Crud\Html::sortableTh('created_at','admin.blog.index','Date')!!}
						<th><a href="javascript:void(0)">Actions</a></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
							<td width="5%"><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
							<td></td>
							<td><input type="text" class="form-control" name="title_fr" value="{{Request::input("title_fr")}}"></td>
							<td></td>
							<td></td>
							<td><input type="text" class="form-control" name="meta_tag" value="{{Request::input("meta_tag")}}"></td>
							<td><input type="text" class="form-control" name="meta_description" value="{{Request::input("meta_description")}}"></td>
							<td>
								<select class="form-control" name="status">
									<option value="">Choisir statut</option>
									@foreach($status as $st)
									<option value="{{$st}}" {{@$_GET['status']==$st?'selected':''}}>{{$st}}</option>
									@endforeach
								</select>
								<?php /*?><input type="text" class="form-control" name="status" value="{{Request::input("status")}}"><?php */?>
							</td>
							<td><input type="text" class="form-control" name="created_at" value="{{Request::input("created_at")}}"></td>
							<td style="min-width: 6em;">@include('vendor.crud.single-page-templates.common.search-btn')</td>
                        </form>
                    </tr>
                    </thead>

                    <tbody id="current-files">
                        @forelse ( $records as $index =>$record )
                            <tr id="{{ $record->id }}" order="{{ $record->view_order }}">
                                <td>{{ $index + $records->firstItem() }}</td>
								<td>
									<a href="{{Auth::user()->isAdmin()?route('blog.index',$record->slug):(Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.index',$record->slug):route('admin.collaborator.admin.blog.index',$record->slug))}}" target="_blank">
										<img class="thumb" src="{{$record->getImageUrl('thumb')}}">
									</a>
								</td>
								<td>
									{{$record->title_fr}}
                                </td>
								<td style="text-align:center">
									<a href="{{(Auth::user()->isAdmin()?route('admin.comment.index'):(Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.comment.index'):route('admin.collaborator.admin.comment.index'))).'?blog_id='.$record->id}}">{{count($record->comments)}}</a>
								</td>
								<td>{{ $record->view_order }}</td>
								<td>
                                     {{ $record->meta_tag }}
                                 </td>
                                 <td>
                                     {{ $record->meta_description }}
                                  </td>
								  <td>
                                      <a href="">
										 @if($record->status=='published')
										 <span class="label label-success">{{$record->status}}</span>
										 @else
										 <span class="label label-warning">{{$record->status}}</span>
										 @endif
									 </a>
                                   </td>
								   <td>{{$record->created_at ? $record->created_at->diffForHumans() : ""}}</td>
								   <td class="actions-cell text-center" width="12%">
									<form class="form-inline" action="{{ Auth::user()->isAdmin() ? route('admin.blog.index') : (Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.index'):route('admin.collaborator.admin.blog.index')) }}/{{$record->id}}" method="POST">
										<a href="{{Auth::user()->isAdmin() ? route('admin.blog.index') : (Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.index'):route('admin.collaborator.admin.blog.index'))}}/{{$record->id}}/edit" title="Modification" class="btn btn-default btn-circle">
											<i class="fa fa-pencil-square-o"></i>
										</a>&nbsp;&nbsp;
										@if($record->status=='pinged' || $record->status=='archived')
											<a href="{{Auth::user()->isAdmin() ? route('admin.blog.publish', $record) : (Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.publish', $record):route('admin.collaborator.admin.blog.publish', $record))}}" class="btn btn-default btn-circle" title="@lang('app.btn.publish')">
												<i class="fa fa-check"></i>
											</a>&nbsp;
											<a href="{{Auth::user()->isAdmin() ? route('admin.blog.trash', $record) : (Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.trash', $record):route('admin.collaborator.admin.blog.trash', $record))}}" class="btn btn-default btn-circle" title="@lang('app.btn.trash')">
												<i class="fa fa-trash-o"></i>
											</a>&nbsp;&nbsp;
										 @elseif($record->status=='trashed')
											<a href="{{Auth::user()->isAdmin() ? route('admin.blog.restore', $record) : (Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.restore', $record):route('admin.collaborator.admin.blog.restore', $record))}}" class="btn btn-default btn-circle" title="Restore">
												<i class="fa fa-window-restore"></i>
											</a>&nbsp;&nbsp;
										 @endif
										 @if($record->status=='published')
										 	<a href="{{Auth::user()->isAdmin() ? route('admin.blog.archive',$record) : (Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.archive', $record):route('admin.collaborator.admin.blog.archive', $record))}}" class="btn btn-default btn-circle" title="@lang('app.btn.archive')">
												<i class="fa fa-archive"></i>
											</a>&nbsp;&nbsp;
											<a href="{{Auth::user()->isAdmin() ? route('admin.blog.trash', $record) : (Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.trash', $record):route('admin.collaborator.admin.blog.trash', $record))}}" class="btn btn-default btn-circle" title="@lang('app.btn.trash')">
												<i class="fa fa-trash-o"></i>
											</a>&nbsp;&nbsp;
										 @endif
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button type="button" class="btn btn-default btn-circle" title="Suppression" id="delRecord"><i class="fa fa-times text-danger"></i>
										</button>
									</form>
									</td>
                                  <?php /*?> @include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => route('admin.blog.index'), 'record' => $record ] )<?php */?>
                            </tr>
                        @empty
                            @include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 15])
                        @endforelse
                    </tbody>

                </table>

                @include('vendor.crud.single-page-templates.common.pagination', [ 'records' => $records ] )
				<script>
					// $(".editable").editable({ajaxOptions:{method:'PUT'}});
				</script>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('custom-script')
	<style>
		#current-files tr:hover {
			cursor: pointer;
		}

		#current-files tr.ui-sortable-helper{
			cursor: move;
		}
	</style>
	
	<script>
		$("#current-files").sortable({
			connectWith: "#selected-files",
			update: function(event, ui){
				var blog_id = ui.item.attr('id');
				var order = ui.item.attr('order');
				var new_order = ui.item[0].rowIndex - 1;
				var datas = {
					'blog_id' : blog_id,
					'view_order' : new_order,
					'old_view_order' : order,
				};

				$.ajax({
					url : "{{ Auth::user()->isAdmin() ? route('admin.blog.update.order') : (Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.update.order'):route('admin.collaborator.admin.blog.update.order')) }}",
					method : "get",
					data : datas,
					dataType : 'json',
					success : function(data){
						var msg = data.msg;
						location.reload();
						console.log(msg);
					}
				})	
			}
		});
	</script>
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
