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
						<h2>Information sur la configuration</h2>
						{{ csrf_field() }}
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<label for="title">Ancienneté du bien *</label>
									<select class="form-control" name="ancienneteBien" id="ancienneteBien">
										<option value="">Choisir...</option>
										<option value="Neuf">Neuf</option>
										<option value="Ancien">Ancien</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row" style="display:none" id="nature_enregistrement">
							<div class="col-lg-12">
								<div class="form-group">
									<label for="title">Nature de L'Enregistrement *</label>
									<select class="form-control" name="natureBien" id="natureBien">
										<option value="">Choisir...</option>
										<option value="Programme immobilier">Programme immobilier</option>
										<option value="Produit individuel">Produit individuel</option>
									</select>
								</div>
							</div>
						</div>
						<!-- choix programmme existant ou nouveau -->
						<div class="row" style="display:none" id="programme">
							<div class="col-lg-6">
								<div class="form-group">
									<label>Choisir programme *</label>
									<select class="form-control" name="parent_id" id="parent_id" style="width:100%">
										<option value="">Choisir...</option>
										<option value="0">Nouveau programme</option>
										@foreach(\App\Models\Product::where('parent_id',0)->get() as $prd)
											<option value="{{$prd->id}}">{{$prd->title}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-6"></div>
						</div>
						<!-- fin choix programmme existant ou nouveau -->
						<!-- information programme -->
						<div id="info-programme" style="display:none">
							<div class="row">							
								<div class="col-lg-3">
									<div class="form-group">
										<label>Catégorie *</label>
										<select class="form-control" name="cat_programmme_id" id="cat_programmme_id">
											<option value="">Choisir...</option>
											@foreach(\App\Models\Category::all() as $category)
												<option value="{{$category->id}}">{{$category->title}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label>Prix Minimal *</label>
										<input name="prix_min" id="prix_min" class="form-control" type="number" value="0">
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label>Prix Maximal *</label>
										<input name="prix_max" id="prix_max" class="form-control" type="number" value="0">
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label for="title">Photo</label>
										<input name="image_programme" class="form-control" type="file">
									</div>
								</div>
							</div>
							<div class="row">     
								<div class="col-lg-12">                              
									<div class="form-group">
										<label for="title">Titre *</label>
										<input name="title" id="title" class="form-control" type="text" value="">
									</div>
								</div>
							</div>
							<div class="row">     
								<div class="col-lg-12">                              
									<div class="form-group">
										<label for="title">Description</label>
										<textarea class="form-control" rows="10" name="description" id="description"></textarea>
										<input type="hidden" name="type" value="{{$type}}" />
									</div>
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
									<label class="chk_firb"> 
										<input type="checkbox" value="" name="chk_firb"> The Seller certifies undertheir sole responsibilitythatthispropertycanbesold to non-residentforeigners in accordance withAustralianlaw and the rules applicable by the ForeignInvestmentReviewBoard (FIRB)
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
									<input name="title_product" id="title_product" class="form-control" type="text" value="">
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
									<select class="form-control" name="type_id" id="type_id" style="width:100%">
										<option value="">Choisir...</option>
										@foreach(\App\Models\Type::all() as $ty)
											<option value="{{$ty->id}}">{{$ty->title}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Quantité</label>
									<input name="quantity" id="quantity" class="form-control" type="number" value="0">
								</div>  
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Prix</label>
									<input name="price" id="price" class="form-control" type="number" value="0">
								</div>  
							</div>							
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Devise</label>
									<select class="form-control" name="currency" id="currency">
										<option value="EUR">Euro</option>
										<option value="USD">Dollar</option>
										<option value="AUD" selected="selected">Dollar Australien</option>
									</select>
								</div>  
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Photo</label>
									<input name="image" class="form-control" type="file">
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Statuts</label>
									<select class="form-control" name="status" id="status">
										<option value="published">Publier</option>
										<option value="archived">Archivé</option>
									</select>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Surface *</label>
									<input name="area" id="area" class="form-control" type="text" value="">
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Espaces de carport</label>
									<input name="carport_spaces" id="carport_spaces" class="form-control" type="number" value="0">
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Surface intérieur</label>
									<input name="interior_area" id="interior_area" class="form-control" type="number" value="0">
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Surface extérieur</label>
									<input name="exterior_area" id="exterior_area" class="form-control" type="number" value="0">
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Surface total</label>
									<input name="total_area" id="total_area" class="form-control" type="number" value="0">
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Unités garage</label>
									<input name="garage_spaces" id="garage_spaces" class="form-control" type="number" value="0">
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Nombre d'étages</label>
									<input name="number_of_floors" id="number_of_floors" class="form-control" type="number" value="0">
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Nombre de sweet</label>
									<input name="ensuite" id="ensuite" class="form-control" type="number" value="0">
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Nombre de salles de bain</label>
									<input name="bathrooms" id="bathrooms" class="form-control" type="number" value="0">
								</div> 
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Nombre de chambre</label>
									<input name="bedrooms" id="bedrooms" class="form-control" type="number" value="0">
								</div>  
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Etat</label>
									<select class="form-control" name="state_id" id="state_id" style="width:100%">
										@foreach(\App\Models\State::all() as $state)
											<option value="{{$state->id}}">{{$state->content}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Code postal</label>
									<input name="postalCode" id="postalCode" class="form-control" type="text" value="">
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Nouvelle construction</label>
									<select class="form-control" name="new_construction" id="new_construction">
										<option value="0">OUI</option>
										<option value="1">NON</option>
									</select>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Année de construction</label>
									<input name="year_built" id="year_built" class="form-control" type="number" value="0">
								</div>
							</div>							
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<label for="title">Adresse *</label>
									<input name="display_address" id="display_address" class="form-control" type="text" value="">
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
        $(document).ready(function(){			
			$("#form").steps({
                bodyTag: "fieldset",
                onStepChanging: function (event, currentIndex, newIndex)
                {
					var titre_programme = $('#title').val();
					$('#title_product').val(titre_programme+' - ');
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
				errorPlacement: function (error, element)
				{
					if(element.parent().hasClass('input-group')){
						error.insertBefore( element.parent() );
					}else{
						error.insertAfter( element );
					}
				},
				rules: {
					ancienneteBien: {
						required: true
					},
					natureBien: {
						required: true
					},
					postal_code: {
						required: true,
						remote: {
                            url: "{{ route('admin.ajaxCheckFirb') }}",
                            type: "GET",
                            data: {
                                postal_code: function () {
									return $("input[name='postal_code']").val();
								},
                            },
							success: function(msg){
								if(msg.msg == 'true') {
									console.log('exists');
									return 'true';
								}else{
									console.log('doesnt exists');
									return 'false';
								}
							},
                        },
					},
					chk_firb: {
						required: true,
					},
					parent_id: {
						required: true
					},
					title: {
						required: true
					},
					cat_programmme_id: {
						required: true
					},
					prix_min: {
						required: true
					},
					prix_max: {
						required: true
					},
					display_address: {
						required: true
					},
					price: {
						required: true
					},
					quantity: {
						required: true
					},
					type_id: {
						required: true
					},
					title_product: {
						required: true
					}
				},
				messages: {
					ancienneteBien: {
						required: "Champ obligatoire"
					},
					natureBien: {
						required: "Champ obligatoire"
					},
					postal_code: {
						required: "Champ obligatoire",
						remote: $.validator.format("Code postal non autorisé"),
					},
					chk_firb: {
						required: "Champ obligatoire"
					},
					parent_id: {
						required: "Champ obligatoire"
					},
					title: {
						required: "Champ obligatoire"
					},
					cat_programmme_id: {
						required: "Champ obligatoire"
					},
					prix_min: {
						required: "Champ obligatoire"
					},
					prix_max: {
						required: "Champ obligatoire"
					},
					display_address: {
						required: "Champ obligatoire"
					},
					price: {
						required: "Champ obligatoire"
					},
					quantity: {
						required: "Champ obligatoire"
					},
					type_id: {
						required: "Champ obligatoire"
					},
					title_product: {
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
			$("#type_id").select2();
			
			$('#ancienneteBien').on('change', function() {
				var anciennete = this.value;
				if(anciennete == 'Neuf'){
					$('#nature_enregistrement').show();
					$('#info_code_postal').hide();
					$('#natureBien').on('change', function() {
						var nature = this.value;
						//console.log(nature);
						if(nature == 'Programme immobilier'){
							$('#programme').show();								
						}else{
							//pour le programme individuel
							$('#programme').hide();	
						}
					});
				}else{
					$('#info_code_postal').show();
					$('#nature_enregistrement').hide();
				}
			});
				
			$('#parent_id').on('change', function() {
				var type_programme = this.value;				
				if(type_programme == 0){
					$('[name="cat_programmme_id"]').val('');
					$('#cat_programmme_id').prop('disabled', false);
					$('[name="prix_min"]').val('');
					$("#prix_min").prop("readonly", false);
					$('[name="prix_max"]').val('');
					$("#prix_max").prop("readonly", false);
					$('[name="title"]').val('');
					$("#title").prop("readonly", false);
					CKEDITOR.instances['description'].setData('');					
					$('#info-programme').show();
				}else{
					$.ajax({
					   type:'POST',
					   url:"{{ route('admin.ajaxRequestProgramme.post') }}",
					   data: {"_token": "{{ csrf_token() }}","productId": type_programme},
					   success:function(data) {
						  //console.log(data.content);	
						  $("#form").validate().resetForm();				  
						  $('[name="cat_programmme_id"]').val(data.category_id);
						  //$('#cat_programmme_id'). prop("disabled", true);
						  $('[name="prix_min"]').val(data.min_price);
						  $("#prix_min").prop("readonly", true);
						  $('[name="prix_max"]').val(data.max_price);
						  $("#prix_max").prop("readonly", true);
						  $('[name="title"]').val(data.title);
						  $("#title").prop("readonly", true);
						  CKEDITOR.instances['description'].setData(data.content);
						  $('#info-programme').show();
					   }
					});
				}
			});
        });
    </script>
@endsection