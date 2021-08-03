@extends('admin.layouts.app')

@section('title', 'Paramètres Emails - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.mail_settings')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdmin()?route('admin.parameters-email.index'):route('admin.collaborators.admin.parameters-email.index') }}">@lang('app.txt.mail_settings')</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.lists')</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ Auth::user()->isAdmin()?route('admin.parameters-email.create'):route('admin.collaborators.admin.parameters-email.create') }}" type="button" class="btn btn-primary btn-block">
               <i class="fa fa-plus"></i> @lang('app.txt.add_new_mail_settings')
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
				<h5>@lang('app.txt.mail_settings')</h5>
			</div>
			<div class="ibox-content">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
						{!!\Nvd\Crud\Html::sortableTh('id','admin.parameters-email.index','Id')!!}
						{!!\Nvd\Crud\Html::sortableTh('libelle','admin.parameters-email.index','Libellé')!!}
						{!!\Nvd\Crud\Html::sortableTh('nom_variable','admin.parameters-email.index','Nom Variable')!!}
						{!!\Nvd\Crud\Html::sortableTh('model_name','admin.parameters-email.index','Model')!!}
						{!!\Nvd\Crud\Html::sortableTh('created_at','admin.parameters-email.index','Créer le')!!}
						{!!\Nvd\Crud\Html::sortableTh('updated_at','admin.parameters-email.index','Mis à jour le')!!}
						<th><a href="javascript:void(0)">@lang('app.table.actions')</a></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
							<td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
							<td><input type="text" class="form-control" name="libelle" value="{{Request::input("libelle")}}"></td>
							<td><input type="text" class="form-control" name="nom_variable" value="{{Request::input("nom_variable")}}"></td>
							<td><input type="text" class="form-control" name="model_name" value="{{Request::input("model_name")}}"></td>
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
                                          data-type="textarea"
                                          data-name="libelle"
                                          data-value="{{ $record->libelle }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ Auth::user()->isAdmin()?route('admin.parameters-email.index'):route('admin.collaborators.admin.parameters-email.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->libelle }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="nom_variable"
                                          data-value="{{ $record->nom_variable }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ Auth::user()->isAdmin()?route('admin.parameters-email.index'):route('admin.collaborators.admin.parameters-email.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->nom_variable }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="model_name"
                                          data-value="{{ $record->model_name }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ Auth::user()->isAdmin()?route('admin.parameters-email.index'):route('admin.collaborators.admin.parameters-email.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->model_name }}</span>
                                                                    </td>
                                                                <td>
                                                                            {{$record->created_at ? $record->created_at->diffForHumans() : ""}}
                                                                    </td>
                                                                <td>
                                                                            {{ $record->updated_at ? $record->updated_at->diffForHumans() : ''}}
                                                                    </td>
                                                                @include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => (Auth::user()->isAdmin()?route('admin.parameters-email.index'):route('admin.collaborators.admin.parameters-email.index')), 'record' => $record ] )
                            </tr>
                        @empty
                            @include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 7])
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
