@extends('admin.layouts.app')

@section('title', 'Programme - Ajout ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.programme')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.txt.programme')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('admin.product.programme')}}">@lang('app.txt.liste')</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.add_new_programme')</strong>
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
                <h5>@lang('app.txt.new_programme')</h5>
            </div>
            <div class="ibox-content">
                <form class="form-validation form-padding" action="{{ route('admin.product.store') }}" method="post" id="programmeForm" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    <input type="hidden" name="type" value="{{$type}}" />  
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label>@lang('app.form.programme_choix_categorie') *</label>
								<select class="form-control" name="cat_programmme_id" id="cat_programmme_id">
									<option value="">@lang('app.form.choix_txt')</option>
									@foreach(\App\Models\Category::all() as $category)
										<option value="{{$category->id}}">{{ trans('app.txt.'.$category->title) }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">@lang('app.form.programme_choix_anciennete') *</label>
								<select class="form-control" name="ancienneteBien" id="ancienneteBien" disabled="disabled">
									<option value="@lang('app.txt.new')">@lang('app.txt.new')</option>
									<option value="@lang('app.txt.old')">@lang('app.txt.old')</option>
								</select>
								<input type="hidden" name="ancienneteBien" value="Neuf" />
							</div>
						</div>
						<div class="col-lg-4">
							<div id="nature_enregistrement">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_choix_nature') *</label>
									<select class="form-control" name="natureBien" id="natureBien" disabled="disabled">
										<option value="@lang('app.txt.real_estate_program')">@lang('app.txt.real_estate_program')</option>
										<option value="@lang('app.txt.isolated_product')">@lang('app.txt.isolated_product')</option>
									</select>
									<input type="hidden" name="natureBien" value="@lang('app.txt.real_estate_program')" />
								</div>
							</div>
						</div>
					</div> 
					<div id="infoNewProgramme">
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
								<div class="form-group">
									<label for="title">@lang('app.form.programme_price_min') *</label>
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
									<label for="title">@lang('app.form.programme_price_max') *</label>
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
										@foreach(\App\Models\Country::where('id',12)->get() as $country)
											<option value="{{$country->id}}">{{$country->content}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_etat') *</label>
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
									<label for="title">@lang('app.form.programme_fond_dossier')</label>
									<div class="custom-file" id="customFile">
										<input name="fond_dossier" id="fond_dossier" class="form-control custom-file-input" type="file" accept="image/png, image/jpeg,.pdf,video/mp4,video/x-m4v,video/*">
										<label class="custom-file-label" for="fond_dossier">
											<label for="title"></label>
										</label>
									</div>
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
							<div class="col-lg-12" style="margin-top:15px">
								<label class="chk_firb"> 
									<input type="checkbox" value="" name="chk_firb"> @lang('app.txt.firb_recommendation')
								</label>
							</div>
						</div>
					</div>                              
                    <button type="submit" id="savePro" class="btn btn-primary btn-lg pull-right">
						<i class="fa fa-save"></i> @lang('app.form.programme_btn_create')
					</button>
					<div style="clear:both"></div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('custom-script')
	<style>
		.custom-file-input ~ .custom-file-label::after {
			content: "{{ trans('app.form.choose_file') }}";
		}
	</style>
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
			maxFiles: 20, 
            maxFilesize: 20,
			dictDefaultMessage: "@lang('app.dropzone.libelle')",
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
					error.insertBefore( element.parent() );
				}else{
					error.insertAfter( element );
				}
			},
		});
	});
	</script>
@endsection