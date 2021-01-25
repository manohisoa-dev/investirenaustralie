@extends('V2.admin.layouts.app')
@section('title', 'Configuration site')
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
		<div class="row m-b-lg m-t-lg">
			<div class="col-md-4">
				<div class="profile-image">
					<img src="{{$item->imageUrl(false)}}" alt="{{$item->name}}" class="rounded-circle circle-border m-b-md" alt="profile">
				</div>
				<div class="profile-info">
					<div class="">
						<div>
							<h2 class="no-margins">
								{{$item->name}}
							</h2>
							<h4>{{$item->email}}</h4>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<table class="table small m-b-xs">
					<tbody>
						<tr>
							<td>
								<strong>@lang('app.form.first_name')</strong>
							</td>
							<td>
								{{$item->get_meta('first_name')?$item->get_meta('first_name')->value:''}}
							</td>
						</tr>
						<tr>
							<td>
								<strong>@lang('app.form.last_name')</strong>
							</td>
							<td>
								{{$item->get_meta('last_name')?$item->get_meta('last_name')->value:''}}
							</td>
						</tr>
						<tr>
							<td>
								<strong>@lang('app.form.language')</strong>
							</td>
							<td>
								{{$item->language == 'fr' ? 'Français' : 'Anglais'}}
							</td>
						</tr>
					</tbody>
				</table>
				<a href="{{route('profile.upadate')}}" class="btn btn-default"><i class="fa fa-pencil"></i> Modifier profile</a>
				<a href="{{route('avatar.edit')}}"  class="btn btn-default"><i class="fa fa-pencil"></i> Modifier Avatar</a>
				<a href="{{route('password.edit')}}"  class="btn btn-default"><i class="fa fa-pencil"></i> Modifier Mot de passe</a>
				<a href="{{route('location.edit')}}" class="btn btn-default"><i class="fa fa-pencil"></i> Modifier Localisation</a>
			</div>
		</div>
	</div>
@endsection

