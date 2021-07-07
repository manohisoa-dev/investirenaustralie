@extends('admin.layouts.app')

@section('title', 'Témoignage - Edition ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Témoignage</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Témoignages de satisfaction</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.temoignage.index') }}">Listes</a>
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
                <h5>Mise à jour Témoignages</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('admin.temoignage.index')}}/{{$temoignage->id}}" method="post">

                    {{ csrf_field() }}

                    {{ method_field("PUT") }}
                    <div class="form-group">
						<label for="statut">Membre</label>
						<input type="text" class="form-control" value="{{$temoignage->author->name}}" readonly="" />
					</div>        
					<div class="form-group">
						<label for="contenu">Message</label>
						<textarea name="contenu" id="contenu" class="form-control">{{$temoignage->contenu}}</textarea>
					</div>                                                                         
					<input type="hidden" name="user_create" value="{{$temoignage->user_create}}" />
					<div class="form-group">
						<label for="statut">Statut</label>
						<select class="form-control" name="statut" id="statut">
							<option value="Actif" {{ ( $temoignage->statut == 'Actif') ? 'selected' : '' }}>Actif</option>
							<option value="Bloqué" {{ ( $temoignage->statut == 'Bloqué') ? 'selected' : '' }}>Bloqué</option>
						</select>
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
            CKEDITOR.replace( 'contenu' );
		});
	</script>
@endsection
