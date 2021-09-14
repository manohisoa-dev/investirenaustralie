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
											<label>@lang('app.txt.iicc_mobile')</label> 
											<input type="text" placeholder="@lang('app.txt.mobile')" class="form-control" name="iicc_mobile" value="{{old('iicc_mobile')?old('iicc_mobile'):($item->get_meta('iicc_mobile')?$item->get_meta('iicc_mobile')->value:'')}}">
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
	jQuery.validator.addMethod("phoneAUS", function (iicc_mobile, element) {
        iicc_mobile = iicc_mobile.replace(/\s+/g, "");
        return this.optional(element) || iicc_mobile.length > 9 && iicc_mobile.match(/^(?:\+?(61))? ?(?:\((?=.*\)))?(0?[2-57-8])\)? ?(\d\d(?:[- ](?=\d{3})|(?!\d\d[- ]?\d[- ]))\d\d[- ]?\d[- ]?\d{3})$/);
    }, "Enter a valid number please (Ex: 61 7 05 060 768 OR +61 7 35 642 234 OR 0735 642 342)");
	
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
				phoneAUS: true
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