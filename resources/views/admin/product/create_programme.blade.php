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
                    <div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="title">Catégorie *</label>
								<select class="form-control" name="category_id" id="category_id">
									<option value="">Choisir...</option>
									@foreach(\App\Models\Category::all() as $category)
										<option value="{{$category->id}}">{{$category->title}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="title">Prix Minimal *</label>
								<input name="prix_min" id="prix_min" class="form-control" type="number" value="">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="title">Prix Maximal *</label>
								<input name="prix_max" id="prix_max" class="form-control" type="number" value="">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="title">Photo</label>
								<input name="image_programme" class="form-control" type="file">
							</div>
						</div>
					</div>
					<div class="row">     
						<div class="col-md-12">                              
							<div class="form-group">
								<label for="title">Titre *</label>
								<input name="title" id="title" class="form-control" type="text" value="">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="title">Description *</label>
						<textarea id="content" class="form-control" name="content"></textarea>
						<input type="hidden" name="type" value="{{$type}}" />
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
			
			$('#programmeForm').validate({
			    ignore: [],
				rules: {
					title: {
						required: true
					},
					category_id: {
						required: true
					},
					prix_min: {
						required: true
					},
					prix_max: {
						required: true
					},
					content: {
						required: true
					}
				},
				messages: {
					title: {
						required: "Champ obligatoire"
					},
					category_id: {
						required: "Champ obligatoire"
					},
					prix_min: {
						required: "Champ obligatoire"
					},
					prix_max: {
						required: "Champ obligatoire"
					},
					content: {
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