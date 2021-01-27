@extends('V2.admin.layouts.app')

@section('title', 'Mails - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Mails</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('v2.mail.index') }}">Mails</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ route('v2.mail.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Ajouter un nouveau Mail            </a>
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
                                                    {!!\Nvd\Crud\Html::sortableTh('id','v2.mail.index','Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('subject','v2.mail.index','Subject')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('content','v2.mail.index','Content')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('copied_from','v2.mail.index','Copied From')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('status','v2.mail.index','Status')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('sender_id','v2.mail.index','Sender Id')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('created_at','v2.mail.index','Créer le')!!}
                                                    {!!\Nvd\Crud\Html::sortableTh('updated_at','v2.mail.index','Mise à jour le')!!}
                                            <th><a href="javascript:void(0)">Actions</a></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
                                                            <td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
                                                            <td><input type="text" class="form-control" name="subject" value="{{Request::input("subject")}}"></td>
                                                            <td><input type="text" class="form-control" name="content" value="{{Request::input("content")}}"></td>
                                                            <td><input type="text" class="form-control" name="copied_from" value="{{Request::input("copied_from")}}"></td>
                                                            <td><input type="text" class="form-control" name="status" value="{{Request::input("status")}}"></td>
                                                            <td><input type="text" class="form-control" name="sender_id" value="{{Request::input("sender_id")}}"></td>
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
                                          data-type="textarea"
                                          data-name="subject"
                                          data-value="{{ $record->subject }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.mail.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->subject }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="textarea"
                                          data-name="content"
                                          data-value="{{ $record->content }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.mail.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ str_limit(strip_tags($record->content), "100", "...") }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="copied_from"
                                          data-value="{{ $record->copied_from }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.mail.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->copied_from }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="status"
                                          data-value="{{ $record->status }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.mail.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->status }}</span>
                                                                    </td>
                                                                <td>
                                                                        <span class="editable"
                                          data-type="text"
                                          data-name="sender_id"
                                          data-value="{{ $record->sender_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('v2.mail.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->sender_id }}</span>
                                                                    </td>
                                                                <td>
                                                                            {{ $record->created_at ? $record->created_at->diffForHumans() : '' }}
                                                                    </td>
                                                                <td>
                                                                            {{ $record->updated_at ? $record->updated_at->diffForHumans() : ''}}
                                                                    </td>
                                                                @include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => route('v2.mail.index'), 'record' => $record ] )
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
