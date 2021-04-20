@extends('admin.layouts.app') @section('title', 'Products - Listes ') @section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Produits</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.product.index') }}">Programme</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ route('admin.product.create') }}?type=programme" type="button" class="btn btn-primary btn-block">
				<i class="fa fa-plus"></i> Ajouter un nouveau programme 
			</a>
        </div>
    </div>
</div>

@endsection @section('content')
<div class="row">
	<div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Programmes</h5>
            </div>
            <div class="ibox-content">
                <table class="table table-striped grid-view-tbl">
                    <thead>
                        <tr class="header-row">
							{!!\Nvd\Crud\Html::sortableTh('id','admin.product.index','Id')!!}
							{!!\Nvd\Crud\Html::sortableTh('image_id','admin.product.index','Image')!!}
							{!!\Nvd\Crud\Html::sortableTh('title','admin.product.index','Titre')!!}
							{!!\Nvd\Crud\Html::sortableTh('category_id','admin.product.index','Categorie')!!}
							{!!\Nvd\Crud\Html::sortableTh('created_at','admin.product.index','Date')!!}
							{!!\Nvd\Crud\Html::sortableTh('status','admin.product.index','Statut')!!}
							{!!\Nvd\Crud\Html::sortableTh('author_id','admin.product.index','Auteur')!!}
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
										<option value="">Choisir statut</option>
										@foreach($status as $st)
										<option value="{{$st}}" {{@$_GET['status']==$st?'selected':''}}>{{$st}}</option>
										@endforeach
									</select>
								</td>
								<td><input type="text" class="form-control" name="author_id" value="{{Request::input("author_id")}}"></td>
                                <td style="min-width: 6em;">@include('vendor.crud.single-page-templates.common.search-btn')</td>
                            </form>
                        </tr>
                    </thead>

                    <tbody>
						
                        @forelse ( $records as $record )
                        <tr>
                            <td align="center">
                                {{ $record->id }}
                            </td>
							<td>
								@if (@getimagesize($record->imageUrl()))
									<img src="{{$record->imageUrl()}}" class="img-responsive" style="height:80px" />
								@else
									<img class="img-responsive" src="{{asset('img/500x500.jpg')}}" width="80">
								@endif
                            </td>
							<td>
                                <span
                                    class="editable"
                                    data-type="text"
                                    data-name="title"
                                    data-value="{{ $record->title }}"
                                    data-pk="{{ $record->{$record->getKeyName()} }}"
                                    data-url="{{ route('admin.product.index')}}/{{ $record->{$record->getKeyName()} }}"
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
                                    data-url="{{ route('admin.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                >
                                    {{ $record->category->title }}
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
                                    data-url="{{ route('admin.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                >
									@if($record->status=='published')
									<span class="label label-success">@lang('app.'.$record->status)</span>
									@else
									<span class="label label-warning">@lang('app.'.$record->status)</span>
									@endif
                                </span>
                            </td>
							<td>
                                <span
                                    class="editable"
                                    data-type="text"
                                    data-name="author_id"
                                    data-value="{{ $record->author_id }}"
                                    data-pk="{{ $record->{$record->getKeyName()} }}"
                                    data-url="{{ route('admin.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                >
                                    {{ $record->author->name }}
                                </span>
                            </td>
							<td class="actions-cell text-center" width="12%">
								<form class="form-inline" action="{{route('admin.product.index')}}/{{$record->id}}" method="POST">
									<a href="{{route('admin.product.index')}}/{{$record->id}}" class="btn btn-default btn-circle" title="Détail">
										<i class="fa fa-eye"></i>
									</a>&nbsp;&nbsp;
									<a href="{{route('admin.product.index')}}/{{$record->id}}/edit" class="btn btn-default btn-circle" title="Modification">
										<i class="fa fa-pencil-square-o"></i>
									</a>&nbsp;&nbsp;
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<button onclick="return confirm('Vous êtes sur?')"
											type="submit" class="btn btn-default btn-circle" title="Suppression"><i class="fa fa-times text-danger"></i>
									</button>
							</td>
                        </tr>
                        @empty @include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 40]) @endforelse
                    </tbody>
                </table>

                @include('vendor.crud.single-page-templates.common.pagination', [ 'records' => $records ] )

                <script>
                    $(".editable").editable({ ajaxOptions: { method: "PUT" } });
                </script>
            </div>
        </div>
    </div>
</div>
@endsection
