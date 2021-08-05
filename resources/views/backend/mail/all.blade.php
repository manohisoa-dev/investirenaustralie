@extends('layouts.backend')

@section('subcontent')
<div class="row col-lg-8 col-xl-9">
    @include('includes.alerts')
    <div class="col-lg-8 col-xl-8">
        <div class="profile-content-area m-40px-tb card card-body">
            <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                <h5>{{isset($title)?$title:__('app.list.mail')}}</h5>
                <div class="row">
                    <div class="col-md-12 m-10px-tb">
                        <div class="media">
                            <div class="media-body p-15px-l lh-normal">
                                @foreach($items as $item)
                                    @include('backend.mail.item', ['mail'=>$item])
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>		
    </div>
    <div class="col-lg-4 col-xl-4">
        <div class="profile-content-area m-40px-tb card card-body">
            <div class="border-bottom-1 border-color-dark-gray m-35px-b p-35px-b">
                <h5>{{isset($title)?$title:__('app.list.mail')}}</h5>
                <div class="row">
                    <div class="col-md-12 m-10px-tb">
                        <div class="media">
                            <div class="media-body p-15px-l lh-normal">
								<p>
									<a href="{{route(\App\Models\User::find(Auth::id())->roleUser->role_initial.'.mail.list',['filter'=>'inbox'])}}">
										<i class="fa fa-envelope-open-text m-10px-r" aria-hidden="true"></i> 
										@lang('app.mail.inbox')
									</a>
								</p>
								<p>
									<a href="{{route(\App\Models\User::find(Auth::id())->roleUser->role_initial.'.mail.list',['filter'=>'outbox'])}}">
										<i class="fa fa-paper-plane m-10px-r" aria-hidden="true"></i> @lang('app.mail.outbox')
									</a>
								</p>
								<p>
									<a href="{{route(\App\Models\User::find(Auth::id())->roleUser->role_initial.'.mail.list',['filter'=>'draft'])}}">
										<i class="fa fa-edit m-10px-r" aria-hidden="true"></i> @lang('app.mail.draft')
									</a>
								</p>
								<p>
									<a href="javascript:void(0)" onclick="new_email()">
										<i class="far fa-envelope m-10px-r"></i> @lang('app.txt.new_mail')
									</a>
								</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<!-- Jquery Validate -->
<script src="{{ asset('administrator/js/plugins/validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('administrator/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script type="text/javascript">
function new_email()
{
	save_method = 'add';
	$('#form_new_email')[0].reset();
	$('.form-group').removeClass('has-error');
	$('.help-block').empty();
	$('#modal_form_new_email').modal('show'); 
	$('.modal-title').text("@lang('app.txt.new_mail')");
}

function send_new_email()
{
	var url = "{{ route('ajaxSendEmail') }}";
	var form = $("#form_new_email");
	
	form.validate({
		rules: {
			subject: {
				required: true
			},
			content: {
				required: true
			}
		},
		messages: {
			subject: {
				required: "@lang('app.txt.champobligatoire')"
			},
			content: {
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
		var formData = new FormData($('#form_new_email')[0]);
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
				swal({
					   title: "Contact", 
					   text: "Votre email a été bien envoyé", 
					   type: "success"
					 },
				   function(){ 
					   location.reload();
				   }
				);
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

<div class="modal inmodal fade" id="modal_form_new_email" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<form action="#" id="form_new_email" class="form-horizontal">
					{{ csrf_field() }}
					<input type="hidden" name="sender_id" value="{{Auth::id()}}" />
					<input type="hidden" name="sender_email" value="{{Auth::user()->email}}" />
					<input type="hidden" name="name" value="{{Auth::user()->name}}" />
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="form-control-label">@lang('app.subject')</label>
								<input id="subject" name="subject" type="text" placeholder="Sujet *" aria-required="true" required="required" value="{{old('subject')}}" class="form-control">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="form-control-label">@lang('app.comment')</label>
								<textarea id="content" name="content" placeholder="@lang('app.message')" cols="45" rows="8" aria-required="true" required="required" data-constraints="@Required" class="form-control">{{old('content')}}</textarea>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">@lang('app.txt.close')</button>
				<button type="button" class="btn btn-primary" id="btnSave" onClick="send_new_email()">@lang('app.btn.send')</button>
			</div>
		</div>
	</div>
</div>
@endpush
