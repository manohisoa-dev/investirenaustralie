@extends('admin.layouts.app')

@section('title', 'Types - Ajout ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Types</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Types</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.type.index'):route('admin.type.index') }}">Listes</a>
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
                <h5>Ajouter un nouveau Type</h5>
            </div>
            <div class="ibox-content">
                <form class="form-validation form-padding" action="{{ route('admin.type.store') }}" method="post" id="formType">

                    {{ csrf_field() }}                               
                    <div class="form-group">
						<label for="title">@lang('app.table.type') *</label>
						<input name="title" id="title" class="form-control" type="text" value="">
					</div>
                    <div class="form-group">
						<label>@lang('app.select_category') *</label> 
						<select class="form-control" name="categories_id" id="categories_id">
							<option value="">Choisir...</option>
							@foreach($categories as $category)
								<option value="{{$category->id}}"> {{$category->title}}</option>
							@endforeach
						</select>
					</div>                                                                                    
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Créer</button>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom-script')
    <script>
        $(document).ready(function(){
			$('#formType').validate({
			    ignore: [],
				rules: {
					title: {
						required: true
					},
					categories_id: {
						required: true
					}
				},
				messages: {
					title: {
						required: "@lang('app.txt.champobligatoire')"
					},
					categories_id: {
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
    </script>
@endsection

