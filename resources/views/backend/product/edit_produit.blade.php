@extends('layouts.backend')

@section('subcontent')

    <div class="profile-content-area m-40px-tb card card-body">
        <div class="tab-style-4">
			<ul class="nav nav-fill nav-tabs">
				<li class="nav-item">
					<a href="{{route('mes-programmes')}}" class="{{Request::is('mes-programmes') ? 'active' : ''}}">
						<div class="icon"><i class="fa fa-briefcase"></i></div>
						<span>@lang('app.tab.title_programme')</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{route('mes-produits')}}" class="active">
						<div class="icon"><i class="fa fa-building"></i></div>
						<span>@lang('app.tab.title_produits')</span>
					</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="profile-content-area m-40px-tb">		
					<div class="card m-40px-b">		
						<div class="card-header">
							<div class="row">
								<div class="col-5 col-lg-8">
									<span class="h6 font-w-500">@lang('app.form.programme_edition') <strong>{{$product->title}}</strong></span>
								</div>
							</div>
						</div>
						<div class="card-body">
							<form class="form-padding wizard-big" action="{{ route('updateProduit') }}" method="post" id="productForm" enctype="multipart/form-data">
								{{ csrf_field() }}
								<input type="hidden" name="category_id" id="cat_programmme_id" value="{{$product->category_id}}" />
								<input type="hidden" name="location_id" value="{{$product->location_id}}" />
								<input type="hidden" name="id" value="{{$product->id}}" /> 
								<input type="hidden" name="" id="natureBien" value="{{$product->natureBien}}" />    
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label for="title">@lang('app.form.product_title') *</label>
											<input name="title" id="title" class="form-control" type="text" value="{{$product->title}}">								
										</div>
									</div>
								</div>
								<div class="row">     
									<div class="col-lg-12">                              
										<div class="form-group">
											<label for="title">@lang('app.form.product_content')</label>
											<textarea class="form-control" rows="10" name="desc_product" id="desc_product">{{$product->content}}</textarea>
										</div>
									</div>
								</div>
									
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label for="title">@lang('app.input.type') *</label>
											<select class="form-control" name="type_id" id="product_type_id" style="width:100%">
												
											</select>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="title">@lang('app.form.programme_suburb') *</label>
											<input name="suburb_product" id="suburb_product" class="form-control" type="text" value="{{$localisation ? $localisation->area_level_1:''}}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label for="title">@lang('app.form.programme_ville') *</label>
											<input name="ville_product" id="ville_product" class="form-control" type="text" value="{{$localisation ? $localisation->locality:''}}">
										</div>  
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="title">@lang('app.form.programme_cp') *</label>
											<input name="postalCode_product" id="postalCode_product" class="form-control" type="text" value="{{$product->postalCode}}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label for="title">@lang('app.form.programme_adresse') *</label>
											<input name="display_address" id="display_address" class="form-control" type="text" value="{{$product->display_address}}">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="title">@lang('app.form.programme_etat') *</label>
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
											<label for="title">@lang('app.form.programme_pays')</label>
											<select class="form-control" name="countryId_product" id="countryId_product" style="width:100%">
												@foreach(\App\Models\Country::where('id',12)->get() as $country)
													@if($localisation)
														<option value="{{$country->code}}" {{$country->code == $localisation->country ? 'selected' : ''}}>{{$country->content}}</option>
													@else
														<option value="{{$country->code}}">{{$country->content}}</option>
													@endif
													
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<!-- categorie residentiel / neuf / immobilier -->
								@if($product->category_id == 1 && $product->ancienneteBien == 'Neuf' && $product->natureBien == 'Programme immobilier')
									<div class="row">							
										<div class="col-lg-6">
											<div class="form-group">
												<label for="title">@lang('app.form.product_prix_min') *</label>
												<div class="input-group m-b">
													<input type="number" class="form-control" name="min_price" id="min_price" value="{{$product->min_price}}">
													<div class="input-group-append">
														<span class="input-group-text">AUD</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label for="title">@lang('app.form.product_prix_max') *</label>
												<div class="input-group m-b">
													<input type="number" class="form-control" name="max_price" id="max_price" value="{{$product->max_price}}">
													<div class="input-group-append">
														<span class="input-group-text">AUD</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label for="title">@lang('app.form.programme_commission_type')</label>
												<select class="form-control" name="commision_product" id="commision_product">
													<option value="">Choisir...</option>
													<option value="Sales commission rate (%)" {{$product->commission_type == 'Sales commission rate (%)' ? 'selected' : ''}}>
														@lang('app.form.programme_commission_option1') (%)
													</option>
													<option value="Fixed commission ($)" {{$product->commission_type == 'Fixed commission ($)' ? 'selected' : ''}}>
														@lang('app.form.programme_commission_option2') ($)
													</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6">
											<div id="commission_rate_prd" style="display:none">
												<div class="form-group">
													<label for="title">@lang('app.form.programme_taux_commission')</label>
													<div class="input-group m-b">
														<input type="number" class="form-control" name="sales_rate_product" id="sales_rate_product">
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
														<input type="number" class="form-control" name="rate_commission_product" id="rate_commission_product">
														<div class="input-group-append">
															<span class="input-group-text">AUD</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group" style="margin-bottom:.5rem;">
												<label for="title">@lang('app.txt.avoir_bonus')</label>
												<select class="form-control" name="bonus_vente" id="bonus_vente">
													<option value="">Choisir...</option>
													<option value="YES" {{$product->avoir_bonus == 'YES' ? 'selected' : ''}}>@lang('app.txt.yes')</option>
													<option value="NO" {{$product->avoir_bonus == 'NO' ? 'selected' : ''}}>@lang('app.txt.no')</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6">
											<div id="montant_bonus_vente" style="display:none">
												<label for="title">@lang('app.txt.valeur_bonus') *</label>
												<div class="input-group" style="margin-bottom: .5rem;">
													<input type="number" class="form-control" value="{{$product->amount_bonus}}" name="bonus_amount" id="bonus_amount">
													<div class="input-group-append">
														<span class="input-group-text">AUD</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.input.nbchambre')</label>
												<input name="bedrooms" id="bedrooms" class="form-control" type="number" value="{{$product->bedrooms}}">
											</div>  
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.input.nbchambresuite')</label>
												<input name="ensuite" id="ensuite" class="form-control" type="number" value="{{$product->ensuite}}">
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.input.nbsalledebain')</label>
												<input name="bathrooms" id="bathrooms" class="form-control" type="number" value="{{$product->bathrooms}}">
											</div> 
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.form.product_area_interior') *</label>
												<div class="input-group m-b">
													<input type="text" name="interior_area" id="interior_area" class="form-control" value="{{$product->interior_area}}">
													<div class="input-group-append">
														<span class="input-group-text">.m2</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.form.product_area_exterior') *</label>
												<div class="input-group m-b">
													<input type="text" name="exterior_area" id="exterior_area" class="form-control" value="{{$product->exterior_area}}">
													<div class="input-group-append">
														<span class="input-group-text">.m2</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.form.product_area_total') *</label>
												<div class="input-group m-b">
													<input type="text" name="total_area" id="total_area" class="form-control" value="{{$product->total_area}}" readonly="">
													<div class="input-group-append">
														<span class="input-group-text">.m2</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.form.product_parking_ferme')</label>
												<input name="garage_spaces" id="garage_spaces" class="form-control" type="number" value="{{$product->garage_spaces}}">
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.form.product_parking_carpot')</label>
												<input name="carport_spaces" id="carport_spaces" class="form-control" type="number" value="{{$product->carport_spaces}}">
											</div>
										</div>
									</div>
									<!-- photo produit -->
									<div class="row">
										@if($product->image_id != 0)
										<div class="col-lg-4">
											<div class="file-box" style="width:100% !important">
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
													<label>@lang('app.table.produit_image')</label>
												</div>
											</div>
										</div>
										@endif
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.table.produit_image')</label>
												<input name="image" class="form-control" type="file" accept="image/png, image/jpeg">
											</div>
										</div>
									</div>
									<!-- fin photo produit -->
									<div class="row">
										<div class="col-lg-12">
											<label class="chk_parking"> 
												<input type="checkbox" value="1" id="chk_parking" name="chk_parking" {{$product->avoir_parking_voie_public == 1 ? 'checked="checked"' : ''}}> @lang('app.form.product_parking_vPublic')
											</label>
										</div>
										<div class="col-lg-12">
											<div id="chk_firb">
												<label class="chk_firb"> 
													<input type="checkbox" value="" name="chk_firb" checked="checked"> The Seller certifies under their sole responsibilitythatthis property canbe sold to non-residentforeigners in accordance with Australian law and the rules applicable by the Foreign Investment Review Board (FIRB).
												</label>
											</div>
										</div>
									</div>
								@endif
								<!-- fin categorie residentiel / neuf / immobilier -->
								<!-- categorie residentiel / neuf / isolé -->
								@if($product->category_id == 1 && $product->ancienneteBien == 'Neuf' && $product->natureBien == 'Produit isolé')
									<div class="row">
										<div class="col-lg-4">
											<label for="title">Price *</label>
											<div class="input-group" style="margin-bottom: .5rem;">
												<input type="number" class="form-control" name="simple_price" id="simple_price" value="{{$product->price}}">
												<div class="input-group-append">
													<span class="input-group-text">AUD</span>
												</div>
											</div>
										</div>										
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.form.produit_dt_db_travaux')</label>
												<input type="text" class="form-control" name="dt_db_travaux" value="{{$product->dt_db_travaux}}" id="dt_db_travaux" />
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.form.produit_dt_prevu_livraison')</label>
												<input type="date" class="form-control" value="{{$product->dt_prevu_livraison}}" name="dt_prevu_livraison" id="dt_prevu_livraison" />
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label for="title">@lang('app.form.programme_commission_type')</label>
												<select class="form-control" name="commision_product" id="commision_product">
													<option value="">Choisir...</option>
													<option value="Sales commission rate (%)" {{$product->commission_type == 'Sales commission rate (%)' ? 'selected' : ''}}>
														@lang('app.form.programme_commission_option1') (%)
													</option>
													<option value="Fixed commission ($)" {{$product->commission_type == 'Fixed commission ($)' ? 'selected' : ''}}>
														@lang('app.form.programme_commission_option2') ($)
													</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6">
											<div id="commission_rate_prd" style="display:none">
												<div class="form-group">
													<label for="title">@lang('app.form.programme_taux_commission')</label>
													<div class="input-group m-b">
														<input type="number" class="form-control" name="sales_rate_product" id="sales_rate_product">
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
														<input type="number" class="form-control" name="rate_commission_product" id="rate_commission_product">
														<div class="input-group-append">
															<span class="input-group-text">AUD</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group" style="margin-bottom:.5rem;">
												<label for="title">@lang('app.txt.avoir_bonus')</label>
												<select class="form-control" name="bonus_vente" id="bonus_vente">
													<option value="">Choisir...</option>
													<option value="YES" {{$product->avoir_bonus == 'YES' ? 'selected' : ''}}>@lang('app.txt.yes')</option>
													<option value="NO" {{$product->avoir_bonus == 'NO' ? 'selected' : ''}}>@lang('app.txt.no')</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6">
											<div id="montant_bonus_vente" style="display:none">
												<label for="title">@lang('app.txt.valeur_bonus') *</label>
												<div class="input-group" style="margin-bottom: .5rem;">
													<input type="number" class="form-control" value="{{$product->amount_bonus}}" name="bonus_amount" id="bonus_amount">
													<div class="input-group-append">
														<span class="input-group-text">AUD</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.input.nbchambre')</label>
												<input name="bedrooms" id="bedrooms" class="form-control" type="number" value="{{$product->bedrooms}}">
											</div>  
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.input.nbchambresuite')</label>
												<input name="ensuite" id="ensuite" class="form-control" type="number" value="{{$product->ensuite}}">
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.input.nbsalledebain')</label>
												<input name="bathrooms" id="bathrooms" class="form-control" type="number" value="{{$product->bathrooms}}">
											</div> 
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.form.product_area_interior') *</label>
												<div class="input-group m-b">
													<input type="text" name="interior_area" id="interior_area" class="form-control" value="{{$product->interior_area}}">
													<div class="input-group-append">
														<span class="input-group-text">.m2</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.form.product_area_exterior') *</label>
												<div class="input-group m-b">
													<input type="text" name="exterior_area" id="exterior_area" class="form-control" value="{{$product->exterior_area}}">
													<div class="input-group-append">
														<span class="input-group-text">.m2</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.form.product_area_total') *</label>
												<div class="input-group m-b">
													<input type="text" name="total_area" id="total_area" class="form-control" value="{{$product->total_area}}" readonly="">
													<div class="input-group-append">
														<span class="input-group-text">.m2</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.form.product_parking_ferme')</label>
												<input name="garage_spaces" id="garage_spaces" class="form-control" type="number" value="{{$product->garage_spaces}}">
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.form.product_parking_carpot')</label>
												<input name="carport_spaces" id="carport_spaces" class="form-control" type="number" value="{{$product->carport_spaces}}">
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.form.product_jardin_space')</label>
												<div class="input-group m-b">
													<input type="number" class="form-control" name="superficie_jardin" id="superficie_jardin" value="{{$product->superficie_jardin}}">
													<div class="input-group-append">
														<span class="input-group-text">.m2</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<!-- si fond dossier existe -->
									@if (count($dossier) > 0)
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
											<div class="dropzone" id="fond_dossier" multiple style="margin-bottom:25px">
												<div id="template" class="file-row"></div>
											</div>
										</div>
									</div>
									<!-- fin fond dossier -->
									
									<!-- si eoi dossier existe -->
									@if (count($eoidossier)>0)
									<div class="row">
										 <div class="col-lg-12">
											 <h5 style="font-weight:normal; font-size:17px; color:#718096">@lang('app.table.eoi_dossier')</h5>
											 @foreach ( $eoidossier as $dos )
												 <div class="file-box">
													<div class="file">
														@if(setIconFile($dos->filepath) == 'images')
															<a href="{{asset($dos->filepath)}}" class="fancyboxLink">
														@elseif(setIconFile($dos->filepath) == 'pdf')
															<a class="fancybox-pdf" data-fancybox-type="iframe" href="http://docs.google.com/viewer?embedded=true&url={{asset(urlencode($dos->filepath))}}">
														@else
															<a href="https://docs.google.com/viewer?url={{asset(urlencode($dos->filepath))}}&embedded=true" class="fancyboxLinkDoc" data-fancybox-type="iframe">
														@endif								
															<span class="corner"></span>						
															@if(setIconFile($dos->filepath) == 'images')
																<div class="image">
																	<img alt="image" class="img-fluid" src="{{asset($dos->filepath)}}">
																</div>
															@endif	
															@if(setIconFile($dos->filepath) == 'pdf')
																<div class="icon">
																	<i class="fa fa-file-pdf"></i>
																</div>
															@endif	
															@if(setIconFile($dos->filepath) == 'doc')
																<div class="icon">
																	<i class="fa fa-file-word-o"></i>
																</div>
															@endif
															@if(setIconFile($dos->filepath) == 'excel')
																<div class="icon">
																	<i class="fa fa-file-excel-o"></i>
																</div>
															@endif	
															@if(setIconFile($dos->filepath) == 'file')
																<div class="icon">
																	<i class="fa fa-file"></i>
																</div>
															@endif		
															<div class="file-name">
																@php
																	$filename_eoi = $dos->filename;
																	$filename_eoi = preg_replace('/^(.*)\-\d{8,}\.(gif|jpg|png|pdf)$/', '$1.$2', $filename_eoi);
																@endphp
																<label style="text-transform:lowercase">{{str_limit($filename_eoi, 15)}}</label>
																<a class="pull-right" href="javascript:void(0)" onclick="delete_eoi_dossier({{$dos->prdEoiId}})">
																	<i class="fa fa-trash"></i>
																</a>
																<br>
																<small>{{$dos->created_at ? $dos->created_at->diffForHumans() : ""}}</small>
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
											<label for="title">@lang('app.table.eoi_dossier')</label>
											<div class="dropzone" id="eoi_dossier" multiple style="margin-bottom:25px">
												<div id="template" class="file-row"></div>
											</div>
										</div>
									</div>  
									<!-- fin eoi dossier -->
									<!-- lia dossier -->
									@if (count($liadossier) > 0)
									<div class="row">
										 <div class="col-lg-12">
											 <h5 style="font-weight:normal; font-size:17px; color:#718096">@lang('app.table.lia_dossier')</h5>
											 @foreach ( $liadossier as $dos )
											 <div class="file-box">
												<div class="file">
													@if(setIconFile($dos->filepath) == 'images')
														<a href="{{asset($dos->filepath)}}" class="fancyboxLink">
													@elseif(setIconFile($dos->filepath) == 'pdf')
														<a class="fancybox-pdf" target="_blank" data-fancybox-type="iframe" href="http://docs.google.com/viewer?embedded=true&url={{asset(urlencode($dos->filepath))}}">
													@else
														<a href="https://docs.google.com/viewer?url={{asset(urlencode($dos->filepath))}}&embedded=true" class="fancyboxLinkDoc" data-fancybox-type="iframe">
													@endif								
														<span class="corner"></span>						
														@if(setIconFile($dos->filepath) == 'images')
															<div class="image">
																<img alt="image" class="img-fluid" src="{{asset($dos->filepath)}}">
															</div>
														@endif	
														@if(setIconFile($dos->filepath) == 'pdf')
															<div class="icon">
																<i class="fa fa-file-pdf"></i>
															</div>
														@endif	
														@if(setIconFile($dos->filepath) == 'doc')
															<div class="icon">
																<i class="fa fa-file-word-o"></i>
															</div>
														@endif
														@if(setIconFile($dos->filepath) == 'excel')
															<div class="icon">
																<i class="fa fa-file-excel-o"></i>
															</div>
														@endif	
														@if(setIconFile($dos->filepath) == 'file')
															<div class="icon">
																<i class="fa fa-file"></i>
															</div>
														@endif		
														<div class="file-name">
															@php
																$filename_eoi = $dos->filename;
																$filename_eoi = preg_replace('/^(.*)\-\d{8,}\.(gif|jpg|png|pdf)$/', '$1.$2', $filename_eoi);
															@endphp
															<label style="text-transform:lowercase">{{str_limit($filename_eoi, 15)}}</label>
															<a class="pull-right" href="javascript:void(0)" onclick="delete_lia_dossier({{$dos->prdLiaId}})">
																<i class="fa fa-trash"></i>
															</a>
															<br>
															<small>{{$dos->created_at ? $dos->created_at->diffForHumans() : ""}}</small>
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
											<label for="title">@lang('app.table.lia_dossier')</label>
											<div class="dropzone" id="lia_dossier" multiple style="margin-bottom:25px">
												<div id="template" class="file-row"></div>
											</div>
										</div>
									</div>
									<!-- fin lia dossier -->
									
									<!-- photo produit -->
									<div class="row">
										@if($product->image_id != 0)
										<div class="col-lg-4">
											<div class="file-box" style="width:100% !important">
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
													<label>@lang('app.table.produit_image')</label>
												</div>
											</div>
										</div>
										@endif
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.table.produit_image')</label>
												<input name="image" class="form-control" type="file" accept="image/png, image/jpeg">
											</div>
										</div>
									</div>
									<!-- fin photo produit -->
									
									<div class="row">
										<div class="col-lg-12">
											<label class="chk_parking"> 
												<input type="checkbox" value="1" id="chk_parking" name="chk_parking" {{$product->avoir_parking_voie_public == 1 ? 'checked="checked"' : ''}}> @lang('app.form.product_parking_vPublic')
											</label>
										</div>
										<div class="col-lg-12">
											<div id="chk_picine">
												<label class="chk_picine"> 
													<input type="checkbox" value="1" name="chk_picine" {{$product->avoir_piscine == 1 ? 'checked="checked"' : ''}}> @lang('app.form.product_piscine')
												</label>
											</div>
										</div>
									</div>
								@endif
								<!-- fin categorie residentiel / neuf / isolé -->		                                
								<!-- categorie residentiel / ancien -->
								@if($product->category_id == 1 && $product->ancienneteBien == 'Ancien')	
									<div class="row">
										<div class="col-lg-4">
											<label for="title">@lang('app.input.prix') *</label>
											<div class="input-group" style="margin-bottom: .5rem;">
												<input type="number" class="form-control" name="simple_price" id="simple_price" value="{{$product->price}}">
												<div class="input-group-append">
													<span class="input-group-text">AUD</span>
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.form.programme_commission_type')</label>
												<select class="form-control" name="commision_product" id="commision_product">
													<option value="">Choisir...</option>
													<option value="Sales commission rate (%)" {{$product->commission_type == 'Sales commission rate (%)' ? 'selected' : ''}}>
														@lang('app.form.programme_commission_option1') (%)
													</option>
													<option value="Fixed commission ($)" {{$product->commission_type == 'Fixed commission ($)' ? 'selected' : ''}}>
														@lang('app.form.programme_commission_option2') ($)
													</option>
												</select>
											</div>
										</div>
										<div class="col-lg-4">
											<div id="commission_rate_prd" style="display:none">
												<div class="form-group">
													<label for="title">@lang('app.form.programme_taux_commission')</label>
													<div class="input-group m-b">
														<input type="number" class="form-control" name="sales_rate_product" id="sales_rate_product">
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
														<input type="number" class="form-control" name="rate_commission_product" id="rate_commission_product">
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
											<div class="form-group" style="margin-bottom:.5rem;">
												<label for="title">@lang('app.txt.avoir_bonus')</label>
												<select class="form-control" name="bonus_vente" id="bonus_vente">
													<option value="">Choisir...</option>
													<option value="YES" {{$product->avoir_bonus == 'YES' ? 'selected' : ''}}>@lang('app.txt.yes')</option>
													<option value="NO" {{$product->avoir_bonus == 'NO' ? 'selected' : ''}}>@lang('app.txt.no')</option>
												</select>
											</div>
										</div>
										<div class="col-lg-4">
											<div id="montant_bonus_vente">
												<label for="title">@lang('app.txt.valeur_bonus') *</label>
												<div class="input-group" style="margin-bottom: .5rem;">
													<input type="number" class="form-control" value="{{$product->amount_bonus}}" name="bonus_amount" id="bonus_amount">
													<div class="input-group-append">
														<span class="input-group-text">AUD</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.form.product_anneeConstruct') *</label>
												<input name="year_built" id="year_built" class="form-control" type="number" value="{{$product->year_built}}">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.input.nbchambre')</label>
												<input name="bedrooms" id="bedrooms" class="form-control" type="number" value="{{$product->bedrooms}}">
											</div>  
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.input.nbchambresuite')</label>
												<input name="ensuite" id="ensuite" class="form-control" type="number" value="{{$product->ensuite}}">
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.input.nbsalledebain')</label>
												<input name="bathrooms" id="bathrooms" class="form-control" type="number" value="{{$product->bathrooms}}">
											</div> 
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.form.product_area_interior') *</label>
												<div class="input-group m-b">
													<input type="text" name="interior_area" id="interior_area" class="form-control" value="{{$product->interior_area}}">
													<div class="input-group-append">
														<span class="input-group-text">.m2</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.form.product_area_exterior') *</label>
												<div class="input-group m-b">
													<input type="text" name="exterior_area" id="exterior_area" class="form-control" value="{{$product->exterior_area}}">
													<div class="input-group-append">
														<span class="input-group-text">.m2</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.form.product_area_total') *</label>
												<div class="input-group m-b">
													<input type="text" name="total_area" id="total_area" class="form-control" value="{{$product->total_area}}" readonly="">
													<div class="input-group-append">
														<span class="input-group-text">.m2</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.form.product_parking_ferme')</label>
												<input name="garage_spaces" id="garage_spaces" class="form-control" type="number" value="{{$product->garage_spaces}}">
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.form.product_parking_carpot')</label>
												<input name="carport_spaces" id="carport_spaces" class="form-control" type="number" value="{{$product->carport_spaces}}">
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.form.product_jardin_space')</label>
												<div class="input-group m-b">
													<input type="number" class="form-control" name="superficie_jardin" id="superficie_jardin" value="{{$product->superficie_jardin}}">
													<div class="input-group-append">
														<span class="input-group-text">.m2</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- si fond dossier existe -->
									@if (count($dossier) > 0)
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
											<div class="dropzone" id="fond_dossier" multiple style="margin-bottom:25px">
												<div id="template" class="file-row"></div>
											</div>
										</div>
									</div>
									<!-- fin fond dossier -->
									
									<!-- si eoi dossier existe -->
									@if (count($eoidossier)>0)
									<div class="row">
										 <div class="col-lg-12">
											 <h5 style="font-weight:normal; font-size:17px; color:#718096">@lang('app.table.eoi_dossier')</h5>
											 @foreach ( $eoidossier as $dos )
												 <div class="file-box">
													<div class="file">
														@if(setIconFile($dos->filepath) == 'images')
															<a href="{{asset($dos->filepath)}}" class="fancyboxLink">
														@elseif(setIconFile($dos->filepath) == 'pdf')
															<a class="fancybox-pdf" data-fancybox-type="iframe" href="http://docs.google.com/viewer?embedded=true&url={{asset(urlencode($dos->filepath))}}">
														@else
															<a href="https://docs.google.com/viewer?url={{asset(urlencode($dos->filepath))}}&embedded=true" class="fancyboxLinkDoc" data-fancybox-type="iframe">
														@endif								
															<span class="corner"></span>						
															@if(setIconFile($dos->filepath) == 'images')
																<div class="image">
																	<img alt="image" class="img-fluid" src="{{asset($dos->filepath)}}">
																</div>
															@endif	
															@if(setIconFile($dos->filepath) == 'pdf')
																<div class="icon">
																	<i class="fa fa-file-pdf"></i>
																</div>
															@endif	
															@if(setIconFile($dos->filepath) == 'doc')
																<div class="icon">
																	<i class="fa fa-file-word-o"></i>
																</div>
															@endif
															@if(setIconFile($dos->filepath) == 'excel')
																<div class="icon">
																	<i class="fa fa-file-excel-o"></i>
																</div>
															@endif	
															@if(setIconFile($dos->filepath) == 'file')
																<div class="icon">
																	<i class="fa fa-file"></i>
																</div>
															@endif		
															<div class="file-name">
																@php
																	$filename_eoi = $dos->filename;
																	$filename_eoi = preg_replace('/^(.*)\-\d{8,}\.(gif|jpg|png|pdf)$/', '$1.$2', $filename_eoi);
																@endphp
																<label style="text-transform:lowercase">{{str_limit($filename_eoi, 15)}}</label>
																<a class="pull-right" href="javascript:void(0)" onclick="delete_eoi_dossier({{$dos->prdEoiId}})">
																	<i class="fa fa-trash"></i>
																</a>
																<br>
																<small>{{$dos->created_at ? $dos->created_at->diffForHumans() : ""}}</small>
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
											<label for="title">@lang('app.table.eoi_dossier')</label>
											<div class="dropzone" id="eoi_dossier" multiple style="margin-bottom:25px">
												<div id="template" class="file-row"></div>
											</div>
										</div>
									</div>  
									<!-- fin eoi dossier -->
									<!-- lia dossier -->
									@if (count($liadossier) > 0)
									<div class="row">
										 <div class="col-lg-12">
											 <h5 style="font-weight:normal; font-size:17px; color:#718096">@lang('app.table.lia_dossier')</h5>
											 @foreach ( $liadossier as $dos )
											 <div class="file-box">
												<div class="file">
													@if(setIconFile($dos->filepath) == 'images')
														<a href="{{asset($dos->filepath)}}" class="fancyboxLink">
													@elseif(setIconFile($dos->filepath) == 'pdf')
														<a class="fancybox-pdf" target="_blank" data-fancybox-type="iframe" href="http://docs.google.com/viewer?embedded=true&url={{asset(urlencode($dos->filepath))}}">
													@else
														<a href="https://docs.google.com/viewer?url={{asset(urlencode($dos->filepath))}}&embedded=true" class="fancyboxLinkDoc" data-fancybox-type="iframe">
													@endif								
														<span class="corner"></span>						
														@if(setIconFile($dos->filepath) == 'images')
															<div class="image">
																<img alt="image" class="img-fluid" src="{{asset($dos->filepath)}}">
															</div>
														@endif	
														@if(setIconFile($dos->filepath) == 'pdf')
															<div class="icon">
																<i class="fa fa-file-pdf"></i>
															</div>
														@endif	
														@if(setIconFile($dos->filepath) == 'doc')
															<div class="icon">
																<i class="fa fa-file-word-o"></i>
															</div>
														@endif
														@if(setIconFile($dos->filepath) == 'excel')
															<div class="icon">
																<i class="fa fa-file-excel-o"></i>
															</div>
														@endif	
														@if(setIconFile($dos->filepath) == 'file')
															<div class="icon">
																<i class="fa fa-file"></i>
															</div>
														@endif		
														<div class="file-name">
															@php
																$filename_eoi = $dos->filename;
																$filename_eoi = preg_replace('/^(.*)\-\d{8,}\.(gif|jpg|png|pdf)$/', '$1.$2', $filename_eoi);
															@endphp
															<label style="text-transform:lowercase">{{str_limit($filename_eoi, 15)}}</label>
															<a class="pull-right" href="javascript:void(0)" onclick="delete_lia_dossier({{$dos->prdLiaId}})">
																<i class="fa fa-trash"></i>
															</a>
															<br>
															<small>{{$dos->created_at ? $dos->created_at->diffForHumans() : ""}}</small>
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
											<label for="title">@lang('app.table.lia_dossier')</label>
											<div class="dropzone" id="lia_dossier" multiple style="margin-bottom:25px">
												<div id="template" class="file-row"></div>
											</div>
										</div>
									</div>
									<!-- fin lia dossier -->
									
									<!-- photo produit -->
									<div class="row">
										@if($product->image_id != 0)
										<div class="col-lg-4">
											<div class="file-box" style="width:100% !important">
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
													<label>@lang('app.table.produit_image')</label>
												</div>
											</div>
										</div>
										@endif
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.table.produit_image')</label>
												<input name="image" class="form-control" type="file" accept="image/png, image/jpeg">
											</div>
										</div>
									</div>
									<!-- fin photo produit -->
									<div class="row">
										<div class="col-lg-12">
											<label class="chk_parking"> 
												<input type="checkbox" value="1" id="chk_parking" name="chk_parking" {{$product->avoir_parking_voie_public == 1 ? 'checked="checked"' : ''}}> @lang('app.form.product_parking_vPublic')
											</label>
										</div>
										<div class="col-lg-12">
											<div id="chk_picine">
												<label class="chk_picine"> 
													<input type="checkbox" value="1" name="chk_picine" {{$product->avoir_piscine == 1 ? 'checked="checked"' : ''}}> @lang('app.form.product_piscine')
												</label>
											</div>
										</div>
									</div>
								@endif
								<!-- fin categorie residentiel / ancien -->
								<!-- categorie foncier -->
								@if($product->category_id == 2)
									<div class="row">
										<div class="col-lg-4">
											<label for="title">@lang('app.input.prix') *</label>
											<div class="input-group" style="margin-bottom: 1.5rem;">
												<input type="number" class="form-control" name="simple_price" id="simple_price" value="{{$product->price}}">
												<div class="input-group-append">
													<span class="input-group-text">AUD</span>
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.form.programme_commission_type')</label>
												<select class="form-control" name="commision_product" id="commision_product">
													<option value="">Choisir...</option>
													<option value="Sales commission rate (%)" {{$product->commission_type == 'Sales commission rate (%)' ? 'selected' : ''}}>
														@lang('app.form.programme_commission_option1') (%)
													</option>
													<option value="Fixed commission ($)" {{$product->commission_type == 'Fixed commission ($)' ? 'selected' : ''}}>
														@lang('app.form.programme_commission_option2') ($)
													</option>
												</select>
											</div>
										</div>
										<div class="col-lg-4">
											<div id="commission_rate_prd" style="display:none">
												<div class="form-group">
													<label for="title">@lang('app.form.programme_taux_commission')</label>
													<div class="input-group m-b">
														<input type="number" class="form-control" name="sales_rate_product" id="sales_rate_product">
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
														<input type="number" class="form-control" name="rate_commission_product" id="rate_commission_product">
														<div class="input-group-append">
															<span class="input-group-text">AUD</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group" style="margin-bottom:1.5rem;">
												<label for="title">@lang('app.txt.avoir_bonus')</label>
												<select class="form-control" name="bonus_vente" id="bonus_vente">
													<option value="">Choisir...</option>
													<option value="YES" {{$product->avoir_bonus == 'YES' ? 'selected' : ''}}>@lang('app.txt.yes')</option>
													<option value="NO" {{$product->avoir_bonus == 'NO' ? 'selected' : ''}}>@lang('app.txt.no')</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6">
											<div id="montant_bonus_vente">
												<label for="title">@lang('app.txt.valeur_bonus') *</label>
												<div class="input-group" style="margin-bottom: 1.5rem;">
													<input type="number" class="form-control" value="{{$product->amount_bonus}}" name="bonus_amount" id="bonus_amount">
													<div class="input-group-append">
														<span class="input-group-text">AUD</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group" style="margin-bottom:1.5rem;">
												<label for="title">Surface *</label>
												<input type="number" name="surface_foncier" id="surface_foncier" value="{{$product->area}}" class="form-control">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group" style="margin-bottom:1.5rem;">
												<label for="title">Unité de surface *</label>
												<select class="form-control" name="unite_surface">
													<option value="m2" {{$product->unite_area == 'm2' ? 'selected' : ''}}>m2</option>
													<option value="Ha" {{$product->unite_area == 'Ha' ? 'selected' : ''}}>Ha</option>
												</select>
											</div>
										</div>
									</div>
									<!-- si fond dossier existe -->
									@if (count($dossier) > 0)
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
											<div class="dropzone" id="fond_dossier" multiple style="margin-bottom:25px">
												<div id="template" class="file-row"></div>
											</div>
										</div>
									</div>
									<!-- fin fond dossier -->
									
									<!-- si eoi dossier existe -->
									@if (count($eoidossier)>0)
									<div class="row">
										 <div class="col-lg-12">
											 <h5 style="font-weight:normal; font-size:17px; color:#718096">@lang('app.table.eoi_dossier')</h5>
											 @foreach ( $eoidossier as $dos )
												 <div class="file-box">
													<div class="file">
														@if(setIconFile($dos->filepath) == 'images')
															<a href="{{asset($dos->filepath)}}" class="fancyboxLink">
														@elseif(setIconFile($dos->filepath) == 'pdf')
															<a class="fancybox-pdf" data-fancybox-type="iframe" href="http://docs.google.com/viewer?embedded=true&url={{asset(urlencode($dos->filepath))}}">
														@else
															<a href="https://docs.google.com/viewer?url={{asset(urlencode($dos->filepath))}}&embedded=true" class="fancyboxLinkDoc" data-fancybox-type="iframe">
														@endif								
															<span class="corner"></span>						
															@if(setIconFile($dos->filepath) == 'images')
																<div class="image">
																	<img alt="image" class="img-fluid" src="{{asset($dos->filepath)}}">
																</div>
															@endif	
															@if(setIconFile($dos->filepath) == 'pdf')
																<div class="icon">
																	<i class="fa fa-file-pdf"></i>
																</div>
															@endif	
															@if(setIconFile($dos->filepath) == 'doc')
																<div class="icon">
																	<i class="fa fa-file-word-o"></i>
																</div>
															@endif
															@if(setIconFile($dos->filepath) == 'excel')
																<div class="icon">
																	<i class="fa fa-file-excel-o"></i>
																</div>
															@endif	
															@if(setIconFile($dos->filepath) == 'file')
																<div class="icon">
																	<i class="fa fa-file"></i>
																</div>
															@endif		
															<div class="file-name">
																@php
																	$filename_eoi = $dos->filename;
																	$filename_eoi = preg_replace('/^(.*)\-\d{8,}\.(gif|jpg|png|pdf)$/', '$1.$2', $filename_eoi);
																@endphp
																<label style="text-transform:lowercase">{{str_limit($filename_eoi, 15)}}</label>
																<a class="pull-right" href="javascript:void(0)" onclick="delete_eoi_dossier({{$dos->prdEoiId}})">
																	<i class="fa fa-trash"></i>
																</a>
																<br>
																<small>{{$dos->created_at ? $dos->created_at->diffForHumans() : ""}}</small>
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
											<label for="title">@lang('app.table.eoi_dossier')</label>
											<div class="dropzone" id="eoi_dossier" multiple style="margin-bottom:25px">
												<div id="template" class="file-row"></div>
											</div>
										</div>
									</div>  
									<!-- fin eoi dossier -->
									<!-- lia dossier -->
									@if (count($liadossier) > 0)
									<div class="row">
										 <div class="col-lg-12">
											 <h5 style="font-weight:normal; font-size:17px; color:#718096">@lang('app.table.lia_dossier')</h5>
											 @foreach ( $liadossier as $dos )
											 <div class="file-box">
												<div class="file">
													@if(setIconFile($dos->filepath) == 'images')
														<a href="{{asset($dos->filepath)}}" class="fancyboxLink">
													@elseif(setIconFile($dos->filepath) == 'pdf')
														<a class="fancybox-pdf" target="_blank" data-fancybox-type="iframe" href="http://docs.google.com/viewer?embedded=true&url={{asset(urlencode($dos->filepath))}}">
													@else
														<a href="https://docs.google.com/viewer?url={{asset(urlencode($dos->filepath))}}&embedded=true" class="fancyboxLinkDoc" data-fancybox-type="iframe">
													@endif								
														<span class="corner"></span>						
														@if(setIconFile($dos->filepath) == 'images')
															<div class="image">
																<img alt="image" class="img-fluid" src="{{asset($dos->filepath)}}">
															</div>
														@endif	
														@if(setIconFile($dos->filepath) == 'pdf')
															<div class="icon">
																<i class="fa fa-file-pdf"></i>
															</div>
														@endif	
														@if(setIconFile($dos->filepath) == 'doc')
															<div class="icon">
																<i class="fa fa-file-word-o"></i>
															</div>
														@endif
														@if(setIconFile($dos->filepath) == 'excel')
															<div class="icon">
																<i class="fa fa-file-excel-o"></i>
															</div>
														@endif	
														@if(setIconFile($dos->filepath) == 'file')
															<div class="icon">
																<i class="fa fa-file"></i>
															</div>
														@endif		
														<div class="file-name">
															@php
																$filename_eoi = $dos->filename;
																$filename_eoi = preg_replace('/^(.*)\-\d{8,}\.(gif|jpg|png|pdf)$/', '$1.$2', $filename_eoi);
															@endphp
															<label style="text-transform:lowercase">{{str_limit($filename_eoi, 15)}}</label>
															<a class="pull-right" href="javascript:void(0)" onclick="delete_lia_dossier({{$dos->prdLiaId}})">
																<i class="fa fa-trash"></i>
															</a>
															<br>
															<small>{{$dos->created_at ? $dos->created_at->diffForHumans() : ""}}</small>
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
											<label for="title">@lang('app.table.lia_dossier')</label>
											<div class="dropzone" id="lia_dossier" multiple style="margin-bottom:25px">
												<div id="template" class="file-row"></div>
											</div>
										</div>
									</div>
									<!-- fin lia dossier -->
									
									<!-- photo produit -->
									<div class="row">
										@if($product->image_id != 0)
										<div class="col-lg-4">
											<div class="file-box" style="width:100% !important">
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
													<label>@lang('app.table.produit_image')</label>
												</div>
											</div>
										</div>
										@endif
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.table.produit_image')</label>
												<input name="image" class="form-control" type="file" accept="image/png, image/jpeg">
											</div>
										</div>
									</div>
									<!-- fin photo produit -->
								<!-- fin categorie foncier -->
								@endif
								
								<!-- categorie industriel -->
								@if($product->category_id == 3)
									<div class="row">
										<div class="col-lg-4">
											<label for="title">@lang('app.input.prix') *</label>
											<div class="input-group" style="margin-bottom: 1.5rem;">
												<input type="number" class="form-control" name="simple_price" id="simple_price" value="{{$product->price}}">
												<div class="input-group-append">
													<span class="input-group-text">AUD</span>
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.form.programme_commission_type')</label>
												<select class="form-control" name="commision_product" id="commision_product">
													<option value="">Choisir...</option>
													<option value="Sales commission rate (%)" {{$product->commission_type == 'Sales commission rate (%)' ? 'selected' : ''}}>
														@lang('app.form.programme_commission_option1') (%)
													</option>
													<option value="Fixed commission ($)" {{$product->commission_type == 'Fixed commission ($)' ? 'selected' : ''}}>
														@lang('app.form.programme_commission_option2') ($)
													</option>
												</select>
											</div>
										</div>
										<div class="col-lg-4">
											<div id="commission_rate_prd" style="display:none">
												<div class="form-group">
													<label for="title">@lang('app.form.programme_taux_commission')</label>
													<div class="input-group m-b">
														<input type="number" class="form-control" name="sales_rate_product" id="sales_rate_product">
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
														<input type="number" class="form-control" name="rate_commission_product" id="rate_commission_product">
														<div class="input-group-append">
															<span class="input-group-text">AUD</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group" style="margin-bottom:1.5rem;">
												<label for="title">@lang('app.txt.avoir_bonus')</label>
												<select class="form-control" name="bonus_vente" id="bonus_vente">
													<option value="">Choisir...</option>
													<option value="YES" {{$product->avoir_bonus == 'YES' ? 'selected' : ''}}>@lang('app.txt.yes')</option>
													<option value="NO" {{$product->avoir_bonus == 'NO' ? 'selected' : ''}}>@lang('app.txt.no')</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6">
											<div id="montant_bonus_vente">
												<label for="title">@lang('app.txt.valeur_bonus') *</label>
												<div class="input-group" style="margin-bottom: 1.5rem;">
													<input type="number" class="form-control" value="{{$product->amount_bonus}}" name="bonus_amount" id="bonus_amount">
													<div class="input-group-append">
														<span class="input-group-text">AUD</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group" style="margin-bottom: 1.5rem;">
												<label for="title">@lang('app.txt.property_details') *</label>
												<textarea class="form-control" rows="4" name="property_detail">{{$product->property_detail}}</textarea>
											</div>
										</div>
									</div>
									<!-- si fond dossier existe -->
									@if (count($dossier) > 0)
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
											<div class="dropzone" id="fond_dossier" multiple style="margin-bottom:25px">
												<div id="template" class="file-row"></div>
											</div>
										</div>
									</div>
									<!-- fin fond dossier -->
									
									<!-- si eoi dossier existe -->
									@if (count($eoidossier)>0)
									<div class="row">
										 <div class="col-lg-12">
											 <h5 style="font-weight:normal; font-size:17px; color:#718096">@lang('app.table.eoi_dossier')</h5>
											 @foreach ( $eoidossier as $dos )
												 <div class="file-box">
													<div class="file">
														@if(setIconFile($dos->filepath) == 'images')
															<a href="{{asset($dos->filepath)}}" class="fancyboxLink">
														@elseif(setIconFile($dos->filepath) == 'pdf')
															<a class="fancybox-pdf" data-fancybox-type="iframe" href="http://docs.google.com/viewer?embedded=true&url={{asset(urlencode($dos->filepath))}}">
														@else
															<a href="https://docs.google.com/viewer?url={{asset(urlencode($dos->filepath))}}&embedded=true" class="fancyboxLinkDoc" data-fancybox-type="iframe">
														@endif								
															<span class="corner"></span>						
															@if(setIconFile($dos->filepath) == 'images')
																<div class="image">
																	<img alt="image" class="img-fluid" src="{{asset($dos->filepath)}}">
																</div>
															@endif	
															@if(setIconFile($dos->filepath) == 'pdf')
																<div class="icon">
																	<i class="fa fa-file-pdf"></i>
																</div>
															@endif	
															@if(setIconFile($dos->filepath) == 'doc')
																<div class="icon">
																	<i class="fa fa-file-word-o"></i>
																</div>
															@endif
															@if(setIconFile($dos->filepath) == 'excel')
																<div class="icon">
																	<i class="fa fa-file-excel-o"></i>
																</div>
															@endif	
															@if(setIconFile($dos->filepath) == 'file')
																<div class="icon">
																	<i class="fa fa-file"></i>
																</div>
															@endif		
															<div class="file-name">
																@php
																	$filename_eoi = $dos->filename;
																	$filename_eoi = preg_replace('/^(.*)\-\d{8,}\.(gif|jpg|png|pdf)$/', '$1.$2', $filename_eoi);
																@endphp
																<label style="text-transform:lowercase">{{str_limit($filename_eoi, 15)}}</label>
																<a class="pull-right" href="javascript:void(0)" onclick="delete_eoi_dossier({{$dos->prdEoiId}})">
																	<i class="fa fa-trash"></i>
																</a>
																<br>
																<small>{{$dos->created_at ? $dos->created_at->diffForHumans() : ""}}</small>
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
											<label for="title">@lang('app.table.eoi_dossier')</label>
											<div class="dropzone" id="eoi_dossier" multiple style="margin-bottom:25px">
												<div id="template" class="file-row"></div>
											</div>
										</div>
									</div>  
									<!-- fin eoi dossier -->
									<!-- lia dossier -->
									@if (count($liadossier) > 0)
									<div class="row">
										 <div class="col-lg-12">
											 <h5 style="font-weight:normal; font-size:17px; color:#718096">@lang('app.table.lia_dossier')</h5>
											 @foreach ( $liadossier as $dos )
											 <div class="file-box">
												<div class="file">
													@if(setIconFile($dos->filepath) == 'images')
														<a href="{{asset($dos->filepath)}}" class="fancyboxLink">
													@elseif(setIconFile($dos->filepath) == 'pdf')
														<a class="fancybox-pdf" target="_blank" data-fancybox-type="iframe" href="http://docs.google.com/viewer?embedded=true&url={{asset(urlencode($dos->filepath))}}">
													@else
														<a href="https://docs.google.com/viewer?url={{asset(urlencode($dos->filepath))}}&embedded=true" class="fancyboxLinkDoc" data-fancybox-type="iframe">
													@endif								
														<span class="corner"></span>						
														@if(setIconFile($dos->filepath) == 'images')
															<div class="image">
																<img alt="image" class="img-fluid" src="{{asset($dos->filepath)}}">
															</div>
														@endif	
														@if(setIconFile($dos->filepath) == 'pdf')
															<div class="icon">
																<i class="fa fa-file-pdf"></i>
															</div>
														@endif	
														@if(setIconFile($dos->filepath) == 'doc')
															<div class="icon">
																<i class="fa fa-file-word-o"></i>
															</div>
														@endif
														@if(setIconFile($dos->filepath) == 'excel')
															<div class="icon">
																<i class="fa fa-file-excel-o"></i>
															</div>
														@endif	
														@if(setIconFile($dos->filepath) == 'file')
															<div class="icon">
																<i class="fa fa-file"></i>
															</div>
														@endif		
														<div class="file-name">
															@php
																$filename_eoi = $dos->filename;
																$filename_eoi = preg_replace('/^(.*)\-\d{8,}\.(gif|jpg|png|pdf)$/', '$1.$2', $filename_eoi);
															@endphp
															<label style="text-transform:lowercase">{{str_limit($filename_eoi, 15)}}</label>
															<a class="pull-right" href="javascript:void(0)" onclick="delete_lia_dossier({{$dos->prdLiaId}})">
																<i class="fa fa-trash"></i>
															</a>
															<br>
															<small>{{$dos->created_at ? $dos->created_at->diffForHumans() : ""}}</small>
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
											<label for="title">@lang('app.table.lia_dossier')</label>
											<div class="dropzone" id="lia_dossier" multiple style="margin-bottom:25px">
												<div id="template" class="file-row"></div>
											</div>
										</div>
									</div>
									<!-- fin lia dossier -->
									
									<!-- photo produit -->
									<div class="row">
										@if($product->image_id != 0)
										<div class="col-lg-4">
											<div class="file-box" style="width:100% !important">
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
													<label>@lang('app.table.produit_image')</label>
												</div>
											</div>
										</div>
										@endif
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.table.produit_image')</label>
												<input name="image" class="form-control" type="file" accept="image/png, image/jpeg">
											</div>
										</div>
									</div>
									<!-- fin photo produit -->
								@endif
								<!-- fin categorie industriel -->
								<!-- categorie commercial -->
								@if($product->category_id == 4)
									<div class="row">
										<div class="col-lg-4">
											<label for="title">@lang('app.input.prix') *</label>
											<div class="input-group" style="margin-bottom: 1.5rem;">
												<input type="number" class="form-control" name="simple_price" id="simple_price" value="{{$product->price}}">
												<div class="input-group-append">
													<span class="input-group-text">AUD</span>
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.form.programme_commission_type')</label>
												<select class="form-control" name="commision_product" id="commision_product">
													<option value="">Choisir...</option>
													<option value="Sales commission rate (%)" {{$product->commission_type == 'Sales commission rate (%)' ? 'selected' : ''}}>
														@lang('app.form.programme_commission_option1') (%)
													</option>
													<option value="Fixed commission ($)" {{$product->commission_type == 'Fixed commission ($)' ? 'selected' : ''}}>
														@lang('app.form.programme_commission_option2') ($)
													</option>
												</select>
											</div>
										</div>
										<div class="col-lg-4">
											<div id="commission_rate_prd" style="display:none">
												<div class="form-group">
													<label for="title">@lang('app.form.programme_taux_commission')</label>
													<div class="input-group m-b">
														<input type="number" class="form-control" name="sales_rate_product" id="sales_rate_product">
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
														<input type="number" class="form-control" name="rate_commission_product" id="rate_commission_product">
														<div class="input-group-append">
															<span class="input-group-text">AUD</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group" style="margin-bottom:1.5rem;">
												<label for="title">@lang('app.txt.avoir_bonus')</label>
												<select class="form-control" name="bonus_vente" id="bonus_vente">
													<option value="">Choisir...</option>
													<option value="YES" {{$product->avoir_bonus == 'YES' ? 'selected' : ''}}>@lang('app.txt.yes')</option>
													<option value="NO" {{$product->avoir_bonus == 'NO' ? 'selected' : ''}}>@lang('app.txt.no')</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6">
											<div id="montant_bonus_vente">
												<label for="title">@lang('app.txt.valeur_bonus') *</label>
												<div class="input-group" style="margin-bottom: 1.5rem;">
													<input type="number" class="form-control" value="{{$product->amount_bonus}}" name="bonus_amount" id="bonus_amount">
													<div class="input-group-append">
														<span class="input-group-text">AUD</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<label for="title">Sales area *</label>
											<div class="input-group" style="margin-bottom: .5rem;">
												<input type="text" name="surface_commercial" id="surface_commercial" value="{{$product->area}}" class="form-control">
												<div class="input-group-append">
													<span class="input-group-text">.m2</span>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<label for="title">Customer parking *</label>
											<select class="form-control" name="type_cutomer_parking">
												<option value="">Choisir...</option>
												<option value="1" {{$product->avoir_parking_voie_public == 1 ? 'selected' : ''}}>Oui</option>
												<option value="0" {{$product->avoir_parking_voie_public == 0 ? 'selected' : ''}}>Non</option>
											</select>
										</div>
										<div class="col-md-4">
											<label for="title">Number of parking spots</label>
											<input type="number" class="form-control" value="{{$product->nb_parking_spots}}" name="nombre_cutomer_parking" />
										</div>
									</div>
									<!-- si fond dossier existe -->
									@if (count($dossier) > 0)
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
											<div class="dropzone" id="fond_dossier" multiple style="margin-bottom:25px">
												<div id="template" class="file-row"></div>
											</div>
										</div>
									</div>
									<!-- fin fond dossier -->
									
									<!-- si eoi dossier existe -->
									@if (count($eoidossier)>0)
									<div class="row">
										 <div class="col-lg-12">
											 <h5 style="font-weight:normal; font-size:17px; color:#718096">@lang('app.table.eoi_dossier')</h5>
											 @foreach ( $eoidossier as $dos )
												 <div class="file-box">
													<div class="file">
														@if(setIconFile($dos->filepath) == 'images')
															<a href="{{asset($dos->filepath)}}" class="fancyboxLink">
														@elseif(setIconFile($dos->filepath) == 'pdf')
															<a class="fancybox-pdf" data-fancybox-type="iframe" href="http://docs.google.com/viewer?embedded=true&url={{asset(urlencode($dos->filepath))}}">
														@else
															<a href="https://docs.google.com/viewer?url={{asset(urlencode($dos->filepath))}}&embedded=true" class="fancyboxLinkDoc" data-fancybox-type="iframe">
														@endif								
															<span class="corner"></span>						
															@if(setIconFile($dos->filepath) == 'images')
																<div class="image">
																	<img alt="image" class="img-fluid" src="{{asset($dos->filepath)}}">
																</div>
															@endif	
															@if(setIconFile($dos->filepath) == 'pdf')
																<div class="icon">
																	<i class="fa fa-file-pdf"></i>
																</div>
															@endif	
															@if(setIconFile($dos->filepath) == 'doc')
																<div class="icon">
																	<i class="fa fa-file-word-o"></i>
																</div>
															@endif
															@if(setIconFile($dos->filepath) == 'excel')
																<div class="icon">
																	<i class="fa fa-file-excel-o"></i>
																</div>
															@endif	
															@if(setIconFile($dos->filepath) == 'file')
																<div class="icon">
																	<i class="fa fa-file"></i>
																</div>
															@endif		
															<div class="file-name">
																@php
																	$filename_eoi = $dos->filename;
																	$filename_eoi = preg_replace('/^(.*)\-\d{8,}\.(gif|jpg|png|pdf)$/', '$1.$2', $filename_eoi);
																@endphp
																<label style="text-transform:lowercase">{{str_limit($filename_eoi, 15)}}</label>
																<a class="pull-right" href="javascript:void(0)" onclick="delete_eoi_dossier({{$dos->prdEoiId}})">
																	<i class="fa fa-trash"></i>
																</a>
																<br>
																<small>{{$dos->created_at ? $dos->created_at->diffForHumans() : ""}}</small>
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
											<label for="title">@lang('app.table.eoi_dossier')</label>
											<div class="dropzone" id="eoi_dossier" multiple style="margin-bottom:25px">
												<div id="template" class="file-row"></div>
											</div>
										</div>
									</div>  
									<!-- fin eoi dossier -->
									<!-- lia dossier -->
									@if (count($liadossier) > 0)
									<div class="row">
										 <div class="col-lg-12">
											 <h5 style="font-weight:normal; font-size:17px; color:#718096">@lang('app.table.lia_dossier')</h5>
											 @foreach ( $liadossier as $dos )
											 <div class="file-box">
												<div class="file">
													@if(setIconFile($dos->filepath) == 'images')
														<a href="{{asset($dos->filepath)}}" class="fancyboxLink">
													@elseif(setIconFile($dos->filepath) == 'pdf')
														<a class="fancybox-pdf" target="_blank" data-fancybox-type="iframe" href="http://docs.google.com/viewer?embedded=true&url={{asset(urlencode($dos->filepath))}}">
													@else
														<a href="https://docs.google.com/viewer?url={{asset(urlencode($dos->filepath))}}&embedded=true" class="fancyboxLinkDoc" data-fancybox-type="iframe">
													@endif								
														<span class="corner"></span>						
														@if(setIconFile($dos->filepath) == 'images')
															<div class="image">
																<img alt="image" class="img-fluid" src="{{asset($dos->filepath)}}">
															</div>
														@endif	
														@if(setIconFile($dos->filepath) == 'pdf')
															<div class="icon">
																<i class="fa fa-file-pdf"></i>
															</div>
														@endif	
														@if(setIconFile($dos->filepath) == 'doc')
															<div class="icon">
																<i class="fa fa-file-word-o"></i>
															</div>
														@endif
														@if(setIconFile($dos->filepath) == 'excel')
															<div class="icon">
																<i class="fa fa-file-excel-o"></i>
															</div>
														@endif	
														@if(setIconFile($dos->filepath) == 'file')
															<div class="icon">
																<i class="fa fa-file"></i>
															</div>
														@endif		
														<div class="file-name">
															@php
																$filename_eoi = $dos->filename;
																$filename_eoi = preg_replace('/^(.*)\-\d{8,}\.(gif|jpg|png|pdf)$/', '$1.$2', $filename_eoi);
															@endphp
															<label style="text-transform:lowercase">{{str_limit($filename_eoi, 15)}}</label>
															<a class="pull-right" href="javascript:void(0)" onclick="delete_lia_dossier({{$dos->prdLiaId}})">
																<i class="fa fa-trash"></i>
															</a>
															<br>
															<small>{{$dos->created_at ? $dos->created_at->diffForHumans() : ""}}</small>
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
											<label for="title">@lang('app.table.lia_dossier')</label>
											<div class="dropzone" id="lia_dossier" multiple style="margin-bottom:25px">
												<div id="template" class="file-row"></div>
											</div>
										</div>
									</div>
									<!-- fin lia dossier -->
									
									<!-- photo produit -->
									<div class="row">
										@if($product->image_id != 0)
										<div class="col-lg-4">
											<div class="file-box" style="width:100% !important">
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
													<label>@lang('app.table.produit_image')</label>
												</div>
											</div>
										</div>
										@endif
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">@lang('app.table.produit_image')</label>
												<input name="image" class="form-control" type="file" accept="image/png, image/jpeg">
											</div>
										</div>
									</div>
									<!-- fin photo produit -->
								@endif
								<!-- fin categorie commercial -->
								<button type="submit" class="btn btn-primary btn-lg pull-right" style="margin-top:2rem">
									<i class="fa fa-save"></i> @lang('app.form.product_btn_save')
								</button>
								<div style="clear:both"></div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('script')
	<!-- dropzone -->
	<script src="{{ asset('administrator/js/plugins/dropzone/dropzone.js') }}"></script>
	<script src="{{asset('administrator/plugins/ckeditor/ckeditor.js')}}"></script>	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
	<!-- Jquery Validate -->
	<script src="{{ asset('administrator/js/plugins/validate/jquery.validate.min.js') }}"></script>
	<script>
	Dropzone.autoDiscover = false;
	$(document).ready(function(){
		CKEDITOR.replace( 'desc_product' );
		set_type_programme($('#cat_programmme_id').val(),{{$product->type_id}});		
		$(".fancyboxLink").fancybox();
		$('#bonus_vente').on('change', function() {
			var type_bonus = this.value;
			if(type_bonus == 'YES'){
				$('#montant_bonus_vente').show();
			}else{
				$('#montant_bonus_vente').hide();
			}
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
		
		$("#eoi_dossier").dropzone({
			maxFiles: 25, 
			maxFilesize: 25,
			dictDefaultMessage: "@lang('app.txt.eoi_dossier')",
			url: "{{ route('AjaxEoiDossierEdit') }}",
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
		
		$("#lia_dossier").dropzone({
			maxFiles: 1, 
			maxFilesize: 25,
			dictDefaultMessage: "@lang('app.txt.lia_dossier')",
			url: "{{ route('AjaxLiaDossierEdit') }}",
			params: {"_token": "{{ csrf_token() }}","id_programme": "{{ $product->id }}"},
			acceptedFiles: ".pdf",
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
		var type_commission = '{{$product->commission_type}}';
		var nature_produit = '{{$product->natureBien}}';
		
		if(type_commission == 'Sales commission rate (%)'){
			$('#commission_rate_prd').show();
			$('#sales_rate_product').val({{$product->commision}});
		}else{
			$('#fixed_commission_prd').show();
			$('#rate_commission_product').val({{$product->commision}});
		}
		
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
		
		$('#productForm').validate({
			ignore: [],
			ignore: ":hidden",
			rules: {
				title: {
					required: true
				},
				type_id: {
					required: true
				},
				simple_price: {
					required: {
						depends: function(element) {
							if($("#natureBien").val() == 'Produit isolé'){
								return true;	
							}
						}
					},
					number: true
				},
				min_price: {
					required: {
						depends: function(element) {
							if($("#natureBien").val() == 'Programme immobilier'){
								return true;	
							}
						}
					},
					number: true
				},
				max_price: {
					required: {
						depends: function(element) {
							if($("#natureBien").val() == 'Programme immobilier'){
								return true;	
							}
						}
					},
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
				},
				type_cutomer_parking:{
					required: true
				}
			},
			messages: {
				title: {
					required: "@lang('app.txt.champobligatoire')"
				},
				type_id: {
					required: "@lang('app.txt.champobligatoire')"
				},
				min_price: {
					required: "@lang('app.txt.champobligatoire')"
				},
				max_price: {
					required: "@lang('app.txt.champobligatoire')",
					min: jQuery.validator.format("@lang('app.form.programme_validate_prix_max') {0}")
				},
				display_address: {
					required: "@lang('app.txt.champobligatoire')",
				},
				postalCode_product: {
					required: "@lang('app.txt.champobligatoire')",
				},
				interior_area: {
					required: "@lang('app.txt.champobligatoire')",
				},
				exterior_area: {
					required: "@lang('app.txt.champobligatoire')",
				},
				type_cutomer_parking:{
					required: "@lang('app.txt.champobligatoire')",
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
	
	function delete_eoi_dossier(id_eoi_dossier)
	{
		swal({
			title: "@lang('app.table.eoi_dossier')",
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
					url : "{{ route('ajaxDropEoiDossier') }}",
					type: "POST",
					dataType: "JSON",
					data:{"_token": "{{ csrf_token() }}",'id_eoi_dossier':id_eoi_dossier},
					success: function(data)
					{
						swal("@lang('app.table.eoi_dossier')", "@lang('app.dropzone.delete_fonds_yes')", "success");
						location.reload();	
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						swal("@lang('app.table.eoi_dossier')", "@lang('app.jquery.error_delete')", "error");
						location.reload();	
					}
				}); 
			} else {
				swal("@lang('app.table.eoi_dossier')", "@lang('app.jquery.delete_cancel')", "error");
			}
		 });
	}
	
	function delete_lia_dossier(id_lia_dossier)
	{
		swal({
			title: "@lang('app.table.lia_dossier')",
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
					url : "{{ route('ajaxDropLiaDossier') }}",
					type: "POST",
					dataType: "JSON",
					data:{"_token": "{{ csrf_token() }}",'id_lia_dossier':id_lia_dossier},
					success: function(data)
					{
						swal("@lang('app.table.lia_dossier')", "@lang('app.dropzone.delete_fonds_yes')", "success");
						location.reload();	
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						swal("@lang('app.table.lia_dossier')", "@lang('app.jquery.error_delete')", "error");
						location.reload();	
					}
				}); 
			} else {
				swal("@lang('app.table.lia_dossier')", "@lang('app.jquery.delete_cancel')", "error");
			}
		 });
	}
	</script>
@endpush