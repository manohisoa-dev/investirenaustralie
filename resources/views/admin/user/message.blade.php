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
                <strong>Messages</strong>
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
                <h5>Conversation avec {{$user->name}}</h5>
            </div>
            <div class="ibox-content">
				
				<div>
					<div class="chat-activity-list"> 
					@foreach ($conversation as $val)
						@php
							$date_msg = Carbon\Carbon::parse($val->created_at);
							$elapsed = $date_msg->diffForHumans(Carbon\Carbon::now());
						@endphp
						@if(Auth::id() == $val->from_id)						
							<div class="chat-element right">
								<a href="#" class="float-right">
									<img src="http://placehold.it/50/AE4435/fff&text={{strtoupper(substr($user_admin->name,0,1))}}" alt="User Avatar" class="img-circle" />								
								</a>
								<div class="media-body text-right ">
									<small class="float-left">{{$elapsed}}</small>
									<strong>{{$user_admin->name}}</strong>
									<p class="m-b-xs">
										{{$val->body}}
									</p>
									<small class="text-muted">{!! htmlspecialchars_decode(date('l jS \\of F Y h:i:s A', strtotime($val->created_at))) !!}</small>
								</div>
							</div>
						@else
							<div class="chat-element">
								<a href="#" class="float-left">
									<img src="http://placehold.it/50/555658/fff&text={{strtoupper(substr($user->name,0,1))}}" alt="User Avatar" class="img-circle" />
								</a>
								<div class="media-body ">
									<small class="float-right text-navy">{{$elapsed}}</small>
									<strong>{{$user->name}}</strong>
									<p class="m-b-xs">
										{{$val->body}}
									</p>
									<small class="text-muted">{!! htmlspecialchars_decode(date('l jS \\of F Y h:i:s A', strtotime($val->created_at))) !!}</small>
								</div>
							</div>
						@endif
					@endforeach					
					</div>
				</div>
				<div class="chat-form">
					<form role="form" id="formContact">
						{{ csrf_field() }}
						<input type="hidden" name="to_id" value="{{$user->id}}" />
						<div class="form-group">
							<textarea class="form-control" name="content" placeholder="Message"></textarea>
						</div>
						<div class="text-right">
							<button type="submit" class="btn btn-sm btn-primary m-t-n-xs"><strong>Send message</strong></button>
						</div>
					</form>
				</div>

				
			</div>
		</div>
	</div>
</div>
@endsection

@section('custom-script')
<script>
$(document).ready(function(){
	$('#formContact').validate({
		ignore: [],
		rules: {
			content: {
				required: true
			}
		},
		messages: {
			content: {
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
	
	$('#formContact').on('submit',function(e){
    	e.preventDefault();
		var formData = $('#formContact').serialize();
		$.ajax({
			url: '{{Auth::user()->isAdmin()?route('admin.ajax.send.message'):route('admin.collaborators.admin.ajax.send.message')}}',
			type: "POST",
			data: formData,
			dataType: "json",
			success:function(data){
				location.reload();	
			}
		});
	});
});
</script>
@endsection