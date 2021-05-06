@extends('admin.layouts.app')

@section('title', 'Products - Ajout ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Products</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Products</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.product.index') }}">Listes</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Ajout</strong>
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
                <h5>Ajouter un nouveau Product</h5>
            </div>
            <div class="ibox-content">
				<form class="form-padding wizard-big" action="{{ route('admin.product.store') }}" method="post" id="form" enctype="multipart/form-data">
					<h1>Configuration</h1>
					<fieldset>
						<h4>Information concernant le programme <small><i>La création d'un programme avec un produit se fait en deux étapes</i></small></h4>
						{{ csrf_field() }}
						<div class="row">
							<div class="col-lg-5">
								<div class="form-group">
									<label>A quelle catégorie appartient le bien que vous voulez saisir ? *</label>
									<select class="form-control" name="cat_programmme_id" id="cat_programmme_id">
										<option value="">Choisir...</option>
										@foreach(\App\Models\Category::all() as $category)
											<option value="{{$category->id}}">{{$category->title}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label for="title">Ancienneté du bien *</label>
									<select class="form-control" name="ancienneteBien" id="ancienneteBien">
										<option value="">Choisir...</option>
										<option value="Neuf">Neuf</option>
										<option value="Ancien">Ancien</option>
									</select>
								</div>
							</div>
							<div class="col-lg-3">
								<div id="nature_enregistrement" style="display:none">
									<div class="form-group">
										<label for="title">Nature de L'Enregistrement *</label>
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
										<label for="title">Nom/Titre du programme *</label>
										<input name="title_programme" id="title_programme" class="form-control" type="text" value="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">                              
									<div class="form-group">
										<label for="title">Description du programme</label>
										<textarea class="form-control" rows="10" name="description" id="description"></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label for="title">Prix Minimal *</label>
										<div class="input-group m-b">
											<input type="number" class="form-control" name="prix_min" id="prix_min">
											<div class="input-group-append">
												<span class="input-group-addon">AUD</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="title">Prix Maximal *</label>
										<div class="input-group m-b">
											<input type="number" class="form-control" name="prix_max" id="prix_max">
											<div class="input-group-append">
												<span class="input-group-addon">AUD</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label for="title">Type de produits *</label>
										<select class="form-control" name="type_id" id="type_id" style="width:100%">
											
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-8">
									<div class="form-group">
										<label for="title">Adresse rue *</label>
										<input name="display_address" id="display_address" class="form-control" type="text" value="">
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label for="title">Suburb</label>
										<input name="suburb" id="suburb" class="form-control" type="text" value="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3">
									<div class="form-group">
										<label for="title">Ville</label>
										<input name="ville" id="ville" class="form-control" type="text">
									</div>  
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label for="title">Code postal *</label>
										<input name="postalCode" id="postalCode" class="form-control" type="text" value="">
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label for="title">Pays</label>
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
											<label for="title">Etat *</label>
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
								<div class="col-lg-4">
									<div class="form-group">
										<label for="title">Fond de dossier</label>
										<input name="fond_dossier" class="form-control" type="file" accept="image/png, image/jpeg,.pdf,video/mp4,video/x-m4v,video/*">
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label for="title">Icône du programme *</label>
										<input name="image_programme" class="form-control" type="file" accept="image/png, image/jpeg,.pdf">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<div class="dropzone">
										<div class="fallback">
											<input name="file" type="file" multiple />
										</div>
									</div>
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
										<label for="title">Code postal *</label>
										<input type="text" class="form-control" name="postal_code" id="postal_code" />
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="title">Année de construction du bâtiment *</label>
										<input type="number" class="form-control" name="annee_const" id="annee_const" />
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
					
					<h1>Produit</h1>
					<fieldset>
						<h2>Information du produit</h2>
						<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label for="title">Titre du produit *</label>
										<input name="title_product" id="title_product" class="form-control" type="text" value="" title="Indiquez la référence du produit">
									</div>
								</div>
							</div>
							<div class="row">     
								<div class="col-lg-12">                              
									<div class="form-group">
										<label for="title">Description produit *</label>
										<textarea class="form-control" rows="10" name="desc_product" id="desc_product"></textarea>
									</div>
								</div>
							</div>
							
						<div class="row">
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Type *</label>
									<select class="form-control" name="product_type_id" id="product_type_id" style="width:100%">
										
									</select>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Suburb</label>
									<input name="suburb_product" id="suburb_product" class="form-control" type="text" value="">
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Ville</label>
									<input name="ville_product" id="ville_product" class="form-control" type="text">
								</div>  
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Code postal *</label>
									<input name="postalCode_product" id="postalCode_product" class="form-control" type="text" value="">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4">
								<div class="form-group">
									<label for="title">Adresse rue *</label>
									<input name="display_address_product" id="display_address_product" class="form-control" type="text" value="">
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label for="title">Etat *</label>
									<select class="form-control" name="state_id_product" id="state_id_product" style="width:100%">
										<option value="">Sélectionner état...</option>
										@foreach(\App\Models\State::all() as $state)
											<option value="{{$state->id}}">{{$state->content}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label for="title">Pays</label>
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
									<label for="title">Prix min de vente *</label>
									<div class="input-group m-b">
										<input type="number" class="form-control" name="price" id="price">
										<div class="input-group-append">
											<span class="input-group-addon">AUD</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Prix max de vente *</label>
									<div class="input-group m-b">
										<input type="number" class="form-control" name="price_max_prd" id="price_max_prd">
										<div class="input-group-append">
											<span class="input-group-addon">AUD</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Statuts</label>
									<select class="form-control" name="status" id="status">
										<option value="published">Publier</option>
										<option value="En attente">En attente</option>
									</select>
								</div>
							</div>
							<div class="col-lg-3">
								<div id="info_qte">
									<div class="form-group">
										<label for="title">Quantité</label>
										<input name="quantity" id="quantity" class="form-control" type="number" value="1">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Nombre de chambre</label>
									<input name="bedrooms" id="bedrooms" class="form-control" type="number" value="0">
								</div>  
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Nombre de suites de chambres</label>
									<input name="ensuite" id="ensuite" class="form-control" type="number" value="0">
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Nombre autres salles de bain/eau</label>
									<input name="bathrooms" id="bathrooms" class="form-control" type="number" value="0">
								</div> 
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Photo</label>
									<input name="image" class="form-control" type="file">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Surface intérieur *</label>
									<div class="input-group m-b">
										<input type="text" name="interior_area" id="interior_area" class="form-control">
										<div class="input-group-append">
											<span class="input-group-addon">.m2</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Surface extérieur *</label>
									<div class="input-group m-b">
										<input type="text" name="exterior_area" id="exterior_area" class="form-control">
										<div class="input-group-append">
											<span class="input-group-addon">.m2</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Surface total *</label>
									<div class="input-group m-b">
										<input type="text" name="total_area" id="total_area" class="form-control" readonly="">
										<div class="input-group-append">
											<span class="input-group-addon">.m2</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div id="yearConstruct" style="display:none">								
									<div class="form-group">
										<label for="title">Année de construction *</label>
										<input name="year_built" id="year_built" class="form-control" type="number" value="0">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4">
								<div class="form-group">
									<label for="title">Emplacements parking fermés</label>
									<input name="garage_spaces" id="garage_spaces" class="form-control" type="number" value="0">
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label for="title">Emplacements parking carport</label>
									<input name="carport_spaces" id="carport_spaces" class="form-control" type="number" value="0">
								</div>
							</div>
							
							<div class="col-lg-4">
								<div id="jardin_info" style="display:none">
									<div class="form-group">
										<label for="title">Superficie jardin privatif</label>
										<div class="input-group m-b">
											<input type="number" class="form-control" name="superficie_jardin" id="superficie_jardin" value="0">
											<div class="input-group-append">
												<span class="input-group-addon">.m2</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-12">
								<label class="chk_parking"> 
									<input type="checkbox" value="1" name="chk_parking"> parking voies publiques
								</label>
							</div>
							
							<div class="col-lg-12">
								<div id="chk_picine" style="display:none">
									<label class="chk_picine"> 
										<input type="checkbox" value="1" name="chk_picine"> piscine
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
@section('custom-script')
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
	<!-- Steps -->
	<script src="{{ asset('administrator/js/plugins/steps/jquery.steps.min.js') }}"></script>
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
					finish: "Terminé",
					next: "Saisir les détails du produit",
					previous: "Précédent",
					loading: "Chargement ..."
				},
                onStepChanging: function (event, currentIndex, newIndex)
                {
					var ancienneteBien = $('#ancienneteBien').val();
					var natureBien = $('#natureBien').val();
					if(ancienneteBien == 'Neuf' && natureBien == 'Programme immobilier'){
						var titre_programme = $('#title_programme').val();
						$('#title_product').val(titre_programme+' - ');
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

                    // Forbid suppressing "Warning" step if the user is to young
                    if (newIndex === 3 && Number($("#age").val()) < 18)
                    {
                        return false;
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
 					console.log("error list", val);
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
							url: "{{ route('admin.ajaxCheckFirb') }}",
							type: "get",
							data: {
								postal_code: function () {
									return $("input[name='postal_code']").val();
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
						required: true
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
					image_programme: {
						required: {
							depends: function(element) {
								if($("#ancienneteBien").val() == 'Neuf' && $("#natureBien").val() == 'Programme immobilier'){
									return true;	
								}
							}
						}
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
					title_programme: {
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
					}
				},
				messages: {
					cat_programmme_id: {
						required: "Champ obligatoire"
					},
					ancienneteBien: {
						required: "Champ obligatoire"
					},
					natureBien: {
						required: "Champ obligatoire"
					},
					prix_min: {
						required: "Champ obligatoire"
					},
					prix_max: {
						required: "Champ obligatoire",
						min: jQuery.validator.format("Prix maximal doit superieur à {0}")
					},
					type_id: {
						required: "Champ obligatoire"
					},
					postal_code: {
						required: "Champ obligatoire",
						remote: jQuery.validator.format("{0} Code postal non autorisé")
					},
					annee_const: {
						required: "Champ obligatoire",
					},
					chk_firb1: {
						required: "Champ obligatoire"
					},
					title_product: {
						required: "Champ obligatoire"
					},
					product_type_id: {
						required: "Champ obligatoire"
					},
					postalCode_product: {
						required: "Champ obligatoire"
					},
					display_address_product: {
						required: "Champ obligatoire"
					},
					price: {
						required: "Champ obligatoire"
					},
					price_max_prd: {
						required: "Champ obligatoire"
					},
					interior_area: {
						required: "Champ obligatoire"
					},
					exterior_area: {
						required: "Champ obligatoire"
					},
					total_area: {
						required: "Champ obligatoire"
					},
					image_programme: {
						required: "Champ obligatoire"
					},
					display_address: {
						required: "Champ obligatoire"
					},
					postalCode: {
						required: "Champ obligatoire"
					},
					title_programme: {
						required: "Champ obligatoire"
					},
					chk_firb_programme: {
						required: "Champ obligatoire"
					}
				}
			});
			
			CKEDITOR.replace( 'description' );
			CKEDITOR.replace( 'desc_product' );
			$("#category_id").select2();
			$("#state_id").select2();
			$("#seller_id").select2();
			$("#parent_id").select2();
			
			Dropzone.options.form = {
				paramName: "file", // The name that will be used to transfer the file
				maxFilesize: 2, // MB
				dictDefaultMessage: "<strong>Drop files here or click to upload. </strong></br> (This is just a demo dropzone. Selected files are not actually uploaded.)"
			};
			//$("#type_id").select2();
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
					$('#natureBien').empty().append($('<option />').text('Choisir...').val(''),$('<option />').text('Produit isolé').val('Produit isolé'));
					$('#info_qte').show();
				}else{
					console.log('Residentiel');
					$('#natureBien').empty().append($('<option />').text('Choisir...').val(''),$('<option />').text('Programme immobilier').val('Programme immobilier'),$('<option />').text('Produit isolé').val('Produit isolé'));
					$('#info_qte').hide();
				}
				
				//changer list type produit par rapport au programme
				$.ajax({
				   type:'POST',
				   url:"{{ route('admin.ajaxGetTypeProduitCategorie') }}",
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
		
        });
    </script>
@endsection