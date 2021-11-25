@extends('admin.layouts.app')

@section('title', 'Search Mandate - Edition ')

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
                <h5>Mise à jour mandat de recherche : {{$searchMandate->search_mandate_name}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('admin.search-mandate.index')}}/{{$searchMandate->id}}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    {{ method_field("PUT") }}
                    <div class="form-group">
						<label for="state_id">Etat</label>
						<select class="form-control" name="state_id" id="state_id" required>
							@foreach($states as $state)
								<option value="{{$state->id}}" {{$state->id==$searchMandate->state_id?'selected="selected"':''}}> {{$state->content}}</option>
							@endforeach
						</select>
					</div>         
					<div class="form-group">
						<label for="mandate_name">Libellé</label>
						<input name="search_mandate_name" id="search_mandate_name" class="form-control" type="text" value="{{$searchMandate->search_mandate_name}}" required>
					</div>         
                    <div class="form-group">
						<label for="mandate_file">Source</label>
						<input type="file" name="mandate_file" accept="application/pdf" class="form-control"/>
					</div>
                                                
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Enregistrer</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
