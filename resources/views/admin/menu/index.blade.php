@extends('admin.layouts.app')

@section('title', 'Menus - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Menus</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.menu.index') }}">Menus</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <?php /*?><a href="{{ route('admin.menu.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> @lang('app.admin.menu.createBtn')            
			</a><?php */?>
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Menus</h5>
			</div>
			<div class="ibox-content">
				<div class="table-responsive">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
						{!!\Nvd\Crud\Html::sortableTh('id','admin.menu.index','ID')!!}
						{!!\Nvd\Crud\Html::sortableTh('menu_photo','admin.menu.index','Photo')!!}
						{!!\Nvd\Crud\Html::sortableTh('libelle','admin.menu.index','Libelle')!!}													
						{!!\Nvd\Crud\Html::sortableTh('parent_id','admin.menu.index','Menu parent')!!}
						{!!\Nvd\Crud\Html::sortableTh('created_at','admin.menu.index','Crée le')!!}
						<th><a href="javascript:void(0)">Actions</a></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
							<td width="5%"><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
							<td><input type="text" class="form-control" name="menu_photo" value="{{Request::input("menu_photo")}}"></td>
							<td><input type="text" class="form-control" name="libelle" value="{{Request::input("libelle")}}"></td>
							<td>
								<select class="form-control" name="parent_id">
									<option value="0">Aucun</option>
									@foreach($menus as $menu)
										<option value="{{$menu->id}}"> {{$menu->libelle}}</option>
									@endforeach
								</select>
							</td>
							<td><input type="text" class="form-control" name="created_at" value="{{Request::input("created_at")}}"></td>
							<td style="min-width: 6em;">@include('vendor.crud.single-page-templates.common.search-btn')</td>
                        </form>
                    </tr>
                    </thead>

                    <tbody>
                        @forelse ( $records as $index =>$record )
                            <tr>
								<td>{{ $index + $records->firstItem() }}</td>
								<td><img src="{{asset('images/slider/'.$record->photo)}}" style="height:80px" /></td>
                                <td>
                                    <span class="editable"
                                          data-type="text"
                                          data-name="menu"
                                          data-value="{{ $record->menu }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.menu.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->libelle }}</span>
                                 </td>
                                 <td>
                                     <span class="editable"
                                          data-type="text"
                                          data-name="parent_id"
                                          data-value="{{ $record->parent_id }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.menu.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >
										  @if($record->parent_id !=0)
										  	{{\App\Models\Menu::find($record->parent_id)->libelle}}
										  @else
										  	Aucun
										  @endif
										  </span>
                                  </td>
                                  <td>{{ $record->created_at ? $record->created_at->diffForHumans() : '' }}</td>
								  <td class="actions-cell text-center" width="7%">
									<form class="form-inline" action="{{route('admin.menu.index')}}/{{$record->id}}" method="POST">
									<?php /*?><a href="{{route('admin.menu.index')}}/{{$record->id}}" title="Détail" class="btn btn-default btn-circle">
										<i class="fa fa-eye"></i>
									</a>&nbsp;&nbsp;<?php */?>
									
									<a href="{{route('admin.menu.index')}}/{{$record->id}}/edit" title="Modification" class="btn btn-default btn-circle">
										<i class="fa fa-pencil-square-o"></i>
									</a>&nbsp;&nbsp;
									
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<?php /*?><button class="btn btn-default btn-circle text-danger" 
											onclick="return confirm('Vous êtes sur?')"
											type="submit" title="Suppression"><i class="fa fa-times text-danger"></i></button><?php */?>
									</form>
								  </td>
                                  
                            </tr>
                        @empty
                            @include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 6])
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
</div>
@endsection
