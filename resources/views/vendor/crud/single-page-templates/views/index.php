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
                <a href="{{ route('<?= $gen->generateRouteAction('index') ?>') }}"><?= $gen->titlePlural() ?></a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ route('<?= $gen->generateRouteAction('create') ?>') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Ajouter un nouveau <?=$gen->titleSingular()?>
            </a>
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5><?= $gen->titlePlural() ?></h5>
			</div>
			<div class="ibox-content">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
                        <?php foreach ( $fields as $field )  { ?>
                            {!!\Nvd\Crud\Html::sortableTh('<?=$field->name?>','<?= $gen->generateRouteAction('index') ?>','<?=ucwords(str_replace('_',' ',$field->name))?>')!!}
                        <?php } ?>
                    <th></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
                            <?php foreach ( $fields as $field )  { ?>
                                <td><?=\Nvd\Crud\Db::getSearchInputStr($field)?></td>
                            <?php } ?>
                            <td style="min-width: 6em;">@include('<?=$gen->templatesDir()?>.common.search-btn')</td>
                        </form>
                    </tr>
                    </thead>

                    <tbody>
                        @forelse ( $records as $record )
                            <tr>
                                <?php foreach ( $fields as $field )  { ?>
                                <td>
                                    <?php if( !\Nvd\Crud\Db::isGuarded($field->name) ) {?>
                                    <span class="editable"
                                          data-type="<?=\Nvd\Crud\Html::getInputType($field)?>"
                                          data-name="<?=$field->name?>"
                                          data-value="{{ $record-><?=$field->name?> }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('<?=$gen->generateRouteAction('index')?>')}}/{{ $record->{$record->getKeyName()} }}"
                                          <?=\Nvd\Crud\Html::getSourceForEnum($field)?>>{{ $record-><?=$field->name?> }}</span>
                                    <?php } else { ?>
                                        {{ $record-><?=$field->name?> }}
                                    <?php } ?>
                                </td>
                                <?php } ?>
                                @include( '<?=$gen->templatesDir()?>.common.actions', [ 'url' => route('<?= $gen->generateRouteAction('index') ?>'), 'record' => $record ] )
                            </tr>
                        @empty
                            @include ('<?=$gen->templatesDir()?>.common.not-found-tr',['colspan' => <?=count($fields)+1?>])
                        @endforelse
                    </tbody>

                </table>

                @include('<?=$gen->templatesDir()?>.common.pagination', [ 'records' => $records ] )

				<script>
					$(".editable").editable({ajaxOptions:{method:'PUT'}});
				</script>
			</div>
		</div>
	</div>
</div>
@endsection
