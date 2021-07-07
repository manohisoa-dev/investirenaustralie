@extends('layouts.backend')

@section('subcontent')
<div class="col-lg-8 col-xl-9">
    <div class="profile-content-area m-40px-tb">
		<div class="card m-40px-b">
			<div class="card-header">
				<div class="row">
					<div class="col-5 col-lg-8">
						<span class="h6 font-w-500">{{$title}}</span>
					</div>
					<div class="col-7 col-lg-4 text-right">
						<a href="javascript:void(0)" onclick="ajouter()" class="m-btn m-btn-radius m-btn-theme m-btn-sm">@lang('app.btn.add') </a>
					</div>
				</div>
			</div>
			<div class="card-body">
			@if(count($records) > 0)
				<table class="table table-bordered" style="font-size:12px">
					<thead>
						<tr>
							<th>ID</th>
							<th>Message</th>
							<th>Statut</th>
							<th>Date création</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					@foreach($records as $index =>$record)
						<tr>
							<td>{{$index + $records->firstItem()}}</td>
							<td>{!! $record->contenu !!}</td>
							<td>{{ $record->statut }}</td>
							<td>{{$record->created_at ? $record->created_at->diffForHumans() : ""}}</td>
							<td align="center">
								<a href="javascript:void(0)" onclick="edit_testimonial({{$record->id}})" class="" title="@lang('app.table.btn_title_modification')">
									<i class="fa fa-edit"></i>
								</a>&nbsp;
								<a href="javascript:void(0)" onclick="supprimer({{$record->id}})" class="" title="@lang('app.table.btn_title_delete')">
									<i class="fa fa-trash text-danger"></i>
								</a>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection

@push('script')
<script src="{{asset('administrator/plugins/ckeditor/ckeditor.js')}}"></script>
<script src="{{ asset('administrator/js/plugins/validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('administrator/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script type="text/javascript">
function ajouter()
{
	save_method = 'add';
	$('#form_testimonial')[0].reset();
	$('.form-group').removeClass('has-error');
	$('.help-block').empty(); 
	$('#modal_form_testimonial').modal('show'); 
	CKEDITOR.replace( 'contenu' );
	$('.modal-title').text("Nouveau message");
}

function edit_testimonial(id)
{
	save_method = 'update';
	$('#form_testimonial')[0].reset(); 
	$('.form-group').removeClass('has-error'); 
	$('.help-block').empty(); 


	//Ajax Load data from ajax
	$.ajax({
		url : "{{ route('ajaxGetTestimonialById') }}",
		type: "POST",
		dataType: "JSON",
		data:{"_token": "{{ csrf_token() }}",'id':id},
		success: function(data)
		{
			$('[name="id"]').val(data.testimonial.id);
			$('#contenu').val(data.testimonial.contenu);
			CKEDITOR.replace( 'contenu' );
			$('#modal_form_testimonial').modal('show'); 
			$('.modal-title').text("Modification"); 
		}
	});
}

function save_temoignage()
{
	var url;
	var form = $("#form_testimonial");

	if(save_method == 'add') {
		url = "{{ route('member.ajaxSaveTestimonial') }}";
	} else {
		url = "{{ route('ajaxModifTestimonial') }}";
	}
	
	form.validate({
		rules: {
			contenu: {
				required: true
			}
		},
		messages: {
			contenu: {
				required: "@lang('app.txt.champobligatoire')"
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
	
	
	// ajax adding data to database
	if (form.valid() === true) {
		var formData = new FormData($('#form_testimonial')[0]);
		formData.append('contenu', CKEDITOR.instances['contenu'].getData());
		$.ajax({
			url : url,
			type: "POST",
			data: formData,
			cache: false,
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

function supprimer(id)
{
	swal({
		title: "@lang('member.menu_temoignage')",
		text: "Voulez-vous supprimer",
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
				url : "{{ route('ajaxDropTestimonial') }}",
				type: "POST",
				dataType: "JSON",
				data:{"_token": "{{ csrf_token() }}",'id':id},
				success: function(data)
				{
					swal("@lang('member.menu_temoignage')", "Témoignage bien supprimé", "success");
					location.reload();	
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					swal("@lang('member.menu_temoignage')", "@lang('app.jquery.error_delete')", "error");
					location.reload();	
				}
			}); 
		} else {
			swal("@lang('app.products')", "@lang('app.jquery.delete_cancel')", "error");
		}
	 });
}
</script>
<div class="modal inmodal fade" id="modal_form_testimonial" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<form action="#" id="form_testimonial" class="form-horizontal" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="contenu">Message</label>
						<textarea name="contenu" rows="10" id="contenu" class="form-control"></textarea>
					</div> 
					<input type="hidden" name="id" />
					<input type="hidden" name="user_create" value="{{Auth::user()->id}}" />
					<input type="hidden" name="pays" value="{{Auth::user()->location->country}}" />
					<input type="hidden" name="statut" value="Bloqué" />
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">@lang('app.txt.close')</button>
				<button type="button" class="btn btn-primary" id="btnSave" onClick="save_temoignage()">@lang('app.form.product_btn_save')</button>
			</div>
		</div>
	</div>
</div>
@endpush