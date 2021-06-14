@extends('layouts.backend')

@section('subcontent')
<div class="col-lg-8 col-xl-9">
    <div class="profile-content-area m-40px-tb">
		<div class="card m-40px-b">
			<div class="card-header">
				<div class="row">
					<div class="col-5 col-lg-8">
						<span class="h6 font-w-500">@lang('app.txt.new_programme')</span>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form class="form-validation form-padding" action="" method="post" id="programmeForm" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group">
						<label>@lang('app.form.programme_choix_categorie') *</label>
						<select class="form-control" name="cat_programmme_id" id="cat_programmme_id">
							<option value="">@lang('app.form.choix_txt')</option>
							@foreach(\App\Models\Category::all() as $category)
								<option value="{{$category->id}}">{{ trans('app.txt.'.$category->title) }}</option>
							@endforeach
						</select>
					</div>
					
					<div class="form-group">
						<label for="title">@lang('app.form.programme_choix_anciennete') *</label>
						<select class="form-control" name="ancienneteBien" id="ancienneteBien" disabled="disabled">
							<option value="@lang('app.txt.new')">@lang('app.txt.new')</option>
							<option value="@lang('app.txt.old')">@lang('app.txt.old')</option>
						</select>
						<input type="hidden" name="ancienneteBien" value="Neuf" />
					</div>
					
					<div class="form-group">
						<label for="title">@lang('app.form.programme_choix_nature') *</label>
						<select class="form-control" name="natureBien" id="natureBien" disabled="disabled">
							<option value="@lang('app.txt.real_estate_program')">@lang('app.txt.real_estate_program')</option>
							<option value="@lang('app.txt.isolated_product')">@lang('app.txt.isolated_product')</option>
						</select>
						<input type="hidden" name="natureBien" value="@lang('app.txt.real_estate_program')" />
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
								<label for="title">@lang('app.form.programme_suburb')</label>
								<input name="suburb" id="suburb" class="form-control" type="text" value="">
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="title">@lang('app.form.programme_ville')</label>
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
								<label for="title">@lang('app.form.programme_pays')</label>
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
							<div class="form-group">
								<label for="title">@lang('app.form.programme_fond_dossier')</label>
								<div class="custom-file" id="customFile">
									<input name="fond_dossier" multiple id="fond_dossier" class="form-control custom-file-input" type="file" accept="image/png, image/jpeg,.pdf,video/mp4,video/x-m4v,video/*">
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
	});
</script>
@endsection