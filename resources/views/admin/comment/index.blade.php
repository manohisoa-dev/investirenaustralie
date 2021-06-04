@extends('admin.layouts.app')

@section('title', 'Commentaires - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Commentaires</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{-- {{ route('admin.comment.index') }} --}}">Commentaires</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Commentaires</h5>
			</div>
			<div class="ibox-content">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
						{!!\Nvd\Crud\Html::sortableTh('id','admin.comment.index','Id')!!}
						{!!\Nvd\Crud\Html::sortableTh('content','admin.comment.index','Commentaire')!!}
						{!!\Nvd\Crud\Html::sortableTh('status','admin.comment.index','Statut')!!}
						{!!\Nvd\Crud\Html::sortableTh('user_id','admin.comment.index','Auteur')!!}
						{!!\Nvd\Crud\Html::sortableTh('reply_id','admin.comment.index','Reponses')!!}
						{!!\Nvd\Crud\Html::sortableTh('votes','admin.comment.index','Votes')!!}
						{!!\Nvd\Crud\Html::sortableTh('spam','admin.comment.index','Spam')!!}						
						{!!\Nvd\Crud\Html::sortableTh('blog_id','admin.comment.index','Blog')!!}
						{!!\Nvd\Crud\Html::sortableTh('created_at','admin.comment.index','Créée le ')!!}
						{!!\Nvd\Crud\Html::sortableTh('updated_at','admin.comment.index','Mis à jour le')!!}
						<th><a href="javascript:void(0)">Actions</a></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
							<td width="5%"><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
							<td><input type="text" class="form-control" name="content" value="{{Request::input("content")}}"></td>
							<td><input type="text" class="form-control" name="status" value="{{Request::input("status")}}"></td>
							<td><input type="text" class="form-control" name="user_id" value="{{Request::input("user_id")}}"></td>
							<td><input type="text" class="form-control" name="reply_id" value="{{Request::input("reply_id")}}"></td>
							<td><input type="text" class="form-control" name="votes" value="{{Request::input("votes")}}"></td>
							<td><input type="text" class="form-control" name="spam" value="{{Request::input("spam")}}"></td>							
							<td><input type="text" class="form-control" name="blog_id" value="{{Request::input("blog_id")}}"></td>							
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
                                    <span class="editable"
                                          data-type="text"
                                          data-name="content"
                                          data-value="{{ $record->content }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.comment.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->content }}</span>
                               </td>
                               <td>
                                   <span class="editable"
                                          data-type="text"
                                          data-name="status"
                                          data-value="{{ $record->status }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.comment.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->status }}</span>
                               </td>
							   <td>
                                   <span class="editable"
                                          data-type="text"
                                          data-name="user_id"
                                          data-value="{{ $record->user_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.comment.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->user?$record->user->name:'' }}</span>
                                </td>
							   <td>
                                   <span class="editable"
                                          data-type="text"
                                          data-name="reply_id"
                                          data-value="{{ $record->reply_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.comment.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{count($record->replies)}}</span>
                               </td>
                               <td>
                                   <span class="editable"
                                          data-type="number"
                                          data-name="votes"
                                          data-value="{{ $record->votes }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.comment.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->votes }}</span>
                               </td>
                               <td>
                                   <span class="editable"
                                          data-type="number"
                                          data-name="spam"
                                          data-value="{{ $record->spam }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.comment.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->spam }}</span>
                               </td>                               
                               <td>
                                   <span class="editable"
                                          data-type="text"
                                          data-name="blog_id"
                                          data-value="{{ $record->blog_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.comment.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->blog['title']?$record->blog->title:'' }}</span>
                               </td>
                               
                                <td>{{ $record->created_at }}</td>
                                <td>{{ $record->updated_at }}</td>
                                @include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => route('admin.comment.index'), 'record' => $record ] )
                            </tr>
                        @empty
                            @include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 11])
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
