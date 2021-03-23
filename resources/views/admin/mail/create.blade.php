@extends('admin.layouts.app')

@section('title', 'Mails - Ajout ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Mails</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Mails</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.mail.index') }}">Listes</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Nouveau Mail </strong>
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
                <h5>Ajouter un nouveau Mail</h5>
            </div>
            <div class="ibox-content">
                <form action="{{route('admin.mail.compose')}}" method="post" id="commentform" class="contact-form" >
					{{ csrf_field() }}
					<input type="hidden" name="sender_id" value="{{Auth::id()}}">
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">To:</label>
						<div class="col-sm-10">
							<select class="form-control" name="users[]" id="users" multiple="multiple">
								<option value="0">@lang('app.select_user')</option>
								@foreach($users as $user)
									<option value="{{$user->id}}">{{$user->name}}&nbsp;[{{$user->email}}]</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">@lang('app.etbl.sujetth'):</label>
						<div class="col-sm-10"><input type="text" name="subject" class="form-control" value=""></div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Message:</label>
						<div class="col-sm-10">
							<textarea id="message" class="input-block-level ckeditor" rows="10" name="content" placeholder="@lang('app.message')" ></textarea>
						</div>
					</div>
					
				  
					<div class="mail-body text-right tooltip-demo">
						<button type="submit" class="btn btn-sm btn-primary pull-left" name="method" value="send"><i class="fa fa-reply"></i> @lang('app.btn.send')</button>
						<button type="submit" class="btn btn-white btn-sm" name="method" value="draft"><i class="fa fa-pencil"></i> @lang('app.btn.draft')</button>
						<button type="submit" class="btn btn-white btn-sm" name="method" value="model"><i class="fa fa-tag"></i> @lang('app.btn.save_as_model')</button>
					</div> 
				</form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom-script')
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

    <script>
        $(document).ready(function(){
            CKEDITOR.replace( 'content' );
			$("#users").select2();
        }) ;
    </script>
@endsection

