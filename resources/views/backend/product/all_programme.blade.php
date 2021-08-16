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
								<a href="{{route('produit.programme', $record->id)}}" title="@lang('app.table.product_programme')">
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

@endsection
