@extends('admin.layouts.app') @section('title', 'Products - Listes ') @section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.all_programmes')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.product.index') }}">@lang('app.txt.programme') </a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.liste') </strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ route('admin.product.create') }}?type=programme" type="button" class="btn btn-primary btn-block">
				<i class="fa fa-plus"></i> @lang('app.txt.add_new_programme') 
			</a>
        </div>
    </div>
</div>

@endsection @section('content')
<div class="row">
	<div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>@lang('app.txt.list_programme')</h5>
            </div>
            <div class="ibox-content">
				<div class="table-responsive">
                <table class="table table-striped grid-view-tbl">
                    <thead>
                        <tr class="header-row">
							{!!\Nvd\Crud\Html::sortableTh('id','admin.product.programme','Id')!!}
							{!!\Nvd\Crud\Html::sortableTh('image_id','admin.product.programme','Image')!!}
							{!!\Nvd\Crud\Html::sortableTh('title','admin.product.programme','Titre')!!}
							{!!\Nvd\Crud\Html::sortableTh('category_id','admin.product.programme','Categorie')!!}
							{!!\Nvd\Crud\Html::sortableTh('created_at','admin.product.programme','Date')!!}
							{!!\Nvd\Crud\Html::sortableTh('status','admin.product.programme','Statut')!!}
							{!!\Nvd\Crud\Html::sortableTh('min_price','admin.product.programme','Prix min')!!}
							{!!\Nvd\Crud\Html::sortableTh('max_price','admin.product.programme','Prix max')!!}
							{!!\Nvd\Crud\Html::sortableTh('author_id','admin.product.programme','Auteur')!!}
                            <th><a href="javascript:void(0)">Actions</a></th>
							
                        </tr>
                        <tr class="search-row">
                            <form class="search-form">
                                <td style="width:2%"><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
								<td><input type="text" class="form-control" name="image_id" value="{{Request::input("image_id")}}"></td>
								<td><input type="text" class="form-control" name="title" value="{{Request::input("title")}}"></td> 
								<td><input type="text" class="form-control" name="category_id" value="{{Request::input("category_id")}}"></td> 
								<td><input type="text" class="form-control" name="created_at" value="{{Request::input("created_at")}}"></td>  
								<td>
									<select class="form-control" name="status">
										<option value="">@lang('app.form.choix_status')</option>
										@foreach($status as $st)
										<option value="{{$st}}" {{@$_GET['status']==$st?'selected':''}}>{{$st}}</option>
										@endforeach
									</select>
								</td>
								<td><input type="text" class="form-control" name="min_price" value="{{Request::input("min_price")}}"></td>
								<td><input type="text" class="form-control" name="max_price" value="{{Request::input("max_price")}}"></td>
								<td><input type="text" class="form-control" name="author_id" value="{{Request::input("author_id")}}"></td>
                                <td style="min-width: 6em;">@include('vendor.crud.single-page-templates.common.search-btn')</td>
                            </form>
                        </tr>
                    </thead>

                    <tbody>
						
                        @forelse ( $records as $index =>$record )
                        <tr>
                            <td align="center">
                                {{ $index + $records->firstItem() }}
                            </td>
							<td>
							@php
								$photo_principal = \App\Models\ProductsImage::where('products_images.product_id', '=', $record->id)->where('products_images.is_principal', '=', 1)->join('images', 'products_images.image_id', '=', 'images.id')->first();
								$first_photo = \App\Models\ProductsImage::where('products_images.product_id', '=', $record->id)->join('images', 'products_images.image_id', '=', 'images.id')->first();
								
							@endphp
							@if($first_photo)
								@if($photo_principal)
								<!-- Programme sans principal -->
								<img src="{{asset($photo_principal->filepath)}}" class="img-responsive" style="height:80px" />
								@else
								<!-- Programme principal -->
								<img src="{{asset($first_photo->filepath)}}" class="img-responsive" style="height:80px" />
								@endif
							@else
								<!-- Programme aucun photo -->
								<img class="img-responsive" src="{{asset('images/product.png')}}" width="80">
							@endif								
                            </td>
							<td>
                                <span
                                    class="editable"
                                    data-type="text"
                                    data-name="title"
                                    data-value="{{ $record->title }}"
                                    data-pk="{{ $record->{$record->getKeyName()} }}"
                                    data-url="{{ route('admin.product.programme')}}/{{ $record->{$record->getKeyName()} }}"
                                >
                                    {{ $record->title }}
                                </span><br />
								{!! $record->excerpt() !!}
                                </span>                            
							</td>
							<td>
                                <span
                                    class="editable"
                                    data-type="text"
                                    data-name="title"
                                    data-value="{{ $record->category_id }}"
                                    data-pk="{{ $record->{$record->getKeyName()} }}"
                                    data-url="{{ route('admin.product.programme')}}/{{ $record->{$record->getKeyName()} }}"
                                >
                                    @if ($record->category) 
									{{ $record->category->title }}
									@endif
                                </span>                          
							</td>
							<td>
                                {{ $record->created_at ? $record->created_at->diffForHumans() : '' }}
                            </td>
							<td>
                                <span
                                    class="editable"
                                    data-type="text"
                                    data-name="status"
                                    data-value="{{ $record->status }}"
                                    data-pk="{{ $record->{$record->getKeyName()} }}"
                                    data-url="{{ route('admin.product.programme')}}/{{ $record->{$record->getKeyName()} }}"
                                >
                                    @if($record->status=='published')
                                        <span class="label label-success">@lang('app.'.$record->status)</span>
                                    @elseif($record->status=='waiting')
                                        <span class="label label-danger">@lang('app.'.$record->status)</span>
                                    @else
                                        <span class="label label-warning">@lang('app.'.$record->status)</span>
                                    @endif
                                </span>
                            </td>
							<td>
                                <span
                                    class="editable"
                                    data-type="number"
                                    data-name="min_price"
                                    data-value="{{ $record->min_price }}"
                                    data-pk="{{ $record->{$record->getKeyName()} }}"
                                    data-url="{{ route('admin.product.programme')}}/{{ $record->{$record->getKeyName()} }}"
                                >
                                    {{ $record->min_price }}
                                </span>
                            </td>
							<td>
                                <span
                                    class="editable"
                                    data-type="text"
                                    data-name="max_price"
                                    data-value="{{ $record->max_price }}"
                                    data-pk="{{ $record->{$record->getKeyName()} }}"
                                    data-url="{{ route('admin.product.programme')}}/{{ $record->{$record->getKeyName()} }}"
                                >
                                    {{ $record->max_price }}
                                </span>
                            </td>
							<td>
                                <span
                                    class="editable"
                                    data-type="text"
                                    data-name="author_id"
                                    data-value="{{ $record->author_id }}"
                                    data-pk="{{ $record->{$record->getKeyName()} }}"
                                    data-url="{{ route('admin.product.programme')}}/{{ $record->{$record->getKeyName()} }}"
                                >
                                    {{ $record->author->name }}
                                </span>
                            </td>
							<td class="actions-cell text-center" width="12%">
								<form class="form-inline" action="{{route('admin.product.index')}}/{{$record->id}}" method="POST">
									<?php /*?><a href="{{route('admin.product.index')}}/{{$record->id}}" class="btn btn-default btn-circle" title="@lang('app.table.btn_title_detail')">
										<i class="fa fa-eye"></i>
									</a>&nbsp;&nbsp;<?php */?>
									<a href="{{route('admin.product.index')}}/{{$record->id}}/edit" class="btn btn-default btn-circle" title="@lang('app.table.btn_title_modification')">
										<i class="fa fa-pencil-square-o"></i>
									</a>&nbsp;&nbsp;
                                    @if($record->status=='waiting')
										<a href="{{route('admin.product.publish', $record->id)}}" class="btn btn-default btn-circle" title="@lang('app.btn.validate')">
											<i class="fa fa-check text-info"></i>
										</a>&nbsp;&nbsp;
									@endif
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<button type="button" class="btn btn-default btn-circle" title="@lang('app.table.btn_title_delete')" id="delRecord"><i class="fa fa-times text-danger"></i>
									</button>
								</form>
							</td>
                        </tr>
                        @empty @include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 40]) @endforelse
                    </tbody>
                </table>
                @include('vendor.crud.single-page-templates.common.pagination', [ 'records' => $records ] )
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
