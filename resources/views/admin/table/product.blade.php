<table class="table boo-table table-striped table-hover">
 <thead>
     <tr>
         <th scope="col">@lang('app.table.id') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.photo') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.title')/@lang('app.table.content') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.price')/@lang('app.table.tma') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.date') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.status') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.seller') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.author') <span class="column-sorter"></span></th>
         <th scope="col">@lang('app.table.actions') </th>
     </tr>
 </thead>
 <tbody>
     @foreach($products as $product)
     <tr>
         <td>{{$product->id}}</td>
         <td>
             <a href="{{route('admin.product.show', ['product'=>$product])}}"><img class="thumb" src="{{$product->imageUrl()}}" width="50"></a>
         </td>
         <td>
             <a href="{{route('admin.product.show', ['product'=>$product])}}">{{$product->title}}</a><br>
             {{$product->excerpt()}}
         </td>
         <td>{{$product->currency}} {{$product->price}} / {{$product->tma}}</td>
         <td>{{$product->created_at->diffForHumans()}}</td>
         <td>
             <a href="<?php /*?>{{route('admin.product.list', ['filter'=>$product->status])}}<?php */?>">
                 @if($product->status=='published')
                 <span class="label label-success">{{$product->status}}</span>
                 @else
                 <span class="label label-warning">{{$product->status}}</span>
                 @endif
             </a>
         </td>
         <td>
             @if($product->seller)
             <a href="{{route('admin.user.show', $product->seller)}}">{{$product->seller->name}}</a>
             @endif
         </td>
         <td>
             @if($product->author)
             <a href="{{route('admin.user.show', $product->author)}}">{{$product->author->name}}</a>
             @endif
         </td>
         <td>
		 <form class="form-inline" action="{{route('admin.product.index')}}/{{$product->id}}" method="POST">
         @if($product->status=='pinged' || $product->status=='archived')
            <a href="{{route('admin.product.publish', $product)}}" class="btn btn-default btn-circle" title="@lang('app.btn.publish')"><i class="fa fa-check"></i></a>&nbsp;&nbsp;
            <a href="{{route('admin.product.trash', $product)}}" class="btn btn-default btn-circle" title="@lang('app.btn.trash')"><i class="fa fa-trash-o"></i></a>&nbsp;&nbsp;
         @elseif($product->status=='trashed')
            <a href="{{route('admin.product.restore', $product)}}" class="btn btn-default btn-circle" title="Restore"><i class="fa fa-window-restore"></i></a>&nbsp;&nbsp;
         @endif
         @if($product->status=='published')
            <a href="{{route('admin.product.archive', $product)}}" class="btn btn-default btn-circle" title="@lang('app.btn.archive')"><i class="fa fa-archive"></i></a>&nbsp;&nbsp;
            <a href="{{route('admin.product.trash', $product)}}" class="btn btn-default btn-circle" title="@lang('app.btn.trash')"><i class="fa fa-trash-o"></i></a>&nbsp;&nbsp;
         @endif
			{{ csrf_field() }}
			{{ method_field('DELETE') }}
			<button onclick="return confirm('Vous êtes sur?')"
				type="submit" class="btn btn-default btn-circle" title="Suppression"><i class="fa fa-times text-danger"></i>
			</button>
		 </form>
         </td>
     </tr>
     @endforeach
 </tbody>
</table>