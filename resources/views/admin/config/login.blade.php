@extends('admin.layouts.app')

@section('title', 'Configuration login')

@section('breadcrumb')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>@lang('app.info_site')</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('V2/admin')}}">Accueil</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Configuration</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>@lang('app.login')</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>@lang('app.login') <small>Mise à jour des informations</small></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <form method="post" action="{{route('admin.config.login.update')}}">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="title[fr]">Titre</label>
                                            <input id="title[fr]" class="form-control" type="text" name="title[fr]"
                                                   value="{{old('title.fr')?old('title.fr'):$item->get_meta_array('title', 'fr', '')}}"
                                            >
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="title[en]">Title</label>
                                            <input id="title[en]" class="form-control" type="text" name="title[en]"
                                                   value="{{old('title.en')?old('title.en'):$item->get_meta_array('title', 'en', '')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="content[fr]">Contenu</label>
                                            <textarea id="content[fr]" class="form-control" type="text" name="content[fr]">{{old('content.fr')?old('content.fr'):$item->get_meta_array('content', 'fr', '')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="content[en]">Content</label>
                                            <textarea id="content[en]" class="form-control" type="text" name="content[en]">{{old('content.en')?old('content.en'):$item->get_meta_array('content', 'en', '')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="address[fr]">Adresse</label>
                                            <textarea id="address[fr]" class="form-control" type="text" name="address[fr]">{{old('address.fr')?old('address.fr'):$item->get_meta_array('address', 'fr', '')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="address[en]">Address</label>
                                            <textarea id="address[en]" class="form-control" type="text" name="address[en]" >{{old('address.en')?old('address.en'):$item->get_meta_array('address', 'en', '')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="contact[fr]">Contact</label>
                                            <textarea id="contact[fr]" class="form-control" type="text" name="contact[fr]">{{old('contact.fr')?old('contact.fr'):$item->get_meta_array('contact', 'fr', '')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="contact[en]">Contact</label>
                                            <textarea id="contact[en]" class="form-control" type="text" name="contact[en]" >{{old('contact.en')?old('contact.en'):$item->get_meta_array('contact', 'en', '')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right m-t-n-xs">@lang('app.btn.save')</button>
                                <button type="reset" class="btn btn-default float-right m-t-n-xs mr-2">@lang('app.btn.cancel')</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

    <script>
        $(document).ready(function(){
            CKEDITOR.replace( 'content[fr]' );
            CKEDITOR.replace( 'content[en]' );
            CKEDITOR.replace( 'address[fr]' );
            CKEDITOR.replace( 'address[en]' );
            CKEDITOR.replace( 'contact[en]' );
            CKEDITOR.replace( 'contact[fr]' );
        }) ;
    </script>
@endsection