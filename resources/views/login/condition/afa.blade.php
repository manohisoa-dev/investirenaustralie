@extends('layouts.app')


@section('content')

<!-- Page Title -->
@component('includes.breadcrumb')
    @lang('inscriptionafa')
@endcomponent
<!-- Section -->

<div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content white-bg">
            <div class="modal-header border-radius-0" style="background-color: #AE4435 !important;">
              <h4 class="modal-title white-color">{!!$page?$page->title:''!!}</h4>
            </div>
            <div class="modal-body">
                <p class="text-justify">{!!$page?$page->content:''!!}</p>
            </div>
            <div class="modal-footer">
                <a type="button" class="pull-left m-btn m-btn-theme" href="{{ route('home') }}">@lang('app.btn.abandonner')</a>
                <a type="button" class="m-btn m-btn-theme2nd" href="#section1" id="custom-close">@lang('app.btn.continuer')</a>
            </div>
        </div>
    </div>
</div>

<!-- content -->
<div id="section1" class="p-100px-tb">
<div id="property-single"> 
    <div class="container text-center col-lg-6">
        @include('includes.alerts')
    </div>
    <div class="main-slider-wrapper clearfix content corps"> 
        <div id="slider"> 
            <div class="container text-center"> 
                <div class="jumbotron"> 
                        <h2>@lang('afa.agreement.title')</h2> 
                </div>                     
            </div>                 
        </div>             
    </div>
    <div class="container" id="section1"> 
        <div class="row">
            <div class="col-md-12"> 
                <section class="at-faq-sec">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                            <form action="{{ route('register.show', ['role'=>'afa']) }}" method="get">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <div class="panel-group">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                                    @lang('afa.condition.step_1')
                                            </h4>
                                        </div>
                                            <div class="panel-body">
                                                @lang('afa.condition.step_1.content')
                                            <br>
                                                <label data-pg-collapsed> 
                                                    <input class="control-label" type="checkbox" name="condition[]" id="condition1" value="1" required>   &nbsp;     @lang('app.txt.agree') *
                                                </label>
                                            </div>
                                    </div>

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                                    @lang('afa.condition.step_2')
                                            </h4>
                                        </div>
                                            <div class="panel-body">
                                                @lang('afa.condition.step_2.content')
                                                <br>
                                                <label data-pg-collapsed> 
                                                    <input class="control-label" type="checkbox" name="condition[]" id="condition2" value="1" required>   &nbsp;     @lang('app.txt.agree') *
                                                </label>
                                            </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                                    @lang('afa.condition.step_3')
                                            </h4>
                                        </div>
                                            <div class="panel-body">
                                                @lang('afa.condition.step_3.content')
                                                <br>
                                                <label data-pg-collapsed> 
                                                    <input class="control-label" type="checkbox" name="condition[]" id="condition3" value="1" required>   &nbsp;     @lang('app.txt.agree') *
                                                </label>
                                            </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                                    @lang('afa.condition.step_4')
                                            </h4>
                                        </div>
                                            <div class="panel-body">
                                                @lang('afa.condition.step_4.content')
                                                <br>
                                                <label data-pg-collapsed> 
                                                    <input class="control-label" type="checkbox" name="condition[]" id="condition4" value="1" required>   &nbsp;     @lang('app.txt.agree') *
                                                </label>
                                            </div>
                                    </div>
                                </div>
                                 <p class="help-block">
                                    <em>(*) @lang('app.txt.champobligatoire')</em>
                                 </p>
                                <a class="pull-left m-btn m-btn-theme btn-lg text-center" href="{{ route('home') }}">@lang('app.btn.abandonner')</a>
                                 <button  type="submit" class="pull-right m-btn m-btn-theme2nd btn-lg text-center">@lang('app.btn.continuer')</button>
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

