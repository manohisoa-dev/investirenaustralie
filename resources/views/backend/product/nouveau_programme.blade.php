@extends('layouts.backend')

@section('subcontent')
					
    <div class="profile-content-area m-40px-tb">
		
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{route('mes-programmes')}}">@lang('app.txt.all_programmes')</a>
			</li>
			<li class="breadcrumb-item active">
				<strong>@lang('app.txt.new_programme')</strong>
			</li>
		</ol>

		
		<div class="card m-40px-b">		
			<div class="card-header">
				<div class="row">
					<div class="col-5 col-lg-8">
						<span class="h6 font-w-500">@lang('app.txt.new_programme')</span>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="media-comment" style="margin-bottom:15px">
					<h6>@lang('app.txt_information_title') </h6>
					<p>@lang('app.txt_information_p')</p>
					<ul>
						<li>@lang('app.txt_information_etape1')</li>
						<li>@lang('app.txt_information_etape2')</li>
					</ul>
				</div>
				<form class="form-validation form-padding" action="{{route('save-programme')}}" method="post" id="programmeForm" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group">
						<label>@lang('app.form.programme_choix_categorie') *</label>
						<select class="form-control" name="cat_programmme_id" id="cat_programmme_id">
							<option value="">@lang('app.form.choix_txt')</option>
							@foreach(\App\Models\Category::where('is_programm', '=', 1)->get() as $category)
								<option value="{{$category->id}}">{{ trans('app.txt.'.$category->title) }}</option>
							@endforeach
						</select>
					</div>
					
					<div class="form-group">
						<label for="title">@lang('app.form.programme_choix_anciennete') *</label>
						<select class="form-control" name="ancienneteBien" id="ancienneteBien" disabled="disabled">
							<option value="Neuf">@lang('app.txt.new')</option>
							<option value="Ancien">@lang('app.txt.old')</option>
						</select>
						<input type="hidden" name="ancienneteBien" value="Neuf" />
					</div>
					
					<div class="form-group">
						<label for="title">@lang('app.form.programme_choix_nature') *</label>
						<select class="form-control" name="natureBien" id="natureBien" disabled="disabled">
							<option value="Programme immobilier">@lang('app.txt.real_estate_program')</option>
							<option value="Produit isolé">@lang('app.txt.isolated_product')</option>
						</select>
						<input type="hidden" name="natureBien" value="Programme immobilier" />
					</div>
					
					<div class="form-group">
						<label for="title">@lang('app.form.programme_title') *</label>
						<input name="title_programme" id="title_programme" class="form-control" type="text" value="">
					</div>
					
					<div class="form-group">
						<label for="title">@lang('app.form.programme_content')</label>
						<textarea class="form-control" rows="10" name="description" id="description"></textarea>
					</div>
								
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">@lang('app.form.programme_commission_type')</label>
								<select class="form-control" name="commision" id="commision">
									<option value="">Choisir...</option>
									<option value="Sales commission rate (%)">@lang('app.form.programme_commission_option1') (%)</option>
									<option value="Fixed commission ($)">@lang('app.form.programme_commission_option2') ($)</option>
								</select>
							</div>
						</div>
						<div class="col-lg-4">
							<div id="commission_rate" style="display:none">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_taux_commission')</label>
									<div class="input-group">
										<input type="number" class="form-control" name="sales_rate" id="sales_rate">
										<div class="input-group-append">
											<span class="input-group-text">%</span>
										</div>
									</div>
								</div>
							</div>
							<div id="fixed_commission" style="display:none">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_mt_commission')</label>
									<div class="input-group">
										<input type="number" class="form-control" name="rate_commission" id="rate_commission">
										<div class="input-group-append">
											<span class="input-group-text">AUD</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>	
							
					<div class="row">
						<div class="col-lg-4">
							<label for="title">@lang('app.form.programme_price_min') *</label>
							<div class="input-group">
								<input type="number" class="form-control" name="prix_min" id="prix_min">
								<div class="input-group-append">
									<span class="input-group-text">AUD</span>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">@lang('app.form.programme_price_max') *</label>
								<div class="input-group">
									<input type="number" class="form-control" name="prix_max" id="prix_max">
									<div class="input-group-append">
										<span class="input-group-text">AUD</span>
									</div>
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
					
					<div class="form-group">
						<label for="title">@lang('app.form.programme_adresse') *</label>
						<input name="display_address" id="display_address" class="form-control" type="text" value="">
					</div>
					
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">@lang('app.form.programme_suburb') *</label>
								<input name="suburb" id="suburb" class="form-control" type="text" value="">
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">@lang('app.form.programme_ville') *</label>
								<input name="ville" id="ville" class="form-control" type="text">
							</div>  
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">@lang('app.form.programme_cp') *</label>
								<input name="postalCode" id="postalCode" class="form-control" type="text" value="">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">@lang('app.form.programme_pays') *</label>
								<select class="form-control" name="countryId" id="countryId" style="width:100%">
									@foreach(\App\Models\Country::where('id',12)->get() as $country)
										<option value="{{$country->id}}">{{$country->content}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">@lang('app.form.programme_etat') *</label>
								<select class="form-control" name="state_id" id="state_id" style="width:100%">
									@foreach(\App\Models\State::all() as $state)
										<option value="{{$state->id}}">{{$state->content}}</option>
									@endforeach
								</select>
							</div> 
						</div>
						<div class="col-lg-4">
							
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
					
					<div class="row">
						<div class="col-lg-12">
							<label for="title">@lang('app.table.eoi_dossier')</label>
							<div class="dropzone" id="eoi_dossier" multiple style="margin-bottom:25px">
								<div id="template" class="file-row"></div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-12">
							<label for="title">@lang('app.txt.photo_programme')</label>
							<div class="dropzone" id="image_upload" multiple>
								<div id="template" class="file-row"></div>
							</div>
						</div>
					</div>						
					<div class="row">
						<div class="col-lg-12" style="margin-top:15px">
							<label class="chk_firb"> 
								<input type="checkbox" value="" name="chk_firb"> @lang('app.txt.firb_recommendation')
							</label>
						</div>
					</div>
					<button type="submit" id="savePro" class="btn btn-primary btn-lg pull-right">
						<i class="fa fa-save"></i> @lang('app.form.programme_btn_create')
					</button>			
				</form>
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
<script>
	Dropzone.autoDiscover = false;
	$(document).ready(function(){
		$('#fond_dossier').on('change',function(){
			//get the file name
			var fileName = $(this).val();
			//replace the "Choose a file" label
			$(this).next('.custom-file-label').html(fileName);
		});
		
		$('#commision').on('change', function() {
			var type_commission = this.value;
			if(type_commission == 'Sales commission rate (%)'){
				$('#commission_rate').show();
				$('#fixed_commission').hide();
			}else if(type_commission == 'Fixed commission ($)'){
				$('#fixed_commission').show();
				$('#commission_rate').hide();
			}else{
				$('#fixed_commission').hide();
				$('#commission_rate').hide();
			}
		});
			
		CKEDITOR.replace( 'description' );
		$("#category_id").select2();
		//$("#type_id").select2();
		
		$('#cat_programmme_id').on('change', function() {
			var category = this.value;
			$.ajax({
			   type:'POST',
			   url:"{{ route('ajaxGetTypeProduitCategorie') }}",
			   data: {"_token": "{{ csrf_token() }}","categoryId": category, "type_id_active": 0},
			   success:function(data) {
				  console.log(data);
				  $('#type_id').html(data);
				  $('#product_type_id').html(data);
				  
			   }
			});
		});
		
		$("#fond_dossier").dropzone({
			maxFiles: 25, 
            maxFilesize: 25,
			dictDefaultMessage: "@lang('app.txt.fond_dossier')",
			url: "{{ route('ajaxDropZone') }}",
			params: {"_token": "{{ csrf_token() }}"},
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.doc,.docx,.xls,.xlsx,.pdf",
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
				// set new images names in dropzone�s preview box.
                var olddatadzname = file.previewElement.querySelector("[data-dz-name]");   
				file.previewElement.querySelector("img").alt = response.success;
				file._captionBox = Dropzone.createElement("<label style='width:100%;text-align:center'>"+response.success+"</label>");
				file.previewElement.appendChild(file._captionBox);
				$('#programmeForm').append('<input type="hidden" name="fondDossier[]" value="'+response.success +'">');
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
		
		$("#eoi_dossier").dropzone({
			maxFiles: 25, 
            maxFilesize: 25,
			dictDefaultMessage: "@lang('app.txt.eoi_dossier')",
			url: "{{ route('ajaxDropZone') }}",
			params: {"_token": "{{ csrf_token() }}"},
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.doc,.docx,.xls,.xlsx,.pdf",
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
				$('#programmeForm').append('<input type="hidden" name="eoiDossier[]" value="'+response.success +'">');
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
            maxFilesize: 25,
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
				// set new images names in dropzone�s preview box.
                var olddatadzname = file.previewElement.querySelector("[data-dz-name]");   
				file.previewElement.querySelector("img").alt = response.success;
				file._captionBox = Dropzone.createElement("<label style='width:100%;text-align:center'><input value='"+response.success+"' type='radio' name='radioDrop' style='display:inline-block'> @lang('app.dropzone.photoIcon_tex')</label>");
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
				commision: {
					required: true
				},
				sales_rate: {
					required: {
						depends: function(element) {
							if($("#commision").val() == 'Sales commission rate (%)'){
								return true;	
							}
						}
					}
				},
				rate_commission: {
					required: {
						depends: function(element) {
							if($("#commision").val() == 'Fixed commission ($)'){
								return true;	
							}
						}
					}
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
				suburb: {
					required: true
				},
				ville: {
					required: true
				},
				state_id: {
					required: true
				},
				title_programme: {
					required: true,
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
				chk_firb: {
					required: true
				}
			},
			messages: {
				cat_programmme_id: {
					required: "@lang('app.txt.champobligatoire')"
				},
				commision: {
					required: "@lang('app.txt.champobligatoire')"
				},
				sales_rate: {
					required: "@lang('app.txt.champobligatoire')"
				},
				rate_commission: {
					required: "@lang('app.txt.champobligatoire')"
				},
				prix_min: {
					required: "@lang('app.txt.champobligatoire')"
				},
				prix_max: {
					required: "@lang('app.txt.champobligatoire')",
					min: jQuery.validator.format("@lang('app.form.programme_validate_prix_max') {0}")
				},
				image_programme: {
					required: "@lang('app.txt.champobligatoire')"
				},
				type_id: {
					required: "@lang('app.txt.champobligatoire')"
				},
				display_address: {
					required: "@lang('app.txt.champobligatoire')"
				},
				postalCode: {
					required: "@lang('app.txt.champobligatoire')"
				},
				suburb: {
					required: "@lang('app.txt.champobligatoire')"
				},
				ville: {
					required: "@lang('app.txt.champobligatoire')"
				},
				state_id: {
					required: "@lang('app.txt.champobligatoire')"
				},
				title_programme: {
					required: "@lang('app.txt.champobligatoire')",
					remote: jQuery.validator.format("{0} @lang('app.form.programme_validate_titre')")
				},
				chk_firb: {
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
	});
</script>
@endpush