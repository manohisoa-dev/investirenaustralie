@extends('V2.admin.layouts.app') @section('title', 'Products - Listes ') @section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Products</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('v2.admin.product.index') }}">Products</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ route('v2.admin.product.create') }}" type="button" class="btn btn-primary btn-block"> <i class="fa fa-plus"></i> Ajouter un nouveau Product </a>
        </div>
    </div>
</div>

@endsection @section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Products</h5>
            </div>
            <div class="ibox-content" style="overflow:scroll">
                <table class="table table-striped grid-view-tbl">
                    <thead>
                        <tr class="header-row">
                            {!!\Nvd\Crud\Html::sortableTh('id','v2.admin.product.index','Id')!!} 
							{!!\Nvd\Crud\Html::sortableTh('image_id','v2.admin.product.index','Image')!!}
							{!!\Nvd\Crud\Html::sortableTh('title','v2.admin.product.index','Titre')!!}
							{!!\Nvd\Crud\Html::sortableTh('currency','v2.admin.product.index','Devise')!!}
							{!!\Nvd\Crud\Html::sortableTh('price','v2.admin.product.index','Prix')!!}     
							{!!\Nvd\Crud\Html::sortableTh('created_at','v2.admin.product.index','Date')!!}     
							{!!\Nvd\Crud\Html::sortableTh('status','v2.admin.product.index','Status')!!}
							{!!\Nvd\Crud\Html::sortableTh('seller_id','v2.admin.product.index','Vendeur')!!}
							{!!\Nvd\Crud\Html::sortableTh('author_id','v2.admin.product.index','Auteurs')!!}
                            <th><a href="javascript:void(0)">Actions</a></th>
                        </tr>
                        <tr class="search-row">
                            <form class="search-form">
                                <td style="width:2%"><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
								<td><input type="text" class="form-control" name="image_id" value="{{Request::input("image_id")}}"></td>
								<td><input type="text" class="form-control" name="title" value="{{Request::input("title")}}"></td>
								<td><input type="text" class="form-control" name="currency" value="{{Request::input("currency")}}"></td>
								<td><input type="text" class="form-control" name="price" value="{{Request::input("price")}}"></td>    
								<td><input type="text" class="form-control" name="created_at" value="{{Request::input("created_at")}}"></td>  
								<td><input type="text" class="form-control" name="status" value="{{Request::input("status")}}"></td>
								<td><input type="text" class="form-control" name="seller_id" value="{{Request::input("seller_id")}}"></td>
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
								<img src="{{setImage($record->image_id)}}" class="img-responsive" style="height:80px" />
                            </td>
							<td>
								<a href="#">
                                <span
                                    class="editable"
                                    data-type="text"
                                    data-name="title"
                                    data-value="{{ $record->title }}"
                                    data-pk="{{ $record->{$record->getKeyName()} }}"
                                    data-url="{{ route('v2.admin.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                >
                                    {{ $record->title }}
                                </span></a>
                            </td>							
                            <td>
                                <span
                                    class="editable"
                                    data-type="text"
                                    data-name="currency"
                                    data-value="{{ $record->currency }}"
                                    data-pk="{{ $record->{$record->getKeyName()} }}"
                                    data-url="{{ route('v2.admin.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                >
                                    {{ $record->currency }}
                                </span>
                            </td>
							<td>
                                <span
                                    class="editable"
                                    data-type="text"
                                    data-name="price"
                                    data-value="{{ $record->price }}"
                                    data-pk="{{ $record->{$record->getKeyName()} }}"
                                    data-url="{{ route('v2.admin.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                >
                                    {{ separateur_millier($record->price) }}
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
                                    data-url="{{ route('v2.admin.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                >
									@if($record->status=='published')
									<span class="label label-success">{{$record->status}}</span>
									@else
									<span class="label label-warning">{{$record->status}}</span>
									@endif
                                </span>
                            </td>
                            <td>
                                <span
                                    class="editable"
                                    data-type="text"
                                    data-name="seller_id"
                                    data-value="{{ $record->seller_id }}"
                                    data-pk="{{ $record->{$record->getKeyName()} }}"
                                    data-url="{{ route('v2.admin.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                >
                                    {{ setNomUser($record->seller_id) }}
                                </span>
                            </td>
							<td>
                                <span
                                    class="editable"
                                    data-type="text"
                                    data-name="author_id"
                                    data-value="{{ $record->author_id }}"
                                    data-pk="{{ $record->{$record->getKeyName()} }}"
                                    data-url="{{ route('v2.admin.product.index')}}/{{ $record->{$record->getKeyName()} }}"
                                >
                                    {{ setNomUser($record->author_id) }}
                                </span>
                            </td>
                            @include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => route('v2.admin.product.index'), 'record' => $record ] )
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
