@extends('admin.layouts.app')

@section('title', 'Model Fichier Pdfs - Edition ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Modèle Fichier Pdf</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Modèle Fichier Pdf</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdmin()?route('admin.model-fichier-pdf.index'):route('admin.collaborators.admin.model-fichier-pdf.index') }}">Listes</a>
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
                <h5>Mise à jour Modèle Fichier Pdf : {{$modelFichierPdf->pdf_titre}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('admin.model-fichier-pdf.index')}}/{{$modelFichierPdf->id}}" method="post">

                    {{ csrf_field() }}

                    {{ method_field("PUT") }}
                    <div class="form-group">
						<label for="contenu">@lang('app.table.title')</label>
						<input name="pdf_titre" id="pdf_titre" class="form-control" type="text" value="{!! $modelFichierPdf->pdf_titre !!}">
					</div> 											
					<div class="form-group">
						<label for="contenu">@lang('app.message') fr</label>
						<textarea name="contenu_fr" id="contenu_fr" class="form-control">{!! $modelFichierPdf->contenu_fr !!}</textarea>
					</div> 
					<div class="form-group">
						<label for="contenu">@lang('app.message') en</label>
						<textarea name="contenu_en" id="contenu_en" class="form-control">{!! $modelFichierPdf->contenu_en !!}</textarea>
					</div>                                  
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Enregistrer</button>

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
            CKEDITOR.replace( 'contenu_fr' );
			CKEDITOR.replace( 'contenu_en' );
		});
	</script>
@endsection
