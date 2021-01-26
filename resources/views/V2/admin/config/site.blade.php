@extends('V2.admin.layouts.app')

@section('title', 'Configuration site')

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
                    <strong>Site</strong>
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
                    <h5>Basic form <small>Simple login form example</small></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        @include('includes.alerts')
                        <div class="col-sm-12 col-lg-12"><h3 class="m-t-none m-b">@lang('app.info_site')</h3>
                            <form role="form" method="post" action="{{route('v2.config.site.update')}}">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">

                                <div class="row">
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="form-group"><label>Titre du site</label> <input type="text" placeholder="Enter email" class="form-control" value="{{old('meta_title')?old('meta_title'):($item->get_meta('meta_title')?$item->get_meta('meta_title')->value:'')}}" name="meta_title"></div>
                                        <div class="form-group"><label>Meta description du site</label> <textarea placeholder="Meta description du site" class="form-control" name="meta_desc">{{old('meta_desc')?old('meta_desc'):($item->get_meta('meta_desc')?$item->get_meta('meta_desc')->value:'')}}</textarea></div>
                                        <div class="form-group"><label>Mot clés</label> <textarea placeholder="Mots clés" class="form-control" name="meta_keywords">{{old('meta_keywords')?old('meta_keywords'):($item->get_meta('meta_keywords')?$item->get_meta('meta_keywords')->value:'')}}</textarea></div>
                                        <hr>
                                        <div class="form-group"><label>Latitude</label> <input type="text" placeholder="Latitude" class="form-control" value="{{old('latitude')?old('latitude'):($item->get_meta('latitude')?$item->get_meta('latitude')->value:'')}}" name="latitude"></div>
                                    </div>
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="form-group"><label>Liste des Admins</label>
                                            <select name="admin" class="form-control">
                                                <option value="0">@lang('app.select_admin')</option>
                                                @foreach($admins as $admin)
                                                    <option value="{{$admin->id}}" {{old('admin', $item->get_meta('admin')?$item->get_meta('admin')->value:0)==$admin->id?'selected':0}}>{{$admin->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group"><label>Admin name</label> <input type="text" placeholder="Admin name" class="form-control" value="{{old('admin_name')?old('admin_name'):($item->get_meta('admin_name')?$item->get_meta('admin_name')->value:'')}}" name="admin_name"></div>
                                        <div class="form-group"><label>Admin email</label> <input type="text" placeholder="Enter email" class="form-control" value="{{old('admin_email')?old('admin_email'):($item->get_meta('admin_email')?$item->get_meta('admin_email')->value:'')}}" name="admin_email"></div>
                                        <div class="form-group"><label>Admin Phone</label> <input type="text" placeholder="Enter Phone" class="form-control" value="{{old('admin_phone')?old('admin_phone'):($item->get_meta('admin_phone')?$item->get_meta('admin_phone')->value:'')}}" name="admin_phone"></div>
                                        <hr>
                                        <div class="form-group"><label>Longitude</label> <input type="text" placeholder="Longitude" class="form-control" value="{{old('longitude')?old('longitude'):($item->get_meta('longitude')?$item->get_meta('longitude')->value:'')}}" name="longitude"></div>
                                        <div>
                                            <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"><strong>@lang('app.btn.save')</strong></button>
                                            <button class="btn btn-sm btn-default float-right m-t-n-xs mr-2" type="button"><strong>@lang('app.btn.cancel')</strong></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection