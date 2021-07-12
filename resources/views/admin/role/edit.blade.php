@extends('admin.layouts.app')

@section('title', 'Role - Edition ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.roles')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.txt.roles')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.role.index'):route('admin.role.index') }}">@lang('app.txt.lists')</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.editing')</strong>
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
                <h5>@lang('app.txt.update_role',['role'=>$role->role_name])</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.role.index'):route('admin.role.index')}}/{{$role->id}}" method="post">

                    {{ csrf_field() }}

                    {{ method_field("PUT") }}
                                                                                                
                            {!! \Nvd\Crud\Form::input('role_name','text')->model($role)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('role_initial','text')->model($role)->show() !!}
                                                
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> @lang('app.btn.save')</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
