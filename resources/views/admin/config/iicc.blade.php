@extends('admin.layouts.app')

@section('title', 'Configuration site')

@section('breadcrumb')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>@lang('app.config.iicc')</h2>
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
                    <strong>@lang('app.txt.iicc')</strong>
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
                    <h5>@lang('app.txt.iicc') <small>@lang('app.txt.update_infos')</small></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <form role="form" method="post" action="{{Auth::user()->isAdmin()?route('admin.config.iicc.update'):route('admin.collaborators.config.iicc.update')}}" id="iiccForm">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">

                                <div class="row">
                                    <div class="col-sm-12 col-lg-12">
                                        <div class="form-group">
											<label>@lang('app.txt.iicc_name')</label> 
											<input type="text" placeholder="@lang('app.txt.name')" class="form-control" value="{{old('iicc_name')?old('iicc_name'):($item->get_meta('iicc_name')?$item->get_meta('iicc_name')->value:'')}}" name="iicc_name">
										</div>
                                        <div class="form-group">
											<label>@lang('app.txt.iicc_address')</label> 
											<textarea placeholder="@lang('app.txt.address')" class="form-control" name="iicc_address">{!! old('iicc_address')?old('iicc_address'):($item->get_meta('iicc_address')?$item->get_meta('iicc_address')->value:'') !!}</textarea>
										</div>
                                        <div class="form-group">
											@php
												$tel_base = old('iicc_mobile')?old('iicc_mobile'):($item->get_meta('iicc_mobile')?$item->get_meta('iicc_mobile')->value:'');
												if($tel_base != ''){
													$pattern = '!\(([^\)]+)\)!';
													$replace = '';
													preg_match($pattern, $tel_base, $match);
													if($match){
														$val_indicatif = str_replace("+", $replace, $match[1]);
														$numero = preg_replace($pattern, $replace, $tel_base);
													}else{
														$val_indicatif = '';
														$numero = $tel_base;
													}
												}else{
													$val_indicatif = 61;
													$numero = $tel_base;
												}
											@endphp
											<label>@lang('app.txt.iicc_mobile')</label> 
											<div class="input-group">
                                                <div class="input-group-prepend">
                                                    <select class="form-control" name="indicatif" id="indicatif">
                                                        @foreach (App\Models\Indicatif::all() as $indicatif)
                                                            <option value="+{{ $indicatif->code }}" {{ str_replace(' ', '', $indicatif->code)==$val_indicatif?'selected':'' }}>(+ {{ $indicatif->code }}) </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="text" pattern="[0-9]{1}[0-9]{7|8}" minlength="6" maxlength="9" placeholder="XXXXXXXX" class="form-control" id="iicc_mobile" name="iicc_mobile" value="{{$numero}}" required>
                                                </div>
                                            </div>
										</div>
                                        <div class="form-group">
											<label>@lang('app.txt.iicc_email')</label> 
											<input type="text" placeholder="@lang('app.txt.email')" class="form-control" value="{{ ($item->get_meta('iicc_email')?$item->get_meta('iicc_email')->value:'') }}" name="iicc_email">
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
	$('#iiccForm').validate({
		ignore: [],
		rules: {
			iicc_name: {
				required: true
			},
			iicc_address: {
				required: true
			},
			iicc_mobile: {
				required: true,
				digits: true,
				maxlength:9,
				minlength:6
			},
			iicc_email: {
				required: true,
				email: true
			}
		},
		messages: {
			iicc_name: {
				required: "@lang('app.txt.champobligatoire')"
			},
			iicc_address: {
				required: "@lang('app.txt.champobligatoire')"
			},
			iicc_mobile: {
				required: "@lang('app.txt.champobligatoire')"
			},
			iicc_email: {
				required: "@lang('app.txt.champobligatoire')",
				email: "Enter valid email please"
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