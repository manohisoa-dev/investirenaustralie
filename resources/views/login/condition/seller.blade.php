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
                        <h2>@lang('seller.acceptance_page')</h2>
                    </div>                     
                </div>                 
            </div>             
        </div>
    </div>
    <div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content white-bg">
                <div class="modal-header border-radius-0" style="background-color: #AE4435 !important;">
                  <h4 class="modal-title white-color">{{$page->title}}</h4>
                </div>
                <div class="modal-body">
                    <p class="text-justify">{{$page->content}}</p>
                    <div class="row m-50px-t">
                        <div class="col-md-12">
                            <select class="form-control" id="seller_class" name="seller_class">
                                <option value="" selected disabled>@lang('seller.choose_your_seller_class')</option>
                                <option value="real_estate_professionals" {{ old('seller_class')=='real_estate_professionals'?'selected':'' }}>@lang('seller.real_estate_professionals')</option>
                                <option value="non_professional_legal_persons" {{ old('seller_class')=='non_professional_legal_persons'?'selected':'' }}>@lang('seller.non_professional_legal_persons')</option>
                                <option value="non_professional_natural_persons" {{ old('seller_class')=='non_professional_natural_persons'?'selected':'' }}>@lang('seller.non_professional_natural_persons')</option>
                                <option value="seller_by_afa" {{ old('seller_class')=='seller_by_afa'?'selected':'' }}>@lang('seller.seller_by_afa')</option>
                            </select>
                        </div>
                    </div>
                    <span class="error-msg text-danger p-25px-t"></span>
                </div>
                <div class="modal-footer">
                    <a type="button" class="pull-left m-btn m-btn-theme" href="javascript:history.back()">@lang('app.btn.abandonner')</a>
                    <a type="button" class="m-btn m-btn-theme2nd" href="#section1" id="custom-close">@lang('app.btn.continuer')</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        @include('includes.alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12">
                    <h4 class="title wow slideInLeft" style="visibility: hidden; animation-name: none;">
                        {{ strtoupper(trans('seller.sellers_aggreement')) }}</h4>
                </div>
                <section class="at-faq-sec">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('register.show', ['role'=>'seller']) }}" method="get">
                                    <div class="panel-group">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                        <input type="hidden" id="class" name="class">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                                    @lang('seller.condition.step_1')
                                                </h4>
                                            </div>
                                                <div class="panel-body">
                                                    @lang('seller.condition.step_1.content')
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
                                                        @lang('seller.condition.step_2')
                                                </h4>
                                            </div>
                                                <div class="panel-body">
                                                    @lang('seller.condition.step_2.content')
                                                    <br>
                                                    <label data-pg-collapsed>
                                                        <input class="control-label" type="checkbox" value="1" id="condition2" name="condition[]" required>   &nbsp; @lang('app.txt.agree')   *
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
    <script type="text/javascript">
        $(document).ready(function(){
            var classSess = sessionStorage.getItem("class");
            
            if(classSess == null){
                $('#myModal').modal('show');
            }else{
                if(classSess == 'seller_by_afa'){
                    return location.href=("{{ route('register', ['role'=>'seller']) }}?class=seller_by_afa");
                }
            }          
        });

        $("#custom-close").on('click', function() {
            var val = $('#seller_class').val();
            sessionStorage.setItem("class",val);

            if(val!==null){
                $('#class').val(val);
                if(val == 'seller_by_afa'){
                    
                    return location.href=("{{ route('register', ['role'=>'seller']) }}?class=seller_by_afa");
                }
                
                $('#myModal').modal('hide');
            }else{
                $('.error-msg').html('* Please choose your seller class');
            }

            return false;
        });

        $("#seller_class").on('change', function() {
            // Reinitialize error message
            return $('.error-msg').html('');
        });

        $("#btn_cancel").on('click', function() {
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