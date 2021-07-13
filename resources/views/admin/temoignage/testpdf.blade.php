@extends('admin.layouts.app')

@section('title', 'Témoignages - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Témoignages</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Témoignages de satisfaction</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.temoignage.index') }}">Listes</a>
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
                <h5>Pdf test</h5>
            </div>
            <div class="ibox-content">
                <form class="form-validation form-padding" action="{{ route('admin.infoPost') }}" method="post">
					{{ csrf_field() }}   
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="statut">Nom</label>
								<input type="text" class="form-control" name="name"/>
							</div> 
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="statut">Titre</label>
								<input type="text" class="form-control" name="titre"/>
							</div> 
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="statut">Date</label>
								<input type="date" class="form-control" name="dt"/>
							</div> 
						</div>
					</div>
					<button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Modifier pdf</button>
				</form>
            </div>
        </div>
    </div>
</div>

@endsection