@extends('admin.layouts.app')

@section('title', 'Videos - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Videos</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Videos</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.video.index') }}">Listes</a>
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
                <h5>Détail Video : {{$video->video_titre}}</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>Id</h4>
                        <h5>{{$video->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Video Titre</h4>
                        <h5>{{$video->video_titre}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Video Url</h4>
                        <h5>{{$video->video_url}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Video Path</h4>
                        <h5>{{$video->video_path}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Created At</h4>
                        <h5>{{$video->created_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Updated At</h4>
                        <h5>{{$video->updated_at}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection