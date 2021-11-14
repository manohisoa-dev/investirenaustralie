@extends('layouts.backend')

@section('subcontent')

    <div class="profile-content-area m-40px-tb card card-body">
        <div class="tab-style-4">
			<ul class="nav nav-fill nav-tabs">
				<li class="nav-item">
					<a href="{{route('mes-programmes')}}" class="{{Request::is('mes-programmes') ? 'active' : ''}}">
						<div class="icon"><i class="fa fa-briefcase"></i></div>
						<span>@lang('app.tab.title_programme')</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{route('mes-produits')}}" class="{{Request::is('mes-produits') ? 'active' : ''}}">
						<div class="icon"><i class="fa fa-building"></i></div>
						<span>@lang('app.tab.title_produits')</span>
					</a>
				</li>
			</ul>
			<div class="tab-content">
				<table class="table table-bordered" style="font-size:12px">
					<thead>
						<tr>
							<th>ID</th>
							<th>@lang('app.table.produit_image')</th>
							<th>@lang('app.table.produit_titre')</th>
							<th>@lang('app.admin.categories')</th>
							<th>@lang('app.form.product_status')</th>
							<th>@lang('app.table.action')</th>
						</tr>
					</thead>
					<tbody>
					@foreach($records as $index =>$record)
						<tr>
							<td>{{$index + $records->firstItem()}}</td>
							<td>
							@php
								$photo_principal = \App\Models\ProductsImage::where('products_images.product_id', '=', $record->id)->where('products_images.is_principal', '=', 1)->join('images', 'products_images.image_id', '=', 'images.id')->first();
								$first_photo = \App\Models\ProductsImage::where('products_images.product_id', '=', $record->id)->join('images', 'products_images.image_id', '=', 'images.id')->first();
							@endphp
							@if($first_photo)
								@if($photo_principal)
								<!-- Programme sans principal -->
								<img src="{{asset(getImageResizeUrl('product', $photo_principal->filename, 'mini'))}}" class="img-responsive" />
								@else
								<!-- Programme principal -->
								<img src="{{asset(getImageResizeUrl('product', $first_photo->filename, 'mini'))}}" class="img-responsive"/>
								@endif
							@else
								<!-- Programme aucun photo -->
								<img class="img-responsive" src="{{asset('images/product.png')}}" style="width:50px">
							@endif			
							</td>
							<td>{{ $record->title }}</td>
							<td>
							@if ($record->category) 
								{{ $record->category->title }}
							@endif
							</td>
							<td>
							@if($record->status=='published')
								@lang('app.'.$record->status)
							@elseif($record->status=='waiting')
								@lang('app.'.$record->status)
							@else
								@lang('app.'.$record->status)
							@endif
							</td>
							<td align="center">
								@if($record->status=='published')
								<a href="{{route('produit.programme', $record->id)}}" title="@lang('app.table.product_programme')">
									<i class="fa fa-building"></i>
								</a>&nbsp;
								<a href="{{route('edit.programme', $record->id)}}" title="@lang('app.table.btn_title_modification')">
									<i class="fa fa-edit"></i>
								</a>&nbsp;
								<a href="javascript:void(0)" onclick="delete_programme({{$record->id}})" title="@lang('app.table.btn_title_delete')">
									<i class="fa fa-trash text-danger"></i>
								</a>
								@else
								<a href="{{route('edit.programme', $record->id)}}" title="@lang('app.table.btn_title_modification')">
									<i class="fa fa-edit"></i>
								</a>&nbsp;
								<a href="javascript:void(0)" onclick="delete_programme({{$record->id}})" title="@lang('app.table.btn_title_delete')">
									<i class="fa fa-trash text-danger"></i>
								</a>
								@endif
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				{{$records->links("pagination::bootstrap-4")}}
			</div>
		</div>
	</div>

@endsection

@push('script')
<script src="{{ asset('administrator/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script type="text/javascript">
	function delete_programme(id_programm)
	{
		swal({
			title: "@lang('app.txt.programme')",
			text: "@lang('app.dropzone.delete_photo_confirme')",
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
					url : "{{ route('ajaxDropProgramm') }}",
					type: "POST",
					dataType: "JSON",
					data:{"_token": "{{ csrf_token() }}",'id_programm':id_programm},
					success: function(data)
					{
						swal("@lang('app.txt.programme')", "@lang('app.jquery.delete_product_yes')", "success");
						location.reload();	
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						swal("@lang('app.txt.programme')", "@lang('app.jquery.error_delete')", "error");
						location.reload();	
					}
				}); 
			} else {
				swal("@lang('app.txt.programme')", "@lang('app.jquery.delete_cancel')", "error");
			}
		 });
	}
</script>
@endpush
