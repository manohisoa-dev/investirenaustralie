@extends('admin.layouts.app')

@section('title', 'Vente - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.sales')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.sale.index'):route('admin.sale.index') }}">@lang('app.sales')</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.lists')</strong>
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
				<h5>@lang('app.sales')</h5>
			</div>
			<div class="ibox-content">
				<div class="table-responsive">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
						{!!\Nvd\Crud\Html::sortableTh('id','admin.sale.index','Id')!!}
						<th>@lang('app.table.photo')</th>
						<th>@lang('app.table.title')/@lang('app.table.content')</th>
						<th>@lang('app.table.price')/@lang('app.table.tma')</th>
						{!!\Nvd\Crud\Html::sortableTh('created_at','admin.sale.index','Date')!!}
						<th>@lang('app.table.status')</th>
						<th>@lang('app.table.apl')</th>
						<th>@lang('app.table.afa')</th>
						<th>@lang('app.table.customer')</th>
						<th><a href="javascript:void(0)">@lang('app.table.action')</a></th>
                    </tr>
                    <?php /*?><tr class="search-row">
                        <form class="search-form">
							<td width="5%"><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
							<td></td>
							<td></td>
							<td></td>
							<td><input type="text" class="form-control" name="created_at" value="{{Request::input("created_at")}}"></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td style="min-width: 6em;">@include('vendor.crud.single-page-templates.common.search-btn')</td>
                        </form>
                    </tr><?php */?>
                    </thead>

                    <tbody>
                        @forelse ( $records as $index =>$record )
                            <tr>
                            	<td>{{ $index + $records->firstItem() }} </td>
								<td>
									<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.index'):route('admin.product.index')}}/{{$record->id}}">
										<img class="thumb" src="{{asset('img/500x500.jpg')}}" width="50">
									</a>
								</td>
								<td>
								@if($record->product)
									<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.index'):route('admin.product.index')}}/{{$record->id}}">
										{{$record->product->title}}
									</a><br />{{$record->product->excerpt()}}
								@endif
								</td>
								<td>{{$record->currency}} {{number_format($record->price, 0, '.', ' ')}} / {{number_format($record->tma, 0, '.', ' ')}}</td>
								<td>{{$record->created_at->diffForHumans()}}</td>
								<td>
									<a href="#">
										 @if($record->status=='ordered')
										 <span class="label label-success">{{$record->status}}</span>
										 @else
										 <span class="label label-warning">{{$record->status}}</span>
										 @endif
									 </a>
								</td>
								<td>
									@if($record->apl)
									<a href="#">{{$record->apl->name}}</a>
									<p>{{$record->apl_paid_at?$record->apl_paid_at->diffForHumans():''}}</p>
									@endif
								</td>
								<td>
									@if($record->afa)
									<a href="#">{{$record->afa->name}}</a>
									@endif
								</td>
								<td>
									@if($record->author)
									<a href="#">{{$record->author->name}}</a>
									@endif
								</td>
								<td class="actions-cell text-center" width="12%">
									<form class="form-inline" action="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.sale.index'):route('admin.sale.index')}}/{{$record->id}}" method="POST">
										@if($record->status=='ordered')
											@if(!$record->apl_paid_at)
												<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.sale.pay', ['cartitem'=>$record, 'role'=>'apl']):route('admin.sale.pay', ['cartitem'=>$record, 'role'=>'apl'])}}" class="btn btn-default btn-circle" title="@lang('app.admin.sale.pay.apl')">
													<i class="fa fa-credit-card" aria-hidden="true"></i>
												</a>&nbsp;&nbsp;
											@endif
							
											@if(!$record->afa_paid_at)
												<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.sale.pay', ['cartitem'=>$record, 'role'=>'afa']):route('admin.sale.pay', ['cartitem'=>$record, 'role'=>'afa'])}}" class="btn btn-default btn-circle" title="@lang('app.admin.sale.pay.afa')">
													<i class="fa fa-cc-visa"></i>
												</a>&nbsp;&nbsp;
											@endif
										@endif
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button type="button" class="btn btn-default btn-circle" title="Suppression" id="delRecord"><i class="fa fa-times text-danger"></i>
										</button>
										
										<?php /*?><a href="{{Auth::user()->isAdminDelegate()?:route('admin.sale.index')}}/{{$record->id}}" title="Détail"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
									
										<a href="{{Auth::user()->isAdminDelegate()?:route('admin.sale.index')}}/{{$record->id}}/edit" title="Modification"><i class="fa fa-pencil-square-o"></i></a>
									
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button style="outline: none;background: transparent;border: none;"
												onclick="return confirm('Vous êtes sur?')"
												type="submit" class="fa fa-trash text-danger" title="Suppression">
										</button><?php */?>
									</form>
								</td>
                            </tr>
                        @empty
                            @include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 24])
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

@section('custom-script')
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