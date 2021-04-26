@extends('admin.layouts.app')

@section('title', 'Firb - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Firb</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.firb.index') }}">Firb</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ route('admin.firb.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Ajouter un nouveau Firb            </a>
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Firb</h5>
			</div>
			<div class="ibox-content">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
						{!!\Nvd\Crud\Html::sortableTh('id','admin.firb.index','Id')!!}
						{!!\Nvd\Crud\Html::sortableTh('label','admin.firb.index','Label')!!}
						{!!\Nvd\Crud\Html::sortableTh('created_at','admin.firb.index','Crée le')!!}
						{!!\Nvd\Crud\Html::sortableTh('updated_at','admin.firb.index','Modifié le')!!}
						<th><a href="javascript:void(0)">Actions</a></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
							<td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
							<td><input type="text" class="form-control" name="label" value="{{Request::input("label")}}"></td>
							<td><input type="text" class="form-control" name="created_at" value="{{Request::input("created_at")}}"></td>
							<td><input type="text" class="form-control" name="updated_at" value="{{Request::input("updated_at")}}"></td>
							<td style="min-width: 6em;">@include('vendor.crud.single-page-templates.common.search-btn')</td>
                        </form>
                    </tr>
                    </thead>

                    <tbody>
                        @forelse ( $records as $record )
                            <tr>
                                <td>{{ $record->id }}</td>
                                <td>
                                    <span class="editable"
                                          data-type="text"
                                          data-name="label"
                                          data-value="{{ $record->label }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.firb.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->label }}</span>
                                 </td>
                                 <td>{{$record->created_at ? $record->created_at->diffForHumans() : ""}}</td>
                                 <td>{{$record->updated_at ? $record->updated_at->diffForHumans() : ""}}</td>
								 <td class="actions-cell">
								<form class="form-inline" action="{{route('admin.firb.index')}}/{{$record->id}}" method="POST">
									<a href="{{route('admin.firb.index')}}/{{$record->id}}" class="btn btn-default btn-circle" title="Voir">
										<i class="fa fa-eye"></i>
									</a>&nbsp;&nbsp;
								
									<a href="{{route('admin.firb.index')}}/{{$record->id}}/edit" class="btn btn-default btn-circle" title="Modification">
										<i class="fa fa-pencil-square-o"></i>
									</a>&nbsp;&nbsp;
								
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<button class="btn btn-default btn-circle"
											onclick="return confirm('Are You Sure?')"
											type="submit" title="Supprimer"><i class="fa fa-times text-danger"></i></button>
								</form>
								</td>
                            </tr>
                        @empty
                            @include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 5])
                        @endforelse
                    </tbody>

                </table>

                @include('vendor.crud.single-page-templates.common.pagination', [ 'records' => $records ] )

				<script>
					$(".editable").editable({ajaxOptions:{method:'PUT'}});
				</script>
			</div>
		</div>
	</div>
</div>
@endsection
