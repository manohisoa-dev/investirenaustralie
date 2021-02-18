@extends('admin.layouts.app')

@section('title', 'Blogs - Edition ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Blogs</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Blogs</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.blog.index') }}">Listes</a>
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
                <h5>Mise à jour Blog : {{$blog->slug}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('admin.blog.index')}}/{{$blog->id}}" method="post">

                    {{ csrf_field() }}
                    {{ method_field("PUT") }}
					<div class="form-group">
						<label for="title">@lang('app.admin.title')</label>
						<input name="title" id="title" class="form-control" type="text" value="{{$blog->title}}">
					</div> 
					<div class="form-group">
						<label for="title">@lang('app.admin.content')</label>
						<textarea id="ckeditor" class="form-control" name="content" placeholder="@lang('app.admin.content.desc')">{!!$blog->content!!}</textarea>
					</div>   
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">  
								<label for="title">@lang('app.admin.metatag')</label>
								<textarea class="form-control" style="height: 120px" name="meta_tag" placeholder="@lang('app.admin.metatag.desc')">{{$blog->meta_tag}}</textarea>
							</div>
							<div class="col-md-6">  
								<label for="title">@lang('app.admin.metadesc')</label>
								<textarea id="wysiBooEditor" class="form-control" style="height: 120px" name="meta_description" placeholder="@lang('app.admin.metadesc.desc')">{{$blog->meta_description}}</textarea>
							</div>
						</div>
					</div> 
					<div class="form-group">
						<label for="title">@lang('app.admin.category')</label>
						<select class="form-control" name="category[]" id="category" multiple="multiple">
							@foreach($categories as $category)
								<option value="{{$category->id}}" {{in_array($category->id, $categoryIds)?'selected="selected"':''}}> {{$category->title}}</option>
							@endforeach
						</select>
					</div>    
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<div class="well well-nice inline">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="fileupload-preview thumbnail" style="width: 200px; height: 120px;">
											<img src="{{$blog->imageUrl()}}" style="width:100%">
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
							<div class="col-md-6"></div>
						</div>
					</div>                                                                                                                                                 
                    <button type="submit" class="btn btn-primary btn-lg pull-right">
						<i class="fa fa-save"></i> @lang('app.btn.save')
					</button>
					<a href="javascript:history.back()" class="btn btn-warning btn-lg" type="submit">@lang('app.btn.back')</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-script')
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
	<script src="{{asset('administrator/plugins/bootstrap-fileupload/js/bootstrap-fileupload.js')}}"></script>
    <script>
        $(document).ready(function(){
            CKEDITOR.replace('content');
			$("#category").select2();
        }) ;
    </script>
@endsection
