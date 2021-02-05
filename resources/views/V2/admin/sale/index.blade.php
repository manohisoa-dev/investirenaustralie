@extends('V2.admin.layouts.app')

@section('title', 'Vente - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Ventes</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('V2.admin.sale.index') }}">Ventes</a>
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
				<h5>Ventes</h5>
			</div>
			<div class="ibox-content">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
						{!!\Nvd\Crud\Html::sortableTh('id','V2.admin.sale.index','Id')!!}
						<th>@lang('app.table.photo')</th>
						<th>@lang('app.table.title')/@lang('app.table.content')</th>
						<th>@lang('app.table.price')/@lang('app.table.tma')</th>
						{!!\Nvd\Crud\Html::sortableTh('created_at','V2.admin.sale.index','Date')!!}
						<th>@lang('app.table.status')</th>
						<th>@lang('app.table.apl')</th>
						<th>@lang('app.table.afa')</th>
						<th>@lang('app.table.customer')</th>
						<th><a href="javascript:void(0)">Actions</a></th>
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
                        @forelse ( $records as $record )
                            <tr>
                            	<td>{{ $record->id }} </td>
								<td><img class="thumb" src="{{$record->product->imageUrl()}}" width="50"></td>
								<td>
								@if($record->product)
									<a href="#">{{$record->product->title}}</a><br />{{$record->product->excerpt()}}
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
									<form class="form-inline" action="{{route('V2.admin.sale.index')}}/{{$record->id}}" method="POST">
										@if($record->status=='ordered')
											@if(!$record->apl_paid_at)
												<a href="{{route('V2.admin.sale.pay', ['cartitem'=>$record, 'role'=>'apl'])}}" class="btn btn-default btn-circle" title="@lang('app.admin.sale.pay.apl')">
													<i class="fa fa-handshake-o" aria-hidden="true"></i>
												</a>&nbsp;&nbsp;
											@endif
							
											@if(!$record->afa_paid_at)
												<a href="#" class="btn btn-default btn-circle" title="@lang('app.admin.sale.pay.afa')">
													<i class="fa fa-university"></i>
												</a>&nbsp;&nbsp;
											@endif
										@endif
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button onclick="return confirm('Vous êtes sur?')" class="btn btn-default btn-circle" title="@lang('app.btn.delete')">
											<i class="fa fa-trash-o text-danger"></i>
										</button>
										
										<?php /*?><a href="{{route('V2.admin.sale.index')}}/{{$record->id}}" title="Détail"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
									
										<a href="{{route('V2.admin.sale.index')}}/{{$record->id}}/edit" title="Modification"><i class="fa fa-pencil-square-o"></i></a>
									
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
@endsection
