@extends('V2.admin.layouts.app')

@section('breadcrumb')
<h2>Countries</h2>
<ol class="breadcrumb">
    <li>
        <a href="#">Countries</a>
    </li>
    <li>
        <a href="{{ route('v2.country.index') }}">Listes</a>
    </li>
    <li class="active">
        <strong>Détail</strong>
    </li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Détail Country : {{$country->code}}</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>Id</h4>
                        <h5>{{$country->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Code</h4>
                        <h5>{{$country->code}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Content</h4>
                        <h5>{{$country->content}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>PrefixPhone</h4>
                        <h5>{{$country->prefixPhone}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Placeholder</h4>
                        <h5>{{$country->placeholder}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Created At</h4>
                        <h5>{{$country->created_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Updated At</h4>
                        <h5>{{$country->updated_at}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection