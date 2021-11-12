@extends('admin.layouts.app') @section('title', 'Products - Listes ') @section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.all_programmes')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.index'):route('admin.product.index') }}">@lang('app.txt.programme') </a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.liste') </strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            {{--<a href="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.create'):route('admin.product.create') }}?type=programme" type="button" class="btn btn-primary btn-block">
				<i class="fa fa-plus"></i> @lang('app.txt.add_new_programme') 
			</a>--}}
        </div>
    </div>
</div>

@endsection @section('content')
<div class="row">
	<div class="col-lg-12">
        <div class="tabs-container">
			<ul class="nav nav-tabs" role="tablist">
				<li><a class="nav-link {{$statusPro == 'waiting'?'active':''}}" href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.programme'):route('admin.product.programme')}}?status=waiting">@lang('app.admin.program.list_valid')</a></li>
				<li><a class="nav-link {{$statusPro == 'published'?'active':''}}" href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.programme'):route('admin.product.programme')}}?status=published">@lang('app.admin.program.list_no_valid')</a></li>
			</ul>
			<div class="tab-content">
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
										<img src="{{asset(getImageResizeUrl('product', $photo_principal->filename, 'mini'))}}" class="img-responsive" />
									@else
										<!-- Programme principal -->
										<img src="{{asset(getImageResizeUrl('product', $first_photo->filename, 'mini'))}}" class="img-responsive" />
									@endif
								@else
									<!-- Programme aucun photo -->
									<img class="img-responsive" src="{{asset('images/product.png')}}" width="50px">
								@endif
								</td>
								<td>
									{{ $record->title }}       
								</td>
								<td>
									@if ($record->category) 
										{{ $record->category->title }}
									@endif                        
								</td>
								<td>
									{{ $record->created_at ? $record->created_at->diffForHumans() : '' }}
								</td>
								<td>
									@if($record->status=='published')
										<span class="label label-success">@lang('app.'.$record->status)</span>
									@elseif($record->status=='waiting')
										<span class="label label-danger">@lang('app.'.$record->status)</span>
									@else
										<span class="label label-warning">@lang('app.'.$record->status)</span>
									@endif
								</td>
								<td>
									${{number_format($record->min_price, 0, '.', ' ')}}
								</td>
								<td>
									${{number_format($record->max_price, 0, '.', ' ')}}
								</td>
								<td>
									<span
										class="editable"
										data-type="text"
										data-name="author_id"
										data-value="{{ $record->author_id }}"
										data-pk="{{ $record->{$record->getKeyName()} }}"
										data-url="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.programme'):route('admin.product.programme')}}/{{ $record->{$record->getKeyName()} }}"
									>
										{{ $record->author->name }}
									</span>
								</td>
								<td class="actions-cell text-center" width="12%">
								@if($statusPro == 'published')
									<form class="form-inline" action="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.index'):route('admin.product.index')}}/{{$record->id}}" method="POST">
										<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.index'):route('admin.product.index')}}/{{$record->id}}" class="btn btn-default btn-circle" title="@lang('app.table.btn_title_detail')">
											<i class="fa fa-eye"></i>
										</a>&nbsp;&nbsp;
										{{--<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.index'):route('admin.product.index')}}/{{$record->id}}/edit" class="btn btn-default btn-circle" title="@lang('app.table.btn_title_modification')">
											<i class="fa fa-pencil-square-o"></i>
										</a>&nbsp;&nbsp;--}}
										@if($record->status=='waiting')
											<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.publish', $record->id):route('admin.product.publish', $record->id)}}" class="btn btn-default btn-circle" title="@lang('app.btn.validate')">
												<i class="fa fa-check text-info"></i>
											</a>&nbsp;&nbsp;
										@endif
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button type="button" class="btn btn-default btn-circle" title="@lang('app.table.btn_title_delete')" id="delRecord"><i class="fa fa-times text-danger"></i>
										</button>
									</form>
									@else
										<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.index'):route('admin.product.index')}}/{{$record->id}}" class="btn btn-default btn-circle"><i class="fa fa-eye text-info"></i></a>
									@endif
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
