@extends('admin.layouts.app')

@section('title', 'Products - Edition ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.programme')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.txt.programme')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.product.programme') }}">@lang('app.txt.liste')</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.form.programme_edition')</strong>
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
                <h5>@lang('app.form.programme_edit_title') : {{$product->title}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('admin.product.index')}}/{{$product->id}}" method="post" id="programmeForm" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    {{ method_field("PUT") }}
					<input type="hidden" name="type" value="{{$type}}" />   
					<input type="hidden"  name="location_Id" value="{{$product->location_id}}" />                                                              
                    <div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label>@lang('app.form.programme_choix_categorie') *</label>
								<select class="form-control" name="cat_programmme_id" id="cat_programmme_id" disabled>
									<option value="">@lang('app.form.choix_txt')</option>
									@foreach(\App\Models\Category::all() as $category)
										<option value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected' : ''}}>{{$category->title}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">@lang('app.form.programme_choix_anciennete') *</label>
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
									<label for="title">@lang('app.form.programme_choix_nature') *</label>
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
								<label for="title">@lang('app.form.programme_title') *</label>
								<input name="title_programme_now" id="title_programme_now" class="form-control" type="hidden" value="{{$product->title}}">
								<input name="title_programme" id="title_programme" class="form-control" type="text" value="{{$product->title}}">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">                              
							<div class="form-group">
								<label for="title">@lang('app.form.programme_content')</label>
								<textarea class="form-control" rows="10" name="description" id="description">{{$product->content}}</textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="title">@lang('app.form.programme_price_min') *</label>
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
								<label for="title">@lang('app.form.programme_price_max') *</label>
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
								<input name="display_address" id="display_address" class="form-control" type="text" value="{{$product->display_address}}">
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">@lang('app.form.programme_suburb')</label>
								<input name="suburb" id="suburb" class="form-control" type="text" value="{{$localisation->area_level_1}}">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">@lang('app.form.programme_ville')</label>
								<input name="ville" id="ville" class="form-control" type="text" value="{{$localisation->locality}}">
							</div>  
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">@lang('app.form.programme_cp') *</label>
								<input name="postalCode" id="postalCode" class="form-control" type="text" value="{{$localisation->postalCode}}">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">@lang('app.form.programme_pays')</label>
								<select class="form-control" name="countryId" id="countryId" style="width:100%">
									@foreach(\App\Models\Country::where('id',12)->get() as $country)
										<option value="{{$country->id}}" {{$country->id == $localisation->country ? 'selected' : ''}}>{{$country->content}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">@lang('app.form.programme_etat') *</label>
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
						 <div class="col-lg-12">
						 <h5>@lang('app.form.programme_fond_dossier')</h5>
						 @foreach ( $dossier as $dossie )
						 <div class="file-box">
							<div class="file">
								<a href="{{asset($dossie->filepath)}}" class="fancyboxLink">
									<span class="corner"></span>						
									<div class="icon">
										<i class="fa fa-file"></i>
									</div>
									<div class="file-name">
										<label>{{$dossie->created_at ? $dossie->created_at->diffForHumans() : ""}}</label>
										<a class="pull-right" href="javascript:void(0)" onclick="delete_photo({{$dossie->prdFondId}})">
											<i class="fa fa-trash"></i>
										</a>
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
							<div class="dropzone" id="fond_dossier" multiple style="margin-bottom:25px">
								<div id="template" class="file-row"></div>
							</div>
						</div>
					</div>  
					
					@if ($photos)
					<div class="row">
						<div class="col-lg-12">
						<h5>@lang('app.txt.photo_programme')</h5>
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
                    <button type="submit" class="btn btn-primary btn-lg pull-right">
						<i class="fa fa-save"></i> @lang('app.form.programme_btn_edit')
					</button>
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
				<h5>@lang('app.table.product_programme_title')</h5>
				<div class="ibox-tools">
					<a href="javascript:void(0)" onclick="add_product({{$product->id}})" class="btn btn-primary">
						<i class="fa fa-plus"></i> @lang('app.form.product_add_ajax')
					</a>
					<div style="clear:both"></div>
				</div>
				<div style="clear:both"></div>
			</div>
			<div class="ibox-content">
				<table class="table table-striped grid-view-tbl">
					<thead>
                        <tr class="header-row">
							<th>Id</th>
							<th>@lang('app.table.produit_image')</th>
							<th>@lang('app.table.produit_titre')</th>
							<th>@lang('app.table.produit_prix_min')</th>
							<th>@lang('app.table.produit_prix_max')</th>
							<th>Date</th>
							<th>@lang('app.table.status')</th>
							<th>@lang('app.seller')</th>
							<th>@lang('app.table.author')</th>
							<th style="text-align:center">@lang('app.table.actions')</th>
						</tr>
					</thead>
					<tbody>
					@foreach($product_lies as $key=>$product_lie)
						<tr>
							<td>{{$key + 1}}</td>
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
								<a href="javascript:void(0)" onclick="edit_product({{$product_lie->id}})" class="btn btn-default btn-circle" title="@lang('app.table.btn_title_modification')">
									<i class="fa fa-pencil-square-o"></i>
								</a>&nbsp;&nbsp;
								<a href="javascript:void(0)" onclick="delete_product({{$product_lie->id}})" class="btn btn-default btn-circle" title="@lang('app.table.btn_title_delete')">
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
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
	<script>
		Dropzone.autoDiscover = false;
        $(document).ready(function(){
            CKEDITOR.replace( 'description' );
			$("#category_id").select2();
			$(".fancyboxLink").fancybox();
			set_type_programme($('#cat_programmme_id').val(),{{$product->type_id}});
			//set_type_produit($('#cat_programmme_id').val());
			
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
			
			$("#fond_dossier").dropzone({
				maxFiles: 20, 
				maxFilesize: 20,
				dictDefaultMessage: "@lang('app.txt.fond_dossier')",
				url: "{{ route('admin.AjaxFonDossierEdit') }}",
				params: {"_token": "{{ csrf_token() }}","id_programme": "{{ $product->id }}"},
				acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf,video/mp4,video/x-m4v",
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
				maxFiles: 20, 
				maxFilesize: 20,
				dictDefaultMessage: "@lang('app.dropzone.libelle')",
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
			
			$('#garage_spaces, #carport_spaces').bind('keyup mouseup', function (){
				if($('#garage_spaces').val() != 0 || $('#carport_spaces').val() != 0){
					$("#chk_parking").attr('disabled','disabled');
				}else{
					$("#chk_parking").removeAttr('disabled');
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
			   url:"{{ route('admin.ajaxGetTypeProduitCategorie') }}",
			   data: {"_token": "{{ csrf_token() }}","categoryId": categorie_id, "type_id_active": type_id_active},
			   success:function(data) {
				  $('#type_id').html(data);
				  $('#product_type_id').html(data);
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
						url : "{{ route('admin.ajaxDropPhotoIcon') }}",
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
		
		function delete_product(id_prd)
		{
			swal({
				title: "@lang('app.products')",
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
						url : "{{ route('admin.ajaxDropProduit') }}",
						type: "POST",
						dataType: "JSON",
						data:{"_token": "{{ csrf_token() }}",'id_produit':id_prd},
						success: function(data)
						{
							swal("@lang('app.products')", "@lang('app.jquery.delete_product_yes')", "success");
							location.reload();	
						},
						error: function (jqXHR, textStatus, errorThrown)
						{
							swal("@lang('app.products')", "@lang('app.jquery.error_delete')", "error");
							location.reload();	
						}
					}); 
				} else {
					swal("@lang('app.products')", "@lang('app.jquery.delete_cancel')", "error");
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
			$('.modal-title').text("@lang('app.form.product_add_ajax')");
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
					$('.modal-title').text("@lang('app.form.product_edit_title')"); 
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
						required: true,
						min: function ()  { return parseInt($("#price").val())}
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
						required: "@lang('app.txt.champobligatoire')",
						remote: jQuery.validator.format("{0} @lang('app.form.programme_validate_titre')")
					},
					product_type_id: {
						required: "@lang('app.txt.champobligatoire')"
					},
					postalCode_product: {
						required: "@lang('app.txt.champobligatoire')"
					},
					display_address_product:{
						required: "@lang('app.txt.champobligatoire')"
					},
					state_id_product:{
						required: "@lang('app.txt.champobligatoire')"
					},
					price:{
						required: "@lang('app.txt.champobligatoire')"
					},
					price_max_prd:{
						required: "@lang('app.txt.champobligatoire')",
						min: jQuery.validator.format("@lang('app.form.programme_validate_prix_max') {0}")
					},
					interior_area:{
						required: "@lang('app.txt.champobligatoire')"
					},
					exterior_area:{
						required: "@lang('app.txt.champobligatoire')"
					},
					total_area:{
						required: "@lang('app.txt.champobligatoire')"
					},
					year_built:{
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
						if(data.success == 'false'){
							$('#info_error').show();
						}else{
							location.reload();
						}
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
									<label for="title">@lang('app.form.product_title') *</label>
									<div class="input-group m-b">
										<div class="input-group-prepend">
											<span class="input-group-addon" id="progTitle"></span>
										</div>
										<input name="title_product" id="title_product" class="form-control" type="text" value="" title="@lang('app.form.product_title_input')">
									</div>									
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
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_product_type') *</label>
									<select class="form-control" name="product_type_id" id="product_type_id" style="width:100%">
										
									</select>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_suburb')</label>
									<input name="suburb_product" id="suburb_product" class="form-control" type="text" value="">
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_ville')</label>
									<input name="ville_product" id="ville_product" class="form-control" type="text">
								</div>  
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_cp') *</label>
									<input name="postalCode_product" id="postalCode_product" class="form-control" type="text" value="">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_adresse') *</label>
									<input name="display_address_product" id="display_address_product" class="form-control" type="text" value="">
								</div>
							</div>
							<div class="col-lg-4">
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
							<div class="col-lg-4">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_pays')</label>
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
									<label for="title">@lang('app.form.product_prix_min') *</label>
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
									<label for="title">@lang('app.form.product_prix_max') *</label>
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
									<label for="title">@lang('app.table.status')</label>
									<select class="form-control" name="status" id="status">
										<option value="published">Publier</option>
										<option value="En attente">En attente</option>
									</select>
								</div>
							</div>
							<div class="col-lg-3">
								<div id="info_qte">
									<div class="form-group">
										<label for="title">@lang('app.form.product_qte')</label>
										<input name="quantity" id="quantity" class="form-control" type="number" value="1">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">@lang('app.input.nbchambre')</label>
									<input name="bedrooms" id="bedrooms" class="form-control" type="number" value="0">
								</div>  
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">@lang('app.input.nbchambresuite')</label>
									<input name="ensuite" id="ensuite" class="form-control" type="number" value="0">
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">@lang('app.input.nbsalledebain')</label>
									<input name="bathrooms" id="bathrooms" class="form-control" type="number" value="0">
								</div> 
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">@lang('app.table.produit_image')</label>
									<input name="image" class="form-control" type="file" accept="image/png, image/jpeg">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">
								<div class="form-group">
									<label for="title">@lang('app.form.product_area_interior') *</label>
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
									<label for="title">@lang('app.form.product_area_exterior') *</label>
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
									<label for="title">@lang('app.form.product_area_total') *</label>
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
										<label for="title">@lang('app.form.product_anneeConstruct') *</label>
										<input name="year_built" id="year_built" class="form-control" type="number" value="0">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4">
								<div class="form-group">
									<label for="title">@lang('app.form.product_parking_ferme')</label>
									<input name="garage_spaces" id="garage_spaces" class="form-control" type="number" value="0">
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label for="title">@lang('app.form.product_parking_carpot')</label>
									<input name="carport_spaces" id="carport_spaces" class="form-control" type="number" value="0">
								</div>
							</div>
							
							<div class="col-lg-4">
								<div id="jardin_info" style="display:none">
									<div class="form-group">
										<label for="title">@lang('app.form.product_jardin_space')</label>
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
						<div class="alert alert-danger alert-dismissable" id="info_error" style="display:none">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4><i class="icon fa fa-ban"></i> @lang('app.form.product_error_title') !</h4>
							@lang('app.form.product_error_content')
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">@lang('app.txt.close')</button>
					<button type="button" class="btn btn-primary" id="btnSave" onClick="save_product()">@lang('app.form.product_btn_save')</button>
				</div>
			</div>
		</div>
	</div>
@endsection
