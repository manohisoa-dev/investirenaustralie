@extends('V2.admin.layouts.app')
@section('breadcrumb')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>@lang('app.login_info')</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('V2/admin')}}">Acceuil</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Profile</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
@endsection

@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">
	<form class="form-horizontal" role="form" method="post" action="{{route('avatar.edit')}}" enctype="multipart/form-data">
		<div class="row m-b-lg m-t-lg">
			<div class="col-md-4">
				<div class="profile-image">
					<img src="{{$item->imageUrl()}}" alt="{{$item->name}}" class="rounded-circle circle-border m-b-md" alt="profile">
				</div>
			</div>
			<div class="col-md-8">
			
			</div>
		</div>
	</form>
	</div>
@endsection