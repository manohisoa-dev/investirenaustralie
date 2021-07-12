@extends('admin.layouts.app')

@section('title', 'Blogs - Ajout ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.blogs')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.txt.blogs')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdmin()?route('admin.blog.index') : (Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.index'):route('admin.collaborator.admin.blog.index')) }}">@lang('app.txt.lists')</a>
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
                <h5>@lang('app.txt.add_new_blog')</h5>
            </div>
            <div class="ibox-content">
                <form class="form-validation form-padding" action="{{ Auth::user()->isAdmin()?route('admin.blog.store') : (Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.store'):route('admin.collaborator.admin.blog.store')) }}" id="formBlog" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                                                        
                    <div class="form-group">
						<label for="title">@lang('app.admin.title')</label>
						<input name="title" id="title" class="form-control" type="text">
					</div> 
					<div class="form-group">
						<label for="title">@lang('app.admin.content')</label>
						<textarea id="ckeditor" class="form-control" name="content" placeholder="@lang('app.admin.content.desc')"></textarea>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">  
								<label for="title">@lang('app.admin.metatag')</label>
								<textarea class="form-control" style="height: 120px" name="meta_tag" placeholder="@lang('app.admin.metatag.desc')"></textarea>
							</div>
							<div class="col-md-6">  
								<label for="title">@lang('app.admin.metadesc')</label>
								<textarea id="wysiBooEditor" class="form-control" style="height: 120px" name="meta_description" placeholder="@lang('app.admin.metadesc.desc')"></textarea>
							</div>
						</div>
					</div> 
					<div class="form-group">
						<label>@lang('app.admin.category')</label> 
						<select class="form-control" name="category[]" id="category" multiple="multiple">
							@foreach($categories as $category)
								<option value="{{$category->id}}"> {{$category->title}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<div class="well well-nice">
							<div class="fileupload fileupload-new" data-provides="fileupload">
								<div class="row">									
									<div class="col-md-12">
										<label>@lang('app.admin.file.select')</label> 
										<div class="input-group">
											<div class="custom-file">
												<label class="custom-file-label" for="inputGroupFile01">@lang('app.admin.file.select')</label>	
												<input id="inputGroupFile01" type="file" name="image" class="custom-file-input" accept="image/*">																									
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="fileupload-preview thumbnail"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="view_order">@lang('app.admin.article_display_order')</label>
						<input name="view_order" id="view_order" class="form-control" type="number" min="1" max="{{ (App\Models\Blog::max('view_order')+1) }}" value="{{ (App\Models\Blog::max('view_order')+1) }}" placeholder="@lang('app.admin.article_order.desc')">
					</div>            
					<div class="hr-line-dashed"></div>
                    <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> @lang('app.btn.save')</button>
					<a href="{{ Auth::user()->isAdmin() ? route('admin.blog.index') : (Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.index'):route('admin.collaborator.admin.blog.index')) }}" class="btn btn-outline btn-default btn-lg pull-right" type="submit">
						<i class="fa fa-chevron-circle-left"></i> @lang('app.btn.back')
					</a>
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
            CKEDITOR.replace( 'content' );
			$("#category").select2();
			
			$('#formBlog').validate({
			    ignore: [],
				rules: {
					title: {
						required: true
					},
					"category[]": {
						required: true
					},
					image: {
						required: true
					}
				},
				messages: {
					title: {
						required: "@lang('app.txt.champobligatoire')"
					},
					"category[]": {
						required: "@lang('app.txt.champobligatoire')"
					},
					image: {
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
