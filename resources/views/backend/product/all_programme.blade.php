@extends('layouts.backend')

@section('subcontent')
<div class="col-lg-8 col-xl-9">
    <div class="profile-content-area m-40px-tb">
		<div class="card m-40px-b">
			<div class="card-header">
				<div class="row">
					<div class="col-5 col-lg-8">
						<span class="h6 font-w-500">{{$title}}</span>
					</div>
					<div class="col-7 col-lg-4 text-right">
						<a href="{{route('nouveau-programmes')}}" class="m-btn m-btn-radius m-btn-theme m-btn-sm">@lang('app.txt.add_new_programme') </a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<table class="table table-bordered" style="font-size:12px">
					<thead>
						<tr>
							<th>ID</th>
							<th>Image</th>
							<th>Titre</th>
							<th>Categorie</th>
							<th>Statut</th>
							<th>Action</th>
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
								<img src="{{asset($photo_principal->filepath)}}" class="img-responsive" style="height:50px" />
								@else
								<!-- Programme principal -->
								<img src="{{asset($first_photo->filepath)}}" class="img-responsive" style="height:50px" />
								@endif
							@else
								<!-- Programme aucun photo -->
								<img class="img-responsive" src="{{asset('images/product.png')}}" style="height:50px">
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
								<a href="{{route('produit.programme', $record->id)}}" title="Produits programme">
									<i class="fa fa-building"></i>
								</a>&nbsp;
								<a href="{{route('edit.programme', $record->id)}}" title="@lang('app.table.btn_title_modification')">
									<i class="fa fa-edit"></i>
								</a>&nbsp;
								<a href="" title="@lang('app.table.btn_title_modification')">
									<i class="fa fa-trash text-danger"></i>
								</a>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
