@extends('admin.layouts.app')

@section('title', 'Contract - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.contract_to_be_validated')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.contract.index'):route('admin.contract.index') }}">@lang('app.txt.contracts')</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.lists')</strong>
            </li>
        </ol>
    </div>
</div>

@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>@lang('app.txt.contract_to_be_validated')</h5>
			</div>
			<div class="ibox-content">
				<div class="table-responsive">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
						{!!\Nvd\Crud\Html::sortableTh('id','admin.contract.index','Id')!!}
						{!!\Nvd\Crud\Html::sortableTh('user_id','admin.contract.index','User')!!}
						{!!\Nvd\Crud\Html::sortableTh('role','admin.contract.index','Role')!!}
						{!!\Nvd\Crud\Html::sortableTh('date_signature_contract','admin.contract.index','Date signature')!!}
						{!!\Nvd\Crud\Html::sortableTh('url_contract','admin.contract.index','Contract')!!}
						<th><a href="javascript:void(0)">@lang('app.table.actions')</a></th>
                    </tr>
                    {{-- <tr class="search-row">
                        <form class="search-form">
							<td width="5%"><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
							<td><input type="text" class="form-control" name="user_id" value="{{Request::input("user_id")}}"></td>
							<td><input type="text" class="form-control" name="url_contract" value="{{Request::input("url_contract")}}"></td>
							<td style="min-width: 6em;">@include('vendor.crud.single-page-templates.common.search-btn')</td>
                        </form>
                    </tr> --}}
                    </thead>

                    <tbody>
                        @forelse ( $records as $index =>$record )
                            <tr>
								<td>{{ $index + $records->firstItem() }}</td>
                                <td>
                                    <span class="editable"
                                          data-type="text"
                                          data-name="user_id"
                                          data-value="{{ $record->user_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.contract.index'):route('admin.contract.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ App\Models\User::whereId($record->user_id)->first()->name }}</span>
                                 </td>
                                <td>
                                    <span class="editable"
                                        data-type="text"
                                        data-name="role"
                                        data-value="{{ App\Models\User::whereId($record->user_id)->first()->role }}"
                                        data-pk="{{ $record->{$record->getKeyName()} }}"
                                        data-url="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.contract.index'):route('admin.contract.index')}}/{{ $record->{$record->getKeyName()} }}"
                                        >{{ strtoupper(App\Models\Role::whereId(App\Models\User::whereId($record->user_id)->first()->role)->pluck('role_initial')[0]) }}</span>
                                </td>
                                 <td>
                                     <span class="editable"
                                          data-type="text"
                                          data-name="date_signature_contract"
                                          data-value="{{ $record->date_signature_contract }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.contract.index'):route('admin.contract.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ Carbon\Carbon::parse($record->date_signature_contract)->format('d M Y') }}</span>
                                  </td>
                                  <td>
                                    <span class="editable"
                                         data-type="text"
                                         data-name="url_contract"
                                         data-value="{{ $record->url_contract }}"
                                         data-pk="{{ $record->{$record->getKeyName()} }}"
                                         data-url="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.contract.index'):route('admin.contract.index')}}/{{ $record->{$record->getKeyName()} }}">       
                                            <a href="{{ url($record->url_contract) }}" target="_blank">@lang('app.btn.show')</a>
                                    </span>
                                 </td>
								  <td class="actions-cell text-center" width="10%">
                                    @if (Auth::user()->isAdminDelegate() && $record->id===1)
                                    <small>@lang('app.txt.authorization_not_defined')</small>
                                    @else
								  	<a href="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.contract.index'):route('admin.contract.index')}}/{{$record->id}}/validate" title="{{trans('app.btn.validate')}}" class="btn btn-success btn-circle">
										<i class="fa fa-check"></i>
									</a>
                                    <a href="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.contract.index'):route('admin.contract.index')}}/{{$record->id}}/reject" title="{{trans('app.btn.reject')}}" class="btn btn-danger btn-circle">
										<i class="fa fa-ban"></i>
									</a>
                                    @endif
								  </td>
                            </tr>
                        @empty
                            @include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 4])
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
</div>
@endsection
