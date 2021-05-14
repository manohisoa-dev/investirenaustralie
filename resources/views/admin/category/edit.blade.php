@extends('admin.layouts.app')

@section('title', 'Categories - Edition ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Categories</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Categories</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.category.index') }}">Listes</a>
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
                <h5>Mise à jour catégorie: {{$category->slug}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('admin.category.update',$category)}}" method="post">

                    {{ csrf_field() }}

                    {{ method_field("PUT") }}
					<input name="slug" id="slug" class="form-control" type="hidden" value="{{$category->slug}}">
					<div class="form-group">
						<label for="title">Titre</label>
						<input name="title" id="title" class="form-control" type="text" value="{{$category->title}}">
					</div>
					<div class="form-group">
						<label for="title">@lang('app.admin.content')</label>
						<textarea id="ckeditor" class="form-control" name="content" placeholder="@lang('app.admin.content.desc')">{!!$category->content!!}</textarea>
					</div>
					<input name="author_id" id="author_id" class="form-control" type="hidden" value="{{$category->author_id}}">
                                                                                                                                                
                    <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Enregistrer</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-script')
    <script src="{{asset('administrator/plugins/ckeditor/ckeditor.js')}}"></script>
    <script>
        $(document).ready(function(){
            CKEDITOR.replace('content');
        }) ;
    </script>
@endsection
