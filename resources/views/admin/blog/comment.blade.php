@extends('admin.layouts.app')

@section('title', 'Blogs - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Blogs</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Blogs</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.blog.index') }}">Listes</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.comment.list')</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

    </div>
</div>

@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>{{$blog->title}}</h5>
            </div>
            <div class="ibox-content">
				<table class="table table-striped grid-view-tbl">
                	<thead>
                    	<tr class="header-row">
							<th width="5%">ID</th>
							<th>Commentaire</th>
							<th>Statut</th>
							<th>Auteur</th>
							<th>Reponses</th>
							<th>Créer le</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
					@foreach($comments as $comment) 
						<tr>
							<td>{{$comment->id}}</td>
							<td>{{$comment->content}}</td>
							<td><a href="#">{{$comment->status}}</a></td>
							<td>{{$comment->user?$comment->user->name:''}}</td>
							<td>{{$comment->replies_count}}</td>
							<td>{{$comment->created_at->diffForHumans()}}</td>
							<td class="actions-cell text-center" width="12%">
							 @if($comment->status=='pinged' || $comment->status=='archived')
								<a href="{{route('admin.comment.publish', $comment)}}" class="btn btn-default btn-circle" title="@lang('app.btn.publish')">
									<i class="fa fa-check"></i>
								</a>&nbsp;&nbsp;
								<a href="#" class="btn btn-default btn-circle" title="@lang('app.btn.trash')">
									<i class="fa fa-trash-o"></i>
								</a>&nbsp;&nbsp;
							 @elseif($comment->status=='trashed')
								<a href="#" class="btn btn-default btn-circle" title="Restore">
									<i class="fa fa-window-restore"></i>
								</a>&nbsp;&nbsp;
							 @endif
							 @if($comment->status=='published')
								<a href="#" class="btn btn-default btn-circle" title="@lang('app.btn.archive')">
									<i class="fa fa-archive"></i>
								</a>&nbsp;&nbsp;
								<a href="#" class="btn btn-default btn-circle" title="@lang('app.btn.trash')">
									<i class="fa fa-trash-o"></i>
								</a>&nbsp;&nbsp;
							 @endif
								<a href="#" class="btn btn-default btn-circle" title="@lang('app.btn.delete')">
									<i class="fa fa-times text-danger"></i>
								</a>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				@include('vendor.crud.single-page-templates.common.pagination', [ 'records' => $comments ] )
			</div>
		</div>
	</div>
</div>
@endsection