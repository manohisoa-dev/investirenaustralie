@extends('layouts.backend')

@section('subcontent')
				
    <div class="profile-content-area m-40px-tb card card-body">
        <div class="tab-style-4">
			<ul class="nav nav-fill nav-tabs">
				<li class="nav-item">
					<a href="{{route('mes-programmes')}}" class="active">
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
				<div class="profile-content-area m-40px-tb">
					<div class="card m-40px-b">		
						<div class="card-header">
							<div class="row">
								<div class="col-5 col-lg-8">
									<span class="h6 font-w-500">Liste des produits <strong>{{$product->title}}</strong></span>
								</div>
								<div class="col-7 col-lg-4 text-right">
									<a href="javascript:void(0)" onclick="add_product({{$product->id}})" class="m-btn m-btn-radius m-btn-theme m-btn-sm">@lang('app.form.product_add_ajax') </a>
								</div>
							</div>
						</div>
						<div class="card-body">
							<table class="table table-bordered" style="font-size:12px">
								<thead>
									<tr>
										<th>ID</th>
										<th>@lang('app.table.produit_image')</th>
										<th>@lang('app.form.product_title')</th>
										<th>@lang('app.table.produit_prix_min')</th>
										<th>@lang('app.table.produit_prix_max')</th>
										<th>@lang('app.table.status')</th>
										<th style="text-align:center">@lang('app.table.actions')</th>
									</tr>
								</thead>
								<tbody>
								@foreach($product_lies as $key=>$product_lie)
									<tr>
										<td>{{$key + 1}}</td>
										<td>
											@if (@getimagesize($product_lie->imageUrl()))
												<img src="{{$product_lie->imageUrl()}}" class="img-responsive" style="height:50px" />
											@else
												<img class="img-responsive" src="{{asset('img/500x500.jpg')}}" style="height:50px" >
											@endif
										</td>
										<td><b>{{ $product_lie->title }}</b><br />{!! $product_lie->excerpt() !!}</td>
										<td>{{ $product_lie->currency }}&nbsp;{{ number_format($product_lie->min_price, 0, '.', ' ') }}</td>
										<td>{{ $product_lie->currency }}&nbsp;{{ number_format($product_lie->max_price, 0, '.', ' ') }}</td>
										<td>
											@if($product_lie->status=='published')
											<span class="label label-success">@lang('app.'.$product_lie->status)</span>
											@else
											<span class="label label-warning">@lang('app.'.$product_lie->status)</span>
											@endif
										</td>
										<td class="actions-cell text-center">	
										@if($product_lie->status=='waiting')							
											<a href="javascript:void(0)" onclick="edit_product({{$product_lie->id}})" class="" title="@lang('app.table.btn_title_modification')">
												<i class="fa fa-edit"></i>
											</a>&nbsp;
											<a href="javascript:void(0)" onclick="delete_product({{$product_lie->id}})" class="" title="@lang('app.table.btn_title_delete')">
												<i class="fa fa-times text-danger"></i>
											</a>
										@endif
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	

@endsection

@push('script')
<style>
	.custom-file-input ~ .custom-file-label::after {
		content: "{{ trans('app.form.choose_file') }}";
	}
	.error{color:red !important}
</style>
<!-- dropzone -->
<script src="{{ asset('administrator/js/plugins/dropzone/dropzone.js') }}"></script>
<!-- jquery select2-->
<script src="{{ asset('administrator/js/plugins/select2/select2.full.min.js') }}"></script>

<script src="{{asset('administrator/plugins/ckeditor/ckeditor.js')}}"></script>
<!-- Jquery Validate -->
<script src="{{ asset('administrator/js/plugins/validate/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="{{ asset('administrator/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script>
	$(document).ready(function(){
		$("#interior_area").keyup(function(){
			var interior = parseInt($("#interior_area").val());
			var exterior = parseInt($("#exterior_area").val());
			var total_area = interior + exterior;
			if($.isNumeric(total_area) === true){
				$('#total_area').val(total_area);
			}
		});
		
		$("#exterior_area").keyup(function(){
			var interior = parseInt($("#interior_area").val());
			var exterior = parseInt($("#exterior_area").val());
			var total_area = interior + exterior;
			if($.isNumeric(total_area) === true){
				$('#total_area').val(total_area);
			}
		});
		
		$('#bonus_vente').on('change', function() {
			var type_bonus = this.value;
			if(type_bonus == 'YES'){
				$('#montant_bonus_vente').show();
			}else{
				$('#montant_bonus_vente').hide();
			}
		});
		
		<!-- commission product -->			
		$('#commision_product').on('change', function() {
			var type_commission_product = this.value;
			if(type_commission_product == 'Sales commission rate (%)'){
				$('#commission_rate_prd').show();
				$('#fixed_commission_prd').hide();
				$('#sales_rate_product').val('');
				$('#rate_commission_product').val('');
			}else if(type_commission_product == 'Fixed commission ($)'){
				$('#fixed_commission_prd').show();
				$('#commission_rate_prd').hide();
				$('#sales_rate_product').val('');
				$('#rate_commission_product').val('');
			}else{
				$('#fixed_commission_prd').hide();
				$('#commission_rate_prd').hide();
				$('#sales_rate_product').val('');
				$('#rate_commission_product').val('');
			}
		});
	});
	
	function set_type_programme(categorie_id,type_id_active)
	{
		$.ajax({
		   type:'POST',
		   url:"{{ route('ajaxGetTypeProduitCategorie') }}",
		   data: {"_token": "{{ csrf_token() }}","categoryId": categorie_id, "type_id_active": type_id_active},
		   success:function(data) {
			  $('#type_id').html(data);
			  $('#product_type_id').html(data);
		   }
		});
	}
	
	function add_product(id_programme)
	{
		save_method = 'add';
		var type_commission = '{{$product->commission_type}}';
		$('#form_product')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty(); 
		$('#id_programme').val(id_programme);
		$('#title_new_programme').val($('#title_programme').val());	
		set_type_programme({{$product->category_id}},{{$product->type_id}});
		if(type_commission == 'Sales commission rate (%)'){
			$('#commission_rate_prd').show();
			$('#fixed_commission_prd').hide();
			$('#sales_rate_product').val({{$product->commision}});
			$('#rate_commission_product').val('');
		}else{
			$('#commission_rate_prd').hide();
			$('#fixed_commission_prd').show();
			$('#sales_rate_product').val('');
			$('#rate_commission_product').val({{$product->commision}});
		}
		$('#modal_form_product').modal('show'); 
		CKEDITOR.replace( 'desc_product' );
		$('.modal-title').text("@lang('app.form.product_add_ajax')");
	}
	
	function edit_product(id_produit)
	{
		save_method = 'update';
		$('#form_product')[0].reset(); 
		$('.form-group').removeClass('has-error'); 
		$('.help-block').empty(); 
	
	
		//Ajax Load data from ajax
		$.ajax({
			url : "{{ route('ajaxGetProductById') }}",
			type: "POST",
			dataType: "JSON",
			data:{"_token": "{{ csrf_token() }}",'id_produit':id_produit},
			success: function(data)
			{
				$('#title_new_programme').val($('#title_programme').val());
				$("#progTitle").text($('#title_programme').val());
				$('[name="title_product"]').val(data.product.title);
				$('#desc_product').val(data.product.content);
				CKEDITOR.replace( 'desc_product' );
				$('[name="product_type_id"]').val(data.product.type_id);
				$('[name="suburb_product"]').val(data.localisation.area_level_1);
				$('[name="ville_product"]').val(data.localisation.locality);
				$('[name="postalCode_product"]').val(data.product.postalCode);
				$('[name="display_address_product"]').val(data.product.display_address);
				$('[name="state_id_product"]').val(data.product.state_id);
				$('[name="countryId_product"]').val(data.localisation.country);
				$('[name="price"]').val(data.product.min_price);
				$('[name="price_max_prd"]').val(data.product.max_price);
				$('[name="status"]').val(data.product.status);
				$('[name="quantity"]').val(data.product.quantity);
				$('[name="bedrooms"]').val(data.product.bedrooms);
				$('[name="ensuite"]').val(data.product.ensuite);
				$('[name="bathrooms"]').val(data.product.bathrooms);
				$('[name="interior_area"]').val(data.product.interior_area);
				$('[name="exterior_area"]').val(data.product.exterior_area);
				$('[name="total_area"]').val(data.product.total_area);
				$('[name="garage_spaces"]').val(data.product.garage_spaces);
				$('[name="carport_spaces"]').val(data.product.carport_spaces);
				$('[name="id_programme"]').val(data.product.parent_id);
				$('[name="id_product"]').val(data.product.id);
				$('[name="id_location_product"]').val(data.product.location_id);
				$('[name="bonus_vente"]').val(data.product.avoir_bonus);
				$('[name="bonus_amount"]').val(data.product.amount_bonus);
				
				$('[name="commision_product"]').val(data.product.commission_type);
				if(data.product.commission_type == 'Sales commission rate (%)'){
					$('#commission_rate_prd').show();
					$('#fixed_commission_prd').hide();
					$('[name="sales_rate_product"]').val(data.product.commision);
				}else if(data.product.commission_type == 'Fixed commission ($)'){
					$('#commission_rate_prd').hide();
					$('#fixed_commission_prd').show();
					$('[name="rate_commission_product"]').val(data.product.commision);
				}else{
					$('#commission_rate_prd').hide();
					$('#fixed_commission_prd').hide();
				}
				
				if(data.product.avoir_bonus == 'YES'){
					$('#montant_bonus_vente').show();
				}else{
					$('#montant_bonus_vente').hide();
				}
				
				set_type_programme({{$product->category_id}},data.product.type_id);
				$('#modal_form_product').modal('show'); 
				$('.modal-title').text("@lang('app.form.product_edit_title')"); 
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error get data from ajax');
			}
		});
	}
	
	function save_product()
	{
		var url;
		var form = $("#form_product");
	
		if(save_method == 'add') {
			url = "{{ route('ajaxSaveProduct') }}";
		} else {
			url = "{{ route('ajaxModifProduct') }}";
		}
		
		form.validate({
			rules: {
				title_product: {
					required: true,
					remote: {
						url: "{{ route('ajaxCheckTitreProgramme') }}",
						type: "get",
						data: {
							title_programme: function () {
								if($("input[name='title_programme']").val() != ''){
									var prg_text = $("input[name='title_new_programme']").val();
									var prd_text = $("input[name='title_product']").val();
									return prg_text+'-'+prd_text;
								}else{
									return $("input[name='title_product']").val();
								}	
							}
						}
					}
				},
				product_type_id: {
					required: true
				},
				postalCode_product: {
					required: true
				},
				display_address_product: {
					required: true
				},
				state_id_product: {
					required: true
				},
				price: {
					required: true
				},
				price_max_prd: {
					required: true,
					min: function ()  { return parseInt($("#price").val())}
				},
				interior_area: {
					required: true
				},
				exterior_area: {
					required: true
				},
				total_area: {
					required: true
				},
				year_built: {
					required: true
				},
				bonus_vente: {
					required: true
				},
				bonus_amount: {
					required: {
						depends: function(element) {
							if($("#bonus_vente").val() == 'YES'){
								return true;	
							}
						}
					}
				},
				commision_product: {
					required: true
				}
			},
			messages: {
				title_product: {
					required: "@lang('app.txt.champobligatoire')",
					remote: jQuery.validator.format("{0} @lang('app.form.programme_validate_titre')")
				},
				product_type_id: {
					required: "@lang('app.txt.champobligatoire')"
				},
				postalCode_product: {
					required: "@lang('app.txt.champobligatoire')"
				},
				display_address_product:{
					required: "@lang('app.txt.champobligatoire')"
				},
				state_id_product:{
					required: "@lang('app.txt.champobligatoire')"
				},
				price:{
					required: "@lang('app.txt.champobligatoire')"
				},
				price_max_prd:{
					required: "@lang('app.txt.champobligatoire')",
					min: jQuery.validator.format("@lang('app.form.programme_validate_prix_max') {0}")
				},
				interior_area:{
					required: "@lang('app.txt.champobligatoire')"
				},
				exterior_area:{
					required: "@lang('app.txt.champobligatoire')"
				},
				total_area:{
					required: "@lang('app.txt.champobligatoire')"
				},
				year_built:{
					required: "@lang('app.txt.champobligatoire')"
				},
				bonus_vente: {
					required: "@lang('app.txt.champobligatoire')"
				},
				bonus_amount:{
					required: "@lang('app.txt.champobligatoire')"
				},
				commision_product:{
					required: "@lang('app.txt.champobligatoire')"
				}
			},
			errorPlacement: function ( error, element ) {
				if(element.parent().hasClass('input-group')){
				  error.insertAfter( element.parent() );
				}else{
					error.insertAfter( element );
				}
			},
		});
		
		for ( instance in CKEDITOR.instances ) {
			CKEDITOR.instances[instance].updateElement();
		}
		// ajax adding data to database
		if (form.valid() === true) {
			var formData = new FormData($('#form_product')[0]);
			$.ajax({
				url : url,
				type: "POST",
				data: formData,
				async: true,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "JSON",
				success: function(data)
				{
					if(data.success == 'false'){
						$('#info_error').show();
					}else{
						location.reload();
					}
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					$('#btnSave').text('Enregistrer'); //change button text
					$('#btnSave').attr('disabled',false); //set button enable 
		
				}
			});
		}else{
			$('#btnSave').attr('disabled',false);
			$(this).addClass('input-error');
		}
	}
	
	function delete_product(id_prd)
	{
		swal({
			title: "@lang('app.products')",
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
					url : "{{ route('ajaxDropProduit') }}",
					type: "POST",
					dataType: "JSON",
					data:{"_token": "{{ csrf_token() }}",'id_produit':id_prd},
					success: function(data)
					{
						swal("@lang('app.products')", "@lang('app.jquery.delete_product_yes')", "success");
						location.reload();	
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						swal("@lang('app.products')", "@lang('app.jquery.error_delete')", "error");
						location.reload();	
					}
				}); 
			} else {
				swal("@lang('app.products')", "@lang('app.jquery.delete_cancel')", "error");
			}
		 });
	}
</script>
	<div class="modal inmodal fade" id="modal_form_product" role="dialog" data-keyboard="false" data-backdrop="static">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<form action="#" id="form_product" class="form-horizontal" enctype="multipart/form-data">
						<input type="hidden" name="title_new_programme" value="{{$product->title}}" />
						<input type="hidden" name="prg_anciennete" id="prg_anciennete" value="{{$product->ancienneteBien}}" />
						<input type="hidden" name="prg_nature" id="prg_nature" value="{{$product->natureBien}}"/>
						<input type="hidden" name="prg_cat_id" id="prg_cat_id" value="{{$product->category_id}}"/>
						<input type="hidden" name="id_programme" id="id_programme"/>
						<input type="hidden" name="id_product" id="id_product" />
						<input type="hidden" name="id_location_product" id="id_location_product" />
						{{ csrf_field() }}
						<div class="row">
							<div class="col-lg-12">
								<label for="title">@lang('app.form.product_title') *</label>
								<div class="input-group" style="margin-bottom:.5rem">
									<div class="input-group-append">
										<span class="input-group-text">{{$product->title}}</span>
									</div>
									<input name="title_product" id="title_product" class="form-control" type="text" value="" title="@lang('app.form.product_title_input')">									
								</div>
							</div>
						</div>
						<div class="row">     
							<div class="col-lg-12">                              
								<div class="form-group">
									<label for="title">@lang('app.form.product_content') *</label>
									<textarea class="form-control" rows="10" name="desc_product" id="desc_product"></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_product_type') *</label>
									<select class="form-control" name="product_type_id" id="product_type_id" style="width:100%">
										
									</select>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_suburb')</label>
									<input name="suburb_product" id="suburb_product" class="form-control" type="text" value="{{$localisation->area_level_1}}">
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_ville')</label>
									<input name="ville_product" id="ville_product" class="form-control" type="text" value="{{$localisation->locality}}">
								</div>  
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_cp') *</label>
									<input name="postalCode_product" id="postalCode_product" class="form-control" type="text" value="{{$localisation->postalCode}}">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_adresse') *</label>
									<input name="display_address_product" id="display_address_product" class="form-control" type="text" value="{{$product->display_address}}">
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_etat') *</label>
									<select class="form-control" name="state_id_product" id="state_id_product" style="width:100%">
										<option value="">Sélectionner état...</option>
										@foreach(\App\Models\State::all() as $state)
											<option value="{{$state->id}}" {{$state->id == $product->state_id ? 'selected' : ''}}>{{$state->content}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_pays')</label>
									<select class="form-control" name="countryId_product" id="countryId_product" style="width:100%">
										@foreach(\App\Models\Country::where('id',12)->get() as $country)
											<option value="{{$country->id}}">{{$country->content}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_commission_type')</label>
									<select class="form-control" name="commision_product" id="commision_product">
										<option value="">Choisir...</option>
										<option value="Sales commission rate (%)" {{$product->commission_type == 'Sales commission rate (%)' ? 'selected' : ''}}>@lang('app.form.programme_commission_option1') (%)</option>
										<option value="Fixed commission ($)" {{$product->commission_type == 'Fixed commission ($)' ? 'selected' : ''}}>@lang('app.form.programme_commission_option2') ($)</option>
									</select>
								</div>
							</div>
							<div class="col-lg-3">
								<div id="commission_rate_prd" style="display:none">
									<div class="form-group">
										<label for="title">@lang('app.form.programme_taux_commission')</label>
										<div class="input-group m-b">
											<input type="number" class="form-control" name="sales_rate_product" id="sales_rate_product">
											<div class="input-group-append">
												<span class="input-group-text">%</span>
											</div>
										</div>
									</div>
								</div>
								<div id="fixed_commission_prd" style="display:none">
									<div class="form-group">
										<label for="title">@lang('app.form.programme_mt_commission')</label>
										<div class="input-group m-b">
											<input type="number" class="form-control" name="rate_commission_product" id="rate_commission_product">
											<div class="input-group-append">
												<span class="input-group-text">AUD</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Bonus</label>
									<select class="form-control" name="bonus_vente" id="bonus_vente">
										<option value="">Choisir...</option>
										<option value="YES">@lang('app.txt.yes')</option>
										<option value="NO">@lang('app.txt.no')</option>
									</select>
								</div>
							</div>
							<div class="col-lg-3">
								<div id="montant_bonus_vente" style="display:none">
									<div class="form-group">
										<label for="title">Bonus amount</label>
										<div class="input-group m-b">
											<input type="number" class="form-control" name="bonus_amount" id="bonus_amount">
											<div class="input-group-append">
												<span class="input-group-text">AUD</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">							
							<div class="col-lg-3">
								<label for="title">@lang('app.form.product_prix_min') *</label>
								<div class="input-group">
									<input type="number" class="form-control" name="price" id="price">
									<div class="input-group-append">
										<span class="input-group-text">AUD</span>
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<label for="title">@lang('app.form.product_prix_max') *</label>
								<div class="input-group">
									<input type="number" class="form-control" name="price_max_prd" id="price_max_prd">
									<div class="input-group-append">
										<span class="input-group-text">AUD</span>
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">@lang('app.table.status')</label>
									<select class="form-control" name="status" id="status">
										<option value="waiting">En attente</option>
									</select>
								</div>
							</div>
							<div class="col-lg-3">
								<div id="info_qte">
									<div class="form-group">
										<label for="title">@lang('app.form.product_qte')</label>
										<input name="quantity" id="quantity" class="form-control" type="number" value="1" min="1">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">@lang('app.input.nbchambre')</label>
									<input name="bedrooms" id="bedrooms" class="form-control" type="number" value="0">
								</div>  
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">@lang('app.input.nbchambresuite')</label>
									<input name="ensuite" id="ensuite" class="form-control" type="number" value="0">
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">@lang('app.input.nbsalledebain')</label>
									<input name="bathrooms" id="bathrooms" class="form-control" type="number" value="0">
								</div> 
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">@lang('app.table.produit_image')</label>
									<input name="image" class="form-control" type="file" accept="image/png, image/jpeg">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">
								<label for="title">@lang('app.form.product_area_interior') *</label>
								<div class="input-group" style="margin-bottom:.5rem">
									<input type="text" name="interior_area" id="interior_area" class="form-control">
									<div class="input-group-append">
										<span class="input-group-text">.m2</span>
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<label for="title">@lang('app.form.product_area_exterior') *</label>
								<div class="input-group" style="margin-bottom:.5rem">
									<input type="text" name="exterior_area" id="exterior_area" class="form-control">
									<div class="input-group-append">
										<span class="input-group-text">.m2</span>
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<label for="title">@lang('app.form.product_area_total') *</label>
								<div class="input-group" style="margin-bottom:.5rem">
									<input type="text" name="total_area" id="total_area" class="form-control" readonly="">
									<div class="input-group-append">
										<span class="input-group-text">.m2</span>
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div id="yearConstruct" style="display:none">								
									<div class="form-group">
										<label for="title">@lang('app.form.product_anneeConstruct') *</label>
										<input name="year_built" id="year_built" class="form-control" type="number" value="0">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4">
								<div class="form-group">
									<label for="title">@lang('app.form.product_parking_ferme')</label>
									<input name="garage_spaces" id="garage_spaces" class="form-control" type="number" value="0">
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label for="title">@lang('app.form.product_parking_carpot')</label>
									<input name="carport_spaces" id="carport_spaces" class="form-control" type="number" value="0">
								</div>
							</div>
							
							<div class="col-lg-4">
								<div id="jardin_info" style="display:none">
									<label for="title">@lang('app.form.product_jardin_space')</label>
									<div class="input-group">
										<input type="number" class="form-control" name="superficie_jardin" id="superficie_jardin" value="0">
										<div class="input-group-append">
											<span class="input-group-text">.m2</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-12">
								<label class="chk_parking"> 
									<input type="checkbox" value="1" id="chk_parking" name="chk_parking"> @lang('app.form.product_parking_vPublic')
								</label>
							</div>
							
							<div class="col-lg-12">
								<div id="chk_picine" style="display:none">
									<label class="chk_picine"> 
										<input type="checkbox" value="1" name="chk_picine"> @lang('app.form.product_piscine')
									</label>
								</div>
							</div>
							
							<div class="col-lg-12">
								<div id="chk_firb" style="display:none">
									<label class="chk_firb"> 
										<input type="checkbox" value="" name="chk_firb"> The Seller certifies under their sole responsibilitythatthis property canbe sold to non-residentforeigners in accordance with Australian law and the rules applicable by the Foreign Investment Review Board (FIRB).
									</label>
								</div>
							</div>
						</div>
						<div class="alert alert-danger alert-dismissable" id="info_error" style="display:none">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4><i class="icon fa fa-ban"></i> @lang('app.form.product_error_title') !</h4>
							@lang('app.form.product_error_content')
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">@lang('app.txt.close')</button>
					<button type="button" class="btn btn-primary" id="btnSave" onClick="save_product()">@lang('app.form.product_btn_save')</button>
				</div>
			</div>
		</div>
	</div>
@endpush