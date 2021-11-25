@extends('admin.layouts.app')

@section('title', 'Search Mandate - Ajout ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.research_mandate')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.txt.research_mandate')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.search-mandate.index') }}">Listes</a>
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
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Ajouter un nouveau mandat de recherche</h5>
            </div>
            <div class="ibox-content">
                <form class="form-validation form-padding" action="{{ Auth::user()->isAdmin()?route('admin.search-mandate.store') : (Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.search-mandate.store'):route('admin.collaborator.admin.search-mandate.store')) }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
					<div class="form-group">
						<label for="state_id">Etat</label>
						<select class="form-control" name="state_id" id="state_id" required>
							@foreach($states as $state)
								<option value="{{$state->id}}"> {{$state->content}}</option>
							@endforeach
						</select>
					</div>         
					<div class="form-group">
						<label for="mandate_name">Libellé</label>
						<input name="search_mandate_name" id="search_mandate_name" class="form-control" type="text" value="" required>
					</div>          
					<div class="form-group">
						<label for="mandate_file">Source</label>
						<input type="file" name="mandate_file" class="form-control" accept="application/pdf" required/>
					</div>     
                            
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Créer</button>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
