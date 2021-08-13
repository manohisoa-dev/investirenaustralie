@extends('layouts.backend')

@section('subcontent')

	@if($aplActive->apl_id != 0)
    <div class="profile-content-area m-40px-tb">
		<div class="card m-40px-b">
			<div class="card-header">
				<div class="row">
					<div class="col-5 col-lg-8">
						<span class="h6 font-w-500">@lang('member.relation_active')</span>
					</div>
				</div>
			</div>
			<div class="card-body">
				<table class="table table-bordered" style="font-size:12px">
					<thead>
						<tr>
							<th>@lang('app.table.photo')</th>
							<th>@lang('app.table.apl')</th>							
							<th>@lang('app.table.email')</th>
							<th>@lang('app.table.end_date')</th>
							<th width="15%">@lang('app.table.action')</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								@if (@getimagesize($aplActive->apl->imageUrl()))
									<img class="img-responsive" src="{{$aplActive->apl->imageUrl()}}" width="50">
								@else
									<img class="img-responsive" src="{{asset('img/500x500.jpg')}}" width="50">
								@endif
							</td>
							<td>{{ $aplActive->apl->name }}</td>
							<td>{{ $aplActive->apl->email }}</td>
							<td>{{\Carbon\Carbon::parse($aplActive->apl_ends_at)->formatLocalized('%d %b %Y')}}</td>
							<td align="center">
								<a href="javascript:void(0)" onclick="renew_relation({{$aplActive->id}})" class="btn btn-default btn-circle" title="@lang('app.txt.renew_relationship')">
									<i class="icon-refresh text-success"></i>
								</a>
								{{--<a href="javascript:void(0)" onclick="annuler_relation({{$aplActive->id}})" class="btn btn-default btn-circle" title="@lang('app.txt.end_relationship')">
									<i class="fa fa-times text-danger"></i>
								</a>--}}
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	@endif
	
	<div class="profile-content-area m-40px-tb">
		<div class="card m-40px-b">
			<div class="card-header">
				<div class="row">
					<div class="col-5 col-lg-8">
						<span class="h6 font-w-500">@lang('member.historique_relation')</span>
					</div>
				</div>
			</div>
			<div class="card-body">
				@if(count($allApl) > 0)
				<table class="table table-bordered" style="font-size:12px">
					<thead>
						<tr>
							<th>@lang('app.table.apl')</th>							
							<th>@lang('app.table.email')</th>
							<th>@lang('app.table.start_date')</th>
							<th>@lang('app.table.end_date')</th>
						</tr>
					</thead>
					<tbody>
					@foreach($allApl as $index =>$record)
						<tr>
							<td>{{ $record->Users->name }}</td>
							<td>{{ $record->Users->email }}</td>
							<td>{{\Carbon\Carbon::parse($record->dt_debut_relation)->formatLocalized('%d %b %Y')}}</td>
							<td>{{\Carbon\Carbon::parse($record->dt_end_relation)->formatLocalized('%d %b %Y')}}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				@endif
			</div>
		</div>
	</div>

@endsection

@push('script')
	<script src="{{ asset('administrator/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
	<script>
	function annuler_relation(id_membre)
	{
		swal({
			title: "Relation Membre & APL",
			text: "@lang('app.txt.confirm.end_relationship')",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: '#ff3547',
			confirmButtonText: "@lang('app.yes')",
			cancelButtonText: "@lang('app.no')",
			closeOnConfirm: false,
			closeOnCancel: false
		 },
		 function(isConfirm){	
		   if (isConfirm){
				 $.ajax({
					url : "{{ route('member.ajaxDropRelation') }}",
					type: "POST",
					dataType: "JSON",
					data:{"_token": "{{ csrf_token() }}",'id_membre':id_membre},
					success: function(data)
					{
						swal("Relation Membre & APL", "@lang('app.jquery.delete_product_yes')", "success");
						location.reload();	
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						swal("Relation Membre & APL", "@lang('app.jquery.error_delete')", "error");
						location.reload();	
					}
				}); 
			} else {
				swal("Relation Membre & APL", "@lang('app.jquery.delete_cancel')", "error");
			}
		 });
	}

	function renew_relation(id_membre)
	{
		swal({
			title: "Relation Membre & APL",
			text: "@lang('app.txt.confirm.renew_relationship')",
			type: "info",
			showCancelButton: true,
			confirmButtonColor: '#009FE6',
			confirmButtonText: "@lang('app.yes')",
			cancelButtonText: "@lang('app.no')",
			closeOnConfirm: false,
			closeOnCancel: false
		 },
		 function(isConfirm){	
		   if (isConfirm){
				 $.ajax({
					url : "{{ route('member.ajaxRenewRelation') }}",
					type: "POST",
					dataType: "JSON",
					data:{"_token": "{{ csrf_token() }}",'id_membre':id_membre},
					success: function(data)
					{
						swal("Relation Membre & APL", "@lang('app.jquery.delete_product_yes')", "success");
						location.reload();	
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						swal("Relation Membre & APL", "@lang('app.jquery.error_delete')", "error");
						location.reload();	
					}
				}); 
			} else {
				swal("Relation Membre & APL", "@lang('app.jquery.delete_cancel')", "error");
			}
		 });
	}
	</script>
@endpush