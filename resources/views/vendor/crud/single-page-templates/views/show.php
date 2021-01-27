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
        <strong>Détail</strong>
    </li>
</ol>
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