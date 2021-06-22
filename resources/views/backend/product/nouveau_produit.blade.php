@extends('layouts.backend')

@section('subcontent')
<div class="col-lg-8 col-xl-9">						
    <div class="profile-content-area m-40px-tb">
		
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{route('mes-produits')}}">@lang('app.txt.all_products')</a>
			</li>
			<li class="breadcrumb-item active">
				<strong>@lang('afa.new.product.title')</strong>
			</li>
		</ol>

		
		<div class="card m-40px-b">		
			<div class="card-header">
				<div class="row">
					<div class="col-5 col-lg-8">
						<span class="h6 font-w-500">@lang('afa.new.product.title')</span>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form class="form-padding wizard-big" action="{{ route('save-product') }}" method="post" id="form" enctype="multipart/form-data">
					<h1>@lang('app.config')</h1>
					<fieldset>
						<h4>@lang('app.txt.info_programme')</h4>
						{{ csrf_field() }}
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<label>@lang('app.form.programme_choix_categorie') *</label>
									<select class="form-control" name="cat_programmme_id" id="cat_programmme_id">
										<option value="">@lang('app.form.choix_txt')</option>
										@foreach(\App\Models\Category::all() as $category)
											<option value="{{$category->id}}">{{$category->title}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-7">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_choix_anciennete') *</label>
									<select class="form-control" name="ancienneteBien" id="ancienneteBien">
										<option value="">@lang('app.form.choix_txt')</option>
										<option value="Neuf">Neuf</option>
										<option value="Ancien">Ancien</option>
									</select>
								</div>
							</div>
							<div class="col-lg-5">
								<div id="nature_enregistrement" style="display:none">
									<div class="form-group">
										<label for="title">@lang('app.form.programme_choix_nature') *</label>
										<select class="form-control" name="natureBien" id="natureBien">
											
										</select>
									</div>
								</div>
							</div>
						</div>
						
						<!-- information programme -->
						<div id="info-programme" style="display:none">
							<div class="row">
								<div class="col-md-12">                              
									<div class="form-group">
										<label for="title">@lang('app.form.programme_title') *</label>
										<input name="title_programme" id="title_programme" class="form-control" type="text" value="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">                              
									<div class="form-group">
										<label for="title">@lang('app.form.programme_content')</label>
										<textarea class="form-control" rows="10" name="description" id="description"></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<label for="title">@lang('app.form.programme_price_min') *</label>
									<div class="input-group">
										<input type="number" class="form-control" name="prix_min" id="prix_min">
										<div class="input-group-append">
											<span class="input-group-text">AUD</span>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<label for="title">@lang('app.form.programme_price_max') *</label>
									<div class="input-group">
										<input type="number" class="form-control" name="prix_max" id="prix_max">
										<div class="input-group-append">
											<span class="input-group-text">AUD</span>
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label for="title">@lang('app.form.programme_product_type') *</label>
										<select class="form-control" name="type_id" id="type_id" style="width:100%">
											
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-8">
									<div class="form-group">
										<label for="title">@lang('app.form.programme_adresse') *</label>
										<input name="display_address" id="display_address" class="form-control" type="text" value="">
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label for="title">@lang('app.form.programme_suburb')</label>
										<input name="suburb" id="suburb" class="form-control" type="text" value="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3">
									<div class="form-group">
										<label for="title">@lang('app.form.programme_ville')</label>
										<input name="ville" id="ville" class="form-control" type="text">
									</div>  
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label for="title">@lang('app.form.programme_cp') *</label>
										<input name="postalCode" id="postalCode" class="form-control" type="text" value="">
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label for="title">@lang('app.form.programme_pays')</label>
										<select class="form-control" name="countryId" id="countryId" style="width:100%">
											@foreach(\App\Models\Country::whereIn('id',[12,152])->get() as $country)
												<option value="{{$country->id}}">{{$country->content}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-3">
									<div id="info_etat">
										<div class="form-group">
											<label for="title">@lang('app.form.programme_etat') *</label>
											<select class="form-control" name="state_id" id="state_id" style="width:100%">
												<option value="">Sélectionner état...</option>
												@foreach(\App\Models\State::all() as $state)
													<option value="{{$state->id}}">{{$state->content}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<label for="title">@lang('app.form.programme_fond_dossier')</label>
									<div class="dropzone" id="fond_dossier" multiple style="margin-bottom:15px">
										<div id="template" class="file-row"></div>
									</div>
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-lg-12">
									<label for="title">@lang('app.txt.photo_programme')</label>
									<div class="dropzone" id="image_upload"></div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<label class="chk_firb_programme"> 
										<input type="checkbox" value="" name="chk_firb_programme" id="chk_firb_programme" required> The Seller certifies under their sole responsibilitythatthis property canbe sold to non-residentforeigners in accordance with Australian law and the rules applicable by the Foreign Investment Review Board (FIRB).
									</label>
								</div>
							</div>
						</div>
						<!-- fin information programme -->
						<!-- si ancienneté est encien -->
						<div id="info_code_postal" style="display:none">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="title">@lang('app.form.programme_cp') *</label>
										<input type="text" class="form-control" name="postal_code" id="postal_code" />
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="title">@lang('app.form.product_anneeConstructBuild') *</label>
										<input type="number" class="form-control" name="annee_const" id="annee_const" disabled="disabled"/>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<label class="chk_firb1"> 
										<input type="checkbox" value="" name="chk_firb1"> The Seller certifies undertheir sole responsibilitythatthispropertycanbesold to non-residentforeigners in accordance withAustralianlaw and the rules applicable by the ForeignInvestmentReviewBoard (FIRB)
									</label>
								</div>
							</div>
						</div>
						<!-- fin si ancienneté est encien -->
					</fieldset>
					
					<h1>@lang('app.product')</h1>
					<fieldset>
						<h2>@lang('app.txt.info_produit')</h2>
						<div class="row">
							<div class="col-lg-12">
								<label for="title">@lang('app.form.product_title') *</label>
								<div class="input-group" style="margin-bottom: .5rem;">
									<div class="input-group-append">
										<span class="input-group-text" id="progTitle"></span>
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
							<div class="col-lg-6">
								<div class="form-group">
									<label for="title">@lang('app.input.type') *</label>
									<select class="form-control" name="product_type_id" id="product_type_id" style="width:100%">
										
									</select>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_suburb')</label>
									<input name="suburb_product" id="suburb_product" class="form-control" type="text" value="">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_ville')</label>
									<input name="ville_product" id="ville_product" class="form-control" type="text">
								</div>  
							</div>	
							<div class="col-lg-6">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_cp') *</label>
									<input name="postalCode_product" id="postalCode_product" class="form-control" type="text" value="">
								</div>
							</div>						
						</div>
						<div class="row">							
							<div class="col-lg-6">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_adresse') *</label>
									<input name="display_address_product" id="display_address_product" class="form-control" type="text" value="">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_etat') *</label>
									<select class="form-control" name="state_id_product" id="state_id_product" style="width:100%">
										<option value="">Sélectionner état...</option>
										@foreach(\App\Models\State::all() as $state)
											<option value="{{$state->id}}">{{$state->content}}</option>
										@endforeach
									</select>
								</div>
							</div>							
						</div>
						
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_pays')</label>
									<select class="form-control" name="countryId_product" id="countryId_product" style="width:100%">
										@foreach(\App\Models\Country::where('id',12)->get() as $country)
											<option value="{{$country->id}}">{{$country->content}}</option>
										@endforeach
									</select>
								</div>
							</div>	
							<div class="col-lg-6">
								<div class="form-group">
									<label for="title">@lang('app.form.product_status')</label>
									<select class="form-control" name="status" id="status">
										<option value="waiting">En attente</option>
									</select>
								</div>
							</div>	
						</div>
						<div class="row">
							<div class="col-lg-6">
								<label for="title">@lang('app.form.product_prix_min') *</label>
								<div class="input-group" style="margin-bottom: .5rem;">
									<input type="number" class="form-control" name="price" id="price">
									<div class="input-group-append">
										<span class="input-group-text">AUD</span>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<label for="title">@lang('app.form.product_prix_max') *</label>
								<div class="input-group" style="margin-bottom: .5rem;">
									<input type="number" class="form-control" name="price_max_prd" id="price_max_prd">
									<div class="input-group-append">
										<span class="input-group-text">AUD</span>
									</div>
								</div>
							</div>			
						</div>
						<div class="row">					
							<div class="col-lg-6">
								<div class="form-group">
									<label for="title">@lang('app.input.nbchambre')</label>
									<input name="bedrooms" id="bedrooms" class="form-control" type="number" value="0">
								</div>  
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="title">@lang('app.input.nbchambresuite')</label>
									<input name="ensuite" id="ensuite" class="form-control" type="number" value="0">
								</div>
							</div>														
						</div>
						<div class="row">							
							<div class="col-lg-6">
								<div class="form-group">
									<label for="title">@lang('app.input.nbsalledebain')</label>
									<input name="bathrooms" id="bathrooms" class="form-control" type="number" value="0">
								</div> 
							</div>	
							<div class="col-lg-6">
								<div id="info_qte">
									<div class="form-group">
										<label for="title">@lang('app.form.product_qte')</label>
										<input name="quantity" id="quantity" class="form-control" type="number" value="1">
									</div>
								</div>
							</div>						
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<label for="title">@lang('app.table.produit_image')</label>
									<input name="image" class="form-control" type="file" accept="image/png, image/jpeg">
								</div>
							</div>							
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div id="yearConstruct" style="display:none">								
									<div class="form-group">
										<label for="title">@lang('app.form.product_anneeConstruct') *</label>
										<input name="year_built" id="year_built" class="form-control" type="number" value="0">
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div id="jardin_info" style="display:none">
									<label for="title">@lang('app.form.product_jardin_space')</label>
									<div class="input-group" style="margin-bottom: .5rem;">
										<input type="number" class="form-control" name="superficie_jardin" id="superficie_jardin" value="0">
										<div class="input-group-append">
											<span class="input-group-text">.m2</span>
										</div>
									</div>
								</div>
							</div>							
						</div>
						<div class="row">
							<div class="col-lg-4">
								<label for="title">@lang('app.form.product_area_interior') *</label>
								<div class="input-group" style="margin-bottom: .5rem;">
									<input type="text" name="interior_area" id="interior_area" class="form-control">
									<div class="input-group-append">
										<span class="input-group-text">.m2</span>
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<label for="title">@lang('app.form.product_area_exterior') *</label>
								<div class="input-group" style="margin-bottom: .5rem;">
									<input type="text" name="exterior_area" id="exterior_area" class="form-control">
									<div class="input-group-append">
										<span class="input-group-text">.m2</span>
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<label for="title">@lang('app.form.product_area_total') *</label>
								<div class="input-group" style="margin-bottom: .5rem;">
									<input type="text" name="total_area" id="total_area" class="form-control" readonly="">
									<div class="input-group-append">
										<span class="input-group-text">.m2</span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">							
							<div class="col-lg-6">
								<div class="form-group">
									<label for="title">@lang('app.form.product_parking_ferme')</label>
									<input name="garage_spaces" id="garage_spaces" class="form-control" type="number" value="0">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="title">@lang('app.form.product_parking_carpot')</label>
									<input name="carport_spaces" id="carport_spaces" class="form-control" type="number" value="0">
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
					</fieldset>
				</form>
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
<!-- Steps -->
<script src="{{ asset('administrator/js/plugins/steps/jquery.steps.min.js') }}"></script>
<!-- Jquery checkeditor -->
<script src="{{asset('administrator/plugins/ckeditor/ckeditor.js')}}"></script>
<!-- Jquery Validate -->
<script src="{{ asset('administrator/js/plugins/validate/jquery.validate.min.js') }}"></script>
<script>
	Dropzone.autoDiscover = false;
	$(document).ready(function(){
		$.validator.setDefaults({
			ignore: []
		});	
		$("#form").steps({
			bodyTag: "fieldset",
			labels: {
				current: "current step:",
				pagination: "Pagination",
				finish: "@lang('app.form.steps_btn_finish')",
				next: "@lang('app.form.steps_btn_saisir_product')",
				previous: "@lang('app.form.steps_btn_precedent')",
				loading: "@lang('app.form.steps_load')"
			},
			onStepChanging: function (event, currentIndex, newIndex)
			{
				var ancienneteBien = $('#ancienneteBien').val();
				var natureBien = $('#natureBien').val();
				if(ancienneteBien == 'Neuf' && natureBien == 'Programme immobilier'){
					var titre_programme = $('#title_programme').val();
					$('[name="product_type_id"]').val($('#type_id').val());
					$('[name="suburb_product"]').val($('#suburb').val()).prop("readonly", true);
					$('[name="ville_product"]').val($('#ville').val()).prop("readonly", true);
					$('[name="postalCode_product"]').val($('#postalCode').val()).prop("readonly", true);
					$('[name="display_address_product"]').val($('#display_address').val()).prop("readonly", true);
					$('[name="state_id_product"]').val($('#state_id').val());
					$('[name="countryId_product"]').val($('#countryId').val()).prop("readonly", true);
					$('#jardin_info').hide();
					$('#chk_picine').hide();
					$('#chk_firb').hide();
					$('#yearConstruct').hide();
					$("#progTitle").text(titre_programme);
				}else if(ancienneteBien == 'Neuf' && natureBien == 'Produit isolé'){
					$('#title_product').val('');
					$('#jardin_info').show();
					$('#chk_picine').show();
					$('#chk_firb').show();
					$('#yearConstruct').hide();
				}else if(ancienneteBien == 'Ancien'){
					$('#title_product').val('');
					$('[name="year_built"]').val($('#annee_const').val()).prop("readonly", true);
					$('[name="postalCode_product"]').val($('#postal_code').val()).prop("readonly", true);
					$('#yearConstruct').show();
					$('#jardin_info').show();
					$('#chk_picine').show();
					$('#chk_firb').show();
				}
				// Always allow going backward even if the current step contains invalid fields!
				if (currentIndex > newIndex)
				{
					return true;
				}

				var form = $(this);

				// Clean up if user went backward before
				if (currentIndex < newIndex)
				{
					// To remove error styles
					$(".body:eq(" + newIndex + ") label.error", form).remove();
					$(".body:eq(" + newIndex + ") .error", form).removeClass("error");
				}

				// Disable validation on fields that are disabled or hidden.
				form.validate().settings.ignore = ":disabled,:hidden";

				// Start validation; Prevent going forward if false
				return form.valid();
			},
			onStepChanged: function (event, currentIndex, priorIndex)
			{
				// Suppress (skip) "Warning" step if the user is old enough.
				if (currentIndex === 2 && Number($("#age").val()) >= 18)
				{
					$(this).steps("next");
				}

				// Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
				if (currentIndex === 2 && priorIndex === 3)
				{
					$(this).steps("previous");
				}
			},
			onFinishing: function (event, currentIndex)
			{
				var form = $(this);

				// Disable validation on fields that are disabled.
				// At this point it's recommended to do an overall check (mean ignoring only disabled fields)
				form.validate().settings.ignore = ":disabled";

				// Start validation; Prevent form submission if false
				var val = form.validate();
				console.log(val.errors());
				//console.log("error list", val);
				return form.valid();
			},
			onFinished: function (event, currentIndex)
			{
				var form = $(this);

				// Submit form input
				form.submit();
			}
		}).validate({
			ignore: [],
			onkeyup: false,
			ignore:":not(:visible)",
			errorPlacement: function (error, element)
			{
				if(element.parent().hasClass('input-group')){
					error.insertBefore( element.parent() );
				}else{
					error.insertAfter( element );
				}
			},
			rules: {
				cat_programmme_id: {
					required: true
				},
				ancienneteBien: {
					required: true
				},
				natureBien: {
					required: {
						depends: function(element) {
							if($("#ancienneteBien").val() == 'Neuf'){
								return true;	
							}
						}
					}
				},
				title_programme: {
					required: {
						depends: function(element) {
							if($("#ancienneteBien").val() == 'Neuf' && $("#natureBien").val() == 'Programme immobilier'){
								return true;	
							}
						}
					},
					remote: {
						url: "{{ route('ajaxCheckTitreProgramme') }}",
						type: "get",
						data: {
							title_programme: function () {
								return $("input[name='title_programme']").val();
							}
						}
					}
				},
				prix_min: {
					required: {
						depends: function(element) {
							if($("#ancienneteBien").val() == 'Neuf' && $("#natureBien").val() == 'Programme immobilier'){
								return true;	
							}
						}
					},
					number: true
				},
				prix_max: {
					required: {
						depends: function(element) {
							if($("#ancienneteBien").val() == 'Neuf' && $("#natureBien").val() == 'Programme immobilier'){
								return true;	
							}
						}
					},
					number: true,
					min: function ()  { return parseInt($("#prix_min").val())}
				},
				type_id: {
					required: {
						depends: function(element) {
							if($("#ancienneteBien").val() == 'Neuf' && $("#natureBien").val() == 'Programme immobilier'){
								return true;	
							}
						}
					}
				},
				postal_code: {
					required: {
						depends: function(element) {
							if($("#info_code_postal").is(":visible")){
								return true;	
							}
						}
					},
					remote: {
						url: "{{ route('ajaxCheckFirb') }}",
						type: "get",
						data: {
							postal_code: function () {
								return $("input[name='postal_code']").val();
							}
						},
						complete: function(data){
							if(data.responseText == "true" ) {
								$('#annee_const').prop('disabled', false);
							}else{
								$('#annee_const').prop('disabled', true);
							}
						}
					}
				},
				annee_const: {
					required: {
						depends: function(element) {
							if($("#info_code_postal").is(":visible")){
								return true;	
							}
						}
					}
				},
				chk_firb1: {
					required: {
						depends: function(element) {
							if($("#info_code_postal").is(":visible")){
								return true;	
							}
						}
					}
				},
				title_product: {
					required: true,
					remote: {
						url: "{{ route('ajaxCheckTitreProgramme') }}",
						type: "get",
						data: {
							title_programme: function () {
								if($("input[name='title_programme']").val() != ''){
									var prg_text = $("input[name='title_programme']").val();
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
				price: {
					required: true
				},
				price_max_prd: {
					required: true
				},
				interior_area: {
					required: true,
					number: true,
				},
				exterior_area: {
					required: true,
					number: true,
				},
				total_area: {
					required: true,
					number: true,
				},
				display_address: {
					required: {
						depends: function(element) {
							if($("#ancienneteBien").val() == 'Neuf' && $("#natureBien").val() == 'Programme immobilier'){
								return true;	
							}
						}
					}
				},
				postalCode: {
					required: {
						depends: function(element) {
							if($("#ancienneteBien").val() == 'Neuf' && $("#natureBien").val() == 'Programme immobilier'){
								return true;	
							}
						}
					}
				},
				state_id: {
					required: {
						depends: function(element) {
							if($("#ancienneteBien").val() == 'Neuf' && $("#natureBien").val() == 'Programme immobilier'){
								return true;	
							}
						}
					}
				},
				chk_firb_programme: {
					required: {
						depends: function(element) {
							if($("#ancienneteBien").val() == 'Neuf' && $("#natureBien").val() == 'Programme immobilier'){
								return true;	
							}
						}
					}
				},
				state_id_product:{
					required: true,
				}
			},
			messages: {
				cat_programmme_id: {
					required: "@lang('app.txt.champobligatoire')"
				},
				ancienneteBien: {
					required: "@lang('app.txt.champobligatoire')"
				},
				natureBien: {
					required: "@lang('app.txt.champobligatoire')"
				},
				prix_min: {
					required: "@lang('app.txt.champobligatoire')"
				},
				prix_max: {
					required: "@lang('app.txt.champobligatoire')",
					min: jQuery.validator.format("@lang('app.form.programme_validate_prix_max') {0}")
				},
				type_id: {
					required: "@lang('app.txt.champobligatoire')"
				},
				postal_code: {
					required: "@lang('app.txt.champobligatoire')",
					remote: jQuery.validator.format("{0} @lang('app.form.validation_cp')")
				},
				annee_const: {
					required: "@lang('app.txt.champobligatoire')",
				},
				chk_firb1: {
					required: "@lang('app.txt.champobligatoire')"
				},
				title_product: {
					required: "@lang('app.txt.champobligatoire')",
					remote: jQuery.validator.format("{0} existe déjà")
				},
				product_type_id: {
					required: "@lang('app.txt.champobligatoire')"
				},
				postalCode_product: {
					required: "@lang('app.txt.champobligatoire')"
				},
				display_address_product: {
					required: "@lang('app.txt.champobligatoire')"
				},
				price: {
					required: "@lang('app.txt.champobligatoire')"
				},
				price_max_prd: {
					required: "@lang('app.txt.champobligatoire')"
				},
				interior_area: {
					required: "@lang('app.txt.champobligatoire')"
				},
				exterior_area: {
					required: "@lang('app.txt.champobligatoire')"
				},
				total_area: {
					required: "@lang('app.txt.champobligatoire')"
				},
				display_address: {
					required: "@lang('app.txt.champobligatoire')"
				},
				postalCode: {
					required: "@lang('app.txt.champobligatoire')"
				},
				title_programme: {
					required: "@lang('app.txt.champobligatoire')",
					remote: jQuery.validator.format("{0} @lang('app.form.programme_validate_titre')")
				},
				chk_firb_programme: {
					required: "@lang('app.txt.champobligatoire')"
				},
				state_id: {
					required: "@lang('app.txt.champobligatoire')"
				},
				state_id_product: {
					required: "@lang('app.txt.champobligatoire')"
				}
			},
			success: function(label,element) {
				label.parent().removeClass('error');
				label.remove(); 
			}
		});
		
		CKEDITOR.replace( 'description' );
		CKEDITOR.replace( 'desc_product' );
		$("#category_id").select2();
		$("#seller_id").select2();
		$("#parent_id").select2();
		
		$("#fond_dossier").dropzone({
			maxFiles: 25, 
            maxFilesize: 50,
			dictDefaultMessage: "@lang('app.txt.fond_dossier')",
			url: "{{ route('ajaxDropZone') }}",
			params: {"_token": "{{ csrf_token() }}"},
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf,video/mp4,video/x-m4v",
            addRemoveLinks: true,
            timeout: 50000,
            init:function() {
				// Get images
				var myDropzone = this;
			},
            removedfile: function(file) 
            {
				if (this.options.dictRemoveFile) {
				  return Dropzone.confirm("Are You Sure to "+this.options.dictRemoveFile, function() {
					if(file.previewElement.id != ""){
						var name = file.previewElement.id;
					}else{
						var name = file.name;
					}
					//console.log(name);
					var fileRef;
						return (fileRef = file.previewElement) != null ? 
						fileRef.parentNode.removeChild(file.previewElement) : void 0;
				  });
			    }		
            },
       
            success: function(file, response) 
            {
				file.previewElement.id = response.success;
				//console.log(file.previewElement.id); 
				// set new images names in dropzone’s preview box.
                var olddatadzname = file.previewElement.querySelector("[data-dz-name]");   
				file.previewElement.querySelector("img").alt = response.success;
				file._captionBox = Dropzone.createElement("<label style='width:100%;text-align:center'>"+response.success+"</label>");
				file.previewElement.appendChild(file._captionBox);
				$('#form').append('<input type="hidden" name="fondDossier[]" value="'+response.success +'">');
				olddatadzname.innerHTML = response.success;
            },
            error: function(file, response)
            {
               if($.type(response) === "string")
					var message = response; //dropzone sends it's own error messages in string
				else
					var message = response.message;
				file.previewElement.classList.add("dz-error");
				_ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
				_results = [];
				for (_i = 0, _len = _ref.length; _i < _len; _i++) {
					node = _ref[_i];
					_results.push(node.textContent = message);
				}
				return _results;
            }
		});
		
		$("#image_upload").dropzone({
			maxFiles: 25, 
			maxFilesize: 50,
			dictDefaultMessage: "@lang('app.dropzone.libelle')",
			url: "{{ route('ajaxDropZone') }}",
			params: {"_token": "{{ csrf_token() }}"},
			acceptedFiles: ".jpeg,.jpg,.png,.gif",
			addRemoveLinks: true,
			timeout: 50000,
			init:function() {
				// Get images
				var myDropzone = this;
			},
			removedfile: function(file) 
			{
				if (this.options.dictRemoveFile) {
				  return Dropzone.confirm("Are You Sure to "+this.options.dictRemoveFile, function() {
					if(file.previewElement.id != ""){
						var name = file.previewElement.id;
					}else{
						var name = file.name;
					}
					//console.log(name);
					var fileRef;
						return (fileRef = file.previewElement) != null ? 
						fileRef.parentNode.removeChild(file.previewElement) : void 0;
				  });
				}		
			},
	   
			success: function(file, response) 
			{
				file.previewElement.id = response.success;
				//console.log(file.previewElement.id); 
				// set new images names in dropzone’s preview box.
				var olddatadzname = file.previewElement.querySelector("[data-dz-name]");   
				file.previewElement.querySelector("img").alt = response.success;
				file._captionBox = Dropzone.createElement("<label style='width:100%;text-align:center'><input value='"+response.success+"' type='radio' name='radioDrop' style='display:inline-block'> @lang('app.dropzone.photoIcon_tex')</label>");
				file.previewElement.appendChild(file._captionBox);
				$('#form').append('<input type="hidden" name="dropPhoto[]" value="'+response.success +'">');
				olddatadzname.innerHTML = response.success;
			},
			error: function(file, response)
			{
			   if($.type(response) === "string")
					var message = response; //dropzone sends it's own error messages in string
				else
					var message = response.message;
				file.previewElement.classList.add("dz-error");
				_ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
				_results = [];
				for (_i = 0, _len = _ref.length; _i < _len; _i++) {
					node = _ref[_i];
					_results.push(node.textContent = message);
				}
				return _results;
			}
		});
		
		$('#countryId').on('change', function() {
			var country = this.value;
			if(country == 152){
				$('#info_etat').hide();
			}else{
				$('#info_etat').show();
			}
		});
		
		$('#cat_programmme_id').on('change', function() {
			$('#nature_enregistrement').hide();
			$('#info-programme').hide();	
			$('#infoAdresse').hide();
			$('#info_code_postal').hide();
			$('[name="ancienneteBien"]').val('');
			var category = this.value;
			if(category != 1){
				$('#natureBien').empty().append($('<option />').text("@lang('app.form.choix_txt')").val(''),$('<option />').text('Produit isolé').val('Produit isolé'));
				$('#info_qte').show();
			}else{
				console.log('Residentiel');
				$('#natureBien').empty().append($('<option />').text("@lang('app.form.choix_txt')").val(''),$('<option />').text('Programme immobilier').val('Programme immobilier'),$('<option />').text('Produit isolé').val('Produit isolé'));
				$('#info_qte').hide();
			}
			
			//changer list type produit par rapport au programme
			$.ajax({
			   type:'POST',
			   url:"{{ route('ajaxGetTypeProduitCategorie') }}",
			   data: {"_token": "{{ csrf_token() }}","categoryId": category},
			   success:function(data) {
				  console.log(data);
				  $('#type_id').html(data);
				  $('#product_type_id').html(data);
				  
			   }
			});
		});
		
		$('#ancienneteBien').on('change', function() {
			var anciennete = this.value;
			if(anciennete == 'Neuf'){
				$('#nature_enregistrement').show();
				$('#infoAdresse').show();
				$('#info_code_postal').hide();
				
				$('#natureBien').on('change', function() {
					var nature = this.value;
					//console.log(nature);
					if(nature == 'Programme immobilier'){
						$('#info-programme').show();								
					}else{
						//pour le programme individuel
						$('#info-programme').hide();	
						$("#form").steps("next");
					}
				});
			}else{
				$('#info_code_postal').show();
				$('#infoAdresse').hide();
				$('#nature_enregistrement').hide();
				$('#info-programme').hide();	
			}
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
		
		$('#postal_code').keyup(function(){
			var codeP = this.value;
			$.ajax({
			   type:'GET',
			   url:"{{ route('ajaxCheckFirb') }}",
			   data: {"_token": "{{ csrf_token() }}","postal_code": codeP},
			   success:function(data) {
				  if(data == "true" ) {
					 $('#annee_const').prop('disabled', false);
					 $('#postal_code').removeClass('error');
					 $('#postal_code-error').hide();
				  }else{
					 $('#postal_code').addClass('error');
					 $('#postal_code-error').show();
				  }					  
			   }
			});
		});
		
		$('#garage_spaces, #carport_spaces').bind('keyup mouseup', function (){
			if($('#garage_spaces').val() != 0 || $('#carport_spaces').val() != 0){
				 console.log('tokony disabled');
				$("#chk_parking").attr('disabled','disabled');
			}else{
				console.log('normal');
				$("#chk_parking").removeAttr('disabled');
			}
		});	
			
	});
</script>
@endpush