@extends('admin.layouts.app')

@section('title', 'Menus - Edition ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.menus')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.txt.menus')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdmin()?route('admin.menu.index'):route('admin.collaborators.admin.menu.index') }}">@lang('app.txt.lists')</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.editing')</strong>
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
                <h5>@lang('app.txt.update_menu' , ['menu'=>$menu->menu])</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ Auth::user()->isAdmin()?route('admin.menu.index'):route('admin.collaborators.admin.menu.index')}}/{{$menu->id}}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field("PUT") }}
					<div class="form-group">
						<label for="libelle">@lang('app.txt.label')</label>
						<input name="libelle" id="libelle" class="form-control" type="text" value="{{$menu->libelle}}" readonly="">
					</div>
                    <div class="form-group">
						<div class="row">
							<div class="col-md-2">
								<img src="{{asset('images/slider/'.$menu->photo)}}" style="height:80px" /><br />
							</div>
							<div class="col-md-4">								
								<label for="parent_id">@lang('app.admin.menu.photoBack') <small><i>(@lang('app.txt.recommended_resolution', ['res'=>'2000 X 800px']))</i></small></label>
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
									@foreach($menus as $val)
										<option value="{{$val->id}}" {{$val->id==$menu->parent_id?'selected':''}}> {{$val->libelle}}</option>
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
