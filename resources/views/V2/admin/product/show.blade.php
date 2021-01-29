@extends('V2.admin.layouts.app')

@section('title', 'Products - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Products</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Products</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('V2.admin.product.index') }}">Listes</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Détail</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

    </div>
</div>

@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>{{$product->title}}</h5>
				<div class="ibox-tools">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
				</div>
            </div>
            <div class="ibox-content">
				<div class="row">
                	<div class="col-md-6">
						<img src="{{$product->imageUrl()}}" class="img-responsive" style="width:100%" />
					</div>
					<div class="col-md-6">
						<dl class="row mb-0">
							<div class="col-sm-4 text-sm">
								<dt>Statuts:</dt>
							</div>
							<div class="col-sm-8 text-sm-left">
								<dd class="mb-1">
									@if($product->status=='published')
									<span class="label label-success">@lang('app.'.$product->status)</span>
									@else
									<span class="label label-warning">@lang('app.'.$product->status)</span>
									@endif
								</dd>
							</div>
						</dl>
						<dl class="row mb-0">
							<div class="col-sm-4 text-sm">
								<dt>@lang('app.reference'):</dt>
							</div>
							<div class="col-sm-8 text-sm-left">
								<dd class="mb-1">{{$product->reference}}</dd>
							</div>
						</dl>
						<dl class="row mb-0">
							<div class="col-sm-4 text-sm">
								<dt>@lang('app.reference'):</dt>
							</div>
							<div class="col-sm-8 text-sm-left">
								<dd class="mb-1">{{$product->reference}}</dd>
							</div>
						</dl>
					</div>
				</div>       
			</div>
        </div>
    </div>
</div>

@endsection