@extends('layouts.backend')

@section('subcontent')
				
    <div class="profile-content-area m-40px-tb">
		
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{route('mes-produits')}}">@lang('app.txt.all_products')</a>
			</li>
			<li class="breadcrumb-item active">
				<strong>@lang('afa.new.product.title')</strong>
			</li>
		</ol>

		
		<div class="card m-40px-b">		
			<div class="card-header">
				<div class="row">
					<div class="col-5 col-lg-8">
						<span class="h6 font-w-500">@lang('afa.new.product.title')</span>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form class="form-padding wizard-big" action="{{ route('save-product') }}" method="post" id="form" enctype="multipart/form-data">
					<h1>@lang('app.config')</h1>
					<fieldset>
						<h4>@lang('app.txt.info_programme')</h4>
						{{ csrf_field() }}
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<label>@lang('app.form.programme_choix_categorie') *</label>
									<select class="form-control" name="cat_programmme_id" id="cat_programmme_id">
										<option value="">@lang('app.form.choix_txt')</option>
										@foreach(\App\Models\Category::all() as $category)
											<option value="{{$category->id}}">{{getGTranslateAutoDetect( App::getLocale() ,$category->title)}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<div id="Age_of_Property" style="display:none">
									<div class="form-group">
										<label for="title">@lang('app.form.programme_choix_anciennete') *</label>
										<select class="form-control" name="ancienneteBien" id="ancienneteBien">
											<option value="">@lang('app.form.choix_txt')</option>
											<option value="Neuf">@lang('app.txt.new')</option>
											<option value="Ancien">@lang('app.txt.old')</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						
						<!-- information programme -->
						<div id="info-programme" style="display:none">
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
								<div class="col-lg-6">
									<div class="form-group">
										<label for="title">@lang('app.form.programme_commission_type')</label>
										<select class="form-control" name="commision" id="commision">
											<option value="">Choisir...</option>
											<option value="Sales commission rate (%)">@lang('app.form.programme_commission_option1') (%)</option>
											<option value="Fixed commission ($)">@lang('app.form.programme_commission_option2') ($)</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6">
									<div id="commission_rate" style="display:none">
										<div class="form-group">
											<label for="title">@lang('app.form.programme_taux_commission')</label>
											<div class="input-group m-b">
												<input type="number" min="0" class="form-control" name="sales_rate" id="sales_rate">
												<div class="input-group-append">
													<span class="input-group-text">%</span>
												</div>
											</div>
										</div>
									</div>
									<div id="fixed_commission" style="display:none">
										<div class="form-group">
											<label for="title">@lang('app.form.programme_mt_commission')</label>
											<div class="input-group m-b">
												<input type="number" min="0" class="form-control" name="rate_commission" id="rate_commission">
												<div class="input-group-append">
													<span class="input-group-text">AUD</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-4">
									<label for="title">@lang('app.form.programme_price_min') *</label>
									<div class="input-group">
										<input type="number" min="0" class="form-control" name="prix_min" id="prix_min">
										<div class="input-group-append">
											<span class="input-group-text">AUD</span>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<label for="title">@lang('app.form.programme_price_max') *</label>
									<div class="input-group">
										<input type="number" min="0" class="form-control" name="prix_max" id="prix_max">
										<div class="input-group-append">
											<span class="input-group-text">AUD</span>
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
										<label for="title">@lang('app.form.programme_suburb') *</label>
										<input name="suburb" id="suburb" class="form-control" type="text" value="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3">
									<div class="form-group">
										<label for="title">@lang('app.form.programme_ville') *</label>
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
											@foreach(\App\Models\Country::whereIn('id',[12,152])->get() as $country)
												<option value="{{$country->code}}">{{$country->content}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-3">
									<div id="info_etat">
										<div class="form-group">
											<label for="title">@lang('app.form.programme_etat') *</label>
											<select class="form-control" name="state_id" id="state_id" style="width:100%">
												<option value="">Sélectionner état...</option>
												@foreach(\App\Models\State::all() as $state)
													<option value="{{$state->id}}">{{$state->content}}</option>
												@endforeach
											</select>
										</div>
									</div>
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
									<label for="title">@lang('app.table.lia_dossier')</label>
									<div class="dropzone" id="lia_dossier" multiple style="margin-bottom:25px">
										<div id="template" class="file-row"></div>
									</div>
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-lg-12">
									<label for="title">@lang('app.txt.photo_programme')</label>
									<div class="dropzone" id="image_upload"></div>
								</div>
							</div>							
						</div>
						<!-- fin information programme -->
						
						<!-- si ancienneté est encien -->
						<div id="info_code_postal" style="display:none">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="title">@lang('app.form.programme_cp') *</label>
										<input type="text" class="form-control" name="postal_code" id="postal_code" />
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="title">@lang('app.form.product_anneeConstructBuild') *</label>
										<input type="number" min="0" class="form-control" name="annee_const" id="annee_const" disabled="disabled"/>
									</div>
								</div>
							</div>
						</div>
						<!-- fin si ancienneté est encien -->
						<div class="row">
							<div class="col-lg-12">
								<label class="chk_firb_programme"> 
									<input type="checkbox" value="" name="chk_firb_programme" id="chk_firb_programme" required> @lang('app.txt.condition_vente_programme')
								</label>
							</div>
						</div>
					</fieldset>
					
					<h1>@lang('app.product')</h1>
					<fieldset>
						<h2>@lang('app.txt.info_produit')</h2>
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<label for="title">@lang('app.form.product_title') *</label>
									@If(Auth::user()->isSba())
									<input name="title_product" id="title_product" class="form-control" type="text" value="{{Auth::user()->property_name}}">
									@else
									<input name="title_product" id="title_product" class="form-control" type="text" value="{{ old('title_product')?old('title_product'):'' }}">
									@endif
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
						
						<div class="row" id="bloc_date_residance" style="display:none">
							<div class="col-lg-6">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_commencement_dt') *</label>
									<input type="text" name="commencement_dt" id="commencement_dt" placeholder="Month/YYYY" class="form-control date_month_year" />
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="title">@lang('app.form.estimated_delivery_dt') *</label>
									<input type="text" name="estimated_delvivery_dt" id="estimated_delvivery_dt" class="form-control date_month_year" placeholder="Month/YYYY"/>
								</div>
							</div>
						</div>		
						
						<div class="row" id="bloc_fond_doc_produit" style="display:none">
							<div class="col-lg-12">
								<h5>@lang('app.form.programme_fond_dossier')</h5>
								<div class="dropzone" id="p_fond_dossier" multiple style="margin-bottom:25px">
									<div id="template" class="file-row"></div>
								</div>
							</div>
						</div>
						
						<div class="row" id="bloc_eoi_doc" style="display:none">
							<div class="col-lg-12">
								<h5>@lang('app.table.eoi_dossier') *</h5>
								<input type="hidden" name="p_eoiDossier" id="p_eoiDossier" />
								<div class="dropzone" id="p_eoi_dossier" multiple style="margin-bottom:25px">
									<div id="template" class="file-row"></div>
								</div>
							</div>
						</div>
						
						<div class="row" id="bloc_lia_doc" style="display:none">
							<div class="col-lg-12">
								<h5>@lang('app.table.lia_dossier')</h5>
								<div class="dropzone" id="p_lia_dossier" multiple style="margin-bottom:25px">
									<div id="template" class="file-row"></div>
								</div>
							</div>
						</div>
							
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label for="title">@lang('app.input.type') *</label>
									<select class="form-control" name="product_type_id" id="product_type_id" style="width:100%">
										
									</select>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_adresse') *</label>
									<input name="display_address_product" id="display_address_product" class="form-control" type="text" value="">
									<input type="hidden" name="long" id="long" />
									<input type="hidden" name="lat" id="lat" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_ville') *</label>
									<input name="ville_product" id="ville_product" class="form-control" type="text">
								</div>  
							</div>	
							<div class="col-lg-6">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_cp') *</label>
									<input name="postalCode_product" id="postalCode_product" class="form-control" type="text" value="">
								</div>
							</div>						
						</div>
						<div class="row">							
							<div class="col-lg-6">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_suburb') *</label>
									<input name="suburb_product" id="suburb_product" class="form-control" type="text" value="">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_etat') *</label>
									<select class="form-control" name="state_id_product" id="state_id_product" style="width:100%">
										<option value="">@lang('app.txt.choose_state')</option>
										@foreach(\App\Models\State::all() as $state)
											<option value="{{$state->id}}" dataname="{{$state->content}}">{{$state->content}}</option>
										@endforeach
									</select>
								</div>
							</div>							
						</div>
						
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_pays')</label>
									<select class="form-control" name="countryId_product" id="countryId_product" style="width:100%">
										@foreach(\App\Models\Country::where('id',12)->get() as $country)
											<option value="{{$country->code}}">{{$country->content}}</option>
										@endforeach
									</select>
								</div>
							</div>	
							<div class="col-lg-6">
								<div class="form-group">
									<label for="title">@lang('app.form.product_status')</label>
									<select class="form-control" name="status" id="status">
										<option value="waiting">En attente</option>
									</select>
								</div>
							</div>	
						</div>
						<!-- commission product -->
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label for="title">@lang('app.form.programme_commission_type')</label>
									<select class="form-control" name="commision_product" id="commision_product">
										<option value="">Choisir...</option>
										<option value="Sales commission rate (%)">@lang('app.form.programme_commission_option1') (%)</option>
										<option value="Fixed commission ($)">@lang('app.form.programme_commission_option2') ($)</option>
									</select>
								</div>
							</div>
							<div class="col-lg-6">
								<div id="commission_rate_prd" style="display:none">
									<div class="form-group">
										<label for="title">@lang('app.form.programme_taux_commission')</label>
										<div class="input-group m-b">
											<input type="number" min="0" class="form-control" name="sales_rate_product" id="sales_rate_product">
											<div class="input-group-append">
												<span class="input-group-text">%</span>
											</div>
										</div>
									</div>
								</div>
								<div id="fixed_commission_prd" style="display:none">
									<div class="form-group">
										<label for="title">@lang('app.form.programme_mt_commission')</label>
										<div class="input-group m-b">
											<input type="number" min="0" class="form-control" name="rate_commission_product" id="rate_commission_product">
											<div class="input-group-append">
												<span class="input-group-text">AUD</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- fin commission product -->
						<!-- eoi debut-->
						<div class="row" id="bloc_eoi_doc" style="display:none">
							<div class="col-lg-12">
								<label for="title">@lang('app.table.eoi_dossier')</label>								
								<div class="dropzone" id="p_eoi_dossier" multiple style="margin-bottom:25px">
									<div id="template" class="file-row"></div>
								</div>
							</div>
							<div class="col-lg-12">
								<label for="title">@lang('app.table.lia_dossier')</label>
								<div class="dropzone" id="p_lia_dossier" multiple style="margin-bottom:25px">
									<div id="template" class="file-row"></div>
								</div>
							</div>
						</div>
						<!-- fin eoi-->
						<div class="row" id="price_simple" style="display:none">
							<div class="col-lg-6">
								<label for="title">@lang('app.table.price') *</label>
								<div class="input-group" style="margin-bottom: .5rem;">
									<input type="number" min="0" class="form-control" name="simple_price" id="simple_price">
									<div class="input-group-append">
										<span class="input-group-text">AUD</span>
									</div>
								</div>
							</div>
						</div>
						<div class="row" id="price_max_min" style="display:none">
							<div class="col-lg-6">
								<label for="title">@lang('app.form.product_prix_min') *</label>
								<div class="input-group" style="margin-bottom: .5rem;">
									<input type="number" min="0" class="form-control" name="price" id="price">
									<div class="input-group-append">
										<span class="input-group-text">AUD</span>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<label for="title">@lang('app.form.product_prix_max') *</label>
								<div class="input-group" style="margin-bottom: .5rem;">
									<input type="number" min="0" class="form-control" name="price_max_prd" id="price_max_prd">
									<div class="input-group-append">
										<span class="input-group-text">AUD</span>
									</div>
								</div>
							</div>			
						</div>
						<div class="row">
							<div class="col-lg-4">
								<div id="firb_pre_approved_sale">
									<label for="title">@lang('app.form.programme_firb_pre_approved_program') *</label>
									<select class="form-control" name="programme_firb_pre_approved_program" id="programme_firb_pre_approved_program" style="width:100%">
										<option value="">@lang('app.form.choix_txt')</option>
										<option value="NO">NO</option>
										<option value="YES - 50%">YES - 50%</option>
										<option value="YES - 100%">YES - 100%</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group" style="margin-bottom:.5rem;">
									<label for="title">@lang('app.txt.avoir_bonus')</label>
									<select class="form-control" name="bonus_vente" id="bonus_vente">
										<option value="">Choisir...</option>
										<option value="YES">@lang('app.txt.yes')</option>
										<option value="NO">@lang('app.txt.no')</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div id="montant_bonus_vente" style="display:none">
									<label for="title">@lang('app.txt.valeur_bonus') *</label>
									<div class="input-group" style="margin-bottom: .5rem;">
										<input type="number" min="0" class="form-control" name="bonus_amount" id="bonus_amount">
										<div class="input-group-append">
											<span class="input-group-text">AUD</span>
										</div>
									</div>
								</div>
							</div>							
						</div>
						<!-- info date produit isolé-->
						<!--<div id="info-date-isole">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="title">@lang('app.form.produit_dt_db_travaux')</label>
										<input type="text" class="form-control" name="dt_db_travaux" id="dt_db_travaux" />
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="title">@lang('app.form.produit_dt_prevu_livraison')</label>
										<input type="date" class="form-control" name="dt_prevu_livraison" />
									</div>
								</div>
							</div>
						</div>-->
						<!-- fin info date produit isolé-->
						<div class="row mb-2">
							<div class="col-lg-12">
								<label for="title">@lang('app.table.produit_image')</label>
								<div class="dropzone" id="pictures_upload"></div>
							</div>
						</div>
						<div class="row">							
							<div class="col-lg-6">
								<div id="yearConstruct" style="display:none">								
									<div class="form-group">
										<label for="title">@lang('app.form.product_anneeConstruct') *</label>
										<input name="year_built" id="year_built" class="form-control" type="number" min="0" value="0">
									</div>
								</div>
							</div>	
							<div class="col-lg-6">
								<div id="jardin_info" style="display:none">
									<label for="title">@lang('app.form.product_jardin_space')</label>
									<div class="input-group" style="margin-bottom: .5rem;">
										<input type="number" min="0" class="form-control" name="superficie_jardin" id="superficie_jardin" value="0">
										<div class="input-group-append">
											<span class="input-group-text">.m2</span>
										</div>
									</div>
								</div>
							</div>			
						</div>
						
						<!-- info pour le produit résidentiel -->
						<div id="info_prd_residentiel" style="display:none">
							<div class="row">					
								<div class="col-lg-4">
									<div class="form-group">
										<label for="title">@lang('app.input.nbchambre')</label>
										<input name="bedrooms" id="bedrooms" class="form-control" type="number" min="0" value="0">
									</div>  
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label for="title">@lang('app.input.nbchambresuite')</label>
										<input name="ensuite" id="ensuite" class="form-control" type="number" min="0" value="0">
									</div>
								</div>	
								<div class="col-lg-4">
									<div class="form-group">
										<label for="title">@lang('app.input.nbsalledebain')</label>
										<input name="bathrooms" id="bathrooms" class="form-control" type="number" min="0" value="0">
										<input name="quantity" id="quantity" class="form-control" type="hidden" min="0" value="1" min="1">
									</div> 
								</div>														
							</div>
							<!--<div class="row">
								<div class="col-lg-6"></div>
								<div class="col-lg-6">
									<div id="info_qte">
										<div class="form-group">
											<label for="title">@lang('app.form.product_qte')</label>
											<input name="quantity" id="quantity" class="form-control" type="number" min="0" value="1" min="1">
										</div>
									</div>
								</div>						
							</div>-->
							<div class="row">
								<div class="col-lg-4">
									<label for="title">@lang('app.form.product_area_interior') *</label>
									<div class="input-group" style="margin-bottom: .5rem;">
										<input type="text" name="interior_area" id="interior_area" class="form-control">
										<div class="input-group-append">
											<span class="input-group-text">.m2</span>
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<label for="title">@lang('app.form.product_area_exterior') *</label>
									<div class="input-group" style="margin-bottom: .5rem;">
										<input type="text" name="exterior_area" id="exterior_area" class="form-control">
										<div class="input-group-append">
											<span class="input-group-text">.m2</span>
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<label for="title">@lang('app.form.product_area_total') *</label>
									<div class="input-group" style="margin-bottom: .5rem;">
										<input type="text" name="total_area" id="total_area" class="form-control" readonly="">
										<div class="input-group-append">
											<span class="input-group-text">.m2</span>
										</div>
									</div>
								</div>
							</div>
							<div class="row">							
								<div class="col-lg-6">
									<div class="form-group">
										<label for="title">@lang('app.form.product_parking_ferme')</label>
										<input name="garage_spaces" id="garage_spaces" class="form-control" type="number" min="0" value="0">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="title">@lang('app.form.product_parking_carpot')</label>
										<input name="carport_spaces" id="carport_spaces" class="form-control" type="number" min="0" value="0">
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
							</div>
						</div>
						<!-- fin info pour le produit résidentiel -->
						
						<!-- info pour le produit foncier -->
						<div id="info_prd_foncier" style="display:none">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="title">Surface *</label>
										<input type="number" min="0" name="surface_foncier" id="surface_foncier" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="title">Unité de surface *</label>
										<select class="form-control" name="unite_surface">
											<option value="m2">m2</option>
											<option value="Ha">Ha</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<!-- fin info pour le produit foncier -->
						
						<!-- info pour le produit industriel -->
						<div id="info_prd_industriel" style="display:none">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group" style="margin-bottom: .5rem;">
										<label for="title">@lang('app.txt.property_details') *</label>
										<textarea class="form-control" rows="4" name="property_detail"></textarea>
									</div>
								</div>
							</div>
						</div>
						<!-- info pour le produit industriel -->
						
						<!-- info pour le produit commercial -->
						<div id="info_prd_commercial" style="display:none">
							<div class="row">
								<div class="col-md-4">
									<label for="title">Sales area *</label>
									<div class="input-group" style="margin-bottom: .5rem;">
										<input type="text" name="surface_commercial" id="surface_commercial" class="form-control">
										<div class="input-group-append">
											<span class="input-group-text">.m2</span>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<label for="title">Customer parking *</label>
									<select class="form-control" name="type_cutomer_parking" id="type_cutomer_parking">
										<option value="">Choisir...</option>
										<option value="1">Oui</option>
										<option value="0">Non</option>
									</select>
								</div>
								<div class="col-md-4">
									<div id="NbCustomerParking" style="display:none">
										<label for="title">Number of parking spots</label>
										<input type="number" min="0" class="form-control" name="nombre_cutomer_parking" />
									</div>
								</div>
							</div>
						</div>
						<!-- fin info pour le produit commercial -->
						
						
						<div class="row">
							<div class="col-lg-12">
								<label><strong>@lang('app.txt.declaration_annonceur')</strong></label>
								<label>@lang('app.txt.type_annonceur')</label>
								<label>@lang('app.txt.legal_owner')</label>
								<label class="form-check"> 
									<div class="form-check">
										<input class="form-check-input" type="radio" name="certificat" id="certificat"/>
										<label class="form-check-label" for="certificat"> @lang('app.txt.radio_legal_owner_choix_1')</label>
									</div>
									@If(Auth::user()->isSba())
									<div class="form-check" id="choix_seller">
										<input class="form-check-input" type="radio" name="certificat" id="certificat1"/>
										<label class="form-check-label" for="certificat1"> @lang('app.txt.radio_legal_owner_choix_2')</label>
									</div>
									@endif
								</label>
								
								<label> 
									<input type="checkbox" value="1" name="certicat2"> @lang('app.txt.certificat_loi_investissement')
								</label>
								
								<label> 
									<input type="checkbox" value="1" name="certicat3"> @lang('app.txt.certificat_responsabilite')
								</label>
								
								<label> 
									<input type="checkbox" value="1" name="certicat4"> @lang('app.txt.certificat_acceptation')
								</label>
							</div>
							
							<div class="col-lg-12">
								<div id="chk_firb" style="display:none">
									<label class="chk_firb"> 
										<input type="checkbox" value="" name="chk_firb"> @lang('app.txt.firb_recommendation')
									</label>
								</div>
							</div>
						</div>
					</fieldset>
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
	.ui-datepicker-calendar {
    	display: none;
    }
</style>
<!-- dropzone -->
<script src="{{ asset('administrator/js/plugins/dropzone/dropzone.js') }}"></script>
<!-- jquery select2-->
<script src="{{ asset('administrator/js/plugins/select2/select2.full.min.js') }}"></script>
<!-- Steps -->
<script src="{{ asset('administrator/js/plugins/steps/jquery.steps.min.js') }}"></script>
<!-- Jquery checkeditor -->
<script src="{{asset('administrator/plugins/ckeditor/ckeditor.js')}}"></script>
<!-- Jquery Validate -->
<script src="{{ asset('administrator/js/plugins/validate/jquery.validate.min.js') }}"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2izG_M7K3gP6pFUH5cyzmDjuGpOYfgc4&libraries=places&callback=initMap&channel=GMPSB_addressselection_v1_cABC" async defer></script>
<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2izG_M7K3gP6pFUH5cyzmDjuGpOYfgc4&libraries=places&callback=initMap"></script>-->
<script>
// display_address
function initMap(){
	var autocomplete = new google.maps.places.Autocomplete($("#display_address_product")[0], {});
	autocomplete.setComponentRestrictions({'country': ['au']});

	google.maps.event.addListener(autocomplete, 'place_changed', function() {
		var place = autocomplete.getPlace();
		//console.log(place.address_components);
		var arrAddress = place.address_components;
		var itemRoute='';
		var itemSuburb='';
		var itemCountry='';
		var itemPc='';
		var itemSnumber='';
		var itemState = '';
		var itemCity = '';
		var lat = place.geometry.location.lat();
		var long = place.geometry.location.lng();
		
		$.each(arrAddress, function (i, address_components) {
			if (address_components.types[0] == "street_number") {
				//console.log("street_number:" + address_components.long_name);
				itemSnumber = address_components.long_name;
			}
			if (address_components.types[0] == "route") {
				//console.log(i + ": route:" + address_components.long_name);
				itemRoute = address_components.long_name;
			}
			
			if (address_components.types[0] == "locality") {
				//console.log("town:" + address_components.long_name);
				itemSuburb = address_components.long_name;
			}
			
			if (address_components.types[0] == "country") {
				//document.getElementById("country_code").value = place.address_components[i].short_name;
				console.log("country:" + address_components.long_name);
				console.log("country:" + address_components.short_name);
				itemCountry = address_components.long_name;
			}
			
			if (address_components.types[0] == "postal_code") {
				//console.log("pc:" + address_components.long_name);
				itemPc = address_components.long_name;
			}
			
			if (address_components.types[0] == "administrative_area_level_2") {
				//console.log("pc:" + address_components.long_name);
				itemCity = address_components.short_name;
			}
			if (address_components.types[0] == "administrative_area_level_1") {
				//console.log("pc:" + address_components.long_name);
				itemState = address_components.short_name;
			}
			
			var adresse = itemSnumber + ' ' + itemRoute;
			$('#display_address_product').val(adresse);
			$('#ville_product').val(itemSuburb);
			$('#suburb_product').val(itemCity);
			$('#postalCode_product').val(itemPc);
			$('#long').val(long);
			$('#lat').val(lat);
			$('#state_id_product option[dataname="'+itemState+'"]').prop('selected', true);
		});
	});
}
</script>

<script>
	Dropzone.autoDiscover = false;
	$(document).ready(function(){
		$.validator.setDefaults({
			ignore: []
		});	
		
		$("#form").steps({
			bodyTag: "fieldset",
			labels: {
				current: "current step:",
				pagination: "Pagination",
				finish: "@lang('app.btn.submit')",
				next: "@lang('app.form.steps_btn_saisir_product')",
				previous: "@lang('app.form.steps_btn_precedent')",
				loading: "@lang('app.form.steps_load')"
			},
			onStepChanging: function (event, currentIndex, newIndex)
			{
				initMap();
				$(".date_month_year").datepicker({
					changeMonth: true,
					changeYear: true,
					showButtonPanel: true,
					dateFormat: 'MM yy',
					onClose: function(dateText, inst) { 
						var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
						var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
						$(this).datepicker('setDate', new Date(year, month, 1));
					}
				});
		
				var ancienneteBien = $('#ancienneteBien').val();
				var natureBien = 'Produit isolé';
				var cat = $('#cat_programmme_id').val();
				if(cat == 1){
					if(ancienneteBien == 'Neuf' && natureBien == 'Programme immobilier'){
						var titre_programme = $('#title_programme').val();
						$('[name="product_type_id"]').val($('#type_id').val());
						$('[name="suburb_product"]').val($('#suburb').val()).prop("readonly", true);
						$('[name="ville_product"]').val($('#ville').val()).prop("readonly", true);
						$('[name="postalCode_product"]').val($('#postalCode').val()).prop("readonly", true);
						$('[name="display_address_product"]').val($('#display_address').val()).prop("readonly", true);
						$('[name="state_id_product"]').val($('#state_id').val());
						$('[name="countryId_product"]').val($('#countryId').val()).prop("readonly", true);
						$('[name="commision_product"]').val($('#commision').val());
						if($('#commision').val() == 'Sales commission rate (%)'){
							$('[name="sales_rate_product"]').val($('#sales_rate').val());
							$('#commission_rate_prd').show();
							$('#fixed_commission_prd').hide();
						}else if($('#commision').val() == 'Fixed commission ($)'){
							$('[name="rate_commission_product"]').val($('#rate_commission').val());
							$('#commission_rate_prd').hide();
							$('#fixed_commission_prd').show();
						}else{
							$('#commission_rate_prd').hide();
							$('#fixed_commission_prd').hide();
						}
						$("#progTitle").text(titre_programme);
						//$('#info-date-isole').hide();
						$('#price_simple').hide();
						$('#price_max_min').show();
						$('#chk_picine').hide();
						
						$('#bloc_fond_doc_produit').hide();
						$('#bloc_eoi_doc').hide();
						$('#bloc_lia_doc').hide();
					}else if(ancienneteBien == 'Neuf' && natureBien == 'Produit isolé'){
						//$('#info-date-isole').show();
						$('#info_qte').show();
						$('#chk_picine').show();
						$('#jardin_info').show();
						$('#price_simple').show();
						$('#price_max_min').hide();
						
						$('#bloc_fond_doc_produit').show();
						$('#bloc_eoi_doc').show();
						$('#bloc_lia_doc').show();
						$('[name="year_built"]').val('').prop("readonly", false);
						$('[name="postalCode_product"]').val('').prop("readonly", false);
						
					}else if(ancienneteBien == 'Ancien'){
						$('#title_product').val('');
						$('[name="year_built"]').val($('#annee_const').val()).prop("readonly", true);
						$('[name="postalCode_product"]').val($('#postal_code').val()).prop("readonly", true);
						$('#yearConstruct').show();
						$('#jardin_info').show();
						$('#chk_picine').show();
						//$('#info-date-isole').hide();
						$('#price_simple').show();
						$('#price_max_min').hide();
						
						$('#bloc_fond_doc_produit').show();
						$('#bloc_eoi_doc').show();
						$('#bloc_lia_doc').show();
					}
					$('#bloc_date_residance').show();
				}else if(cat == 2){
					$('#info_prd_foncier').show();
					$('#price_simple').show();
					
					$('#bloc_fond_doc_produit').show();
					$('#bloc_eoi_doc').show();
					$('#bloc_lia_doc').show();
					$('#yearConstruct').hide();
					$('#jardin_info').hide();
					$('[name="postalCode_product"]').val('').prop("readonly", false);
					$('#bloc_date_residance').hide();
				}else if(cat == 3){
				    //$('#info-date-isole').hide();
					$('#bloc_fond_doc_produit').show();
					$('#bloc_eoi_doc').show();
					$('#bloc_lia_doc').show();
					$('#yearConstruct').hide();
					$('#jardin_info').hide();
					$('[name="postalCode_product"]').val('').prop("readonly", false);
					$('#bloc_date_residance').hide();
				}else if(cat == 4){
					//$('#info-date-isole').hide();
					$('#bloc_fond_doc_produit').show();
					$('#bloc_eoi_doc').show();
					$('#bloc_lia_doc').show();
					$('#yearConstruct').hide();
					$('#jardin_info').hide();
					$('[name="postalCode_product"]').val('').prop("readonly", false);
					$('#bloc_date_residance').hide();
					$('#type_cutomer_parking').on('change',function(){
						var parkingType = $(this).val();
						if(parkingType == 1){
							$('#NbCustomerParking').show();	
						}else{
							$('#NbCustomerParking').hide();	
						}
					})
				}
				// Always allow going backward even if the current step contains invalid fields!
				if (currentIndex > newIndex)
				{
					return true;
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
				var val = form.validate();
				console.log(val.errors());
				//console.log("error list", val);
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
			onkeyup: false,
			ignore:":not(:visible)",
			errorElement: 'div',
			errorPlacement: function (error, element)
			{
				if(element.parent().hasClass('input-group')){
					error.insertAfter( element.parent() );
				}else{
					error.insertAfter( element );
				}
			},
			rules: {
				cat_programmme_id: {
					required: true
				},
				ancienneteBien: {
					required: {
						depends: function(element) {
							if($("#cat_programmme_id").val() == 1){
								return true;	
							}
						}
					}
				},
				natureBien: {
					required: {
						depends: function(element) {
							if($("#cat_programmme_id").val() == 1 && $("#ancienneteBien").val() == 'Neuf'){
								return true;	
							}
						}
					}
				},
				title_programme: {
					required: {
						depends: function(element) {
							if($("#ancienneteBien").val() == 'Neuf' && $("#natureBien").val() == 'Programme immobilier'){
								return true;	
							}
						}
					},
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
				commision: {
					required: {
						depends: function(element) {
							if($("#ancienneteBien").val() == 'Neuf' && $("#natureBien").val() == 'Programme immobilier'){
								return true;	
							}
						}
					}
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
					required: {
						depends: function(element) {
							if($("#ancienneteBien").val() == 'Neuf' && $("#natureBien").val() == 'Programme immobilier'){
								return true;	
							}
						}
					},
					number: true
				},
				prix_max: {
					required: {
						depends: function(element) {
							if($("#ancienneteBien").val() == 'Neuf' && $("#natureBien").val() == 'Programme immobilier'){
								return true;	
							}
						}
					},
					number: true,
					min: function ()  { return parseInt($("#prix_min").val())}
				},
				type_id: {
					required: {
						depends: function(element) {
							if($("#ancienneteBien").val() == 'Neuf' && $("#natureBien").val() == 'Programme immobilier'){
								return true;	
							}
						}
					}
				},
				postal_code: {
					required: {
						depends: function(element) {
							if($("#info_code_postal").is(":visible")){
								return true;	
							}
						}
					},
					remote: {
						url: "{{ route('ajaxCheckFirb') }}",
						type: "get",
						data: {
							postal_code: function () {
								return $("input[name='postal_code']").val();
							}
						},
						complete: function(data){
							if(data.responseText == "true" ) {
								$('#annee_const').prop('disabled', false);
							}else{
								$('#annee_const').prop('disabled', true);
							}
						}
					}
				},
				annee_const: {
					required: {
						depends: function(element) {
							if($("#info_code_postal").is(":visible")){
								return true;	
							}
						}
					}
				},
				chk_firb_programme: {
					required: true
				},
				title_product: {
					required: true,
					remote: {
						url: "{{ route('ajaxCheckTitreProgramme') }}",
						type: "get",
						data: {
							title_programme: function () {
								if($("input[name='title_programme']").val() != ''){
									var prg_text = $("input[name='title_programme']").val();
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
				suburb_product: {
					required: true
				},
				ville_product: {
					required: true
				},
				display_address_product: {
					required: true,
					remote: {
						url: "{{ route('ajaxCheckAdresse') }}",
						type: "get",
						data: {
							display_address: function () {
								return $("input[name='display_address_product']").val();
							}
						}
					}
				},
				display_address: {
					required: {
						depends: function(element) {
							if($("#ancienneteBien").val() == 'Neuf' && $("#natureBien").val() == 'Programme immobilier'){
								return true;	
							}
						}
					}
				},
				postalCode: {
					required: {
						depends: function(element) {
							if($("#ancienneteBien").val() == 'Neuf' && $("#natureBien").val() == 'Programme immobilier'){
								return true;	
							}
						}
					}
				},
				suburb: {
					required: {
						depends: function(element) {
							if($("#ancienneteBien").val() == 'Neuf' && $("#natureBien").val() == 'Programme immobilier'){
								return true;	
							}
						}
					}
				},
				ville: {
					required: {
						depends: function(element) {
							if($("#ancienneteBien").val() == 'Neuf' && $("#natureBien").val() == 'Programme immobilier'){
								return true;	
							}
						}
					}
				},
				state_id: {
					required: {
						depends: function(element) {
							if($("#ancienneteBien").val() == 'Neuf' && $("#natureBien").val() == 'Programme immobilier'){
								return true;	
							}
						}
					}
				},
				state_id_product:{
					required: true,
				},
				simple_price: {
					required: {
						depends: function(element) {
							if($("#ancienneteBien").val() == 'Neuf' && $("#natureBien").val() == 'Produit isolé'){
								return true;	
							}
						}
					},
					number: true
				},
				dt_db_travaux:{
					required: {
						depends: function(element) {
							if($("#ancienneteBien").val() == 'Neuf' && $("#natureBien").val() == 'Produit isolé'){
								return true;	
							}
						}
					}
				},
				dt_prevu_livraison:{
					required: {
						depends: function(element) {
							if($("#ancienneteBien").val() == 'Neuf' && $("#natureBien").val() == 'Produit isolé'){
								return true;	
							}
						}
					}
				},
				price: {
					required: {
						depends: function(element) {
							if($("#ancienneteBien").val() == 'Neuf' && $("#natureBien").val() == 'Programme immobilier'){
								return true;	
							}
						}
					},
					number: true
				},
				commision_product: {
					required: true
				},
				sales_rate_product: {
					required: {
						depends: function(element) {
							if($("#commision_product").val() == 'Sales commission rate (%)'){
								return true;	
							}
						}
					}
				},
				rate_commission_product: {
					required: {
						depends: function(element) {
							if($("#commision_product").val() == 'Fixed commission ($)'){
								return true;	
							}
						}
					}
				},
				price_max_prd: {
					required: {
						depends: function(element) {
							if($("#ancienneteBien").val() == 'Neuf' && $("#natureBien").val() == 'Programme immobilier'){
								return true;	
							}
						}
					},
					number: true,
					min: function ()  { return parseInt($("#price").val())}
				},
				interior_area: {
					required: {
						depends: function(element) {
							if($("#cat_programmme_id").val() == 1){
								return true;	
							}
						}
					},
					number: true,
				},
				exterior_area: {
					required: {
						depends: function(element) {
							if($("#cat_programmme_id").val() == 1){
								return true;	
							}
						}
					},
					number: true,
				},
				total_area: {
					required: {
						depends: function(element) {
							if($("#cat_programmme_id").val() == 1){
								return true;	
							}
						}
					},
					number: true,
				},	
				property_detail: {
					required: {
						depends: function(element) {
							if($("#cat_programmme_id").val() == 3){
								return true;	
							}
						}
					}
				},	
				surface_commercial: {
					required: {
						depends: function(element) {
							if($("#cat_programmme_id").val() == 4){
								return true;	
							}
						}
					}
				},		
				type_cutomer_parking: {
					required: {
						depends: function(element) {
							if($("#cat_programmme_id").val() == 4){
								return true;	
							}
						}
					}
				},			
				certificat: {
					required: true
				},
				certicat2: {
					required: true
				},
				certicat3: {
					required: true
				},
				certicat4: {
					required: true
				},
				chk_firb: {
					required: {
						depends: function(element) {
							if($("#ancienneteBien").val() == 'Neuf' && $("#natureBien").val() == 'Produit isolé'){
								return true;	
							}
						}
					}
				},
				programme_pre_approved_sale: {
					required: true
				},
				p_eoiDossier: {
					required: true
				},
				programme_firb_pre_approved_program: {
					required: true
				}
			},
			messages: {
				cat_programmme_id: {
					required: "@lang('app.txt.champobligatoire')"
				},
				ancienneteBien: {
					required: "@lang('app.txt.champobligatoire')"
				},
				natureBien: {
					required: "@lang('app.txt.champobligatoire')"
				},
				simple_price:{
					required: "@lang('app.txt.champobligatoire')"
				},
				dt_db_travaux:{
					required: "@lang('app.txt.champobligatoire')"
				},
				dt_prevu_livraison:{
					required: "@lang('app.txt.champobligatoire')"
				},
				prix_min: {
					required: "@lang('app.txt.champobligatoire')"
				},
				prix_max: {
					required: "@lang('app.txt.champobligatoire')",
					min: jQuery.validator.format("@lang('app.form.programme_validate_prix_max') {0}")
				},
				type_id: {
					required: "@lang('app.txt.champobligatoire')"
				},
				postal_code: {
					required: "@lang('app.txt.champobligatoire')",
					remote: jQuery.validator.format("{0} @lang('app.form.validation_cp')")
				},
				annee_const: {
					required: "@lang('app.txt.champobligatoire')",
				},
				title_product: {
					required: "@lang('app.txt.champobligatoire')",
					remote: jQuery.validator.format("{0} existe déjà")
				},
				product_type_id: {
					required: "@lang('app.txt.champobligatoire')"
				},
				postalCode_product: {
					required: "@lang('app.txt.champobligatoire')"
				},
				suburb_product: {
					required: "@lang('app.txt.champobligatoire')"
				},
				ville_product: {
					required: "@lang('app.txt.champobligatoire')"
				},
				display_address_product: {
					required: "@lang('app.txt.champobligatoire')",
					remote: "@lang('app.txt.adress_exist_error')"
				},
				price: {
					required: "@lang('app.txt.champobligatoire')"
				},
				price_max_prd: {
					required: "@lang('app.txt.champobligatoire')"
				},
				interior_area: {
					required: "@lang('app.txt.champobligatoire')"
				},
				exterior_area: {
					required: "@lang('app.txt.champobligatoire')"
				},
				total_area: {
					required: "@lang('app.txt.champobligatoire')"
				},
				display_address: {
					required: "@lang('app.txt.champobligatoire')"
				},
				suburb: {
					required: "@lang('app.txt.champobligatoire')"
				},
				ville: {
					required: "@lang('app.txt.champobligatoire')"
				},
				postalCode: {
					required: "@lang('app.txt.champobligatoire')"
				},
				title_programme: {
					required: "@lang('app.txt.champobligatoire')",
					remote: jQuery.validator.format("{0} @lang('app.form.programme_validate_titre')")
				},
				chk_firb_programme: {
					required: "@lang('app.txt.champobligatoire')"
				},
				state_id: {
					required: "@lang('app.txt.champobligatoire')"
				},
				state_id_product: {
					required: "@lang('app.txt.champobligatoire')"
				},
				property_detail: {
					required: "@lang('app.txt.champobligatoire')"
				},
				surface_commercial: {
					required: "@lang('app.txt.champobligatoire')"
				},
				type_cutomer_parking: {
					required: "@lang('app.txt.champobligatoire')"
				},
				certificat: {
					required: "@lang('app.txt.champobligatoire')"
				},
				certicat2: {
					required: "@lang('app.txt.champobligatoire')"
				},
				certicat3: {
					required: "@lang('app.txt.champobligatoire')"
				},
				certicat4: {
					required: "@lang('app.txt.champobligatoire')"
				},
				chk_firb: {
					required: "@lang('app.txt.champobligatoire')"
				},
				programme_pre_approved_sale: {
					required: "@lang('app.txt.champobligatoire')"
				},
				p_eoiDossier: {
					required: "@lang('app.txt.champobligatoire')"
				},
				programme_firb_pre_approved_program: {
					required: "@lang('app.txt.champobligatoire')"
				}
			},
			success: function(label,element) {
				label.parent().removeClass('error');
				label.remove(); 
			}
		});
		
		$('#bonus_vente').on('change', function() {
			var type_bonus = this.value;
			if(type_bonus == 'YES'){
				$('#montant_bonus_vente').show();
			}else{
				$('#montant_bonus_vente').hide();
			}
		});
		
		<!-- commission programme -->
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
		
		<!-- commission product -->
		$('#commision_product').on('change', function() {
			var type_commission_product = this.value;
			if(type_commission_product == 'Sales commission rate (%)'){
				$('#commission_rate_prd').show();
				$('#fixed_commission_prd').hide();
				$('#sales_rate_product').val('');
				$('#rate_commission_product').val('');
			}else if(type_commission_product == 'Fixed commission ($)'){
				$('#fixed_commission_prd').show();
				$('#commission_rate_prd').hide();
				$('#sales_rate_product').val('');
				$('#rate_commission_product').val('');
			}else{
				$('#fixed_commission_prd').hide();
				$('#commission_rate_prd').hide();
				$('#sales_rate_product').val('');
				$('#rate_commission_product').val('');
			}
		});
		
		$("#dt_db_travaux").datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			dateFormat: 'MM yy',
			onClose: function(dateText, inst) { 
				var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
				var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
				$(this).datepicker('setDate', new Date(year, month, 1));
			},
			beforeShow : function(input, inst) {
				var datestr;
				if ((datestr = $(this).val()).length > 0) {
					year = datestr.substring(datestr.length-4, datestr.length);
					month = jQuery.inArray(datestr.substring(0, datestr.length-5), $(this).datepicker('option', 'monthNamesShort'));
					$(this).datepicker('option', 'defaultDate', new Date(year, month, 1));
					$(this).datepicker('setDate', new Date(year, month, 1));
				}
			}
		});
		
		CKEDITOR.replace( 'description' );
		CKEDITOR.replace( 'desc_product' );
		$("#category_id").select2();
		$("#seller_id").select2();
		$("#parent_id").select2();
		
		$("#fond_dossier").dropzone({
			maxFiles: 25, 
            maxFilesize: 50,
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
				// set new images names in dropzone’s preview box.
                var olddatadzname = file.previewElement.querySelector("[data-dz-name]");   
				file.previewElement.querySelector("img").alt = response.success;
				file._captionBox = Dropzone.createElement("<label style='width:100%;text-align:center'>"+response.success+"</label>");
				file.previewElement.appendChild(file._captionBox);
				$('#form').append('<input type="hidden" name="fondDossier[]" value="'+response.success +'">');
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
				$('#form').append('<input type="hidden" name="eoiDossier[]" value="'+response.success +'">');
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
		
		$("#lia_dossier").dropzone({
			maxFiles: 1, 
            maxFilesize: 25,
			dictDefaultMessage: "@lang('app.txt.lia_dossier')",
			url: "{{ route('ajaxDropZone') }}",
			params: {"_token": "{{ csrf_token() }}"},
            acceptedFiles: ".pdf",
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
				$('#programmeForm').append('<input type="hidden" name="liaDossier[]" value="'+response.success +'">');
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
		
		$("#p_fond_dossier").dropzone({
			maxFiles: 25, 
            maxFilesize: 50,
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
				// set new images names in dropzone’s preview box.
                var olddatadzname = file.previewElement.querySelector("[data-dz-name]");   
				file.previewElement.querySelector("img").alt = response.success;
				file._captionBox = Dropzone.createElement("<label style='width:100%;text-align:center'>"+response.success+"</label>");
				file.previewElement.appendChild(file._captionBox);
				$('#form').append('<input type="hidden" name="p_fondDossier[]" value="'+response.success +'">');
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
		
		$("#p_eoi_dossier").dropzone({
			maxFiles: 1, 
			maxFilesize: 25,
			dictDefaultMessage: "@lang('app.txt.eoi_dossier')",
			url: "{{ route('ajaxDropZone') }}",
			params: {"_token": "{{ csrf_token() }}"},
			acceptedFiles: ".pdf",
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
				document.getElementById("p_eoiDossier").value = response.success;
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
		
		$("#p_lia_dossier").dropzone({
			maxFiles: 1, 
            maxFilesize: 25,
			dictDefaultMessage: "@lang('app.txt.lia_dossier')",
			url: "{{ route('ajaxDropZone') }}",
			params: {"_token": "{{ csrf_token() }}"},
            acceptedFiles: ".pdf",
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
				$('#programmeForm').append('<input type="hidden" name="p_liaDossier[]" value="'+response.success +'">');
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
		
		$("#pictures_upload").dropzone({
			maxFiles: 25, 
			maxFilesize: 50,
			dictDefaultMessage: "@lang('app.dropzone.libelle_product')",
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
				// set new images names in dropzone’s preview box.
				var olddatadzname = file.previewElement.querySelector("[data-dz-name]");   
				file.previewElement.querySelector("img").alt = response.success;
				file._captionBox = Dropzone.createElement("<label style='width:100%;text-align:center'><input value='"+response.success+"' type='radio' name='radioDrop' style='display:inline-block'> @lang('app.dropzone.photoIcon_tex')</label>");
				file.previewElement.appendChild(file._captionBox);
				$('#form').append('<input type="hidden" name="dropPhoto[]" value="'+response.success +'">');
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
			maxFilesize: 50,
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
				// set new images names in dropzone’s preview box.
				var olddatadzname = file.previewElement.querySelector("[data-dz-name]");   
				file.previewElement.querySelector("img").alt = response.success;
				file._captionBox = Dropzone.createElement("<label style='width:100%;text-align:center'><input value='"+response.success+"' type='radio' name='radioDrop' style='display:inline-block'> @lang('app.dropzone.photoIcon_tex')</label>");
				file.previewElement.appendChild(file._captionBox);
				$('#form').append('<input type="hidden" name="dropPhoto[]" value="'+response.success +'">');
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
		
		$('#countryId').on('change', function() {
			var country = this.value;
			if(country == 152){
				$('#info_etat').hide();
			}else{
				$('#info_etat').show();
			}
		});
		
		$('#cat_programmme_id').on('change', function() {
			$('#Age_of_Property').hide();
			$('#info-programme').hide();	
			$('#infoAdresse').hide();
			$('#info_code_postal').hide();
			$('[name="ancienneteBien"]').val('');
			var category = this.value;
			if(category == 1){
				//pour le categorie residentiel
				$('#info_qte').show();
				$('#info_prd_residentiel').show();
				$('#info_prd_foncier').hide();
				$('#info_prd_industriel').hide();
				$('#info_prd_commercial').hide();
				$('#Age_of_Property').show();
			}else if(category == 2){
				//pour categorie foncier 
				$('#info_qte').hide();
				//$('#info-date-isole').hide();
				$('#info_prd_residentiel').hide();
				$('#info_prd_foncier').show();
				$('#info_prd_industriel').hide();
				$('#info_prd_commercial').hide();
				$('#Age_of_Property').hide();
				$('#price_simple').show();
			}else if(category == 3){
				// pour categorie industriel
				$('#info_prd_residentiel').hide();
				$('#info_prd_foncier').hide();
				$('#info_prd_industriel').show();
				$('#info_prd_commercial').hide();
				$('#Age_of_Property').hide();
				$('#price_simple').show();
			}else if(category == 4){
				//pour categorie commercial
				$('#info_prd_residentiel').hide();
				$('#info_prd_foncier').hide();
				$('#info_prd_industriel').hide();
				$('#info_prd_commercial').show();
				$('#Age_of_Property').hide();
				$('#price_simple').show();
			}
			
			//changer list type produit par rapport au programme
			$.ajax({
			   type:'POST',
			   url:"{{ route('ajaxGetTypeProduitCategorie') }}",
			   data: {"_token": "{{ csrf_token() }}","categoryId": category, "type_id_active": 0,"cat":1},
			   success:function(data) {
				  console.log(data);
				  $('#type_id').html(data);
				  $('#product_type_id').html(data);
				  
			   }
			});
		});
		
		$('#ancienneteBien').on('change', function() {
			var anciennete = this.value;
			if(anciennete == 'Neuf'){
				$('#infoAdresse').show();
				$('#info_code_postal').hide();				
				$("#form").steps("next");
			}else{
				$('#info_code_postal').show();
				$('#infoAdresse').hide();
				$("#form").steps("next");
				$('#info-programme').hide();
			}
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
		
		$('#postal_code').keyup(function(){
			var codeP = this.value;
			$.ajax({
			   type:'GET',
			   url:"{{ route('ajaxCheckFirb') }}",
			   data: {"_token": "{{ csrf_token() }}","postal_code": codeP},
			   success:function(data) {
				  if(data == "true" ) {
					 $('#annee_const').prop('disabled', false);
					 $('#postal_code').removeClass('error');
					 $('#postal_code-error').hide();
				  }else{
					 $('#postal_code').addClass('error');
					 $('#postal_code-error').show();
				  }					  
			   }
			});
		});
		
		$('#garage_spaces, #carport_spaces').bind('keyup mouseup', function (){
			if($('#garage_spaces').val() != 0 || $('#carport_spaces').val() != 0){
				 console.log('tokony disabled');
				$("#chk_parking").attr('disabled','disabled');
			}else{
				console.log('normal');
				$("#chk_parking").removeAttr('disabled');
			}
		});	
			
	});
</script>
@endpush