@extends('admin.layouts.app')

@section('title', 'Pubs - Edition ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Publicités</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Publicités</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.pub.index') }}">Listes</a>
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
<style>
.fileupload-preview img{width:100%}
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Mise à jour Publicités : {{$pub->title}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('admin.pub.index')}}/{{$pub->id}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field("PUT") }}
					<div class="form-group">
						<label for="links">@lang('app.admin.title')</label>
						<input name="title" id="title" class="form-control" type="text" value="{{$pub->title}}">
					</div>                                            
					<div class="form-group">
						<label for="links">@lang('app.admin.link')</label>
						<input name="links" id="links" class="form-control" type="text" value="{{$pub->links}}">
					</div>
					<div class="form-group">
						<label for="content">@lang('app.admin.content')</label>
						<textarea name="content" id="content">{{$pub->content}}</textarea>
					</div>  
					<div class="form-group">
						<label for="title">@lang('app.admin.page')</label>
						<select class="form-control" name="page[]" id="page" multiple="multiple">
							@foreach($pages as $page)
								<option value="{{$page->id}}" {{in_array($page->id, $pageIds)?'selected="selected"':''}}> {{$page->title}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<div class="well well-nice inline">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="fileupload-preview thumbnail" style="width: 200px; height: 120px;">
											<img src="{{$pub->imageUrl()}}" style="width:100%">
										</div>
										<div> 
											<span class="btn btn-file"> 
												<span class="fileupload-new">@lang('app.admin.file.select')</span> 
												<span class="fileupload-exists">@lang('app.admin.file.change')</span>
												<input type="file" name="image" id="file">
											</span> 
											<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">@lang('app.admin.file.remove')</a> 
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
							
							</div>
						</div>
					</div>                                                                                                                                                
                    <button type="submit" class="btn btn-primary btn-lg">
						<i class="fa fa-save"></i> @lang('app.btn.save')
					</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-script')
    <script src="{{asset('administrator/plugins/ckeditor/ckeditor.js')}}"></script>
	<script src="{{asset('administrator/plugins/bootstrap-fileupload/js/bootstrap-fileupload.js')}}"></script>
    <script>
        $(document).ready(function(){
            CKEDITOR.replace('content');
			$("#page").select2();
        }) ;
    </script>
@endsection
