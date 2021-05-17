@extends('admin.layouts.app')

@section('title', 'Blogs - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Blogs</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.blog.index') }}">Blogs</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ route('admin.blog.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Ajouter un nouveau Blog            
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
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
						{!!\Nvd\Crud\Html::sortableTh('id','admin.blog.index','Id')!!}
						<th>@lang('app.table.photo')</th>
						{!!\Nvd\Crud\Html::sortableTh('title','admin.blog.index','Titres/Contenus')!!}
						<th>@lang('app.table.comment')</th>
						<th>@lang('app.form.order')</th>
						{!!\Nvd\Crud\Html::sortableTh('meta_tag','admin.blog.index','Meta TAG')!!}
						{!!\Nvd\Crud\Html::sortableTh('meta_description','admin.blog.index','Meta DESC')!!}
						{!!\Nvd\Crud\Html::sortableTh('status','admin.blog.index','Statut')!!}
						{!!\Nvd\Crud\Html::sortableTh('created_at','admin.blog.index','Date')!!}
						
						<?php /*?>{!!\Nvd\Crud\Html::sortableTh('slug','admin.blog.index','Slug')!!}
						{!!\Nvd\Crud\Html::sortableTh('title','admin.blog.index','Title')!!}
						{!!\Nvd\Crud\Html::sortableTh('content','admin.blog.index','Content')!!}
						{!!\Nvd\Crud\Html::sortableTh('view_count','admin.blog.index','View Count')!!}
						{!!\Nvd\Crud\Html::sortableTh('starred','admin.blog.index','Starred')!!}
						{!!\Nvd\Crud\Html::sortableTh('post_type','admin.blog.index','Post Type')!!}
						{!!\Nvd\Crud\Html::sortableTh('image_id','admin.blog.index','Image Id')!!}
						{!!\Nvd\Crud\Html::sortableTh('author_id','admin.blog.index','Author Id')!!}
						{!!\Nvd\Crud\Html::sortableTh('updated_at','admin.blog.index','Mis à jour le')!!}<?php */?>
						<th><a href="javascript:void(0)">Actions</a></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
							<td width="5%"><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
							<td></td>
							<td><input type="text" class="form-control" name="title" value="{{Request::input("title")}}"></td>
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
							
							<?php /*?><td><input type="text" class="form-control" name="slug" value="{{Request::input("slug")}}"></td>							
							<td><input type="text" class="form-control" name="content" value="{{Request::input("content")}}"></td>							
							<td><input type="text" class="form-control" name="view_count" value="{{Request::input("view_count")}}"></td>							
							<td><input type="text" class="form-control" name="starred" value="{{Request::input("starred")}}"></td>
							<td><input type="text" class="form-control" name="post_type" value="{{Request::input("post_type")}}"></td>
							<td><input type="text" class="form-control" name="image_id" value="{{Request::input("image_id")}}"></td>
							<td><input type="text" class="form-control" name="author_id" value="{{Request::input("author_id")}}"></td>							
							<td><input type="text" class="form-control" name="updated_at" value="{{Request::input("updated_at")}}"></td><?php */?>
							<td style="min-width: 6em;">@include('vendor.crud.single-page-templates.common.search-btn')</td>
                        </form>
                    </tr>
                    </thead>

                    <tbody>
                        @forelse ( $records as $record )
                            <tr>
                                <td>{{ $record->id }}</td>
								<td>
									<a href="{{route('blog.index',$record->slug)}}" target="_blank">
										<img class="thumb" src="{{$record->imageUrl(true)}}" width="50">
									</a>
								</td>
								<td>
                                    <span class="editable"
                                          data-type="text"
                                          data-name="title"
                                          data-value="{{ $record->title }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.blog.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >
										  <a href="{{route('blog.index',$record->slug)}}" target="_blank">{{ $record->title }}</a><br />
										  {{str_limit(strip_tags($record->excerpt()),"100","...")}}
									</span>
                                </td>
								<td style="text-align:center">
									<a href="{{route('admin.comment.index').'?blog_id='.$record->id}}">{{count($record->comments)}}</a>
								</td>
								<td>{{ $record->view_order }}</td>
								<td>
                                     <span class="editable"
                                          data-type="text"
                                          data-name="meta_tag"
                                          data-value="{{ $record->meta_tag }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.blog.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->meta_tag }}
									 </span>
                                 </td>
                                 <td>
                                     <span class="editable"
                                          data-type="text"
                                          data-name="meta_description"
                                          data-value="{{ $record->meta_description }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.blog.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->meta_description }}
									 </span>
                                  </td>
								  <td>
                                      <span class="editable"
                                          data-type="text"
                                          data-name="status"
                                          data-value="{{ $record->status }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.blog.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >
										  <a href="">
											 @if($record->status=='published')
											 <span class="label label-success">{{$record->status}}</span>
											 @else
											 <span class="label label-warning">{{$record->status}}</span>
											 @endif
										 </a>
									  </span>
                                   </td>
								   <td>{{$record->created_at ? $record->created_at->diffForHumans() : ""}}</td>
								   <td class="actions-cell text-center" width="12%">
									<form class="form-inline" action="{{route('admin.blog.index')}}/{{$record->id}}" method="POST">
										<a href="{{route('admin.blog.index')}}/{{$record->id}}/edit" title="Modification" class="btn btn-default btn-circle">
											<i class="fa fa-pencil-square-o"></i>
										</a>&nbsp;&nbsp;
										@if($record->status=='pinged' || $record->status=='archived')
											<a href="{{route('admin.blog.publish', $record)}}" class="btn btn-default btn-circle" title="@lang('app.btn.publish')">
												<i class="fa fa-check"></i>
											</a>&nbsp;
											<a href="{{route('admin.blog.trash', $record)}}" class="btn btn-default btn-circle" title="@lang('app.btn.trash')">
												<i class="fa fa-trash-o"></i>
											</a>&nbsp;&nbsp;
										 @elseif($record->status=='trashed')
											<a href="{{route('admin.blog.restore', $record)}}" class="btn btn-default btn-circle" title="Restore">
												<i class="fa fa-window-restore"></i>
											</a>&nbsp;&nbsp;
										 @endif
										 @if($record->status=='published')
										 	<a href="{{route('admin.blog.archive',$record)}}" class="btn btn-default btn-circle" title="@lang('app.btn.archive')">
												<i class="fa fa-archive"></i>
											</a>&nbsp;&nbsp;
											<a href="{{route('admin.blog.trash', $record)}}" class="btn btn-default btn-circle" title="@lang('app.btn.trash')">
												<i class="fa fa-trash-o"></i>
											</a>&nbsp;&nbsp;
										 @endif
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button class="btn btn-default btn-circle"
												onclick="return confirm('Vous êtes sur?')"
												type="submit" title="Suppression"><i class="fa fa-times text-danger"></i></button>
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
					$(".editable").editable({ajaxOptions:{method:'PUT'}});
				</script>
			</div>
		</div>
	</div>
</div>
@endsection
