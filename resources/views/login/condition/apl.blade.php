@extends('layouts.app')


@section('content')

<!-- Page Title -->
@component('includes.breadcrumb')
    @lang('inscriptionapl')
@endcomponent

<!-- Section -->
<div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content white-bg">
            <div class="modal-header border-radius-0" style="background-color: #AE4435 !important;">
              <h4 class="modal-title white-color">{{$page->title}}</h4>
            </div>
            <div class="modal-body">
                <p class="text-justify">{{$page->content}}</p>
            </div>
            <div class="modal-footer">
                <a type="button" class="pull-left m-btn m-btn-theme" href="{{ route('home') }}">@lang('app.btn.abandonner')</a>
                <a type="button" class="m-btn m-btn-theme2nd" href="#section1" id="custom-close">@lang('app.btn.continuer')</a>
            </div>
        </div>
    </div>
</div>

<div id="section1" class="p-100px-tb">
<div id="property-single">
    <div class="container text-center col-lg-6">
        @include('includes.alerts')
    </div>
    <div class="main-slider-wrapper clearfix content corps gery"> 
        <div id="slider"> 
            <div class="container text-center"> 
                <div class="jumbotron"> 
                    <h2>@lang('app.apl')</h2> 
                    <p>@lang('apl.local_partner_agencies_acceptance_page')</p>
                </div>                     
            </div>                 
        </div>             
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12">
                    <h4 class="title wow slideInLeft" style="visibility: hidden; animation-name: none;">
                        @lang('apl.local_partner_agencies_acceptance_page')</h4>
                </div>
                <!-- Faq start from here -->
                <section class="at-faq-sec">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" role="form" id="particulierForm" action="{{ route('register.show', ['role'=>'apl']) }}" method="get" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <div class="panel-group">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                                    @lang('apl.condition.point_1')
                                                </h4>
                                            </div>
                                            <div class="panel-body">
                                                @lang('apl.condition.point_1.content')
                                                <br>
                                                <label data-pg-collapsed>
                                                    <input class="control-label jm" type="checkbox" value="1" required name="condition[]">   &nbsp;     @lang('app.txt.agree') *
                                                </label>
                                            </div>
                                        </div>

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                                        @lang('apl.condition.point_2')
                                                </h4>
                                            </div>
                                            <div class="panel-body">
                                                @lang('apl.condition.point_2.content')
                                                <br>
                                                <label data-pg-collapsed>
                                                    <input class="control-label jm" type="checkbox" value="1" required name="condition[]">   &nbsp;     @lang('app.txt.agree') *
                                                </label>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                                        @lang('apl.condition.point_3')
                                                </h4>
                                            </div>
                                            <div class="panel-body">
                                                @lang('apl.condition.point_3.content')
                                                <br>
                                                <label data-pg-collapsed>
                                                    <input class="control-label jm" type="checkbox" value="1" required name="condition[]">   &nbsp;     @lang('app.txt.agree') *
                                                </label>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                                        @lang('apl.condition.point_4')
                                                </h4>
                                            </div>
                                            <div class="panel-body">
                                                @lang('apl.condition.point_4.content')
                                                <br>
                                                <label data-pg-collapsed>
                                                    <input class="control-label jm" type="checkbox" value="1" required name="condition[]">   &nbsp;     @lang('app.txt.agree') *
                                                </label>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                                        @lang('apl.condition.point_5')
                                                </h4>
                                            </div>
                                            <div class="panel-body">
                                                @lang('apl.condition.point_5.content')
                                                <br>
                                                <label data-pg-collapsed>
                                                    <input class="control-label jm" type="checkbox" value="1" required name="condition[]">   &nbsp;     @lang('app.txt.agree') *
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <p class="help-block">
                                      <em>(*) @lang('app.txt.champobligatoire')</em>
                                    </p>
                                     <a class="pull-left m-btn m-btn-theme btn-lg text-center" href="{{route('home')}}">@lang('app.btn.abandonner')</a>
                                     <button type="submit" class="pull-right m-btn m-btn-theme2nd btn-lg text-center btnNextProcedure">@lang('app.btn.continuer')</button>
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
            $('#myModal').modal('show');
        });

        //fermeture du modal
        $("#custom-close").on('click', function() {
            $('#myModal').modal('hide');
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