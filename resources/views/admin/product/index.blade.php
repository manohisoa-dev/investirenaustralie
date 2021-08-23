@extends('admin.layouts.app') @section('title', 'Products - Listes ') @section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.products')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.index'):route('admin.product.index') }}">@lang('app.txt.products')</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.lists')</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            {{--<a href="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.create'):route('admin.product.create') }}?type=produit" type="button" class="btn btn-primary btn-block">
				<i class="fa fa-plus"></i> @lang('app.txt.add_new_product') 
			</a>--}}
        </div>
    </div>
</div>
@endsection @section('content')
<div class="row">
	<div class="col-lg-12">
        <div class="tabs-container">
			<ul class="nav nav-tabs" role="tablist">
				<li><a class="nav-link {{$nature == 'Programme immobilier' ? 'active' : ''}}" href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.index'):route('admin.product.index')}}?nature=Programme immobilier"> Programme immobilier</a></li>
				<li><a class="nav-link {{$nature == 'Produit isolé' ? 'active' : ''}}" href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.index'):route('admin.product.index')}}?nature=Produit isolé">Produit isolé</a></li>
			</ul>
			<div class="tab-content">
				<div class="ibox-content">
					<div class="table-responsive">
					<table class="table table-striped grid-view-tbl">
						<thead>
							<tr class="header-row">
								{!!\Nvd\Crud\Html::sortableTh('id','admin.product.index','Id')!!}
								{!!\Nvd\Crud\Html::sortableTh('image_id','admin.product.index','Image')!!}
								{!!\Nvd\Crud\Html::sortableTh('title','admin.product.index','Titre')!!}
								{!!\Nvd\Crud\Html::sortableTh('price','admin.product.index','Prix')!!}
								{!!\Nvd\Crud\Html::sortableTh('created_at','admin.product.index','Date')!!}
								{!!\Nvd\Crud\Html::sortableTh('status','admin.product.index','Statut')!!}
								{!!\Nvd\Crud\Html::sortableTh('seller_id','admin.product.index','Vendeur')!!}
								{!!\Nvd\Crud\Html::sortableTh('author_id','admin.product.index','Auteur')!!}
								<th>Programme</th>
								<th><a href="javascript:void(0)">@lang('app.table.actions')</a></th>
								
							</tr>
							<tr class="search-row">
								<form class="search-form">
									<td style="width:2%"><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
									<td><input type="text" class="form-control" name="image_id" value="{{Request::input("image_id")}}"></td>
									<td><input type="text" class="form-control" name="title" value="{{Request::input("title")}}"></td>
									<td><input type="text" class="form-control" name="price" value="{{Request::input("price")}}"></td>    
									<td><input type="text" class="form-control" name="created_at" value="{{Request::input("created_at")}}"></td>  
									<td>
										<select class="form-control" name="status">
											<option value="">@lang('app.form.choix_status')</option>
											@foreach($status as $st)
											<option value="{{$st}}" {{@$_GET['status']==$st?'selected':''}}>{{$st}}</option>
											@endforeach
										</select>
									</td>
									<td><input type="text" class="form-control" name="seller_id" value="{{Request::input("seller_id")}}"></td>
									<td><input type="text" class="form-control" name="author_id" value="{{Request::input("author_id")}}"></td>
									<td></td>
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
									@if (@getimagesize($record->imageUrl()))
										<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.index'):route('admin.product.index')}}/{{$record->id}}">
											<img src="{{$record->imageUrl()}}" class="img-responsive" style="height:80px" />
										</a>
									@else
										<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.index'):route('admin.product.index')}}/{{$record->id}}">
											<img class="img-responsive" src="{{asset('img/500x500.jpg')}}" width="80">
										</a>
									@endif
									
								</td>
								<td>
									<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.index'):route('admin.product.index')}}/{{$record->id}}">
									<span
										class="editable"
										data-type="text"
										data-name="title"
										data-value="{{ $record->title }}"
										data-pk="{{ $record->{$record->getKeyName()} }}"
										data-url="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.index'):route('admin.product.index')}}/{{ $record->{$record->getKeyName()} }}"
									>
										{{ $record->title }}
									</span></a><br />
									{!! $record->excerpt() !!}
									</span>                            
								</td>
	
								<td>
									<span
										class="editable"
										data-type="text"
										data-name="price"
										data-value="{{ $record->price }}"
										data-pk="{{ $record->{$record->getKeyName()} }}"
										data-url="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.index'):route('admin.product.index')}}/{{ $record->{$record->getKeyName()} }}"
									>
										{{ $record->currency }}&nbsp;{{ number_format($record->price, 0, '.', ' ') }}
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
										data-url="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.index'):route('admin.product.index')}}/{{ $record->{$record->getKeyName()} }}"
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
								@if($record->seller_id != 0)
									<span
										class="editable"
										data-type="text"
										data-name="seller_id"
										data-value="{{ $record->seller_id }}"
										data-pk="{{ $record->{$record->getKeyName()} }}"
										data-url="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.index'):route('admin.product.index')}}/{{ $record->{$record->getKeyName()} }}"
									>
										{{ $record->seller->name }}
									</span>
								@endif
								</td>
								<td>
									<span
										class="editable"
										data-type="text"
										data-name="author_id"
										data-value="{{ $record->author_id }}"
										data-pk="{{ $record->{$record->getKeyName()} }}"
										data-url="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.index'):route('admin.product.index')}}/{{ $record->{$record->getKeyName()} }}"
									>
										{{ $record->author->name }}
									</span>
								</td>
								<td>
									@if($record->parent_id != 0)
										{{\App\Models\Product::where('id',$record->parent_id)->value('title') }}
									@endif								
								</td>
								<td class="actions-cell text-center" width="12%">
									<form class="form-inline" action="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.index'):route('admin.product.index')}}/{{$record->id}}" method="POST">
										{{-- <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.'):route('admin.product.index')}}/{{$record->id}}" class="btn btn-default btn-circle" title="Détail">
											<i class="fa fa-eye"></i>
										</a>&nbsp;&nbsp; --}}
										<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.index'):route('admin.product.index')}}/{{$record->id}}/edit" class="btn btn-default btn-circle" title="Modification">
											<i class="fa fa-pencil-square-o"></i>
										</a>&nbsp;&nbsp;
										@if($record->status=='pinged' || $record->status=='archived')
											<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.publish', $record->id):route('admin.product.publish', $record->id)}}" class="btn btn-default btn-circle" title="@lang('app.btn.publish')">
												<i class="fa fa-check"></i>
											</a>&nbsp;&nbsp;
											<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.trash', $record->id):route('admin.product.trash', $record->id)}}" class="btn btn-default btn-circle" title="@lang('app.btn.trash')">
												<i class="fa fa-trash-o"></i>
											</a>&nbsp;&nbsp;
										@elseif($record->status=='trashed')
											<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.restore', $record->id):route('admin.product.restore', $record->id)}}" class="btn btn-default btn-circle" title="Restore">
												<i class="fa fa-window-restore"></i>
											</a>&nbsp;&nbsp;
										@endif
										@if($record->status=='published')
											<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.archive', $record->id):route('admin.product.archive', $record->id)}}" class="btn btn-default btn-circle" title="@lang('app.btn.archive')">
												<i class="fa fa-archive"></i>
											</a>&nbsp;&nbsp;
											<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.trash', $record->id):route('admin.product.trash', $record->id)}}" class="btn btn-default btn-circle" title="@lang('app.btn.trash')">
												<i class="fa fa-trash-o"></i>
											</a>&nbsp;&nbsp;
										@endif
										@if($record->status=='waiting')
											<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.product.publish', $record->id):route('admin.product.publish', $record->id)}}" class="btn btn-default btn-circle" title="@lang('app.btn.validate')">
												<i class="fa fa-check text-info"></i>
											</a>&nbsp;&nbsp;
										@endif
										
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										
										
										<button type="button" class="btn btn-default btn-circle" title="Suppression" id="delRecord"><i class="fa fa-times text-danger"></i>
										</button>
									</form>
								</td>
							</tr>
							@empty @include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 40]) @endforelse
						</tbody>
					</table>
					</div>
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