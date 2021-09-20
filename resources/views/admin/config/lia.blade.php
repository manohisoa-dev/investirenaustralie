@extends('admin.layouts.app')

@section('title', 'Configuration site')

@section('breadcrumb')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>@lang('app.config.lia')</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ Auth::user()->isAdmin()?url('/admin'):url('/collaborators') }}">
                        @lang('app.home')
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.config.lia'):route('admin.config.lia')}}">
                        @lang('app.config')
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>@lang('app.txt.lia')</strong>
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
                    <h5>@lang('app.txt.lia') <small>@lang('app.txt.update_infos')</small></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <form role="form" method="post" action="{{Auth::user()->isAdmin()?route('admin.config.lia.update'):route('admin.collaborators.config.lia.update')}}" id="liaForm">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">

                                <div class="row">
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="form-group">
											<label>@lang('app.txt.lia_name')</label> 
											<input type="text" placeholder="@lang('app.txt.name')" class="form-control" value="{{old('lia_name')?old('lia_name'):($item->get_meta('lia_name')?$item->get_meta('lia_name')->value:'')}}" name="lia_name">
										</div>
                                        <div class="form-group">
											<label>@lang('app.txt.lia_address')</label> 
											<textarea placeholder="@lang('app.txt.address')" class="form-control" name="lia_address">{!! old('lia_address')?old('lia_address'):($item->get_meta('lia_address')?$item->get_meta('lia_address')->value:'') !!}</textarea>
										</div>
										@php
											$mobile_base = old('lia_mobile')?old('lia_mobile'):($item->get_meta('lia_mobile')?$item->get_meta('lia_mobile')->value:'');
											if($mobile_base != ''){
												$pattern = '!\(([^\)]+)\)!';
												$replace = '';
												preg_match($pattern, $mobile_base, $match);
												if($match){
													$val_indicatif = str_replace("+", $replace, $match[1]);
													$numero = preg_replace($pattern, $replace, $mobile_base);
												}else{
													$val_indicatif = '';
													$numero = $mobile_base;
												}
											}else{
												$val_indicatif = 61;
												$numero = $mobile_base;
											}
										@endphp
                                        <div class="form-group">
											<label>@lang('app.txt.lia_mobile')</label> 
											<div class="input-group">
                                                <div class="input-group-prepend">
                                                    <select class="form-control" name="indicatif" id="indicatif">
                                                        @foreach (App\Models\Indicatif::all() as $indicatif)
                                                            <option value="+{{ $indicatif->code }}" {{ str_replace(' ', '', $indicatif->code)==$val_indicatif?'selected':'' }}>(+ {{ $indicatif->code }}) </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="text" pattern="[0-9]{1}[0-9]{7|8}" minlength="6" maxlength="9" placeholder="XXXXXXXX" class="form-control" id="lia_mobile" name="lia_mobile" value="{{$numero}}" required>
                                                </div>
                                            </div>
										</div>
                                        <div class="form-group">
											<label>@lang('app.txt.lia_email')</label> 
											<input type="email" placeholder="@lang('app.txt.email')" class="form-control" value="{{ ($item->get_meta('lia_email')?$item->get_meta('lia_email')->value:'') }}" name="lia_email">
										</div>
                                        <hr>
                                    </div>
                                    
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="form-group">
											<label>@lang('app.txt.lia_abn')</label> 
											<input type="text" minlength="11" maxlength="11" pattern="[0-9]{1}[0-9]{10}" class="form-control" id="lia_abn" name="lia_abn" placeholder="@lang('app.txt.abn_number')" value="{{old('lia_abn')?old('lia_abn'):($item->get_meta('lia_abn')?$item->get_meta('lia_abn')->value:'')}}">
										</div>
                                        <div class="form-group">
											<label>@lang('app.txt.lia_license')</label>
											<input type="text" class="form-control" id="lia_license" name="lia_license" placeholder="@lang('app.txt.license_number')" value="{{old('lia_license')?old('lia_license'):($item->get_meta('lia_license')?$item->get_meta('lia_license')->value:'')}}">
										</div>
                                        <div class="form-group">
											<label>@lang('app.txt.lia_license_expire_date')</label> 
											<input type="date" placeholder="@lang('app.txt.license_expire_date')" class="form-control" value="{{old('lia_license_expire_date')?old('lia_license_expire_date'):($item->get_meta('lia_license_expire_date')?$item->get_meta('lia_license_expire_date')->value:'')}}" name="lia_license_expire_date">
										</div>
                                        <div style="padding-bottom: 83px;"></div>
                                        <hr>
                                    </div>

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="form-group">
											<label>@lang('app.txt.dir_name')</label> 
											<input type="text" placeholder="@lang('app.txt.dir_name')" class="form-control" value="{{old('lia_dir')?old('lia_dir'):($item->get_meta('lia_dir')?$item->get_meta('lia_dir')->value:'')}}" name="lia_dir">
										</div>
                                        <div class="form-group">
											<label>@lang('app.txt.dir_license')</label>
											<input type="text" class="form-control" id="lia_dir_license" name="lia_dir_license" placeholder="@lang('app.txt.license_number')" value="{{old('lia_dir_license')?old('lia_dir_license'):($item->get_meta('lia_dir_license')?$item->get_meta('lia_dir_license')->value:'')}}">
										</div>
                                        <div class="form-group">
											<label>@lang('app.txt.dir_license_expire_date')</label> 
											<input type="date" placeholder="@lang('app.txt.license_expire_date')" class="form-control" value="{{old('lia_dir_license_expire_date')?old('lia_dir_license_expire_date'):($item->get_meta('lia_dir_license_expire_date')?$item->get_meta('lia_dir_license_expire_date')->value:'')}}" name="lia_dir_license_expire_date">
										</div>
                                    </div>

                                    <div class="col-sm-6 col-lg-6" style="margin-top: 280px;">
                                        <div>
                                            <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"><strong>@lang('app.btn.save')</strong></button>
                                            <button class="btn btn-sm btn-default float-right m-t-n-xs mr-2" type="reset"><strong>@lang('app.btn.cancel')</strong></button>
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
	$('#liaForm').validate({
		ignore: [],
		rules: {
			lia_name: {
				required: true
			},
			lia_address: {
				required: true
			},
			lia_mobile: {
				required: true,
				digits: true,
				maxlength:9,
				minlength:6
			},
			lia_email: {
				required: true,
				email: true
			},
			lia_abn: {
				required: true
			},
			lia_license: {
				required: true
			},
			lia_license_expire_date: {
				required: true
			},
			lia_dir: {
				required: true
			},
			lia_dir_license: {
				required: true
			},
			lia_dir_license_expire_date: {
				required: true
			}
		},
		messages: {
			lia_name: {
				required: "@lang('app.txt.champobligatoire')"
			},
			lia_address: {
				required: "@lang('app.txt.champobligatoire')"
			},
			lia_mobile: {
				required: "@lang('app.txt.champobligatoire')"
			},
			lia_email: {
				required: "@lang('app.txt.champobligatoire')",
				email: "Enter valid email please"
			},
			lia_abn: {
				required: "@lang('app.txt.champobligatoire')",
			},
			lia_license: {
				required: "@lang('app.txt.champobligatoire')",
			},
			lia_license_expire_date: {
				required: "@lang('app.txt.champobligatoire')",
			},
			lia_dir: {
				required: "@lang('app.txt.champobligatoire')",
			},
			lia_dir_license: {
				required: "@lang('app.txt.champobligatoire')",
			},
			lia_dir_license_expire_date: {
				required: "@lang('app.txt.champobligatoire')",
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