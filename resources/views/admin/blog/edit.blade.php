@extends('admin.layouts.app')

@section('title', 'Blogs - Edition ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.blogs')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.txt.blogs')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.blog.index') }}">@lang('app.txt.lists')</a>
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
                <h5>@lang('app.txt.update_blog', ['blog'=>$blog->slug])</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ Auth::user()->isAdmin() ? route('admin.blog.index') : Auth::user()->isAdmin() ? route('admin.blog.index') : (Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.index'):route('admin.collaborator.admin.blog.index')) }}/{{$blog->id}}" id="formBlog" method="post" enctype="multipart/form-data">
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
							<div class="col-md-8">
								<div class="well well-nice inline">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="row">
											<div class="col-md-4">
												<div class="fileupload-preview thumbnail">
													<img src="{{$blog->imageUrl()}}" style="width:100% !important">
												</div>
												<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">@lang('app.admin.file.remove')</a>
											</div>
											<div class="col-md-8">
												<div class="input-group">
													<div class="custom-file">
														<input id="inputGroupFile01" type="file" name="image" class="custom-file-input" accept="image/*">
														<label class="custom-file-label" for="inputGroupFile01">@lang('app.admin.file.select')</label>														
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="view_order">@lang('app.admin.article_display_order')</label>
						<input type="hidden" name="old_view_order" value="{{$blog->view_order}}">
						<input name="view_order" id="view_order" class="form-control" type="number" min="1" max="{{ (App\Models\Blog::max('view_order')) }}" value="{{$blog->view_order}}" placeholder="@lang('app.admin.article_order.desc')">
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
    <script src="{{asset('administrator/plugins/ckeditor/ckeditor.js')}}"></script>
	<script src="{{asset('administrator/plugins/bootstrap-fileupload/js/bootstrap-fileupload.js')}}"></script>
    <script>
        $(document).ready(function(){
            CKEDITOR.replace('content');
			$("#category").select2();
			
			$('#formBlog').validate({
				rules: {
					title: {
						required: true
					},
					category: {
						required: true
					}
				},
				messages: {
					title: {
						required: "@lang('app.txt.champobligatoire')"
					},
					category: {
						required: "@lang('app.txt.champobligatoire')"
					}
				}
			});
        }) ;
    </script>
@endsection
