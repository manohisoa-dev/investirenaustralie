@extends('admin.layouts.app')

@section('title', 'Sliders - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Sliders</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Sliders</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.slider.index') }}">Listes</a>
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
                <h5>Détail Slider : {{$slider->content}}</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                                        <li class="list-group-item">
                        <h4>Id</h4>
                        <h5>{{$slider->id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Content</h4>
                        <h5>{{$slider->content}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Type</h4>
                        <h5>{{$slider->type}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Status</h4>
                        <h5>{{$slider->status}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Image Id</h4>
                        <h5>{{$slider->image_id}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Created At</h4>
                        <h5>{{$slider->created_at}}</h5>
                    </li>
                                        <li class="list-group-item">
                        <h4>Updated At</h4>
                        <h5>{{$slider->updated_at}}</h5>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div>

@endsection