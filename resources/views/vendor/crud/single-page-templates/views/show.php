<?php
/* @var $gen \Nvd\Crud\Commands\Crud */
/* @var $fields [] */
?>
@extends('<?=config('crud.layout')?>')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2><?= $gen->titlePlural() ?></h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#"><?= $gen->titlePlural() ?></a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('<?= $gen->generateRouteAction('index') ?>') }}">Listes</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Détail</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

    </div>
</div>

@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Détail <?= $gen->titleSingular() ?> : {{$<?= $gen->modelVariableName() ?>-><?=array_values($fields)[1]->name?>}}</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                    <?php foreach ( $fields as $field )  { ?>
                    <li class="list-group-item">
                        <h4><?=ucwords(str_replace('_',' ',$field->name))?></h4>
                        <h5>{{$<?= $gen->modelVariableName() ?>-><?=$field->name?>}}</h5>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection