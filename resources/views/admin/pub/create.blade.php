@extends('admin.layouts.app')

@section('title', 'Pubs - Ajout ')

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
                <strong>Ajout</strong>
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
                <h5>Ajouter un nouveau Pub</h5>
            </div>
            <div class="ibox-content">
                <form class="form-validation form-padding" action="{{ route('admin.pub.store') }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                                                        
                    {!! \Nvd\Crud\Form::input('title','text')->show() !!}                                            
                    <div class="form-group">
						<label for="content">Content</label>
						<textarea name="content" id="content"></textarea>
					</div>                                    
                    {!! \Nvd\Crud\Form::input('links','text')->show() !!}    
                    <div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<div class="well well-nice inline">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="fileupload-preview thumbnail" style="width: 200px; height: 120px;">
											
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
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Créer</button>

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
        }) ;
    </script>
@endsection
