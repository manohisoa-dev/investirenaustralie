@extends('admin.layouts.app')

@section('title', 'Programme - Ajout ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Programmes</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Programmes</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('admin.product.programme')}}">Listes</a>
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
                <h5>Ajouter un nouveau programme</h5>
            </div>
            <div class="ibox-content">
                <form class="form-validation form-padding" action="{{ route('admin.product.store') }}" method="post" id="programmeForm" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    <input type="hidden" name="type" value="{{$type}}" />  
					<div class="row">
						<div class="col-lg-4">
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
								<select class="form-control" name="ancienneteBien" id="ancienneteBien" disabled="disabled">
									<option value="Neuf">Neuf</option>
									<option value="Ancien">Ancien</option>
								</select>
								<input type="hidden" name="ancienneteBien" value="Neuf" />
							</div>
						</div>
						<div class="col-lg-4">
							<div id="nature_enregistrement">
								<div class="form-group">
									<label for="title">Nature de L'Enregistrement *</label>
									<select class="form-control" name="natureBien" id="natureBien" disabled="disabled">
										<option value="Programme immobilier">Programme immobilier</option>
										<option value="Produit isolé">Produit isolé</option>
									</select>
									<input type="hidden" name="natureBien" value="Programme immobilier" />
								</div>
							</div>
						</div>
					</div> 
					<div id="infoNewProgramme">
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
										@foreach(\App\Models\Country::where('id',12)->get() as $country)
											<option value="{{$country->id}}">{{$country->content}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">Etat *</label>
									<select class="form-control" name="state_id" id="state_id" style="width:100%">
										@foreach(\App\Models\State::all() as $state)
											<option value="{{$state->id}}">{{$state->content}}</option>
										@endforeach
									</select>
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
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="dropzone" id="image_upload" multiple>
									<!--<div class="fallback">
										<input name='file' type='file' multiple />
									</div>-->
									<div id="template" class="file-row">
										
										

									</div>
								</div>
							</div>
						</div>						
						<div class="row">
							<div class="col-lg-12">
								<label class="chk_firb"> 
									<input type="checkbox" value="" name="chk_firb"> The Seller certifies under their sole responsibilitythatthis property canbe sold to non-residentforeigners in accordance with Australian law and the rules applicable by the Foreign Investment Review Board (FIRB).
								</label>
							</div>
						</div>
					</div>                              
                    <button type="submit" id="savePro" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Créer</button>
				
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('custom-script')
	<script src="{{asset('administrator/plugins/ckeditor/ckeditor.js')}}"></script>
	<!-- Jquery Validate -->
    <script src="{{ asset('administrator/js/plugins/validate/jquery.validate.min.js') }}"></script>
    <script>
	Dropzone.autoDiscover = false;
	$(document).ready(function(){
		CKEDITOR.replace( 'description' );
		$("#category_id").select2();
		$("#type_id").select2();
		
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
		
		$('#programmeForm').validate({
			ignore: [],
			rules: {
				cat_programmme_id: {
					required: true
				},
				prix_min: {
					required: true
				},
				prix_max: {
					required: true,
					number: true,
					min: function ()  { return parseInt($("#prix_min").val())}
				},
				image_programme: {
					required: true
				},
				type_id: {
					required: true
				},
				display_address: {
					required: true
				},
				postalCode: {
					required: true
				},
				state_id: {
					required: true
				},
				title_programme: {
					required: true,
					remote: {
						url: "{{ route('admin.ajaxCheckTitreProgramme') }}",
						type: "get",
						data: {
							title_programme: function () {
								return $("input[name='title_programme']").val();
							}
						}
					}
				},
				chk_firb: {
					required: true
				}
			},
			messages: {
				cat_programmme_id: {
					required: "Champ obligatoire"
				},
				prix_min: {
					required: "Champ obligatoire"
				},
				prix_max: {
					required: "Champ obligatoire",
					min: jQuery.validator.format("Prix maximal doit superieur à {0}")
				},
				image_programme: {
					required: "Champ obligatoire"
				},
				type_id: {
					required: "Champ obligatoire"
				},
				display_address: {
					required: "Champ obligatoire"
				},
				postalCode: {
					required: "Champ obligatoire"
				},
				state_id: {
					required: "Champ obligatoire"
				},
				title_programme: {
					required: "Champ obligatoire",
					remote: jQuery.validator.format("{0} existe déjà")
				},
				chk_firb: {
					required: "Champ obligatoire"
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
	});
	</script>
@endsection