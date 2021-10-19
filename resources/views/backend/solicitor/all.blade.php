@extends('layouts.backend')

@section('subcontent')

    <div class="profile-content-area m-40px-tb card card-body">
        <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
            <h5>{{$title}}</h5>
            <div class="row">
                <div class="col-md-12 m-10px-tb">
                    <div class="media">
                        <div class="media-body p-15px-l lh-normal">
                            <a href="javascript:void(0)" onclick="add_solicitor()"  class="m-btn m-btn-radius m-btn-theme pull-right btn-sm">
								Ajouter
							</a>
							<div style="clear:both"></div>
							<div style="margin-top:20px">
								<table class="table table-bordered" style="font-size:12px">
									<thead>
										<tr>
											<th>Nom cabinet</th>
											<th>CP</th>
											<th>Email</th>
											<th>Tél</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
									@foreach($solicitors as $index =>$record)
									<tr>
										<td>{{$record->cabinet_name}}</td>
										<td>{{$record->cabinet_cp}}</td>
										<td>{{$record->cabinet_email}}</td>
										<td>{{$record->cabinet_phone}}</td>
										<td align="center">
											<a href="javascript:void(0)" onclick="editer_solicitor({{$record->id}})" class="" title="@lang('app.table.btn_title_modification')">
												<i class="fa fa-edit"></i>
											</a>&nbsp;
											<a href="javascript:void(0)" onclick="delete_solicitor({{$record->id}})" class="" title="@lang('app.table.btn_title_delete')">
												<i class="fa fa-trash text-danger"></i>
											</a>
										</td>
									</tr>
									@endforeach
									</tbody>
								</table>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
<script src="{{ asset('administrator/js/plugins/validate/jquery.validate.min.js') }}"></script>
<script>
function add_solicitor()
{
	save_method = 'add';
	$('#form_solicitor')[0].reset();
	$('.form-group').removeClass('has-error');
	$('.help-block').empty(); 
	$('#modal_form_solicitor').modal('show'); 
	$('.modal-title').text('Nouveau solicitor');
}

function save_solicitor()
{
	var url;
	var form = $("#form_solicitor");

	if(save_method == 'add') {
		url = "{{ route('ajaxSaveSolicitor') }}";
	} else {
		url = "{{ route('ajaxModifSolicitor') }}";
	}
	
	form.validate({
		rules: {
			cabinet_name: {
				required: true
			},
			cabinet_email: {
				required: true,
				email: true
			},
			cabinet_cp: {
				required: true
			},
			cabinet_phone: {
				required: true
			}
		},
		messages: {
			cabinet_name: {
				required: "@lang('app.txt.champobligatoire')"
			},
			cabinet_email: {
				required: "@lang('app.txt.champobligatoire')",
				email: "Valide email"
			},
			cabinet_cp: {
				required: "@lang('app.txt.champobligatoire')"
			},
			cabinet_phone: {
				required: "@lang('app.txt.champobligatoire')"
			}
		},
		errorPlacement: function ( error, element ) {
			if(element.parent().hasClass('input-group')){
			  error.insertAfter( element.parent() );
			}else{
				error.insertAfter( element );
			}
		},
	});
	
	// ajax adding data to database
	if (form.valid() === true) {
		var formData = new FormData($('#form_solicitor')[0]);
		$.ajax({
			url : url,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			dataType: "JSON",
			success: function(data)
			{
				location.reload();
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

function editer_solicitor(id)
{
	save_method = 'update';
	$('#form_solicitor')[0].reset(); 
	$('.form-group').removeClass('has-error'); 
	$('.help-block').empty(); 


	//Ajax Load data from ajax
	$.ajax({
		url : "{{ route('ajaxGetSolicitorById') }}",
		type: "POST",
		dataType: "JSON",
		data:{"_token": "{{ csrf_token() }}",'id':id},
		success: function(data)
		{
			$('[name="id"]').val(data.solicitor.id);
			$('[name="cabinet_name"]').val(data.solicitor.cabinet_name);
			$('[name="cabinet_email"]').val(data.solicitor.cabinet_email);
			$('[name="cabinet_cp"]').val(data.solicitor.cabinet_cp);
			$('[name="cabinet_phone"]').val(data.solicitor.cabinet_phone);
			
			$('#modal_form_solicitor').modal('show'); 
			$('.modal-title').text("Modifier solicitor"); 
		}
	});
}

function delete_solicitor(id)
{
	swal({
		title: "Solicitor",
		text: "@lang('app.dropzone.delete_photo_confirme')",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#ff3547',
		confirmButtonText: "@lang('app.yes')",
		cancelButtonText: "@lang('app.no')",
		closeOnConfirm: false,
		closeOnCancel: false
	 },
	 function(isConfirm){	
	   if (isConfirm){
			 $.ajax({
				url : "{{ route('ajaxDropSolicitor') }}",
				type: "POST",
				dataType: "JSON",
				data:{"_token": "{{ csrf_token() }}",'id':id},
				success: function(data)
				{
					swal("Solicitor", "@lang('app.jquery.delete_product_yes')", "success");
					location.reload();	
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					swal("Solicitor", "@lang('app.jquery.error_delete')", "error");
					location.reload();	
				}
			}); 
		} else {
			swal("Solicitor", "@lang('app.jquery.delete_cancel')", "error");
		}
	 });
}
</script>

<div class="modal fade" id="modal_form_solicitor" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
				<h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                
            </div>
            <div class="modal-body">
				 <form action="#" id="form_solicitor" class="form-horizontal">
                    <div class="form-body">
						{{ csrf_field() }}
						<input type="hidden" value="" name="id" />
						<div class="form-group">
							<label class="control-label">Nom du cabinet *</label>
							<input type="text" class="form-control" name="cabinet_name" id="cabinet_name">
						</div>
						<div class="form-group">
							<label class="control-label">Email cabinet *</label>
							<input type="email" class="form-control" name="cabinet_email" id="cabinet_email">
						</div>						
						<div class="row">
							<div class="col-md-6">								
								<div class="form-group">
									<label class="control-label">CP *</label>
									<input type="text" class="form-control" name="cabinet_cp" id="cabinet_cp">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Tél *</label>
									<input type="text" class="form-control" name="cabinet_phone" id="cabinet_phone">
								</div>
							</div>
						</div>
						
					</div>
				</form>
			</div>
			<div class="modal-footer">
                <button type="button" id="btnSave" onClick="save_solicitor()" class="btn btn-primary">Enregistrer</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
            </div>
		</div>
	</div>
</div>
@endpush
