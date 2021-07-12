@extends('admin.layouts.app')

@section('title', 'Pages - Ajout ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.pages')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.pages')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdmin()?route('admin.page.index'):route('admin.collaborators.admin.page.index') }}">@lang('app.txt.lists')</a>
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
                <h5>@lang('app.txt.add_new_page')</h5>
            </div>
            <div class="ibox-content">
                <form class="form-validation form-padding" action="{{ Auth::user()->isAdmin()?route('admin.page.store'):route('admin.collaborators.admin.page.store') }}" method="post" id="formPage">
                    {{ csrf_field() }}
                    <input type="hidden" name="author_id" value="{{Auth::id()}}">
                                                        
					<div class="form-group">
                        <label for="estunpub">@lang('app.txt.is_ad')</label>
                        <select name="is_pub" id="is_pub" class="form-control">
                            <option value="0">@lang('app.no')</option>
							<option value="1">@lang('app.yes')</option>
                        </select>
                    </div>
					
					<div id="liste_pub" style="display:none">
						<div class="form-group">
							<label>@lang('app.txt.choose_ad')</label>
							<select name="pubid" id="pubid" class="form-control" style="width:100%">
								<option value="">@lang('app.form.choix_txt')</option>
								@foreach(\App\Models\Pub::all() as $pub)
									<option value="{{$pub->id}}">{{$pub->title}}</option>
								@endforeach
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label for="title">@lang('app.admin.title')</label>
						<input name="title" id="title" class="form-control" type="text" value="">
					</div>
                    <div class="form-group">
						<label for="title">@lang('app.admin.content')</label>
						<textarea id="ckeditor" class="form-control" name="content" placeholder="@lang('app.admin.content.desc')"></textarea>
					</div> 
                    <div class="form-group">
						<label for="path">@lang('app.admin.path')</label>
						<input name="path" id="path" class="form-control" type="text" value="" placeholder="@lang('app.admin.path.desc')">
					</div>
					<div class="form-group">
                        <label for="parent_id">@lang('app.admin.parent')</label>
                        <select name="parent_id" id="parent_id" class="form-control">
                            @foreach(\App\Models\Page::all() as $page)
                                <option value="{{$page->id}}">{{$page->title}}</option>
                            @endforeach
                        </select>
                    </div>
					<div class="form-group">
						<label for="page_order">@lang('app.admin.page_order')</label>
						<input name="page_order" id="page_order" class="form-control" type="number" value="" placeholder="@lang('app.admin.page_order.desc')">
					</div>
					              
                    <div class="form-group">
                        <label for="language">@lang('app.admin.language')</label>
                        <select name="language" id="language" class="form-control">
                            <option value="fr">@lang('app.txt.fr')</option>
                            <option value="en">@lang('app.txt.en')</option>
                        </select>
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

    <script>
        $(document).ready(function(){
            CKEDITOR.replace( 'content' );
			$("#pubid").select2();
			
			$('#is_pub').change(function() {
				var is_pub = $(this).val();
				if(is_pub == 1){
					$('#liste_pub').show();
				}else{
					$('#liste_pub').hide();
					$('[name="title"]').val('');
					CKEDITOR.instances['ckeditor'].setData('');
					$('[name="path"]').val('');
				}
			});
			
			$('#pubid').change(function() {
				var pubId = $(this).val();
				if(pubId != 0){
					$.ajax({
					   type:'POST',
					   url:"{{ route('admin.ajaxRequest.post') }}",
					   data: {"_token": "{{ csrf_token() }}","pubId": pubId},
					   success:function(data) {
						  console.log(data.links);
						  $('[name="title"]').val(data.title);
						  CKEDITOR.instances['ckeditor'].setData(data.content);
						  $('[name="path"]').val(data.links);
					   }
					});
				}
			});
			
			$('#formPage').validate({
			    ignore: [],
				rules: {
					title: {
						required: true
					},
					path: {
						required: true
					},
					page_order: {
						required: true
					}
				},
				messages: {
					title: {
						required: "@lang('app.txt.champobligatoire')"
					},
					path: {
						required: "@lang('app.txt.champobligatoire')"
					},
					page_order: {
						required: "@lang('app.txt.champobligatoire')"
					}
				}
			});
        }) ;
    </script>
@endsection
