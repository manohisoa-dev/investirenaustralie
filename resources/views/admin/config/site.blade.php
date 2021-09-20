@extends('admin.layouts.app')

@section('title', 'Configuration site')

@section('breadcrumb')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>@lang('app.info_site')</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ Auth::user()->isAdmin()?url('/admin'):url('/collaborators') }}">
                        @lang('app.home')
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.config.site'):route('admin.config.site')}}">
                        @lang('app.config')
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>@lang('app.txt.site')</strong>
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
                    <h5>@lang('app.info_site') <small>@lang('app.txt.update_infos')</small></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <form role="form" method="post" action="{{Auth::user()->isAdmin()?route('admin.config.site.update'):route('admin.collaborators.config.site.update')}}" id="formSite">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">

                                <div class="row">
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="form-group">
											<label>@lang('app.txt.site_title')</label> 
											<input type="text" class="form-control" value="{{old('meta_title')?old('meta_title'):($item->get_meta('meta_title')?$item->get_meta('meta_title')->value:'')}}" name="meta_title">
										</div>
                                        <div class="form-group">
											<label>@lang('app.txt.meta_description_site')</label> 
											<textarea placeholder="Meta description du site" class="form-control" name="meta_desc">{{old('meta_desc')?old('meta_desc'):($item->get_meta('meta_desc')?$item->get_meta('meta_desc')->value:'')}}</textarea>
										</div>
                                        <div class="form-group">
											<label>@lang('app.txt.keys_word')</label> 
											<textarea placeholder="Mots clés" class="form-control" name="meta_keywords">{{old('meta_keywords')?old('meta_keywords'):($item->get_meta('meta_keywords')?$item->get_meta('meta_keywords')->value:'')}}</textarea>
										</div>
                                        <div class="form-group">
											<label>@lang('app.longitude')</label> 
											<input type="text" placeholder="Longitude" class="form-control" value="{{old('longitude')?old('longitude'):($item->get_meta('longitude')?$item->get_meta('longitude')->value:'')}}" name="longitude">
										</div>
                                        <div class="form-group">
											<label>@lang('app.latitude')</label> 
											<input type="text" placeholder="Latitude" class="form-control" value="{{old('latitude')?old('latitude'):($item->get_meta('latitude')?$item->get_meta('latitude')->value:'')}}" name="latitude">
										</div>
                                        <div style="padding-bottom: 40px;"></div>
                                        <hr>
                                    </div>
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="form-group">
											<label>@lang('app.txt.admin_list')</label>
                                            <select name="admin" class="form-control">
                                                <option value="0">@lang('app.select_admin')</option>
                                                @foreach($admins as $admin)
                                                <option value="{{$admin->id}}" {{old('admin', $item->get_meta('admin')?$item->get_meta('admin')->value:0)==$admin->id?'selected':0}}>{{$admin->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
											<label>@lang('app.txt.admin_name')</label> 
											<input type="text" placeholder="Admin name" class="form-control" value="{{old('admin_name')?old('admin_name'):($item->get_meta('admin_name')?$item->get_meta('admin_name')->value:'')}}" name="admin_name">
										</div>
                                        <div class="form-group">
											<label>@lang('app.txt.admin_email')</label> 
											<input type="text" placeholder="Enter email" class="form-control" value="{{ ($item->get_meta('admin_email')?$item->get_meta('admin_email')->value:'') }}" name="admin_email">
										</div>
										@php
											$mobile_admin = old('admin_phone')?old('admin_phone'):($item->get_meta('admin_phone')?$item->get_meta('admin_phone')->value:'');
											if($mobile_admin != ''){
												$pattern = '!\(([^\)]+)\)!';
												$replace = '';
												preg_match($pattern, $mobile_admin, $match);
												if($match){
													$val_indicatif_mobile = str_replace("+", $replace, $match[1]);
													$numero_mobile = preg_replace($pattern, $replace, $mobile_admin);
												}else{
													$val_indicatif_mobile = '';
													$numero_mobile = $mobile_admin;
												}
											}else{
												$val_indicatif_mobile = 61;
												$numero_mobile = $mobile_admin;
											}
										@endphp
                                        <div class="form-group">
											<label>@lang('app.txt.admin_phone')</label> 
											<div class="input-group">
                                                <div class="input-group-prepend">
                                                    <select class="form-control" name="indicatif1">
                                                        @foreach (App\Models\Indicatif::all() as $indicatif)
                                                            <option value="+{{ $indicatif->code }}" {{ str_replace(' ', '', $indicatif->code)==$val_indicatif_mobile?'selected':'' }}>(+ {{ $indicatif->code }}) </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="text" pattern="[0-9]{1}[0-9]{7|8}" minlength="6" maxlength="9" placeholder="XXXXXXXX" class="form-control" id="admin_phone" name="admin_phone" value="{{$numero_mobile}}">
                                                </div>
                                            </div>
										</div>
										@php
											$fax_base = old('admin_fax')?old('admin_fax'):($item->get_meta('admin_fax')?$item->get_meta('admin_fax')->value:'');
											if($fax_base != ''){
												$pattern = '!\(([^\)]+)\)!';
												$replace = '';
												preg_match($pattern, $fax_base, $match);
												if($match){
													$val_indicatif = str_replace("+", $replace, $match[1]);
													$numero = preg_replace($pattern, $replace, $fax_base);
												}else{
													$val_indicatif = '';
													$numero = $tel_base;
												}
											}else{
												$val_indicatif = 61;
												$numero = $fax_base;
											}
										@endphp
                                        <div class="form-group">
											<label>@lang('app.txt.admin_fax')</label>
											<div class="input-group">
                                                <div class="input-group-prepend">
                                                    <select class="form-control" name="indicatif" id="indicatif">
                                                        @foreach (App\Models\Indicatif::all() as $indicatif)
                                                            <option value="+{{ $indicatif->code }}" {{ str_replace(' ', '', $indicatif->code)==$val_indicatif?'selected':'' }}>(+ {{ $indicatif->code }}) </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="text" pattern="[0-9]{1}[0-9]{7|8}" minlength="6" maxlength="9" placeholder="XXXXXXXX" class="form-control" id="admin_fax" name="admin_fax" value="{{$numero}}" required>
                                                </div>
                                            </div>
										</div>
                                        <div class="form-group">
											<label>@lang('app.txt.admin_address')</label> 
											<textarea placeholder="Mots clés" class="form-control" name="admin_address">{!! old('admin_address')?old('admin_address'):($item->get_meta('admin_address')?$item->get_meta('admin_address')->value:'') !!}</textarea>
										</div>

                                        <hr>
                                        
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

@section('custom-script')
<script>
$(document).ready(function(){	
	$('#formSite').validate({
		ignore: [],
		rules: {
			meta_title: {
				required: true
			},
			meta_desc: {
				required: true
			},
			meta_keywords: {
				required: true
			},
			longitude: {
				required: true
			},
			latitude: {
				required: true
			},
			admin: {
				required: true
			},
			admin_name: {
				required: true
			},
			admin_fax: {
				required: true,
				digits: true,
				maxlength:9,
				minlength:6
			},
			admin_phone: {
				digits: true,
				maxlength:9,
				minlength:6
			},
			admin_email: {
				email: true
			},
			admin_address: {
				required: true
			}
		},
		messages: {
			meta_title: {
				required: "@lang('app.txt.champobligatoire')"
			},
			meta_desc: {
				required: "@lang('app.txt.champobligatoire')"
			},
			meta_keywords: {
				required: "@lang('app.txt.champobligatoire')"
			},
			longitude: {
				required: "@lang('app.txt.champobligatoire')"
			},
			latitude: {
				required: "@lang('app.txt.champobligatoire')"
			},
			admin: {
				required: "@lang('app.txt.champobligatoire')"
			},
			admin_name: {
				required: "@lang('app.txt.champobligatoire')"
			},
			admin_fax: {
				required: "@lang('app.txt.champobligatoire')"
			},
			admin_phone: {
				required: "@lang('app.txt.champobligatoire')"
			},
			admin_email: {
				required: "@lang('app.txt.champobligatoire')",
				email: "Enter valid email please"
			},
			admin_address: {
				required: "@lang('app.txt.champobligatoire')"
			}
		},
		errorPlacement: function ( error, element ) {
			if(element.parent().hasClass('input-group')){
				error.insertBefore( element.parent() );
			}else{
				error.insertAfter( element );
			}
		}
	});
});
</script>
@endsection