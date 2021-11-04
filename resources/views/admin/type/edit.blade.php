@extends('admin.layouts.app')

@section('title', 'Types - Edition ')

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
                <h5>Mise à jour Type : {{$type->slug}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('admin.type.index')}}/{{$type->id}}" method="post" id="formType">

                    {{ csrf_field() }}

                    {{ method_field("PUT") }}
                    <div class="form-group">
						<label for="title">@lang('app.table.type') *</label>
						<input name="title" id="title" class="form-control" type="text" value="{{$type->title}}">
					</div>
					<div class="form-group">
						<label for="title">@lang('app.table.type') En*</label>
						<input name="title_en" id="title_en" class="form-control" type="text" value="{{$type->title_en}}">
					</div>
                    <div class="form-group">
						<label>@lang('app.select_category') *</label> 
						<select class="form-control" name="categories_id" id="categories_id">
							<option value="">Choisir...</option>
							@foreach($categories as $category)
								<option value="{{$category->id}}" {{$type->categories_id == $category->id ?'selected="selected"':''}}> {{$category->title}}</option>
							@endforeach
						</select>
					</div>   
					<div class="form-group">
						<label>Produit autonome seulement *</label> 
						<select class="form-control" name="is_autonome" id="is_autonome">
							<option value="0" {{$type->is_autonome == 0 ?'selected="selected"':''}}>NON</option>
							<option value="1" {{$type->is_autonome == 1 ?'selected="selected"':''}}>OUI</option>
						</select>
					</div>                                                                                                                                             
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Enregistrer</button>

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
				}
			});
        }) ;
    </script>
@endsection

