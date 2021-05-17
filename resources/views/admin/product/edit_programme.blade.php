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
                <form action="{{ route('admin.product.index')}}/{{$product->id}}" method="post">

                    {{ csrf_field() }}

                    {{ method_field("PUT") }}
					<input type="hidden" name="type" value="{{$type}}" />                                                                  
                    <div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label>A quelle catégorie appartient le bien que vous voulez saisir ? *</label>
								<select class="form-control" name="cat_programmme_id" id="cat_programmme_id">
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
								<select class="form-control" name="ancienneteBien" id="ancienneteBien">
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
									<select class="form-control" name="natureBien" id="natureBien">
										<option value="Programme immobilier" {{$product->ancienneteBien == 'Programme immobilier' ? 'selected' : ''}}>Programme immobilier</option>
										<option value="Produit isolé" {{$product->ancienneteBien == 'Produit isolé' ? 'selected' : ''}}>Produit isolé</option>
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
					@if ($dossier)
					<div class="row">
						<div class="col-lg-3">
							<div class="file-box">
								<div class="file">
									<a href="{{$dossier->filepath}}" target="_blank">
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
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">Modifier fond de dossier</label>
								<input name="fond_dossier" class="form-control" type="file" accept="image/png, image/jpeg,.pdf,video/mp4,video/x-m4v,video/*">
							</div>
						</div>
					</div>     
					@endif  
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
											<input type="radio" checked="" value="option1" name="radioDrop"> Photo icône
											@else
											<input type="radio" value="option1" name="radioDrop"> Photo icône
											@endif
										</label>
										<a class="pull-right" href=""><i class="fa fa-trash"></i></a>
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
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Enregistrer</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
	<script src="{{asset('administrator/plugins/ckeditor/ckeditor.js')}}"></script>
	<script>
		Dropzone.autoDiscover = false;
        $(document).ready(function(){
            CKEDITOR.replace( 'description' );
			$("#category_id").select2();
			set_type_programme($('#cat_programmme_id').val(),{{$product->type_id}});
			
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
				url: "{{ route('admin.ajaxDropZone') }}",
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
					file._captionBox = Dropzone.createElement("<label style='width:100%;text-align:center'><input value='"+response.success+"' type='radio' name='radioDrop' style='display:inline-block'> Photo icône</label>");
					file.previewElement.appendChild(file._captionBox);
					$('#programmeForm').append('<input type="hidden" name="dropPhoto[]" value="'+response.success +'">');
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
        }) ;
		
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
    </script>
@endsection
