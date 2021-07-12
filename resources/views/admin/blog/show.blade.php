@extends('admin.layouts.app')

@section('title', 'Blogs - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.blogs')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.txt.blogs')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ Auth::user()->isAdmin()?route('admin.blog.index'):(Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.index'):route('admin.collaborator.admin.blog.index')) }}">@lang('app.txt.lists')</a>
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
                <h5>@lang('app.txt.detail_blog', ['blog'=>$blog->slug])</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>@lang('app.table.id')</h4>
                        <h5>{{$blog->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.table.slug')</h4>
                        <h5>{{$blog->slug}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.table.title')</h4>
                        <h5>{{$blog->title}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.table.content')</h4>
                        <h5>{{$blog->content}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.table.meta_tag')</h4>
                        <h5>{{$blog->meta_tag}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.table.meta_desc')</h4>
                        <h5>{{$blog->meta_description}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.table.view_count')</h4>
                        <h5>{{$blog->view_count}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.table.status')</h4>
                        <h5>{{$blog->status}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.table.starred')</h4>
                        <h5>{{$blog->starred}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.table.post_type')</h4>
                        <h5>{{$blog->post_type}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.table.image_id')</h4>
                        <h5>{{$blog->image_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.table.author_id')</h4>
                        <h5>{{$blog->author_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.txt.created_on') </h4>
                        <h5>{{$blog->created_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>@lang('app.txt.updated_on')</h4>
                        <h5>{{$blog->updated_at}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection