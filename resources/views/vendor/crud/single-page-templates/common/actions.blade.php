<?php
/* @var $url */
/* @var $record */
?>
<td class="actions-cell text-center" width="7%">
<form class="form-inline" action="{{$url}}/{{$record->id}}" method="POST">
    <a href="{{$url}}/{{$record->id}}" title="Détail"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;

    <a href="{{$url}}/{{$record->id}}/edit" title="Modification"><i class="fa fa-pencil-square-o"></i></a>

    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button style="outline: none;background: transparent;border: none;"
            onclick="return confirm('Vous êtes sur?')"
            type="submit" class="fa fa-trash text-danger" title="Suppression"></button>
</form>
</td>