<?php
/* @var $gen \Nvd\Crud\Commands\Crud */
/* @var $fields [] */
?>

@extends('<?=config('crud.layout')?>')

@section('title', '<?= $gen->titlePlural() ?> - Edition ')

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
                <strong>Edition</strong>
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
                <h5>Mise à jour <?=$gen->titleSingular()?> : {{$<?=$gen->modelVariableName()?>-><?=array_values($fields)[1]->name?>}}</h5>
            </div>
            <div class="ibox-content">
                <form action="{{ route('<?=$gen->generateRouteAction('index')?>')}}/{{$<?=$gen->modelVariableName()?>->id}}" method="post">

                    {{ csrf_field() }}

                    {{ method_field("PUT") }}
                        <?php foreach ( $fields as $field )  { ?>
                        <?php if( $str = \Nvd\Crud\Db::getFormInputMarkup( $field, $gen->modelVariableName() ) ) { ?>

                            <?=$str?>

                        <?php } ?>
                        <?php } ?>

                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Enregistrer</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
