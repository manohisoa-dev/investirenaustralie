@extends('V2.layouts.app')


@section('content')

<!-- Page Title -->
@component('V2.includes.breadcrumb')
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
                            <h2>Acceptance Page - Seller</h2> 
                    </div>                     
                </div>                 
            </div>             
        </div>
    </div>
    <div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
          <div class="modal-content dark-bg">
              <div class="modal-header" style="background-color: #AE4435 !important;">
                  <h4 class="modal-title white-color">{{$page->title}}</h4>
              </div>
              <div class="modal-body">
                  <p class="text-justify">{{$page->content}}</p>
              </div>
              <div class="modal-footer">
                  <a type="button" class="pull-left m-btn m-btn-theme" href="javascript:history.back()">@lang('app.btn.abandonner')</a>
                  <a type="button" class="m-btn m-btn-theme2nd" href="#section1" id="custom-close">@lang('app.btn.continuer')</a>
              </div>
          </div>
      </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="col-md-12">
                    <h4 class="title wow slideInLeft" style="visibility: hidden; animation-name: none;">
                        SELLER'S AGREEMENT</h4>
                </div>
                <section class="at-faq-sec">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="" method="post">
                                <div class="panel-group">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <i class="more-less glyphicon glyphicon-plus"></i>
                                                STEP 1 – Terms and Conditions of Use
                                            </h4>
                                        </div>
                                            <div class="panel-body">
                                                The Seller acknowledges having read the Terms and Conditions of Use of the site
                                                "Investir en Australie" and declares to accept them without any reservation
                                                <br>
                                                <label data-pg-collapsed>
                                                    <input class="control-label" type="checkbox" name="condition[]" value="1" id="condition1" >    I agree   *
                                                </label>
                                            </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                                    STEP 2 – Legal compliance of products
                                            </h4>
                                        </div>
                                            <div class="panel-body">
                                                The Seller makes the commitment, under its sole responsibility, to display on "Investir en Australie"
                                                site only products that can be sold to non-resident foreigners in accordance with Australian law and the
                                                rules applicable by the Foreign Investment Review Board (FIRB).<br>
                                                <label data-pg-collapsed>
                                                    <input class="control-label" type="checkbox" value="1" id="condition2" name="condition[]">   &nbsp;I agree   *
                                                </label>
                                            </div>
                                    </div>
                                </div>
                                 <p class="help-block">
                                        <em>(*) Required field</em>
                                 </p>
                                <a class="pull-left m-btn m-btn-theme btn-lg text-center" href="/">@lang('app.btn.cancel')</a>
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