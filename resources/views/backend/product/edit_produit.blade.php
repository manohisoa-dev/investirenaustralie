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
								
								@if($product->category_id == 1)
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label for="title">@lang('app.form.programme_commencement_dt') *</label>
											<input type="text" name="commencement_dt" id="commencement_dt" value="{{$product->commencement_dt}}" class="form-control date_month_year" />
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="title">@lang('app.form.estimated_delivery_dt') *</label>
											<input type="text" name="estimated_delvivery_dt" id="estimated_delvivery_dt" class="form-control date_month_year" value="{{$product->estimated_delvivery_dt}}"/>
										</div>
									</div>
								</div>	
								@endif
									
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
											<label for="title">@lang('app.form.programme_adresse') *</label>
											<input name="display_address" id="display_address" class="form-control" type="text" value="{{$product->display_address}}">
											<input type="hidden" name="long" id="long" value="{{$localisation ? $localisation->longitude:''}}" />
											<input type="hidden" name="lat" id="lat" value="{{$localisation ? $localisation->latitude:''}}" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label for="title">@lang('app.form.programme_ville') *</label>
											<input name="ville_product" id="ville_product" class="form-control" type="text" value="{{$localisation ? $localisation->locality:''}}" readonly="">
										</div>  
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="title">@lang('app.form.programme_cp') *</label>
											<input name="postalCode_product" id="postalCode_product" class="form-control" type="text" value="{{$product->postalCode}}" readonly="">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label for="title">@lang('app.form.programme_suburb') *</label>
											<input name="suburb_product" id="suburb_product" class="form-control" type="text" value="{{$localisation ? $localisation->area_level_2:''}}" readonly="">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="title">@lang('app.form.programme_etat') *</label>
											<input type="text" name="state_id" id="state_id" class="form-control" value="{{$localisation?$localisation->area_level_1:''}}" readonly="" />
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
								<!-- pour les catégorie résidentiel -->
								@if($product->category_id == 1)
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
									<div class="row">
										<div class="col-lg-6">
											<label for="title">@lang('app.input.prix') *</label>
											<div class="input-group" style="margin-bottom: 1.5rem;">
												<input type="number" min="0" class="form-control" name="simple_price" id="simple_price" value="{{$product->price}}">
												<div class="input-group-append">
													<span class="input-group-text">AUD</span>
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
											<div id="montant_bonus_vente">
												<label for="title">@lang('app.txt.valeur_bonus') *</label>
												<div class="input-group" style="margin-bottom: .5rem;">
													<input type="number" min="0" class="form-control" value="{{$product->amount_bonus}}" name="bonus_amount" id="bonus_amount">
													<div class="input-group-append">
														<span class="input-group-text">AUD</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-lg-6">
											<label for="title">@lang('app.form.product_jardin_space')</label>
											<div class="input-group" style="margin-bottom: .5rem;">
												<input type="number" min="0" class="form-control" name="superficie_jardin" id="superficie_jardin" value="{{$product->superficie_jardin}}">
												<div class="input-group-append">
													<span class="input-group-text">.m2</span>
												</div>
											</div>
										</div>	
										@if($product->ancienneteBien == 'Ancien')							
										<div class="col-lg-6">							
											<div class="form-group">
												<label for="title">@lang('app.form.product_anneeConstruct') *</label>
												<input name="year_built" id="year_built" class="form-control" type="number" min="0" value="{{$product->year_built}}">
											</div>
										</div>	
										@endif										
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label for="title">@lang('app.input.nbchambre')</label>
												<input name="bedrooms" id="bedrooms" class="form-control" type="number" min="0" value="{{$product->bedrooms}}">
											</div>  
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label for="title">@lang('app.input.nbchambresuite')</label>
												<input name="ensuite" id="ensuite" class="form-control" type="number" min="0" value="{{$product->ensuite}}">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label for="title">@lang('app.input.nbsalledebain')</label>
												<input name="bathrooms" id="bathrooms" class="form-control" type="number" min="0" value="{{$product->bathrooms}}">
											</div> 
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label for="title">@lang('app.form.product_qte')</label>
												<input name="quantity" id="quantity" class="form-control" type="number" min="0" value="{{$product->quantity}}" min="1">
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
										<div class="col-lg-6">
											<div class="form-group">
												<label for="title">@lang('app.form.product_parking_ferme')</label>
												<input name="garage_spaces" id="garage_spaces" class="form-control" type="number" min="0" value="{{$product->garage_spaces}}">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label for="title">@lang('app.form.product_parking_carpot')</label>
												<input name="carport_spaces" id="carport_spaces" class="form-control" type="number" min="0" value="{{$product->carport_spaces}}">
											</div>
										</div>
									</div>
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
											 <input type="hidden" name="mandat_recActive" id="mandat_recActive" value="{{$liadossier?$liadossier[0]->image_id:''}}" />
											 <input type="hidden" name="id_mandatActive" id="id_mandatActive" value="{{$liadossier?$liadossier[0]->prdLiaId:''}}" />
											 <div id="salesMandates"></div>
										 </div>
									</div>   
									@endif 
									<!-- fin lia dossier -->
									<!-- photo produit -->
									@if (count($photos) > 0)
									<div class="row">
										<div class="col-lg-12">
										<h5>@lang('app.table.produit_image')</h5>
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
									<div class="row" style="margin-bottom:15px">
										<div class="col-lg-12">
											<label for="title">@lang('app.table.produit_image')</label>
											<div class="dropzone" id="pictures_upload"></div>
										</div>
									</div>  
									<!-- fin photo produit -->
								@endif
								<!-- fin pour les catégorie résidentiel -->
								<!-- categorie foncier -->
								@if($product->category_id == 2)
									<div class="row">
										<div class="col-lg-4">
											<label for="title">@lang('app.input.prix') *</label>
											<div class="input-group" style="margin-bottom: 1.5rem;">
												<input type="number" min="0" class="form-control" name="simple_price" id="simple_price" value="{{$product->price}}">
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
													<input type="number" min="0" class="form-control" value="{{$product->amount_bonus}}" name="bonus_amount" id="bonus_amount">
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
												<input type="number" min="0" name="surface_foncier" id="surface_foncier" value="{{$product->area}}" class="form-control">
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
											 <input type="hidden" name="mandat_recActive" id="mandat_recActive" value="{{$liadossier?$liadossier[0]->image_id:''}}" />
											 <input type="hidden" name="id_mandatActive" id="id_mandatActive" value="{{$liadossier?$liadossier[0]->prdLiaId:''}}" />
											 <div id="salesMandates"></div>
										 </div>
									</div>   
									@endif 
									<!-- fin lia dossier -->
									
									<!-- photo produit -->
									@if (count($photos) > 0)
										<div class="row">
											<div class="col-lg-12">
											<h5>@lang('app.table.produit_image')</h5>
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
									<div class="row" style="margin-bottom:15px">
										<div class="col-lg-12">
											<label for="title">@lang('app.table.produit_image')</label>
											<div class="dropzone" id="pictures_upload"></div>
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
												<input type="number" min="0" class="form-control" name="simple_price" id="simple_price" value="{{$product->price}}">
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
													<input type="number" min="0" class="form-control" value="{{$product->amount_bonus}}" name="bonus_amount" id="bonus_amount">
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
											 <input type="hidden" name="mandat_recActive" id="mandat_recActive" value="{{$liadossier?$liadossier[0]->image_id:''}}" />
											 <input type="hidden" name="id_mandatActive" id="id_mandatActive" value="{{$liadossier?$liadossier[0]->prdLiaId:''}}" />
											 <div id="salesMandates"></div>
										 </div>
									</div>   
									@endif 
									<!-- fin lia dossier -->
									
									<!-- photo produit -->
									@if (count($photos) > 0)
										<div class="row">
											<div class="col-lg-12">
											<h5>@lang('app.table.produit_image')</h5>
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
									<div class="row" style="margin-bottom:15px">
										<div class="col-lg-12">
											<label for="title">@lang('app.table.produit_image')</label>
											<div class="dropzone" id="pictures_upload"></div>
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
												<input type="number" min="0" class="form-control" name="simple_price" id="simple_price" value="{{$product->price}}">
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
													<input type="number" min="0" class="form-control" value="{{$product->amount_bonus}}" name="bonus_amount" id="bonus_amount">
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
											<input type="number" min="0" class="form-control" value="{{$product->nb_parking_spots}}" name="nombre_cutomer_parking" />
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
											 <input type="hidden" name="mandat_recActive" id="mandat_recActive" value="{{$liadossier?$liadossier[0]->image_id:''}}" />
											 <input type="hidden" name="id_mandatActive" id="id_mandatActive" value="{{$liadossier?$liadossier[0]->prdLiaId:''}}" />
											 <div id="salesMandates"></div>
										 </div>
									</div>   
									@endif
									<!-- fin lia dossier -->
									
									<!-- photo produit -->
									@if (count($photos) > 0)
										<div class="row">
											<div class="col-lg-12">
											<h5>@lang('app.table.produit_image')</h5>
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
									<div class="row" style="margin-bottom:15px">
										<div class="col-lg-12">
											<label for="title">@lang('app.table.produit_image')</label>
											<div class="dropzone" id="pictures_upload"></div>
										</div>
									</div>
									<!-- fin photo produit -->
								@endif
								<!-- fin categorie commercial -->
								<hr>
								<div class="row">
									<div class="form-group">
										<h4 class="new-programme-solicitor">@lang('app.form.programme_solicitor')</h4>
									</div>
								</div>
								<div id="solicitorExistant">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<select class="form-control" name="solicitor_id" id="solicitor_id" style="width:100%">
													<option value="">@lang('app.form.choix_txt')</option>
													@foreach($solicitors as $solicitor)
														<option value="{{$solicitor->id}}" {{$solicitor->id == $product->solicitor_id?'selected="selected"':''}}>
															{{$solicitor->cabinet_name}}
														</option>
													@endforeach
													<option value="new">Créer nouveau solicitor</option>
												</select>
											</div> 
										</div>
									</div>
								</div>
								
								<div id="newSolicitor" style="display:none">
									<div class="row">						
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">Nom du cabinet *</label>
												<input name="cabinet_name" id="cabinet_name" class="form-control" type="text" value="{{ old('cabinet_name')?old('cabinet_name'):'' }}">
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">Email cabinet *</label>
												<input name="cabinet_email" id="cabinet_email" class="form-control" type="email" value="{{ old('cabinet_email')?old('cabinet_email'):'' }}">
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="title">Tel *</label>
												<input name="cabinet_phone" id="cabinet_phone" class="form-control" type="text" value="{{ old('cabinet_phone')?old('cabinet_phone'):'' }}">
											</div>
										</div>
									</div>
								</div>
								<hr>
								
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
	<style>
	.ui-datepicker-calendar {
    	display: none;
    }
	</style>
	<!-- dropzone -->
	<script src="{{ asset('administrator/js/plugins/dropzone/dropzone.js') }}"></script>
	<script src="{{asset('administrator/plugins/ckeditor/ckeditor.js')}}"></script>	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
	<!-- Jquery Validate -->
	<script src="{{ asset('administrator/js/plugins/validate/jquery.validate.min.js') }}"></script>
	
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2izG_M7K3gP6pFUH5cyzmDjuGpOYfgc4&libraries=places&callback=initMap&channel=GMPSB_addressselection_v1_cABC" async defer></script>
<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2izG_M7K3gP6pFUH5cyzmDjuGpOYfgc4&libraries=places&callback=initMap"></script>-->
	<script>
	// display_address
	function initMap(){
		var autocomplete = new google.maps.places.Autocomplete($("#display_address")[0], {});
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
				$('#state_id').val(itemState);
				set_mandat_state(itemState,0);
			});
		});
	}
	</script>

	<script>
	Dropzone.autoDiscover = false;
	$(document).ready(function(){
		CKEDITOR.replace( 'desc_product' );
		set_type_programme($('#cat_programmme_id').val(),{{$product->type_id}});		
		$(".fancyboxLink").fancybox();
		
		var itemState = $('#state_id').val();
		var mandatActive = $('#mandat_recActive').val();
		set_mandat_state(itemState,mandatActive);
		set_type_programme($('#cat_programmme_id').val(),{{$product->type_id}});
		
		$('#bonus_vente').on('change', function() {
			var type_bonus = this.value;
			if(type_bonus == 'YES'){
				$('#montant_bonus_vente').show();
			}else{
				$('#montant_bonus_vente').hide();
			}
		});
		
		$('#solicitor_id').on('change',function(){
			var choix_solicitor = $(this).val();
			if(choix_solicitor == 'new'){
				$('#newSolicitor').show();
			}else{
				$('#newSolicitor').hide();
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
		
		$("#pictures_upload").dropzone({
			maxFiles: 20, 
			maxFilesize: 20,
			dictDefaultMessage: "@lang('app.dropzone.libelle_product')",
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
				},
				sales_mandate:{
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
		   data: {"_token": "{{ csrf_token() }}","categoryId": categorie_id, "type_id_active": type_id_active,"cat":1},
		   success:function(data) {
		   	  console.log(data);
			  //$('#type_id').html(data);
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
	
	function set_mandat_state(state,active)
	{
		loadingPage();
		$.ajax({
			type:'POST',
			url:"{{ route('ajaxSetMandatState') }}",
			data: {"_token": "{{ csrf_token() }}","state": state,"Mactive":active},
			success:function(data) {
				$('#salesMandates').html(data);
				stopLoadingPage();
			}
		});
	}
	</script>
@endpush