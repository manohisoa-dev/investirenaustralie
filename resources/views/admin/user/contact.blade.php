@extends('admin.layouts.app')

@section('title', 'Users - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Parties prenantes</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Liste des parties prenantes</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.user.index') }}">Listes</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Contacter</strong>
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
                <h5>Contacter {{$user->name}} ({{$user->email}})</h5>
            </div>
            <div class="ibox-content">
				<form action="{{Auth::user()->isAdmin()?route('admin.mail.compose'):route('admin.collaborators.admin.mail.compose')}}" method="post" id="commentform" class="contact-form" >
					{{ csrf_field() }}
					<input type="hidden" name="sender_id" value="{{Auth::id()}}">
					<input type="hidden" name="users[]" value="{{$user->id}}" />
					<div class="form-group">
						<label for="title">@lang('app.subject')</label>
						<input id="subject" class="form-control" name="subject" type="text" placeholder="@lang('app.subject') *" aria-required="true" required="required" value="{{$mail->subject}}">
					</div>
					<div class="form-group">
						<label for="title">@lang('app.message')</label>
						<textarea id="message" class="form-control" rows="10" name="content" placeholder="@lang('app.message')" >{{$mail->content}}</textarea>
					</div>
					<div class="hr-line-dashed"></div>
					<div>
						<button type="submit" class="btn btn-w-m btn-primary" name="method" value="send">@lang('app.btn.send')</button>
                        <button type="submit" class="btn btn-w-m btn-warning pull-right" name="method" value="draft">@lang('app.btn.draft')</button>
                        <button type="submit" class="btn btn-w-m btn-info pull-right" name="method" value="model" style="margin-right:10px">@lang('app.btn.save_as_model')</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('custom-script')
<script src="{{asset('administrator/plugins/ckeditor/ckeditor.js')}}"></script>
<script>
	$(document).ready(function(){	
		if (CKEDITOR.instances['content']) {
			CKEDITOR.instances['content'].destroy(true);
		}
		CKEDITOR.replace('content');	
		$('#commentform').validate({
			ignore: [],
			rules: {
				subject: {
					required: true
				}
			},
			messages: {
				subject: {
					required: "@lang('app.txt.champobligatoire')"
				}
			},
			errorPlacement: function ( error, element ) {
				if(element.parent().hasClass('input-group')){
					error.insertBefore( element.parent() );
				}else{
					error.insertAfter( element );
				}
			},
		});
	});
</script>
@endsection