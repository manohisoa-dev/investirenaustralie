@extends('V2.admin.layouts.app')

@section('title', 'Blogs - Edition ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Blogs</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Blogs</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('v2.blog.index') }}">Listes</a>
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
                <h5>Mise à jour Blog : {{$blog->slug}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('v2.blog.index')}}/{{$blog->id}}" method="post">

                    {{ csrf_field() }}

                    {{ method_field("PUT") }}
                                                                                                
                            {!! \Nvd\Crud\Form::input('slug','text')->model($blog)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('title','text')->model($blog)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::textarea('content','text')->model($blog)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::textarea('meta_tag','text')->model($blog)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::textarea('meta_description','text')->model($blog)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('view_count','text')->model($blog)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('status','text')->model($blog)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('starred','text')->model($blog)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('post_type','text')->model($blog)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('image_id','text')->model($blog)->show() !!}
                                                                        
                            {!! \Nvd\Crud\Form::input('author_id','text')->model($blog)->show() !!}
                                                                                                                                                
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Enregistrer</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

    <script>
        $(document).ready(function(){
            CKEDITOR.replace( 'content' );
            CKEDITOR.replace( 'meta_tag' );
            CKEDITOR.replace( 'meta_description' );
        });
    </script>
@endsection
