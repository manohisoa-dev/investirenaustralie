@extends('V2.admin.layouts.app')

@section('title', 'Mot interdits - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Mot interdits</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('V2.admin.badword.index') }}">Mot interdits</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ route('V2.admin.badword.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Ajouter un nouveau mot interdit            </a>
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Mot interdits</h5>
			</div>
			<div class="ibox-content">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
                                                    {!!\Nvd\Crud\Html::sortableTh('id','V2.admin.badword.index','Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('content','V2.admin.badword.index','LIbellé')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('created_at','V2.admin.badword.index','Créer le')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('updated_at','V2.admin.badword.index','Mise à jour le')!!}
                                            <th><a href="javascript:void(0)">Actions</a></th>
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
                        @forelse ( $records as $record )
                            <tr>
                                                                <td>
                                                                            {{ $record->id }}
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="content"
                                          data-value="{{ $record->content }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('V2.admin.badword.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ str_limit(strip_tags($record->content), "100", "...") }}</span>
                                                                    </td>
                                                                <td>
                                                                            {{ $record->created_at ? $record->created_at->diffForHumans() : '' }}
                                                                    </td>
                                                                <td>
                                                                            {{ $record->updated_at ? $record->updated_at->diffForHumans() : ''}}
                                                                    </td>
                                                                @include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => route('V2.admin.badword.index'), 'record' => $record ] )
                            </tr>
                        @empty
                            @include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 5])
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
