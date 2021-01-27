<?php
/* @var $gen \Nvd\Crud\Commands\Crud */
/* @var $fields [] */
?>
@extends('<?=config('crud.layout')?>')

@section('breadcrumb')
<h2><?= $gen->titlePlural() ?></h2>
<ol class="breadcrumb">
    <li>
        <a href="#"><?= $gen->titlePlural() ?></a>
    </li>
    <li>
        <a href="{{ route('<?= $gen->generateRouteAction('index') ?>') }}">Listes</a>
    </li>
    <li class="active">
        <strong>Ajout</strong>
    </li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Ajouter un nouveau <?=$gen->titleSingular()?></h5>
            </div>
            <div class="ibox-content">
                <form class="form-validation form-padding" action="{{ route('<?=  $gen->generateRouteAction('store') ?>') }}" method="post">

                    {{ csrf_field() }}
            <?php foreach ( $fields as $field )  { ?>
                <?php if( $str = \Nvd\Crud\Db::getFormInputMarkup($field) ) { ?>

                    <?=$str?>

                <?php } ?>
            <?php } ?>

                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Créer</button>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
