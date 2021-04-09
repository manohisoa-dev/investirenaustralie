@extends('admin.layouts.app')

@section('title', 'Products - Ajout ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Products</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Products</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.product.index') }}">Listes</a>
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
                <h5>Ajouter un nouveau Product</h5>
            </div>
            <div class="ibox-content">
                <form class="form-validation form-padding" action="{{ route('admin.product.store') }}" method="post">

                    {{ csrf_field() }}
                                                        
                    <div class="form-group">
						<label for="title">Titre</label>
						<input name="title" id="title" class="form-control" type="text" value="">
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="title">Catégorie</label>
								<select class="form-control" name="category_id" id="category_id">
									<option value="">Choisir...</option>
									@foreach(\App\Models\Category::all() as $category)
										<option value="{{$category->id}}">{{$category->title}}</option>
									@endforeach
								</select>
							</div>
						</div>  
						<div class="col-md-4">
							<div class="form-group">
								<label for="title">Type</label>
								<select class="form-control" name="type_id" id="type_id">
									<option value="">Choisir...</option>
									@foreach(\App\Models\Type::all() as $ty)
										<option value="{{$ty->id}}">{{$ty->title}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="title">Programme</label>
								<select class="form-control" name="parent_id" id="parent_id">
									<option value="">Choisir...</option>
									@foreach(\App\Models\Product::all() as $prd)
										<option value="{{$prd->id}}">{{$prd->title}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="title">Description</label>
						<textarea id="ckeditor" class="form-control" name="content"></textarea>
					</div> 
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="title">Quantité</label>
								<input name="quantity" id="quantity" class="form-control" type="number" value="">
							</div>
						</div> 
						<div class="col-md-6">
							<div class="form-group">
								<label for="title">Photo</label>
								<input name="photo" class="form-control" type="file">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="title">Prix</label>
								<input name="price" id="price" class="form-control" type="number" value="">
							</div>  
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="title">Devise</label>
								<select class="form-control" name="currency" id="currency">
									<option value="EUR">Euro</option>
									<option value="USD">Dollar</option>
									<option value="AUD">Dollar Australien</option>
								</select>
							</div>  
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="title">Surface</label>
								<input name="area" id="area" class="form-control" type="text" value="">
							</div>  
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="title">Espaces de carport</label>
								<input name="carport_spaces" id="carport_spaces" class="form-control" type="number" value="">
							</div>  
						</div>
					</div>  
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="title">Surface garage</label>
								<input name="garage_spaces" id="garage_spaces" class="form-control" type="number" value="">
							</div>  
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="title">Hors des espaces de la rue</label>
								<input name="off_street_spaces" id="off_street_spaces" class="form-control" type="number" value="">
							</div>  
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="title">Nombre de salles de bain</label>
								<input name="bathrooms" id="bathrooms" class="form-control" type="number" value="">
							</div>  
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="title">Nombre de chambre</label>
								<input name="bedrooms" id="bedrooms" class="form-control" type="number" value="">
							</div>  
						</div>
					</div>    
					<div class="row">						
						<div class="col-md-3">
							<div class="form-group">
								<label for="title">Nombre de suite</label>
								<input name="ensuite" id="ensuite" class="form-control" type="number" value="">
							</div>  
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="title">Aire d'atterrissage</label>
								<input name="land_area" id="land_area" class="form-control" type="number" value="">
							</div>  
						</div>						
						<div class="col-md-3">
							<div class="form-group">
								<label for="title">Surface de plancher</label>
								<input name="floor_area" id="floor_area" class="form-control" type="number" value="">
							</div>  
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="title">Nombre d'étages</label>
								<input name="number_of_floors" id="number_of_floors" class="form-control" type="number" value="">
							</div>  
						</div>
					</div>    
					<div class="row">						
						<div class="col-md-3">
							<div class="form-group">
								<label for="title">Nouvelle construction</label>
								<select class="form-control" name="new_construction" id="new_construction">
									<option value="0">OUI</option>
									<option value="0">NON</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="title">Année de construction</label>
								<input name="year_built" id="year_built" class="form-control" type="number" value="">
							</div>    
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="title">Adresse</label>
								<input name="display_address" id="display_address" class="form-control" type="text" value="">
							</div>    
						</div>
					</div> 
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="title">Pays</label>
								<select class="form-control" name="state_id" id="state_id">
									<option value="">Choisir...</option>
									@foreach(\App\Models\State::all() as $state)
										<option value="{{$state->id}}">{{$state->content}}</option>
									@endforeach
								</select>
							</div>
						</div>						
						<div class="col-md-3">
							<div class="form-group">
								<label for="title">Type location</label>
								<input name="location_type_id" id="location_type_id" class="form-control" type="number" value="">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="title">Code postal</label>
								<input name="postalCode" id="postalCode" class="form-control" type="text" value="">
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
            CKEDITOR.replace( 'content' );
			$("#category_id").select2();
        }) ;
    </script>
@endsection