@extends('admin.layouts.app')

@section('title', 'Pages - Edition ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Pages</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Pages</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.page.index') }}">Listes</a>
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
                <h5>Mise à jour Page : {{$page->title}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('admin.page.index')}}/{{$page->id}}" method="post" id="formPage">

                    {{ csrf_field() }}
                    {{ method_field("PUT") }}
					<div class="form-group">
                        <label for="language">Est un pub</label>
                        <select name="is_pub" id="is_pub" class="form-control">
							<option value="1" {{$page->is_pub == '1' ? 'selected' : ''}}>Oui</option>
							<option value="0" {{$page->is_pub == '0' ? 'selected' : ''}}>Non</option>
						</select>
                    </div>
					@if($page->is_pub == 1)					
					<div id="liste_pub">
						<div class="form-group">
							<label for="language">Choisir pub</label>
							<select name="pubid" id="pubid" class="form-control" style="width:100%">
								<option value="">Choisir...</option>								
								@foreach(\App\Models\Pub::all() as $pub)
									<option value="{{$pub->id}}" {{$page->pubs->first()->id == $pub->id ? 'selected' : ''}}>{{$pub->title}}</option>
								@endforeach
							</select>
						</div>
						<input type="hidden" name="oldpubId" value="{{$page->pubs->first()->id}}" />
					</div>
					@endif
                    <div class="form-group">
						<label for="title">@lang('app.admin.title')</label>
						<input name="title" id="title" class="form-control" type="text" value="{{$page->title}}">
					</div>
                    <div class="form-group">
						<label for="title">@lang('app.admin.content')</label>
						<textarea id="ckeditor" class="form-control" name="content">{{$page->content}}</textarea>
					</div> 
                    <div class="form-group">
						<label for="path">@lang('app.admin.path')</label>
						<input name="path" id="path" class="form-control" type="text" value="{{$page->path}}">
					</div>
					<div class="form-group">
                        <label for="parent_id">@lang('app.admin.parent')</label>
                        <select name="parent_id" id="parent_id" class="form-control">
                            @foreach(\App\Models\Page::all() as $item)
								<option value="{{$item->id}}" {{$page->parent_id == $item->id ? 'selected' : ''}}>{{$item->title}}</option>
							@endforeach
                        </select>
                    </div>
					<div class="form-group">
						<label for="page_order">@lang('app.admin.page_order')</label>
						<input name="page_order" id="page_order" class="form-control" type="number" value="{{$page->page_order}}">
					</div>               
                                            
                    <div class="form-group">
                        <label for="language">@lang('app.admin.language')</label>
                        <select name="language" id="language" class="form-control">
							<option value="fr" {{$page->language == 'fr' ? 'selected' : ''}}>Fr</option>
							<option value="en" {{$page->language == 'en' ? 'selected' : ''}}>En</option>
						</select>
                    </div>                                                                           
                    <input type="hidden" name="author_id" value="{{$page->author_id}}">        

                    <button type="submit" class="btn btn-primary btn-lg">
						<i class="fa fa-save"></i> Enregistrer
					</button>

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
					content: {
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
					content: {
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
