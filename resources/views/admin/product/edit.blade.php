@extends('admin.layouts.app')

@section('title', 'Products - Edition ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Products</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Produits</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.product.index') }}">Listes</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Edition</strong>
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
                <h5>Mise à jour Produit : {{$product->reference}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('admin.product.index')}}/{{$product->id}}" id="productForm" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field("PUT") }}
					<input type="hidden" name="category_id" id="cat_programmme_id" value="{{$product->category_id}}" />
					<input type="hidden" name="location_id" value="{{$product->location_id}}" />
                    <div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label for="title">Titre du produit *</label>
								<input name="title" id="title" class="form-control" type="text" value="{{$product->title}}" title="Indiquez la référence du produit">								
							</div>
						</div>
					</div>
					<div class="row">     
						<div class="col-lg-12">                              
							<div class="form-group">
								<label for="title">Description produit</label>
								<textarea class="form-control" rows="10" name="content" id="content">{{$product->content}}</textarea>
							</div>
						</div>
					</div>
						
					<div class="row">
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Type *</label>
								<select class="form-control" name="type_id" id="product_type_id" style="width:100%">
									
								</select>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Suburb</label>
								<input name="suburb_product" id="suburb_product" class="form-control" type="text" value="{{$localisation ? $localisation->area_level_1:''}}">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Ville</label>
								<input name="ville_product" id="ville_product" class="form-control" type="text" value="{{$localisation ? $localisation->locality:''}}">
							</div>  
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Code postal *</label>
								<input name="postalCode_product" id="postalCode_product" class="form-control" type="text" value="{{$product->postalCode}}">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">Adresse rue *</label>
								<input name="display_address" id="display_address" class="form-control" type="text" value="{{$product->display_address}}">
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">Etat *</label>
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
								<label for="title">Pays</label>
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
								<label for="title">Prix min de vente *</label>
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
								<label for="title">Prix max de vente *</label>
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
								<label for="title">Statuts</label>
								<select class="form-control" name="status" id="status">
									<option value="published" {{$product->status == 'published' ? 'selected' : ''}}>Publier</option>
									<option value="En attente" {{$product->status == 'En attente' ? 'selected' : ''}}>En attente</option>
								</select>
							</div>
						</div>
						<div class="col-lg-3">
							<div id="info_qte">
								<div class="form-group">
									<label for="title">Quantité</label>
									<input name="quantity" id="quantity" class="form-control" type="number" value="{{$product->quantity}}">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">Nombre de chambre</label>
								<input name="bedrooms" id="bedrooms" class="form-control" type="number" value="{{$product->bedrooms}}">
							</div>  
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">Nombre de suites de chambres</label>
								<input name="ensuite" id="ensuite" class="form-control" type="number" value="{{$product->ensuite}}">
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">Nombre autres salles de bain/eau</label>
								<input name="bathrooms" id="bathrooms" class="form-control" type="number" value="{{$product->bathrooms}}">
							</div> 
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Surface intérieur *</label>
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
								<label for="title">Surface extérieur *</label>
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
								<label for="title">Surface total *</label>
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
									<label for="title">Année de construction *</label>
									<input name="year_built" id="year_built" class="form-control" type="number" value="{{$product->year_built}}">
								</div>
							</div>
						@endif
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">Emplacements parking fermés</label>
								<input name="garage_spaces" id="garage_spaces" class="form-control" type="number" value="{{$product->garage_spaces}}">
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">Emplacements parking carport</label>
								<input name="carport_spaces" id="carport_spaces" class="form-control" type="number" value="{{$product->carport_spaces}}">
							</div>
						</div>
						
						<div class="col-lg-4">
							<div id="jardin_info" style="display:none">
								<div class="form-group">
									<label for="title">Superficie jardin privatif</label>
									<div class="input-group m-b">
										<input type="number" class="form-control" name="superficie_jardin" id="superficie_jardin" value="{{$product->superficie_jardin}}">
										<div class="input-group-append">
											<span class="input-group-addon">.m2</span>
										</div>
									</div>
								</div>
							</div>
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
									<label>Photo produit</label>
								</div>
							</div>
						</div>
						@endif
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Photo</label>
								<input name="image" class="form-control" type="file" accept="image/png, image/jpeg">
							</div>
						</div>
					</div>
					
					
					<div class="row">
						<div class="col-lg-12">
							<label class="chk_parking"> 
								<input type="checkbox" value="1" id="chk_parking" name="chk_parking" {{$product->avoir_parking_voie_public == 1 ? 'checked="checked"' : ''}}> parking voies publiques
							</label>
						</div>
						
						@if($product->natureBien == 'Produit isolé')
						<div class="col-lg-12">
							<div id="chk_picine">
								<label class="chk_picine"> 
									<input type="checkbox" value="1" name="chk_picine" {{$product->avoir_piscine == 1 ? 'checked="checked"' : ''}}> piscine
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
                    <button type="submit" class="btn btn-primary btn-lg pull-right"><i class="fa fa-save"></i> Enregistrer</button>
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
					required: "Champ obligatoire"
				},
				type_id: {
					required: "Champ obligatoire"
				},
				min_price: {
					required: "Champ obligatoire"
				},
				max_price: {
					required: "Champ obligatoire",
					min: jQuery.validator.format("Prix maximal doit superieur à {0}")
				},
				display_address: {
					required: "Champ obligatoire",
				},
				postalCode_product: {
					required: "Champ obligatoire",
				},
				interior_area: {
					required: "Champ obligatoire",
				},
				exterior_area: {
					required: "Champ obligatoire",
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
		   url:"{{ route('admin.ajaxGetTypeProduitCategorie') }}",
		   data: {"_token": "{{ csrf_token() }}","categoryId": categorie_id, "type_id_active": type_id_active},
		   success:function(data) {
			  $('#product_type_id').html(data);
		   }
		});
	}
	</script>
@endsection
