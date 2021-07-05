@extends('admin.layouts.app')

@section('title', 'Mails Template - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Mails Template</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.mails-template.index') }}">Mails Template</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Listes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            <a href="{{ route('admin.mails-template.create') }}" type="button" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Ajouter un nouveau Mails Template            
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
				<h5>Mails Template</h5>
			</div>
			<div class="ibox-content">
                <table class="table table-striped grid-view-tbl">
                <thead>
                    <tr class="header-row">
						{!!\Nvd\Crud\Html::sortableTh('id','admin.mails-template.index','Id')!!}
						{!!\Nvd\Crud\Html::sortableTh('titre','admin.mails-template.index','Titre')!!}
						{!!\Nvd\Crud\Html::sortableTh('sujet_fr','admin.mails-template.index','Sujet fr')!!}
						{!!\Nvd\Crud\Html::sortableTh('template_fr','admin.mails-template.index','Template fr')!!}
						{!!\Nvd\Crud\Html::sortableTh('sujet_en','admin.mails-template.index','Sujet en')!!}
						{!!\Nvd\Crud\Html::sortableTh('template_en','admin.mails-template.index','Template en')!!}
						{!!\Nvd\Crud\Html::sortableTh('created_at','admin.mails-template.index','Created At')!!}
						{!!\Nvd\Crud\Html::sortableTh('updated_at','admin.mails-template.index','Updated At')!!}
						<th><a href="javascript:void(0)">Actions</a></th>
                    </tr>
                    <tr class="search-row">
                        <form class="search-form">
							<td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
							<td><input type="text" class="form-control" name="titre" value="{{Request::input("titre")}}"></td>
							<td><input type="text" class="form-control" name="sujet_fr" value="{{Request::input("sujet_fr")}}"></td>
							<td><input type="text" class="form-control" name="template_fr" value="{{Request::input("template_fr")}}"></td>
							<td><input type="text" class="form-control" name="sujet_en" value="{{Request::input("sujet_en")}}"></td>
							<td><input type="text" class="form-control" name="template_en" value="{{Request::input("template_en")}}"></td>
							<td><input type="text" class="form-control" name="created_at" value="{{Request::input("created_at")}}"></td>
							<td><input type="text" class="form-control" name="updated_at" value="{{Request::input("updated_at")}}"></td>
							<td style="min-width: 6em;">@include('vendor.crud.single-page-templates.common.search-btn')</td>
                        </form>
                    </tr>
                    </thead>

                    <tbody>
                        @forelse ( $records as $index =>$record )
                            <tr>
                                <td>{{ $index + $records->firstItem() }}</td>
                                 <td>
                                     <span class="editable"
                                          data-type="text"
                                          data-name="titre"
                                          data-value="{{ $record->titre }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.mails-template.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->titre }}</span>
                                 </td>
                                 <td>
                                      <span class="editable"
                                          data-type="text"
                                          data-name="sujet_fr"
                                          data-value="{{ $record->sujet_fr }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.mails-template.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->sujet_fr }}</span>
                                  </td>
                                  <td>
                                      <span class="editable"
                                          data-type="textarea"
                                          data-name="template_fr"
                                          data-value="{{ $record->template_fr }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.mails-template.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{str_limit(strip_tags($record->template_fr),"100","...")}}</span>
                                   </td>
								   <td>
                                      <span class="editable"
                                          data-type="text"
                                          data-name="sujet_en"
                                          data-value="{{ $record->sujet_en }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.mails-template.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{ $record->sujet_en }}</span>
                                  </td>
                                  <td>
                                      <span class="editable"
                                          data-type="textarea"
                                          data-name="template_en"
                                          data-value="{{ $record->template_en }}"
                                          data-pk="{{ $record->{$record->getKeyName()} }}"
                                          data-url="{{ route('admin.mails-template.index')}}/{{ $record->{$record->getKeyName()} }}"
                                          >{{str_limit(strip_tags($record->template_en),"100","...")}}</span>
                                   </td>
                                   <td>{{$record->created_at ? $record->created_at->diffForHumans() : ""}}</td>
                                   <td>{{ $record->updated_at ? $record->updated_at->diffForHumans() : ''}}</td>
								   <td class="actions-cell">
								   <form class="form-inline" action="{{route('admin.mails-template.index')}}/{{$record->id}}" method="POST">
										<a href="{{route('admin.mails-template.index')}}/{{$record->id}}" class="btn btn-default btn-circle" title="Voir">
											<i class="fa fa-eye"></i>
										</a>&nbsp;&nbsp;
									
										<a href="{{route('admin.mails-template.index')}}/{{$record->id}}/edit" class="btn btn-default btn-circle" title="Modification">
											<i class="fa fa-pencil-square-o"></i>
										</a>&nbsp;&nbsp;
										
										<a href="javascript:void(0)" onclick="send_email({{$record->id}})" class="btn btn-default btn-circle" title="Envoyer">
											<i class="fa fa-send-o"></i>
										</a>&nbsp;&nbsp;
									
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button type="button" class="btn btn-default btn-circle" title="Suppression" id="delRecord"><i class="fa fa-times text-danger"></i>
										</button>
									</form>
									</td>
                            </tr>
                        @empty
                            @include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 7])
                        @endforelse
                    </tbody>

                </table>

                @include('vendor.crud.single-page-templates.common.pagination', [ 'records' => $records ] )
			</div>
		</div>
	</div>
</div>
@endsection

@section('custom-script')
<script type="text/javascript">
function send_email(id_template)
{
	$('#form_send')[0].reset();
	$('.form-group').removeClass('has-error');
	$('.help-block').empty(); 
	$('#id_template').val(id_template);
	$('#modal_form_send').modal('show'); 
	$('.modal-title').text("Enovoyer email");
}

function envoyer_email()
{
	var url = "{{route('sendmail')}}";
	var form = $("#form_send");
	
	form.validate({
		rules: {
			send_to: {
				required: true
			}
		},
		messages: {
			send_to: {
				required: "@lang('app.txt.champobligatoire')",
			}
		},
		errorPlacement: function ( error, element ) {
			if(element.parent().hasClass('input-group')){
			  error.insertAfter( element.parent() );
			}else{
				error.insertAfter( element );
			}
		}
	});
	
	if (form.valid() === true) {
		var formData = new FormData($('#form_send')[0]);
		$.ajax({
			url : url,
			type: "POST",
			data: formData,
			async: true,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "JSON",
			success: function(data)
			{
				if(data.success == 'false'){
					alert('Error');
				}else{
					alert('Email envoyé');
					location.reload();
				}
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				$('#btnSave').text('Enregistrer'); //change button text
				$('#btnSave').attr('disabled',false); //set button enable 
	
			}
		});
	}else{
		$('#btnSave').attr('disabled',false);
		$(this).addClass('input-error');
	}
}
</script>
<div class="modal inmodal fade" id="modal_form_send" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<form action="#" id="form_send" class="form-horizontal">
					{{ csrf_field() }}
					<input type="hidden" name="id_template" id="id_template" />
					<div class="row">     
						<div class="col-lg-12">                              
							<div class="form-group">
								<label for="title">Langue *</label>
								<select class="form-control" name="langue">
									<option value="fr">French</option>
									<option value="en">English</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">     
						<div class="col-lg-12">                              
							<div class="form-group">
								<label for="title">Envoyer à (adresse email)*</label>
								<input type="text" name="send_to" class="form-control" />
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">@lang('app.txt.close')</button>
				<button type="button" class="btn btn-primary" id="btnSave" onClick="envoyer_email()">Envoyer</button>
			</div>
		</div>
	</div>
</div>
@endsection
