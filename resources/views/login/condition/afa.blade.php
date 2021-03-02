@extends('layouts.app')


@section('content')

<!-- Page Title -->
@component('includes.breadcrumb')
    @lang('inscriptionafa')
@endcomponent
<!-- Section -->

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

<!-- content -->
<div id="section1" class="p-100px-tb">
    @include('includes.alerts')
<div id="property-single"> 
    <div class="main-slider-wrapper clearfix content corps"> 
        <div id="slider"> 
            <div class="container text-center"> 
                <div class="jumbotron"> 
                        <h2>Australian Francophone Agents</h2> 
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

                            <form action="" method="post">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <div class="panel-group">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                                    STEP 1 – Francophone service
                                            </h4>
                                        </div>
                                            <div class="panel-body">
                                                The Australian francophone Agent commits to providing a service in french to
                                                prospectice or actual purchasers. <br>
                                                <label data-pg-collapsed> 
                                                    <input class="control-label" type="checkbox" name="condition[]" id="condition1" value="1" >   &nbsp;     I agree *
                                                </label>
                                            </div>
                                    </div>

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                                    STEP 2 – Clientele Introductory Fee
                                            </h4>
                                        </div>
                                            <div class="panel-body">
                                                The Australian Francophone Agent accepts that a clientele introductory fee
                                                ("Commission de Présentation de Clientèle" - CPC) will be due to the company
                                                managing IEA website in case of actual sale of products. Therefore they
                                                commit to have the buyer pay that fee at the same time they sign the sale
                                                contract, and to pay it back to IEA website managing company without delay .
                                                <br>
                                                <label data-pg-collapsed> 
                                                    <input class="control-label" type="checkbox" name="condition[]" id="condition2" value="1" >   &nbsp;     I agree *
                                                </label>
                                            </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                                    STEP 3 – Terms and Conditions of Use
                                            </h4>
                                        </div>
                                            <div class="panel-body">
                                                The Australian Francophone Agent acknowledges having read the Terms and Conditions of Use of the
                                                site "Investir en Australie" and declares to accept them without any reservation. <br>
                                                <label data-pg-collapsed> 
                                                    <input class="control-label" type="checkbox" name="condition[]" id="condition3" value="1" >   &nbsp;     I agree *
                                                </label>
                                            </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                                    STEP 4 - Legal compliance of products
                                            </h4>
                                        </div>
                                            <div class="panel-body">
                                                The Australian francophone Agent makes the commitment to verify and guarantee that the products
                                                for the sale of which they are the operating agent are effectively residential, land, industrial
                                                or commercial properties which may be sold to non-resident foreigners in accordance with the
                                                Australian law and the rules applicable to foreign investment by the Foreign Investment
                                                Review Board (FIRB).<br>
                                                <label data-pg-collapsed> 
                                                    <input class="control-label" type="checkbox" name="condition[]" id="condition4" value="1" >   &nbsp;     I agree *
                                                </label>
                                            </div>
                                    </div>
                                </div>
                                 <p class="help-block">
                                        <em>(*) Required field</em>
                                 </p>
                                <a class="pull-left m-btn m-btn-theme btn-lg text-center" href="/">@lang('app.btn.abandonner')</a>
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

