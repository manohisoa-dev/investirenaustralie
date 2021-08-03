@extends('admin.layouts.app')

@section('title', 'Products - Edition ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.products')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.products')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.index'):route('admin.product.index') }}">@lang('app.list')</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.form.programme_edition')</strong>
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
                <h5>@lang('app.txt.produit_update_info') : {{$product->reference}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.index'):route('admin.product.index')}}/{{$product->id}}" id="productForm" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field("PUT") }}
					<input type="hidden" name="category_id" id="cat_programmme_id" value="{{$product->category_id}}" />
					<input type="hidden" name="location_id" value="{{$product->location_id}}" />
                    <div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label for="title">@lang('app.form.product_title') *</label>
								<input name="title" id="title" class="form-control" type="text" value="{{$product->title}}">								
							</div>
						</div>
					</div>
					<div class="row">     
						<div class="col-lg-12">                              
							<div class="form-group">
								<label for="title">@lang('app.form.product_content')</label>
								<textarea class="form-control" rows="10" name="content" id="content">{{$product->content}}</textarea>
							</div>
						</div>
					</div>
						
					<div class="row">
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">@lang('app.input.type') *</label>
								<select class="form-control" name="type_id" id="product_type_id" style="width:100%">
									
								</select>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">@lang('app.form.programme_suburb')</label>
								<input name="suburb_product" id="suburb_product" class="form-control" type="text" value="{{$localisation ? $localisation->area_level_1:''}}">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">@lang('app.form.programme_ville')</label>
								<input name="ville_product" id="ville_product" class="form-control" type="text" value="{{$localisation ? $localisation->locality:''}}">
							</div>  
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">@lang('app.form.programme_cp') *</label>
								<input name="postalCode_product" id="postalCode_product" class="form-control" type="text" value="{{$product->postalCode}}">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">@lang('app.form.programme_adresse') *</label>
								<input name="display_address" id="display_address" class="form-control" type="text" value="{{$product->display_address}}">
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">@lang('app.form.programme_etat') *</label>
								<select class="form-control" name="state_id" id="state_id" style="width:100%">
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
									    @if($localisation)
											<option value="{{$country->id}}" {{$country->id == $localisation->country ? 'selected' : ''}}>{{$country->content}}</option>
										@else
											<option value="{{$country->id}}">{{$country->content}}</option>
										@endif
										
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
									<option value="Sales commission rate (%)" {{$product->commission_type == 'Sales commission rate (%)' ? 'selected' : ''}}>
										@lang('app.form.programme_commission_option1') (%)
									</option>
									<option value="Fixed commission ($)" {{$product->commission_type == 'Fixed commission ($)' ? 'selected' : ''}}>
										@lang('app.form.programme_commission_option2') ($)
									</option>
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
											<span class="input-group-addon">%</span>
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
											<span class="input-group-addon">AUD</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="info-date-isole" class="col-lg-6">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="title">@lang('app.form.produit_dt_db_travaux')</label>
										<input type="text" class="form-control" name="dt_db_travaux" id="dt_db_travaux" />
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="title">@lang('app.form.produit_dt_prevu_livraison')</label>
										<input type="date" class="form-control" name="dt_prevu_livraison" id="dt_prevu_livraison" />
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">							
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">@lang('app.form.product_prix_min') *</label>
								<div class="input-group m-b">
									<input type="number" class="form-control" name="min_price" id="min_price" value="{{$product->min_price}}">
									<div class="input-group-append">
										<span class="input-group-addon">AUD</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">@lang('app.form.product_prix_max') *</label>
								<div class="input-group m-b">
									<input type="number" class="form-control" name="max_price" id="max_price" value="{{$product->max_price}}">
									<div class="input-group-append">
										<span class="input-group-addon">AUD</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">@lang('app.form.product_status')</label>
								<select class="form-control" name="status" id="status">
									<option value="published" {{$product->status == 'published' ? 'selected' : ''}}>Publier</option>
									<option value="En attente" {{$product->status == 'En attente' ? 'selected' : ''}}>En attente</option>
								</select>
							</div>
						</div>
						<div class="col-lg-3">
							<div id="info_qte">
								<div class="form-group">
									<label for="title">@lang('app.form.product_qte')</label>
									<input name="quantity" id="quantity" class="form-control" type="number" value="{{$product->quantity}}">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">@lang('app.input.nbchambre')</label>
								<input name="bedrooms" id="bedrooms" class="form-control" type="number" value="{{$product->bedrooms}}">
							</div>  
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">@lang('app.input.nbchambresuite')</label>
								<input name="ensuite" id="ensuite" class="form-control" type="number" value="{{$product->ensuite}}">
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">@lang('app.input.nbsalledebain')</label>
								<input name="bathrooms" id="bathrooms" class="form-control" type="number" value="{{$product->bathrooms}}">
							</div> 
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">@lang('app.form.product_area_interior') *</label>
								<div class="input-group m-b">
									<input type="text" name="interior_area" id="interior_area" class="form-control" value="{{$product->interior_area}}">
									<div class="input-group-append">
										<span class="input-group-addon">.m2</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">@lang('app.form.product_area_exterior') *</label>
								<div class="input-group m-b">
									<input type="text" name="exterior_area" id="exterior_area" class="form-control" value="{{$product->exterior_area}}">
									<div class="input-group-append">
										<span class="input-group-addon">.m2</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">@lang('app.form.product_area_total') *</label>
								<div class="input-group m-b">
									<input type="text" name="total_area" id="total_area" class="form-control" value="{{$product->total_area}}" readonly="">
									<div class="input-group-append">
										<span class="input-group-addon">.m2</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
						@if($product->ancienneteBien == 'Ancien')
							<div id="yearConstruct">								
								<div class="form-group">
									<label for="title">@lang('app.form.product_anneeConstruct') *</label>
									<input name="year_built" id="year_built" class="form-control" type="number" value="{{$product->year_built}}">
								</div>
							</div>
						@endif
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">@lang('app.form.product_parking_ferme')</label>
								<input name="garage_spaces" id="garage_spaces" class="form-control" type="number" value="{{$product->garage_spaces}}">
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">@lang('app.form.product_parking_carpot')</label>
								<input name="carport_spaces" id="carport_spaces" class="form-control" type="number" value="{{$product->carport_spaces}}">
							</div>
						</div>
						
						<div class="col-lg-4">
							@if($product->ancienneteBien == 'Neuf' && $product->natureBien == 'Produit isolé')
								<div class="form-group">
									<label for="title">@lang('app.form.product_jardin_space')</label>
									<div class="input-group m-b">
										<input type="number" class="form-control" name="superficie_jardin" id="superficie_jardin" value="{{$product->superficie_jardin}}">
										<div class="input-group-append">
											<span class="input-group-addon">.m2</span>
										</div>
									</div>
								</div>
							@endif
						</div>
					</div>
					
					<div class="row">
						@if($product->image_id != 0)
						<div class="col-lg-3">
							<div class="file-box">
								<div class="file">
									<a href="{{asset($product->imageUrl())}}" target="_blank" class="fancyboxLink">
										<span class="corner"></span>	
										@if (@getimagesize($product->imageUrl()))					
										<div class="image">
											<img alt="image" class="img-fluid" src="{{$product->imageUrl()}}">
										</div>
										@else
										<div class="image">
											<img alt="image" class="img-fluid" src="{{asset('img/500x500.jpg')}}">
										</div>
										@endif
									</a>
								</div>
								<div class="file-name">
									<label>@lang('app.table.produit_image')</label>
								</div>
							</div>
						</div>
						@endif
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">@lang('app.table.produit_image')</label>
								<input name="image" class="form-control" type="file" accept="image/png, image/jpeg">
							</div>
						</div>
					</div>
					
					
					<div class="row">
						<div class="col-lg-12">
							<label class="chk_parking"> 
								<input type="checkbox" value="1" id="chk_parking" name="chk_parking" {{$product->avoir_parking_voie_public == 1 ? 'checked="checked"' : ''}}> @lang('app.form.product_parking_vPublic')
							</label>
						</div>
						
						@if($product->natureBien == 'Produit isolé')
						<div class="col-lg-12">
							<div id="chk_picine">
								<label class="chk_picine"> 
									<input type="checkbox" value="1" name="chk_picine" {{$product->avoir_piscine == 1 ? 'checked="checked"' : ''}}> @lang('app.form.product_piscine')
								</label>
							</div>
						</div>
						@endif
						<div class="col-lg-12">
							<div id="chk_firb">
								<label class="chk_firb"> 
									<input type="checkbox" value="" name="chk_firb" checked="checked"> The Seller certifies under their sole responsibilitythatthis property canbe sold to non-residentforeigners in accordance with Australian law and the rules applicable by the Foreign Investment Review Board (FIRB).
								</label>
							</div>
						</div>
					</div>                                                                                                                         
                    <button type="submit" class="btn btn-primary btn-lg pull-right"><i class="fa fa-save"></i> @lang('app.form.product_btn_save')</button>
					<div style="clear:both"></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
	<script src="{{asset('administrator/plugins/ckeditor/ckeditor.js')}}"></script>	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
	<script>
	$(document).ready(function(){
		CKEDITOR.replace( 'content' );
		set_type_programme($('#cat_programmme_id').val(),{{$product->type_id}});		
		$(".fancyboxLink").fancybox();
		
		$("#dt_db_travaux").datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			dateFormat: 'MM yy',
			onClose: function(dateText, inst) { 
				var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
				var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
				$(this).datepicker('setDate', new Date(year, month, 1));
			},
			beforeShow : function(input, inst) {
				var datestr;
				if ((datestr = $(this).val()).length > 0) {
					year = datestr.substring(datestr.length-4, datestr.length);
					month = jQuery.inArray(datestr.substring(0, datestr.length-5), $(this).datepicker('option', 'monthNamesShort'));
					$(this).datepicker('option', 'defaultDate', new Date(year, month, 1));
					$(this).datepicker('setDate', new Date(year, month, 1));
				}
			}
		});
		var type_commission = '{{$product->commission_type}}';
		var nature_produit = '{{$product->natureBien}}';
		
		if(type_commission == 'Sales commission rate (%)'){
			$('#commission_rate_prd').show();
			$('#sales_rate_product').val({{$product->commision}});
		}else{
			$('#fixed_commission_prd').show();
			$('#rate_commission_product').val({{$product->commision}});
		}
		
		if(nature_produit == 'Produit isolé'){
			$('#info-date-isole').show();
			$('#dt_db_travaux').val('{{$product->dt_db_travaux}}');
			$('#dt_prevu_livraison').val('{{$product->dt_prevu_livraison}}');
		}else{
			$('#info-date-isole').hide();
		}
		
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
		
		$('#productForm').validate({
			ignore: [],
			rules: {
				title: {
					required: true
				},
				type_id: {
					required: true
				},
				min_price: {
					required: true
				},
				max_price: {
					required: true,
					number: true,
					min: function ()  { return parseInt($("#min_price").val())}
				},
				display_address: {
					required: true
				},
				postalCode_product: {
					required: true
				},
				interior_area: {
					required: true
				},
				exterior_area: {
					required: true
				}
			},
			messages: {
				title: {
					required: "@lang('app.txt.champobligatoire')"
				},
				type_id: {
					required: "@lang('app.txt.champobligatoire')"
				},
				min_price: {
					required: "@lang('app.txt.champobligatoire')"
				},
				max_price: {
					required: "@lang('app.txt.champobligatoire')",
					min: jQuery.validator.format("@lang('app.form.programme_validate_prix_max') {0}")
				},
				display_address: {
					required: "@lang('app.txt.champobligatoire')",
				},
				postalCode_product: {
					required: "@lang('app.txt.champobligatoire')",
				},
				interior_area: {
					required: "@lang('app.txt.champobligatoire')",
				},
				exterior_area: {
					required: "@lang('app.txt.champobligatoire')",
				}
			},
			errorPlacement: function ( error, element ) {
				if(element.parent().hasClass('input-group')){
					error.insertBefore( element.parent() );
				}else{
					error.insertAfter( element );
				}
			},
		});
		
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
	});
	
	function set_type_programme(categorie_id,type_id_active)
	{
		$.ajax({
		   type:'POST',
		   url:"{{ Auth::user()->isAdmin()?route('admin.ajaxGetTypeProduitCategorie'):route('admin.collaborators.admin.ajaxGetTypeProduitCategorie') }}",
		   data: {"_token": "{{ csrf_token() }}","categoryId": categorie_id, "type_id_active": type_id_active},
		   success:function(data) {
			  $('#product_type_id').html(data);
		   }
		});
	}
	</script>
@endsection
