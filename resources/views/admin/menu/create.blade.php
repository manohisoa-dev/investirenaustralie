@extends('admin.layouts.app')

@section('title', 'Menus - Ajout ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.menus')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.txt.menus')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdmin()?route('admin.menu.index'):route('admin.collaborators.admin.menu.index') }}">
					@lang('app.txt.lists')
				</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.add')</strong>
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
                <h5>@lang('app.txt.add_new_menu')</h5>
            </div>
            <div class="ibox-content">
                <form class="form-validation form-padding" id="menuForm" action="{{ Auth::user()->isAdmin()?route('admin.menu.store'):route('admin.collaborators.admin.menu.store') }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                                                        
                    {!! \Nvd\Crud\Form::input('libelle','text')->show() !!}
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<label for="parent_id">@lang('app.admin.menu.photoBack') <small><i>(Résolution recommandée : 2000 X 800px)</i></small></label>
								<div class="input-group">
									<div class="custom-file">
										<input id="inputGroupFile01" type="file" name="photo" class="custom-file-input" accept="image/*">
										<label class="custom-file-label" for="inputGroupFile01">@lang('app.admin.file.select')</label>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<label for="parent_id">@lang('app.admin.menu.libMenuParent')</label>
								<select class="form-control" name="parent_id">
									<option value="0">@lang('app.txt.aucun')</option>
									@foreach($menus as $menu)
										<option value="{{$menu->id}}"> {{$menu->libelle}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>                                                                                    
                    <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> @lang('app.btn.save')</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom-script')
<script src="{{asset('administrator/js/plugins/bs-custom-file/bs-custom-file-input.min.js')}}"></script>
<script>
	$(document).ready(function(){
		bsCustomFileInput.init();
		$('#menuForm').validate({
			rules: {
				menu: {
					required: true
				},
				menu_photo: {
					required: true
				},
				parent_id: {
					required: true
				}
			},
			messages: {
				menu: {
					required: "@lang('app.txt.champobligatoire')"
				},
				menu_photo: {
					required: "@lang('app.txt.champobligatoire')"
				},
				parent_id: {
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
	}) ;
</script>
@endsection
