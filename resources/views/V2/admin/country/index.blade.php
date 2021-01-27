@extends('V2.admin.layouts.app')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Countries</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('v2.country.index') }}">Countries</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ route('v2.country.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Ajouter un nouveau Country            </a>
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Countries</h5>
			</div>
			<div class="ibox-content">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
                                                    {!!\Nvd\Crud\Html::sortableTh('id','v2.country.index','Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('code','v2.country.index','Code')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('content','v2.country.index','Content')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('prefixPhone','v2.country.index','PrefixPhone')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('placeholder','v2.country.index','Placeholder')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('created_at','v2.country.index','Created At')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('updated_at','v2.country.index','Updated At')!!}
                                            <th></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
                                                            <td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
                                                            <td><input type="text" class="form-control" name="code" value="{{Request::input("code")}}"></td>
                                                            <td><input type="text" class="form-control" name="content" value="{{Request::input("content")}}"></td>
                                                            <td><input type="text" class="form-control" name="prefixPhone" value="{{Request::input("prefixPhone")}}"></td>
                                                            <td><input type="text" class="form-control" name="placeholder" value="{{Request::input("placeholder")}}"></td>
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
                                          data-name="code"
                                          data-value="{{ $record->code }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.country.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->code }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="content"
                                          data-value="{{ $record->content }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.country.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->content }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="prefixPhone"
                                          data-value="{{ $record->prefixPhone }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.country.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->prefixPhone }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="placeholder"
                                          data-value="{{ $record->placeholder }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.country.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->placeholder }}</span>
                                                                    </td>
                                                                <td>
                                                                            {{ $record->created_at->diffForHumans() }}
                                                                    </td>
                                                                <td>
                                                                            {{ $record->updated_at ? $record->updated_at->diffForHumans() : ''}}
                                                                    </td>
                                                                @include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => route('v2.country.index'), 'record' => $record ] )
                            </tr>
                        @empty
                            @include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 8])
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
