@extends('admin.layouts.app')

@section('title', 'Categories - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.categories')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.txt.categories')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdmin()?route('admin.category.index'):route('admin.collaborators.admin.category.index')  }}">@lang('app.txt.lists')</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.details')</strong>
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
                <h5>@lang('app.txt.detail_category', ['category'=>$category->slug])</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>@lang('app.table.id')</h4>
                        <h5>{{$category->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.table.slug')</h4>
                        <h5>{{$category->slug}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.table.title')</h4>
                        <h5>{{$category->title}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.table.content')</h4>
                        <h5>{{$category->content}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.table.author_id')</h4>
                        <h5>{{$category->author_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.table.created_on')</h4>
                        <h5>{{$category->created_at ? $category->created_at->diffForHumans() : ''}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.table.updated_on')</h4>
                        <h5>{{$category->updated_at ? $category->updated_at->diffForHumans() : ''}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection