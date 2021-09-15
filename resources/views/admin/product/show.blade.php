@extends('admin.layouts.app')

@section('title', 'Products - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.products')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.txt.products')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.programme'):route('admin.product.programme')}}?status=waiting">@lang('app.txt.lists')</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.detail')</strong>
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
						@if (count($photos) > 0)
						<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								@foreach ( $photos as $photo )
								<div class="carousel-item active">
									<img class="d-block w-100" src="{{asset($photo->filepath)}}" alt="">
								</div>
								@endforeach
							</div>
							<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
						@else
						<img class="img-responsive" src="{{asset('images/product.png')}}" style="width:100%">
						@endif
					</div>
					<div class="col-md-6">
						<dl class="row mb-0">
							<div class="col-sm-4 text-sm">
								<dt>@lang('app.category'):</dt>
							</div>
							<div class="col-sm-8 text-sm-left">
								<dd class="mb-1"><span class="label label-info">{{$product->category->title}}</span></dd>
							</div>
						</dl>
						<dl class="row mb-0">
							<div class="col-sm-4 text-sm">
								<dt>@lang('app.form.programme_product_type'):</dt>
							</div>
							<div class="col-sm-8 text-sm-left">
								<dd class="mb-1">{{$product->type->title}}</dd>
							</div>
						</dl>
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
						<div class="hr-line-dashed"></div>
						<dl class="row mb-0">
							<div class="col-sm-4 text-sm">
								<dt>@lang('app.form.programme_title'):</dt>
							</div>
							<div class="col-sm-8 text-sm-left">
								<dd class="mb-1">{{$product->title}}</dd>
							</div>
						</dl>
						<dl class="row mb-0">
							<div class="col-sm-12 text-sm-left">
								<dd class="mb-1">{!!$product->content!!}</dd>
							</div>
						</dl>
						<div class="hr-line-dashed"></div>
						<dl class="row mb-0">
							<div class="col-sm-4 text-sm">
								<dt>@lang('app.form.programme_price_min'):</dt>
							</div>
							<div class="col-sm-8 text-sm-left">
								<dd class="mb-1">AUD {{ number_format($product->min_price, 0, '.', ' ') }}</dd>
							</div>
						</dl>
						<dl class="row mb-0">
							<div class="col-sm-4 text-sm">
								<dt>@lang('app.form.programme_price_max'):</dt>
							</div>
							<div class="col-sm-8 text-sm-left">
								<dd class="mb-1">AUD {{ number_format($product->max_price, 0, '.', ' ') }}</dd>
							</div>
						</dl>
						<dl class="row mb-0">
							<div class="col-sm-4 text-sm">
								<dt>@lang('app.form.programme_commission_type'):</dt>
							</div>
							<div class="col-sm-8 text-sm-left">
								<dd class="mb-1">{{$product->commission_type}}</dd>
							</div>
						</dl>
						<dl class="row mb-0">
						@if($product->commission_type == 'Sales commission rate (%)')
							<div class="col-sm-4 text-sm">
								<dt>@lang('app.form.programme_taux_commission')</dt>
							</div>
							<div class="col-sm-8 text-sm-left">
								<dd class="mb-1">{{$product->commision}} %</dd>
							</div>
						@else
							<div class="col-sm-4 text-sm">
								<dt>@lang('app.form.programme_mt_commission')</dt>
							</div>
							<div class="col-sm-8 text-sm-left">
								<dd class="mb-1">{{$product->commision}} AUD</dd>
							</div>
						@endif
						</dl>
						<div class="hr-line-dashed"></div>
						<div>
                            <dl class="row mb-0">
								<div class="col-sm-4 text-sm">
									<dt>@lang('app.location.country'):</dt>
								</div>
								<div class="col-sm-8 text-sm-left">
									<dd class="mb-1">{{@$product->location->country}}</dd>
								</div>
							</dl>
							<dl class="row mb-0">
								<div class="col-sm-4 text-sm">
									<dt>@lang('app.location.area_level_1'):</dt>
								</div>
								<div class="col-sm-8 text-sm-left">
									<dd class="mb-1">{{$product->location?$product->location->area_level_1:''}}</dd>
								</div>
							</dl>
							<dl class="row mb-0">
								<div class="col-sm-4 text-sm">
									<dt>@lang('app.location.area_level_2'):</dt>
								</div>
								<div class="col-sm-8 text-sm-left">
									<dd class="mb-1">{{$product->location?$product->location->area_level_2:''}}</dd>
								</div>
							</dl>
							<dl class="row mb-0">
								<div class="col-sm-4 text-sm">
									<dt>@lang('app.location.locality'):</dt>
								</div>
								<div class="col-sm-8 text-sm-left">
									<dd class="mb-1">{{$product->location?$product->location->locality:''}}</dd>
								</div>
							</dl>
							<dl class="row mb-0">
								<div class="col-sm-4 text-sm">
									<dt>@lang('app.location.route'):</dt>
								</div>
								<div class="col-sm-8 text-sm-left">
									<dd class="mb-1">{{$product->location?$product->location->route:''}}</dd>
								</div>
							</dl>
							<dl class="row mb-0">
								<div class="col-sm-4 text-sm">
									<dt>@lang('app.location.postalCode'):</dt>
								</div>
								<div class="col-sm-8 text-sm-left">
									<dd class="mb-1">{{$product->location?$product->location->postalCode:''}}</dd>
								</div>
							</dl>
                        </div>
						<div class="hr-line-dashed"></div>
						<div class="pull-right">
						@if($product->status == 'waiting')
							<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.publish', $record->id):route('admin.product.publish', $product->id)}}" class="btn btn-flat btn-primary">@lang('app.admin.btn_approbation')</a>
							<a href="javascript:void(0)" onclick="rejet_programme({{$product->id}})" class="btn btn-flat btn-danger">@lang('app.admin.btn_rejet')</a>
						@else
							<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.programme'):route('admin.product.programme')}}?status=waiting" class="btn btn-default">@lang('app.btn.return')</a>
						@endif
						</div>
					</div>
				</div>       
			</div>
        </div>
		
		<div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>@lang('app.form.programme_fond_dossier')</h5>
				<div class="ibox-tools">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
				</div>
            </div>
            <div class="ibox-content">
				@foreach ( $dossier as $dossie )
				<div class="file-box">
					<div class="file">
						@if(setIconFile($dossie->filepath) == 'images')
							<a href="{{asset($dossie->filepath)}}" class="fancyboxLink">
						@elseif(setIconFile($dossie->filepath) == 'pdf')
							<a class="fancybox-pdf" data-fancybox-type="iframe" href="http://docs.google.com/viewer?embedded=true&url={{asset(urlencode($dossie->filepath))}}">
						@else
							<a href="https://docs.google.com/viewer?url={{asset(urlencode($dossie->filepath))}}&embedded=true" class="fancyboxLinkDoc" data-fancybox-type="iframe">
						@endif								
							<span class="corner"></span>						
							@if(setIconFile($dossie->filepath) == 'images')
								<div class="image">
									<img alt="image" class="img-fluid" src="{{asset($dossie->filepath)}}">
								</div>
							@endif	
							@if(setIconFile($dossie->filepath) == 'pdf')
								<div class="icon">
									<i class="fa fa-file-pdf-o"></i>
								</div>
							@endif	
							@if(setIconFile($dossie->filepath) == 'doc')
								<div class="icon">
									<i class="fa fa-file-word-o"></i>
								</div>
							@endif
							@if(setIconFile($dossie->filepath) == 'excel')
								<div class="icon">
									<i class="fa fa-file-excel-o"></i>
								</div>
							@endif	
							@if(setIconFile($dossie->filepath) == 'file')
								<div class="icon">
									<i class="fa fa-file"></i>
								</div>
							@endif		
							<div class="file-name">
								@php
									$filename = $dossie->filename;
									$filename = preg_replace('/^(.*)\-\d{8,}\.(gif|jpg|png|pdf)$/', '$1.$2', $filename);
								@endphp
								<label style="text-transform:lowercase">{{str_limit($filename, 15)}}</label>
								<br>
								<small>{{$dossie->created_at ? $dossie->created_at->diffForHumans() : ""}}</small>
							</div>
						</a>
					</div>
				</div>
				@endforeach
				<div style="clear:both"></div>
			</div>
		</div>
		
		<div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>@lang('app.table.eoi_dossier')</h5>
				<div class="ibox-tools">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
				</div>
            </div>
            <div class="ibox-content">
				@foreach ( $eoidossier as $dos )
				 <div class="file-box">
					<div class="file">
						@if(setIconFile($dos->filepath) == 'images')
							<a href="{{asset($dos->filepath)}}" class="fancyboxLink">
						@elseif(setIconFile($dos->filepath) == 'pdf')
							<a class="fancybox-pdf" data-fancybox-type="iframe" href="http://docs.google.com/viewer?embedded=true&url={{asset(urlencode($dos->filepath))}}">
						@else
							<a href="https://docs.google.com/viewer?url={{asset(urlencode($dos->filepath))}}&embedded=true" class="fancyboxLinkDoc" data-fancybox-type="iframe">
						@endif								
							<span class="corner"></span>						
							@if(setIconFile($dos->filepath) == 'images')
								<div class="image">
									<img alt="image" class="img-fluid" src="{{asset($dos->filepath)}}">
								</div>
							@endif	
							@if(setIconFile($dos->filepath) == 'pdf')
								<div class="icon">
									<i class="fa fa-file-pdf-o"></i>
								</div>
							@endif	
							@if(setIconFile($dos->filepath) == 'doc')
								<div class="icon">
									<i class="fa fa-file-word-o"></i>
								</div>
							@endif
							@if(setIconFile($dos->filepath) == 'excel')
								<div class="icon">
									<i class="fa fa-file-excel-o"></i>
								</div>
							@endif	
							@if(setIconFile($dos->filepath) == 'file')
								<div class="icon">
									<i class="fa fa-file"></i>
								</div>
							@endif		
							<div class="file-name">
								@php
									$filename_eoi = $dos->filename;
									$filename_eoi = preg_replace('/^(.*)\-\d{8,}\.(gif|jpg|png|pdf)$/', '$1.$2', $filename_eoi);
								@endphp
								<label style="text-transform:lowercase">{{str_limit($filename_eoi, 15)}}</label>
								<br>
								<small>{{$dos->created_at ? $dos->created_at->diffForHumans() : ""}}</small>
							</div>
						</a>
					</div>
				</div>
				@endforeach
				<div style="clear:both"></div>
			</div>
		</div>
		
		<div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>@lang('app.table.lia_dossier')</h5>
				<div class="ibox-tools">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
				</div>
            </div>
            <div class="ibox-content">
				@foreach ( $liadossier as $dos )
				 <div class="file-box">
					<div class="file">
						@if(setIconFile($dos->filepath) == 'images')
							<a href="{{asset($dos->filepath)}}" class="fancyboxLink">
						@elseif(setIconFile($dos->filepath) == 'pdf')
							<a class="fancybox-pdf" data-fancybox-type="iframe" href="http://docs.google.com/viewer?embedded=true&url={{asset(urlencode($dos->filepath))}}">
						@else
							<a href="https://docs.google.com/viewer?url={{asset(urlencode($dos->filepath))}}&embedded=true" class="fancyboxLinkDoc" data-fancybox-type="iframe">
						@endif								
							<span class="corner"></span>						
							@if(setIconFile($dos->filepath) == 'images')
								<div class="image">
									<img alt="image" class="img-fluid" src="{{asset($dos->filepath)}}">
								</div>
							@endif	
							@if(setIconFile($dos->filepath) == 'pdf')
								<div class="icon">
									<i class="fa fa-file-pdf-o"></i>
								</div>
							@endif	
							@if(setIconFile($dos->filepath) == 'doc')
								<div class="icon">
									<i class="fa fa-file-word-o"></i>
								</div>
							@endif
							@if(setIconFile($dos->filepath) == 'excel')
								<div class="icon">
									<i class="fa fa-file-excel-o"></i>
								</div>
							@endif	
							@if(setIconFile($dos->filepath) == 'file')
								<div class="icon">
									<i class="fa fa-file"></i>
								</div>
							@endif		
							<div class="file-name">
								@php
									$filename_eoi = $dos->filename;
									$filename_eoi = preg_replace('/^(.*)\-\d{8,}\.(gif|jpg|png|pdf)$/', '$1.$2', $filename_eoi);
								@endphp
								<label style="text-transform:lowercase">{{str_limit($filename_eoi, 15)}}</label>
								<br>
								<small>{{$dos->created_at ? $dos->created_at->diffForHumans() : ""}}</small>
							</div>
						</a>
					</div>
				</div>
				@endforeach
			</div>
		</div>
		
		<div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>@lang('app.table.product_programme_title')</h5>
				<div class="ibox-tools">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
				</div>
            </div>
            <div class="ibox-content">
				<table class="table table-striped grid-view-tbl">
					<thead>
                        <tr class="header-row">
							<th>Id</th>
							<th>@lang('app.table.produit_image')</th>
							<th>@lang('app.table.produit_titre')</th>
							<th>@lang('app.table.produit_prix_min')</th>
							<th>@lang('app.table.produit_prix_max')</th>
							<th>Date</th>
							<th>@lang('app.table.status')</th>
							<th>@lang('app.seller')</th>
							<th>@lang('app.table.author')</th>
						</tr>
					</thead>
					<tbody>
					@foreach($product_lies as $key=>$product_lie)
						<tr>
							<td>{{$key + 1}}</td>
							<td>
								@if (@getimagesize($product_lie->imageUrl()))
									<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.index'):route('admin.product.index')}}/{{$product_lie->id}}">
										<img src="{{$product_lie->imageUrl()}}" class="img-responsive" style="height:80px" />
									</a>
								@else
									<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.index'):route('admin.product.index')}}/{{$product_lie->id}}">
										<img class="img-responsive" src="{{asset('img/500x500.jpg')}}" width="80">
									</a>
								@endif
							</td>
							<td><b>{{ $product_lie->title }}</b><br />{!! $product_lie->excerpt() !!}</td>
							<td>{{ $product_lie->currency }}&nbsp;{{ number_format($product_lie->min_price, 0, '.', ' ') }}</td>
							<td>{{ $product_lie->currency }}&nbsp;{{ number_format($product_lie->max_price, 0, '.', ' ') }}</td>
							<td>{{ $product_lie->created_at ? $product_lie->created_at->diffForHumans() : '' }}</td>
							<td>
								@if($product_lie->status=='published')
								<span class="label label-success">@lang('app.'.$product_lie->status)</span>
								@else
								<span class="label label-warning">@lang('app.'.$product_lie->status)</span>
								@endif
							</td>
							<td>
								@if($product_lie->seller_id != 0)
									{{ $product_lie->seller->name }}
								@endif
							</td>
							<td>{{ $product_lie->author->name }}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
    </div>
</div>

@endsection

@section('custom-script')
<script src="{{ asset('administrator/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script>
$(document).ready(function(){
	$("a.fancyboxLink").fancybox();			
	$("#fancybox-pdf").fancybox({
		openEffect  : 'none',
		closeEffect : 'none',
		iframe : {
			preload: false
		}
	});
	$("a.fancyboxLinkDoc").fancybox({
		type: "iframe"
	});
});

function rejet_programme(id_prd)
{
	swal({
		title: "@lang('app.txt.programme')",
		text: "@lang('app.dropzone.delete_photo_confirme')",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#ff3547',
		confirmButtonText: "@lang('app.yes')",
		cancelButtonText: "@lang('app.no')",
		closeOnConfirm: false,
		closeOnCancel: false
	 },
	 function(isConfirm){	
	   if (isConfirm){
			 $.ajax({
				url : "{{ Auth::user()->isAdmin()?route('admin.ajaxRejetProduit'):route('admin.collaborators.admin.ajaxRejetProduit') }}",
				type: "POST",
				dataType: "JSON",
				data:{"_token": "{{ csrf_token() }}",'id_produit':id_prd},
				success: function(data)
				{
					swal("@lang('app.txt.programme')", "@lang('app.jquery.delete_product_yes')", "success");
					window.location.href = "{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.programme'):route('admin.product.programme')}}?status=waiting";
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					swal("@lang('app.txt.programme')", "@lang('app.jquery.error_delete')", "error");
					location.reload();
				}
			}); 
		} else {
			swal("@lang('app.txt.programme')", "@lang('app.jquery.delete_cancel')", "error");
		}
	 });
}
</script>
@endsection