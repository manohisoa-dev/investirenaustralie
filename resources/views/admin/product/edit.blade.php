@extends('admin.layouts.app')

@section('title', 'Products - Edition ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Products</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Produits</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.product.index') }}">Listes</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Edition</strong>
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
                <h5>Mise à jour Produit : {{$product->reference}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('admin.product.index')}}/{{$product->id}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field("PUT") }}
                    <div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Choisir programme *</label>
								<select class="form-control" name="parent_id" id="parent_id">
									@foreach(\App\Models\Product::where('parent_id',0)->get() as $prd)
										<option value="{{$prd->id}}" {{$product->parent_id == $prd->id ? 'selected' : ''}}>{{$prd->title}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="title">Titre du produit *</label>
								<input name="title_product" id="title_product" class="form-control" type="text" value="{{$product->title}}">
							</div>
						</div>
					</div>                                                                           
                    <div class="row">     
						<div class="col-lg-12">                              
							<div class="form-group">
								<label for="title">Description produit *</label>
								<textarea class="form-control" rows="10" name="desc_product" id="desc_product">{{$product->content}}</textarea>
							</div>
						</div>
					</div>        
                    
					<div class="row">
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Type *</label>
								<select class="form-control" name="type_id" id="type_id" style="width:100%">
									<option value="">Choisir...</option>
									@foreach(\App\Models\Type::all() as $ty)
										<option value="{{$ty->id}}" {{$product->type_id == $ty->id ? 'selected' : ''}}>{{$ty->title}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Quantité</label>
								<input name="quantity" id="quantity" class="form-control" type="number" value="{{$product->quantity}}">
							</div>  
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Prix</label>
								<input name="price" id="price" class="form-control" type="number" value="{{$product->price}}">
							</div>  
						</div>							
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Devise</label>
								<select class="form-control" name="currency" id="currency">
									<option value="EUR" {{$product->currency == 'EUR' ? 'selected' : ''}}>Euro</option>
									<option value="USD" {{$product->currency == 'USD' ? 'selected' : ''}}>Dollar</option>
									<option value="AUD" {{$product->currency == 'AUD' ? 'selected' : ''}}>Dollar Australien</option>
								</select>
							</div>  
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Photo</label>
								<input name="image" class="form-control" type="file">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Statuts</label>
								<select class="form-control" name="status" id="status">
									<option value="published" {{$product->status == 'published' ? 'selected' : ''}}>Publier</option>
									<option value="archived" {{$product->status == 'archived' ? 'selected' : ''}}>Archivé</option>
								</select>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Surface *</label>
								<input name="area" id="area" class="form-control" type="text" value="{{$product->area}}">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Espaces de carport</label>
								<input name="carport_spaces" id="carport_spaces" class="form-control" type="number" value="{{$product->carport_spaces}}">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Surface intérieur</label>
								<input name="interior_area" id="interior_area" class="form-control" type="number" value="{{$product->interior_area}}">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Surface extérieur</label>
								<input name="exterior_area" id="exterior_area" class="form-control" type="number" value="{{$product->exterior_area}}">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Surface total</label>
								<input name="total_area" id="total_area" class="form-control" type="number" value="{{$product->total_area}}">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Unités garage</label>
								<input name="garage_spaces" id="garage_spaces" class="form-control" type="number" value="{{$product->garage_spaces}}">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Nombre d'étages</label>
								<input name="number_of_floors" id="number_of_floors" class="form-control" type="number" value="0">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Nombre de sweet</label>
								<input name="ensuite" id="ensuite" class="form-control" type="number" value="0">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Nombre de salles de bain</label>
								<input name="bathrooms" id="bathrooms" class="form-control" type="number" value="0">
							</div> 
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Nombre de chambre</label>
								<input name="bedrooms" id="bedrooms" class="form-control" type="number" value="0">
							</div>  
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Etat</label>
								<select class="form-control" name="state_id" id="state_id" style="width:100%">
									@foreach(\App\Models\State::all() as $state)
										<option value="{{$state->id}}">{{$state->content}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Code postal</label>
								<input name="postalCode" id="postalCode" class="form-control" type="text" value="">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Nouvelle construction</label>
								<select class="form-control" name="new_construction" id="new_construction">
									<option value="0">OUI</option>
									<option value="1">NON</option>
								</select>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Année de construction</label>
								<input name="year_built" id="year_built" class="form-control" type="number" value="0">
							</div>
						</div>							
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label for="title">Adresse *</label>
								<input name="display_address" id="display_address" class="form-control" type="text" value="">
							</div>
						</div>
					</div>                                                                                                                           
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Enregistrer</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
	<script src="{{asset('administrator/plugins/ckeditor/ckeditor.js')}}"></script>
	<script>
	$(document).ready(function(){
		CKEDITOR.replace( 'desc_product' );
	});
	</script>
@endsection
