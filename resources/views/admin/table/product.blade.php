<table class="table boo-table table-striped table-hover">
 <thead>
     <tr>
         <th scope="col">@lang('app.table.id') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.photo') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.title')/@lang('app.table.content') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.price')<span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.date') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.status') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.seller') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.author') <span class="column-sorter"></span></th>
     </tr>
 </thead>
 <tbody>
     @foreach($products as $product)
	 @if($product->parent_id != 0)
     <tr>
         <td>{{$product->id}}</td>
         <td>
             <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.show', ['product'=>$product]):route('admin.product.show', ['product'=>$product])}}">
			 	
				@php
					$photo_principal = \App\Models\ProductsImage::where('products_images.product_id', '=', $product->id)->where('products_images.is_principal', '=', 1)->join('images', 'products_images.image_id', '=', 'images.id')->first();
					$first_photo = \App\Models\ProductsImage::where('products_images.product_id', '=', $product->id)->join('images', 'products_images.image_id', '=', 'images.id')->first();
					
				@endphp
				@if($first_photo)
					@if($photo_principal)
					<!-- Programme sans principal -->
					<img src="{{asset(getImageResizeUrl('product', $photo_principal->filename, 'mini'))}}" class="thumb"/>
					@else
					<!-- Programme principal -->
					<img src="{{asset(getImageResizeUrl('product', $first_photo->filename, 'mini'))}}" class="thumb"/>
					@endif
				@else
					<!-- Programme aucun photo -->
					<img class="img-responsive" src="{{asset('images/product.png')}}" width="50px">
				@endif
			 </a>
         </td>
         <td>
             <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.show', ['product'=>$product]):route('admin.product.show', ['product'=>$product])}}">{{$product->title}}</a>
         </td>
         <td>
		 	@if($product->parent_id == -1)
				AUD {{ number_format($product->price, 0, '.', ' ') }}
			@else
				AUD {{ number_format($product->min_price, 0, '.', ' ') }} / AUD {{ number_format($product->max_price, 0, '.', ' ') }}
			@endif
		 </td>
         <td>{{$product->created_at->diffForHumans()}}</td>
         <td>
             {{-- <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.list', ['filter'=>$product->status]):route('admin.product.list', ['filter'=>$product->status])}}"> --}}
             <a href="#">
                 @if($product->status=='published')
                 <span class="label label-success">{{$product->status}}</span>
                 @else
                 <span class="label label-warning">{{$product->status}}</span>
                 @endif
             </a>
         </td>
         <td>
             @if($product->seller)
             <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.show', $product->seller):route('admin.user.show', $product->seller)}}">{{$product->seller->name}}</a>
             @endif
         </td>
         <td>
             @if($product->author)
             <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.show', $product->author):route('admin.user.show', $product->author)}}">{{$product->author->name}}</a>
             @endif
         </td>
     </tr>
	 @endif
     @endforeach
 </tbody>
</table>