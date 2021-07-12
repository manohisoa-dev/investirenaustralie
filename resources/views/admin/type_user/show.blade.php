@extends('admin.layouts.app')

@section('title', 'Type Users - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.user_type')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.txt.user_type')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.type-user.index'):route('admin.type-user.index') }}">@lang('app.txt.lists')</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.detail')</strong>
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
                <h5>@lang('app.txt.detail_user_type', ['user_type'=>$typeUser->type_user_name])</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>@lang('app.table.id')</h4>
                        <h5>{{$typeUser->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.table.name')</h4>
                        <h5>{{$typeUser->type_user_name}}</h5>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection