@extends('layouts.backend')

@section('subcontent')
<div class="col-lg-8 col-xl-9">						
    <div class="profile-content-area m-40px-tb">
		
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{route('mes-programmes')}}">@lang('app.txt.all_programmes')</a>
			</li>
			<li class="breadcrumb-item active">
				<strong>@lang('app.form.programme_edition')</strong>
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
				<form class="form-validation form-padding" action="{{route('updateProgramme')}}" method="post" id="programmeForm" enctype="multipart/form-data">
					{{ csrf_field() }}
					<input type="hidden"  name="location_Id" value="{{$product->location_id}}" />  
					<input type="hidden" name="id" value="{{$product->id}}" />     
					<div class="form-group">
						<label>@lang('app.form.programme_choix_categorie') *</label>
						<select class="form-control" name="cat_programmme_id" id="cat_programmme_id" disabled>
							<option value="">@lang('app.form.choix_txt')</option>
							@foreach(\App\Models\Category::all() as $category)
								<option value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected' : ''}}>{{$category->title}}</option>
							@endforeach
						</select>
					</div>
					
					<div class="form-group">
						<label for="title">@lang('app.form.programme_choix_anciennete') *</label>
						<select class="form-control" name="ancienneteBien" id="ancienneteBien" disabled="disabled">
							<option value="@lang('app.txt.new')" {{$product->ancienneteBien == 'Neuf' ? 'selected' : ''}}>@lang('app.txt.new')</option>
							<option value="@lang('app.txt.old')" {{$product->ancienneteBien == 'Ancien' ? 'selected' : ''}}>@lang('app.txt.old')</option>
						</select>
						<input type="hidden" name="ancienneteBien" value="Neuf" />
					</div>
					
					<div class="form-group">
						<label for="title">@lang('app.form.programme_choix_nature') *</label>
						<select class="form-control" name="natureBien" id="natureBien" disabled="disabled">
							<option value="@lang('app.txt.real_estate_program')" {{$product->natureBien == 'Programme immobilier' ? 'selected' : ''}}>@lang('app.txt.real_estate_program')</option>
							<option value="@lang('app.txt.isolated_product')" {{$product->natureBien == 'Produit isolé' ? 'selected' : ''}}>@lang('app.txt.isolated_product')</option>
						</select>
						<input type="hidden" name="natureBien" value="@lang('app.txt.real_estate_program')" />
					</div>
					
					<div class="form-group">
						<label for="title">@lang('app.form.programme_title') *</label>
						<input name="title_programme_now" id="title_programme_now" class="form-control" type="hidden" value="{{$product->title}}">
						<input name="title_programme" id="title_programme" class="form-control" type="text" value="{{$product->title}}">
					</div>
					
					<div class="form-group">
						<label for="title">@lang('app.form.programme_content')</label>
						<textarea class="form-control" rows="10" name="description" id="description">{{$product->content}}</textarea>
					</div>
								
								
					<div class="row">
						<div class="col-lg-4">
							<label for="title">@lang('app.form.programme_price_min') *</label>
							<div class="input-group">
								<input type="number" class="form-control" name="prix_min" id="prix_min" value="{{$product->min_price}}">
								<div class="input-group-append">
									<span class="input-group-text">AUD</span>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">@lang('app.form.programme_price_max') *</label>
								<div class="input-group">
									<input type="number" class="form-control" name="prix_max" id="prix_max" value="{{$product->max_price}}">
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
						<input name="display_address" id="display_address" class="form-control" type="text" value="{{$product->display_address}}">
					</div>
					
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">@lang('app.form.programme_suburb')</label>
								<input name="suburb" id="suburb" class="form-control" type="text" value="{{$localisation->area_level_1}}">
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">@lang('app.form.programme_ville')</label>
								<input name="ville" id="ville" class="form-control" type="text" value="{{$localisation->locality}}">
							</div>  
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">@lang('app.form.programme_cp') *</label>
								<input name="postalCode" id="postalCode" class="form-control" type="text" value="{{$localisation->postalCode}}">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">@lang('app.form.programme_pays')</label>
								<select class="form-control" name="countryId" id="countryId" style="width:100%">
									@foreach(\App\Models\Country::where('id',12)->get() as $country)
										<option value="{{$country->id}}" {{$country->id == $localisation->country ? 'selected' : ''}}>{{$country->content}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">@lang('app.form.programme_etat') *</label>
								<select class="form-control" name="state_id" id="state_id" style="width:100%">
									@foreach(\App\Models\State::all() as $state)
										<option value="{{$state->id}}" {{$state->id == $product->state_id ? 'selected' : ''}}>{{$state->content}}</option>
									@endforeach
								</select>
							</div> 
						</div>
						<div class="col-lg-4">
							
						</div>
					</div>
					
					@if ($dossier)
					<div class="row">
						 <div class="col-lg-12">
						 <h5 style="font-weight:normal; font-size:17px; color:#718096">@lang('app.form.programme_fond_dossier')</h5>
						 @foreach ( $dossier as $dossie )						 	
						 <div class="file-box">
							<div class="file">
								@if(setIconFile($dossie->filepath) == 'images')
									<a href="{{asset($dossie->filepath)}}" class="fancyboxLink">
								@elseif(setIconFile($dossie->filepath) == 'pdf')
									<a class="fancybox-pdf" data-fancybox-type="iframe" href="http://docs.google.com/viewer?embedded=true&url={{asset(urlencode($dossie->filepath))}}">
								@else
									<a href="https://docs.google.com/viewer?url={{asset(urlencode($dossie->filepath))}}&embedded=true" class="fancyboxLinkDoc" data-fancybox-type="iframe">
								@endif	
									<span class="corner"></span>	
									@if(setIconFile($dossie->filepath) == 'images')
										<div class="image">
											<img alt="image" class="img-fluid" src="{{asset($dossie->filepath)}}">
										</div>
									@endif	
									@if(setIconFile($dossie->filepath) == 'pdf')
										<div class="icon">
											<i class="fa fa-file-pdf"></i>
										</div>
									@endif	
									@if(setIconFile($dossie->filepath) == 'doc')
										<div class="icon">
											<i class="fa fa-file-word"></i>
										</div>
									@endif
									@if(setIconFile($dossie->filepath) == 'excel')
										<div class="icon">
											<i class="fa fa-file-excel"></i>
										</div>
									@endif	
									@if(setIconFile($dossie->filepath) == 'file')
										<div class="icon">
											<i class="fa fa-file"></i>
										</div>
									@endif									
									<div class="file-name">
										@php
											$filename = $dossie->filename;
											$filename = preg_replace('/^(.*)\-\d{8,}\.(gif|jpg|png|pdf)$/', '$1.$2', $filename);
										@endphp
										<label style="text-transform:lowercase">{{str_limit($filename, 15)}}</label>
										<a class="pull-right" href="javascript:void(0)" onclick="delete_fond_dossier({{$dossie->prdFondId}})">
											<i class="fa fa-trash"></i>
										</a>
										<br>
										<small>{{$dossie->created_at ? $dossie->created_at->diffForHumans() : ""}}</small>
									</div>
								</a>
							</div>
						</div>
						 @endforeach		
						 </div>
					</div>  
					@endif 
					
					<div class="row">
						<div class="col-lg-12">
							<label for="title">@lang('app.form.programme_fond_dossier')</label>
							<div class="dropzone" id="fond_dossier" multiple style="margin-bottom:15px">
								<div id="template" class="file-row"></div>
							</div>
						</div>
					</div>
					
					@if ($photos)
					<div class="row">						
						<div class="col-lg-12">		
						<h5 style="font-weight:normal; font-size:17px; color:#718096">@lang('app.txt.photo_programme')</h5>				
						@foreach ( $photos as $photo )					
						<div class="file-box">
							<div class="file">								
								<span class="corner"></span>						
								<div class="image">
									<a href="{{asset($photo->filepath)}}" class="fancyboxLink">
									<img alt="image" class="img-fluid" src="{{asset($photo->filepath)}}">
									</a>
								</div>
								<div class="file-name">
									<label> 
										@if($photo->is_principal == 1)
										<input type="radio" checked="" value="{{$photo->prdImageId}}" name="radioDrop"> @lang('app.dropzone.photoIcon_tex')
										@else
										<input type="radio" value="{{$photo->prdImageId}}" name="radioDrop"> @lang('app.dropzone.photoIcon_tex')
										@endif
									</label>
									<a class="pull-right" href="javascript:void(0)" onclick="delete_photo({{$photo->prdImageId}})">
										<i class="fa fa-trash"></i>
									</a>
									<br>
									<small>{{$photo->created_at ? $photo->created_at->diffForHumans() : ""}}</small>
								</div>				
							</div>
						</div>
						@endforeach
						</div>
					</div>
					@endif  
					
					<div class="row">
						<div class="col-lg-12">
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
						<i class="fa fa-save"></i> @lang('app.form.programme_btn_edit')
					</button>			
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

<script src="{{asset('administrator/plugins/ckeditor/ckeditor.js')}}"></script>
<!-- Jquery Validate -->
<script src="{{ asset('administrator/js/plugins/validate/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="{{ asset('administrator/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script>
	Dropzone.autoDiscover = false;
	$(document).ready(function(){					
		CKEDITOR.replace( 'description' );
		$("#category_id").select2();
		$("#type_id").select2();
		$("a.fancyboxLink").fancybox();			
		$("#fancybox-pdf").fancybox({
			openEffect  : 'none',
			closeEffect : 'none',
			iframe : {
				preload: false
			}
		});
		$("a.fancyboxLinkDoc").fancybox({
			type: "iframe"
		});
		set_type_programme($('#cat_programmme_id').val(),{{$product->type_id}});
		
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
			url: "{{ route('AjaxFonDossierEdit') }}",
			params: {"_token": "{{ csrf_token() }}","id_programme": "{{ $product->id }}"},
			acceptedFiles: ".jpeg,.jpg,.png,.gif,.doc,.docx,.xls,.xlsx,.pdf",
			addRemoveLinks: true,
			timeout: 50000,
			init:function() {
				// Get images
				var myDropzone1 = this;
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
		
		$("#image_upload").dropzone({
			maxFiles: 25, 
			maxFilesize: 25,
			dictDefaultMessage: "@lang('app.dropzone.libelle')",
			url: "{{ route('ajaxDropZoneEdit') }}",
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
			   url:"{{ route('ajaxChangeIconPhotoActive') }}",
			   data: {"_token": "{{ csrf_token() }}","id_photo_prd": this.value, "id_prd": {{$product->id}}},
			   success:function(data) {
				  
				  
			   }
			})
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
						url: "{{ route('ajaxCheckTitreProgramme') }}",
						type: "get",
						data: {
							// title_programme: function () {
							// 	return $("input[name='title_programme']").val();
							// }

							datas: function () {
								return $("input[name='title_programme']").val()+'|;|'+$("input[name='title_programme_now']").val();
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
	
	function set_type_programme(categorie_id,type_id_active)
	{
		$.ajax({
		   type:'POST',
		   url:"{{ route('ajaxGetTypeProduitCategorie') }}",
		   data: {"_token": "{{ csrf_token() }}","categoryId": categorie_id, "type_id_active": type_id_active},
		   success:function(data) {
			  $('#type_id').html(data);
			  $('#product_type_id').html(data);
		   }
		});
	}
	
	function delete_fond_dossier(id_fond_dossier)
	{
		swal({
			title: "@lang('app.table.fond_dossier')",
			text: "@lang('app.dropzone.delete_photo_confirme')",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: '#ff3547',
			confirmButtonText: "@lang('app.yes')",
			cancelButtonText: "@lang('app.no')",
			closeOnConfirm: false,
			closeOnCancel: false
		 },
		 function(isConfirm){	
		   if (isConfirm){
				 $.ajax({
					url : "{{ route('ajaxDropFondDossier') }}",
					type: "POST",
					dataType: "JSON",
					data:{"_token": "{{ csrf_token() }}",'id_fond_dossier':id_fond_dossier},
					success: function(data)
					{
						swal("@lang('app.table.fond_dossier')", "@lang('app.dropzone.delete_fonds_yes')", "success");
						location.reload();	
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						swal("@lang('app.table.fond_dossier')", "@lang('app.jquery.error_delete')", "error");
						location.reload();	
					}
				}); 
			} else {
				swal("@lang('app.table.fond_dossier')", "@lang('app.jquery.delete_cancel')", "error");
			}
		 });
	}
	
	function delete_photo(id_photo_prd_image)
	{
		swal({
			title: "@lang('app.table.produit_image')",
			text: "@lang('app.dropzone.delete_photo_confirme')",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: '#ff3547',
			confirmButtonText: "@lang('app.yes')",
			cancelButtonText: "@lang('app.no')",
			closeOnConfirm: false,
			closeOnCancel: false
		 },
		 function(isConfirm){	
		   if (isConfirm){
				 $.ajax({
					url : "{{ route('ajaxDropPhotoIcon') }}",
					type: "POST",
					dataType: "JSON",
					data:{"_token": "{{ csrf_token() }}",'id_photo_prd_image':id_photo_prd_image},
					success: function(data)
					{
						swal("@lang('app.table.produit_image')", "@lang('app.dropzone.delete_photo_yes')", "success");
						location.reload();	
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						swal("@lang('app.table.produit_image')", "@lang('app.jquery.error_delete')", "error");
						location.reload();	
					}
				}); 
			} else {
				swal("@lang('app.table.produit_image')", "@lang('app.jquery.delete_cancel')", "error");
			}
		 });
	}
</script>
@endpush