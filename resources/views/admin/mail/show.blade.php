@extends('admin.layouts.app')

@section('title', 'Mails - Détail ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>@lang('app.txt.mails')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">@lang('app.txt.mails')</a>
            </li>
            <li class="breadcrumb-item">
				@if($_GET['filter'] == '')
                <a href="{{ Auth::user()->isAdmin()?route('admin.mail.index'):route('admin.collaborators.admin.mail.index') }}">@lang('app.txt.lists')</a>
				@else
				<a href="{{Auth::user()->isAdmin()?route('admin.mail.list',['filter'=>$_GET['filter']]):route('admin.collaborators.admin.mail.list',['filter'=>$_GET['filter']])}}">@lang('app.txt.lists')</a>
				@endif
            </li>
            <li class="breadcrumb-item active">
                <strong>@lang('app.txt.detail')</strong>
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
        <!-- header -->
		<div class="mail-box-header">
			<div class="float-right">
			@if($mail->status == 'send')
				<a href="{{Auth::user()->isAdmin()?route('admin.mail.compose', $mail):route('admin.collaborators.admin.mail.compose', $mail)}}" class="btn btn-white btn-sm" title="@lang('app.reply')">
					<i class="fa fa-reply"></i> @lang('app.reply')
				</a>
				<a href="#" class="btn btn-white btn-sm" title="@lang('app.btn.delete')">
					<i class="fa fa-trash-o"></i> 
				</a>
			@endif
			</div>
			<div class="mail-tools tooltip-demo m-t-md">
				<h3>
					<span class="font-normal">@lang('app.etbl.sujetth'): </span>{{$mail->subject}}
				</h3>
				<h5>
					<span class="float-right font-normal">{{$mail->created_at ? $mail->created_at->diffForHumans() : ''}}</span>
					<span class="font-normal">@lang('app.txt.from'): </span>{{$mail->sender->email}}
				</h5>
			</div>
		</div>
		<!-- fin header -->
		<!-- contenu -->
		<div class="mail-box">
			<div class="mail-body">
				{!! $mail->content !!}
			</div>
			<div class="clearfix"></div>
		</div>
		<!--fin contenu-->
    </div>
</div>

@endsection