@extends('admin.layouts.app')

@section('title', 'Pages - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.pages')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.pages')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdmin()?route('admin.page.index'):route('admin.collaborators.admin.page.index') }}">@lang('app.txt.lists')</a>
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
                <h5>@lang('app.txt.detail_page', ['page'=>$page->title])</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>@lang('app.table_id')</h4>
                        <h5>{{$page->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.table.title')</h4>
                        <h5>{{$page->title}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.table.content')</h4>
                        <h5>{!! $page->content !!}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.txt.path')</h4>
                        <h5>{{$page->path}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.table.order')</h4>
                        <h5>{{$page->page_order}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Is Pub</h4>
                        <h5>{{$page->is_pub}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.language')</h4>
                        <h5>{{$page->language}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.txt.parent_id')</h4>
                        <h5>{{$page->parent ? $page->parent->title : ''}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.txt.author_id')</h4>
                        <h5>{{$page->author ? $page->author->name : ''}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.txt.created_on')</h4>
                        <h5>{{$page->created_at ? $page->created_at->diffForHumans() : ''}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.txt.updated_on')</h4>
                        <h5>{{$page->updated_at ? $page->updated_at->diffForHumans() : ''}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection