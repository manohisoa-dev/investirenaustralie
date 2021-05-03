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
							<div class="col-md-4">
								<div class="form-group">
									<label for="title">Prix Minimal *</label>
									<input name="prix_min" id="prix_min" class="form-control" type="number" value="">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="title">Prix Maximal *</label>
									<input name="prix_max" id="prix_max" class="form-control" type="number" value="">
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label for="title">Photo programme *</label>
									<input name="image_programme" class="form-control" type="file">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4">
								<div class="form-group">
									<label for="title">Type de produits *</label>
									<select class="form-control" name="type_id" id="type_id" style="width:100%">
										<option value="">Choisir...</option>
										@foreach(\App\Models\Type::all() as $ty)
											<option value="{{$ty->id}}">{{$ty->title}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-4">
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
							<div class="col-lg-4">
								<div class="form-group">
									<label for="title">Ville *</label>
									<input name="ville" id="ville" class="form-control" type="text">
								</div>  
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label for="title">Code postal *</label>
									<input name="postalCode" id="postalCode" class="form-control" type="text" value="">
								</div>
							</div>
							<div class="col-lg-4">
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
									<label for="title">Pays</label>
									<select class="form-control" name="countryId" id="countryId" style="width:100%">
										@foreach(\App\Models\Country::where('id',12)->get() as $country)
											<option value="{{$country->id}}">{{$country->content}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-8">                              
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
							<div class="col-lg-12">
								<label class="chk_firb"> 
									<input type="checkbox" value="" name="chk_firb"> The Seller certifies under their sole responsibilitythatthis property canbe sold to non-residentforeigners in accordance with Australian law and the rules applicable by the Foreign Investment Review Board (FIRB).
								</label>
							</div>
						</div>
					</div>                              
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Créer</button>
				
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('custom-script')
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

    <script>
        $(document).ready(function(){
            CKEDITOR.replace( 'description' );
			$("#category_id").select2();
			$("#type_id").select2();
			
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
						required: true
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
					ville: {
						required: true
					},
					postalCode: {
						required: true
					},
					state_id: {
						required: true
					},
					title_programme: {
						required: true
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
						required: "Champ obligatoire"
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
					ville: {
						required: "Champ obligatoire"
					},
					postalCode: {
						required: "Champ obligatoire"
					},
					state_id: {
						required: "Champ obligatoire"
					},
					title_programme: {
						required: "Champ obligatoire"
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
        }) ;
    </script>
@endsection