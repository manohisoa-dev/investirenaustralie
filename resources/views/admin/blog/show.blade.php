@extends('admin.layouts.app')

@section('title', 'Blogs - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Blogs</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Blogs</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.blog.index') }}">Listes</a>
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
                <h5>Détail Blog : {{$blog->slug}}</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>Id</h4>
                        <h5>{{$blog->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Slug</h4>
                        <h5>{{$blog->slug}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Title</h4>
                        <h5>{{$blog->title}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Content</h4>
                        <h5>{{$blog->content}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Meta Tag</h4>
                        <h5>{{$blog->meta_tag}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Meta Description</h4>
                        <h5>{{$blog->meta_description}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>View Count</h4>
                        <h5>{{$blog->view_count}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Status</h4>
                        <h5>{{$blog->status}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Starred</h4>
                        <h5>{{$blog->starred}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Post Type</h4>
                        <h5>{{$blog->post_type}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Image Id</h4>
                        <h5>{{$blog->image_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Author Id</h4>
                        <h5>{{$blog->author_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Créée le </h4>
                        <h5>{{$blog->created_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Mis à jour le</h4>
                        <h5>{{$blog->updated_at}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection