@extends('admin.layouts.app')

@section('title', 'Model Fichier Pdfs - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Model Fichier Pdfs</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Model Fichier Pdfs</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.model-fichier-pdf.index') }}">Listes</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Détail</strong>
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
                <h5>Détail Model Fichier Pdf : {{$modelFichierPdf->pdf_titre}}</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>Id</h4>
                        <h5>{{$modelFichierPdf->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Pdf Titre</h4>
                        <h5>{{$modelFichierPdf->pdf_titre}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Contenu Fr</h4>
                        <h5>{!!$modelFichierPdf->contenu_fr!!}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Contenu En</h4>
                        <h5>{!!$modelFichierPdf->contenu_en!!}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Params</h4>
                        <h5>{{$modelFichierPdf->params}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Created At</h4>
                        <h5>{{$modelFichierPdf->created_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Updated At</h4>
                        <h5>{{$modelFichierPdf->updated_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Deleted At</h4>
                        <h5>{{$modelFichierPdf->deleted_at}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection