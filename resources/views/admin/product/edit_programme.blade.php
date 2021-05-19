@extends('admin.layouts.app')

@section('title', 'Products - Edition ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Programme</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Programme</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.product.programme') }}">Listes</a>
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
                <h5>Mise à jour Programme : {{$product->title}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('admin.product.index')}}/{{$product->id}}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    {{ method_field("PUT") }}
					<input type="hidden" name="type" value="{{$type}}" />   
					<input type="hidden"  name="location_Id" value="{{$product->location_id}}" />                                                              
                    <div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label>A quelle catégorie appartient le bien que vous voulez saisir ? *</label>
								<select class="form-control" name="cat_programmme_id" id="cat_programmme_id" disabled>
									<option value="">Choisir...</option>
									@foreach(\App\Models\Category::all() as $category)
										<option value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected' : ''}}>{{$category->title}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">Ancienneté du bien *</label>
								<select class="form-control" name="ancienneteBien" id="ancienneteBien" disabled>
									<option value=""></option>
									<option value="Neuf" {{$product->ancienneteBien == 'Neuf' ? 'selected' : ''}}>Neuf</option>
									<option value="Ancien" {{$product->ancienneteBien == 'Ancien' ? 'selected' : ''}}>Ancien</option>
								</select>
							</div>
						</div>
						<div class="col-lg-4">
							<div id="nature_enregistrement">
								<div class="form-group">
									<label for="title">Nature de L'Enregistrement *</label>
									<select class="form-control" name="natureBien" id="natureBien" disabled>
										<option value="Programme immobilier" {{$product->natureBien == 'Programme immobilier' ? 'selected' : ''}}>Programme immobilier</option>
										<option value="Produit isolé" {{$product->natureBien == 'Produit isolé' ? 'selected' : ''}}>Produit isolé</option>
									</select>
								</div>
							</div>
						</div>
					</div>         
                    <div class="row">
						<div class="col-md-12">                              
							<div class="form-group">
								<label for="title">Nom/Titre du programme *</label>
								<input name="title_programme" id="title_programme" class="form-control" type="text" value="{{$product->title}}">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">                              
							<div class="form-group">
								<label for="title">Description du programme</label>
								<textarea class="form-control" rows="10" name="description" id="description">{{$product->content}}</textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="title">Prix Minimal *</label>
								<div class="input-group m-b">
									<input type="number" class="form-control" name="prix_min" id="prix_min" value="{{$product->min_price}}">
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
									<input type="number" class="form-control" name="prix_max" id="prix_max" value="{{$product->max_price}}">
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
								<input name="display_address" id="display_address" class="form-control" type="text" value="{{$product->display_address}}">
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">Suburb</label>
								<input name="suburb" id="suburb" class="form-control" type="text" value="{{$localisation->area_level_1}}">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Ville</label>
								<input name="ville" id="ville" class="form-control" type="text" value="{{$localisation->locality}}">
							</div>  
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Code postal *</label>
								<input name="postalCode" id="postalCode" class="form-control" type="text" value="{{$product->postalCode}}">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Pays</label>
								<select class="form-control" name="countryId" id="countryId" style="width:100%">
									@foreach(\App\Models\Country::where('id',12)->get() as $country)
										<option value="{{$country->id}}" {{$country->id == $localisation->country ? 'selected' : ''}}>{{$country->content}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Etat *</label>
								<select class="form-control" name="state_id" id="state_id" style="width:100%">
									@foreach(\App\Models\State::all() as $state)
										<option value="{{$state->id}}" {{$state->id == $product->state_id ? 'selected' : ''}}>{{$state->content}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div> 
					
					<div class="row">
						@if ($dossier)
						<div class="col-lg-3">
							<div class="file-box">
								<div class="file">
									<a href="{{asset($dossier->filepath)}}" target="_blank">
										<span class="corner"></span>
										<div class="icon">
											<i class="fa fa-file"></i>
										</div>
										<div class="file-name">
											Fond de dossier<br><small>{{$dossier->created_at ? $dossier->created_at->diffForHumans() : ""}}</small>
										</div>
									</a>
								</div>
							</div>
						</div>
						@endif  
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">Modifier fond de dossier</label>
								<input name="fond_dossier" class="form-control" type="file" accept="image/png, image/jpeg,.pdf,video/mp4,video/x-m4v,video/*">
							</div>
						</div>
					</div>     
					
					@if ($photos)
					<div class="row">
						<div class="col-lg-12">
						@foreach ( $photos as $photo )					
						<div class="file-box">
							<div class="file">
								<a href="#">
									<span class="corner"></span>						
									<div class="image">
										<img alt="image" class="img-fluid" src="{{asset($photo->filepath)}}">
									</div>
									<div class="file-name">
										<label> 
											@if($photo->is_principal == 1)
											<input type="radio" checked="" value="{{$photo->prdImageId}}" name="radioDrop"> Photo icône
											@else
											<input type="radio" value="{{$photo->prdImageId}}" name="radioDrop"> Photo icône 
											@endif
										</label>
										<a class="pull-right" href="javascript:void(0)" onclick="delete_photo({{$photo->prdImageId}})">
											<i class="fa fa-trash"></i>
										</a>
										<br>
										<small>{{$photo->created_at ? $photo->created_at->diffForHumans() : ""}}</small>
									</div>
								</a>						
							</div>
						</div>
						@endforeach
						</div>
					</div>
					@endif  
					<div class="row" style="margin-bottom:15px">
						<div class="col-lg-12">
							<div class="dropzone" id="image_upload" multiple>
								<div id="template" class="file-row"></div>
							</div>
						</div>
					</div>	                                                                                                                    
                    <button type="submit" class="btn btn-primary btn-lg pull-right"><i class="fa fa-save"></i> Enregistrer la modification</button>
					<div style="clear:both"></div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="row">
	<div class="col-lg-12">
		<div class="ibox ">
			<div class="ibox-title">
				<h5>Produits du programme</h5>
				<div class="ibox-tools">
					<a href="javascript:void(0)" onclick="add_product({{$product->id}})" class="btn btn-primary btn-block">
						<i class="fa fa-plus"></i> Ajouter un nouveau Produit 
					</a>
				</div>
			</div>
			<div class="ibox-content">
				<table class="table table-striped grid-view-tbl">
					<thead>
                        <tr class="header-row">
							<th>Id</th>
							<th>Image</th>
							<th>Titre</th>
							<th>Prix min</th>
							<th>Prix max</th>
							<th>Date</th>
							<th>Statut</th>
							<th>Vendeur</th>
							<th>Auteur</th>
							<th style="text-align:center">Actions</th>
						</tr>
					</thead>
					<tbody>
					@foreach($product_lies as $product_lie)
						<tr>
							<td>{{$product_lie->id}}</td>
							<td>
								@if (@getimagesize($product_lie->imageUrl()))
									<a href="{{route('admin.product.index')}}/{{$product_lie->id}}">
										<img src="{{$product_lie->imageUrl()}}" class="img-responsive" style="height:80px" />
									</a>
								@else
									<a href="{{route('admin.product.index')}}/{{$product_lie->id}}">
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
							<td class="actions-cell text-center" width="10%">								
								<a href="javascript:void(0)" onclick="edit_product({{$product_lie->id}})" class="btn btn-default btn-circle" title="Modification">
									<i class="fa fa-pencil-square-o"></i>
								</a>&nbsp;&nbsp;
								<a href="javascript:void(0)" onclick="delete_product({{$product_lie->id}})" class="btn btn-default btn-circle" title="Supprimer">
									<i class="fa fa-times text-danger"></i>
								</a>
							</td>
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
	<script src="{{asset('administrator/plugins/ckeditor/ckeditor.js')}}"></script>
	<script src="{{ asset('administrator/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
	<script>
		Dropzone.autoDiscover = false;
        $(document).ready(function(){
            CKEDITOR.replace( 'description' );
			$("#category_id").select2();
			set_type_programme($('#cat_programmme_id').val(),{{$product->type_id}});
			set_type_produit($('#cat_programmme_id').val());
			
			$('#cat_programmme_id').on('change', function() {
				var category = this.value;
				$.ajax({
				   type:'POST',
				   url:"{{ route('admin.ajaxGetTypeProduitCategorie') }}",
				   data: {"_token": "{{ csrf_token() }}","categoryId": category, "type_id_active": 0},
				   success:function(data) {
					  console.log(data);
					  $('#type_id').html(data);
					  $('#product_type_id').html(data);
					  
				   }
				});
			});
			
			$("#image_upload").dropzone({
				maxFiles: 5, 
				maxFilesize: 4,
				dictDefaultMessage: 'Choisir plusieurs photo pour la représentation du programme',
				url: "{{ route('admin.ajaxDropZoneEdit') }}",
				params: {"_token": "{{ csrf_token() }}","id_programme": "{{ $product->id }}"},
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
					location.reload();	
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
			
			$('input[type=radio][name=radioDrop]').change(function() {
				$.ajax({
				   type:'POST',
				   url:"{{ route('admin.ajaxChangeIconPhotoActive') }}",
				   data: {"_token": "{{ csrf_token() }}","id_photo_prd": this.value, "id_prd": {{$product->id}}},
				   success:function(data) {
					  
					  
				   }
				})
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
				  $('#type_id').html(data);
			   }
			});
		}
		
		function set_type_produit(categorie_id)
		{
			$.ajax({
			   type:'POST',
			   url:"{{ route('admin.ajaxGetTypeProduitCategorie') }}",
			   data: {"_token": "{{ csrf_token() }}","categoryId": categorie_id},
			   success:function(data) {
				  $('#product_type_id').html(data);
				  
			   }
			});
		}
		
		function delete_photo(id_photo_prd_image)
		{
			swal({
				title: "Photo icône",
				text: "Voulez vous supprimer ?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: '#ff3547',
				confirmButtonText: 'OUI',
				cancelButtonText: "NON",
				closeOnConfirm: false,
				closeOnCancel: false
			 },
			 function(isConfirm){	
			   if (isConfirm){
					 $.ajax({
						url : "{{ route('admin.ajaxDropPhotoIcon') }}",
						type: "POST",
						dataType: "JSON",
						data:{"_token": "{{ csrf_token() }}",'id_photo_prd_image':id_photo_prd_image},
						success: function(data)
						{
							swal("Photo icône", "photo bien supprimé", "success");
							location.reload();	
						},
						error: function (jqXHR, textStatus, errorThrown)
						{
							swal("Photo icône", "Opération impossible", "error");
							location.reload();	
						}
					}); 
				} else {
					swal("Photo icône", "Vous venez d'annuler l'opération", "error");
				}
			 });
		}
		
		function delete_product(id_prd)
		{
			swal({
				title: "Produit",
				text: "Voulez vous supprimer ?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: '#ff3547',
				confirmButtonText: 'OUI',
				cancelButtonText: "NON",
				closeOnConfirm: false,
				closeOnCancel: false
			 },
			 function(isConfirm){	
			   if (isConfirm){
					 $.ajax({
						url : "{{ route('admin.ajaxDropProduit') }}",
						type: "POST",
						dataType: "JSON",
						data:{"_token": "{{ csrf_token() }}",'id_produit':id_prd},
						success: function(data)
						{
							swal("Produit", "Produit bien supprimé", "success");
							location.reload();	
						},
						error: function (jqXHR, textStatus, errorThrown)
						{
							swal("Produit", "Opération impossible", "error");
							location.reload();	
						}
					}); 
				} else {
					swal("Produit", "Vous venez d'annuler l'opération", "error");
				}
			 });
		}
		
		function add_product(id_programme)
		{
			save_method = 'add';
			$('#form_product')[0].reset();
			$('.form-group').removeClass('has-error');
			$('.help-block').empty(); 
			$('#id_programme').val(id_programme);
			$('#title_new_programme').val($('#title_programme').val());			
			$("#progTitle").text($('#title_programme').val());
			$('#modal_form_product').modal('show'); 
			CKEDITOR.replace( 'desc_product' );
			$('.modal-title').text('Nouveau produit');
		}
		
		function edit_product(id_produit)
		{
			save_method = 'update';
			$('#form_product')[0].reset(); 
			$('.form-group').removeClass('has-error'); 
			$('.help-block').empty(); 
		
		
			//Ajax Load data from ajax
			$.ajax({
				url : "{{ route('admin.ajaxGetProductById') }}",
				type: "POST",
				dataType: "JSON",
				data:{"_token": "{{ csrf_token() }}",'id_produit':id_produit},
				success: function(data)
				{
					console.log(data);
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
					
					$('#modal_form_product').modal('show'); 
					$('.modal-title').text('Modification agence'); 
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
				url = "{{ route('admin.ajaxSaveProduct') }}";
			} else {
				url = "{{ route('admin.ajaxModifProduct') }}";
			}
			
			form.validate({
				rules: {
					title_product: {
						required: true,
						remote: {
							url: "{{ route('admin.ajaxCheckTitreProgramme') }}",
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
						required: true
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
					}
				},
				messages: {
					title_product: {
						required: "Champ obligatoire",
						remote: jQuery.validator.format("{0} existe déjà")
					},
					product_type_id: {
						required: "Champ obligatoire"
					},
					postalCode_product: {
						required: "Champ obligatoire"
					},
					display_address_product:{
						required: "Champ obligatoire"
					},
					state_id_product:{
						required: "Champ obligatoire"
					},
					price:{
						required: "Champ obligatoire"
					},
					price_max_prd:{
						required: "Champ obligatoire"
					},
					interior_area:{
						required: "Champ obligatoire"
					},
					exterior_area:{
						required: "Champ obligatoire"
					},
					total_area:{
						required: "Champ obligatoire"
					},
					year_built:{
						required: "Champ obligatoire"
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
						console.log(data);
						location.reload();
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
						<input type="hidden" name="title_new_programme" id="title_new_programme" />
						<input type="hidden" name="prg_anciennete" id="prg_anciennete" value="{{$product->ancienneteBien}}" />
						<input type="hidden" name="prg_nature" id="prg_nature" value="{{$product->natureBien}}"/>
						<input type="hidden" name="prg_cat_id" id="prg_cat_id" value="{{$product->category_id}}"/>
						<input type="hidden" name="id_programme" id="id_programme"/>
						<input type="hidden" name="id_product" id="id_product" />
						<input type="hidden" name="id_location_product" id="id_location_product" />
						{{ csrf_field() }}
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<label for="title">Titre du produit *</label>
									<div class="input-group m-b">
										<div class="input-group-prepend">
											<span class="input-group-addon" id="progTitle"></span>
										</div>
										<input name="title_product" id="title_product" class="form-control" type="text" value="" title="Indiquez la référence du produit">
									</div>									
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
									<input name="image" class="form-control" type="file" accept="image/png, image/jpeg">
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
									<input type="checkbox" value="1" id="chk_parking" name="chk_parking"> parking voies publiques
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
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="btnSave" onClick="save_product()">Enregistrer</button>
				</div>
			</div>
		</div>
	</div>
@endsection
