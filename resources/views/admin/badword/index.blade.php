@extends('admin.layouts.app')

@section('title', 'Mot interdits - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.forbidden_words')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdmin()?route('admin.badword.index'):route('admin.collaborators.admin.badword.index') }}">@lang('app.txt.forbidden_words')</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.lists')</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ Auth::user()->isAdmin()?route('admin.badword.create'):route('admin.collaborators.admin.badword.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> @lang('app.txt.add_new_forbidden_words')            </a>
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>@lang('app.txt.forbidden_words')</h5>
			</div>
			<div class="ibox-content">
				<div class="table-responsive">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
						{!!\Nvd\Crud\Html::sortableTh('id','admin.badword.index','Id')!!}
						{!!\Nvd\Crud\Html::sortableTh('content','admin.badword.index','LIbellé')!!}
						{!!\Nvd\Crud\Html::sortableTh('created_at','admin.badword.index','Créer le')!!}
						{!!\Nvd\Crud\Html::sortableTh('updated_at','admin.badword.index','Mise à jour le')!!}
						<th><a href="javascript:void(0)">@lang('app.table.actions')</a></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
							<td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
							<td><input type="text" class="form-control" name="content" value="{{Request::input("content")}}"></td>
							<td><input type="text" class="form-control" name="created_at" value="{{Request::input("created_at")}}"></td>
							<td><input type="text" class="form-control" name="updated_at" value="{{Request::input("updated_at")}}"></td>
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
									data-type="text"
									data-name="content"
									data-value="{{ $record->content }}"
									data-pk="{{ $record->{$record->getKeyName()} }}"
									data-url="{{ Auth::user()->isAdmin()?route('admin.badword.index'):route('admin.collaborators.admin.badword.index')}}/{{ $record->{$record->getKeyName()} }}"
									>{{ str_limit(strip_tags($record->content), "100", "...") }}</span>
								</td>
								<td>
									{{ $record->created_at ? $record->created_at->diffForHumans() : '' }}
								</td>
								<td>
									{{ $record->updated_at ? $record->updated_at->diffForHumans() : ''}}
								</td>
								@include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => Auth::user()->isAdmin()?route('admin.badword.index'):route('admin.collaborators.admin.badword.index'), 'record' => $record ] )
							</tr>
						@empty
							@include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 5])
						@endforelse
                    </tbody>

                </table>

                @include('vendor.crud.single-page-templates.common.pagination', [ 'records' => $records ] )
				</div>
				<script>
					$(".editable").editable({ajaxOptions:{method:'PUT'}});
				</script>
			</div>
		</div>
	</div>
</div>
@endsection
