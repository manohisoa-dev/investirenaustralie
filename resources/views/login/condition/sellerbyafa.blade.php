@extends('layouts.app')


@section('content')

<!-- Page Title -->
@component('includes.breadcrumb')
    @lang('inscriptionseller')
@endcomponent

<!-- Section -->
<div id="section1" class="p-100px-tb">
<div id="property-single">
    <div class="container">
        <div class="main-slider-wrapper clearfix content corps gery"> 
            <div id="slider"> 
                <div class="container text-center"> 
                    <div class="jumbotron"> 
                        <h2>@lang('seller.seller_by_afa_acceptance_page')</h2> 
                    </div>                     
                </div>                 
            </div>             
        </div>
    </div>
    {{-- Modal --}}
    <div class="modal fade" id="loginModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">@lang('app.txt.afa_login')</h5>
            </div>
            <div class="modal-body">
                <form action="{{route('login.sellerbyafa')}}" id="afaLoginForm" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="form-control-label">@lang('app.txt.afa_name') *</label>
                        <input type="text" name="name" class="form-control" placeholder="@lang('app.txt.afa_name')" value="{{ old('name')?old('name'):'' }}">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">@lang('app.txt.afa_id') *</label>
                        <input type="text" name="immat" class="form-control" placeholder="AFA-XXXXX" value="{{ old('immat')?old('immat'):'' }}">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">@lang('app.txt.afa_emailaddress') *</label>
                        <input type="email" name="email" class="form-control" placeholder="afa@email.com" value="{{ old('email')?old('email'):'' }}">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">@lang('app.txt.afa_password')</label>
                        <input type="password" name="password" class="form-control" placeholder="***********">
                    </div>
                </form>
                <span class="text-danger m-25px-t">{{ $errors->first('email') }}</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="pull-left m-btn m-btn-theme" id="btn_abondon">@lang('app.btn.abandonner')</button>
                <button type="submit" class="m-btn m-btn-theme2nd" id="btn_login">@lang('app.btn.login')</button>
            </div>
        </div>
        </div>
    </div>
    {{-- end modal --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12">
                    <h4 class="title wow slideInLeft" style="visibility: hidden; animation-name: none;">
                        {{ strtoupper(trans('seller.sellers_aggreement')) }}
                    </h4>
                </div>
                <section class="at-faq-sec">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('register.show', ['role'=>'seller']) }}" method="get">
                                    <div class="panel-group">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                        <input type="hidden" id="afa_id" name="afa_id" value="{{ session('afa_id')?session('afa_id'):'' }}">
                                        <input type="hidden" id="class" name="class" value="seller_by_afa">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                                    @lang('seller.seller_by_afa_condition.step_1')
                                                </h4>
                                            </div>
                                            <div class="panel-body">
                                                @lang('seller.seller_by_afa_condition.step_1.content')
                                                <br>
                                                <label data-pg-collapsed>
                                                    <input class="control-label" type="checkbox" name="condition[]" value="1" id="condition1" required>    @lang('app.txt.agree')   *
                                                </label>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                                        @lang('seller.seller_by_afa_condition.step_2')
                                                </h4>
                                            </div>
                                            <div class="panel-body">
                                                @lang('seller.seller_by_afa_condition.step_2.content')
                                                <br>
                                                <label data-pg-collapsed>
                                                    <input class="control-label" type="checkbox" value="1" id="condition2" name="condition[]" required>   &nbsp; @lang('app.txt.agree')   *
                                                </label>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                                        @lang('seller.seller_by_afa_condition.step_3')
                                                </h4>
                                            </div>
                                            <div class="panel-body">
                                                @lang('seller.seller_by_afa_condition.step_3.content')
                                                <br>
                                                <label data-pg-collapsed>
                                                    <input class="control-label" type="checkbox" value="1" id="condition3" name="condition[]" required>   &nbsp; @lang('app.txt.agree')   *
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="help-block">
                                            <em>(*) @lang('app.txt.champobligatoire')</em>
                                    </p>
                                    <a class="pull-left m-btn m-btn-theme btn-lg text-center" href="{{ route('home') }}" id="btn_cancel">@lang('app.btn.cancel')</a>
                                    <button type="submit" class="m-btn m-btn-theme2nd btn-lg text-center pull-right">@lang('app.btn.continuer')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('script')
    <script src="{{asset('js/myJs.js')}}"></script>
    <!-- Jquery Validate -->
    <script src="{{ asset('administrator/js/plugins/validate/jquery.validate.min.js') }}"></script>
    <script>
        $('#afaLoginForm').validate({
			ignore: [],
			rules: {
				name: {
					required: true
				},
                immat: {
					required: true
				},
                email: {
                    required: true,
                },
				password: {
					required: true
				},
			},
			messages: {
				name: {
					required: "@lang('app.txt.champobligatoire')"
				},
				immat: {
					required: "@lang('app.txt.champobligatoire')"
				},
				email: {
					required: "@lang('app.txt.champobligatoire')",
				},
				password: {
					required: "@lang('app.txt.champobligatoire')"
				},
			},
			errorPlacement: function ( error, element ) {
				if(element.parent().hasClass('input-group')){
					error.insertBefore( element.parent() );
				}else{
					error.insertAfter( element );
				}
			},
		});
        
    </script>
    <style>
        .error {
            color: #F00;
            background-color: #FFF;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            var afa_id = $('#afa_id').val();
            // sessionStorage.setItem('afa_id',afa_id);

            if(afa_id == ''){
                $('#loginModal').modal('show');
            }
        });

        // Submit afa login
        $("#btn_login").on('click', function() {
            if ($('#afaLoginForm').valid()) {
                loadingPage();
                $('#afaLoginForm').submit();
            }
            return false;
        });

        $("#btn_abondon").on('click', function() {
            sessionStorage.removeItem('class');
            sessionStorage.removeItem('afa_id');
            return location.href="/";
        });

        $("#btn_cancel").on('click', function() {
            sessionStorage.removeItem('afa_id');
            return sessionStorage.removeItem('class');
        });
    </script>
    <script type="text/javascript">
        $('body').scrollspy({
            target: '#navbar-collapsible',
            offset: 50
        });
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top - 50
                    }, 1000);
                    return false;
                }
            }
        });
    </script>
@endpush