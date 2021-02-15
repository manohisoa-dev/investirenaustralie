@extends('layouts.app')


@section('content')

<!-- Page Title -->
@component('includes.breadcrumb')
    @lang('inscriptionapl')
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

<div id="section1" class="p-100px-tb">
<div id="property-single">
    <div class="main-slider-wrapper clearfix content corps gery"> 
        <div id="slider"> 
            <div class="container text-center"> 
                <div class="jumbotron"> 
                        <h2>@lang('app.apl')</h2> 
                </div>                     
            </div>                 
        </div>             
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12">
                    <h4 class="title wow slideInLeft" style="visibility: hidden; animation-name: none;">
                        Page d'acceptation des Agences Partenaires Locales</h4>
                </div>
                <!-- Faq start from here -->
                <section class="at-faq-sec">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" role="form" id="particulierForm" action="" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <div class="panel-group">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                                    POINT 1 – Mission d'Information, d'Orientation et de Promotion (MIOP)

                                                </h4>
                                            </div>
                                            <div class="panel-body">
                                                L'Agence Partenaire Locale accepte la Mission d'Information, d'Orientation et de Promotion qui consiste d'une part à informer et orienter les Membres du site IEA qui sont engagés dans une relation exclusive avec elles, et d'autre part d'assurer le placement des produits affichés par des initiatives promotionnelles ciblées propres. <br>
                                                <label data-pg-collapsed>
                                                    <input class="control-label jm" type="checkbox" value="1" required name="condition[]">   &nbsp;     J'accepte *
                                                </label>
                                            </div>
                                        </div>

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                                        POINT 2 - Sécurisation du marché des APL
                                                </h4>
                                            </div>
                                            <div class="panel-body">
                                                L'Agence Partenaire Locale accepte la sécurisation du lien que des Membres ont établi en choisissant d'établir une relation d'exclusivité avec elle. Ceci sera détaillé dans le contrat qui lui sera proposé dans la suite de la procédure. <br>
                                                <label data-pg-collapsed>
                                                    <input class="control-label jm" type="checkbox" value="1" required name="condition[]">   &nbsp;     J'accepte *
                                                </label>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                                        POINT 3 - Sécurisation de la relation d'affaires entre IEA et l'APL
                                                </h4>
                                            </div>
                                            <div class="panel-body">
                                                L'Agence Partenaire Locale accepte la sécurisation de la relation d'affaires entre IEA et elle-même qui comporte des clauses de non concurrence et de loyauté nécessaires et essentielles dans un marché virtuel. Ceci sera détaillé dans le contrat qui lui sera proposé dans la suite de la procédure. <br>
                                                <label data-pg-collapsed>
                                                    <input class="control-label jm" type="checkbox" value="1" required name="condition[]">   &nbsp;     J'accepte *
                                                </label>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                                        POINT 4 – Rémunération de l'APL
                                                </h4>
                                            </div>
                                            <div class="panel-body">
                                                L'Agence Partenaire Locale accepte les montants et la procédure de la rémunération établis par IEA. En cas d'achat d'un bien par un des Membres qui lui est lié par une relation d'exclusivité, le taux de rémunération normal de l'APL est de 0,5% du prix de vente du bien exprimé en dollars australiens. Si l'APL a été à l'origine d'un volume d'affaires égal ou supérieur à 2 500 000 dollars australiens au cours d'un exercice, le taux de sa rémunération est porté à 1% du prix de vente du bien exprimé en dollars australiens. Le versement de la rémunération s'effectue par une procédure automatisée à 30 jours fin de mois après la perception par IEA de sa propre rémunération.
                                                <br>
                                                <label data-pg-collapsed>
                                                    <input class="control-label jm" type="checkbox" value="1" required name="condition[]">   &nbsp;     J'accepte *
                                                </label>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                                        POINT 5
                                                </h4>
                                            </div>
                                            <div class="panel-body">
                                                L'Agence Partenaire Locale reconnaît avoir pris connaissance des Termes et Conditions d'Utilisation du site "Investir en Australie" et déclare les accepter sans aucune réserve.
                                                <br>
                                                <label data-pg-collapsed>
                                                    <input class="control-label jm" type="checkbox" value="1" required name="condition[]">   &nbsp;     J'accepte *
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <p class="help-block">
                                      <em>(*) Champ obligatoire</em>
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